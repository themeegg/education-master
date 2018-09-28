jQuery(document).ready(function ($) {

	"use strict";

	/**
	 * Notice script
	 */
	$("#newsNotice").lightSlider({
		item: 1,
		vertical: true,
		loop: true,
		verticalHeight: 35,
		pager: false,
		enableTouch: false,
		enableDrag: false,
		auto: true,
		controls: true,
		speed: 1350,
		prevHtml: '<i class="fa fa-chevron-left"></i>',
		nextHtml: '<i class="fa fa-chevron-right"></i>',
		onSliderLoad: function () {
			$('#edm-newsNotice').removeClass('cS-hidden');
		}
	});

	/**
	 * Slider script
	 */
	$('.slider-posts').each(function () {
		$(".edm-main-slider").lightSlider({
			item: 1,
			auto: true,
			pager: false,
			loop: true,
			speed: 1350,
			pause: 5200,
			enableTouch: false,
			enableDrag: false,
			prevHtml: '<i class="fa fa-angle-left"></i>',
			nextHtml: '<i class="fa fa-angle-right"></i>',
			onSliderLoad: function () {
				$('.edm-main-slider').removeClass('cS-hidden');
			}
		});
	});

	/**
	 * Block carousel layout
	 */
	$('.carousel-posts').each(function () {
		var Id = $(this).parent().attr('id');
		var NewId = Id;
		var crsItem = $(this).data('items');

		var layout = $(this).attr('data-layout');
		layout = typeof layout !== 'string' ? 'layout1' : layout;
		var item = 4;
		if (layout === 'layout1') {
			item = 4;
		} else if (layout === 'layout2') {
			item = 2;
		}
		NewId = $('#' + Id + " #blockCarousel").lightSlider({
			auto: true,
			loop: true,
			pauseOnHover: true,
			pager: false,
			controls: false,
			prevHtml: '<i class="fa fa-angle-left"></i>',
			nextHtml: '<i class="fa fa-angle-right"></i>',
			item: item,
			onSliderLoad: function () {
				$('#' + Id + " #blockCarousel").removeClass('cS-hidden');
			},
			responsive: [{
				breakpoint: 840,
				settings: {
					item: 2,
					slideMove: 1,
					slideMargin: 6,
				}
			},
				{
					breakpoint: 480,
					settings: {
						item: 1,
						slideMove: 1,
					}
				}
			]
		});

		$('#' + Id + ' .edm-navPrev').click(function () {
			NewId.goToPrevSlide();
		});
		$('#' + Id + ' .edm-navNext').click(function () {
			NewId.goToNextSlide();
		});
	});

	/**
	 * Default widget tabbed
	 */
	$(".edm-default-tabbed-wrapper").tabs();


	//Search toggle
	jQuery('.edm-header-search-wrapper .search-main').click(function () {
		jQuery('.search-form-main').toggleClass('active-search');
		jQuery('.search-form-main .search-field').focus();
	});

	//responsive menu toggle
	jQuery('.edm-header-menu-wrapper .menu-toggle').click(function (event) {
		jQuery('.edm-header-menu-wrapper #site-navigation').slideToggle('slow');
	});

	//responsive sub menu toggle
	jQuery('#site-navigation .menu-item-has-children,#site-navigation .page_item_has_children').append('<span class="sub-toggle"> <i class="fa fa-angle-right"></i> </span>');

	jQuery('#site-navigation .sub-toggle').click(function () {
		jQuery(this).parent('.menu-item-has-children').children('ul.sub-menu').first().slideToggle('1000');
		jQuery(this).parent('.page_item_has_children').children('ul.children').first().slideToggle('1000');
		jQuery(this).children('.fa-angle-right').first().toggleClass('fa-angle-down');
	});

	// Scroll To Top
	$(window).scroll(function () {
		if ($(this).scrollTop() > 1000) {
			$('#edm-scrollup').fadeIn('slow');
		} else {
			$('#edm-scrollup').fadeOut('slow');
		}
	});

	$('#edm-scrollup').click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, 600);
		return false;
	});
	/**
    * Prelaoder for website
    * @package Theme Egg
	* @subpackage Education Master
	* @since 1.0.7
	*/
    var preloader = $('.spinner-wrapper');
    preloader.fadeOut();
    $('body').removeClass('body_preloader');
});