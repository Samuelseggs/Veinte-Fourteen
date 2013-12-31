<!-- Begin Post #post-<?php the_ID(); ?> -->
<div id="post-<?php the_ID(); ?>" <?php post_class('box'); ?>> 
<?php 
	$format = get_post_format(); 
	if( false === $format ) { $format = 'standard'; }
	if( $format == 'standard' || $format == 'quote' || $format == 'image' || $format == 'gallery' || $format == 'video' || $format == 'audio' || $format == 'chat' || $format == 'link' ) {} 
?>

<?php if ( is_singular() && !is_page_template('template-blog.php') ) { ?>
	<div class="details">
		<span class="icon-<?php echo $format; ?>"><?php the_time(get_option('date_format')); ?></span>
		<span class="likes"><?php printLikes(get_the_ID()); ?></span>
		<span class="comments"><?php comments_popup_link( __( '0', 'elemis' ), __( '1', 'elemis' ), __( '%', 'elemis' ) ); ?></span>
	</div>
	
	<?php get_template_part( 'format', get_post_format() ); ?>
	<?php the_content(); ?>
	
	<?php if ($tags = wp_get_post_tags($post->ID)) { ?><div class="tags"><?php the_tags('', ', ', ''); ?> </div><?php } ?>
	<div class="post-nav">
		<span class="nav-prev"><?php previous_post_link( '%link', '&larr; %title' ); ?></span>
		<span class="nav-next"><?php next_post_link( '%link', '%title &rarr;' ); ?></span>
		<div class="clear"></div>
	</div>

<?php } else { ?>

	<?php get_template_part( 'format', get_post_format() ); ?>
	<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'elemis' ) ); ?>

	<div class="details">
		<span class="icon-<?php echo $format; ?>"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'elemis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_time(get_option('date_format')); ?></a></span>
		<span class="likes"><?php printLikes(get_the_ID()); ?></span>
		<span class="comments"><?php comments_popup_link( __( '0', 'elemis' ), __( '1', 'elemis' ), __( '%', 'elemis' ) ); ?></span>
	</div>
	
<?php } ?>
</div>
<!-- End Post #post-<?php the_ID(); ?> --> 