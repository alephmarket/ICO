(function ($) {
    "use strict";
    
    $.fn.parmslider = function (options) {
        var defaults = {};
        var settings = $.extend({}, defaults, options);
        return this.each(function () {
            var $this = $(this),
                min = $this.data('min'),
                max = $this.data('max'),
                step = $this.data('step'),
                value = parseInt($this.parent().find('input').val());

            $this.slider({
                min: min,
                max: max,
                value: value,
                range: "min",
                step: step,
                slide: function (event, ui) {
                    $(this).parent().find('input').val(ui.value);
                    console.log(ui.value);
                }
            });
            $this.parent().find('input').on('keyup change', function () {
                $this.slider('value', $(this).val());
            });
        });
    }

    $('.ideo-slider-group .slider').parmslider();


})(window.jQuery);