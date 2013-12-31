<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 */


/* ========================= Blog utils section ============================== */

// Return template page id
function getTemplatePageId($name) {
	$posts = getPostsByMetaValue('_wp_page_template', $name . '.php', ARRAY_A);
	return count($posts)>0 ? $posts[0]['post_id'] : 0;
}


// Return any type categories objects by post id
function getCategoriesByPostId($post_id = 0, $cat_types = array('category')) {
	return getTaxonomiesByPostId($post_id, $cat_types);
}


// Return tags objects by post id
function getTagsByPostId($post_id = 0) {
	return getTaxonomiesByPostId($post_id, array('post_tag'));
}


// Return taxonomies objects by post id
function getTaxonomiesByPostId($post_id = 0, $tax_types = array('post_format')) {
	global $wpdb, $wp_query;
	if (!$post_id) $post_id = $wp_query->current_post>=0 ? get_the_ID() : $wp_query->post->ID;
	$sql = "SELECT terms.*, tax.taxonomy, tax.parent, tax.count"
			. " FROM $wpdb->term_relationships AS rel"
			. " LEFT JOIN {$wpdb->term_taxonomy} AS tax ON rel.term_taxonomy_id=tax.term_taxonomy_id"
			. " LEFT JOIN {$wpdb->terms} AS terms ON tax.term_id=terms.term_id"
			. " WHERE rel.object_id = {$post_id}"
				. " AND tax.taxonomy IN ('" . join("','", $tax_types) . "')"
			. " ORDER BY terms.name";
	$taxes = $wpdb->get_results($sql, ARRAY_A);
	for ($i=0; $i<count($taxes); $i++) {
		$taxes[$i]['link'] = get_term_link($taxes[$i]['slug'], $taxes[$i]['taxonomy']);
	}
	return $taxes;
}


// Return taxonomies objects by post type
function getTaxonomiesByPostType($post_types = array('post'), $tax_types = array('post_format')) {
	global $wpdb, $wp_query;
	if (!$post_types) $post_types = array('post');
	$sql = "SELECT terms.*, tax.taxonomy, tax.parent, tax.count, posts.post_type"
			. " FROM $wpdb->term_relationships AS rel"
			. " LEFT JOIN {$wpdb->term_taxonomy} AS tax ON rel.term_taxonomy_id=tax.term_taxonomy_id"
			. " LEFT JOIN {$wpdb->terms} AS terms ON tax.term_id=terms.term_id"
			. " LEFT JOIN {$wpdb->posts} AS posts ON rel.object_id=posts.id"
			. " WHERE posts.post_type IN ('" . join("','", $post_types) . "')"
				. " AND tax.taxonomy IN ('" . join("','", $tax_types) . "')"
			. " ORDER BY terms.name";
	$taxes = $wpdb->get_results($sql, ARRAY_A);
	$result = array();
	$used = array();
	$res_count = 0;
	for ($i=0; $i<count($taxes); $i++) {
		$link = get_term_link($taxes[$i]['slug'], $taxes[$i]['taxonomy']);
		$k = $taxes[$i]['post_type'].$taxes[$i]['slug'];
		$idx = isset($used[$k]) ? $used[$k] : -1;
		if ($idx == -1) {
			$used[$k] = $res_count;
			$result[$res_count] = $taxes[$i];
			$result[$res_count]['link'] = $link;
			$result[$res_count]['count'] = 1;
			$res_count++;
		} else
			$result[$idx]['count']++;
	}
	return $result;
}

// Return one inherited category property value (from parent categories)
function getCategoryInheritedProperty($id, $prop, $defa='') {
	if ((int) $id == 0) {
		$cat = get_term_by( 'slug', $id, 'category', ARRAY_A);
		$id = $cat['term_id'];
	}
	$val = $defa;
	do {
		if ($props = category_custom_fields_get($id)) {
			if (isset($props[$prop]) && !empty($props[$prop]) && $props[$prop]!='default') {
				$val = $props[$prop];
				break;
			}
		}
		$cat = get_term_by( 'id', $id, 'category', ARRAY_A);
		$id = $cat['parent'];
	} while ($id);
	return $val;
}

// Return all inherited category properties value (from parent categories)
function getCategoryInheritedProperties($id) {
	if ((int) $id == 0) {
		$cat = get_term_by( 'slug', $id, 'category', ARRAY_A);
		$id = $cat['term_id'];
	}
	$val = array('category_id'=>$id);
	do {
		if ($props = category_custom_fields_get($id)) {
			foreach($props as $prop_name=>$prop_value) {
				if (!isset($val[$prop_name]) || empty($val[$prop_name]) || $val[$prop_name]=='default') {
					$val[$prop_name] = $prop_value;
				}
			}
		}
		$cat = get_term_by( 'id', $id, 'category', ARRAY_A);
		$id = $cat['parent'];
	} while ($id);
	return $val;
}

// Return all inherited properties value (from parent categories) for list categories
function getCategoriesInheritedProperties($cats) {
	$cat_options = array();
	if ($cats) {
		foreach ($cats as $cat) {
			$new_options = getCategoryInheritedProperties($cat['term_id']);
			foreach ($new_options as $k=>$v) {
				if (!empty($v) && $v!='default' && (!isset($cat_options[$k]) || empty($cat_options[$k]) || $cat_options[$k]=='default'))
					$cat_options[$k] = $v;
			}
		}
	}
	return $cat_options;
}

// Return id highest category with desired property in array values
function getParentCategoryByProperty($id, $prop, $values, $highest=true) {
	if (!is_array($values)) $values = array($values);
	$val = $id;
	do {
		if ($props = category_custom_fields_get($id)) {
			if (isset($props[$prop]) && !empty($props[$prop]) && in_array($props[$prop], $values)) {
				$val = $id;
				if (!$highest) break;
			}
		}
		$cat = get_term_by( 'id', $id, 'category', ARRAY_A);
		$id = $cat['parent'];
	} while ($id);
	return $val;
}

// Return id closest category to desired parent
function getParentCategory($id, $parent_id=0) {
	$val = null;
	do {
		$cat = get_term_by( 'id', $id, 'category', ARRAY_A);
		if ($cat['parent']==$parent_id) {
			$val = $cat;
			break;
		}
		$id = $cat['parent'];
	} while ($id);
	return $val;
}

