</div>
<footer>
<div class="page-wrapper">
<div class="col-1"><a href=""><img src="<?php echo get_template_directory_uri(); ?>/assets/bolster.png" width="80" height="80" alt="Lighthouse & Giant web design falmouth cornwall"/></a></div>
<div class="col-1"><h4>Work</h4><div class="filter"><ul><li><a href="<?php echo home_url(); ?>/work/">All Work</a></li>
<?php $args = array(
	'order'              => 'ASC',
	'title_li'           => __( '' )
); ?>
<?php wp_list_categories( $args ); ?> 
</ul>
</div>
</div> 
<div class="col-2 last"><h4>About Lighthouse &amp; Giant</h4><ul><li><p>We are a two man design and development team based in Falmouth, Cornwall, with over ten years experience in creative and retail industries. <a href="<?php echo home_url(); ?>/about/">Read More</a></p></li><li><address><span>+44(0)7909 974064</span> | <a href="mailto:info@lighthouseandgiant.co.uk?&subject=Website Enquiry">info@lighthouseandgiant.co.uk</a></address></li><li><p>Visit our <a href="http://journal.lighthouseandgiant.co.uk">Journal</a></p></li></ul></div> 
<div style="clear:both"></div>
</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>