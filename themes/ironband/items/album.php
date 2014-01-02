<div id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<?php if(get_field('alb_link_external')): ?>
	<a target="_blank" href="<?php echo get_field('alb_link_external'); ?>">
	<?php else: ?>
	<a href="<?php the_permalink(); ?>">
	<?php endif; ?>
		<div class="holder">
			<div class="image"><?php the_post_thumbnail( array(216,216) ); ?></div>
			<div class="text-box">
				<i class="media-decoration media-audio icon-headphones"></i>
				<h2><?php the_title(); ?></h2>
				<?php if(get_field('alb_release_date') != '') : ?>
				<time class="date" datetime="<?php echo date( 'c', strtotime( get_field('alb_release_date') ) ); ?>"><?php echo __("Release date", IRON_TEXT_DOMAIN); ?> <?php the_field('alb_release_date'); ?></time>
				<?php endif; ?>
			</div>
		</div>
	</a>
</div>