// Return breadcrumbs path
function showBreadcrumbs($args=array()) {
	global $wp_query;
	
	$args = array_merge(array(
		'home' => '',							// Home page title (if empty - not showed)
		'home_url' => '',						// Home page url
		'show_all_photo_video' => false,		// Add "All photos" (All videos) before categories list
		'show_all_posts' => true,				// Add "All posts" at start 
		'truncate_title' => 0,					// Truncate all titles to this length (if 0 - no truncate)
		'truncate_add' => '...',				// Append truncated title with this string
		'echo' => true							// If true - show on page, else - only return value
		), is_array($args) ? $args : array( 'home' => $args ));

	$rez = '';
	$rez2 = '';
	$all_link = $all_format =  '';
	$type = getBlogType();
	$title = getShortString(getBlogTitle(), $args['truncate_title'], $args['truncate_add']);
	$cat = '';
	$parentTax = '';
	if ( !in_array($type, array('home', 'frontpage')) ) {
		$need_reset = true;
		$parent = 0;
		$post_id = 0;
		if ($type == 'page' || $type == 'attachment') {
			$pageParentID = isset($wp_query->post->post_parent) ? $wp_query->post->post_parent : 0;
			$post_id = $type == 'page' ? (isset($wp_query->post->ID) ? $wp_query->post->ID : 0) : $pageParentID;
			while ($pageParentID > 0) {
				$pageParent = get_post($pageParentID);
				$rez2 = '<li class="cat_post"><a href="' . get_permalink($pageParent->ID) . '">' . getShortString($pageParent->post_title, $args['truncate_title'], $args['truncate_add']) . '</a></li>' . $rez2;
				if (($pageParentID = $pageParent->post_parent) > 0) $page_id = $pageParentID;
			}
		} else if ($type=='single')
			$post_id =  isset($wp_query->post->ID) ? $wp_query->post->ID : 0;
		
		$depth = 0;
		$ex_cats = explode(',', get_theme_option('exclude_cats'));
		do {
			if ($depth++ == 0) {
				if (in_array($type, array('single', 'attachment'))) {
					if ($args['show_all_photo_video']) {
						$post_format = get_post_format($post_id);
						if ($post_format == 'video' && ($video_id = getTemplatePageId($post_format)) > 0) {
							$all_link = get_permalink($video_id);
							$all_format = __('Videos', 'themerex');
						} else if ($post_format == 'gallery' && ($gallery_id = getTemplatePageId($post_format)) > 0) {
							$all_link = get_permalink($gallery_id);
							$all_format = __('Galleries', 'themerex');
						}
					}
					$cats = getCategoriesByPostId( $post_id );
					$cat = $cats ? $cats[0] : false;
					if ($cat) {
						if (!in_array($cat['term_id'], $ex_cats)) {
							$cat_link = get_term_link($cat['slug'], $cat['taxonomy']);
							$rez2 = '<li class="cat_post"><a href="' . $cat_link . '">' . getShortString($cat['name'], $args['truncate_title'], $args['truncate_add']) . '</a></li>' . $rez2;
						}
					} else {
						$post_type = get_post_type($post_id);
						$parentTax = 'category' . ($post_type == 'post' ? '' : '_' . $post_type);
					}
				} else if ( $type == 'category' ) {
					$cat = get_term_by( 'id', get_query_var( 'cat' ), 'category', ARRAY_A);
				}
				if ($cat) {
					$parent = $cat['parent'];
					$parentTax = $cat['taxonomy'];
				}
			}
			if ($parent) {
				$cat = get_term_by( 'id', $parent, $parentTax, ARRAY_A);
				if ($cat) {
					if (!in_array($cat['term_id'], $ex_cats)) {
						$cat_link = get_term_link($cat['slug'], $cat['taxonomy']);
						$rez2 = '<li class="cat_parent"><a href="' . $cat_link . '">' . getShortString($cat['name'], $args['truncate_title'], $args['truncate_add']) . '</a></li>' . $rez2;
					}
					$parent = $cat['parent'];
				}
			}
			if (!$all_link && $args['show_all_posts'] && ($blog_id = getTemplatePageId('template-blog')) > 0) {
				$all_link = get_permalink($blog_id);
				$all_format = __( 'Posts', 'themerex');
			}
		} while ($parent);
		
		$rez3 = '';
		if (is_archive()) {
			$year  = get_the_time('Y'); 
			$month = get_the_time('m'); 
			if (is_day() || is_month())
				$rez3 .= '<li class="cat_parent"><a href="' . get_year_link( $year ) . '">' . $year . '</a></li>';
			if (is_day())
				$rez3 .= '<li class="cat_parent"><a href="' . get_month_link( $year, $month ) . '">' . get_the_date( 'F' ) . '</a></li>';
		}
		
		if (!is_home() && !is_front_page()) {
			$rez .= '<ul class="breadcrumbs">'
				. (isset($args['home']) && $args['home']!='' ? '<li class="home"><a href="' . ($args['home_url'] ? $args['home_url'] : home_url()) . '">' . $args['home'] . '</a></li>' : '') 
				. ($all_link && !in_array(my_strtolower($title), array('all posts')) ? '<li class="all"><a href="' . $all_link . '">' . sprintf( __( 'All %s', 'themerex' ), $all_format ) . '</a></li>' : '' )
				. $rez2 
				. $rez3 
				. ($title ? '<li class="current">' . $title . '</li>' : '')
				. '</ul>';
		}
	}
	
	if ($args['echo'] && !empty($rez)) echo $rez;
	return $rez;
}



// Return blog records type
function getBlogType($query=null) {
global $wp_query;
	if ( $query===null ) $query = $wp_query;

	$page = '';
	if (isset($query->queried_object) && isset($query->queried_object->post_type) && $query->queried_object->post_type=='page')
		$page = get_post_meta($query->queried_object_id, '_wp_page_template', true);
	else if (isset($query->query_vars['page_id']))
		$page = get_post_meta($query->query_vars['page_id'], '_wp_page_template', true);
	else if (isset($query->queried_object) && isset($query->queried_object->taxonomy))
		$page = $query->queried_object->taxonomy;

	if (  $page == 'template-blog.php')			// || is_page_template( 'template-blog.php' ) )
		return 'blog';
	else if ( $query && $query->is_404())		// || is_404() ) 					// -------------- 404 error page
		return 'error';
	else if ( $query && $query->is_search())	// || is_search() ) 				// -------------- Search results
		return 'search';
	else if ( $query && $query->is_day())		// || is_day() )					// -------------- Archives daily
		return 'archives';
	else if ( $query && $query->is_month())		// || is_month() ) 				// -------------- Archives monthly
		return 'archives';
	else if ( $query && $query->is_year())		// || is_year() )  				// -------------- Archives year
		return 'archives';
	else if ( $query && $query->is_category())	// || is_category() )  		// -------------- Category
		return 'category';
	else if ( $query && $query->is_tag())		// || is_tag() ) 	 				// -------------- Tag posts
		return 'tag';
	else if ( $query && $query->is_author())	// || is_author() )				// -------------- Author page
		return 'author';
	else if ( $query && $query->is_attachment())	// || is_attachment() )
		return 'attachment';
	else if ( $query && $query->is_single())	// || is_single() )				// -------------- Single post
		return 'single';
	else if ( $query && $query->is_page())		// || is_page() )
		return 'page';
	else										// -------------- Home page
		return 'home';
}

