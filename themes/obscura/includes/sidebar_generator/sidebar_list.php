<table>
	<tr>
		<th class="sidebar_name"><?php _e("Name", 'elemis') ?></th>
		<th class="sidebar_class"><?php _e("Class", 'elemis') ?></th>
		<th class="sidebar_action"><?php _e("Action", 'elemis') ?></th>
	</tr>
	
	<?php 
		foreach ( (array)$this->get_sidebars() as $i => $sidebar ): 
			if ( ! is_array($sidebar) )
				continue;
	?>
		<tr>
			<td class="sidebar_name"><?php echo $sidebar['name'] ?></td>
			<td class="sidebar_class"><?php echo $sidebar['class'] ?></td>
			<td class="sidebar_action">
				<a href="admin-ajax.php?action=sidebar_generator_remove&amp;nonce=<?php echo wp_create_nonce('sidebar_generator_remove') ?>&amp;slug=<?php echo $sidebar['slug'] ?>" class="sidebar_remove"><?php _e("Remove", 'elemis') ?></a>
			</td>
		</tr>
	<?php 
		endforeach 
	?>
	
</table>



