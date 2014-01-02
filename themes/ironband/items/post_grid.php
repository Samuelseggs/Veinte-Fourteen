<article id="post-<?php the_ID(); ?>" <?php post_class('article'); ?>>
	<div class="holder">
		<a href="<?php the_permalink(); ?>">
			<div class="image">
				<?php the_post_thumbnail( array(326, 178) ); ?>
			</div>
			<div class="text">
				<h2><?php the_title(); ?></h2>
				<time class="date" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
				<i class="more icon-plus" title="<?php echo __("More", IRON_TEXT_DOMAIN); ?>"></i>
			</div>
		</a>
	</div>
</article>