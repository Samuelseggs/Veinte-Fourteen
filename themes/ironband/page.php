<?php get_header(); ?>

		<!-- container -->
		<div class="container">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<!-- single-post -->
			<article id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
				<?php the_title('<h1>','</h1>'); ?>

				<!-- image -->
				<div class="image"><?php the_post_thumbnail(); ?></div>

				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
				</div>

<?php get_template_part('parts/share'); ?>

<?php comments_template(); ?>
			</article>
<?php endwhile; endif; ?>
		</div>

<?php get_footer();