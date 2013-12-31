<?php
if ( ! isset( $content_width ) )
	$content_width = 640;
	
	// The height and width of your custom header.
	// Add a filter to elemis_header_image_width and elemis_header_image_height to change these values.
	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'elemis_header_image_width', 660 ) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'elemis_header_image_height', 350 ) );

/** Tell WordPress to run elemis_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'elemis_setup' );

if ( ! function_exists( 'elemis_setup' ) ):

/**
 * SETUP
 */
function elemis_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();

/**
 * THUMBNAILS
 */
	add_theme_support( 'post-thumbnails' );
	
	
	if ( function_exists( 'add_image_size' ) ) add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) { 
	add_image_size( 'list_thumb', 67, 67, true );
	add_image_size( 'image_artwork', 125, 125, true );
	add_image_size( 'gallery_thumb', 120, 70, true );
	add_image_size( 'fullscreen_thumb', 100, 70, true );
	add_image_size( 'grid_image', 490, 9999 );
	add_image_size( 'gallery_grid', 490, 300, true );
	add_image_size( 'full_image', 1010, 9999 );
	}

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	// Make theme available for translation
	// Translations can be filed in the /languages/ directory
	load_theme_textdomain( 'elemis', TEMPLATEPATH . '/languages' );

	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'elemis' ),
	) );


}
endif;

// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'link', 'audio', 'video', 'gallery', 'quote', 'image', 'chat' ) );


/**
 * TITLE
 */
function elemis_filter_wp_title( $title, $separator ) {
	// Don't affect wp_title() calls in feeds.
	if ( is_feed() )
		return $title;

	// The $paged global variable contains the page number of a listing of posts.
	// The $page global variable contains the page number of a single post that is paged.
	// We'll display whichever one applies, if we're not looking at the first page.
	global $paged, $page;

	if ( is_search() ) {
		// If we're a search, let's start over:
		$title = sprintf( __( 'Search results for %s', 'elemis' ), '"' . get_search_query() . '"' );
		// Add a page number if we're on page 2 or more:
		if ( $paged >= 2 )
			$title .= " $separator " . sprintf( __( 'Page %s', 'elemis' ), $paged );
		// Add the site name to the end:
		$title .= " $separator " . get_bloginfo( 'name', 'display' );
		// We're done. Let's send the new title back to wp_title():
		return $title;
	}

	// Otherwise, let's start by adding the site name to the end:
	$title .= get_bloginfo( 'name', 'display' );

	// If we have a site description and we're on the home/front page, add the description:
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $separator " . $site_description;

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $separator " . sprintf( __( 'Page %s', 'elemis' ), max( $paged, $page ) );

	// Return the new title to wp_title():
	return $title;
}
add_filter( 'wp_title', 'elemis_filter_wp_title', 10, 2 );

/**
 * MENU
 */
function elemis_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
        wp_nav_menu(  array( 'container_id' => 'menu', 'container_class' => 'menu', 'theme_location' => 'primary', 'items_wrap'  => '<ul id="tiny">%3$s</ul>' ) );
    else
        elemis_nav_fallback();
}
 
function elemis_nav_fallback() {
    wp_page_menu( array( 'show_home' => false, 'menu_class'  => 'menu' ) );
}

/**
 * EXCERPT
 */
function elemis_excerpt_length( $length ) {
	return 40;
}
add_filter( 'excerpt_length', 'elemis_excerpt_length' );


/**
 * COMMENTS
 */

if ( ! function_exists( 'elemis_comment' ) ) :

function elemis_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>" class="com-wrap">
			<div class="comment-author vcard user frame">
				<?php echo get_avatar( $comment, 70 ); ?>
			</div><!-- .comment-author .vcard -->
			<div class="message">
				<span class="reply-link"><?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></span>
				<div class="info">
					<?php printf( __( '%s', 'elemis' ), sprintf( '<h2>%s</h2>', get_comment_author_link() ) ); ?>
					<span class="meta">
						<?php
							/* translators: 1: date, 2: time */
							printf( __( '%1$s at %2$s', 'elemis' ), get_comment_date(),  get_comment_time() ); ?>
					</span><!-- .comment-meta .commentmetadata -->
				</div>
				<div class="comment-body ">
					<?php comment_text(); ?>
				</div>
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="moderation"><?php _e( '(Your comment is awaiting moderation.)', 'elemis' ); ?></em>
				<?php endif; ?>
				<span class="edit-link"><?php edit_comment_link( __( 'Edit', 'elemis' ), ' ' ); ?></span>
			</div>
			<div class="clear"></div>
		</div><!-- #comment-##  -->
		<div class="clear"></div>
	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'elemis' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __('(Edit)', 'elemis'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;


function comment_reform ($arg) {
$arg['title_reply'] = __('Submit a comment', 'elemis');
return $arg;
}
add_filter('comment_form_defaults','comment_reform');

/**
 * SIDEBAR WIDGETS
 */
function elemis_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => __( 'Primary Widget Area', 'elemis' ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', 'elemis' ),
		'before_widget' => '<div id="%1$s" class="sidebox widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area One', 'elemis' ),
		'id' => 'sidebar-1',
		'description' => __( 'An optional widget area for your site footer', 'elemis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Two', 'elemis' ),
		'id' => 'sidebar-2',
		'description' => __( 'An optional widget area for your site footer', 'elemis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Footer Area Three', 'elemis' ),
		'id' => 'sidebar-3',
		'description' => __( 'An optional widget area for your site footer', 'elemis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer Area Four', 'elemis' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'elemis' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
/** Register sidebars by running elemis_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'elemis_widgets_init' );

/**
 * FOOTER SIDEBAR
 */
function elemis_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-1' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;
	
	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'one';
			break;
		case '2':
			$class = 'two';
			break;
		case '3':
			$class = 'three';
			break;
		case '4':
			$class = 'four';
			break;
	}

	if ( $class )
		echo 'class="' . $class . '"';
}

/**
 * RECENT COMMENTS WIDGET
 */
function elemis_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'elemis_remove_recent_comments_style' );

if ( ! function_exists( 'elemis_posted_on' ) ) :

/**
 * META
 */
function elemis_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'elemis' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'elemis' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'elemis_posted_in' ) ) :

function elemis_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = __( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'elemis' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = __( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'elemis' );
	} else {
		$posted_in = __( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'elemis' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;


/**
 * PAGINATION
 */

if ( ! function_exists( 'elemis_content_nav' ) ) :

function elemis_content_nav( $nav_id ) {
	global $wp_query;

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<div id="<?php echo $nav_id; ?>">
			<div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav-prev">&larr;  Older posts</span>', 'elemis' ) ); ?></div>
			<div class="nav-next"><?php previous_posts_link( __( '<span class="meta-nav-next">Newer posts &rarr;</span>', 'elemis' ) ); ?></div>
		</div><!-- #nav-above -->
	<?php endif;
}
endif; 



/**
 * EXCLUDE PAGES FROM SEARCH
 */
 
function mySearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','mySearchFilter');




/**
 * SHORTCODES IN WIDGETS
 */
 
add_filter('widget_text', 'do_shortcode');



/**
 * FULLSCREEN POSTS IN PAGES LIST
 */

add_filter( 'get_pages',  'add_my_cpt' );

function add_my_cpt( $pages )
{
     $my_cpt_pages = new WP_Query( array( 'post_type' => 'fullscreen' ) );
     if ( $my_cpt_pages->post_count > 0 )
     {
         $pages = array_merge( $pages, $my_cpt_pages->posts );
     }
     return $pages;
}
