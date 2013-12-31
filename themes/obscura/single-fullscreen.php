<?php get_header(); ?>
</div>
<!-- End Wrapper -->

<?php 
	$fullscreen_autoplay = of_get_option('fullscreen_autoplay');
	$fullscreen_loop = of_get_option('fullscreen_loop');
	$fullscreen_slide_interval = of_get_option('fullscreen_slide_interval');
	$fullscreen_transition_speed = of_get_option('fullscreen_transition_speed');
	$fullscreen_transition = of_get_option('fullscreen_transition');
	$fullscreen_pause_hover = of_get_option('fullscreen_pause_hover');
	$fullscreen_protect = of_get_option('fullscreen_protect');
	$fullscreen_progress = of_get_option('fullscreen_progress');
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
				
	$.supersized({
		
		// Functionality
		slideshow               :   1,			// Slideshow on/off
		autoplay				:	<?php if ($fullscreen_autoplay) { echo '1'; } else { echo '0'; } ?>,			// Slideshow starts playing automatically
		start_slide             :   1,			// Start slide (0 is random)
		stop_loop				:	<?php if ($fullscreen_loop) { echo '1'; } else { echo '0'; } ?>,			// Pauses slideshow on last slide
		random: 	0,			// Randomize slide order (Ignores start slide)
		slide_interval          :   <?php if ($fullscreen_slide_interval) { echo ''.$fullscreen_slide_interval.''; } else { echo '3000'; } ?>,		// Length between transitions
		transition              :   <?php if ($fullscreen_transition) { echo ''.$fullscreen_transition.''; } else { echo '0'; } ?>, 		// 0-None, 1-Fade, 2-Slide Top, 3-Slide Right, 4-Slide Bottom, 5-Slide Left, 6-Carousel Right, 7-Carousel Left
		transition_speed		:	<?php if ($fullscreen_transition_speed) { echo ''.$fullscreen_transition_speed.''; } else { echo '1000'; } ?>,		// Speed of transition
		new_window				:	1,			// Image links open in new window/tab
		pause_hover             :   <?php if ($fullscreen_pause_hover) { echo '1'; } else { echo '0'; } ?>,			// Pause slideshow on hover
		keyboard_nav            :   1,			// Keyboard navigation on/off
		performance				:	0,			// 0-Normal, 1-Hybrid speed/quality, 2-Optimizes image quality, 3-Optimizes transition speed // (Only works for Firefox/IE, not Webkit)
		image_protect			:	<?php if ($fullscreen_protect) { echo '1'; } else { echo '0'; } ?>,			// Disables image dragging and right click with Javascript
		image_path              :   '<?php echo get_template_directory_uri(); ?>/style/images/fullscreen/', //Default image path
		
		// Size & Position	   
		min_width		        :   0,			// Min width allowed (in pixels)
		min_height		        :   0,			// Min height allowed (in pixels)
		vertical_center         :   1,			// Vertically center background
		horizontal_center       :   1,			// Horizontally center background
		fit_always				:	0,			// Image will never exceed browser width or height (Ignores min. dimensions)
		fit_portrait         	:   1,			// Portrait images will not exceed browser height
		fit_landscape			:   0,			// Landscape images will not exceed browser width
		
		// Components		
		slide_links				:	'blank',	// Individual links for each slide (Options: false, 'num', 'name', 'blank')
		thumb_links				:	1,			// Individual thumb links for each slide
		
		// Slideshow Images
		slides					:  	[			
		<?php 
		$images = rwmb_meta( 'rw_fc_images', 'type=image&size=fullscreen_thumb' );
		foreach ( $images as $image )
		{
			$count++;
			if ($count>1) { echo ", "; }
			$url = "{$image['caption']}";
			$desc = "{$image['description']}";
			$blank   = array("\r\n", "\n", "\r");
			$break = '<br />';
			$description = str_replace($blank, $break, $desc);
			
			echo "{image : '{$image['full_url']}', ";
				if ($desc) { 
					echo "title : '<span>$description</span>',";
				}
				if ($url) { 
					echo "url : '$url',";
				}
			echo "thumb : '{$image['url']}'}";
		} ?>
									],		
		// Theme Options			   
		progress_bar			:	1,			// Timer for each slide		
		mouse_scrub				:	0
	});
	
	$('#thumb-list li').addClass("outer");
	$('#thumb-list li img').wrap('<span class="inset"></span>');
	
	$('.frame').mouseenter(function(e) {
		$(this).children('a').children('span').fadeIn(300);
	}).mouseleave(function(e) {
		$(this).children('a').children('span').fadeOut(200);
	});     
});	
</script>

<div id="buttons">
	<div id="slidecaption"></div>
	<a id="tray-button"><img id="tray-arrow" src="<?php echo get_template_directory_uri(); ?>/style/images/fullscreen/button-tray-up.png"/></a>
	<a id="play-button"><img id="pauseplay" src="<?php echo get_template_directory_uri(); ?>/style/images/fullscreen/pause.png"/></a>
	<a id="nextslide" class="load-item"></a>
	<a id="prevslide" class="load-item"></a>
</div>
<div id="thumb-tray" class="load-item">
	<div id="thumb-back"></div>
	<div id="thumb-forward"></div>
</div>
<?php if ($fullscreen_progress) { echo '<div id="progress-back" class="load-item"><div id="progress-bar"></div></div>'; } ?>

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

<?php wp_footer(); ?>
</body>
</html>      
        
  
      


