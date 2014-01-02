<?php

/*
 * Register recommended plugins for this theme.
 */

function iron_register_required_plugins ()
{
	$plugins = array(
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true
		),
		array(
			'name'     => 'Simple Page Ordering',
			'slug'     => 'simple-page-ordering',
			'required' => false
		),
		array(
			'name'     => 'Duplicate Post',
			'slug'     => 'duplicate-post',
			'required' => false
		),
		array(
			'name'		=>	'Google Analytics for WordPress',
			'slug'		=>	'google-analytics-for-wordpress',
			'required'	=>	false
		)
	);

	$config = array(
		'domain'       => IRON_TEXT_DOMAIN,
		'has_notices'  => true, // Show admin notices or not
		'is_automatic' => true // Automatically activate plugins after installation or not
	);

	tgmpa($plugins, $config);

}

add_action('tgmpa_register', 'iron_register_required_plugins');