// Return blog title
function getBlogTitle() {
	global $wp_query;

	$page = $slug = '';
	if (isset($wp_query->queried_object) && isset($wp_query->queried_object->post_type) && $wp_query->queried_object->post_type=='page')
		$page = get_post_meta($wp_query->queried_object_id, '_wp_page_template', true);
	else if (isset($wp_query->query_vars['page_id']))
		$page = get_post_meta($wp_query->query_vars['page_id'], '_wp_page_template', true);
	else if (isset($wp_query->queried_object) && isset($wp_query->queried_object->taxonomy))
		$page = $slug = $wp_query->queried_object->taxonomy;

	if (  $page == 'template-blog.php' || is_page_template( 'template-blog.php' ) )
		return __( 'All Posts', 'themerex' );
	else if ( is_author() ) {		// -------------- Author page
		$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		return sprintf(__('Author page: %s', 'themerex'), $curauth->display_name);
	} else if ( is_404() ) 			// -------------- 404 error page
		return __('URL not found', 'themerex');
	else if ( is_search() ) 		// -------------- Search results
		return sprintf( __( 'Search Results for: %s', 'themerex' ), get_search_query() );
	else if ( is_day() )			// -------------- Archives daily
		return sprintf( __( 'Daily Archives: %s', 'themerex' ), get_the_date() );
	else if ( is_month() ) 			// -------------- Archives monthly
		return sprintf( __( 'Monthly Archives: %s', 'themerex' ), get_the_date( 'F Y' ) );
	else if ( is_year() )  			// -------------- Archives year
		return sprintf( __( 'Yearly Archives: %s', 'themerex' ), get_the_date( 'Y' ) );
	else if ( is_category() )  		// -------------- Category
		return sprintf( __( '%s', 'themerex' ), single_cat_title( '', false ) );
	else if ( is_tag() )  			// -------------- Tag page
		return sprintf( __( 'Tag: %s', 'themerex' ), single_tag_title( '', false ) );
	else if ( is_attachment() )		// -------------- Attachment page
		return sprintf( __( 'Attachment: %s', 'themerex' ), getPostTitle());
	else if ( is_single() )			// -------------- Single post
		return getPostTitle();
	else if ( is_page() )
		//return $wp_query->post->post_title;
		return getPostTitle();
	else							// -------------- Unknown pages - as homepage
		return get_bloginfo('name', 'raw');
}


// Show pages links below list or single page
function showPagination($args=array()) {
	$args = array_merge(array(
		'offset' => 0,				// Offset to first showed record
		'id' => 'nav_pages',		// Name of 'id' attribute
		'class' => 'nav_pages'		// Name of 'class' attribute
		),  is_array($args) ? $args 
			: (is_int($args) ? array( 'offset' => $args ) 		// If send number parameter - use it as offset
				: array( 'id' => $args, 'class' => $args )));	// If send string parameter - use it as 'id' and 'class' name
	global $wp_query;
	echo "<div id=\"{$args['id']}\" class=\"{$args['class']}\">";
	if (function_exists('themerex_wp_pagenavi') && !is_single()) {
		echo themerex_wp_pagenavi(array(
			'always_show' => 0,
			'style' => 1,
			'num_pages' => 5,
			'num_larger_page_numbers' => 3,
			'larger_page_numbers_multiple' => 10,
			'pages_text' => __('Page %CURRENT_PAGE% of %TOTAL_PAGES%', 'themerex'),
			'current_text' => "%PAGE_NUMBER%",
			'page_text' => "%PAGE_NUMBER%",
			'first_text' => __('&laquo; First', 'themerex'),
			'last_text' => __("Last &raquo;", 'themerex'),
			'next_text' => "&raquo;",
			'prev_text' => "&laquo;",
			'dotright_text' => '', //"...",
			'dotleft_text' => '', //"...",
			'before' => '',
			'after' => '',
			'offset' => $args['offset']
		));
	} else {
		showSinglePageNav( 'nav-below' );
	}
	echo "</div>";
}


// Single page nav or used if no pagenavi
function showSinglePageNav( $nav_id ) {
	global $wp_query, $post;
	// Don't print empty markup on single pages if there's nowhere to navigate.
	if ( is_single() ) {
		$previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
		$next = get_adjacent_post( false, '', false );
		if ( ! $next && ! $previous )
			return;
	}
	// Don't print empty markup in archives if there's only one page.
	if ( $wp_query->max_num_pages < 2 && ( is_home() || is_archive() || is_search() ) )
		return;
	$nav_class = ( is_single() ) ? 'navigation-post' : 'navigation-paging';
	?>
	<nav role="navigation" id="<?php echo esc_attr( $nav_id ); ?>" class="<?php echo $nav_class; ?>">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'themerex' ); ?></h1>
		<?php if ( is_single() ) : // navigation links for single posts ?>
			<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . __( '&larr;', 'themerex' ) . '</span> %title' ); ?>
			<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . __( '&rarr;', 'themerex' ) . '</span>' ); ?>
		<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>
			<?php if ( get_next_posts_link() ) : ?>
				<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'themerex' ) ); ?></div>
			<?php endif; ?>
			<?php if ( get_previous_posts_link() ) : ?>
				<div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'themerex' ) ); ?></div>
			<?php endif; ?>
	<?php endif; ?>
	</nav>
	<?php
}









/* ========================= Post utilities section ============================== */

// Return custom_page_heading (if set), else - post title
function getPostTitle($id = 0, $maxlength = 0, $add='...') {
	global $wp_query;
	if (!$id) $id = $wp_query->current_post>=0 ? get_the_ID() : $wp_query->post->ID;
	$title = get_the_title($id);
	if ($maxlength > 0) $title = getShortString($title, $maxlength, $add);
	return $title;
}

// Return custom_page_description (if set), else - post excerpt (if set), else - trimmed content
function getPostDescription($maxlength = 0, $add='...') {
	$descr = get_the_excerpt();
	$descr = trim(str_replace(array('[...]', '[&hellip;]'), array($add, $add), $descr));
	if (!empty($descr) && my_strpos(',.:;-', my_substr($descr, -1))!==false) $descr = my_substr($descr, 0, -1);
	if ($maxlength > 0) $descr = getShortString($descr, $maxlength, $add);
	return $descr;
}

//Return Post Views Count on Posts Without Any Plugin in WordPress
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 ";
    }
    return $count;
}

//Set Post Views Count
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

