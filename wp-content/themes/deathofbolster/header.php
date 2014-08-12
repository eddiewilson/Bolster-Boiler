<?php
/**
* @package WordPress
* @subpackage deathofbolster
**/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />  
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if gte IE 9 ]><html class="no-js ie9" lang="en"> <![endif]-->
<title><?php wp_title('|',true,'right'); ?><?php bloginfo('name'); ?></title>
<meta name="description" content="A web design, graphic design, illustration and development team based in Falmouth, Cornwall, with over ten years experience in creative and retail industries." />	
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!-- Mobile Specific Metas
  ================================================== -->
	<meta name="viewport" content="width=1200">
	
	<!-- CSS
  ================================================== -->
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/style.css"/>
  <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
<?php wp_head(); ?>        
</head>
<body <?php body_class(); ?>>
<div id="ajax-loading">
  <div id="animation"></div>
</div>
<div id="site">
	<div id="wrapper" class="hfeed"><!-- Should close in footer -->
		<header>
			<div id="branding">
				<a href="<?php echo home_url(); ?>"><img src="<?php echo get_template_directory_uri(); ?>/assets/bolster.png" width="80"  height="80" alt="lighthouse and giant logo web design falmouth cornwall"/></a>
				<div id="site-title"><?php if ( is_singular() ) {} else {echo '<h1>';} ?><a href="<?php echo home_url() ?>/" title="<?php bloginfo( 'name' ) ?>" rel="home"><?php bloginfo( 'name' ) ?></a><?php if ( is_singular() ) {} else {echo '</h1>';} ?></div>
			</div>
<nav>
	<ul id="menu-header-nav" class="menu">
		<li id="menu-item-22" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-22">
		<a style="color:<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_home_nav_color', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?>; border-bottom-color:<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_home_nav_color', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?> " href="<?php echo home_url(); ?>/work/">Work</a>
		</li>
		<li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a style="color:<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_home_nav_color', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?>; border-bottom-color:<?php $key_1_value = get_post_meta(get_the_ID(), '_cmb_home_nav_color', true);
// check if the custom field has a value
if($key_1_value != '') {
  echo $key_1_value;
};
?>" href="<?php echo home_url(); ?>/about/">About &amp; Contact</a></li>
	</ul>
</nav>
	<div style="clear:both"></div>
		</header>