<?php if(!is_single()) : global $more; $more = 0; endif; //enable more link ?>

<!-- BEGIN GET POST ID (FOR CUSTOM BACKGROUND COLOR) -->
<?php $bonfire_background_color = get_post_meta($post->ID, 'bonfire_background_color', true); ?>
<!-- END GET POST ID (FOR CUSTOM BACKGROUND COLOR) -->
<!-- BEGIN ALTERNATE POST BACKGROUND COLOR + FEATURED IMAGE AS BACKGROUND -->
<?php global $darkdarker; $darkdarker = ( $darkdarker == 'dark' ) ? 'darker' : 'dark'; ?>
<?php if ( has_post_thumbnail() ) { ?>
<div class="<?php echo $darkdarker ?>-image" style="background-image: url(<?php $image_id = get_post_thumbnail_id(); $image_url = wp_get_attachment_image_src($image_id,'large', true); echo $image_url[0];  ?>);background-size:cover;background-repeat:no-repeat;background-position:top center;z-index:-1;">
<?php } else { ?>
<div class="<?php if ( is_single() ) { ?>darker<?php } else { ?><?php echo $darkdarker ?><?php } ?> <?php echo $bonfire_background_color; ?>">
<?php } ?>
<!-- END ALTERNATE POST BACKGROUND COLOR + FEATURED IMAGE AS BACKGROUND -->


<!-- BEGIN DIV WRAPPER IF FEATURED IMAGE USED -->
<?php if ( has_post_thumbnail() ) { ?>
<div class="<?php if($bonfire_background_color !== ' ') { ?>post-background-opacity<?php } ?> <?php echo $bonfire_background_color; ?>">
<!-- BEGIN TOGGLE SHOW/HIDE CONTENT IF FEATURED IMAGE USED -->
<div class="featured-image-toggle-wrapper">
<a href="#"><div class="featured-image-toggle"></div></a>
</div>
<!-- END TOGGLE SHOW/HIDE CONTENT IF FEATURED IMAGE USED -->
<?php } ?>
<!-- END DIV WRAPPER IF FEATURED IMAGE USED -->

<div class="content-wrapper">

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	
		<!-- BEGIN TITLE -->
		<h1 class="post-title">
			<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'bonfire' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark">
				<?php the_title(); ?>
			</a>
		</h1>
		<!-- END TITLE -->
		
		<!-- BEGIN TITLE SPACER IMAGE -->
		<div class="title-spacer"></div>
		<!-- END TITLE SPACER IMAGE -->
		
		<!-- BEGIN CONTENT -->
		<div class="entry-content">
			<?php the_content(''); ?>
		</div>
		<!-- END CONTENT -->
		
		<!-- BEGIN AUTHOR + DATE + TAGS WRAPPER -->
		<?php if(is_single() ) { ?>
		<div class="author-date-tags-wrapper">
		
			<!-- BEGIN POST AUTHOR + DATE -->
			<div class="post-meta-author-date">
				<?php _e( 'by', 'bonfire' ); ?>
					<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
						<?php printf( get_the_author() ); ?>
					</a>
					<time datetime="<?php echo esc_attr( the_time('o-m-d') ); ?>"><?php the_time('M j, Y') ?></time>
			</div>
			<!-- END POST AUTHOR + DATE -->
			
			<!-- BEGIN POST TAGS -->
			<?php the_tags('<div class="post-meta-tags">'.__('Tagged with: ', 'bonfire').'',', ', '</div>'); ?>
			<!-- END POST TAGS -->
			
		</div>
		<?php } ?>
		<!-- END AUTHOR + DATE + TAGS WRAPPER -->
		
		<!-- BEGIN VIEW/LEAVE COMMENTS -->
		<?php if(is_single() ) { ?>
		<?php } else { ?>
			<a class="read-leave-comments" href="<?php the_permalink(); ?>">
			
				<!-- BEGIN READ MORE LINK -->
				<?php if( strpos( $post->post_content , "<!--more-->" ) != false ) { ?>
					<?php _e( 'VIEW FULL POST +', 'bonfire' ); ?>
				<?php } ?>
				<!-- END READ MORE LINK -->
				
				<!-- BEGIN COMMENT COUNT -->
				<?php if ( have_comments() || comments_open() ) : ?>
				<?php comments_number( 'LEAVE A COMMENT', 'VIEW ONE COMMENT', 'VIEW % COMMENTS' ); ?>
				<?php else : if ( ! comments_open() ) :?>
				<?php _e( 'COMMENTS CLOSED', 'bonfire' ); ?>
				<?php endif; // end ! comments_open() ?>
				<?php endif; // end have_comments() || comments_open() ?>
				<!-- END COMMENT COUNT -->
		
			</a>
		<?php } ?>
		<!-- END VIEW/LEAVE COMMENTS -->
		
		<!-- BEGIN POST NAVIGATION -->
		<div class="link-pages">
			<?php wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'bonfire').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
		</div>
		<!-- END POST NAVIGATION -->
		
		<!-- BEGIN EDIT POST LINK -->
		<?php edit_post_link(__('EDIT', 'bonfire')); ?>
		<!-- END EDIT POST LINK -->
	
	</article>
	
</div>
<!-- /.content-wrapper -->

<!-- BEGIN DIV WRAPPER IF FEATURED IMAGE USED -->
<?php if ( has_post_thumbnail() ) { ?>
</div>
<?php } ?>
<!-- END DIV WRAPPER IF FEATURED IMAGE USED -->

</div>
<!-- /.post -->