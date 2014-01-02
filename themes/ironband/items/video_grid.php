<?php
$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'image-thumb' );

if ( ! empty($image)) :
?>

	<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php echo get_permalink($post->ID) ?>">
			<img src="<?php echo $image[0]; ?>" alt="<?php esc_attr( get_the_title() ); ?>">
			<span class="hover-text"><span><?php the_title(); ?></span></span>
		</a>
	</li>

<?php endif; ?>