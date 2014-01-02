<?php
/*
 * After Theme Setup
 */
function iron_theme_setup () {

	register_nav_menu('main-menu', 'Main Menu');

	if ( function_exists('add_theme_support') ) {
		add_theme_support('automatic-feed-links');
		add_theme_support('post-thumbnails');
		add_theme_support( 'html5', array( 'comment-form', 'comment-list' ) );
	}

	if ( function_exists('add_image_size') ) {
		add_image_size('image-thumb', 300, 230, true);
	}

	// Fix bug with category pages not found after reseting option panel to default
	if(!empty($_GET["settings-updated"])) {
		switch_theme( get_template() );
	}
}

add_action('after_setup_theme', 'iron_theme_setup');


/*
 * Redirect to options after activation
 */
function iron_theme_activation() {

	flush_rewrite_rules();

	if ( ! empty($_GET['activated']) && $_GET['activated'] == 'true' )
	{
		wp_redirect( admin_url('admin.php?page=ironband_options') );
		exit;
	}

}
add_action('after_switch_theme', 'iron_theme_activation');


function webmotion_admin_head ()
{
	if ( get_iron_option('meta_favicon') )
	echo '<link rel="shortcut icon" type="image/x-icon" href="' . get_iron_option('meta_favicon') . '" />';
}

add_action('admin_head', 'webmotion_admin_head', 99);


function iron_write_updates() {

	global $iron_updates;

	$static_updates_file = IRON_PARENT_DIR.'/changelog.txt';
	$updates_file = IRON_PARENT_DIR.'/admin/updates.php';

	if(file_exists($static_updates_file) && is_writable($static_updates_file) && !empty($iron_updates)) {

		$static_updates_file_time = filemtime($static_updates_file);
		$updates_file_time = filemtime($updates_file);

		if(($static_updates_file_time < $updates_file_time) || (@filesize($static_updates_file_time) == 0)) {

			$changelog = '';
			foreach($iron_updates as $update) {

				$changelog .= '----------------------------------------------'."\r\n";
				$changelog .= 'V.'.$update["version"].' - '.$update["date"]."\r\n";
				$changelog .= '----------------------------------------------'."\r\n";
				foreach($update["changes"] as $change) {

					$changelog .= '- '.$change."\r\n";

				}
				$changelog .= "\r\n";
			}

			file_put_contents($static_updates_file, $changelog);
		}
	}

}
add_action('init', 'iron_write_updates');

/*
 * Import default Theme Data
 */
