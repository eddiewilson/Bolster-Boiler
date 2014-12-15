<?php
// Allow the Metaboxes to be arranged
add_action( 'add_meta_boxes', 'action_add_meta_boxes', 0 );
function action_add_meta_boxes() {
    global $_wp_post_type_features;
	if (isset($_wp_post_type_features['post']['editor']) && $_wp_post_type_features['post']['editor']) {
		unset($_wp_post_type_features['post']['editor']);
		add_meta_box(
			'description_section',
			__('Description'),
			'inner_custom_box',
			'post', 'normal', 'high'
		);
	}
	
	if (isset($_wp_post_type_features['page']['editor']) && $_wp_post_type_features['page']['editor']) {
		unset($_wp_post_type_features['page']['editor']);
		add_meta_box(
			'description_sectionid',
			__('Description'),
			'inner_custom_box',
			'page', 'normal', 'high'
		);
	}
}
function inner_custom_box( $post ) {
	the_editor($post->post_content);
}

// Change what's hidden by default
function remove_page_fields() {
 remove_meta_box( 'slugdiv' , 'casestudies' , 'normal' ); //removes slug from Case Studies CPT
 remove_meta_box( 'postexcerpt' , 'casestudies' , 'normal' ); //removes excerpt from Case Studies CPT
 remove_meta_box( 'categorydiv' , 'services' , 'normal' ); //removes category from Services CPT
 remove_meta_box( 'tagsdiv-post_tag' , 'services' , 'normal' ); //removes tags from Services CPT 
}
add_action( 'admin_menu' , 'remove_page_fields' );

// Reorder Dashboard Menu items
// Rearrange the admin menu
  function custom_menu_order($menu_ord) {
    if (!$menu_ord) return true;
    return array(
      'index.php', // Dashboard
      'edit.php?post_type=page', // Pages
      'separator1', // First separator
      'edit.php?post_type=services', // Services
      'edit.php?post_type=casestudies', // Case Studies
      'edit.php', // Journal
      'edit-comments.php', // Comments
      'separator2', // First separator
      'wpseo_dashboard', // Wordpress SEO
      'upload.php', // Media
      'link-manager.php', // Links   
      'themes.php', // Appearance
      'separator-last', // Last separator
      'plugins.php', // Plugins
      'users.php', // Users
      'tools.php', // Tools
      'options-general.php', // Settings
    );
  }

  add_filter('custom_menu_order', 'custom_menu_order'); // Activate custom_menu_order
  add_filter('menu_order', 'custom_menu_order');

