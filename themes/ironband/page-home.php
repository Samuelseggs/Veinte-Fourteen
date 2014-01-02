<?php
/**
 * Template Name: Home
 */

if(isset($_GET["load"]) && $_GET["load"] == "playlist.json") {
	iron_print_playlist_json();
	die();
}

$active_blocks = get_iron_option('homepage_blocks');
$blocks = array(
	'audioplayer_twitter' => 'iron_get_home_audioplayer_twitter',
	'recent_news' => 'iron_get_home_news',
	'upcoming_gigs' => 'iron_get_home_gigs',
	'recent_videos' => 'iron_get_home_videos',
);

get_header();

echo iron_get_home_slider();

?>

<!-- container -->
<div class="container">

<?php if($active_blocks): ?>

	<?php foreach($active_blocks["enabled"] as $block => $title): ?>

		<?php
		if(isset($blocks[$block])) {
			$block_output_function = $blocks[$block];
			if(function_exists($block_output_function))
				echo $block_output_function();
		}
		?>

	<?php endforeach; ?>

<?php endif; ?>

</div>

<?php get_footer(); ?>