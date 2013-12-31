<?php 

/* Template Name: Gallery */

get_header(); ?>

	<div id="primary" class="content-area page">
		<main id="main" class="site-main gal-container" role="main">

			<?php

			$gppp = $smof_data['gppp'];
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array(
				'post_type' => 'spsa_gallery',
				'paged' => $paged,
				'posts_per_page' => $gppp,
			);
			
			$the_query = new WP_Query($args);
			if ( $the_query->have_posts() ) : 
			while ( $the_query->have_posts() ) : $the_query->the_post();

			?>

				<article class="gal-item" id="post-<?php the_ID(); ?>">
					<h1 class="page-title"><?php the_title(); ?></h1>
					
					<div class="gal-content">
						<?php the_content(); ?>
					</div>
					
					<?php

					$images = rwmb_meta( 'silver_gallery_post', 'type=image' );
					if($images) {
						echo '<div id="gallery" class="clearfix">';
							foreach ( $images as $image ) {
								echo "<a data-fancybox-group='gallery".get_the_ID()."' class='fancybox' href='{$image['full_url']}' title='{$image['title']}'>
									<img src='{$image['url']}' width='150' height='150' alt='{$image['alt']}' />
								</a>";
							}
						echo '</div>';
						$i++;
					}

					?>
				</article>

			<?php 
			endwhile; ?>
			
			<div id="npl"><?php next_posts_link( 'Older Entries', $the_query->max_num_pages ); ?></div>
			
			<?php
			wp_reset_postdata();
			else:
				_e( 'Sorry, no posts matched your criteria.', 'silver' );
			endif;
			?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
