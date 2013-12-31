<?php get_header(); ?>

<!-- Begin Intro -->
<div class="intro"><?php _e( 'Page Not Found', 'elemis' ) ?></div>
<?php include (TEMPLATEPATH . '/social.php'); ?>
<!-- End Intro --> 

<!-- Begin Content -->
<div class="box">
	<h1 class="page-title"><?php _e('404 Error', 'elemis') ?></h1>
	<p><?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help.', 'elemis' ) ?></p>
	<?php get_search_form(); ?>
	<script type="text/javascript">
	document.getElementById('s') && document.getElementById('s').focus();
	</script> 
</div>
<!-- End Container -->

<?php get_footer(); ?>
