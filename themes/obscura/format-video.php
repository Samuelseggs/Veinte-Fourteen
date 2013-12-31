<?php if ($media = get_post_meta(get_the_ID(), 'rw_video', true)) {echo "<div class='video frame'>$media</div>";} ?>
<?php if ( is_singular() && !is_page_template('template-blog.php') ) { ?>
	<h1 class="title"><?php the_title(); ?></h1>
<?php } else { ?>
	<h2 class="title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'elemis' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
<?php } ?>