// Return posts by meta_value
function getPostsByMetaValue($meta_key, $meta_value, $return_format=OBJECT) {
	global $wpdb;
	$where = array();
	if ($meta_key) $where[] = 'meta_key="' . $meta_key . '"';
	if ($meta_value) $where[] = 'meta_value="' . $meta_value . '"';
	$whereStr = count($where) ? 'WHERE '.join(' AND ', $where) : '';
	$posts = $wpdb->get_results("SELECT * FROM {$wpdb->postmeta} {$whereStr}", $return_format);
	return $posts;
}

// Return url from gallery, inserted in post
function getPostGallery($text, $id=0, $parse_text=true) {
	$tag = '[gallery]';
	$rez = array();
	$ids = array();
	if ($parse_text) {
		$ids_list = getTagAttrib($text, $tag, 'ids');
		if ($ids_list!='') {
			$ids = explode(',', $ids_list);
		}
	}
	if (count($ids)==0 && $id > 0) {
		$args = array(
				'numberposts' => -1,
				'order' => 'ASC',
				'post_mime_type' => 'image',
				'post_parent' => $id,
				'post_status' => 'any',
				'post_type' => 'attachment',
			);
		$attachments = get_children( $args );
		if ( $attachments ) {
			foreach ( $attachments as $attachment )
				$ids[] = $attachment->ID;
		}
	}
	if (count($ids) > 0) {
		foreach ($ids as $v) {
			$src = wp_get_attachment_image_src( $v, 'full' );
			if (isset($src[0]) && $src[0]!='')
				$rez[] = $src[0];
		}
	}
	return $rez;
}

// Return gallery tag from photos array
function buildGalleryTag($photos, $w, $h, $zoom=false) {
	$gallery_text = '';
	if (count($photos) > 0) {
		$gallery_text = '
			<div class="sc_slider sc_slider_flex">
				<ul class="slides">
				';
		foreach ($photos as $photo) {
			$photo_min = getResizedImageTag($photo, $w, $h);
			$gallery_text .= $zoom 
				? '<li><a href="'. $photo . '" class="prettyPhoto">'.$photo_min.'</a></li>' 
				: '<li>'.$photo_min.'</li>';
		}
		$gallery_text .= '
				</ul>
			</div>
		';
	}
	return $gallery_text;
}

// Substitute standard Wordpress galleries
function substituteGallery($post_text, $post_id, $w, $h, $a='none', $zoom=false) {
	$tag = '[gallery]';
	$post_photos = false;
	while (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1)))!==false) {
		$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
		$tag_text = my_substr($post_text, $pos_start, $pos_end-$pos_start+1);
		if (($ids = getTagAttrib($tag_text, $tag, 'ids'))!='') {
			$ids_list = explode(',', $ids);
			$photos = array();
			if (count($ids_list) > 0) {
				foreach ($ids_list as $v) {
					$src = wp_get_attachment_image_src( $v, 'full' );
					if (isset($src[0]) && $src[0]!='')
						$photos[] = $src[0];
				}
			}
		} else {
			if ($post_photos===false)
				$post_photos = getPostGallery('', $post_id, true);
			$photos = $post_photos;
		}
		
		$post_text = my_substr($post_text, 0, $pos_start) . buildGalleryTag($photos, $w, $h, $zoom) . my_substr($post_text, $pos_end + 1);
	}
	return $post_text;
}

// Return url from audio tag or shortcode, inserted in post
function getPostAudio($post_text, $get_src=true) {
	$src = '';
	$tags = array('<audio>', '[audio]');
	for ($i=0; $i<count($tags); $i++) {
		$tag = $tags[$i];
		$tag_end = my_substr($tag,0,1).'/'.my_substr($tag,1);
		if (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1).' '))!==false) {
			$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
			$pos_end2 = my_strpos($post_text, $tag_end, $pos_end);
			$tag_text = my_substr($post_text, $pos_start, ($pos_end2!==false ? $pos_end2+7 : $pos_end)-$pos_start+1);
			if ($get_src) {
				if (($src = getTagAttrib($tag_text, $tag, 'src'))=='')
					$src = getTagAttrib($tag_text, $tag, 'url');
			} else
				$src = $tag_text;
			if ($src!='') break;
		}
	}
	if ($src == '' && $get_src) $src = getFirstURL($post_text);
	return $src;
}

// Substitute audio tags
function substituteAudio($post_text) {
	$tag = '<audio>';
	$tag_end = '</audio>';
	$pos_start = -1;
	while (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1).' ', $pos_start+1))!==false) {
		$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
		$pos_end2 = my_strpos($post_text, $tag_end, $pos_end);
		$tag_text = my_substr($post_text, $pos_start, ($pos_end2!==false ? $pos_end2+7 : $pos_end)-$pos_start+1);
		if (($src = getTagAttrib($tag_text, $tag, 'src'))=='')
			$src = getTagAttrib($tag_text, $tag, 'url');
		if ($src != '') {
			$tag_w = getTagAttrib($tag_text, $tag, 'width');
			$tag_h = getTagAttrib($tag_text, $tag, 'height');
			$tag_a = getTagAttrib($tag_text, $tag, 'align');
			$tag_s = getTagAttrib($tag_text, $tag, 'style');
			$pos_end = $pos_end2!==false ? $pos_end2+8 : $pos_end+1;
			$container = '<div class="audio_container' . ($tag_a ? ' align'.$tag_a : '') . '"' . ($tag_s || $tag_w || $tag_h ? ' style="'.($tag_w!='' ? 'width:' . $tag_w . (my_substr($tag_w, -1)!='%' ? 'px' : '') . ';' : '').($tag_h!='' ? 'height:' . $tag_h . 'px;' : '') . $tag_s . '"' : '') . '>';
			$post_text = my_substr($post_text, 0, (my_substr($post_text, $pos_start-3, 3)=='<p>' ? $pos_start-3 : $pos_start)) 
				. $container
				. (my_strpos($src, 'soundcloud.com') !== false 
					? '<iframe width="100%" height="166" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url='.esc_url($src).'"></iframe>'
					: $tag_text)
				. '</div>'
				. my_substr($post_text, (my_substr($post_text, $pos_end, 4)=='</p>' ? $pos_end+4 : $pos_end));
			if (my_strpos($src, 'soundcloud.com') === false) $pos_start += my_strlen($container)+10;
		}
	}
	return $post_text;
}