function iron_import_default_data() {

	global $wpdb;

	require_once IRON_PARENT_DIR . '/includes/classes/autoimporter.class.php';

	$importPath = IRON_PARENT_DIR . '/import/';

	$file = $importPath.'default-data.xml';

	if(file_exists($file) && copy($file, $importPath.'tmp.xml')) {

		// call the function
		$args = array(
			'file'        => $importPath.'tmp.xml',
			'map_user_id' => 1
		);

		$removed = array();
		if($wpdb->query("TRUNCATE TABLE $wpdb->posts")) $removed[] = 'Posts removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->postmeta")) $removed[] = 'Postmeta removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->comments")) $removed[] = 'Comments removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->commentmeta")) $removed[] = 'Commentmeta removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->links")) $removed[] = 'Links removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->terms")) $removed[] = 'Terms removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->term_relationships")) $removed[] = 'Term relationships removed';
		if($wpdb->query("TRUNCATE TABLE $wpdb->term_taxonomy")) $removed[] = 'Term Taxonomy removed';
		if($wpdb->query("DELETE FROM $wpdb->options WHERE `option_name` LIKE ('%_transient_%')")) $removed[] = 'Transients removed';
		$wpdb->query("OPTIMIZE TABLE $wpdb->options");

		ob_start();

		foreach($removed as $item) {
			echo $item.'<br>';
		}
		echo '<br><hr><br>';

		auto_import( $args );
		$output = ob_get_contents();
		ob_end_clean();



		// UGLY HACK TO AVOID DUPLICATED MENU ITEMS --------------------------------------------------------------------

		$keep_safe = array();

		$results = $wpdb->get_results("select MIN(m2.meta_value) as parent from $wpdb->postmeta m1
		INNER JOIN $wpdb->postmeta m2 ON m1.post_id = m2.post_id AND m2.meta_key = '_menu_item_menu_item_parent'
		WHERE m1.meta_key = '_menu_item_object_id' AND m2.meta_value != 0 group by m1.meta_value having count(*) > 1");

		foreach($results as $res) {
			$keep_safe[] = $res->parent;
		}

		$results = $wpdb->get_results("select MAX(m2.meta_value) as parent, m1.post_id, m1.meta_value, MAX(m1.meta_id) from $wpdb->postmeta m1
		INNER JOIN $wpdb->postmeta m2 ON m1.post_id = m2.post_id AND m2.meta_key = '_menu_item_menu_item_parent'
		WHERE m1.meta_key = '_menu_item_object_id' AND m2.meta_value != 0 group by m1.meta_value having count(*) > 1");

		foreach($results as $res) {


			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE `post_id` = $res->post_id");
			wp_delete_post($res->post_id);

			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE `post_id` = $res->parent");
			wp_delete_post($res->parent);

		}

		$results = $wpdb->get_results("select m1.post_id, m1.meta_value, MAX(m1.meta_id) from $wpdb->postmeta m1
		INNER JOIN $wpdb->postmeta m2 ON m1.post_id = m2.post_id AND m2.meta_key = '_menu_item_menu_item_parent'
		WHERE m1.meta_key = '_menu_item_object_id' AND m2.meta_value = 0 group by m1.meta_value having count(*) > 1");

		foreach($results as $res) {

			if(!in_array($res->post_id, $keep_safe)) {
				$wpdb->query("DELETE FROM $wpdb->postmeta WHERE `post_id` = $res->post_id");
				wp_delete_post($res->post_id);
			}
		}

		// --------------------------------------------------------------------------------------------------------------

		flush_rewrite_rules();

		$data["error"] = false;
		$data["msg"] = $output."<br><font color='green'><b>Import Succeded!</b></font><br>";

	}else{

		$data["error"] = true;
		$data["msg"] = "Import file is missing: ".$file;
	}
	die(json_encode($data));
}
add_action('wp_ajax_iron_import_default_data', 'iron_import_default_data');
add_action('wp_ajax_nopriv_iron_import_default_data', 'iron_import_default_data');


function iron_import_assign_templates() {

	$pages = get_pages();

	$data["error"] = false;
	$data["msg"] = "";

	$front_page = false;
	$blog_page = false;

	foreach($pages as $page) {

		$template = false;
		$content_type_option = false;

		if($page->post_name == 'home') {

			$template = "page-home.php";
			$front_page = $page;

		}else if($page->post_name == 'news') {

			$template = "index.php";
			$blog_page = $page;

		}else if($page->post_name == 'gigs') {

			$template = "archive-gig.php";
			$content_type_option = 'page_for_gigs';

		}else if($page->post_name == 'discography') {

			$template = "archive-album.php";
			$content_type_option = 'page_for_albums';

		}else if($page->post_name == 'videos') {

			$template = "archive-video.php";
			$content_type_option = 'page_for_videos';

		}else if($page->post_name == 'photos') {

			$template = "archive-photo.php";
			$content_type_option = 'page_for_photos';

		}else if($page->post_name == 'contact') {

			$template = "page-contact.php";
		}

		if($template !== false){
			update_post_meta( $page->ID, '_wp_page_template', $template );
			$data["msg"] .= "Assigned Page: (".$page->post_title.") To Template: (".$template.")<br>";

		}

		if($content_type_option !== false)
			set_iron_option($content_type_option, $page->ID);
	}


	$data["msg"] .= "<br><font color='green'><b>Templates Assigned Successfully!</b></font><br><br><br>";


	$data["msg"] .= "<b>Assigning Static Pages ... </b><br><br>";


	// Use a static front page
	$errors = 0;
	if($front_page !== false) {

		update_option( 'page_on_front', $front_page->ID );
		update_option( 'show_on_front', 'page' );
		$data["msg"] .= "Assigned: (".$front_page->post_title.") As Static Front Page<br>";

	}else{
		$errors++;
	}

	// Set the blog page
	if($blog_page !== false) {

		update_option( 'page_for_posts', $blog_page->ID );
		$data["msg"] .= "Assigned: (".$blog_page->post_title.") As Static Blog Page<br>";

	}else{
		$errors++;
	}

	if($errors == 0)
		$data["msg"] .= "<br><font color='green'><b>Static Pages Assigned Successfully!</b></font><br>";
	else
		$data["msg"] .= "<br><font color='red'><b>Failed To Assign Static Pages!</b></font><br>";

	die(json_encode($data));
}

add_action('wp_ajax_iron_import_assign_templates', 'iron_import_assign_templates');
add_action('wp_ajax_nopriv_iron_import_assign_templates', 'iron_import_assign_templates');



/**
 * Adjusts content_width value for video post formats and attachment templates.
 *
 * @return void
 */
function iron_content_width ()
{
	global $content_width;

	if ( is_page() )
		$content_width = 1064;
	elseif ( 'album' == get_post_type() )
		$content_width = 693;
	elseif ( 'gig' == get_post_type() )
		$content_width = 700;
}
add_action('template_redirect', 'iron_content_width');

/*
 * Enqueue theme Styles
 */
function iron_enqueue_styles() {

	if ( is_admin() || iron_is_login_page() ) return;

	global $wp_query;

	// Styled by the theme
	wp_dequeue_style('contact-form-7');

	iron_enqueue_style('iron-revolution', IRON_PARENT_URL.'/css/slider-revolution.css', false, '', 'all' );
	iron_enqueue_style('iron-fancybox', IRON_PARENT_URL.'/css/fancybox.css', false, '', 'all' );
	wp_enqueue_style('font-awesome', '//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css', false, '', 'all' );
	iron_enqueue_style('iron-master', IRON_PARENT_URL.'/style.css', false, '', 'all' );

	if (get_iron_option('preset') != '')
		iron_enqueue_style('iron-preset', IRON_PARENT_URL.'/css/colors/'.get_iron_option('preset').'/style.css', array('iron-master'), '', 'all' );

	if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) )
		iron_enqueue_style('iron-msie', IRON_PARENT_URL.'/css/ie.css', array('iron-master'), '', 'all');

	$custom_styles_url = home_url().'?load=custom-style.css';
	if($wp_query && !empty($wp_query->queried_object) && !empty($wp_query->queried_object->ID))
		$custom_styles_url .= '&post_id='.$wp_query->queried_object->ID;

	wp_enqueue_style('custom-styles', $custom_styles_url, array('iron-master', 'iron-preset'), '', 'all' );

}
add_action('wp_enqueue_scripts', 'iron_enqueue_styles');


