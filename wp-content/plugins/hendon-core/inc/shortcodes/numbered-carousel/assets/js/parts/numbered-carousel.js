(function ($) {
    "use strict";

    $(document).ready(function () {
        qodefNumberedCarousel.init();
    });

    var qodefNumberedCarousel = {

        init: function () {
            var setup = function (carousel) {
                var swiper = new Swiper(carousel, {
                    speed: 300,
                    centeredSlides: true,
                    slidesPerView: 'auto',
                    allowTouchMove: false,
                    init: false
                });

                var holder = carousel.closest('.qodef-numbered-carousel'),
                    bgItems = holder.find('.qodef-m-bg-item'),
                    indicators = holder.find('.qodef-m-indicator'),
                    gridTrigger = holder.find('.qodef-m-grid-line:last-child');

                swiper.on('init', function () {
                    holder.data('items', bgItems.length);

                    iterate(holder, carousel, bgItems, indicators, carousel.find('.swiper-wrapper'));
                    changeActiveSlide(holder, swiper);

                    //initial animation
                    carousel
                        .addClass('qodef-show')
                        .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                            holder.addClass('qodef-initialized');
                            gridTrigger.one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                                holder.data('idle', true);
                            });
                        });
                });

                swiper.on('slideChangeTransitionEnd', function () {
                    iterate(holder, carousel, bgItems, indicators, carousel.find('.swiper-wrapper'));

                    //wait for last item to unmask
                    holder.removeClass('qodef-mask');
                    gridTrigger.one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                        holder.data('idle', true);
                    });
                });

                //initialize swiper
                carousel.waitForImages(swiper.init());
            }

            //toggle on every slide iteration
            var iterate = function (holder, carousel, bgItems, indicators, wrapper) {
                setActiveIndex(holder, carousel);
                changeActiveItem(holder, bgItems);
                changeActiveItem(holder, indicators);
            }

            //fix swiper calcs for center layout type
            var roundTransformVal = function (wrapper) {
                var val = Math.round(wrapper.css('transform').split(',')[4]);

                wrapper.css('transform', 'matrix(1, 0, 0, 1, ' + val + ', 0)');
            }

            //sets active index to holder element
            var setActiveIndex = function (holder, carousel) {
                var activeIndex = carousel.find('.swiper-slide-active').data('index');
                holder.data('active-index', activeIndex);
            }

            //change css class
            var changeClass = function (holder, cssClass) {
                holder
                    .removeClass('qodef-next qodef-prev')
                    .addClass(cssClass);
            }

            //declarative item change - bg item, indicators
            var changeActiveItem = function (holder, items) {
                var activeItem = items.filter(function () {
                    return $(this).data("index") == holder.data('active-index')
                });

                items.removeClass('qodef-active');
                activeItem.addClass('qodef-active');

                items.removeClass('qodef-prev');
                activeItem.prev().addClass('qodef-prev');

                items.removeClass('qodef-next');
                activeItem.next().addClass('qodef-next');
            }

            //declarative slide change
            var changeActiveSlide = function (holder, swiper) {
                var delay = 0,
                    speed = 800;

                var slideTo = function (holder, swiper, direction) {
                    changeClass(holder, 'qodef-' + direction);

                    holder.data('idle', false);
                    holder.addClass('qodef-mask');

                    if (direction == 'next') {
                        setTimeout(function () {
                            swiper.slideNext(speed);
                        }, delay);
                    } else {
                        //fade before transition
                        holder.addClass('qodef-fade-prev-content');
                        setTimeout(function () {
                            holder.removeClass('qodef-fade-prev-content');
                            swiper.slidePrev(speed);
                        }, delay * 1.5);
                    }
                }

                var clickHandler = function (e) {
                    var item = $(e.currentTarget);

                    if (item.hasClass('swiper-slide-next')) {
                        holder.data('idle') && slideTo(holder, swiper, 'next');
                    } else if (item.hasClass('swiper-slide-prev')) {
                        holder.data('idle') && slideTo(holder, swiper, 'prev');
                    }
                }

                var wheelHandler = function (e) {
                    if (holder.data('idle')) {
                        var direction = e.deltaY > 0 ? 'next' : 'prev',
                            activeIndex = holder.data('active-index');

                        if (direction == 'next' && activeIndex < holder.data('items') ||
                            direction == 'prev' && activeIndex > 1) {
                            slideTo(holder, swiper, direction);
                        }
                    }
                }

                var touchStart = function (e) {
                    holder.data('touch-start', parseInt(e.changedTouches[0].clientX));
                }

                var touchMove = function (e) {
                    holder.data('touch-move', parseInt(e.changedTouches[0].clientX));

                    var delta = holder.data('touch-move') - holder.data('touch-start');

                    if (holder.data('idle')) {
                        var direction = delta < 0 ? 'next' : 'prev',
                            activeIndex = holder.data('active-index');

                        if (direction == 'next' && activeIndex < holder.data('items') ||
                            direction == 'prev' && activeIndex > 1) {
                            slideTo(holder, swiper, direction);
                        }
                    }
                }

                holder.on('click', '.swiper-slide', clickHandler);
                if (holder.hasClass('qodef-change-on-scroll')) {
                    holder[0].addEventListener('wheel', wheelHandler);
                    Modernizr.touch && holder[0].addEventListener('touchstart', touchStart);
                    Modernizr.touch && holder[0].addEventListener('touchmove', touchMove);
                }

                var indicator = holder.find('.qodef-m-indicator');
                indicator.on('click', function () {
                    var indicatorIndex = $(this).data('index'),
                        activeIndicatorIndex = holder.find('.qodef-m-indicator.qodef-active').data('index');

                    if (indicatorIndex < activeIndicatorIndex && indicatorIndex === activeIndicatorIndex - 1) {
                        slideTo(holder, swiper, 'prev');
                    }

                    if (indicatorIndex > activeIndicatorIndex && indicatorIndex === activeIndicatorIndex + 1) {
                        slideTo(holder, swiper, 'next');
                    }
                });

                if (qodef.windowWidth < 1025) {
                    var dragEvent = {
                        down: 'touchstart',
                        up: 'touchend',
                        target: 'srcElement',
                    }

                    var getXPos = function (e) {
                        return e.originalEvent.changedTouches[0].clientX;
                    }

                    var touchScrolling = function (oldEvent, newEvent) {
                        var oldY = oldEvent.originalEvent.changedTouches[0].clientY,
                            newY = newEvent.originalEvent.changedTouches[0].clientY;

                        if (Math.abs(newY - oldY) > 100) { // 100 is drag sensitivity
                            return true;
                        };
                        return false;
                    }

                    var mouseDown = false;
                    holder.on(dragEvent.down, function (e) {
                        if (!mouseDown && !$(e[dragEvent.target]).is('a, span')) {
                            var oldEvent = e,
                                xPos = getXPos(e);
                            mouseDown = true;

                            holder.one(dragEvent.up, function (e) {
                                var xPosNew = getXPos(e);
                                if (Math.abs(xPos - xPosNew) > 10 && !touchScrolling(oldEvent, e)) {
                                    var activeIndex = holder.data('active-index');
                                    if (xPos > xPosNew) {
                                        activeIndex < holder.data('items') && slideTo(holder, swiper, 'next');
                                    } else {
                                        activeIndex > 1 && slideTo(holder, swiper, 'prev');
                                    }
                                }
                                mouseDown = false;
                            });
                        }
                    });
                }
            }

            var carousels = $('.qodef-numbered-carousel');
            if (carousels.length) {
                carousels.each(function () {
                    var carousel = $(this).find('.swiper-container');
                    setup(carousel);
                });
            }
        }

    };

    qodefCore.shortcodes.hendon_core_numered_carousel = qodefNumberedCarousel;

})(jQuery);