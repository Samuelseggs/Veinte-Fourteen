<?php //processing for ajax user ratings

//this assumes your theme is not within a subfolder of your themes folder and goes all the way to the root of your WP install
//this file (ajax-sort.php) should be in the following location on your server: wp-content/themes/steam/functions/ajax-sort.php
//that is why there are four ../ in a row, so it goes back four folders into your main WP install
//if ajax-sort.php is not in this location, you may need to add an extra ../ or remove one, but 99.9% of the time this will work
$wordpress_location = "../../../../wp-load.php";

//grab WordPress functions
require_once($wordpress_location);

$sorter=$_POST["sorter"];
$loop=$_POST["loop"];
$location=$_POST["location"];
$container=$_POST["container"];
if(empty($location)) $location = $loop; #a specified location overrides the loop parameter
$action=$_POST["action"];
$cols=$_POST["columns"];
$paginated=$_POST["paginated"];
$thumbnail=$_POST["thumbnail"];
$morelink=$_POST["morelink"];
$numarticles=$_POST["numarticles"];
$rating=$_POST["rating"];
$rating_small=$_POST["ratingsmall"];
$view=$_POST["view"];
$likeaction=$_POST["likeaction"];
$postid=$_POST["id"];
$timeperiod=$_POST["timeperiod"];
$query=$_POST["currentquery"];
$meta=$_POST["meta"];
$award=$_POST["award"];
$article_format=$_POST["articleformat"];
$metric=$_POST["metric"];
$divID=$_POST["divID"];
$method=$_POST["method"];
$targeted=$_POST["targeted"];
$taxonomy=$_POST["taxonomy"];
$icon=$_POST["icon"];
$container=$_POST["container"];
$comments_per_page=$_POST["commentsperpage"];
$offset=$_POST["offset"];
$type=$_POST["type"];
$minisite=$_POST["minisite"];
$object=$_POST["object"];
$object_name=$_POST["object_name"];
$content_before = '';
$content_after = '';
$out = '';
$args = array();
$format = array();

#get the user's ip address
$ip=$_SERVER['REMOTE_ADDR'];