function iron_enqueue_scripts() {

	if ( is_admin() || iron_is_login_page() ) return;

	if ( is_singular() && comments_open() && get_option('thread_comments') )
		wp_enqueue_script('comment-reply');
/*
	if ( is_singular() && get_iron_option('custom_social_actions') )
		wp_enqueue_script('addthis', '//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51719dd0019cdf21', array(), null, true);
*/

	// HTML5 Shim
	if (!empty($_SERVER['HTTP_USER_AGENT']) && preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) ) {
		$html5shim = '//html5shim.googlecode.com/svn/trunk/html5.js';
		wp_enqueue_script('html5shim', ( @fopen($html5shim, 'r') ? $html5shim : IRON_PARENT_URL . '/js/html5.js' ), array(), '3.6.2pre', false);
	}

/*
	if ( preg_match('/(?i)msie [6-8]/',$_SERVER['HTTP_USER_AGENT']) )
		wp_enqueue_script('respondjs', IRON_PARENT_URL.'/js/respond.min.js', array(), null, false);
*/

	// VENDORS
	iron_enqueue_script('iron-utilities', IRON_PARENT_URL.'/js/utilities.min.js', array('jquery'), null, true);
	iron_enqueue_script('iron-plugins', IRON_PARENT_URL.'/js/plugins.all.min.js', array('jquery'), null, true);
	iron_enqueue_script('iron-twitter', IRON_PARENT_URL.'/js/twitter/jquery.tweet.min.js', array('jquery'), null, true);
	iron_enqueue_script('iron-main', IRON_PARENT_URL.'/js/main.js', array('jquery', 'iron-plugins'), null, true);

	wp_localize_script('iron-main', 'iron_vars', array(
		'theme_url' => IRON_PARENT_URL,
		'ajaxurl' => admin_url('admin-ajax.php'),
		'enable_nice_scroll' => get_iron_option('enable_nice_scroll') == "0" ? false : true,
		'enable_fixed_header' => get_iron_option('enable_fixed_header') == "0" ? false : true,
		'lang' => array(
			'newsletter_success' => __(get_iron_option('newsletter_success'), IRON_TEXT_DOMAIN),
			'newsletter_exists' => __(get_iron_option('newsletter_exists'), IRON_TEXT_DOMAIN),
			'newsletter_invalid' => __(get_iron_option('newsletter_invalid'), IRON_TEXT_DOMAIN),
			'newsletter_error' => __(get_iron_option('newsletter_error'), IRON_TEXT_DOMAIN)
		)
	));

}

