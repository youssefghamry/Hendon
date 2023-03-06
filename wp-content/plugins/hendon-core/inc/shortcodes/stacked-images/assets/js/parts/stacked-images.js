(function ($) {
	"use strict";

	qodefCore.shortcodes.hendon_core_stacked_images = {};

	$(document).ready(function () {
		qodefStackedImages.init();
	});

	var qodefStackedImages = {
		init: function () {
			var $holder = $('.qodef-stacked-images');

			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);

					qodefStackedImages.animateAppear($thisHolder);
					qodefStackedImages.animateOnScroll();
				});
			}
		},
		animateAppear: function ($holder) {
			$holder.appear(function () {
				$holder.addClass('qodef--appear');
			}, { accX: 0, accY: -200 });
		},
		animateOnScroll: function () {
			var itemSelectors = [
				{
					selector: '.qodef-stacked-images .qodef-m-images img',
					modifier: 'translateY',
					modifierUnit: '%',
					startValue: 50,
					endValue: 0,
				},
				{
					selector: '.qodef-stack-image-img-holder',
					modifier: 'translateY',
					modifierUnit: '%',
					startValue: 100,
					endValue: 0,
				},
				{
					selector: '.qodef-image-with-text.qodef-layout--text-below.qodef-image-outline-top-right',
					modifier: 'translateY',
					modifierUnit: '%',
					startValue: 50,
					endValue: 0,
				},
			];

			if (qodef.windowWidth > 1024) {
				itemSelectors.forEach(function (item) {
					var $items = $(item.selector);

					if ($items.length) {
						$items.each(function () {
							var $thisItem = $(this),
								thisItemTop = $thisItem.offset().top,
								thisItemHeight = $thisItem.outerHeight(),
								thisItemBottom = thisItemTop + thisItemHeight,
								progressVal = 0,
								scrollOffsetY = -1 * qodef.windowHeight * 1.2;

							// Set init css value
							if (thisItemTop > qodef.windowHeight * .5) {
								$thisItem.css('transform', item.modifier + '(' + item.startValue + item.modifierUnit + ')');
							}
							$thisItem.css('transition', 'transform 1.5s cubic-bezier(0.07, 0.83, 0.25, 1)');

							$(window).on('scroll', function () {
								if (qodef.scroll > thisItemTop + scrollOffsetY) progressVal = 1;
								if (qodef.scroll > thisItemTop + scrollOffsetY && qodef.scroll < thisItemBottom + scrollOffsetY) {
									if (progressVal !== 1) {
										progressVal = Math.abs(qodef.scroll - thisItemTop - scrollOffsetY) / thisItemHeight;
									}
								}
								$thisItem.css('transform', item.modifier + '(' + (item.endValue + (1 - (progressVal * 1) * 1) * Math.abs(1 - item.startValue)) + item.modifierUnit + ')');
							});
						});
					}
				});
			}
		}
	};

	qodefCore.shortcodes.hendon_core_stacked_images.qodefStackedImages = qodefStackedImages;

})(jQuery);