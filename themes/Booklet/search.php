<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Silver
 */

get_header(); ?>

	<div id="primary" class="content-area page">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'silver' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>

				<h1 class="post-title spt"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

			<?php endwhile; ?>

		<?php endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>