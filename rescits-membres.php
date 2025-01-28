<?php
/*
Plugin Name: Membres rescits
Plugin URI: https:\/\/rescits.ca
Description: Gestion, inscription et affichage des membres du rescits
Version: 1.0
Author: La Fabrique de blogs
Author URI: https:\/\/lafabriquedeblogs.com
Text Domain: rescits
*/

function rescits_add_user_roles()
{
    // Add new roles
    add_role('membre_regulier_citoyen', __('Membre régulier·ère Citoyen', 'rescits'), array('read' => true));
    add_role('membre_regulier_universitaire', __('Membre régulier·ère Universitaire', 'rescits'), array('read' => true));
    add_role('membre_releve_scientifique', __('Membre de la relève scientifique', 'rescits'), array('read' => true));
    add_role('membre_collaborateur_citoyen', __('Membre collaborateur·rice Citoyen', 'rescits'), array('read' => true));
    add_role('membre_collaborateur_universitaire', __('Membre collaborateur·rice Universitaire', 'rescits'), array('read' => true));
}
register_activation_hook(__FILE__, 'rescits_add_user_roles');

function rescits_membres_styles()
{
    wp_enqueue_style('rescits-membres-style', plugin_dir_url(__FILE__) . '/assets/css/front.css', array(), false, "screen");
    // App
    // wp_enqueue_script('rescits-smembres-cripts', get_stylesheet_directory_uri() . "/assets/js/app-min.js", array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'rescits_membres_styles', 999);

function rescits_membres_admin_styles()
{
    wp_enqueue_style('rescits-membres-style', plugin_dir_url(__FILE__) . '/assets/css/admin.css');
}
add_action('admin_enqueue_scripts', 'rescits_membres_admin_styles');
add_filter('admin_body_class', 'rescits_add_profile_role_to_body_class');

function rescits_add_profile_role_to_body_class($classes)
{
    global $pagenow;

    if ($pagenow === 'user-edit.php' || $pagenow === 'profile.php') {
        // Get the user ID from the query
        $user_id = isset($_GET['user_id']) ? intval($_GET['user_id']) : get_current_user_id();
        $user = get_userdata($user_id);
        $user_roles = $user->roles;

        // Add each role to the body classes
        foreach ($user_roles as $role) {
            $classes .= ' profile-role-' . $role;
        }
    }

    return $classes;
}

require plugin_dir_path( __FILE__ ) . '/inc/post-types.php';
require plugin_dir_path( __FILE__ ) . '/inc/user-edit/user-edit-form.php';
require plugin_dir_path( __FILE__ ) . '/inc/gf/gf-hooks.php';
require plugin_dir_path( __FILE__ ) . '/inc/short_code_membre.php';