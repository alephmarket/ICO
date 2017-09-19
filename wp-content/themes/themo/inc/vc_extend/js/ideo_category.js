(function ($) {
    "use strict";
    
    var container = $('.loop-categories');
    var input = container.find('input.wpb_vc_param_value');

    container.find('select').on('change', function () {
        var value = $(this).val();
        var value_str = '';
        if (value) {
            for (var i in value) {
                value_str += value[i] + ',';
            }
        } else {
            value_str = '';
        }

        if (value_str.length > 0) {
            value_str = value_str.substr(0, value_str.length - 1);
        }

        input.val(value_str);
    });
    
    $(".chosen-select").chosen();

})(window.jQuery);




