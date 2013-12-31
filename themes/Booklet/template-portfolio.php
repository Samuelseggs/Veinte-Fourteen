<?php 

/* Template Name: Portfolio */

get_header(); ?>

	<div id="primary" class="content-area page">
		<main id="main" class="site-main" role="main">

			<h1 class="folio-title"><?php the_title(); ?></h1>
		
			<div id="filters">
				<?php

				$portfolio_filters = get_terms( 'filter' );
				if( $portfolio_filters ) {
					$filters = '
						<ul class="clearfix">
							<li><a href="#filter" data-option-value="*" class="active selected">' . __('All', 'silver') . '</a></li>';
							foreach( $portfolio_filters as $portfolio_filter ) {
								$filters .= '<li><a href="#filter" data-option-value=".term-' . $portfolio_filter->slug . '">' . $portfolio_filter->name . '</a></li>';
							}
					$filters .= '</ul>';
					echo $filters;
				};

				?>
			</div>

			<div id="portfolio">
				
				<?php
				$ppp = $smof_data['ppp'];
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
				$args = array(
					'post_type' => 'spsa_folio',
					'paged' => $paged,
					'posts_per_page' => $ppp,
				);
					
				$the_query = new WP_Query($args);
				if ( $the_query->have_posts() ) :
					echo '<ul id="portfolio-wrapper" class="items imglist clearfix">';
					
						while ( $the_query->have_posts() ) : $the_query->the_post();
							if ( has_post_thumbnail()) {
								$thumbnail_id = get_post_thumbnail_id();				
								$thumbnail = wp_get_attachment_image_src( $thumbnail_id , 'folio' );	
								$alt_text = get_post_meta($thumbnail_id , '_wp_attachment_image_alt', true);
								echo '
								<li class="portfolio';
								$terms = get_the_terms( get_the_ID(), 'filter' );
								if( $terms ) { 
									foreach ($terms as $term ) { 
										echo ' term-' . $term -> slug; 
									} 
								}; 
								echo ' portfolio-item">
									<img class="team-member" src="' . $thumbnail[0] . '" alt="'. $alt_text .'"/>
									<h3>'.get_the_title().'</h3>
									<p>'.limit_words( get_the_content(), '66' ).'&hellip;</p>
									<span><a href="'.get_permalink().'">'.__('Learn More', 'silver').'</a></span>
								</li>';
							}
						endwhile;
					
					echo '</ul>'; ?>
						
					<ul class="folio-direction-nav">
						<li><?php next_posts_link( 'Older Entries', $the_query->max_num_pages ); ?></li>
						<li><?php previous_posts_link( 'Newer Entries' ); ?></li>
					</ul>
						
					<?php
					wp_reset_postdata();
				else:
					_e( 'Sorry, no posts matched your criteria.', 'silver' );
				endif;
				?>
			</div>
			
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
