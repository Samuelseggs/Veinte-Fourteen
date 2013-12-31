<?php get_header(); ?>		

<div id="content" class="clearfix">

	<?php // the loop ?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	
		<!-- BEGIN LOOP -->
		<?php get_template_part( 'includes/loop'); ?>
		<!-- END LOOP  -->
	
	<?php endwhile; ?>
	<?php else : ?>
		
		<!-- BEGIN NO CONTENT FOUND -->
		<p><?php _e( 'Apologies, nothing found.', 'bonfire' ); ?></p>
		<!-- END NO CONTENT FOUND -->
		
	<?php endif; ?>

</div>
<!-- END #content -->

<?php get_footer(); ?>