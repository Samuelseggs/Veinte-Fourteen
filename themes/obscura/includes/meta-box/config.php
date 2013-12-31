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
$prefix = 'rw_';

global $meta_boxes;

$meta_boxes = array();

$meta_boxes[] = array(
	'id' => 'intro',
	'title' => 'Intro',
	'pages' => array('post', 'page'),

	'fields' => array(
		array(
			'name' => 'Intro Text',
			'id' => $prefix . 'intro',
			'type' => 'textarea',
			'desc' => 'Leave blank to show default intro text entered in the Theme Options panel'
		),
		array(
			'name' => 'Disable Intro Text',
			'id'   => $prefix . 'hide_intro',
			'type' => 'checkbox',
			'desc' => 'Check to disable intro text',
			// Value can be 0 or 1
			'std' => 0,
		),
		array(
			'name' => 'Disable Social Icons',
			'id'   => $prefix . 'hide_social',
			'type' => 'checkbox',
			'desc' => 'Check to disable social icons',
			// Value can be 0 or 1
			'std' => 0,
		)
	)
);

$meta_boxes[] = array(
	'id' => 'image',
	'title' => 'Image',
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => 'Image',
			'id' => $prefix . 'image',
			'type'	=> 'image',
			'max_file_uploads' => 1,
			'desc' => 'Upload image (Min. 490px width of recommended for blog grid display.)'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'video',
	'title' => 'Video',
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => 'Video Embed Code',
			'id' => $prefix . 'video',
			'type' => 'textarea',
			'desc' => 'Enter video embed code'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'gallery-format',
	'title' => 'Gallery',
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => 'Gallery Style',
			'id' => $prefix . 'gallery_style',
			'type' => 'select',
			'options' => array(
				'flex'		=> 'Flex Slider',
				'zeta'		=> 'Zeta Slider',
			),
			'multiple' => false,
			'std'  => array( 'flex' ),
			'desc' => 'Select a style for the gallery',
		),
		array(
			'name' => 'Gallery Images',
			'desc' => 'Upload gallery images (Min. 490px of width recommended for blog grid display.)',
			'id' => $prefix . 'gallery_images',
			'type' => 'plupload_image'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'audio',
	'title' => 'Audio',
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => 'Audio .mp3 URL',
			'id' => $prefix . 'audio_mp3',
			'type' => 'text',
			'desc' => 'Enter URL of .mp3 file'
		),
		array(
			'name' => 'Album Artwork',
			'desc' => 'Upload artwork of the album',
			'id' => $prefix . 'audio_artwork',
			'max_file_uploads' => 1,
			'type' => 'image'
		),
		array(
			'name' => 'Song Name',
			'id' => $prefix . 'audio_song',
			'type' => 'text',
			'desc' => 'Enter the name of the song'
		),
		array(
			'name' => 'Artist Name',
			'id' => $prefix . 'audio_artist',
			'type' => 'text',
			'desc' => 'Enter the name of the artist'
		),
		array(
			'name' => 'Album Name',
			'id' => $prefix . 'audio_album',
			'type' => 'text',
			'desc' => 'Enter the name of the album'
		),
		
	)
);

$meta_boxes[] = array(
	'id' => 'link',
	'title' => 'Link URL',
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => 'Add a Link',
			'id' => $prefix . 'link',
			'type' => 'text',
			'desc' => 'Enter URL'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'quote',
	'title' => 'Quote',
	'pages' => array('post'),

	'fields' => array(
		array(
			'name' => 'Quote',
			'id' => $prefix . 'quote',
			'type' => 'text',
			'desc' => 'Enter a quote'
		),
		
		array(
			'name' => 'Quote Author',
			'id' => $prefix . 'quote_author',
			'type' => 'text',
			'desc' => 'Enter quote author'
		)
	)
);

$meta_boxes[] = array(
	'id' => 'bbp',

	'title' => 'Background',

	'pages' => array( 'post', 'page'),

	'context' => 'normal',

	'priority' => 'high',

	'fields' => array(
		array(
			'name'	=> 'Background Image',
			'desc'	=> 'Upload the image you would like to use as the background for this page/post.',
			'id'	=> "{$prefix}background",
			'type'	=> 'image',
			'max_file_uploads' => 1
		)
	)
);

$meta_boxes[] = array(
	'id' => 'fullscreen',
	'title' => 'Fullscreen Gallery',
	'pages' => array('fullscreen'),

	'fields' => array(
	
		array(
			'name' => 'Images',
			'id' => $prefix . 'fc_images',
			'type' => 'plupload_image'
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
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) )
	{
		foreach ( $meta_boxes as $meta_box )
		{
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'YOUR_PREFIX_register_meta_boxes' );