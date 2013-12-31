<?php

/*-----------------------------------------------------------------------------------*/
/* Options Framework Functions
/*-----------------------------------------------------------------------------------*/

define('ADMIN_PATH', TEMPLATEPATH . '/admin/');
define('ADMIN', get_template_directory_uri() . '/admin/');
define('FUNCTIONS_PATH', TEMPLATEPATH . '/functions/');
define('INCLUDES_PATH', TEMPLATEPATH . '/includes/');
define('IMAGES', get_template_directory_uri() . '/style/images');
define('RWMB_URL', trailingslashit( get_template_directory_uri().'/includes/meta-box' ) );
define('RWMB_DIR', trailingslashit( get_template_directory().'/includes/meta-box' ) );

require_once (FUNCTIONS_PATH . 'obscura-functions.php');
require_once (FUNCTIONS_PATH . 'obscura-options.php');
require_once (FUNCTIONS_PATH . 'obscura-custom.php');
require_once (FUNCTIONS_PATH . 'shortcodes.php');
require_once (FUNCTIONS_PATH . 'widget.php');
require_once (ADMIN_PATH . 'shortcodes-editor.php');
include_once (INCLUDES_PATH . 'sidebar_generator/sidebar_generator.php');
include_once (INCLUDES_PATH . 'like-this/likethis.php');
require_once (RWMB_DIR . 'meta-box.php');
require_once (INCLUDES_PATH  . 'meta-box/config.php');

if (!function_exists( 'optionsframework_init')) 
{

	/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */
	
	if ( STYLESHEETPATH == TEMPLATEPATH ) {
		define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	} else {
		define('OPTIONS_FRAMEWORK_URL', get_template_directory() . '/admin/');
		define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/');
	}
	
	require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}
add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>
<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>
<?php
}

load_theme_textdomain( 'elemis', TEMPLATEPATH . '/lang' );

function load_scripts() {

wp_register_script('menu', get_template_directory_uri().'/style/js/ddsmoothmenu.js', 'jquery', '1.01');
wp_register_script('masonry', get_template_directory_uri().'/style/js/jquery.masonry.min.js', 'jquery', '2.1.05');
wp_register_script('easing', get_stylesheet_directory_uri().'/style/js/jquery.easing.1.3.min.js', 'jquery', '1.3');
wp_register_script('fitvids', get_template_directory_uri().'/style/js/jquery.fitvids.js', 'jquery', '1.0');
wp_register_script('forms', get_stylesheet_directory_uri().'/style/js/jquery.slickforms.js', 'jquery', '1.0');
wp_register_script('flex', get_template_directory_uri().'/style/js/jquery.flexslider-min.js', 'jquery', '2.0');
wp_register_script('backstretch', get_template_directory_uri().'/style/js/jquery.backstretch.min.js', 'jquery', '1.2.8');
wp_register_script('mediaelement', get_template_directory_uri().'/style/js/mediaelement.min.js', 'jquery', '1.0');
wp_register_script('mediaelementplayer', get_template_directory_uri().'/style/js/mediaelementplayer.min.js', 'jquery', '2.9.1');
wp_register_script('tools', get_template_directory_uri().'/style/js/jquery.tools.min.js', 'jquery', '1.2.5');
wp_register_script('selectnav', get_template_directory_uri().'/style/js/selectnav.js', 'jquery', '0.1');
wp_register_script('zeta', get_template_directory_uri().'/style/js/zeta_slider.js', 'jquery', '1.0');
wp_register_script('supersized', get_template_directory_uri().'/style/js/supersized.3.2.7.min.js', 'jquery', '3.2.7');
wp_register_script('shutter', get_template_directory_uri().'/style/js/supersized.shutter.min.js', 'jquery', '3.2.7');
wp_register_script('retina', get_template_directory_uri().'/style/js/retina.js', 'jquery', '0.0.2');
wp_register_script('scripts', get_template_directory_uri().'/style/js/scripts.js', 'jquery', '1.0');
wp_register_style('media-queries', get_template_directory_uri().'/style/css/media-queries.css');
wp_register_style('player', get_template_directory_uri().'/style/js/player/mediaelementplayer.css');
wp_register_style('fullscreen', get_template_directory_uri().'/style/css/fullscreen.css');

wp_enqueue_script('menu');
wp_enqueue_script('easing');
wp_enqueue_script('retina');
wp_enqueue_script('selectnav');
wp_enqueue_style('media-queries');

if(!is_singular('fullscreen')):
	wp_enqueue_script('masonry');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('forms');
	wp_enqueue_script('flex');
	wp_enqueue_script('backstretch');
	wp_enqueue_script('mediaelement');
	wp_enqueue_script('mediaelementplayer');
	wp_enqueue_script('tools');
	wp_enqueue_script('zeta');
	wp_enqueue_script('scripts');
	wp_enqueue_style('player');
endif;

if(is_singular('fullscreen')):
	wp_enqueue_script('supersized');
	wp_enqueue_script('shutter');
	wp_enqueue_style('fullscreen');
endif;

wp_enqueue_style('ie7', get_template_directory_uri().'/style/css/ie7.css');
wp_enqueue_style('ie8', get_template_directory_uri().'/style/css/ie8.css');
wp_enqueue_style('ie9', get_template_directory_uri().'/style/css/ie9.css');
global $wp_styles;
$wp_styles->add_data( 'ie7', 'conditional', 'IE 7' );
$wp_styles->add_data( 'ie8', 'conditional', 'IE 8' );
$wp_styles->add_data( 'ie9', 'conditional', 'IE 9' );

}
add_action('wp_enqueue_scripts', 'load_scripts');
?>