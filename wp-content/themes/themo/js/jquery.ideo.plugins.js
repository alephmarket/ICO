(function ($) {
    'use strict';

    var is_rtl = $('body').hasClass('rtl');

    function inIframe() {
        try {
            return window.self !== window.top;
        } catch (e) {
            return true;
        }
    }

    $.fn.ideoPiechart = function (options) {
        var defaults = {
                onScreen: true,
                onScreenTolerance: '95%'
            },
            settings = $.extend({}, defaults, options);

        var methods = {
            setSize: function ($circle, size, $bgcircle, distance, $bgbar, $bar, prec) {
                $circle.height($circle.width());
                var r = (100 - size / 2) / 2;
                var c = Math.PI * ($circle.width() + (size / 2 * $circle.width() / 100));
                $bgcircle.attr({
                    r: (r - size / 4 - distance) + '%'
                });
                $bgbar.attr({
                    r: r + '%'
                }).css({
                    strokeWidth: size / 2 + '%'
                });
                $bar.attr({
                    r: r + '%',

                }).css({
                    strokeWidth: size / 2 + '%',
                    strokeDasharray: $circle.width() * Math.PI,
                    strokeDashoffset: ((100 - prec) / 100) * c
                });
            },
            init: function ($this) {
                var $circle = $this.find('.circle'),
                    $svg = $this.find('.svg'),
                    $bgcircle = $this.find('.bg-circle'),
                    $bar = $this.find('.bar'),
                    $bgbar = $this.find('.bg-bar'),
                    $number = $this.find('.number'),
                    prec = $bar.data('prec'),
                    size = $bar.data('counter-size'),
                    distance = $bar.data('counter-distance'),
                    duration = $this.data('duration'),
                    number = parseInt($this.data('number')),
                    easing = $bar.data('easing'),
                    r = $bar.attr('r'),
                    c = Math.PI * (r * 2),
                    t = duration / prec,
                    p = 0;

                if ($bar.length) {
                    $number.text(0);
                    $bar.css({
                        strokeDashoffset: c
                    });
                } else {
                    $number.text(0);
                }
            },
            play: function ($this) {
                if (!$this.data('done')) {
                    $this.data('done', true);

                    var $circle = $this.find('.circle'),
                        $svg = $this.find('.svg'),
                        $bgcircle = $this.find('.bg-circle'),
                        $bar = $this.find('.bar'),
                        $bgbar = $this.find('.bg-bar'),
                        $number = $this.find('.number'),
                        prec = $bar.data('prec'),
                        size = $bar.data('counter-size'),
                        distance = $bar.data('counter-distance'),
                        duration = $this.data('duration'),
                        number = parseInt($this.data('number')),
                        easing = $bar.data('easing'),
                        r = $bar.attr('r'),
                        c = Math.PI * (r * 2),
                        t = duration / prec,
                        p = 0;

                    if ($bar.length) {
                        $number.text(0);
                        $bar.css({
                            strokeDashoffset: c
                        });

                        $({
                            p: 0
                        }).animate({
                            p: prec
                        }, {
                            duration: duration,
                            step: function (now) {
                                $bar.css({
                                    strokeDashoffset: ((100 - now) / 100) * c
                                });
                                $number.text(parseInt(now * number / prec));
                            },
                            easing: easing //http://api.jqueryui.com/easings/
                        });

                    } else {
                        $number.text(0);
                        $({
                            number: 0
                        }).animate({
                            number: number
                        }, {
                            duration: duration,
                            step: function (now) {
                                $number.text(parseInt(now));
                            },
                            easing: easing //http://api.jqueryui.com/easings/
                        });
                    }
                }
            }
        }

        return this.each(function () {
            var $this = $(this),
                play = function () {
                    setTimeout(function () {
                        if (
                            //accordion && tabs
                            ($this.closest('.accordion').length == 0 && $this.closest('.container-tabs').length == 0) ||
                            ($this.closest('.collapse.in').length || $this.closest('.tab-pane.active.in').length)
                        ) {
                            methods.play($this);
                        }

                    }, 25);
                    //accordion support
                    $this.closest('.accordion').on('show.bs.collapse', function () {
                        setTimeout(function () {
                            if ($('.panel-collapse.collapsing').is($this.closest('.panel-collapse'))) {
                                methods.play($this);
                            }
                        }, 25);
                    });
                    //tabs support
                    $this.closest('.container-tabs').find('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                        var idx = $this.closest('.container-tabs').find('a[data-toggle="tab"]').index(e.target);
                        setTimeout(function () {
                            if ($this.closest('.container-tabs').find('.tab-pane').eq(idx).is($this.closest('.tab-pane'))) {
                                methods.play($this);
                            }
                        }, 225);
                    });
                };
            if (settings.onScreen) {
                $this.waypoint(function () {
                    play();
                }, {
                    offset: settings.onScreenTolerance
                });
            } else {
                play();
            }
            methods.init($this);
        });
    }

    $.fn.ideoVieweportAnimation = function (options, atts) {
        if (isMobile.any && _ideo.settings.advanced.viewport_disable_on_mobile == 'true') {
            $('.viewport-animate').removeClass('viewport-animate').addClass('animated');
            return;
        }

        var defaults = {
                onScreen: true,
                onScreenTolerance: 95
            },
            settings = $.extend({}, defaults, options);

        var methods = {
            open: function () {},
            animationType: function (element, type, delay, duration) {

                if (element.hasClass('animated')) return false;

                setTimeout(function () {
                    element.css({
                        animationDelay: 0,
                        animationDuration: duration + 'ms'
                    }).addClass(type).addClass('animated ');
                }, delay);
            }
        }

        if (typeof options === 'string') {
            methods[options].apply();
        } else {
            return this.each(function () {
                var $this = $(this),
                    type = $this.data('animation-type') || '',
                    delay = $this.data('animation-delay') || 0,
                    duration = $this.data('animation-duration') || 1000,
                    offset = $this.data('animation-offset') || settings.onScreenTolerance,
                    play = function () {
                        setTimeout(function () {
                            if (
                                //accordion && tabs
                                ($this.closest('.accordion').length == 0 || $this.closest('.container-tabs').length == 0) ||
                                ($this.closest('.collapse.in').length || $this.closest('.tab-pane.active.in').length)

                            ) {
                                methods.animationType($this, type, delay, duration);
                            }
                        }, 25);
                        //accordion support
                        $this.closest('.accordion').on('show.bs.collapse', function () {
                            setTimeout(function () {
                                if ($('.panel-collapse.collapsing').is($this.closest('.panel-collapse'))) {
                                    methods.animationType($this, type, delay, duration);
                                }
                            }, 25);
                        });
                        //tabs support
                        $this.closest('.container-tabs').find('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                            var idx = $this.closest('.container-tabs').find('a[data-toggle="tab"]').index(e.target);
                            setTimeout(function () {
                                if ($this.closest('.container-tabs').find('.tab-pane').eq(idx).is($this.closest('.tab-pane'))) {
                                    methods.animationType($this, type, delay, duration);
                                }
                            }, 25);
                        });
                    };

                $this.addClass('viewport-animate');

                if (settings.onScreen) {

                    setTimeout(function () {
                        $this.waypoint(function () {
                            play();
                        }, {
                            offset: offset + '%'
                        });
                    }, inIframe() ? 2000 : 25); //  fix for customizer
                } else {
                    play();
                }

            });
        }
    }

    $.fn.ideoProgressBar = function (options, atts) {
        var defaults = {
                onScreen: true,
                onScreenTolerance: '95%'
            },
            settings = $.extend({}, defaults, options);

        var methods = {
            init: function ($this) {
                var coverElem = $this.find('.cover'),
                    numberElem = $this.find('.number .text');
                $this.data('done', false);
                numberElem.html(0);
                setTimeout(function () {
                    coverElem.width('0%');
                }, 25);
            },
            play: function ($this) {
                var number = $this.data('number'),
                    step = number / 100,
                    current = 0,
                    cover = $this.data('cover'),
                    numberElem = $this.find('.number .text'),
                    coverElem = $this.find('.cover');

                if (typeof number === 'number' && !$this.data('done')) {
                    setTimeout(function () {
                        coverElem.width(cover + '%');
                    }, 25);

                    numberElem.html(current);
                    setTimeout(function () {
                        var timer = setInterval(function () {
                            if (current < number) {
                                current += step;
                                if (number > 10) {
                                    numberElem.html(parseInt(current));
                                } else {
                                    numberElem.html(parseInt(current * 100) / 100);
                                }

                            } else {
                                clearInterval(timer);
                                numberElem.html(number);
                                $this.data('done', true);
                            }
                        }, 15);
                    }, 25);
                }
            },
        }

        if (typeof options === 'string') {
            methods[options].apply(this);
        } else {
            return this.each(function () {
                var $this = $(this),
                    play = function () {
                        setTimeout(function () {
                            if (
                                //accordion && tabs
                                ($this.closest('.accordion').length == 0 && $this.closest('.container-tabs').length == 0) ||
                                ($this.closest('.collapse.in').length || $this.closest('.tab-pane.active.in').length)
                            ) {
                                methods.play($this);
                            }

                        }, 25);
                        //accordion support
                        $this.closest('.accordion').on('show.bs.collapse', function () {
                            setTimeout(function () {
                                if ($('.panel-collapse.collapsing').is($this.closest('.panel-collapse'))) {
                                    methods.play($this);
                                }
                            }, 25);
                        });
                        //tabs support
                        $this.closest('.container-tabs').find('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                            var idx = $this.closest('.container-tabs').find('a[data-toggle="tab"]').index(e.target);
                            setTimeout(function () {
                                if ($this.closest('.container-tabs').find('.tab-pane').eq(idx).is($this.closest('.tab-pane'))) {
                                    methods.play($this);
                                }
                            }, 225);
                        });
                    };
                if (settings.onScreen) {
                    $this.waypoint(function () {
                        play();
                    }, {
                        offset: settings.onScreenTolerance
                    });
                } else {
                    play();
                }
                methods.init($this);
            });
        }
    }

    $.fn.ideoCounter = function (options) {
        var defaults = {
                onScreen: true,
                onScreenTolerance: '95%'
            },
            settings = $.extend({}, defaults, options);

        var methods = {
            init: function ($this) {
                var $number = $this.find('.number');
                $number.text(0);
            },
            play: function ($this) {

                if (!$this.data('done')) {
                    $this.data('done', true);

                    var $number = $this.find('.number'),
                        duration = $this.data('duration'),
                        number = parseInt($this.data('number'));

                    $({
                        number: 0
                    }).animate({
                        number: number
                    }, {
                        duration: duration,
                        step: function (now) {
                            $number.text(parseInt(now));
                        },
                    });
                }
            }
        }

        return this.each(function () {
            var $this = $(this),
                play = function () {
                    setTimeout(function () {
                        if (
                            //accordion && tabs
                            ($this.closest('.accordion').length == 0 && $this.closest('.container-tabs').length == 0) ||
                            ($this.closest('.collapse.in').length || $this.closest('.tab-pane.active.in').length)
                        ) {
                            methods.play($this);
                        }

                    }, 25);
                    //accordion support
                    $this.closest('.accordion').on('show.bs.collapse', function () {
                        setTimeout(function () {
                            if ($('.panel-collapse.collapsing').is($this.closest('.panel-collapse'))) {
                                methods.play($this);
                            }
                        }, 25);
                    });
                    //tabs support
                    $this.closest('.container-tabs').find('a[data-toggle="tab"]').on('show.bs.tab', function (e) {
                        var idx = $this.closest('.container-tabs').find('a[data-toggle="tab"]').index(e.target);
                        setTimeout(function () {
                            if ($this.closest('.container-tabs').find('.tab-pane').eq(idx).is($this.closest('.tab-pane'))) {
                                methods.play($this);
                            }
                        }, 225);
                    });
                };

            if (settings.onScreen) {
                $this.waypoint(function () {
                    play();
                }, {
                    offset: settings.onScreenTolerance
                });
            } else {
                play();
            }
            methods.init($this);

        });
    }

    $.fn.ideoMessageBox = function (options) {
        return this.each(function () {
            var $this = $(this),
                $close = $this.find('.message-close');

            if ($close.length) {
                $close.click(function () {
                    $this.animate({
                        height: 0
                    }, 400, 'linear', function () {
                        $this.remove()
                    });
                });
            }

        });
    }
    $.fn.tabsfullwidth = function (options) {
        return this.each(function () {
            var $this = $(this),
                tabs = $this.find('.nav-tabs li'),
                width = 100 / tabs.length;

            tabs.width(width + '%');

        });
    }

    $.fn.ideoblur = function (options) {
        var settings = $.extend({}, options),
            methods = {
                getTargetSize: function (elem) {
                    return {
                        w: elem.width(),
                        h: elem.height()
                    };
                },
                getImageSize: function (elem) {
                    var cloned = elem.clone();
                    cloned.removeAttr('style');
                    cloned.css({
                        "visibility": "hidden",
                        'position': 'fixed'
                    });
                    $('body').append(cloned);
                    var size = {
                        w: cloned.width(),
                        h: cloned.height()
                    };
                    cloned.remove();
                    return size;
                },
                getBgImageSize: function (elem) {
                    var src = elem.css('background-image').replace(/url\((['"])?(.*?)\1\)/gi, '$2'),
                        img = $('<img/>', {
                            src: src
                        }).css({
                            "visibility": "hidden",
                            'position': 'fixed'
                        });

                    $('body').append(img);

                    var size = {
                        w: img.width(),
                        h: img.height()
                    };
                    img.remove();
                    return size;
                },
                fillImage: function (elem) {
                    var bgTargetSize = methods.getTargetSize(elem),
                        bgImageSize = methods.getBgImageSize(elem),
                        ratioW = bgImageSize.w / bgTargetSize.w,
                        ratioH = bgImageSize.h / bgTargetSize.h,
                        ratio = ratioW / ratioH,
                        css = {};

                    if (ratio > 1) {
                        css = {
                            'background-size': '' + (bgTargetSize.w * ratio) + 'px ' + (bgTargetSize.h) + 'px'
                        };
                    } else {
                        css = {
                            'background-size': '' + (bgTargetSize.w) + 'px ' + (bgTargetSize.h / ratio) + 'px'
                        };
                    }

                    return css;
                }
            }

        var bgTarget = $(settings.bg),
            bgImage = bgTarget.css('background-image').replace(/url\((['"])?(.*?)\1\)/gi, '$2'),
            bgImageSize = methods.getBgImageSize(bgTarget),
            bgTargetSize = methods.getTargetSize(bgTarget),
            imageBlur = bgImage.replace('.jpg', '_blur.jpg'),
            css = methods.fillImage(bgTarget);


        return this.each(function () {
            var $this = $(this),
                left = $this.offset().left - bgTarget.offset().left,
                top = $this.offset().top - bgTarget.offset().top;



            if ($.browser.webkit) {
                //$this.css({'background-image':  imageBlur });
                $this.css({
                    'background-image': 'url(' + imageBlur + ')'
                });
            } else {
                $this.css({
                    'background-image': 'url(' + imageBlur + ')'
                });
            }


            $this.css({
                'background-position': '-' + left + 'px' + ' -' + top + 'px'
            });
            $this.css(methods.fillImage(bgTarget));


            $(window).on('resize', function () {
                left = $this.offset().left - bgTarget.offset().left;
                top = $this.offset().top - bgTarget.offset().top;
                $this.css({
                    'background-position': '-' + left + 'px' + ' -' + top + 'px'
                });
                $this.css(methods.fillImage(bgTarget));
            });

        });
    };

    $.fn.texteffect = function (options) {
        return this.each(function () {
            var $this = $(this),
                textArray = $this.data('text').split('|'),
                textEffect = $this.data('text-effect'),
                splitText = function () {
                    var firstText = $('<span/>', {
                        class: 'ideo-text-item in',
                        html: $this.html()
                    });
                    $this.html(firstText);
                    firstText.data('width', firstText.width());
                    for (var i in textArray) {
                        var text = $('<span/>', {
                            class: 'ideo-text-item',
                            html: textArray[i]
                        }).appendTo($this);
                        text.data('width', text.width());
                    }
                }
            $($this).wrapAll('<span class="ideo-text-effect ' + textEffect + '"/>');

            switch (textEffect) {
                case 'typewriting':
                    $this.text('');
                    $this.typed({
                        strings: textArray,
                        typeSpeed: 0,
                        loop: true,
                        showCursor: false,
                        backDelay: 1000
                    });
                    break;
                case 'slider-fade':
                case 'slider-vertical':
                case 'slider-elastic-in':
                    splitText();

                    var current = 1,
                        length = textArray.length;

                    setInterval(function () {

                        $this.find('.ideo-text-item.out').removeClass('out');
                        $this.find('.ideo-text-item.in').addClass('out').removeClass('in');
                        $this.find('.ideo-text-item').eq(current).removeClass('out').addClass('in');
                        $this.width($($this).find('.ideo-text-item.in').data('width'));

                        if (length > current) {
                            current += 1;
                        } else {
                            current = 0;
                        }

                    }, 2500);
                    break;


            }

        });
    }

    $.preloadImage = function (imageUrl) {
        var added = false;

        $('head').children('link[rel=prefetch]').each(function () {
            if ($(this).attr('href') == imageUrl) {
                added = true;
                return false;
            }
        });

        if (added)
            return;

        $('head').append($('<link>', {
            rel: 'prefetch',
            href: imageUrl
        }));
    }

    $.preloadImageForCard = function (item) {
        if (!item || !item.featured_image)
            return;

        $.preloadImage(item.featured_image);
    }

    for (var i in _ideo.portfolio)
        $.preloadImageForCard(_ideo.portfolio[i]);

    $.fn.ideoModalWindow = function (options, atts) {
        var defaults = {
                openSpeed: 1,
                openEase: Linear.none,
                closeSpeed: 0.5,
                closeEase: Linear.none,
                type: 'horizontal'
            },
            settings = $.extend({}, defaults, options, atts),
            currentIndex = atts.index,
            currentItem = atts.data[currentIndex],
            windowScrollTop = null,
            ajaxContainer = this,
            leftColContent = null,
            leftColContentInner = null,
            leftColImage = null,
            itemName = null,
            itemSub = null,
            itemParams = null,
            itemSocial = null,
            hoverTitle = null,
            hoverImage = null,
            rightColContent = null,
            leftCol = null,
            rightCol = null,
            closeBtn = null,
            prevBtn = null,
            nextBtn = null,
            toggleBtn = null,
            isChanging = false;

        var methods = {
            open: function () {

                windowScrollTop = $(window).scrollTop();

                var modalWindowContent = $('<div class="container-fluid container-full-modal-window"><div class="row type-' + settings.type + '"><div class="col-xs-12 col-md-3 left-col"></div><div class="col-xs-12 col-md-9 right-col"></div></div></div>').appendTo(ajaxContainer);
                leftColContent = $('<div class="item current"></div>');
                leftColContentInner = $('<div class="item-inner"></div>').appendTo(leftColContent);
                rightColContent = $('<div class="modal-window-content"></div>');

                switch (settings.type) {
                    case 'vertical':
                        leftColImage = $('<div class="item-image"><img src="' + currentItem.member_image + '"></div>').appendTo(leftColContentInner);
                        itemName = $('<h1 class="item-name">' + currentItem.member_name + '</h1>').appendTo(leftColContentInner);
                        itemSub = $('<p class="item-subname">' + currentItem.member_position + '</p>').appendTo(leftColContentInner);
                        itemSocial = $('<p class="item-social">' + methods.generateSocialLinks(currentItem.member_social) + '</p>');
                        break;
                    case 'horizontal':
                        leftColImage = $('<div class="bg-image"></div>').appendTo(leftColContentInner);
                        itemName = $('<h1 class="item-name">' + currentItem.title + '</h1>').appendTo(leftColContentInner);
                        itemSub = $('<div class="item-subname">' + currentItem.subtitle + '</div>').appendTo(leftColContentInner);
                        itemParams = $('<div class="item-params">' + methods.generateParams(currentItem) + '</div>').appendTo(leftColContentInner);
                        itemSocial = $('<div class="item-social">' + currentItem.social + '</div>');
                        modalWindowContent.toggleClass('no-subtitle', !currentItem.subtitle)
                        break;
                }

                if (_ideo.settings.portfolio.social_media_share) {
                    itemSocial.appendTo(leftColContentInner);
                }

                var closeWindow = function () {
                    $('html,body').removeClass('overflow');
                    $(window).scrollTop(windowScrollTop);

                    closeBtn.hide();
                    TweenMax.to(leftCol, settings.closeSpeed, {
                        x: is_rtl ? leftCol.outerWidth() : -leftCol.outerWidth(),
                        ease: settings.closeEase,
                        onComplete: function () {
                            ajaxContainer.html('');
                        }
                    });
                    TweenMax.to(rightCol, settings.closeSpeed, {
                        x: is_rtl ? -rightCol.outerWidth() : rightCol.outerWidth(),
                        ease: settings.closeEase,
                        onComplete: function () {}
                    });
                }


                isChanging = false;


                leftCol = ajaxContainer.find('.left-col');
                rightCol = ajaxContainer.find('.right-col');


                leftCol.append(leftColContent);
                rightCol.append(rightColContent);

                hoverImage = $('<div class="hover-image"></div>').appendTo(leftCol);
                hoverTitle = $('<div class="hover-title"><span></span></div>').appendTo(leftCol);

                $('body').on('keyup', function (e) {
                    if (e.keyCode == 27) {
                        closeWindow();
                        $('body').unbind('keypress');
                    }
                });

                closeBtn = $('<a class="close"><span class="hover"></span><span class="id id-close"></span></a>').appendTo(modalWindowContent).on(_eventtype, function (e) {
                    e.preventDefault();
                    closeWindow();
                });

                toggleBtn = $('<a class="toggle"><span class="id id-down"></span></a>').appendTo(leftColContentInner).on(_eventtype, function (e) {
                    e.preventDefault();
                    leftCol.toggleClass('expand');
                    toggleBtn.toggleClass('open');
                });

                nextBtn = $('<a class="browse next hidden-xs"><span class="hover"></span><span class="id"></span></a>').on(_eventtype, function (e) {
                    e.preventDefault();
                    methods.next();

                    if (!isMobile.any) {
                        var nextItem = methods.getNextItem();
                        methods.hoverPreview(nextItem, true);
                    }
                }).appendTo(leftCol);

                if (settings.type == 'horizontal' && !isMobile.any) {
                    nextBtn.on('hover', function (e) {
                        if (e.type == "mouseenter") {
                            var nextItem = methods.getNextItem();
                            hoverTitle.css({
                                textAlign: is_rtl ? 'left' : 'right'
                            });
                            methods.hoverPreview(nextItem);
                        } else { // mouseleave
                            methods.hoverPreviewEnd();

                        }

                    });
                }

                prevBtn = $('<a class="browse prev hidden-xs"><span class="hover"></span><span class="id"></span></a>').on(_eventtype, function (e) {
                    e.preventDefault();
                    methods.prev();
                    if (!isMobile.any) {
                        var prevItem = methods.getPrevItem();
                        methods.hoverPreview(prevItem, true);
                    }
                }).prependTo(leftCol);

                if (settings.type == 'horizontal' && !isMobile.any) {
                    prevBtn.on('hover', function (e) {
                        if (e.type == "mouseenter") {
                            var prevItem = methods.getPrevItem();
                            hoverTitle.css({
                                textAlign: is_rtl ? 'right' : 'left'
                            });
                            methods.hoverPreview(prevItem);
                        } else { // mouseleave
                            methods.hoverPreviewEnd();

                        }

                    });
                }

                if (settings.type == 'vertical' && !currentItem.rel) {
                    nextBtn.css('visibility', 'hidden');
                    prevBtn.css('visibility', 'hidden');
                }

                //                rightCol.swipeleft(function () {
                //                    methods.next();
                //                });
                //                rightCol.swiperight(function () {
                //                    methods.prev();
                //                });
                rightCol.swipeleft(function () {
                    if ($(window).width() < 1200)
                        methods.next();
                });
                rightCol.swiperight(function () {
                    if ($(window).width() < 1200)
                        methods.prev();
                });

                methods.setCss(currentItem);
                methods.animationOpenWindow();


            },
            hoverPreview: function (item, afterClick) {

                var imageCSS = {},
                    duration = 1;


                if (afterClick) {
                    TweenMax.to([hoverTitle.children('span')], 0.5, {
                        alpha: 0,
                        onComplete: function () {
                            methods.hoverPreview(item);
                        }
                    });
                    return 0;
                }

                hoverTitle.children('span').html(item.title);



                TweenMax.set([hoverTitle.children('span')], {
                    alpha: 0
                });
                TweenMax.to([hoverTitle.children('span')], duration, {
                    alpha: 1
                });

            },
            hoverPreviewEnd: function () {
                var duration = 1;
                TweenMax.to([hoverTitle.children('span')], duration, {
                    alpha: 0
                });
            },
            animationOpenWindow: function () {
                var tl = new TimelineLite({
                    paused: false,
                    onComplete: function () {
                        isChanging = false;
                    }
                });

                switch (settings.type) {
                    case 'horizontal':
                        tl.from(leftCol, settings.openSpeed, {
                                x: is_rtl ? leftCol.outerWidth() : -leftCol.outerWidth(),
                                ease: settings.openEase
                            }, "start")
                            .from(rightCol, settings.openSpeed, {
                                x: is_rtl ? -rightCol.outerWidth() : rightCol.outerWidth(),
                                ease: settings.openEase
                            }, "start")
                            .from(prevBtn, settings.openSpeed / 2, {
                                y: '-=100',
                                ease: Linear.none
                            }, "btn")
                            .from(nextBtn, settings.openSpeed / 2, {
                                y: '-=100',
                                ease: Linear.none
                            }, "btn")
                            .from(closeBtn, settings.openSpeed / 2, {
                                y: '-=100',
                                ease: Linear.none
                            }, "btn");
                        break;
                    case 'vertical':
                        tl.from(leftCol, settings.openSpeed, {
                                x: is_rtl ? leftCol.outerWidth() : -leftCol.outerWidth(),
                                ease: settings.openEase
                            }, "start")
                            .from(rightCol, settings.openSpeed, {
                                x: is_rtl ? -rightCol.outerWidth() : rightCol.outerWidth(),
                                ease: settings.openEase
                            }, "start")
                            .from(prevBtn, settings.openSpeed / 2, {
                                y: '-=100',
                                ease: Linear.none
                            }, "btn")
                            .from(nextBtn, settings.openSpeed / 2, {
                                y: '+=100',
                                ease: Linear.none
                            }, "btn")
                            .from(closeBtn, settings.openSpeed / 2, {
                                y: '-=100',
                                ease: Linear.none
                            }, "btn");
                        break;
                }



                isChanging = true;

                methods.animationFillContent();
            },
            animationFillContent: function () {
                rightCol.addClass('loading');
                $.ajax({
                    type: "POST",
                    url: _ideo.ajaxurl,
                    dataType: "html",
                    data: {
                        action: 'loadTeamPostContent',
                        post_id: currentItem.post_id
                    },
                    timeout: 600000,
                    xhrFields: {
                        withCredentials: true
                    },

                    beforeSend: function () {
                        rightCol.addClass('loading').removeClass('loaded');
                    },

                    success: function (data) {
                        //add loaded data
                        rightColContent.html(data);
                        rightCol.addClass('loaded').removeClass('loading');
                        methods.callJSContent();
                        methods.setScroll();
                    }
                });
            },
            setScroll: function () {
                rightCol.on("mousewheel DOMMouseScroll", function (e) {
                    e.stopPropagation();
                });
            },
            callJSContent: function () {
                rightColContent.find('.full-screen-height').ideoFullScreenHeight();
                rightColContent.find('[data-animation-type]').ideoVieweportAnimation({
                    onScreen: false
                });
                rightColContent.find('.ideo-progress-bar').ideoProgressBar({
                    onScreen: false
                });

                rightColContent.find('.ideo-pie-chart').ideoPiechart({
                    onScreen: false
                });
                rightColContent.find('.ideo-counter').ideoCounter({
                    onScreen: false
                });
                rightColContent.find('.ideo-message-box').ideoMessageBox();
                //rightColContent.find('[data-sticky-offset]').stickyColumn();

                rightColContent.find('.ideo-team-box').teamBoxOnClick();
                rightColContent.find('.ideo-team-box-caption').teamBoxOnClick();

                rightColContent.find('.link.icon-info').singleImageOnClick();
                rightColContent.find('.ideo-google-map').ideoGoogleMap();

                rightColContent.find('[data-font]').ideoGoogleFonts();

                if (typeof The_Grid === 'object') {
                    setTimeout(function () {
                        rightColContent.find('.tg-grid-holder').The_Grid();
                    }, 10);
                }

                if ($.isFunction(jQuery.fn.wpcf7InitForm)) {
                    $(function () {
                        _wpcf7.supportHtml5 = $.wpcf7SupportHtml5();
                        rightColContent.find('div.wpcf7 form').attr({
                            'action': window.location.pathname
                        }).wpcf7InitForm();
                    });
                }

                $.fn.initParallax($('.col-xs-12.col-md-9.right-col').first());
                resizeToCover();

                if ($(window).width() > 991) {
                    rightColContent.find('[data-youtube_id]').each(function () {
                        $(this).YTPlayer({
                            videoId: $(this).data('youtube_id')
                        });
                    });
                }
            },
            setCss: function (item) {

                leftCol.css({
                    backgroundColor: item.background_color || '',
                });
                hoverTitle.css({
                    color: item.arrows_color || '',
                    backgroundColor: item.background_color || '',
                });
                closeBtn.css({
                    backgroundColor: item.background_color || '',
                    color: item.arrows_color || '',
                });
                toggleBtn.css({
                    color: item.arrows_color || '',
                });
                closeBtn.find('.hover').css({
                    backgroundColor: item.border_color || ''
                });
                nextBtn.css({
                    color: item.arrows_color || '',
                    borderColor: item.border_color || ''
                });
                nextBtn.find('.hover').css({
                    backgroundColor: item.border_color || '',
                });
                prevBtn.css({
                    color: item.arrows_color,
                    borderColor: item.border_color || '',
                });
                prevBtn.find('.hover').css({
                    backgroundColor: item.border_color || '',
                });
                leftColImage.css({
                    borderColor: item.image_border_color || ''
                });
                itemName.css({
                    color: item.title_font_color || '',
                    fontSize: item.title_font_size == parseInt(item.title_font_size) ? item.title_font_size + 'px' : item.title_font_size || ''
                });
                itemSub.css({
                    color: item.subtitlefont_color || '',
                    fontSize: item.subtitle_font_size == parseInt(item.subtitle_font_size) ? item.subtitle_font_size + 'px' : item.subtitle_font_size || ''
                });
                if (itemParams) {
                    itemParams.find('.params-label').css({
                        color: item.parametrs_label_color || ''
                    });
                    itemParams.find('.params-value').css({
                        color: item.parametrs_value_color || '',
                    });
                    itemParams.find('.params-label, .params-value').css({
                        'font-size': item.parametrs_font_size + 'px'
                    });
                }
                itemSocial.find('a').css({
                    color: item.social_icons_color || ''
                });
                leftColContent.css({
                    textAlign: item.content_align || ''
                }).removeClass('text-left text-right text-center').addClass('text-' + item.content_align);
            },
            setData: function (item) {

                switch (settings.type) {
                    case 'vertical':
                        leftColImage.find('img').attr('src', item.member_image);
                        itemName.html(item.member_name);
                        itemSub.html(item.member_position);
                        itemSocial.html(methods.generateSocialLinks(item.member_social));
                        break;
                    case 'horizontal':
                        //leftColImage.find('img').attr('src', item.member_image);
                        itemName.html(item.title);
                        itemSub.html(item.subtitle);
                        itemParams.html(methods.generateParams(item));
                        itemSocial.html(item.social);
                        $('.container-full-modal-window').toggleClass('no-subtitle', !item.subtitle)
                        break;
                }


            },
            getNextItem: function (diff) {
                if (!diff)
                    diff = 1;

                if (currentIndex < atts.data.length - diff) {
                    return atts.data[currentIndex + diff];
                } else {
                    var newIndex = diff - (atts.data.length - currentIndex);

                    if (newIndex < 0 || newIndex >= atts.data.length)
                        return null;

                    return atts.data[newIndex];
                }
            },
            getPrevItem: function (diff) {
                if (!diff)
                    diff = 1;

                if (currentIndex >= diff) {
                    return atts.data[currentIndex - diff];
                } else {
                    var newIndex = atts.data.length - (diff - currentIndex);

                    if (newIndex < 0 || newIndex >= atts.data.length)
                        return null;

                    return atts.data[newIndex];
                }
            },
            prev: function () {
                if (currentIndex > 0) {
                    methods.change(atts.data[currentIndex - 1], 'prev');
                } else {
                    methods.change(atts.data[atts.data.length - 1], 'prev');
                }
            },
            next: function () {
                if (currentIndex < atts.data.length - 1) {
                    methods.change(atts.data[currentIndex + 1], 'next');
                } else {
                    methods.change(atts.data[0], 'next');
                }
            },
            change: function (item, direction) {
                if (!isChanging) {
                    var animations = [],
                        yOut = '0',
                        yIn = '0',
                        duration = 0.4,
                        animItems = [leftColImage, itemName, itemSub, itemSocial];

                    if (itemParams) {
                        animItems.push(itemParams);
                    }

                    isChanging = true;

                    currentItem = item;
                    currentIndex = atts.data.indexOf(item);


                    if (direction == 'next') {
                        yOut = "-=200";
                        yIn = "+=100";

                    } else {
                        yOut = "+=200";
                        yIn = "-=100";
                        animItems.reverse();
                    }
                    TweenMax.staggerTo(animItems, duration, {
                        y: yOut,
                        alpha: 0,
                        ease: Sine.easeIn,
                        onComplete: function () {
                            methods.setData(item);
                            methods.setCss(item);
                            methods.animationFillContent();

                            TweenMax.set(animItems, {
                                y: 0,
                                alpha: 1
                            });
                            TweenMax.staggerFrom(animItems, duration, {
                                y: yIn,
                                alpha: 0,
                                ease: Sine.easeOut,
                                onComplete: function () {
                                    isChanging = false;
                                }
                            }, 0.1);
                        }
                    }, 0.1);

                }
            },
            reset: function (animation) {},
            generateSocialLinks: function (social) {
                var html = '';

                $.each(social, function (index, link) {
                    if (link != '') {
                        if (index == 'google') {
                            index = 'google-plus'
                        }

                        html += '<a href="' + link + '" target="_blank"><i class="icon fa fa-' + index + '"></i></a>';
                    }
                });

                return html;
            },
            generateParams: function (currentItem) {
                var params_html = '';
                if (currentItem.portfolio_parametrs == '1') {
                    params_html = '<ul class="params ' + (currentItem.parameters_display == 'block' ? 'params--block' : '') + '">';
                    for (var i in currentItem.portfolio_parameters_arr.labels) {
                        params_html += '<li style="display: ' + +'; ' + (currentItem.parameters_display == 'block' ? ' padding: 5px 0px;' : '') + '">';
                        params_html += '<span class="params-label">' + currentItem.portfolio_parameters_arr.labels[i] + ':</span>';
                        if (currentItem.portfolio_parameters_arr.urls[i]) {
                            params_html += '<a href="' + currentItem.portfolio_parameters_arr.urls[i] + '">';
                        }
                        params_html += '<span class="params-value">' + currentItem.portfolio_parameters_arr.values[i] + '</span>';
                        if (currentItem.portfolio_parameters_arr.urls[i]) {
                            params_html += '</a>';
                        }
                        params_html += '</li>';
                    }
                    params_html += '<ul>';
                }
                return params_html;
            }
        }

        if (typeof options === 'string') {
            methods[options].apply();
        } else {

        }

        return this;

    }

    $.fn.singleImageOnClick = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options);

        return this.each(function () {
            var $singleImage = $(this);

            $singleImage.on(_eventtype, function (e) {
                e.preventDefault();
                var $this = $(this),
                    rel = $this.attr('rel'),
                    items = $('a[rel="' + rel + '"]'),
                    index = 0,
                    data = [];

                //fix advancet carusel
                if ($singleImage.closest('.ult-item-wrap').length > 0) {
                    items = $('.ult-item-wrap:not(.slick-cloned) a[rel="' + rel + '"]')
                }

                if (rel != '') {
                    index = items.index($this),
                        $.each(items, function (idx, item) {
                            data.push({
                                title: $(item).attr('title') + '<span>' + $(item).data('desc') + '</span>',
                                src: $(item).attr('href')
                            });
                        });
                } else {
                    data.push({
                        title: $this.attr('title') + '<span>' + $this.data('desc') + '</span>',
                        src: $this.attr('href')
                    });
                }

                $.magnificPopup.open({
                    type: 'image',
                    removalDelay: 500,
                    gallery: {
                        enabled: true
                    },
                    items: data,
                    callbacks: {
                        beforeOpen: function () {
                            // just a hack that adds mfp-anim class to markup
                            this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                            this.st.mainClass = 'mfp-' + _ideo.settings.lightbox_entry_animation;
                        },
                        change: function () {
                            var img = this.currItem.img;
                            var holder = img.parents('figure').css({
                                'visibility': 'hidden',
                                'opacity': 0
                            });

                            img.css({
                                'max-height': parseFloat(img.css('max-height')) * 0.85 + 'px'
                            });

                            setTimeout(function () {
                                var bottomBar = holder.find('.mfp-bottom-bar');
                                var padding = bottomBar.outerHeight();

                                img.css({
                                    'padding-bottom': padding + 'px'
                                });
                                bottomBar.css('margin-top', -1 * padding + 'px');

                                holder.css('visibility', 'visible').animate({
                                    'opacity': 1
                                }, 500);
                            }, 200);
                        }
                    }
                });
                var magnificPopup = $.magnificPopup.instance;
                magnificPopup.goTo(index);
            });



        });
    }

    $.fn.teamBoxOnClick = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options);

        return this.each(function () {
            var $teamBox = $(this);

            if ($teamBox.hasClass('link-lightbox')) {
                $teamBox.find('a.overlay').on('click', function (e) {
                    e.preventDefault();

                    if (_pc && _pc.customizer) return false;

                    var $this = $(this),
                        rel = $this.attr('rel'),
                        items = $('a[rel="' + rel + '"]'),
                        index = 0,
                        data = [];



                    if (rel != '') {
                        index = items.index($this);
                        $.each(items, function (idx, item) {
                            data.push({
                                title: $(item).attr('title') + ' <span>' + $(item).data('desc') + '</span>',
                                src: $(item).attr('href')
                            });
                        });
                    } else {
                        data.push({
                            title: $this.attr('title') + ' <span>' + $this.data('desc') + '</span>',
                            src: $this.attr('href')
                        });
                    }

                    $.magnificPopup.open({
                        type: 'image',
                        removalDelay: 500,
                        gallery: {
                            enabled: true
                        },
                        items: data,
                        callbacks: {
                            beforeOpen: function () {
                                // just a hack that adds mfp-anim class to markup
                                this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                                this.st.mainClass = 'mfp-' + _ideo.settings.lightbox_entry_animation;
                            },
                            change: function () {
                                var img = this.currItem.img;
                                var holder = img.parents('figure').css({
                                    'visibility': 'hidden',
                                    'opacity': 0
                                });

                                img.css({
                                    'max-height': parseFloat(img.css('max-height')) * 0.85 + 'px'
                                });

                                setTimeout(function () {
                                    var bottomBar = holder.find('.mfp-bottom-bar');
                                    var padding = bottomBar.outerHeight();

                                    img.css({
                                        'padding-bottom': padding + 'px'
                                    });
                                    bottomBar.css('margin-top', -1 * padding + 'px');

                                    holder.css('visibility', 'visible').animate({
                                        'opacity': 1
                                    }, 500);
                                }, 200);
                            }
                        }
                    });
                    var magnificPopup = $.magnificPopup.instance;
                    magnificPopup.goTo(index);
                });
            }

            if ($teamBox.hasClass('link-modern')) {

                $teamBox.find('a.overlay').on('click', function (e) {
                    e.preventDefault();

                    $('body').addClass('overflow');

                    var $this = $(this),
                        rel = $this.attr('rel'),
                        items = $('.link-modern a[rel="' + rel + '"]'),
                        index = 0,
                        itemsData = [];

                    if (rel != '') {
                        index = items.index($this);
                        $.each(items, function (idx, item) {
                            var itemData = $(item).data('json');
                            itemData.rel = rel;
                            itemsData.push(itemData);
                        });

                    } else {
                        index = 0;
                        items.push($this);
                        itemsData.push($this.data('json'));
                    }

                    $('#ajax-container').ideoModalWindow('open', {
                        index: index,
                        type: 'vertical',
                        data: itemsData,
                        openSpeed: $this.data('easing-in-time'),
                        openEase: $this.data('easing-in-animation'),
                        closeSpeed: $this.data('easing-out-time'),
                        closeEase: $this.data('easing-out-animation')
                    });

                });
            }


        });
    }

    $.fn.ideoFullScreenHeight = function (options, atts) {
        var defaults = {},
            settings = $.extend({}, defaults, options);

        var methods = {
            setHeight: function ($this) {
                var height = $(window).height();
                $this.css({
                    height: height
                });
            },
        }

        if (typeof options === 'string') {
            methods[options].apply();
        } else {
            return this.each(function () {
                var $this = $(this);

                methods.setHeight($this);

                $(window).on('resize', function () {
                    methods.setHeight($this);
                });

            });
        }
    }

    $.fn.ideoScollLine = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options),
            $this = $(this),
            $line = $('<i/>', {
                id: 'scroll-line'
            });

        if (!$this.length) {
            return false;
        }

        $this.find('nav').prepend($line);

        var setScollLine = function () {
            if ($this.find('nav').hasClass('navbar-sticky')) {
                var height = $(document).height() - $(window).height(),
                    width = height > 0 ? $(window).scrollTop() * 100 / height : 100;
                $line.css({
                    width: width + '%'
                });
            } else {
                $line.css({
                    width: 0
                });
            }
        }
        $(document).on('ready', function () {
            setScollLine();
        });

        $(window).on('scroll onScrollUpdate.PC resize', function () {
            setScollLine();
        });

    }

    $.fn.ideoActiveLine = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options),
            $this = $(this),
            $links = $this.find('.navbar-menu>li'),
            $line = $('<i/>', {
                id: 'active-line'
            }).appendTo($this);

        if (!$this.length) return false;

        var setActiveLine = function () {
            if ($(".navbar-menu").length) {
                var active = $('.navbar-nav>.active:last>a'),
                    width = active.length ? active.outerWidth() : $(".navbar-menu>li:first").outerWidth(),
                    left = active.length ? active.offset().left : $(".navbar-menu>li:first").offset().left - 50,
                    opacity = $line.data('origOpacity', opacity) === 'undefined' ? $line.data('origOpacity', opacity) : active.length ? 1 : 0;

                $line.css({
                    width: width,
                    left: left,
                    opacity: opacity,
                }).data('origWidth', width).data('origLeft', left).data('origOpacity', opacity);
            }
        }
        setTimeout(function () {
            setActiveLine();
        }, 125);

        $links.hover(function () {
            var active = $(this),
                width = active.outerWidth(),
                left = active.offset().left;

            $line.css({
                width: width,
                left: left,
                opacity: 1
            });
        }, function () {
            $line.css({
                width: $line.data('origWidth'),
                left: $line.data('origLeft'),
                opacity: $line.data('origOpacity')
            });
        });

        $(window).on('resize stickyChange', function () {
            setActiveLine();
        });


    }

    $.fn.ideoLeftMenu = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options),
            $this = $(this);

        if (!$this.length) return false;

        $this.find('a').on('click', function (e) {
            var $a = $(this);

            if ($a.parent().children('.dropmenu').length) {
                e.preventDefault();
                if ($a.parent().hasClass('active')) {

                    $a.next().slideUp('slow', function () {
                        $a.parent().removeClass('active');
                    });
                } else {

                    $a.parent().addClass('activating');
                    $a.next().slideDown('slow', function () {
                        $a.parent().addClass('active').removeClass('activating');
                    });
                }
            }

        });

        var deltaFactor = 250;
        $this.on('mousewheel', function (event) {
            event.preventDefault();
            if ($this.children().height() > $(window).height()) {
                event.stopPropagation();
            }
            $this.stop().animate({
                scrollTop: $this.scrollTop() - (event.deltaY * deltaFactor)
            });
        });

    }

    $.fn.ideoGoogleMap = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options);

        var methods = {
            setBounds: function (points, map) {
                var bounds = new google.maps.LatLngBounds();
                $.each(points, function (idx, point) {
                    var position = new google.maps.LatLng(point.lat, point.lng);
                    bounds.extend(position);
                });
                map.fitBounds(bounds);
            }
        }

        this.each(function () {
            var $this = $(this);

            var $map = $this.find('.ideo-google-map-canvas'),
                bounds = $map.data('bounds'),
                centermap = parseInt($map.data('centermap') || 0),
                markers = $map.data('markers'),
                zoom = $map.data('zoom'),
                markerIcon = $map.data('icon'),
                hue = $map.data('hue'),
                style = $map.data('stylers'),
                style_array = $map.data('style-array'),
                scrollwheel = $map.data('scrollwheel'),
                maptype = $map.data('map-type'),
                draggable = $map.data('draggable'),
                controls = $map.data('controls');

            var mapOptions = {
                center: new google.maps.LatLng(markers[centermap].lat, markers[centermap].lng),
                zoom: zoom,
                scrollwheel: scrollwheel,
                disableDefaultUI: controls,
                draggable: draggable,
                mapTypeId: maptype || google.maps.MapTypeId.ROADMAP
            };
            var styleArray;

            if (style) {
                styleArray = [{
                    stylers: style.stylers
                }];
            } else if (style_array) {
                styleArray = style_array;
            }



            var gmap = new google.maps.Map($map.get(0), mapOptions);

            gmap.setOptions({
                styles: styleArray
            });

            $.each(markers, function (idx, marker) {
                var pos = new google.maps.LatLng(marker.lat, marker.lng),
                    marker = new google.maps.Marker({
                        position: pos,
                        map: gmap,
                        title: marker.text,
                        icon: markerIcon
                    }),
                    infowindow = null;


                google.maps.event.addListener(marker, _eventtype, function () {
                    infowindow = new google.maps.InfoWindow({
                        content: marker.title
                    });
                    infowindow.open(gmap, marker);
                });
            });
            if (!bounds && markers.length > 1) {
                methods.setBounds(markers, gmap);
            }
        });
    }

    $.fn.essentialGridSetup = function (options) {
        var defaults = {
                accentColor: options.accentColor || _ideo.settings.accent_color,
                modalWindow: false,
                modalWindowLinking: '.tp-esg-item',
                easingIn: 'Linear',
                easingOut: 'Linear',
                easingInDuration: 1.5,
                easingOutDuration: 1.5
            },
            settings = $.extend({}, defaults, options),
            $essgrid = $(this);

        if (!$essgrid.length) return false;

        var timer = null;

        timer = setInterval(function () {
            if ($essgrid.find('.tp-esg-item').length > 0) {
                clearInterval(timer);
                init();
            }
        }, 100);


        var ideo_generateCss = function (navigationType, id) {

            id = "#" + id + "-wrap";


            switch (navigationType) {
                case 'scl':
                    var tmpCss = "" + id + " .esg-sorting-select:focus { border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-colored-light .eg-search-submit { background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-colored-light .eg-search-input:focus { border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-colored-light .esg-sortbutton-order { background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".standard-colored-light .esg-navigationbutton:hover," + id + ".standard-colored-light .esg-filterbutton:hover," + id + ".standard-colored-light .esg-cartbutton a:hover," + id + ".standard-colored-light .esg-filterbutton.selected  {background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".standard-colored-light .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";

                    return tmpCss;
                    break;


                case 'scd':
                    var tmpCss = "" + id + ".standard-colored-dark .eg-search-submit { background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-colored-dark .eg-search-input:focus { border:1px solid " + settings.accentColor + " }";
                    tmpCss += "" + id + ".standard-colored-dark .esg-sortbutton-order { background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".standard-colored-dark .esg-navigationbutton:hover," + id + ".standard-colored-dark .esg-filterbutton:hover," + id + ".standard-colored-dark .esg-cartbutton a:hover," + id + ".standard-colored-dark .esg-filterbutton.selected { background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-colored-dark .esg-dropdown-wrapper .esg-filterbutton.selected," + id + ".standard-colored-dark .esg-dropdown-wrapper .esg-filterbutton:hover{ background-color:" + settings.accentColor + " !important; }";
                    //					tmpCss+= ".standard-colored-dark .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-colored-dark .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";

                    return tmpCss;
                    break;

                case 'stl':
                    var tmpCss = "" + id + ".standard-transparent-light .eg-search-submit { background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-light .eg-search-input:focus { border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-light .esg-sortbutton-order { background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".standard-transparent-light .esg-navigationbutton:hover," + id + ".standard-transparent-light .esg-filterbutton:hover," + id + ".standard-transparent-light .esg-cartbutton a:hover," + id + ".standard-transparent-light .esg-filterbutton.selected { background-color:" + settings.accentColor + "; border: 1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-light .esg-sortbutton:active { border: 1px solid " + settings.accentColor + "; }";
                    //					tmpCss+= ".standard-transparent-light .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-light .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";

                    return tmpCss;
                    break;

                case 'std':
                    var tmpCss = "" + id + ".standard-transparent-dark .eg-search-submit { background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-dark .eg-search-input:focus { border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-dark .esg-sortbutton-order { background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".standard-transparent-dark .esg-navigationbutton:hover," + id + ".standard-transparent-dark .esg-filterbutton:hover," + id + ".standard-transparent-dark .esg-cartbutton a:hover," + id + ".standard-transparent-dark .esg-filterbutton.selected { background-color:" + settings.accentColor + "; border: 1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-dark .esg-sortbutton:active { border: 1px solid " + settings.accentColor + "; }";
                    //					tmpCss+= ".standard-transparent-dark .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-dark .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".standard-transparent-dark .esg-left," + id + ".standard-transparent-dark .esg-right {background-color: " + ideo_addOpacity(settings.accentColor, 0.2) + " !important;}";

                    return tmpCss;
                    break;



                case 'mcl':
                    var tmpCss = "" + id + ".modern-colored-light .esg-left{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important }";
                    tmpCss += "" + id + ".modern-colored-light .esg-right{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-colored-light .esg-pagination-button:hover{ background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .eg-search-submit{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .eg-search-input:focus{ border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .esg-sortbutton-order{ background-color: " + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".modern-colored-light .esg-pagination-button.selected{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .magic-line{ background: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .eg-el-amount{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .esg-dropdown-wrapper .esg-filterbutton:hover," + id + ".modern-colored-light .esg-dropdown-wrapper .esg-filterbutton.selected{ background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-light .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";
                    //					tmpCss+= ".modern-colored-light .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";

                    return tmpCss;
                    break;


                case 'mcd':
                    var tmpCss = "" + id + ".modern-colored-dark .esg-left{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-right{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-pagination-button:hover{ background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .eg-search-submit{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .eg-search-input:focus{ border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-sortbutton-order{ background-color: " + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-pagination-button.selected{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .magic-line{ background: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .eg-el-amount{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-dropdown-wrapper .esg-filterbutton:hover{ background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-colored-dark .esg-filter-wrapper.dropdownstyle .esg-filterbutton.selected { background-color: " + settings.accentColor + " !important; color:white; }";
                    //					tmpCss+= ".modern-colored-dark .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";


                    return tmpCss;
                    break;


                case 'mtl':
                    var tmpCss = "" + id + ".modern-transparent-light .esg-left{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-right{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-pagination-button:hover{ background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .eg-search-submit{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .eg-search-input:focus{ border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-sortbutton-order{ background-color: " + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-pagination-button.selected{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .magic-line{ background: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .eg-el-amount{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-dropdown-wrapper .esg-filterbutton:hover{ background-color:" + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-light .esg-filter-wrapper.dropdownstyle .esg-filterbutton.selected { background-color: " + settings.accentColor + " !important; color:white; }";
                    //					tmpCss+= ".modern-transparent-light .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";

                    return tmpCss;
                    break;


                case 'mtd':
                    var tmpCss = "" + id + ".modern-transparent-dark .esg-left{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-right{ background-image: linear-gradient(to left, " + settings.accentColor + " 50%, rgba(255,255,255,0) 50%) !important; }";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-pagination-button:hover{ background-color:" + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .eg-search-submit{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .eg-search-input:focus{ border:1px solid " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-sortbutton-order{background-color: " + settings.accentColor + " !important; }";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-pagination-button.selected{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .magic-line{ background: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .eg-el-amount{ background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-dropdown-wrapper .esg-filterbutton:hover{ background-color:" + settings.accentColor + " !important;}";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-selected-filterbutton i { background-color: " + settings.accentColor + "; }";
                    tmpCss += "" + id + ".modern-transparent-dark .esg-filter-wrapper.dropdownstyle .esg-filterbutton.selected { background-color: " + settings.accentColor + " !important; color:white; }";
                    //					tmpCss+= ".modern-transparent-dark .esg-sorting-select option { border: 1px solid " + settings.accentColor + "; }";





                    return tmpCss;
                    break;




            }


        }

        var ideo_hexToRgb = function (hex) {
            var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
            return result ? {
                r: parseInt(result[1], 16),
                g: parseInt(result[2], 16),
                b: parseInt(result[3], 16)
            } : null;
        }

        var ideo_addOpacity = function (hex, value) {
            var rgb = ideo_hexToRgb(hex);
            return "rgba(" + rgb.r + "," + rgb.g + "," + rgb.b + "," + value + ")";
        }

        var modalWindowInit = function () {
            //modalWindow

            var modalWindowLinking = settings.modalWindowLinking;

            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio_1-wrapper')) {
                modalWindowLinking = '.eg-portfolio_1-element-6, .eg-portfolio_1-element-3';
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-2-wrapper')) {
                //default
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-3-wrapper')) {
                modalWindowLinking = '.eg-portfolio-3-element-4, .eg-portfolio-3-element-9';
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-4-wrapper')) {
                modalWindowLinking = '.eg-portfolio-4-element-2, .eg-portfolio-4-element-3';
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-4-2-wrapper')) {
                modalWindowLinking = '.eg-portfolio-4-2-element-2, .eg-portfolio-4-2-element-3';
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-5-wrapper')) {
                modalWindowLinking = '.eg-portfolio-5-element-1, .eg-portfolio-5-element-4';
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-6-wrapper')) {
                //default
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-7-wrapper')) {
                //default
            }
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-8-wrapper')) {
                modalWindowLinking = '.eg-portfolio-8-element-2, .eg-portfolio-8-element-3';
            }


            if (settings.modalWindow && modalWindowLinking) {


                $essgrid.find(modalWindowLinking).on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();

                    //open window
                    $('body').addClass('overflow');

                    var $this = $(this),
                        items = $essgrid.find(modalWindowLinking),
                        index = 0,
                        itemsData = [],
                        ids = [];



                    var idIndex = $this.closest('.tp-esg-item').attr("class").match(/eg-post-id-([0-9]+)/)[1];

                    $.each(items, function (idx, item) {
                        var postID = null;
                        if ($(item).hasClass('tp-esg-item')) {
                            postID = $(item).attr("class").match(/eg-post-id-([0-9]+)/)[1];
                        } else {
                            postID = $(item).closest('.tp-esg-item').attr("class").match(/eg-post-id-([0-9]+)/)[1];
                        }
                        if (postID && ids.indexOf(postID) == -1) {
                            $(item).data('json', _ideo.portfolio[postID]);
                            itemsData.push($(item).data('json'));
                            ids.push(postID);
                        }
                    });

                    index = ids.indexOf(idIndex);


                    $('#ajax-container').ideoModalWindow('open', {
                        index: index,
                        data: itemsData,
                        type: 'horizontal',
                        openSpeed: settings.easingInDuration,
                        openEase: settings.easingIn,
                        closeSpeed: settings.easingOutDuration,
                        closeEase: settings.easingOut
                    });
                });
            }

        }

        var init = function () {




            var portfolioContainer = $essgrid.parent().parent();

            //define actual nav class
            var actualNav = false;
            if (portfolioContainer.hasClass('standard-colored-light')) actualNav = 'scl';
            if (portfolioContainer.hasClass('standard-colored-dark')) actualNav = 'scd';
            if (portfolioContainer.hasClass('standard-transparent-light')) actualNav = 'stl';
            if (portfolioContainer.hasClass('standard-transparent-dark')) actualNav = 'std';

            if (portfolioContainer.hasClass('modern-colored-light')) actualNav = 'mcl';
            if (portfolioContainer.hasClass('modern-colored-dark')) actualNav = 'mcd';
            if (portfolioContainer.hasClass('modern-transparent-light')) actualNav = 'mtl';
            if (portfolioContainer.hasClass('modern-transparent-dark')) actualNav = 'mtd';

            //load css for specifed navigation
            jQuery('head').append("<style>" + ideo_generateCss(actualNav, $essgrid.attr('id')) + "</style>");



            // Load JS for modern or standard navigation
            if (portfolioContainer.length > 0) {
                if (
                    portfolioContainer.hasClass('modern-colored-dark') ||
                    portfolioContainer.hasClass('modern-colored-light') ||
                    portfolioContainer.hasClass('modern-transparent-dark') ||
                    portfolioContainer.hasClass('modern-transparent-light')
                ) {

                    jQuery('.esg-navigationbutton.esg-right').html('<i class="id id-right-arrow"></i>');
                    jQuery('.esg-navigationbutton.esg-left').html('<i class="id id-left-arrow"></i>');
                    jQuery('.esg-sortbutton-order').removeClass('eg-icon-down-open').addClass('id id-right-arrow');
                    jQuery('.esg-filter-wrapper.dropdownstyle .esg-selected-filterbutton i').removeClass('eg-icon-down-open').addClass('id id-right-arrow');
                    jQuery('.esg-filter-wrapper').not('.dropdownstyle').find('.esg-filterbutton').last().addClass('filter-button-big-margin');

                    setTimeout(function () {

                        if (jQuery(".esg-filter-wrapper:not(.dropdownstyle)").find(".esg-filterbutton").find('.eg-el-amount').length == 0) {
                            jQuery(".esg-filter-wrapper:not(.dropdownstyle)").find(".esg-filterbutton").attr('style', 'padding-left:25px !important;padding-right:25px !important;');
                        }


                        var $el, leftPos, newWidth,
                            $mainNav = jQuery(".esg-filter-wrapper:not(.dropdownstyle):not(.eg-search-wrapper)"),
                            $trueMainNav = jQuery();
                        $mainNav.each(function () {
                            if (jQuery(this).find('.esg-filterbutton').length > 0)
                                $trueMainNav.push(this);
                        });
                        $mainNav = $trueMainNav;

                        $mainNav.append("<div class='magic-line'></div>");
                        var $magicLine = jQuery(".magic-line");

                        $magicLine.each(function () {
                            var self = jQuery(this);
                            var newLeft = self.parent().find('.selected').position().left;
                            self.width(self.parent().find('.selected').css('width'));
                            self.css("left", newLeft);
                            self.data("origLeft", self.position().left);
                            self.data("origWidth", self.css('width'));
                        });
                        jQuery(".esg-filter-wrapper:not(.dropdownstyle)").find(".esg-filterbutton").hover(function () {
                            $el = jQuery(this);
                            leftPos = $el.position().left;
                            newWidth = $el.css('width');

                            $el.parents('div').find('.magic-line').stop().animate({
                                left: leftPos,
                                width: newWidth
                            }, 100);
                        }, function () {
                            var $el = jQuery(this);

                            $el.parents('div').find('.magic-line').stop().animate({
                                left: jQuery(".esg-filter-wrapper:not(.dropdownstyle)").find(".esg-filterbutton.selected").position().left,
                                width: jQuery(".esg-filter-wrapper:not(.dropdownstyle)").find(".esg-filterbutton.selected").css('width')
                            });
                        });
                    }, 500);

                } else if (
                    portfolioContainer.hasClass('standard-colored-dark') ||
                    portfolioContainer.hasClass('standard-colored-light') ||
                    portfolioContainer.hasClass('standard-transparent-dark') ||
                    portfolioContainer.hasClass('standard-transparent-light')
                ) {
                    jQuery('.esg-navigationbutton.esg-right').html('<i class="id id-right-arrow"></i>');
                    jQuery('.esg-navigationbutton.esg-left').html('<i class="id id-left-arrow"></i>');
                    jQuery('.esg-sortbutton-order').removeClass('eg-icon-down-open').addClass('id id-right-arrow');
                    jQuery('.esg-filter-wrapper.dropdownstyle .esg-selected-filterbutton i').removeClass('eg-icon-down-open').addClass('id id-right-arrow');


                }
            }




            // BLOG 1 
            if ($essgrid.find('.tp-esg-item').hasClass('eg-blog-1-wrapper')) {

                // CODE FROM API/Javascript 
                var interval_b1 = 0;

                var ideot_initPortfolios_b1 = function () {
                    var color_b1 = settings.accentColor;

                    jQuery('.eg-blog-1-content').each(function () {
                        jQuery(this).css('padding', '0px');

                        var date = jQuery(this).find('.eg-blog-1-element-12').html();
                        var expDate = date.split(' ');

                        var data = jQuery(this).find('div');
                        jQuery(this).html('<div style="width:25%;height:100%;float:left;" class="left-bar"></div> <div style="width:75%;float:left;height:100%;padding-right:10px;padding-left:10px;"class="right-bar"></div>');

                        data.appendTo(jQuery(this).find('.right-bar'));
                        jQuery(this).find('.left-bar').html('<span class="b1_day" style="background-color:' + color_b1 + '">' + expDate[0] + '</span><span class="b1_month">' + (expDate[1].substr(0, 3)) + '</span><span class="b1_year">' + expDate[2] + '</span>');
                        var barH = parseInt(jQuery(this).find('.right-bar').css('height'))
                        jQuery(this).find('.left-bar').css('height', barH + 'px');
                        $essgrid.esquickdraw();
                    });
                }

                var ideot_detectElements_b1 = function () {
                    if (parseInt(jQuery('.eg-blog-1-element-1').css('height')) > 0) {
                        interval_b1 = clearInterval(interval_b1);
                        setTimeout(function () {
                            ideot_initPortfolios_b1();
                        }, 450);
                    }
                }

                var ideot_init_b1 = function () {
                    interval_b1 = setInterval(function () {
                        ideot_detectElements_b1()
                    }, 100);
                }

                ideot_init_b1();
            }

            // BLOG 2 
            if ($essgrid.find('.tp-esg-item').hasClass('eg-blog-2-wrapper')) {

                var interval_b2 = 0;

                var ideot_initPortfolios_b2 = function () {

                    jQuery('.eg-blog-2-element-8').each(function () {
                        var href = jQuery(this).attr('href');
                        var block = jQuery(this).parent('div').parent('div').parent('div');

                        jQuery(this).parent('div').parent('div').parent('div').parent('li').append('<a href="' + href + '" class="static-link"></a>');
                        block.appendTo(jQuery(this).parent('div').parent('div').parent('div').parent('li').find('.static-link'));

                    });


                    var color_b2 = jQuery('.eg-blog-2-container').css('background-color');
                    var color_b2_2 = jQuery('.eg-blog-2-element-8').css('color');
                    jQuery('.eg-blog-2-element-8').append('<span class="btn-special-wrap"><span class="triangle-wrap"><i class="triangle-body" style="background-color:' + color_b2_2 + '"></i></span><span class="square" style="background-color:' + color_b2_2 + '"><i class="id id-interface-21"></i></span></span>');

                    jQuery('.eg-blog-2-content').prepend('<div class="up-triangle"></div>');
                }

                var ideot_detectElements_b2 = function () {
                    if (parseInt(jQuery('.eg-blog-2-element-1').css('height')) > 0) {
                        interval_b2 = clearInterval(interval_b2);
                        setTimeout(function () {
                            ideot_initPortfolios_b2();
                        }, 450);
                    }
                }

                var ideot_init_b2 = function () {
                    interval_b2 = setInterval(function () {
                        ideot_detectElements_b2()
                    }, 100);
                }

                ideot_init_b2();

            }

            // BLOG 3
            if ($essgrid.find('.tp-esg-item').hasClass('eg-blog-3-wrapper')) {
                var interval_b3 = 0;

                var ideot_initPortfolios_b3 = function () {

                    jQuery('.eg-blog-3-element-8').each(function () {
                        var href = jQuery(this).attr('href');
                        var block = jQuery(this).parent('div').parent('div').parent('div');

                        jQuery(this).parent('div').parent('div').parent('div').parent('li').append('<a href="' + href + '" class="static-link"></a>');
                        block.appendTo(jQuery(this).parent('div').parent('div').parent('div').parent('li').find('.static-link'));

                    });

                    var color_b2 = jQuery('.eg-blog-3-container').css('background-color');
                    var color_b2_2 = jQuery('.eg-blog-3-element-8').css('color');

                    jQuery('.eg-blog-3-element-8').append('<span class="btn-special-wrap"><span class="triangle-wrap"><i class="triangle-body" style="background-color:' + color_b2_2 + '"></i></span><span class="square" style="background-color:' + color_b2_2 + '"><i class="id id-interface-21"></i></span></span>');

                    jQuery('.eg-blog-3-content').prepend('<div class="up-triangle"></div>');
                }

                var ideot_detectElements_b3 = function () {
                    if (parseInt(jQuery('.eg-blog-3-element-1').css('height')) > 0) {
                        interval_b3 = clearInterval(interval_b3);
                        setTimeout(function () {
                            ideot_initPortfolios_b3();
                        }, 450);
                    }
                }

                var ideot_init_b3 = function () {
                    interval_b3 = setInterval(function () {
                        ideot_detectElements_b3()
                    }, 100);
                }

                ideot_init_b3();

            }

            // BLOG 4
            if ($essgrid.find('.tp-esg-item').hasClass('eg-blog-4-wrapper')) {

                jQuery(".eg-blog-4-element-2").each(function () {
                    var get_date = jQuery(this).html();
                    var date_exp = get_date.split(' ');
                    var shortMonth = date_exp[1];
                    shortMonth = shortMonth.substring(0, 3);
                    jQuery(this).html('<span class="circle_date_big"><span>' + date_exp[0] + '</span><br><span class="s-month">' + shortMonth + '</span></span>');

                });

            }

            // BLOG 5
            if ($essgrid.find('.tp-esg-item').hasClass('eg-blog-5-wrapper')) {

                jQuery(".eg-blog-5-element-1").each(function () {
                    var get_date = jQuery(this).html();
                    var date_exp = get_date.split(' ');
                    var shortMonth = date_exp[1];
                    shortMonth = shortMonth.substring(0, 3);
                    jQuery(this).html('<span class="square_date_big">' + date_exp[0] + '</span><br>' + shortMonth);

                });
            }

            // PORTFOLIO 2
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-2-wrapper')) {

                var intervalp2 = 0;

                var ideot_initPortfolio2 = function () {

                    setTimeout(function () {
                        jQuery('.eg-portfolio-2-wrapper .esg-cc').each(function () {
                            var width = jQuery(this).find('.eg-portfolio-2-element-1').css('width');

                            jQuery(this).append('<div class="border" style="width:' + width + ';"></div>');
                        });
                    }, 120);

                    $essgrid.esquickdraw();

                }

                var ideot_detectElementsP2 = function () {
                    if (parseInt(jQuery('.eg-portfolio-2-element-1').css('width')) > 0) {
                        intervalp2 = clearInterval(intervalp2);
                        setTimeout(function () {
                            ideot_initPortfolio2();
                        }, 10);
                    }
                }

                var ideot_initP2 = function () {
                    intervalp2 = setInterval(function () {
                        ideot_detectElementsP2()
                    }, 100);
                }

                ideot_initP2();

            }

            // PORTFOLIO 8
            if ($essgrid.find('.tp-esg-item').hasClass('eg-portfolio-8-wrapper')) {
                jQuery('.eg-portfolio-8-element-1-a, .eg-portfolio-8-element-2-a').hover(function () {
                    jQuery(this).animate({
                        'top': '-4px'
                    }, 250);
                }, function () {
                    jQuery(this).animate({
                        'top': '0px'
                    }, 250);
                });
            }

            // TEAM 1
            if ($essgrid.find('.tp-esg-item').hasClass('eg-team-1-wrapper')) {

                var interval = 0;

                var ideot_resizeTeam1 = function () {

                }

                var ideot_initTeam1 = function () {


                    var team_1_height = parseInt(jQuery('.eg-team-1-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').height()) - 40;
                    var team_1_border_color = jQuery('.esg-content a i').css('color');
                    jQuery('.eg-team-1-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').addClass('circle-team-1').css({
                        'position': 'relative',
                        'width': team_1_height + 'px',
                        'height': team_1_height + 'px',
                        'border': '6px solid ' + team_1_border_color
                    });
                    //jQuery('.eg-team-1-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media').append('<span class="ext-circle" style="width:'+(team_1_height+12)+'px;height:'+(team_1_height+12)+'px;background-color:'+team_1_border_color+';display:block;margin:0px auto;border-radius:100%;position:absolute;left:0px;right:0px;margin-top:14px;"></span>');
                    jQuery('.eg-team-1-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper').css('height', jQuery('.eg-team-1-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper').css('width') + 'px');


                    jQuery('.eg-team-1-element-4').each(function () {
                        var href = jQuery(this).attr('href');
                        var img = jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('img');
                        var emptySpan = "<span style='display: inline-block;height: 100%;vertical-align: middle;'></span>";



                        jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').append('<a href="' + href + '" class="static-link"></a>');
                        img.appendTo(jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('.static-link'));
                        jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('.static-link').prepend(emptySpan);
                    });

                    $essgrid.esquickdraw();

                }

                var ideot_detectElements = function () {
                    if (parseInt(jQuery('.eg-team-1-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').css('height')) > 0) {
                        interval = clearInterval(interval);
                        setTimeout(function () {
                            ideot_initTeam1();
                        }, 450);
                    }
                }

                var ideot_init = function () {
                    interval = setInterval(function () {
                        ideot_detectElements()
                    }, 100);
                }

                ideot_init();

                jQuery(window).resize(function () {
                    setTimeout(function () {
                        ideot_resizeTeam1();
                    }, 450);
                });

            }

            // TEAM 2
            if ($essgrid.find('.tp-esg-item').hasClass('eg-team-2-wrapper')) {

                var interval2 = 0;

                var ideot_initTeam2 = function () {

                    jQuery('.eg-invisiblebutton').each(function () {
                        var href = jQuery(this).attr('href');
                        var block = jQuery(this).parent('div').parent('div');

                        jQuery(this).parent('div').parent('div').parent('li').append('<a href="' + href + '" class="static-link"></a>');
                        block.appendTo(jQuery(this).parent('div').parent('div').parent('li').find('.static-link'));

                    });
                }

                var ideot_detectElements2 = function () {
                    if (parseInt(jQuery('.eg-team-2-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').css('height')) > 0) {
                        interval2 = clearInterval(interval2);
                        setTimeout(function () {
                            ideot_initTeam2();
                        }, 450);
                    }
                }

                var ideot_init2 = function () {
                    interval2 = setInterval(function () {
                        ideot_detectElements2()
                    }, 100);
                }

                ideot_init2();

            }

            // TEAM 3
            if ($essgrid.find('.tp-esg-item').hasClass('eg-team-3-wrapper')) {

                var interval3 = 0;

                var ideot_initTeam3 = function () {


                    var team_3_height = parseInt(jQuery('.eg-team-3-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').height()) - 40;
                    var team_3_height = parseInt(team_3_height / 2) * 2;
                    var team_3_border_color = jQuery('.esg-content a i').css('color');
                    jQuery('.eg-team-3-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').addClass('circle-team-3').css({
                        'position': 'relative',
                        'width': team_3_height + 'px',
                        'height': team_3_height + 'px',
                        'border': '1px solid transparent'
                    });
                    jQuery('.eg-team-3-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper').css('height', jQuery('.eg-team-3-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper').css('width') + 'px');


                    jQuery('.eg-team-3-element-6').each(function () {
                        var href = jQuery(this).attr('href');
                        var img = jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('img');
                        var emptySpan = "<span style='display: inline-block;height: 100%;vertical-align: middle;'></span>";

                        var imgHeight = team_3_height + 'px';
                        var imgMargin = (-1 * parseInt(team_3_height / 2)) + 'px';

                        //var afterCircle = "<span class='circle-team-3-after' style='width:"+imgHeight+";height:"+imgHeight+";left:50%;top:50%;margin-left:"+imgMargin+" !important;margin-top:"+imgMargin+" !important;'></span>";


                        var fakeDiv = "<div class='circle-team-3' style='position:relative;width:" + team_3_height + "px;height:" + team_3_height + "px;border:1px solid transparent;background:url(" + img.attr('src') + ");'></div>";
                        img.remove();
                        jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').append('<a href="' + href + '" class="static-link"></a>');

                        jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('.static-link').append(fakeDiv);
                        jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('.static-link').prepend(emptySpan);

                        //jQuery(this).parent('div').parent('div').parent('div').find('.esg-entry-media-wrapper').find('.esg-entry-media').find('.static-link').append(afterCircle);


                    });

                    $essgrid.esquickdraw();
                }

                var ideot_detectElements3 = function () {
                    if (parseInt(jQuery('.eg-team-3-wrapper .esg-media-cover-wrapper .esg-entry-media-wrapper .esg-entry-media img').css('height')) > 0) {
                        interval3 = clearInterval(interval3);
                        setTimeout(function () {
                            ideot_initTeam3();
                        }, 450);
                    }
                }

                var ideot_init3 = function () {
                    interval3 = setInterval(function () {
                        ideot_detectElements3()
                    }, 100);
                }

                ideot_init3();

            }

            if (settings.modalWindow) {
                modalWindowInit();
            }

        }
    }

    $.fn.theGridSetup = function (options) {
        var $tgrid = $(this);

        if ($tgrid.is('.tg-grid-initialized')) {
            // when there are more grids with the same id it is necessary
            // to find grid that is was not initialized yet
            $tgrid = $(':not(.tg-grid-initialized)#' + $tgrid.attr('id'));
            if ($tgrid.length == 0)
                return;
        }

        $tgrid.addClass('tg-grid-initialized');

        var defaults = {
                accentColor: options.accentColor || _ideo.settings.accent_color,
                modalWindow: false,
                modalWindowLinking: '.tg-item-link,.tg-media-button,a',
                easingIn: 'Linear',
                easingOut: 'Linear',
                easingInDuration: 1.5,
                easingOutDuration: 1.5
            },
            settings = $.extend({}, defaults, options);

        $tgrid.find(settings.modalWindowLinking).addClass('js--no-load');

        $tgrid.on('click', settings.modalWindowLinking, function (e) {
            if ($(this).is('.no-ajaxy,.tg-media-button,.tg-facebook,.tg-twitter,.tg-google1,.tg-pinterest,.tg-page-number'))
                return true;

            var $this = $(this),
                items = $tgrid.find('.tg-item'),
                index = 0,
                itemsData = [],
                ids = [];

            var indexId = parseInt($this.closest('.tg-item').attr('class').match(/tg-post-([0-9]+)/)[1]);

            $.each(items, function (idx, item) {
                var postID = parseInt($(item).attr('class').match(/tg-post-([0-9]+)/)[1]);

                if (postID && ids.indexOf(postID) == -1) {
                    if (_ideo.portfolio[postID] !== undefined) {
                        $(item).data('json', _ideo.portfolio[postID]);
                        itemsData.push($(item).data('json'));
                        ids.push(postID);
                    }
                }
            });

            index = ids.indexOf(indexId);

            if (index === -1)
                return true;

            e.preventDefault();
            e.stopPropagation();

            $('body').addClass('overflow');

            $('#ajax-container').ideoModalWindow('open', {
                index: index,
                data: itemsData,
                type: 'horizontal',
                openSpeed: settings.easingInDuration,
                openEase: settings.easingIn,
                closeSpeed: settings.easingOutDuration,
                closeEase: settings.easingOut
            });
        });

        var ajaxCardId = null;

        if (_ideo.ajax_card) {
            ajaxCardId = _ideo.ajax_card;
        }

        if (window.location.hash) {
            var match = window.location.hash.match(/#ajax_card=([0-9]+)/i);

            if (match) {
                ajaxCardId = match[1];

            }
        }

        if (ajaxCardId) {
            var card = $tgrid.find('.tg-post-' + ajaxCardId + ' a:not(.no-ajaxy):not(.tg-media-button):not(.tg-facebook):not(.tg-twitter):not(.tg-google1):not(.tg-pinterest):not(.tg-page-number)').first();
            if (card.length > 0)
                card.click();
        }

    }

    $.fn.stickyColumn = function (options) {
        var defaults = {
                mobileSize: 768
            },
            settings = $.extend({}, defaults, options);


        return this.each(function () {
            var $this = $(this),
                $thisWaypoint = null,
                offset = parseInt($this.data('sticky-offset')),
                heightContainer = $this.outerHeight(),
                topContainer = $this.offset().top,
                stickyElement = $this.children('.wpb_wrapper'),
                stickyElementHeight = stickyElement.outerHeight(),
                isSticky = $this.hasClass('sticky'),
                isMobile = $(window).width() < settings.mobileSize;


            var setPosition = function () {
                var scrollVal = $(window).scrollTop(),
                    stickyElementPos = scrollVal + stickyElementHeight,
                    containerPos = topContainer + heightContainer;

                if (isSticky && !isMobile) {
                    var pos = heightContainer - (scrollVal - topContainer + stickyElementHeight + offset);
                    if (pos < 0) {
                        stickyElement.css({
                            top: offset + pos
                        });
                    } else {
                        stickyElement.css({
                            top: offset
                        });
                    }
                }
            }

            var destroy = function () {
                if (isSticky) {
                    $this.removeClass('sticky');
                    stickyElement.css({
                        top: '',
                        width: ''
                    });
                }
            }
            var reinit = function () {
                if (isSticky) {
                    heightContainer = $this.outerHeight();
                    topContainer = $this.offset().top;
                    stickyElementHeight = stickyElement.outerHeight();

                    $this.removeClass('sticky');
                    stickyElement.css({
                        top: '',
                        width: ''
                    });
                    stickyElement.css({
                        top: offset,
                        width: stickyElement.width()
                    });
                    $this.addClass('sticky');
                    setPosition();

                }
            }
            var init = function () {
                $thisWaypoint = $this.waypoint(function (direction) {
                    if (!isMobile) {
                        stickyElement.css({
                            top: direction === 'down' ? offset : '',
                            width: direction === 'down' ? stickyElement.width() : ''
                        });

                        $this.toggleClass('sticky', direction === 'down');
                        isSticky = $this.hasClass('sticky');
                        setPosition();
                    }

                }, {
                    offset: offset + 'px'
                });
            }

            init();

            $(window).on('scroll', function () {
                setPosition();
            });

            $(window).on('resize', function () {
                isMobile = $(window).width() < settings.mobileSize;
                if (isMobile) {
                    destroy();
                } else {
                    reinit();
                }
            });

        });
    }

    $.fn.ideoGoogleFonts = function (options) {
        var defaults = {},
            settings = $.extend({}, defaults, options),
            google_fonts = [];

        var addFont = function (font) {
            var fontdata = font.split('|'),
                family = fontdata[0].replace(/\s/g, '+'),
                subset = '';

            if (fontdata[1]) {
                family += ':' + fontdata[1];
            }

            if (fontdata[2]) {
                subset = '&subset=' + fontdata[2];
            }

            if (google_fonts.indexOf(font) == -1) {
                google_fonts.push(font);
                $("head").append("<link />");
                var gf = $("head").children(":last");

                gf.attr({
                    "class": 'pc_google_fonts',
                    "rel": "stylesheet",
                    "type": "text/css",
                    "href": "//fonts.googleapis.com/css?family=" + family + subset
                });
            }
        }


        return this.each(function () {
            var $this = $(this),
                font = $this.data('font');

            addFont(font);

        });
    }

})(jQuery);