<?php
/*
Template Name: Contact (form)
*/
?>
<?php get_header(); ?>

	<div id="content" class="clearfix">

<!-- BEGIN GET POST ID (FOR CUSTOM BACKGROUND COLOR) --><?php $bonfire_background_color = get_post_meta($post->ID, 'bonfire_background_color', true); ?><!-- END GET POST ID (FOR CUSTOM BACKGROUND COLOR) -->
<!-- BEGIN PAGE BACKGROUND COLOR + FEATURED IMAGE AS BACKGROUND -->
<?php if ( has_post_thumbnail() ) { ?>
<div class="darker-image" style="background-image: url(<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>);background-size:cover;background-repeat:no-repeat;background-position:top center;z-index:-1;">
<?php } else { ?>

<div class="darker <?php echo $bonfire_background_color; ?>">
<?php } ?>
<!-- END PAGE BACKGROUND COLOR + FEATURED IMAGE AS BACKGROUND -->

<!-- BEGIN CUSTOM FIELD FOR EMBEDDABLE MAP -->
<?php $map = get_post_meta($post->ID, 'Map', true); ?>
<div class="map-container"><?php echo $map; ?></div>
<!-- END CUSTOM FIELD FOR EMBEDDABLE MAP -->

<!-- BEGIN DIV WRAPPER IF FEATURED IMAGE USED -->
<?php if ( has_post_thumbnail() ) { ?>
<div class="<?php if($bonfire_background_color !== ' ') { ?>post-background-opacity<?php } ?> <?php echo $bonfire_background_color; ?>">
<!-- BEGIN TOGGLE SHOW/HIDE CONTENT IF FEATURED IMAGE USED -->
<div class="featured-image-toggle-wrapper">
<a href="#"><div class="featured-image-toggle"></div></a>
</div>
<!-- END TOGGLE SHOW/HIDE CONTENT IF FEATURED IMAGE USED -->
<?php } ?>
<!-- END DIV WRAPPER IF FEATURED IMAGE USED -->

<div class="content-wrapper">

<div class="contact-page-wrapper">

		<?php while ( have_posts() ) : the_post(); ?>
						
<!-- BEGIN PAGE CONTENT -->
<div class="entry-content"><?php the_content(); ?></div>
<!-- END PAGE CONTENT -->			

<!-- BEGIN POST NAVIGATION -->
<div class="link-pages">
<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'bonfire').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>
<!-- END POST NAVIGATION -->

<!-- BEGIN EDIT POST LINK -->
<?php edit_post_link(__('EDIT', 'bonfire')); ?>
<!-- END EDIT POST LINK -->

<!-- BEGIN CONTACT FORM -->	
<script type="text/javascript">                                         
	/* <![CDATA[ */
		jQuery(document).ready(function(){ // sends the data filled in the contact form to the php file and shows a message
			jQuery("#contact-form").submit(function(){
				var str = jQuery(this).serialize();
				jQuery.ajax({
				   type: "POST",
				   url: "<?php echo get_template_directory_uri(); ?>/contact-send.php",
				   data: str,
				   success: function(msg)
				   {
						jQuery("#formstatus").ajaxComplete(function(event, request, settings){
							if(msg == 'OK'){ // Message Sent? Show the 'Thank You' message and hide the form
								result = '<div class="formstatusok"><?php _e( 'Your message has been sent.<br> Thank you!', 'bonfire' ); ?></div>';
								jQuery("#contactform-wrapper").hide();
							}
							else{
							if(msg == 'ERROR'){ // Problems? Show the 'Error' message
							result = '<div class="formstatuserror"><?php _e( 'Please make sure you have entered:', 'bonfire' ); ?> <br>- <?php _e( ' your message', 'bonfire' ); ?><br>- <?php _e( ' your name', 'bonfire' ); ?><br>- <?php _e( ' a valid email address', 'bonfire' ); ?></div>';
							}
							}
							jQuery(this).html(result);
						});
					}
				
				 });
				return false;
			});
		});
	/* ]]> */
</script>


<form id="contact-form" action="javascript:alert('success!');">
<div id="formstatus"></div>
			
	<div id="contactform-wrapper">
	<div id="message-wrapper"><textarea name="message" value="Your Message" id="message" placeholder="<?php _e( 'Type your message here..', 'bonfire' ); ?>" ></textarea></div>
	<div id="name-wrapper"><input type="text" name="name" value="" id="name" placeholder="<?php _e( 'Name', 'bonfire' ); ?>" /></div>
	<div id="mail-wrapper"><input type="text" name="email" value="" id="mail" placeholder="<?php _e( 'Email', 'bonfire' ); ?>" /></div>
	<input type="submit" name="submit" value="<?php _e( 'Send message', 'bonfire' ); ?>" id="contact-submit" />
	<div id="cancel-message"></div>
	</div>
</form>


<script> 
<!-- BEGIN NAME, EMAIL FIELD FADE-IN -->
jQuery('#name-wrapper,#mail-wrapper').hide();
jQuery('#cancel-message').hide();
jQuery('#formstatus').animate({opacity: 0}, 0);

jQuery('#message').click(function() {
        jQuery('#name-wrapper,#mail-wrapper,#cancel-message').slideDown(200).animate({opacity: 1}, 100);
    });

jQuery('#cancel-message').click(function() {
        jQuery('#name-wrapper,#mail-wrapper,#formstatus').animate({opacity: 0}, 100).slideUp(150);
		jQuery('#cancel-message').animate({opacity: 0}, 0).hide(0);
    });
	
jQuery('#contact-submit').click(function() {
        jQuery('#formstatus').show(0).animate({opacity: 1}, 400).animate({opacity: 0.5}, 150).animate({opacity: 1}, 350);
    });
<!-- END NAME, EMAIL FIELD FADE-IN -->

<!-- BEGIN JUMP TO #footer ON #message CLICK -->
jQuery('#message').click(function() {
jQuery('html,body').animate({
    scrollTop: '+=' + jQuery('#cancel-message').offset().top + 'px'
}, 'fast');
});
<!-- END JUMP TO #footer ON #message CLICK -->

<!-- BEGIN AUTO-EXPAND TEXTAREA -->
jQuery(document).ready(function() {
	jQuery( "textarea" ).autogrow();
});
<!-- END AUTO-EXPAND TEXTAREA -->
</script>
<!-- END CONTACT FORM -->


	</div>
	<!-- /#content -->

<?php endwhile; ?>

</div>

</div>

<!-- BEGIN DIV WRAPPER IF FEATURED IMAGE USED -->
<?php if ( has_post_thumbnail() ) { ?>
</div>
<?php } ?>
<!-- END DIV WRAPPER IF FEATURED IMAGE USED -->
</div>

<?php get_footer(); ?>