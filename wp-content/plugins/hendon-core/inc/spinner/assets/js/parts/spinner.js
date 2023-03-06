(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefSpinner.init();
	});

	var qodefSpinner = {
		init: function () {
			this.holder = $('#qodef-page-spinner:not(.qodef-layout--hendon)');

			if (this.holder.length) {
				qodefSpinner.animateSpinner(this.holder);
			}
		},
		animateSpinner: function ($holder) {
			$(window).on('load', function () {
				qodefSpinner.fadeOutLoader($holder);
			});

			if (window.elementorFrontend) {
				qodefSpinner.fadeOutLoader($holder);
			}
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay(delay).fadeOut(speed, easing);

			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	}

})(jQuery);