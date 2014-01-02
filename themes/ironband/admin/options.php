<?php
/*
 *
 * Set the text domain for the theme or plugin.
 *
 */

define('Redux_TEXT_DOMAIN', IRON_TEXT_DOMAIN);

if ( ! defined('Redux_ASSETS_URL') ) {
	define('Redux_ASSETS_URL', get_stylesheet_directory_uri() . '/admin/assets/');
}

if ( ! defined('Redux_OPTIONS_URL') ) {
	define('Redux_OPTIONS_URL', get_stylesheet_directory_uri() . '/admin/options/');
}



/*
 *
 * Require the framework class before doing anything else, so we can use the defined URLs and directories.
 * If you are running on Windows you may have URL problems which can be fixed by defining the framework url first.
 *
 */

if ( ! class_exists('Redux_Options') ) {
	require_once(dirname(__FILE__) . '/options/defaults.php');
}


/*
 * Load custom reduc assets
 *
 */

function redux_custom_assets() {

	wp_enqueue_script('redux-custom', Redux_ASSETS_URL.'/js/redux.custom.js', array('jquery'), null, true);
}
add_action( 'admin_enqueue_scripts', 'redux_custom_assets' );



/*
 *
 * Most of your editing will be done in this section.
 *
 * Here you can override default values, uncomment args and change their values.
 * No $args are required, but they can be over ridden if needed.
 *
 */

