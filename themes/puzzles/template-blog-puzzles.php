<?php
/*
 * The template for displaying one article of blog streampage with style "Puzzles"
 * 
 * @package puzzles
*/
?>
<article <?php post_class('theme_article post_format_'.$post_format.' '.($post_number%2==0 ? 'even' : 'odd') . ($post_number==0 ? ' first' : '') . ($post_number==$per_page? ' last' : '') . ($addViewMoreClass ? ' viewmore' : '')); ?>>
	<?php 
	$post_hover_bg  = get_custom_option('puzzles_post_bg', null, $post_id);
	$post_hover_pos = get_custom_option('puzzles_post_position', null, $post_id);
	$show_content_block = !in_array($post_format, array('link', 'image')) || !$post_thumb;
	?>
	<div class="post_thumb image_wrapper <?php echo in_array($post_format, array('quote', 'link', 'image')) || (!$post_thumb && (!$post_gallery || $post_protected)) ? 'no_thumb' : $post_hover_pos; ?>"<?php echo $post_video && !$post_protected ? ' data-video="'.htmlspecialchars($post_video).'"' : ''; ?>>
		<?php
		if ($post_gallery && !$post_protected) {			// If post have gallery - show it
			if ($post_link!='')
				echo '<a href="'.$post_link.'">'.$post_gallery.'</a>';
			else
				echo $post_gallery;
			//echo '<div class="post_thumb_hover"></div>';
		} else if ($post_thumb) {							// If post have thumbnail - show it
			if ($post_format=='link' && $post_url!='')
				echo '<a href="'.$post_url.'">'.$post_thumb.'</a>';
			else if ($post_link!='')
				echo '<a href="'.$post_link.'">'.$post_thumb.'</a>';
			else
				echo $post_thumb; 
			if ($post_format == 'video' && $post_video && !$post_protected) {
				?>
				<a href="#" class="post_video_play icon-play"></a>
				<?php
			}
			//echo '<div class="post_thumb_hover"></div>';
		} else if ($post_video && !$post_protected) {
			echo $post_video; 
			$show_content_block = false;
		}
		?>
		<span class="post_format theme_accent_bg <?php echo $post_icon; ?>"<?php echo my_substr($post_accent_color, 0, 1)=='#' ? ' style="background-color: '.$post_accent_color.'"' : ''; ?>></span>
		<?php 
		if ($post_accent_category!='') { 
		?>
			<span class="post_category theme_accent_bg"<?php echo my_substr($post_accent_color, 0, 1)=='#' ? ' style="background-color: '.$post_accent_color.'"' : ''; ?>><?php echo $post_accent_category; ?></span>
		<?php 
		}
		if ($show_content_block) {
		?>
		<div class="post_content_wrapper theme_puzzles"<?php echo $post_hover_bg!='' && $post_hover_bg!='default' ? ' style="background-color:'.$post_hover_bg.';"' : ''; ?>>
			<?php 
			if (!in_array($post_format, array('quote', 'aside'))) { 
			?>
				<h2 class="post_subtitle"><a href="<?php echo $post_link; ?>"><?php echo $post_title; ?></a></h2>
				<?php
				if ( get_custom_option('show_reviews', null, $post_id)=='yes' ) {
					$avg_author = get_post_meta($post_id, 'reviews_avg'.(get_theme_option('reviews_first')=='author' ? '' : '2'), true);
					if ($avg_author > 0) {
						?>
						<div class="reviews_summary blog_reviews">
							<div class="criteria_summary criteria_row">
								<?php echo getReviewsSummaryStars($avg_author); ?>
							</div>
						</div>
						<?php 
					}
				} 
			}
			?>
			<div class="post_descr"><?php echo $post_descr; ?></div>
			<div class="post_content_padding theme_puzzles"<?php 
				if ($post_hover_bg!='' && $post_hover_bg!='default') {
					$rgb = Hex2RGB($post_hover_bg);
					$post_hover_ie = str_replace('#', '', $post_hover_bg);
					echo " style=\"
						background: -moz-linear-gradient(top,  rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0) 0%, rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.01) 1%, rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1) 50%);
						background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0)), color-stop(1%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.01)), color-stop(50%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1)));
						background: -webkit-linear-gradient(top,  rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0) 0%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.01) 1%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1) 50%);
						background: -o-linear-gradient(top,  rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0) 0%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.01) 1%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1) 50%);
						background: -ms-linear-gradient(top,  rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0) 0%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.01) 1%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1) 50%);
						background: linear-gradient(to bottom,  rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0) 0%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},0.01) 1%,rgba({$rgb['r']},{$rgb['g']},{$rgb['b']},1) 50%);
						filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#00{$post_hover_ie}', endColorstr='#$post_hover_ie',GradientType=0 );
						\""; 
				}
				?>></div>
		</div>
		<?php 
		}
		if (!$post_protected) {
			if ( $post_audio )							// If post have audio - show it
				echo $post_audio;
		}
		?>
	</div>
</article>
