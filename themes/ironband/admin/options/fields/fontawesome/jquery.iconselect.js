jQuery(function () {
	jQuery('.iconselect').iconselect();
});

/*!
 * jQuery.iconselect - An icon selector for the Icon Awesome collection
 * Based on Tom Moor's IconSelect, http://tommoor.com
 * MIT Licensed
 * Modified by Keith Miyake to include a reset button
 * @version 0.1.1
*/

(function($){

	$.fn.iconselect = function(options) {

		var __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };

		var _icons = ["adjust", "align-center", "align-justify", "align-left", "align-right", "ambulance", "angle-down", "angle-left", "angle-right", "angle-up", "arrow-down", "arrow-left", "arrow-right", "arrow-up", "asterisk", "backward", "ban-circle", "bar-chart", "barcode", "beaker", "beer", "bell", "bell-alt", "bold", "bolt", "book", "bookmark", "bookmark-empty", "briefcase", "building", "bullhorn", "calendar", "calendar-empty", "camera", "camera-retro", "caret-down", "caret-left", "caret-right", "caret-up", "certificate", "check", "check-empty", "chevron-down", "chevron-left", "chevron-right", "chevron-up", "circle", "circle-arrow-down", "circle-arrow-left", "circle-arrow-right", "circle-arrow-up", "circle-blank", "cloud", "cloud-download", "cloud-upload", "code", "code-fork", "coffee", "cog", "cogs", "collapse-alt", "columns", "comment", "comment-alt", "comments", "comments-alt", "copy", "credit-card", "crop", "cut", "dashboard", "desktop", "double-angle-down", "double-angle-left", "double-angle-right", "double-angle-up", "download", "download-alt", "edit", "eject", "envelope", "envelope-alt", "eraser", "exchange", "exclamation", "exclamation-sign", "expand-alt", "external-link", "eye-close", "eye-open", "facebook", "facebook-sign", "facetime-video", "fast-backward", "fast-forward", "fighter-jet", "file", "file-alt", "film", "filter", "fire", "fire-extinguisher", "flag", "flag-alt", "flag-checkered", "folder-close", "folder-close-alt", "folder-open", "folder-open-alt", "font", "food", "forward", "frown", "fullscreen", "gamepad", "gift", "github", "github-alt", "github-sign", "glass", "globe", "google-plus", "google-plus-sign", "group", "h-sign", "hand-down", "hand-left", "hand-right", "hand-up", "hdd", "headphones", "heart", "heart-empty", "home", "hospital", "inbox", "indent-left", "indent-right", "info", "info-sign", "italic", "key", "keyboard", "laptop", "leaf", "legal", "lemon", "lightbulb", "link", "linkedin", "linkedin-sign", "list", "list-alt", "list-ol", "list-ul", "location-arrow", "lock", "magic", "magnet", "mail-reply-all", "map-marker", "maxcdn", "medkit", "meh", "microphone", "microphone-off", "minus", "minus-sign", "mobile-phone", "money", "move", "music", "off", "ok", "ok-circle", "ok-sign", "paper-clip", "paste", "pause", "pencil", "phone", "phone-sign", "picture", "pinterest", "pinterest-sign", "plane", "play", "play-circle", "plus", "plus-sign", "plus-sign-alt", "print", "pushpin", "puzzle-piece", "qrcode", "question", "question-sign", "quote-left", "quote-right", "random", "refresh", "remove", "remove-circle", "remove-sign", "reorder", "repeat", "reply", "reply-all", "resize-full", "resize-horizontal", "resize-small", "resize-vertical", "retweet", "road", "rocket", "rss", "save", "screenshot", "search", "share", "share-alt", "shield", "shopping-cart", "sign-blank", "signal", "signin", "signout", "sitemap", "smile", "sort", "sort-down", "sort-up", "spinner", "star", "star-empty", "star-half", "star-half-empty", "step-backward", "step-forward", "stethoscope", "stop", "strikethrough", "subscript", "suitcase", "superscript", "table", "tablet", "tag", "tags", "tasks", "terminal", "text-height", "text-width", "th", "th-large", "th-list", "thumbs-down", "thumbs-up", "time", "tint", "trash", "trophy", "truck", "twitter", "twitter-sign", "umbrella", "underline", "undo", "unlink", "unlock", "upload", "upload-alt", "user", "user-md", "volume-down", "volume-off", "volume-up", "warning-sign", "wrench", "zoom-in", "zoom-out"];;

		var settings = $.extend({
			style:       'redux-icon-select',
			placeholder: 'Select an icon',
			resettext:   'Reset',
			// lookahead:   6,
			icons:       _icons/*,
			fetch:       false,
			combine:     false*/
		}, options);

		var Iconselect = (function(){

			function Iconselect(original, o){
				this.$original = $(original);
				this.options = o;
				this.active = false;
				this.setupHtml();
				this.setupIcons();
				/*if (this.options.fetch) {
					this.fetchIcons();
				}*/
			}
/*
			Iconselect.prototype.fetchIcons = function () {
				var iconselect = this;
				var url = this.options.apiUrl;
				if (this.options.apiKey) {
					url = url + '?key=' + this.options.apiKey;
				}
				$.ajax({
					url: url,
					dataType: 'jsonp',
					success: function(data) {
						if (data.items && data.items.length > 0) {
							iconselect.options.icons = [];
							$.each(data.items, function(key, icon) {
							//TO-DO: add selectors for variants and subsets
								$.each(icon.variants, function(key, variant) {
									var family = icon.family.replace(/ /g, '+');
									if (icon.variants.length > 1 || (variant != 400 && variant != 'regular')) {
										family = family + ':' + variant;
									}
									iconselect.options.icons.push(family);
									//console.log('"'+family+'"');
								});
							});
						}
						iconselect.$drop.empty();
						iconselect.$results.empty();
						iconselect.$drop.append(iconselect.$results.append(iconselect.iconsAsHtml())).hide();
						$('li', iconselect.$results)
							.click(__bind(iconselect.selectIcon, iconselect))
							.mouseenter(__bind(iconselect.activateIcon, iconselect))
							.mouseleave(__bind(iconselect.deactivateIcon, iconselect));
					},
					error: function(xmlhttp) {
						// JSONP doesn't trigger any event if there's an error with the request
					}
				});
			}
*/
			Iconselect.prototype.setupIcons = function() {
				this.getVisibleIcons();
				this.bindEvents();

				var icon = this.$original.val();
				if (icon) {
					this.updateSelected();
					// this.addIconLink(icon);
				}
			}

			Iconselect.prototype.bindEvents = function(){

				$('li', this.$results)
				.click(__bind(this.selectIcon, this))
				.mouseenter(__bind(this.activateIcon, this))
				.mouseleave(__bind(this.deactivateIcon, this));

				$('span,i', this.$select).click(__bind(this.toggleDrop, this));
				this.$arrow.click(__bind(this.toggleDrop, this));
				this.$reset.click(__bind(this.resetSelected, this));
			};

			Iconselect.prototype.toggleDrop = function(ev){

				if(this.active){
					this.$element.removeClass('redux-icon-select-active');
					this.$top = this.$results.scrollTop();
					this.$drop.hide();
					clearInterval(this.visibleInterval);

				} else {
					this.$element.addClass('redux-icon-select-active');
					this.$drop.show();
					this.$results.scrollTop(this.$top);
					this.moveToSelected();
					this.visibleInterval = setInterval(__bind(this.getVisibleIcons, this), 500);
				}

				this.active = !this.active;
			};

			Iconselect.prototype.selectIcon = function(){

				var icon = $('li.active', this.$results).data('value');
				this.$original.val(icon).change();
				this.updateSelected();
				this.toggleDrop();
			};

			Iconselect.prototype.moveToSelected = function(){

				var $li, icon = this.$original.val();

				if (icon) {
					$li = $("li[data-value='"+ icon +"']", this.$results);
				} else {
					$li = $("li", this.$results).first();
				}

				if (!$li.hasClass('active')) {
					this.$results.scrollTop(0);
					this.$results.scrollTop($li.addClass('active').position().top);
				}
			};

			Iconselect.prototype.activateIcon = function(ev){
				$('li.active', this.$results).removeClass('active');
				$(ev.currentTarget).addClass('active');
			};

			Iconselect.prototype.deactivateIcon = function(ev){

				$(ev.currentTarget).removeClass('active');
			};

			Iconselect.prototype.updateSelected = function(){

				var icon = this.$original.val();
				$('span', this.$select).text( this.toReadable(icon) );
				$('i', this.$select).removeClass().addClass( this.toIcon(icon) );
			};

			Iconselect.prototype.resetSelected = function(ev){

				this.$original.val('').change();
				$('span', this.$select).text(this.options.placeholder);
				$('i', this.$select).removeClass();
			};

			Iconselect.prototype.setupHtml = function(){

				this.$original.empty().hide();
				this.$element = $('<div>', {'class': this.options.style});
				this.$arrow = $('<div><b></b></div>');
				this.$select = $('<a><i></i><span>'+ this.options.placeholder +'</span></a>');
				this.$drop = $('<div>', {'class': 'fs-drop'});
				this.$results = $('<ul>', {'class': 'fs-results'});
				this.$reset = $('<input type="button" class="'+ this.options.style +' fs-reset button" value="'+ this.options.resettext +'" />');
				this.$original.after(this.$element.append(this.$select.append(this.$arrow)).append(this.$drop));
				this.$reset.insertAfter(this.$element);
				this.$drop.append(this.$results.append(this.iconsAsHtml())).hide();
			};

			Iconselect.prototype.iconsAsHtml = function(){

				var icons = this.options.icons;
				var l = icons.length;

				var r, s, h = '';

				for ( var i = 0; i < l; i++ ) {
					r = this.toReadable(icons[i]);
					s = this.toIcon(icons[i]);
					h += '<li data-value="'+ icons[i] +'"><i class="'+ s +'"></i> '+ r +'</li>';
				}

				return h;
			};

			Iconselect.prototype.toReadable = function(icon){
				return icon;
			};

			Iconselect.prototype.toIcon = function(icon){

				return 'icon-' + icon;
			};

			Iconselect.prototype.getVisibleIcons = function(){
/*
				if(this.$results.is(':hidden')) return;

				var is = this;
				var top = this.$results.scrollTop();
				var bottom = top + this.$results.height();

				if(this.options.lookahead){
					var li = $('li', this.$results).first().height();
					bottom += li*this.options.lookahead;
				}

				$('li', this.$results).each(function(){

					var ft = $(this).position().top+top;
					var fb = ft + $(this).height();

					if ((fb >= top) && (ft <= bottom)){
						var icon = $(this).data('value');
						is.addIconLink(icon);
					}

				});
*/
			};

			return Iconselect;
		})();

		return this.each(function() {
			return new Iconselect(this, settings);
		});

	};
})(jQuery);
