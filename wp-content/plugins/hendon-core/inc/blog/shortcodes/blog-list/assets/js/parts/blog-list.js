(function ($) {
	"use strict";

	var shortcode = 'hendon_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if (typeof qodefCore.listShortcodesScripts === 'object') {
		$.each(qodefCore.listShortcodesScripts, function (key, value) {
			qodefCore.shortcodes[shortcode][key] = value;
		});
	}

	$(document).ready(function () {
		qodefBlogHovers.init();
	});

	var qodefBlogHovers = {
		init: function () {
			var $elements = $('.qodef-blog.qodef-item-layout--date-in-image .qodef-e');

			if ($elements.length) {
				$elements.each(function () {
					var $thisItem = $(this),
						$thisTargets = $thisItem.find('.qodef-e-title, .qodef-e-media-image, .qodef-button');

					$thisTargets.length && qodefBlogHovers.hoverClass($thisItem, $thisTargets);
				});
			}
		},
		hoverClass: function ($holder, $target) {
			$target.on('mouseenter', function () {
				$holder.addClass('qodef-e--isHovered');
			}).on('mouseleave', function () {
				$holder.removeClass('qodef-e--isHovered');
			});
		}
	}

})(jQuery);