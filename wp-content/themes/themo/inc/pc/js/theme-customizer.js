var _pc = _pc || {};

_pc.customizer = true;
_pc.isInitAnimation = false;

(function ($, pc) {
    "use strict";

    if (!window.parent.angular) {
        _pc.customizer = false;
        return false;
    }
    
    $('html').addClass('pc-scope');

    var scope = pc.scope = window.parent.angular.element('html').scope();
    if(scope) {
        pc.data = scope.data.data || {};
        pc.settings = scope.data.settings;

        scope.$on('updatePreview', function (e, message) {
            if (scope.PCData.changeView === false) {
                if (typeof pc.initAnimation != 'undefined') pc.initAnimation(scope.data.data);
            }
        });


        var setSectionList = function () {
            var pageID = $('body').data('id'),
                sections = [];

            var globalSection = {
                id: pageID,
                title: scope.l10n.globalSection,
                type: "global",
                nodes: [],
                animation: [],
                offsetTop: 0
            }

            sections.push(globalSection);

            $.each($('.vc_page_section.parallax'), function (i, elementSection) {
                var id = $(elementSection).data('id'),
                    offsetTopElement = $(elementSection).offset().top,
                    heightElement = $(elementSection).outerHeight(),
                    section = {};

                section = {
                    id: id,
                    title: $(elementSection).data('row-name') || scope.l10n.section + ' ' + (i + 1),
                    type: "page-section",
                    nodes: [],
                    animation: [],
                    height: heightElement,
                    offsetTop: parseInt(offsetTopElement)
                };

                $.each($(elementSection).find('.vc_column_container.parallax'), function (j, elementLayer) {
                    var layer = {
                        id: $(elementLayer).data('id'),
                        title: $(elementLayer).data('column-name') || scope.l10n.layerVC,
                        type: "vc",
                        nodes: [],
                        animation: [],
                        overflow: false,
                        relative2screen: false,
                        display: true,
                        displayLG: true,
                        displayMD: true,
                        displaySM: true,
                        displayXS: true,
                    };
                    var key = {
                        frame: parseInt(offsetTopElement) || 0,
                        left: {
                            value: 0
                        },
                        top: {
                            value: 0
                        },
                        width: {
                            value: $(elementLayer).outerWidth()
                        },
                        height: {
                            value: $(elementLayer).outerHeight()
                        }
                    }
                    layer.animation.push(key);
                    section.nodes.push(layer);

                });

                sections.push(section);

            });

            scope.setSectionList({
                pageID: pageID,
                pageSections: sections
            });
        };

        var parms = {
            documentHeight: $(document).outerHeight(),
            windowHeight: $(window).height(),
            windowWidth: $(window).width(),
        };

        var setPosParms = function () {

            var scrollPos = $(window).scrollTop();

            scope.$apply(function () {
                scope.updateScrollPosition(scrollPos, parms);
            });
        };


        $(window).on('load', function () {
            setPosParms();
            setSectionList();


            $('a[href]').on('click', function (e) {
                e.preventDefault();
                if ($('.pc-alert.warning.link').length == 0) {
                    $().pcAlert({class: 'warning link', text: scope.l10n.alertWarning, msg: scope.l10n.alertLinkClick});
                }

            });
        });

        $(window).on('resize', function () {
            parms = {
                documentHeight: $(document).outerHeight(),
                windowHeight: $(window).height(),
                windowWidth: $(window).width(),
            };
            setPosParms();
        });
    }

})(jQuery, _pc);
