<?php
// Add theme styles to TinyMCE editor
function tjink_add_editor_styles() {
    add_editor_style( 'style.css' );
}
add_action( 'after_setup_theme', 'tjink_add_editor_styles' );

// Add theme styles to TinyMCE editor
add_filter("mce_buttons", "tinymce_editor_buttons", 99); //targets the first line
add_filter("mce_buttons_2", "tinymce_editor_buttons_second_row", 99); //targets the second line

function tinymce_editor_buttons($buttons) {
return array(
	"bold",
	"italic",
	"strikethrough",
	"bullist",
	"numlist",
	"blockquote",
	"alignleft",
	"aligncenter",
	"alignright",
	"link",
	"unlink",
	"spellchecker",
	"wp_fullscreen",
	"separator",
	"runin_button",
	"cta_button",
	"h1_button",
	"h2_button",
	"h3_button",
    );
}

function tinymce_editor_buttons_second_row($buttons) {
   //return an empty array to remove this line
    return array(

	    
    );
}

