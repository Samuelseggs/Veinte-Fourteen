<!DOCTYPE HTML>
<html <?php language_attributes(); ?>>

<head>

	<!-- GENERAL -->
	<title><?php bloginfo( 'name' ); ?><?php wp_title( '|' ); ?></title>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=1074">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo get_stylesheet_directory_uri() . '/style.css'; ?>" />

	<!-- OPTIONS -->
	<?php $inspire_options = get_option('inspire_options'); ?>

	<!-- DYNAMIC HEADER TEMPLATE -->
	<?php get_template_part('inc/templates/dynamic_header'); ?>
	
	<!-- WORDPRESS MAIN HEADER CALL -->
	<?php wp_head(); ?>

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

	
	<!-- BEGIN BG WRAPPER -->
	<div id="bg-wrapper">
	
	<!-- BEGIN WRAPPER -->
	<div id="wrapper">
	
		<!-- BEGIN HEADER -->
		<div id="header">
			
			<div id="header-social" <?php if ($inspire_options['social_icons_size'] == 'big') echo 'class="big"'; ?>>

				<?php if (!empty($inspire_options['facebook_url'])) echo '<a href="'. $inspire_options['facebook_url'] .'" class="social facebook" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['twitter_url'])) echo '<a href="'. $inspire_options['twitter_url'] .'" class="social twitter" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['pinterest_url'])) echo '<a href="'. $inspire_options['pinterest_url'] .'" class="social pinterest" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['flickr_url'])) echo '<a href="'. $inspire_options['flickr_url'] .'" class="social flickr" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['tumblr_url'])) echo '<a href="'. $inspire_options['tumblr_url'] .'" class="social tumblr" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['vimeo_url'])) echo '<a href="'. $inspire_options['vimeo_url'] .'" class="social vimeo" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['instagram_url'])) echo '<a href="'. $inspire_options['instagram_url'] .'" class="social instagram" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['google_url'])) echo '<a href="'. $inspire_options['google_url'] .'" class="social google" target="_blank" /></a>'; ?>
				<?php if (!empty($inspire_options['rss_url'])) echo '<a href="'. $inspire_options['rss_url'] .'" class="social rss" target="_blank" /></a>'; ?>

			</div>
			
			<div id="header-search" <?php if ($inspire_options['social_icons_size'] == 'big') echo 'class="big"'; ?>>
				
				<a href="#" class="search-icon"></a>
				
			</div>

			<div id="pop_out_search">

				<?php get_search_form(); ?>
				
			</div>
			
			<div id="logo">
				<?php 
					if (!empty($inspire_options['logo_url'])) {
						echo '<a href="'. home_url() .'"><img src="'. $inspire_options['logo_url'] .'"></a>';
					} else {
						echo '<a href="'. home_url() .'"><img src="'. get_template_directory_uri() .'/images/logo2.png"></a>';
					}
				?>
			</div>

			<!-- MAIN NAVIGATION MENU -->
			<?php wp_nav_menu(array( 
				'theme_location' => 'main_navigation_menu',
				'menu_id' => 'menu',
				'container' => false,
				'show_home' => '1'
				));
			 ?>
			 
			 <select id="navigation_select">
			 </select>

		</div>
		<!-- END HEADER -->
		
