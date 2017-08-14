function ideotransition(opts) {

    /**
     * Do linking with page loading (overriding standard function defined in script.js)
     * @param e Event object
     * @param href Prepared href
     */
    jQuery.doLinking = function (e, href) {
        showtransition();

        setTimeout(function () {
            window.location.href = href;
        }, 1000);

        return false;
    };

    jQuery('form').on('submit', function () {
        if (jQuery(this).find('.wpcf7-submit').length)
            return true;

        showtransition();

        return true;
    });

    showtransition = function () {
        jQuery('.ideo-transition-logo').remove();

        jQuery('body')
            .addClass('ideo-transition-anim-body');

        jQuery('#ideo-transition-page-container')
            .removeClass('ideo-transition-animation-in')
            .removeClass(opts.transitionIn)
            .addClass('ideo-transition-anim')
            .addClass('ideo-transition-animation-out')
            .addClass(opts.transitionOut);

        jQuery('.ideo-transition').show()
            .removeClass('ideo-transition-animation-out')
            .removeClass('fade-out')
            .addClass('ideo-transition-animation-in')
            .addClass('fade-in');
    };

    removetransition = function () {
        jQuery('.ideo-transition')
            .addClass('ideo-transition-animation-out')
            .addClass('fade-out');

        jQuery('body')
            .removeClass('ideo-transition-anim-body');

        jQuery('#ideo-transition-page-container')
            .addClass('ideo-transition-anim')
            .addClass('ideo-transition-animation-in')
            .addClass(opts.transitionIn);

        setTimeout(function () {
            jQuery('.ideo-transition').hide();

            jQuery('body')
                .removeClass('ideo-transition-anim-body');

            jQuery('#ideo-transition-page-container')
                .removeClass('ideo-transition-anim')
                .removeClass('ideo-transition-animation-in')
                .removeClass(opts.transitionIn);
        }, 1500);
    }

    jQuery(window).on('PC.imageLoaded', function () {
        if(jQuery('.ideo-transition:visible').length){
            removetransition();                         
        }
    });
    jQuery(window).on('PC.imageLoadProgress', function (event, data) { 
         
    });
    jQuery(window).load(function () {
         if(jQuery('.vc_page_section.parallax').length == 0){
             removetransition();             
         }                
    });

    jQuery(window).unload(function () {
        setTimeout(function () {
            jQuery('.ideo-transition').hide();
        }, 2000);
    });
}