<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">

	<title><?php wp_title('—', true, 'right'); ?></title>

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<div id="fb-root"></div>

	<div id="wrapper">

		<!-- header -->
		<header id="header">
			<div class="header__left"><!--
				--><a class="site-title" rel="home" href="<?php echo home_url('/'); ?>">
					<img class="logo-desktop" src="<?php echo esc_url( get_iron_option('header_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
					<img class="logo-mobile" src="<?php echo esc_url( get_iron_option('header_logo_mobile') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				</a><!--
				--><strong class="site-description"><?php bloginfo('description'); ?></strong><!--
			--></div>
<?php
	$header_quote = get_iron_option('header_blockquote');
	if ( ! empty($header_quote['quote']) || ! empty($header_quote['author']) ) :
?>
			<figure class="blockquote-box">
<?php
		if ( ! empty($header_quote['quote']) ) :
?>
					<blockquote><?php echo $header_quote['quote']; ?></blockquote>
<?php
		endif;

		if ( ! empty($header_quote['author']) ) :
?>
					<figcaption><?php echo $header_quote['author']; ?></figcaption>
<?php
		endif;
?>
			</figure>
<?php
	endif;
?>
		</header>

		<!-- panel -->
		<div class="panel">
			<a class="opener" href="#"><i class="icon-reorder"></i> <?php _e("Menu", IRON_TEXT_DOMAIN); ?></a>

			<!-- nav-holder -->
			<div class="nav-holder">

				<!-- nav -->
				<nav id="nav">
<?php if ( get_iron_option('header_menu_logo_icon') ) : ?>
					<a class="logo-panel" href="<?php echo home_url('/'); ?>">
						<img src="<?php echo esc_url( get_iron_option('header_menu_logo_icon') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
					</a>
<?php endif; ?>
					<?php echo preg_replace('/>\s+</S', '><', wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu', 'echo' => false ) )); ?>
				</nav>

<?php get_template_part('parts/networks'); ?>
			</div>
		</div>