(function ($) {
    "use strict";
    
    $.fn.filterIcons = function () {

        var filter = function ($icons, search) {
            $icons.removeClass('hide');
            $icons.each(function (idx, icon) {
                if ($(icon).data('icon').indexOf(search) == -1) {
                    $(icon).addClass('hide');
                }
                ;
            });
        }
        return this.each(function () {
            var $this = $(this),
                $list = $this.find('.ideo-icon-choose'),
                $icons = $list.find('span'),
                $input = $this.find('.icon-search'),
                inputValue = '';

            $input.keyup(function () {
                inputValue = $(this).val();
                filter($icons, inputValue);
            });

            $icons.click(function (e) {
                e.preventDefault();
                var value = $(this).data('icon');
                $list.find('input.wpb_vc_param_value').val(value);
                $icons.removeClass('active');
                $(this).addClass('active');
            });
            
        });
    }


    $('.ideo-icon-choose-wrap').filterIcons();

})(window.jQuery);