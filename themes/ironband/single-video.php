<?php

get_header();

$archive_page = get_iron_option('page_for_videos');
$archive_page = ( empty($archive_page) ? false : post_permalink($archive_page) );

?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<?php the_title('<h1>','</h1>'); ?>

			<!-- twocolumns -->
			<div id="twocolumns">
				<!-- content -->
				<div id="content">
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<!-- single-post video-post -->
					<div id="post-<?php the_ID(); ?>" <?php post_class('single-post video-post'); ?>>
						<!-- video-block -->
						<div class="video-block">
							<?php the_field('vid_video',$post->ID); ?>
						</div>

						<!-- meta -->
						<div class="meta">
							<time class="date" datetime="<?php the_time('c'); ?>"><?php the_date(); ?></time>
							<?php the_terms( $post->ID, 'video-category', '<span class="links">' . __('Category', IRON_TEXT_DOMAIN) . ': ', ', ', '</span>' ); ?>
						</div>

						<div class="entry">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div>

<?php	get_template_part('parts/share'); ?>

<?php	comments_template(); ?>
					</div>
				</div>
<?php endwhile; endif; ?>

				<!-- sidebar -->
				<aside id="sidebar">
					<!-- widget-box -->
					<section class="widget-box">
						<!-- title-box -->
						<header class="title-box">
							<?php echo iron_widget_action_link( 'video', 0, $archive_page ); ?>
							<h2><?php
								$post_type_object = get_post_type_object('video');
								$title = $post_type_object->label;

								printf( __('More %s', IRON_TEXT_DOMAIN), $title );
							?></h2>
						</header>
						<nav>
							<ul>
							<?php $args = array('post_type' => 'video'); ?>
							<?php $posts_array = get_posts( $args ); ?>
							<?php foreach( $posts_array as $post ) : setup_postdata($post); ?>
								<li><a href="<?php the_permalink(); ?>"><span><i class="icon-plus"></i> <?php the_title(); ?></span></a></li>
							<?php endforeach; ?>
							</ul>
						</nav>
					</section>

					<?php iron_show_categories('video-category'); ?>
				</aside>
			</div>
		</div>

<?php get_footer(); ?>