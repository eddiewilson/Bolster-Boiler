<?php
/**
* @package WordPress
* @subpackage deathofbolster
**/

// Rename 'Tags' to be Clients

function clients_tagged_init() {
	global $wp_taxonomies;
	$wp_taxonomies['post_tag']->labels = (object) array(
		'name' => 'Client',
		'singular_name' => 'Client',
		'all_items' => 'All Clients',
		'edit_item' => 'Edit Client',
		'menu_name' => 'Clients',
		'update_item' => 'Update Client',
		'add_new_item' => 'Add New Client',
		'search_items' => 'Search Clients',
		'popular_items' => 'Popular Clients',
		'new_item_name' => 'New Client Name',
		'add_or_remove_items' => 'Add or remove Clients',
		'parent_item' => null, 'parent_item_colon' => null,
		'choose_from_most_used' => 'Choose from most used Clients',
		'separate_items_with_commas' => 'Separate Clients with commas',
	);
	$wp_taxonomies['post_tag']->label = 'Clients';
}
add_action( 'init', 'clients_tagged_init' );

// Rename 'Posts' to be Projects
	
function change_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Project';
	$submenu['edit.php'][5][0] = 'Project';
	$submenu['edit.php'][10][0] = 'Add Project';
	$submenu['edit.php'][16][0] = 'Project Client';
	echo '';
}
function change_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Project';
	$labels->singular_name = 'Project';
	$labels->add_new = 'Add Project';
	$labels->add_new_item = 'Add Project';
	$labels->edit_item = 'Edit Project';
	$labels->new_item = 'Project';
	$labels->view_item = 'View Project';
	$labels->search_items = 'Search Projects';
	$labels->not_found = 'No Project found';
	$labels->not_found_in_trash = 'No Project found in Trash';
}
add_action( 'init', 'change_post_object_label' );
add_action( 'admin_menu', 'change_post_menu_label' );

// Add Another 'Posts' Menu item (admin)

// Sub Catagory Taxonomy

function subcat_taxonomies() {
	// Add new "Sub-Catagory" taxonomy to Posts
	register_taxonomy('sub-catagory', 'post', array(
		// Hierarchical taxonomy (like categories)
		'hierarchical' => true,
		// This array of options controls the labels displayed in the WordPress Admin UI
		'labels' => array(
			'name' => _x( 'Sub-Catagory', 'taxonomy general name' ),
			'singular_name' => _x( 'Sub-Catagory', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Sub-Catagories' ),
			'all_items' => __( 'All Sub-Catagories' ),
			'parent_item' => __( 'Parent Sub-Catagories' ),
			'parent_item_colon' => __( 'Parent Sub-Catagories:' ),
			'edit_item' => __( 'Edit Sub-Catagories' ),
			'update_item' => __( 'Update Sub-Catagory' ),
			'add_new_item' => __( 'Add New Sub-Catagory' ),
			'new_item_name' => __( 'New Sub-Catagory Name' ),
			'menu_name' => __( 'Sub-Catagories' ),
		),
		// Control the slugs used for this taxonomy
		'rewrite' => array(
			'slug' => 'sub-catagory', // This controls the base slug that will display before each term
			'with_front' => false, // Don't display the category base before "/locations/"
			'hierarchical' => true // This will allow URL's like "/locations/boston/cambridge/"
		),
	));
}
add_action( 'init', 'subcat_taxonomies', 0 );
// Add Cover Image to Top Level Menu

function lg_post_cover_image() {
	$labels = array(
		'name'               => _x( 'Cover Image', 'post type general name' ),
		'singular_name'      => _x( 'Cover Image', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'book' ),
		'add_new_item'       => __( 'Add New Cover Image' ),
		'edit_item'          => __( 'Edit Cover Image' ),
		'new_item'           => __( 'New Cover Image' ),
		'all_items'          => __( 'All Cover Images' ),
		'view_item'          => __( 'View Cover Image' ),
		'search_items'       => __( 'Search Cover Images' ),
		'not_found'          => __( 'No Cover Image found' ),
		'not_found_in_trash' => __( 'No Cover Image found in the Trash' ), 
		'parent_item_colon'  => '',
		'menu_name'          => 'Cover Image'
	);
	$args = array(
		'labels'        => $labels,
		'description'   => 'Holds our Cover Images specific data',
		'public'        => true,
		'menu_position' => 5,
		'supports'      => array( 'title', 'editor', 'thumbnail', ),
		'has_archive'   => true,
	);
	register_post_type( 'cover-image', $args );	
}
add_action( 'init', 'lg_post_cover_image' );

//Custom Home Color Meta Box
function home_nav_color( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'nav_color',
		'title' => 'Nav Colour',
		'pages' => array('cover-image'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
	      'name' => 'Navigation Home Colour',
	      'desc' => 'Change the nav colour to suit the cover image',
	      'id'   => $prefix . 'home_nav_color',
	      'type' => 'colorpicker',
	      'std'  => '#DB5B48',
	      ),
	   ),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'home_nav_color' );

//Project Hero Image Meta Box
function project_image( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'project_image',
		'title' => 'Project Images',
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
			array(
	      'name' => 'Project Hero Image',
	      'desc' => 'Add the hero for the project',
	      'id'   => $prefix . 'project_hero_image',
	      'type' => 'file',
	      ),
	   ),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'project_image' );


// Custom Home Image Meta Box
function home_image( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'home_image',
		'title' => 'Home Cover Image',
		'pages' => array('cover-image'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
	    array(
				'name' => 'Home Cover Image',
				'desc' => 'Upload an image or enter an URL.',
				'id'   => $prefix . 'home_cover_image',
				'type' => 'file',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'home_image' );

// Custom Home Video Meta Box
function home_video( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'home_video',
		'title' => 'Home Cover Video',
		'pages' => array('cover-image'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
	    array(
				'name' => 'oEmbed',
				'desc' => 'Enter a youtube, twitter, or instagram URL.',
				'id' => $prefix . 'home_cover_video',
				'type' => 'oembed',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'home_video' );

// Client Industry Meta Box
function client_industry( $meta_boxes ) {
	$prefix = '_cmb_'; // Prefix for all fields
	$meta_boxes[] = array(
		'id' => 'client_industry',
		'title' => 'Client Industry',
		'pages' => array('post'), // post type
		'context' => 'normal',
		'priority' => 'high',
		'show_names' => true, // Show field names on the left
		'fields' => array(
	    array(
				'name' => 'Clients Industry',
				'desc' => 'Enter the industry/job title of client',
				'id'   => $prefix . 'client_industry_meta',
				'type' => 'text',
			),
		),
	);

	return $meta_boxes;
}
add_filter( 'cmb_meta_boxes', 'client_industry' );

// Initialize the metabox class
add_action( 'init', 'lg_initialize_cmb_meta_boxes', 9999 );
function lg_initialize_cmb_meta_boxes() {
	if ( !class_exists( 'cmb_Meta_Box' ) ) {
		require_once( 'library/metabox/init.php' );
	}
}