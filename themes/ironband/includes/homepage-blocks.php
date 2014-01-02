<?php

function iron_get_home_slider() {

	$query = new WP_Query( array(
		  'post_type' => 'slide'
		, 'no_found_rows' => true
	) );

	$output = '';

	if ( $query->have_posts() ) :

		$output = array();

		while ( $query->have_posts() ) : $query->the_post();
			if ( ! has_post_thumbnail() ) continue;

			if ( get_field('slide_link_type') == 'internal' ) {
				$link = get_field('slide_link');
				$target = '';
			} else {
				$link = get_field('slide_link_external');
				$target = ' target="blank" ';
			}

			if ( ! $action = get_field('slide_more_text') ) {
				if ( ! $action = get_iron_option('slide_more_label') ) {
					$action = __('Read More', IRON_TEXT_DOMAIN);
				}
			}

			$title = get_the_title();

			if ( ! $icon = get_iron_option('slides_widget_action_icon') )
				$icon = 'plus';

			$output[] = '
				<li class="slide" data-transition="slidedown" data-slotamount="10" data-masterspeed="300">
					' . get_the_post_thumbnail( get_the_ID(), 'full' ) . '
					<div class="caption text-box lfl lfl" data-x="0" data-y="140" data-speed="300" data-start="800" data-easing="easeOutExpo">'
						. ( empty($title) ? '<div class="placeholder"></div>' : '<h1><span>' . get_the_title() . '</span></h1>' . ( empty($link)  ? '' : '<a class="more" href="' . $link . '"' . $target . '><i class="icon-' . $icon .'"></i> ' . $action . '</a>' ) )
						. '<div class="tp-leftarrow tparrows"><i class="icon-caret-left"></i></div>
						<div class="tp-rightarrow tparrows"><i class="icon-caret-right"></i></div>
					</div>
				</li>';

		endwhile;

		if ( empty($output) ) :
			$output = '';
		else :
			$output = '
	<!-- marquee -->
	<div class="marquee__container">
		<div id="home-marquee" class="marquee">
			<ul class="slideset">'
			. implode("\n", $output).
			'</ul>
		</div>
	</div>';
		endif;

		wp_reset_postdata();

	endif;

	return $output;
}

function iron_get_home_audioplayer_twitter() {

	global $post;

	$page_id = get_iron_option('page_for_albums');

	$more_link = iron_widget_action_link( 'album', $page_id );

	$playlist = iron_get_playlist();
	if ( isset($playlist['tracks']) && !empty($playlist['tracks']) )
		$player_message = __("Loading tracks...", IRON_TEXT_DOMAIN);
	else
		$player_message = __("No tracks founds...", IRON_TEXT_DOMAIN);

	$output = '
	<!-- widget-blocks -->
	<div class="widget-blocks">
		<!-- block -->';

		$output .= '
		<div class="block">
			<div class="holder">
				<!-- title-box -->
				<header class="title-box">
					'.$more_link.'
					<h2>'.$playlist['playlist_name'].'</h2>
				</header>
				<!-- album-box player-holder -->
				<div class="album-box player-holder" data-url-playlist="'.get_permalink($post->ID).'?load=playlist.json">
					<div class="info-box">
						<img class="poster-image" src="'.IRON_PARENT_URL.'/images/player-thumb.jpg" width="107" height="107" alt="">
						<div class="text player-title-box">'.$player_message.'</div>
					</div>
					<!-- jplayer markup start -->
					<div id="audio-holder">
						<div class="jp-jplayer"></div>
						<!-- jp-audio player-box -->
						<div class="jp-audio player-box">
							<div class="jp-type-playlist">
								<div class="jp-gui jp-interface">
									<!-- time-box -->
									<div class="time-box">
										<div class="jp-current-time"></div>
										<div class="jp-duration"></div>
									</div>
									<!-- jp-controls -->
									<ul class="jp-controls">
										<li><a href="javascript:;" class="jp-previous" tabindex="1"><i class="icon-backward" title="'.__("previous", IRON_TEXT_DOMAIN).'"></i></a></li>
										<li><a href="javascript:;" class="jp-play" tabindex="1"><i class="icon-play" title="'.__("play", IRON_TEXT_DOMAIN).'"></i></a></li>
										<li><a href="javascript:;" class="jp-pause" tabindex="1"><i class="icon-pause" title="'.__("pause", IRON_TEXT_DOMAIN).'"></i></a></li>
										<li><a href="javascript:;" class="jp-next" tabindex="1"><i class="icon-forward" title="'.__("next", IRON_TEXT_DOMAIN).'"></i></a></li>
									</ul>
									<!-- jp-progress -->
									<div class="jp-progress">
										<div class="jp-seek-bar">
											<div class="jp-play-bar"></div>
										</div>
									</div>
								</div>
								<!-- jp-playlist hidden -->
								<div class="jp-playlist hidden">
									<ul>
										<li></li>
									</ul>
								</div>
								<!-- jp-no-solution -->
								<div class="jp-no-solution '.(empty($playlist['tracks']) ? 'hidden' : '').'">
									<span>'.__("Update Required", IRON_TEXT_DOMAIN).'</span>
									'.__("To play the media you will need to either update your browser to a recent version or update your", IRON_TEXT_DOMAIN).' <a href="http://get.adobe.com/flashplayer/" target="_blank">Flash plugin</a>.
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- block -->';

		if ( ! $icon = get_iron_option('twitter_widget_action_icon') )
			$icon = 'plus';

		$output .= '
		<div class="block">
			<div class="holder">
				<header class="title-box">
					<a class="link" target="_blank" href="' . get_iron_option('twitter_page') . '"><i class="icon-' . $icon . '"></i> <span class="label">' . __(get_iron_option('twitter_widget_action_label'), IRON_TEXT_DOMAIN) . '</span></a>
					<h2>'.__(get_iron_option('twitter_widget_label'), IRON_TEXT_DOMAIN).'</h2>
				</header>
				<div class="twitter-box">
					<div id="twitter" class="query" data-username="'.get_iron_option('twitter_username').'"></div>
				</div>
			</div>
		</div>';

	$output .= '</div>';

	return $output;
}


