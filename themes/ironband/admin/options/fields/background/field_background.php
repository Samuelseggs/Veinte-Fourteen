<?php

// require_once(dirname(__FILE__).'/../upload/'.'field_upload.php');
require_once(dirname(__FILE__).'/../select/'.'field_select.php');
require_once(dirname(__FILE__).'/../color/'.'field_color.php');

class Redux_Options_background {

	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since Redux_Options 1.0.0
	 */
	function __construct($field = array(), $value ='', $parent = '') {
		$this->field = $field;
		$this->value = $value;
		$this->args = $parent->args;
		$this->url = $parent->url;
		$this->hide = isset($field['hide']) ? $field['hide'] : array();
	}

	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since Redux_Options 1.0.0
	 */
	function render() {

		$class = (isset($this->field['class'])) ? $this->field['class'] : 'regular-text';

		echo '<table class="redux-background-table"><tr><td>';

		echo '<input type="hidden" id="' . $this->field['id'] . '-file" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][file]" value="' . @$this->value['file'] . '" class="' . $class . '" />';
		echo '<img class="redux-opts-screenshot" id="redux-opts-screenshot-' . $this->field['id'] . '" src="' . @$this->value['file'] . '" />';
		if(@$this->value['file'] == '') {$remove = ' style="display:none;"'; $upload = ''; } else {$remove = ''; $upload = ' style="display:none;"'; }
		echo ' <a data-update="Select File" data-choose="Choose a File" href="javascript:void(0);"class="redux-opts-upload button-secondary"' . $upload . ' rel-id="' . $this->field['id'] . '-file">' . __('Upload', Redux_TEXT_DOMAIN) . '</a>';
		echo ' <a href="javascript:void(0);" class="redux-opts-upload-remove"' . $remove . ' rel-id="' . $this->field['id'] . '-file">' . __('Remove Upload', Redux_TEXT_DOMAIN) . '</a>';

		echo '<br><br>';

		echo '<label>'.__('Upload Background Image', IRON_TEXT_DOMAIN).'</label> ';
		echo (isset($this->field['desc']) && !empty($this->field['desc'])) ? '<br/><span class="description">' . $this->field['desc'] . '</span>' : '';

		echo '</td>';

		echo '<td>';


		$field_id = "repeat";

		if(!in_array($field_id, $this->hide)) {

			$info = "<b>repeat:</b> The background image will be repeated both vertically and horizontally.<br><br>
					 <b>repeat-x:</b> The background image will be repeated only horizontally<br><br>
					 <b>repeat-y:</b> The background image will be repeated only vertically<br><br>
					 <b>no-repeat:</b> The background-image will not be repeated";

			echo '<i class="tooltip icon-info-sign icon-large" title="'.esc_attr($info).'"></i> <label>'.__('Background Repeat', IRON_TEXT_DOMAIN).'</label> ';

			$field = new Redux_Options_select(
			array(
					'id' => $this->field['id'] . '-'.$field_id,
					'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
					'options' => array(
					'' => 'Default',
					'repeat' => 'Repeat',
					'no-repeat' => 'No Repeat',
					'repeat-x' => 'Repeat X',
					'repeat-y' => 'Repeat Y',
					'inherit' => 'Inherit'
					)
				),'' , ''
			);
			$field->value = @$this->value[$field_id];
			$field->render();
			echo '<br><br>';
		}


		$field_id = "size";

		if(!in_array($field_id, $this->hide)) {


			$info = "<b>cover:</b>	Scale the background image to be as large as possible so that the background area is completely covered by the background image. Some parts of the background image may not be in view within the background positioning area<br><br>
					 <b>contain:</b> Scale the image to the largest size such that both its width and its height can fit inside the content area";

			echo '<i class="tooltip icon-info-sign icon-large" title="'.esc_attr($info).'"></i> <label>'.__('Background Size', IRON_TEXT_DOMAIN).'</label> ';


			$field = new Redux_Options_select(
			array(
					'id' => $this->field['id'] . '-'.$field_id,
					'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
					'options' => array(
					'' => 'Default',
					'cover' => 'Cover',
					'contain' => 'Contain',
					'inherit' => 'Inherit'
					)
				),'' , ''
			);
			$field->value = @$this->value[$field_id];
			$field->render();
			echo '<br><br>';
		}

		$field_id = "attachment";

		if(!in_array($field_id, $this->hide)) {


			$info = "<b>scroll:</b> The background image scrolls with the rest of the page<br><br>
					 <b>fixed:</b> The background image is fixed";

			echo '<i class="tooltip icon-info-sign icon-large" title="'.esc_attr($info).'"></i> <label>'.__('Background Attachment', IRON_TEXT_DOMAIN).'</label> ';

			$field = new Redux_Options_select(
			array(
					'id' => $this->field['id'] . '-'.$field_id,
					'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
					'options' => array(
					'' => 'Default',
					'scroll' => 'Scroll',
					'fixed' => 'Fixed',
					'inherit' => 'Inherit'
					)
				),'' , ''
			);
			$field->value = @$this->value[$field_id];
			$field->render();
			echo '<br><br>';
		}


		$field_id = "position";

		if(!in_array($field_id, $this->hide)) {

			$info = "The position property sets the starting position of a background image";

			echo '<i class="tooltip icon-info-sign icon-large" title="'.esc_attr($info).'"></i> <label>'.__('Background Position', IRON_TEXT_DOMAIN).'</label> ';

			$field = new Redux_Options_select(
			array(
					'id' => $this->field['id'] . '-'.$field_id,
					'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
					'options' => array(
					'' => 'Default',
					'left top' => 'left top',
						'left center' => 'left center',
						'left bottom' => 'left bottom',
						'right top' => 'right top',
						'right center' => 'right center',
						'right bottom' => 'right bottom',
						'center top' => 'center top',
						'center center' => 'center center',
						'center bottom' => 'center bottom',
						'inherit' => 'Inherit'
					)
				),'' , ''
			);
			$field->value = @$this->value[$field_id];
			$field->render();
			echo '<br><br>';
		}


		$field_id = "color";

		if(!in_array($field_id, $this->hide)) {

			$info = "The color property sets the background color of an element";

			echo '<i class="tooltip icon-info-sign icon-large" title="'.esc_attr($info).'"></i> <label>'.__('Background Color', IRON_TEXT_DOMAIN).'</label> ';

			$field = new Redux_Options_color(
			array(
					'id' => $this->field['id'] . '-'.$field_id,
					'name' => $this->args['opt_name'] . '[' . $this->field['id'] . ']['.$field_id.']',
					'std' => ''
				),'' , ''
			);
			$field->value = @$this->value[$field_id];
			$field->enqueue();
			$field->render();
		}

		echo '</td></tr></table>';
	}

