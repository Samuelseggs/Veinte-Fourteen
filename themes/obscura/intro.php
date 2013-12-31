<!-- Begin Intro -->
<?php 
	$intro = get_post_meta(get_the_ID(), 'rw_intro', true);
	$hide_intro = get_post_meta(get_the_ID(), 'rw_hide_intro', true);
	$hide_social = get_post_meta(get_the_ID(), 'rw_hide_social', true);
	$main_intro = of_get_option('home_intro');
	if (!$hide_intro) {
		if ($intro) {
			echo "<div class='intro'>$intro</div>";
		} elseif ($main_intro) {
			echo "<div class='intro'>$main_intro</div>";
		}
	}
	if (!$hide_social) { include (TEMPLATEPATH . '/social.php'); }
?>

<?php if (!$hide_intro && $hide_social) { ?>
<style type="text/css">
.intro {
margin-bottom: 40px;
}
</style>
<?php } ?>

<?php if ($hide_intro && !$hide_social) { ?>
<style type="text/css">
ul.social {
margin-bottom: 32px;
}
</style>
<?php } ?>
<!-- End Intro -->