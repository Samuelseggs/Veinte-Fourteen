<style>
	.iron-importer {
		position: relative;
	}
	.iron-importer .loader{
		display:none;
		position:absolute;
		background-image:url(<?php echo IRON_PARENT_URL; ?>/admin/assets/img/ajax-loader.gif);
		background-repeat:no-repeat;
		width:31px;
		height:31px;
		top: -4px;
		left: 145px;
	}
	.iron-importer .status{
		display:none;
		border:1px solid #ddd;
		padding:20px;
		margin-top:15px;
	}
	.iron-importer .status.error{
		border:1px solid red;
	}
	.iron-importer .status.success{
		border:1px solid green;
	}
</style>
<script>

	jQuery(document).ready(function() {
		
	    jQuery('#iron-importer').click(function(e) {
	    	e.preventDefault();
	    	
	    	var res = confirm("Attention: This will flush all posts, post metas, comments, links in your actual DB before importing. Are you sure you want to continue?");
			if (!res)
  				return -1;

	    	var postData = {action: 'iron_import_default_data'};
	    	var loader = jQuery('#iron-importer-loader');
	    	var status = jQuery('#iron-importer-status');
	    	
	    	loader.fadeIn();
	    	status.html('<b>Flushing Current Data ... </b><br><br>').fadeIn();
	    	
	    	jQuery.ajax({
	    		url: ajaxurl,
	    		data: postData,
	    		type: 'post',
	    		dataType: 'json',
	    		success: function(data) {
	    		
	    			if(data.error) {
	    			
	    				status.removeClass('success');
	    				status.addClass('error');
	    				loader.fadeOut();
	    				
	    			}else{
	    				status.removeClass('error');
	    				status.addClass('success');
	    				
	    				status.append(data.msg);
	    				status.append('<br><br><b>Assigning Pages To Template ... </b><br><br>');
	    				
	    				postData = {action: 'iron_import_assign_templates'};
	    				
	    				jQuery.ajax({
				    		url: ajaxurl,
				    		data: postData,
				    		type: 'post',
				    		dataType: 'json',
				    		success: function(data) {
	    		
	    						if(!data.error) {
	    							status.append(data.msg);
	    						}
	    						
	    						loader.fadeOut();
	    					}
	    				});	
	    		
	    			}
	    			
	    			
	    		}
	    	});
	    });
	});
</script>


<div class="iron-importer">
	<input id="iron-importer" type="button" class="button" value="Import Default Data">
	<div id="iron-importer-loader" class="loader"></div>
	<p id="iron-importer-status" class="status"></p>
</div>
	
