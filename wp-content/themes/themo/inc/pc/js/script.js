TweenMax.defaultOverwrite = "all";

var _pc = _pc || {};
var tl = null;
var google_fonts = [];


(function ($, pc) {
    "use strict";

    var $window = $(window);
    var isFreezEnabled = false;
    var count = 0;
    var audioLayers = [];

    pc.placeholders = [];


    var createTimeLine = function () {

        tl = null;
        tl = new TimelineMax({
            useFrames: true,
            paused: true,
            onUpdate: function () {}
        });

        tl.addLabel("start", 0);
    };

    var getAnimationKeysProp = function (animation) {

        var props = [];
        _.each(animation, function (key) {
            props.push(Object.keys(key));
        });

        return _.reject(_.uniq(_.flatten(props)), function (prop) {
            return prop == 'frame';
        });
    };

    var generateSingleTween = function (layer, animation, prop) {

        var el = $('[data-id="' + layer.id + '"]'),
            tweenArray = [],
            prevKey = {};

        if (el.length == 0) return false;

        isFreezEnabled = false;

        if ((layer.display && layer.type != 'audio') || (layer.activity && layer.type == 'audio')) {

            _.each(animation, function (key, index) {
                var value = key[prop],
                    keyAnimation = {},
                    inFreez = 0;


                if (layer.freezArray) inFreez = _.sortedIndex(layer.freezArray, key.frame) % 2;


                if (layer.type == 'audio' || prop == 'volume') {
                    if (prop == 'volume') {
                        var volume = $('#sound-' + layer.id).data('volume');
                        volume.push([key.frame, value.value]);
                        $('#sound-' + layer.id).data('volume', volume);
                    }
                } else {


                    if (key.top && key.top.label == 'stopFreez') {
                        isFreezEnabled = false;
                    }

                    if (typeof value.value != 'undefined' && typeof value.value != 'object') {
                        if (isFreezEnabled && prop == 'top' && index > 0 && index < animation.length - 1) {
                            //skip top                        
                        } else {
                            keyAnimation = calcValue(el, key, prop, layer, isFreezEnabled);
                        }
                        keyAnimation.ease = "Linear.easeNone";

                        if (key.top && key.top.label == 'startFreez') {
                            isFreezEnabled = true;
                        }

                        if (index === 0) {
                            TweenMax.set(el, keyAnimation);
                            if (key.top && key.top.label == 'startFreez' && prop == 'top') {
                                tweenArray.push(new TweenMax(el, 0, calcTopStartFreez(el, value, key, layer.align, layer)));
                            } else {}


                            prevKey = key;
                        } else {

                            var duration = key.frame - prevKey.frame;
                            keyAnimation.delay = prevKey.frame;

                            if (key.top && key.top.label == 'startFreez' && prop == 'top') {
                                tweenArray.push(new TweenMax(el, 0, calcTopStartFreez(el, value, key, layer.align, layer)));
                            }


                            if (key.top && key.top.label == 'stopFreez' && prop == 'top') {
                                tweenArray.push(new TweenMax(el, 0, calcTopStopFreez(el, value, key, layer.align, keyAnimation.top, layer)));
                            } else {
                                tweenArray.push(new TweenMax(el, duration, keyAnimation));
                            }

                            if (isFreezEnabled && prop == 'top' && typeof value.label == 'undefined') {
                                //skip top
                            } else {
                                prevKey = key;
                            }
                        }
                    }
                }
            });

        }

        if (tweenArray.length) {
            tl.insertMultiple(tweenArray);
        }

    };

    var generateTweenLines = function (layer, animation) {

        var tls = [],
            porityArray = ["width", "height"],
            animationKeysProp = getAnimationKeysProp(animation);


        function sortFunc(a, b) {
            var porityArray = ["height", "width"];
            return porityArray.indexOf(b) - porityArray.indexOf(a);
        }

        animationKeysProp.sort(sortFunc);


        _.each(animationKeysProp, function (prop) {
            var keyWithProp = _.filter(animation, function (key) {
                return typeof key[prop] != 'undefined';
            });
            generateSingleTween(layer, keyWithProp, prop);
        });
    };

    var buildTimeLine = function (data) {

        var pageID = $('body').data('id').toString(),
            scrollPos = window.pageYOffset || 0;

        if (typeof data == 'object') {
            _.each(data[pageID], function (section) {
                var $section = $('[data-id="' + section.id + '"]');
                if (section.type == 'page-section' && !$section.hasClass('parallax')) return false;
                _.each(section.nodes, function (layer) {
                    var $layer = $('[data-id="' + layer.id + '"]');
                    if (layer.type == 'vc' && (!$layer.hasClass('parallax') && !$layer.hasClass('pc-clone'))) return false;

                    if ((layer.display && layer.type != 'audio') || (layer.activity && layer.type == 'audio')) {
                        var animation = _.indexBy(layer.animation, 'frame');
                        var tweenLines = generateTweenLines(layer, animation);
                    }

                    _.each(layer.nodes, function (layer_1st) {
                        var $layer_1st = $('[data-id="' + layer_1st.id + '"]');
                        if (layer_1st.type == 'vc' && (!$layer_1st.hasClass('parallax') && !$layer_1st.hasClass('pc-clone'))) return false;
                        if ((layer_1st.display && layer_1st.type != 'audio') || (layer_1st.activity && layer_1st.type == 'audio')) {
                            var animation = _.indexBy(layer_1st.animation, 'frame');
                            var tweenLines = generateTweenLines(layer_1st, animation);

                        }
                        _.each(layer_1st.nodes, function (layer_2nd) {
                            var $layer_2nd = $('[data-id="' + layer_2nd.id + '"]');
                            if (layer_2nd.type == 'vc' && (!$layer_2nd.hasClass('parallax') && !$layer_2nd.hasClass('pc-clone'))) return false;
                            if ((layer_2nd.display && layer_2nd.type != 'audio') || (layer_2nd.activity && layer_2nd.type == 'audio')) {
                                var animation = _.indexBy(layer_2nd.animation, 'frame');
                                var tweenLines = generateTweenLines(layer_2nd, animation);
                            }
                        });
                    });
                });
            });
        }

        tl.addCallback(function () {}, 0);

        tl.seek(1);
        tl.seek(scrollPos);

    };
    var calcRSOffset = function (el, scrollTop) {
        var pos = $(el).parent().offset().top - scrollTop,
            pos2 = pos + $(el).parent().height(),
            s = $(el).parent().offset().top + $(el).parent().outerHeight() - $(window).height() - scrollTop,
            w = scrollTop + $(window).height();

        if (pos < -1) pos = 0;
        if (s < -1) pos = s;

        return pos;
    }
    var calcTopStartFreez = function (el, value, key, align, layer) {

        var align = align || "0% 0%",
            frame = {
                className: '+=freez',
                delay: key.frame,
                ease: "Linear.easeNone"
            };

        align = align.split(' ');

        if (align[0] == '50%') {}
        if (align[0] == '100%') {
            frame['marginRight'] = parseInt(el.parent().offset().left + 0);
        } else {
            frame['marginLeft'] = parseInt(el.parent().offset().left + 0);
        }

        if (align[1] == '50%') {
            if (layer.relative2screen == true) {
                frame['top'] = parseInt(parseInt(value.value) + el.parent().height() / 2 - el.height() / 2 + calcRSOffset(el.parent(), key.frame));
            } else {
                frame['top'] = parseInt(parseInt(value.value) + el.parent().outerHeight() / 2 + (parseInt(el.parent().offset().top) - parseInt(key.frame)) - el.height() / 2);
            }
        } else if (align[1] == '100%') {
            if (layer.relative2screen == true) {
                var rsOffset = calcRSOffset(el.parent(), key.frame);
                frame['bottom'] = parseInt(value.value) - rsOffset;

            } else {
                frame['bottom'] = parseInt(value.value) + $(window).height() - (parseInt(el.parent().offset().top) - parseInt(key.frame) + el.parent().outerHeight());
            }
        } else {

            if (layer.relative2screen == true) {
                frame['top'] = parseInt(parseInt(value.value) + calcRSOffset(el.parent(), key.frame));
            } else {
                frame['top'] = parseInt(parseInt(value.value) + (parseInt(el.parent().offset().top) - parseInt(key.frame)));
            }
        }

        return frame;


    }
    var calcTopStopFreez = function (el, value, key, align, top, layer) {

        var align = align || "0% 0%",
            frame = {
                className: '-=freez',
                delay: key.frame,
                marginLeft: 0,
                marginRight: 0,
                ease: "Linear.easeNone"
            };

        align = align.split(' ');

        if (align[1] == '50%') {
            if (layer.relative2screen == true) {
                var rsOffset = calcRSOffset(el.parent(), key.frame);
                var startFreezKey = _.find(layer.animation, function (frame) {
                    if (frame.top && frame.top.freezId == key.top.freezId) {
                        return true;
                    }
                    return false;
                });
                var duration = key.frame - startFreezKey.frame;

                if (rsOffset == 0) {
                    frame['top'] = el.parent().height() / 2 - el.height() / 2 + parseInt(value.value) - duration + calcRSOffset(el.parent(), startFreezKey.frame);
                } else if (rsOffset < 0) {
                    frame['top'] = el.parent().height() / 2 - el.height() / 2 + parseInt(value.value) + rsOffset - calcRSOffset(el.parent(), startFreezKey.frame);
                } else {
                    frame['top'] = el.parent().height() / 2 - el.height() / 2 + parseInt(value.value);
                }
            } else {
                frame['top'] = el.parent().outerHeight() / 2 - el.height() / 2 + parseInt(value.value);
            }
        } else if (align[1] == '100%') {
            if (layer.relative2screen == true) {
                var rsOffset = calcRSOffset(el.parent(), key.frame);
                var startFreezKey = _.find(layer.animation, function (frame) {
                    if (frame.top && frame.top.freezId == key.top.freezId) {
                        return true;
                    }
                    return false;
                });
                var duration = key.frame - startFreezKey.frame;
                frame['bottom'] = parseInt(value.value) - duration - calcRSOffset(el.parent(), startFreezKey.frame) + rsOffset;;

            } else {
                frame['bottom'] = -parseInt(value.value);
            }
        } else {
            if (layer.relative2screen == true) {
                var rsOffset = calcRSOffset(el.parent(), key.frame);
                var startFreezKey = _.find(layer.animation, function (frame) {
                    if (frame.top && frame.top.freezId == key.top.freezId) {
                        return true;
                    }
                    return false;
                });
                var duration = key.frame - startFreezKey.frame;

                if (rsOffset == 0) {
                    frame['top'] = parseInt(value.value) - duration + calcRSOffset(el.parent(), startFreezKey.frame);
                } else if (rsOffset < 0) {
                    frame['top'] = parseInt(startFreezKey.top.value - rsOffset) + calcRSOffset(el.parent(), startFreezKey.frame);
                } else {
                    frame['top'] = parseInt(value.value);
                }
            } else {
                frame['top'] = top;
            }
        }

        frame['top'] = parseInt(frame['top']);

        return frame;
    }

    var calcValue = function (el, key, prop, layer, inFreez) {
        var out = {},
            value = key[prop],
            setValue = value.value.toString(),
            align = layer.align || "0% 0%";

        align = align.split(' ');


        if (value.precent) {
            setValue = setValue + '%';
        }

        if (prop == 'left') {
            if (align[0] == '100%') {
                if (value.precent) {
                    setValue = value.value * el.parent().outerWidth() / 100;
                } else {
                    setValue = value.value;
                }

                prop = "right";
                out["left"] = "auto";

            } else if (align[0] == '50%') {
                var center = el.parent().outerWidth() / 2 - el.outerWidth() / 2;

                if (value.precent) {
                    setValue = center + value.value * el.parent().outerWidth() / 100;
                } else {
                    setValue = center + value.value;
                }

            } else {

            }
        }
        if (prop == 'top') {
            if (align[1] == '100%') {
                if (value.precent) {
                    setValue = value.value * el.parent().outerHeight() / 100;
                } else {
                    setValue = value.value;
                }
                prop = "bottom";
                out["top"] = "auto";

            } else if (align[1] == '50%') {
                var center = el.parent().outerHeight() / 2 - el.height() / 2;

                if (value.precent) {
                    setValue = center + value.value * el.parent().outerHeight() / 100;
                } else {
                    setValue = center + value.value;
                }

            } else {

            }

        }


        if (prop == 'width') {

            if (layer.relative2screen) {
                if (value.precent) {
                    setValue = el.parent().width() * (value.value / 100);
                }
            }
        }

        if (prop == 'height') {
            if (layer.relative2screen) {
                if (value.precent) {
                    if (layer.type == 'image') {
                        setValue = el.parent().height() * (value.value / 100);
                    }

                    if (layer.type == 'multi') {
                        setValue = el.parent().height() * (value.value / 100);
                    }
                }
            }
        }
        if (prop == 'letterSpacing') {
            if (parseInt(value.value) == value.value) {
                setValue = value.value + 'px';
            }
        }

        if (setValue == parseInt(setValue)) {
            setValue = parseInt(setValue);
        }

        out[prop] = setValue;

        return out;

    }

    var setCSS = function (layer, node, scrollPos) {
        var frame = node.animation[scrollPos];


        if (typeof node.display != 'undefined') {
            layer.css({
                display: node.display ? (node.type == 'text-block' ? 'flex' : 'block') : 'none'
            });
        }
        if (typeof node.overflow != 'undefined' && node.overflow) {
            layer.css({
                overflow: 'hidden'
            });
        }
        if (typeof node.backgroundSize != 'undefined') {
            layer.css({
                backgroundSize: node.backgroundSize
            });
        }
        if (typeof node.backgroundPosition != 'undefined') {
            layer.css({
                backgroundPosition: node.backgroundPosition
            });
        }
        if (typeof node.backgroundRepeat != 'undefined') {
            layer.css({
                backgroundRepeat: node.backgroundRepeat
            });
        }
        if (typeof node.image != 'undefined') {
            if (node.image.url) {
                layer.css({
                    'background-image': 'url(' + node.image.url + ')'
                });
            }
        }

        if (node.scale) layer.addClass('scaled');

        if (typeof node.transformOrigin != 'undefined') {
            layer.css({
                transformOrigin: node.transformOrigin
            });
        }
        if (node.backfaceVisibility) {
            layer.css({
                backfaceVisibility: 'visible'
            });
        } else {
            layer.css({
                backfaceVisibility: 'hidden'
            });
        }
        if (node.letterSpacing) {
            layer.css({
                letterSpacing: node.letterSpacing + 'px'
            });
        }
        if (node.perspective) {
            layer.css({
                perspective: node.perspective + 'px'
            });
        }
        if (node.color && node.type == 'nullobject') {

            layer.css({
                color: node.color
            });
            layer.find('.cross').css({
                color: node.color
            });
            layer.find('.circle').css({
                backgroundColor: node.color
            });
        }

    };
    var setFonts = function (layer, data) {
        var font = '',
            variant = '',
            weight = '',
            style = '';

        if (!data.fontFamily)
            return false;

        font = data.fontFamily.family;
        variant = data.fontWeight;
        weight = parseInt(variant);

        if (variant && variant.indexOf('italic') !== -1) {
            style = 'italic';
        }

        if (!google_fonts[font]) {
            google_fonts[font] = [];
        }
        if (variant && google_fonts[font].indexOf(variant) == -1)
            google_fonts[font].push(variant);

        layer.css({
            fontFamily: font,
            fontWeight: weight,
            fontStyle: style,
        });
    }
    var renderNodes = function (element, nodes, parent) {
        if (typeof nodes == 'object' && element) {
            for (var j in nodes) {
                
                if (nodes[j].preview === false && window.parent.location.href !== location.href) {

                } else {
                    if (typeof nodes[j] == 'object' && ((nodes[j].activity && nodes[j].type == 'audio') || nodes[j].type != 'audio')) {

                        var contentBefore = element.children('.pc-content.before'),
                            contentAfter = element.children('.pc-content.after'),
                            rsBefore = element.children('.pc-r2s.before'),
                            rsAfter = element.children('.pc-r2s.after'),
                            target = null;

                        target = contentBefore;

                        if (nodes[j].relative2screen == true && !nodes[j].zIndex) {
                            target = rsBefore;
                            target.removeClass('empty');
                        }
                        if (nodes[j].relative2screen == false && nodes[j].zIndex) {
                            target = contentAfter;
                        }
                        if (nodes[j].relative2screen == true && nodes[j].zIndex) {
                            target = rsAfter;
                            target.removeClass('empty');
                        }

                        if (nodes[j].relative2screenDisableOptimization == true) {
                            target.parent().addClass('pc-r2s-disableop');
                        }

                        if (parent.type != 'page-section') {
                            target = element;
                        }

                        if (parent.type == 'global') {
                            target = element;
                            if (nodes[j].relative2screen == true) {
                                target = rsAfter;
                                target.removeClass('empty');
                            }
                        }


                        switch (nodes[j].type) {
                            case 'image':

                                if (!nodes[j].displayLG && window.innerWidth > 1199) {
                                    continue;
                                }
                                if (!nodes[j].displayMD && window.innerWidth < 1200 && window.innerWidth > 991) {
                                    continue;
                                }
                                if (!nodes[j].displaySM && window.innerWidth < 992 && window.innerWidth > 767) {
                                    continue;
                                }
                                if (!nodes[j].displayXS && window.innerWidth < 768) {
                                    continue;
                                }

                                var layer = $('<div/>', {
                                    'data-id': nodes[j].id,
                                    'data-title': nodes[j].title,
                                    'class': "pc-layer image",
                                }).prependTo(target);

                                setCSS(layer, nodes[j], 0);
                                break;
                            case 'nullobject':

                                if (!nodes[j].displayLG && window.innerWidth > 1199) {
                                    continue;
                                }
                                if (!nodes[j].displayMD && window.innerWidth < 1200 && window.innerWidth > 991) {
                                    continue;
                                }
                                if (!nodes[j].displaySM && window.innerWidth < 992 && window.innerWidth > 767) {
                                    continue;
                                }
                                if (!nodes[j].displayXS && window.innerWidth < 768) {
                                    continue;
                                }
                                var layer = $('<div/>', {
                                    'data-id': nodes[j].id,
                                    'class': "pc-layer nullobject",
                                }).prependTo(target);

                                $('<span/>', {
                                    class: 'icon-nullobject',
                                    html: '<i class="circle"></i><i class="cross"></i>'
                                }).appendTo(layer);


                                setCSS(layer, nodes[j], 0);
                                break;
                            case 'multi':

                                if (!nodes[j].displayLG && window.innerWidth > 1199) {
                                    continue;
                                }
                                if (!nodes[j].displayMD && window.innerWidth < 1200 && window.innerWidth > 991) {
                                    continue;
                                }
                                if (!nodes[j].displaySM && window.innerWidth < 992 && window.innerWidth > 767) {
                                    continue;
                                }
                                if (!nodes[j].displayXS && window.innerWidth < 768) {
                                    continue;
                                }

                                var layer = $('<div/>', {
                                    'data-id': nodes[j].id,
                                    'data-frames': nodes[j].multiimages.length,
                                    'data-ppf': nodes[j].ppf,
                                    'data-loopnum': nodes[j].loopnum,
                                    'data-loop': nodes[j].loop,
                                    'data-start': nodes[j].start,
                                    'data-stop': nodes[j].stop,
                                    'class': "pc-layer multi"
                                }).prependTo(target);

                                var imagesPlaceholder = $('<div/>', {
                                    'class': "pc-images-placeholder",
                                }).appendTo(layer);

                                var images = [];
                                var multiimages = _.sortBy(nodes[j].multiimages, function (o) {
                                    return o.url;
                                });


                                pc.placeholders[nodes[j].id] = [];

                                for (var index in multiimages) {
                                    images.push(multiimages[index].url);

                                    var img = new Image();
                                    img.src = multiimages[index].url;

                                    pc.placeholders[nodes[j].id].push(img);

                                    $('<img/>', {
                                        src: multiimages[index].url
                                    }).appendTo(imagesPlaceholder);

                                }
                                setCSS(layer, nodes[j], 0);

                                break;
                            case 'audio':
                                var layerAudio = _.find(audioLayers, function (audio) {
                                    return audio.id == nodes[j].id;
                                });
                                if (layerAudio) {
                                    layerAudio.audio.src = nodes[j].audio.url;
                                    layerAudio.audio.load();
                                    layerAudio.audio.loop = nodes[j].loop;
                                } else {
                                    var aud = new Audio();
                                    aud.src = nodes[j].audio.url;
                                    aud.loop = nodes[j].loop;
                                    audioLayers.push({
                                        id: nodes[j].id,
                                        audio: aud,
                                        data: nodes[j]
                                    });
                                }

                                break;
                            case 'vc': //TAG vc
                                var layer = vcColumn2PC('[data-id="' + nodes[j].id + '"]'),
                                    source = $('[data-source="' + nodes[j].id + '"]');

                                if (layer) {

                                    if (parent.type != 'page-section') {
                                        var parentElement = $('[data-id="' + parent.id + '"]');
                                        layer.prependTo(parentElement);
                                    } else if (target) {
                                        layer.prependTo(target);
                                    } else {
                                        layer.prependTo(source);
                                    }


                                    if (!nodes[j].displayLG) {
                                        layer.addClass('hidden-lg');
                                    } else {
                                        layer.removeClass('hidden-lg')
                                    }
                                    if (!nodes[j].displayMD) {
                                        layer.addClass('hidden-md');
                                    } else {
                                        layer.removeClass('hidden-md')
                                    }
                                    if (!nodes[j].displaySM) {
                                        layer.addClass('hidden-sm');
                                    } else {
                                        layer.removeClass('hidden-sm')
                                    }
                                    if (!nodes[j].displayXS) {
                                        layer.addClass('hidden-xs');
                                    } else {
                                        layer.removeClass('hidden-xs')
                                    }

                                    setCSS(layer, nodes[j], 0);
                                }
                                break;

                            case 'text':
                                if (!nodes[j].displayLG && window.innerWidth > 1199) {
                                    continue;
                                }
                                if (!nodes[j].displayMD && window.innerWidth < 1200 && window.innerWidth > 991) {
                                    continue;
                                }
                                if (!nodes[j].displaySM && window.innerWidth < 992 && window.innerWidth > 767) {
                                    continue;
                                }
                                if (!nodes[j].displayXS && window.innerWidth < 768) {
                                    continue;
                                }
                                var layer = $('<div/>', {
                                    'data-id': nodes[j].id,
                                    'class': "pc-layer text",
                                    'html': nodes[j].text
                                }).prependTo(target);

                                setCSS(layer, nodes[j], 0);
                                setFonts(layer, nodes[j]);
                                break;
                            case 'text-block':
                                if (!nodes[j].displayLG && window.innerWidth > 1199) {
                                    continue;
                                }
                                if (!nodes[j].displayMD && window.innerWidth < 1200 && window.innerWidth > 991) {
                                    continue;
                                }
                                if (!nodes[j].displaySM && window.innerWidth < 992 && window.innerWidth > 767) {
                                    continue;
                                }
                                if (!nodes[j].displayXS && window.innerWidth < 768) {
                                    continue;
                                }

                                var layer = $('<div/>', {
                                    'data-id': nodes[j].id,
                                    'class': "pc-layer text-block " + (nodes[j].alignHorizontal || '') + " " + (nodes[j].alignVertical || ''),
                                    'html': '<div class="">' + nodes[j].text + '<div/>'
                                }).prependTo(target);

                                setCSS(layer, nodes[j], 0);
                                setFonts(layer, nodes[j]);
                                break;
                            case 'shape':

                                if (!nodes[j].displayLG && window.innerWidth > 1199) {
                                    continue;
                                }
                                if (!nodes[j].displayMD && window.innerWidth < 1200 && window.innerWidth > 991) {
                                    continue;
                                }
                                if (!nodes[j].displaySM && window.innerWidth < 992 && window.innerWidth > 767) {
                                    continue;
                                }
                                if (!nodes[j].displayXS && window.innerWidth < 768) {
                                    continue;
                                }

                                var layer = $('<canvas/>', {
                                    'id': nodes[j].id,
                                    'data-id': nodes[j].id,
                                    'class': "pc-layer shape",
                                }).attr('width', nodes[j].width || 300).attr('height', nodes[j].height || 300).prependTo(target);

                                setCSS(layer, nodes[j], 0);


                                var canvas = layer[0];
                                if (canvas) {
                                    var ctx = canvas.getContext("2d");

                                    try {
                                        $('.error-js').remove();
                                        if (nodes[j].display) {
                                            eval(nodes[j].code);
                                        }
                                    } catch (e) {

                                        $().pcAlert({
                                            class: 'error error-js',
                                            text: 'ERROR',
                                            msg: " (" + nodes[j].title + ") " + e.message
                                        });
                                    }
                                }

                                break;
                        }

                        if (pc.settings) {
                            if (pc.settings.displayLayerNamesType == 'all') {
                                $('<span class="pc-element-name">' + nodes[j].title + '</span>').appendTo(layer);
                            }
                            if (pc.settings.displayLayerNamesType == 'hover') {
                                $('<span class="pc-element-name hidden">' + nodes[j].title + '</span>').appendTo(layer);
                            }
                        }

                        if (nodes[j].nodes) {
                            renderNodes(layer, nodes[j].nodes, nodes[j]);
                        }
                    }
                }
            }
        }
    };

    var debuger = function (data) {
        var html = '';
        _.each(data, function (section, index) {
            html += '' + section.title + " ->  <strong>" + section.offsetTop + " (" + section.height + ")</strong>\n";
            _.each(section.nodes, function (layer, index) {
                html += '  ' + layer.title + "\n";
                var animation = getAnimationKeysProp(layer.animation);
                _.each(layer.animation, function (key, index) {
                    if (key.top) {
                        html += '      frame: ' + key.frame + "(" + (key.frame - section.offsetTop) + ")" + " ->  " + key.top.value + " | " + key.top.label + "\n";
                    }

                });
            });
        });

        return html;
    }

    var buildHtml = function (data) {
        //TAG buildHtml
        var pageID = $('body').data('id'),
            globalSection = $('.pc-global-section'),
            sections = [];

        if (data) sections = data[pageID];

        $('.pc-element').remove();
        $('.pc-layer').remove();
        $('.pc-clone').remove();
        $('[data-source]').each(function (i, el) {
            $(el).attr('data-id', $(el).attr('data-source'));
            $(el).removeClass('pc-invisibility');
            $(el).removeClass('pc-source');
            $(el).children().removeClass('pc-invisibility');
        });
        $('pre').remove();

        if (globalSection.length == 0) {
            globalSection = $('<div class="pc-global-section"><div class="pc-r2s after empty"></div></div>').prependTo('body');
        }
        if (pc.settings) {
            if (pc.settings.displayContentWidthBorder) {
                var pcContentBorder = $('<div class="pc-element pc-content-border"></div>').appendTo('body');
                var layout_site_width = parseInt(_ideo.settings.generals.layout_site_width);
                if (_ideo.settings.generals.layout_boxed_version == "true") {
                    layout_site_width = $('#page-container > .container').width();
                } else {
                    layout_site_width = $('#content > .container').width() || $('.container').eq(2).width();
                }
                pcContentBorder.css({
                    width: parseInt(layout_site_width)
                });
            }
        }


        if (pageID) {
            for (var i in sections) {
                var elem = $('[data-id="' + sections[i].id + '"]');
                if (sections[i].type == 'global') {
                    elem = globalSection;
                }
                renderNodes(elem, sections[i].nodes, sections[i]);
                if (pc.settings) {

                    if (pc.settings.displaySectionBorder) {
                        if (sections[i].type != 'global') {
                            $(elem).children('.pc-element-name').remove();
                            $('<span class="pc-element-name">' + sections[i].title + '</span>').appendTo(elem);
                            $(elem).addClass('pc-grid');
                        }
                    } else {
                        $(elem).children('.pc-element-name').remove();
                        $(elem).removeClass('pc-grid');
                    }
                }
            }

            var imgLoad = imagesLoaded('body', {
                background: '.pc-layer'
            });
            var imgLoadTotal = imgLoad.images.length;
            var imgLoadCurent = 0;

            imgLoad.on('done', function () {
                $(window).trigger('PC.imageLoaded');
            });
            imgLoad.on('fail', function (instance) {
                $(window).trigger('PC.imageLoaded');
            });
            imgLoad.on('progress', function (instance, image) {
                imgLoadCurent++;
                $(window).trigger('PC.imageLoadProgress', {
                    current: imgLoadCurent,
                    total: imgLoadTotal
                });
            });

        }
    }
    var vcColumn2PC = function (el) {
        //TAG vcColumn2PC

        if ($(el).hasClass('pc-clone')) return $(el);

        if (!$(el).hasClass('parallax')) return false;


        var $el = $(el),
            clone,
            id = $el.attr('data-id');


        clone = $el.clone(true, true);
        clone.attr('class', '').attr('data-source', '');
        clone.addClass('pc-clone vc_column_container');

        //TABS & ACCORDIONS FIX
        clone.find('.container-tabs .nav-tabs a, .accordion .panel-title a').each(function (index, elem) {
            $(elem).attr('href', $(elem).attr('href') + '_2');
        });
        clone.find('.container-tabs .tab-pane, .accordion .panel-collapse').each(function (index, elem) {
            $(elem).attr('id', $(elem).attr('id') + '_2');
        });
        clone.find('.accordion .panel-title a').each(function (index, elem) {
            $(elem).data('parent', $(elem).data('parent') + '_2');
        });
        clone.find('.accordion').each(function (index, elem) {
            $(elem).attr('id', $(elem).attr('id') + '_2');
            $(elem).attr('data-id', $(elem).attr('data-id') + '_2');
        });

        //CAROUSEL FIX
        clone.find('.carousel-control').each(function (index, elem) {
            $(elem).attr('href', $(elem).attr('href') + '_2');
        });
        clone.find('.carousel').each(function (index, elem) {
            $(elem).attr('id', $(elem).attr('id') + '_2');
            $(elem).data('bs.carousel', null);
        });

        clone.find('.ideo-progress-bar').ideoProgressBar();
        clone.find('.ideo-pie-chart').ideoPiechart();
        clone.find('.ideo-counter').ideoCounter();
        clone.find('.ideo-message-box').ideoMessageBox();
        clone.find('.ideo-google-map').ideoGoogleMap();

        $el.attr('data-id', '').addClass('pc-source').attr('style', '').attr('data-column-name', '').children().addClass('pc-invisibility');

        clone.css({
            position: 'absolute',
            visibility: '',
            paddingTop: $el.css('paddingTop'),
            paddingRight: $el.css('paddingRight'),
            paddingBottom: $el.css('paddingBottom'),
            paddingLeft: $el.css('paddingLeft'),
            margin: 0
        });

        return clone;

    }

    var relative2screen = function () {

        $('.vc_page_section.parallax').each(function (i, el) {
            $(el).children('.overlay').after('<div class="pc-content before"></div><div class="pc-r2s before empty"></div>');
            $(el).append('<div class="pc-content after"></div><div class="pc-r2s after empty"></div>');
            if ($(window).height() > $(el).outerHeight()) {
                $(el).find('.pc-r2s').addClass('static').height($(el).outerHeight());
            }
        });
    }


    var sections = $('.vc_page_section.parallax,.vc_page_section.parallax.pc-r2s-disableop');
    var isCustomizer = parseInt(_ideo.is_customize_preview) !== 0;

    if (!isCustomizer) {
        sections = sections.filter(function(){
            return $(this).children('.pc-r2s.empty').length < 2;
        });
    }

    var setRelative2screen = pc.setRelative2screen = function (restrict) {
        var restrict = restrict || ''; //pc-r2s-disableop
        var windowHeight = $(window).height();
        sections.filter('.vc_page_section.parallax' + restrict + ',.vc_page_section.parallax.pc-r2s-disableop').each(function (i, el) {
            if (!isCustomizer || $(el).children('.pc-r2s.empty').length < 2) {
                var offsetTop = $(el).offset().top,
                    scrollTop = window.pageYOffset,
                    elHeight = $(el).outerHeight(),
                    pos = offsetTop - scrollTop,
                    pos2 = pos + elHeight,
                    s = offsetTop + elHeight - windowHeight - scrollTop,
                    w = scrollTop + windowHeight;

                if (pos < -1) pos = 0;
                if (s < -1) {
                    pos = s;
                    if (elHeight < windowHeight) {
                        pos += windowHeight - elHeight;
                    }
                }

                $(el).children('.pc-r2s:not(.empty)').css({
                    top: parseInt(pos)
                });
            }

        });
    };

    var setFontsLink = function () {


        var family = [],
            ext = ["latin"];

        if (_pc.fonts_extension) {
            ext.push(_pc.fonts_extension);
        }

        jQuery.each(Object.keys(google_fonts), function (k, v) {
            var f = v.replace(/\s/g, '+');
            var v = google_fonts[v].join(',');
            if (v) {
                f += ':' + v;
            }
            family.push(f);
        });

        family = family.join('|');
        if (family && ext) {

            $("head .pc_google_fonts").remove();
            $("head").append("<link />");
            var gf = $("head").children(":last");

            gf.attr({
                "class": 'pc_google_fonts',
                "rel": "stylesheet",
                "type": "text/css",
                "href": "http://fonts.googleapis.com/css?family=" + family + "&subset=" + ext.join(',')
            });
        }
    }

    pc.initAnimation = function (data) {

        if (!data) return false;

        pc.isInitAnimation = true;

        //freez fix vc_column
        $('.freez').removeClass('freez').css({
            margin: ''
        });

        setTimeout(function () {
            buildHtml(data);
            createTimeLine();
            buildTimeLine(data);
            setFontsLink();
            if ($('.vc-layer.parallax').length) $('.vc-layer.parallax').vcAnimation();
            if ($('.pc-layer.multi').length) $('.pc-layer.multi').multiImagesAnimation();
            audioAnimation(audioLayers);
        }, 25);
        
    }

    var onScroll = function (e) {
        var scrollPos = window.pageYOffset;
        if (tl) tl.seek(scrollPos);
        _pc.setRelative2screen('.onScreen ', 'onScroll');
    }

    var isResizing = false;
    var onResizeDone = function () {
        if (isResizing) {
            isResizing = false;
        }
        pc.initAnimation(pc.data);
        onScroll();
    }
    var onResize = _.debounce(onResizeDone, 500);

    $(window).on('load', function () {
        relative2screen();
        setTimeout(setRelative2screen, 100);
        //setRelative2screen();

        pc.initAnimation(pc.data || _pcdata.data);

        $(window).on('resize', onResize);
        $(document).on('scroll', function (e) {
            onScroll(e);
        });
    });

    pc.layerMouseenter = function (id) {
        var element = $('[data-id="' + id + '"] > .pc-element-name');
        element.removeClass('hidden');
    }
    pc.layerMouseleave = function (id) {
        var element = $('[data-id="' + id + '"] > .pc-element-name');
        element.addClass('hidden');
    }

    var audioAnimation = function (arr) {
        _.each(arr, function (audio) {
            var isPlaying = false,
                volumeFrame = [],
                volumeValue = [];


            _.each(audio.data.animation, function (frame) {
                if (frame.volume) {
                    volumeFrame.push(frame.frame);
                    volumeValue.push(parseFloat(frame.volume.value));
                }
            });


            $(window).scroll(function (event) {
                var scrollPos = window.pageYOffset;

                if (audio.data.activity) {
                    _.each(volumeFrame, function (element, index) {
                        if (scrollPos >= element && (index == volumeFrame.length - 1 || scrollPos < volumeFrame[index + 1])) {
                            audio.audio.volume = volumeValue[index];
                        }
                    });

                    if (!isPlaying && scrollPos >= audio.data.start && scrollPos < audio.data.stop) {
                        isPlaying = true;
                        audio.audio.play();
                    } else if (isPlaying && scrollPos >= audio.data.stop) {
                        isPlaying = false;
                        audio.audio.pause();
                        audio.audio.currentTime = 0;
                    } else if (isPlaying && scrollPos < audio.data.start) {
                        isPlaying = false;
                        audio.audio.pause();
                        audio.audio.currentTime = 0;
                    }
                } else {
                    audio.audio.pause();
                    audio.audio.currentTime = 0;
                }

            });

        });
    }

})(jQuery, _pc);


