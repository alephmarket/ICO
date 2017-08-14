var _ideo = _ideo || {};

var initHash = '';
if (window.location.hash && window.location.hash.length > 1 && document.getElementById(window.location.hash.substr(1))) {
    // If there is hash that points to existing element on the page find if exists menu link to it
    // If it does clear hash to prevent default browser scroll and perform correct one (with sticky header fix)
    var links = document.getElementsByTagName('a');

    for (var i in links) {
        if (typeof links[i].getAttribute != 'function')
            continue;

        var href = links[i].getAttribute('href');

        if (!href)
            continue;

        var hashIndex = href.indexOf('#');

        if (hashIndex <= 0)
            continue;

        // if hash part of link is different than current hash location skip link
        if (href.substr(hashIndex) != window.location.hash)
            continue;

        // Skip links that are not menu links
        if (!links[i].parentNode.classList.contains('menu-item'))
            continue;

        // Link found, clear hash to prevent default scroll
        initHash = window.location.hash;
        window.location.hash = '';
    }
}

var doesSupportPassive = null;

window.supportsPassive = function(){
    if (doesSupportPassive === null) {
        try {
            var opts = Object.defineProperty({}, 'passive', {
                get: function () {
                    doesSupportPassive = true;
                }
            });
            window.addEventListener("test", null, opts);
        } catch (e) {
            doesSupportPassive = false;
        }
    }

    return doesSupportPassive;
};

//detects mobile devices
! function (a) {
    var b = /iPhone/i,
        c = /iPod/i,
        d = /iPad/i,
        e = /(?=.*\bAndroid\b)(?=.*\bMobile\b)/i,
        f = /Android/i,
        g = /IEMobile/i,
        h = /(?=.*\bWindows\b)(?=.*\bARM\b)/i,
        i = /BlackBerry/i,
        j = /BB10/i,
        k = /Opera Mini/i,
        l = /(?=.*\bFirefox\b)(?=.*\bMobile\b)/i,
        m = new RegExp("(?:Nexus 7|BNTV250|Kindle Fire|Silk|GT-P1000)", "i"),
        n = function (a, b) {
            return a.test(b)
        },
        o = function (a) {
            var o = a || navigator.userAgent;
            return this.apple = {
                phone: n(b, o),
                ipod: n(c, o),
                tablet: n(d, o),
                device: n(b, o) || n(c, o) || n(d, o)
            }, this.android = {
                phone: n(e, o),
                tablet: !n(e, o) && n(f, o),
                device: n(e, o) || n(f, o)
            }, this.windows = {
                phone: n(g, o),
                tablet: n(h, o),
                device: n(g, o) || n(h, o)
            }, this.other = {
                blackberry: n(i, o),
                blackberry10: n(j, o),
                opera: n(k, o),
                firefox: n(l, o),
                device: n(i, o) || n(j, o) || n(k, o) || n(l, o)
            }, this.seven_inch = n(m, o), this.any = this.apple.device || this.android.device || this.windows.device || this.other.device || this.seven_inch, this.phone = this.apple.phone || this.android.phone || this.windows.phone, this.tablet = this.apple.tablet || this.android.tablet || this.windows.tablet, "undefined" == typeof window ? this : void 0
        },
        p = function () {
            var a = new o;
            return a.Class = o, a
        };
    "undefined" != typeof module && module.exports && "undefined" == typeof window ? module.exports = o : "undefined" != typeof module && module.exports && "undefined" != typeof window ? module.exports = p() : "function" == typeof define && define.amd ? define("isMobile", [], a.isMobile = p()) : a.isMobile = p()
}(this);

var _eventtype = 'click'; //isMobile.any && !isMobile.windows.device ? 'touchend' : 'click';
var touchmove = false;
var touchtarget = false;
var direction, lastScrollTop = 0;

