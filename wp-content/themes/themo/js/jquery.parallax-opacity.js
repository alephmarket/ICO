/*
Plugin: jQuery Opacity Parallax
Version 0.1
Author: Dawid Szwed

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function ($) {
    "use strict";
    
    var $window = $(window);
    var windowHeight = $window.height();

    $window.resize(function () {
        windowHeight = $window.height();
    });

    $.fn.parallaxOpacity = function (options, outerHeight) {
        var $this = $(this),
            $target = $this,
            getHeight,
            opacity = 1,
            speed = 0.1,
            firstTop;

        if(options.target){
            $target = $(options.target);
        }
        //get the starting position of each element to have parallax applied to it		
        $this.each(function () {
            firstTop = $this.offset().top;
        });

        if (outerHeight) {
            getHeight = function (jqo) {
                return jqo.outerHeight(true);
            };
        } else {
            getHeight = function (jqo) {
                return jqo.height();
            };
        }

        // setup defaults if arguments aren't specified
        speed = options.speed || speed;
        if (arguments.length < 2 || outerHeight === null) outerHeight = true;

        // function to be called whenever the window is scrolled or resized
        function update() {
            var pos = $window.scrollTop();

            $this.each(function () {
                var $element = $(this);
                var top = $element.offset().top;
                var height = getHeight($element);

                // Check if totally above or totally below viewport
                if (top + height < pos || top > pos + windowHeight) {
                    return;
                }
                var r = pos/height < 1 ? pos/height : 1;
                
                $target.css('opacity', opacity - r * speed );
            });
        }

        $window.bind('scroll.ptParallax', update).resize(update);
        update();
    };
})(jQuery);