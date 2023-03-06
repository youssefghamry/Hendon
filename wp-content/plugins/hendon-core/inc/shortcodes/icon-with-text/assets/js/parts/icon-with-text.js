(function ($) {
    "use strict";

    qodefCore.shortcodes.hendon_core_icon_with_text = {};

    $(document).ready(function () {
        qodefIconWithTextBox.init();
        qodefIconWithTextCircle.init();
    });

    var qodefIconWithTextBox = {
        init: function () {
            this.icons = $('.qodef-icon-with-text.qodef-layout--content-in-box');

            if (this.icons.length) {
                this.icons.each(function () {
                    var $thisIconBox = $(this);

                    qodefIconWithTextBox.iconBoxBgColor($thisIconBox);
                });
            }
        },

        iconBoxBgColor: function ($iconBox) {
            if (typeof $iconBox.data('hover-background-color') !== 'undefined') {
                var hoverBackgroundColor = $iconBox.data('hover-background-color');
                var originalBackgroundColor = $iconBox.css('background-color');

                $iconBox.on('mouseenter', function () {
                    qodefIconWithTextBox.changeColor($iconBox, 'background-color', hoverBackgroundColor);
                });
                $iconBox.on('mouseleave', function () {
                    qodefIconWithTextBox.changeColor($iconBox, 'background-color', originalBackgroundColor);
                });
            }
        },

        changeColor: function ($iconBox, cssProperty, color) {
            $iconBox.css(cssProperty, color);
        }
    };

    var qodefIconWithTextCircle = {
        init: function () {
            var $holder = $('.qodef-icon-with-text.qodef--circle-frame-enabled');

            if ($holder.length) {
                $holder.each(function () {
                    var $thisHolder = $(this),
                        circleColor = $thisHolder.data('circle-color'),
                        circleHoverColor = $thisHolder.data('circle-hover-color');

                    $thisHolder.find('.qodef-svg-circle circle:nth-child(1)').css('stroke', circleColor);
                    $thisHolder.find('.qodef-svg-circle circle:nth-child(2)').css('stroke', circleHoverColor);
                });
            }
        }
    }

    qodefCore.shortcodes.hendon_core_icon_with_text.qodefIconWithTextBox = qodefIconWithTextBox;
    qodefCore.shortcodes.hendon_core_icon_with_text.qodefIconWithTextCircle = qodefIconWithTextCircle;

})(jQuery);