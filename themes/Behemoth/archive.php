<?php get_header(); ?>		

<div id="content" class="clearfix">

	<?php // the loop ?>
	<?php if (have_posts()) : ?>

		<!-- BEGIN HIDE BUTTON -->
		<div class="showing-hide"></div>
		<!-- END HIDE BUTTON -->

		<?php if ( is_day() ) : ?>
			<div class="showing">
				<?php _e( 'Daily archives', 'bonfire' ); ?> <span><?php printf( get_the_date() ); ?></span>
			</div>

		<?php elseif ( is_month() ) : ?>
			<div class="showing">
				<?php _e( 'Monthly archives', 'bonfire' ); ?> <span><?php printf( get_the_date( _x( 'F Y', 'monthly archives format', 'bonfire' ) ) ); ?></span>
			</div>

		<?php elseif ( is_year() ) : ?>
			<div class="showing">
				<?php _e( 'Yearly archives', 'bonfire' ); ?> <span><?php printf( get_the_date( _x( 'Y', 'yearly archives format', 'bonfire' ) ) ); ?></span>
			</div>

		<?php else : ?>
			<?php ( 'Blog Archives' ); ?>
		<?php endif; ?>

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