// Return url from video tag or shortcode, inserted in post
function getPostVideo($post_text, $get_src=true) {
	$src = '';
	$tags = array('<video>', '[video]', '<iframe>');
	for ($i=0; $i<count($tags); $i++) {
		$tag = $tags[$i];
		$tag_end = my_substr($tag,0,1).'/'.my_substr($tag,1);
		if (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1).' '))!==false) {
			$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
			$pos_end2 = my_strpos($post_text, $tag_end, $pos_end);
			$tag_text = my_substr($post_text, $pos_start, ($pos_end2!==false ? $pos_end2+7 : $pos_end)-$pos_start+1);
			if ($get_src) {
				if (($src = getTagAttrib($tag_text, $tag, 'src'))=='')
					$src = getTagAttrib($tag_text, $tag, 'url');
			} else
				$src = $tag_text;
			if ($src!='') break;
		}
	}
	if ($src == '' && $get_src) $src = getFirstURL($post_text);
	return $src;
}

// Substitute video tags and shortcodes
function substituteVideo($post_text, $w, $h) {
	$tag = '<video>';
	$tag_end = '</video>';
	$pos_start = -1;
	while (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1).' ', $pos_start+1))!==false) {
		$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
		$pos_end2 = my_strpos($post_text, $tag_end, $pos_end);
		$tag_text = my_substr($post_text, $pos_start, ($pos_end2!==false ? $pos_end2+7 : $pos_end)-$pos_start+1);
		if (($src = getTagAttrib($tag_text, $tag, 'src'))=='')
			$src = getTagAttrib($tag_text, $tag, 'url');
		if ($src != '') {
			$src = getVideoPlayerURL($src);
			$tag_w = getTagAttrib($tag_text, $tag, 'width');
			$tag_h = getTagAttrib($tag_text, $tag, 'height');
			$tag_a = getTagAttrib($tag_text, $tag, 'align');
			$tag_s = getTagAttrib($tag_text, $tag, 'style');
			$pos_end = $pos_end2!==false ? $pos_end2+8 : $pos_end+1;
			$post_text = my_substr($post_text, 0, (my_substr($post_text, $pos_start-3, 3)=='<p>' ? $pos_start-3 : $pos_start)) 
				. '
					<div class="video_container' . ($tag_a ? ' align'.$tag_a : '') . '"' . ($tag_s || $tag_w || $tag_h ? ' style="'.($tag_w!='' ? 'width:' . $tag_w . (my_substr($tag_w, -1)!='%' ? 'px' : '') . ';' : '').($tag_h!='' ? 'height:' . $tag_h . 'px;' : '') . $tag_s . '"' : '') . '>
						<iframe class="video_frame" src="' . $src . '" width="' . ($tag_w ? $tag_w : $w) . '" height="' . ($tag_h ? $tag_h : $h) . '" frameborder="0" webkitAllowFullScreen="webkitAllowFullScreen" mozallowfullscreen="mozallowfullscreen" allowFullScreen="allowFullScreen"></iframe>
					</div>
				'
				. my_substr($post_text, (my_substr($post_text, $pos_end, 4)=='</p>' ? $pos_end+4 : $pos_end));
		}
	}
	return $post_text;
}



// Return url from img tag or shortcode, inserted in post
function getPostImage($post_text, $get_src=true) {
	$src = '';
	$tags = array('<img>', '[image]');
	for ($i=0; $i<count($tags); $i++) {
		$tag = $tags[$i];
		if (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1).' '))!==false) {
			$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
			$tag_text = my_substr($post_text, $pos_start, $pos_end-$pos_start+1);
			if ($get_src) {
				if (($src = getTagAttrib($tag_text, $tag, 'src'))=='')
					$src = getTagAttrib($tag_text, $tag, 'url');
			} else
				$src = $tag_text;
			if ($src!='') break;
		}
	}
	if ($src == '' && $get_src) $src = getFirstURL($post_text);
	return $src;
}


// Return url from tag a, inserted in post
function getPostLink($post_text) {
	$src = '';
	$tag = '<a>';
	$tag_end = '</a>';
	if (($pos_start = my_strpos($post_text, my_substr($tag, 0, -1).' '))!==false) {
		$pos_end = my_strpos($post_text, my_substr($tag, -1), $pos_start);
		$pos_end2 = my_strpos($post_text, $tag_end, $pos_end);
		$tag_text = my_substr($post_text, $pos_start, ($pos_end2!==false ? $pos_end2+7 : $pos_end)-$pos_start+1);
		$src = getTagAttrib($tag_text, $tag, 'href');
	}
	if ($src == '') $src = getFirstURL($post_text);
	return $src;
}


function getFirstURL($post_text) {
	$src = '';
	if (($pos_start = my_strpos($post_text, 'http'))!==false) {
		for ($i=$pos_start; $i<my_strlen($post_text); $i++) {
			$ch = my_substr($post_text, $i, 1);
			if (my_strpos("< \n\"\'", $ch)!==false) break;
			$src .= $ch;
		}
	}
	return $src;
}





/* ========================= Social share links ============================== */

$THEMEREX_share_social_list = array(
	'twitter' => "https://twitter.com/share?url={link}&text={title}",
	'facebook' => "http://www.facebook.com/share.php?u={link}&t={title}",
	'pinterest' => "javascript:void((function(d){var%20e=d.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);d.body.appendChild(e)})(document));",
	'linkedin' => 'http://www.linkedin.com/shareArticle?url={link}&mini=true&title={title}&ro=false&summary={descr}&source=',
	'dribbble' => 'http://www.dribbble.com/',
	'gplus' => "https://plus.google.com/share?url={link}"	//"https://plusone.google.com/_/+1/confirm?url={link}"
	);

// Return (and show) share social links
function showShareSocialLinks($args) {
	$args = array_merge(array(
		'post_id' => 0,						// post ID
		'post_link' => '',					// post link
		'post_title' => '',					// post title
		'post_descr' => '',					// post descr
		'allowed' => array(),				// list of allowed social
		'echo' => true						// if true - show on page, else - only return as string
		), $args);
	global $THEMEREX_share_social_list;
	$output = '';
	if (count($args['allowed'])==0) $args['allowed'] = array_keys($THEMEREX_share_social_list);
	foreach ($args['allowed'] as $s) {
		if (array_key_exists($s, $THEMEREX_share_social_list)) {
			$link = str_replace(array('{id}', '{link}', '{title}', '{descr}'), array($args['post_id'], $args['post_link'], $args['post_title'], $args['post_descr']), $THEMEREX_share_social_list[$s]);
			$output .= '<a href="' . $link . '" class="social ' . $s . '" target="_blank"><span class="icon-' .$s . '"></span></a>';
		}
	}
	if ($args['echo']) echo $output;
	return $output;
}

