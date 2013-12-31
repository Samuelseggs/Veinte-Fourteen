<?php
/**
* Template Name: Social Timeline
*/
get_header(); ?>

<?php include (TEMPLATEPATH . '/intro.php'); ?>

<!-- Begin Container -->
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
	<div class="social-wrapper"> 
		<?php the_content(); ?>
	</div>
<?php endwhile; endif; ?>
<!-- End Container -->

<?php get_footer(); ?>


