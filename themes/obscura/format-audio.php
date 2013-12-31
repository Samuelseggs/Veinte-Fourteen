<?php 
	$audio_mp3 = get_post_meta(get_the_ID(), 'rw_audio_mp3', true);
	$audio_artwork = get_post_meta(get_the_ID(), 'rw_audio_artwork', true);
	$audio_song = get_post_meta(get_the_ID(), 'rw_audio_song', true);
	$audio_artist = get_post_meta(get_the_ID(), 'rw_audio_artist', true);
	$audio_album = get_post_meta(get_the_ID(), 'rw_audio_album', true); 
	$images = rwmb_meta( 'rw_audio_artwork', 'type=image&size=image_artwork' );
?>
<div class="audio-wrapper">
	<div class="vinyl">
		<dl>
			<dt class="art"> <img class="highlight" src="<?php echo get_template_directory_uri(); ?>/style/images/vinyl.png" />
				<?php if ($audio_artwork) {
					foreach ( $images as $image )
					{
						echo "<img src='{$image['url']}' alt='{$image['alt']}' />";
						break;
					}
				} ?>
			</dt>
			<?php if ($audio_song) { ?><dd class="song"><div class="icon-song"></div> <?php echo $audio_song; ?></dd><?php } ?>
			<?php if ($audio_artist) { ?><dd class="artist"><div class="icon-artist"></div> <?php echo $audio_artist; ?></dd><?php } ?>
			<?php if ($audio_album) { ?><dd class="album"><div class="icon-album"></div> <?php echo $audio_album; ?></dd><?php } ?>
		</dl>
	</div><div class="clear"></div>
	<div class="audio">
		<audio controls="" preload="none" src="<?php echo $audio_mp3; ?>"></audio>
	</div>
</div>





