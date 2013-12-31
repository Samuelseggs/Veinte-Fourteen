<?php

///////////////////////////////////////
// You may add your custom functions here
///////////////////////////////////////

	///////////////////////////////////////
	// WordPress theme options: Custom colors
	///////////////////////////////////////
	add_action( 'customize_register', 'bonfire_customize_register' );
	function bonfire_customize_register($wp_customize)
	{
		$colors = array();
		$colors[] = array( 'slug'=>'bonfire_header_background', 'default' => '', 'label' => __( 'Header background', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_logo_hover_color', 'default' => '', 'label' => __( 'Site name hover color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_logo_color', 'default' => '', 'label' => __( 'Site name color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_title_color', 'default' => '', 'label' => __( 'Title color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_title_hover_color', 'default' => '', 'label' => __( 'Title hover color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_link_color', 'default' => '', 'label' => __( 'Link color (inside post/page content)', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_link_hover_color', 'default' => '', 'label' => __( 'Link hover color (inside post/page content)', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_commentform_background_color', 'default' => '', 'label' => __( 'Comment form background color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_commentform_button_color', 'default' => '', 'label' => __( 'Comment form button color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_readleave_comments', 'default' => '', 'label' => __( 'Read/leave comments button', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_readleave_comments_hover', 'default' => '', 'label' => __( 'Read/leave comments button hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_authordate', 'default' => '', 'label' => __( 'Author/date button', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_authordate_hover', 'default' => '', 'label' => __( 'Author/date button hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_tags', 'default' => '', 'label' => __( 'Tags button', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_tags_hover', 'default' => '', 'label' => __( 'Tags button hover', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_footer_background_color', 'default' => '', 'label' => __( 'Footer background color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_commentarea_background_color', 'default' => '', 'label' => __( 'Comment area background color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_contactform_background_color', 'default' => '', 'label' => __( 'Contact form background color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_contactform_button_color', 'default' => '', 'label' => __( 'Contact form button color', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_menu_button_background_color', 'default' => '', 'label' => __( 'Menu button background', 'bonfire' ) );
		$colors[] = array( 'slug'=>'bonfire_menu_button_background_hover', 'default' => '', 'label' => __( 'Menu button background hover', 'bonfire' ) );
	
	foreach($colors as $color)
	{
	$wp_customize->add_setting( $color['slug'], array( 'default' => $color['default'], 'type' => 'option', 'capability' => 'edit_theme_options' ));
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color['slug'], array( 'label' => $color['label'], 'section' => 'colors', 'settings' => $color['slug'] )));
	}
	}

	///////////////////////////////////////
	// WordPress theme options: Custom logo upload
	///////////////////////////////////////
	function bonfire_theme_customizer( $wp_customize ) {
	
	$wp_customize->add_section( 'bonfire_logo_section' , array(
		'title'       => __( 'Logo', 'bonfire' ),
		'priority'    => 30,
		'description' => 'Upload a logo to replace the default site name and description in the header',
	) );
	
	$wp_customize->add_setting( 'bonfire_logo' );
	
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'bonfire_logo', array(
		'label'    => __( 'Logo', 'bonfire' ),
		'section'  => 'bonfire_logo_section',
		'settings' => 'bonfire_logo',
	) ) );
	
	}
	add_action('customize_register', 'bonfire_theme_customizer');

	///////////////////////////////////////
	// Background color drop-down on 'write post/page' pages
	///////////////////////////////////////
	add_action( 'add_meta_boxes', 'bonfire_custom_class_add' );
	function bonfire_custom_class_add() {
		add_meta_box( 'bonfire-meta-box-id', __( 'Custom Background Color', 'bonfire' ), 'bonfire_custom_class', 'post', 'normal', 'high' );
		add_meta_box( 'bonfire-meta-box-id', __( 'Custom Background Color', 'bonfire' ), 'bonfire_custom_class', 'page', 'normal', 'high' );
	}

	function bonfire_custom_class( $post ) {
		$values = get_post_custom( $post->ID );
		$bonfire_selected_class = isset( $values['bonfire_background_color'] ) ? esc_attr( $values['bonfire_background_color'][0] ) : '';
		wp_nonce_field( 'bonfire_meta_box_nonce', 'meta_box_nonce' );
		?>		
		<p>
			<select name="bonfire_background_color">
				<option value="" <?php selected( $bonfire_selected_class, 'None' ); ?>>Default</option>
				<!-- You can add and remove options starting from here -->				
				<option value="silver" <?php selected( $bonfire_selected_class, 'silver' ); ?>>Silver</option>
				<option value="dark-silver" <?php selected( $bonfire_selected_class, 'dark-silver' ); ?>>Dark Silver</option>
				
				<option value="green" <?php selected( $bonfire_selected_class, 'green' ); ?>>Green</option>
				<option value="dark-green" <?php selected( $bonfire_selected_class, 'dark-green' ); ?>>Dark Green</option>
				
				<option value="blue" <?php selected( $bonfire_selected_class, 'blue' ); ?>>Blue</option>
				<option value="dark-blue" <?php selected( $bonfire_selected_class, 'dark-blue' ); ?>>Dark Blue</option>
				
				<option value="salmon" <?php selected( $bonfire_selected_class, 'salmon' ); ?>>Salmon</option>
				<option value="dark-salmon" <?php selected( $bonfire_selected_class, 'dark-salmon' ); ?>>Dark Salmon</option>
				
				<option value="red" <?php selected( $bonfire_selected_class, 'red' ); ?>>Red</option>
				<option value="dark-red" <?php selected( $bonfire_selected_class, 'dark-red' ); ?>>Dark Red</option>
				
				<option value="orange" <?php selected( $bonfire_selected_class, 'orange' ); ?>>Orange</option>
				<option value="dark-orange" <?php selected( $bonfire_selected_class, 'dark-orange' ); ?>>Dark Orange</option>
				
				<option value="pink" <?php selected( $bonfire_selected_class, 'pink' ); ?>>Pink</option>
				<option value="dark-pink" <?php selected( $bonfire_selected_class, 'dark-pink' ); ?>>Dark Pink</option>
				
				<option value="light" <?php selected( $bonfire_selected_class, 'light' ); ?>>Light</option>
				<option value="lighter" <?php selected( $bonfire_selected_class, 'lighter' ); ?>>Lighter</option>
				
				<!-- Options end here -->	
			</select>		
		</p>
		<?php	
	}

	add_action( 'save_post', 'bonfire_custom_class_save' );
	function bonfire_custom_class_save( $post_id ) {
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}
		if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'bonfire_meta_box_nonce' ) ) {
			return;
		}
		if( !current_user_can( 'edit_post' ) ) {
			return;
		}
			
		if( isset( $_POST['bonfire_background_color'] ) ) {
			update_post_meta( $post_id, 'bonfire_background_color', esc_attr( $_POST['bonfire_background_color'] ) );
		}
	}

	///////////////////////////////////////
	// Enable featured image
	///////////////////////////////////////
	add_theme_support( 'post-thumbnails');

	///////////////////////////////////////
	// Add default posts and comments RSS feed links to head
	///////////////////////////////////////
	add_theme_support( 'automatic-feed-links' );

	///////////////////////////////////////
	// Add support for a variety of post formats
	///////////////////////////////////////
	add_theme_support( 'post-formats', array( 'aside', 'link', 'gallery', 'status', 'quote', 'image', 'video', 'audio', 'chat' ) );
	
	///////////////////////////////////////
	// Styles the visual editor with editor-style.css to match the theme style
	///////////////////////////////////////
	add_editor_style();

	///////////////////////////////////////
	// Load theme languages
	///////////////////////////////////////
	load_theme_textdomain( 'bonfire', get_template_directory().'/languages' );

	///////////////////////////////////////
	// Register Custom Menu Function
	///////////////////////////////////////
	if (function_exists('register_nav_menus')) {
		register_nav_menus( array(
			'bonfire-main-menu' => ( 'Bonfire Main Menu' ),
			'bonfire-icon-menu' => ( 'Bonfire Icon Menu' ),
		) );
	}

	///////////////////////////////////////
	// Default Main Nav Function
	///////////////////////////////////////
	function default_main_nav() {
		echo '<ul id="main-nav" class="main-nav clearfix">';
		wp_list_pages('title_li=');
		echo '</ul>';
	}
	
	///////////////////////////////////////
	// Register Widgets
	///////////////////////////////////////
	if ( function_exists('register_sidebar') ) {
	
		register_sidebar( array(
		'name' => __( 'Footer Widgets (full width)', 'bonfire' ),
		'id' => 'footer-widgets-full',
		'description' => __( 'Drag widgets here', 'bonfire' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));
		
		register_sidebar( array(
		'name' => __( 'Footer Widgets (2 columns)', 'bonfire' ),
		'id' => 'footer-widgets-2-columns',
		'description' => __( 'Drag widgets here', 'bonfire' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));
		
		register_sidebar( array(
		'name' => __( 'Footer Widgets (3 columns)', 'bonfire' ),
		'id' => 'footer-widgets-3-columns',
		'description' => __( 'Drag widgets here', 'bonfire' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
		));

	}

	///////////////////////////////////////
	// Exclude pages from search results
	///////////////////////////////////////	
	function SearchFilter($query) {
	if ($query->is_search) {
	$query->set('post_type', 'post');
	}
	return $query;
	}

	add_filter('pre_get_posts','SearchFilter');

	///////////////////////////////////////
	// Enqueue Google WebFonts
	///////////////////////////////////////
	function bonfire_fonts() {
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'bonfire-fonts', "$protocol://fonts.googleapis.com/css?family=Open+Sans:300,400|Montserrat:400,700|Dosis:300,500,600,700|Noticia+Text:400italic' rel='stylesheet' type='text/css" );}
	add_action( 'wp_enqueue_scripts', 'bonfire_fonts' );

	///////////////////////////////////////
	// Enqueue font-awesome.min.css (icons for menu)
	///////////////////////////////////////
	function bonfire_fontawesome() {  
		wp_register_style( 'fontawesome', get_template_directory_uri() . '/fonts/font-awesome/css/font-awesome.min.css', array(), '1', 'all' );  

		wp_enqueue_style( 'fontawesome' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_fontawesome' );
	
	///////////////////////////////////////
	// Enqueue style.css (default WordPress stylesheet)
	///////////////////////////////////////
	function bonfire_style() {  
		wp_register_style( 'style', get_stylesheet_uri() , array(), '1', 'all' );

		wp_enqueue_style( 'style' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_style' );
	
	
	///////////////////////////////////////
	// Enqueue accordion.js
	///////////////////////////////////////
	function bonfire_accordion() {  
		wp_register_script( 'bonfire-accordion', get_template_directory_uri() . '/js/accordion.js', array( 'jquery' ), '1' );  

		wp_enqueue_script( 'bonfire-accordion' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_accordion' );  

	///////////////////////////////////////
	// Enqueue main-menu.js
	///////////////////////////////////////

	function bonfire_mainmenu() {
	wp_register_script( 'bonfire-main-menu', get_template_directory_uri() . '/js/main-menu.js',  array( 'jquery' ), '1', true );
	
	wp_enqueue_script( 'bonfire-main-menu', true );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_mainmenu' );

	///////////////////////////////////////
	// Enqueue search-toggle.js
	///////////////////////////////////////

	function bonfire_searchtoggle() {
	wp_register_script( 'search-toggle', get_template_directory_uri() . '/js/search-toggle.js',  array( 'jquery' ), '1', true );
	
	wp_enqueue_script( 'search-toggle', true );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_searchtoggle' );
	
	///////////////////////////////////////
	// Enqueue story-hovers.js
	///////////////////////////////////////
    function bonfire_storyhovers() {  
		wp_register_script( 'story-hovers', get_template_directory_uri() . '/js/story-hovers.js',  array( 'jquery' ), '1' );  
      
		wp_enqueue_script( 'story-hovers', true );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_storyhovers' );  
	
	///////////////////////////////////////
	// Enqueue empty-textarea.js
	///////////////////////////////////////
    function bonfire_emptytextarea() {  
		wp_register_script( 'empty-textarea', get_template_directory_uri() . '/js/empty-textarea.js',  array( 'jquery' ), '1' );  

		wp_enqueue_script( 'empty-textarea' );
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_emptytextarea' ); 

	///////////////////////////////////////
	// Enqueue video-container.js
	///////////////////////////////////////
    function bonfire_videocontainer() {  
		wp_register_script( 'video-container', get_template_directory_uri() . '/js/video-container.js',  array( 'jquery' ), '1' );  

		wp_enqueue_script( 'video-container' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_videocontainer' ); 

	///////////////////////////////////////
	// Enqueue autogrow/jquery.autogrow-textarea.js
	///////////////////////////////////////
    function bonfire_autogrow() {
		if ( is_singular() ) {
		wp_register_script( 'autogrow', get_template_directory_uri() . '/js/autogrow/jquery.autogrow-textarea.js',  array( 'jquery' ), '1', true );  

		wp_enqueue_script( 'autogrow' );  
	}
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_autogrow' );

	///////////////////////////////////////
	// Enqueue expand-textarea.js
	///////////////////////////////////////
	function bonfire_expandtextarea() {  
		if ( is_single() ) {
		wp_register_script( 'expand-textarea', get_template_directory_uri() . '/js/expand-textarea.js',  array( 'jquery' ), '1' );  

		wp_enqueue_script( 'expand-textarea' );  
	}
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_expandtextarea' ); 

	///////////////////////////////////////
	// Enqueue comment-form.js
	///////////////////////////////////////
	function bonfire_commentform() {  
		if ( is_single() ) {
		wp_register_script( 'comment-form', get_template_directory_uri() . '/js/comment-form.js',  array( 'jquery' ), '1', true );  

		wp_enqueue_script( 'comment-form' );  
	}
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_commentform' );

	///////////////////////////////////////
	// Enqueue placeholder-fix.js (IE textarea/field placeholder fix)
	///////////////////////////////////////
    function bonfire_placeholderfix() {  
		wp_register_script( 'placeholder-fix', get_template_directory_uri() . '/js/placeholder-fix.js',  array( 'jquery' ), '1', true );  

		wp_enqueue_script( 'placeholder-fix' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_placeholderfix' ); 

	///////////////////////////////////////
	// Enqueue media-queries.css
	///////////////////////////////////////
	function bonfire_mediaqueries() {  
		wp_register_style( 'media-queries', get_template_directory_uri() . '/media-queries.css', array(), '1', 'all' );  

		wp_enqueue_style( 'media-queries' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_mediaqueries' );

	///////////////////////////////////////
	// Enqueue jquery.scrollTo-min.js (smooth scrolling to anchors)
	///////////////////////////////////////
    function bonfire_scrollto() {  
		wp_register_script( 'scroll-to', get_template_directory_uri() . '/js/jquery.scrollTo-min.js',  array( 'jquery' ), '1', true );  

		wp_enqueue_script( 'scroll-to' );  
	}
	add_action( 'wp_enqueue_scripts', 'bonfire_scrollto' ); 


	///////////////////////////////////////
	// Enqueue comment-reply.js (threaded comments)
	///////////////////////////////////////
	function bonfire_comment_reply(){
		if ( is_singular() && get_option( 'thread_comments' ) )	wp_enqueue_script( 'comment-reply' );
	}
	add_action('wp_print_scripts', 'bonfire_comment_reply');


	///////////////////////////////////////
	// Add wmode transparent and post-video container for responsive purpose
	///////////////////////////////////////	
	function add_video_wmode_transparent($html, $url, $attr) {
		
		$html = '<div class="post-video">' . $html . '</div>';
		if (strpos($html, "<embed src=" ) !== false) {
			$html = str_replace('</param><embed', '</param><param name="wmode" value="transparent"></param><embed wmode="transparent" ', $html);
			return $html;
		}
		else {
			if(strpos($html, "wmode=transparent") == false){
				if(strpos($html, "?fs=" ) !== false){
					$search = array('?fs=1', '?fs=0');
					$replace = array('?fs=1&wmode=transparent', '?fs=0&wmode=transparent');
					$html = str_replace($search, $replace, $html);
					return $html;
				}
				else{
					$youtube_embed_code = $html;
					$patterns[] = '/youtube.com\/embed\/([a-zA-Z0-9._-]+)/';
					$replacements[] = 'youtube.com/embed/$1?wmode=transparent';
					return preg_replace($patterns, $replacements, $html);
				}
			}
			else{
				return $html;
			}
		}
	}
	add_filter('embed_oembed_html', 'add_video_wmode_transparent');
	
	///////////////////////////////////////
	// Define content width
	///////////////////////////////////////
	if ( ! isset( $content_width ) ) $content_width = 1000;

	///////////////////////////////////////
	// Custom Comment Output
	///////////////////////////////////////
	function custom_theme_comment($comment, $args, $depth) {
	   $GLOBALS['comment'] = $comment; 
	   ?>

		<li id="comment-<?php comment_ID() ?>" <?php comment_class(); ?>>
		
			<div class="comment-avatar"><?php echo get_avatar($comment,$size='60'); ?></div>
			<div class="comment-author"><?php comment_author(); ?></div>
			<div class="comment-time"><?php comment_date('M d, Y'); ?></div>
			<div class="clear"></div>
		
			<div class="comment-container">
			<div class="comment-entry">
			
			<?php if ($comment->comment_approved == '0') : ?>
			<strong><?php _e('(Your comment is awaiting moderation.)', 'bonfire') ?></strong>
			<?php endif; ?>
			<?php echo get_comment_text(); ?>
			<?php edit_comment_link( __('Edit', 'bonfire'),' [',']') ?>
			
			</div>
			<div class="clear"></div>
			<?php comment_reply_link(array_merge( $args, array('add_below' => 'comment', 'depth' => $depth, 'reply_text' => __( 'Reply', 'bonfire' ), 'max_depth' => $args['max_depth']))) ?>
			</div>
		
	<?php
	}

?>