/*
Plugin: jQuery Objects Parallax
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

    $.fn.parallaxObject = function (speedFactor, outerHeight) {
        var $this = $(this);
        var getHeight;
        var firstTop;

        $(this).css('position', 'relative');

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
        if (arguments.length < 2 || speedFactor === null) speedFactor = 1;
        if (arguments.length < 3 || outerHeight === null) outerHeight = true;

        // function to be called whenever the window is scrolled or resized
        function update() {
            var pos = $window.scrollTop();

            $this.each(function () {
                var $element = $(this);
                var top = $element.offset().top;
                var height = getHeight($element);

                // Check if totally above or totally below viewport
                if (top > pos + windowHeight) {
                    return;
                }

                //var moveTo = Math.round((firstTop - pos) * speedFactor);
                var newTop = pos * speedFactor * 0.4;

                $this.css('transform', 'translate3d(0px, ' + newTop + 'px, 0px)');
            });
        }

        $window.bind('scroll.ptParallax', update).resize(update);
        update();
    };
})(jQuery);