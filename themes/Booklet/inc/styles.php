<?php
function custom_styles() {
global $smof_data;
?>

<style>
.main-navigation ul li a:hover, .main-navigation ul li.current_page_item a { color: <?php echo $smof_data['lh_color'] ? $smof_data['lh_color'] : '#bfbfbf'; ?>; }
.main-navigation ul li a { border-left: 1px solid <?php echo $smof_data['l_color'] ? $smof_data['l_color'] : '#818181'; ?>; color: <?php echo $smof_data['l_color'] ? $smof_data['l_color'] : '#818181'; ?>; }
.site-header { background: <?php echo $smof_data['header_color'] ? $smof_data['header_color'] : '#2c2c2c'; ?>; }
.content-area .post-box .post-extra a.read-more:hover,
.content-area .post-single .left.sidebar a.b-button:hover,
.content-area .site-main #portfolio ul li span a:hover,
.button:hover, button:hover, input[type="submit"]:hover, input[type="reset"]:hover, input[type="button"]:hover { 
	color: <?php echo $smof_data['link_color'] ? $smof_data['link_color'] : 'gray'; ?>; 
	border: 1px solid <?php echo $smof_data['link_color'] ? $smof_data['link_color'] : 'gray'; ?>;
}
.nicescroll-rails div { background: <?php echo $smof_data['scroll_color'] ? $smof_data['scroll_color'] : '#2c2c2c'; ?> !important; }
<?php echo $smof_data['custom_styles']; ?>
</style>

<?php }
add_action('wp_head', 'custom_styles', 22);
?>