(function ($, ideo) {
    'use strict';

    $('.js-menu-dropdown').on(_eventtype, function (e) {
        $(this).children('.js-menu-dropdown-link').trigger(_eventtype);
        e.stopPropagation();
        e.stopImmediatePropagation();
        e.preventDefault();
        return false;
    });
    

    $.fn.detectDirection = function () {

        var st = window.pageYOffset;

        if (st > lastScrollTop) {
            direction = "down";
        } else if (st < lastScrollTop) {
            direction = "up";
        }

        lastScrollTop = st;

        return direction;
    };

    $.fn.isScrollDown = function () {
        return ($.fn.detectDirection() == 'down');
    };

    $.fn.isScrollUp = function () {
        return ($.fn.detectDirection() == 'up');
    };

    $.fn.getBackgroundPositionPercent = function (elem) {
        var position = elem.css('backgroundPositionX');
        return position;
    };

    $.fn.runIsotope = function () {
        $.resizeMasonryGallerySlides();
        $('.ideo-blog-masonry').isotope({
            itemSelector: '.ideo-blog-entry',
            layoutMode: 'masonry',
            containerStyle: {
                position: 'relative',
                padding: $('.ideo-blog-masonry').css('padding')
            }
        });
    };

    $.fn.runStickyFooter = function () {
        var footer = $('#footer-container')

        $('#page-container').css('marginBottom', '');

        if (footer.height() > $(window).height()) {
            footer.removeClass('sticky');
            return;
        }

        if (footer.hasClass('sticky')) {
            $('#page-container').css('marginBottom', footer.height());
        }
    };

    $.fn.headerMobileChanger = function () {
        var $headerNavbar = $('#header-navbar');
        if ($(window).width() < 992) {
            $headerNavbar.addClass('mobile navbar-hide-menu navbar-overflow skin-' + $headerNavbar.attr('data-mobile-skin'));

        } else {
            $headerNavbar.removeClass('mobile navbar-hide-menu navbar-overflow skin-dark skin-light');
        }
    }

    $.fn.runInfinityScroll = function () {

        var postListContainer = $('.js--posts-list');

        if (postListContainer.length && postListContainer.hasClass('infinity-scroll')) {

            $(window).scroll(function () {

                //if scroll direction is bottom
                if ($.fn.isScrollDown() && $('.js--load-more-posts').length > 0) {

                    var windscroll = window.pageYOffset;
                    var buttonTop = $('.js--load-more-posts').parent().offset().top;

                    if (buttonTop - windscroll < 800) {
                        $('.js--load-more-posts').click();
                    }
                }
            });
        }
    };

    $.fn.initParallax = function (scrollSource) {
        $('[data-motion]').each(function (index, element) {
            var ps = $(element),
                motion = ps.attr('data-motion'),
                direction = ps.attr('data-motion-direction') || '',
                speed = ps.attr('data-motion-speed') || 0.1;

            if (motion == 'parallax') {
                ps.parallax($.fn.getBackgroundPositionPercent(ps), speed, null, scrollSource);
                ps.children('.overlay, .pt-overlay').parallax("50%", speed, null, scrollSource);
            }
            if (motion == 'mousemove') {
                ps.mousemoveparallax({
                    speed: speed
                });
            }

            if (motion == 'pt-motion') {
                ps.parallaxOpacity({
                    speed: speed * 2
                });

                ps.parallaxOpacity({
                    speed: speed * 2,
                    target: '.navigator-bar'
                });

                $('.navigator-bar').parallaxHeight(speed / 2, parseInt($('.navigator-bar').css('paddingTop')));

                ps.parallaxObject(speed);
            }
        });
    };

    $.fn.calcTotalHeaderHeight = function () {
        var headerHeight = $('#header .page-title-container').outerHeight(true);

        return headerHeight;
    };

    $.fn.calcPTHeight = function () {
        var totalHeight = $.fn.calcTotalHeaderHeight();
        var menuHeight = $('#header-navbar').outerHeight(true);
        return totalHeight - menuHeight;
    };

    $.fn.runBackTopButton = function () {
        if ($('.js--back-top-button').length > 0) {
            $(window).on('scroll', _.debounce(function () {
                var windscroll = window.pageYOffset;
                if (windscroll > 800) {
                    $('.js--back-top-button').addClass('active');
                } else {
                    $('.js--back-top-button').removeClass('active');
                }
            }, 100));

        }
    };

    $.fn.initilizeMediaelementplayer = function (selector) {
        var settings = {};

        if (typeof _wpmejsSettings !== 'undefined') {
            settings = _wpmejsSettings;
        }

        settings.success = settings.success || function (mejs) {
            var autoplay, loop;

            if ('flash' === mejs.pluginType) {
                autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
                loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;

                autoplay && mejs.addEventListener('canplay', function () {
                    mejs.play();
                }, false);

                loop && mejs.addEventListener('ended', function () {
                    mejs.play();
                }, false);
            }
        };

        if ($().mediaelementplayer) {
            $(selector).mediaelementplayer(settings);
        }
    };

    /*
     * Method run on page initilization and reinitilization, prepare all scripts to work
     * 
     * @returns null
     */
    $.fn.initJsScripts = function (settings) {

        if (parseInt(_ideo.is_customize_preview) !== 0) {
            $('.widget_archive select').change(function (e) {
                if (!$(this).val())
                    return true;

                e.stopPropagation();
                e.stopImmediatePropagation();
                e.preventDefault();
                window.parent.wp.customize.previewer.previewUrl($(this).val());
                return false;
            });
            $('.widget_categories select').change(function (e) {
                var index = $(this).get(0).selectedIndex;

                if (!index)
                    return true;

                e.stopPropagation();
                e.stopImmediatePropagation();
                e.preventDefault();
                window.parent.wp.customize.previewer.previewUrl(window.parent.wp.customize.settings.url.home + '?cat=' + $(this).get(0).options[index].value);
                return false;
            });
        }

        if (settings['mediaelement']) {
            $.fn.initilizeMediaelementplayer(settings['mediaelement'].ideoSelector);
        }

        if (settings['selectric']) {
            $(settings['selectric'].ideoSelector).selectric();
        }

        //$.fn.contentStickyPlayer();

        $.fn.customizeSetup();
    };

    $.resizeMasonryGallerySlides = function () {
        var carousels = $('.ideo-blog-masonry .format-gallery .carousel');

        carousels.each(function () {
            var items = $(this).find('.item'), //grab all slides
                heights = [], //create empty array to store height values
                tallest; //create variable to make note of the tallest slide

            if (items.length) {
                items.each(function () { //add heights to array
                    $(this).css('min-height', '');
                    heights.push($(this).height());
                });
                tallest = Math.max.apply(null, heights); //cache largest value
                items.each(function () {
                    $(this).css('min-height', tallest + 'px');
                });
            }
        });

    }

    $.fn.initJsScriptsForAjax = function (settings) {
        if (typeof settings === 'undefined') {
            var settings = {};
        }
        if (typeof settings['mediaelement'] === 'undefined') {
            settings['mediaelement'] = {
                'ideoSelector': '.js--ajax-loaded .wp-audio-shortcode, .js--ajax-loaded .wp-video-shortcode'
            };
        }

        if (typeof settings['selectric'] === 'undefined') {
            settings['selectric'] = {
                'ideoSelector': '.js--custom-select'
            };
        }

        $.fn.initJsScripts(settings);
        $.resizeMasonryGallerySlides();
    };

    $.fn.getLogoURL = function (type) {
        if (type === 'normal') {
            return _ideo.logoURL.normal;
        } else if (type === 'sticky') {
            return _ideo.logoURL.sticky;
        }

    };

    $.fn.centerNavMenu = function (type) {
        var navClassContainer = $("#header-navbar nav"),
            layout_site_width = _ideo.settings.generals.layout_site_width,
            left,
            windowWidth = $(window).innerWidth(),
            isWrapBoxed = $("#header").hasClass('wrap-boxed'),
            offset = isWrapBoxed ? 0 : 30;

        if (windowWidth < 992 - 16 || $("#header").hasClass('wrap-boxed')) {
            navClassContainer.css({
                left: ''
            });
            return 0;
        }
        if (isWrapBoxed) {
            layout_site_width = $('#page-container > .container').width();
        } else {
            layout_site_width = $('#content > .container').width() || $('.container').eq(2).width();
        }


        if (navClassContainer.hasClass('navbar-static-top')) {
            if (_ideo.settings.header.top_width == 'container') {
                left = parseInt($(window).width() - layout_site_width - offset) / 2;
            } else if (_ideo.settings.header.top_width == 'custom') {
                left = parseInt($(window).width() - _ideo.settings.header.top_custom_width) / 2;
            } else {
                left = 0;
            }
        }
        if (navClassContainer.hasClass('navbar-sticky')) {
            if (_ideo.settings.header.sticky_width == 'container') {
                left = parseInt($(window).width() - layout_site_width - offset) / 2;
            } else if (_ideo.settings.header.sticky_width == 'custom') {
                left = parseInt($(window).width() - _ideo.settings.header.sticky_custom_width) / 2;
            } else {
                left = 0;
            }
        }

        if (left < 0) left = 0;


        navClassContainer.css({
            left: left
        });


    }

    $("#header-navbar nav").on('stickychanger', function (e, type) {
        $.fn.centerNavMenu(type);
    });

    $.fn.hoverNavMenu = function () {
        var navClassContainer = $("#header-navbar nav");
        var navClassContainerLinks = $("#header-navbar .navbar-menu > li > a");

        navClassContainerLinks.on('mouseover', function (e) {
            var $this = $(this),
                offsetLeft = $(this).offset().left,
                dropmenuWidth = $(this).next().width(),
                windowWidth = $(window).width(),
                pos = windowWidth - (offsetLeft + dropmenuWidth);

            if (!$(this).parent().hasClass('navbar-language-switcher') && !$(this).parent().hasClass('navbar-megamenu')) {
                if (offsetLeft + dropmenuWidth > windowWidth) {
                    $(this).next().addClass('offset-left');
                } else {
                    $(this).next().removeClass('offset-left');
                }

                if (pos < dropmenuWidth) {
                    $(this).next().addClass('left');
                } else {
                    $(this).next().removeClass('left');
                }
            }

        });
        navClassContainerLinks.on('mouseout', function (e) {
            var $this = $(this);
        });


    }

    $.fn.stickyMobileChanger = function () {
        var header = $("#header-navbar");
        var navClassContainer = $("#header-navbar nav");
        var navClassContainerHeight = navClassContainer.outerHeight();
        var topBarHeight = $("#topbar").height() || 0;
        var wpadminBarHeight = $("#wpadminbar").height() || 0;
        var amountPoint = topBarHeight + navClassContainerHeight;

        var setMaxHeightMenu = function() {
            navClassContainer.find('.navbar-collapse').css({maxHeight: $(window).height() - amountPoint - wpadminBarHeight});
        };
        var stickySlideMobile = function () {
            var amountOfScroll = window.pageYOffset;
            var direction = $.fn.detectDirection();

            if(amountOfScroll > topBarHeight){
                navClassContainer.addClass('fixed');
                 header.css({
                    paddingTop: navClassContainerHeight
                });
            }else{
                navClassContainer.removeClass('fixed');
                header.css({
                    paddingTop: ''
                });
            }
        };
        setMaxHeightMenu();
        $(window).on('scroll', function () {
            stickySlideMobile();
        });
        $(window).on('resize', function () {
            setMaxHeightMenu();
        });
    };
    $.fn.stickyChanger = function () {
        var normalLogoSrc = $.fn.getLogoURL('normal');
        var stickyLogoSrc = $.fn.getLogoURL('sticky');
        var adminBarHeight = $('#wpadminbar').length ? $('#wpadminbar').height() : 0;
        var layoutBoxed = $('#header').hasClass('wrap-boxed');


        var headerTopClass = _ideo.settings.header.top_class;
        var headerTopWidth = _ideo.settings.header.top_width;
        var headerStickyClass = _ideo.settings.header.sticky_class;
        var headerStickyWidth = _ideo.settings.header.sticky_width;

        var topBarHeight = $("#topbar").height() || 0;
        var navHeight = $("#header-navbar nav").height() || 0;

        var hasClass = false;
        var executed = false;
        var menu = $("#header-navbar");

        var headerClassContainer = $("#header");
        var topbar = $("#topbar");
        var navClassContainer = $("#header-navbar nav");
        var logo = $("#header-navbar nav a.navbar-brand > img");
        var navContainerOffsetTop = $("#header-navbar nav").css('top');
        var navContainerOutHeight = navClassContainer.position().top + navClassContainer.outerHeight();


        var logoChange = function (src) {
            if (!!src) {
                logo.removeClass('no-src').attr('src', src);
            } else {
                logo.addClass('no-src');
            }
        }

        //NOTE stickySlideAmount
        var stickySlideAmount = function () {
            var amountToChange = parseInt(_ideo.settings.header.amount_to_change);
            var direction = $.fn.detectDirection()
            var amountOfScroll = window.pageYOffset;

            if (direction == 'down') {
                if (amountOfScroll > navContainerOutHeight) {
                    if (navClassContainer.hasClass('navbar-standard') && !navClassContainer.hasClass('out')) {
                        navClassContainer.addClass('out');
                    }
                }
                if (amountOfScroll > amountToChange && (!navClassContainer.hasClass('navbar-sticky') || navClassContainer.hasClass('out'))) {
                    $.fn.enableStickyElementsAnimation(false);
                    $.fn.requestAnimationFrame(function () {
                        navClassContainer
                            .removeClass('navbar-standard').removeClass('out').addClass('navbar-sticky');
                        headerClassContainer
                            .removeClass(_ideo.settings.header.top_class)
                            .addClass(_ideo.settings.header.sticky_class)
                            .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                                setTimeout(function () {
                                    $.fn.enableStickyElementsAnimation(true);
                                }, 500);
                            });

                        navClassContainer.trigger('stickychanger', 'sticky');
                        logoChange(_ideo.settings.header.sticky_logo);
                    });
                }
            }

            if (direction == 'up') {
                if (amountOfScroll <= amountToChange) {
                    if (navClassContainer.hasClass('navbar-sticky') && !navClassContainer.hasClass('out')) navClassContainer.addClass('out');
                    if (navClassContainer.hasClass('navbar-standard') && navClassContainer.hasClass('out')) navClassContainer.removeClass('out');
                }
                if (amountOfScroll <= navContainerOutHeight && (navClassContainer.hasClass('navbar-sticky') || navClassContainer.hasClass('out'))) {
                    $.fn.enableStickyElementsAnimation(false);
                    $.fn.requestAnimationFrame(function () {
                        navClassContainer
                            .removeClass('navbar-sticky').removeClass('out').addClass('navbar-standard');
                        headerClassContainer
                            .removeClass(_ideo.settings.header.sticky_class)
                            .addClass(_ideo.settings.header.top_class)
                            .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                                setTimeout(function () {
                                    $.fn.enableStickyElementsAnimation(true);
                                }, 500);
                            });

                        navClassContainer.trigger('stickychanger', 'standard');
                        logoChange(_ideo.settings.header.top_logo);
                    });
                }
            }
        }

        //NOTE stickySlideHide
        var stickySlideHide = function () {
            var direction = $.fn.detectDirection();
            var amountOfScroll = window.pageYOffset;

            if (!direction && amountOfScroll <= 0) {
                headerClassContainer
                    .removeClass(_ideo.settings.header.sticky_class)
                    .addClass(_ideo.settings.header.top_class)
                    .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                        setTimeout(function () {
                            $.fn.enableStickyElementsAnimation(true);
                        }, 500);
                    });

                logoChange(_ideo.settings.header.top_logo);
                navClassContainer.trigger('stickychanger', 'standard');
            }

            if (direction == 'down') {
                if (amountOfScroll > navContainerOutHeight) {
                    if (!navClassContainer.hasClass('out')) {
                        navClassContainer.addClass('out');
                        setTimeout(function () {
                            navClassContainer.removeClass('navbar-standard').addClass('navbar-sticky')
                        }, 1)
                    }
                }
            } else if (direction == 'up') {
                if (amountOfScroll <= 0 && navClassContainer.hasClass('navbar-sticky')) {
                    $.fn.enableStickyElementsAnimation(false);
                    $.fn.requestAnimationFrame(function () {
                        navClassContainer.removeClass('navbar-sticky').addClass('navbar-standard');

                        topbar.removeClass('out');
                        menu.find('.open').removeClass('open');

                        if (headerTopWidth && headerTopWidth == 'container') {
                            if (!layoutBoxed && !navClassContainer.hasClass('container')) navClassContainer.addClass('container');
                            navClassContainer.removeClass('custom');
                        } else if (headerTopWidth && headerTopWidth == 'custom') {
                            navClassContainer.addClass('custom');
                            if (!layoutBoxed && navClassContainer.hasClass('container')) navClassContainer.removeClass('container');
                        } else {
                            if (!layoutBoxed && navClassContainer.hasClass('container')) navClassContainer.removeClass('container');
                            navClassContainer.removeClass('custom');
                        }
                        headerClassContainer
                            .removeClass(_ideo.settings.header.sticky_class)
                            .addClass(_ideo.settings.header.top_class)
                            .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                                setTimeout(function () {
                                    $.fn.enableStickyElementsAnimation(true);
                                }, 500);
                            });

                        logoChange(_ideo.settings.header.top_logo);
                        navClassContainer.trigger('stickychanger', 'standard');
                    });
                } else {
                    if (navClassContainer.hasClass('out')) {
                        $.fn.enableStickyElementsAnimation(false);
                        $.fn.requestAnimationFrame(function () {
                            navClassContainer
                                .removeClass('navbar-standard').removeClass('out').addClass('navbar-sticky');
                            headerClassContainer
                                .removeClass(_ideo.settings.header.top_class)
                                .addClass(_ideo.settings.header.sticky_class)
                                .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                                    setTimeout(function () {
                                        $.fn.enableStickyElementsAnimation(true);
                                    }, 500);
                                });

                            navClassContainer.trigger('stickychanger', 'sticky');
                            logoChange(_ideo.settings.header.sticky_logo);
                        });
                    }
                }
            }
        };

        var offcanvasBarLogoChanger = function (type) {
            var bar_logo = $('.side-header-offcanvas-logo img'),
                topbar_src = bar_logo.data('topbar-src'),
                stickybar_src = bar_logo.data('stickybar-src');

            if (type == 'topbar') {
                if (topbar_src == '') {
                    bar_logo.addClass('no-src');
                } else {
                    bar_logo.removeClass('no-src');
                }
                bar_logo.attr('src', topbar_src);
            } else if (type == 'stickybar') {
                if (stickybar_src == '') {
                    bar_logo.addClass('no-src');
                } else {
                    bar_logo.removeClass('no-src');
                }
                bar_logo.attr('src', stickybar_src);
            }
        };

        //NOTE offcanvasStickySlideHide
        var offcanvasBar = $('.side-header-offcanvas-topbar-hide-slide');
        var offcanvasOverlay = $('.side-header-offcanvas-overlay');
        var offcanvasStickySlideHide = function () {
            var direction = $.fn.detectDirection();
            var amountOfScroll = window.pageYOffset;

            // if($('body').hasClass('side-offcanvas-header-open')){
            //     return false;
            // }

            if (direction == 'down') {
                if (!$('body').hasClass('side-offcanvas-header-open')) {
                    if (amountOfScroll > offcanvasBar.height()) {
                        if (!offcanvasBar.hasClass('out')) {
                            offcanvasBar.addClass('out');
                        }
                    }
                    if (offcanvasBar.hasClass('sticky') && !offcanvasBar.hasClass('out')) {
                        offcanvasBar.addClass('out');
                    }
                } else {
                    if (!offcanvasBar.hasClass('sticky')) {
                        offcanvasBar
                            .addClass('sticky')
                            .removeClass('out')
                            //.height(_ideo.settings.header.offcanvas_stickybar_height)
                            .removeClass('light').removeClass('dark')
                            .addClass(_ideo.settings.header.offcanvas_stickybar_style);
                        offcanvasOverlay
                            .removeClass('light').removeClass('dark')
                            .addClass(_ideo.settings.header.offcanvas_stickybar_style);
                        offcanvasBarLogoChanger('stickybar');
                    }
                }
            }

            if (direction == 'up') {
                if (amountOfScroll > 500) {
                    offcanvasBar
                        .addClass('sticky')
                        .removeClass('out')
                        //.height(_ideo.settings.header.offcanvas_stickybar_height)
                        .removeClass('light').removeClass('dark')
                        .addClass(_ideo.settings.header.offcanvas_stickybar_style);
                    offcanvasOverlay
                        .removeClass('light').removeClass('dark')
                        .addClass(_ideo.settings.header.offcanvas_stickybar_style);
                    offcanvasBarLogoChanger('stickybar');
                } else if (amountOfScroll == 0) {
                    offcanvasBar
                        .removeClass('sticky')
                        .removeClass('light').removeClass('dark')
                        .removeClass('out')
                        .addClass(_ideo.settings.header.offcanvas_topbar_style)
                        //.height(_ideo.settings.header.offcanvas_topbar_height)
                    ;
                    offcanvasOverlay
                        .removeClass('light').removeClass('dark')
                        .addClass(_ideo.settings.header.offcanvas_topbar_style);
                    offcanvasBarLogoChanger('topbar');
                }
            }
        };



        //NOTE offcanvasStickySlideHide
        var offcanvasStickyBar = $('.side-header-offcanvas-topbar-sticky');

        var offcanvasSticky = function () {
            var direction = $.fn.detectDirection();
            var amountOfScroll = window.pageYOffset;

            // if($('body').hasClass('side-offcanvas-header-open')){
            //     return false;
            // }

            if (direction == 'down') {
                if (amountOfScroll > 0 && !offcanvasBar.hasClass(_ideo.settings.header.offcanvas_stickybar_style)) {
                    offcanvasStickyBar
                    //.height(_ideo.settings.header.offcanvas_stickybar_height)
                        .removeClass('light').removeClass('dark')
                        .addClass(_ideo.settings.header.offcanvas_stickybar_style)
                        .addClass('stickybar');
                    offcanvasOverlay
                        .removeClass('light').removeClass('dark')
                        .addClass(_ideo.settings.header.offcanvas_stickybar_style);
                    offcanvasBarLogoChanger('stickybar');
                }

            }

            if (direction == 'up' && amountOfScroll == 0) {
                offcanvasStickyBar
                //.height(_ideo.settings.header.offcanvas_topbar_height)
                    .removeClass('light').removeClass('dark')
                    .addClass(_ideo.settings.header.offcanvas_topbar_style)
                    .removeClass('stickybar');
                offcanvasOverlay
                    .removeClass('light').removeClass('dark')
                    .addClass(_ideo.settings.header.offcanvas_topbar_style);
                offcanvasBarLogoChanger('topbar');
            }
        };



        var stickySlideNormal = function () {

            var amountOfScroll = window.pageYOffset;

            //standard -> sticky
            if (amountOfScroll > 0 && navClassContainer.hasClass('navbar-standard')) {
                $.fn.enableStickyElementsAnimation(false);
                $.fn.requestAnimationFrame(function () {
                    navClassContainer.removeClass('navbar-standard').addClass('navbar-sticky');

                    topbar.addClass('out');

                    if (headerStickyWidth && headerStickyWidth == 'container') {
                        if (!layoutBoxed && !navClassContainer.hasClass('container')) navClassContainer.addClass('container');
                        navClassContainer.removeClass('custom');
                    } else if (headerStickyWidth && headerStickyWidth == 'custom') {
                        navClassContainer.addClass('custom');
                        if (!layoutBoxed && navClassContainer.hasClass('container')) navClassContainer.removeClass('container');
                    } else {
                        if (!layoutBoxed && navClassContainer.hasClass('container')) navClassContainer.removeClass('container');
                        navClassContainer.removeClass('custom');
                    }

                    headerClassContainer
                        .removeClass(_ideo.settings.header.top_class)
                        .addClass(_ideo.settings.header.sticky_class)
                        .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                            setTimeout(function () {
                                $.fn.enableStickyElementsAnimation(true);
                            }, 500);
                        });

                    logoChange(_ideo.settings.header.sticky_logo);

                    navClassContainer.trigger('stickychanger', 'sticky');
                });
                // sticky -> standard
            } else if (amountOfScroll <= 0 && navClassContainer.hasClass('navbar-sticky')) {
                $.fn.enableStickyElementsAnimation(false);
                $.fn.requestAnimationFrame(function () {
                    navClassContainer.removeClass('navbar-sticky').addClass('navbar-standard');

                    topbar.removeClass('out');

                    if (headerTopWidth && headerTopWidth == 'container') {
                        if (!layoutBoxed && !navClassContainer.hasClass('container')) navClassContainer.addClass('container');
                        navClassContainer.removeClass('custom');
                    } else if (headerTopWidth && headerTopWidth == 'custom') {
                        navClassContainer.addClass('custom');
                        if (!layoutBoxed && navClassContainer.hasClass('container')) navClassContainer.removeClass('container');
                    } else {
                        if (!layoutBoxed && navClassContainer.hasClass('container')) navClassContainer.removeClass('container');
                        navClassContainer.removeClass('custom');
                    }
                    headerClassContainer
                        .removeClass(_ideo.settings.header.sticky_class)
                        .addClass(_ideo.settings.header.top_class)
                        .one('transitionend webkitTransitionEnd oTransitionEnd otransitionend MSTransitionEnd', function () {
                            setTimeout(function () {
                                $.fn.enableStickyElementsAnimation(true);
                            }, 500);
                        });

                    logoChange(_ideo.settings.header.top_logo);
                    navClassContainer.trigger('stickychanger', 'standard');
                });
            }
        }

        var resetStickyChanger = function () {
            navClassContainer
                .removeClass('navbar-sticky')
                .removeClass('out')
                .addClass('navbar-standard');
            headerClassContainer
                .removeClass(_ideo.settings.header.sticky_class)
                .addClass(_ideo.settings.header.top_class);
            logoChange(_ideo.settings.header.top_logo);

            $('.modern-bar').removeClass('active');
            $('#header-navbar').removeClass('navbar-hide-menu');
        }

        var initStickyChanger = function () {

            // $('.modern-bar').removeClass('active');
            // $('#header-navbar').removeClass('navbar-hide-menu');

            if ($(window).width() > 991) {
                if (menu.hasClass("sticky-slide")) {
                    stickySlideAmount();
                } else if (menu.hasClass("sticky-slide-hide")) {
                    stickySlideHide();
                } else if (menu.hasClass("side_offcanvas_header") && $('.side-header-offcanvas-topbar').hasClass('side-header-offcanvas-topbar-hide-slide')) {
                    offcanvasStickySlideHide();
                } else if (menu.hasClass("side_offcanvas_header") && $('.side-header-offcanvas-topbar').hasClass('side-header-offcanvas-topbar-sticky')) {
                    offcanvasSticky();
                } else if (menu.hasClass("sticky")) {
                    stickySlideNormal();
                }
            }
        }

        $(window).on('scroll', _.throttle(function () {
            initStickyChanger();
        }, 200, {
            leading: false
        }));

        $(window).on('resize', function () {
            if ($(window).width() < 992) {
                resetStickyChanger();
            } else {
                initStickyChanger();
            }
        });

        initStickyChanger();

        if (isMobile.apple.device) {
            $('#header-navbar input').on('focusin focus', function (e) {
                $(window).stop().animate({
                    scrollTop: 0
                }, 400);
            });
        }


    }

    $.fn.enableStickyElementsAnimation = function (state) {
        if (state) {
            setTimeout(function () {
                $('#header-navbar').removeClass('block-transition');
            }, 1);
        } else {
            $('#header-navbar').addClass('block-transition');
        }
    }

    $.fn.requestAnimationFrameShim = function (callback) {
        window.setTimeout(callback, 1000 / 60)
    }

    $.fn.requestAnimationFrame = function (callback) {
        var requestFn = window.requestAnimationFrame ||
            window.mozRequestAnimationFrame ||
            window.webkitRequestAnimationFrame ||
            $.fn.requestAnimationFrameShim
        requestFn.call(window, callback)
    }

    $.fn.windowResized = function () {
        if ($(window).width() > 767) {
            $('.full-screen-height').ideoFullScreenHeight();
        } else {
            $('.full-screen-height').css({
                height: ''
            });
        }
    }

    $(document).on('ready', function () {

        $.fn.centerNavMenu();
        $.fn.hoverNavMenu();

        $.fn.runBackTopButton();
        $.fn.runStickyFooter();
        $.fn.runInfinityScroll();

        if ($(window).width() > 991 && $("#header-navbar nav").length) {
            $.fn.stickyChanger();
        } else if ($("#header-navbar nav").hasClass('mobile-sticky')) {
            $.fn.stickyMobileChanger();
        }

        if (!isMobile.any && $(window).width() > 991) {
            $('[data-youtube_id]').each(function () {
                $(this).YTPlayer({
                    videoId: $(this).data('youtube_id')
                });
            });
        } else {
            $('video').each(function () {
                this.pause();
                delete this;
                $(this).remove();
            });
        }

        $('.ideo-lightbox').magnificPopup({type:'image'});
    });

    $(window).on('load', function () {
        setTimeout(function () {
            Waypoint.refreshAll();
        }, 2000);

        if (_eventtype == 'touchend') {
            $('body, a').on('touchmove', function (e) {
                touchmove = true;
            });
            $('a').on('touchend, mouseup', function (e) {
                e.stopPropagation();
                if (touchmove) {
                    touchmove = false;
                    e.preventDefault();
                    e.stopPropagation();
                    return false;
                }
            });
        }

    });

    $(window).on('resize', _.debounce(function () {

        $.fn.windowResized();

        setTimeout(function () {
            $.fn.centerNavMenu();
        }, 225);

        $.resizeMasonryGallerySlides();
    }, 300));

    $(window).on('scroll', _.debounce(function () {
        //fix faster scorll
        if (typeof _pc.setRelative2screen == 'function') _pc.setRelative2screen('', 'scroll debounce');
    }, 100));

    $.fn.customizeSetup = function () {
        //prevent customize redirection for links with hash #
        if (parseInt(_ideo.is_customize_preview) !== 0) {
            jQuery('a').off("mouseup").on('mouseup click ' + _eventtype, function (e) {
                if ($(this).attr('href').indexOf('#') === 0) {
                    e.stopPropagation();
                    e.preventDefault();
                }
            });
        }
    };


    $(function () {
        setTimeout(function () {
            $.fn.runIsotope();
        }, 225);
    });

    $('body').on(_eventtype, '.js--back-top-button', function (e) {
        e.preventDefault();

        $("html, body").stop().animate({
            scrollTop: 0
        }, '500', 'swing');

        return false;
    });

    //$('[data-toggle="tooltip"]').tooltip();

    /*Click on mobile menu */
    $('.dropdown li').on('hover', function (e) {
        /* NOTE add responsive */
        if ($(window).width() < 992) {
            e.preventDefault();
        }
    });

    $('#header-navbar .dropdown > a').on(_eventtype, function (e) {
        if (touchmove) return false;

        if (parseInt(_ideo.is_customize_preview) === 0) {
            e.stopPropagation();
        }

        var target = $(this).closest('.dropdown');

        $("#" + target[0].id).toggleClass("active");

        

        /* NOTE add responsive */
        if ($(window).width() < 992) {
            e.preventDefault();
            var element = target.children(" .dropmenu");
            if (!$(element).hasClass('open')) {
                $(element).slideDown("slow", function () {
                    $(element).addClass('open');
                    $(element).parent().addClass('open');
                });

            } else if ($(element).hasClass('open')) {
                $(element).slideUp("slow", function () {
                    $(element).removeClass('open');
                    $(element).parent().removeClass('open');
                });
            }
        }
    });

    $('.js-menu-dropdown').on(_eventtype, function (e) {
            if($(this).children().hasClass('js-menu-dropdown-link') && $(window).width() < 992){
                var element = $(this).children(" .dropmenu");
                if (!$(element).hasClass('open')) {
                    $(element).slideDown("slow", function () {
                        $(element).addClass('open');
                        $(element).parent().addClass('open');
                    });

                } else if ($(element).hasClass('open')) {
                    $(element).slideUp("slow", function () {
                        $(element).removeClass('open');
                        $(element).parent().removeClass('open');
                    });
                }
            }
            // $(this).children('.js-menu-dropdown-link').trigger(_eventtype);
            e.stopPropagation();
            e.stopImmediatePropagation();
            e.preventDefault();
            return false;
        });
    /*head menu*/
    $('#header-navbar [data-target]:not(.navbar-toggle)').on(_eventtype, function (e) {
        e.preventDefault();
        var target = $(this).data('target');
        $(target).addClass('active');
        if (!isMobile.apple.device) {
            $(target).find('input').focus();
        }
        if (target != '.navbar-form') {
            $('#header-navbar').addClass('navbar-hide-menu navbar-overflow');

        }

        if (target === '.navbar-form') {
            $(e.target).toggleClass('active');
            if (!($(e.target).hasClass('active'))) {
                $(target).removeClass('active');
                $(target).find('input').blur();
            } else {
                setTimeout(function () {
                    if (!isMobile.apple.device) {
                        $(target).find('input').focus();
                    }
                }, 400);

            }
        }

    });

    var toggleOffcanvasHeader = function (action) {
        var timeout = 300;
        if($('.side-header-offcanvas-topbar').hasClass('side-header-offcanvas-topbar-hide')){
            timeout = 0;
        }
        if (action == 'add') {
            setTimeout(function () {
                $('.hamburger').addClass('is-active');
                hamburgerWrapBoxedOffset(true);
            }, timeout);
            //$('.hamburger').addClass('is-active');
            $('body').addClass('side-offcanvas-header-open');
            $('#leftside-navbar').removeClass('collapsed');
        } else if (action == 'remove') {
            //$('.hamburger').removeClass('is-active');
            setTimeout(function () {
                $('.hamburger').removeClass('is-active');
                hamburgerWrapBoxedOffset(false);
            }, 300);
            $('body').removeClass('side-offcanvas-header-open');
            $('#leftside-navbar').addClass('collapsed');
        } else if (action == 'toggle') {
            if($('.hamburger').hasClass('is-active')){
                timeout = 300;
            }
            setTimeout(function () {
                $('.hamburger').toggleClass('is-active');
                hamburgerWrapBoxedOffset($('.hamburger').hasClass('is-active'));
            }, timeout);
            $('body').toggleClass('side-offcanvas-header-open');
            $('#leftside-navbar').toggleClass('collapsed');
        }
    };

    var hamburgerWrapBoxedOffset = function (add, duration) {
        if ($('body').hasClass('wrap-boxed')) {
            var offset = Math.ceil(330 - ($(window).width() - $('.container').width()) / 2);
            duration = duration || 300;
            if ($('body').hasClass('side-right-header')) {
                if (add && offset > 0) {
                    $('.hamburger').animate({
                        right: offset
                    }, duration);
                } else {
                    $('.hamburger').animate({
                        right: 0
                    }, duration);
                }
            } else if ($('body').hasClass('side-left-header')) {
                if (add && offset > 0) {
                    $('.hamburger').animate({
                        left: offset
                    }, duration);
                } else {
                    $('.hamburger').animate({
                        left: 0
                    }, duration);
                }
            }
        }
    };

    if($('.side-header-offcanvas-overlay').length){
        $('.side-header-offcanvas-overlay').on(_eventtype, function (e) {
            e.preventDefault();
            toggleOffcanvasHeader('toggle');
        });
    }

    if ($('.hamburger').hasClass('opening-click')) {
        $('.hamburger').on(_eventtype, function (e) {
            e.preventDefault();
            toggleOffcanvasHeader('toggle');
        });
    } else {
        $('.hamburger').on('mouseenter', function (e) {
            if ($('#leftside-navbar').hasClass('collapsed')) {
                toggleOffcanvasHeader('add');
            }
        });

        $('#leftside-navbar').on('mouseleave', function (e) {
            setTimeout(function () {
                toggleOffcanvasHeader('remove');
            }, 100);
        });
    }
    $('.modern-bar .close').on(_eventtype, function (e) {
        e.preventDefault();

        $(this).parent().removeClass('active');
        $('#header-navbar').removeClass('navbar-hide-menu');
        setTimeout(function () {
            $('#header-navbar').removeClass('navbar-overflow');
        }, 500);
    });

    $('body').on(_eventtype, '.js--social-share', function (event) {
        event.preventDefault();
        window.open(event.currentTarget.getAttribute('href'), '_blank', 'width=800, height=500');
    });

    $(document).on(_eventtype, function (e) {
        var container = $(".navbar-form.active");

        if (!container.is(e.target) // if the target of the click isn't the container...
            &&
            container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            if (!($(e.target).hasClass('fa-search'))) {
                container.removeClass('active');
                $('i.fa-search').removeClass('active');

            }
        }
    });

    if ($('#leftside-navbar').length) $('#leftside-navbar').ideoLeftMenu();
    if (
        (
            $('#header-navbar.sticky_header').hasClass('loading-effect-1') ||
            $('#header-navbar.sticky_header').hasClass('loading-effect-2') ||
            $('#header-navbar.sticky_slide_header').hasClass('loading-effect-1') ||
            $('#header-navbar.sticky_slide_header').hasClass('loading-effect-2')
        ) && !isMobile.any && $(window).width() > 991) $('#header-navbar').ideoScollLine();

    /*head menu*/

    $('.js--load-more-posts').on(_eventtype, function (e) {

        var button = $(this);
        var paged = parseInt(button.data('paged')) + 1;
        var max_num_pages = parseInt(button.data('max_num_pages'));

        if (!button.hasClass('loading') && (_ideo.is_customize_preview == 0)) {

            button.data('paged', paged);

            $.ajax({
                type: "POST",
                url: _ideo.ajaxurl,
                dataType: "html",
                data: button.data(),
                timeout: 600000,
                xhrFields: {
                    withCredentials: true
                },

                beforeSend: function () {
                    button.addClass('loading');
                },

                success: function (data) {

                    var $newItems = $(data);

                    //have to add class to new elements to stop rerender already embded media players
                    var $newPosts = $newItems.filter('article');
                    $newPosts.addClass('js--ajax-loaded');

                    //add loaded data
                    if (button.data('el_type') == 'masonry') {
                        var $container = $('.ideo-blog-masonry');


                        $container.append($newItems);
                        $container.isotope('addItems', $newItems);
                        $container.isotope('updateSortData', $container.children());

                        $container.isotope('on', 'layoutComplete', function () {
                            button.removeClass('loading');
                        });

                        $container.imagesLoaded(function () {
                            $container.isotope();
                        });

                    } else {
                        $('.js--posts-list').append($newItems);

                        button.removeClass('loading');
                    }

                    if (paged >= max_num_pages) {
                        button.remove();
                    }

                    ///reinitilize js mediaelement for loaded content
                    $.fn.initJsScriptsForAjax({
                        'medialement': {
                            'ideoSelector': '.js--ajax-loaded .wp-audio-shortcode, .js--ajax-loaded .wp-video-shortcode'
                        }
                    });

                    //prepare for next request
                    $newPosts.removeClass('js--ajax-loaded');
                }
            });
        }

        return false;
    });

    $('.js--load-more-comments').on(_eventtype, function (e) {

        var button = $(this);
        var page = parseInt(button.data('page'));
        var max_page = parseInt(button.data('max_page'));
        var dcp = button.data('default_comments_page');

        e.preventDefault();
        e.stopPropagation();
        e.stopImmediatePropagation();

        if (!button.hasClass('loading')) {

            if (dcp == 'oldest' && page < max_page) {
                page++;
            } else if (dcp == 'newest' && page > 0) {
                page--;
            }

            button.data('page', page);

            $.ajax({
                type: "POST",
                url: _ideo.ajaxurl,
                dataType: "html",
                data: {
                    'action': 'loadCommentsAjax',
                    'page': page,
                    'post_id': button.data('post_id')
                },
                timeout: 600000,
                xhrFields: {
                    withCredentials: true
                },

                beforeSend: function () {
                    button.addClass('loading');
                },

                success: function (data) {

                    $('.js--coments-list').append(data);

                    button.removeClass('loading');

                    if (dcp == 'oldest' && page == max_page) {
                        button.remove();
                    } else if (dcp == 'newest' && page == 1) {
                        button.remove();
                    }
                }
            });
        }

        return false;
    });

    $.fn.initJsScripts({
        'selectric': {
            'ideoSelector': '.js--custom-select, #footer select, .sidebar select'
        }
    });

    function toggleSocials(socialsElement, showHide) {
        socialsElement.find('ul').toggleClass('in', showHide);
        socialsElement.find('ul.animated').removeClass('animated');

        socialsElement.find('ul').not('.animated').delay(200).queue(function () {
            $(this).addClass('animated');
            $(this).dequeue();
        });

        socialsElement.find('.symbol').toggleClass('out', showHide);
        socialsElement.find('.symbol.animated').removeClass('animated');

        socialsElement.find('.symbol').not('.animated').delay(200).queue(function () {
            $(this).addClass('animated');
            $(this).dequeue();
        });

        var navigation = socialsElement.parent().find('.pagetitle-nav-container');
        navigation.toggleClass('out', showHide);
        navigation.filter('.animated').removeClass('animated');

        navigation.not('.animated').delay(200).queue(function () {
            $(this).addClass('animated');
            $(this).dequeue();
        });
    }

    // ======== PORTFOLIO =====================
    $('.navigator-bar .socials .symbol').on(_eventtype, (function (e) {
        toggleSocials($(this).closest('.socials'));
        e.stopPropagation();
        e.preventDefault();
        return false;
    }));

    $('.navigator-bar .socials .symbol').mouseenter(function () {
        if ($(window).width() >= 480)
            toggleSocials($(this).closest('.socials'), true);
        return true;
    });

    $('.navigator-bar .socials').mouseleave(function () {
        if ($(window).width() >= 480)
            toggleSocials($(this), false);
        return true;
    });

    $(window).resize(function () {
        var navigatorBar = $('.navigator-bar');
        navigatorBar.find('.socials ul.in').removeClass('in').removeClass('animated');
        navigatorBar.find('.socials .symbol.out').removeClass('out').removeClass('animated');
        navigatorBar.find('.pagetitle-nav-container.out').removeClass('out').removeClass('animated');
        hamburgerWrapBoxedOffset($('.hamburger').hasClass('is-active'), 1);
    });

    // ========
    $('#header #leftside-navbar .navbar-menu li.menu-item > a').on(_eventtype, function (e) {

        if ($(this).closest('li').hasClass('dropdown')) {
            e.stopPropagation();
            e.preventDefault();
        }
    });

    $.getStickyHeaderHeight = function () {
        var height = 0;

        if ($('body').hasClass('admin-bar'))
            height += $('#wpadminbar').outerHeight();

        var navbar = $('#header-navbar');

        if ((!navbar.hasClass('sticky') && !navbar.hasClass('sticky-slide')) || navbar.hasClass('mobile'))
            return height;

        var borderThickness = _ideo.settings.header[_ideo.settings.header.sticky_class.replace('-', '_') + '_border_bottom_thickness'];
        borderThickness = borderThickness ? parseInt(borderThickness) : 0;

        return height + parseInt(_ideo.settings.header.sticky_top_distance) + parseInt(_ideo.settings.header.sticky_height) + borderThickness;
    };

    $(document).on('ready', function () {
        $('#header .navbar-menu li.menu-item > a:not(.dropdown-toggle), #header .navbar-menu li.menu-item > a.dropdown-toggle.js-menu-dropdown-link, .column-text a, a.vc_column_container_link, .button, a.ideo-icons, a.icon-url, .scroll-animation, a.button').on(_eventtype, function (e) {
            if (touchmove || e.wasTouchmove) {
                e.stopPropagation();
                e.stopImmediatePropagation();
                return false;
            }

            var href = $(this).attr('href') + '';
            var hasDropdown = $(this).next().hasClass('dropmenu');

            if ($(this).hasClass('js-menu-dropdown-link')) {
                if (href.length <= 1 || (href.indexOf('#') !== 0 && href.replace(currentUrl, '').indexOf('#') === 0)) {
                    return true;
                }
            }

            if ($(this).parents('#leftside-navbar:first').length) {
                e.stopPropagation();
                e.preventDefault();
            }

            if (href.length > 0) {

                var match = href.match(/#ajax_card=([0-9]+)/i);

                if (match) {
                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    var card = $('.tg-post-' + match[1] + ' a:not(.no-ajaxy):not(.tg-media-button):not(.tg-facebook):not(.tg-twitter):not(.tg-google1):not(.tg-pinterest):not(.tg-page-number)').first();

                    if (card.length > 0)
                        card.click();
                }

                var currentUrl = window.location.protocol + '//' + window.location.hostname + window.location.pathname;

                if (href.replace(currentUrl, '').indexOf('#') === 0) {
                    href = href.replace(currentUrl, '');
                }
                if (href.indexOf('#') === 0 && href.length > 1) {

                    e.preventDefault();
                    e.stopPropagation();
                    e.stopImmediatePropagation();

                    if (href.length > 1) {
                        var target = $(href);

                        if (href.length > 0 && target.length) {
                            var offsetTop = Math.max(target.offset().top - $.getStickyHeaderHeight(), 0);
                            var distance = Math.abs(window.pageYOffset - offsetTop);
                            var duration = (isMobile.any ? 500 : _ideo.settings.advanced.one_page_scroll_speed) * (distance / 1000);
                            var $element = $(href);

                            $element.attr('id', '');

                            if (parseInt(_ideo.is_customize_preview) == 0) {
                                window.location.href = href;
                            }

                            $element.attr('id', href.substr(1));
                            window.inScrollAnimation = true;
                            if (!hasDropdown && $(window).width() < 992)
                                $('[data-target="#header-navbar-collapse"]:not(.collapsed)').trigger('click');

                            $('html,body').stop().animate({
                                scrollTop: offsetTop,
                            }, {
                                duration: duration,
                                specialEasing: 'easeOutCubic',
                                step: function () {
                                    _pc.setRelative2screen('.onScreen ', 'onScroll');
                                },
                                complete: function () {
                                    window.inScrollAnimation = false;
                                }
                            });
                        }
                    }

                    return false;
                }
            }
        });

        /**
         * One page links mechanism
         */

        var onePageDetectionTolerance = 50;
        var onePageLinks = [];
        var onePageElements = [];
        var currentUrl;
        var isCustomizer = parseInt(_ideo.is_customize_preview) !== 0;

        if (!isCustomizer) {
            // Set url to current browser location
            currentUrl = location.host + location.pathname + (location.search ? location.search : '');
        } else {
            // When in customizer set url to current preview url
            currentUrl = window.parent.wp.customize.previewer.previewUrl();
        }

        // Remove trailing slash
        if (currentUrl[currentUrl.length - 1] == '/') {
            currentUrl = currentUrl.substr(0, currentUrl.length - 1);
        }

        // Regex to check if link points to current page
        var currentUrlRegex = new RegExp('(https?://)?(www)?' + currentUrl + '/?(#.*)');

        /**
         * Performs one page links activation on page scroll
         */
        function checkOnePage() {
            if (onePageLinks.length <= 0) {
                // One page links does not exist, return
                return;
            }

            // Get current scroll position
            var position = $('body').scrollTop();

            // Value to be added to scroll distance to skip sticky header
            var difference = $.getStickyHeaderHeight();

            // Check all one page links in reverse
            for (var i = onePageLinks.length - 1; i >= 0; i--) {
                // Check if scrolled enough to catch this element
                if (position + difference + onePageDetectionTolerance >= onePageElements[i].offset().top) {
                    if (!onePageLinks[i].hasClass('active')) {
                        // Activate anchor
                        $('.menu-item.active').removeClass('active');
                        onePageLinks[i].addClass('active');
                    }

                    return;
                }
            }

            // No one page link was activated, activate the first one
            if (onePageLinks[0].hasClass('active')) {
                $('.menu-item.active').removeClass('active');
                onePageLinks[0].addClass('active');
            }
        }

        /**
         * Prepares href for comparison when in customizer mode
         */
        function prepareOnePageHref(href) {
            href += '';

            if (!isCustomizer)
                return href;

            if (href.indexOf('?') < 0) {
                // No search part, return original href
                return href;
            }

            // Remove search part of url
            return href.substr(0, href.indexOf('?')) + href.substr(href.indexOf('#'));
        }

        /**
         * Checks if link href points to current page and returns hash if id does and null if not
         */
        function getCurrentPageHash(href) {
            if (!href)
                return null;

            if (href[0] == '#')
                return href;

            var match = prepareOnePageHref(href).match(currentUrlRegex);

            if (!match)
                return null;

            // Return hash part of link
            return match[3];
        }

        /**
         * Prepares one page links data
         */
        $('.menu-item > a[href*="#"]').each(function () {
            var href = getCurrentPageHash($(this).attr('href'));

            if (!href)
                return true;

            var $element = $(href);

            if ($element.length == 0) {
                // There is no element on the page that matches href, skip link
                return true;
            }

            // Set href without base url
            $(this).attr('href', href);

            $(this).parent().removeClass('active');

            // Add link and target element to lists
            onePageLinks.push($(this).closest('.menu-item'));
            onePageElements.push($element);
        });

        if (onePageLinks.length > 0) {
            // If one page links exist bind function to scroll event
            $(window).scroll(
                _.throttle(function () {
                    checkOnePage();
                }, 200)
            );

            if (initHash && initHash.length > 1) {
                // If there was hash on page load do first scroll animation
                setTimeout(function () {
                    for (var i in onePageLinks) {
                        var $link = onePageLinks[i].find('a');

                        if ($link.attr('href') == initHash) {
                            // Trigger click on link
                            $link.click();
                            return false;
                        }
                    }
                }, 500);
            }
        }
    });

    if (parseInt(_ideo.is_customize_preview) !== 0) {
        $('a').on(_eventtype, function (e) {

            if ($(this).closest('.widget_nav_menu').length > 0 && $(this).parent().hasClass('menu-item-has-children')) {
                e.preventDefault();
                return false;
            }

            if ($(this).hasClass('js-menu-dropdown') || $(this).hasClass('js-menu-dropdown-link')) {
                return false;
            }

            var href = $(this).attr('href');

            if (href.indexOf('#') === 0 || $(this).attr('target') == '_blank' || $(this).is('.js--no-load, .icon-info, .overlay, .dropdown-toggle, .js--social-share, .tg-media-button')) {
                return true;
            }

            e.stopPropagation();
            e.stopImmediatePropagation();
            e.preventDefault();
            window.parent.wp.customize.previewer.previewUrl(href);
            return false;
        });
    }

    /**
     * Do standard linking
     * @param e Event object
     * @param href Prepared href
     */
    $.doLinking = function (e, href) {
        window.location.href = href;

        return false;
    };

    /**
     * Checks if dropdown links should not do linking for current header type (mobile, side, off canvas)
     */
    function unlinkableParents() {
        var $header = $('#header-navbar');

        return $header.hasClass('mobile') ||
            $header.hasClass('side_right_header') ||
            $header.hasClass('side_left_header') ||
            $header.hasClass('side_offcanvas_left_header') ||
            $header.hasClass('side_offcanvas_right_header');
    };

    $('a').on(_eventtype, function (e) {
        var $this = $(this);

        // Block linking and other actions for this type of links
        if ($this.hasClass('js-menu-dropdown') ||
            $this.hasClass('comment-reply-link') ||
            $this.attr('id') == 'cancel-comment-reply-link' ||
            
            ($this.closest('.widget_nav_menu').length > 0 && $this.parent().hasClass('menu-item-has-children'))) {
            e.preventDefault();
            e.stopPropagation();
            e.stopImmediatePropagation();
            return false;
        }

        var currentUrl = window.location.protocol+'//'+window.location.hostname + window.location.pathname;
        var href = $this.attr('href') + '';

        // Block linking but allow chain listeners to perform action for this type of links
        if (
            typeof $this.attr('href') === 'undefined' ||
            href.indexOf('#') === 0 ||
            href.indexOf('tel:') === 0 ||
            href.indexOf('callto:') === 0 ||
            href.indexOf('mailto:') === 0 ||
            href.replace(currentUrl,'').indexOf('#') === 0 ||
            href == window.location.href  ||
            $this.attr('target') == '_blank' ||
            $this.is('.js--no-load, .icon-info, .overlay, .dropdown-toggle, .js--social-share, .carousel-control, .tg-media-button, .fancybox, .ideo-lightbox')
        ) {
            return true;
        }

        // Middle mouse button click, open new window
        if (e.which == 2) {
            window.open(href);
            return false;
        }

        // Do linking linking
        return $.doLinking.call(this, e, href);
    });
})(jQuery, _ideo);


