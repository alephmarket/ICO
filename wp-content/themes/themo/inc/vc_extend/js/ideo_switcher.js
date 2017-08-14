(function ($) {
    "use strict";
    
    $.fn.switcher = function (options) {
        var defaults = {};
        var settings = $.extend({}, defaults, options);
        return this.each(function () {
            var $this = $(this),
                input = $this.find('input'),
                inputOnValue = '' + input.data('on'),
                inputOffValue = '' + input.data('off'),
                switcher = $this.find('.ideo-switcher'),
                dependencies = input.data('dependencies'),
                dependencies_el = [],
                name = input.attr('name');

            for (var idx in dependencies) {
                dependencies_el.push(dependencies[idx]);
            }
            dependencies_el = _.flatten(dependencies_el);

            var showhide = function () {
                if (dependencies) {

                    var show = $this.find('input').val();

                     if (show == 'true' && $this.closest('.vc_shortcode-param').is('.is-dependent'))
                        show = $this.closest('.vc_shortcode-param').hasClass('dependencies') ? 'true' : 'false';

                    for (var i in dependencies_el) {
                        $('.' + dependencies_el[i]).hideParameterBy(name);
                    }

                    for (var i in dependencies[show]) {
                        if (dependencies[show][i]) {
                             $('.' + dependencies[show][i]).showParameterBy(name);
                        }
                    }

                }
            }

            showhide();

            input.on('change', function () {
                showhide();
            });


            if (input.val() == inputOnValue) {
                switcher.removeClass('on');
                switcher.find('.ideo-switcher-text').text('');
            } else {
                switcher.addClass('on');
                switcher.find('.ideo-switcher-text').text('');
            }

            switcher.on('click', function () {
                if (input.val() == inputOnValue) {
                    input.val(inputOffValue);
                    switcher.addClass('on');
                    switcher.find('.ideo-switcher-text').text('');
                } else {
                    input.val(inputOnValue);
                    switcher.removeClass('on');
                    switcher.find('.ideo-switcher-text').text('');
                }
                input.trigger('change');
            });
        });
    }

    $('.ideo-switcher-group').switcher();

})(window.jQuery);