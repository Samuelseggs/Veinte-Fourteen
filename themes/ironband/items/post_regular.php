<article id="post-<?php the_ID(); ?>" <?php post_class('media-block'); ?>>
	<a href="<?php the_permalink(); ?>">
		<div class="holder">
			<div class="image"><?php the_post_thumbnail( array(260, 174) ); ?></div>
			<div class="text-box">
				<i class="media-decoration media-video icon-play"></i>
				<h2><?php the_title(); ?></h2>
				<time class="date" datetime="<?php the_time('c'); ?>"><?php the_time( get_option('date_format') ); ?></time>
				<div class="excerpt">
					<?php the_excerpt(); ?>
				</div>
			</div>
		</div>
	</a>
</article>