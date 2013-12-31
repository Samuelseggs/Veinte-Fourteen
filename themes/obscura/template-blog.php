<?php
/**
* Template Name: Blog
*/
get_header(); ?>

<?php include (TEMPLATEPATH . '/intro.php'); ?>

<!-- Begin Blog Grid -->
<div class="blog-wrap<?php if ( of_get_option('loading') ) { echo ' loading'; } ?>">
	<!-- Begin Blog -->
	<div class="blog-grid">
		<?php  
		if ( get_query_var('paged') ) {
		$paged = get_query_var('paged');
		} elseif ( get_query_var('page') ) {
		$paged = get_query_var('page');
		} else {
		$paged = 1;
		}
		query_posts( array( 'post_type' => 'post', 'paged' => $paged ) );?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
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