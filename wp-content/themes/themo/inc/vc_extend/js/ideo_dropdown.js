(function ($) {
    "use strict";
    
    $.fn.selectdependencies = function (options) {
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
                    for (var i in dependencies['all']) {
                        if (dependencies['all'][i] && show) {
                            $('.' + dependencies['all'][i]).showParameterBy(name);
                        }
                    }

                }
            }

            $this.find('select').on('change', function () {
                showhide();
            });

            showhide();

        });
    }

    $('.ideo-dropdown-group').selectdependencies();


})(window.jQuery);