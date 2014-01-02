<?php

/**
 * Upgrade
 *
 * All the functionality for upgrading IronBand
 *
 * @since 1.5.0
 */

function iron_upgrade () {
	global $wpdb; // $iron_updates

	# Don't run on theme activation
	if ( isset($_GET['activated']) && $_GET['activated'] == 'true' )
	{
		return;
	}

	$iron_theme = wp_get_theme();
	$old_version = get_option('ironband_version', '1.0.0'); // false
	$new_version = $iron_theme->get('Version'); // $iron_updates[0]['version'];

	if ( $new_version !== $old_version )
	{
		/*
		 * 1.4.0
		 *
		 * Migrate `gig_date` values from ACF
		 * to `post_date` from WordPress.
		 *
		 * @created 2013-09-13
		 * @updated 2013-10-03
		 */

		if ( $old_version < '1.4.1' )
		{
			$message = _x('Migrating Gig dates from Advanced Custom Fields to WordPress post date...', 'Upgrade', IRON_TEXT_DOMAIN);

			# Initial option introduced in 1.4.1 to track if migration was done.
			$migrated = get_option('iron_gig_dates_migrated', false);

			# Migration from initial release of 1.4.1 forgot to delete ACF field keys.
			if ( $migrated )
			{
				# Delete field value and field key
				$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key IN ('gig_date','_gig_date')");

				# Delete deprecated option in favor of version numbering.
				delete_option('iron_gig_dates_migrated');

			} else {

				$gigs = get_posts( array('post_type'=>'gig', 'posts_per_page' => -1, 'no_found_rows' => true) );

				foreach ( $gigs as $gig )
				{
					$gig_date = get_field('gig_date', $gig->ID);

					if ( $gig_date )
					{
						wp_update_post(array(
							'ID' => $gig->ID,
							'post_date' => date('Y-m-d H:i:s', strtotime( get_field('gig_date', $gig->ID) ))
						));

						delete_post_meta($gig->ID, 'gig_date');  # Field Value
						delete_post_meta($gig->ID, '_gig_date'); # Field Key
					}
				}

			}

			# Done
			update_option('ironband_version', '1.4.1');
		}


		/*
		 * 1.5.1
		 *
		 * Step 1 : Delete `vid_category` and `img_cat` fields
		 * from ACF in favor of native WordPress metabox.
		 *
		 * Step 2 : Migrate `vid_category` and `img_cat` taxonomies
		 * to hierarchical; from "tags" to "categories".
		 *
		 * @created 2013-10-03
		 */

		if ( $old_version < '1.5.1' )
		{
			$message = _x('Deprecating Video and Photo category dropdowns from Advanced Custom Fields in favor of WordPress native meta box...', 'Upgrade', IRON_TEXT_DOMAIN);

			# Step 1 : Delete `img_cat` and `vid_category` from ACF.
			# Values already saved in `wp_term_relationships` table.
			$wpdb->query("DELETE FROM $wpdb->postmeta WHERE meta_key IN ('vid_category', '_vid_category', 'img_cat','_img_cat')");

			# Step 2 : Make `img_cat` and `vid_category` taxonomies hierarchical, like categories.
			# Changes made in `/includes/taxonomies.php` and `/includes/custom-fields.php`.

			# Done
			update_option('ironband_version', '1.5.1');
		}

	}
}

add_action('init', 'iron_upgrade');
