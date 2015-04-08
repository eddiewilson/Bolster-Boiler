<?php 
// Rename 'Posts' to 'Journal Entries'
add_action( 'admin_menu', 'tjink_rename_post_menu_label' );
add_action( 'init', 'tjink_rename_post_object_label' );
function tjink_rename_post_menu_label() {
	global $menu;
	global $submenu;
	$menu[5][0] = 'Journal Entries';
	$submenu['edit.php'][5][0] = 'Journal Entries';
	$submenu['edit.php'][10][0] = 'Add Journal Entry';
	$submenu['edit.php'][16][0] = 'Journal Tags';
	echo '';
}
function tjink_rename_post_object_label() {
	global $wp_post_types;
	$labels = &$wp_post_types['post']->labels;
	$labels->name = 'Journal Entries';
	$labels->singular_name = 'Journal Entries';
	$labels->add_new = 'Add Journal Entry';
	$labels->add_new_item = 'Add Journal Entries';
	$labels->edit_item = 'Edit Journal Entries';
	$labels->new_item = 'Journal Entries';
	$labels->view_item = 'View Journal Entries';
	$labels->search_items = 'Search Journal Entries';
	$labels->not_found = 'No Journal Entries found';
	$labels->not_found_in_trash = 'No Journal Entries found in Trash';
}
// Remove Screen options from certain screens
