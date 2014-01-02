<?php

/*-----------------------------------------------------------------------------------*/
/* Post Type Registering
/*-----------------------------------------------------------------------------------*/

$iron_post_types = array();
$iron_query = (object) array();

function iron_register_post_types() {
	global $iron_post_types;

	$iron_post_types = array( 'gig', 'video', 'photo', 'album', 'slide' );

	$static_page = false;

	$default_args = array(
		  'public'              => true
		, 'show_ui'             => true
		, 'show_in_menu'        => true
		, 'has_archive'         => ( empty($static_page) ? false : trim(str_replace( home_url(), '', post_permalink($static_page->ID) ), '/') )
		, 'query_var'           => true
		, 'exclude_from_search' => false
	);

/* Gig Post Type (gig)
   ========================================================================== */

	$static_page = get_post( get_iron_option('page_for_gigs') );

	$gig_args = $default_args;

	$gig_args['labels'] = array(
		  'name'               => __('Gigs', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Gig', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Gig', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Gigs', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Gigs', IRON_TEXT_DOMAIN)
		, 'add_new'            => _x('Add New', 'gig', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Gig', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Gig', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Gig', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Gig', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Gig', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No gigs found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No gigs found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Gig:', IRON_TEXT_DOMAIN)
	);

	$gig_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'custom-fields'
		, 'revisions'
	);

	$gig_args['public'] = false;

	register_post_type('gig', $gig_args);



/* Video Post Type (video)
   ========================================================================== */

	$static_page = get_post( get_iron_option('page_for_videos') );

	$video_args = $default_args;

	$video_args['labels'] = array(
		  'name'               => __('Videos', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Video', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Video', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Videos', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Videos', IRON_TEXT_DOMAIN)
		, 'add_new'            => _x('Add New', 'video', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Video', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Video', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Video', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Video', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Video', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No videos found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No videos found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Video:', IRON_TEXT_DOMAIN)
	);

	$video_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'comments'
		, 'custom-fields'
		, 'revisions'
	);

	register_post_type('video', $video_args);



/* Photo Post Type (photo)
   ========================================================================== */

	$static_page = get_post( get_iron_option('page_for_photos') );

	$photo_args = $default_args;

	$photo_args['labels'] = array(
		  'name'               => __('Photos', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Photo', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Photo', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Photos', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Photos', IRON_TEXT_DOMAIN)
		, 'add_new'            => _x('Add New', 'photo', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Photo', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Photo', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Photo', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Photo', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Photo', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No photos found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No photos found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Photo:', IRON_TEXT_DOMAIN)
	);

	$photo_args['supports'] = array(
		  'title'
		, 'custom-fields'
	);

	register_post_type('photo', $photo_args);



/* Album Post Type (album)
   ========================================================================== */

	$static_page = get_post( get_iron_option('page_for_albums') );

	$album_args = $default_args;

	$album_args['labels'] = array(
		  'name'               => __('Albums', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Album', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Album', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Albums', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Albums', IRON_TEXT_DOMAIN)
		, 'add_new'            => _x('Add New', 'album', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Album', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Album', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Album', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Album', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Album', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No albums found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No albums found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Album:', IRON_TEXT_DOMAIN)
	);

	$album_args['supports'] = array(
		  'title'
		, 'editor'
		, 'excerpt'
		, 'thumbnail'
		, 'custom-fields'
		, 'revisions'
	);

	register_post_type('album', $album_args);



