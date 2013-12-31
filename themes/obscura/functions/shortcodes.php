<?php 

function fix_shortcodes($content){   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'fix_shortcodes');
	
/**
 * Image
 */
function image_shortcode($atts) {
	extract(shortcode_atts(array(	
		"url" => "",
		"img" => "",
		"alt" => "",
		"align" => "",
		"frame" => "false"
	), $atts));
	
	if ( $img == '' )
		return NULL;
		
	if( $url != '' ) {
		$output = "";
		$output  .=  "\n" . '<div class="frame"><a href="' . $url . '" title="' . $alt . '"><img src="' . $img . '" alt="' . $alt . '" title="' . $alt . '"/></a></div>';
	} else {
		$output = "";
		$output  .=  "\n" . '<div class="outer ' . $align . '"><span class="inset"><img src="' . $img . '" alt="' . $alt . '" title="' . $alt . '" /></span></div>';
	}
	
	return $output;
}
add_shortcode('image', 'image_shortcode');

/** Button */
add_shortcode( 'button', 'button_shortcode' );
function button_shortcode( $atts, $content = null ) {
    extract( shortcode_atts( array( 
    "url" => '', 
    "color" => '',
	"text_color" => '',
	"preset" => '',
	"target" => '',
    "blank" => 'false'
    ), $atts ) );
    
    if( $blank == 'true' )
		$target = 'target="_blank"';
    
    $backgroundColor = $color != '' ? ' background-color:#' . $color . ';' : '' ;
	$textColor = $text_color != '' ? ' color:#' . $text_color . ';' : '' ;
	$style = $backgroundColor.$textColor != '' ? ' style="'.$backgroundColor.$textColor.'"' : '' ;
	
	return '<a href="' . $url . '" class="button '.$preset.'" '.$style.' ' . $target . '>' . do_shortcode($content) . '</a>';
    
}

/** Vimeo */
add_shortcode( 'vimeo_video', 'vimeo_shortcode' );
function vimeo_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 
    "id" => '', 
    "height" => '280',
    "width" => '500'
    ), $atts ) );
    return '<div class="media"><iframe src="http://player.vimeo.com/video/' . $id . '?title=0&amp;byline=0&amp;portrait=0" width="' . $width . '" height="' . $height . '" frameborder="0"></iframe></div>';
}

/** YouTube */
add_shortcode( 'youtube_video', 'youtube_shortcode' );
function youtube_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 
    "id" => '', 
    "height" => '280',
    "width" => '500'
    ), $atts ) );
    return '<div class="media"><iframe width="' . $width . '" height="' . $height . '" src="http://www.youtube.com/embed/' . $id . '?rel=0" frameborder="0" allowfullscreen></iframe></div>';
}

/**
 * Video
 */
function video_shortcode( $atts, $content = null ) {
   return '<div class="video"> 
    	' . do_shortcode($content) . '
</div>';
}
add_shortcode('video', 'video_shortcode');



