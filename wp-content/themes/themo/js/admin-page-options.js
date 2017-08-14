(function ($) {
    "use strict";
    
    dependArray = JSON.parse(dependArray) || {};
    
    var showRow = function (selector) {
        $(selector).closest('.ideo-row').removeClass('element-hidden').show();
    };

    var hideRow = function (selector) {
        var row = $(selector);
        row.closest('.ideo-row').addClass('element-hidden').hide();
        row.find('.ideo-row').addClass('element-hidden');
    };

    var setInVisibleDependencies = function (depend) {
        $.each(depend, function (i, control) {
            if (typeof control == 'string' && control != '') {
                hideRow('[name="' + control + '"]');
                return true;
            } else if (typeof control == 'object') {
                $.each(control, function (subi, subcontrol) {
                    $('[name="' + subi + '"]').addClass('change-dependencies');
                    hideRow('[name="' + subi + '"]');
                    $.each(subcontrol, function (val, subdepend) {
                        setInVisibleDependencies(subdepend);
                    });
                });
            }
        });
    }

    var sections = $('.ideo-section');

    var dependencies = function (depend) {
        $('.ideo-row').removeClass('element-hidden');

        $.each(depend, function (link, d) {
            $('[name="' + link + '"]').addClass('change-dependencies');

            $.each(d, function (value, values) {
                setInVisibleDependencies(values);
            });

            var dependValue = $('[name="' + link + '"]').val();
            $.each(depend[link][dependValue], function (i, control) {
                if (typeof control == 'string' && control != '') {

                    showRow('[name="' + control + '"]');
                } else if (typeof control == 'object') {
                    $.each(control, function (subi, subcontrol) {
                        showRow('[name="' + subi + '"]');
                        $('[name="' + subi + '"]').data('depend', link);
                        var subDependValue = $('[name="' + subi + '"]').val();
                        $.each(subcontrol[subDependValue], function (i, control) {
                            showRow('[name="' + control + '"]');
                        });
                    });
                }
            });
        });

        sections.each(function () {
            if ($(this).find('.ideo-row:not(.element-hidden)').length == 0)
                $(this).hide();
            else {
                $(this).show();
                $(this).children('.ideo-row:not(.element-hidden)').removeClass('ideo-first-row').first().addClass('ideo-first-row');
            }
        });

        /*
         * Funtion is an event trigger for metabox fields
         */
        var setDependencies = function (link, value) {
            var dependControl = $('[name="' + link + '"]').data('depend');
            var curDependArray = dependArray;

            dependencies(curDependArray);
        };


        $('.change-dependencies').unbind('change selectmenuchange').on('change selectmenuchange', function (e) {
            setDependencies($(this).attr('name'), $(this).val());
        });
    };


    dependencies(dependArray);

})(jQuery);