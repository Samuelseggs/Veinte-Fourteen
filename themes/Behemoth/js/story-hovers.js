jQuery(document).ready(function() {
	jQuery('.featured-image-toggle').click( function() {
		jQuery(this).toggleClass('featured-image-toggle-rotate');
		jQuery(this).parent().parent().parent().find('.entry-content, .post-title, .page-title, .title-spacer').toggleClass('entry-content-toggle');
		jQuery(this).parent().parent().parent().toggleClass('post-background-opacity-toggle');
		return false;
	});
	
	/* silver */
	jQuery('.dark-image .silver, .darker-image .silver').hover( function() {
		jQuery(this).toggleClass('silver-post-background-opacity-hover');
	});
	
	/* dark silver */
	jQuery('.dark-image .dark-silver, .darker-image .dark-silver').hover( function() {
		jQuery(this).toggleClass('dark-silver-post-background-opacity-hover');
	});
	
	/* green */
	jQuery('.dark-image .green, .darker-image .green').hover( function() {
		jQuery(this).toggleClass('green-post-background-opacity-hover');
	});
	
	/* dark green */
	jQuery('.dark-image .dark-green, .darker-image .dark-green').hover( function() {
		jQuery(this).toggleClass('dark-green-post-background-opacity-hover');
	});
	
	/* blue */
	jQuery('.dark-image .blue, .darker-image .blue').hover( function() {
		jQuery(this).toggleClass('blue-post-background-opacity-hover');
	});
	
	/* dark blue */
	jQuery('.dark-image .dark-blue, .darker-image .dark-blue').hover( function() {
		jQuery(this).toggleClass('dark-blue-post-background-opacity-hover');
	});
	
	/* salmon */
	jQuery('.dark-image .salmon, .darker-image .salmon').hover( function() {
		jQuery(this).toggleClass('salmon-post-background-opacity-hover');
	});
	
	/* dark salmon */
	jQuery('.dark-image .dark-salmon, .darker-image .dark-salmon').hover( function() {
		jQuery(this).toggleClass('dark-salmon-post-background-opacity-hover');
	});
	
	/* red */
	jQuery('.dark-image .red, .darker-image .red').hover( function() {
		jQuery(this).toggleClass('red-post-background-opacity-hover');
	});
	
	/* dark red */
	jQuery('.dark-image .dark-red, .darker-image .dark-red').hover( function() {
		jQuery(this).toggleClass('dark-red-post-background-opacity-hover');
	});
	
	/* orange */
	jQuery('.dark-image .orange, .darker-image .orange').hover( function() {
		jQuery(this).toggleClass('orange-post-background-opacity-hover');
	});
	
	/* dark orange */
	jQuery('.dark-image .dark-orange, .darker-image .dark-orange').hover( function() {
		jQuery(this).toggleClass('dark-orange-post-background-opacity-hover');
	});
	
	/* pink */
	jQuery('.dark-image .pink, .darker-image .pink').hover( function() {
		jQuery(this).toggleClass('pink-post-background-opacity-hover');
	});

	/* dark pink */
	jQuery('.dark-image .dark-pink, .darker-image .dark-pink').hover( function() {
		jQuery(this).toggleClass('dark-pink-post-background-opacity-hover');
	});

	/* light */
	jQuery('.dark-image .light, .darker-image .light').hover( function() {
		jQuery(this).toggleClass('light-post-background-opacity-hover');
	});

	/* lighter */
	jQuery('.dark-image .lighter, .darker-image .lighter').hover( function() {
		jQuery(this).toggleClass('lighter-post-background-opacity-hover');
	});
	
});