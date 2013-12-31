<?php get_header(); ?>

<div id="primary" class="content-area">
	
	<?php while ( have_posts() ) : the_post(); ?>
		
		<?php 
		$sidebarDisplay = get_post_meta( get_the_ID(), 'silver_sidebar_radio', true );
		$sidebarRight = get_post_meta( get_the_ID(), 'silver_sidebar_rl', true );
		?>
		<div class="post-single clearfix">
			<div class="left <?php if($sidebarDisplay == 'hide') echo 'fixed '; if($sidebarRight == 'right') echo 'sidebar_right '; ?>sidebar">
				<?php 
				if ( has_post_thumbnail() ) {
					echo '<div class="single-img">';
						the_post_thumbnail();
					echo '</div>';
				} 
				?>
				
				<?php
				if($sidebarDisplay != 'hide') get_sidebar(); ?>
				
				<div class="sidebar-sticky">
					<a class="b-button" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Back'); ?></a>
					<?php 
						if($smof_data['hide_s_ch'] == false) {
							get_template_part( 'inc/bottom_menu' );
						}
					?>
				</div>
			</div>
			<div <?php if($sidebarRight == 'right') echo 'style="float: left;"'; ?> class="right-content">
				<span class="cat">
					<?php 
					$categories_list = get_the_category_list( __( ', ', 'silver' ) );
					$terms = get_the_terms( get_the_ID(), 'filter' );
						if( $terms ) { 
							foreach ($terms as $term ) { 
								echo ' '.$term->slug; 
							} 
						} elseif( $categories_list ) echo $categories_list;
					?>
				</span>
				<?php 
					if($smof_data['hide_ch'] == false) {
						get_template_part( 'inc/top_menu' );
					}
				?>
				<span class="author"><?php _e('by', 'silver'); ?> <?php the_author(); ?>
				<?php if(get_the_tag_list()) { ?>- <span><?php _e('tagged:', 'silver'); ?></span><?php echo get_the_tag_list(' ', ', '); ?><?php }; ?></span>
				<h1 class="post-title"><?php the_title(); ?></h1>
				<?php the_content(); ?>
				<?php
					wp_link_pages( array(
						'before' => '<div class="page-links">' . __( 'Pages:', 'silver' ),
						'after'  => '</div>',
					) );
				?>
				<?php
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
				?>
			</div>
		</div>

	<?php endwhile; ?>
</div>

<?php get_footer(); ?>