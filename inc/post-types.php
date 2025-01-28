<?php 

// Register Custom Post Type
function rescits_membre_post_type() {

	$labels = array(
		'name'                  => _x( 'Membres', 'Post Type General Name', 'rescits' ),
		'singular_name'         => _x( 'Membre', 'Post Type Singular Name', 'rescits' ),
		'menu_name'             => __( 'Membres', 'rescits' ),
		'name_admin_bar'        => __( 'Membre', 'rescits' ),
		'archives'              => __( 'Item Archives', 'rescits' ),
		'attributes'            => __( 'Item Attributes', 'rescits' ),
		'parent_item_colon'     => __( 'Parent Item:', 'rescits' ),
		'all_items'             => __( 'All Items', 'rescits' ),
		'add_new_item'          => __( 'Add New Item', 'rescits' ),
		'add_new'               => __( 'Add New', 'rescits' ),
		'new_item'              => __( 'New Item', 'rescits' ),
		'edit_item'             => __( 'Edit Item', 'rescits' ),
		'update_item'           => __( 'Update Item', 'rescits' ),
		'view_item'             => __( 'View Item', 'rescits' ),
		'view_items'            => __( 'View Items', 'rescits' ),
		'search_items'          => __( 'Search Item', 'rescits' ),
		'not_found'             => __( 'Not found', 'rescits' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'rescits' ),
		'featured_image'        => __( 'Featured Image', 'rescits' ),
		'set_featured_image'    => __( 'Set featured image', 'rescits' ),
		'remove_featured_image' => __( 'Remove featured image', 'rescits' ),
		'use_featured_image'    => __( 'Use as featured image', 'rescits' ),
		'insert_into_item'      => __( 'Insert into item', 'rescits' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'rescits' ),
		'items_list'            => __( 'Items list', 'rescits' ),
		'items_list_navigation' => __( 'Items list navigation', 'rescits' ),
		'filter_items_list'     => __( 'Filter items list', 'rescits' ),
	);
	$args = array(
		'label'                 => __( 'Membre', 'rescits' ),
		'description'           => __( 'Profil des membres du rescits', 'rescits' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'custom-fields', 'page-attributes' ),
		'taxonomies'            => array( 'type_de_membre' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 70,
		'menu_icon'             => 'dashicons-star-empty',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'          => true,
	);
	register_post_type( 'membre_rescits', $args );

}
add_action( 'init', 'rescits_membre_post_type', 0 );