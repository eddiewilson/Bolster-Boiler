<?php get_header(); ?>
	<div class="page-wrapper">
		<?php the_post(); ?>
		<?php rewind_posts(); ?>
		<?php while ( have_posts() ) : the_post(); ?>
		<div class="grid-col">
		<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail', $attr ); ?>
		<div class="rollover">
		<p>Click to View</p>
		</div></a>
			<!-- <h5><a href="<?php echo get_permalink(); ?>"><?php
$posttags = get_the_tags();
if ($posttags) {
  foreach($posttags as $tag) {
    echo $tag->name . ' '; 
  }
}
?></a></h5>			
			<span><?php 
echo strip_tags (
    get_the_term_list( $post->ID, 'sub-catagory', " ",", " )
);
?></span> -->
	</div>
<?php endwhile; ?>
</div>
<div style="clear:both"></div>
<?php get_sidebar(); ?>
<?php get_footer(); ?>