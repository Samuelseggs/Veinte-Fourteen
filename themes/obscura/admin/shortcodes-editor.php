<?php 

/* Include shortcodes.js script for text editor */
function elemis_shortcodes_init() {
if (is_admin()) {
	wp_enqueue_script( 'shortcodes', get_template_directory_uri().'/admin/js/shortcodes.js', array('jquery'));
	wp_enqueue_script( 'color', get_template_directory_uri().'/admin/js/colorpicker.js', array('jquery'));
	wp_enqueue_style( 'shortcodes', get_template_directory_uri().'/admin/css/shortcodes.css');
	add_action('wp_ajax_choice', 'elemis_create_shortcodes');
}
}
add_action('init', 'elemis_shortcodes_init');

/* Add button to editor media nav */
add_action('media_buttons', 'add_shortcodes_media_button', 20);

function add_shortcodes_media_button() {

	echo '<a class="thickbox shortcode-link" href="'.get_option('siteurl').'/wp-admin/admin-ajax.php?action=choice&width=640&height=400" title="Sortcode Generator"><img src="'.get_template_directory_uri().'/admin/images/shortcodes.png" alt="Create Sortcode"></a>';

}

function elemis_create_shortcodes() {

	?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/admin/css/colorpicker.css" type="text/css" />
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/admin/js/colorpicker.js"></script>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/admin/js/shortcodes.js"></script>
	
	<ul class="nav-shortcode-tabs">
	<li><a href="#">Columns</a></li>
	<li><a href="#">Button</a></li>
	<li><a href="#">Image</a></li>
	<li><a href="#">Tabs</a></li>
	<li><a href="#">Toggle</a></li>
	<li><a href="#">Map</a></li>
	<li><a href="#">Forms</a></li>
	<li><a href="#">Others</a></li>
</ul>
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php">
		<h3>Columns</h3>
		<fieldset>
			<p>
				<label for="columns-code" class="row-label"><?php _e('Column Type:', 'elemis') ?></label>
					<select id="columns-code" class="select" name="code">
<option value='col2'>col2</option>
<option value='col2_last'>col2_last</option>
<option value='col3'>col3</option>
<option value='col3_last'>col3_last</option>
<option value='col4'>col4</option>
<option value='col4_last'>col4_last</option>
<option value='col5'>col5</option>
<option value='col5_last'>col5_last</option>
<option value='col6'>col6</option>
<option value='col6_last'>col6_last</option>
<option value='col1_3'>col1_3</option>
<option value='col1_3_last'>col1_3_last</option>
<option value='col2_3'>col2_3</option>
<option value='col2_3_last'>col2_3_last</option>
<option value='col1_4'>col1_4</option>
<option value='col1_4_last'>col1_4_last</option>
<option value='col3_4'>col3_4</option>
<option value='col3_4_last'>col3_4_last</option>
			</select>
		</p>
		<p>
			<label for="columns-content" class="row-label"><?php _e('Content:', 'elemis') ?></label>
			<textarea name="content" id="columns-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Column', 'elemis') ?>"  name="submit" />
		</p>
		
	  </fieldset>
	</form>
</div>
<!-- End Tab 1 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" class="shortcode-form button-short">
		<h3>Button</h3>
		<fieldset>
			<p>
				<label for="ibm-button-content" class="row-label"><?php _e('Button Text:', 'elemis') ?></label>
				<input type="text" value="" name="content" id="ibm-button-content" class="text-input shortcode-content" />
			</p>
			<p>
				<label for="ibm-button-url" class="row-label"><?php _e('URL:', 'elemis') ?></label>
				<input type="text" value="" name="url" id="ibm-button-url" class="text-input" />
			</p>
			<p class="check-row">
				<label for="ibm-button-blank" class="row-label"><?php _e('Blank:', 'elemis') ?></label>
				<input type="checkbox" name="blank" id="ibm-button-blank" class="checkbox" value="true" />
			</p>
			
			<p>
				<label for="ibm-image-preset" class="row-label"><?php _e('Preset:', 'elemis') ?></label>
					<select id="ibm-image-preset" class="select" name="preset">
						<option value=''>None</option>
						<option value='blue'>Blue</option>
						<option value='green'>Green</option>
						<option value='pink'>Pink</option>
						<option value='purple'>Purple</option>
						<option value='red'>Red</option>
						<option value='yellow'>Yellow</option>
					</select>
			</p>
			
			
			<label for="ibm-button-color" class="color-label"><?php _e('Background:', 'elemis') ?></label>
			<div id="button-color"><div style="background-color: #555"></div></div>
			<div id="button-color-holder"></div>
			
			<label for="ibm-button-text-color" class="color-label"><?php _e('Text Color:', 'elemis') ?></label>
			<div id="button-text-color"><div style="background-color: #fff"></div></div>
			<div id="button-text-color-holder"></div>
			

			
			
			<p class="button-row">
				<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Button', 'elemis') ?>"  name="submit" />
			</p>
			<input type="hidden" name="color" id="button-color-input" value="" />
			<input type="hidden" name="text_color" id="button-text-color-input" value="" />
			<input type="hidden" name="code" value="button" />
		</fieldset>
	</form>
	</div>
<!-- End Tab 2 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" class="shortcode-form">
		<h3>Image</h3>
		<fieldset>
			<p class="left">
				<label for="ibm-image-img" class="row-label"><?php _e('Image:', 'elemis') ?></label>
				<input type="text" value="" name="img" id="ibm-image-img" class="text-input required" />
			</p>
			<p class="right">
				<label for="ibm-image-url" class="row-label"><?php _e('URL:', 'elemis') ?></label>
				<input type="text" value="" name="url" id="ibm-image-url" class="text-input" />
			</p>
			<p class="left">
				<label for="ibm-image-alt" class="row-label"><?php _e('Alt:', 'elemis') ?></label>
				<input type="text" value="" name="alt" id="ibm-image-alt" class="text-input" />
			</p>
			<p class="right">
				<label for="ibm-image-align" class="row-label"><?php _e('Align:', 'elemis') ?></label>
					<select id="ibm-image-align" class="select" name="align">
						<option value='none'>None</option>
						<option value='left'>Left</option>
						<option value='right'>Right</option>
					</select>
			</p>
			<p class="right button-row">
				<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Image', 'elemis') ?>"  name="submit" />
			</p>
			<input type="hidden" name="type" value="single" />
			<input type="hidden" name="code" value="image" />
		</fieldset>
	</form>
	</div>
<!-- End Tab 2 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" id="form-tabgroup">
	  <h3>Tab Group</h3>
		<fieldset>
		<p>
			<label for="tabs-group-content" class="row-label"><?php _e('Tabs:', 'elemis') ?></label>
			<textarea name="content" id="tabs-group-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary link-create-item" rel="form-tabgroup-tab" value="<?php _e('Add Tab Item', 'elemis') ?>" />
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Tab Group', 'elemis') ?>"  name="submit" />
		</p>
		<input type="hidden" name="code" value="tabgroup" />
	  </fieldset>
	</form>
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" class="helper" id="form-tabgroup-tab">
	  <h3>Tab</h3>
		<fieldset>
			<p>
				<label for="tabs-tab-heading" class="row-label"><?php _e('Heading:', 'elemis') ?></label>
				<input type="text" value="" name="heading" id="tabs-tab-heading" class="required text-input" />
			</p>
		<p>
			<label for="tabs-tab-content" class="row-label"><?php _e('Content:', 'elemis') ?></label>
			<textarea name="content" id="tabs-tab-content" class="text-area content"></textarea>
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Tab', 'elemis') ?>"  name="submit" />
		</p>
		
		<input type="hidden" name="code" value="tab" />
		<input type="hidden" name="form" class="helper-form" value="form-tabgroup" />
	  </fieldset>
	</form>
</div>
<!-- End Tab 3 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" id="form-toggle">
	  <h3>Toggle</h3>
		<fieldset>
			<p>
				<label for="tabs-toggle-heading" class="row-label"><?php _e('Heading:', 'elemis') ?></label>
				<input type="text" value="" name="heading" id="tabs-toggle-heading" class="required text-input" />
			</p>
		<p class="clear">
			<label for="tabs-toggle-content" class="row-label"><?php _e('Content:', 'elemis') ?></label>
			<textarea name="content" id="tabs-toggle-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Toggle', 'elemis') ?>"  name="submit" />
		</p>
		<input type="hidden" name="code" value="toggle" />
	  </fieldset>
	</form>
</div>
<!-- End Tab 3 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" class="shortcode-form">
		<h3>Map</h3>
		<fieldset>
			<p class="left">
				<label for="ibm-map-width" class="row-label"><?php _e('Width:', 'elemis') ?></label>
				<input type="text" value="630" name="width" id="ibm-map-width" class="text-input required" />
			</p>
			<p class="right">
				<label for="ibm-map-height" class="row-label"><?php _e('Height:', 'elemis') ?></label>
				<input type="text" value="350" name="height" id="ibm-map-height" class="text-input required" />
			</p>
			<p class="left">
				<label for="ibm-map-src" class="row-label"><?php _e('Src:', 'elemis') ?></label>
				<input type="text" value="" name="src" id="ibm-map-src" class="text-input" />
			</p>
			<p class="button-row right">
				<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Map', 'elemis') ?>"  name="submit" />
			</p>
			
			<input type="hidden" name="type" value="single" />
			<input type="hidden" name="code" value="googlemap" />
		</fieldset>
	</form>

</div>
<!-- End Tab 8 -->
<!-- Tab 9 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" id="form-forms">
		<h3>Forms</h3>
		<fieldset>
			<p>
			<label for="form-content" class="row-label"><?php _e('Form Items:', 'elemis') ?></label>
			<textarea name="content" id="form-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="left">
		  <label for="form-valid-subject" class="row-label"><?php _e('Email Subject:', 'elemis') ?></label>
		  <input type="text" value="" name="emailsubject" id="form-valid-subject" class="text-input required" />
		</p>
		<p class="right">
				<label for="form-item-submit" class="row-label"><?php _e('Submit Text:', 'elemis') ?></label>
				<input type="text" value="" name="submit" id="form-item-submit" class="text-input required" />
			</p>
		<p class="left">
		  <label for="form-emailto" class="row-label"><?php _e('Email To:', 'elemis') ?></label>
		  <input type="text" value="" name="emailto" id="form-emailto" class="text-input required email" />
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary link-create-item set-1" rel="form-form-item" value="<?php _e('Add Form Input', 'elemis') ?>" />
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Form', 'elemis') ?>"  name="submit" />
		</p>
		<input type="hidden" name="code" value="forms" />
	  </fieldset>
	</form>
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" id="form-form-item" class="helper set-1">
		<h3>Form Item</h3>
		<fieldset>
			<p class="left">
				<label for="form-item-input" class="row-label"><?php _e('Type:', 'elemis') ?></label>
					<select id="form-item-input" class="select" name="input">
						<option value='text-input'>Text Field</option>
						<option value='text-area'>Text Area</option>
					</select>
		</p>
			<p class="right">
				<label for="form-item-label" class="row-label"><?php _e('Label:', 'elemis') ?></label>
				<input type="text" value="" name="label" id="form-item-label" class="text-input required" />
			</p>
			<p class="left check-row">
				<label for="form-item-required" class="row-label"><?php _e('Required:', 'elemis') ?></label>
				<input type="checkbox" name="required" id="form-item-required" class="checkbox" value="true" />
			</p>
			
			<p class="right hide default text-input-form">
				<label for="form-item-validation" class="row-label"><?php _e('Validation:', 'elemis') ?></label>
					<select id="form-item-validation" class="select" style="margin-right: 10px;" name="validation">
						<option value='1'>None</option>
						<option value='2'>Email</option>
					</select>
					
		</p>
		
		
			<p class="left radio-form checkbox-form hidden-form submit-form hide">
				<label for="form-item-value" class="row-label"><?php _e('Value:', 'elemis') ?></label>
				<input type="text" value="" name="value" id="form-item-value" class="text-input" />
		</p>
		<p class="right check-row radio-form checkbox-form hide">
				<label for="form-item-checked" class="row-label"><?php _e('Checked:', 'elemis') ?></label>
				<input type="checkbox" name="checked" id="form-item-checked" class="checkbox" value="true" />
			</p>
			<p class="right button-row">
				<input type="submit" class="button-primary btn-submit" value="<?php _e('Add Form Item', 'elemis') ?>"  name="submit" />
			</p>
			<input type="hidden" name="type" value="single" />
			<input type="hidden" name="code" value="form_item" />
			<input type="hidden" name="form" class="helper-form" value="form-forms" />
		</fieldset>
	</form>
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" id="form-form-select" class="helper set-2">
		<h3>Select Lists</h3>
		<fieldset>
		<p class="clear">
			<label for="form-select-content" class="row-label"><?php _e('Options:', 'elemis') ?></label>
			<textarea name="content" id="form-select-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="left">
				<label for="form-select-label" class="row-label"><?php _e('Label:', 'elemis') ?></label>
				<input type="text" value="" name="label" id="form-select-label" class="text-input required" />
			</p>
		<p class="button-row right">
			<input type="submit" class="button-primary link-create-item" rel="form-select-option" value="<?php _e('Create Option', 'elemis') ?>" />
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert List', 'elemis') ?>"  name="submit" />
		</p>
		<input type="hidden" name="code" value="form_select" />
		<input type="hidden" name="form" class="helper-form" value="form-forms" />
	  </fieldset>
	</form>
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php" id="form-select-option" class="helper set-2">
		<h3>Options</h3>
		<fieldset>
			<p class="left">
				<label for="form-select-option-content" class="row-label"><?php _e('Text:', 'elemis') ?></label>
				<input type="text" value="" name="content" id="form-select-option-content" class="text-input required" />
			</p>
			<p class="right">
				<label for="form-select-option-value" class="row-label"><?php _e('Value:', 'elemis') ?></label>
				<input type="text" value="" name="value" id="form-select-option-value" class="text-input required" />
			</p>
			<p class="button-row">
				<input type="submit" class="button-primary btn-submit" value="<?php _e('Add Option', 'elemis') ?>"  name="submit" />
			</p>
			<input type="hidden" name="code" value="form_option" />
			<input type="hidden" name="form" class="helper-form" value="form-form-select" />
		</fieldset>
	</form>
</div>
<!-- End Tab 9 -->
<div class="shortcode-tab">
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php">
		<h3>Typography</h3>
		<fieldset>
			<p>
				<label for="typography-code" class="row-label"><?php _e('Shortcode:', 'elemis') ?></label>
					<select id="typography-code" class="select" name="code">
						<option value='hr'>Divider</option>
						<option value='clear'>Clear</option>
						<option value='dropcap'>Dropcaps</option>
						<option value='lite1'>Highlight 1</option>
						<option value='lite2'>Highlight 2</option>
					</select>
		</p>
		<p>
			<label for="typography-content" class="row-label"><?php _e('Content:', 'elemis') ?></label>
			<textarea name="content" id="typography-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'elemis') ?>"  name="submit" />
		</p>
		
	  </fieldset>
	</form>
	<form method="post" action="<?php echo get_template_directory_uri(); ?>/admin/shortcodes-handler.php">
		<h3>Boxes</h3>
		<fieldset>
			<p>
				<label for="boxes-code" class="row-label"><?php _e('Shortcode:', 'elemis') ?></label>
					<select id="boxes-code" class="select" name="code">
						<option value='info_box'>Info Box</option>
						<option value='warning_box'>Warning Box</option>
						<option value='note_box'>Note Box</option>
						<option value='download_box'>Download Box</option>
					</select>
		</p>
		<p>
			<label for="box-content" class="row-label"><?php _e('Content:', 'elemis') ?></label>
			<textarea name="content" id="box-content" class="text-area shortcode-content"></textarea>
		</p>
		<p class="button-row">
			<input type="submit" class="button-primary btn-submit" value="<?php _e('Insert Shortcode', 'elemis') ?>"  name="submit" />
		</p>
		
	  </fieldset>
	</form>
</div>
<!-- End Tab 5 -->
	<?php

	exit();
}
?>