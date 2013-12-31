jQuery(document).ready(function() {
	
	jQuery('.main-navigation  div > ul').on('click', function() {
		jQuery(this).toggleClass('mtc');
	});
	
	function singleImgSize() {
		var singleBox		 = jQuery('#primary .left.sidebar .single-img'),
			thirdRatio       = singleBox.find('img').width() / singleBox.find('img').height(),
			windowHeight     = jQuery(window).height();

		singleBox.css({'height':windowHeight-106});
		if( (singleBox.width() / singleBox.height()) < thirdRatio ) { singleBox.find('img').css({'width':'auto','height':'100%'}); } else { singleBox.find('img').css({'width':'100%','height':'auto'}); }
	};
	
	function fixedImgSize() {
		var fixedBox		 = jQuery('#primary .left.fixed.sidebar .single-img'),
			thirdRatio       = fixedBox.find('img').width() / fixedBox.find('img').height(),
			windowHeight     = jQuery(window).height();

		fixedBox.css({'height':windowHeight});
		if( (fixedBox.width() / fixedBox.height()) < thirdRatio ) { fixedBox.find('img').css({'width':'auto','height':'100%'}); } else { fixedBox.find('img').css({'width':'100%','height':'auto'}); }
	};

	jQuery(window).resize(function() {
		singleImgSize();
		fixedImgSize();
	});

	jQuery('.bsm > li').hover(
		function(){ jQuery('.social-menu').fadeIn(); },
		function(){ jQuery('.social-menu').fadeOut(); }
	);
	
	jQuery('#page').niceScroll();
	
	jQuery('.rom > li').hover(
		function(){ jQuery('.reading-options-menu').fadeIn(); },
		function(){ jQuery('.reading-options-menu').fadeOut(); }
	);
	
	/* Homepage Slider */
	(function() {
		var location = 0,
			lis      = jQuery('#slider img'),
			length   = lis.length - 1;

		jQuery("#slider img:gt(0)").hide();
		jQuery('#slider-nav li').on('click', function() {
			var direction = jQuery(this).data('nav');
				
			( direction === 'next' ) ? ++location : --location;
			if ( location < 0 ) location = length; else if ( location > length ) location = 0;
			
			lis.fadeOut(100).eq(location).fadeIn(1000);
		});
	})(jQuery);

	/* Homepage Resize */
	jQuery(window).resize(function() {
	
		(function menuBhv() {
			var masthead        = jQuery('#masthead'),
				scont           = jQuery('.site-content'),
				mnav			= jQuery('.main-navigation ul'),
				sbrand			= jQuery('.site-branding img'),
				sdesc			= jQuery('.site-branding .site-description');
			
			jQuery(window).scroll(function() {
				if(jQuery(window).width() > 768 && jQuery(window).scrollTop() > 50) {
					masthead.addClass('mhshr');
					scont.addClass('scpts');
					mnav.addClass('mnuls');
					sbrand.addClass('sbims');
					sdesc.addClass('sdescs');
				} else if (jQuery(window).width() < 768 || jQuery(window).scrollTop() < 50) {
					masthead.removeClass('mhshr');
					scont.removeClass('scpts');
					mnav.removeClass('mnuls');
					sbrand.removeClass('sbims');
					sdesc.removeClass('sdescs');
				}
			});
		})();
		
		
	
		function siteSizes() {
			var $boxOne          = jQuery('.post-box.special, .post-box.special #slider'),
				$boxTwo          = jQuery('.post-box.half-wide'),
				$boxThree        = jQuery('.post-box.half'),
				$oneRatio        = $boxOne.find('img').width() / $boxOne.find('img').height(),
				$twoRatio        = $boxTwo.find('img').width() / $boxTwo.find('img').height(),
				$threeRatio      = $boxThree.find('img').width() / $boxThree.find('img').height(),
				theWindow        = jQuery(window),
				windowHeight     = theWindow.height(),
				windowWidthWide  = Math.floor(theWindow.width() / 2),
				windowWidthBoxed = Math.floor(theWindow.width() / 4);

			if(jQuery(window).width() > 568 ) {
				$boxOne.css({'height':windowHeight-106, 'width':windowWidthWide});
				$boxTwo.css({'height':(windowHeight-106)/2, 'width':windowWidthWide});
				$boxThree.css({'height':(windowHeight-106)/2, 'width':windowWidthBoxed});
			} else {
				$boxOne.css({'height':'568px', 'width':'100%'});
				$boxTwo.css({'height':'334px', 'width':'100%'});
				$boxThree.css({'height':'334px', 'width':'100%'});
			}
			if(($boxOne.width() / $boxOne.height()) < $oneRatio ) { $boxOne.find('img').css({'width':'auto','height':'100%'}); } else { $boxOne.find('img').css({'width':'100%','height':'auto'}); };
			if(($boxTwo.width() / $boxTwo.height()) < $twoRatio ) { $boxTwo.find('img').css({'width':'auto','height':'100%'}); } else { $boxTwo.find('img').css({'width':'100%','height':'auto'}); };
			if(($boxThree.width() / $boxThree.height()) < $threeRatio ) { $boxThree.find('img').css({'width':'auto','height':'100%'}); } else { $boxThree.find('img').css({'width':'100%','height':'auto'}); };
		};
		
		siteSizes();
		
		jQuery('.content-area.index').infinitescroll({
		  navSelector  : '#npl a:last',
		  nextSelector : '#npl a:last',
		  itemSelector : '.post-box',
		  loading      : {
			  finishedMsg : 'No more pages to load.',
			  img         : 'http://i.imgur.com/qkKy8.gif'
			}
		  },
		  function() {
		    siteSizes();
		  }
		);

	}).trigger('resize');
	
	jQuery('.gal-container').infinitescroll({
	  navSelector  : '#npl a:last',
	  nextSelector : '#npl a:last',
	  itemSelector : '.gal-item',
	  loading      : {
		  finishedMsg : 'No more pages to load.',
		  img         : 'http://i.imgur.com/qkKy8.gif'
	    }
	  },
	  function() {
		galEffect();
	  }
	);

	/* jQuery(window).resize(function() {
		var gallery    = jQuery('#gallery'),
			galWidth   = gallery.width(),
			imgWidth   = Math.floor(galWidth - 122) / 5;
			
		gallery.find('img').css({'width':imgWidth,'height':imgWidth});
	}).trigger('resize');*/
	
	if(jQuery.support.fullscreen){
		jQuery('.fullscreen').on('click', function(e){

			jQuery('.right-content').fullScreen();
			return false;

		});
	}
	
	jQuery('a.black').on('click', function(){
		jQuery('.post-single').addClass('bbg');
	});
	jQuery('a.white').on('click', function(){
		jQuery('.post-single').removeClass('bbg');
	});
	
	jQuery(function() {
		jQuery( "#font-slider" ).slider({
			value : 1,
			min : 13,
			max : 23,
			step : 1,
			slide: function( event, ui ) {
                jQuery( ".right-content p" ).css({'line-height':'1.55','font-size':ui.value});
				// $( "#slider-value" ).html( ui.value );
            }
		});
	});
	
	function galEffect() {
		jQuery('#gallery a').hover(
			function() {
				jQuery(this).siblings('a').children('img').stop().addClass('gray').animate({'opacity': 0.5}, 1000);
				jQuery(this).children('img').stop().animate({'opacity': 1});
			},
			function () {
				jQuery(this).siblings('a').children('img').stop().removeClass('gray').animate({'opacity': 1}, 1000);
			}
		);
	};
	
	galEffect();
	
	/*----------------------------------------------------*/
	/*	Isotope Portfolio Filter
	/*----------------------------------------------------*/

	jQuery(window).load(function(){
		jQuery('#portfolio-wrapper').isotope({
			itemSelector : '.portfolio-item',
			layoutMode : 'fitRows'
		});
			
		jQuery('#filters a.selected').trigger("click");
	});

	jQuery('#filters a').click(function(e){
		e.preventDefault();

		var selector = jQuery(this).attr('data-option-value');
		jQuery('#portfolio-wrapper').isotope({ filter: selector });

		jQuery(this).parents('ul').find('a').removeClass('selected');
		jQuery(this).addClass('selected');
	});
	
	/* Portfolio color/bw */
	jQuery('#portfolio li').hover(
		function() {
			jQuery(this).siblings('li').children('img').stop().addClass('gray').animate({'opacity': 0.5}, 1000);
			jQuery(this).children('img').stop().animate({'opacity': 1});
		},
		function () {
			jQuery(this).siblings('li').children('img').stop().removeClass('gray').animate({'opacity': 1}, 1000);
		}
	);
	
	/* FancyBox */
	jQuery('.fancybox').fancybox();

});