/* Slide Post Type (slide)
   ========================================================================== */

	$slide_args = $default_args;

	$slide_args['labels'] = array(
		  'name'               => __('Slides', IRON_TEXT_DOMAIN)
		, 'singular_name'      => __('Slide', IRON_TEXT_DOMAIN)
		, 'name_admin_bar'     => _x('Slide', 'add new on admin bar', IRON_TEXT_DOMAIN)
		, 'menu_name'          => __('Slides', IRON_TEXT_DOMAIN)
		, 'all_items'          => __('All Slides', IRON_TEXT_DOMAIN)
		, 'add_new'            => _x('Add New', 'slide', IRON_TEXT_DOMAIN)
		, 'add_new_item'       => __('Add New Slide', IRON_TEXT_DOMAIN)
		, 'edit_item'          => __('Edit Slide', IRON_TEXT_DOMAIN)
		, 'new_item'           => __('New Slide', IRON_TEXT_DOMAIN)
		, 'view_item'          => __('View Slide', IRON_TEXT_DOMAIN)
		, 'search_items'       => __('Search Slide', IRON_TEXT_DOMAIN)
		, 'not_found'          => __('No albums found.', IRON_TEXT_DOMAIN)
		, 'not_found_in_trash' => __('No albums found in the Trash.', IRON_TEXT_DOMAIN)
		, 'parent'             => __('Parent Slide:', IRON_TEXT_DOMAIN)
	);

	$slide_args['supports'] = array(
		  'title'
		, 'thumbnail'
		, 'page-attributes'
		, 'custom-fields'
	);

	$slide_args['query_var'] = $slide_args['public'] = false;
	$slide_args['exclude_from_search'] = true;

	register_post_type('slide', $slide_args);



/* ========================================================================== */



	if ( get_transient(IRON_TEXT_DOMAIN . '_flush_rules') ) {
		flush_rewrite_rules( false );
		delete_transient(IRON_TEXT_DOMAIN . '_flush_rules');
	}
}

add_action('init', 'iron_register_post_types');



/*-----------------------------------------------------------------------------------*/
/* Post Type Sorting & Filtering
/*-----------------------------------------------------------------------------------*/

function iron_pre_get_post_types ( $query )
{
	global $iron_post_types, $iron_query;

	$post_type = $query->get('post_type');
	$posts_per_page = $query->get('posts_per_page');

	$iron_query->post_type = $post_type;

	if ( in_array($post_type, $iron_post_types) )
	{
		if ( empty($posts_per_page) || $posts_per_page == 0 ) {
			$posts_per_page = get_iron_option($post_type . 's_per_page');
			$query->set( 'posts_per_page',  $posts_per_page);
		}
	}


	if ( 'gig' == $post_type )
	{
		$order = $query->get('order');
		$orderby = $query->get('orderby');

		if ( is_admin() && ! $query->get('ajax') ) {

			// Furthest to Oldest
			if ( empty( $order ) )
				$query->set('order', 'DESC');

		} else {

			// reset Post Status
			$query->set('post_status', array('publish', 'future'));

			// Nearest to Furthest
			if ( empty( $order ) )
				$query->set('order', 'ASC');

		}

		if ( empty( $orderby ) )
			$query->set('orderby', 'date');

	}

}

add_action('pre_get_posts', 'iron_pre_get_post_types');


function iron_gigs_where ( $where = '' )
{
	global $wpdb, $iron_query;

	if ( 'gig' == $iron_query->post_type ) {
		$where .= " AND $wpdb->posts.post_date > '" . date_i18n('Y-m-d 00:00:00') . "'";
	}

	return $where;
}

add_filter('posts_where', 'iron_gigs_where');



function iron_posts_selection ()
{
	$iron_query = (object) array();
}

add_action('posts_selection', 'iron_posts_selection');


/*-----------------------------------------------------------------------------------*/
/* Page Management
/*-----------------------------------------------------------------------------------*/

// Register Custom Columns & Unregister Default Columns
if ( ! function_exists('iron_manage_pages_columns') )
{
	function iron_manage_pages_columns ( $columns )
	{
		$iron_cols = array(
			'template' => __('Page Template')
		);

		if ( function_exists('array_insert') )
			$columns = array_insert($columns, $iron_cols, 'title', 'after');
		else
			$columns = array_merge($columns, $iron_cols);

		return $columns;
	}
}

add_filter('manage_pages_columns', 'iron_manage_pages_columns');



// Display Custom Columns
if ( ! function_exists('iron_manage_pages_custom_column') )
{
	function iron_manage_pages_custom_column ( $column, $post_id )
	{
		switch ($column)
		{
			case 'template':
				$output = ''; // __('Default')
				$tpl = get_post_meta( $post_id, '_wp_page_template', true);
				$templates = get_page_templates();
				ksort($templates);
				foreach ( array_keys($templates) as $template )
				{
					if ( $tpl == $templates[$template] ) {
						$output = $template;
						break;
					}
				}
				echo $output;
			break;

		}
	}
}

