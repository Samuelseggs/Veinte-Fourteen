<?php get_header(); ?>

	<?php if ( have_posts() ) : ?>

		<div id="primary" class="content-area index">
			
			<?php while ( have_posts() ) : the_post(); ?>
			
				<article id="post-<?php the_ID(); ?>" class="<?php
						$postDisplay = get_post_meta( get_the_ID(), 'silver_radio', true );
						$transparency = get_post_meta( get_the_ID(), 'silver_transparency_radio', true );
						
						if($postDisplay == 'featured') echo 'post-box special';
						elseif ($postDisplay == 'wide' && has_post_thumbnail()) echo 'post-box half-wide';
						elseif (!has_post_thumbnail()) echo 'post-box half-wide no-img';
						else echo 'post-box half';
					?><?php echo $transparency == 'opaque' ? '' : ' transparency'; ?>">
					
					<?php
					if(isset($smof_data['c_imgres'])) $params = array( 'size' => 'home_featured', 'type' => 'image' ); else $params = array( 'size' => 'home_featured_small', 'type' => 'image' );
					$images = rwmb_meta( 'silver_featured_slider', $params );
					
					if($postDisplay == 'featured' && $images) {
						echo '<div id="slider" class="';
						echo $transparency == 'opaque' ? '' : 'transparency ';
						echo 'clearfix">';
							foreach ( $images as $image ) {
								echo "<img src='{$image['url']}' width='{$image['width']}' height='{$image['height']}' alt='{$image['alt']}' />";
							}
						echo '</div>
						<ul id="slider-nav">
							<li data-nav="prev">Prev</li>
							<li data-nav="next">Next</li>
						</ul>';
					} elseif ( has_post_thumbnail() ) {
						if(isset($smof_data['c_imgres'])) $hf = 'home_featured'; else $hf = 'home_featured_small';
						if(isset($smof_data['c_imgres'])) $hw = 'home_wide'; else $hw = 'home_wide_small';
						if(isset($smof_data['c_imgres'])) $hb = 'home_boxed'; else $hb = 'home_boxed_small';
						if($postDisplay == 'featured') the_post_thumbnail($hf);
						elseif ($postDisplay == 'wide') the_post_thumbnail($hw);
						else the_post_thumbnail($hb);
					} ?>
					
					<div class="post-extra">
						<span class="cat">
							<?php $categories_list = get_the_category_list( __( ', ', 'silver' ) );
								echo $categories_list;  
							?>
						</span>
						<h1 class="post-title"><?php the_title(); ?></h1>
						<?php if ($postDisplay !== '' && $postDisplay !== 'boxed') echo '<p>'.get_the_excerpt().'</p>'; ?>
						<a class="read-more" href="<?php the_permalink(); ?>"><?php _e('Read More'); ?></a>
					</div>
					
				</article>

			<?php endwhile; ?>

		</div>

	<?php else : ?>
		<p style="margin: 35px 0 0;"><?php _e( 'Sorry, no posts matched your criteria.', 'silver' ); ?></p>
	<?php endif; ?>

	<div id="npl"><?php next_posts_link(); ?></div>

<?php get_footer(); ?>