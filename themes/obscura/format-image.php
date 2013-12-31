<?php if ( is_singular() && !is_page_template('template-blog.php') ) { ?>
	<h1 class="title"><?php the_title(); ?></h1>
<?php } else { ?>
	<div class="frame">
		<a href="<?php the_permalink(); ?>">
			<?php
				$images = rwmb_meta( 'rw_image', 'type=image&size=grid_image' );
				foreach ( $images as $image )
				{
					echo "<img src='{$image['url']}' alt='{$image['alt']}' />";
					break;
				}
			?>
		</a>
	</div>
	<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'elemis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php } ?>
