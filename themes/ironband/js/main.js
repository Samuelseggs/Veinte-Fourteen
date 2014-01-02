var iron_vars = window.iron_vars || {}
,   IronBand = window.IronBand || {};

(function($){
	"use strict";

	IronBand.$ = window.IronBand.$ || {};

	IronBand.XHR = {
		settings: {
			  url  : iron_vars.ajaxurl
			, type : 'POST'
		}
	};

	var jcf = window.jcf || {};
	var DocumentTouch = window.DocumentTouch || {};
	var ResponsiveHelper = window.ResponsiveHelper || {};
	var jPlayerPlaylist = window.jPlayerPlaylist || {};
	var PlaceholderInput = window.PlaceholderInput || {};
	var TouchNav = window.TouchNav || {};
	var lib = window.lib || {};

	// page init
	jQuery(function(){
		IronBand.initNavigationSelect();
		jcf.customForms.replaceAll();
		IronBand.initTouchNav();
		IronBand.initAccordion();
		IronBand.initPopups();
		IronBand.initInputs();
		IronBand.initFitVids();
		IronBand.initDropDownClasses();
		IronBand.initPlayer();
		IronBand.initAjaxBlocksLoad();
		IronBand.initSliderRevolution();
		IronBand.initLightbox();
		IronBand.initAnchorGigs();
		IronBand.initLayout();
		IronBand.initQuicksand();
		IronBand.initNewsLetter();
		IronBand.initFacebookLikebox();
		IronBand.initTwitter();

		if(iron_vars.enable_fixed_header)
			IronBand.initFixedBar();

		if(iron_vars.enable_nice_scroll)
			IronBand.initNiceScroll();

		/* Fancybox overlay fix */
		// detect device type
		var isTouchDevice = (function() {
			try {
				return ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch;
			} catch (e) {
				return false;
			}
		}());

		// fix options
		var supportPositionFixed = !( (jQuery.browser.msie && jQuery.browser.version < 8) || isTouchDevice );
		var overlaySelector = '#fancybox-overlay';

		if(supportPositionFixed) {
			// create <style> rules
			var head = document.getElementsByTagName('head')[0],
				style = document.createElement('style'),
				rules = document.createTextNode(overlaySelector+'{'+
					'position:fixed;'+
					'top:0;'+
					'left:0;'+
				'}');

			// append style element
			style.type = 'text/css';
			if(style.styleSheet) {
				style.styleSheet.cssText = rules.nodeValue;
			} else {
				style.appendChild(rules);
			}
			head.appendChild(style);
		}
	});

	jQuery(window).load(function(){
		setTimeout(function(){
			IronBand.initSameHeight();
			jQuery(window).trigger('resize');
		}, 200);
	});

	IronBand.pagination = {
		  XHR: {}
		, $: {}
		, loadingClass: 'ajax-load'
		, ajaxBusy: false
	};

	IronBand.pagination.XHR = {
		done: function ( response, status, xhr ) { // success : data, status, xhr

			var IB = IronBand.pagination;

			if ( response/* && response.output != ''*/ )
			{
				IB.$.container.append(response/*.output*/).fadeIn();

				if ( IB.$.container.find('#no-more-posts').length > 0 )
				{
					$('#no-more-posts').remove();
					IB.$.loadButton.remove();

				} else {
					IB.$.loadButton.data('page', IB.XHR.temp.data.page + 1);
				}

				IB.ajaxBusy = false;

				IronBand.initTouchNav();

				var callbacks = IB.$.loadButton.data('callback');
				if ( callbacks ) {
					callbacks = callbacks.split(',');

					for ( var i = 0 ; i < callbacks.length ; i++ )
					{
						var callback = IronBand[callbacks[i]];

						if ( typeof callback === 'function' ) {
							callback();
						}
					}
				}

				if ( IB.method == 'paginate_scroll' ) {

					$(window).on('scroll', function ( event ) {
						if ( ! IB.ajaxBusy ) {
							var $win = $(window)
							,   $doc = $(document)
							,   $foot = $('body > footer');

							if ( $win.scrollTop() >= ($doc.height() - $win.height() - ( $foot.height() ) ) ) {
								IB.$.loadButton.click();
							}
						}
					});

				} else {
					IB.$.loadButton.css('visibility', 'visible').fadeIn();
				}

			} else {

				IB.$.loadButton.remove();
				IB.XHR.fail( xhr, 'error', 404 );
			}
		}
		, fail: function ( xhr, status, error ) { // error : xhr, status, error

			var IB = IronBand.pagination;

			setTimeout(function() {
				alert( IB.$.loadButton.data('warning') );
			}, 100);
		}
		, always: function () { // complete : data|xhr, status, xhr|error

			var IB = IronBand.pagination;
			IB.$.loadButton.prop('disabled', false);

			IB.$.container.removeClass(IB.loadingClass);

			if ( iron_vars.enable_nice_scroll && !jcf.isTouchDevice )
				IronBand.niceScroll.resize();
		}
		, before: function ( xhr ) {

			var IB = IronBand.pagination;
			IB.$.loadButton.prop('disabled', true);
		}
	};

	IronBand.initAnchorGigs = function () {
		jQuery('ul.concerts-list .open-link').each(function(){
			var opener = jQuery(this);
			if(window.location.href.indexOf(opener.attr('id')) > 0) {
				jQuery(window).scrollTop(opener.offset().top - 100);
				opener.trigger('click');
			}
		});
	}

	IronBand.initLayout = function () {
		var visibleElements;
		ResponsiveHelper.addRange({
			'..767': {
				on: function(){
					visibleElements = 1;
					IronBand.initCarousel(visibleElements, true);
					IronBand.initCarousel(visibleElements, false);
				},
				off: function(){
					IronBand.initCarousel(visibleElements, true);
				}
			},
			'768..': {
				on: function(){
					visibleElements = 3;
					IronBand.initCarousel(visibleElements, true);
					IronBand.initCarousel(visibleElements, false);
				},
				off: function(){
					IronBand.initCarousel(visibleElements, true);
				}
			}
		});
	}

	IronBand.initSliderRevolution = function () {
		IronBand.$.marquee = jQuery('#home-marquee');

		if ( jQuery.fn.cssOriginal != undefined )
			jQuery.fn.css = jQuery.fn.cssOriginal;

		IronBand.$.marquee
			.revolution({
				  delay            : 5000
				, startheight      : 500
				, startwidth       : 1144

				, navigationType   : 'none'	// bullet, thumb, none
				, navigationArrows : 'none'	// nexttobullets, solo (old name verticalcentered), none

				, touchenabled     : 'on'	// Enable Swipe Function : on/off
				, onHoverStop      : 'on'	// Stop Banner Timet at Hover on Slide on/off

				, stopAtSlide      : -1
				, stopAfterLoops   : -1

				, shadow           : 1		//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
				, fullWidth        : 'on'	// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
			})
			.bind('revolution.slide.onloaded',function () {
				// jQuery('.marquee').css('height', 'inherit');

				// Put caption text on 2 lines
				jQuery('.slide .caption h1').each(function() {
					var $this = jQuery(this)
					,   text  = $this.text()
					,   words = text.split(' ')
					,   half  = Math.ceil(words.length / 2)
					,   line1 = ''
					,   line2 = ''
					,   i;

					for ( i = 0; i < half; i++ )
					{
						line1 += words[i];
						if ( i < half - 1 ) {
							line1 += ' ';
						}
					}

					for ( i = half; i < words.length; i++ )
					{
						line2 += words[i];
						if ( i < words.length - 1 ) {
							line2 += ' ';
						}
					}

					var html = '';

					if ( line1 !== '' ) {
						html += '<span>' + line1 + '</span>';
					}

					if ( line2 !== '' ) {
						html += '<span>' + line2 + '</span>';
					}

					$this.html(html);
				});
		});
	}

	IronBand.initFacebookLikebox = function () {
		if($('#fb-likebox').length === 0) {
			return false;
		}

		var fb_app_id = $('#fb-likebox').data('appid');
		var fb_page_url = $('#fb-likebox').data('pageurl');
		fb_page_url = encodeURI(fb_page_url);

		var iframe = '<iframe src="//www.facebook.com/plugins/likebox.php?href='+fb_page_url+'&amp;width=200&amp;height=62&amp;show_faces=false&amp;colorscheme=dark&amp;stream=false&amp;border_color&amp;header=false&amp;appId='+fb_app_id+'" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:200px; height:62px;" allowTransparency="true"></iframe>';

		$('#fb-likebox').html(iframe);
	}


	IronBand.initTwitter = function () {
		if($('#twitter').length === 0) {
			return false;
		}

		var username = $('#twitter').data('username');

		jQuery(function($){
			$('#twitter').tweet({
				modpath: iron_vars.theme_url+'/js/twitter/',
				join_text: 'auto',
				username: (username ? username : 'envato'),
				count: 1,
				auto_join_text_default: '',
				auto_join_text_ed: '',
				auto_join_text_ing: '',
				auto_join_text_reply: '',
				auto_join_text_url: '',
				loading_text: 'loading tweets...'
			}).bind('loaded', function() {
				jQuery(window).resize();
			});
		});
	}

	IronBand.initNiceScroll = function () {
		$(document).ready(function() {
			IronBand.niceScroll = $('html').niceScroll();
		});
	}

	// init circular slider
	IronBand.initCarousel = function (visibleElements, destroy) {
		//	Responsive layout, resizing the items
		jQuery('.carousel').each(function(){
			var set = jQuery(this);
			if(destroy){
				set.find('.slideset').trigger('destroy');
			}
			else {
				set.find('.slideset').carouFredSel({
					circular: true,
					responsive: true,
					width: '100%',
					scroll: 1,
					auto: false,
					prev: {
						button: set.find('.btn-prev')
					},
					next: {
						button: set.find('.btn-next')
					},
					items: {
						visible: visibleElements,
						height: 'variable'
					}
				});
			}
		});
	}

	IronBand.initFixedBar = function () {
		var win = jQuery(window);
		var animSpeed = 500;
		var activeClass = 'fixed-bar';
		var clone;
		jQuery('.panel').each(function(){
			var panel = jQuery(this);
			function getPosition(){
				var offset = jQuery('#header').outerHeight(true);
				if(win.scrollTop() > offset) {
					if(!clone) {
						clone = true;
						var panelHeight = panel.outerHeight();
						clone = panel.clone( true, true );
						clone.insertAfter(panel).addClass(activeClass).css({
							'opacity': 0,
							'marginTop': -panelHeight
						}).animate({
							'opacity': 1,
							'marginTop': 0
						}, {
							duration: animSpeed,
							queue: false
						});
						IronBand.initTouchNav();
					}
				}
				else {
					if (clone) {
						clone.remove();
						clone = false;
					}
				}
			}
			getPosition();
			win.bind('scroll resize', getPosition);
		});
	}

	IronBand.initAjaxBlocksLoad = function () {

		IronBand.pagination.XHR.request = {
			  dataType: 'text'
			, data: {
				  action: 'iron_get_ajax_content'
			}
			, beforeSend: IronBand.pagination.XHR.before
		};

		IronBand.pagination.XHR.request = $.extend(true, IronBand.pagination.XHR.request, IronBand.XHR.settings );

		$(document).on('click', 'a.button-more', function (e) {
			e.preventDefault();

			var IB = IronBand.pagination
			,   $this = $(this);

			if ( IB.ajaxBusy )
				return;

			IB.$.loadButton = $this;
			IB.$.container  = $('#' + IB.$.loadButton.data('rel'));

			IB.XHR.temp = $.extend(true, {
				data: {
					template: $this.data('template'),
					type: $this.data('type'),
					page: $this.data('page'),
					tax: $this.data('taxonomy'),
					term: $this.data('term'),
					active: $this.data('active')
				}
			}, IB.XHR.request);

			IB.method = $this.data('paginate');

			$.ajax( IB.XHR.temp )
			 .done( IB.XHR.done )
			 .fail( IB.XHR.fail )
			 .always( IB.XHR.always );
		});

		$('a.button-more').trigger('click');

/*
		jQuery('a.button-more').hide().on('click', function(e){
			e.preventDefault();

			var opener = jQuery(this);
			var template = opener.data('template');
			var post_type = opener.data('type');
			// var caption = opener.data('caption');
			var page = opener.data('page');
			var taxonomy = opener.data('taxonomy');
			var term = opener.data('term');
			var active = opener.data('active');
			var paginate_method = opener.data('paginate');

			var container = jQuery('#' + opener.data('rel'));
			var loadingClass = 'ajax-load';
			var ajaxBusy;

			if(container.length && post_type !== ''){
				if(!ajaxBusy) {
					// load external content
					ajaxBusy = true;
					container.addClass(loadingClass);

					jQuery.ajax({
						url: iron_vars.ajaxurl,
						type:'post',
						data: {
							action: 'iron_get_ajax_content',
							template: template,
							type: post_type,
							page: page,
							tax: taxonomy,
							term: term,
							active: active
						},
						dataType:'text',
						success:function(msg) {

							if(msg !== '') {
								$(container).append(msg).fadeIn();

								if($(container).find('#no-more-posts').length > 0) {

									$('#no-more-posts').remove();
									opener.remove();

								}else{
									opener.data('page', page+1);
								}

								ajaxBusy = false;

								IronBand.initTouchNav();

								var callbacks = opener.data('callback');
								if(callbacks) {
									callbacks = callbacks.split(',');

									for(var i = 0 ; i < callbacks.length ; i++) {
										var callback = IronBand[callbacks[i]];

										if(typeof callback === 'function') {
											callback();
										}
									}
								}

								if(paginate_method == 'paginate_scroll') {

									$(window).on('scroll', function ( event ) {
										opener = jQuery('a.button-more');
										if ( ! ajaxBusy ) {
											var $win = $(window)
											,   $doc = $(document)
											,   $foot = $('body > footer');

											if ( $win.scrollTop() >= ($doc.height() - $win.height() - ( $foot.height() ) ) ) {
												opener.click();
											}
										}
									});

								}else{
									opener.css('visibility', 'visible').fadeIn();
								}

							}else{
								opener.remove();
							}

							container.removeClass(loadingClass);

							if(iron_vars.enable_nice_scroll && !jcf.isTouchDevice)
								IronBand.niceScroll.resize();

						},
						error:function() {
							//alert('AJAX Error!');
						}
					});
				}
			}
		}).click();
*/
	}

	// add classes if item has dropdown
	IronBand.initDropDownClasses = function () {
		jQuery('#nav li').each(function() {
			var item = jQuery(this);
			var drop = item.find('ul');
			var link = item.find('a').eq(0);
			if(drop.length) {
				item.addClass('has-drop-down');
				if(link.length) { link.addClass('has-drop-down-a'); }
			}
		});
	}

	IronBand.initPlayer = function () {
		jQuery('.player-holder').each(function(ind){
			var set = jQuery(this);
			var dataUrl = set.attr('data-url-playlist');
			var posterImage = set.find('.poster-image');
			var defURl = posterImage.attr('src');
			var titleBox = set.find('.player-title-box');
			var player = set.find('.jp-jplayer');
			var playerBox = set.find('.player-box');
			var uiPlayer = 'jplayer-custom-' + new Date().getMilliseconds() + ind;
			var uiPlayerBox = 'jplayerBox-custom-' + new Date().getMilliseconds() + ind;
			var Playlist = {};

			player.attr('id', uiPlayer);
			playerBox.attr('id', uiPlayerBox);

			jQuery.ajax({
				url: dataUrl,
				type: 'get',
				dataType: 'script',
				success: function(){
					startPlayer();
				}
			});

			function startPlayer(){
				Playlist = new jPlayerPlaylist({
					jPlayer: '#' + uiPlayer,
					cssSelectorAncestor: '#' + uiPlayerBox
				}, musicPlayList || [], {
					swfPath: iron_vars.theme_url+'/js/',
					supplied: 'mp3',
					wmode: 'window',
					ready: function(){
						refreshInfo();
					},
					play: function(){
						refreshInfo();
					}
				});
			}

			function refreshInfo(){
				if ( Playlist.original.length )
				{
					if ( Playlist.original[Playlist.current].poster ) {
						posterImage.attr('src', Playlist.original[Playlist.current].poster);
					} else {
						posterImage.attr('src', defURl);
					}

					if ( Playlist.original[Playlist.current].title ) {
						titleBox.html(Playlist.original[Playlist.current].title);
					}
				}
			}
		});

		jQuery('.tracks-list li').each(function(ind){
			var set = jQuery(this);
			var player = set.find('.jp-jplayer');
			var playerBox = set.find('.player-box');
			var playBtn = set.find('.buttons .btn-play');
			// var pauseBtn = set.find('.buttons .btn-pause');
			var urlMedia = set.attr('data-media');
			var uiPlayer = 'jplayer-custom-' + new Date().getMilliseconds() + ind;
			var uiPlayerBox = 'jplayerBox-custom-' + new Date().getMilliseconds() + ind;
			player.attr('id', uiPlayer);
			playerBox.attr('id', uiPlayerBox);
			if(urlMedia){
				var urlTag = urlMedia.substr(urlMedia.lastIndexOf('.')+1);
				var obj = {};
				obj[urlTag] = urlMedia;
				jQuery('#' + uiPlayer).jPlayer({
					cssSelectorAncestor: '#' + uiPlayerBox,
					ready: function () {
						jQuery(this).jPlayer('setMedia', obj);
					},
					swfPath: 'js',
					supplied: urlTag,
					wmode: 'window'
				});

				var allPauseBtns = jQuery('.tracks-list li').not(set).find('.buttons .btn-pause');

				playBtn.click(function() {
					allPauseBtns.click();
				});
			}
		});
	}

	// handle flexible video size
	IronBand.initFitVids = function () {
		jQuery('.video-block').fitVids();
	}

	// accordion menu init
	IronBand.initAccordion = function () {
		jQuery('.concerts-list').slideAccordion({
			activeClass: 'expanded',
			opener: 'a.open-link',
			slider: 'div.slide',
			animSpeed: 300
		});
	}

	// popups init
	IronBand.initPopups = function () {
		jQuery('.panel').contentPopup({
			mode: 'click',
			popup: '.nav-holder',
			btnOpen: '.opener'
		});
	}

	// clear inputs on focus
	IronBand.initInputs = function () {
		PlaceholderInput.replaceByOptions({
			// filter options
			clearInputs: true,
			clearTextareas: true,
			clearPasswords: true,
			skipClass: 'default',

			// input options
			wrapWithElement: false,
			showUntilTyping: false,
			getParentByClass: false,
			placeholderAttr: 'value'
		});
	}

	// align blocks height
	IronBand.initSameHeight = function () {
		jQuery('.widget-blocks').sameHeight({
			elements: '.holder',
			flexible: true,
			multiLine: true
		});
		jQuery('.carousel').sameHeight({
			elements: '.concert-box, .text, .video-box',
			flexible: true,
			multiLine: true
		});
		jQuery('.articles-section').sameHeight({
			elements: '.text, .block a',
			flexible: true,
			multiLine: true
		});
	}

	// handle dropdowns on mobile devices
	IronBand.initTouchNav = function () {
		lib.each(lib.queryElementsBySelector('#nav'), function(){
			new TouchNav({
				navBlock: this
			});
		});
		lib.each(lib.queryElementsBySelector('.articles-section .article'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'div',
				menuOpener: 'a',
				menuDrop: ''
			});
		});
		lib.each(lib.queryElementsBySelector('.concerts-list li'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'div.title-row',
				menuOpener: 'a',
				menuDrop: ''
			});
		});
		lib.each(lib.queryElementsBySelector('.listing-section'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'a',
				menuOpener: 'a',
				menuDrop: ''
			});
		});
		lib.each(lib.queryElementsBySelector('.carousel'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'a',
				menuOpener: 'a',
				menuDrop: ''
			});
		});
		lib.each(lib.queryElementsBySelector('.carousel'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'a',
				menuOpener: 'a',
				menuDrop: 'div.hover-box'
			});
		});
		lib.each(lib.queryElementsBySelector('.article'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'a',
				menuOpener: 'a',
				menuDrop: ''
			});
		});
		lib.each(lib.queryElementsBySelector('.photos-list'), function(){
			new TouchNav({
				navBlock: this,
				menuItems: 'li',
				menuOpener: 'a',
				menuDrop: 'span.hover-text'
			});
		});
	}

	// generate select from navigation
	IronBand.initNavigationSelect = function () {
		jQuery('.filters-block .holder ul').navigationSelect({
			defaultOptionAttr: 'title',
			useDefaultOption: false
		});
	}


	IronBand.initQuicksand = function () {

		if ( $('#filter-type').length < 1 )
			return;

		var $filterType = $('#filter-type a')
		,   $collection = $('#filter-collection')
		,   $data = $collection.clone();		// Clone items to get a second collection

		// Attempt to call Quicksand on every filter click
		$(document).on('click', $filterType.selector, function (e) {
			e.preventDefault();

			var $this = $(this);

			$filterType.removeClass('active');
			$this.addClass('active');

			var $filteredData = $data.find( 'all' === $this.data('target') ? 'li' : 'li[class*="' + $this.data('target') + '"]' );

			console.log( 'li[class*="' + $this.data('target') + '"]', $filteredData );

			$collection.quicksand($filteredData, {
				  duration    : 600
				, useScaling  : true
				, adjustWidth : false
				, attribute   : 'id'
				, easing      : 'easeInOutQuad'
			},
			function () {
				IronBand.initLayout();
				IronBand.initTouchNav();
				IronBand.initLightbox();
				$(window).resize();
			});

		});

	}

	IronBand.initNewsLetter = function () {
		// init subscribe form
		$('.subscribe-block form').submit(function (event) {
			event.preventDefault();
			var form = $(this);
			var postData = form.serialize();
			var success = form.find('label');
			var status = form.find('.status');

			$.ajax({
				type: 'POST',
				url: iron_vars.ajaxurl,
				data: postData,
				success: function(data) {

					if (data === 'success') {
						form.find('.box').hide();
						success.html(iron_vars.lang.newsletter_success).slideDown();

					} else if (data === 'subscribed') {
						status.html(iron_vars.lang.newsletter_exists).slideDown();

					} else if (data === 'invalid') {
						status.html(iron_vars.lang.newsletter_invalid).slideDown();

					} else if (data === 'disabled') {
						status.html('The newsletter module is disabled. You can activate it from within the theme options').slideDown();

					} else if (data === 'missing_api_key') {
						status.html('Error: Missing Mailchimp API Key / List ID').slideDown();

					} else {
						status.html(iron_vars.lang.newsletter_error).slideDown();
					}

				},
				error: function () {
					status.html(iron_vars.lang.newsletter_error).slideDown();
				}
			});
		});
	}

	// fancybox modal popup init
	IronBand.initLightbox = function () {
		jQuery('a.lightbox, a[rel*="lightbox"]').fancybox({
			padding: 10,
			cyclic: false,
			overlayShow: true,
			overlayOpacity: 0.65,
			overlayColor: '#000000',
			titlePosition: 'inside'
		});
	}

})(jQuery);