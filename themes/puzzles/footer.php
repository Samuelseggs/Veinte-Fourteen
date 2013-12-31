<?php
/**
 * The template for displaying the footer.
 *
 * @package puzzles
 */
?>
    </div><!-- #main -->
	
	<footer id="footer" class="site_footer" role="contentinfo">
		<?php if (get_custom_option('show_sidebar_advert') == 'yes'  ) { ?>
        <div id="advert" class="site_advert">
            <div id="advert_sidebar" class="widget_area sidebar_advert theme_<?php echo get_custom_option('sidebar_advert_theme'); ?>" role="complementary">
                <div id="advert_sidebar_inner">
                    <?php do_action( 'before_sidebar' ); ?>
                    <?php if ( ! dynamic_sidebar( get_custom_option('sidebar_advert') ) ) { ?>
                        <?php // Put here html if user no set widgets in sidebar ?>
                    <?php } // end sidebar widget area ?>
                </div>
            </div>
        </div>
        <?php } ?>

		<?php if (get_custom_option('show_sidebar_footer') == 'yes'  ) { ?>
		<div id="footer_sidebar" class="widget_area sidebar_footer theme_<?php echo get_custom_option('sidebar_footer_theme'); ?> theme_article" role="complementary">
			<div id="footer_sidebar_inner">
				<?php do_action( 'before_sidebar' ); ?>
				<?php if ( ! dynamic_sidebar( get_custom_option('sidebar_footer') ) ) { ?>
					<?php // Put here html if user no set widgets in sidebar ?>
				<?php } // end sidebar widget area ?>
			</div>
		</div>

		<div id="footer_copyright" class="theme_<?php echo get_custom_option('sidebar_footer_theme'); ?> theme_article">
			<div id="footer_copyright_inner" class="theme_text">
				<?php
					echo get_theme_option('footer_copyright')
				?>
			</div>
		</div>
        <?php } ?>
	</footer>

</div><!-- #page -->

<a href="#" id="toTop" class="theme_button icon-up-open-big"></a>

<div id="popup_login" class="popup_form">
    <div class="popup_body theme_article">
		<h4 class="popup_title"><?php _e('Login', 'themerex'); ?></h4>
        <form action="<?php echo wp_login_url(); ?>" method="post" name="login_form">
			<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>"/>
			<div class="popup_field"><input type="text" name="log" id="log" placeholder="<?php _e('Login*', 'themerex'); ?>" /></div>
			<div class="popup_field"><input type="password" name="pwd" id="pwd" placeholder="<?php _e('Password*', 'themerex'); ?>" /></div>
			<div class="popup_field popup_button"><a href="#" class="theme_button"><?php _e('Login', 'themerex'); ?></a></div>
			<div class="popup_field forgot_password">
				<a href="<?php echo wp_lostpassword_url( get_permalink() ); ?>"><?php _e('Forgot password?', 'themerex'); ?></a>
            </div>
			<div class="popup_field register">
				<a href="#"><?php _e('Register', 'themerex'); ?></a>
            </div>
            <div class="result sc_infobox"></div>
		</form>
    </div>
</div>

<div id="popup_register" class="popup_form">
    <div class="popup_body theme_article">
		<h4 class="popup_title"><?php _e('Registration', 'themerex'); ?></h4>
        <form action="#" method="post" name="register_form">
			<input type="hidden" name="redirect_to" value="<?php echo home_url(); ?>"/>
			<div class="popup_field"><input type="text" name="registration_username" id="registration_username" placeholder="<?php _e('Your name (login)*', 'themerex'); ?>" /></div>
			<div class="popup_field"><input type="text" name="registration_email" id="registration_email" placeholder="<?php _e('Your email*', 'themerex'); ?>" /></div>
			<div class="popup_field"><input type="password" name="registration_pwd" id="registration_pwd" placeholder="<?php _e('Your Password*', 'themerex'); ?>" /></div>
			<div class="popup_field"><input type="password" name="registration_pwd2" id="registration_pwd2" placeholder="<?php _e('Confirm Password*', 'themerex'); ?>" /></div>
			<div class="popup_field theme_info registration_role"><p><?php _e('Desired role:','themerex'); ?></p>
			<input type="radio" name="registration_role" id="registration_role1" value="1" checked="checked" /><label for="registration_role1"><?php _e('Subscriber', 'themerex'); ?></label>
			<input type="radio" name="registration_role" id="registration_role2" value="2" /><label for="registration_role2"><?php _e('Author', 'themerex'); ?></label>
			</div>
			<div class="popup_field registration_msg_area"><textarea name="registration_msg" id="registration_msg" placeholder="<?php _e('Your message', 'themerex'); ?>"></textarea></div>
			<div class="popup_field popup_button"><a href="#" class="theme_button"><?php _e('Register', 'themerex'); ?></a></div>
            <div class="result sc_infobox"></div>
		</form>
    </div>
</div>

