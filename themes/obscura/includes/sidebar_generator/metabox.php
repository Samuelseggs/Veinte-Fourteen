<?php
global $post, $wp_registered_sidebars;

foreach ( $wp_registered_sidebars as $sidebar ):
	if ( $this->sidebar_exists($sidebar['id']) )
		continue;
	$current_sidebar = get_post_meta($post->ID, "_sidebar_".$sidebar['id'], true);
?>
<p>
	<label><?php echo $sidebar['name'] ?></label><br />
	<select name="sidebar[<?php echo $sidebar['id'] ?>]">
		<option value=""><?php _e("Default", 'elemis') ?></option>
		<?php
			foreach ( (array)$this->get_sidebars() as $i => $sbar ): 
				if ( ! is_array($sbar) )
					continue;
		?>
		<option value="<?php echo $sbar['slug'] ?>" <?php if ( $current_sidebar == $sbar['slug'] ) echo 'selected="selected"' ?>><?php echo $sbar['name'] ?></option>
		<?php 
			endforeach 
		?>
	</select>
</p>
<?php
endforeach
?>
<input type="hidden" name="sidebar_generator_nonce" value="<?php echo wp_create_nonce('sidebar_generator_save_post') ?>" />
