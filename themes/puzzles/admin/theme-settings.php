<?php
global $THEMEREX_shortname;
$THEMEREX_shortname = 'wps';

// Prepare arrays 
$fonts = getThemeFontsList(false);
$themes = getThemesList(false);
$socials = getSocialsList(false);
$puzzles = getPuzzlesList(false);
$categories = getCategoriesList(false);
$sidebars = getSidebarsList(false);
$positions = getSidebarsPositions(false);
$blog_styles = getBlogStylesList(false);
$sliders = getSlidersList(false);
$yes_no = getYesNoList(false);
$show_hide = getShowHideList(false);

// Theme options arrays
$THEMEREX_theme_options = array();

/*
###############################
#### General               #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('General', 'themerex'),
			"override" => "category,post,page",
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('Favicon', 'themerex'),
			"desc" => __('Upload a 16px x 16px image that will represent your website\'s favicon.<br /><br /><em>To ensure cross-browser compatibility, we recommend converting the favicon into .ico format before uploading. (<a href="http://www.favicon.cc/">www.favicon.cc</a>)</em>', 'themerex'),
			"id" => $THEMEREX_shortname."_"."favicon",
			"std" => "",
			"type" => "upload");

$THEMEREX_theme_options[] = array( "name" => __('Logo image', 'themerex'),
			"desc" => __('Upload logo image', 'themerex'),
			"id" => $THEMEREX_shortname."_"."logo_image",
			"std" => "",
			"type" => "mediamanager");

$THEMEREX_theme_options[] = array( "name" => __('Logo text', 'themerex'),
			"desc" => __('Write logo text (if empty the logo image). Use characters [ and ] to select accented part.', 'themerex'),
			"id" => $THEMEREX_shortname."_"."logo_text",
			"std" => "puz[z]les",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Slogan text', 'themerex'),
			"desc" => __('Write slogan (under logo)', 'themerex'),
			"id" => $THEMEREX_shortname."_"."logo_slogan",
			"std" => "Bold'n'modern multipurpose wp theme",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Show Advertisement block in page header',  'themerex'),
			"desc" => __('Do you want to show the advertisement block in the page header area?',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "show_ads_block",
			"override" => "category,post,page",
			"std" => "no",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Advertisement block: banner image',  'themerex'),
			"desc" => __('Upload the banner image',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "ads_block_image",
			"override" => "category,post,page",
			"std" => "",
			"type" => "mediamanager");

$THEMEREX_theme_options[] = array( "name" => __('Advertisement block: banner image link',  'themerex'),
			"desc" => __('Link URL for the banner image',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "ads_block_link",
			"override" => "category,post,page",
			"std" => "",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Advertisement block: html-content',  'themerex'),
			"desc" => __('Put here an advertisement block html-content (will be display instead the image above)',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "ads_block_content",
			"override" => "category,post,page",
			"std" => "",
			"type" => "textarea");

$THEMEREX_theme_options[] = array( "name" => __('Footer copyright',  'themerex'),
			"desc" => __("Copyright text to show in footer area (bottom of site)", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "footer_copyright",
			"std" => "ThemeREX &copy; 2013 All Rights Reserved ",
			"type" => "text");
			
$THEMEREX_theme_options[] = array( "name" => __('Image dimensions', 'themerex'),
			"desc" => __('What dimensions use for uploaded image: Original or "Retina ready" (twice enlarged)', 'themerex'),
			"id" => $THEMEREX_shortname."_"."retina_ready",
			"std" => "1",
			"type" => "select",
			"options" => array("1"=>__("Original", 'themerex'), "2"=>__("Retina", 'themerex')));
			
$THEMEREX_theme_options[] = array( "name" => __('Responsive Layouts', 'themerex'),
			"desc" => __('Do you want use responsive layouts on small screen or still use main layout?', 'themerex'),
			"id" => $THEMEREX_shortname."_"."responsive_layouts",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __('Additional filters in admin panel', 'themerex'),
			"desc" => __('Show additional filters (on post format and tags) in admin panel page "Posts"', 'themerex'),
			"id" => $THEMEREX_shortname."_"."admin_add_filters",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);



/*
###############################
#### Customization         #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('Customization', 'wpspace'),
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('Show Theme customizer', 'themerex'),
			"desc" => __('Show theme customizer', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_theme_customizer",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Theme font', 'themerex'),
			"desc" => __('Select theme main font', 'themerex'),
			"id" => $THEMEREX_shortname."_"."theme_font",
			"std" => "Oxygen",
			"type" => "select",
			"options" => $fonts);

$THEMEREX_theme_options[] = array( "name" => __('Show Login/Logout buttons', 'themerex'),
			"desc" => __('Show Login and Logout buttons', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_login",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Puzzles-style elements: enable animations', 'themerex'),
			"desc" => __('Enable animations on puzzles-style page element', 'themerex'),
			"id" => $THEMEREX_shortname."_"."puzzles_animations",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Main menu parameters', 'wpspace'),
			"std" => __('Main menu display parameters', 'wpspace'),
			"type" => "info");

$THEMEREX_theme_options[] = array( "name" => __('Main menu position', 'themerex'),
			"desc" => __('Attach main menu to top of window then page scroll down', 'themerex'),
			"id" => $THEMEREX_shortname."_"."menu_position",
			"std" => "fixed",
			"type" => "select",
			"options" => array("fixed"=>__("Fix menu position", 'themerex'), "none"=>__("Don't fix menu position", 'themerex')));

$THEMEREX_theme_options[] = array( "name" => __('Main menu colored', 'themerex'),
			"desc" => __('Use for main menu item theme and accent colors from categories (if categories used as menu items)', 'themerex'),
			"id" => $THEMEREX_shortname."_"."menu_colored",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Main menu slider', 'themerex'),
			"desc" => __('Use slider background for main menu items', 'themerex'),
			"id" => $THEMEREX_shortname."_"."menu_slider",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Main menu height', 'themerex'),
			"desc" => __('Height of main menu items', 'themerex'),
			"id" => $THEMEREX_shortname."_"."menu_height",
			"std" => "",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Submenu width', 'themerex'),
			"desc" => __('Width for dropdown menus in main menu', 'themerex'),
			"id" => $THEMEREX_shortname."_"."menu_width",
			"std" => "",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Max width for responsive menu', 'themerex'),
			"desc" => __('Use responsive menu, if window width less then value in this field', 'themerex'),
			"id" => $THEMEREX_shortname."_"."responsive_menu_width",
			"std" => "800",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Body parameters', 'wpspace'),
			"std" => __('This parameters only for fixed body style. Use only background image (if selected), else use background pattern', 'wpspace'),
			"type" => "info");
			
$THEMEREX_theme_options[] = array( "name" => __('Body style', 'themerex'),
			"desc" => __('Use boxed or wide body style', 'themerex'),
			"id" => $THEMEREX_shortname."_"."body_style",
			"std" => "wide",
			"type" => "select",
			"options" => array("boxed"=>__("Boxed", 'themerex'), "wide"=>__("Wide", 'themerex')));

$THEMEREX_theme_options[] = array( "name" => __('Background color',  'wpspace'),
			"desc" => __('Body background color',  'wpspace'),
			"id" => $THEMEREX_shortname . "_" . "bg_color",
			"std" => "#bfbfbf",
			"type" => "color");

$THEMEREX_theme_options[] = array( "name" => __('Background predefined pattern',  'wpspace'),
			"desc" => __('Select theme background pattern (first case - without pattern)',  'wpspace'),
			"id" => $THEMEREX_shortname . "_" . "bg_pattern",
			"std" => "",
			"type" => "images",
			"options" => array(
				0 => get_template_directory_uri().'/images/spacer.png',
				1 => get_template_directory_uri().'/images/bg/pattern_1.png',
				2 => get_template_directory_uri().'/images/bg/pattern_2.png',
				3 => get_template_directory_uri().'/images/bg/pattern_3.png',
				4 => get_template_directory_uri().'/images/bg/pattern_4.png',
				5 => get_template_directory_uri().'/images/bg/pattern_5.png',
			));

$THEMEREX_theme_options[] = array( "name" => __('Background custom pattern',  'wpspace'),
			"desc" => __('Select or upload background custom pattern',  'wpspace'),
			"id" => $THEMEREX_shortname . "_" . "bg_custom_pattern",
			"std" => "",
			"type" => "mediamanager");

$THEMEREX_theme_options[] = array( "name" => __('Background predefined image',  'wpspace'),
			"desc" => __('Select theme background image (first case - without image)',  'wpspace'),
			"id" => $THEMEREX_shortname . "_" . "bg_image",
			"std" => "",
			"type" => "images",
			"options" => array(
				0 => get_template_directory_uri().'/images/spacer.png',
				1 => get_template_directory_uri().'/images/bg/image_1.jpg',
				2 => get_template_directory_uri().'/images/bg/image_2.jpg',
				3 => get_template_directory_uri().'/images/bg/image_3.jpg',
			));

$THEMEREX_theme_options[] = array( "name" => __('Background custom image',  'wpspace'),
			"desc" => __('Select or upload background custom image',  'wpspace'),
			"id" => $THEMEREX_shortname . "_" . "bg_custom_image",
			"std" => "",
			"type" => "mediamanager");

$THEMEREX_theme_options[] = array( "name" => __('Background custom image position',  'wpspace'),
			"desc" => __('Select custom image position',  'wpspace'),
			"id" => $THEMEREX_shortname . "_" . "bg_custom_image_position",
			"std" => "left_top",
			"type" => "select",
			"options" => array(
				'left_top' => "Left Top",
				'center_top' => "Center Top",
				'right_top' => "Right Top",
				'left_center' => "Left Center",
				'center_center' => "Center Center",
				'right_center' => "Right Center",
				'left_bottom' => "Left Bottom",
				'center_bottom' => "Center Bottom",
				'right_bottom' => "Right Bottom",
			));


/*
###############################
####Sidebars               #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('Sidebars', 'themerex'),
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('Custom sidebars',  'themerex'),
			"desc" => __('Manage custom sidebars. You can use it with each category (page, post) independently',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "custom_sidebars",
			"std" => "",
			"increment" => true,
			"type" => "text");



/*
###############################
#### Blog                  #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('Blog', 'themerex'),
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('General Blog parameters', 'themerex'),
			"type" => "group",
			"override" => "category,post,page",
			"tab" => 'blog_general',
			"tabs" => array(
				'blog_general'=>__('General', 'themerex'),
				'blog_stream'=>__('Blog Stream page', 'themerex'),
				'blog_single'=>__('Blog Single page', 'themerex')));

$THEMEREX_theme_options[] = array( "name" => __('General Blog parameters', 'themerex'),
			"std" => __('Select excluded categories, substitute parameters, etc.', 'themerex'),
			"type" => "info");

$THEMEREX_theme_options[] = array( "name" => __('Exclude categories', 'themerex'),
			"desc" => __('Select categories, which posts are exclude from blog page', 'themerex'),
			"id" => $THEMEREX_shortname."_"."exclude_cats",
			"std" => "",
			"type" => "checklist",
			"multiple" => true,
			"options" => $categories);

$THEMEREX_theme_options[] = array( "name" => __('Show Breadcrumbs', 'themerex'),
			"desc" => __('Show path to current category (post, page)', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_breadcrumbs",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Blog pagination style', 'themerex'),
			"desc" => __('Select pagination style on blog streampages', 'themerex'),
			"id" => $THEMEREX_shortname."_"."blog_pagination",
			"std" => "pages",
			"type" => "select",
			"options" => array(
				'pages'    => __('Standard page numbers', 'themerex'),
				'viewmore' => __('"View more" button', 'themerex'),
				'infinite' => __('Infinite scroll', 'themerex')
				));

$THEMEREX_theme_options[] = array( "name" => __('Blog counters', 'themerex'),
			"desc" => __('Select counters, displayed near the post title', 'themerex'),
			"id" => $THEMEREX_shortname."_"."blog_counters",
			"std" => "views",
			"type" => "select",
			"options" => array('none'=>__("Don't show any counters", 'themerex'), 'views' => __('Show views number', 'themerex'), 'comments' => __('Show comments number', 'themerex')));

$THEMEREX_theme_options[] = array( "name" => __("Post's category announce", 'themerex'),
			"desc" => __('What category display in announce block (over posts thumb) - original or nearest parental', 'themerex'),
			"id" => $THEMEREX_shortname."_"."close_category",
			"std" => "parental",
			"type" => "select",
			"options" => array('parental'=>__('Nearest parental category', 'themerex'), 'original' => __("Original post's category", 'themerex')));

$THEMEREX_theme_options[] = array( "name" => __('Show post date after', 'themerex'),
			"desc" => __('Show post date after N days (before - show post age)', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_date_after",
			"std" => "30",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Substitute standard Wordpress gallery', 'themerex'),
			"desc" => __('Substitute standard Wordpress gallery with our theme-styled gallery', 'themerex'),
			"id" => $THEMEREX_shortname."_"."substitute_gallery",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Substitute audio tags', 'themerex'),
			"desc" => __('Substitute audio tag with source from soundclound to embed player', 'themerex'),
			"id" => $THEMEREX_shortname."_"."substitute_audio",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Substitute video tags', 'themerex'),
			"desc" => __('Substitute video tags to embed players', 'themerex'),
			"id" => $THEMEREX_shortname."_"."substitute_video",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Use Media Element script for audio and video tags', 'themerex'),
			"desc" => __('Do you want use the Media Element script for all audio and video tags on your site?', 'themerex'),
			"id" => $THEMEREX_shortname."_"."use_mediaelement",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);



$THEMEREX_theme_options[] = array( "name" => __('Blog streampage parameters', 'themerex'),
			"override" => "category,post,page",
			"closed" => true,
			"tab" => 'blog_stream',
			"type" => "group");

$THEMEREX_theme_options[] = array( "name" => __('Blog streampage parameters', 'themerex'),
			"std" => __('Select desired blog streampage parameters (you can override it in each category)', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_theme_options[] = array( "name" => __('Blog style', 'themerex'),
			"desc" => __('Select desired blog style', 'themerex'),
			"id" => $THEMEREX_shortname."_"."blog_style",
			"override" => "category,page",
			"std" => "puzzles",
			"type" => "select",
			"options" => $blog_styles);

$THEMEREX_theme_options[] = array( "name" => __('Blog posts per page',  'themerex'),
			"desc" => __('How many posts display on blog pages for selected style. If empty or 0 - inherit system wordpress settings',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "posts_per_page",
			"override" => "category,page",
			"std" => "",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Blog theme',  'themerex'),
			"desc" => __('Blog theme - colors set for display each page element',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "blog_theme",
			"override" => "category,post,page",
			"std" => "regular",
			"type" => "select",
			"options" => $themes);

$THEMEREX_theme_options[] = array( "name" => __('Theme accent color',  'themerex'),
			"desc" => __('Used as background for category name on puzzles-styled pages and for accent some page elements',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "theme_accent_color",
			"override" => "category",
			"std" => "#0080af",
			"type" => "color");
			
$THEMEREX_theme_options[] = array( "name" => __('Show main sidebar',  'themerex'),
			"desc" => __('Select main sidebar position on blog page',  'themerex'),
			"id" => $THEMEREX_shortname . '_' . 'show_sidebar_main',
			"override" => "category,post,page",
			"std" => "right",
			"type" => "radio",
			"options" => $positions);

$THEMEREX_theme_options[] = array( "name" => __('Select main sidebar',  'themerex'),
			"desc" => __('Select main sidebar for blog page',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "sidebar_main",
			"override" => "category,post,page",
			"std" => "sidebar-main",
			"type" => "select",
			"options" => $sidebars);

$THEMEREX_theme_options[] = array( "name" => __('Main Sidebar theme',  'themerex'),
			"desc" => __('Main sidebar color theme',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "sidebar_main_theme",
			"override" => "category,post,page",
			"std" => "sidebar",
			"type" => "select",
			"options" => $themes);

$THEMEREX_theme_options[] = array( "name" => __('Show advertisement sidebar', 'themerex'),
			"desc" => __('Show advertisement sidebar before footer', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_sidebar_advert",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Select advertisement sidebar',  'themerex'),
			"desc" => __('Select advertisement sidebar for blog page',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "sidebar_advert",
			"override" => "category,post,page",
			"std" => "sidebar-advert",
			"type" => "select",
			"options" => $sidebars);

$THEMEREX_theme_options[] = array( "name" => __('Advertisement Sidebar theme',  'themerex'),
			"desc" => __('Advertisement sidebar color theme',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "sidebar_advert_theme",
			"override" => "category,post,page",
			"std" => "advertisement",
			"type" => "select",
			"options" => $themes);

$THEMEREX_theme_options[] = array( "name" => __('Show footer sidebar', 'themerex'),
			"desc" => __('Show footer sidebar', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_sidebar_footer",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Select footer sidebar',  'themerex'),
			"desc" => __('Select footer sidebar for blog page',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "sidebar_footer",
			"override" => "category,post,page",
			"std" => "sidebar-footer",
			"type" => "select",
			"options" => $sidebars);

$THEMEREX_theme_options[] = array( "name" => __('Footer Sidebar theme',  'themerex'),
			"desc" => __('Footer sidebar color theme',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "sidebar_footer_theme",
			"override" => "category,post,page",
			"std" => "footer",
			"type" => "select",
			"options" => $themes);



$THEMEREX_theme_options[] = array( "name" => __('Single page parameters', 'themerex'),
			"closed" => true,
			"override" => "category,post,page",
			"tab" => 'blog_single',
			"type" => "group");


$THEMEREX_theme_options[] = array( "name" => __('Single (detail) pages parameters', 'themerex'),
			"std" => __('Select desired parameters for single (detail) pages (you can override it in each category and single post (page))', 'themerex'),
			"override" => "category,post,page",
			"type" => "info");

$THEMEREX_theme_options[] = array( "name" => __('Use fullwidth content (without paddings)',  'themerex'),
			"desc" => __("Disable paddings for page content on single pages", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "without_paddings",
			"override" => "page",
			"std" => "no",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Show featured image before post',  'themerex'),
			"desc" => __("Show featured image (if selected) before post content on single pages", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_featured_image",
			"override" => "category,post,page",
			"std" => "no",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Show post title', 'themerex'),
			"desc" => __('Show area with post title on single pages', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_post_title",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Show post info', 'themerex'),
			"desc" => __('Show area with post info on single pages', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_post_info",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Show text before "Read more" tag', 'themerex'),
			"desc" => __('Show text before "Read more" tag on single pages', 'themerex'),
			"id" => $THEMEREX_shortname."_"."show_text_before_readmore",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __('Show post author details',  'themerex'),
			"desc" => __("Show post author information block on single post page", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_post_author",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $yes_no);
/*
$THEMEREX_theme_options[] = array( "name" => __('Show post social share',  'themerex'),
			"desc" => __("Show social share block on single post page", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_post_share",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $yes_no);
*/
$THEMEREX_theme_options[] = array( "name" => __('Show post tags',  'themerex'),
			"desc" => __("Show tags block on single post page", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_post_tags",
			"override" => "category,post",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Show related posts',  'themerex'),
			"desc" => __("Show related posts block on single post page", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_post_related",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Related posts number',  'themerex'),
			"desc" => __("How many related posts showed on single post page", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "post_related_count",
			"override" => "category,post,page",
			"std" => "3",
			"type" => "list",
			"options" => array(3,6,9));

$THEMEREX_theme_options[] = array( "name" => __('Show comments',  'themerex'),
			"desc" => __("Show comments block on single post page", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_post_comments",
			"override" => "category,post,page",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Puzzles-style: Post excerpt background',  'themerex'),
			"desc" => __('Use this color as background for post excerpt on puzzles-styled pages',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "puzzles_post_bg",
			"override" => "category,post,page",
			"std" => "#0080af",
			"type" => "color");

$THEMEREX_theme_options[] = array( "name" => __('Puzzles-style: Post excerpt position',  'themerex'),
			"desc" => __('Post excerpt position on puzzles-styled pages',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "puzzles_post_position",
			"override" => "category,post,page",
			"std" => "down-1",
			"type" => "images",
			"options" => $puzzles);




/*
###############################
#### Reviews               #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('Reviews', 'themerex'),
			"override" => "category,post",
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('Reviews criterias', 'themerex'),
			"std" => __('Set up list of reviews criterias. You can override it in any category.', 'themerex'),
			"override" => "category",
			"type" => "info");

$THEMEREX_theme_options[] = array( "name" => __('Show reviews block',  'themerex'),
			"desc" => __("Show reviews block on single post page and average reviews rating after post's title in stream pages", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "show_reviews",
			"override" => "category",
			"std" => "yes",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $yes_no);

$THEMEREX_theme_options[] = array( "name" => __('Show first reviews',  'themerex'),
			"desc" => __("What reviews will be displayed first: by author or by readers. Also this type of reviews will display under post's title.", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "reviews_first",
			"std" => "author",
			"type" => "radio",
			"style" => "horizontal",
			"options" => array('author' => __('By Author', 'themerex'), 'users' => __('By Users (Readers)', 'themerex') ));

$THEMEREX_theme_options[] = array( "name" => __('Hide second reviews',  'themerex'),
			"desc" => __("Do you want hide second reviews tab in widgets and single posts?", 'themerex'),
			"id" => $THEMEREX_shortname . '_' . "reviews_second",
			"std" => "show",
			"type" => "radio",
			"style" => "horizontal",
			"options" => $show_hide);

$THEMEREX_theme_options[] = array( "name" => __('Reviews Criterias Levels', 'themerex'),
			"desc" => __('Comma separated words to mark criterials levels (5 levels)', 'themerex'),
			"id" => $THEMEREX_shortname. "_" . "reviews_criterias_levels",
			"std" => __("bad,poor,normal,good,great", 'themerex'),
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Reviews criterias',  'themerex'),
			"desc" => __('Add default reviews criterias.',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "reviews_criterias",
			"override" => "category",
			"std" => "",
			"increment" => true,
			"type" => "text");






/*
###############################
#### Main slider           #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('Slider', 'wpspace'),
			"override" => "category,page",
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('Main slider parameters', 'wpspace'),
			"std" => __('Select parameters for main slider (you can override it in each category and page)', 'wpspace'),
			"override" => "category,page",
			"type" => "info");
			
$THEMEREX_theme_options[] = array( "name" => __('Show Slider', 'wpspace'),
			"desc" => __('Do you want to show slider on each page (post)', 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_show",
			"override" => "category,page",
			"std" => "no",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __('Slider display', 'wpspace'),
			"desc" => __('How display slider: fixed width or fullscreen width', 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_display",
			"override" => "category,page",
			"std" => "none",
			"type" => "select",
			"options" => array("fixed"=>__("Fixed width", 'wpspace'), "fullscreen"=>__("Fullscreen", 'wpspace')));
			
$THEMEREX_theme_options[] = array( "name" => __('Slider engine', 'wpspace'),
			"desc" => __('What engine use to show slider: Revolution slider (need to install additional plugin from theme package), Flex Slider or None (don\'t show slider)', 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_engine",
			"override" => "category,page",
			"std" => "flex",
			"type" => "select",
			"options" => $sliders);

$THEMEREX_theme_options[] = array( "name" => __('Revolution Slider alias',  'wpspace'),
			"desc" => __("Slider alias (see in Revolution plugin settings)", 'wpspace'),
			"id" => $THEMEREX_shortname . '_' . "slider_alias",
			"override" => "category,page",
			"std" => "",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __('Flexslider: Category to show', 'wpspace'),
			"desc" => __('Select category to show in Flexslider (ignored for Revolution slider)', 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_category",
			"override" => "category,page",
			"std" => "",
			"type" => "select",
			"options" => my_array_merge(array(0 => __('- Any category -', 'themerex')), $categories));

$THEMEREX_theme_options[] = array( "name" => __('Flexslider: Number posts or comma separated posts list',  'wpspace'),
			"desc" => __("How many recent posts display in slider or comma separated list of posts ID (in this case selected category ignored)", 'wpspace'),
			"override" => "category,page",
			"id" => $THEMEREX_shortname . '_' . "slider_posts",
			"std" => "5",
			"type" => "text");

$THEMEREX_theme_options[] = array( "name" => __("Flexslider: Post's order by",  'wpspace'),
			"desc" => __("Posts in slider ordered by date (default), comments, views, author rating, users rating or random", 'wpspace'),
			"override" => "category,page",
			"id" => $THEMEREX_shortname . '_' . "slider_orderby",
			"std" => "date",
			"type" => "select",
			"options" => array('date' => __('Date (descending)', 'themerex'), 'comments' => __('Comments number', 'themerex'), 'views' => __('Views number', 'themerex'), 'author_rating' => __('Author rating', 'themerex'), 'users_rating' => __('Users rating', 'themerex'), 'random' => __('Random order', 'themerex')));
			
$THEMEREX_theme_options[] = array( "name" => __("Flexslider: Show post's infobox", 'wpspace'),
			"desc" => __("Do you want to show post's title, reviews rating and description on slides in flex-slider", 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_info_box",
			"override" => "category,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __("Flexslider: Infobox fixed", 'wpspace'),
			"desc" => __("Do you want to fix infobox on slides in flex-slider or hide it in hover", 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_info_fixed",
			"override" => "category,page",
			"std" => "no",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __("Flexslider: Show post's category", 'wpspace'),
			"desc" => __("Do you want to show post's category on slides in flex-slider", 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_info_category",
			"override" => "category,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __("Flexslider: Show post's reviews rating", 'wpspace'),
			"desc" => __("Do you want to show post's reviews rating on slides in flex-slider", 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_reviews",
			"override" => "category,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);
			
$THEMEREX_theme_options[] = array( "name" => __("Flexslider: Show post's descriptions", 'wpspace'),
			"desc" => __("Do you want to show post's description on slides in flex-slider", 'wpspace'),
			"id" => $THEMEREX_shortname."_"."slider_descriptions",
			"override" => "category,page",
			"std" => "yes",
			"type" => "radio",
			"options" => $yes_no);




/*
###############################
#### Social                #### 
###############################
*/
$THEMEREX_theme_options[] = array( "name" => __('Social', 'themerex'),
			"type" => "heading");

$THEMEREX_theme_options[] = array( "name" => __('Social networks',  'themerex'),
			"desc" => __('Select icon and write URL to your profile in desired social networks.',  'themerex'),
			"id" => $THEMEREX_shortname . "_" . "social_icons",
			"std" => "",
			"type" => "socials",
			"options" => $socials);



// Load current values for all theme options
load_all_theme_options();



/*-----------------------------------------------------------------------------------*/
/* Get all options array
/*-----------------------------------------------------------------------------------*/
function load_all_theme_options() {
	global $THEMEREX_theme_options;
	foreach ($THEMEREX_theme_options as $k => $item) {
		if (isset($item['id'])) {
			if (($val = get_option($item['id'], false)) !== false)
				$THEMEREX_theme_options[$k]['val'] = $val;
			else
				$THEMEREX_theme_options[$k]['val'] = $THEMEREX_theme_options[$k]['std'] . (isset($THEMEREX_theme_options[$k]['enable']) ? '|'.($THEMEREX_theme_options[$k]['enable'] ? 1 : 0 ) : '');
		}
	}
}


/* ==========================================================================================
   ==  Get theme option. If not exists - try get site option. If not exist - return default
   ========================================================================================== */
function get_theme_option($option_name, $default = false) {
	global $THEMEREX_shortname, $THEMEREX_theme_options;
	$fullname = my_substr($option_name, 0, my_strlen($THEMEREX_shortname.'_')) == $THEMEREX_shortname.'_' ? $option_name : $THEMEREX_shortname.'_'.$option_name;
	$val = false;
	if (isset($THEMEREX_theme_options)) {
		foreach($THEMEREX_theme_options as $option) {
			if (isset($option['id']) && $option['id'] == $fullname) {
				$val = $option['val'];
				break;
			}
		}
	}
	if ($val === false) {
		if (($val = get_option($fullname, false)) !== false) {
			return $val;
		} else if (($val = get_option($option_name, false)) !== false) {
			return $val;
		} else {
			return $default;
		}
	} else {
		return $val;
	}
}


/* ==========================================================================================
   ==  Update theme option
   ========================================================================================== */
function update_theme_option($option_name, $value) {
	global $THEMEREX_shortname, $THEMEREX_theme_options;
	$fullname = my_substr($option_name, 0, my_strlen($THEMEREX_shortname.'_')) == $THEMEREX_shortname.'_' ? $option_name : $THEMEREX_shortname.'_'.$option_name;
	foreach($THEMEREX_theme_options as $k=>$option) {
		if (isset($option['id']) && $option['id'] == $fullname) {
			$THEMEREX_theme_options[$k]['val'] = $value;
			update_option($fullname, $value);
			break;
		}
	}
}

function get_option_name($fullname) {
	global $THEMEREX_shortname;
	return my_substr($fullname, 0, my_strlen($THEMEREX_shortname)+1)==$THEMEREX_shortname.'_' ? my_substr($fullname, my_strlen($THEMEREX_shortname)+1) : $fullname;
}
?>