<?php
// Admin Login Branding 
function custom_login_logo() {
  echo '<style type="text/css">
    		h1 a {
    			background-image:url('.get_bloginfo('template_directory').'/assets/img/tjink-logo-white.svg) !important;
				width:80px;
				height:80px;
			}
			body.login{
				background: #766E65 !important;
			}
			.login #backtoblog a, .login #nav a{
				color: #ffffff !important;
			}
    </style>';
}
add_action('login_head', 'custom_login_logo');