<?php get_header(); ?>

		<!-- container -->
		<div class="container">
			<!-- single-post -->
			<article class="single-post">
				<h1><?php _e('Page not found', IRON_TEXT_DOMAIN); ?></h1>
				<p><?php _e('Are you lost? The content you were looking for is not here.', IRON_TEXT_DOMAIN); ?></p>
				<p><a href="<?php echo home_url(); ?>"><?php _e('Return to home page', IRON_TEXT_DOMAIN); ?></a></p>
			</article>
		</div>

<?php get_footer(); ?>