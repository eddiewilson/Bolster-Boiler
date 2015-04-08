<?php 
	
function dynamic_stylesheet() {

global $post;
	$thumb_id = get_post_thumbnail_id( $post->ID );
	$thumb_url_array = wp_get_attachment_image_src($thumb_id, 'full', true);
	$image = $thumb_url_array[0];
	
	$pagecolor = get_post_meta( $post->ID, '_cmb_page_colorpicker', true );

	if (is_page() || is_post_type_archive() || is_front_page() || is_home() || is_single()) { ?>

<?php 
/* Convert hexdec color string to rgb(a) string */

function hex2rgba($color, $opacity = false) {

	$default = 'rgba(0, 0, 0, 0.7)';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}

	$color = $pagecolor;
	$rgb = hex2rgba($color);
	$rgba = hex2rgba($color, 0.7);
?>

<style type="text/css">
.header-feature{
	background-image: url(' <?php echo $image; ?>') !important;
}
.button{
	background-color:<?php echo $pagecolor; ?> !important;
}
.overlay{
	background-color:<?php echo $rgba; ?> !important;
}
.case-study-hover{
	background-color:<?php echo $rgba; ?> !important;
}
blockquote:before, blockquote:after, h2:after{
	border-color: <?php echo $pagecolor; ?>;
}
.current_page_item a{
	color: <?php echo $pagecolor; ?> !important;
}
.title-icon{
	background: <?php echo $pagecolor; ?> !important;
}
.social-nav ul li a:hover{
	color: <?php echo $pagecolor; ?> !important;
}
::selection {
  background: <?php echo $pagecolor; ?> !important; /* WebKit/Blink Browsers */
}
::-moz-selection {
  background: <?php echo $pagecolor; ?> !important; /* Gecko Browsers */
}
#submit{
	background-color:<?php echo $rgba; ?> !important;
}
</style>

<?php } }

add_action('wp_head','dynamic_stylesheet');