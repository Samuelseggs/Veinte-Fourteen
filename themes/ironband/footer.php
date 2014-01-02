		<!-- footer -->
		<footer id="footer">

			<!-- footer-block -->
			<div class="footer-block">
				<a class="footer-logo" href="<?php echo home_url('/'); ?>">
					<img class="logo-desktop" src="<?php echo esc_url( get_iron_option('footer_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
					<img class="logo-mobile" src="<?php echo esc_url( get_iron_option('footer_logo_mobile') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
				</a>

				<!-- links-box -->
				<div class="links-box">
<?php if ( get_iron_option('facebook_page') ) : ?>
					<!-- facebook-box -->
					<div class="facebook-box">
						<div class="fb-like-box" data-href="<?php echo esc_url( get_iron_option('facebook_page') ); ?>"<?php if ( get_iron_option('facebook_appid') ) echo ' data-appid="' . esc_attr( get_iron_option('facebook_appid') ) . '"'; ?> data-width="200" data-colorscheme="dark" data-show-faces="false" data-header="false" data-stream="false" data-show-border="false"></div>
					</div>
<?php endif; ?>

<?php get_template_part('parts/networks'); ?>
				</div>
			</div>

<?php if ( get_iron_option('newsletter_enabled') ) : ?>
			<!-- subscribe-block -->
			<div class="subscribe-block">
				<form action="#">
					<input type="hidden" name="action" value="<?php echo get_iron_option('newsletter_type'); ?>">
					<fieldset>
						<label for="email"><?php _e(get_iron_option('newsletter_label'), IRON_TEXT_DOMAIN); ?></label>
						<div class="box">
							<input type="email" name="email">
							<input type="submit" value="<?php _e(get_iron_option('newsletter_submit_button_label'), IRON_TEXT_DOMAIN); ?>">
							<p class="status"></p>
						</div>
					</fieldset>
				</form>
			</div>
<?php endif; ?>

			<!-- footer-row -->
			<div class="footer-row">
				<?php
	if ( get_iron_option('footer_bottom_logo') ) :
		$output = '<img src="' . esc_url( get_iron_option('footer_bottom_logo') ) . '" alt="">';

		if ( get_iron_option('footer_bottom_link') )
			$output = sprintf('<a target="_blank" href="%s">%s</a>', esc_url( get_iron_option('footer_bottom_link') ), $output);

		echo $output . "\n";
	endif;
				?>
				<div class="text"><?php echo apply_filters('the_content', get_iron_option('footer_copyright') ); ?></div>
			</div>
		</footer>

	</div>

<?php wp_footer(); ?>

</body>
</html>