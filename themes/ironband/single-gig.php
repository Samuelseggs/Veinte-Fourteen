<?php get_header(); ?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<?php the_title('<h1>','</h1>'); ?>
			<ul id="gigs" class="concerts-list">
				<li id="post-<?php the_ID(); ?>" <?php post_class('expanded'); ?>>
					<div class="title-row">
						<?php iron_the_gig_date(); ?>
						<span class="location"><?php the_field('gig_city'); ?></span>
						<span>@<?php the_field('gig_venue'); ?></span>
						<div class="buttons">
							<a id="gig1" class="open-link" href="#">
								<span class="opener"><?php _e(get_iron_option('gig_more_alt_label'), IRON_TEXT_DOMAIN); ?></span>
							</a>
							<a class="link" target="_blank" href="<?php the_field('gig_map'); ?>"><?php _e("View Map", IRON_TEXT_DOMAIN); ?></a>
							<a class="button" href="<?php the_field('gig_tickets'); ?>"><?php _e("TICKETS", IRON_TEXT_DOMAIN); ?></a>
						</div>
					</div>
					<!-- slide -->
					<div class="slide">
						<div class="holder">
							<div class="entry">
								<?php the_content(); ?>
								<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
							</div>
						</div>
					</div>
				</li>
			</ul>
		</div>

<?php get_footer(); ?>