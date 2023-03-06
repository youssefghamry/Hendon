(function ($) {
    'use strict';

    qodefCore.shortcodes.hendon_core_property_advanced_info = {};

    $(window).on('load', function () {
        qodefElementorPropertyAdvancedInfo.init();
    });

    var qodefElementorPropertyAdvancedInfo = {
        init: function () {
            $(window).on('elementor/frontend/init', function (e) {
                elementorFrontend.hooks.addAction('frontend/element_ready/hendon_core_property_advanced_info.default', function () {
                    qodefCore.shortcodes.hendon_core_tabs.qodefTabs.init();
                });
            });
        }
    }

    qodefCore.shortcodes.hendon_core_property_advanced_info.qodefElementorPropertyAdvancedInfo = qodefElementorPropertyAdvancedInfo;

})(jQuery);