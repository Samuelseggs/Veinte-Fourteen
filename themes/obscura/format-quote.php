<?php 
$quote = get_post_meta(get_the_ID(), 'rw_quote', true);
$cite = get_post_meta(get_the_ID(), 'rw_quote_author', true); 
if ($quote) {
	echo '<blockquote>'.$quote.'';
		if ($cite) {
			echo '<cite>'.$cite.'</cite>';
		}
	echo '</blockquote>';
} 
?>