<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="initial-scale=1.0">

<title><?php if (is_home() || is_front_page()) { echo bloginfo('name'); } else { echo wp_title(''); } ?></title>
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php echo bloginfo('rss2_url'); ?>">

<!-- wp_header -->
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

<!-- BEGIN THEME CUSTOMIZATION (in WP backend) -->
<?php get_template_part('includes/customization'); ?>
<!-- END THEME CUSTOMIZATION (in WP backend) -->

<!-- BEGIN MENU BAR -->
<div id="header-wrapper">

	<!-- BEGIN MENU BUTTON -->
	<div class="menu-button">
		<?php if ( get_theme_mod( 'bonfire_logo' ) ) : ?>

			<!-- BEGIN LOGO IMAGE -->
			<div class="site-logo-image">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><img src="<?php echo get_theme_mod( 'bonfire_logo' ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a>
			</div>
			<!-- END LOGO IMAGE -->

		<?php else : ?>

			<!-- BEGIN SITE NAME -->
			<div class="site-logo"><?php bloginfo('name'); ?></div>
			<!-- END SITE NAME -->

		<?php endif; ?>
	</div>
	<!-- END MENU BUTTON -->


	<!-- BEGIN ICON MENU -->
	<?php wp_nav_menu( array( 'container_class' => 'bonfire-icon-menu', 'theme_location' => 'bonfire-icon-menu' ) ); ?>
	<!-- END ICON MENU -->


	<!-- BEGIN SEARCH BUTTON + SEARCH FORM -->
		<!-- BEGIN SEARCH BUTTON --><div id="header-search"><i class="icon-search"></i></div><!-- END SEARCH BUTTON -->
		<!-- BEGIN SEARCH FORM --><?php get_search_form(); ?><!-- END SEARCH FORM -->
	<!-- END SEARCH BUTTON + SEARCH FORM -->

</div>
<!-- END MENU BAR -->

<!-- BEGIN ACCORDION MENU -->
<div id="menu">
	<?php wp_nav_menu( array( 'container_class' => 'menu01', 'theme_location' => 'bonfire-main-menu' ) ); ?>
</div>
<!-- END ACCORDION MENU -->


<div id="sitewrap">

	<div id="body" class="pagewidth clearfix">