add_action('manage_pages_custom_column', 'iron_manage_pages_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Discography Management
/*-----------------------------------------------------------------------------------*/

// Album: Icon

add_filter('manage_album_posts_columns', 'iron_manage_video_columns');

function iron_manage_album_columns ($columns)
{
	$iron_cols = array(
		  'alb_release_date' => __('Release Date', IRON_TEXT_DOMAIN)
		, 'alb_tracklist'    => __('# Tracks', IRON_TEXT_DOMAIN)
		, 'alb_store_list'   => __('# Stores', IRON_TEXT_DOMAIN)
	);

	if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'date', 'before');
	else
		$columns = array_merge($columns, $iron_cols);

	return $columns;
}

add_filter('manage_album_posts_columns', 'iron_manage_album_columns');


// Discography: Display Custom Columns

function iron_manage_album_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'alb_release_date':
			if ( get_field('alb_release_date', $post_id) )
				the_field('alb_release_date', $post_id);
			else
				echo __('N/A');
			break;

		case 'alb_tracklist':
			if ( $list = get_field('alb_tracklist', $post_id) )
				echo count($list);
			else
				echo __('N/A');
			break;

		case 'alb_store_list':
			if ( $list = get_field('alb_store_list', $post_id) )
				echo count($list);
			else
				echo __('N/A');
			break;
	}
}

add_action('manage_album_posts_custom_column', 'iron_manage_album_custom_column', 10, 2);

add_action('manage_album_posts_custom_column', 'iron_manage_video_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Event Management
/*-----------------------------------------------------------------------------------*/

function iron_manage_event_columns ($columns)
{
	unset( $columns['date'] );

	$iron_cols = array(
		  'gig_date'    => __('Date', IRON_TEXT_DOMAIN)
		, 'gig_city'    => __('City', IRON_TEXT_DOMAIN)
		, 'gig_venue'   => __('Venue', IRON_TEXT_DOMAIN)
		, 'gig_tickets' => __('Tickets URL', IRON_TEXT_DOMAIN)
	);

	/*if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'date', 'after');
	else*/
		$columns = array_merge($columns, $iron_cols);

	$columns['title'] = __('Event');	// Renamed first column

	return $columns;
}

add_filter('manage_gig_posts_columns', 'iron_manage_event_columns');


// Events: Display Custom Columns

function iron_manage_event_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'gig_date':
			global $mode;

			$post = get_post( $post_id );
			setup_postdata( $post );

			if ( '0000-00-00 00:00:00' == $post->post_date ) {
				$t_time = $h_time = __('Unpublished');
			} else {
				$t_time = get_the_time( __( 'Y/m/d g:i:s A' ) );
				$h_time = date_i18n( get_option('date_format') . ' ' . get_option('time_format'), get_post_time('U', false, $post_id) );
			}

			echo '<abbr title="' . $t_time . '">' . apply_filters( 'post_date_column_time', $h_time, $post, 'gig_date', $mode ) . '</abbr>';
		break;

		case 'gig_city':
			if ( get_field('gig_city', $post_id) )
				the_field('gig_city', $post_id);
			else
				echo __('N/A');
			break;

		case 'gig_venue':
			if ( get_field('gig_venue', $post_id) )
				the_field('gig_venue', $post_id);
			else
				echo __('N/A');
			break;

		case 'gig_tickets':
			$output = array();
			if ( get_field('gig_tickets', $post_id) )
			{
				$url = get_field('gig_tickets', $post_id);
				$link = parse_url( $url );

				if ( $url )
					echo '<a target="blank" href="' . $url . '" title="' . esc_attr( sprintf( __( 'Visit &#8220;%s&#8221;' ), $link['host'] ) ) . '">' . $link['host'] . '</a>';
			}
			break;
	}
}

add_action('manage_gig_posts_custom_column', 'iron_manage_event_custom_column', 10, 2);


// Events: Register Custom Columns as Sortable

function iron_manage_event_sortable_columns ($columns)
{
	$columns['gig_date']  = 'date';
	// $columns['gig_city']  = 'gig_city';
	// $columns['gig_venue'] = 'gig_venue';

	return $columns;
}

