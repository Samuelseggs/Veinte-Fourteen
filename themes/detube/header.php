<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package deTube
 * @subpackage Template
 * @since deTube 1.0
 */
?><!DOCTYPE html>
<!--[if IE 6]><html class="ie ie6 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 7]><html class="ie ie7 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html class="ie ie8 oldie" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 9]><html class="ie ie9" <?php language_attributes(); ?>><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<!-- Meta Tags -->
<meta charset="<?php bloginfo('charset'); ?>" />
<?php 
	$viewport = 'width=device-width';
	if(get_option('dp_responsive')){ 
		$viewport .= ', initial-scale=1, maximum-scale=1'; 
	} 
?>
<meta name="viewport" content="<?php echo $viewport; ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

<!-- Title, Keywords and Description -->
<title><?php wp_title( '|', true, 'right' ); ?></title>
<?php dp_meta_keywords(); ?>
<?php dp_meta_description(); ?>

<link rel="profile" href="http://gmpg.org/xfn/11" />
<?php if($favicon = get_option('dp_favicon')) echo '<link rel="shortcut icon" href="'.$favicon.'" />'."\n"; ?>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
<?php
// Generate CSS Style based on user's settings on Theme Options page
$css = '';

$bgpat = get_option('dp_bgpat');
$bgcolor = get_option('dp_bgcolor');
if($bgpat) {
	$preset_bgpat = get_option('dp_preset_bgpat');
	$custom_bgpat = get_option('dp_custom_bgpat'); 
	$bgpat = !empty($custom_bgpat) ? $custom_bgpat : $preset_bgpat;
	$bgpat = $bgpat ? 'url("'.$bgpat.'")' : '';
	$bgpat = apply_filters('dp_bgpat', $bgpat);
	
	$bgrep = get_option('dp_bgrep');
	$bgatt = get_option('dp_bgatt');
	$bgfull = get_option('dp_bgfull');
	$bgpos = 'center top';
	$bgsize = '';
	if($bgfull) {
		$bgrep = 'no-repeat';
		$bgatt = 'fixed';
		$bgsize .= '-webkit-background-size: cover;
			-moz-background-size: cover;
			-o-background-size: cover;
			background-size: cover;';
	}

	$css .= "body{background:".implode(' ', array_filter(array($bgcolor,$bgpat,$bgrep,$bgpos,$bgatt))).";".$bgsize."}\n";
} else {
	$css .= 'body{background:'.$bgcolor.'}';
}

$info_toggle = (int)get_option('dp_info_toggle');
if(!empty($info_toggle))
	$css .= '.info-less{height:'.$info_toggle.'px;}';

if(!empty($css)) {
	echo "\n<!-- Generated CSS BEGIN -->\n<style type='text/css'>\n";
	echo $css;
	echo "\n</style>\n<!-- Generated CSS END -->\n";
}
?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-38456714-2', 'frontburnr.net');
  ga('send', 'pageview');

</script>

</head>

<body <?php body_class(); ?>>

<!-- Start Alexa Certify Javascript -->
<script type="text/javascript">
_atrk_opts = { atrk_acct:"wYEfh1aMQV002q", domain:"frontburnr.net",dynamic: true};
(function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
</script>
<noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=wYEfh1aMQV002q" style="display:none" height="1" width="1" alt="" /></noscript>
<!-- End Alexa Certify Javascript -->


<div id="page">

<header id="header"><div class="wrap cf">
	<div id="branding" class="<?php echo get_option('dp_logo_type', 'text'); ?>-branding" role="banner">
		<?php if(is_front_page()) { ?>
			<h1 id="site-title"><a rel="home" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<?php } else { ?>
			<div id="site-title"><a rel="home" href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ); ?></a></div>
		<?php } ?>
		
		<?php if (get_option('dp_logo_type') == 'image' && $logo = get_option('dp_logo')) { ?>
			<a id="site-logo" rel="home" href="<?php echo home_url(); ?>"><img src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>"/></a>
		<?php } ?>
		
		<?php if(is_front_page()) { ?>
			<h2 id="site-description"<?php if(!get_option('dp_site_description')) echo ' class="hidden"'; ?>><?php bloginfo('description'); ?></h2>
		<?php } else { ?>
			<div id="site-description"<?php if(!get_option('dp_site_description')) echo ' class="hidden"'; ?>><?php bloginfo('description'); ?></div>
		<?php } ?>
	</div><!-- end #branding -->
	
	<div id="header-actions" class="cf">
		<?php dp_account_button(); ?>
		<?php dp_signup_button(); ?>
		<?php dp_login_button(); ?>
		<?php dp_likes_page_button(); ?>
	</div><!-- end #header-actions -->
	
	<?php 
	// Search Box
	if(get_option('dp_header_search')) { ?>
	<div id="header-search">
		<?php get_search_form(); ?>
	</div><!-- end #header-search -->
	<?php } ?>
	
</div></header><!-- end #header-->

<div id="main-nav"><div class="wrap cf">

	<?php 
		$nav_menu = wp_nav_menu(array('theme_location'=>'main', 'container'=>'', 'fallback_cb' => '', 'echo' => 0)); 
		
		// The fallback menu
		if(empty($nav_menu)) {
			$nav_menu = '<ul class="menu">';
			$nav_menu .= '<li><a rel="home" href="'.home_url().'">'.__('Home', 'dp').'</a></li>';
			$nav_menu .= wp_list_categories(array('title_li'=>'', 'echo'=>0));
			$nav_menu .= '</ul>';
		}
		echo $nav_menu;
	?>
</div></div><!-- end #main-nav -->

<?php do_action( 'dp_after_header_php' ); ?>
