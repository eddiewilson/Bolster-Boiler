<?php
//  Start the Session for form validation:
add_action('init', 'myStartSession', 1);
add_action('wp_logout', 'myEndSession');
add_action('wp_login', 'myEndSession');

function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}

function myEndSession() {
    session_destroy ();
}
//Making jQuery Google API
function modify_jquery() {
	if (!is_admin()) {
		// comment out the next two lines to load the local copy of jQuery
		wp_deregister_script('jquery');
		wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js', false, '1.8.1');
		wp_enqueue_script('jquery');
	}
}
add_action('init', 'modify_jquery');
// Add Featured Image Support
add_theme_support( 'post-thumbnails' );
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
    h1 a { background-image:url('.get_bloginfo('template_directory').'/assets/bolster.png) !important;
    width:16px; height:16px; }
    </style>';
}
add_action('login_head', 'custom_login_logo');
// Remove Height/Width Atts
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
function remove_width_attribute( $html ) {
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
}
//Change the WP Gallery
add_filter( 'post_gallery', 'my_post_gallery', 10, 2);
function my_post_gallery( $output, $attr) {
    global $post, $wp_locale;
    static $instance = 0;
    $instance++;
    // We're trusting author input, so let's at least make sure it looks like a valid orderby statement
    if ( isset( $attr['orderby'] ) ) {
        $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
        if ( !$attr['orderby'] )
            unset( $attr['orderby'] );
    }
    extract(shortcode_atts(array(
        'order'      => 'ASC',
        'orderby'    => 'menu_order ID',
        'id'         => $post->ID,
        'itemtag'    => '',
        'icontag'    => '',
        'captiontag' => '',
        'columns'    => 3,
        'size'       => 'full',
        'include'    => '',
        'exclude'    => ''
    ), $attr));
    $id = intval($id);
    if ( 'RAND' == $order )
        $orderby = 'none';
    if ( !empty($include) ) {
        $include = preg_replace( '/[^0-9,]+/', '', $include );
        $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
        $attachments = array();
        foreach ( $_attachments as $key => $val ) {
            $attachments[$val->ID] = $_attachments[$key];
        }
    } elseif ( !empty($exclude) ) {
        $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );
        $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    } else {
        $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
    }
    if ( empty($attachments) )
        return '';
    if ( is_feed() ) {
        $output = "\n";
        foreach ( $attachments as $att_id => $attachment )
            $output .= wp_get_attachment_link($att_id, $size, true) . "\n";
        return $output;
    }
    $itemtag = tag_escape($itemtag);
    $captiontag = tag_escape($captiontag);
    $columns = intval($columns);
    $itemwidth = $columns > 0 ? floor(100/$columns) : 100;
    $float = is_rtl() ? 'right' : 'left';
    $selector = "slider";
    $output = apply_filters('gallery_style', "
        <div id='slider' class='swipe galleryid-{$id}'>
        		<div class='swipe-wrap'>
        			 ");
    $i = 0;
    foreach ( $attachments as $id => $attachment ) {
        $link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_image($id, $size) : wp_get_attachment_image($id, $size);
        $output .= "$link";
        if ( $captiontag && trim($attachment->post_excerpt) ) {
            $output .= "
                <{$captiontag} class='gallery-caption'>
                " . wptexturize($attachment->post_excerpt) . "
                </{$captiontag}>";
        }
        $output .= "</{$itemtag}>";
        if ( $columns > 0 && ++$i % $columns == 0 )
            $output .= '';
    }
    $output .= "
        </div></div>
        <div style='text-align:center;padding-top:20px;'>
  <button onclick='slider.prev()'>prev</button> 
  <button onclick='slider.next()'>next</button>
</div>
\n";
    return $output;
}
// Add Typekit Fonts
require_once( get_template_directory() . '/snippets/fonts-typekit.php' );
// Form script in Header
function lg_form_scripts() {
	wp_enqueue_script(
		'form-script',
		get_template_directory_uri() . '/js/script.js',
		array( 'jquery' )
	);
}
add_action( 'wp_enqueue_scripts', 'lg_form_scripts' );
// Modernizr script in Header
function lg_modernizr_scripts() {
	wp_enqueue_script(
		'modernizr-script',
		get_template_directory_uri() . '/js/libs/modernizr-1.7.min.js',
		array( 'jquery' )
	);
}
add_action( 'wp_enqueue_scripts', 'lg_modernizr_scripts' );
// Google Analytics
function lg_google_analytics() {
?>
<script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-29424686-1']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();
</script>
<?php
}
add_action('wp_head', 'lg_google_analytics',99);
// Fix image compression

@ini_set( 'upload_max_size' , '500M' );
@ini_set( 'post_max_size', '500M');
@ini_set( 'max_execution_time', '300' );