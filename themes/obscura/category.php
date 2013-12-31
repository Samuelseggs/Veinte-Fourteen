<?php get_header(); ?>

<!-- Begin Intro -->
<div class="intro">
	<?php printf( __( 'Category Archives: %s', 'elemis' ), '' . single_cat_title( '', false ) . '' ); ?>
</div>
<?php include (TEMPLATEPATH . '/social.php'); ?>
<!-- End Intro -->

<!-- Begin Blog Grid -->
<div class="blog-wrap<?php if ( of_get_option('loading') ) { echo ' loading'; } ?>">
	<!-- Begin Blog -->
	<div class="blog-grid">
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