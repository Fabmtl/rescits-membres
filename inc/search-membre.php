<?php

    // Ajouter le formulaire de recherche avec un nonce et AJAX
    function user_search_form()
    {
        ob_start();
    ?>
    <form id="user-search-form">
        <input type="text" id="search_user" name="search_user" placeholder="Rechercher par nom ou prénom...">
        <button type="submit">Rechercher</button> 
        <?php wp_nonce_field('user_search_nonce_action', 'user_search_nonce'); ?>
    </form>
    <button onClick="window.location.reload();">Refresh Page</button>
    <div id="user-search-results"></div>

    <?php
        return ob_get_clean();
        }
        add_shortcode('user_search_form', 'user_search_form');

        // Ajouter le script AJAX
        function user_search_script()
        {
        ?>
    <script type="text/javascript">
        // jQuery(document).ready(function($) {
        //     $('#user-search-form').submit(function(e) {
        //         e.preventDefault();  // Empêche le rechargement de la page

        //         var search_query = $('#search_user').val();
        //         var nonce = $('#user-search-form').find('input[name="user_search_nonce"]').val(); // Récupère le nonce

        //         if (search_query.length > 0) {
        //             $.ajax({
        //                 url: '<?php echo admin_url('admin-ajax.php'); ?>',
        //                 type: 'GET',
        //                 data: {
        //                     action: 'search_users',
        //                     search_user: search_query,
        //                     user_search_nonce: nonce  // Envoie le nonce avec la requête
        //                 },
        //                 success: function(response) {
        //                     $('#user-search-results').html(response);
        //                     $('.default-list-membres').hide();
        //                     $('.wp-block-heading').hide();
        //                 }
        //             });
        //         }
        //     });
        // });
    </script>
    <?php
        }
        add_action('wp_footer', 'user_search_script');

        // Traitement de la recherche d'utilisateurs via AJAX avec vérification du nonce
        function search_users_ajax()
        {
            // Vérification du nonce
            if (! isset($_GET['user_search_nonce']) || ! wp_verify_nonce($_GET['user_search_nonce'], 'user_search_nonce_action')) {
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
                            'compare' => 'LIKE',
                        ],
                        [
                            'key'     => 'last_name',
                            'value'   => $search_query,
                            'compare' => 'LIKE',
                        ],
                    ],
                ];

                $users = get_users($args);
                // $output = rescits_get_users_by_id($users);
                if (! empty($users)) {
                    echo '<ul class="user-list">';
                    $membre = '';
                    foreach ($users as $user) {
                        $userId         = $user->ID;
                        $user_full_name = $user->display_name;

                        $role      = get_role($user->roles[0])->name;
                        $user_type = $role ? wp_roles()->get_names()[$role] : '';

                        $user_photo = false;
                        $lien       = false;
                        $bio        = false;
                        switch ($role) {
                            case 'membre_collaborateur_citoyen':
                                /**
                                 * membre_collaborateur_milieux_cpc_titre
                                 * membre_collaborateur_milieux_cpc_affiliation
                                 * membre_collaborateur_milieux_cpc_champ_pratique
                                 */
                                $champ1 = get_user_meta($userId, 'membre_collaborateur_milieux_cpc_titre', true);
                                $champ2 = get_user_meta($userId, 'membre_collaborateur_milieux_cpc_affiliation', true);
                                $champ3 = get_user_meta($userId, 'membre_collaborateur_milieux_cpc_champ_pratique', true);
                                break;
                            case 'membre_collaborateur_universitaire':
                                /**
                                 * membre_collaborateur_universitaire_titre
                                 * membre_collaborateur_universitaire_institution
                                 * membre_collaborateur_universitaire_departement
                                 */

                                $champ1 = get_user_meta($userId, 'membre_collaborateur_universitaire_titre', true);
                                $champ2 = get_user_meta($userId, 'membre_collaborateur_universitaire_institution', true);
                                $champ3 = get_user_meta($userId, 'membre_collaborateur_universitaire_departement', true);
                                break;
                            case 'membre_regulier_citoyen':
                                /**
                                 * membre_citoyen_regulier_affiliation_1
                                 * membre_citoyen_regulier_type_membre
                                 * membre_citoyen_regulier_bio
                                 */
                                $user_photo = (false != get_user_meta($userId, 'photo_membre', true)) ? get_user_meta($userId, 'photo_membre', true) : false;
                                $champ1     = get_user_meta($userId, 'membre_citoyen_regulier_affiliation_1', true);
                                $champ2     = get_user_meta($userId, 'membre_citoyen_regulier_type_membre', true);
                                $bio        = get_user_meta($userId, 'membre_citoyen_regulier_bio', true);
                                break;
                            case 'membre_regulier_universitaire':
                                /**
                                 * membre_universitaire_collegial_regulier_titre
                                 * membre_universitaire_collegial_regulier_affiliation_1
                                 * membre_universitaire_collegial_regulier_bio
                                 * url
                                 */
                                $user_photo = (false != get_user_meta($userId, 'photo_membre', true)) ? get_user_meta($userId, 'photo_membre', true) : false;
                                $champ1     = get_user_meta($userId, 'membre_citoyen_regulier_affiliation_1', true);
                                $champ2     = get_user_meta($userId, 'membre_universitaire_collegial_regulier_affiliation_1', true);
                                $bio        = get_user_meta($userId, 'membre_universitaire_collegial_regulier_bio', true);
                                $lien       = get_user_meta($userId, 'url', true);
                                break;
                            default:
                                /**
                                 * membre_releve_scientifique_departement
                                 * membre_releve_scientifique_institution
                                 * membre_releve_scientifique_programme
                                 * */
                                $champ1 = get_user_meta($userId, 'membremembre_releve_scientifique_departement_citoyen_regulier_affiliation_1', true);
                                $champ3 = get_user_meta($userId, 'membre_releve_scientifique_institution', true);
                                $champ2 = get_user_meta($userId, 'membre_releve_scientifique_programme', true);
                                break;
                        }
                        ob_start();
                    ?>
                 <li class="membre-rescits membre-rescits shadow<?php echo $role; ?>">

                        <?php if ($user_photo): ?>
                        <figure class="figure-membre to-up">
                            <img fetchpriority="high" decoding="async" width="180" height="180" src="<?php echo $user_photo ?>" alt="" class="image-membre" />
                        </figure>
                        <?php endif; ?>
                        <p class="type-membre  to-up"><?php echo $user_type; ?></p>
                        <div class="nom-titre-membre to-up">
                            <h4 class="nom-membre"><?php echo $user_full_name; ?></h4>
                            <p class="titre-membre">
                                <?php echo $champ1; ?>
                            </p>
                        </div>
                        <p class="champ-2  to-up">
                            <?php echo $champ2; ?>
                        </p>
                        <p class="champ-3  to-up">
                            <?php echo $champ3; ?>
                        </p>
                        <?php if ($bio): ?>
                            <p class="bio  to-up"><?php echo $bio; ?></p>
                            <a class="voir-bio">voir la bio</a>
                        <?php endif; ?>

                </li>
                <?php
                    $membre .= ob_get_clean();
                                    // echo rescits_get_users_by_id($users, $type );
                                }
                                echo $membre;
                                echo '</ul>';
                            } else {
                                echo "<p>Aucun utilisateur trouvé.</p>";
                            }
                        }

                        wp_die(); // Terminer la requête AJAX
                    }
                add_action('wp_ajax_search_users', 'search_users_ajax');
                add_action('wp_ajax_nopriv_search_users', 'search_users_ajax');
