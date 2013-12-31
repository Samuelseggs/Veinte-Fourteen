<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<?php global $data; ?>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
<?php if ( of_get_option('favicon') ) { echo '<link rel="shortcut icon" href="'.of_get_option('favicon').'"/>'."\n"; } ?>
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<?php 
	$body_font = (of_get_option('body_font', 'Open+Sans') == 'Open+Sans' ? ':400,400italic,300italic,300,700,700italic' : '');
	$heading_font = (of_get_option('heading_font', 'Open+Sans+Condensed') == 'Open+Sans+Condensed' ? ':300,700' : '');
?>
<link href='http://fonts.googleapis.com/css?family=<?php echo of_get_option('body_font', 'Open+Sans') . $body_font; ?>|<?php echo of_get_option('heading_font', 'Open+Sans+Condensed') . $heading_font; ?>' rel='stylesheet' type='text/css'>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_enqueue_script('jquery'); ?>
<?php 
if ( is_singular() && get_option( 'thread_comments' ) )
wp_enqueue_script( 'comment-reply' );
wp_head(); 
?>

<?php if(!is_singular( 'fullscreen' ) ) {  ?>
	<?php $main_bg = of_get_option('main_bg');
	$main_bg_preset = of_get_option('main_bg_preset');
	$images = rwmb_meta( 'rw_background', 'type=image&size=full' );
	$bgimagepath = IMAGES . "/bg/";  ?>
					
	<?php if ($images) {  ?>
	<!-- Post BG -->
		<?php foreach ( $images as $image )	{
			echo "<script type='text/javascript'>$.backstretch('{$image['url']}');</script>";
			break;
		} ?>
	<?php } elseif ($main_bg) { ?>
	<!-- Options Uploaded BG -->
		<script type="text/javascript">
			$.backstretch("<?php echo "$main_bg"; ?>");
		</script>
	<?php } elseif ($main_bg_preset) { ?>
	<!-- Options Preset BG -->
		<script type="text/javascript">
			$.backstretch("<?php echo "$bgimagepath" . "$main_bg_preset"; ?>");
		</script>
	<?php } else { ?>
	<!-- Default -->
		<script type="text/javascript">
			$.backstretch("<?php echo get_template_directory_uri(); ?>/style/images/bg/1.jpg");
		</script>
	<?php } ?>
<?php } ?>

<?php if ( function_exists( 'wp_nav_menu' ) ) {  ?>
<script type="text/javascript">
    ddsmoothmenu.init({
	mainmenuid: "menu",
	orientation: 'h',
	classname: 'menu',
	contentsource: "markup"
})
</script>
<?php } ?>
</head>

<body <?php body_class(); ?>>
<div class="scanlines"></div>

<!-- Begin Header -->
<div class="header-wrapper opacity">
	<div class="header">
		<!-- Begin Logo -->
		<div class="logo">
		    <a href="<?php echo home_url(); ?>">
				<?php if ( of_get_option('logo') ) { ?>
					<img src="<?php echo of_get_option('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>" />
				<?php } else {?>
					<h1 class="blog-title"><?php bloginfo( 'name' ); ?></h1>
				<?php } ?>
			</a>
	    </div>
		<!-- End Logo -->
		<!-- Begin Menu -->
		<div id="menu-wrapper"><?php elemis_nav(); ?></div>
		<div class="clear"></div>
		<!-- End Menu -->
	</div>
</div>
<!-- End Header -->

<!-- Begin Wrapper -->
<div class="wrapper">