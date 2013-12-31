<?php get_header(); ?>
<!-- Begin Intro -->
<?php if ( of_get_option('home_intro') ) { echo '<div class="intro">'.of_get_option('home_intro').'</div>'."\n"; } ?>
<?php include (TEMPLATEPATH . '/social.php'); ?>
<!-- End Intro --> 

<!-- Begin Blog Grid -->
<div class="blog-wrap<?php if ( of_get_option('loading') ) { echo ' loading'; } ?>">
	<!-- Begin Blog -->
	<div class="blog-grid">
		<?php if ( have_posts() ) : ?>
		<?php if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
		} else {
		$paged = 1;
		}
		$recent_args = array(
		'order' => 'DESC',
		'paged' => $paged,
		'no_found_rows' => true,
		);
		$recent = new WP_Query( $recent_args );
		while ( $recent->have_posts() ) : $recent->the_post(); ?>
			<?php get_template_part( 'content' ); ?>
		<?php endwhile; ?>
		<?php else : ?>
			<div id="post-0" class="post no-results not-found">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'elemis' ); ?></h1>
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'elemis' ); ?></p>
				<?php get_search_form(); ?>
			</div>
		<?php endif; ?>
	</div>
	<!-- End Blog -->
</div>
<!-- End Blog Grid -->

<!-- Begin Page-navi -->
<?php elemis_content_nav( 'navigation' ); ?>
<!-- End Page-navi -->

<?php get_footer(); ?>