function setup_framework_options() {
	$args = array();


	// Setting dev mode to true allows you to view the class settings/info in the panel.
	// Default: true
	$args['dev_mode'] = false;

	// Set the icon for the dev mode tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: info-sign
	//$args['dev_mode_icon'] = 'info-sign';


	// The defaults are set so it will preserve the old behavior.
	$args['std_show'] = true; // If true, it shows the std value


	// Set the class for the dev mode tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['dev_mode_icon_class'] = 'icon-large';

	// If you want to use Google Webfonts, you MUST define the api key.
	$args['google_api_key'] = 'AIzaSyCQdHHTp_ttcRUygzBKIpwa6b8iiCJyjqo';

	// Define the starting tab for the option panel.
	// Default: '0';
	//$args['last_tab'] = '0';

	// Define the option panel stylesheet. Options are 'standard', 'custom', and 'none'
	// If only minor tweaks are needed, set to 'custom' and override the necessary styles through the included custom.css stylesheet.
	// If replacing the stylesheet, set to 'none' and don't forget to enqueue another stylesheet!
	// Default: 'standard'
	$args['admin_stylesheet'] = 'custom';

	// Add HTML before the form.
	//$args['intro_text'] = __('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', IRON_TEXT_DOMAIN);

	// Add content after the form.
	$args['footer_text'] = __('<p>Brought to you by <a target="_blank" href="http://irontemplates.com">IronTemplates</a></p>', IRON_TEXT_DOMAIN);

	// Set footer/credit line.
	//$args['footer_credit'] = __('<p>This text is displayed in the options panel footer across from the WordPress version (where it normally says \'Thank you for creating with WordPress\'). This field accepts all HTML.</p>', IRON_TEXT_DOMAIN);

	// Setup custom links in the footer for share icons
	$args['share_icons']['twitter'] = array(
		'link' => 'http://twitter.com/irontemplates',
		'title' => __('Follow us on Twitter', IRON_TEXT_DOMAIN),
		'img' => Redux_OPTIONS_URL . 'img/social/Twitter.png'
	);

	// Enable the import/export feature.
	// Default: true
	//$args['show_import_export'] = false;

	// Set the icon for the import/export tab.
	// If $args['icon_type'] = 'image', this should be the path to the icon.
	// If $args['icon_type'] = 'iconfont', this should be the icon name.
	// Default: refresh
	//$args['import_icon'] = 'refresh';

	// Set the class for the import/export tab icon.
	// This is ignored unless $args['icon_type'] = 'iconfont'
	// Default: null
	$args['import_icon_class'] = 'icon-large';

	// Set a custom option name. Don't forget to replace spaces with underscores!
	$args['opt_name'] = IRON_TEXT_DOMAIN;

	// Set a custom menu icon.
	//$args['menu_icon'] = '';

	// Set a custom title for the options page.
	// Default: Options
	$args['menu_title'] = __('IronBand', IRON_TEXT_DOMAIN);

	// Set a custom page title for the options page.
	// Default: Options
	$args['page_title'] = __('IronBand Options', IRON_TEXT_DOMAIN);

	// Set a custom page slug for options page (wp-admin/themes.php?page=***).
	// Default: redux_options
	$args['page_slug'] = 'ironband_options';

	// Set a custom page capability.
	// Default: manage_options
	$args['page_cap'] = 'manage_options';

	// Set the menu type. Set to "menu" for a top level menu, or "submenu" to add below an existing item.
	// Default: menu
	//$args['page_type'] = 'submenu';

	// Set the parent menu.
	// Default: themes.php
	// A list of available parent menus is available at http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
	//$args['page_parent'] = 'options-general.php';

	// Set a custom page location. This allows you to place your menu where you want in the menu order.
	// Must be unique or it will override other items!
	// Default: null
	//$args['page_position'] = null;

	// Set a custom page icon class (used to override the page icon next to heading)
	//$args['page_icon'] = 'icon-themes';

	// Set the icon type. Set to "iconfont" for Font Awesome, or "image" for traditional.
	// Redux no longer ships with standard icons!
	// Default: iconfont
	//$args['icon_type'] = 'image';
	//$args['dev_mode_icon_type'] = 'image';
	//$args['import_icon_type'] == 'image';

	// Disable the panel sections showing as submenu items.
	// Default: true
	//$args['allow_sub_menu'] = false;

	// Set ANY custom page help tabs, displayed using the new help tab API. Tabs are shown in order of definition.
/*
	$args['help_tabs'][] = array(
		'id' => 'redux-opts-1',
		'title' => __('Theme Information 1', IRON_TEXT_DOMAIN),
		'content' => __('<p>This is the tab content, HTML is allowed.</p>', IRON_TEXT_DOMAIN)
	);
	$args['help_tabs'][] = array(
		'id' => 'redux-opts-2',
		'title' => __('Theme Information 2', IRON_TEXT_DOMAIN),
		'content' => __('<p>This is the tab content, HTML is allowed.</p>', IRON_TEXT_DOMAIN)
	);

	// Set the help sidebar for the options page.
	$args['help_sidebar'] = __('<p>This is the sidebar content, HTML is allowed.</p>', IRON_TEXT_DOMAIN);
*/


	$sections = array();

	if(file_exists(IRON_PARENT_DIR . '/admin/inc/docs.php')) {

		ob_start();
		include IRON_PARENT_DIR . '/admin/inc/docs.php';
		$docs = ob_get_contents();
		ob_end_clean();

		$sections[] = array(
			// Redux uses the Font Awesome iconfont to supply its default icons.
			// If $args['icon_type'] = 'iconfont', this should be the icon name minus 'icon-'.
			// If $args['icon_type'] = 'image', this should be the path to the icon.
			// Icons can also be overridden on a section-by-section basis by defining 'icon_type' => 'image'
			'icon' => 'book',
			'icon_class' => 'icon-large',
			'title' => __('Getting Started', IRON_TEXT_DOMAIN),
			'desc' => '',
			'fields' => array(
				array(
					'id' => 'font_awesome_info',
					'type' => 'raw_html',
					'html' => $docs
				)
			)
		);
	}

	if(file_exists(IRON_PARENT_DIR . '/admin/inc/import.php')) {

		ob_start();
		include IRON_PARENT_DIR . '/admin/inc/import.php';
		$importData = ob_get_contents();
		ob_end_clean();

		$sections[] = array(
			'icon' => 'cloud-download',
			'icon_class' => 'icon-large',
			'title' => __('Import Default Data', IRON_TEXT_DOMAIN),
			'desc' => '<p class="description">' . __('Here you can clone our theme demo contents.', IRON_TEXT_DOMAIN) . '</p>',
			'fields' => array(
				array(
					'id' => 'import_default_data',
					'type' => 'raw_html',
					'title' => __('Import Default Data', IRON_TEXT_DOMAIN),
					'sub_desc' => '<p class="description">' . __('This will flush all your current data and clone our theme demo contents.', IRON_TEXT_DOMAIN) . '</p>',
					'html' => $importData
				)
			)
		);

	}

	$sections[] = array(
		'icon' => 'cogs',
		'icon_class' => 'icon-large',
		'title' => __('General Settings', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some general settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'enable_nice_scroll',
				'type' => 'checkbox',
				'title' => __('Enable NiceScroll', IRON_TEXT_DOMAIN),
				'sub_desc' => '<p class="description">' . __('This will style the default scrollbar and will add a nice scrolling effect', IRON_TEXT_DOMAIN) . '</p>',
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'enable_fixed_header',
				'type' => 'checkbox',
				'title' => __('Enable Fixed Header', IRON_TEXT_DOMAIN),
				'sub_desc' => '<p class="description">' . __('This will make the header fixed on page scroll', IRON_TEXT_DOMAIN) . '</p>',
				'switch' => true,
				'std' => '1'
			)
		)
	);

	$sections[] = array(
		'icon' => 'eye-open',
		'icon_class' => 'icon-large',
		'title' => __('Look and feel', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some look & feel options that you can edit. These options will override the selected preset.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'preset',
				'type' => 'radio_img',
				'title' => __('Choose a preset', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This will change the overall colors of the site', IRON_TEXT_DOMAIN),
				'options' => get_iron_presets(),
				'std' => 'pink'
			),
			array(
				'id' => 'body_background',
				'type' => 'background',
				'title' => __('Body Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Body background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'class' => 'greybg'
			),
			array(
				'id' => 'footer_bottom_border',
				'type' => 'color',
				'title' => __('Bottom Border Line', IRON_TEXT_DOMAIN),
				'sub_desc' => __('The border at the bottom of every page. Use this to match the colors of the <a href="/wp-admin/admin.php?page=ironband_options&tab=5#footer_bottom_logo">Bottome Logo</a>.', IRON_TEXT_DOMAIN),
				'class' => 'greybg'
			),
			array(
				'id' => 'header_background',
				'type' => 'background',
				'title' => __('Header Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Header background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
			),
			array(
				'id' => 'menu_background',
				'type' => 'background',
				'title' => __('Menu Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Menu background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'menu_link_background',
				'type' => 'background',
				'title' => __('Menu Link Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Menu Link background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'menu_link_active_background',
				'type' => 'background',
				'title' => __('Menu Link Active Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Menu Link Active background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'menu_link_hover_background',
				'type' => 'background',
				'title' => __('Menu Link Hover Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Menu Link Hover background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'content_background',
				'type' => 'background',
				'title' => __('Content Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Content background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'class' => 'greybg'
			),
			array(
				'id' => 'blocks_background',
				'type' => 'background',
				'title' => __('Blocks Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Blocks Content background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size'),
				'class' => 'greybg'
			),
			array(
				'id' => 'blocks_header_background',
				'type' => 'background',
				'title' => __('Blocks Header Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Blocks Header background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size'),
				'class' => 'greybg'
			),
			array(
				'id' => 'carousel_arrows_background',
				'type' => 'background',
				'title' => __('Carousel Arrows Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Carousel Arrows Background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'carousel_arrows_hover_background',
				'type' => 'background',
				'title' => __('Carousel Arrows Hover Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Carousel Arrows Hover Background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'carousel_arrows_color',
				'type' => 'color',
				'title' => __('Carousel Arrows Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Carousel Arrows Color', IRON_TEXT_DOMAIN),
				'class' => 'greybg'
			),
			array(
				'id' => 'button_background',
				'type' => 'background',
				'title' => __('Buttons Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Buttons background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'button_hover_background',
				'type' => 'background',
				'title' => __('Buttons Hover Background', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Buttons background options / Upload a custom background image', IRON_TEXT_DOMAIN),
				'desc' => 'This will override the preset background',
				'hide' => array('size', 'attachment'),
				'class' => 'greybg'
			),
			array(
				'id' => 'button_color',
				'type' => 'color',
				'title' => __('Buttons Color', IRON_TEXT_DOMAIN),
				'class' => 'greybg'
			),
			array(
				'id' => 'button_hover_color',
				'type' => 'color',
				'title' => __('Buttons Hover Color', IRON_TEXT_DOMAIN),
				'class' => 'greybg'
			),
			array(
				'id' => 'custom_css',
				'type' => 'textarea',
				'title' => __('Custom CSS', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This is for advanced users', IRON_TEXT_DOMAIN),
				'rows' => '20',
				'std' => ''
			),
		)
	);

	$sections[] = array(
		'icon' => 'edit',
		'icon_class' => 'icon-large',
		'title' => __('Typography', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some typography options that you can edit. These options will override the selected preset.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'header_color',
				'type' => 'color',
				'title' => __('Header Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'body_color',
				'type' => 'color',
				'title' => __('Body Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'body_link_color',
				'type' => 'color',
				'title' => __('Body Link Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a link text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'body_link_hover_color',
				'type' => 'color',
				'title' => __('Body Link Hover Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a link text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'menu_link_color',
				'type' => 'color',
				'title' => __('Menu Link Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a link text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'menu_link_active_color',
				'type' => 'color',
				'title' => __('Menu Link Active Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a link text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'menu_link_hover_color',
				'type' => 'color',
				'title' => __('Menu Link Hover Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a link text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'blocks_header_link_color',
				'type' => 'color',
				'title' => __('Blocks Header Links Text Color', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a link text color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'h1_typography',
				'type' => 'typography',
				'title' => __('Heading 1 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'h2_typography',
				'type' => 'typography',
				'title' => __('Heading 2 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'h3_typography',
				'type' => 'typography',
				'title' => __('Heading 3 Typography', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose a font, font size and color', IRON_TEXT_DOMAIN),
				'std' => ''
			),
		)
	);

	$sections[] = array(
		'icon' => 'chevron-up',
		'icon_class' => 'icon-large',
		'title' => __('Header Options', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some header options that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'header_logo',
				'type' => 'upload',
				'title' => __('Header Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo.png',
				'desc' => 'Maximum Size : 400 &times; 150 px',
				'class' => 'greybg'
			),
			array(
				'id' => 'header_logo_mobile',
				'type' => 'upload',
				'title' => __('Header Logo (Mobile Version)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your mobile version logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo-mobile.png',
				'desc' => 'Maximum Size : 150 &times; 50 px',
				'class' => 'greybg'
			),
			array(
				'id' => 'header_menu_logo_icon',
				'type' => 'upload',
				'title' => __('Header Menu Logo Icon', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your menu logo icon (When menu is in fixed mode)', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo-panel.png',
				'desc' => 'Maximum Size : 120 &times; 40 px',
				'class' => 'greybg'
			),
			array(
				'id' => 'header_blockquote',
				'type' => 'blockquote',
				'title' => __('Header Quote', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', IRON_TEXT_DOMAIN),
				'std' => array(
					'quote'=>'A professional theme for your band signed IRON TEMPLATES',
					'author'=>'Rolling Stone Magazine'
				)
			),
		)
	);

	$sections[] = array(
		'icon' => 'chevron-down',
		'icon_class' => 'icon-large',
		'title' => __('Footer Options', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some footer options that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'footer_logo',
				'type' => 'upload',
				'title' => __('Footer Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo.png',
				'desc' => 'Maximum Size : 400 &times; 150 px',
				'class' => 'greybg'
			),
			array(
				'id' => 'footer_logo_mobile',
				'type' => 'upload',
				'title' => __('Footer Logo (Mobile Version)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your mobile version logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo-mobile.png',
				'desc' => 'Maximum Size : 150 &times; 50 px',
				'class' => 'greybg'
			),
			array(
				'id' => 'footer_bottom_logo',
				'type' => 'upload',
				'title' => __('Bottom Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload a mini logo that will appear on the bottom. Could be a partner or a record label, for example.', IRON_TEXT_DOMAIN),
				'desc' => 'Maximum Size : 200 &times; 100 px',
				'std' => get_template_directory_uri().'/images/logo-irontemplates-footer.png',
				'class' => 'greybg'
			),
			array(
				'id' => 'footer_bottom_link',
				'type' => 'text',
				'title' => __('Bottom Logo URL', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Add a URL to the mini logo that will appear on the bottom. The link opens in a new window.', IRON_TEXT_DOMAIN),
				'std' => 'http://irontemplates.com/'
			),
			array(
				'id' => 'footer_copyright',
				'type' => 'editor',
				'title' => __('Footer Copyright Text', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This is a little space under the field title which can be used for additonal info.', IRON_TEXT_DOMAIN),
				'std' => 'Copyright &copy; '.date('Y').' Iron Templates<br>All rights reserved'
			),
		)
	);

	$home_blocks = array(
		"enabled" => array(
			"placebo" => "placebo",
			"audioplayer_twitter" => "Audio Player / Twitter Feed",
			"recent_news" => "Recent News",
			"upcoming_gigs" => "Upcoming Gigs",
			"recent_videos" => "Recent Videos",
		),
		"disabled" => array(
			"placebo" => "placebo"
		)
	);

	$sections[] = array(
		'icon' => 'th',
		'icon_class' => 'icon-large',
		'title' => __('Homepage Blocks', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Control the layout of the front page.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				"id" => "homepage_blocks",
				"type" => "sorter",
				"title" => "Layout Manager",
				"desc" => "Organize how you want the modules to appear on the homepage",
				'options' => $home_blocks,
				'std' => $home_blocks
			),
			array(
				'id' => 1,
				'type' => 'info',
				'desc' => '<h4 class="title">' . __('Module Labels', IRON_TEXT_DOMAIN) . '</h4>'
			),
			array(
				'id' => 2,
				'type' => 'info',
				'desc' => '<h5 class="title">' . __('Slideshow', IRON_TEXT_DOMAIN) . '</h5>'
			),
			array(
				'id' => 'slide_more_label',
				'type' => 'text',
				'title' => __('Slideshow “Read More” Label.', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Default call-to-action displayed on each slide.', IRON_TEXT_DOMAIN) . '<br><small><em>(' . __('This setting may be overridden for individual slides.', IRON_TEXT_DOMAIN) . ')</em></small>',
				'std' => __('Read More', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'slides_widget_action_icon',
				'type' => 'fontawesome',
				'title' => __('Slideshow “Read More” Icon', IRON_TEXT_DOMAIN),
				'std' => 'plus'
			),
			array(
				'id' => 3,
				'type' => 'info',
				'desc' => '<h5 class="title">' . __('Audio Player Module', IRON_TEXT_DOMAIN) . '</h5>'
			),
			array(
				'id' => 'radio_playlist_label',
				'type' => 'text',
				'title' => __('Audio Player Playlist Label', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Default playlist title (i.e., “Popular Songs”).', IRON_TEXT_DOMAIN) . '<br><small><em>(' . __('This setting may be overridden for individual playlists.', IRON_TEXT_DOMAIN) . ')</em></small>',
				'std' => __('Popular Songs', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'albums_widget_action_label',
				'type' => 'text',
				'title' => __('Albums Block Call-To-Action', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'albums_widget_action_icon',
				'type' => 'fontawesome',
				'title' => __('Albums Block Call-To-Action Icon', IRON_TEXT_DOMAIN),
				'std' => 'plus'
			),
			array(
				'id' => 4,
				'type' => 'info',
				'desc' => '<h5 class="title">' . __('Twitter Module', IRON_TEXT_DOMAIN) . '</h5>'
			),
			array(
				'id' => 'twitter_widget_label',
				'type' => 'text',
				'title' => __('Twitter Block Title', IRON_TEXT_DOMAIN),
				'std' => __('Live from Twitter', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'twitter_widget_action_label',
				'type' => 'text',
				'title' => __('Twitter Block Call-To-Action', IRON_TEXT_DOMAIN),
				'std' => __('Follow us on Twitter', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'twitter_widget_action_icon',
				'type' => 'fontawesome',
				'title' => __('Twitter Block Call-To-Action Icon', IRON_TEXT_DOMAIN),
				'std' => 'plus'
			),
			array(
				'id' => 5,
				'type' => 'info',
				'desc' => '<h5 class="title">' . __('News Module', IRON_TEXT_DOMAIN) . '</h5>'
			),
			array(
				'id' => 'posts_widget_label',
				'type' => 'text',
				'title' => __('News Block Title', IRON_TEXT_DOMAIN),
				'desc' => '<br />' . __('Leave field empty to default to the blog posts page title.', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'posts_widget_action_label',
				'type' => 'text',
				'title' => __('News Block Call-To-Action', IRON_TEXT_DOMAIN),
				'desc' => '<br />' . __('Leave field empty to default to "+ All <em>[blog posts page title]</em>".', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'posts_widget_action_icon',
				'type' => 'fontawesome',
				'title' => __('News Block Call-To-Action Icon', IRON_TEXT_DOMAIN),
				'std' => 'plus'
			),
			array(
				'id' => 6,
				'type' => 'info',
				'desc' => '<h5 class="title">' . __('Gigs Module', IRON_TEXT_DOMAIN) . '</h5>'
			),
			array(
				'id' => 'gigs_widget_label',
				'type' => 'text',
				'title' => __('Gigs Block Title', IRON_TEXT_DOMAIN),
				'desc' => '<br />' . __('Leave field empty to default to the gigs page title.', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'gigs_widget_action_label',
				'type' => 'text',
				'title' => __('Gigs Block Call-To-Action', IRON_TEXT_DOMAIN),
				'desc' => '<br />' . __('Leave field empty to default to "+ All <em>[gigs page title]</em>".', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'gigs_widget_action_icon',
				'type' => 'fontawesome',
				'title' => __('Gigs Block Call-To-Action Icon', IRON_TEXT_DOMAIN),
				'std' => 'plus'
			),
			array(
				'id' => 7,
				'type' => 'info',
				'desc' => '<h5 class="title">' . __('Videos Module', IRON_TEXT_DOMAIN) . '</h5>'
			),
			array(
				'id' => 'videos_widget_label',
				'type' => 'text',
				'title' => __('Videos Block Title', IRON_TEXT_DOMAIN),
				'desc' => '<br />' . __('Leave field empty to default to the videos page title.', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'videos_widget_action_label',
				'type' => 'text',
				'title' => __('Videos Block Call-To-Action', IRON_TEXT_DOMAIN),
				'desc' => '<br />' . __('Leave field empty to default to "+ All <em>[videos page title]</em>".', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'videos_widget_action_icon',
				'type' => 'fontawesome',
				'title' => __('Videos Block Call-To-Action Icon', IRON_TEXT_DOMAIN),
				'std' => 'plus'
			),
		)
	);

	$sections[] = array(
		'icon' => 'file-text',
		'icon_class' => 'icon-large',
		'title' => __('Content Types', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('You can control settings concerning related to the reading and navigation of posts. You can decide which page to link people to your albums, for example. You can also adjust how many posts are displayed for each content type.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 1,
				'type' => 'info',
				'desc' => '<h4 class="title">' . __('Page Listings', IRON_TEXT_DOMAIN) . '</h4>'
			),
			array(
				'id' => 'post_type_label',
				'type' => 'text',
				'title' => __('Posts Label', IRON_TEXT_DOMAIN),
				'sub_desc' => __('If no static page is assigned to the blog posts, this will be the default label.', IRON_TEXT_DOMAIN) . '<br>' . __('Empty value will default to "Posts".', IRON_TEXT_DOMAIN),
				'std' => __('News', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'gig_more_label',
				'type' => 'text',
				'title' => __('Gig “Read More” label in Home Page carousel', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Used on the home page when hovering over a carousel.', IRON_TEXT_DOMAIN),
				'std' => __('Get Tickets', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'gig_more_alt_label',
				'type' => 'text',
				'title' => __('Gig “Read More” label in Gigs index.', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Used on the Gigs listing page when hovering over an event.', IRON_TEXT_DOMAIN),
				'std' => __('More Infos', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 1,
				'type' => 'info',
				'desc' => '<p>' . __('Select in the drop-down boxes below the name of the <a href="edit.php?post_type=page">static pages</a> that will contain your gigs, albums, videos, and photos. Also, any Template assigned to the Page will be ignored and the theme’s archive.php (index.php or archive-{$post_type}.php if it exists) will control the display of the posts.', IRON_TEXT_DOMAIN) . '</p><p>' . __('You can control the static page for the Front page and the Posts page on the <a href="options-reading.php">Reading Settings</a> page.', IRON_TEXT_DOMAIN) . '</p><p>' . __('These settings are automatically controlled by the page templates you choose for your pages. For example, if you assign the "Album Posts" page template to a page called "Discography", that page will be automatically selected below. <br>The reverse is not possible at this time.', IRON_TEXT_DOMAIN) . '</p>'
			),
			array(
				'id' => 'page_for_albums',
				'type' => 'pages_select',
				'title' => __('Discography page', IRON_TEXT_DOMAIN),
				'args' => array()
			),
			array(
				'id' => 'page_for_gigs',
				'type' => 'pages_select',
				'title' => __('Gigs page', IRON_TEXT_DOMAIN),
				'args' => array()
			),
			array(
				'id' => 'page_for_videos',
				'type' => 'pages_select',
				'title' => __('Videos page', IRON_TEXT_DOMAIN),
				'args' => array()
			),
			array(
				'id' => 'page_for_photos',
				'type' => 'pages_select',
				'title' => __('Photos page', IRON_TEXT_DOMAIN),
				'args' => array()
			),
			array(
				'id' => 2,
				'type' => 'info',
				'desc' => '<h4 class="title">' . __('Posts per page', IRON_TEXT_DOMAIN) . '</h4><p>' . __('Enter the number of posts to be displayed, per page, on your site for each content type.', IRON_TEXT_DOMAIN) . ' ' . __('You can control the number of posts for the Posts content type on the <a href="options-reading.php">Reading Settings</a> page.', IRON_TEXT_DOMAIN) . '</p><p>' . __('These settings are applied the listings pages and the carousel modules on the home page.', IRON_TEXT_DOMAIN) . '</p>'
			),
			array(
				'id' => 'slides_per_page',
				'type' => 'text',
				'title' => __('Home page slider shows at most', IRON_TEXT_DOMAIN),
				'std' => 5
			),
			array(
				'id' => 'albums_per_page',
				'type' => 'text',
				'title' => __('Discography listings show at most', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'gigs_per_page',
				'type' => 'text',
				'title' => __('Gigs listings show at most', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Includes the carousel on the Home page.', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'videos_per_page',
				'type' => 'text',
				'title' => __('Videos listings show at most', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Includes the carousel on the Home page.', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'photos_per_page',
				'type' => 'text',
				'title' => __('Photos listings show at most', IRON_TEXT_DOMAIN),
				'std' => 10
			),
			array(
				'id' => 'paginate_method',
				'type' => 'radio',
				'title' => __('Pagination Style', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Choose how to provide "paged" navigation of posts, categories, and archive pages.', IRON_TEXT_DOMAIN) . '<br>' . __('You can set how many posts to list on each page on the <a href="options-reading.php">Reading Settings</a> page.', IRON_TEXT_DOMAIN),
				'options' => array(
					'posts_nav_link' => __('Displays links for next and previous pages', IRON_TEXT_DOMAIN) . ' (' . sprintf( _x('e.g. : %s', 'Abbreviation of Latin exemplī grātiā (“for example”).', IRON_TEXT_DOMAIN), __('« Previous Page — Next Page »', IRON_TEXT_DOMAIN) ) . ')',
					'paginate_links' => __('Displays a row of paginated links', IRON_TEXT_DOMAIN) . ' (' . sprintf( _x('e.g. : %s', 'Abbreviation of Latin exemplī grātiā (“for example”).', IRON_TEXT_DOMAIN), __('« Prev 1 … 3 4 5 6 7 … 9 Next »', IRON_TEXT_DOMAIN) ) . ')',
					'paginate_more' => __('Displays a single link to dynamically load more items', IRON_TEXT_DOMAIN) . ' (' . sprintf( _x('e.g. : %s', 'Abbreviation of Latin exemplī grātiā (“for example”).', IRON_TEXT_DOMAIN), __('« More Posts »', IRON_TEXT_DOMAIN) ) . ')',
					'paginate_scroll' => __('Dynamically load more items as you scroll down (infinite scrolling)', IRON_TEXT_DOMAIN)
				),
				'std' => 'posts_nav_link'
			),
			array(
				'id' => 3,
				'type' => 'info',
				'desc' => '<h4 class="title">' . __('Default settings', IRON_TEXT_DOMAIN) . '</h4>'
			),
			array(
				'id' => 'default_gig_show_time',
				'type' => 'checkbox',
				'title' => __('Show the time on new events', IRON_TEXT_DOMAIN),
				'sub_desc' => '<small><em>(' . __('This setting may be overridden for individual events.', IRON_TEXT_DOMAIN) . ')</em></small>',
				'switch' => true,
				'std' => '0'
			),
			array(
				'id' => 'sidebar_for_posts',
				'type' => 'checkbox',
				'title' => __('Show categories sidebar on the News listing page', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'sidebar_for_videos',
				'type' => 'checkbox',
				'title' => __('Show categories sidebar on the Videos listing page', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),

		)
	);

	$sections[] = array(
		'icon' => 'facebook-sign',
		'icon_class' => 'icon-large',
		'title' => __('Social Media', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Here are some social settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'facebook_appid',
				'type' => 'text',
				'title' => __('Facebook App ID', IRON_TEXT_DOMAIN),
				'sub_desc' => __('When you <a target="_blank" href="https://developers.facebook.com/setup/">register your website as an app</a>, you can get detailed analytics about the demographics of your users and how users are sharing from your website with <a target="_blank" href="https://www.facebook.com/insights/">Insights</a>.', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'twitter_username',
				'type' => 'text',
				'title' => __('Twitter Username', IRON_TEXT_DOMAIN),
				'sub_desc' => __('This will be used for the Twitter live feed', IRON_TEXT_DOMAIN),
				'std' => 'envato'
			),
			array(
				'id' => 'facebook_page',
				'type' => 'text',
				'title' => __('Facebook Page URL', IRON_TEXT_DOMAIN),
				'std' => 'https://facebook.com/envato'
			),
			array(
				'id' => 'twitter_page',
				'type' => 'text',
				'title' => __('Twitter Page URL', IRON_TEXT_DOMAIN),
				'std' => 'https://twitter.com/envato'
			),
			array(
				'id' => 'instagram_page',
				'type' => 'text',
				'title' => __('Instagram Page URL', IRON_TEXT_DOMAIN),
				'std' => ''
			),
			array(
				'id' => 'linkedin_page',
				'type' => 'text',
				'title' => __('LinkedIn Page URL', IRON_TEXT_DOMAIN),
				'std' => 'http://linkedin.com/'
			),
			array(
				'id' => 'soundcloud_page',
				'type' => 'text',
				'title' => __('SoundCloud Page URL', IRON_TEXT_DOMAIN),
				'std' => 'http://soundcloud.com/'
			),
			array(
				'id' => 'vimeo_page',
				'type' => 'text',
				'title' => __('Vimeo Page URL', IRON_TEXT_DOMAIN),
				'std' => 'http://vimeo.com/'
			),
			array(
				'id' => 'youtube_page',
				'type' => 'text',
				'title' => __('YouTube Page URL', IRON_TEXT_DOMAIN),
				'std' => 'http://youtube.com/'
			),
			array(
				'id' => 'custom_social_actions',
				'type' => 'textarea',
				'title' => __('Custom Social Buttons', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Add your favorite drop-in bookmarking and social link-sharing scripts.<br /><br />e.g., <a target="_blank" href="//sharethis.com/">ShareThis</a>, <a target="_blank" href="//www.addthis.com/">AddThis</a>', IRON_TEXT_DOMAIN),
				'rows' => '20',
				'std' => '
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
	<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
	<a class="addthis_button_tweet"></a>
	<a class="addthis_button_pinterest_pinit"></a>
	<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js"></script>
<!-- AddThis Button END -->
'
			)

		)
	);


	$sections[] = array(
		'icon' => 'envelope',
		'icon_class' => 'icon-large',
		'title' => __('Newsletter', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Here are some newsletter settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'newsletter_enabled',
				'type' => 'checkbox',
				'title' => __('Newsletter Form', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enable / Disable Newsletter Form', IRON_TEXT_DOMAIN),
				'switch' => true,
				'std' => '1'
			),
			array(
				'id' => 'newsletter_type',
				'type' => 'radio',
				'title' => __('Newsletter Type', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Select your Newsletter Type', IRON_TEXT_DOMAIN),
				'options' => array(
					'iron_newsletter_subscribe' => 'WordPress Database',
					'iron_mailchimp_subscribe' => 'Mailchimp'
				),
				'std' => 'iron_newsletter_subscribe'
			),
			array(
				'id' => 'newsletter_download',
				'type' => 'raw_html',
				'title' => __('Export Newsletter', IRON_TEXT_DOMAIN),
				'html' => '<a href="'.admin_url('?load=newsletter.csv').'">Export newsletter to a CSV file</a>',
			),
			array(
				'id' => 'mailchimp_api_key',
				'type' => 'text',
				'title' => __('Mailchimp API KEY', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enter your Mailchimp API KEY (Only if using Mailchinp)', IRON_TEXT_DOMAIN),
				'desc' => '<br><br>Get your API key from <a target="_blank" href="http://admin.mailchimp.com/account/api/">http://admin.mailchimp.com/account/api/</a>',
				'std' => ''
			),
			array(
				'id' => 'mailchimp_list_id',
				'type' => 'text',
				'title' => __('Mailchimp LIST ID', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enter your Mailchimp LIST ID (Only if using Mailchinp)', IRON_TEXT_DOMAIN),
				'desc' => '<br><br>Get your list unique id from <a target="_blank" href="http://admin.mailchimp.com/lists">http://admin.mailchimp.com/lists</a><br>under settings at the bottom of the page, look for unique id',
				'std' => ''
			),
			array(
				'id' => 'newsletter_label',
				'type' => 'text',
				'title' => __('Newsletter Label', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Call to action used in the footer.', IRON_TEXT_DOMAIN),
				'std' => __('Subscribe to our <strong>newsletter</strong>', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'newsletter_submit_button_label',
				'type' => 'text',
				'title' => __('Newsletter Submit Button', IRON_TEXT_DOMAIN),
				'sub_desc' => __('The label used for the submit button.', IRON_TEXT_DOMAIN),
				'std' => __('Subscribe', IRON_TEXT_DOMAIN)
			),
			array(
				'id' => 'newsletter_success',
				'type' => 'textarea',
				'title' => __('Newsletter Success Message', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enter a customized newsletter success message', IRON_TEXT_DOMAIN),
				'std' => '<span>Thanks for your interest!</span> We will let you know.'
			),
			array(
				'id' => 'newsletter_exists',
				'type' => 'textarea',
				'title' => __('Newsletter Already Subscribed Message', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enter a customized newsletter message if user is already subscribed', IRON_TEXT_DOMAIN),
				'std' => 'This email is already subscribed.'
			),
			array(
				'id' => 'newsletter_invalid',
				'type' => 'textarea',
				'title' => __('Newsletter Invalid Message', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enter a customized newsletter message if user email is invalid', IRON_TEXT_DOMAIN),
				'std' => 'This email is invalid.'
			),
			array(
				'id' => 'newsletter_error',
				'type' => 'textarea',
				'title' => __('Newsletter Error Message', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Enter a customized newsletter error message', IRON_TEXT_DOMAIN),
				'std' => 'Oups, something went wrong!'
			)
		)
	);

	$sections[] = array(
		'icon' => 'phone-sign',
		'icon_class' => 'icon-large',
		'title' => __('Contact / Booking', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('Contact / Booking Information that will appear on the contact page.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'contact_logo',
				'type' => 'upload',
				'title' => __('Contact / Booking Logo', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your company / booking agency logo', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/logo-2.png',
				'desc' => 'Logo size: 100px &times; 100px',
				'class' => 'greybg'
			),
			array(
				'id' => 'contact_name',
				'type' => 'text',
				'title' => __('Contact Name', IRON_TEXT_DOMAIN),
				'std' => 'Company'
			),
			array(
				'id' => 'contact_address',
				'type' => 'editor',
				'title' => __('Contact Address', IRON_TEXT_DOMAIN),
				'std' => '3456, Coronation Street<br>Montreal (Canada)<br>H4E 1P5'
			),
			array(
				'id' => 'contact_email',
				'type' => 'text',
				'title' => __('Contact Email', IRON_TEXT_DOMAIN),
				'std' => 'contact@ironband.com'
			),
			array(
				'id' => 'contact_phone',
				'type' => 'text',
				'title' => __('Contact Phone', IRON_TEXT_DOMAIN),
				'std' => '1 (555) 555-5555'
			),
		)
	);

	$sections[] = array(
		'icon' => 'code',
		'icon_class' => 'icon-large',
		'title' => __('Metadata', IRON_TEXT_DOMAIN),
		'desc' => '<p class="description">' . __('These are some metadata options that you can edit, including favicons and a short title for mobile home screens.', IRON_TEXT_DOMAIN) . '</p>',
		'fields' => array(
			array(
				'id' => 'meta_favicon',
				'type' => 'upload',
				'title' => __('Favicon', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/favicon.ico',
				'desc' => 'Icon Size: 32px &times; 32px',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (57×57)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-57x57-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 57px &times; 57px. For iPhone 3GS, 2011 iPod Touch and older Android devices.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon_72x72',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (72×72)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-72x72-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 72px &times; 72px. For 1st generation iPad, iPad 2 and iPad mini.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon_114x114',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (114×114)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-114x114-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 114px &times; 114px. For iPhone 4, 4S, 5 and 2012 iPod Touch.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_touch_icon_144x144',
				'type' => 'upload',
				'title' => __('Apple Touch Icon (144×144)', IRON_TEXT_DOMAIN),
				'sub_desc' => __('Upload your shortcut icon', IRON_TEXT_DOMAIN),
				'std' => get_template_directory_uri().'/images/icons/apple-touch-icon-144x144-precomposed.png',
				'desc' => 'Precomposed. Icon Size: 144px &times; 144px. For iPad 3rd and 4th generation.',
				'class' => 'greybg'
			),
			array(
				'id' => 'meta_apple_mobile_web_app_title',
				'type' => 'text',
				'title' => __('Apple Mobile Web App Title', IRON_TEXT_DOMAIN),
				'desc' => '<br><br>Sets a different title for an iOS Home Screen icon. By default, Mobile Safari crops document titles to 13 characters.',
				'std' => ''
			),
		)
	);

	if($args['dev_mode']) {

		$sections[] = array(
			'icon' => 'cog',
			'icon_class' => 'icon-large',
			'title' => __('Developer Settings', IRON_TEXT_DOMAIN),
			'desc' => '<p class="description">' . __('Here are some developer settings that you can edit.', IRON_TEXT_DOMAIN) . '</p>',
			'fields' => array(
				array(
					'id' => 'acf_lite',
					'type' => 'checkbox',
					'title' => __('Enable ACF LITE Mode', IRON_TEXT_DOMAIN),
					'sub_desc' => __('<br>By default, ACF (Advanced Custom Fields) is running in LITE mode. <br>If you which to add your own custom fields using the ACF Admin Interface, you can turn off this option. <br><br><b>NB:</b><br> When ACF LITE is on, custom fields are loaded from the custom-fields.php file found in /includes/ <br>For more info on using ACF, visit <a target="_blank" href="http://www.advancedcustomfields.com/">www.advancedcustomfields.com</a>', IRON_TEXT_DOMAIN),
					'switch' => true,
					'std' => '1' // 1 = checked | 0 = unchecked
				)
			)
		);
	}



	$tabs = array();

	if (function_exists('wp_get_theme')){

		$theme_data = wp_get_theme();
		$item_uri = $theme_data->get('ThemeURI');
		$name = $theme_data->get('Name');
		$description = $theme_data->get('Description');
		$author = $theme_data->get('Author');
		$author_uri = $theme_data->get('AuthorURI');
		$version = $theme_data->get('Version');
		$tags = $theme_data->get('Tags');


		$item_info = '<div class="redux-opts-section-desc">';
		$item_info .= '<p class="redux-opts-item-data description item-description"><h4>' . $name . '</h4>' . $description . '</p>';
		$item_info .= '<p class="redux-opts-item-data description item-uri">' . __('<strong>Theme URL:</strong> ', IRON_TEXT_DOMAIN) . '<a href="' . $item_uri . '" target="_blank">' . $item_uri . '</a></p>';
		$item_info .= '<p class="redux-opts-item-data description item-author">' . __('<strong>Author:</strong> ', IRON_TEXT_DOMAIN) . ($author_uri ? '<a href="' . $author_uri . '" target="_blank">' . $author . '</a>' : $author) . '</p>';
		$item_info .= '<p class="redux-opts-item-data description item-version">' . __('<strong>Version:</strong> ', IRON_TEXT_DOMAIN) . $version . '</p>';
		$item_info .= '<p class="redux-opts-item-data description item-tags">' . __('<strong>Tags:</strong> ', IRON_TEXT_DOMAIN) . implode(', ', $tags) . '</p>';
		$item_info .= '</div>';

		$tabs['item_info'] = array(
			'icon' => 'info-sign',
			'icon_class' => 'icon-large',
			'title' => __('Theme Information', IRON_TEXT_DOMAIN),
			'content' => $item_info
		);

	}

	global $Redux_Options;
	$Redux_Options = new Redux_Options($sections, $args, $tabs);

}
setup_framework_options();

/*
 *
 * Custom function for the callback referenced above
 *
 */
function my_custom_field($field, $value) {
	print_r($field);
	print_r($value);
}

/*
 *
 * Custom function for the callback validation referenced above
 *
 */
function validate_callback_function($field, $value, $existing_value) {
	$error = false;
	$value =  'just testing';
	/*
	do your validation

	if(something) {
		$value = $value;
	} elseif(somthing else) {
		$error = true;
		$value = $existing_value;
		$field['msg'] = 'your custom error message';
	}
	*/

	$return['value'] = $value;
	if($error == true) {
		$return['error'] = $field;
	}
	return $return;
}


/*
 *
 * Get Theme Option by ID
 *
 * Optinal Params:
 * $key, if value is an array get by array key
 */

function get_iron_option($id, $key = null) {
	global $Redux_Options;
	$value = $Redux_Options->get($id);

	if($key && is_array($value) && isset($value["$key"]))
		$value = $value[$key];

	return $value;
}

/*
 *
 * Get Theme Options Array
 *
 */

function get_iron_options() {

	global $Redux_Options;
	return $Redux_Options->options;
}

/*
 *
 * Set Theme Option by ID
 *
 * Optinal Params:
 * $key, if value is an array get by array key
 */

function set_iron_option($id, $value = null) {
	global $Redux_Options;

	if ( null === $value )
		$value = $Redux_Options->_get_std($id);

	$Redux_Options->set($id, $value);
}

/*
 *
 * Reset Theme Option by ID
 *
 * Optinal Params:
 * $key, if value is an array get by array key
 */

function reset_iron_option($id) {
	global $Redux_Options;
	$value = $Redux_Options->_get_std($id);

	$Redux_Options->set($id, $value);
}

/*
 *
 * Get Theme Presets Array
 *
 */

function get_iron_presets() {

	$files = scandir(Redux_OPTIONS_DIR.'/presets');
	$presets = array();

	foreach($files as $file) {
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		$id = str_replace(".".$ext, "", $file);
		$filename = ucFirst($id);

		if($ext == 'png' ) {
			$presets[$id] = array('title' => $filename, 'img' => Redux_OPTIONS_URL.'/presets/'.$file);
		}
	}

	return $presets;
}


function iron_page_for_content_update ( $option ) {

	set_transient(IRON_TEXT_DOMAIN . '_flush_rules', true);

}

add_action('update_option_' . IRON_TEXT_DOMAIN, 'iron_page_for_content_update', 10, 1);