/*
function twitter_followers($account) {
	$tw = get_transient("twitterfollowers");
	if ($tw !== false) return $tw;
	$tw = '?';
	$url = 'https://twitter.com/users/show/'.$account;
	$headers = get_headers($url);
	if (my_strpos($headers[0], '200')) {
		$xml = file_get_contents($url);
		preg_match('/followers_count>(.*)</', $xml, $match);
		if ($match[1] !=0 ) {
			$tw = $match[1];
			set_transient("twitterfollowers", $tw, 60*60);
		}
	}
	return $tw;
}

function facebook_likes($account) {
	$fb = get_transient("facebooklikes");
	if ($fb !== false) return $fb;
	$fb = '?';
	$url = 'http://graph.facebook.com/'.$account;
	$headers = get_headers($url);
	if (my_strpos($headers[0], '200')) {
		$json = file_get_contents($url);
		$rez = json_decode($json, true);
		if (isset($rez['likes']) ) {
			$fb = $rez['likes'];
			set_transient("facebooklikes", $fb, 60*60);
		}
	}
	return $fb;
}

function feedburner_counter($account) {
	$rss = get_transient("feedburnercounter");
	if ($rss !== false) return $rss;
	$rss = '?';
	$url = 'http://feedburner.google.com/api/awareness/1.0/GetFeedData?uri='.$account;
	$headers = get_headers($url);
	if (my_strpos($headers[0], '200')) {
		$xml = file_get_contents($url);
		preg_match('/circulation="(\d+)"/', $xml, $match);
		if ($match[1] != 0) {
			$rss = $match[1];
			set_transient("feedburnercounter", $rss, 60*60);
		}
	}
	return $rss;
}
*/






/* ========================= User profile section ============================== */

$THEMEREX_user_social_list = array(
	'facebook' => __('Facebook', 'themerex'),
	'twitter' => __('Twitter', 'themerex'),
	'gplus' => __('Google+', 'themerex'),
	'linkedin' => __('LinkedIn', 'themerex'),
	'dribbble' => __('Dribbble', 'themerex'),
	'pinterest' => __('Pinterest', 'themerex'),
	'tumblr' => __('Tumblr', 'themerex'),
	'behance' => __('Behance', 'themerex'),
	'youtube' => __('Youtube', 'themerex'),
	'vimeo' => __('Vimeo', 'themerex'),
	'rss' => __('RSS', 'themerex'),
	);

// Return (and show) user profiles links
function showUserSocialLinks($args) {
	$args = array_merge(array(
		'author_id' => 0,						// author's ID
		'allowed' => array(),					// list of allowed social
		'icons' => false,
		'echo' => true							// if true - show on page, else - only return as string
		), is_array($args) ? $args 
			: array('author_id' => $args));		// If send one number parameter - use it as author's ID
	global $THEMEREX_user_social_list;
	$output = '';
	if (count($args['allowed'])==0) $args['allowed'] = array_keys($THEMEREX_user_social_list);
	foreach ($args['allowed'] as $s) {
		if (array_key_exists($s, $THEMEREX_user_social_list)) {
			$link = get_the_author_meta('user_' . $s, $args['author_id']);
			if ($link) {
				$output .= '<a href="' . $link . '" class="social_icons social_' . $s . '" target="_blank">'
					. ($args['icons'] ? '<span class="icon-' . $s . '"></span>' : '<img src="'.get_template_directory_uri().'/images/socials/'.$s.'.png" />')
					. '</a>';
			}
		}
	}
	if ($args['echo']) echo $output;
	return $output;
}



// show additional fields
add_action( 'show_user_profile', 'my_show_extra_profile_fields' );
add_action( 'edit_user_profile', 'my_show_extra_profile_fields' );
function my_show_extra_profile_fields( $user ) { 
	global $THEMEREX_user_social_list;
?>
	<h3>User Position</h3>
	<table class="form-table">
        <tr>
            <th><label for="user_position"><?php _e('User position', 'themerex'); ?>:</label></th>
            <td><input type="text" name="user_position" id="user_position" size="55" value="<?php echo esc_attr(get_the_author_meta('user_position', $user->ID)); ?>" />
                <span class="description"><?php _e('Please, enter your position in the company', 'themerex'); ?></span>
            </td>
        </tr>
    </table>

	<h3>Social links</h3>
	<table class="form-table">
	<?php
	foreach ($THEMEREX_user_social_list as $name=>$title) {
	?>
        <tr>
            <th><label for="<?php echo $name; ?>"><?php echo $title; ?>:</label></th>
            <td><input type="text" name="user_<?php echo $name; ?>" id="user_<?php echo $name; ?>" size="55" value="<?php echo esc_attr(get_the_author_meta('user_'.$name, $user->ID)); ?>" />
                <span class="description"><?php echo sprintf(__('Please, enter your %s link', 'themerex'), $title); ?></span>
            </td>
        </tr>
	<?php
	}
	?>
    </table>
<?php
}

// Save / update additional fields
add_action( 'personal_options_update', 'my_save_extra_profile_fields' );
add_action( 'edit_user_profile_update', 'my_save_extra_profile_fields' );
function my_save_extra_profile_fields( $user_id ) {
	if ( !current_user_can( 'edit_user', $user_id ) )
		return false;
	update_user_meta( $user_id, 'user_position', $_POST['user_position'] );
	global $THEMEREX_user_social_list;
	foreach ($THEMEREX_user_social_list as $name=>$title)
		update_user_meta( $user_id, 'user_'.$name, $_POST['user_'.$name] );
}









/* ========================= Other functions section ============================== */


// Add data in inline styles block
if (!function_exists('wp_style_add_data')) {
	function wp_style_add_data($css, $cond, $expr) {
		global $wp_styles;
		if (is_object($wp_styles)) {
			return $wp_styles->add_data($css, $cond, $expr);
		}
		return false;
	}
}


// Return difference or date
function getDateOrDifference($dt1, $dt2=null, $max_days=-1) {
	if ($max_days < 0) $max_days = get_theme_option('show_date_after', 30);
	if ($dt2 == null) $dt2 = date('Y-m-d H:i:s');
	$dt2n = strtotime($dt2);
	$dt1n = strtotime($dt1);
	$diff = $dt2n - $dt1n;
	$days = floor($diff / (24*3600));
	if ($days <= $max_days)
		return dateDifference($dt1, $dt2).' '.__('ago', 'themerex');
	else
		return date(get_option('date_format'), $dt1n);
}



