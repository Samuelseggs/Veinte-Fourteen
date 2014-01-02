<?php
$image = get_field('img_image');

if ( ! empty($image) ) :
?>

	<li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<a href="<?php echo $image['url']; ?>" rel="lightbox" class="lightbox">
			<img src="<?php echo $image['sizes']['image-thumb']; ?>" alt="<?php esc_attr( get_the_title() ); ?>">
			<span class="hover-text"><span><?php echo __("VIEW IMAGE", IRON_TEXT_DOMAIN); ?></span></span>
		</a>
	</li>

<?php endif; ?>