function iron_get_home_news() {

	$query = new WP_Query( array(
		  'post_type'     => 'post'
		, 'no_found_rows' => true
	)  );

	$output = "";
	$more_link = "";

	if ( $query->have_posts() ) :
		global $post;

		$page_id = get_option('page_for_posts');
		$more_link = iron_widget_action_link( 'post', $page_id );

		if ( get_iron_option('posts_widget_label') )
			$title = get_iron_option('posts_widget_label');

		else if ( $page_id )
			$title = get_the_title($page_id);

		else if ( get_iron_option('post_type_label') )
			$title = __(get_iron_option('post_type_label'), IRON_TEXT_DOMAIN);

		else {
			$post_type_object = get_post_type_object('post');
			$title = $post_type_object->label;
		}

		$output .= '
		<!-- carousel responsive1 -->
		<div class="carousel responsive1">
			<div class="mask">
				<!-- slideset -->
				<div class="slideset">';

		while ( $query->have_posts() ) : $query->the_post();

			$output .= '
					<!-- slide -->
					<div class="slide">
						<a href="' . get_permalink() . '">';

			if ( has_post_thumbnail() ) :
				$output .= '
 							<div class="image">' . get_the_post_thumbnail($post->ID, array(326, 183), array( 'alt' => $post->post_title )) . '</div>';
			endif;

			$output .= '
							<div class="text">
								<h2>' . get_the_title() . '</h2>
								<time class="date" datetime="' . get_the_time('c') . '">' . get_the_date() . '</time>
								<i class="more icon-plus" title="' . __('More', IRON_TEXT_DOMAIN) . '"></i>
							</div>
						</a>
					</div>';
		endwhile;

		$output .= '
				</div>
			</div>
			<a class="btn-prev" href="#"><i class="icon-left-open-big" title="' . __('Previous', IRON_TEXT_DOMAIN) . '"></i></a>
			<a class="btn-next" href="#"><i class="icon-right-open-big" title="' . __('Next', IRON_TEXT_DOMAIN) . '"></i></a>
		</div>';

		wp_reset_postdata();

	else :
		$output .= '<h2>' . __('There are no posts to display.', IRON_TEXT_DOMAIN) . '</h2>';
	endif;

	if ( empty( $output ) ) :
		$output = '';
	else :
		$output = '
	<!-- section -->
	<section class="section">
		<!-- heading -->
		<header class="heading">
			<h1>' . $title . '</h1>
			' . $more_link . '
		</header>'
		. $output .
	'</section>';
	endif;

	return $output;
}

