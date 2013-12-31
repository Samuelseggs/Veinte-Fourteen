<?php 

/* Template Name: Contact */

get_header();
global $smof_data; ?>

	<div id="primary" class="content-area page">
		<main id="main" class="site-main" role="main">
			<h1 style="clear: both; display: block;" class="page-title"><?php the_title(); ?></h1>
		
			<div style="background: none; padding-left: 10px;" class="left sidebar">
				<?php echo $smof_data['contact_extra'] != "" ? $smof_data['contact_extra'] : 'Add contact extra information in the contact section of the theme options.'; ?>
			</div>
			
			<div style="padding: 0 10px 0 0; width: 65%;" class="right-content">
				<?php
					$script = get_template_directory_uri() . '/js/jquery.gmap.min.js';
					$output = '
					
						<!-- Google Maps -->
						<div id="googlemaps" class="google-map google-map-full" style="height: 300px;"></div>

						<script src="http://maps.google.com/maps/api/js?sensor=true"></script>
						<script src="'.$script.'"></script>
					
						<script type="text/javascript">
							jQuery("#googlemaps").gMap({
								maptype: "ROADMAP",
								scrollwheel: true,
								zoom: 15,
								markers: [
									{
										address: "';
										$smof_data['map_address'] != "" ? $output .= $smof_data['map_address'] : $output .= 'New York, United States';
										$output .= '", // Your Adress Here
										html: "';
										$smof_data['map_description'] != "" ? $output .= $smof_data['map_description'] : $output .= 'This is the map description';
										$output .='",
										popup: true
									}

								],
								
							});
						</script>';

					echo $output;
				?>

				<?php while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<?php the_content(); ?>
					</article>

				<?php endwhile; ?>
			</div>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_footer(); ?>
