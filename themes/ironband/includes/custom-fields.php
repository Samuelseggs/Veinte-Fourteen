<?php
/***
 *  Install Add-ons
 *
 *  The following code will include all 4 premium Add-Ons in your theme.
 *  Please do not attempt to include a file which does not exist. This will produce an error.
 *
 *  All fields must be included during the 'acf/register_fields' action.
 *  Other types of Add-ons (like the options page) can be included outside of this action.
 *
 *  The following code assumes you have a folder 'add-ons' inside your theme.
 *
 *  IMPORTANT
 *  Add-ons may be included in a premium theme as outlined in the terms and conditions.
 *  However, they are NOT to be included in a premium / free plugin.
 *  For more information, please read http://www.advancedcustomfields.com/terms-conditions/
 */

// Fields

function iron_register_acf_fields()
{
	if ( ! class_exists('acf_field_repeater') )
		include_once('advanced-custom-fields/addons/acf-repeater/repeater.php');

	iron_check_acf_lite_switch();

}
add_action('acf/register_fields', 'iron_register_acf_fields');


/**
* If ACF_LITE is on, update all acf group fields in DB to draft
*/


function iron_check_acf_lite_switch()
{

	if(isset($_GET["settings-updated"])) {

		global $wpdb;

		if(ACF_LITE)
			$status = "draft";
		else
			$status = "publish";

		$wpdb->query("UPDATE $wpdb->posts SET post_status = '".$status."' WHERE post_type = 'acf'");
	}

}



/**
 *  Register Field Groups
 *
 *  The register_field_group function accepts 1 array which holds the relevant data to register a field group
 *  You may edit the array as you see fit. However, this may result in errors if the array is not compatible with ACF
 */

