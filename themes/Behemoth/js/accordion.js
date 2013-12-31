<!-- BEGIN CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE (in Wordpress backend, add "sub" class to main-level menu) -->
jQuery(document).ready(function ($) {
	jQuery('.menu ul').slideUp(0);

	jQuery('.menu li.sub').click(function () {
		var target = jQuery(this).children('a');
		if (target.hasClass('menu-expanded')) {
			target.removeClass('menu-expanded');
		} else {
			jQuery('.menu-item > a').removeClass('menu-expanded');
			target.addClass('menu-expanded');
		}
		jQuery(this).find('ul:first')
			.slideToggle(350)
			.end()
			.siblings('li')
			.find('ul')
			.slideUp(350);
		preventDefault();
	});
});
<!-- END CONVERTING DEFAULT WP MENU TO A SLIDE-DOWN ONE -->