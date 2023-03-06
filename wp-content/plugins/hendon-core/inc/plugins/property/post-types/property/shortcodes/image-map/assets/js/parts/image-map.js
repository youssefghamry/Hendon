(function ($) {
    'use strict';

    qodefCore.shortcodes.hendon_core_image_map = {};

    $(window).on('load', function () {
        qodefImageMap.init();
    })

    $(document).ready(function () {
        qodefPropertyImageMapSVG.init();
    });

    var qodefImageMap = {
        init: function () {
            var $holder = $('.qodef-image-map');
            if ($holder.length) {
                $holder.each(function () {
                    var $thisHolder = $(this),
                        $holderMap = $thisHolder.find('.qodef-image-map-holder'),
                        holderMapData = JSON.parse($holderMap.attr('data-options')),
                        $infoItems = $thisHolder.find('.qodef-im-info-section-holder .qodef-m-item'),
                        $impShapes = $holderMap.find('.imp-shape'),
                        mapName = holderMapData['general']['name'],
                        shapeNames = holderMapData['spots'].map(function (item) {
                            return item['title'];
                        });

                    var activeShape = shapeNames[0];
                    $infoItems.first().addClass('qodef--active');

                    // Highlight First Shape
                    $.imageMapProHighlightShape(mapName, activeShape);

                    var unhighlightAllButActiveShape = function () {
                        shapeNames.forEach(function (item) {
                            if (item !== activeShape) {
                                $.imageMapProUnhighlightShape(mapName, item);
                            }
                        });
                    }

                    $impShapes.on('mouseenter', function () {
                        setTimeout(function () {
                            unhighlightAllButActiveShape();
                        }, 10);
                    });

                    $.imageMapProEventHighlightedShape = function (imageMapName, shapeName) {
                        activeShape = shapeName;
                        $infoItems.each(function () {
                            if ($(this).data('imp-shape') === shapeName) {
                                $(this).addClass('qodef--active');
                            } else {
                                $(this).removeClass('qodef--active');

                            }
                        })
                    };

                    $.imageMapProEventUnhighlightedShape = function (imageMapName, shapeName) {
                        $.imageMapProHighlightShape(mapName, activeShape);
                        $infoItems.each(function () {
                            if ($(this).data('imp-shape') === shapeName) {
                                $(this).removeClass('qodef--active');
                            }
                        })
                    };

                });
            }
        }
    }

    //function used to repaint ImageMapPro in Elementor admin, that why it is only used in elementor reinitiate and not in $(document).ready
    var qodefPropertyImageMapSVG = {
        init: function () {
            var imageMapHolders = $('.qodef-image-map .qodef-image-map-holder');

            if (imageMapHolders.length) {
                imageMapHolders.each(function () {
                    var thisHolder = $(this),
                        settings = thisHolder.data('options') !== 'undefined' ? thisHolder.data('options') : {},
                        id = settings.id !== undefined && settings.id !== '' ? settings.id : 0,
                        mapSvgHolder = thisHolder.find('#image-map-pro-' + id);

                    if (mapSvgHolder.length) {
                        mapSvgHolder.imageMapPro(settings);
                    }
                })
            }
        }
    }

    qodefCore.shortcodes.hendon_core_image_map.qodefImageMap = qodefImageMap;
    qodefCore.shortcodes.hendon_core_image_map.qodefPropertyImageMapSVG = qodefPropertyImageMapSVG;

})(jQuery);
