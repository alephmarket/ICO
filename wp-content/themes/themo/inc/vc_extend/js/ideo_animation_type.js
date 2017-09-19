(function ($) {
    "use strict";
    
    var element = $('.ideo-animation-type-example-element'),
        tl = new TimelineMax({
            repeat: -1,
            repeatDelay: 2
        });

    var previewAnimation = function (type) {

        tl.remove();
        tl = new TimelineMax({
            repeat: -1,
            repeatDelay: 2
        });
        switch (type) {
            case 'fadein':
                TweenMax.set(element, {
                    opacity: 0
                });
                tl.add(TweenMax.to(element, 1, {
                    opacity: 1
                }));
                break;
            case 'fadeout':
                TweenMax.set(element, {
                    opacity: 1
                });
                tl.add(TweenMax.to(element, 1, {
                    opacity: 0
                }));
                break;
            case 'slidetop':
                TweenMax.set(element, {
                    y: -100,
                    opacity: 0
                });
                tl.add(TweenMax.to(element, 1, {
                    y: 0,
                    opacity: 1
                }));
                break;
            case 'slideleft':
                TweenMax.set(element, {
                    x: -100,
                    opacity: 0
                });
                tl.add(TweenMax.to(element, 1, {
                    x: 0,
                    opacity: 1
                }));
                break;
            default:
                element.removeClass().addClass('ideo-animation-type-example-element animated ' + type);
                break;
        }
    }
    previewAnimation($('.ideo_animation_type').val());

    $('.ideo_animation_type').on('change', function () {
        previewAnimation($(this).val());
    });

})(window.jQuery);