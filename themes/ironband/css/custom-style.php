<?php
header("Content-type: text/css; charset: UTF-8");

$post_id = !empty($_GET["post_id"]) ? intval($_GET["post_id"]) : null;

$xt_styles = new Dynamic_Styles(IRON_TEXT_DOMAIN);

if($post_id) {

	$parents = get_post_ancestors($post_id);

	$background_id = get_field('background', $post_id);
	$background_color = get_field('background_color', $post_id);

	while(empty($background_id) && empty($background_color) && !empty($parents)) {

		$post_id = array_pop($parents);
		$background_id = get_field('background', $post_id);
		$background_color = get_field('background_color', $post_id);
	}

	if(!empty($background_id) || !empty($background_color)) {

		if(!empty($background_id))
			$background_url = wp_get_attachment_image_src( $background_id, 'full' );
		else
			$background_url = 'none';

		$background_repeat = get_field('background_repeat', $post_id);
		$background_size = get_field('background_size', $post_id);
		$background_position = get_field('background_position', $post_id);
		$background_attachment = get_field('background_attachment', $post_id);

		$xt_styles->useOptions(false);

		$background = array(
			'background-image' => $background_url[0],
			'background-repeat' => $background_repeat,
			'background-size' => $background_size,
			'background-position' => $background_position,
			'background-attachment' => $background_attachment,
			'background-color' => $background_color
		);

		$xt_styles->setBackground('body', $background, true);

		$xt_styles->useOptions(true);

	}else{
		$xt_styles->setBackground('body', 'body_background', true);
	}

}else{
	$xt_styles->setBackground('body', 'body_background', true);
}

$xt_styles->setColor('body', 'body_color');
$xt_styles->set('body', 'border-bottom-color', 'footer_bottom_border');

$xt_styles->setColor('body a', 'body_link_color');
$xt_styles->setColor('body a:hover', 'body_hover_link_color');

$xt_styles->setBackground('#header', 'header_background');
$xt_styles->setColor('#header', 'header_color');

$xt_styles->set('#header .blockquote-box figcaption:before', 'color', 'header_color');

$xt_styles->setBackground('a.button, .wpcf7-submit', 'button_background');
$xt_styles->setColor('a.button, .wpcf7-submit', 'button_color');

$xt_styles->setBackground('a.button:hover, .wpcf7-submit:hover', 'button_hover_background');
$xt_styles->setColor('a.button:hover', 'button_hover_color');

//
$xt_styles->setBackground('.heading h1, .container, .subscribe-block', 'content_background', true);


$xt_styles->setBackground('.nav-holder, .panel.fixed-bar', 'menu_background');

$xt_styles->setBackground('.nav-holder #nav div > ul > li > a', 'menu_link_background');
$xt_styles->setColor('.nav-holder #nav div > ul > li > a', 'menu_link_color');

$xt_styles->setBackground('.nav-holder #nav div > ul > li:hover > a, .caroufredsel_wrapper .slide a.hover, .article a.hover', 'menu_link_hover_background');
$xt_styles->setColor('.nav-holder #nav div > ul > li:hover > a, .caroufredsel_wrapper .slide a.hover, .article a.hover', 'menu_link_hover_color');

$xt_styles->setBackground('.nav-holder #nav div > ul > li.current_page_item > a', 'menu_link_active_background');
$xt_styles->setColor('.nav-holder #nav div > ul > li.current_page_item > a', 'menu_link_active_color');

$xt_styles->setBackground('.block .holder, .caroufredsel_wrapper .slide a', 'blocks_background');

$xt_styles->setBackground('.block .holder .title-box, section .heading', 'blocks_header_background');

$xt_styles->setBackground('.carousel .btn-next, .carousel .btn-prev', 'carousel_arrows_background');
$xt_styles->setColor('.carousel .btn-next, .carousel .btn-prev', 'blocks_header_link_color');

$xt_styles->setBackground('.carousel .btn-next.hover, .carousel .btn-prev.hover', 'carousel_arrows_hover_background');

$xt_styles->setColor('.block .holder .title-box a.link, section .heading a', 'blocks_header_link_color');


$xt_styles->setFont('.container h1', 'h1_typography');
$xt_styles->setFont('.container h2', 'h2_typography');
$xt_styles->setFont('.container h3', 'h3_typography');


$xt_styles->render();