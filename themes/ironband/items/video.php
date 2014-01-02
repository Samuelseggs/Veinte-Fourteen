<?php

$term = get_field('vid_category');

if ( $term && is_array($term) )
{
	$term = get_term($term[0], 'video-category');
}

?>
<div id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<div class="image"><?php the_post_thumbnail( array(260, 174) ); ?></div>
			<div class="text-box">
				<i class="media-decoration media-video icon-play"></i>
				<h2><?php the_title(); ?></h2>
<?php if ( ! empty($term->name) ) { ?>
				<span class="category"><?php echo $term->name; ?></span>
<?php } ?>
			</div>
		</div>
	</a>
</div>