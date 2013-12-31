<?php get_header(); ?>		

<div id="content" class="clearfix">

	<?php // the loop ?>
	<?php if (have_posts()) : ?>

			<?php if ( have_posts() ) the_post(); ?>

			<!-- BEGIN HIDE BUTTON -->
			<div class="showing-hide"></div>
			<!-- END HIDE BUTTON -->

			<div class="showing">
				<?php _e( 'Showing posts by', 'bonfire' ); ?> <span><?php printf( "" . get_the_author() . "" ); ?></span>
			</div>
			
			<?php rewind_posts(); ?>
		
	<?php while (have_posts()) : the_post(); ?>
	
	<!-- BEGIN LOOP -->
	<?php get_template_part( 'includes/loop'); ?>
	<!-- END LOOP -->

	<?php endwhile; ?>

	<!-- BEGIN INCLUDE PAGINATION -->
	<div id="footer">
		<?php get_template_part('includes/pagination'); ?>
	</div>
	<!-- END INCLUDE PAGINATION -->

	<?php endif; ?>			
	
</div>
<!-- /#content -->

<?php get_footer(); ?>