add_action('wp_enqueue_scripts', 'iron_enqueue_scripts');

function iron_metadata_icons () {
	$output = array();

	if ( get_iron_option('meta_apple_mobile_web_app_title') ) :
		$output[] = '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_iron_option('meta_apple_mobile_web_app_title') ) . '">';
	endif;

	if ( get_iron_option('meta_favicon') ) :
		$output[] = '<link rel="shortcut icon" type="image/x-icon" href="' . esc_url( get_iron_option('meta_favicon') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" href="' . esc_url( get_iron_option('meta_apple_touch_icon') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon_72x72') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="' . esc_url( get_iron_option('meta_apple_touch_icon_72x72') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon_114x114') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="' . esc_url( get_iron_option('meta_apple_touch_icon_114x114') ) . '">';
	endif;

	if ( get_iron_option('meta_apple_touch_icon_144x144') ) :
		$output[] = '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="' . esc_url( get_iron_option('meta_apple_touch_icon_144x144') ) . '">';
	endif;

	if ( ! empty($output) )
		echo "\n\t" . implode("\n\t", $output);
}

add_action('wp_head', 'iron_metadata_icons', 100);

/**
 * Disable inline CSS injected by WordPress.
 *
 * Always apply your styles from an external file.
 */
add_filter('use_default_gallery_style', '__return_false');



/*
| -------------------------------------------------------------------
| Loading Dynamic Assets
| -------------------------------------------------------------------
| */

function iron_load_dynamic_assets() {

	if(is_admin() || iron_is_login_page()) return -1;

	if(!empty($_GET["load"])) {

		if($_GET["load"] == 'custom-style.css') {
			include_once(IRON_PARENT_DIR.'/css/custom-style.php');
			die();
		}

	}
}
add_action( 'template_redirect', 'iron_load_dynamic_assets');


/*
| -------------------------------------------------------------------
| Enqueue Latest Script based on timestamp.
| This Avoids flushing browser cache
| -------------------------------------------------------------------
| */

function iron_enqueue_script($handle, $src, $deps = array(), $ver = false, $in_footer = false ) {

	$src_path = str_replace(get_template_directory_uri(), get_template_directory(), $src);
	$file_time = filemtime($src_path);
	$src = $src."?t=".$file_time;

	wp_enqueue_script($handle, $src, $deps, $ver, $in_footer);
}

/*
| -------------------------------------------------------------------
| Enqueue Latest Style based on timestamp.
| This Avoids flushing browser cache
| -------------------------------------------------------------------
| */

function iron_enqueue_style($handle, $src, $deps = array(), $ver = false, $media = "all") {

	$src_path = str_replace(get_template_directory_uri(), get_template_directory(), $src);
	$file_time = filemtime($src_path);
	$src = $src."?t=".$file_time;

	wp_enqueue_style($handle, $src, $deps, $ver, $media);
}