	/**
	 * Enqueue Function.
	 *
	 * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
	 *
	 * @since Redux_Options 1.0.0
	 */
	function enqueue() {
	// gobal $wp_version; //AP: why doesn't this work?!?!
			$wp_version = floatval(get_bloginfo('version'));

		if ( $wp_version < "3.5" ) {
			wp_enqueue_script(
				'redux-opts-field-upload-js',
				Redux_OPTIONS_URL . 'fields/upload/field_upload_3_4.js',
				array('jquery', 'thickbox', 'media-upload'),
				time(),
				true
			);
			wp_enqueue_style('thickbox');// thanks to https://github.com/rzepak
		} else {
			wp_enqueue_script(
				'redux-opts-field-upload-js',
				Redux_OPTIONS_URL . 'fields/upload/field_upload.js',
				array('jquery'),
				time(),
				true
			);
			wp_enqueue_media();
		}

		wp_enqueue_script('iron-jquery-ui-tooltip', Redux_ASSETS_URL . 'js/jquery.ui.tooltip.min.js', array('jquery-ui-core', 'jquery-ui-widget', 'jquery-ui-position'), '1.10.3', 1);
		wp_enqueue_style('iron-jquery-ui-tooltip', Redux_ASSETS_URL . 'css/jquery-ui-tooltip.min.css', false ,'1.10.3', 'all' );

		wp_localize_script('redux-opts-field-upload-js', 'redux_upload', array('url' => $this->url.'fields/upload/blank.png'));
	}
}
