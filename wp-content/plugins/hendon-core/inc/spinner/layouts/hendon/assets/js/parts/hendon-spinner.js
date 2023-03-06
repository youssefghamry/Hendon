(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefHendonSpinner.init();
	});

	$(window).on('elementor/frontend/init', function () {
		var isEditMode = Boolean(elementorFrontend.isEditMode());
		if (isEditMode) {
			qodefHendonSpinner.init(isEditMode);
		}
	});

	var qodefHendonSpinner = {
		init: function (isEditMode) {
			this.holder = $('#qodef-page-spinner.qodef-layout--hendon');

			if (this.holder.length) {
				qodefHendonSpinner.animateSpinner(this.holder, isEditMode);
			}
		},
		animateSpinner: function ($holder, isEditMode) {
			var $letter = $holder.find('.qodef-m-hendon-text span'),
				tl = new TimelineMax({ repeat: -1, repeatDelay: 0 })

			tl.staggerFromTo($letter, 3, {
				opacity: 0,
			}, {
				opacity: 1,
				ease: Power3.easeInOut
			}, .3);
			tl.staggerTo($letter, 2, {
				opacity: 0,
				ease: Power2.easeInOut
			}, .1);

			isEditMode && qodefHendonSpinner.finishAnimation($holder);

			$(window).on('load', function () {
				tl.eventCallback("onUpdate", function () {
					if (tl.progress() > 0.6) {
						tl.pause().kill();
						TweenMax.to($letter, 1, {
							opacity: 0,
							stagger: .1,
							ease: Power1.easeInOut
						});
						setTimeout(function () {
							qodefHendonSpinner.finishAnimation($holder);
						}, 1000);
					}
				});
			});
		},
		finishAnimation: function ($holder) {
			qodefHendonSpinner.fadeOutLoader($holder);
			var landingRev = $('#qodef-landing-rev').find('rs-module');
			landingRev.length && landingRev.revstart();
		},
		fadeOutLoader: function ($holder, speed, delay, easing) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'linear';

			$holder.delay(delay).fadeOut(speed, easing);

			$(window).on('bind', 'pageshow', function (event) {
				if (event.originalEvent.persisted) {
					$holder.fadeOut(speed, easing);
				}
			});
		}
	};

})(jQuery);