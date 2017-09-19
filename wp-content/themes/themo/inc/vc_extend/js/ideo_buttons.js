(function ($) {
    "use strict";

    $.fn.selecttobuttons = function (options) {
        var defaults = {};
        var settings = $.extend({}, defaults, options);
        return this.each(function () {
            var $this = $(this),
                dependencies = $this.find('select').data('dependencies'),
                dependencies_el = [],
                name = $this.find('select').attr('name');

            for (var idx in dependencies) {
                dependencies_el.push(dependencies[idx]);
            }
            dependencies_el = _.flatten(dependencies_el);

            var showhide = function () {
                if (dependencies) {
                    var show = $this.find('select').val();

                    for (var i in dependencies_el) {
                        $('.' + dependencies_el[i]).hideParameterBy(name);
                    }


                    for (var i in dependencies[show]) {
                        if (dependencies[show][i]) {
                            $('.' + dependencies[show][i]).showParameterBy(name);
                        }
                    }

                    for (var i in dependencies_el) {
                        var el = $('.' + dependencies_el[i]);
                        if (el.attr('data-dependencies'))
                            el.trigger('change');
                    }
                }
            }
            showhide();
            $this.find('select option').each(function (index, element) {

                var selected = $(element).attr('selected') || '';
                var button = $('<a/>', {class: 'button ' + selected, html: $(element).text()}).appendTo($this)
                    .on('click', function (e) {
                        e.preventDefault();
                        var idx = $this.find('a.button').index($(this));

                        $this.find('select').prop("selectedIndex", idx);
                        $this.find('a.button').removeClass('selected');
                        $(this).addClass('selected');

                        $this.find('select').trigger('change');

                        showhide();

                    });
            });

        });
    }

    $('.ideo-buttons-group').selecttobuttons();


})(window.jQuery);