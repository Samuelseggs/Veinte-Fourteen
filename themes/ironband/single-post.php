<?php

get_header();

$archive_page = get_option('page_for_posts');
$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );

?>

		<!-- container -->
		<div class="container">
			<?php if(have_posts()) : while (have_posts()) : the_post();?>
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<?php the_title('<h1>','</h1>'); ?>
			<!-- twocolumns -->
			<div id="twocolumns">
				<!-- content -->
				<div id="content">
					<!-- single-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class('single-post'); ?>>
						<!-- image -->
						<div class="image"><?php the_post_thumbnail(array(696, 353)); ?></div>
						<!-- meta -->
						<div class="meta">
							<time class="date" datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time>
<?php

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __(', ', IRON_TEXT_DOMAIN) );
	if ( $categories_list ) {
		echo '<span class="links categories-links">' . sprintf(_x('%s: ', 'A term followed by a punctuation mark used to explain or start an enumeration.', IRON_TEXT_DOMAIN), __('Category', IRON_TEXT_DOMAIN)) . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __(', ', IRON_TEXT_DOMAIN) );
	if ( $tag_list ) {
		echo '<span class="links tags-links">' . sprintf(_x('%s: ', 'A term followed by a punctuation mark used to explain or start an enumeration.', IRON_TEXT_DOMAIN), __('Tag', IRON_TEXT_DOMAIN)) . $tag_list . '</span>';
	}

?>
						</div>

						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>

<?php get_template_part('parts/share'); ?>

<?php comments_template(); ?>
					</div>
				</div>
				<!-- sidebar -->
				<aside id="sidebar">
					<!-- widget-box -->
					<section class="widget-box">
						<!-- title-box -->
						<header class="title-box">
							<?php echo iron_widget_action_link( 'post', 0, $archive_page ); ?>
							<h2><?php
								if ( $title = get_iron_option('post_type_label') )
									$title = __($title, IRON_TEXT_DOMAIN);

								else {
									$post_type_object = get_post_type_object('post');
									$title = $post_type_object->label;
								}

								printf( __('More %s', IRON_TEXT_DOMAIN), $title );
							?></h2>
						</header>
						<?php
						$news = get_posts(
							array(
								'post_type' => 'post',
								'posts_per_page' => 10,
								'suppress_filters' => true,
								'exclude' => $post->ID
							)
						);
						if($news) :
						?>
						<nav>
							<ul>
								<?php foreach($news as $new) : ?>
									<li><a href="<?php echo get_permalink($new->ID); ?>"><i class="icon-plus"></i> <?php echo $new->post_title ?></a></li>
								<?php endforeach; ?>
							</ul>
						</nav>
						<?php else : ?>

							<h2><?php echo __("No more news to display.", IRON_TEXT_DOMAIN); ?></h2>

						<?php endif; ?>
					</section>

					<?php iron_show_categories('category'); ?>
				</aside>
			</div>
			<?php
					endwhile;
				endif;
			?>
		</div>


<?php get_footer(); ?>