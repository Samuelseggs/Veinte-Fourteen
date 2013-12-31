<?php

add_action('init','of_options');

if (!function_exists('of_options'))
{
	function of_options()
	{
		//Access the WordPress Categories via an Array
		$of_categories 		= array();  
		$of_categories_obj 	= get_categories('hide_empty=0');
		foreach ($of_categories_obj as $of_cat) {
		    $of_categories[$of_cat->cat_ID] = $of_cat->cat_name;}
		$categories_tmp 	= array_unshift($of_categories, "Select a category:");    
	       
		//Access the WordPress Pages via an Array
		$of_pages 			= array();
		$of_pages_obj 		= get_pages('sort_column=post_parent,menu_order');    
		foreach ($of_pages_obj as $of_page) {
		    $of_pages[$of_page->ID] = $of_page->post_name; }
		$of_pages_tmp 		= array_unshift($of_pages, "Select a page:");       
	
		//Testing 
		$of_options_select 	= array("one","two","three","four","five"); 
		$of_options_radio 	= array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
		
		//Sample Homepage blocks for the layout manager (sorter)
		$of_options_homepage_blocks = array
		( 
			"disabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_one"		=> "Block One",
				"block_two"		=> "Block Two",
				"block_three"	=> "Block Three",
			), 
			"enabled" => array (
				"placebo" 		=> "placebo", //REQUIRED!
				"block_four"	=> "Block Four",
			),
		);


		//Stylesheets Reader
		$alt_stylesheet_path = LAYOUT_PATH;
		$alt_stylesheets = array();
		
		if ( is_dir($alt_stylesheet_path) ) 
		{
		    if ($alt_stylesheet_dir = opendir($alt_stylesheet_path) ) 
		    { 
		        while ( ($alt_stylesheet_file = readdir($alt_stylesheet_dir)) !== false ) 
		        {
		            if(stristr($alt_stylesheet_file, ".css") !== false)
		            {
		                $alt_stylesheets[] = $alt_stylesheet_file;
		            }
		        }    
		    }
		}


		//Background Images Reader
		$bg_images_path = get_stylesheet_directory(). '/images/bg/'; // change this to where you store your bg images
		$bg_images_url = get_template_directory_uri().'/images/bg/'; // change this to where you store your bg images
		$bg_images = array();
		
		if ( is_dir($bg_images_path) ) {
		    if ($bg_images_dir = opendir($bg_images_path) ) { 
		        while ( ($bg_images_file = readdir($bg_images_dir)) !== false ) {
		            if(stristr($bg_images_file, ".png") !== false || stristr($bg_images_file, ".jpg") !== false) {
		            	natsort($bg_images); //Sorts the array into a natural order
		                $bg_images[] = $bg_images_url . $bg_images_file;
		            }
		        }    
		    }
		}
		

		/*-----------------------------------------------------------------------------------*/
		/* TO DO: Add options/functions that use these */
		/*-----------------------------------------------------------------------------------*/
		
		//More Options
		$uploads_arr 		= wp_upload_dir();
		$all_uploads_path 	= $uploads_arr['path'];
		$all_uploads 		= get_option('of_uploads');
		$other_entries 		= array("Select a number:","1","2","3","4","5","6","7","8","9","10","11","12","13","14","15","16","17","18","19");
		$body_repeat 		= array("no-repeat","repeat-x","repeat-y","repeat");
		$body_pos 			= array("top left","top center","top right","center left","center center","center right","bottom left","bottom center","bottom right");
		
		// Image Alignment radio box
		$of_options_thumb_align = array("alignleft" => "Left","alignright" => "Right","aligncenter" => "Center"); 
		
		// Image Links to Options
		$of_options_image_link_to = array("image" => "The Image","post" => "The Post"); 


/*-----------------------------------------------------------------------------------*/
/* The Options Array */
/*-----------------------------------------------------------------------------------*/

// Set the Options Array
global $of_options;
$of_options = array();

$of_options[] = array( 	"name" 		=> "General Settings",
						"type" 		=> "heading"
				);

$of_options[] = array( 	"name" 		=> "Site Logo",
						"desc" 		=> "Upload site logo here.",
						"id" 		=> "logo_upload",
						// Use the shortcodes [site_url] or [site_url_secure] for setting default URLs
						"std" 		=> "",
						"mod"		=> "min",
						"type" 		=> "media"
				);
				
$of_options[] = array( 	"name" 		=> "Button hover border color and text color",
						"desc" 		=> "Add button hover border color and text color.",
						"id" 		=> "link_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Scroll bar color",
						"desc" 		=> "Change the scroll bar color here.",
						"id" 		=> "scroll_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Menu color",
						"desc" 		=> "Add menu color.",
						"id" 		=> "l_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Menu hover color",
						"desc" 		=> "Add menu hover color.",
						"id" 		=> "lh_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Header color",
						"desc" 		=> "Add header color.",
						"id" 		=> "header_color",
						"std" 		=> "",
						"type" 		=> "color"
				);
				
$of_options[] = array( 	"name" 		=> "Portfolio entries per page",
						"desc" 		=> "Set how many portfolio entries to show per page.",
						"id" 		=> "ppp",
						"std" 		=> "10",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Gallery entries per page",
						"desc" 		=> "Set how many gallery entries to show per page.",
						"id" 		=> "gppp",
						"std" 		=> "10",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Extra CSS",
						"desc" 		=> "Add extra css here.",
						"id" 		=> "custom_styles",
						"std" 		=> "",
						"type" 		=> "textarea"
				);
				
$of_options[] = array( 	"name" 		=> "Activate high resolution thumbnails/images",
						"desc" 		=> "The uploaded images must be at least 850 by 850px.",
						"id" 		=> "c_imgres",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" 		=> "Hide font options",
						"desc" 		=> "Hide single page font options menu",
						"id" 		=> "hide_ch",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" 		=> "Social options",
						"desc" 		=> "Single page social menu options",
						"id" 		=> "hide_s_ch",
						"std" 		=> 0,
						"type" 		=> "checkbox"
				);
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Add facebook link name.",
						"id" 		=> "fb",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Add twitter link name.",
						"id" 		=> "tw",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Add google+ link name.",
						"id" 		=> "gpl",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "",
						"desc" 		=> "Add email link name.",
						"id" 		=> "sve",
						"std" 		=> "",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Contact Settings",
						"type" 		=> "heading",
						"icon"		=> ADMIN_IMAGES . "icon-edit.png"
				);

$of_options[] = array( 	"name" 		=> "Google Map Address",
						"desc" 		=> "Add google map address here.",
						"id" 		=> "map_address",
						"std" 		=> "New York, United States",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Google Map Description",
						"desc" 		=> "Add google map description here.",
						"id" 		=> "map_description",
						"std" 		=> "This is the map description",
						"type" 		=> "text"
				);
				
$of_options[] = array( 	"name" 		=> "Contact Left Column",
						"desc" 		=> "Add left column info.",
						"id" 		=> "contact_extra",
						"std" 		=> "",
						"type" 		=> "textarea"
				);

	}//End function: of_options()
}//End chack if function exists: of_options()
?>
