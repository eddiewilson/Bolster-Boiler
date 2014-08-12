<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
if(is_archive() || is_search()){
get_template_part('entry','summary');
} else {
get_template_part('entry','content');
}
?>
<div style="clear:both"></div>
<?php 
if ( is_single() ) {
get_template_part( 'entry-footer', 'single' ); 
} else {
get_template_part( 'entry-footer' ); 
}
?>
</div> 