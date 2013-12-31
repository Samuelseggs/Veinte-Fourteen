<!-- SHOW SHOW/HIDE SEARCH FORM -->

/* show/hide search form via search icon */
jQuery('#header-search').click(function(){
	if(jQuery('.searchform-wrapper').hasClass('searchform-wrapper-active'))
	{

		/* hide search field */
		jQuery('.searchform-wrapper').removeClass('searchform-wrapper-active');
		/* show icon menu */
		jQuery('.bonfire-icon-menu').fadeIn(600);
		return false;

	}
	else
	{

		/* show search field */
		jQuery('.searchform-wrapper').addClass('searchform-wrapper-active');
		/* hide icon menu */
		jQuery('.bonfire-icon-menu').fadeOut(0);
		/* focus search field */
		jQuery('#searchform #s').focus();
		return false;

	}
});

/* hide search field via 'X' button */
jQuery('#searchform-close').click(
	function() {

		/* hide search field */
		jQuery('.searchform-wrapper').removeClass('searchform-wrapper-active');
		/* show icon menu */
		jQuery('.bonfire-icon-menu').fadeIn(600);
		return false;

});
<!-- END SHOW/HIDE SEARCH FORM -->