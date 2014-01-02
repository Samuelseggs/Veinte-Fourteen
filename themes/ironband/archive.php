<?php

get_header();

global $post_type, $item_template, $post, $wp_query;

if($item_template === null)
	$item_template = $post_type;

$paged = ( get_query_var('paged') ? get_query_var('paged') : 1 );

if ( empty( $post_type ) )
	$post_type = get_post_type();

// Prevent extra database query by enabling permalink structure
if ( $post_type !== get_post_type() )
	query_posts( array(
		'post_type' => $post_type,
		'paged' => $paged
	) );

$post_type_object = get_post_type_object( $post_type );
$page_for_archive = ( 'post' == $post_type ? get_option('page_for_posts') : get_iron_option('page_for_' . $post_type . 's') );

$attr = array(
	'data-type="' . $post_type . '"',
	'data-page="' . $paged . '"'
);

if ( is_day() ) :
	$archive_title = sprintf( __('Daily Archives: %s', IRON_TEXT_DOMAIN), get_the_date() );
elseif ( is_month() ) :
	$archive_title = sprintf( __('Monthly Archives: %s', IRON_TEXT_DOMAIN), get_the_date( _x('F Y', 'monthly archives date format', IRON_TEXT_DOMAIN) ) );
elseif ( is_year() ) :
	$archive_title = sprintf( __('Yearly Archives: %s', IRON_TEXT_DOMAIN), get_the_date( _x('Y', 'yearly archives date format', IRON_TEXT_DOMAIN) ) );
elseif ( ! empty($post_type_object->label) ) :

	if(isset($wp_query->queried_object) && isset($wp_query->queried_object->ID))
		$archive_title = get_the_title($wp_query->queried_object->ID);
	else
		$archive_title = get_the_title($post->ID);

endif;


if ( is_tax() )
{
	$taxonomy = get_query_var('taxonomy');
	$term = get_term_by( 'slug', get_query_var('term'), $taxonomy );

} elseif ( is_category() ) {
	$taxonomy = 'category';
	$term = get_category( get_query_var('cat') );

} elseif ( is_tag() ) {
	$taxonomy = 'post_tag';
	$term = get_term_by( 'slug', get_query_var('tag'), $taxonomy );
}

if ( ! empty($term) && ! is_wp_error( $term ) )
{
	$archive_title = $term->name;

	$attr[] = 'data-taxonomy="' . $taxonomy . '"';
	$attr[] = 'data-term="' . $term->term_id . '"';
}

$paginate_method = get_iron_option('paginate_method');
$attr[] = 'data-paginate="' . $paginate_method . '"';
$attr[] = 'data-template="' . $item_template . '"';

if($paginate_method == 'paginate_scroll')
	$paginate_method = "paginate_more";

$sidebar_enabled = false;

switch ( $post_type ) {
	case 'post':
		$tag = 'div';

		if(empty($item_template))
			$item_template = 'post';

		if($item_template == 'post_grid')
			$class = 'articles-section';
		else
			$class = 'listing-section news';

		$caption = 'Older News';
		$next = 'Older News';
		$prev = 'Recent News';
		$sidebar_enabled = ( get_iron_option('sidebar_for_posts') ? get_iron_option('sidebar_for_posts') : false);
		break;

	case 'gig':
		$tag = 'ul';
		$class = 'concerts-list';

		$attr[] = 'data-active="' . ( empty($_GET['id']) ? '' : $_GET['id'] ) . '"';
		$attr[] = 'data-callback="initAccordion,initAnchorGigs"';
		$caption = 'More Gigs';
		$next = 'Next Gigs';
		$prev = 'Previous Gigs';
		break;

	case 'album':
		$tag = 'div';
		$class = 'listing-section';
		$caption = 'More Albums';
		$next = 'Next Albums';
		$prev = 'Previous Albums';
		break;

	case 'photo':
		$tag = 'ul';
		$class = 'filter-data photos-list';
		$caption = 'More Photos';
		break;

	case 'video':
		$tag = 'div';
		$class = 'listing-section videos';
		$caption = 'More Videos';
		$next = 'Next Videos';
		$prev = 'Previous Videos';
		$sidebar_enabled = ( get_iron_option('sidebar_for_videos') ? get_iron_option('sidebar_for_videos') : false);

		break;

	default:
		$class = 'post-listing';
		$caption = 'Older Posts';
		$next = 'Next Posts';
		$prev = 'Previous Posts';
		break;
}

if ( empty($archive_title) )
	$archive_title = __('Archives', IRON_TEXT_DOMAIN);

$attr[] = 'data-caption="' . __($caption, IRON_TEXT_DOMAIN) . '"';

?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<h1><?php echo $archive_title; ?></h1>

<?php
if ( $sidebar_enabled ) :
?>
			<div id="twocolumns">
				<div id="content">
<?php
endif;
?>

			<!-- post-list -->
<?php
if ( $paginate_method == 'paginate_more' ) :
?>

				<<?php echo $tag; ?> id="post-list" class="<?php echo $class; ?>"></<?php echo $tag; ?>>

<?php
else :
?>

				<<?php echo $tag; ?> id="post-list" class="<?php echo $class; ?>">

<?php

	if ( have_posts() ) :
		while ( have_posts() ) : the_post();

			get_template_part('items/' . $item_template);

		endwhile;
	endif;

?>

				</<?php echo $tag; ?>>

<?php
endif;

if ( $paginate_method == 'paginate_more' ) :
?>

			<a data-rel="post-list" <?php echo implode(' ', $attr); ?> class="button-more" href="#"><?php _e($caption, IRON_TEXT_DOMAIN); ?></a>

<?php
elseif ( $paginate_method == 'paginate_links' ) :
?>

				<div class="pages full clear">
					<?php iron_full_pagination(); ?>
				</div>

<?php
else :
?>

				<div class="pages clear">
					<div class="alignleft"><?php previous_posts_link('&laquo; '.__($prev), ''); ?></div>
					<div class="alignright"><?php next_posts_link(__($next).' &raquo;',''); ?></div>
				</div>

<?php
endif;

if ( $sidebar_enabled ) :
?>
				</div>

				<!-- sidebar -->
				<aside id="sidebar">
					<?php
						$taxonomy = 'category';
						if ( $post_type != 'post' )
							$taxonomy =  $post_type . '-' . $taxonomy;

						iron_show_categories($taxonomy);
					?>
				</aside>
			</div>
<?php
endif;
?>

		</div>

<?php

get_footer();