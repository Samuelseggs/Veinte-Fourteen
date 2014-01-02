<?php
/**
 * Template Name: Contact
 */

$single_column = ! has_existing_shortcode(get_field('contact_form'));

get_header(); ?>

		<!-- container -->
		<div class="container">
			<!-- breadcrumbs -->
			<?php iron_breadcrumbs(); ?>

			<?php the_title('<h1>','</h1>'); ?>
<?php	if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<!-- two-columns form-block -->
			<div class="two-columns form-block">
				<!-- column -->
				<div class="column">
					<h2><?php _e('Contact our booking agency', IRON_TEXT_DOMAIN); ?></h2>
					<div class="entry">
						<?php the_content(); ?>
						<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', IRON_TEXT_DOMAIN ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
					</div>
<?php		if ( $single_column ) { ?>
				</div>
				<!-- column -->
				<div class="column">
<?php		} ?>

					<!-- contact-box -->
					<div class="contact-box">
						<?php if( get_iron_option('contact_logo') != "") : ?>
							<img src="<?php echo get_iron_option('contact_logo'); ?>" width="103" height="103" alt="">
						<?php endif; ?>
						<address>
							<strong class="title"><?php echo get_iron_option('contact_name'); ?></strong>
							<?php if( get_iron_option('contact_address') != "") : ?>
							<p><?php echo get_iron_option('contact_address'); ?></p>
							<?php endif; ?>
							<p>
								<?php if( get_iron_option('contact_email') != "") : ?>
								<a href="mailto:<?php echo get_iron_option('contact_email'); ?>"><?php echo get_iron_option('contact_email'); ?></a>
								<?php endif; ?>

								<?php if( get_iron_option('contact_phone') != "") : ?>
									<strong class="phone"><?php echo get_iron_option('contact_phone'); ?></strong>
								<?php endif; ?>
							</p>
						</address>
					</div>
				</div>
<?php		if ( ! $single_column ) { ?>
				<!-- column -->
				<div class="column">
					<h2><?php _e('Contact us directly', IRON_TEXT_DOMAIN); ?></h2>
					<p class="error"></p>
					<!-- form -->
					<?php echo do_shortcode( get_field('contact_form') ); ?>
				</div>
<?php		} ?>
			</div>
<?php	endwhile; endif; ?>
		</div>

<?php get_footer(); ?>