/** Info */
function info_box_shortcode($atts, $content = null) {	
	return '<div class="info-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('info_box', 'info_box_shortcode');

/** Warning */
function warning_box_shortcode($atts, $content = null) {	
	return '<div class="warning-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('warning_box', 'warning_box_shortcode');


/** Note */
function note_box_shortcode($atts, $content = null) {	
	return '<div class="note-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('note_box', 'note_box_shortcode');


/** Download */
function download_box_shortcode($atts, $content = null) {	
	return '<div class="download-box">' . do_shortcode($content) . '</div>';
}
add_shortcode('download_box', 'download_box_shortcode');


/** Br */
function br_shortcode( $atts, $content = null ) {
   return '<br />';
}
add_shortcode('br', 'br_shortcode');

/** Divider */
function divider_shortcode( $atts, $content = null ) {
   return '<div class="divider"></div>';
}
add_shortcode('divider', 'divider_shortcode');

/** Clear */
function clear_shortcode( $atts, $content = null ) {
   return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear_shortcode');


/** 2 Columns */
function col2_shortcode( $atts, $content = null ) {
   return '<div class="one-half">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col2', 'col2_shortcode');

/** 2 Columns Last */
add_shortcode( 'col2_last', 'col2_last_shortcode' );
function col2_last_shortcode( $atts, $content = null ) {
    return '<div class="one-half last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}

/** 3 Columns */
function col3_shortcode( $atts, $content = null ) {
   return '<div class="one-third">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col3', 'col3_shortcode');

/** 3 Columns Last */
add_shortcode( 'col3_last', 'col3_last_shortcode' );
function col3_last_shortcode( $atts, $content = null ) {
    return '<div class="one-third last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}

/** 4 Columns */
function col4_shortcode( $atts, $content = null ) {
   return '<div class="one-fourth">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col4', 'col4_shortcode');



/** 4 Columns Last */
add_shortcode( 'col4_last', 'col4_last_shortcode' );
function col4_last_shortcode( $atts, $content = null ) {
    return '<div class="one-fourth last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}

/** 5 Columns */
function col5_shortcode( $atts, $content = null ) {
   return '<div class="one-fifth">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col5', 'col5_shortcode');

/** 5 Columns Last */
add_shortcode( 'col5_last', 'col5_last_shortcode' );
function col5_last_shortcode( $atts, $content = null ) {
    return '<div class="one-fifth last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}

/** 6 Columns */
function col6_shortcode( $atts, $content = null ) {
   return '<div class="one-sixth">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col6', 'col6_shortcode');

/** 6 Columns Last */
add_shortcode( 'col6_last', 'col6_last_shortcode' );
function col6_last_shortcode( $atts, $content = null ) {
    return '<div class="one-sixth last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}

/** One-Third Columns */
function col1_3_shortcode( $atts, $content = null ) {
   return '<div class="one-third">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col1_3', 'col1_3_shortcode');

/** One-Third Columns Last */
function col1_3_last_shortcode( $atts, $content = null ) {
   return '<div class="one-third last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('col1_3_last', 'col1_3_last_shortcode');


/** Two-Third Columns */
function col2_3_shortcode( $atts, $content = null ) {
   return '<div class="two-third">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col2_3', 'col2_3_shortcode');

/** Two-Third Columns Last */
function col2_3_last_shortcode( $atts, $content = null ) {
   return '<div class="two-third last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('col2_3_last', 'col2_3_last_shortcode');

/** One-Fourth Columns */
function col1_4_shortcode( $atts, $content = null ) {
   return '<div class="one-fourth">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col1_4', 'col1_4_shortcode');

/** One-Fourth Columns Last */
function col1_4_last_shortcode( $atts, $content = null ) {
   return '<div class="one-fourth last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('col1_4_last', 'col1_4_last_shortcode');

/** Three-Fourth Columns */
function col3_4_shortcode( $atts, $content = null ) {
   return '<div class="three-fourth">'."\n\n" . do_shortcode($content) . '</div>';
}
add_shortcode('col3_4', 'col3_4_shortcode');

/** Three-Fourth Columns Last */
function col3_4_last_shortcode( $atts, $content = null ) {
   return '<div class="three-fourth last">'."\n\n" . do_shortcode($content) . '</div><div class="clear"></div>';
}
add_shortcode('col3_4_last', 'col3_4_last_shortcode');


/**
 * Dropcap
 */
function dropcap_shortcode($atts, $content = null) {	
	return '<span class="dropcap">' . do_shortcode($content) . '</span>';
}
add_shortcode('dropcap', 'dropcap_shortcode');


/**
 * Highlight
 */
function lite1_shortcode($atts, $content = null) {	
	return '<span class="lite1">' . do_shortcode($content) . '</span>';
}
add_shortcode('lite1', 'lite1_shortcode');

/**
 * Highlight 2
 */
function lite2_shortcode($atts, $content = null) {	
	return '<span class="lite2">' . do_shortcode($content) . '</span>';
}
add_shortcode('lite2', 'lite2_shortcode');

/**
 * hr
 */
function hr_shortcode($atts, $content = null) {	
	return '<div class="clear"></div><hr />';
}
add_shortcode('hr', 'hr_shortcode');


/**
 * Blockquote
 */
function quote_shortcode($atts, $content = null) {	
	return '<blockquote>' . do_shortcode($content) . '</blockquote>';
}
add_shortcode('quote', 'quote_shortcode');

/**
 * Code
 */
function code_shortcode($atts, $content = null) {	
	return '<pre>' . do_shortcode($content) . '</pre>';
}
add_shortcode('code', 'code_shortcode');

/**
 * Tabs
 */
add_shortcode( 'tabgroup', 'etdc_tab_group' );
function etdc_tab_group( $atts, $content ){
$GLOBALS['tab_count'] = 0;

do_shortcode( $content );

if( is_array( $GLOBALS['tabs'] ) ){
foreach( $GLOBALS['tabs'] as $tab ){
$tabs[] = '<li><a class="" href="#">'.$tab['heading'].'</a></li>';
$panes[] = '<div class="pane">'."\n\n".do_shortcode($tab['content']).'</div>';
}
$return = "\n".'<!-- the tabs --><ul class="tabs">'.implode( "\n", $tabs ).'</ul>'."\n".'<!-- tab "panes" --><div class="panes">'.implode( "\n", $panes ).'</div><div class="clear"></div>'."\n";
}
return $return;
}

add_shortcode( 'tab', 'etdc_tab' );
function etdc_tab( $atts, $content ){
extract(shortcode_atts(array(
'heading' => 'Tab %d'
), $atts));

$x = $GLOBALS['tab_count'];
$GLOBALS['tabs'][$x] = array( 'heading' => sprintf( $heading, $GLOBALS['tab_count'] ), 'content' =>  $content );

$GLOBALS['tab_count']++;
}


/**
 * Toggle
 */

function toggle_shortcode( $atts, $content = null ) {
	extract(shortcode_atts(array(
        'heading'      => ''
    ), $atts));
	
	$out = ""; 
	$out .= '<div class="toggle">';
	$out .= '<h4 class="trigger title"><span class="trigger-wrapper">' .$heading. '</span></h4>';
	$out .= '<div class="togglebox"><div>';
	$out .= "\n\n";
	$out .= do_shortcode( $content );
	$out .= '</div></div>';
	$out .= '</div>';
	
   return $out;
}
add_shortcode('toggle', 'toggle_shortcode');

/**
 * Maps
 */
function fn_googleMaps($atts, $content = null) {
   extract(shortcode_atts(array(
      "width" => '695',
      "height" => '250',
      "src" => ''
   ), $atts));
   return '<div class="map"><iframe width="'.$width.'" height="'.$height.'" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="'.$src.'&amp;output=embed"></iframe></div>';
}
add_shortcode("googlemap", "fn_googleMaps");

/**
 * Forms
 */

function forms_shortcode( $atts, $content = null ) {
	
	extract( shortcode_atts( array( 
    "emailto" => '',
	"emailsubject" => '',
	"ip" => '',
	"url" => '',
	"submit" => 'Submit'
    ), $atts ) );
	
	$obfuscatedLink = "";
	for ($i=0; $i<strlen($emailto); $i++){
		$obfuscatedLink .= "&#" . ord($emailto[$i]) . ";";
	}
	
	
	$valid_err = of_get_option('valid_error');
	$valid_mail = of_get_option('valid_email');
	
	$validError = $valid_err == '' ? 'Required' : $valid_err;
	$validEmail = $valid_mail == '' ? 'Enter a valid email' : $valid_mail;
	
	$out = '<div class="form-container"><div class="response"></div>';
	$out .= '<form class="forms" action="'.get_stylesheet_directory_uri().'/admin/form-handler.php" method="post">';
	$out .= '<fieldset><ol>';
	$out .= do_shortcode( $content );
	$out .= '<li class="nocomment"><label for="nocomment">Leave This Field Empty</label><input id="nocomment" value="" name="nocomment" /></li>';
	$out .= '<li class="button-row"><input type="submit" value="'.$submit.'" name="submit" class="btn-submit" /></li>';
	$out .= '</ol>';
	$out .= '<input type="hidden" name="emailto" value="'.$obfuscatedLink.'" />';
	$out .= '<input type="hidden" name="emailsubject" value="'.$emailsubject.'" />';
	$out .= '<input type="hidden" name="v_error" id="v-error" value="'.$validError.'" />';
	$out .= '<input type="hidden" name="v_email" id="v-email" value="'.$validEmail.'" />';
	$out .= '<input type="hidden" name="ip" value="'.$ip.'" />';
	$out .= '<input type="hidden" name="url" value="'.$url.'" />';
	$out .= '</fieldset></form></div>';
	
   return $out;
}
add_shortcode('forms', 'forms_shortcode');

/**
 * Form Item
 */

function form_item_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 
    "input" => '', 
    "label" => '',
    "validation" => '1',
	"emailfrom" => '',
	"required" => '',
	"value" => '',
	"checked" => ''
    ), $atts ) );
	
	$valid = $required == 'true' ? ' required' : '';
	$checked = $checked == 'true' ? ' checked="checked"' : '';
	$name = strtolower(str_replace(" ", "-", $label));
	$validation = $input == 'text-input' ? $validation : '1' ;
	
	switch($validation)
    {
        case '1':
            $valid .= '';
            break;
        case '2':
			$valid .= ' email';
			$name = $emailfrom == true ? 'email' : $name ;
            break;
    }
	
	switch($input)
    {
        case 'text-input':
            $field = '<label>'.$label.'</label><input type="text" name="'.$name.'" value="" class="'.$input.$valid.'" title="" />';
            break;
        case 'password':
            $field = '<label>'.$label.'</label><input type="password" name="'.$name.'" value="" class="'.$input.$valid.'" />';
            break;
        case 'checkbox':
            $field = '<label>'.$label.'</label><input type="checkbox" name="'.$name.'" value="'.$value.'" class="'.$input.$valid.'"'.$checked.' />';
            break;
		case 'radio':
            $field = '<label>'.$label.'</label><input type="radio" name="'.$name.'" value="'.$value.'" class="'.$input.$valid.'"'.$checked.' />';
            break;
		case 'hidden':
            $field = '<input type="hidden" name="'.$name.'" value="" />';
            break;
		case 'text-area':
            $field = '<label>'.$label.'</label><textarea name="'.$name.'" class="'.$input.$valid.'"></textarea>';
            break;
    }
	
	$out = '<li class="form-row '.$input.'-row">';
	$out .= $field;
	$out .= '</li>';
	
   return $out;
}
add_shortcode('form_item', 'form_item_shortcode');

/**
 * Form Select List
 */

function form_select_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 
    "label" => ''
    ), $atts ) );
	
	$name = strtolower(str_replace(" ", "-", $label));
	$label = '<label>'.$label.'</label>';

	switch($selecttype)
    {
        case 'single':
            $field = $label.'<select name="'.$name.'" class="select" title="">';
			$field .= do_shortcode( $content );
			$field .= '</select>';
            break;
        case 'multi':
            $field = $label.'<select name="'.$name.'" class="multi-select" title="" multiple="multiple">';
			$field .= do_shortcode( $content );
			$field .= '</select>';
            break;
		default:
			$field = $label.'<select name="'.$name.'" class="select" title="">';
			$field .= do_shortcode( $content );
			$field .= '</select>';
            break;
    }
	
	$out = '<li class="form-row select-row">';
	$out .= $field;
	$out .= '</li>';
	
   return $out;
}
add_shortcode('form_select', 'form_select_shortcode');

/**
 * Form Select Option
 */

function form_option_shortcode( $atts, $content = null ) {
	extract( shortcode_atts( array( 
    "value" => ''
    ), $atts ) );

	$field = '<option value="'.$value.'">';
	$field .= do_shortcode( $content );
	$field .= '</option>';
	return $field;
}
add_shortcode('form_option', 'form_option_shortcode');

?>