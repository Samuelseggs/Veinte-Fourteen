/* global jQuery:false */
var THEMEREX_error_msg_box = null;
var THEMEREX_viewmore_busy = false;

jQuery(document).ready(function() {
	"use strict";

	// toTop link setup
	showToTop();
	jQuery(window).scroll(showToTop);
	jQuery('#toTop').click(function(e) {
		"use strict";
		jQuery('body,html').animate({scrollTop:0}, 800);
		e.preventDefault();
		return false;
	});

	// Search link
	jQuery('.search_link').click(function(e) {
		"use strict";
		jQuery('.search_form_area').addClass('shown').removeClass('hidden');
		e.preventDefault();
		return false;
	});
	jQuery('.search_close').click(function(e) {
		"use strict";
		jQuery('.search_form_area').removeClass('shown').addClass('hidden');
		e.preventDefault();
		return false;
	});

	// Login & registration link
	jQuery('.link_login,.link_register,.popup_form .popup_title .popup_close').click(function(e) {
		"use strict";
		var obj = jQuery(this);
		var popup = obj.hasClass('link_login') ? jQuery('#popup_login') : (obj.hasClass('link_register') ? jQuery('#popup_register') : obj.parents('.popup_form'));
		if (popup.length === 1) {
			if (parseInt(popup.css('left'), 10) === 0) {
				var offset = jQuery('.link_login').offset();
				popup.css({
					left: offset.left+jQuery('.link_login').width()-popup.width(),
					top: offset.top	//+jQuery(this).height()+4
				});
			}
			jQuery('.popup_form').removeClass('visible').fadeOut();
			if (jQuery('.link_login').hasClass('icon-cancel')) {
				jQuery('.link_login').addClass('icon-login-1').removeClass('icon-cancel');
			} else {
				popup.addClass('visible').fadeIn();
				jQuery('.link_login').removeClass('icon-login-1').addClass('icon-cancel');
			}
		}
		e.preventDefault();
		return false;
	});
	jQuery('.popup_form form').keypress(function(e){
		"use strict";
		if (e.keyCode === 27) {
			jQuery(this).parents('.popup_form').find('.popup_title .popup_close').trigger('click');
			e.preventDefault();
			return false;
		} 
		/*
		else if (e.keyCode === 13) {
			jQuery(this).parents('.popup_form').find('.popup_button a').trigger('click');
			e.preventDefault();
			return false;
		}
		*/
	});
	jQuery('#popup_login .popup_button a').click(function(e){
		"use strict";
		jQuery('#popup_login form input').removeClass('error_fields_class');
		var error = formValidate(jQuery('#popup_login form'), {
			error_message_show: true,
			error_message_time: 4000,
			error_message_class: 'sc_infobox sc_infobox_style_error',
			error_fields_class: 'error_fields_class',
			exit_after_first_error: true,
			rules: [
				{
					field: "log",
					min_length: { value: 1, message: THEMEREX_LOGIN_EMPTY},
					max_length: { value: 60, message: THEMEREX_LOGIN_LONG}
				},
				{
					field: "pwd",
					min_length: { value: 4, message: THEMEREX_PASSWORD_EMPTY},
					max_length: { value: 20, message: THEMEREX_PASSWORD_LONG}
				}
			]
		});
		if (!error) {
			document.forms.login_form.submit();
		}
		e.preventDefault();
		return false;
	});
	jQuery('#popup_login .register a').click(function(e){
		"use strict";
		jQuery('.link_login').trigger('click');
		jQuery('.link_register').trigger('click');
		e.preventDefault();
		return false;
	});
	jQuery('#popup_register .registration_role input').change(function(e){
		"use strict";
		if (jQuery(this).index() > 1)
			jQuery('#popup_register .registration_msg_area').slideDown();
		else
			jQuery('#popup_register .registration_msg_area').slideUp();
	});
	jQuery('#popup_register .popup_button a').click(function(e){
		"use strict";
		jQuery('#popup_register form input').removeClass('error_fields_class');
		var error = formValidate(jQuery("#popup_register form"), {
			error_message_show: true,
			error_message_time: 4000,
			error_message_class: "sc_infobox sc_infobox_style_error",
			error_fields_class: "error_fields_class",
			exit_after_first_error: true,
			rules: [
				{
					field: "registration_username",
					min_length: { value: 1, message: THEMEREX_LOGIN_EMPTY },
					max_length: { value: 60, message: THEMEREX_LOGIN_LONG }
				},
				{
					field: "registration_email",
					min_length: { value: 7, message: THEMEREX_EMAIL_EMPTY },
					max_length: { value: 60, message: THEMEREX_EMAIL_LONG },
					mask: { value: "^([a-z0-9_\\-]+\\.)*[a-z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$", message: THEMEREX_EMAIL_NOT_VALID }
				},
				{
					field: "registration_pwd",
					min_length: { value: 4, message: THEMEREX_PASSWORD_EMPTY },
					max_length: { value: 20, message: THEMEREX_PASSWORD_LONG }
				},
				{
					field: "registration_pwd2",
					equal_to: { value: 'registration_pwd', message: THEMEREX_PASSWORD_NOT_EQUAL }
				}
			]
		});
		if (!error) {
			jQuery.post(THEMEREX_ajax_url, {
				action: 'registration_user',
				nonce: THEMEREX_ajax_nonce,
				user_name: 	jQuery('#popup_register #registration_username').val(),
				user_email: jQuery('#popup_register #registration_email').val(),
				user_pwd: 	jQuery('#popup_register #registration_pwd').val(),
				user_role: 	jQuery('#popup_register #registration_role2').get(0).checked ? 2 : 1,
				user_msg: 	jQuery('#popup_register #registration_msg').val()
			}).done(function(response) {
				var rez = JSON.parse(response);
				var result_box = jQuery('#popup_register .result');
				result_box.toggleClass('sc_infobox_style_error', false).toggleClass('sc_infobox_style_success', false);
				if (rez.error === '') {
					result_box.addClass('sc_infobox_style_success').html(THEMEREX_REGISTRATION_SUCCESS + (jQuery('#popup_register #registration_role2').get(0).checked ? '<br /><br />' + THEMEREX_REGISTRATION_AUTHOR : ''));
					setTimeout(function() { jQuery('#popup_register .popup_close').trigger('click'); jQuery('.link_login').trigger('click'); }, 2000);
				} else {
					result_box.addClass('sc_infobox_style_error').html(THEMEREX_REGISTRATION_FAILED + ' ' + rez.error);
				}
				result_box.fadeIn();
				setTimeout(function() { jQuery('#popup_register .result').fadeOut(); }, 5000);
			});
		}
		e.preventDefault();
		return false;
	});


	// Main menu
	if (THEMEREX_mainMenuMobile) {
		jQuery('#mainmenu').mobileMenu({mobileWidth: THEMEREX_mainMenuMobileWidth});
	}
	if (THEMEREX_mainMenuSlider) {
		jQuery('#mainmenu').spasticNav();
	}
	jQuery('#mainmenu').superfish({
		autoArrows: false,
		useClick: false,
		disableHI: true,
		animation: {height:'show'},
		speed: THEMEREX_mainMenuSlider ? 300 : 100,
		animationOut: {opacity: 'hide'},
		speedOut: 'fast',
		delay: 100
	});
	if (THEMEREX_mainMenuFixed) {
		var menu_offset = jQuery('#header_middle').offset().top;
		jQuery(window).scroll(function() {
			"use strict";
			var s = jQuery(this).scrollTop();
			if (s >= menu_offset) {
				jQuery('body').addClass('menu_fixed');
			} else {
				jQuery('body').removeClass('menu_fixed');
			}
		});
	}
	
	// Hide empty pagination
	if (jQuery('#nav_pages > ul > li').length < 3) {
		jQuery('#nav_pages').remove();
	} else {
		jQuery('.theme_paginaton a').addClass('theme_button');
	}

	// Main Sidebar and content height equals
	var h1 = 0, h2 = 0;
	if (jQuery('.with_sidebar #sidebar_main').length === 1) {
		h1 = jQuery('#content').height() - (jQuery('#content #nav_pages').length > 0 ? jQuery('#content #nav_pages').height() + parseInt(jQuery('#content #nav_pages').css('marginTop')) + parseInt(jQuery('#content #nav_pages').css('paddingTop')) + parseInt(jQuery('#content #nav_pages').css('paddingBottom')) : 0);
		h2 = jQuery('#sidebar_main').height();
		if (h1 > h2) {
			jQuery('#sidebar_main').append('<div class="sidebar_increase theme_article" style="height:' + (h1 - h2) + 'px"></div>');
		} else if (h1 < h2) {
			//jQuery('#content').append('<div class="content_increase theme_article" style="height:' + (h2 - h1) + 'px"></div>');
		}
	}
	
	// Advert Sidebar widgets height equals
	if (jQuery('#advert_sidebar').length === 1 && jQuery('body').width()>480) {
		h1 = 0;
		jQuery('#advert_sidebar .widget').each(function() {
			"use strict";
			var tabs = jQuery(this).find('ul.tabs');
			if (tabs.length > 0) {
				h2 =  jQuery(this).find('.widget_title').eq(0).height() + parseInt(jQuery(this).find('.widget_title').eq(0).css('marginBottom'))
					+ tabs.eq(0).height() 
					+ jQuery(this).find('.tab_content').eq(0).height() + parseInt(jQuery(this).find('.tab_content > .post_item').eq(0).css('marginTop'));
			} else {
				h2 = jQuery(this).height();
			}
			if (h2 > h1) {
				h1 = h2;
			}
		});
		if (h1 > 0) {
			jQuery('#advert_sidebar .widget').each(function() {
				"use strict";
				jQuery(this).height(h1);
			});
		}
	}
	
	// Footer Sidebar widgets height equals
	if (jQuery('#footer_sidebar').length === 1 && jQuery('body').width()>480) {
		h1 = 0;
		jQuery('#footer_sidebar .widget').each(function() {
			"use strict";
			var tabs = jQuery(this).find('ul.tabs');
			if (tabs.length > 0) {
				h2 =  jQuery(this).find('.widget_title').eq(0).height() + parseInt(jQuery(this).find('.widget_title').eq(0).css('marginBottom'))
					+ tabs.eq(0).height() 
					+ jQuery(this).find('.tab_content').eq(0).height() + parseInt(jQuery(this).find('.tab_content > .post_item').eq(0).css('marginTop'));
			} else {
				h2 = jQuery(this).height();
			}
			if (h2 > h1) {
				h1 = h2;
			}
		});
		if (h1 > 0) {
			jQuery('#footer_sidebar .widget').each(function() {
				"use strict";
				jQuery(this).height(h1);
			});
		}
	}
	
	// IFRAME width and height constrain proportions 
	if (jQuery('iframe').length > 0) {
		jQuery('iframe').each(function() {
			"use strict";
			var iframe = jQuery(this).eq(0);
			var w_attr = iframe.attr('width');
			var h_attr = iframe.attr('height');
			if (!w_attr || !h_attr) {
				return;
			}
			var w_real = iframe.width();
			iframe.height(Math.round(w_real/w_attr*h_attr));
		});
	}

	// View More button
	jQuery('#viewmore_link').click(function(e) {
		"use strict";
		jQuery(this).addClass('loading');
		THEMEREX_viewmore_busy = true;
		jQuery.post(THEMEREX_ajax_url, {
			action: 'view_more_posts',
			nonce: THEMEREX_ajax_nonce,
			page: Number(jQuery('#viewmore_page').val())+1,
			data: jQuery('#viewmore_data').val(),
			vars: jQuery('#viewmore_vars').val()
		}).done(function(response) {
			"use strict";
			var rez = JSON.parse(response);
			jQuery('#viewmore_link').removeClass('loading');
			THEMEREX_viewmore_busy = false;
			if (rez.error === '') {
				jQuery('#viewmore').before(rez.data);
				initPostFormats();
				var nextPage = Number(jQuery('#viewmore_page').val())+1;
				jQuery('#viewmore_page').val(nextPage);
				if (rez.no_more_data==1) {
					jQuery('#viewmore').hide();
				}
				if (jQuery('#nav_pages ul li').length >= nextPage) {
					jQuery('#nav_pages ul li').eq(nextPage).toggleClass('pager_current', true);
				}
			}
		});
		e.preventDefault();
		return false;
	});

	// Infinite pagination
	if (jQuery('#viewmore.pagination_infinite').length > 0) {
		jQuery(window).scroll(infiniteScroll);
	}

	// ----------------------- Post formats setup -----------------
	initPostFormats();


	// ----------------------- Shortcodes setup -------------------
	jQuery('div.sc_infobox_closeable').click(function(e) {
		"use strict";
		jQuery(this).fadeOut();
		e.preventDefault();
		return false;
	});

	jQuery('.sc_tooltip_parent').hover(function(){
		"use strict";
		var obj = jQuery(this);
		obj.find('.sc_tooltip').stop().animate({'marginTop': '5'}, 100).show();
	},
	function(){
		"use strict";
		var obj = jQuery(this);
		obj.find('.sc_tooltip').stop().animate({'marginTop': '0'}, 100).hide();
	});
	jQuery('.sc_toggles .sc_toggles_item .sc_toggles_title a').click(function(e) {
		"use strict";
		jQuery(this).parent().toggleClass('ui-state-active').siblings('div').slideToggle(200);
		e.preventDefault();
		return false;
	});

	

	// ----------------------- Comment form submit ----------------
	jQuery("form#commentform").submit(function(e) {
		"use strict";
		var error = formValidate(jQuery(this), {
			error_message_text: THEMEREX_GLOBAL_ERROR_TEXT,	// Global error message text (if don't write in checked field)
			error_message_show: true,				// Display or not error message
			error_message_time: 5000,				// Error message display time
			error_message_class: 'sc_infobox sc_infobox_style_error',	// Class appended to error message block
			error_fields_class: 'error_fields_class',					// Class appended to error fields
			exit_after_first_error: false,								// Cancel validation and exit after first error
			rules: [
				{
					field: 'author',
					min_length: { value: 1, message: THEMEREX_NAME_EMPTY},
					max_length: { value: 60, message: THEMEREX_NAME_LONG}
				},
				{
					field: 'email',
					min_length: { value: 7, message: THEMEREX_EMAIL_EMPTY},
					max_length: { value: 60, message: THEMEREX_EMAIL_LONG},
					mask: { value: '^([a-z0-9_\\-]+\\.)*[a-z0-9_\\-]+@[a-z0-9_\\-]+(\\.[a-z0-9_\\-]+)*\\.[a-z]{2,6}$', message: THEMEREX_EMAIL_NOT_VALID }
				},
				{
					field: 'comment',
					min_length: { value: 1, message: THEMEREX_MESSAGE_EMPTY },
					max_length: { value: 1000, message: THEMEREX_MESSAGE_LONG}
				}
			]
		});
		if (error) { e.preventDefault(); }
		return !error;
	});

	/* ================== Customize site ========================= */
	if (jQuery("#custom_options").length===1) {
		jQuery('#co_toggle').click(function(e) {
			"use strict";
			var co = jQuery('#custom_options').eq(0);
			if (co.hasClass('opened')) {
				co.removeClass('opened').animate({marginRight:-237}, 300);
			} else {
				co.addClass('opened').animate({marginRight:-15}, 300);
			}
			e.preventDefault();
			return false;
		});
		// Body style
		jQuery("#custom_options .switcher a" ).draggable({
			axis: 'x',
			containment: 'parent',
			stop: function() {
				var left = parseInt(jQuery(this).css('left'), 10);
				var curStyle = left < 25 ? 'wide' : 'boxed';
				switchBox(jQuery(this).parent(), curStyle, true);
			}
		});
		jQuery("#custom_options .switcher" ).click(function(e) {
			"use strict";
			switchBox(jQuery(this));
			e.preventDefault();
			return false;
		});
		jQuery("#custom_options .co_switch_box .boxed" ).click(function(e) {
			"use strict";
			switchBox(jQuery('#custom_options .switcher'), 'boxed');
			e.preventDefault();
			return false;
		});
		jQuery("#custom_options .co_switch_box .stretched" ).click(function(e) {
			"use strict";
			switchBox(jQuery('#custom_options .switcher'), 'wide');
			e.preventDefault();
			return false;
		});
		// Main theme color and Background color
		iColorPicker();
		jQuery('#custom_options .iColorPicker').click(function () {
			"use strict";
			iColorShow(null, jQuery(this), function(fld, clr) {
				"use strict";
				fld.css('backgroundColor', clr);
				fld.siblings('input').attr('value', clr);
				if (fld.attr('id')==='co_theme_color') {
					jQuery.cookie('theme_color', clr, {expires: 1, path: '/'});
					window.location = jQuery("#custom_options #co_site_url").val();
				} else {
					jQuery("#custom_options .co_switch_box .boxed").trigger('click');
					jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
					jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
					jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
					jQuery.cookie('bg_color', clr, {expires: 1, path: '/'});
					jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3').css('backgroundColor', clr);
				}
			});
		});
		
		// Background patterns
		jQuery('#custom_options #co_bg_pattern_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_pattern_list .co_pattern_wrapper,#custom_options #co_bg_images_list .co_image_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_image', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', val, {expires: 1, path: '/'});
			jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3').addClass('bg_pattern_' + val);
			e.preventDefault();
			return false;
		});
		// Background images
		jQuery('#custom_options #co_bg_images_list a').click(function(e) {
			"use strict";
			jQuery("#custom_options .co_switch_box .boxed").trigger('click');
			jQuery('#custom_options #co_bg_images_list .co_image_wrapper,#custom_options #co_bg_pattern_list .co_pattern_wrapper').removeClass('current');
			var obj = jQuery(this).addClass('current');
			var val = obj.attr('id').substr(-1);
			jQuery.cookie('bg_color', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_pattern', null, {expires: -1, path: '/'});
			jQuery.cookie('bg_image', val, {expires: 1, path: '/'});
			jQuery(document).find('body').removeClass('bg_pattern_1 bg_pattern_2 bg_pattern_3 bg_pattern_4 bg_pattern_5 bg_image_1 bg_image_2 bg_image_3').addClass('bg_image_' + val);
			e.preventDefault();
			return false;
		});
	}
	/* ================== /Customize site ========================= */
});

