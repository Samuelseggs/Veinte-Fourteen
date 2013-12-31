</div>
<!-- End Wrapper -->
	
<!-- Begin Footer -->
<div class="footer-wrapper">
<?php get_sidebar( 'footer' );?>
</div>
<?php if ($footer_text = of_get_option('footer_text') ) { echo '<div class="site-generator-wrapper"><div class="site-generator">'. $footer_text .'</div></div>'."\n"; } ?>
<!-- End Footer --> 

<?php wp_footer(); ?>
</body>
</html>