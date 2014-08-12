<?php
/**
* @package WordPress
* @subpackage deathofbolster
**/

//Gallery Slider
	function slider_script() {
	wp_enqueue_script(
		'slider_script',
		get_template_directory_uri() . '/js/swipe.js',
		array( 'jquery' )
	);
}
add_action( 'wp_enqueue_scripts', 'slider_script' );

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


//Slider script in Footer
wp_enqueue_script( 'slider-activate', get_bloginfo('template_directory') . '/js/slider-activate.js', array( 'jquery' ), '', true );

//Loading script in Footer
wp_enqueue_script( 'loading', get_bloginfo('template_directory') . '/js/lg-script.js', array( 'jquery' ), '', false );



