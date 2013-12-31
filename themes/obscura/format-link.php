<?php $link = get_post_meta(get_the_ID(), 'rw_link', true); ?>
<?php if ( is_singular() && !is_page_template('template-blog.php') ) { ?>
	<h1 class="title"><a href="<?php echo "$link"; ?>" target="_blank"><?php the_title(); ?><span class="arrow">&rarr;</span></a></h1>
<?php } else { ?>
	<h2 class="title"><a href="<?php echo "$link"; ?>" target="_blank"><?php the_title(); ?><span class="arrow">&rarr;</span></a></h2>
<?php } ?>
