<?php
/**
* @package WordPress
* @subpackage deathofbolster
**/
// Remove 'a' Tags From Images

function attachment_image_link_remove_filter( $content ) {
    $content =
        preg_replace(array('{<a[^>]*><img}','{/></a>}'), array('<img','/>'), $content);
    return $content;
}

// Remove 'p' Tags From Images

function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

add_filter('the_content', 'filter_ptags_on_images');

// Custom WordPress Login Logo
function login_css() {
	wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login.css' );
}
add_action('login_head', 'login_css');

// Custom WordPress Admin Color Scheme
function admin_css() {
	wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin.css' );
}
add_action('admin_print_styles', 'admin_css' );

// Custom WordPress Footer
function remove_footer_admin () {
	echo '&copy; 2013 - Lighthouse &amp; Giant';
}
add_filter('admin_footer_text', 'remove_footer_admin');

// Remove Widgets
function remove_some_wp_widgets(){
  unregister_widget('WP_Widget_Calendar');
  unregister_widget('WP_Widget_Search');
  unregister_widget('WP_Widget_Recent_Comments');
  unregister_widget('WP_Widget_Archives');
  unregister_widget('WP_Widget_Categories');
  unregister_widget('WP_Widget_Meta');
  unregister_widget('WP_Widget_Tag_Cloud');
  unregister_widget('WP_Widget_Pages');
  unregister_widget('WP_Widget_Custom_Menu');
  unregister_widget('WP_Widget_RSS');
  unregister_widget('WP_Widget_Recent_Posts');
}

add_action('widgets_init','remove_some_wp_widgets', 1);

// Remove Admin Menu Items
function remove_menu_items() {
  global $menu;
  $restricted = array(__('Links'), __('Comments'));
  end ($menu);
  while (prev($menu)){
    $value = explode(' ',$menu[key($menu)][0]);
    if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){
      unset($menu[key($menu)]);}
    }
  }

add_action('admin_menu', 'remove_menu_items');

// Add a widget in WordPress Dashboard
function wpc_dashboard_widget_function() {
	// Entering the text between the quotes
	echo '';
}
function wpc_add_dashboard_widgets() {
	wp_add_dashboard_widget('wp_dashboard_widget', 'Look Nath! Check out the site in a shitty iframe!', 'wpc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets' );

//Small Admin Logo (top left)
function custom_logo() {
  echo '<style type="text/css">
    .ab-icon { background-image: url('.get_bloginfo('template_directory').'/favicon.png) !important;}
    </style>';
}

add_action('admin_head', 'custom_logo');

function custom_login_logo() {
  echo '<style type="text/css">
    h1 a { background-image:url('.get_bloginfo('template_directory').'/images/login_logo.png) !important;
    width:16px; height:16px; }
    </style>';
}

add_action('login_head', 'custom_login_logo');

