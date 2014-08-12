<?php
/*
Template Name: About & Contact */
?>
<?php get_header(); ?>
<div class="about-hero">
</div>
<article class="content">
<div class="entry-content about"><?php if (have_posts()) :
   while (have_posts()) :
      the_post();
      the_content();
   endwhile;
endif;
?>
</div>
<div class="contact">
<p itemprop="telephone">Phone: +44(0)7909 974 064</p>
<p>Email: <a href="mailto;info@lighthouseandgiant.co.uk">info@lighthouseandgiant.co.uk</a>
</p>
</div>
<?php get_template_part('contact'); ?>
</article>
<?php get_sidebar(); ?>
<?php get_footer(); ?>