<?php 

// Ajouter le formulaire de recherche avec un nonce et AJAX
function user_search_form() {
    ob_start();
    ?>
    <form id="user-search-form">
        <input type="text" id="search_user" name="search_user" placeholder="Rechercher par nom ou prénom...">
        <button type="submit">Rechercher</button>
        <?php wp_nonce_field('user_search_nonce_action', 'user_search_nonce'); ?>
    </form>

    <div id="user-search-results"></div>

    <?php
    return ob_get_clean();
}
add_shortcode('user_search_form', 'user_search_form');

// Ajouter le script AJAX
function user_search_script() {
    ?>
    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $('#user-search-form').submit(function(e) {
                e.preventDefault();  // Empêche le rechargement de la page

                var search_query = $('#search_user').val();
                var nonce = $('#user-search-form').find('input[name="user_search_nonce"]').val(); // Récupère le nonce

                if (search_query.length > 0) {
                    $.ajax({
                        url: '<?php echo admin_url('admin-ajax.php'); ?>',
                        type: 'GET',
                        data: {
                            action: 'search_users',
                            search_user: search_query,
                            user_search_nonce: nonce  // Envoie le nonce avec la requête
                        },
                        success: function(response) {
                            $('#user-search-results').html(response);
                        }
                    });
                }
            });
        });
    </script>
    <?php
}
add_action('wp_footer', 'user_search_script');

// Traitement de la recherche d'utilisateurs via AJAX avec vérification du nonce
function search_users_ajax() {
    // Vérification du nonce
    if (!isset($_GET['user_search_nonce']) || !wp_verify_nonce($_GET['user_search_nonce'], 'user_search_nonce_action')) {
        die('Nonces non valides, action non autorisée.');
    }

    if (isset($_GET['search_user'])) {
        $search_query = sanitize_text_field($_GET['search_user']);

        $args = [
            'meta_query' => [
                'relation' => 'OR',
                [
                    'key'     => 'first_name',
                    'value'   => $search_query,
                    'compare' => 'LIKE'
                ],
                [
                    'key'     => 'last_name',
                    'value'   => $search_query,
                    'compare' => 'LIKE'
                ]
            ]
        ];

        $users = get_users($args);

        if (!empty($users)) {
            echo "<ul>";
            foreach ($users as $user) {
                $first_name = get_user_meta($user->ID, 'first_name', true);
                $last_name = get_user_meta($user->ID, 'last_name', true);
                echo "<li>{$first_name} {$last_name}</li>";
            }
            echo "</ul>";
        } else {
            echo "<p>Aucun utilisateur trouvé.</p>";
        }
    }

    wp_die(); // Terminer la requête AJAX
}
add_action('wp_ajax_search_users', 'search_users_ajax');
add_action('wp_ajax_nopriv_search_users', 'search_users_ajax');
