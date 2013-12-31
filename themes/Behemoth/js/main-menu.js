<!-- BEGIN SHOW/HIDE MAIN MENU -->
jQuery('.menu-button').click(
	function() {
		jQuery('#menu').toggleClass('menu-active');
		jQuery('.menu-button').toggleClass('menu-button-hover');
		jQuery(".menu-button").removeClass("menu-button-hover-touch");	
});

jQuery(".menu-button").hover(
	function() {
		jQuery(".menu-button").addClass("menu-button-hover-touch");
	},
	function() {
		jQuery(".menu-button").removeClass("menu-button-hover-touch");
});

<!-- END SHOW/HIDE MAIN MENU -->


<!-- BEGIN HIDE SHOWING AREA -->
jQuery('.showing-hide').click(
	function() {
		jQuery('.showing, .showing-hide').fadeOut(350);	
});
<!-- END HIDE SHOWING AREA -->