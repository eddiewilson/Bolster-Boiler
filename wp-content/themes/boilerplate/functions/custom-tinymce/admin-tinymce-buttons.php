<?php
	// Enqueue stylesheet for custom buttons
	function my_shortcodes_mce_css() {
    wp_enqueue_style('symple_shortcodes-tc', get_template_directory_uri() . '/functions/custom-tinymce/assets/css/style.css', array(), '1.0', 'all');
	}
	add_action( 'admin_enqueue_scripts', 'my_shortcodes_mce_css' );

	// Hooks your functions into the correct filters
function my_add_mce_button() {
	// check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) ) {
		return;
	}
	// check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) ) {
		add_filter( 'mce_external_plugins', 'my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', 'my_register_mce_button' );
	}
}
add_action('admin_head', 'my_add_mce_button');

// Declare script for new button
function my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['tinymce_buttons'] = get_template_directory_uri() .'/functions/custom-tinymce/assets/js/tinymce-button.js';
	return $plugin_array;
}

// Register new buttons in the editor
function my_register_mce_buttons( $buttons ) {
	array_push( $buttons, 'runin_button', 'cta_button', 'h1_button', 'h2_button', 'h3_button' );
	return $buttons;
}