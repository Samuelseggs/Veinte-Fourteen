<?php

function of_head_css() {

$output = '';

if ($centered_header = of_get_option('centered_header') ) {
	$output .= ".logo { float: none; text-align: center; }
.logo img { display: inline; }
#menu-wrapper .menu { float:none; }
#menu-wrapper .menu ul { text-align:center; }
#menu-wrapper .menu ul ul { text-align:left; }
#menu-wrapper .menu ul li { display:inline-block;float:none; }
#menu-wrapper .menu ul li ul { padding: 35px 0 0 0; }\n";
}

if ($text_color = of_get_option('text_color') ) {
	$output .= "body, 
input, 
textarea,
.widget ul.post-list,
.widget ul.post-list li h6 a,
.sidebox a,
#comments .reply-link,
#footer a,
.site-generator a  {color:" . $text_color .";}
div.dpSocialTimeline .dpSocialTimeline_item {color:" . $text_color ." !important;}\n";
}

if ($heading_color = of_get_option('heading_color') ) {
	$output .= "h1, h2, h3, h4, h5, h6,
h1.title a,
h2.title a,
#navigation a,
#comments .info h2 a,
.toggle h4.title,
ul.tabs li a,
#menu-wrapper .menu ul li a,
#menu-wrapper .menu ul li.active li a, 
#menu-wrapper .menu ul li.current-menu-ancestor li a,
#menu-wrapper .menu ul li.current-menu-item li a {color:" . $heading_color .";}
.dpSocialTimeline_filter button {color:" . $heading_color ." !important;}\n";
}

if ($link_color = of_get_option('link_color') ) {
	$output .= "a, .lite1 {color:" . $link_color .";}
	.lite1, .lite2 {border-bottom: 1px dotted " . $link_color .";}
	div.dpSocialTimeline .dpSocialTimeline_item a {color:" . $link_color ." !important;}\n";
}

if ($hover_color = of_get_option('hover_color') ) {
	$output .= "a:hover,
.title a:hover,
#navigation a:hover,
#menu-wrapper .menu ul li.active a, 
#menu-wrapper .menu ul li a:hover, 
#menu-wrapper .menu ul li.current-menu-ancestor a,
#menu-wrapper .menu ul li.current-menu-ancestor ul li a:hover,
#menu-wrapper .menu ul li.current-menu-item a,
#menu-wrapper .menu ul li ul li a:hover,
.post .details a:hover,
.post-nav a:hover,
.widget ul.post-list li h6 a:hover,
.sidebox a:hover,
#comments .info a:hover,
#comments a:hover,
#footer a:hover,
.site-generator a:hover,
#footer .post-list a:hover,
.toggle h4.title.active,
ul.tabs li a:hover,
ul.tabs li a.current {color:" . $hover_color .";}
.dpSocialTimeline_filter button:hover,
div.dpSocialTimeline .dpSocialTimeline_item div.dpSocialTimelineContentFoot a:hover,
div.dpSocialTimeline .dpSocialTimeline_item a:hover,
.widget .entry-meta a:hover {color:" . $hover_color ." !important;}\n";
}

if ($intro_color = of_get_option('intro_color') ) {
	$output .= ".intro {color:" . $intro_color .";}\n";
}

if ($meta_color = of_get_option('meta_color') ) {
	$output .= ".post .details,
.post .details a,
.post .details .likes a.done:hover,
.post-nav a,
.widget ul.post-list li em,
#comments .info .meta,
blockquote cite,
.widget .entry-meta,
.widget .entry-meta a {color:" . $meta_color .";}
div.dpSocialTimeline .dpSocialTimeline_item span.time,
div.dpSocialTimeline .dpSocialTimeline_item div.dpSocialTimelineContentFoot a,
.widget_twitter .entry-meta,
.widget_twitter .entry-meta a {color:" . $meta_color ." !important;}\n";
}

if ($menu_text_color = of_get_option('menu_text_color') ) {
	$output .= "#menu-wrapper .menu ul li a,
#menu-wrapper .menu ul li.active li a, 
#menu-wrapper .menu ul li.current-menu-ancestor li a,
#menu-wrapper .menu ul li.current-menu-item li a  {color:" . $menu_text_color .";}\n";
}

if ($menu_hover_color = of_get_option('menu_hover_color') ) {
	$output .= "#menu-wrapper .menu ul li.active a, 
#menu-wrapper .menu ul li a:hover, 
#menu-wrapper .menu ul li.current-menu-ancestor a,
#menu-wrapper .menu ul li.current-menu-ancestor ul li a:hover,
#menu-wrapper .menu ul li.current-menu-item a,
#menu-wrapper .menu ul li ul li a:hover  {color:" . $menu_hover_color .";}\n";
}

if ($dd_bg_color = of_get_option('dd_bg_color') ) {
	$output .= "#menu-wrapper .menu ul li ul li  {background-color:" . $dd_bg_color .";}\n";
}

if ($button_text = of_get_option('button_text') ) {
	$output .= "a.button,
.forms fieldset .btn-submit,
#commentform input#submit  {color:" . $button_text .";}\n";
}

if ($button_bg = of_get_option('button_bg') ) {
	$output .= "a.button,
.forms fieldset .btn-submit,
#commentform input#submit  {background-color:" . $button_bg .";}\n";
}

if ($footer_text_color = of_get_option('footer_text_color') ) {
	$output .= "#footer,
#footer a,
#footer input,
.site-generator,
.site-generator a  {color:" . $footer_text_color .";}\n";
}

if ($footer_heading = of_get_option('footer_heading') ) {
	$output .= "#footer h1, #footer h2, #footer h3, #footer h4, #footer h5, #footer h6 {color:" . $footer_heading .";}\n";
}

if ($footer_link = of_get_option('footer_link') ) {
	$output .= "#footer a,
.site-generator a {color:" . $footer_link .";}\n";
}

if ($footer_meta = of_get_option('footer_meta') ) {
	$output .= "#footer .widget ul.post-list li em {color:" . $footer_meta .";}
.widget_twitter .entry-meta,
.widget_twitter .entry-meta a {color:" . $footer_meta ." !important;}\n";
}

if ($footer_hover = of_get_option('footer_hover') ) {
	$output .= "#footer a:hover,
.site-generator a:hover,
#footer .post-list a:hover {color:" . $footer_hover .";}
.widget .entry-meta a:hover {color:" . $footer_hover ." !important;}\n";
}

if ($tile_opacity = of_get_option('tile_opacity') ) {
	$output .= ".scanlines {opacity: " . $tile_opacity .";}\n";
}

if ($header_opacity = of_get_option('header_opacity') ) {
	$output .= ".header-wrapper {background-color: rgba(0, 0, 0, 0." . $header_opacity .");}\n";
}

if ($footer_opacity = of_get_option('footer_opacity') ) {
	$output .= ".footer-wrapper, #thumb-tray {background-color: rgba(0, 0, 0, 0." . $footer_opacity .");}\n";
}

if ($gen_opacity = of_get_option('gen_opacity') ) {
	$output .= ".site-generator-wrapper {background-color: rgba(0, 0, 0, 0." . $gen_opacity .");}\n";
}

if ($tt_opacity = of_get_option('tt_opacity') ) {
	$output .= ".toggle h4.title,
.togglebox,
ul.tabs li a.current,
.panes {background-color: rgba(0, 0, 0, 0." . $tt_opacity .");}\n";
}

if ($tt_active_opacity = of_get_option('tt_active_opacity') ) {
	$output .= "ul.tabs li a,
.toggle h4.title.active {background-color: rgba(0, 0, 0, 0." . $tt_active_opacity .");}\n";
}

if ($box_opacity = of_get_option('box_opacity') ) {
	$output .= "#navigation,
.box,
.gallery-wrapper,
.main-image {background-color: rgba(0, 0, 0, 0." . $box_opacity .");}
.dpSocialTimeline_filter,
div.dpSocialTimeline .dpSocialTimeline_item {background: rgba(0, 0, 0, 0." . $box_opacity .") !important;}\n";
}

if ($body_size = of_get_option('body_size') ) {
	$output .= "body,
input, 
textarea,
.widget ul.post-list li h6 {font-size:" . $body_size ."; }
div.dpSocialTimeline .dpSocialTimeline_item div.dpSocialTimelineContent {font-size:" . $body_size ." !important; }\n";
}

if ($body_line = of_get_option('body_line') ) {
	$output .= "body,
input, 
textarea,
.widget ul.post-list li h6 {line-height:" . $body_line ."; }
div.dpSocialTimeline .dpSocialTimeline_item div.dpSocialTimelineContent {line-height:" . $body_line ." !important; }\n";
}

if ($meta_size = of_get_option('meta_size') ) {
	$output .= ".post .details,
.post-nav,
.widget ul.post-list li em,
#comments .info .meta,
#comments .reply-link,
.widget_twitter .entry-meta {font-size:" . $meta_size ."; }\n";
}

if ($intro_size = of_get_option('intro_size') ) {
	$output .= ".intro {font-size:" . $intro_size ."; }\n";
}

if ($intro_line = of_get_option('intro_line') ) {
	$output .= ".intro {line-height:" . $intro_line ."; }\n";
}

if ($menu_size = of_get_option('menu_size') ) {
	$output .= "#menu-wrapper .menu ul li a {font-size:" . $menu_size ."; }\n";
}

if ($dd_size = of_get_option('dd_size') ) {
	$output .= "#menu-wrapper .menu ul li ul li a {font-size:" . $dd_size ."; }\n";
}

if ($italic_intro = of_get_option('italic_intro') ) {
	$output .= ".intro, blockquote { font-style: italic; }\n";
}

if ($bold_heading = of_get_option('bold_heading') ) {
	$output .= "a.button,
.forms fieldset .btn-submit,
#commentform input#submit,
h1, h2, h3, h4, h5, h6,
#navigation a,
.dropcap,
#menu-wrapper .menu ul li a,
a#cancel-comment-reply-link,
ul.tabs li a { font-weight: bold; }
.dpSocialTimeline_filter button { font-weight: bold !important; }\n";
}

if ($heading_font = of_get_option('heading_font') ) {
$heading_font_name = str_replace('+', ' ', $heading_font);
$output .= "a.button,
.forms fieldset .btn-submit,
#commentform input#submit,
h1, h2, h3, h4, h5, h6,
#navigation a,
.dropcap,
#menu-wrapper .menu ul li a,
a#cancel-comment-reply-link,
ul.tabs li a {font-family:" . $heading_font_name ."; }
.dpSocialTimeline_filter button {font-family:" . $heading_font_name ." !important; }\n";
}

if ($body_font = of_get_option('body_font') ) {
$body_font_name = str_replace('+', ' ', $body_font);
$output .= "body,
input, 
textarea,
.widget ul.post-list li h6 {font-family:" . $body_font_name ."; }
div.dpSocialTimeline {font-family:" . $body_font_name ." !important; }\n";
}

if ($heading1 = of_get_option('heading1') ) {
	$output .= "h1 {\n     font-size:" . $heading1['size'] . "; \n";
	$output .= "     line-height:" . $heading1['line'] . "; \n";
	$output .= "}\n";
}

if ($heading2 = of_get_option('heading2') ) {
	$output .= "h2 {\n     font-size:" . $heading2['size'] . "; \n";
	$output .= "     line-height:" . $heading2['line'] . "; \n";
	$output .= "}\n";
}

if ($heading3 = of_get_option('heading3') ) {
	$output .= "h3 {\n     font-size:" . $heading3['size'] . "; \n";
	$output .= "     line-height:" . $heading3['line'] . "; \n";
	$output .= "}\n";
}

if ($heading4 = of_get_option('heading4') ) {
	$output .= "h4 {\n     font-size:" . $heading4['size'] . "; \n";
	$output .= "     line-height:" . $heading4['line'] . "; \n";
	$output .= "}\n";
}

if ($heading5 = of_get_option('heading5') ) {
	$output .= "h5, h2.title, .sidebox h3, #footer h3, #comments .info h2 {\n     font-size:" . $heading5['size'] . "; \n";
	$output .= "     line-height:" . $heading5['line'] . "; \n";
	$output .= "}\n";
}

if ($heading6 = of_get_option('heading6') ) {
	$output .= "h6, #navigation a, .toggle h4.title, ul.tabs li a {\n     font-size:" . $heading6['size'] . "; \n";
	$output .= "     line-height:" . $heading6['line'] . "; \n";
	$output .= "}\n";
	$output .= ".dpSocialTimeline_filter button {font-size:" . $heading6['size'] . " !important; }\n";
}

$custom_css = of_get_option('custom_css');
		
		if ($custom_css <> '') {
			$output .= $custom_css . "\n";
		}
		
// Output styles
if ($output <> '') {
	$output = "<!-- Custom Styling -->\n<style type=\"text/css\">\n" . $output . "</style>\n";
	echo $output;
}
	
}
add_action('wp_head', 'of_head_css');
?>