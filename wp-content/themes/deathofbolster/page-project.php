<?php
/*
Template Name: Projects */
?>
<?php get_header(); ?>
<div class="hero">
<?php the_post_thumbnail( $size, $attr ); ?>
</div>
<article class="content">
<div class="entry-content"><?php if (have_posts()) :
   while (have_posts()) :
      the_post();
      the_content();
   endwhile;
endif;
?>
</div>
</article>

<?php get_sidebar(); ?>
<?php get_footer(); ?>