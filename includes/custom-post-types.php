<?php 

// Register Custom Post Type: Book
function beepossible_post_types() {


	// Project - Careers
	$args = array(
		'label'                 => __( 'Career', 'beepossible' ),
		'description'           => __( 'Career Description', 'beepossible' ),
		'labels'                => [
			'name'                  => _x( 'Careers', 'Career General Name', 'beepossible' ),
			'singular_name'         => _x( 'Career', 'Career Singular Name', 'beepossible' ),
			'menu_name'             => __( 'Careers', 'beepossible' ),
			'name_admin_bar'        => __( 'Career', 'beepossible' ),
			'add_new'               => __( 'Add New', 'beepossible' ),
			'new_item'              => __( 'New Career', 'beepossible' ),
			'edit_item'             => __( 'Edit Career', 'beepossible' ),
			'update_item'           => __( 'Update Career', 'beepossible' ),
			'view_item'             => __( 'View Career', 'beepossible' ),
			'view_items'            => __( 'View Careers', 'beepossible' ),
		],
		'supports'              => array( 'title', 'editor' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,
		'menu_icon'   					=> 'dashicons-businessperson',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'career', $args );

	
	// Case Study - Portfolio Post Type
	$args = array(
		'label'                 => __( 'Case Study', 'beepossible' ),
		'description'           => __( 'Case Study Description', 'beepossible' ),
		'labels'                => [
			'name'                  => _x( 'Case Studies', 'Case Study General Name', 'beepossible' ),
			'singular_name'         => _x( 'Case Study', 'Case Study Singular Name', 'beepossible' ),
			'menu_name'             => __( 'Case Studies', 'beepossible' ),
			'name_admin_bar'        => __( 'Case Study', 'beepossible' ),
			'add_new'               => __( 'Add New', 'beepossible' ),
			'new_item'              => __( 'New Case Study', 'beepossible' ),
			'edit_item'             => __( 'Edit Case Study', 'beepossible' ),
			'update_item'           => __( 'Update Case Study', 'beepossible' ),
			'view_item'             => __( 'View Case Study', 'beepossible' ),
			'view_items'            => __( 'View Case Studies', 'beepossible' ),
		],
		'supports'              => array( 'title', 'thumbnail' ),
		'taxonomies'            => array( 'post_tag' ), 
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'rewrite' 							=> array('slug' => 'case-studies', 'with_front' => false), // 👈 important
		'menu_icon'             => 'dashicons-laptop',
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'post',
	);
	register_post_type( 'case-study', $args );


	// Talent - Agency Team Post Type
	$args = array(
		'label'               => __( 'Our Team', 'beepossible' ),
		'description'         => __( 'Our agency talents', 'beepossible' ),
		'labels'              =>[
			'name'               => __( 'Talent', 'beepossible' ),
			'singular_name'      => __( 'Talent', 'beepossible' ),
			'menu_name'          => __( 'Our Team', 'beepossible' ),
			'name_admin_bar'     => __( 'Talent', 'beepossible' ),
			'add_new'            => __( 'Add New', 'beepossible' ),
			'add_new_item'       => __( 'Add New Talent', 'beepossible' ),
			'edit_item'          => __( 'Edit Talent', 'beepossible' ),
			'new_item'           => __( 'New Talent', 'beepossible' ),
			'view_item'          => __( 'View Talent', 'beepossible' ),
		],
		'supports'            => array( 'title', 'thumbnail', 'page-attributes' ),
		'public'              => true,
		'publicly_queryable'  => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_admin_bar'   => true,
		'exclude_from_search' => true,
		'has_archive'         => false,
		'rewrite'             => false,
		'menu_icon'           => 'dashicons-smiley',
		'capability_type'     => 'post',
	);
	register_post_type( 'talent', $args );


	// Clients Post Type
	register_post_type( 'client', [
		'labels'                => [
			'name'               => 'Clients',
			'singular_name'      => 'Client',
			'menu_name'          => 'Clients',
			'name_admin_bar'     => 'Client',
			'add_new'            => 'Add New',
			'add_new_item'       => 'Add New Client',
			'new_item'           => 'New Client',
			'edit_item'          => 'Edit Client',
			'view_item'          => 'View Client',
			'all_items'          => 'All Clients',
			'search_items'       => 'Search Clients',
		],
		'public'             => false,
    'publicly_queryable' => false,
    'show_ui'            => true,
    'show_in_menu'       => true,
    'supports'           => array( 'title', 'thumbnail' ),
    'menu_icon'          => 'dashicons-groups',
    'has_archive'        => false,
    'rewrite'            => false,
    'show_in_rest'       => true,
	] );


	/**
	 * TAXONOMIES
	*/
	register_taxonomy(
		'case-study-cat',
		'case-study',
		array(
			'label'             => 'Case Study Category',
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'      => true,
			'hierarchical'      => true,
			'show_admin_column' => true, // Show column in All Projects
			'show_in_quick_edit'=> true, // Enable in Quick Edit
			'rewrite'           => array(
				'slug'       => 'case-study-cat',
				'with_front' => false
			),
			'labels' => array(
				'name'              => 'Case Study Categories',
				'singular_name'     => 'Case Study Category',
				'search_items'      => 'Search Case Study Categories',
				'all_items'         => 'All Case Study Categories',
				'edit_item'         => 'Edit Case Study Category',
				'update_item'       => 'Update Case Study Category',
				'add_new_item'      => 'Add New Case Study Category',
				'new_item_name'     => 'New Case Study Category Name',
				'menu_name'         => 'Case Study Categories',
			),
		)
	);
	
}

add_action( 'init', 'beepossible_post_types', 0 );
