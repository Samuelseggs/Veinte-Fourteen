
	</div>
	<!-- END body -->

</div>
<!-- END #sitewrap -->

<!-- BEGIN FOOTER -->
<?php if(is_home() ) { ?>
	<div id="footer">
	
		<!-- BEGIN INCLUDE PAGINATION -->
		<?php get_template_part('includes/pagination'); ?>
		<!-- END INCLUDE PAGINATION -->
		
		<!-- BEGIN WIDGETS -->
		<div class="footer-widgets-wrapper">
			<div class="footer-widgets-wrapper-inner">
				<!-- BEGIN FULL WIDTH WIDGETS --><div class="footer-widgets-1-column"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets (full width)') ) : ?><?php endif; ?></div><!-- END FULL WIDTH WIDGETS -->
				<!-- BEGIN 2-COLUMN WIDGETS --><div class="footer-widgets-2-columns clear"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets (2 columns)') ) : ?><?php endif; ?></div><!-- END 2-COLUMN WIDGETS -->
				<!-- BEGIN 3-COLUMN WIDGETS --><div class="footer-widgets-3-columns clear"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Footer Widgets (3 columns)') ) : ?><?php endif; ?></div><!-- END 3-COLUMN WIDGETS -->
			</div>
		</div>
		<!-- END WIDGETS -->
	
	</div>
<?php } ?>
<!-- END FOOTER -->

<!-- wp_footer -->
<?php wp_footer(); ?>
</body>
</html>