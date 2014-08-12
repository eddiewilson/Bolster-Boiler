<div class="page-wrapper grid">
	<?php
$args = array(
				 'numberposts'       => -1
				 );
$lastposts = get_posts( $args );
foreach($lastposts as $post) : setup_postdata($post); ?>	
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
<?php endforeach; ?>
<div style="clear:both"></div>
</div>
