/*
Plugin: jQuery Height Parallax
Version 0.1
Author: -

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

    $.fn.parallaxHeight = function (speedFactor, padding) {
        var $this = $(this);
        var height = $this.outerHeight();
        var firstTop;

        $(this).css('overflow', 'hidden');

        //get the starting position of each element to have parallax applied to it		
        $this.each(function () {
            firstTop = $this.offset().top;
        });
        
        // setup defaults if arguments aren't specified
        if (speedFactor === null) speedFactor = 1;

        // function to be called whenever the window is scrolled or resized
        function update() {
            var pos = $window.scrollTop();

            $this.each(function () {
                var $element = $(this);
                var top = $element.offset().top;
                // Check if totally above or totally below viewport
                if (top > pos + windowHeight) {
                    return;
                }
                
                var newHeight = height - pos * speedFactor;
                
                if(newHeight < 0) newHeight = 0;
                if(padding){
                    var newPadding = parseInt(padding * newHeight / height);
                    $this.css({height: newHeight , paddingTop: newPadding, paddingBottom: newPadding});
                }else{
                    $this.css({height: newHeight});                    
                }
            });
        }

        $window.bind('scroll.ptParallax', update).resize(update);
        update();
    };
})(jQuery);