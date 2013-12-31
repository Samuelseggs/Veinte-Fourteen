<?php get_header( 'buddypress' ); ?>

<?php 
$st_page_sidebar_pos = '';	
$st_page_sidebar_pos = get_post_meta( get_the_ID(), '_st_page_sidebar', true ); 
if (empty( $st_page_sidebar_pos )) {
$st_page_sidebar_pos = 'off';	
}
?>

<!-- #page-header -->
<div id="page-header" class="clearfix">
<div class="container">
<div id="page-header-content" class="clearfix">
<h1><?php if ( bp_account_was_activated() ) :
				_e( 'Account Activated', 'buddypress' );
			else :
				_e( 'Activate your Account', 'buddypress' );
			endif; ?></h1>
</div>
</div>
</div>
<!-- /#page-header -->

<!-- #site-container -->
<div id="site-container" class="clearfix">

<!-- #primary -->
<div id="primary" class="sidebar-<?php echo $st_page_sidebar_pos; ?> clearfix"> 

<!-- #content -->
<div id="content" role="main">

		<?php do_action( 'bp_before_activation_page' ); ?>

		<div class="page" id="activate-page">


			<?php do_action( 'template_notices' ); ?>

			<?php do_action( 'bp_before_activate_content' ); ?>

			<?php if ( bp_account_was_activated() ) : ?>

				<?php if ( isset( $_GET['e'] ) ) : ?>
					<p><?php _e( 'Your account was activated successfully! Your account details have been sent to you in a separate email.', 'buddypress' ); ?></p>
				<?php else : ?>
					<p><?php _e( 'Your account was activated successfully! You can now log in with the username and password you provided when you signed up.', 'buddypress' ); ?></p>
				<?php endif; ?>

			<?php else : ?>

				<p><?php _e( 'Please provide a valid activation key.', 'buddypress' ); ?></p>

				<form action="" method="get" class="standard-form" id="activation-form">

					<label for="key"><?php _e( 'Activation Key:', 'buddypress' ); ?></label>
					<input type="text" name="key" id="key" value="" />

					<p class="submit">
						<input type="submit" name="submit" value="<?php _e( 'Activate', 'buddypress' ); ?>" />
					</p>

				</form>

			<?php endif; ?>

			<?php do_action( 'bp_after_activate_content' ); ?>

		</div><!-- .page -->

		<?php do_action( 'bp_after_activation_page' ); ?>

	</div><!-- #content -->
    
<?php if ($st_page_sidebar_pos != 'off') {
get_sidebar( 'buddypress' );
} ?>

</div>
<!-- /#primary -->

</div>
<!-- /#site-container -->

<?php get_footer( 'buddypress' ); ?>
