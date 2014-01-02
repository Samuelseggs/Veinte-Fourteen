<h4>V.1.4.3 - <em>16.09.2013</em></h4>
<ul>
<li>Fixed bug with page background colour overridden by default background</li>
<li>Fixed gig link from homepage</li>
<li>Post Types : Fixed typo on `supports` parameter</li>
</ul>

<h4>V.1.4.2 - <em>15.09.2013</em></h4>
<ul>
<li>Fixed bug with gig dates on the home page</li>
<li>Fixed bug with error showing on a category page</li>
<li>Fixed custom post type thumbnail support</li>
</ul>

<h4>V.1.4.1 - <em>14.09.2013</em></h4>
<ul>
<li>Content type carousels now fetch title from associated page template</li>
<li>Added text fields to customize default playlist and Twitter block</li>
<li>Added text fields to customize Gig calls to action</li>
<li>Added text fields to customize Newsletter title and submit button</li>
<li>Added blank image for default album thumbnail</li>
<li>i18n : Replaced miused _x() with __()</li>
<li>Taxonomies : Cleaned up trailing whitespace and abuse of indentation</li>
<li>Modified PHP syntax for post types to match taxonomy style</li>
<li>Added option to configure number of slides to display on home page</li>
<li>Globalized post_status and posts_per_page settings in pre_get_posts</li>
<li>Archives : Removed Archive suffix from index titles related to wp_title.</li>
<li>Reorganized the fields in the Content Type tab for better readability of options</li>
<li>Added settings to control posts per page for each custom content type</li>
<li>Comments : Fixed submit button to match color palette.</li>
<li>Archive : Moved get_header() to top of file to prevent fallback loop from breaking the title.</li>
<li>Archive > News : Swapped labels for Next and Previous links.</li>
<li>Pagination > posts_nav_link : Fixed links to match color palette.</li>
<li>Updated Advanced Custom Fields to 4.2.2</li>
<li>Fontello : Opera fails to fallback from FontAwesome to Fontello. Added CSS hack to target it and override its first webfont as Fontello.</li>
<li>Gigs : Added title to events; Cleaner title output for Albums.</li>
<li>Post Types : Added custom columns to all custom post types.</li>
<li>Post Types : Improved display of URLs for Slideshows and Gigs.</li>
<li>Taxonomies : Enabled display of taxonomy column for post types.</li>
<li>Site Footer : Fixed layout of logo and social networks on palm-sized viewports.</li>
<li>Gigs : Fixed & Centralized WP Querying</li>
<li>Homepage Slider : Fixed PHP notice related to empty slides. Replaced query_posts with WP_Query.</li>
<li>Added Individual Page Background Settings</li>
<li>Updated jPlayer Plugin to v2.4.0</li>
<li>Added Newsletter export option</li>
<li>Migrated Gigs dates to native WordPress post_date</li>
</ul>

<h4>V.1.4 - <em>05.09.2013</em></h4>
<ul>
<li>Fixed bug with audio player</li>
</ul>

<h4>V.1.3 - <em>04.09.2013</em></h4>
<ul>
<li>Fixed bug with nav menu / theme location</li>
<li>Made sure to use native WordPress jQuery version</li>
<li>Automatically assign pages to templates after importing default data</li>
<li>Automatically assign content types within admin panel after importing default data</li>
</ul>


<h4>V.1.2 - <em>30.08.2013</em></h4>
<ul>
<li>Added Wordpress native pagination support</li>
<li>Now support 4 types of pagination</li>
<li>Placed wp_head immediately before head closing tag</li>
<li>Fixed minor bug</li>
</ul>

<h4>V.1.1 - <em>23.08.2013</em></h4>
<ul>
<li>Followed most of the Wordpress Theme Unit Tests</li>
<li>Functions : Removed deprecated variable that was causing PHP notices.</li>
<li>Fixed PHP notices and presentation of elements for Gigs and Videos.</li>
<li>Updated TGM-Plugin-Activation Class</li>
<li>WP Nav Menu : Improved CSS for wp_page_menu() fallback</li>
<li>Redux Framework : Suppressed illegal offsets on values.</li>
<li>Theme Options : Removed trailing slashes</li>
<li>Theme Options : Added icons and touch-icons as settings with default collection of images</li>
<li>jQuery : Removed source map to reduce unneeded request</li>
<li>Added default favicon and apple-touch-icons</li>
<li>Meta Data : Added Apple Mobile Web App Title to frontend</li>
<li>Favicon : Added MIME type and HTML tag to WP Dashboard.</li>
<li>Improved usage of conditional scripts for Internet Explorer</li>
<li>JS : Reorganized main scripts and custom scripts</li>
<li>Photos Template : Simplified HTML/JS</li>
<li>Removed dummy text from image alt attributes.</li>
<li>Photos : Added new post image size, 'image-thumb', for the photo gallery.</li>
<li>Front Page : Added global declaration of to prevent PHP warning.</li>
<li>Music Playlist : Improved selection and loading of music playlist and reduced error cases related to empty playlists.</li>
<li>Custom Fields : Fixed missing page template location for Music Playlist.</li>
<li>Single : Migrated AddThis and Comments to external files for less redundant code.</li>
<li>Discography : Fixed btn-pause icon not synced with btn-play.</li>
<li>Fixed spacing for Discography tracklist, Cleaned up padding for social network icons.</li>
<li>Breadcrumbs : Fixed hardcoded links to use home_*_link options.</li>
<li>Home > Videos : Added alternative layout in case no image is provided to prevent layout breaking.</li>
<li>Home : Various fixes to audio player and events</li>
<li>Utilities JS : Fixed unnecessary space added when removing class names.</li>
<li>Single Post : Wrapped content for easier CSS targeting.</li>
<li>Fixed top navigation bar overflow when affixed</li>
<li>Wrapped images in articles to provide consistent heights between posts</li>
<li>Added WordPress' default styles for aligning and captioning images</li>
<li>Functions : Fixed misuse of category variable, Limited Blog Posts to published posts.</li>
<li>Main JS : Removed console log, fixed missing TouchNav capabilities for affixed top navigation bar.</li>
<li>Comments : Added conditional display of Facebook Comments.</li>
<li>Single Post, Page : Added content pagination.</li>
<li>Gigs : Added proper meta_query date filter to display events occuring now or later.</li>
<li>Added clearfix to entry content.</li>
<li>Fixed bugs related to Internet Explorer.</li>
</ul>

<h4>V.1.0 - <em>16.08.2013</em></h4>
<ul>
<li>Initial Version</li>
</ul>