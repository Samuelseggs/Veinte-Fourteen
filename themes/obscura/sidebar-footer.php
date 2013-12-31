<?php
	if (   ! sg_is_active_sidebar( 'sidebar-1'  )
		&& ! sg_is_active_sidebar( 'sidebar-2'  )
		&& ! sg_is_active_sidebar( 'sidebar-3'  )
		&& ! sg_is_active_sidebar( 'sidebar-4'  )
	)
	return;
?>
<div id="footer" <?php elemis_footer_sidebar_class('footer'); ?>>
	<?php if ( sg_is_active_sidebar( 'sidebar-1' ) ) : ?>
	<div id="first" class="widget-area">
		<?php sg_dynamic_sidebar( 'sidebar-1' ); ?>
	</div><!-- #first .widget-area -->
	<?php endif; ?>

	<?php if ( sg_is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="second" class="widget-area">
		<?php sg_dynamic_sidebar( 'sidebar-2' ); ?>
	</div><!-- #second .widget-area -->
	<?php endif; ?>

	<?php if ( sg_is_active_sidebar( 'sidebar-3' ) ) : ?>
	<div id="third" class="widget-area">
		<?php sg_dynamic_sidebar( 'sidebar-3' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
	
	<?php if ( sg_is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div id="fourth" class="widget-area">
		<?php sg_dynamic_sidebar( 'sidebar-4' ); ?>
	</div><!-- #third .widget-area -->
	<?php endif; ?>
</div>