if(function_exists("register_field_group") && ACF_LITE)
{
	register_field_group(array (
		'id' => 'acf_page-background',
		'title' => 'Page Background',
		'fields' => array (
			array (
				'key' => 'field_523382c955a74',
				'label' => 'Background',
				'name' => 'background',
				'type' => 'image',
				'save_format' => 'id',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array (
				'key' => 'field_523382f555a75',
				'label' => 'Background Position',
				'name' => 'background_position',
				'type' => 'select',
				'choices' => array (
					'repeat' => 'Repeat',
					'no-repeat' => 'No Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233837455a76',
				'label' => 'Background Size',
				'name' => 'background_size',
				'type' => 'select',
				'choices' => array (
					'cover' => 'Cover',
					'contain' => 'Contain',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_523383fb55a77',
				'label' => 'Background Attachment',
				'name' => 'background_attachment',
				'type' => 'select',
				'choices' => array (
					'scroll' => 'Scroll',
					'fixed' => 'Fixed',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5233842d55a78',
				'label' => 'Background Position',
				'name' => 'background_position',
				'type' => 'select',
				'choices' => array (
					'left top' => 'left top',
					'left center' => 'left center',
					'left bottom' => 'left bottom',
					'right top' => 'right top',
					'right center' => 'right center',
					'right bottom' => 'right bottom',
					'center top' => 'center top',
					'center center' => 'center center',
					'center bottom' => 'center bottom',
					'inherit' => 'Inherit',
				),
				'default_value' => '',
				'allow_null' => 1,
				'multiple' => 0,
			),
			array (
				'key' => 'field_523384ce55a79',
				'label' => 'Background Color',
				'name' => 'background_color',
				'type' => 'color_picker',
				'default_value' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));

	register_field_group(array (
		'id' => 'acf_music-playlist',
		'title' => 'Music Playlist',
		'fields' => array (
			array (
				'key' => 'field_51c4d65df6468',
				'label' => 'Playlist Name',
				'name' => 'playlist_name',
				'type' => 'text',
				'default_value' => __('Popular Songs', IRON_TEXT_DOMAIN),
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
			array (
				'key' => 'field_51c4d5b5f6465',
				'label' => 'Playlist Tracks',
				'name' => 'playlist_tracks',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51c4d613f6466',
						'label' => 'Track Title',
						'name' => 'track_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_51c4d622f6467',
						'label' => 'Album Title',
						'name' => 'album_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
						'formatting' => 'html',
						'maxlength' => '',
					),
					array (
						'key' => 'field_51c4d6b5f6469',
						'label' => 'Album Poster',
						'name' => 'album_poster',
						'type' => 'image',
						'instructions' => 'Upload Album Poster',
						'column_width' => '',
						'save_format' => 'url',
						'preview_size' => 'medium',
						'library' => 'all',
					),
					array (
						'key' => 'field_51c4d6c3f646a',
						'label' => 'MP3',
						'name' => 'track_mp3',
						'type' => 'file',
						'instructions' => 'Upload MP3 File',
						'column_width' => '',
						'save_format' => 'url',
						'library' => 'all',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => 'Add Track',
			),
		),
		'location' => array (
			'rules' => array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-home.php',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_type',
					'operator' => '==',
					'value' => 'front_page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
			'allorany' => 'any',
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_slide-informations',
		'title' => 'Slide Informations',
		'fields' => array (
			array (
				'key' => 'field_5220bd6a85dfc',
				'label' => 'Link Type',
				'name' => 'slide_link_type',
				'type' => 'radio',
				'choices' => array (
					'internal' => 'Internal Page',
					'external' => 'External Link',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'internal',
				'layout' => 'horizontal',
			),
			array (
				'key' => 'field_51b9e1a1fde59',
				'label' => 'Slide Link',
				'name' => 'slide_link',
				'type' => 'page_link',
				'instructions' => 'Add link to redirect the user on click.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5220bd6a85dfc',
							'operator' => '==',
							'value' => 'internal',
						),
					),
					'allorany' => 'all',
				),
				'post_type' => array (
					0 => 'all',
				),
				'allow_null' => 0,
				'multiple' => 0,
			),
			array (
				'key' => 'field_5220bdac85dfd',
				'label' => 'Slide Link',
				'name' => 'slide_link_external',
				'type' => 'text',
				'instructions' => 'Add link to redirect the user on click.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_5220bd6a85dfc',
							'operator' => '==',
							'value' => 'external',
						),
					),
					'allorany' => 'all',
				),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_52386855ea1e9',
				'label' => 'Slide Call-To-Action',
				'name' => 'slide_more_text',
				'instructions' => __('You can control the default label and icon for slides on the <a href="http://ironband.dev/wp-admin/admin.php?page=ironband_options&tab=6">IronBand Homepage Block Settings</a> page.', IRON_TEXT_DOMAIN),
				'type' => 'text',
				'default_value' => '',
				'placeholder' => ( get_iron_option('slide_more_label') ? get_iron_option('slide_more_label') : __('Read More', IRON_TEXT_DOMAIN)),
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'slide',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'categories',
				6 => 'tags',
				7 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_video-embedder',
		'title' => 'Video Embedder',
		'fields' => array (
			array (
				'key' => 'field_51b8d3ffdfe45',
				'label' => 'Video',
				'name' => 'vid_video',
				'type' => 'textarea',
				'instructions' => 'Add the Embed Code from YouTube',
				'default_value' => '<iframe width="640" height="360" src="http://www.youtube.com/embed/aHjpOzsQ9YI?feature=player_detailpage&wmode=opaque" frameborder="0" allowfullscreen></iframe>',
				'placeholder' => '',
				'maxlength' => '',
				'formatting' => 'html',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'video',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'revisions',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_contact-form',
		'title' => 'Contact Form',
		'fields' => array (
			array (
				'key' => 'field_51b8cfb60a2f2',
				'label' => 'Contact Form',
				'name' => 'contact_form',
				'type' => 'text',
				'instructions' => 'Add Form Shortcode',
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'html',
				'maxlength' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'page-contact.php',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_album-infos',
		'title' => 'Album Infos',
		'fields' => array (
			array (
				'key' => 'field_51b8db2cd11c4',
				'label' => 'Release Date',
				'name' => 'alb_release_date',
				'type' => 'date_picker',
				'date_format' => 'yy-mm-dd',
				'display_format' => 'yy-mm-dd',
				'first_day' => 1,
			),
			array (
				'key' => 'field_523b66d6f2382',
				'label' => 'External Link',
				'name' => 'alb_link_external',
				'type' => 'text',
				'instructions' => __('Users will be redirected to the link’s destination instead of the album’s details page.', IRON_TEXT_DOMAIN),
				'default_value' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
				'formatting' => 'none',
				'maxlength' => '',
			),
			array (
				'key' => 'field_51b8c4facc846',
				'label' => 'Tracklist',
				'name' => 'alb_tracklist',
				'type' => 'repeater',
				'sub_fields' => array (
					array (
						'key' => 'field_51b8c51ecc847',
						'label' => 'Title',
						'name' => 'track_title',
						'type' => 'text',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c5e3cc848',
						'label' => 'Where to buy',
						'name' => 'track_store',
						'type' => 'text',
						'instructions' => 'Add link to the online store to buy this track',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c637cc849',
						'label' => 'MP3',
						'name' => 'track_mp3',
						'type' => 'file',
						'instructions' => 'Upload the mp3 file',
						'column_width' => '',
						'save_format' => 'url',
						'library' => 'all',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Track',
			),
			array (
				'key' => 'field_51b8c6d6cc84a',
				'label' => 'Store list',
				'name' => 'alb_store_list',
				'type' => 'repeater',
				'instructions' => 'Links the the online stores to buy album',
				'sub_fields' => array (
					array (
						'key' => 'field_51b8c6fdcc84b',
						'label' => 'Store Name',
						'name' => 'store_name',
						'type' => 'text',
						'instructions' => 'Examples : iTunes, Bandcamp, Soundcloud, etc.',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
					array (
						'key' => 'field_51b8c718cc84c',
						'label' => 'Store Link',
						'name' => 'store_link',
						'type' => 'text',
						'instructions' => 'Link to the online store',
						'column_width' => '',
						'default_value' => '',
						'formatting' => 'html',
						'maxlength' => '',
						'placeholder' => '',
						'prepend' => '',
						'append' => '',
					),
				),
				'row_min' => 0,
				'row_limit' => '',
				'layout' => 'table',
				'button_label' => '+ Add Store',
			),
			array (
				'key' => 'field_51b8c792cc84d',
				'label' => 'Review',
				'name' => 'alb_review',
				'type' => 'textarea',
				'default_value' => '',
				'formatting' => 'br',
				'maxlength' => '',
				'placeholder' => '',
			),
			array (
				'key' => 'field_51b8c88fcc84e',
				'label' => 'Review Author',
				'name' => 'alb_review_author',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'album',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'custom_fields',
				2 => 'discussion',
				3 => 'comments',
				4 => 'categories',
				5 => 'tags',
				6 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_photo',
		'title' => 'Photo',
		'fields' => array (
			array (
				'key' => 'field_520bf0ed9c929',
				'label' => 'Image',
				'name' => 'img_image',
				'type' => 'image',
				'required' => 1,
				'save_format' => 'object',
				'preview_size' => 'thumbnail',
				'library' => 'all',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'photo',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'the_content',
				1 => 'excerpt',
				2 => 'custom_fields',
				3 => 'discussion',
				4 => 'comments',
				5 => 'revisions',
				6 => 'featured_image',
			),
		),
		'menu_order' => 0,
	));

	$default_gig_show_time = get_iron_option('default_gig_show_time');

	if ( is_null($default_gig_show_time) )
		$default_gig_show_time = true;

	register_field_group(array (
		'id' => 'acf_gig-infos',
		'title' => 'Gig Infos',
		'fields' => array (
			array (
				'key' => 'field_523b46ebe35ef',
				'label' => '',
				'name' => 'gig_show_time',
				'type' => 'true_false',
				'message' => 'Show the time',
				'default_value' => (bool) $default_gig_show_time,
			),
			array (
				'key' => 'field_51b8bf97193f8',
				'label' => 'City',
				'name' => 'gig_city',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfa8193f9',
				'label' => 'Venue',
				'name' => 'gig_venue',
				'type' => 'text',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bfbf193fa',
				'label' => 'Map',
				'name' => 'gig_map',
				'type' => 'text',
				'instructions' => 'Add the link to Google Maps pointing to the Venue',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
			array (
				'key' => 'field_51b8bff2193fb',
				'label' => 'Tickets',
				'name' => 'gig_tickets',
				'type' => 'text',
				'instructions' => 'Add the link to the online box-office of the Venue',
				'default_value' => '',
				'formatting' => 'html',
				'maxlength' => '',
				'placeholder' => '',
				'prepend' => '',
				'append' => '',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'gig',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
				0 => 'excerpt',
				1 => 'discussion',
				2 => 'comments',
				3 => 'format',
				4 => 'featured_image',
				5 => 'categories',
				6 => 'tags',
				7 => 'send-trackbacks',
			),
		),
		'menu_order' => 0,
	));
}