// Return calendar with allowed posts types
function get_theme_calendar($initial = true, $echo = true, $allowed_types = array('post', 'news', 'reviews')) {
	// WP global variables with data parts
	global $wpdb, $m, $monthnum, $year, $wp_locale, $posts;

	$cache = array();
	$key = md5( $m . $monthnum . $year );
	if ( $cache = wp_cache_get( 'get_calendar', 'calendar' ) ) {
		if ( is_array($cache) && isset( $cache[ $key ] ) ) {
			if ( $echo ) {
				echo apply_filters( 'get_calendar',  $cache[$key] );
				return;
			} else {
				return apply_filters( 'get_calendar',  $cache[$key] );
			}
		}
	}

	if ( !is_array($cache) )
		$cache = array();

	// Quick check. If we have no posts at all, abort!
	if ( !$posts ) {
		$gotsome = $wpdb->get_var("SELECT 1 as test FROM $wpdb->posts WHERE post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish' LIMIT 1");
		if ( !$gotsome ) {
			$cache[ $key ] = '';
			wp_cache_set( 'get_calendar', $cache, 'calendar' );
			return;
		}
	}

	if ( isset($_GET['w']) )
		$w = ''.intval($_GET['w']);

	// week_begins = 0 stands for Sunday
	$week_begins = intval(get_option('start_of_week'));

	// Let's figure out when we are
	if ( !empty($monthnum) && !empty($year) ) {
		$thismonth = ''.zeroise(intval($monthnum), 2);
		$thisyear = ''.intval($year);
	} elseif ( !empty($w) ) {
		// We need to get the month from MySQL
		$thisyear = ''.intval(my_substr($m, 0, 4));
		$d = (($w - 1) * 7) + 6; //it seems MySQL's weeks disagree with PHP's
		$thismonth = $wpdb->get_var("SELECT DATE_FORMAT((DATE_ADD('{$thisyear}0101', INTERVAL $d DAY) ), '%m')");
	} elseif ( !empty($m) ) {
		$thisyear = ''.intval(my_substr($m, 0, 4));
		if ( my_strlen($m) < 6 )
				$thismonth = '01';
		else
				$thismonth = ''.zeroise(intval(my_substr($m, 4, 2)), 2);
	} else {
		$thisyear = gmdate('Y', current_time('timestamp'));
		$thismonth = gmdate('m', current_time('timestamp'));
	}

	$unixmonth = mktime(0, 0 , 0, $thismonth, 1, $thisyear);
	$last_day = date('t', $unixmonth);

	// Get the next and previous month and year with at least one post
	$previous = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date < '$thisyear-$thismonth-01'
		AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'
			ORDER BY post_date DESC
			LIMIT 1");
	$next = $wpdb->get_row("SELECT MONTH(post_date) AS month, YEAR(post_date) AS year
		FROM $wpdb->posts
		WHERE post_date > '$thisyear-$thismonth-{$last_day} 23:59:59' AND post_date_gmt > '$thisyear-$thismonth-{$last_day} 23:59:59'
		AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'
			ORDER BY post_date ASC
			LIMIT 1");

	/* translators: Calendar caption: 1: month name, 2: 4-digit year */
	$calendar_caption = _x('%1$s %2$s', 'calendar caption', 'themerex');
	$calendar_output = '<table id="wp-calendar">
	<caption>' . sprintf($calendar_caption, $wp_locale->get_month($thismonth), date('Y', $unixmonth)) . '</caption>
	<thead>
	<tr>';

	$myweek = array();

	for ( $wdcount=0; $wdcount<=6; $wdcount++ ) {
		$myweek[] = $wp_locale->get_weekday(($wdcount+$week_begins)%7);
	}

	foreach ( $myweek as $wd ) {
		$day_name = (true == $initial) ? $wp_locale->get_weekday_initial($wd) : $wp_locale->get_weekday_abbrev($wd);
		$wd = esc_attr($wd);
		$calendar_output .= "\n\t\t<th scope=\"col\" title=\"$wd\">$day_name</th>";
	}

	$calendar_output .= '
	</tr>
	</thead>

	<tfoot>
	<tr>';

	if ( $previous ) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev"><a href="' . get_month_link($previous->year, $previous->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s', 'themerex'), $wp_locale->get_month($previous->month), date('Y', mktime(0, 0 , 0, $previous->month, 1, $previous->year)))) . '">&laquo; ' . $wp_locale->get_month_abbrev($wp_locale->get_month($previous->month)) . '</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="prev" class="pad">&nbsp;</td>';
	}

	$calendar_output .= "\n\t\t".'<td class="pad">&nbsp;</td>';

	if ( $next && ($next->year.'-'.$next->month <= date('Y-m'))) {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next"><a href="' . get_month_link($next->year, $next->month) . '" title="' . esc_attr( sprintf(__('View posts for %1$s %2$s', 'themerex'), $wp_locale->get_month($next->month), date('Y', mktime(0, 0 , 0, $next->month, 1, $next->year))) ) . '">' . $wp_locale->get_month_abbrev($wp_locale->get_month($next->month)) . ' &raquo;</a></td>';
	} else {
		$calendar_output .= "\n\t\t".'<td colspan="3" id="next" class="pad">&nbsp;</td>';
	}

	$calendar_output .= '
	</tr>
	</tfoot>

	<tbody>
	<tr>';

	// Get days with posts
	$dayswithposts = $wpdb->get_results("SELECT DISTINCT DAYOFMONTH(post_date)
		FROM $wpdb->posts WHERE (post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' OR post_date_gmt >= '{$thisyear}-{$thismonth}-01 00:00:00')
		AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'
		AND (post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' OR post_date_gmt <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59')", ARRAY_N);
	if ( $dayswithposts ) {
		foreach ( (array) $dayswithposts as $daywith ) {
			$daywithpost[] = $daywith[0];
		}
	} else {
		$daywithpost = array();
	}

	if (my_strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'camino') !== false || stripos($_SERVER['HTTP_USER_AGENT'], 'safari') !== false)
		$ak_title_separator = "\n";
	else
		$ak_title_separator = ', ';

	$ak_titles_for_day = array();
	$ak_post_titles = $wpdb->get_results("SELECT ID, post_title, DAYOFMONTH(post_date) as dom "
		."FROM $wpdb->posts "
		."WHERE (post_date >= '{$thisyear}-{$thismonth}-01 00:00:00' OR post_date_gmt >= '{$thisyear}-{$thismonth}-01 00:00:00') "
		."AND (post_date <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59' OR post_date_gmt <= '{$thisyear}-{$thismonth}-{$last_day} 23:59:59') "
		."AND post_type IN ('" . join("', '", $allowed_types) . "') AND post_status = 'publish'"
	);
	if ( $ak_post_titles ) {
		foreach ( (array) $ak_post_titles as $ak_post_title ) {

				$post_title = esc_attr( apply_filters( 'the_title', $ak_post_title->post_title, $ak_post_title->ID ) );

				if ( empty($ak_titles_for_day['day_'.$ak_post_title->dom]) )
					$ak_titles_for_day['day_'.$ak_post_title->dom] = '';
				if ( empty($ak_titles_for_day["$ak_post_title->dom"]) ) // first one
					$ak_titles_for_day["$ak_post_title->dom"] = $post_title;
				else
					$ak_titles_for_day["$ak_post_title->dom"] .= $ak_title_separator . $post_title;
		}
	}

	// See how much we should pad in the beginning
	$pad = calendar_week_mod(date('w', $unixmonth)-$week_begins);
	if ( 0 != $pad )
		$calendar_output .= "\n\t\t".'<td colspan="'. esc_attr($pad) .'" class="pad">&nbsp;</td>';

	$daysinmonth = intval(date('t', $unixmonth));
	for ( $day = 1; $day <= $daysinmonth; ++$day ) {
		if ( isset($newrow) && $newrow )
			$calendar_output .= "\n\t</tr>\n\t<tr>\n\t\t";
		$newrow = false;

		if ( $day == gmdate('j', current_time('timestamp')) && $thismonth == gmdate('m', current_time('timestamp')) && $thisyear == gmdate('Y', current_time('timestamp')) )
			$calendar_output .= '<td id="today">';
		else
			$calendar_output .= '<td>';

		if ( in_array($day, $daywithpost) ) // any posts today?
				$calendar_output .= '<a href="' . get_day_link( $thisyear, $thismonth, $day ) . '" title="' . esc_attr( $ak_titles_for_day[ $day ] ) . "\">$day</a>";
		else
			$calendar_output .= $day;
		$calendar_output .= '</td>';

		if ( 6 == calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins) )
			$newrow = true;
	}

	$pad = 7 - calendar_week_mod(date('w', mktime(0, 0 , 0, $thismonth, $day, $thisyear))-$week_begins);
	if ( $pad != 0 && $pad != 7 )
		$calendar_output .= "\n\t\t".'<td class="pad" colspan="'. esc_attr($pad) .'">&nbsp;</td>';

	$calendar_output .= "\n\t</tr>\n\t</tbody>\n\t</table>";

	$cache[ $key ] = $calendar_output;
	wp_cache_set( 'get_calendar', $cache, 'calendar' );

	if ( $echo )
		echo apply_filters( 'get_calendar',  $calendar_output );
	else
		return apply_filters( 'get_calendar',  $calendar_output );

}