function iron_get_home_gigs() {

	$query = new WP_Query( array(
		  'post_type'     => 'gig'
		, 'no_found_rows' => true
	) );

	$output = "";
	$more_link = "";

	if ( $query->have_posts() ) :
		global $post;

		$page_id = iron_get_page_for_post_type('gig', 'archive-gig.php');
		$more_link = iron_widget_action_link('gig', $page_id);

		if ( get_iron_option('gigs_widget_label') )
			$title = get_iron_option('gigs_widget_label');

		else if ( $page_id )
			$title = get_the_title($page_id);

		else {
			$post_type_object = get_post_type_object('gig');
			$title = $post_type_object->label;
		}

		$output = '
		<!-- carousel responsive2 -->
		<div class="carousel responsive2">
			<div class="mask">
				<!-- slideset -->
				<div class="slideset">';

		while ( $query->have_posts() ) : $query->the_post();
			$output .= '
					<!-- slide -->
					<div class="slide">
						<a class="concert-box" href="' . get_permalink($page_id) . '?id=' . $post->ID . '">
							<div class="info">
								<time class="date">' . iron_get_the_gig_date() . '</time>';

			$output .= '<span class="location">' . get_the_title() . '</span>';


			if ( get_field('gig_city', $post->ID) ) {
				$output .= '
								@' . get_field('gig_city', $post->ID);
			}

			$output .= '
							</div>
							<div class="hover-box">
								' . __(get_iron_option('gig_more_label'), IRON_TEXT_DOMAIN) . '
							</div>
							<i class="more icon-plus" title="' . __('More', IRON_TEXT_DOMAIN) . '"></i>
						</a>
					</div>';
		endwhile;

		$output .= '
				</div>
			</div>
			<a class="btn-prev" href="#"><i class="icon-left-open-big" title="' . __('Previous', IRON_TEXT_DOMAIN) . '"></i></a>
			<a class="btn-next" href="#"><i class="icon-right-open-big" title="' . __('Next', IRON_TEXT_DOMAIN) . '"></i></a>
		</div>';

		wp_reset_postdata();

	else :
		$output .= '<h2>' . __('No Gigs scheduled right now.', IRON_TEXT_DOMAIN) . '</h2>';
	endif;

	if ( empty( $output ) ) :
		$output = '';
	else :
		$output = '
	<!-- section -->
	<section class="section">
		<!-- heading -->
		<header class="heading">
			<h1>' . $title . '</h1>
			' . $more_link . '
		</header>'
		. $output .
	'</section>';
	endif;

	return $output;
}

function iron_get_home_videos() {

	$query = new WP_Query( array(
		  'post_type'     => 'video'
		, 'no_found_rows' => true
	) );

	$output = "";
	$more_link = "";

	if ( $query->have_posts() ) :
		global $post;

		$page_id = get_iron_option('page_for_videos');
		$more_link = iron_widget_action_link('video', $page_id);

		if ( get_iron_option('videos_widget_label') )
			$title = get_iron_option('videos_widget_label');

		else if ( $page_id )
			$title = get_the_title($page_id);

		else {
			$post_type_object = get_post_type_object('video');
			$title = $post_type_object->label;
		}

		$output .= '
		<!-- carousel responsive3 -->
		<div class="carousel responsive3">
			<div class="mask">
				<!-- slideset -->
				<div class="slideset">';

		while ( $query->have_posts() ) : $query->the_post();

			$image = get_the_post_thumbnail( $post->ID, array(326, 183) );

			$output .= '
					<!-- slide -->
					<div class="slide">
						<a class="video-box" href="' . get_permalink() . '">';

			if ( $image )
			{
				$output .= '<div class="image">' . $image . '</div>';

				$output .= '
							<i class="icon-play"></i>
							<span class="btn-play">' . __('Play Video', IRON_TEXT_DOMAIN) . '</span>
							<div class="hover-box">
								<h2>' . get_the_title() . '</h2>
							</div>';
			} else {
				$output .= '
							<div class="text">
								<h2>' . get_the_title() . '</h2>
								<i class="more icon-plus" title="' . __('More', IRON_TEXT_DOMAIN) . '"></i>
							</div>';
			}

			$output .= '
						</a>
					</div>';
		endwhile;

		$output .= '
				</div>
			</div>
			<a class="btn-prev" href="#"><i class="icon-left-open-big" title="' . __('Previous', IRON_TEXT_DOMAIN) . '"></i></a>
			<a class="btn-next" href="#"><i class="icon-right-open-big" title="' . __('Next', IRON_TEXT_DOMAIN) . '"></i></a>
		</div>';

		wp_reset_postdata();

	else :
		$output .= '<h2>' . __('No videos available at this time.', IRON_TEXT_DOMAIN) . '</h2>';
	endif;

	if ( empty( $output ) ) :
		$output = '';
	else :
		$output = '
	<!-- section -->
	<section class="section">
		<!-- heading -->
		<header class="heading">
			<h1>' . $title . '</h1>
			' . $more_link . '
		</header>'
		. $output .
	'</section>';
	endif;

	return $output;
}

function iron_widget_action_link ( $post_type = 'post', $page_id = 0, $url = false ) {

	if ( $page_id || $url )
	{
		if ( ! $action_label = get_iron_option( $post_type . 's_widget_action_label' ) ) {
			$post_type_object = get_post_type_object( $post_type );
			$action_label = $post_type_object->labels->all_items;

			if ( 'post' === $post_type && $alternate = get_iron_option('post_type_label') )
				$action_label = str_replace($post_type_object->label, $alternate, $action_label);
		}

		if ( ! $icon = get_iron_option( $post_type . 's_widget_action_icon' ) )
			$icon = 'plus';

		if ( ! $url )
			$url = get_permalink($page_id);

		return '<a class="link" href="' . $url . '"><i class="icon-' . $icon . '"></i> <span class="label">' . $action_label . '</span></a>';
	}

	return '';
}