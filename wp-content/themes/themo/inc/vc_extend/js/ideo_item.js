(function ($) {
    "use strict";
    
    var container = $('.loop-items');
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


    $('.vc_description').each(function () {
        $(this).attr('data-content', $(this).html());
    });

    var popoverOpen = false;

    if (jQuery('.vc_description').length) {
        jQuery('.vc_description').popover({
            container: "#vc_ui-panel-edit-element",
            animation: 'fade',
            html: true,
            trigger: 'focus',
            placement: 'bottom'
        }).hover(
            function () {
                if (!popoverOpen)
                    $(this).popover('show');
            },
            function () {
                if (!popoverOpen)
                    $(this).popover('hide');
            }
        ).click(function () {
            if (popoverOpen) {
                $(this).popover('hide');
                popoverOpen = false;
            } else {
                $(this).popover('show');
                popoverOpen = true;
            }

        });
    }
    $('body').on('click', function (e, target) {        
        if (!$(e.target).hasClass('vc_description')) { // clicked elsewhere trigger
            if ($('.popover.in').length > 0) {
                $('.popover.in').removeClass('in').css('display', 'none');
                popoverOpen = false;
            }
        }

    });


})(window.jQuery);




