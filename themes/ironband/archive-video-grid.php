<?php
/**
 * Template Name: Video Posts (Grid)
 */

get_header();

$tax = 'video-category';
$terms = get_terms($tax);
$query = iron_get_posts('video', 1, -1);
?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<h1><?php the_title(); ?></h1>

<?php	if ( count($terms) > 0 ) : ?>
			<!-- filters-block -->
			<div class="filters-block">
				<span class="filter-heading"><?php echo __("FILTER BY", IRON_TEXT_DOMAIN); ?></span>
				<ul id="filter-type" class="filter">
					<li><a class="active" href="#" data-target="all"><?php _e('All', IRON_TEXT_DOMAIN); ?></a></li>
<?php		foreach ( $terms as $term ) :
				$target = sanitize_html_class($tax, 'tax') . '-' . sanitize_html_class($term->slug, $term->term_id); ?>
					<li><a href="#" data-target="<?php echo $target; ?>"><?php echo $term->name; ?></a></li>
<?php		endforeach; ?>
				</ul>
			</div>
<?php	endif; ?>

<?php	if ( $query->have_posts() ): ?>
			<!-- photos -->
			<ul id="filter-collection" class="filter-data photos-list">
<?php
			while ( $query->have_posts() ) :
				$query->the_post();

				get_template_part('items/video_grid');

			endwhile;
?>
			</ul>
<?php	endif; ?>

		</div>

<?php get_footer(); ?>