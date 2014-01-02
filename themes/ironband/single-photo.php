<?php get_header(); ?>

		<!-- container -->
		<div class="container">
<?php
while ( have_posts() ) : the_post();
	$image = get_field('img_image');
?>
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php the_title('<h1>','</h1>'); ?>

				<img src="<?php echo $image['url']; ?>" width="100%" alt="<?php esc_attr( get_the_title() ); ?>">
			</div>
<?php
endwhile;
?>
		</div>

<?php get_footer(); ?>