(function ($) {
    "use strict";

    $.fn.pcAlert = function (options) {
        var defaults = {
            time: 5000,
            class: 'error',
            text: 'ERROR',
            msg: ''
        };
        var settings = $.extend({}, defaults, options);

        var alert = $('<div/>', {
            class: 'pc-alert ' + settings.class,
            html: "<strong>" + settings.text + ":</strong> " + settings.msg + '<span class="time-close"></span><a href="#" class="close"></a>'
        }).appendTo('body');

        var timeClose = parseInt(settings.time / 1000);

        var countdown = function () {
            alert.find('.time-close').text('( ' + timeClose + 's )');
            timeClose -= 1;
            if (timeClose == 0) {
                alert.fadeOut(function () {
                    alert.remove();
                });
                clearInterval(timer);
            }
        };

        var timer = setInterval(function () {
            countdown();
        }, 1000);

        alert.find('.close').on('click', function (e) {
            e.preventDefault();
            alert.remove();
        });
    }

    $.fn.vcAnimation = function (options) {
        var defaults = {};
        var settings = $.extend({}, defaults, options);

        $('.accordion.parallax.vc-layer').on('show.bs.collapse', function () {
            var index = $(this).find('.panel-heading').index($(this).find('.panel-heading.active'));
            var height = 0;

            index = index || 0;

            height = $(this).find('.panel-collapse').eq(index).data('height') + $(this).find('.panel-collapse').length * 45;

            new TweenMax($(this).parent('.vc-placeholder'), 0.3, {
                height: height,
                ease: "Linear.easeNone"
            });
        })

        return this.each(function () {
            var $this = $(this);

            $this.parent('.vc-placeholder').outerHeight($this.outerHeight());
            $this.find('.panel-collapse').each(function (index, element) {
                $(element).data('height', $(element).height());
            });

        })
    }

    $.fn.multiImagesAnimation = function (options) {
        var defaults = {};
        var settings = $.extend({}, defaults, options);

        var methods = {};

        if (typeof options === 'string' && methods[options]) {
            methods[options].apply();
        } else {
            return this.each(function () {
                var $this = $(this),
                    id = $this.data('id'),
                    images = _pc.placeholders[id],
                    ppf = $this.data('ppf'),
                    frames = $this.data('frames'),
                    loop = $this.data('loop') || false,
                    loopnum = $this.data('loopnum') || 1,
                    start = $this.data('start'),
                    stop = $this.data('stop'),
                    scrollPos = window.pageYOffset,
                    index = parseInt((scrollPos - start) / ppf) % frames,
                    currentLoop = parseInt((scrollPos - start) / (ppf * frames)),
                    currentIndex = 0;


                var setImage = function () {
                    scrollPos = window.pageYOffset;
                    index = parseInt((scrollPos - start) / ppf) % frames;
                    currentLoop = parseInt((scrollPos - start) / (ppf * frames));


                    if (currentIndex != index && index > -1) {
                        if ((currentLoop < loopnum || loop) && start <= scrollPos && stop >= scrollPos) {
                            $this.css({
                                'background-image': 'url(' + images[index].src + ')'
                            });


                            currentIndex = index;

                        } else if (scrollPos > stop || currentLoop > loop) {

                            $this.css({
                                'background-image': 'url(' + images[images.length - 1].src + ')'
                            });


                            currentIndex = images.length - 1;
                        } else if (scrollPos < start) {
                            $this.css({
                                'background-image': 'url(' + images[0].src + ')'
                            });

                            currentIndex = 0;
                        }
                    }

                }
                if (images[0] && images[0].src) {
                    $this.css({
                        'background-image': 'url(' + images[0].src + ')'
                    });

                    currentIndex = 0;
                }
                setImage();


                $(window).on('scroll', function (event) {
                    setImage();
                });


            });
        }
    }
}(jQuery));

