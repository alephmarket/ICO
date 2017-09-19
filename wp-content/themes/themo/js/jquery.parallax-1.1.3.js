/*
Plugin: jQuery Parallax
Version 1.1.3
Author: Ian Lunn
Twitter: @IanLunn
Author URL: http://www.ianlunn.co.uk/
Plugin URL: http://www.ianlunn.co.uk/plugins/jquery-parallax/

Dual licensed under the MIT and GPL licenses:
http://www.opensource.org/licenses/mit-license.php
http://www.gnu.org/licenses/gpl.html
*/

(function( $ ){
    "use strict";
    
	var $window = $(window);
	var windowHeight = $window.height();

	$window.resize(function () {
		windowHeight = $window.height();
	});

    $.fn.parallax = function(xpos, speedFactor, outerHeight, scrollSource) { 
		var $this = $(this);
		var getHeight;
		var firstTop;
		var paddingTop = 0;
		var adminBarOffset;
		var customSource = false;

		if (!scrollSource)
			scrollSource = $window;
		else
			customSource = true;
        
        $this.addClass('background-motion-parallax');
		
		//get the starting position of each element to have parallax applied to it		
		$this.each(function(){
		    firstTop = $this.offset().top;
		});

		if (outerHeight) {
			getHeight = function(jqo) {
				return jqo.outerHeight(true);
			};
		} else {
			getHeight = function(jqo) {
				return jqo.height();
			};
		}
			
		// setup defaults if arguments aren't specified
		if (arguments.length < 1 || xpos === null) xpos = "50%";
		if (arguments.length < 2 || speedFactor === null) speedFactor = 0.1;
		if (arguments.length < 3 || outerHeight === null) outerHeight = true;
        
        $.fn.parallax.destroy = function() {
            scrollSource.unbind('scroll', update);
            scrollSource.unbind('resize', update);
        };
		
		// function to be called whenever the window is scrolled or resized
		function update(){
			var pos = scrollSource.scrollTop();
            
			$this.each(function(){
                
                if(!$(this).hasClass('background-motion-parallax')){
                    return false;
                }
                
                var $element = $(this);
				var top =scrollSource == $window ? $element.offset().top : $element.offset(scrollSource).top;
				var height = getHeight($element);
                
				// Check if totally above or totally below viewport
				if (top + height < pos || top > pos + (customSource ? scrollSource.height() : windowHeight)) {
					return;
				}

				$this.css('backgroundPosition', xpos + " " + Math.round((firstTop - pos - adminBarOffset) * speedFactor) + "px");
			});
		}		

        scrollSource.bind('scroll', update).resize(update); 
        setTimeout(function () {
            adminBarOffset = $('#wpadminbar').length == 1 ? 32 : 0;
            update(); 
        },250);
        
        return this;
	};
})(jQuery);
