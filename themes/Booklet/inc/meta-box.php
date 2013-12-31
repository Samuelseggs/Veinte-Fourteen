<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'silver_';

global $meta_boxes;

$meta_boxes = array();

// 1st meta box
$meta_boxes[] = array(
	'id' => 'standard',
	'title' => __( 'Post type', 'rwmb' ),
	'pages' => array( 'post' ),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// RADIO BUTTONS
		array(
			'name'    => __( 'Select post type', 'rwmb' ),
			'id'      => "{$prefix}radio",
			'type'    => 'radio',
			'desc' => __( 'It defaults to boxed', 'rwmb' ),
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'featured' => __( 'Featured', 'rwmb' ),
				'wide' => __( 'Wide', 'rwmb' ),
				'boxed' => __( 'Boxed', 'rwmb' ),
			),
		),
		array(
			'name'    => __( 'Select sidebar position', 'rwmb' ),
			'id'      => "{$prefix}sidebar_rl",
			'type'    => 'radio',
			'desc' => __( 'It defaults to left', 'rwmb' ),
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'left' => __( 'Left', 'rwmb' ),
				'right' => __( 'Right', 'rwmb' ),
			),
		),
		array(
			'name'    => __( 'Show/hide single page sidebar widgets', 'rwmb' ),
			'id'      => "{$prefix}sidebar_radio",
			'desc' => __( 'It defaults to visible/display', 'rwmb' ),
			'type'    => 'radio',
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'display' => __( 'Display', 'rwmb' ),
				'hide' => __( 'Hide', 'rwmb' )
			),
		),
		array(
			'name'    => __( 'Image opacity', 'rwmb' ),
			'id'      => "{$prefix}transparency_radio",
			'desc' => __( 'It defaults to 0.5 image opacity (half opaque)', 'rwmb' ),
			'type'    => 'radio',
			// Array of 'value' => 'Label' pairs for radio options.
			// Note: the 'value' is stored in meta field, not the 'Label'
			'options' => array(
				'transparent' => __( 'Transparent', 'rwmb' ),
				'opaque' => __( 'Opaque', 'rwmb' )
			),
		),
		array(
			'name'             => __( 'Featured Post Homepage Slider', 'rwmb' ),
			'id'               => "{$prefix}featured_slider",
			'type'             => 'image_advanced'
		)
	)
);

/*$meta_boxes[] = array(
	'id' => 'page-meta',
	'title' => __( 'Gallery options', 'rwmb' ),
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// IMAGE ADVANCED (WP 3.5+)
		array(
			'name'             => __( 'Image Advanced Upload', 'rwmb' ),
			'id'               => "{$prefix}gallery",
			'type'             => 'image_advanced'
		)
	)
);*/

$meta_boxes[] = array(
	'id' => 'gallery-meta',
	'title' => __( 'Gallery options', 'rwmb' ),
	'pages' => array( 'spsa_gallery' ),
	'context' => 'normal',
	'priority' => 'high',
	'autosave' => true,
	'fields' => array(
		// IMAGE ADVANCED (WP 3.5+)
		array(
			'name'             => __( 'Image Advanced Upload', 'rwmb' ),
			'id'               => "{$prefix}gallery_post",
			'type'             => 'image_advanced'
		)
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function YOUR_PREFIX_register_meta_boxes()
{
	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( !class_exists( 'RW_Meta_Box' ) )
		return;

	global $meta_boxes;
	foreach ( $meta_boxes as $meta_box )
	{
		new RW_Meta_Box( $meta_box );
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );
