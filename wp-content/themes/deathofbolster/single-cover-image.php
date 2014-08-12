<?php $args = array( 'post_type' => 'cover-image', 'orderby' => 'rand', 'posts_per_page' => '1' );
$loop = new WP_Query( $args );
while ( $loop->have_posts() ) : $loop->the_post();
?>	
<img class="cover-image" src="<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_home_cover_image', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?>" height="780"/>
<?php
endwhile;
wp_reset_postdata();
?>
