(function($){
    $.fn.mousemoveparallax = function(options) {
        var defaults = {
            speed: 0.1
        };
        var settings = $.extend({}, defaults, options);
        
        
        return this.each(function () {
            var $this = $(this),
                offset = $this.offset(),
                bgWidth = $this.data('background-width'),
                bgHeight = $this.data('background-height'),
                bgRatio  = bgHeight/bgWidth,
                newBgWidth = ($this.outerWidth()*(1+ Math.abs(settings.speed))),
                newBgHeight = newBgWidth * bgRatio,
                posX,
                oldPosX = 0,
                posY,
                oldPosY = 0,
                bgPosX,
                bgPosY,
                isEnter = false;
            
            var distance = function(x1,y1,x2,y2) {
                var xs = 0;
                var ys = 0;
                xs = x2 - x1;
                xs = xs * xs;

                ys = y2 - y1;
                ys = ys * ys;

                return Math.sqrt( xs + ys );
            }
            
            var initBg = function() {
                newBgWidth = ($this.outerWidth()*(1+ parseFloat(settings.speed)));
                newBgHeight = newBgWidth * bgRatio ;
                $this.css({
                    backgroundPosition: '50% 50%',
                    backgroundSize: newBgWidth +'px ' + newBgHeight +'px '
                });                
            }   
            
            initBg();
                  
            $this.on('mouseenter',function(e) { 
                 isEnter = true;
                 var posX = (e.pageX - offset.left - $this.outerWidth()/2) * settings.speed;
                    var posY = (e.pageY - offset.top - $this.outerHeight()/2) * settings.speed;
                    var bgPosX = -( newBgWidth - $this.outerWidth() )/2 - posX;
                    var bgPosY = -( newBgHeight - $this.outerHeight() )/2 - posY ;

                    TweenMax.to($this,0.5,{
                        backgroundPosition: bgPosX +'px ' + bgPosY +'px',
                        onComplete: function() {
                            isEnter = false;
                        }
                    });
            });

            $this.on('mousemove',function(e) { 
                if($(window).width()>991){
                    var posX = (e.pageX - offset.left - $this.outerWidth()/2) * settings.speed;
                    var posY = (e.pageY - offset.top - $this.outerHeight()/2) * settings.speed;
                    var bgPosX = -( newBgWidth - $this.outerWidth() )/2 - posX;
                    var bgPosY = -( newBgHeight - $this.outerHeight() )/2 - posY ;
                  
                    if(!isEnter) {
                         TweenMax.to($this,0.5,{
                            backgroundPosition: bgPosX +'px ' + bgPosY +'px'
                        });
                    }
                }
            });
            
            $(window).on('resize',function() {
                initBg();
            });
            
            
        });
    }
    
})(jQuery);