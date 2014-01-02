<?php get_header(); ?>

		<!-- container -->
		<div class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<?php the_title('<h1>','</h1>'); ?>

			<!-- info-section -->
			<div id="post-<?php the_ID(); ?>" <?php post_class('info-section'); ?>>
				<!-- aside -->
				<div class="aside">
					<!-- image -->
					<div class="image"><?php the_post_thumbnail( array(330, 330) ); ?></div>
					<!-- buttons-block -->
<?php	if ( get_field('alb_store_list') ) : ?>
					<div class="buttons-block">
						<strong class="title"><?php echo __("NOW AVAILABLE! FIND IT ON", IRON_TEXT_DOMAIN); ?>:</strong>
						<ul>
							<?php while(has_sub_field('alb_store_list')): ?>
							<li><a class="button" href="<?php echo esc_url( get_sub_field('store_link') ); ?>"><?php the_sub_field('store_name'); ?></a></li>
							<?php endwhile; ?>
						</ul>
					</div>
<?php	endif; ?>
				</div>
				<!-- description-column -->
				<div class="description-column">
<?php	if ( get_field('alb_tracklist') ) : ?>
					<!-- tracks-block -->
					<section class="tracks-block">
						<h2><?php echo __("TRACKLISTING", IRON_TEXT_DOMAIN); ?></h2>
						<!-- tracks-list -->
						<ol class="tracks-list">
<?php		while ( has_sub_field('alb_tracklist') ) : ?>
							<li data-media="<?php echo esc_url( get_sub_field('track_mp3') ); ?>">
								<span class="name"><?php the_sub_field('track_title'); ?></span>
								<div class="buttons">
<?php			if ( get_sub_field('track_store') ) { ?>
									<a class="button" href="<?php echo esc_url( get_sub_field('track_store') ); ?>"><?php echo __("BUY TRACK", IRON_TEXT_DOMAIN); ?></a>
<?php			}

				if ( get_sub_field('track_mp3') ) { ?>
									<div class="jp-jplayer "></div>
									<!-- jp-audio player-box -->
									<div class="jp-audio player-box">
										<div class="jp-type-playlist">
											<div class="jp-gui jp-interface">
												<!-- jp-controls -->
												<ul class="jp-controls">
													<li><a href="javascript:;" class="jp-play btn-play" tabindex="1"><i class="icon-headphones" title="<?php echo __("play", IRON_TEXT_DOMAIN); ?>"></i></a></li>
													<li><a href="javascript:;" class="jp-pause btn-pause" tabindex="1"><i class="icon-pause" title="<?php echo __("pause", IRON_TEXT_DOMAIN); ?>"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
<?php			} ?>
								</div>
							</li>
<?php		endwhile; ?>
						</ol>
					</section>
<?php	endif; ?>

<?php	if ( get_the_content() ) : ?>
					<!-- content-box -->
					<section class="content-box">
						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>
					</section>
<?php	endif; ?>

<?php	if ( get_field('alb_review') ) : ?>
					<!-- content-box -->
					<section class="content-box">
						<h2><?php _e('Album Reviews', IRON_TEXT_DOMAIN); ?></h2>
<?php		if ( get_field('alb_review') || get_field('alb_review_author') ) : ?>
			<!-- blockquote-box -->
						<figure class="blockquote-block">
<?php			if ( get_field('alb_review') ) : ?>
							<blockquote><?php the_field('alb_review'); ?></blockquote>
<?php
				endif;

				if ( get_field('alb_review_author') ) :
?>
							<figcaption><?php the_field('alb_review_author'); ?></figcaption>
<?php
			endif;
?>
						</figure>
<?php		endif; ?>
					</section>
<?php	endif; ?>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
				</div>
			</div>
<?php endwhile; endif; ?>
		</div>

<?php get_footer(); ?>