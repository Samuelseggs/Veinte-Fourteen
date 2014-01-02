<?php

$expanded = ( isset($_GET['id']) && $_GET['id'] == get_the_ID() ? 'expanded' : false );

?>

<li id="post-<?php the_ID(); ?>" <?php post_class($expanded); ?>>
	<!-- title-row -->
	<div class="title-row">
		<i class="icon-concert-dropdown"></i>
		<?php iron_the_gig_date(); ?>
		<span class="location"><?php the_title(); ?></span>
<?php if ( get_field('gig_city') ) { ?>
		<span>@<?php the_field('gig_city'); ?></span>
<?php } ?>
		<div class="buttons">
			<a id="gig1" class="open-link" href="#">
				<span class="opener"><?php _e(get_iron_option('gig_more_alt_label'), IRON_TEXT_DOMAIN); ?></span>
			</a>

<?php if ( get_field('gig_map') ) { ?>
			<a class="link" target="_blank" href="<?php the_field('gig_map'); ?>"><?php _e("View Map", IRON_TEXT_DOMAIN); ?></a>
<?php } ?>
<?php if ( get_field('gig_tickets') ) { ?>
			<a class="button" target="_blank" href="<?php the_field('gig_tickets'); ?>"><?php _e("TICKETS", IRON_TEXT_DOMAIN); ?></a>
<?php } ?>

		</div>
	</div>
	<!-- slide -->
	<div class="slide">
		<div class="entry holder">
			<?php if ( get_field('gig_venue') ) { ?>
			<h2><?php the_field('gig_venue'); ?></h2>
			<?php } ?>
			<?php the_content(); ?>
		</div>
	</div>
</li>