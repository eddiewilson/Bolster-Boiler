<?php
/*
Template Name: Home Cover */
?>
<?php $args = array( 'post_type' => 'cover-image', 'orderby' => 'rand', 'posts_per_page' => '1' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>	
<?php get_header(); ?>
 <script type="text/javascript">
 jQuery(document).ready(function(){
    jQuery('#site').css( 'background-image', 'url(<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_home_cover_image', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?>
)' );
});
 </script>
<div class="cover-image">
</div>
<?php
endwhile;
wp_reset_postdata();
?>
<?php get_footer(); ?>



