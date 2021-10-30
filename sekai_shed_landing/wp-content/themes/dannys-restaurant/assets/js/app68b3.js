/*--------------------------------------------------------------------------------------------------

 File: app.js

 Description: This is the main javascript file for this theme
 Please be careful when editing this file

 --------------------------------------------------------------------------------------------------*/
(function ($) {
	$.ZnThemeJs = function () {
		this.scope = $(document);
		this.zinit();

		// Holds the product archive query args
		this.productQuerysConfig = [];
	};

	$.ZnThemeJs.prototype = {
		zinit : function() {
			var fw = this;

			fw.addActions();
			fw.initHelpers( $(document) );
			// EVENTS THAT CAN BE REFRESHED
			fw.refresh_events( $(document) );

			$(document).trigger( 'ZnThemeJsReady', this );
		},

		refresh_events : function( content ) {

			var fw = this;

			// General
			fw.general(content);
			fw.masonryLayout( content );
			fw.fitvids( content );
			fw.magnificPopup( content );

			fw.slick( content );
			fw.objfit(content);
			fw.toggle_class(content);
			fw.modal_section(content);

			// WooCommerce
			fw.woocommerce_stuff( content );
			fw.woocommerce_fancy_pagination( content );

			// Site Header
			fw.sticky_header(content);
			fw.nav_overlay(content);
		},

		RefreshOnWidthChange : function(content) {
		},

		addActions : function() {
			var fw = this;

			// Refresh events on new content
			fw.scope.on('ZnWidthChanged',function(e){
				fw.RefreshOnWidthChange(e.content);
				$(window).trigger('resize');
			});

			// Refresh events on new content
			fw.scope.on('ZnNewContent',function(e){
				fw.refresh_events( e.content );
			});

		},

		unbind_events : function( scope ){

		},

		initHelpers: function( scope ){

			/**
			 * Helper Functions
			 */
			var fw = this;
			this.helpers = {};

			this.helpers.IsJsonString = function (a) {
				try {
					JSON.parse(a);
				} catch (e) {
					return false;
				}
				return true;
			};

			this.helpers.is_null = function (a) {
				return (a === null);
			};
			this.helpers.is_undefined = function (a) {
				return (typeof a == 'undefined' || a === null || a === '' || a === 'undefined');
			};
			this.helpers.is_number = function (a) {
				return ((a instanceof Number || typeof a == 'number') && !isNaN(a));
			};
			this.helpers.is_true = function (a) {
				return (a === true || a === 'true');
			};
			this.helpers.is_false = function (a) {
				return (a === false || a === 'false');
			};
			this.helpers.throttle = function(func, wait, options) {
				var timeout, context, args, result;
				var previous = 0;
				if (!options) options = {};

				var later = function() {
					previous = options.leading === false ? 0 : fw.helpers.date_now;
					timeout = null;
					result = func.apply(context, args);
					if (!timeout) context = args = null;
				};

				var throttled = function() {
					var now = fw.helpers.date_now;
					if (!previous && options.leading === false) previous = now;
					var remaining = wait - (now - previous);
					context = this;
					args = arguments;
					if (remaining <= 0 || remaining > wait) {
						if (timeout) {
							clearTimeout(timeout);
							timeout = null;
						}
						previous = now;
						result = func.apply(context, args);
						if (!timeout) context = args = null;
					} else if (!timeout && options.trailing !== false) {
						timeout = setTimeout(later, remaining);
					}
					return result;
				};

				throttled.cancel = function() {
					clearTimeout(timeout);
					previous = 0;
					timeout = context = args = null;
				};

				return throttled;
			};

			// Returns a function, that, as long as it continues to be invoked, will not
			// be triggered. The function will be called after it stops being called for
			// N milliseconds. If `immediate` is passed, trigger the function on the
			// leading edge, instead of the trailing.
			this.helpers.debounce = function(func, wait, immediate) {
				var timeout;
				return function() {
					var context = this, args = arguments;
					var later = function() {
						timeout = null;
						if (!immediate) func.apply(context, args);
					};
					var callNow = immediate && !timeout;
					clearTimeout(timeout);
					timeout = setTimeout(later, wait);
					if (callNow) func.apply(context, args);
				};
			};

			this.helpers.isInViewport = function(element) {
				var rect = element.getBoundingClientRect();
				var html = document.documentElement;
				return (
					rect.top >= 0 &&
					rect.left >= 0 &&
					rect.bottom <= (window.innerHeight || html.clientHeight) &&
					rect.right <= (window.innerWidth || html.clientWidth)
				);
			};

			this.helpers.date_now = Date.now || function() {
				return new Date().getTime();
			};

			this.helpers.hasTouch 			= ( typeof Modernizr == 'object' && Modernizr.touchevents) || false;
			this.helpers.hasTouchMobile 	= this.helpers.hasTouch && window.matchMedia( "(max-width: 1024px)" ).matches;
			this.helpers.ua 				= navigator.userAgent || '';
			this.helpers.is_mobile_ie 		= -1 !== this.helpers.ua.indexOf("IEMobile");
			this.helpers.is_firefox 		= -1 !== this.helpers.ua.indexOf("Firefox");
			this.helpers.isAtLeastIE11 		= !!(this.helpers.ua.match(/Trident/) && !this.helpers.ua.match(/MSIE/));
			this.helpers.isIE11 			= !!(this.helpers.ua.match(/Trident/) && this.helpers.ua.match(/rv[ :]11/));
			this.helpers.isMac 				= /^Mac/.test(navigator.platform);
			this.helpers.is_safari 			= /^((?!chrome|android).)*safari/i.test(this.helpers.ua);
			this.helpers.isIE10 			= navigator.userAgent.match("MSIE 10");
			this.helpers.isIE9 				= navigator.userAgent.match("MSIE 9");
			this.helpers.is_EDGE 			= /Edge\/12./i.test(this.helpers.ua);
			this.helpers.is_pb 				= !this.helpers.is_undefined($.ZnPbFactory);

			var $body = $('body');
			if (this.helpers.is_EDGE) 		$body.addClass('is-edge');
			if (this.helpers.isIE11) 		$body.addClass('is-ie11');
			if (this.helpers.is_safari) 	$body.addClass('is-safari');

			this.helpers.nav_overlay__isActive = false;
		},

		general: function(scope) {

			var fw = this;

			// Fallback for IE's missing object-fit
			if (typeof Modernizr == 'object') {
				if ( ! Modernizr.objectfit ) {
					$.each(['cover', 'contain'], function(index, el) {
						$('.u-'+el+'-fit-img', scope).each(function () {
							var $container = $(this),
								imgUrl = $container.prop('src'),
								imgClasses = $container.prop('class');
							if (imgUrl) {
								$container.replaceWith('<div class="' + imgClasses + ' u-'+el+'-fit-img-fallback" style="background-image:url(' + imgUrl + ');"></div>');
							}
						});
					});
				}
			}

			// prevent tapping on # links to prevent page reloading
			if (fw.helpers.hasTouchMobile) {
				$('a[href="#"]').on('click', function(e){
					e.preventDefault();
				});
			}

		},

		masonryLayout: function(scope){
			var fw = this;

			scope.find( '.js-isMasonry' ).each(function(index, el) {

				var $el = $(el),
					masonryItem = '.js-masonryItem',
					$custom = fw.helpers.IsJsonString( $el.attr("data-dn-masonry") ) ? JSON.parse( $el.attr("data-dn-masonry") ) : {};

				// bail if less items than 2
				if( $(masonryItem, $el).length <= 2 ) return;

				var $opts = {
					itemSelector: masonryItem,
					initLayout: false,
				};

				if(!$.isEmptyObject($custom)){
					$.extend( $opts, $custom );
				}
				console.log( $el );
				$el.imagesLoaded(function(){
					var $grid = $el.masonry($opts);
					// bind event
					$grid.masonry( 'on', 'layoutComplete', function() {
						$el.addClass('masonry-active');
					});
					$grid.masonry();
				});
			});
		},

		fitvids : function ( scope ) {

			var element = scope.find('.zn_iframe_wrap, .zn_pb_wrapper, .do-fitvids');
			if (element.length === 0) { return; }
			element.fitVids({ ignore: '.no-fitvids'});
		},

		woocommerce_stuff: function(){

			var fw = this;

			$(window).on('added_to_cart',function (evt,ret) {

				if( ! fw.helpers.is_undefined( ret.zn_added_to_cart ) && ret.zn_added_to_cart.length > 0 ){
					var modal = $( ret.zn_added_to_cart );
					$('body').append(modal);

					// FadeOut and Close the modal after 5 seconds
					 setTimeout(function () {
						$(modal).fadeOut('fast', 'easeInOutExpo',function() {
							$(this).remove();
						});
					 }, 3000);

					$(modal).fadeIn('slow', 'easeInOutExpo',function() {
						modal.find( '.dn-addedToCart-close' ).click(function(e){
							e.preventDefault();
							$(modal).fadeOut('fast', 'easeInOutExpo',function() {
								$(this).remove();
							});
						});
					});
				}
			});
		},

		sticky_header: function(){

			var fw = this;
			var $el = $(".dn-stickyHeader");

			if( $el.length === 0 )
				return;

			var classForVisibleState = 'dn-stickyHeader--on',
				classForHiddenState = 'dn-stickyHeader--off',
				forch = $el.height(),
				added = false;

			var update_forch = function(){
				forch = $el.height();
			};

			// Hack for Relative Sticky header to add a helper
			if( !added && $el.hasClass('dn-siteHeader--pos-relative') ){

				var stickyRelativeHelper = $('<div class="dn-stickyRelativeHelper" style="height:'+ forch +'px"></div>');
				stickyRelativeHelper.insertAfter($el);

				$( window ).on( 'resize ' , fw.helpers.debounce(function(){
					update_forch();
					stickyRelativeHelper.height( forch );
				}, 50) );

				added = true;
			}

			function toggleStickyHeader(){

				var hideSticky = function(){
					if( !$el.hasClass(classForHiddenState) ){
						$el.removeClass(classForVisibleState).addClass(classForHiddenState);
					}
				};

				if ( window.matchMedia( "(min-width: 992px)" ).matches ) {

					var fromTop = window.pageYOffset || window.scrollTop || 0;

					if( fromTop >= forch ){
						if( !$el.hasClass(classForVisibleState) ){
							$el.removeClass(classForHiddenState).addClass(classForVisibleState);
						}
					}
					else {
						hideSticky();
					}
				} else {
					hideSticky();
				}
			}

			$( window ).on( 'resize scroll' , toggleStickyHeader );
		},

		nav_overlay: function( scope ) {

			var _overlayMenuHolder = $('#dn-nav-overlay'),
				_mainMenu = $('#menu-main-menu'),
				fw = this;

			if( _mainMenu.length > 0  ){

				var _body = $('body'),
					_pageWrapper = $('#page_wrapper'),
					_responsiveTrigger = $('#dn-menuBurger'),
					_clonedMenu = _mainMenu.clone().attr({id:"dn-overlay-menu", "class":"dnNavOvr-menu nav-with-smooth-scroll"}),
					slidingOptions = {};

				// Slide Options
				slidingOptions.duration = 500;
				slidingOptions.easing = 'easeInOutExpo';

				var closeMenu = function(){
					_overlayMenuHolder.removeClass('is-active');
					_responsiveTrigger.removeClass('is-active');
					setTimeout(function(){
						_body.css('overflow','');
					}, 700);
					_clonedMenu.find('ul.sub-menu.is-visible, .zn_mega_container.is-visible').slideUp('fast', function(){
						$(this).removeClass('is-visible');
						$(this).closest('.dnNavOvr-menuItemActive').removeClass('dnNavOvr-menuItemActive');
					});
				};

				var openMenu = function(){
					_overlayMenuHolder.addClass('is-active');
					_responsiveTrigger.addClass('is-active');
					_body.css('overflow','hidden');
				};

				var toggleOpen = function(){
					if( _overlayMenuHolder.hasClass('is-active') ){
						closeMenu();
					}
					else {
						openMenu();
					}
				};

				var startOverlayMenu = function()
				{
					_clonedMenu
						.appendTo( _overlayMenuHolder.find('.dnNavOvr-menuWrapper') )
						.wrap('<div class="dnNavOvr-menuWrapper-inner"></div>');

					// Remove Smart area Mega menus
					_clonedMenu.find('div.zn_mega_container.zn-megaMenuSmartArea').remove();

					// TEMP
					// openMenu();

					// Open Levels
					_clonedMenu.find('.menu-item-has-children > a').on('click',function(e){
						e.preventDefault();

						var $t = $(this),
							$parent = $t.parent(),
							$item_submenu = $t.siblings('ul.sub-menu, .zn_mega_container');
							$parentSiblings = $t.parents('.menu-item-has-children').siblings('.menu-item-has-children').find('ul.sub-menu.is-visible, .zn_mega_container.is-visible');

						// Close all other Submenus
						parentSiblings_slideOptions = slidingOptions;
						parentSiblings_slideOptions.complete = function(){
							$(this).removeClass('is-visible');
							$(this).closest('.dnNavOvr-menuItemActive').removeClass('dnNavOvr-menuItemActive');
						};
						$parentSiblings.slideUp(parentSiblings_slideOptions);

						// Open Submenu
						$parent.toggleClass('dnNavOvr-menuItemActive');

						siblings_slideOptions = slidingOptions;
						siblings_slideOptions.complete = function(){
							$(this).toggleClass('is-visible');
						};
						$item_submenu.slideToggle(siblings_slideOptions);

						// Add Depth Class
						_clonedMenu.removeClass('is-depth-0 is-depth-1 is-depth-2 is-depth-3').addClass('is-depth-' + $t.parents('.dnNavOvr-menuItemActive').length );
					});

					_clonedMenu.find(".main-menu-link[href*='#']:not([href='#']):only-child").on('click',function(e){
						e.preventDefault();
						closeMenu();
					});

					// Open Menu Trigger
					_responsiveTrigger.on('click', function(e){
						e.preventDefault();
						toggleOpen();
					});

					// Close Button
					$('#dnNavOvr-close').on('click', function(e){
						e.preventDefault();
						toggleOpen();
					});

					// Close on ESC
					$(document).on('keyup', function(e){
						if ( e.keyCode == 27 && _overlayMenuHolder.hasClass('is-active') ) {
							closeMenu();
						}
					});
				};

				// MAIN TRIGGER FOR ACTIVATING THE RESPONSIVE MENU
				$( window ).on( 'resize' , fw.helpers.debounce(function(){
					if ( $(window).width() <= dnMobileMenu.trigger ) {
						if ( !fw.helpers.nav_overlay__isActive ){
							startOverlayMenu();
							fw.helpers.nav_overlay__isActive = true;
						}
					}
					else{
						// WE SHOULD HIDE THE MENU
						closeMenu();
					}
				// Fix for triggering the responsive menu
				}, 50) ).trigger('resize');
			}
		},

		woocommerce_fancy_pagination: function(scope){

			$pag = $('.dn-wooArchive-pagination.dn-wooArchive-pagination--fancy', scope);

			if( $pag.length ){
				$pag.each(function(i, el){

					var $pagination = $(el),
						prev = $('.pagination-item-prev-link',$pagination),
						next = $('.pagination-item-next-link',$pagination),
						numbers = $('.pagination-item:not(.pagination-item-prev):not(.pagination-item-next)', $pagination),
						products_list = $pagination.prevAll('ul.products'),
						last_prod = products_list.children('li').last().outerHeight(),
						fancyPag = products_list.append('<li class="product dn-fancyPag visible-lg" style="height:'+ parseFloat(last_prod) +'px"><div class="dn-fancyPag-inner"><div class="dn-fancyPag-arrows"></div><ul class="dn-fancyPag-numbers"></ul></div></li>');

					if(prev.length){
						console.log( prev );
						$('.dn-fancyPag-arrows', fancyPag).append( prev[0].outerHTML );
					}
					if(next.length){
						$('.dn-fancyPag-arrows', fancyPag).append( next[0].outerHTML );
					}
					if(numbers.length){
						numbers.each(function(index, el) {
							$('.dn-fancyPag-numbers', fancyPag).append( $(el)[0].outerHTML );
						});
					}
				});
			}
		},

		/**
		 * Returns the header height if set to absolute position
		 * It is usefull when you want to subtract the height
		 * @return int The header height
		 */
		getHeaderAbsoluteHeight: function(){
			var height = 0,
				$header = $( 'header#site-header' );

			if( $header.hasClass( 'dn-siteHeader--pos-absolute' ) ){
				height = $header.height();
			}

			return height;
		},

		getAdminBarHeight: function(){
			var height = 0,
				adminBar = $('#wpadminbar');
			if( adminBar.length > 0 ){
				height = $('html').css('margin-top');
				height = height.replace('px', '');
			}

			return parseInt(height);
		},

		/**
		 * Will enable WooCommerce Ajax filters and pagination
		 * @param  int elementSelector The element selector for which we should enable ajax
		 */
		enableWooCommerceAjax : function( elementSelector, args ){

			var fw = this,
				elementContainer = typeof elementSelector == 'object' ? elementSelector : $(elementSelector),
				prevPage = elementContainer.find( '.pagination-item-prev-link' ),
				nextPage = elementContainer.find( '.pagination-item-next-link' ),
				pageItem = elementContainer.find( '.pagination-item-span' ),
				sortOption = elementContainer.find( '.woocommerce-ordering' ).find('.orderby');

			//  Add the ajax call action
			var args = $.extend(args, {
				action:'zn_product_archive_query',
			});

			// Set default page
			args.page = args.page ? args.page : 1;

			// next page functionality
			nextPage.on( 'click', function(e){
				e.preventDefault();
				args.page = parseInt(args.page) + 1;
				fw.doProductArchiveQuery( elementContainer, args );
			});

			// Sort by functionality
			sortOption.on( 'change', function(e){
				args.sortBy = $(this).val();
				fw.doProductArchiveQuery( elementContainer, args );

				// Don't reload the page
				e.preventDefault();
				return false;

			});

			// Previous page functionality
			prevPage.on( 'click', function(e){
				e.preventDefault();
				args.page = parseInt(args.page) - 1;
				fw.doProductArchiveQuery( elementContainer, args );
			});

			// Pagination functionality
			pageItem.on( 'click', function(e){
				e.preventDefault();
				args.page = $(this).text();
				fw.doProductArchiveQuery( elementContainer, args );
			});

			// Activate a menu item
			if( typeof args.category[0] != 'undefined' ){
				$('.menu-item a[data-productcatid="'+ args.category[0] +'"]').parent('li').addClass('active');
			}

			// Cache the data so we can link it to custom menu element
			fw.productQuerysConfig[elementContainer.id] = args;
		},

		/**
		 * Retrieves the Query configuration for a ajaxified product archive element
		 * @param  string elementContainerId The ajaxified element id
		 * @return object                    The Query configuration for the element
		 */
		getWooCommerceQueryConfig: function(elementContainerId){
			return this.productQuerysConfig[elementContainerId];
		},


		/**
		 * Enables ajaxified Linked custom menu to Shop archive element
		 * @param  string menuContainer The menu container id
		 * @param  string linkedElement The linked product archive element id
		 */
		enableWooCommerceCustomMenuAjax: function(menuContainer, linkedElement){
			var fw = this,
				$element = $(menuContainer),
				$links = $element.find( '.menu-item-object-product_cat a' ),
				$linkedElementContainer = $( linkedElement );

			$links.on( 'click', function(e){
				e.preventDefault();
				args = fw.getWooCommerceQueryConfig( $linkedElementContainer.id );

				// Check if we have args
				if( typeof args != 'undefined' ){
					var $link = $(this),
						categoryId = $link.data('productcatid');

					// Set the category argument
					args.category = categoryId;
					args.page = 1;
					fw.doProductArchiveQuery( $linkedElementContainer, args );

					$element.find('.menu-item').removeClass('active');
					$link.parent('li').addClass('active');
				}
				else{
					console.warn( '[DANNYS] No Ajax config found for ' + linkedElement );
				}
			});
		},

		/**
		 * Will perform a product query and updates the view
		 * @param  object elementContainer The element object that will be updated with result
		 * @param  object args             The arguments for the products query
		 */
		doProductArchiveQuery : function( elementContainer, args ){

			var fw = this,
				elementMarginTop = 3;

			$('html, body').animate({
				scrollTop: elementContainer.offset().top - fw.getHeaderAbsoluteHeight() - fw.getAdminBarHeight() - elementMarginTop
			}, 500);

			// Add loading class
			elementContainer.addClass( 'zn-wcArchive-ajax--loading' );
			$.post( dnThemeAjax.ajaxurl, args ).success(function( data ){

				// Remove loading Class
				elementContainer.removeClass( 'zn-wcArchive-ajax--loading' );

				var newItems = $(data);

				// Add the resulting html
				elementContainer.html( newItems );

				// Refresh all events on data
				elementContainer.imagesLoaded( function() {
					fw.refresh_events( newItems );
					fw.enableWooCommerceAjax( elementContainer, args );
				});
			});
		},

		magnificPopup : function( content )
		{
			if(typeof($.fn.magnificPopup) != 'undefined')
			{
				/**
				 * Single Modal Links
				 * @type: image, iframe, inline, video, media, etc.
				 */
				var defConfig = function(type){
					return {
						type: type,
						removalDelay: 160,
						preloader: true,
						fixedContentPos: false,
						mainClass: 'mfp-fade',
						tLoading: ''
					};
				};

				$('a[data-lightbox="image"], a[rel="mfp-image"], .mfp-image').magnificPopup(defConfig('image'));
				$('a[data-lightbox="iframe"], a[rel="mfp-iframe"], .mfp-iframe').magnificPopup(defConfig('iframe'));
				$('a[data-lightbox="inline"], a[rel="mfp-inline"], .mfp-inline').magnificPopup(defConfig('inline'));
				$('a[data-lightbox="youtube"], a[data-lightbox="vimeo"], a[data-lightbox="gmaps"], a[data-type="video"], a[rel="mfp-media"]').magnificPopup(defConfig('iframe'));

				/**
				 * Gallery Modals
				 * @type: image, iframe, inline, video, media, etc.
				 * @use: "mfp-gallery" css class for image gallery container, or "mfp-gallery mfp-gallery--misc" for multiple source types;
				 */
				var gal_config = {
					delegate: 'a',
					type: 'image',
					gallery: {enabled:true},
					tLoading: '',
					mainClass: 'mfp-fade'
				};

				$('.mfp-gallery:not(.mfp-gallery--misc)').magnificPopup(gal_config);

				// Notice the .misc class, this is a gallery which contains a variety of sources;
				// Links in gallery need data-mfp attributes eg: data-mfp="image", data-mfp="iframe", etc.
				$('.mfp-gallery.mfp-gallery--misc').magnificPopup({
					mainClass: 'mfp-fade',
					delegate: 'a',
					type: 'image',
					gallery: {enabled:true},
					tLoading: '',
					callbacks: {
						elementParse: function(item) {
							item.type = $(item.el).attr('data-mfp');
						}
					}
				});

				/**
				 * Gallery Modals in Blog Post
				 * @type: jpg, jpeg, png
				 */
				$('.dn-blogItem a[href$=".jpg"], .dn-blogItem a[href$=".jpeg"], .dn-blogItem a[href$=".png"]').each(function(i,el){
					$(el).parents('.dn-blogItem-content').magnificPopup({
						delegate: 'a[href$=".jpg"], a[href$=".jpeg"], a[href$=".png"]',
						type: 'image',
						gallery: {enabled:true},
						tLoading: '',
						mainClass: 'mfp-fade'
					});
				});

			}
		},

		slick : function( content ){

			var fw = this;
			var elements = content.find('.js-slick');
			if( elements.length && typeof($.fn.slick) != 'undefined' ){

				elements.each(function(i, el){

					var $el = $(el),
						$attr = fw.helpers.IsJsonString( $el.attr("data-slick") ) ? JSON.parse( $el.attr("data-slick") ) : {};

					$el.imagesLoaded(function(){
						$el.slick({
							"prevArrow" : '<span class="znSlickNav-arr znSlickNav-prev"><svg viewBox="0 0 256 256"><polyline fill="none" stroke-width="16" stroke-linejoin="round" stroke-linecap="round" points="184,16 72,128 184,240"></polyline></svg></span>',
							"nextArrow" : '<span class="znSlickNav-arr znSlickNav-next"><svg viewBox="0 0 256 256"><polyline fill="none" stroke-width="16" stroke-linejoin="round" stroke-linecap="round" points="72,16 184,128 72,240"></polyline></svg></span>',
							customPaging: function(slider, i) {
								return $('<button type="button" class="slickBtn" data-role="none" role="button" tabindex="0" />').text(i + 1);
							},
							rtl: ($('html').is('[dir]') && $('html').attr('dir') == 'rtl') ? true : false
						});
					});

					// Events
					$el.on('init', function(event, slick){

					})
					.on('beforeChange', function(event, slick, currentSlide, nextSlide){

					})
					.on('afterChange', function(event, slick, currentSlide, nextSlide){

					});

				});

			}
		},

		objfit: function(scope){

			var fw = this;

			// switch between height:100% and width:100% based on comparison of obj and container aspect ratios
			function coverFillSwitch(container, obj, invert) {
				if (!container || !obj) return false;

				var objHeight = obj.naturalHeight || obj.videoHeight;
				var objWidth = obj.naturalWidth || obj.videoWidth;
				var containerRatio = container.offsetWidth / container.offsetHeight;
				var objRatio = objWidth / objHeight;

				var ratioComparison = false;
				if (objRatio >= containerRatio) ratioComparison = true;
				if (invert) ratioComparison = !ratioComparison; // flip the bool

				if (ratioComparison) {
					obj.style.height = '100%';
					obj.style.width = 'auto';
				} else {
					obj.style.height = 'auto';
					obj.style.width = '100%';
				}
			}

			// add absolute center object css properties
			function applyStandardProperties(container, obj) {
				var containerStyle = window.getComputedStyle(container);
				if (containerStyle.overflow !== 'hidden') container.style.overflow = 'hidden';
				if (containerStyle.position !== 'relative' &&
					containerStyle.position !== 'absolute' &&
					containerStyle.position !== 'fixed') container.style.position = 'relative';
				obj.style.position = 'absolute';
				obj.style.top = '50%';
				obj.style.left = '50%';
				obj.style.transform = 'translate(-50%,-50%)';
			}

			function objectFitInt(el) {

				var objs = document.getElementsByClassName(el);
				for (var i = 0; i < objs.length; i++) {

					var obj = objs[i];
					var container = obj.parentElement;

					coverFillSwitch(container, obj);
					applyStandardProperties(container, obj);

				}
			}

			// Object Fit Cover as Fallback CSS object-fit:cover;
			if (!Modernizr.objectfit) {
				window.addEventListener('load', objectFitInt('object-fit__cover'), false);
				window.addEventListener('resize', fw.helpers.throttle(
					function () {
						var i, obj, container;
						var objsCover = document.getElementsByClassName('object-fit__cover');
						for (i = 0; i < objsCover.length; i++) {
							obj = objsCover[i];
							container = obj.parentElement;
						}
					}, 66), false);
			}

			// Bail early
			if( $('.js-object-fit-cover', scope).length === 0 ) return;

			  // Object Fit Cover as JS Solution (eg: for iframes)
			window.addEventListener('load', objectFitInt('js-object-fit-cover'), false);
			window.addEventListener('resize', fw.helpers.throttle(
				function () {
					var i, obj, container;
					var objsCover = document.getElementsByClassName('js-object-fit-cover');
					for (i = 0; i < objsCover.length; i++) {
						obj = objsCover[i];
						container = obj.parentElement;
						coverFillSwitch(container, obj);
					}
				}, 66), false);
		},

		/* Button to toggle a class
		* example: class="js-toggle-class" data-target=".kl-contentmaps__panel" data-target-class="is-closed"
		*/
		toggle_class : function( scope ){

			var elements = scope.find( '.js-toggle-class' );

			scope.find( '.js-toggle-class' ).on('click',function (e) {
				e.preventDefault();
				var $el = $(this);
				$el.toggleClass('is-toggled');
				if(!$el.is('[data-multiple-targets]')){
					var target = $el.is('[data-target]') ? $el.attr('data-target') : $el,
						target_class = $el.is('[data-target-class]') ? $el.attr('data-target-class') : '';
					if(target && target.length && target_class && target_class.length){
						$(target).toggleClass(target_class);
					}
				}
			});
		},

		modal_section: function(scope){

			var fw = this;

			var getExpired = function(e){
				if(e == 'halfhour') return 60*30*1000;
				else if(e == 'hour') return 60*60*1000;
				else if(e == 'day') return 24*60*60*1000;
				else if(e == 'week') return 7*24*60*60*1000;
				else if(e == '2week') return 2*7*24*60*60*1000;
				else if(e == 'month') return 30*24*60*60*1000;
			};

			function setCookie(cname, cvalue, expire) {
				var d = new Date();
				d.setTime(d.getTime() + (expire));
				var expires = "expires="+ d.toUTCString();
				document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
			}

			function getCookie(cname) {
				var name = cname + "=";
				var ca = document.cookie.split(';');
				for(var i = 0; i <ca.length; i++) {
					var c = ca[i];
					while (c.charAt(0)==' ') {
						c = c.substring(1);
					}
					if (c.indexOf(name) == 0) {
						return c.substring(name.length,c.length);
					}
				}
				return "";
			}


			// Auto-Popup Modal Window - Immediately
			// Options located in Section element > Advanced
			$('body:not(.zn_pb_editor_enabled) .zn-modalSection--auto-immediately').each(function(index, el) {

				var $el = $(el),
					window_id = $el.attr('id'),
					thecookie = 'automodal'+window_id;

				if(typeof getCookie(thecookie) != 'undefined' && getCookie(thecookie) == 'true'){
					return;
				}

				if(typeof($.fn.magnificPopup) != 'undefined')
				{
					$.magnificPopup.open({
						items: {
							src: $el,
							type: 'inline'
						},
						mainClass: 'mfp-fade',
						callbacks: {
							open: function() {
								// Check if force cookie is added
								if( $el.is('[data-autoprevent]') ){
									// Assign cookie
									setCookie(thecookie, 'true', getExpired( $el.attr('data-autoprevent') ) );
								}
							}
						}
					});
				}
			});

			// Auto-Popup Modal Window - On Scroll
			// Options located in Section element > Advanced
			$('body:not(.zn_pb_editor_enabled) .zn-modalSection--auto-scroll').each(function(index, el) {

				var $el = $(el),
					window_id = $el.attr('id'),
					thecookie = 'automodal'+window_id,
					isAppeared = false;

				if(typeof getCookie(thecookie) != 'undefined' && getCookie(thecookie) == 'true'){
					return;
				}

				function doModal(){
					if(typeof($.fn.magnificPopup) != 'undefined')
					{
						$.magnificPopup.open({
							items: {
								src: $el,
								type: 'inline'
							},
							mainClass: 'mfp-fade',
							callbacks: {
								open: function() {
									// Check if force cookie is added
									if( $el.is('[data-autoprevent]') ){
										// Assign cookie
										setCookie(thecookie, 'true', getExpired( $el.attr('data-autoprevent') ) );
									}
								}
							}
						});
					}
				}

				$(window).on('scroll', fw.helpers.debounce(function() {
					if( $(window).scrollTop() > ($(document).outerHeight()/2) && isAppeared === false){
						doModal();
						isAppeared = true;
					}
				}, 300));
			});

			// Auto-Popup Modal Window - On X seconds Delay
			// Options located in Section element > Advanced
			$('body:not(.zn_pb_editor_enabled) .zn-modalSection--auto-delay').each(function(index, el) {

				var $el = $(el),
					window_id = $el.attr('id'),
					thecookie = 'automodal'+window_id,
					isAppeared = false,
					delay = $el.is("[data-auto-delay]") ? parseInt( $el.attr("data-auto-delay") ) : 5;

				if(typeof getCookie(thecookie) != 'undefined' && getCookie(thecookie) == 'true'){
					return;
				}

				setTimeout(function(){
					if(typeof($.fn.magnificPopup) != 'undefined')
					{
						$.magnificPopup.open({
							items: {
								src: $el,
								type: 'inline'
							},
							mainClass: 'mfp-fade',
							callbacks: {
								open: function() {
									// Check if force cookie is added
									if( $el.is('[data-autoprevent]') ){
										// Assign cookie
										setCookie(thecookie, 'true', getExpired( $el.attr('data-autoprevent') ) );
									}
								}
							}
						});
					}
					isAppeared = true;
				}, delay*1000);
			});
		},


	};

	$(document).ready(function () {

		// Call this on document ready
		$.themejs = new $.ZnThemeJs();

		/**
		 * Smoothscroll options
		 */
		(function(){

			if ( typeof ZnSmoothScroll != 'undefined' ){
				if (!$.themejs.helpers.hasTouchMobile && !$.themejs.helpers.is_mobile_ie && !$.themejs.helpers.is_pb) {

					var smType = ZnSmoothScroll.type || 'no',
						smOptions = {};

					smOptions.touchpadSupport = ZnSmoothScroll.touchpadSupport == 'yes' ? true : false;

					switch(smType){
						// Ultra Fast
						case"0.1":
							smOptions.animationTime = 150;
							 smOptions.stepSize = 70;
						 break;
						// Fast
						case"0.25":
							smOptions.animationTime = 300;
							 smOptions.stepSize = 70;
						 break;
						// Moderate
						case"yes":
							smOptions.animationTime = 500;
							 smOptions.stepSize = 70;
						 break;
						// Slow speed
						case"0.75":
							smOptions.animationTime = 700;
							 smOptions.stepSize = 70;
						 break;
						// Super Slow speed
						case"1":
							smOptions.animationTime = 1000;
							 smOptions.stepSize = 50;
							smOptions.accelerationMax   = 1;
						 break;
						// Snail speed
						case"1.6":
							smOptions.animationTime = 2000;
							 smOptions.stepSize = 68;
							smOptions.accelerationMax   = 1;
						 break;
					}

					SmoothScroll(smOptions);

				}
			}
		})();

	});


	$(window).on('load',function () {

		var preloader = $('#page-loading');
		if ( preloader.length > 0 ) {
			setTimeout(function(){
				preloader.fadeOut( "slow", function() {
					preloader.remove();
				});
			}, ( typeof window.preloaderDelay != 'undefined' ? window.preloaderDelay : 0 ) );
		}

	});

})(jQuery);