/* SMOOTH SCROLL */
var smoothScrollEnable = _ideo.settings.advanced.smoothscroll_enabled;
var smoothScrollPreset = _ideo.settings.advanced.smoothscroll_preset;
var smoothScrolling = false;

var userAgent = window.navigator.userAgent;
var isEdge = /Edge/.test(userAgent); // thank you MS
var isChrome = /chrome/i.test(userAgent) && !isEdge;
var isSafari = /safari/i.test(userAgent) && !isEdge;
var isMobileAgent = /mobile/i.test(userAgent);
var isIEWin7 = /Windows NT 6.1/i.test(userAgent) && /rv:11/i.test(userAgent);
var isOldSafari = isSafari && (/Version\/8/i.test(userAgent) || /Version\/9/i.test(userAgent));
var isEnabledForBrowser = (isChrome || isSafari || isIEWin7) && !isMobileAgent;


if ((!smoothScrollEnable || smoothScrollEnable === 'scroll4websites') && isEnabledForBrowser) {
    (function () {
        "use strict";

        var defaultOptions = {
            dynamic: {

                // Scrolling Core
                frameRate: 150, // [Hz]
                animationTime: 400, // [ms]
                stepSize: 100, // [px]

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm: true,
                pulseScale: 4,
                pulseNormalize: 1,

                // Acceleration
                accelerationDelta: 50,
                accelerationMax: 3,

                // Keyboard Settings
                keyboardSupport: true, // option
                arrowScroll: 50, // [px]

                // Other
                touchpadSupport: false, // ignore touchpad by default
                fixedBackground: true,
                excluded: ''
            },
            dynamic2: {

                // Scrolling Core
                frameRate: 150, // [Hz]
                animationTime: 800, // [ms]
                stepSize: 80, // [px]

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm: true,
                pulseScale: 4,
                pulseNormalize: 1,

                // Acceleration
                accelerationDelta: 25,
                accelerationMax: 2,

                // Keyboard Settings
                keyboardSupport: true, // option
                arrowScroll: 50, // [px]

                // Other
                touchpadSupport: false, // ignore touchpad by default
                fixedBackground: true,
                excluded: ''
            },
            shorttail: {

                // Scrolling Core
                frameRate: 150, // [Hz]
                animationTime: 700, // [ms]
                stepSize: 80, // [px]

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm: true,
                pulseScale: 8,
                pulseNormalize: 1,

                // Acceleration
                accelerationDelta: 20,
                accelerationMax: 1,

                // Keyboard Settings
                keyboardSupport: true, // option
                arrowScroll: 50, // [px]

                // Other
                touchpadSupport: false, // ignore touchpad by default
                fixedBackground: true,
                excluded: ''
            },
            mediumtail: {

                // Scrolling Core
                frameRate: 60, // [Hz] 
                animationTime: 1200, // [ms] 
                stepSize: 100, // [px] 

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm: true,
                pulseScale: 4,
                pulseNormalize: 1,

                // Acceleration     
                accelerationDelta: 20,
                accelerationMax: 1,

                // Keyboard Settings
                keyboardSupport: true, // option
                arrowScroll: 50, // [px]

                // Other
                touchpadSupport: true, // ignore touchpad by default
                fixedBackground: true,
                excluded: ''
            },
            longtail: {

                // Scrolling Core
                frameRate: 60, // [Hz] 
                animationTime: 2000, // [ms]  
                stepSize: 120, // [px] 

                // Pulse (less tweakable)
                // ratio of "tail" to "acceleration"
                pulseAlgorithm: true,
                pulseScale: 5,
                pulseNormalize: 1,

                // Acceleration     
                accelerationDelta: 20,
                accelerationMax: 2,

                // Keyboard Settings
                keyboardSupport: true, // option
                arrowScroll: 50, // [px]

                // Other
                touchpadSupport: true, // ignore touchpad by default
                fixedBackground: true,
                excluded: ''
            }
        };
        var options = defaultOptions[smoothScrollPreset] || defaultOptions.dynamic;

        options = Object.assign(options, ideoconfig.get('scroll4websites'));


        // Other Variables
        var isExcluded = false;
        var isFrame = false;
        var direction = {
            x: 0,
            y: 0
        };
        var initDone = false;
        var root = document.documentElement;
        var activeElement;
        var observer;
        var refreshSize;
        var deltaBuffer = [];
        var isMac = /^Mac/.test(navigator.platform);

        var key = {
            left: 37,
            up: 38,
            right: 39,
            down: 40,
            spacebar: 32,
            pageup: 33,
            pagedown: 34,
            end: 35,
            home: 36
        };
        var arrowKeys = {
            37: 1,
            38: 1,
            39: 1,
            40: 1
        };

        /***********************************************
         * INITIALIZE
         ***********************************************/

        /**
         * Tests if smooth scrolling is allowed. Shuts down everything if not.
         */
        function initTest() {
            if (options.keyboardSupport) {
                addEvent('keydown', keydown);
            }
        }

        /**
         * Sets up scrolls array, determines if frames are involved.
         */
        function init() {

            if (initDone || !document.body) return;

            initDone = true;

            var body = document.body;
            var html = document.documentElement;
            var windowHeight = window.innerHeight;
            var scrollHeight = body.scrollHeight;

            // check compat mode for root element
            root = (document.compatMode.indexOf('CSS') >= 0) ? html : body;
            activeElement = body;

            initTest();

            // Checks if this script is running in a frame
            if (top != self) {
                isFrame = true;
            }

            /**
             * Safari 10 fixed it, Chrome fixed it in v45:
             * This fixes a bug where the areas left and right to
             * the content does not trigger the onmousewheel event
             * on some pages. e.g.: html, body { height: 100% }
             */
            else if (isOldSafari &&
                scrollHeight > windowHeight &&
                (body.offsetHeight <= windowHeight ||
                    html.offsetHeight <= windowHeight)) {

                var fullPageElem = document.createElement('div');
                fullPageElem.style.cssText = 'position:absolute; z-index:-10000; ' +
                    'top:0; left:0; right:0; height:' +
                    root.scrollHeight + 'px';
                document.body.appendChild(fullPageElem);

                // DOM changed (throttled) to fix height
                var pendingRefresh;
                refreshSize = function () {
                    if (pendingRefresh) return; // could also be: clearTimeout(pendingRefresh);
                    pendingRefresh = setTimeout(function () {
                        if (isExcluded) return; // could be running after cleanup
                        fullPageElem.style.height = '0';
                        fullPageElem.style.height = root.scrollHeight + 'px';
                        pendingRefresh = null;
                    }, 500); // act rarely to stay fast
                };

                setTimeout(refreshSize, 10);

                addEvent('resize', refreshSize);

                // TODO: attributeFilter?
                var config = {
                    attributes: true,
                    childList: true,
                    characterData: false
                    // subtree: true
                };

                observer = new MutationObserver(refreshSize);
                observer.observe(body, config);

                if (root.offsetHeight <= windowHeight) {
                    var clearfix = document.createElement('div');
                    clearfix.style.clear = 'both';
                    body.appendChild(clearfix);
                }
            }

            // disable fixed background
            if (!options.fixedBackground && !isExcluded) {
                body.style.backgroundAttachment = 'scroll';
                html.style.backgroundAttachment = 'scroll';
            }
        }

        /**
         * Removes event listeners and other traces left on the page.
         */
        function cleanup() {
            observer && observer.disconnect();
            removeEvent(wheelEvent, wheel);
            removeEvent('mousedown', mousedown);
            removeEvent('keydown', keydown);
            removeEvent('resize', refreshSize);
            removeEvent('load', init);
        }


        /************************************************
         * SCROLLING
         ************************************************/

        var que = [];
        var pending = false;
        var lastScroll = Date.now();

        /**
         * Pushes scroll actions to the scrolling queue.
         */
        function scrollArray(elem, left, top) {

            directionCheck(left, top);

            if (options.accelerationMax != 1) {
                var now = Date.now();
                var elapsed = now - lastScroll;
                if (elapsed < options.accelerationDelta) {
                    var factor = (1 + (50 / elapsed)) / 2;
                    if (factor > 1) {
                        factor = Math.min(factor, options.accelerationMax);
                        left *= factor;
                        top *= factor;
                    }
                }
                lastScroll = Date.now();
            }

            // push a scroll command
            que.push({
                x: left,
                y: top,
                lastX: (left < 0) ? 0.99 : -0.99,
                lastY: (top < 0) ? 0.99 : -0.99,
                start: Date.now()
            });

            // don't act if there's a pending queue
            if (pending) {
                return;
            }

            var scrollWindow = (elem === document.body);

            var step = function (time) {

                var now = Date.now();
                var scrollX = 0;
                var scrollY = 0;

                for (var i = 0; i < que.length; i++) {

                    var item = que[i];
                    var elapsed = now - item.start;
                    var finished = (elapsed >= options.animationTime);

                    // scroll position: [0, 1]
                    var position = (finished) ? 1 : elapsed / options.animationTime;

                    // easing [optional]
                    if (options.pulseAlgorithm) {
                        position = pulse(position);
                    }

                    // only need the difference
                    var x = (item.x * position - item.lastX) >> 0;
                    var y = (item.y * position - item.lastY) >> 0;

                    // add this to the total scrolling
                    scrollX += x;
                    scrollY += y;

                    // update last values
                    item.lastX += x;
                    item.lastY += y;

                    // delete and step back if it's over
                    if (finished) {
                        que.splice(i, 1);
                        i--;
                    }
                }

                // scroll left and top
                if (scrollWindow) {
                    window.scrollBy(scrollX, scrollY);
                } else {
                    if (scrollX) elem.scrollLeft += scrollX;
                    if (scrollY) elem.scrollTop += scrollY;
                }

                // clean up if there's nothing left to do
                if (!left && !top) {
                    que = [];
                }

                if (que.length) {
                    requestFrame(step, elem, (1000 / options.frameRate + 1));
                } else {
                    pending = false;
                }
            };

            // start a new queue of actions
            requestFrame(step, elem, 0);
            pending = true;
        }


        /***********************************************
         * EVENTS
         ***********************************************/

        /**
         * Mouse wheel handler.
         * @param {Object} event
         */
        function wheel(event) {

            if (!initDone) {
                init();
            }

            var target = event.target;

            // leave early if default action is prevented   
            // or it's a zooming event with CTRL 
            if (event.defaultPrevented || event.ctrlKey) {
                return true;
            }

            // leave embedded content alone (flash & pdf)
            if (isNodeName(activeElement, 'embed') ||
                (isNodeName(target, 'embed') && /\.pdf/i.test(target.src)) ||
                isNodeName(activeElement, 'object') ||
                target.shadowRoot) {
                return true;
            }

            var deltaX = -event.wheelDeltaX || event.deltaX || 0;
            var deltaY = -event.wheelDeltaY || event.deltaY || 0;

            if (isMac) {
                if (event.wheelDeltaX && isDivisible(event.wheelDeltaX, 120)) {
                    deltaX = -120 * (event.wheelDeltaX / Math.abs(event.wheelDeltaX));
                }
                if (event.wheelDeltaY && isDivisible(event.wheelDeltaY, 120)) {
                    deltaY = -120 * (event.wheelDeltaY / Math.abs(event.wheelDeltaY));
                }
            }

            // use wheelDelta if deltaX/Y is not available
            if (!deltaX && !deltaY) {
                deltaY = -event.wheelDelta || 0;
            }

            // line based scrolling (Firefox mostly)
            if (event.deltaMode === 1) {
                deltaX *= 40;
                deltaY *= 40;
            }

            var overflowing = overflowingAncestor(target);

            // nothing to do if there's no element that's scrollable
            if (!overflowing) {
                // except Chrome iframes seem to eat wheel events, which we need to 
                // propagate up, if the iframe has nothing overflowing to scroll
                if (isFrame && isChrome) {
                    // change target to iframe element itself for the parent frame
                    Object.defineProperty(event, "target", {
                        value: window.frameElement
                    });
                    return parent.wheel(event);
                }
                return true;
            }

            // check if it's a touchpad scroll that should be ignored
            if (!options.touchpadSupport && isTouchpad(deltaY)) {
                return true;
            }

            // scale by step size
            // delta is 120 most of the time
            // synaptics seems to send 1 sometimes
            if (Math.abs(deltaX) > 1.2) {
                deltaX *= options.stepSize / 120;
            }
            if (Math.abs(deltaY) > 1.2) {
                deltaY *= options.stepSize / 120;
            }

            scrollArray(overflowing, deltaX, deltaY);
            if (event.preventDefault && !window.supportsPassive()) {
                event.preventDefault();
            }

            event.returnValue = false;
            scheduleClearCache();
        }

        /**
         * Keydown event handler.
         * @param {Object} event
         */
        function keydown(event) {

            var target = event.target;
            var modifier = event.ctrlKey || event.altKey || event.metaKey ||
                (event.shiftKey && event.keyCode !== key.spacebar);

            // our own tracked active element could've been removed from the DOM
            if (!document.body.contains(activeElement)) {
                activeElement = document.activeElement;
            }

            // do nothing if user is editing text
            // or using a modifier key (except shift)
            // or in a dropdown
            // or inside interactive elements
            var inputNodeNames = /^(textarea|select|embed|object)$/i;
            var buttonTypes = /^(button|submit|radio|checkbox|file|color|image)$/i;
            if (event.defaultPrevented ||
                inputNodeNames.test(target.nodeName) ||
                isNodeName(target, 'input') && !buttonTypes.test(target.type) ||
                isNodeName(activeElement, 'video') ||
                isInsideYoutubeVideo(event) ||
                target.isContentEditable ||
                modifier) {
                return true;
            }

            // [spacebar] should trigger button press, leave it alone
            if ((isNodeName(target, 'button') ||
                    isNodeName(target, 'input') && buttonTypes.test(target.type)) &&
                event.keyCode === key.spacebar) {
                return true;
            }

            // [arrwow keys] on radio buttons should be left alone
            if (isNodeName(target, 'input') && target.type == 'radio' &&
                arrowKeys[event.keyCode]) {
                return true;
            }

            var shift, x = 0,
                y = 0;
            var overflowing = overflowingAncestor(activeElement);

            if (!overflowing) {
                // Chrome iframes seem to eat key events, which we need to
                // propagate up, if the iframe has nothing overflowing to scroll
                return (isFrame && isChrome) ? parent.keydown(event) : true;
            }

            var clientHeight = overflowing.clientHeight;

            if (overflowing == document.body) {
                clientHeight = window.innerHeight;
            }

            switch (event.keyCode) {
                case key.up:
                    y = -options.arrowScroll;
                    break;
                case key.down:
                    y = options.arrowScroll;
                    break;
                case key.spacebar: // (+ shift)
                    shift = event.shiftKey ? 1 : -1;
                    y = -shift * clientHeight * 0.9;
                    break;
                case key.pageup:
                    y = -clientHeight * 0.9;
                    break;
                case key.pagedown:
                    y = clientHeight * 0.9;
                    break;
                case key.home:
                    y = -overflowing.scrollTop;
                    break;
                case key.end:
                    var scroll = overflowing.scrollHeight - overflowing.scrollTop;
                    var scrollRemaining = scroll - clientHeight;
                    y = (scrollRemaining > 0) ? scrollRemaining + 10 : 0;
                    break;
                case key.left:
                    x = -options.arrowScroll;
                    break;
                case key.right:
                    x = options.arrowScroll;
                    break;
                default:
                    return true; // a key we don't care about
            }

            scrollArray(overflowing, x, y);
            event.preventDefault();
            scheduleClearCache();
        }

        /**
         * Mousedown event only for updating activeElement
         */
        function mousedown(event) {
            activeElement = event.target;
        }


        /***********************************************
         * OVERFLOW
         ***********************************************/

        var uniqueID = (function () {
            var i = 0;
            return function (el) {
                return el.uniqueID || (el.uniqueID = i++);
            };
        })();

        var cache = {}; // cleared out after a scrolling session
        var clearCacheTimer;

        //setInterval(function () { cache = {}; }, 10 * 1000);

        function scheduleClearCache() {
            clearTimeout(clearCacheTimer);
            clearCacheTimer = setInterval(function () {
                cache = {};
            }, 1 * 1000);
        }

        function setCache(elems, overflowing) {
            for (var i = elems.length; i--;)
                cache[uniqueID(elems[i])] = overflowing;
            return overflowing;
        }

        //  (body)                (root)
        //         | hidden | visible | scroll |  auto  |
        // hidden  |   no   |    no   |   YES  |   YES  |
        // visible |   no   |   YES   |   YES  |   YES  |
        // scroll  |   no   |   YES   |   YES  |   YES  |
        // auto    |   no   |   YES   |   YES  |   YES  |

        function overflowingAncestor(el) {
            var elems = [];
            var body = document.body;
            var rootScrollHeight = root.scrollHeight;
            do {
                var cached = cache[uniqueID(el)];
                if (cached) {
                    return setCache(elems, cached);
                }
                elems.push(el);
                if (rootScrollHeight === el.scrollHeight) {
                    var topOverflowsNotHidden = overflowNotHidden(root) && overflowNotHidden(body);
                    var isOverflowCSS = topOverflowsNotHidden || overflowAutoOrScroll(root);
                    if (isFrame && isContentOverflowing(root) ||
                        !isFrame && isOverflowCSS) {
                        return setCache(elems, getScrollRoot());
                    }
                } else if (isContentOverflowing(el) && overflowAutoOrScroll(el)) {
                    return setCache(elems, el);
                }
            } while (el = el.parentElement);
        }

        function isContentOverflowing(el) {
            return (el.clientHeight + 10 < el.scrollHeight);
        }

        // typically for <body> and <html>
        function overflowNotHidden(el) {
            var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
            return (overflow !== 'hidden');
        }

        // for all other elements
        function overflowAutoOrScroll(el) {
            var overflow = getComputedStyle(el, '').getPropertyValue('overflow-y');
            return (overflow === 'scroll' || overflow === 'auto');
        }


        /***********************************************
         * HELPERS
         ***********************************************/

        function addEvent(type, fn, usePassive) {
            window.addEventListener(type, fn, usePassive && window.supportsPassive() ? {
                passive: true
            } : false);
        }

        function removeEvent(type, fn) {
            window.removeEventListener(type, fn, false);
        }

        function isNodeName(el, tag) {
            return (el.nodeName || '').toLowerCase() === tag.toLowerCase();
        }

        function directionCheck(x, y) {
            x = (x > 0) ? 1 : -1;
            y = (y > 0) ? 1 : -1;
            if (direction.x !== x || direction.y !== y) {
                direction.x = x;
                direction.y = y;
                que = [];
                lastScroll = 0;
            }
        }

        var deltaBufferTimer;

        if (window.localStorage && localStorage.SS_deltaBuffer) {
            try { // #46 Safari throws in private browsing for localStorage
                deltaBuffer = localStorage.SS_deltaBuffer.split(',');
            } catch (e) {}
        }

        function isTouchpad(deltaY) {
            if (!deltaY) return;
            if (!deltaBuffer.length) {
                deltaBuffer = [deltaY, deltaY, deltaY];
            }
            deltaY = Math.abs(deltaY);
            deltaBuffer.push(deltaY);
            deltaBuffer.shift();
            clearTimeout(deltaBufferTimer);
            deltaBufferTimer = setTimeout(function () {
                try { // #46 Safari throws in private browsing for localStorage
                    localStorage.SS_deltaBuffer = deltaBuffer.join(',');
                } catch (e) {}
            }, 1000);
            return !allDeltasDivisableBy(120) && !allDeltasDivisableBy(100);
        }

        function isDivisible(n, divisor) {
            return (Math.floor(n / divisor) == n / divisor);
        }

        function allDeltasDivisableBy(divisor) {
            return (isDivisible(deltaBuffer[0], divisor) &&
                isDivisible(deltaBuffer[1], divisor) &&
                isDivisible(deltaBuffer[2], divisor));
        }

        function isInsideYoutubeVideo(event) {
            var elem = event.target;
            var isControl = false;
            if (document.URL.indexOf('www.youtube.com/watch') != -1) {
                do {
                    isControl = (elem.classList &&
                        elem.classList.contains('html5-video-controls'));
                    if (isControl) break;
                } while (elem = elem.parentNode);
            }
            return isControl;
        }

        var requestFrame = (function () {
            return (window.requestAnimationFrame ||
                window.webkitRequestAnimationFrame ||
                window.mozRequestAnimationFrame ||
                function (callback, element, delay) {
                    window.setTimeout(callback, delay || (1000 / 60));
                });
        })();

        var MutationObserver = (window.MutationObserver ||
            window.WebKitMutationObserver ||
            window.MozMutationObserver);

        var getScrollRoot = (function () {
            var SCROLL_ROOT;
            return function () {
                if (!SCROLL_ROOT) {
                    var dummy = document.createElement('div');
                    dummy.style.cssText = 'height:10000px;width:1px;';
                    document.body.appendChild(dummy);
                    var bodyScrollTop = document.body.scrollTop;
                    var docElScrollTop = document.documentElement.scrollTop;
                    window.scrollBy(0, 3);
                    if (document.body.scrollTop != bodyScrollTop)
                        (SCROLL_ROOT = document.body);
                    else
                        (SCROLL_ROOT = document.documentElement);
                    window.scrollBy(0, -3);
                    document.body.removeChild(dummy);
                }
                return SCROLL_ROOT;
            };
        })();


        /***********************************************
         * PULSE (by Michael Herf)
         ***********************************************/

        /**
         * Viscous fluid with a pulse for part and decay for the rest.
         * - Applies a fixed force over an interval (a damped acceleration), and
         * - Lets the exponential bleed away the velocity over a longer interval
         * - Michael Herf, http://stereopsis.com/stopping/
         */
        function pulse_(x) {
            var val, start, expx;
            // test
            x = x * options.pulseScale;
            if (x < 1) { // acceleartion
                val = x - (1 - Math.exp(-x));
            } else { // tail
                // the previous animation ended here:
                start = Math.exp(-1);
                // simple viscous drag
                x -= 1;
                expx = 1 - Math.exp(-x);
                val = start + (expx * (1 - start));
            }
            return val * options.pulseNormalize;
        }

        function pulse(x) {
            if (x >= 1) return 1;
            if (x <= 0) return 0;

            if (options.pulseNormalize == 1) {
                options.pulseNormalize /= pulse_(1);
            }
            return pulse_(x);
        }


        /***********************************************
         * FIRST RUN
         ***********************************************/



        var wheelEvent;
        if ('onwheel' in document.createElement('div'))
            wheelEvent = 'wheel';
        else if ('onmousewheel' in document.createElement('div'))
            wheelEvent = 'mousewheel';

        if (wheelEvent && isEnabledForBrowser) {
            addEvent(wheelEvent, wheel, true);
            addEvent('mousedown', mousedown);
            addEvent('load', init);
        }


        /***********************************************
         * PUBLIC INTERFACE
         ***********************************************/

        function SmoothScroll(optionsToSet) {
            for (var key in optionsToSet)
                if (defaultOptions.hasOwnProperty(key))
                    options[key] = optionsToSet[key];
        }
        SmoothScroll.destroy = cleanup;

        if (window.SmoothScrollOptions) // async API
            SmoothScroll(window.SmoothScrollOptions);

        if (typeof define === 'function' && define.amd)
            define(function () {
                return SmoothScroll;
            });
        else if ('object' == typeof exports)
            module.exports = SmoothScroll;
        else
            window.SmoothScroll = SmoothScroll;

    })();
}
if (smoothScrollEnable === 'ideosmooth' || !isEnabledForBrowser) {
    (function ($) {

        var $window = $(window);
        var isTweening = false;
        var _wheelCount = 0;
        var _scrollRatio = 1;
        var _direction = 1;
        var _wheelMaxCount = 3 * _scrollRatio;
        var hover = $('<div/>');
        var duration = ideoconfig.get('ideosmooth.duration') || 0.5;
        var deltaRatio = ideoconfig.get('ideosmooth.deltaratio') || 1;

        var wheelEvent;
        if ('onwheel' in document.createElement('div'))
            wheelEvent = 'wheel';
        else if ('onmousewheel' in document.createElement('div'))
            wheelEvent = 'mousewheel';


        $(document).ready(function () {
            hover.appendTo('body');
            hover.attr('style', 'position:fixed; width:100%; height:100%; top:0;');
        });

        function customScroll(event) {

            if (event.target.nodeName == 'LI' && $(event.target).parent().parent().hasClass('selectric-scroll')) {
                return true;
            }

            var delta;


            if (event.wheelDelta) {
                delta = (event.wheelDelta % 120 - 0) == -0 ? event.wheelDelta / 120 : event.wheelDelta / 12;
            } else {
                var rawAmmount = event.deltaY ? event.deltaY : event.detail;
                delta = -(rawAmmount % 3 ? rawAmmount * 10 : rawAmmount / 3);
            }

            delta = (delta > 0) ? 1 : -1;

            if (_wheelCount < _wheelMaxCount) {
                _wheelCount++;
            }
            if (delta != _direction) {
                _wheelCount = 1;
            }

            _direction = delta;

            var scrollTop = window.pageYOffset;
            var finScroll = scrollTop - parseInt(delta * 100 * deltaRatio) * _wheelCount / _scrollRatio;

            var smoothScroll = TweenMax.to($window, duration, {
                scrollTo: {
                    y: finScroll,
                    autoKill: true
                },
                ease: Quad.easeOut,
                autoKill: true,
                overwrite: 5,
                onUpdate: function () {
                    if (tl) tl.seek(window.pageYOffset);
                    _pc.setRelative2screen('.onScreen ', 'onScroll');
                },
                onStart: function () {
                    isTweening = true;
                    hover[0].style.zIndex = 100;

                },
                onComplete: function () {
                    isTweening = false;
                    _wheelCount = 0;
                    hover[0].style.zIndex = -1;
                }
            });

            if (event.preventDefault && !window.supportsPassive()) {
                event.preventDefault();
            }

            event.returnValue = false;

        }

        function cleanup() {
            window.removeEventListener(wheelEvent, customScroll, window.supportsPassive() ? {
                passive: true
            } : false);
        }
        if (smoothScrollEnable && !isMobile.any) {
            cleanup();
            window.addEventListener(wheelEvent, customScroll, window.supportsPassive() ? {
                passive: true
            } : false);
        }

    })(jQuery);
}