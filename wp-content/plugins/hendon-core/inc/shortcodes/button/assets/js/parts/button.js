(function ($) {
	"use strict";

	qodefCore.shortcodes.hendon_core_button = {};

	$(document).ready(function () {
		qodefButton.init();
	});

	var qodefButton = {
		init: function () {
			this.buttons = $('.qodef-button');

			if (this.buttons.length) {
				this.buttons.each(function () {
					var $thisButton = $(this);

					qodefButton.buttonHoverColor($thisButton);
					qodefButton.buttonHoverBgColor($thisButton);
					qodefButton.buttonHoverBorderColor($thisButton);
					qodefButton.buttonBordersAnimation($thisButton);
				});
			}
		},
		buttonHoverColor: function ($button) {
			if (typeof $button.data('hover-color') !== 'undefined') {
				var hoverColor = $button.data('hover-color');
				var originalColor = $button.css('color');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'color', hoverColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'color', originalColor);
				});
			}
		},
		buttonHoverBgColor: function ($button) {
			if (typeof $button.data('hover-background-color') !== 'undefined') {
				var hoverBackgroundColor = $button.data('hover-background-color');
				var originalBackgroundColor = $button.css('background-color');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'background-color', hoverBackgroundColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'background-color', originalBackgroundColor);
				});
			}
		},
		buttonHoverBorderColor: function ($button) {
			if (typeof $button.data('hover-border-color') !== 'undefined' && !$button.hasClass('qodef-layout--outlined') && !$button.hasClass('qodef-layout--filled')) {
				var hoverBorderColor = $button.data('hover-border-color');
				var originalBorderColor = $button.css('borderTopColor');

				$button.on('mouseenter', function () {
					qodefButton.changeColor($button, 'border-color', hoverBorderColor);
				});
				$button.on('mouseleave', function () {
					qodefButton.changeColor($button, 'border-color', originalBorderColor);
				});
			}
		},
		changeColor: function ($button, cssProperty, color) {
			$button.css(cssProperty, color);
		},
		buttonBordersAnimation: function ($button) {
			if ($button.hasClass('qodef-layout--outlined') || $button.hasClass('qodef-layout--filled') || $button.hasClass('qodef-type--filled')) {
				var borderColor = $button.data('border-color'),
					borderHoverColor = $button.data('hover-border-color');

				qodefButton.appendBorders($button);

				setTimeout(function () {
					$button.find('.qodef-border-holder').css('border-color', borderColor);
					$button.find('.qodef-border-holder span').css('background-color', borderHoverColor);
					$button.addClass('qodef-layout--borders-animated');
				}, 10);
			}
		},
		appendBorders: function ($element) {
			$element.prepend('<span class="qodef-border-holder"><span class="qodef-top-border"></span><span class="qodef-right-border"></span><span class="qodef-bottom-border"></span><span class="qodef-left-border"></span></span>');
		}
	};

	qodefCore.shortcodes.hendon_core_button.qodefButton = qodefButton;


})(jQuery);