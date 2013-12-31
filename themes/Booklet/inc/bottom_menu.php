<?php global $smof_data; ?>
<ul class="bsm">
	<li class="clearfix"><a class="share" href="#"><?php _e('Share'); ?></a>
		<ul class="social-menu">
			<li>
				<a href="#" 
				  onclick="
					window.open(
					  'https://www.facebook.com/sharer/sharer.php?u='+encodeURIComponent(location.href), 
					  'facebook-share-dialog', 
					  'width=626,height=436'); 
					return false;">
				  <?php echo $smof_data['fb'] != "" ? $smof_data['fb'] : 'Facebook' ; ?>
				</a>
			</li>
			<li><a href="http://twitter.com/share?text=<?php the_title(); ?>&url=<?php the_permalink(); ?>"><?php echo $smof_data['tw'] != "" ? $smof_data['tw'] : 'Twitter' ; ?></a></li>
			<li><a href="https://plus.google.com/share?url=<?php the_permalink(); ?>"><?php echo $smof_data['gpl'] != "" ? $smof_data['gpl'] : 'Google+' ; ?></a></li>
			<li><a target="_blank" href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php the_content(); ?>"><?php echo $smof_data['sve'] != "" ? $smof_data['sve'] : 'Send via email' ; ?></a></li>
		</ul>
	</li>
</ul>