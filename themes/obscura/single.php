<?php get_header(); ?>

<?php include (TEMPLATEPATH . '/intro.php'); ?>

<?php $format = get_post_format(); ?>

<!-- If Format Image -->
<?php if( $format == 'image' ) { ?>

	<div class="main-image">
		<div class="outer">
			<span class="inset">
			
			<?php
				$images = rwmb_meta( 'rw_image', 'type=image&size=full_image' );
				foreach ( $images as $image )
				{
					echo "<img src='{$image['url']}' alt='{$image['alt']}' />";
					break;
				}
			?>
			</span>
		</div>
	</div>

<?php } ?>
<!-- End If Format Image --> 

<!-- If Format Gallery --> 
<?php if( $format == 'gallery' ) {?>

	<?php $templates = get_post_meta( get_the_ID( ), 'rw_gallery_style', false ); ?>
	<?php if ( in_array( flex, $templates ) ) : ?>
		<div class="gallery-wrapper">
			<div class="slider flexslider">
				<ul class="slides">
					<?php
					$images = rwmb_meta( 'rw_gallery_images', 'type=image&size=full_image' );
					foreach ( $images as $image )
					{
						echo "<li><div class='outer'><span class='inset'>";
						echo "<img src='{$image['url']}' alt='{$image['alt']}' />";
							if ($image['description']) { 
								echo "<span class='description'>{$image['description']}</span>";
							}
						echo "</span></div></li>";
					}
					?>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	<?php else : ?>
	
		</div>
		<div class="zetaSlider" id="zetaSlider">
			<div class="zetaHolder box">
				<div class="zetaWrapper">
					<div class="zetaEmpty">
						<?php
							$images = rwmb_meta( 'rw_gallery_images', 'type=image&size=full_image' );
							foreach ( $images as $image )
							{
								echo "<div class='zetaImageBox frame'>";
								echo "<img src='{$image['url']}' alt='{$image['alt']}' />";
									if ($image['description']) { 
										echo "<span class='caption'>{$image['description']}</span>";
									}
								echo "</div>";
							} 
						?>
					</div>
				</div>
			</div>
			<div class="zetaControls"> 
				<a class="zetaBtnPrev" href="#"><?php _e( 'Previous', 'elemis' ) ?></a>
				<a class="zetaBtnNext" href="#"><?php _e( 'Next', 'elemis' ) ?></a> 
			</div>
			<div class="zetaWarning">
				<div class="navigate"><?php _e( 'Navigate by', 'elemis' ) ?></div>
				<div class="drag"><?php _e( 'Dragging', 'elemis' ) ?></div>
				<div class="arrow"><?php _e( 'Arrows', 'elemis' ) ?></div>
				<div class="keys"><?php _e( 'Keyboard', 'elemis' ) ?></div>
				<div class="clear"></div>
			</div>
		</div>

		<script type="text/javascript">
		$(document).ready(function() {
			$('#zetaSlider').zetaSlider();
		});
		</script>
		<div class="wrapper">
	<?php endif; ?>
<?php } ?>
<!-- End If Format Gallery --> 

<!-- Begin Container -->
<div class="content">
	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'content' ); ?>
	
	<?php comments_template( '', true ); ?>
	<?php endwhile; // end of the loop. ?>
</div>
<!-- End Container -->

<?php get_sidebar(); ?>

<?php get_footer(); ?>