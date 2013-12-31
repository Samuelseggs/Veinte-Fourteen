<?php get_header(); ?>		

<div id="content" class="clearfix">

	<?php // the loop ?>
	<?php if (have_posts()) : ?>

		<!-- BEGIN TAG + TAG DESCRIPTION -->
		<div class="showing">

			<!-- BEGIN HIDE BUTTON -->
			<div class="showing-hide"></div>
			<!-- END HIDE BUTTON -->

			<!-- BEGIN TAG -->
			<?php _e( 'Displaying all posts tagged with', 'bonfire' ); ?> <?php printf( '<span>' . single_tag_title( '', false ) . '</span>' ); ?>
			<!-- END TAG -->
	
			<!-- BEGIN TAG DESCRIPTION -->
			<div class="tag-description">
				<?php $tag_description = tag_description();	if ( ! empty( $tag_description ) ) echo apply_filters( 'tag_archive_meta', '' . $tag_description . '' ); ?>
			</div>
			<!-- END TAG DESCRIPTION -->

		</div>
		<!-- BEGIN TAG + TAG DESCRIPTION -->

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