<?php
if (get_theme_option('show_theme_customizer') == 'yes') {
	$theme_color = get_custom_option('theme_color');
	$body_style = get_custom_option('body_style');
	$bg_color = get_custom_option('bg_color');
	$bg_pattern = get_custom_option('bg_pattern');
	$bg_image = get_custom_option('bg_image');
?>
	<div id="custom_options">
		<div class="co_header">
			<a href="#" id="co_toggle" class="icon-cog"></a>
            <div class="co_title_wrapper"><h4 class="co_title"><?php _e('Choose Your Style', 'themerex'); ?></h4></div>
		</div>
		<div class="co_options">
			<form name="co_form">
				<input type="hidden" id="co_site_url" name="co_site_url" value="<?php echo 'http://' . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
                <div class="co_form_row">
					<input type="hidden" name="co_body_style" value="<?php echo $body_style; ?>" />
					<span class="co_label"><?php _e('Background:', 'themerex'); ?></span>
                    <div class="co_switch_box">
                        <a href="#" class="stretched"><?php _e('Stretched', 'themerex'); ?></a>
                        <div class="switcher"><a href="#"></a></div>
                        <a href="#" class="boxed"><?php _e('Boxed', 'themerex'); ?></a>
                    </div>
                    <?php if ($body_style == 'boxed') { ?>
                    <script type="text/javascript">
						jQuery(document).ready(function() {
							var box = jQuery('#custom_options .switcher');
							var switcher = box.find('a').eq(0);
							var right = box.width() - switcher.width() + 2;
							switcher.css({left: right});
						});
                    </script>
                    <?php } ?>
                </div>
                <div class="co_form_row">
					<input type="hidden" name="co_bg_color" value="<?php echo $bg_color; ?>" />
					<span class="co_label"><?php _e('Background color:', 'themerex'); ?></span>
                    <div id="co_bg_color" class="iColorPicker"></div>
                </div>
				<div class="co_form_row">
					<input type="hidden" name="co_bg_pattern" value="<?php echo $bg_pattern; ?>" />
					<span class="co_label"><?php _e('Background pattern:', 'themerex'); ?></span>
                    <div id="co_bg_pattern_list">
                    	<a href="#" id="pattern_1" class="co_pattern_wrapper<?php echo $bg_pattern==1 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/pattern_1.png" /></a>
                    	<a href="#" id="pattern_2" class="co_pattern_wrapper<?php echo $bg_pattern==2 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/pattern_2.png" /></a>
                    	<a href="#" id="pattern_3" class="co_pattern_wrapper<?php echo $bg_pattern==3 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/pattern_3.png" /></a>
                    	<a href="#" id="pattern_4" class="co_pattern_wrapper<?php echo $bg_pattern==4 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/pattern_4.png" /></a>
                    	<a href="#" id="pattern_5" class="co_pattern_wrapper<?php echo $bg_pattern==5 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/pattern_5.png" /></a>
					</div>
                </div>
				<div class="co_form_row">
					<input type="hidden" name="co_bg_image" value="<?php echo $bg_image; ?>" />
					<span class="co_label"><?php _e('Background image:', 'themerex'); ?></span>
                    <div id="co_bg_images_list">
                    	<a href="#" id="image_1" class="co_image_wrapper<?php echo $bg_image==1 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/image_1_thumb.jpg" /></a>
                    	<a href="#" id="image_2" class="co_image_wrapper<?php echo $bg_image==2 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/image_2_thumb.jpg" /></a>
                    	<a href="#" id="image_3" class="co_image_wrapper<?php echo $bg_image==3 ? ' current' : '' ; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/bg/image_3_thumb.jpg" /></a>
					</div>
                </div>
	        </form>
			<script type="text/javascript" language="javascript">
				jQuery(document).ready(function(){
					// Theme & Background color
					jQuery('#co_theme_color').css('backgroundColor', '<?php echo $theme_color; ?>');
					jQuery('#co_bg_color').css('backgroundColor', '<?php echo $bg_color; ?>');    
                });
            </script>
        </div>
	</div>
<?php
}

?>