// Decorate 'read more...' link
function decorateMoreLink($text, $tag_start='<div class="readmore">', $tag_end='</div>') {
	//return preg_replace('/(<a[^>]+class="more-link"[^>]*>[^<]*<\\/a>)/', "{$tag_start}\${1}{$tag_end}", $text);
	$rez = $text;
	if (($pos = my_strpos($text, ' class="more-link"><span class="readmore">'))!==false) {
		$i = $pos-1;
		while ($i > 0) {
			if (my_substr($text, $i, 3) == '<a ') {
				if (($pos = my_strpos($text, '</span></a>', $pos))!== false) {
					$pos += 11;
					$start = my_substr($text, $i-4, 4) == '<p> ' ? $i-4 : (my_substr($text, $i-3, 3) == '<p>' ? $i-3 : $i);
					$end   = my_substr($text, $pos, 4) == '</p>' ? $pos+4 : $pos;
					$rez = my_substr($text, 0, $start) . $tag_start . my_substr($text, $i, $pos-$i) . $tag_end . my_substr($text, $end);
					break;
				}
			}
			$i--;
		}
	}
	return $rez;
}








/* ========================= Aqua resizer wrapper ============================== */


function getResizedImageTag( $post, $w=null, $h=null, $c=null, $u=true, $find_thumb=false ) {
	static $mult = 0;
	if ($mult == 0) $mult = min(2, max(1, get_theme_option("retina_ready")));
    if (is_object($post))		$alt = getPostTitle( $post->ID );
    else if ((int) $post > 0) 	$alt = getPostTitle( $post );
	else						$alt = basename($post);
	$url = getResizedImageURL($post, $w ? $w*$mult : $w, $h ? $h*$mult : $h, $c, $u, $find_thumb);
	/*
	if ($url != '') {
		if (($url_dir = getUploadsDirFromURL($url)) !== false)
			$size = @getimagesize($url_dir);
		else
			$size = false;
		return '<img class="wp-post-image" ' . ($size!==false && isset($size[3]) ? $size[3] : '') . ' alt="' . $alt . '" src="' . $url . '">';
	} else
		return '';
	*/
	return $url!='' ? ('<img class="wp-post-image"' . ($w ? ' width="'.$w.'"' : '') . ($h ? ' height="' . $h . '"' : '') . ' alt="' . $alt . '" src="' . $url . '">') : '';
}



function getResizedImageURL( $post, $w=null, $h=null, $c=null, $u=true, $find_thumb=false ) {
	$url = '';
	if (is_object($post) || (int) $post > 0) {
		$thumb_id = get_post_thumbnail_id( is_object($post) ? $post->ID : $post );
		if (!$thumb_id && $find_thumb) {
			$args = array(
					'numberposts' => 1,
					'order' => 'ASC',
					'post_mime_type' => 'image',
					'post_parent' => $post,
					'post_status' => 'any',
					'post_type' => 'attachment',
				);
			$attachments = get_children( $args );
			foreach ( $attachments as $attachment ) {
				$thumb_id = $attachment->ID;
				break;
			}
		}
		if ($thumb_id) {
			$src = wp_get_attachment_image_src( $thumb_id, 'full' );
			$url = $src[0];
		}
		if ($url == '' && $find_thumb) {
			if (($data = get_post(is_object($post) ? $post->ID : $post))!==null) {
				$url = getTagAttrib($data->post_content, '<img>', 'src');
			}
		}
	} else
		$url = trim(chop($post));
	if ($url != '') {
	    if ($c === null) $c = true;	//$c = get_option('thumbnail_crop')==1;
		if ( ! ($new_url = aq_resize( $url, $w, $h, $c, true, $u)) ) {
			if (false)
				$new_url = get_the_post_thumbnail($url, array($w, $h));
			else
				$new_url = $url;
		}
	} else $new_url = '';
	return $new_url;
}

function getUploadsDirFromURL($url) {
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	$http_prefix = "http://";
	$https_prefix = "https://";
	
	if (!strncmp($url,$https_prefix,my_strlen($https_prefix))){ //if url begins with https:// make $upload_url begin with https:// as well
		$upload_url = str_replace($http_prefix, $https_prefix, $upload_url);
	} else if (!strncmp($url,$http_prefix,my_strlen($http_prefix))){ //if url begins with http:// make $upload_url begin with http:// as well
		$upload_url = str_replace($https_prefix, $http_prefix, $upload_url);		
	}

	// Check if $img_url is local.
	if ( false === my_strpos( $url, $upload_url ) ) return false;

	// Define path of image.
	$rel_path = str_replace( $upload_url, '', $url );
	$img_path = $upload_dir . $rel_path;
	
	return $img_path;
}
?>