function switchBox(box) {
	"use strict";
	var toStyle = arguments[1] ? arguments[1] : '';
	var important = arguments[2] ? arguments[2] : false;
	var switcher = box.find('a').eq(0);
	var left = parseInt(switcher.css('left'), 10);
	var newStyle = left < 5 ? 'boxed' : 'wide';
	if (toStyle==='' || important || newStyle === toStyle) {
		if (toStyle==='') {toStyle = newStyle;}
		var right = box.width() - switcher.width() + 2;
		if (toStyle === 'wide') {switcher.animate({left: -2}, 200);}
		else {switcher.animate({left: right}, 200);}
		jQuery.cookie('body_style', toStyle, {expires: 1, path: '/'});
		jQuery(document).find('body').removeClass(toStyle==='boxed' ? 'wide' : 'boxed').addClass(toStyle);
		jQuery(document).trigger('resize');
	}
	return newStyle;
}

function initPostFormats() {
	"use strict";

	// MediaElement init
	if (THEMEREX_useMediaElement) {
		jQuery('video,audio').each(function () {
			if (jQuery(this).hasClass('inited')) return;
			jQuery(this).addClass('inited').mediaelementplayer({
				videoWidth: -1,		// if set, overrides <video width>
				videoHeight: -1,	// if set, overrides <video height>
				audioWidth: '100%',	// width of audio player
				audioHeight: 30	// height of audio player
			});
		});
	}
	
	// Pretty photo
	jQuery("a[href$='jpg'],a[href$='jpeg'],a[href$='png'],a[href$='gif']").each(function () {
		"use strict";
		jQuery(this).toggleClass('prettyPhoto', true);
	});
	jQuery("a[class*='prettyPhoto']").each(function() {
		"use strict";
		if (jQuery(this).hasClass('inited')) return;
		jQuery(this)
			.addClass('inited')
			.prettyPhoto({
				social_tools: '',
				theme: 'light_rounded'
			})
			.click(function(e) {
				"use strict";
				if (jQuery(window).width()<480)	{
					e.stopImmediatePropagation();
					window.location = jQuery(this).attr('href');
				}
				e.preventDefault();
				return false;
			});
	});
	
	// Galleries Slider
	jQuery('.sc_slider_flex').each(function () {
		"use strict";
		if (jQuery(this).hasClass('inited')) return;
		jQuery(this).addClass('inited').flexslider({
			directionNav: true,
			prevText: '',
			nextText: '',
			controlNav: jQuery(this).hasClass('sc_slider_controls'),
			animation: 'fade',
			animationLoop: true,
			slideshow: true,
			slideshowSpeed: 7000,
			animationSpeed: 600,
			pauseOnAction: true,
			pauseOnHover: true,
			useCSS: false,
			manualControls: ''
			/*
			start: function(slider){},
			before: function(slider){},
			after: function(slider){},
			end: function(slider){},              
			added: function(){},            
			removed: function(){} 
			*/
		});
	});
	
	// Add video on thumb click
	jQuery('.post_thumb .post_video_play').each(function () {
		"use strict";
		if (jQuery(this).hasClass('inited')) return;
		jQuery(this).addClass('inited').click(function (e) {
			"use strict";
			var video = jQuery(this).parent().data('video');
			if (video!=='') {
				jQuery(this).parent().empty().html(video);
			}
			e.preventDefault();
			return false;
		});
	});

	// ---------- Puzzles Animations setup: mousemove events for hover slider --------
	if (THEMEREX_puzzlesAnimations && jQuery('.puzzles_animations .post_thumb .post_content_wrapper').length > 0) {
		jQuery('.puzzles_animations .post_thumb').each(function () {
			"use strict";
			if (jQuery(this).hasClass('inited')) return;
			jQuery(this).addClass('inited').mousemove(function (e) {
				"use strict";
				var offset = jQuery(this).offset();
				var x = e.pageX - offset.left;
				var y = e.pageY - offset.top;
				var thumb = jQuery(this);
				var delta = thumb.height()/7;
				if (thumb.hasClass('down-1') || thumb.hasClass('down-2') || thumb.hasClass('down-3') || thumb.hasClass('down-4')) {
					thumb.toggleClass('open_thumb', y < delta).toggleClass('open_content', y > thumb.height() - delta);
				} else if (thumb.hasClass('left-1') || thumb.hasClass('left-2')) {
					thumb.toggleClass('open_thumb', x > thumb.height() - delta).toggleClass('open_content', x < delta);
				} else if (thumb.hasClass('right-1') || thumb.hasClass('right-2')) {
					thumb.toggleClass('open_thumb', x < delta).toggleClass('open_content', x > thumb.width() - delta);
				}
			});
		});
	}	
}

/* Show/Hide "to Top" button */
function showToTop() {
	"use strict";
	var s = jQuery(this).scrollTop();
	if (s >= 110) {
		jQuery('#toTop').show();
	} else {
		jQuery('#toTop').hide();	
	}
}

/* Infinite Scroll */
function infiniteScroll() {
	var v = jQuery('#viewmore.pagination_infinite').offset();
	if (jQuery(this).scrollTop() + jQuery(this).height() + 100 >= v.top && !THEMEREX_viewmore_busy) {
		jQuery('#viewmore_link').eq(0).trigger('click');
	}
}