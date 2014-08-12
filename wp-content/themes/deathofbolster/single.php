<?php get_header(); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
<?php get_template_part('project-detail'); ?>
<div class="page-wrapper">
<h1><?php
$posttags = get_the_tags();
if ($posttags) {
  foreach($posttags as $tag) {
    echo $tag->name . ' '; 
  }
}
?><span>- <?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_client_industry_meta', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?></span></h1>
<h2><?php 
echo strip_tags (
    get_the_term_list( $post->ID, 'sub-catagory', " ",", " )
);
?></h2>
</div>
<article class="content">
<?php get_template_part( 'entry' ); ?>
<?php endwhile; endif; ?>
</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>

