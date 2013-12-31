<?php if ( is_singular() && !is_page_template('template-blog.php') ) { ?>
	<h1 class="title"><?php the_title(); ?></h1>
<?php } else { ?>
	<div class="slider flexslider">
		<ul class="slides">
			<?php
				$images = rwmb_meta( 'rw_gallery_images', 'type=image&size=gallery_grid' );
				$attachment_page = get_attachment_link( $attachment->ID);
				foreach ( $images as $image )
				{
					echo "<li><div class='outer'><span class='inset'><a href='$attachment_page'>";
					echo "<img src='{$image['url']}' alt='{$image['alt']}' />";
					echo "</a></span></div></li>";
				}
			?>
		</ul>
	</div>
	<div class="clear"></div>
	<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'elemis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php } ?>