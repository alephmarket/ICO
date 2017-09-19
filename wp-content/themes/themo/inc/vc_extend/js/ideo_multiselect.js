(function ($) {
    "use strict";
    
    $.fn.multiselect = function (options) {
        var defaults = {};
        var settings = $.extend({}, defaults, options);
        return this.each(function () {
            var $this = $(this),
                value = $this.find('input.ideo_multiselect_field').val();

            $this.find('select').chosen({
                width: "100%"
            });

            $this.find('select').on('change', function () {
                if ($(this).val()) {
                    $this.find('input.ideo_multiselect_field').val($(this).val().join('|'));
                } else {
                    $this.find('input.ideo_multiselect_field').val('');
                }
            });

        });
    }

    $('.ideo-multiselect-group').multiselect();


})(window.jQuery);