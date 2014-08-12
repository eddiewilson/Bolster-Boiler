<?php
/*
Template Name: Video Prod/Two Column Template
*/
?>
<?php get_header();?>
<div class="container">
	<div class="five alpha">
		 <div class="featured-image">
        <?php echo get_the_post_thumbnail( $post_id, $size, $attr ); ?>
     </div>
	</div>
	<div class="seven omega">
		<div class="content">
			<?php while ( have_posts() ) : the_post(); ?> <!--  the Loop -->
		</div>
	</div>
</div>

