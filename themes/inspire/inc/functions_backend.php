<?php

/**************************************
INDEX

AJAX DELETE SLIDER ITEM
CHECK FOR UPDATES

***************************************/


/**************************************
AJAX DELETE SLIDER ITEM
***************************************/

	//AJAX CALL
	add_action('wp_ajax_del_slider_item', 'del_slider_item');
	add_action('wp_ajax_nopriv_del_slider_item', 'del_slider_item_must_login');

	function del_slider_item() {
		if (!wp_verify_nonce($_REQUEST['nonce'], 'del_slider_item_nonce')) {
			exit('NONCE INCORRECT!');
		}

		$del_item_id = $_REQUEST['item_id'];
		delete_post_meta($del_item_id, 'cmb_slider_feature');

		//update order_array
		$results_slider_posts = get_posts(array(
			'numberposts'		=> -1,
			'meta_key'			=> 'cmb_slider_feature',
			'meta_value'		=> 'checked',
			'orderby'			=> 'post_date',
			'order'				=> 'DESC',
			'post_type'    		=> 'post',
			'post_status'     	=> 'publish',
			'suppress_filters'  => true,
		));
		mb_get_updated_order_array($results_slider_posts);

		$result['type'] = 'success';

		//check if this is an ajax call
		if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		      $result = json_encode($result);
		      echo $result;
		}

		die();

	}

	function del_slider_item_must_login() {
		die();
	}


/**************************************
CHECK FOR UPDATES
***************************************/

	// MAIN CONTROLLER - CHECK IF TRANSIENT EXISTS
	// delete_transient('inspire_version_info');
	// var_dump(get_transient('inspire_version_info'));

	$inspire_options = get_option('inspire_options');

	if (isset($inspire_options['check_for_updates']) && ini_get('allow_url_fopen') == 1) {
		if (get_transient('inspire_version_info')) {
			$inspire_version_info = get_transient('inspire_version_info');
			//check if current version number has changed (theme has been updated)
			$style_url = get_template_directory_uri() . '/style.css';
			$info_array = mb_parse_comment_info_into_array($style_url);
			if ($info_array['Version'] != $inspire_version_info['current_version']) {
				delete_transient('inspire_version_info');
			} elseif ($inspire_version_info['current_version'] < $inspire_version_info['latest_version']) {
				add_action('admin_notices','boost_display_update_notice');
			}
		} else {
			boost_update_version_info();
		}
	}

	function boost_update_version_info() {
		//extract current theme info
		$style_url = get_template_directory_uri() . '/style.css';
		$info_array = mb_parse_comment_info_into_array($style_url);

		//get server version info
		if (!isset($info_array['Version URI'])) return false;
		$versions_url = $info_array['Version URI'];
		if (@file_get_contents($versions_url) === false) return false;
		$check_versions_data = file_get_contents($versions_url);
		$boost_versions = json_decode($check_versions_data);

		//check for match
		for ($i = 0; $i < count($boost_versions->versions->themes); $i++) {  
			if ($boost_versions->versions->themes[$i]->{'Theme Name'} == $info_array['Theme Name']) {
				//update transient
				$new_transient_data = array(
					"current_version" => $info_array['Version'],
					"latest_version" => $boost_versions->versions->themes[$i]->Version,
					"message" =>$boost_versions->versions->themes[$i]->Message
				);
				set_transient('inspire_version_info', $new_transient_data, 1 * WEEK_IN_SECONDS);
			}
		}
	}

	function boost_display_update_notice() {
		$inspire_version_info = get_transient('inspire_version_info');
		 echo '	<div class="updated">
       				<p>' . $inspire_version_info['message'] .'</p>
   				</div>';
	}
		
