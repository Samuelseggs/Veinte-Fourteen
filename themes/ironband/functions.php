<?php

/*-----------------------------------------------------------------------------------*/
/* Set Proper Parent/Child theme paths for inclusion
/*-----------------------------------------------------------------------------------*/

@define( 'IRON_TEXT_DOMAIN', 'ironband' );

@define( 'IRON_PARENT_DIR', get_template_directory() );
@define( 'IRON_CHILD_DIR',  get_stylesheet_directory() );

@define( 'IRON_PARENT_URL', get_template_directory_uri() );
@define( 'IRON_CHILD_URL',  get_stylesheet_directory_uri() );


/**
 * Sets up the content width value based on the theme's design.
 * @see iron_content_width() for template-specific adjustments.
 */
if ( ! isset( $content_width ) )
	$content_width = 696;


// Load theme textdomain
load_theme_textdomain( IRON_TEXT_DOMAIN, IRON_PARENT_DIR . '/languages' );

// Load Updates
include_once(IRON_PARENT_DIR.'/admin/updates.php');

// Load Admin Panel
require_once(IRON_PARENT_DIR.'/admin/options.php');

// Load dynamic styles class
require_once(IRON_PARENT_DIR.'/includes/classes/styles.class.php');


// Load Plugin installation and activation
require_once(IRON_PARENT_DIR.'/includes/classes/tgmpa.class.php');
require_once(IRON_PARENT_DIR.'/includes/plugins.php');


// Load ACF
$acflite = get_iron_option('acf_lite');

if ( is_null($acflite) )
	$acflite = true;

define( 'ACF_LITE', (bool) $acflite );

if ( ! class_exists('Acf') )
	require_once('includes/advanced-custom-fields/acf.php');

// Load functions
require_once(IRON_PARENT_DIR.'/includes/upgrade.php');

// Load functions
require_once(IRON_PARENT_DIR.'/includes/functions.php');

// Load homepage blocks
require_once(IRON_PARENT_DIR.'/includes/homepage-blocks.php');

// Load Custom Post types
require_once(IRON_PARENT_DIR.'/includes/post-types.php');

// Load Taxonomies
require_once(IRON_PARENT_DIR.'/includes/taxonomies.php');

// Load Custom Fields
require_once(IRON_PARENT_DIR.'/includes/custom-fields.php');

// Setup Theme
require_once('includes/setup.php');

// Init Customizer (Preview Only)
if($_SERVER['HTTP_HOST'] == 'irontemplates.com' || $_SERVER['HTTP_HOST'] == 'ironband.dev') {
	require_once('customizer/init.php');
}