(function ($) {
    var setBounds = function (points, map) {
        var bounds = new google.maps.LatLngBounds();
        $.each(points, function (idx, point) {
            var position = new google.maps.LatLng(point.lat, point.lng);
            bounds.extend(position);
        });
        map.fitBounds(bounds);
    }
    var initialize = function () {
        $('.ideo-google-map').ideoGoogleMap();
    }

    if (typeof google != 'undefined') google.maps.event.addDomListener(window, 'load', initialize);

})(jQuery);

(function ($) {

    $(document).on('ready', function () {

        if (isMobile.any) {
            $('body').addClass('mobile');
        } else {
            $.fn.initParallax();
        }

        if ($(window).width() > 767) {
            $('.full-screen-height').ideoFullScreenHeight();
        }


        $('.vc_page_section.parallax').onScreen({
            tolerance: 0,
            toggleClass: 'onScreen',
            throttle: 100
        });


        $('[data-text]').texteffect();
        $('[data-animation-type]').ideoVieweportAnimation();
        $('.ideo-progress-bar').ideoProgressBar();
        $('.ideo-pie-chart').ideoPiechart();
        $('.ideo-counter').ideoCounter();
        $('.ideo-message-box').ideoMessageBox();


        /* ======= TABS ======= */

        $('.container-tabs.horizontal.fullwidth').tabsfullwidth();

        var setLineTabs = function (elem) {
            var line = $(elem).find('.tabs-line'),
                tabs = $(elem).find('.nav-tabs li'),
                height = 0;

            tabs.each(function () {
                height += $(this).height();
            })
            line.height($(elem).height() - height);
        }
        $('.container-tabs.vertical').each(function (i, elem) {
            setLineTabs(elem);
        });

        $('.container-tabs').on('shown.bs.tab', function (e) {
            setLineTabs(this);
        });
        /* ======= TABS ======= */

        /* ======= Bootstrap gallery swipe */
        if (isMobile.any) {
            $(".carousel .carousel-inner").on('swiperight', function () {
                $(this).parents('.carousel').carousel('prev');
            });

            $(".carousel .carousel-inner").on('swipeleft', function () {
                $(this).parents('.carousel').carousel('next');
            });
        }
        /* ======= TESTIMONIALS ======= */

        $('.mobile .ideo-testimonials-slider').swipeleft(function () {
            $(this).find('.carousel').carousel('next');
        });
        $('.mobile .ideo-testimonials-slider').swiperight(function () {
            $(this).find('.carousel').carousel('prev');
        });
        $('.ideo-testimonials-slider .carousel').on('slide.bs.carousel', function () {
            var $this = $(this);
            setTimeout(function () {
                //carousel('next')
                var height = $this.find('.next').outerHeight();
                //carousel('prev')
                if (!height) {
                    height = $this.find('.prev').outerHeight();
                }
                $this.find('.carousel-inner').animate({
                    height: height
                });
            }, 25);
        });
        /* ======= SINGLE IMAGE ======= */

        $('.link.icon-info').singleImageOnClick();


        /* ======= TEAM BOX LIGHTBOX ======= */

        $('.ideo-team-box').teamBoxOnClick();
        $('.ideo-team-box-caption').teamBoxOnClick();

        /* ======= GRAYSCALE IMAGE ======= */
        $('.grayscale').gray();


        /* ======= ACCORDION ======= */
        $('.accordion[data-open-item]').each(function (i, elem) {
            var openItem = $(elem).data('open-item');
            if (openItem > 0) {
                $(elem).find('.panel-title a').eq(openItem - 1).trigger(_eventtype);
            }
        });
        //init open
        $('.accordion[data-open-hover]').each(function (i, elem) {
            var $el = $(elem);

            $el.find('.panel-title a').hover(function () {
                if ($(this).hasClass('collapsed')) $(this).trigger(_eventtype);
            }, function () {

            });

        });

        /* ======= BACK BUTTON ======= */

        $('.back-top-button').off('mouseup').on(_eventtype, function (e) {
            e.preventDefault();
            e.stopPropagation();
            var duration = window.pageYOffset * (isMobile.any ? 500 : parseInt(_ideo.settings.advanced.backtotop_scroll_speed || 500)) / 1000;

            $('html,body').animate({
                scrollTop: 0
            }, duration, 'swing', function () {
                if (typeof _pc.setRelative2screen) _pc.setRelative2screen('', 'scroll back-top-button');
            });


        });


        /* ======= WIDGET NAV MENU ======= */

        $('.widget_nav_menu ul.menu > li.menu-item-has-children > a').on(_eventtype, function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('submenu-opened');
        });

        /* ======= ADVANCED CAROUSEL FIX ======= */

        $('.ult-item-wrap .ideo-single-image, .ult-item-wrap .ideo-single-image img').on('dragstart', function (e) {
            e.preventDefault();
        });


        $('.dropdown li').on('hover', function (e) {
            if ($(window).width() > 991) {
                if (e.type == 'mouseenter') {
                    if ($(this).children('.dropmenu').length) {
                        $(this).closest('.dropmenu').addClass('open');
                    }
                } else {
                    $(this).closest('.dropmenu').removeClass('open');
                }
            }
        });

        // Replacing comment reply javascript with custom version

        var cancelLink = $('#cancel-comment-reply-link');

        if (cancelLink.length > 0) {
            var loggedInAs = $('.logged-in-as');

            if (loggedInAs.length > 0) {
                loggedInAs.append(cancelLink);
            } else {
                var p = $('<p/>');
                p.append(cancelLink);
                $('#respond form').prepend(p);
            }
        }

        $('.comment-reply-link').each(function () {
            var onClick = $(this).attr('onclick');
            $(this).attr('onclick', onClick.replace('return addComment.moveForm', 'return addCommentCustom.moveForm'))
        });

        window.addCommentCustom = {
            moveForm: function (commId, parentId, respondId, postId) {
                var div, element, style, cssHidden,
                    t = this,
                    comm = t.I(commId),
                    respond = t.I(respondId),
                    cancel = t.I('cancel-comment-reply-link'),
                    parent = t.I('comment_parent'),
                    post = t.I('comment_post_ID'),
                    commentForm = respond.getElementsByTagName('form')[0];

                if (!comm || !respond || !cancel || !parent || !commentForm) {
                    return;
                }

                t.respondId = respondId;
                postId = postId || false;

                if (!t.I('wp-temp-form-div')) {
                    div = document.createElement('div');
                    div.id = 'wp-temp-form-div';
                    div.style.display = 'none';
                    respond.parentNode.insertBefore(div, respond);
                }

                comm.parentNode.insertBefore(respond, comm.nextSibling);
                if (post && postId) {
                    post.value = postId;
                }
                parent.value = parentId;
                cancel.style.display = '';

                cancel.onclick = function () {
                    var t = window.addCommentCustom,
                        temp = t.I('wp-temp-form-div'),
                        respond = t.I(t.respondId);

                    if (!temp || !respond) {
                        return;
                    }

                    t.I('comment_parent').value = '0';
                    temp.parentNode.insertBefore(respond, temp);
                    temp.parentNode.removeChild(temp);
                    this.style.display = 'none';
                    this.onclick = null;
                    return false;
                };

                $('.comments-container .sub-head').last().insertAfter($('#respond h3'));
                var sticky = $('.navbar-sticky');
                var adminBar = $('#wpadminbar');
                $('html, body').animate({
                    scrollTop: Math.max($(commentForm).closest('#respond').offset().top - (sticky.length > 0 ? sticky.outerHeight() : 0) - (adminBar.length > 0 ? adminBar.outerHeight() : 0), 0) + 'px'
                }, 1000);

                try {
                    for (var i = 0; i < commentForm.elements.length; i++) {
                        element = commentForm.elements[i];
                        cssHidden = false;

                        // Modern browsers.
                        if ('getComputedStyle' in window) {
                            style = window.getComputedStyle(element);
                        } else if (document.documentElement.currentStyle) {
                            style = element.currentStyle;
                        }

                        if ((element.offsetWidth <= 0 && element.offsetHeight <= 0) || style.visibility === 'hidden') {
                            cssHidden = true;
                        }
                        if ('hidden' === element.type || element.disabled || cssHidden) {
                            continue;
                        }

                        element.focus();

                        break;
                    }

                } catch (er) {}

                return false;
            },
            I: function (id) {
                return document.getElementById(id);
            }
        }
    });
    $(window).on('load', function () {
        $('[data-sticky-offset]').stickyColumn();
    });
})(jQuery);


var min_w = 300;
var vid_w_orig = 16;
var vid_h_orig = 9;

jQuery(function () {

    jQuery(window).resize(function () {
        resizeToCover();
        jQuery.fn.runStickyFooter();
        jQuery.fn.headerMobileChanger();
        //        resizePreloader();
    });
    jQuery(window).trigger('resize');

    if (isMobile.any) {
        jQuery('.video-background .video-player').remove();
    }
});

function resizePreloader() {
    if (jQuery('#ideo-page-preloader').length) {
        var pagePreloader = jQuery('#ideo-page-preloader');

        pagePreloader.removeClass('out').addClass('in');
        setTimeout(function () {
            pagePreloader.removeClass('in').addClass('out');
        }, 1000);
    }
}

function resizeToCover() {


    var scale_h = jQuery(window).width() / vid_w_orig;
    var scale_v = jQuery(window).height() / vid_h_orig;
    var scale = scale_h > scale_v ? scale_h : scale_v;


    if (scale * vid_w_orig < min_w) {
        scale = min_w / vid_w_orig;
    };

    jQuery('.video-background .video-player').each(function (index, element) {

        jQuery(element).width(scale * vid_w_orig);
        jQuery(element).height(scale * vid_h_orig);

    });
};