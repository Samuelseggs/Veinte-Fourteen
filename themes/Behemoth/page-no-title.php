<?php
/*
Template Name: No Title
*/
?>
<?php get_header(); ?>

	<div id="content" class="clearfix">

<!-- BEGIN GET POST ID (FOR CUSTOM BACKGROUND COLOR) --><?php $bonfire_background_color = get_post_meta($post->ID, 'bonfire_background_color', true); ?><!-- END GET POST ID (FOR CUSTOM BACKGROUND COLOR) -->
<!-- BEGIN PAGE BACKGROUND COLOR + FEATURED IMAGE AS BACKGROUND -->
<?php if ( has_post_thumbnail() ) { ?>
<div class="darker-image" style="background-image: url(<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>);background-size:cover;background-repeat:no-repeat;background-position:top center;z-index:-1;">
<?php } else { ?>

<div class="darker <?php echo $bonfire_background_color; ?>">
<?php } ?>
<!-- END PAGE BACKGROUND COLOR + FEATURED IMAGE AS BACKGROUND -->

<!-- BEGIN CUSTOM FIELD FOR EMBEDDABLE MAP -->
<?php $map = get_post_meta($post->ID, 'Map', true); ?>
<div class="map-container"><?php echo $map; ?></div>
<!-- END CUSTOM FIELD FOR EMBEDDABLE MAP -->

<!-- BEGIN DIV WRAPPER IF FEATURED IMAGE USED -->
<?php if ( has_post_thumbnail() ) { ?>
<div class="<?php if($bonfire_background_color !== ' ') { ?>post-background-opacity<?php } ?> <?php echo $bonfire_background_color; ?>">
<!-- BEGIN TOGGLE SHOW/HIDE CONTENT IF FEATURED IMAGE USED -->
<div class="featured-image-toggle-wrapper">
<a href="#"><div class="featured-image-toggle"></div></a>
</div>
<!-- END TOGGLE SHOW/HIDE CONTENT IF FEATURED IMAGE USED -->
<?php } ?>
<!-- END DIV WRAPPER IF FEATURED IMAGE USED -->

<div class="content-wrapper">

<div class="page-wrapper">

		<?php while ( have_posts() ) : the_post(); ?>

<!-- BEGIN PAGE CONTENT -->
<div class="entry-content"><?php the_content(); ?></div>
<!-- END PAGE CONTENT -->
			
<!-- BEGIN POST NAVIGATION -->
<div class="link-pages">
<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'bonfire').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
</div>
<!-- END POST NAVIGATION -->
			
<!-- BEGIN EDIT POST LINK -->
<?php edit_post_link(__('EDIT', 'bonfire')); ?>
<!-- END EDIT POST LINK -->

		<?php endwhile; ?>

	</div>

	</div>
	</div>

<!-- BEGIN DIV WRAPPER IF FEATURED IMAGE USED -->
<?php if ( has_post_thumbnail() ) { ?>
</div>
<?php } ?>
<!-- END DIV WRAPPER IF FEATURED IMAGE USED -->

	</div>
	<!-- /#content -->

<?php get_footer(); ?>