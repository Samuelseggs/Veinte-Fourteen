
<style type="text/css">
	#sidebar_form
	{
		margin: 0;
		padding: 0;
	}
	#sidebar_form fieldset
	{
		border: none;
		margin: 0;
		padding: 20px;
	}
	#sidebar_form fieldset label
	{
		font-size: 14px;
		line-height: 26px;
		display: block;
		float: left;
		width: 150px;
	}
	#sidebar_form fieldset .text
	{
		display: block;
		margin: 0 0 0 160px;
		padding: 0 4px;
		height: 24px;
		width: 300px;
	}
	#sidebar_form fieldset .button
	{
		display: block;
		margin: 0 0 0 160px;
	}
</style>

<form action="admin-ajax.php" method="post" id="sidebar_form">

	<fieldset>
		<label for="sidebar_name"><?php _e("Sidebar Name", 'elemis') ?></label>
		<input type="text" class="text" name="name" id="sidebar_name" value="" /><br />
		<label for="sidebar_class"><?php _e("Sidebar Class", 'elemis') ?></label>
		<input type="text" class="text" name="class" id="sidebar_class" value="" /><br />
		<input type="hidden" name="action" value="sidebar_generator_add_submit" />
		<input type="hidden" name="nonce" value="<?php echo wp_create_nonce('sidebar_generator_add') ?>" />
		<input type="submit" class="button-primary button" value="<?php _e("Add Sidebar", 'elemis') ?>" />
	</fieldset>
	
</form>

