(function ($) {
    "use strict";

    var shortcode = 'hendon_core_apartment_list';

    qodefCore.shortcodes[shortcode] = {};

    if (typeof qodefCore.listShortcodesScripts === 'object') {
        $.each(qodefCore.listShortcodesScripts, function (key, value) {
            qodefCore.shortcodes[shortcode][key] = value;
        });
    }

})(jQuery);