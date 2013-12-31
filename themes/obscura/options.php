<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$fullscreen_transition_array = array("0" => "None","1" => "Fade","2" => "Slide Top","3" => "Slide Right","4" => "Slide Bottom","5" => "Slide Left","6" => "Carousel Right","7" => "Carousel Left");
	
	// Test data
	$google_fonts_array = array(
		"Abel" => "Abel",
		"Abril+Fatface" => "Abril Fatface",
		"Aclonica" => "Aclonica",
		"Actor" => "Actor",
		"Adamina" => "Adamina",
		"Aguafina+Script" => "Aguafina Script",
		"Aladin" => "Aladin",
		"Aldrich" => "Aldrich",
		"Alice" => "Alice",
		"Alike+Angular" => "Alike Angular",
		"Alike" => "Alike",
		"Allan" => "Allan",
		"Allerta+Stencil" => "Allerta Stencil",
		"Allerta" => "Allerta",
		"Amaranth" => "Amaranth",
		"Amatic+SC" => "Amatic SC",
		"Andada" => "Andada",
		"Andika" => "Andika",
		"Annie+Use+Your+Telescope" => "Annie Use Your Telescope",
		"Anonymous+Pro" => "Anonymous Pro",
		"Antic" => "Antic",
		"Anton" => "Anton",
		"Arapey" => "Arapey",
		"Architects+Daughter" => "Architects Daughter",
		"Arimo" => "Arimo",
		"Artifika" => "Artifika",
		"Arvo" => "Arvo",
		"Asset" => "Asset",
		"Astloch" => "Astloch",
		"Atomic+Age" => "Atomic Age",
		"Aubrey" => "Aubrey",
		"Bangers" => "Bangers",
		"Bentham" => "Bentham",
		"Bevan" => "Bevan",
		"Bigshot+One" => "Bigshot One",
		"Bitter" => "Bitter",
		"Black+Ops+One" => "Black Ops One",
		"Bowlby+One+SC" => "Bowlby One SC",
		"Bowlby+One" => "Bowlby One",
		"Brawler" => "Brawler",
		"Bubblegum+Sans" => "Bubblegum Sans",
		"Buda" => "Buda",
		"Butcherman+Caps" => "Butcherman Caps",
		"Cabin+Condensed" => "Cabin Condensed",
		"Cabin+Sketch" => "Cabin Sketch",
		"Cabin" => "Cabin",
		"Cagliostro" => "Cagliostro",
		"Calligraffitti" => "Calligraffitti",
		"Candal" => "Candal",
		"Cantarell" => "Cantarell",
		"Cardo" => "Cardo",
		"Carme" => "Carme",
		"Carter+One" => "Carter One",
		"Caudex" => "Caudex",
		"Cedarville+Cursive" => "Cedarville Cursive",
		"Changa+One" => "Changa One",
		"Cherry+Cream+Soda" => "Cherry Cream Soda",
		"Chewy" => "Chewy",
		"Chicle" => "Chicle",
		"Chivo" => "Chivo",
		"Coda+Caption" => "Coda Caption",
		"Coda" => "Coda",
		"Comfortaa" => "Comfortaa",
		"Coming+Soon" => "Coming Soon",
		"Contrail+One" => "Contrail One",
		"Convergence" => "Convergence",
		"Cookie" => "Cookie",
		"Copse" => "Copse",
		"Corben" => "Corben",
		"Cousine" => "Cousine",
		"Coustard" => "Coustard",
		"Covered+By+Your+Grace" => "Covered By Your Grace",
		"Crafty+Girls" => "Crafty Girls",
		"Creepster+Caps" => "Creepster Caps",
		"Crimson+Text" => "Crimson Text",
		"Crushed" => "Crushed",
		"Cuprum" => "Cuprum",
		"Damion" => "Damion",
		"Dancing+Script" => "Dancing Script",
		"Dawning+of+a+New+Day" => "Dawning of a New Day",
		"Days+One" => "Days One",
		"Delius+Swash+Caps" => "Delius Swash Caps",
		"Delius+Unicase" => "Delius Unicase",
		"Delius" => "Delius",
		"Devonshire" => "Devonshire",
		"Didact+Gothic" => "Didact Gothic",
		"Dorsa" => "Dorsa",
		"Dr+Sugiyama" => "Dr Sugiyama",
		"Droid+Sans+Mono" => "Droid Sans Mono",
		"Droid+Sans" => "Droid Sans",
		"Droid+Serif" => "Droid Serif",
		"EB+Garamond" => "EB Garamond",
		"Eater+Caps" => "Eater Caps",
		"Expletus+Sans" => "Expletus Sans",
		"Fanwood+Text" => "Fanwood Text",
		"Federant" => "Federant",
		"Federo" => "Federo",
		"Fjord+One" => "Fjord One",
		"Fondamento" => "Fondamento",
		"Fontdiner+Swanky" => "Fontdiner Swanky",
		"Forum" => "Forum",
		"Francois+One" => "Francois One",
		"Gentium+Basic" => "Gentium Basic",
		"Gentium+Book+Basic" => "Gentium Book Basic",
		"Geo" => "Geo",
		"Geostar+Fill" => "Geostar Fill",
		"Geostar" => "Geostar",
		"Give+You+Glory" => "Give You Glory",
		"Gloria+Hallelujah" => "Gloria Hallelujah",
		"Goblin+One" => "Goblin One",
		"Gochi+Hand" => "Gochi Hand",
		"Goudy+Bookletter+1911" => "Goudy Bookletter 1911",
		"Gravitas+One" => "Gravitas One",
		"Gruppo" => "Gruppo",
		"Hammersmith+One" => "Hammersmith One",
		"Herr+Von+Muellerhoff" => "Herr Von Muellerhoff",
		"Holtwood+One+SC" => "Holtwood One SC",
		"Homemade+Apple" => "Homemade Apple",
		"IM+Fell+DW+Pica+SC" => "IM Fell DW Pica SC",
		"IM+Fell+DW+Pica" => "IM Fell DW Pica",
		"IM+Fell+Double+Pica+SC" => "IM Fell Double Pica SC",
		"IM+Fell+Double+Pica" => "IM Fell Double Pica",
		"IM+Fell+English+SC" => "IM Fell English SC",
		"IM+Fell+English" => "IM Fell English",
		"IM+Fell+French+Canon+SC" => "IM Fell French Canon SC",
		"IM+Fell+French+Canon" => "IM Fell French Canon",
		"IM+Fell+Great+Primer+SC" => "IM Fell Great Primer SC",
		"IM+Fell+Great+Primer" => "IM Fell Great Primer",
		"Iceland" => "Iceland",
		"Inconsolata" => "Inconsolata",
		"Indie+Flower" => "Indie Flower",
		"Irish+Grover" => "Irish Grover",
		"Istok+Web" => "Istok Web",
		"Jockey+One" => "Jockey One",
		"Josefin+Sans" => "Josefin Sans",
		"Josefin+Slab" => "Josefin Slab",
		"Judson" => "Judson",
		"Julee" => "Julee",
		"Jura" => "Jura",
		"Just+Another+Hand" => "Just Another Hand",
		"Just+Me+Again+Down+Here" => "Just Me Again Down Here",
		"Kameron" => "Kameron",
		"Kelly+Slab" => "Kelly Slab",
		"Kenia" => "Kenia",
		"Knewave" => "Knewave",
		"Kranky" => "Kranky",
		"Kreon" => "Kreon",
		"Kristi" => "Kristi",
		"La+Belle+Aurore" => "La Belle Aurore",
		"Lancelot" => "Lancelot",
		"Lato" => "Lato",
		"League+Script" => "League Script",
		"Leckerli+One" => "Leckerli One",
		"Lekton" => "Lekton",
		"Lemon" => "Lemon",
		"Limelight" => "Limelight",
		"Linden+Hill" => "Linden Hill",
		"Lobster+Two" => "Lobster Two",
		"Lobster" => "Lobster",
		"Lora" => "Lora",
		"Love+Ya+Like+A+Sister" => "Love Ya Like A Sister",
		"Loved+by+the+King" => "Loved by the King",
		"Luckiest+Guy" => "Luckiest Guy",
		"Maiden+Orange" => "Maiden Orange",
		"Mako" => "Mako",
		"Marck+Script" => "Marck Script",
		"Marvel" => "Marvel",
		"Mate+SC" => "Mate SC",
		"Mate" => "Mate",
		"Maven+Pro" => "Maven Pro",
		"Meddon" => "Meddon",
		"MedievalSharp" => "MedievalSharp",
		"Megrim" => "Megrim",
		"Merienda+One" => "Merienda One",
		"Merriweather" => "Merriweather",
		"Metrophobic" => "Metrophobic",
		"Michroma" => "Michroma",
		"Miltonian+Tattoo" => "Miltonian Tattoo",
		"Miltonian" => "Miltonian",
		"Miss+Fajardose" => "Miss Fajardose",
		"Miss+Saint+Delafield" => "Miss Saint Delafield",
		"Modern+Antiqua" => "Modern Antiqua",
		"Molengo" => "Molengo",
		"Monofett" => "Monofett",
		"Monoton" => "Monoton",
		"Monsieur+La+Doulaise" => "Monsieur La Doulaise",
		"Montez" => "Montez",
		"Mountains+of+Christmas" => "Mountains of Christmas",
		"Mr+Bedford" => "Mr Bedford",
		"Mr+Dafoe" => "Mr Dafoe",
		"Mr+De+Haviland" => "Mr De Haviland",
		"Mrs+Sheppards" => "Mrs Sheppards",
		"Muli" => "Muli",
		"Neucha" => "Neucha",
		"Neuton" => "Neuton",
		"News+Cycle" => "News Cycle",
		"Niconne" => "Niconne",
		"Nixie+One" => "Nixie One",
		"Nobile" => "Nobile",
		"Nosifer+Caps" => "Nosifer Caps",
		"Nothing+You+Could+Do" => "Nothing You Could Do",
		"Nova+Cut" => "Nova Cut",
		"Nova+Flat" => "Nova Flat",
		"Nova+Mono" => "Nova Mono",
		"Nova+Oval" => "Nova Oval",
		"Nova+Round" => "Nova Round",
		"Nova+Script" => "Nova Script",
		"Nova+Slim" => "Nova Slim",
		"Nova+Square" => "Nova Square",
		"Numans" => "Numans",
		"Nunito" => "Nunito",
		"Old+Standard+TT" => "Old Standard TT",
		"Open+Sans+Condensed" => "Open Sans Condensed",
		"Open+Sans" => "Open Sans",
		"Orbitron" => "Orbitron",
		"Oswald" => "Oswald",
		"Over+the+Rainbow" => "Over the Rainbow",
		"Ovo" => "Ovo",
		"PT+Sans+Caption" => "PT Sans Caption",
		"PT+Sans+Narrow" => "PT Sans Narrow",
		"PT+Sans" => "PT Sans",
		"PT+Serif+Caption" => "PT Serif Caption",
		"PT+Serif" => "PT Serif",
		"Pacifico" => "Pacifico",
		"Passero+One" => "Passero One",
		"Patrick+Hand" => "Patrick Hand",
		"Paytone+One" => "Paytone One",
		"Permanent+Marker" => "Permanent Marker",
		"Petrona" => "Petrona",
		"Philosopher" => "Philosopher",
		"Piedra" => "Piedra",
		"Pinyon+Script" => "Pinyon Script",
		"Play" => "Play",
		"Playfair+Display" => "Playfair Display",
		"Podkova" => "Podkova",
		"Poller+One" => "Poller One",
		"Poly" => "Poly",
		"Pompiere" => "Pompiere",
		"Prata" => "Prata",
		"Prociono" => "Prociono",
		"Puritan" => "Puritan",
		"Quattrocento+Sans" => "Quattrocento Sans",
		"Quattrocento" => "Quattrocento",
		"Questrial" => "Questrial",
		"Quicksand" => "Quicksand",
		"Radley" => "Radley",
		"Raleway" => "Raleway",
		"Rammetto+One" => "Rammetto One",
		"Rancho" => "Rancho",
		"Rationale" => "Rationale",
		"Redressed" => "Redressed",
		"Reenie+Beanie" => "Reenie Beanie",
		"Ribeye+Marrow" => "Ribeye Marrow",
		"Ribeye" => "Ribeye",
		"Righteous" => "Righteous",
		"Rochester" => "Rochester",
		"Rock+Salt" => "Rock Salt",
		"Rokkitt" => "Rokkitt",
		"Rosario" => "Rosario",
		"Ruslan+Display" => "Ruslan Display",
		"Salsa" => "Salsa",
		"Sancreek" => "Sancreek",
		"Sansita+One" => "Sansita One",
		"Satisfy" => "Satisfy",
		"Schoolbell" => "Schoolbell",
		"Shadows+Into+Light" => "Shadows Into Light",
		"Shanti" => "Shanti",
		"Short+Stack" => "Short Stack",
		"Sigmar+One" => "Sigmar One",
		"Signika+Negative" => "Signika Negative",
		"Signika" => "Signika",
		"Six+Caps" => "Six Caps",
		"Slackey" => "Slackey",
		"Smokum" => "Smokum",
		"Smythe" => "Smythe",
		"Sniglet" => "Sniglet",
		"Snippet" => "Snippet",
		"Sorts+Mill+Goudy" => "Sorts Mill Goudy",
		"Special+Elite" => "Special Elite",
		"Spinnaker" => "Spinnaker",
		"Spirax" => "Spirax",
		"Stardos+Stencil" => "Stardos Stencil",
		"Sue+Ellen+Francisco" => "Sue Ellen Francisco",
		"Sunshiney" => "Sunshiney",
		"Supermercado+One" => "Supermercado One",
		"Swanky+and+Moo+Moo" => "Swanky and Moo Moo",
		"Syncopate" => "Syncopate",
		"Tangerine" => "Tangerine",
		"Tenor+Sans" => "Tenor Sans",
		"Terminal+Dosis" => "Terminal Dosis",
		"The+Girl+Next+Door" => "The Girl Next Door",
		"Tienne" => "Tienne",
		"Tinos" => "Tinos",
		"Tulpen+One" => "Tulpen One",
		"Ubuntu+Condensed" => "Ubuntu Condensed",
		"Ubuntu+Mono" => "Ubuntu Mono",
		"Ubuntu" => "Ubuntu",
		"Ultra" => "Ultra",
		"UnifrakturCook" => "UnifrakturCook",
		"UnifrakturMaguntia" => "UnifrakturMaguntia",
		"Unkempt" => "Unkempt",
		"Unlock" => "Unlock",
		"Unna" => "Unna",
		"VT323" => "VT323",
		"Varela+Round" => "Varela Round",
		"Varela" => "Varela",
		"Vast+Shadow" => "Vast Shadow",
		"Vibur" => "Vibur",
		"Vidaloka" => "Vidaloka",
		"Volkhov" => "Volkhov",
		"Vollkorn" => "Vollkorn",
		"Voltaire" => "Voltaire",
		"Waiting+for+the+Sunrise" => "Waiting for the Sunrise",
		"Wallpoet" => "Wallpoet",
		"Walter+Turncoat" => "Walter Turncoat",
		"Wire+One" => "Wire One",
		"Yanone+Kaffeesatz" => "Yanone Kaffeesatz",
		"Yellowtail" => "Yellowtail",
		"Yeseva+One" => "Yeseva One",
		"Zeyada" => "Zeyada"
	);
	
	$body_size = array(
		"10px" => "10px",
		"11px" => "11px",
		"12px" => "12px",
		"13px" => "13px",
		"14px" => "14px",
		"15px" => "15px",
		"16px" => "16px"
	);
	
	$body_line = array(
		"10px" => "10px",
		"11px" => "11px",
		"12px" => "12px",
		"13px" => "13px",
		"14px" => "14px",
		"15px" => "15px",
		"16px" => "16px",
		"17px" => "17px",
		"18px" => "18px",
		"19px" => "19px",
		"20px" => "20px",
		"21px" => "21px",
		"22px" => "22px",
		"23px" => "23px",
		"24px" => "24px",
		"25px" => "25px",
		"26px" => "26px",
		"27px" => "27px",
		"28px" => "28px",
		"29px" => "29px",
		"30px" => "30px"
	);
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_stylesheet_directory_uri() . '/admin/images/';
		
	$options = array();
		
	$options[] = array( "name" => "General",
						"type" => "heading");
							
	$options[] = array( "name" => "Logo",
						"desc" => "Upload your logo.",
						"id" => "logo",
						"type" => "upload");
	
	$options[] = array( "name" => "Retina Logo",
						"desc" => "Upload your high resolution logo for retina display. Must be twice the size of your logo. Make sure it has the same name with your default logo with @2x.png at the end. (Example: logo@2x.png) ",
						"id" => "logo_retina",
						"type" => "upload");						
	
	$options[] = array( "name" => "Favicon",
						"desc" => "Upload your favicon.",
						"id" => "favicon",
						"type" => "upload");
	
	$options[] = array( "name" => "Centered Logo and Menu",
						"desc" => "Check to center logo and menu.",
						"id" => "centered_header",
						"type" => "checkbox",
						"std" => "");
	
	$options[] = array( "name" => "Loading Icon",
						"desc" => "Display loading icon while blog posts load",
						"id" => "loading",
						"type" => "checkbox",
						"std" => "");
	
	$options[] = array( "name" => "Main Intro",
						"desc" => "Will appear if you want to show a main intro for all pages",
						"id" => "home_intro",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Tracking Code",
						"desc" => "Paste your Google Analytics (or other) tracking code here.",
						"id" => "tracking_code",
						"std" => "",
						"type" => "textarea"); 
	
	$options[] = array( "name" => "Footer Text",
						"desc" => "Enter text for footer.",
						"id" => "footer_text",
						"std" => "",
						"type" => "textarea"); 	
	
	$options[] = array( "name" => "Background",
						"type" => "heading");
	
	
	$url =  ADMIN . 'images/bg/';
	$options[] = array( "name" => "Body Background",
						"desc" => "Click on the image to select it as the background image",
						"id" => "main_bg_preset",
						"std" => "",
						"type" => "images",
						"options" => array(
						'1.jpg' => $url . '1.jpg',
						'2.jpg' => $url . '2.jpg',
						'3.jpg' => $url . '3.jpg',
						'4.jpg' => $url . '4.jpg',
						'5.jpg' => $url . '5.jpg',
						'6.jpg' => $url . '6.jpg',
						'7.jpg' => $url . '7.jpg',
						'8.jpg' => $url . '8.jpg',
						'9.jpg' => $url . '9.jpg'));
	
	
	$options[] = array( "name" => "Main Background Image",
						"desc" => "Upload your an image for main background.",
						"id" => "main_bg",
						"type" => "upload");
	
	$options[] = array( "name" => "Background tile opacity",
						"desc" => "Enter a value between 0-1 (ie: 0.8)",
						"id" => "tile_opacity",
						"std" => "1",
						"type" => "text");
	
	$options[] = array( "name" => "Style",
						"type" => "heading");
	
	$options[] = array( "name" => "Main",
						"type" => "info");
	
	$options[] = array( "name" => "Main text color",
						"desc" => "",
						"id" => "text_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Heading color",
						"desc" => "",
						"id" => "heading_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Link color",
						"desc" => "",
						"id" => "link_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Hover color",
						"desc" => "",
						"id" => "hover_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Intro color",
						"desc" => "",
						"id" => "intro_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Meta color",
						"desc" => "Secondary text, details, quote author etc",
						"id" => "meta_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Menu",
						"type" => "info");
	
	$options[] = array( "name" => "Menu text color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "menu_text_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Menu hover/active color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "menu_hover_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Menu dropdown background color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "dd_bg_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Footer",
						"type" => "info");
	
	$options[] = array( "name" => "Footer text color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "footer_text_color",
						"std" => "",
						"type" => "color");
						
	$options[] = array( "name" => "Footer heading color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "footer_heading",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Footer link color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "footer_link",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Footer hover color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "footer_hover",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Footer meta color",
						"desc" => "Leave blank to use the color you chose for main",
						"id" => "footer_meta",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Default Button",
						"type" => "info");
	
	$options[] = array( "name" => "Default Button Background",
						"desc" => "",
						"id" => "button_bg",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Default Button Text Color",
						"desc" => "",
						"id" => "button_color",
						"std" => "",
						"type" => "color");
	
	$options[] = array( "name" => "Content Overlays",
						"type" => "info");
	
	$options[] = array( "name" => "Box background opacity",
						"desc" => "Enter a two-digit value between 01-99. (Default: 44)",
						"id" => "box_opacity",
						"std" => "44",
						"type" => "text");	
	
	$options[] = array( "name" => "Header background opacity",
						"desc" => "Enter a two-digit value between 01-99. (Default: 33)",
						"id" => "header_opacity",
						"std" => "33",
						"type" => "text");	
										
	$options[] = array( "name" => "Footer background opacity",
						"desc" => "Enter a two-digit value between 01-99. (Default: 44)",
						"id" => "footer_opacity",
						"std" => "44",
						"type" => "text");
						
	$options[] = array( "name" => "Footer bottom background opacity",
						"desc" => "Enter a two-digit value between 01-99. (Default: 55)",
						"id" => "gen_opacity",
						"std" => "55",
						"type" => "text");
	
	$options[] = array( "name" => "Toggle/tab background opacity",
						"desc" => "Enter a two-digit value between 01-99. (Default: 25)",
						"id" => "tt_opacity",
						"std" => "25",
						"type" => "text");
	
	$options[] = array( "name" => "Toggle highlight / other tabs background opacity",
						"desc" => "Enter a two-digit value between 01-99. (Default: 40)",
						"id" => "tt_active_opacity",
						"std" => "40",
						"type" => "text");
	
	$options[] = array( "name" => "Custom CSS",
						"desc" => "Quickly add some CSS to your theme by adding it to this block.",
						"id" => "custom_css",
						"std" => "",
						"type" => "textarea");
	
	
	$options[] = array( "name" => "Typography",
						"type" => "heading");
	
	$options[] = array( "name" => "Headings",
						"desc" => "Choose a font for menu and headings.",
						"id" => "heading_font",
						"type" => "select",
						"std" => "Open+Sans+Condensed",
						"class" => "mini", //mini, tiny, small
						"options" => $google_fonts_array);	
	
	$options[] = array( "name" => "Bold headings",
						"desc" => "Check to make headings bold",
						"id" => "bold_heading",
						"type" => "checkbox",
						"std" => "1");
	
	
	$options[] = array( "name" => "Body",
						"desc" => "Choose a font for body text.",
						"id" => "body_font",
						"type" => "select",
						"std" => "Open+Sans",
						"class" => "mini", //mini, tiny, small
						"options" => $google_fonts_array);	
	
	$options[] = array( "name" => "Italic intro",
						"desc" => "Check to make intro and blockquote italic",
						"id" => "italic_intro",
						"type" => "checkbox",
						"std" => "1");
	
	$options[] = array( "name" => "Body Text Font Size",
						"desc" => "Select font size for body text. (Default: 12px)",
						"id" => "body_size",
						"std" => "12px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_size);
	
	$options[] = array( "name" => "Body Text Line Height",
						"desc" => "Select line height for body text. (Default: 21px)",
						"id" => "body_line",
						"std" => "21px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_line);
	
	$options[] = array( "name" => "Meta Text Font Size",
						"desc" => "Select font size for the secondary text. (Default: 11px)",
						"id" => "meta_size",
						"std" => "11px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_size);
	
	$options[] = array( "name" => "Intro Text Font Size",
						"desc" => "Select font size for the intro. (Default: 22px)",
						"id" => "intro_size",
						"std" => "22px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_line);
	
	$options[] = array( "name" => "Intro Text Line Height",
						"desc" => "Select line height for the intro. (Default: 30px)",
						"id" => "intro_line",
						"std" => "30px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_line);
	
	$options[] = array( "name" => "Menu Font Size",
						"desc" => "Select font size for the menu. (Default: 14px)",
						"id" => "menu_size",
						"std" => "14px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_line);
	
	$options[] = array( "name" => "Menu Dropdown Font Size",
						"desc" => "Select font size for the menu dropdown. (Default: 13px)",
						"id" => "dd_size",
						"std" => "13px",
						"type" => "select",
						"class" => "mini", //mini, tiny, small
						"options" => $body_line);
	
	$options[] = array( "name" => "H1 Font Size and Line Height",
						"desc" => "Select font size and line height for h1. (Default: 24/26px)",
						"id" => "heading1",
						"std" => array('size' => '24px','line' => '26px'),
						"type" => "size");
	
	$options[] = array( "name" => "H2 Font Size and Line Height",
						"desc" => "Select font size and line height for h2. (Default: 22/24px)",
						"id" => "heading2",
						"std" => array('size' => '22px','line' => '24px'),
						"type" => "size");
						
	$options[] = array( "name" => "H3 Font Size and Line Height",
						"desc" => "Select font size and line height for h3. (Default: 20/22px)",
						"id" => "heading3",
						"std" => array('size' => '20px','line' => '22px'),
						"type" => "size");
	
	$options[] = array( "name" => "H4 Font Size and Line Height",
						"desc" => "Select font size and line height for h4. (Default: 18/21px)",
						"id" => "heading4",
						"std" => array('size' => '18px','line' => '21px'),
						"type" => "size");
	
	$options[] = array( "name" => "H5 Font Size and Line Height",
						"desc" => "Select font size and line height for h5, blog grid post, sidebar and footer headings. (Default: 15/21px)",
						"id" => "heading5",
						"std" => array('size' => '15px','line' => '21px'),
						"type" => "size");
	
	$options[] = array( "name" => "H6 Font Size and Line Height",
						"desc" => "Select font size and line height for h6, navigation, filter, toggle and tab headings. (Default: 14/18px)",
						"id" => "heading6",
						"std" => array('size' => '14px','line' => '18px'),
						"type" => "size");
					
	$options[] = array( "name" => "Fullscreen",
						"type" => "heading");
	
	$options[] = array( "name" => "Autoplay",
						"desc" => "Check to enable autoplay. Slideshow will start playing automatically.",
						"id" => "fullscreen_autoplay",
						"type" => "checkbox",
						"std" => "1");
	
	$options[] = array( "name" => "Loop",
						"desc" => "Check to disable loop. Slideshow will be paused on the last slide.",
						"id" => "fullscreen_loop",
						"type" => "checkbox",
						"std" => "");
	
	$options[] = array( "name" => "Slide Interval",
						"desc" => "Length (milliseconds) between transitions (Default: 3000)",
						"id" => "fullscreen_slide_interval",
						"std" => "3000",
						"type" => "text");
	
	$options[] = array( "name" => "Transition",
						"desc" => "",
						"id" => "fullscreen_transition",
						"std" => "1",
						"type" => "select",
						"class" => "mini",
						"options" => $fullscreen_transition_array);
	
	$options[] = array( "name" => "Transition Speed",
						"desc" => "Speed (milliseconds) of transition (Default: 500)",
						"id" => "fullscreen_transition_speed",
						"std" => "500",
						"type" => "text");
						
	$options[] = array( "name" => "Pause on Hover",
						"desc" => "Check to enable pause on hover.",
						"id" => "fullscreen_pause_hover",
						"type" => "checkbox",
						"std" => "");
	
	$options[] = array( "name" => "Image Protection",
						"desc" => "Check to disable image dragging and right-click with Javascript.",
						"id" => "fullscreen_protect",
						"type" => "checkbox",
						"std" => "");
	
	$options[] = array( "name" => "Progress Bar",
						"desc" => "Check to enable progress bar.",
						"id" => "fullscreen_progress",
						"type" => "checkbox",
						"std" => "");
	
	$options[] = array( "name" => "Social Media",
						"type" => "heading");
	
	$options[] = array( "name" => "RSS",
						"desc" => "Enter your URL",
						"id" => "social_rss",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Facebook",
						"desc" => "Enter your URL",
						"id" => "social_facebook",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Twitter",
						"desc" => "Enter your URL",
						"id" => "social_twitter",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Google+",
						"desc" => "Enter your URL",
						"id" => "social_google",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Dribbble",
						"desc" => "Enter your URL",
						"id" => "social_dribbble",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Flickr",
						"desc" => "Enter your URL",
						"id" => "social_flickr",
						"std" => "",
						"type" => "text");	
	
	$options[] = array( "name" => "LinkedIn",
						"desc" => "Enter your URL",
						"id" => "social_linkedin",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Pinterest",
						"desc" => "Enter your URL",
						"id" => "social_pinterest",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Deviantart",
						"desc" => "Enter your URL",
						"id" => "social_deviantart",
						"std" => "",
						"type" => "text");
						
	$options[] = array( "name" => "Forrst",
						"desc" => "Enter your URL",
						"id" => "social_forrst",
						"std" => "",
						"type" => "text");									
						
	$options[] = array( "name" => "Friendfeed",
						"desc" => "Enter your URL",
						"id" => "social_friendfeed",
						"std" => "",
						"type" => "text");					
	
	$options[] = array( "name" => "Lastfm",
						"desc" => "Enter your URL",
						"id" => "social_lastfm",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Skype",
						"desc" => "Enter your URL",
						"id" => "social_skype",
						"std" => "",
						"type" => "text");
	
	$options[] = array( "name" => "Tumblr",
						"desc" => "Enter your URL",
						"id" => "social_tumblr",
						"std" => "",
						"type" => "text");

	$options[] = array( "name" => "Vimeo",
						"desc" => "Enter your URL",
						"id" => "social_vimeo",
						"std" => "",
						"type" => "text");				
	
	$options[] = array( "name" => "Forms",
                    "type" => "heading");
	
	$options[] = array( "name" => "Include IP",
						"desc" => "Check to include the users IP address in the email",
						"id" => "include_ip",
						"type" => "checkbox",
						"std" => "");
					
	$options[] = array( "name" => "Include URL",
						"desc" => "Check to include the page URL in the email",
						"id" => "include_url",
						"type" => "checkbox",
						"std" => "");
					
	$options[] = array( "name" => "Response - Message Sent",
                    	"desc" => "Enter the message returned when the form is successfully submitted",
                    	"id" => "response_sent",
                    	"std" => "Thank you. Your comments have been received.",
                    	"type" => "text");
					
	$options[] = array( "name" => "Use SMTP",
						"desc" => "Check to use SMTP to send email",
						"id" => "mail_smtp",
						"type" => "checkbox",
						"std" => "");
					
	$options[] = array( "name" => "SMTP Server",
                    	"desc" => "Enter the smtp server",
                    	"id" => "smtp_server",
                    	"std" => "",
                    	"type" => "text");
					
	$options[] = array( "name" => "SMTP Port",
                    	"desc" => "Enter the smtp port (if unsure use 25)",
                    	"id" => "smtp_port",
                    	"std" => "25",
                    	"type" => "text");
					
	$options[] = array( "name" => "SMTP Username",
                    	"desc" => "Enter the email account username - this must be the same account as used in 'Email From'",
                    	"id" => "smtp_user",
                    	"std" => "",
                    	"type" => "text");
					
	$options[] = array( "name" => "SMTP Password",
                    	"desc" => "Enter the email account password",
                    	"id" => "smtp_password",
                    	"std" => "",
                    	"type" => "text");
					
	return $options;
}