<script type="text/javascript">
jQuery(document).ready(function() {
	<?php
	// Reject old browsers
	global $THEMEREX_jreject;
	if ($THEMEREX_jreject) {
	?>
		jQuery.reject({
			reject : {
				all: false, // Nothing blocked
				msie5: true, msie6: true, msie7: true, msie8: true // Covers MSIE 5-8
				/*
				 * Possibilities are endless...
				 *
				 * // MSIE Flags (Global, 5-8)
				 * msie, msie5, msie6, msie7, msie8,
				 * // Firefox Flags (Global, 1-3)
				 * firefox, firefox1, firefox2, firefox3,
				 * // Konqueror Flags (Global, 1-3)
				 * konqueror, konqueror1, konqueror2, konqueror3,
				 * // Chrome Flags (Global, 1-4)
				 * chrome, chrome1, chrome2, chrome3, chrome4,
				 * // Safari Flags (Global, 1-4)
				 * safari, safari2, safari3, safari4,
				 * // Opera Flags (Global, 7-10)
				 * opera, opera7, opera8, opera9, opera10,
				 * // Rendering Engines (Gecko, Webkit, Trident, KHTML, Presto)
				 * gecko, webkit, trident, khtml, presto,
				 * // Operating Systems (Win, Mac, Linux, Solaris, iPhone)
				 * win, mac, linux, solaris, iphone,
				 * unknown // Unknown covers everything else
				 */
			},
			imagePath: "<?php echo get_template_directory_uri(); ?>/js/jreject/images/",
			header: "<?php _e('Your browser is out of date', 'themerex'); ?>", // Header Text
			paragraph1: "<?php _e('You are currently using an unsupported browser', 'themerex'); ?>", // Paragraph 1
			paragraph2: "<?php _e('Please install one of the many optional browsers below to proceed', 'themerex'); ?>",
			closeMessage: "<?php _e('Close this window at your own demise!', 'themerex'); ?>" // Message below close window link
		});
	<?php 
	} 
	?>
});

// Main menu settings
var THEMEREX_mainMenuFixed  = <?php echo get_theme_option('menu_position')=='fixed' ? 'true' : 'false'; ?>;
var THEMEREX_mainMenuMobile = <?php echo get_theme_option('responsive_layouts')=='yes' ? 'true' : 'false'; ?>;
var THEMEREX_mainMenuMobileWidth = <?php echo get_theme_option('responsive_menu_width'); ?>;
var THEMEREX_mainMenuSlider = <?php echo get_theme_option('menu_slider')=='yes' ? 'true' : 'false'; ?>;
	
// Video and Audio tag wrapper
var THEMEREX_useMediaElement = <?php echo get_theme_option('use_mediaelement')=='yes' ? 'true' : 'false'; ?>;

// Puzzles animations
var THEMEREX_puzzlesAnimations = <?php echo get_theme_option('puzzles_animations')=='yes' ? 'true' : 'false'; ?>;

// Javascript String constants for translation
THEMEREX_GLOBAL_ERROR_TEXT	= "<?php _e('Global error text', 'wspace'); ?>";
THEMEREX_NAME_EMPTY			= "<?php _e('The name can\'t be empty', 'wspace'); ?>";
THEMEREX_NAME_LONG 			= "<?php _e('Too long name', 'wspace'); ?>";
THEMEREX_EMAIL_EMPTY 		= "<?php _e('Too short (or empty) email address', 'wspace'); ?>";
THEMEREX_EMAIL_LONG			= "<?php _e('Too long email address', 'wspace'); ?>";
THEMEREX_EMAIL_NOT_VALID 	= "<?php _e('Invalid email address', 'wspace'); ?>";
THEMEREX_MESSAGE_EMPTY 		= "<?php _e('The message text can\'t be empty', 'wspace'); ?>";
THEMEREX_MESSAGE_LONG 		= "<?php _e('Too long message text', 'wspace'); ?>";
THEMEREX_SEND_COMPLETE 		= "<?php _e("Send message complete!", 'wspace'); ?>";
THEMEREX_SEND_ERROR 		= "<?php _e("Transmit failed!", 'wspace'); ?>";
THEMEREX_LOGIN_EMPTY		= "<?php _e("The Login field can't be empty", 'themerex'); ?>";
THEMEREX_LOGIN_LONG			= "<?php _e('Too long login field', 'themerex'); ?>";
THEMEREX_PASSWORD_EMPTY		= "<?php _e("The password can't be empty and shorter then 5 characters", 'themerex'); ?>";
THEMEREX_PASSWORD_LONG		= "<?php _e('Too long password', 'themerex'); ?>";
THEMEREX_PASSWORD_NOT_EQUAL	= "<?php _e('The passwords in both fields are not equal', 'themerex'); ?>";
THEMEREX_REGISTRATION_SUCCESS= "<?php _e('Registration success! Please log in!', 'themerex'); ?>";
THEMEREX_REGISTRATION_FAILED= "<?php _e('Registration failed!', 'themerex'); ?>";
THEMEREX_REGISTRATION_AUTHOR= "<?php _e('Your account is waiting for the site admin moderation!', 'themerex'); ?>";
THEMEREX_GEOCODE_ERROR 		= "<?php _e("Geocode was not successful for the following reason:", 'wspace'); ?>";
THEMEREX_GOOGLE_MAP_NOT_AVAIL="<?php _e("Google map API not available!", 'themerex'); ?>";
THEMEREX_NAVIGATE_TO		= "<?php _e("Navigate to...", 'themerex'); ?>";

// AJAX parameters
<?php global $THEMEREX_ajax_url, $THEMEREX_ajax_nonce; ?>
var THEMEREX_ajax_url = "<?php echo $THEMEREX_ajax_url; ?>";
var THEMEREX_ajax_nonce = "<?php echo $THEMEREX_ajax_nonce; ?>";

</script>


<?php wp_footer(); ?>

</body>
</html>