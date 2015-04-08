<?php
	// Enqueue stylesheet for custom admin buttons
	function my_admin_dashboard_css() {
    wp_enqueue_style('admin_dashboard_css', get_template_directory_uri() . '/functions/custom-admin/assets/css/style.css', array(), '1.0', 'all');
	}
	add_action( 'admin_enqueue_scripts', 'my_admin_dashboard_css' );