add_filter('manage_edit-gig_sortable_columns', 'iron_manage_event_sortable_columns');



/*-----------------------------------------------------------------------------------*/
/* Video Management
/*-----------------------------------------------------------------------------------*/

function iron_manage_video_columns ($columns)
{
	$iron_cols = array(
		'icon' => ''
	);

	if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'title', 'before');
	else
		$columns = array_merge($columns, $iron_cols);

	$columns['date'] = __('Published');	// Renamed date column

	return $columns;
}

add_filter('manage_video_posts_columns', 'iron_manage_video_columns');


// Videos: Display Custom Columns

function iron_manage_video_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'icon':
			$att_title = _draft_or_post_title();
?>
				<a href="<?php echo get_edit_post_link( $post_id, true ); ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $att_title ) ); ?>"><?php
					if ( $thumb = get_the_post_thumbnail( $post_id, array(80, 60) ) )
						echo $thumb;
					else
						echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
				?></a>
<?php
			break;
	}
}

add_action('manage_video_posts_custom_column', 'iron_manage_video_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Photo Management
/*-----------------------------------------------------------------------------------*/

// Photos: Icon

add_filter('manage_photo_posts_columns', 'iron_manage_video_columns');


// Photos: Display Custom Columns

function iron_manage_photo_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'icon':
			$att_title = _draft_or_post_title();
?>
				<a href="<?php echo get_edit_post_link( $post_id, true ); ?>" title="<?php echo esc_attr( sprintf( __( 'Edit &#8220;%s&#8221;' ), $att_title ) ); ?>"><?php
					if ( $thumb = get_field('img_image', $post_id) ) {
						echo wp_get_attachment_image( $thumb['id'], array( 80, 60 ), true );
					} else
						echo '<img width="46" height="60" src="' . wp_mime_type_icon('image/jpeg') . '" alt="">';
				?></a>
<?php
			break;
	}
}

add_action('manage_photo_posts_custom_column', 'iron_manage_photo_custom_column', 10, 2);



/*-----------------------------------------------------------------------------------*/
/* Slideshow Management
/*-----------------------------------------------------------------------------------*/

// Slideshows: Icon

add_filter('manage_slide_posts_columns', 'iron_manage_video_columns');

function iron_manage_slide_columns ($columns)
{
	$iron_cols = array(
		'link' => __('Link', IRON_TEXT_DOMAIN)
	);

	if ( function_exists('array_insert') )
		$columns = array_insert($columns, $iron_cols, 'date', 'before');
	else
		$columns = array_merge($columns, $iron_cols);

	$columns['date'] = __('Published');	// Renamed date column

	return $columns;
}

add_filter('manage_slide_posts_columns', 'iron_manage_slide_columns');


// Slideshows: Display Custom Columns

function iron_manage_slide_custom_column ($column, $post_id)
{
	switch ($column)
	{
		case 'link':
			$output = array();
			if ( $type = get_field('slide_link_type', $post_id) )
			{
				if ( 'internal' == $type )
				{
					$that_id = get_field('slide_link', $post_id, false);
					$url = get_edit_post_link( $that_id, true );
					$post_type = get_post_type_object( get_post_type($that_id) );
					$label = sprintf( _x('%s: ', 'A term followed by a punctuation mark used to explain or start an enumeration.', IRON_TEXT_DOMAIN), $post_type->label ) . _draft_or_post_title( $that_id );

				} elseif ( 'external' == $type ) {

					$url = get_field('slide_link_external', $post_id);
					$link = parse_url( $url );
					$label = $link['host'];

				}
			}

			if ( ! empty($url) || ! empty($label) )
				echo '<a target="blank" href="' . $url . '" title="' . esc_attr( sprintf( __( ('internal' == $type ? 'Edit' : 'Visit' ) . ' &#8220;%s&#8221;' ), $label ) ) . '">' . $label . '</a>';
			else
				echo __('N/A');

			break;
	}
}

add_action('manage_slide_posts_custom_column', 'iron_manage_video_custom_column', 10, 2); // Icon
add_action('manage_slide_posts_custom_column', 'iron_manage_slide_custom_column', 10, 2); // Link
