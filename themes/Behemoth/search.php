<?php get_header(); ?>		

<div id="content" class="clearfix">
			
	<?php // the loop ?>
	<?php if (have_posts()) : ?>

		<div class="search-archive">

		<!-- BEGIN HIDE BUTTON -->
		<div class="showing-hide"></div>
		<!-- END HIDE BUTTON -->

		<!-- BEGIN SHOWING SEARCH RESULTS FOR -->
		<div class="showing">
			<?php _e( 'Showing results for:', 'bonfire' ); ?> <?php printf( '<span>' . get_search_query() . '</span>' ); ?>
		</div>
		<!-- END SHOWING SEARCH RESULTS FOR -->

			<?php
				$tag_description = tag_description();
				if ( ! empty( $tag_description ) )
					echo apply_filters( 'tag_archive_meta', '<div class="tag-archive-meta">' . $tag_description . '</div>' );
			?></div>

			<?php while (have_posts()) : the_post(); ?>
	
	<!-- BEGIN LOOP -->
	<?php get_template_part('includes/loop'); ?>
	<!-- END LOOP -->
	
	<?php endwhile; ?>
	
	<!-- BEGIN INCLUDE PAGINATION -->
	<div id="footer">
		<?php get_template_part('includes/pagination'); ?>
	</div>
	<!-- END INCLUDE PAGINATION -->

	<?php else : ?>

	<!-- BEGIN HIDE BUTTON -->
	<div class="showing-hide"></div>
	<!-- END HIDE BUTTON -->

	<!-- BEGIN NO SEARCH RESULTS FOUND -->
	<div class="showing">
		<?php _e( 'Sorry, no results for', 'bonfire' ); ?>: <?php printf( '<span>' . get_search_query() . '</span>' ); ?>
	</div>
	<!-- BEGIN NO SEARCH RESULTS FOUND -->

		<?php endif; ?>			
	
</div>
<!-- /#content -->

<?php get_footer(); ?>