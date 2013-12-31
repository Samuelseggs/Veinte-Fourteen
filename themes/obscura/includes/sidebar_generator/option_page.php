<style type="text/css">
	#sidebar_list
	{
		padding: 20px 0;
	}
	#sidebar_list table 
	{
		width: 640px;
		border-collapse: collapse;
	}
	#sidebar_list table td,
	#sidebar_list table th
	{
		padding: 4px 10px;
		border: 1px solid #ccc;
		text-align: left;
	}
	#sidebar_list table .sidebar_name
	{
		width: 30%;
	}
	#sidebar_list table .sidebar_class
	{
		width: 30%;
	}
</style>

<div class="wrap">
			
	<h2><?php _e("Sidebar Generator", 'elemis') ?></h2>
	
	<p><a href="admin-ajax.php?action=sidebar_generator_add&amp;nonce=<?php echo wp_create_nonce('sidebar_generator') ?>" class="thickbox button" title="<?php _e("Add Sidebar", 'elemis') ?>" id="add_sidebar"><?php _e("Add Sidebar", 'elemis') ?></a></p>
	
	<div id="sidebar_list">
		<?php $this->sidebar_list() ?>
	</div>
	
</div>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#sidebar_form').live('submit', function(){
			var obj = $(this);
			$.post(ajaxurl, {
				'nonce': obj.find('[name=nonce]').val(),
				'action': obj.find('[name=action]').val(),
				'name': obj.find('[name=name]').val(),
				'class': obj.find('[name=class]').val()
			}, function(data){
				if ( data == '-1' )
					alert("<?php _e("An error occured", 'elemis') ?>");
				else if ( data == '-2' )
					alert("<?php _e("Sidebar name exists", 'elemis') ?>");
				else
					tb_remove();
				load_sidebar_list();
			});
			return false;
		});
		$('.sidebar_remove').live('click', function(){
			if ( confirm("<?php _e("Remove this sidebar?", 'elemis') ?>") )
				$.get($(this).attr('href'), {}, function(data){
					load_sidebar_list();
				});
			return false;
		});
	});
	
	function load_sidebar_list()
	{
		jQuery.post(ajaxurl, {
			'nonce': "<?php echo wp_create_nonce("sidebar_generator_list") ?>",
			'action': 'sidebar_generator_list'
		}, function(data){
			jQuery('#sidebar_list').html(data);
		});
	}
	
</script>