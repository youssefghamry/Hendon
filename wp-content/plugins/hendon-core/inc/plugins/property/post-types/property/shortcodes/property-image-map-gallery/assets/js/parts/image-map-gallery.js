(function ($) {
    'use strict';

    qodefCore.shortcodes.hendon_core_property_image_map_gallery = {};

    $(document).ready(function () {
        qodefPropertyImageMapGallery.init();
        qodefPropertyImageMapSVG.init();
    })

    var qodefPropertyImageMapGallery = {
        init: function () {
            var holder = $('.qodef-image-map-gallery');
            if (holder.length) {
                holder.each(function () {

                    var thisHolder = $(this);

                    var imageMapName = thisHolder.data('image-map-name');
                    var lastHighlight;
                    var shapeName;

                    var navigationActive = thisHolder.find('.qodef-map-nav-item.qodef-active-map');
                    var navigation = thisHolder.find('.qodef-map-nav-item.qodef-inactive-map');
                    var mappedImage = thisHolder.find('.qodef-image-map-holder-overlay');
                    var imageHolder = thisHolder.find('.qodef-image-map-holder');

                    navigation.each(function () {
                        $(this).on('click', function () {
                            mappedImage.css('z-index', 999);
                            imageHolder.css('opacity', 0.5);
                        })
                    });

                    navigationActive.each(function () {
                        $(this).on('click', function () {
                            mappedImage.css('z-index', -1);
                            imageHolder.css('opacity', 1);
                        })
                    });

                    // reference for main items
                    var slider = thisHolder.find('.qodef-img-slider');
                    // reference for thumbnail items
                    var thumbnailSlider = thisHolder.find('.qodef-pagination-slider');
                    //transition time in ms
                    var duration = 500;

                    var swiperSlider = new Swiper(slider, {
                        loop: false,
                        autoplay: false,
                        slidesPerView: 1,
                        on: {
                            init: function () {
                                slider.addClass('qodef--initialized');
                                setTimeout(function () {
                                    shapeName = slider.find('.swiper-slide.swiper-slide-active').data('imp-shape');
                                    if (typeof shapeName !== 'undefined') {
                                        imageMapHighlight();
                                    }
                                }, 100);
                            },

                            slideChange: function () {
                                setTimeout(function () {
                                    shapeName = slider.find('.swiper-slide.swiper-slide-active').data('imp-shape');
                                    if (typeof shapeName !== 'undefined') {
                                        imageMapHighlight();
                                    }
                                }, 300);

                                swiperThumbnailSlider.slideTo(swiperSlider.realIndex, duration, true);
                            }
                        }
                    });

                    swiperSlider.init();

                    var swiperThumbnailSlider = new Swiper(thumbnailSlider, {
                        loop: false,
                        autoplay: false,
                        slidesPerView: 4,
                        spaceBetween: 15,
                        on: {
                            init: function () {
                                slider.addClass('qodef--initialized');
                            },

                            slideChange: function () {
                                swiperSlider.slideTo(swiperThumbnailSlider.realIndex, duration, true);
                            },

                            click: function () {
                                swiperSlider.slideTo(swiperThumbnailSlider.clickedIndex, duration, true);
                            }
                        }
                    });

                    swiperThumbnailSlider.init();

                    function imageMapHighlight() {
                        if (typeof lastHighlight !== 'undefined') {
                            $.imageMapProUnhighlightShape(imageMapName, lastHighlight);
                        }
                        if (shapeName !== 'empty') {
                            $.imageMapProHighlightShape(imageMapName, shapeName);
                            lastHighlight = shapeName;
                        }
                    }


                    var singleSection = thisHolder.find('.qodef-img-section'),
                        singleNav = thisHolder.find('.qodef-map-navigation .qodef-map-nav-item');

                    singleNav.on('click', function () {
                        singleSection.removeClass('active');
                        singleNav.removeClass('active');
                        var thisNav = $(this),
                            index = thisNav.index();
                        thisNav.addClass('active');
                        singleSection.eq(index).addClass('active');
                    });

                    $.imageMapProEventClickedShape = function (imageMapName, shapeName) {
                        var sliderIndex = -1;
                        var impObject = $(".qodef-image-map-gallery[data-image-map-name='" + imageMapName + "']");
                        // reference for main items
                        var slider = impObject.find('.qodef-img-slider');
                        // reference for thumbnail items
                        var sliderItems = slider.find('.swiper-slide');
                        sliderItems.each(function () {
                            if ($(this).data('imp-shape') === shapeName) {
                                sliderIndex = $(this).index();
                            }
                            if (sliderIndex !== -1) {
                                swiperSlider.slideTo(sliderIndex, duration, true);
                                swiperThumbnailSlider.slideTo(sliderIndex, duration, true);
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
            var imageMapHolders = $('.qodef-image-map-holder');

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

    qodefCore.shortcodes.hendon_core_property_image_map_gallery.qodefPropertyImageMapGallery = qodefPropertyImageMapGallery;
    qodefCore.shortcodes.hendon_core_property_image_map_gallery.qodefPropertyImageMapSVG = qodefPropertyImageMapSVG;

})(jQuery);