switch ($action) {
	case 'sort':
		switch ($loop) {
			case 'trending':
				#setup loop format
				$format = array('loop' => $loop, 'location' => $location, 'numarticles' => $numarticles, 'metric' => $sorter);
				switch($sorter) {					
					case 'liked':
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_LIKES);	
						break;
					case 'viewed':
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_VIEWS);	
						break;					
					case 'commented':
						$args = array('orderby' => 'comment_count');	
						break;					
				}
				$args['posts_per_page'] = $numarticles;
				#add current query to new query args
				if(!empty($query) && is_array($query)) $args = array_merge($args, $query);
			break;
			case 'top ten':
				#setup loop format
				$format = array('loop' => $loop, 'metric' => $sorter);
				switch($sorter) {
					case 'liked':
						$args = array('order' => 'DESC', 'meta_key' => IT_META_TOTAL_LIKES, 'orderby' => 'meta_value_num');
						break;
					case 'viewed':
						$args = array('order' => 'DESC', 'meta_key' => IT_META_TOTAL_VIEWS, 'orderby' => 'meta_value_num');	
						break;
					case 'rated':
						$format['rating'] = true;
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_USER_SCORE_NORMALIZED, 'meta_query' => array(array( 'key' => IT_META_DISABLE_REVIEW, 'value' => 'false', 'compare' => '=' )));	
						break;
					case 'reviewed':
						$format['rating'] = true;
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_SCORE_NORMALIZED, 'meta_query' => array(array( 'key' => IT_META_DISABLE_REVIEW, 'value' => 'false', 'compare' => '=' )));	
						break;
					case 'commented':
						$args = array('orderby' => 'comment_count');	
						break;
				}
				$args['posts_per_page'] = 10;
				#add current query to new query args
				if(!empty($query) && is_array($query)) $args = array_merge($args, $query);
			break;
			case 'main loop':
				#setup loop format
				$format = array('loop' => $loop, 'location' => $location, 'view' => $view, 'columns' => $cols, 'sort' => $sorter, 'paged' => $paginated, 'thumbnail' => $thumbnail, 'rating' => $rating, 'icon' => true, 'meta' => $meta, 'container' => $container, 'numarticles' => $numarticles);
				switch($sorter) {
					case 'recent':
						$args = array('orderby' => 'date');
						break;
					case 'liked':
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_LIKES);	
						break;
					case 'viewed':
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_VIEWS);	
						break;
					case 'reviewed':
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_SCORE_NORMALIZED, 'meta_query' => array(array( 'key' => IT_META_DISABLE_REVIEW, 'value' => 'false', 'compare' => '=' )));	
						break;
					case 'rated':
						$format['rating'] = true;
						$args = array('orderby' => 'meta_value_num', 'meta_key' => IT_META_TOTAL_USER_SCORE_NORMALIZED, 'meta_query' => array(array( 'key' => IT_META_DISABLE_REVIEW, 'value' => 'false', 'compare' => '=' )));	
						break;
					case 'commented':
						$args = array('orderby' => 'comment_count');	
						break;
					case 'awarded':
						$args = array('orderby' => 'date', 'order' => 'DESC', 'meta_query' => array( array( 'key' => IT_META_AWARDS, 'value' => array(''), 'compare' => 'NOT IN') ));	
						break;
				}
				$args['posts_per_page'] = $numarticles;
				$args['paged'] = $paginated;
				#add current query to new query args
				if(!empty($query) && is_array($query)) $args = array_merge($args, $query);
			break;
			case 'minisite tabs':
				#setup loop format
				$format = array('loop' => $loop, 'location' => $location, 'sort' => $sorter, 'thumbnail' => $thumbnail, 'thumbnail' => $thumbnail, 'rating' => $rating, 'rating_small' => $rating_small, 'award' => $award, 'rating_small' => $rating_small, 'meta' => $meta, 'article_format' => $article_format, 'width' => 349, 'height' => 240, 'size' => 'grid-post');
				$args = array('posts_per_page' => $numarticles, 'post_type' => $sorter);				
			break;
			case 'menu':
				#setup loop format
				$format = array('loop' => $loop, 'location' => $location, 'thumbnail' => $thumbnail, 'rating' => false, 'icon' => false);
				$args = array('posts_per_page' => $numarticles, $object_name => $sorter);
				if($method=='minisite') $args['post_type'] = $minisite;
				
				#add loading to content
				$content_before = '<div class="loading"><div>&nbsp;</div></div>';
				
				#add more link to content
				$term_link = get_term_link($sorter, $object);
				$content_after = '<a class="view-all" href="' . $term_link . '">' . __('VIEW ALL',IT_TEXTDOMAIN) . '<span class="icon-right"></span></a>';
				
			break;
			case 'recommended':
				#taxonomy query
				$tax_query = array(array('taxonomy' => $taxonomy, 'field' => 'id', 'terms' => $sorter));
									
				#format
				$format = array('loop' => $loop, 'location' => $location, 'thumbnail' => $thumbnail, 'rating' => $rating, 'icon' => $icon, 'container' => $container, 'columns' => $cols);		
				switch($method) {
					case 'tags':
						$args=array('tag_id' => $sorter);	
						break;
					case 'categories':
						$args=array('cat' => $sorter);	
						break;	
					case 'taxonomies':
						$args=array('tax_query' => $tax_query);							
						break;
				}
				$args['posts_per_page'] = $numarticles;
				$args['post__not_in'] = array($postid);
				#recommended targeted
				if(!empty($targeted)) $args['post_type'] = $targeted;
			break;
		}
		#add the time period to the args
		$week = date('W');
		$month = date('n');
		$year = date('Y');
		switch($timeperiod) {
			case 'This Week':
				$args['year'] = $year;
				$args['w'] = $week;
				$timeperiod='';
			break;	
			case 'This Month':
				$args['monthnum'] = $month;
				$args['year'] = $year;
				$timeperiod='';
			break;
			case 'This Year':
				$args['year'] = $year;
				$timeperiod='';
			break;
			case 'all':
				$timeperiod='';
			break;			
		}
		#build the loop html and return to ajax call	
		$loop = it_loop($args, $format, $timeperiod);
		$loop_content = '';
		$loop_pages = 0;
		$loop_updatepagination = '';
		$buildquery = '';
		if(array_key_exists('content',$loop)) $loop_content = $loop['content'];
		if(array_key_exists('pages',$loop)) $loop_pages = $loop['pages'];
		if(array_key_exists('updatepagination',$loop)) $loop_updatepagination = $loop['updatepagination'];
		if(!empty($query)) $buildquery = http_build_query($query);
		#add in before and after content
		$loop_content = $content_before . $loop_content . $content_after;
		echo json_encode(array('content' => $loop_content, 'pagination' => it_pagination($loop_pages, $format, it_get_setting('page_range')), 'paginationmobile' => it_pagination($loop_pages, $format, it_get_setting('page_range_mobile')), 'pages' => $loop_pages, 'updatepagination' => $loop_updatepagination, 'utility' => $buildquery));
	break;
	case 'like':
		#get meta info
		$ips = get_post_meta($postid, IT_META_LIKE_IP_LIST, $single = true);
		if(!metadata_exists('post', $postid, IT_META_LIKE_IP_LIST)) $addipmeta=true;
		
		$likes = get_post_meta($postid, IT_META_TOTAL_LIKES, $single = true);
		if(!metadata_exists('post', $postid, IT_META_TOTAL_LIKES)) $addlikesmeta=true;
		
		$ip.=';'; #add delimiter
		
		if($likeaction=='like') {
			$ips.=$ip; #add ip to string
			$likes+=1; #increase likes
		} else {
			$ips = str_replace($ip,'',$ips); #remove ip from string
			$likes-=1; #decrease likes
		}
		
		#figure out whether to add or update the ip address meta field
		if($addipmeta) {
			add_post_meta($postid, IT_META_LIKE_IP_LIST, $ips);
		} else {
			update_post_meta($postid, IT_META_LIKE_IP_LIST, $ips);
		}
		
		#figure out whether to add or update the total likes meta field
		if($addlikesmeta) {
			add_post_meta($postid, IT_META_TOTAL_LIKES, $likes);
		} else {
			update_post_meta($postid, IT_META_TOTAL_LIKES, $likes);
		}
		
		if($likes=='') $likes=0;
		#determine label
		if($location=='single-page') {
			if($likes==1) {
				$likes.=__(' like',IT_TEXTDOMAIN);
			} else {
				$likes.=__(' likes',IT_TEXTDOMAIN);
			}
		} else {
			if($likes==0) $likes=''; #don't display 0 count
		}
		
		echo json_encode(array('content' => $likes));
	
	break;
	case 'rate':
	
		#setup the args
		$ratingargs = array('postid' => $postid, 'meta' => $meta, 'metric' => $metric, 'rating' => $rating);
		
		#perform the actual meta updates
		$ratings = it_save_user_ratings($ratingargs);
		
		#return the values
		echo json_encode(array('newrating' => $ratings['new_rating'], 'totalrating' => $ratings['total_rating'], 'normalized' => $ratings['normalized'], 'divID' => $divID, 'unlimitedratings' => $ratings['unlimitedratings']));
			
	break;
	case 'paginate_comments': #NOT CURRENTLY USED
	
		#setup query
		$args = array('number' => $comments_per_page, 'status' => 'approve', 'type' => $type, 'post_id' => $postid, 'offset' => $offset);
		
		#get the comments	
		$comments = it_comments($args); 
		
		#return the values
		echo json_encode(array('content' => $comments['content']));
		
	break;
	case 'menu_terms':
	
		#defaults
		$term_count = 0;
		$post_count = 0;
		$term_counter = 0;
		$mega_dropdown = false;
	
		#get term list based on method
		switch($method) {
			case 'minisite':
				$terms = get_terms($object, array('parent' => 0, 'hide_empty' => 0));
				if(!empty($terms)) $first_term = $terms[0]->slug;	
				$args['post_type'] = $minisite->id;
			break;	
			case 'category':
				$terms = get_terms($object, array('parent' => $objectid, 'hide_empty' => 0));
				#if(!empty($terms)) $first_term = $terms[0]->slug;
				$first_term = $sorter;
			break;
			case 'post_tag':
				$terms = get_terms($object, array('parent' => $objectid, 'hide_empty' => 0));
				#if(!empty($terms)) $first_term = $terms[0]->slug;
				$first_term = $sorter;
			break;
			case 'taxonomy':
				$terms = get_terms($object, array('parent' => $objectid, 'hide_empty' => 0));
				if(!empty($terms)) $first_term = $terms[0]->slug;
				$term = get_term_by('id', $objectid, $object);
			break;
		}
	
		#only get loop for mega menu items
		if($type == 'mega') {
			#no term list was found, don't display sub terms
			if(empty($terms)) {
				$term = get_term_by('id', $objectid, $object);
				$first_term = $term->slug;
			}
			#get count of returned terms
			if($method=='minisite') $term_count = count($terms);
			#add first object to args
			$args[$object_name] = $first_term;
			#get the link for the first object
			$term_link = get_term_link($first_term, $object);
			#setup args
			$format = array('loop' => $loop, 'location' => $location, 'thumbnail' => $thumbnail, 'rating' => false, 'icon' => false);
			$args = array('posts_per_page' => $numarticles, $object_name => $first_term);
			#query posts
			$loop = it_loop($args, $format);
			$post_count = $loop['posts'];
			
		}
		
		if($term_count > 0 || $post_count > 0) $mega_dropdown = true;
	
		#begin mega drop down
		if($mega_dropdown) {
			$out .= '<ul class="term-list';
			if($term_count == 0) $out .= ' solo';
			$out .= '">';
				$out .= '<li class="post-list">';
					$out .= '<div class="loading"><div>&nbsp;</div></div>';
					$out .= $loop['content'];
					$out .= '<a class="view-all" href="' . $term_link . '">' . __('VIEW ALL',IT_TEXTDOMAIN) . '<span class="icon-right"></span></a>';
				$out .= '</li>';
				
				#begin sub term menu list
				if($term_count > 0) {
					foreach ( $terms as $term ) { 
						$term_counter++;
						$term_name = $term->name;
						$term_slug = $term->slug;
						$term_link = get_term_link($term_slug, $object);
						$out .= '<li';
						if($term_counter==1) {
							$out .= ' class="active"';
						} else {
							$out .= ' class="inactive"';
						}
						$out .= '>';
							$out .= '<a class="list-item" data-sorter="'.$term_slug.'" href="' . $term_link . '">' . $term_name . '</a>';
						$out .= '</li>';
					}
				}							
			$out .= '</ul>';				
		}	
		wp_reset_query();
	
		#return the values
		echo json_encode(array('content' => $out));
	
	break;
} ?>