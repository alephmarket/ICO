var pcapp = pcapp || {};
var IDEO_PC_VERSION = 'BETA v0.9.3 2017-02-22';
console.log('%cPARALLAX COMPOSER ' + IDEO_PC_VERSION, 'background-color:#e74c3c;color:white;font-weight:bold;font-size:14px; padding:2px 20px;');

(function ($) {
    "use strict";

    var extractDelta = function (e) {
        if (e.wheelDelta) {
            return e.wheelDelta;
        }

        if (e.originalEvent.detail) {
            return e.originalEvent.detail * -40;
        }

        if (e.originalEvent && e.originalEvent.wheelDelta) {
            return e.originalEvent.wheelDelta;
        }
    };

    Array.prototype.unique = function () {
        var a = this.concat();
        for (var i = 0; i < a.length; ++i) {
            for (var j = i + 1; j < a.length; ++j) {
                if (a[i] === a[j])
                    a.splice(j--, 1);
            }
        }

        return a;
    };

    $('html').attr('ng-app', 'pcApp').attr('ng-controller', 'AppCtrl').addClass('pc-mode').addClass(_pc.settings.panelColor);


    pcapp = angular.module('pcApp', ['ngRoute', 'ngAnimate', 'ngSanitize', 'ngResource', 'ui.tree', 'colorpicker.module']);

    var pathTemplates = _pc.config.url + 'js/templates/';

    pcapp.config(function ($routeProvider) {

        $routeProvider
            .when('/', {
                templateUrl: pathTemplates + "page-list.html"
            })
            .when('/page/:pageID', {
                templateUrl: pathTemplates + "page-section-list.html",
                resolve: {
                    loadSection: function (getSection) {
                        return getSection.getSection();
                    }
                }
            })
            .when('/page/:pageID/section/:sectionID', {
                templateUrl: pathTemplates + "section.html",
                controller: "treeCtrl"
            })
            .when('/page/:pageID/section/:sectionID/layer/:layerID', {
                templateUrl: pathTemplates + "layer.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-image/:layerID', {
                templateUrl: pathTemplates + "layer-image.html",
            })
            .when('/page/:pageID/section/:sectionID/layer-audio/:layerID', {
                templateUrl: pathTemplates + "layer-audio.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-shape/:layerID', {
                templateUrl: pathTemplates + "layer-shape.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-multi/:layerID', {
                templateUrl: pathTemplates + "layer-multi.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-text/:layerID', {
                templateUrl: pathTemplates + "layer-text.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-text-block/:layerID', {
                templateUrl: pathTemplates + "layer-text-block.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-vc/:layerID', {
                templateUrl: pathTemplates + "layer-vc.html"
            })
            .when('/page/:pageID/section/:sectionID/layer-nullobject/:layerID', {
                templateUrl: pathTemplates + "layer-nullobject.html"
            })
            .otherwise({
                redirectTo: "/"
            });
    });

    pcapp.factory('getSection', ['$q', function ($q) {
        var sections = $q.defer();

        return {
            getSection: function () {
                return sections.promise;
            },
            loadedSection: function () {
                sections.resolve();
            }
        }
    }]);


    /* FACTORY */

    pcapp.factory('Pages', ['$resource',
        function ($resource) {
            return $resource(_pc.config.ajax.url, {}, {
                query: {
                    method: 'GET',
                    params: {
                        method: 'getpages',
                        nonce: _pc.config.ajax.nonce,
                        mode: 'pc'
                    },
                    isArray: true
                }
            });
        }
    ]);

    pcapp.factory('Data', function () {
        return {
            data: _pc.data,
            currentPage: {},
            currentSection: {},
            currentLayer: {},
            pages: [],
            sections: [],
            layers: []
        };
    });

    pcapp.factory('PCData', function () {
        return {
            showTimeline: false,
            timeline: null
        };
    });


    /* CONTROLLER */

    pcapp.controller('AppCtrl', ['$scope', '$rootScope', '$route', '$routeParams', '$q', '$location', '$filter', 'Pages', 'Data', 'PCData', 'getSection', '$http', '$compile', '$timeout', '$document',
        function ($scope, $rootScope, $route, $routeParams, $q, $location, $filter, Pages, Data, PCData, getSection, $http, $compile, $timeout, $document) {


            $scope.iframe = null;
            $scope.l10n = _pcl10n;
            $scope.breadcrumb = [];
            $scope.pages = [];
            $scope.data = Data;
            $scope.sections = [];
            $scope.currentPage = {};
            $scope.currentSection = {};
            $scope.currentLayer = {};
            $scope.data.isCopyAnimation = false;
            $scope.data.copyAnimation = [];
            $scope.showStartPage = true;
            $scope.showPreloader = false; //true;
            $scope.textPreloader = $scope.l10n.preloader.pageLoading;
            $scope.dataChanged = null;
            $scope.PCData = PCData;
            $scope.PCData.changeView = true;

            $scope.showEmptySectionInfo = false;

            $scope.pages = Pages.query();
            $scope.data.pages = $scope.pages;


            $scope.data.settings = _pc.settings || {
                disableParallaxComposerAnimWidth: '',
                displayContentWidthBorder: false,
                displayLayerNames: false,
                displayLayerNamesType: "all",
                displaySectionBorder: false,
                displaySectionOverlay: false,
                displayPanelOverlayed: false,
                displayTootltips: true,
                panelColor: "black"
            };

            if (!$scope.data.settings.displayPanelOverlayed) {
                $('html').removeClass('panel-overlayed');
            } else {
                $('html').addClass('panel-overlayed');
            }
            //FONTS

            $scope.fonts = [];

            angular.forEach(_pc.fonts.items, function (font) {
                if (font.subsets.indexOf(_pc.fonts_extension) > -1) {
                    $scope.fonts.push(font);
                }
            });

            $scope.font = $scope.fonts[0];
            $scope.fontWeight = $scope.font.variants[0];
            $scope.fontExt = _pc.fonts_extension;

            $scope.setFontLink = function () {

                angular.element("head").append("<link />");
                var gf = angular.element("head").children(":last");
                gf.attr({
                    "rel": "stylesheet",
                    "type": "text/css",
                    "href": "http://fonts.googleapis.com/css?family=" + $scope.font.family.replace(/\s/g, '+') + ":" + $scope.fontWeight + '&subset=latin,' + $scope.fontExt.trim()
                });

            }

            $scope.setFont = function (font) {
                $scope.fontWeight = $scope.font.variants[0];
            }

            $scope.setFontWeight = function () {}

            $scope.getFontWeight = function (variant) {
                var idx = $scope.font.variants.indexOf(variant);
                return $scope.font.variants[idx];
            }

            $scope.getFont = function (family) {
                var idx = 0;
                angular.forEach($scope.fonts, function (v, k) {
                    if (v.family == family) {
                        idx = k;
                        return true;
                    }
                });
                return $scope.fonts[idx];
            }


            $location.path("/");

            $scope.onViewLoad = function () {
                $scope.$broadcast('onViewLoad', true);
            }


            $scope.$watch("PCData.updatePreview", function (newValue, oldValue) {
                if (newValue !== oldValue) {
                    $scope.$broadcast('updatePreview', true);
                }
            });

            $scope.$watch("data.currentSection.nodes", function (newValue, oldValue) {
                if (newValue !== oldValue) {
                    $scope.$broadcast('updatePreview', true);
                }
            }, true);


            $scope.$watch("data.settings", function (newValue, oldValue) {
                if (newValue !== oldValue) {
                    if ($scope.data.settings.panelColor == 'black') {
                        $('html').removeClass('white');
                    } else {
                        $('html').addClass('white');
                    }

                    if (!$scope.data.settings.displayPanelOverlayed) {
                        $('html').removeClass('panel-overlayed');
                    } else {
                        $('html').addClass('panel-overlayed');
                    }

                    $scope.saveSettings();
                    $scope.$broadcast('updatePreview', true);
                }
            }, true);


            $scope.range = function (start, stop) {
                return _.range(start, stop);
            }


            $scope.removeTimeline = function () {
                $('#customize-preview').height('100%');

                if ($scope.PCData.timeline) {
                    $scope.PCData.timelineScope.removeTimeline();
                    $scope.PCData.timelineScope.$destroy();
                    $scope.PCData.timeline.remove();
                }
            }
            //start-page
            angular.element($('body.wp-customizer')).append($compile('<div ng-start-page></div>')($scope));
            //loader
            angular.element($('body.wp-customizer')).append($compile('<div ng-pre-loader></div>')($scope));

            $rootScope.$on("$routeChangeStart", function (event, current, previous) {


            });
            $rootScope.$on("$routeChangeSuccess", function (event, current, previous) {

                $timeout(function () {
                    $scope.PCData.changeView = false;
                }, 500);


                var level = Object.keys($routeParams).length;

                $scope.onViewLoad();
                $scope.removeTimeline();
                $scope.collapsedBtnPanel = false;
                $scope.showEmptySectionInfo = false;

                switch (level) {
                    case 0:

                        $scope.view = 'pages';
                        $scope.breadcrumb = [{
                            name: $scope.l10n.pages,
                            path: '/'
                        }];
                        break;
                    case 1:


                        $scope.view = 'sections';
                        $scope.breadcrumb = [{
                                name: $scope.l10n.pages,
                                path: '/'
                            },
                            {
                                name: $scope.l10n.sections,
                                path: '/page/' + $routeParams.pageID
                            }
                        ];

                        break;
                    case 2:

                        $scope.showEmptySectionInfo = $scope.data.currentSection.nodes.length == 0;

                        $scope.view = 'layers';
                        $scope.breadcrumb = [{
                                name: $scope.l10n.pages,
                                path: '/'
                            },
                            {
                                name: $scope.l10n.sections,
                                path: '/page/' + $routeParams.pageID
                            },
                            {
                                name: $scope.l10n.layers,
                                path: '/page/' + $routeParams.pageID + '/section/' + $routeParams.sectionID
                            }
                        ];
                        break;
                    case 3:


                        $scope.view = 'layer';
                        $scope.breadcrumb = [{
                                name: $scope.l10n.pages,
                                path: '/'
                            },
                            {
                                name: $scope.l10n.sections,
                                path: '/page/' + $routeParams.pageID
                            },
                            {
                                name: $scope.l10n.layers,
                                path: '/page/' + $routeParams.pageID + '/section/' + $routeParams.sectionID
                            },
                            {
                                name: $scope.l10n.layer,
                                path: '/page/' + $routeParams.pageID + '/section/' + $routeParams.sectionID + '/layer/' + $routeParams.layerID
                            }
                        ];
                        break;
                    case 4:
                        $scope.breadcrumb = [{
                            name: $scope.l10n.pages,
                            path: '/'
                        }];
                        break;
                }

                $scope.showStartPage = ($scope.view == 'pages');

            });

            $scope.changePage = function (page) {

                $scope.PCData.changeView = true;

                if (page.id != $scope.currentPage.id) {
                    $scope.showPreloader = true;
                } else {
                    $location.path("/page/" + $scope.currentPage.id);
                    getSection.loadedSection();
                }


                $scope.viewClass = 'page-selected';
                $scope.currentPage = page;
                $scope.data.currentPage = page;

                if (wp.customize.previewer.previewUrl() != page.url) {
                    wp.customize.previewer.previewUrl(page.url);
                } else {

                    $scope.showPreloader = false;
                    if ($scope.currentPage.id) {
                        $location.path("/page/" + $scope.currentPage.id);
                    }

                    $($('#customize-preview iframe').contents()).scroll(function () {

                        $scope.scrollPos = parseInt($(this).scrollTop());
                        $scope.$apply();

                    });
                }
            };

            $scope.toggleSettingsPanel = function (scope) {
                //popup settings
                angular.element($('body.wp-customizer')).append($compile(
                    '<div ng-modal-window>' +
                    '<div class="pc-modal-window large">' +
                    '<div class="header"><span class="icon settings"></span> <span ng-bind="::l10n.modalWindow.settings"></span> <div class="close icon"></div></div>' +
                    '<div class="body">' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayLayerNames"></span>' +
                    '<select ng-model="data.settings.displayLayerNamesType"><option value="off" ng-bind="::l10n.modalWindow.displayLayerNamesTypeOff"></option><option value="all" ng-bind="::l10n.modalWindow.displayLayerNamesTypeAll"></option><option value="hover" ng-bind="::l10n.modalWindow.displayLayerNamesTypeHover"></option></select>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.displayLayerNamesInfo"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayTootltips"></span>' +
                    '<div ng-switcher data="data.settings.displayTootltips" ng-init="data.settings.displayTootltips || false"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div>' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displaySectionBorder"></span>' +
                    '<div ng-switcher data="data.settings.displaySectionBorder" ng-init="data.settings.displaySectionBorder || false"></div>' +
                    '</div>' +
                    '<div>' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayContentWidthBorder"></span>' +
                    '<div ng-switcher data="data.settings.displayContentWidthBorder" ng-init="data.settings.displayContentWidthBorder || false"></div>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.displayContentWidthBorderInfo"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.panelColor"></span>' +
                    '<select ng-model="data.settings.panelColor"><option value="black" ng-bind="::l10n.modalWindow.panelColorBlack"></option><option value="white" ng-bind="::l10n.modalWindow.panelColorWhite"></option></select>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.panelColorInfo"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayPanelOverlayed"></span>' +
                    '<div ng-switcher data="data.settings.displayPanelOverlayed" ng-init="data.settings.displayPanelOverlayed || false"></div>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.displayPanelOverlayedInfo"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="footer"></div></div></div>')($scope));
            };

            $scope.toggleIEPanel = function (scope) {
                if ($scope.view == 'layers') {
                    $scope.collapsedIEPanel = !$scope.collapsedIEPanel;
                } else {
                    $scope.collapsedIEPanel = false;
                }
            }

            $scope.toggleImportPanel = function (scope) {
                //popup settings
                angular.element($('body.wp-customizer')).append($compile(
                    '<div ng-modal-window>' +
                    '<div class="pc-modal-window large">' +
                    '<div class="header"><span class="icon import-export"></span> <span ng-bind="::l10n.modalWindow.importExport"></span> <div class="close icon"></div></div>' +
                    '<div class="body">' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayLayerNames"></span>' +
                    '<div ng-switcher data="data.settings.displayLayerNames" ng-init="data.settings.displayLayerNames || false"></div>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.displayLayerNamesInfo"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayTootltips"></span>' +
                    '<div ng-switcher data="data.settings.displayTootltips" ng-init="data.settings.displayTootltips || false"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<div>' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displaySectionBorder"></span>' +
                    '<div ng-switcher data="data.settings.displaySectionBorder" ng-init="data.settings.displaySectionBorder || false"></div>' +
                    '</div>' +
                    '<div>' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displaySectionOverlay"></span>' +
                    '<div ng-switcher data="data.settings.displaySectionOverlay" ng-init="data.settings.displaySectionOverlay || false"></div>' +
                    '</div>' +
                    '<div>' +
                    '<span class="label" ng-bind="::l10n.modalWindow.displayContentWidthBorder"></span>' +
                    '<div ng-switcher data="data.settings.displayContentWidthBorder" ng-init="data.settings.displayContentWidthBorder || false"></div>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.displayContentWidthBorderInfo"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.disableParallaxComposerAnimWidth"></span>' +
                    '<input ng-model="data.settings.disableParallaxComposerAnimWidth">' +
                    '<div class="info" ng-bind="::l10n.modalWindow.disableParallaxComposerAnimWidthInfo"></div>' +
                    '</div>' +
                    '<div class="row">' +
                    '<span class="label" ng-bind="::l10n.modalWindow.panelColor"></span>' +
                    '<select ng-model="data.settings.panelColor"><option value="black" ng-bind="::l10n.modalWindow.panelColorBlack"></option><option value="white" ng-bind="::l10n.modalWindow.panelColorWhite"></option></select>' +
                    '<div class="info" ng-bind="::l10n.modalWindow.panelColorInfo"></div>' +
                    '</div>' +
                    '</div>' +
                    '<div class="footer"></div></div></div>')($scope));
            };


            $scope.toggleBtnPanel = function (scope) {
                $scope.collapsedBtnPanel = !$scope.collapsedBtnPanel;
            };

            $scope.switchPanel = function (link) {
                $location.path(link);
            };

            $scope.updateScrollPosition = function (pos, parms) {


                $scope.scrollPos = pos;
                $scope.windowParms = parms;
            };

            var findDeep = function (items, search) {

                function traverse(value) {
                    var find = false;
                    _.forEach(value, function (v, i) {
                        if (find) {
                            return false;
                        }
                        if (v.id == search.id) {
                            find = v;
                            return false;
                        }

                        if (_.isArray(v.nodes) && v.nodes.length > 0) {
                            find = traverse(v.nodes);
                        }

                        if (find) {
                            return false;
                        }

                    });

                    return find;
                }

                return traverse(items);
            }

            $scope.compareData = function (sectionFrontEnd /*data front-end*/ , sectionSaved /*data save*/ ) {
                var result,
                    nodesFrontEnd = sectionFrontEnd.nodes;

                sectionFrontEnd.nodes = [];

                result = _.extend(sectionFrontEnd, sectionSaved);

                _.forEach(nodesFrontEnd, function (node) {

                    if (findDeep(sectionSaved.nodes, node) === false) {
                        result.nodes.push(node);
                    }
                });

                //usuwanie wyłączonych vc_column 
                var deepClean = function (nodes) {
                    _.forEach(nodes, function (node, index) {
                        if (typeof node != 'undefined') return false;
                        if (node.type == 'vc') {
                            var find = _.find(nodesFrontEnd, function (el) {
                                return el.id == node.id;
                            });
                            if (!find) {
                                nodes.splice(index, 1);
                            }
                        }
                        if (node.nodes.length > 0) {
                            deepClean(node.nodes);
                        }

                    });
                }
                deepClean(result.nodes);

                return result;
            }

            $scope.setSectionList = function (sections) {
                $scope.pageID = sections.pageID;
                if ($scope.pages.length) {

                    _.each($scope.pages, function (page) {
                        if (!$scope.data.data[page.id]) {
                            $scope.data.data[page.id] = [];
                        }
                    });

                    $scope.$apply(function () {

                        var currentPage = _.find($scope.pages, function (el) {
                            return el.id == sections.pageID;
                        });

                        $scope.data.currentPage = currentPage || {};
                        //dane z frontendu
                        $scope.data.sections = sections.pageSections;

                        // Zamiana sekcji pobranych z zapisanymi   
                        //wszystkie sekcje z front
                        _.each($scope.data.sections, function (section, index) {
                            //znajdz sekcje w zapisanych
                            var dataSection = _.find($scope.data.data[$scope.data.currentPage.id], function (el) {
                                return el.id == section.id;
                            });

                            if (dataSection) {
                                // nadpisz sekcje 
                                var sectionHeight = section.height,
                                    sectionOffsetTop = section.offsetTop;

                                $scope.data.sections[index] = $scope.compareData(section, dataSection);
                                // zachowaj orginalne ustawienia
                                $scope.data.sections[index].height = sectionHeight;
                                $scope.data.sections[index].offsetTop = sectionOffsetTop;

                            } else {
                                if ($scope.data.currentPage.id) {
                                    $scope.data.data[$scope.data.currentPage.id].push(section);
                                }
                            }

                        });
                        //usuwanie starych sekcji 
                        _.each($scope.data.data[$scope.data.currentPage.id], function (section, index) {
                            //znajdz sekcje w zapisanych
                            if (typeof section != 'undefined') {
                                var dataSection = _.find($scope.data.sections, function (el) {
                                    return el.id == section.id;
                                });

                                if (!dataSection) {
                                    $scope.data.data[$scope.data.currentPage.id].splice(index, 1);
                                }
                            }

                        });


                        getSection.loadedSection();

                        $scope.showPreloader = false;
                        if ($scope.currentPage.id) {
                            $location.path("/page/" + $scope.currentPage.id);
                        }

                        $($('#customize-preview iframe').contents()).scroll(function () {

                            $scope.scrollPos = parseInt($(this).scrollTop());
                            $scope.$apply();

                        });


                    });
                } else {
                    $scope.showPreloader = false;
                    $scope.$apply();
                }

                $timeout(function () {
                    $('#customize-preview iframe').contents().scrollTop(0);
                }, 300);
            }

            $scope.selectSection = function (section) {
                $scope.PCData.changeView = true;

                $location.path("page/" + $scope.currentPage.id + "/section/" + section.id);

                $scope.data.currentSection = section;
                $scope.data.layers = $scope.data.currentSection.nodes;

                $('#customize-preview iframe')[0].contentWindow.document.onclick = function () {
                    $scope.collapsedIEPanel = false;
                    $scope.collapsedBtnPanel = false;
                };

                $('#customize-preview iframe').contents().scrollTop(parseInt(section.offsetTop));
            }


            $scope.addLayer = function (type) {
                $scope.addLayerType = type;
                switch (type) {
                    case 'image':
                        angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + type + '"></span> <span ng-bind="::l10n.modalWindow.add.image"></span> <div class="close icon"></div></div><div class="body"><div class="row"><span class="label" ng-bind="::l10n.name"></span> <input class="name"></div><div class="row"><div class="pc-alert error"  ng-show="!isFileValidate"><span ng-bind="::l10n.alertErrorFileValidation"></span></div><span class="label" ng-bind="::l10n.file"></span> <div class="media-files"><a class="button file"><span ng-bind="::l10n.chooseFile"></span></a></div><p class="attachment-file"></p></div></div><div class="footer"><a class="button add-layer" ng-show="isFileValidate"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
                        break;
                    case 'audio':
                        angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + type + '"></span> <span ng-bind="::l10n.modalWindow.add.audio"></span> <div class="close icon"></div></div><div class="body"><div class="row"><span class="label" ng-bind="::">{{ l10n.name }}</span> <input class="name"></div><div class="row"><div class="pc-alert error"  ng-show="!isFileValidate"><span ng-bind="::l10n.alertErrorFileValidation"></span></div><span class="label" ng-bind="::">{{ l10n.file }}</span> <div class="media-file"><a class="button file"><span ng-bind="::l10n.chooseFile"></span></a></div><div class="legend"><span class="icon info"></span> <span ng-bind="::l10n.modalWindow.infoAudio"></span></div><p class="attachment-file"></p></div></div><div class="footer"><a class="button add-layer"  ng-show="isFileValidate"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
                        break;
                    case 'multi':
                        angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + type + '"></span> <span ng-bind="::l10n.modalWindow.add.multi"></span> <div class="close icon"></div></div><div class="body"><div class="row"><span class="label" ng-bind="::">{{ l10n.name }}</span> <input class="name"></div><div class="row"><div class="pc-alert error"  ng-show="!isFileValidate"><span ng-bind="::l10n.alertErrorFileValidation"></span></div><span class="label" ng-bind="::l10n.files"></span> <div class="media-files"><a class="button file"><span ng-bind="::l10n.chooseFiles"></span></a></div><div class="clearfix"></div><div class="legend"><span class="icon info"></span> <span ng-bind="::l10n.modalWindow.infoMulti"></span> </div><div class="file-info"></div> <a class="file-list-collapse" ng-show="layer.images.length!=0"></a><ol class="file-list"></ol></div></div><div class="footer"><a class="button add-layer"  ng-show="isFileValidate"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
                        break;
                    case 'shape':
                        angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window large"><div class="header"><span class="icon ' + type + '"></span> <span ng-bind="::l10n.modalWindow.add.shape"></span> <div class="close icon"></div></div><div class="body"><div class="row"><span class="label" ng-bind="::l10n.name"></span> <input class="name"></div><div class="row"><span class="label" ng-bind="::l10n.code"></span> <textarea id="code-layer"></textarea> <div class="legend"><span class="icon info"></span> <span ng-bind="::l10n.modalWindow.infoShape"></span></div></div></div><div class="footer"><a class="button add-layer"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
                        break;
                    case 'text':
                    case 'text-block':
                        angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window large"><div class="header"><span class="icon ' + type + '"></span> <span ng-bind="::l10n.modalWindow.add.text"></span> <div class="close icon"></div></div><div class="body"><div class="row"><div class="col-xs-2"><span class="label" ng-bind="::l10n.name"></span></div> <div class="col-xs-10"> <input class="name"></div></div><div class="row"><div class="col-xs-2"><span class="label" ng-bind="::l10n.content"></span></div> <div class="col-xs-10"><div id="text-layer" ng-tinymce attr="layer.text"></div></div></div></div><div class="footer"><a class="button add-layer"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
                        break;
                    case 'nullobject':
                        angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + type + '"></span> <span ng-bind="::l10n.modalWindow.add.nullobject"></span> <div class="close icon"></div></div><div class="body"><div class="row"><span class="label" ng-bind="::l10n.name"></span> <input class="name"></div></div><div class="footer"><a class="button add-layer"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
                        break;
                }
                $scope.collapsedBtnPanel = false;
                $('.pc-modal-window .name').focus();

            };

            $scope.toggleFullScreen = function () {
                if (!document.fullscreenElement && // alternative standard method
                    !document.mozFullScreenElement && !document.webkitFullscreenElement && !document.msFullscreenElement) { // current working methods
                    if (document.documentElement.requestFullscreen) {
                        document.documentElement.requestFullscreen();
                    } else if (document.documentElement.msRequestFullscreen) {
                        document.documentElement.msRequestFullscreen();
                    } else if (document.documentElement.mozRequestFullScreen) {
                        document.documentElement.mozRequestFullScreen();
                    } else if (document.documentElement.webkitRequestFullscreen) {
                        document.documentElement.webkitRequestFullscreen(Element.ALLOW_KEYBOARD_INPUT);
                    }
                } else {
                    if (document.exitFullscreen) {
                        document.exitFullscreen();
                    } else if (document.msExitFullscreen) {
                        document.msExitFullscreen();
                    } else if (document.mozCancelFullScreen) {
                        document.mozCancelFullScreen();
                    } else if (document.webkitExitFullscreen) {
                        document.webkitExitFullscreen();
                    }
                }
            }

            $scope.save = function () {
                $scope.isStoringData = true;

                $http({
                    method: 'POST',
                    url: _pc.config.ajax.url,
                    responseType: 'json',
                    params: {
                        method: 'save',
                        nonce: _pc.config.ajax.nonce
                    },
                    data: $scope.data,
                    cache: false,
                }).then(function successCallback(response) {
                    $scope.isStoringData = false;
                }, function errorCallback(response) {

                });
            }

            $scope.saveSettings = function () {

                $http({
                    method: 'POST',
                    url: _pc.config.ajax.url,
                    responseType: 'json',
                    params: {
                        method: 'savesettings',
                        nonce: _pc.config.ajax.nonce
                    },
                    data: $scope.data.settings,
                    cache: false,
                }).then(function (res) {}, function (res) {});
            }
            $scope.exportedFile = '';
            $scope.exportAll = function () {

                $scope.isExporting = true;
                $scope.exportedFile = '';

                $http({
                    method: 'POST',
                    url: _pc.config.ajax.url,
                    responseType: 'json',
                    params: {
                        method: 'export',
                        nonce: _pc.config.ajax.nonce
                    },
                    data: $scope.data.currentSection.nodes,
                    cache: false,
                }).then(function (res) {
                    if (res.data.file) {
                        $scope.exportedFile = res.data.file;
                    }
                    $scope.isExporting = false;
                }, function (res) {});
            }


            $scope.importLayers = function (src) {

                var code = angular.copy($scope.data.currentSection.import).replace(/","type":"vc"/g, ' (VC > NO)","type":"nullobject"') || '[]';
                $scope.data.currentSection.import == '';

                if (src == 'code' && code == '[]') {
                    alert('Nothing to import');
                    return true;
                } else if (src == 'file' && $scope.importFileZip == '') {
                    alert('Nothing to import');
                    return true;
                }

                $scope.isImporting = true;


                $http({
                    method: 'POST',
                    url: _pc.config.ajax.url,
                    responseType: 'json',
                    params: {
                        method: 'import',
                        nonce: _pc.config.ajax.nonce
                    },
                    data: {
                        code: code,
                        file: $scope.importFileZip,
                        src: src
                    },
                    cache: false,
                }).then(function (res) {
                    if (res.data.error) {
                        alert(res.data.error)
                    } else {
                        if (res.data.length > 0) {
                            _.each(res.data, function (layer) {
                                //find and remove exists layer
                                var index = -1;
                                _.each($scope.data.currentSection.nodes, function (el, idx) {

                                    if (el.id == layer.id) index = idx;
                                });
                                if (index !== -1) {
                                    $scope.data.currentSection.nodes.splice(index, 1);
                                }

                                $scope.data.currentSection.nodes.push(layer);
                            });
                            $scope.showEmptySectionInfo = false;
                        }
                    }

                    $scope.isImporting = false;
                },function (res) {
                    //alert(res)
                });


            }

            $scope.importFileZip = '';
            $scope.isFileZip = true;
            $scope.isImporting = false;
            $scope.isExporting = false;

            $scope.uploadFile = function () {

                wp.media.editor.send.attachment = function (props, attachment) {
                    var exp = /zip/g;
                    $scope.importFileZip = attachment.filename;

                    if (exp.test(attachment.mime)) {
                        $scope.isFileZip = true;
                    } else {
                        $scope.isFileZip = false;
                    }
                }
                wp.media.editor.open();

            }

            $scope.closeModalWindow = function () {
                $scope.importFileZip = '';
                $scope.exportedFile = '';
            }


            $scope.export = function () {
                $scope.modalWindow = angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window><div class="pc-modal-window large"><div class="header"><span class="icon export"></span> <span ng-bind="::l10n.modalWindow.export"></span> <div class="close icon" ng-click="closeModalWindow()"></div></div><div class="body"><div class="row"><div class="col-xs-2"><span class="label" ng-bind="::l10n.quickexport"></span></div> <div class="col-xs-10"><textarea ng-bind="data.currentSection.nodes|json:0" readonly onClick="this.select()"></textarea><p><small ng-bind="::l10n.modalWindow.exportInfo"></small></p></div></div><div class="row"><div class="col-xs-2"><span class="label" ng-bind="::l10n.mainexport"></span></div> <div class="col-xs-10"><p><a class="button export-layer" ng-click="exportAll()"><span  ng-if="!isExporting" ng-bind="::l10n.exportAll"></span><span class="loading" ng-if="isExporting"></span></a> </p> <p><small ng-bind="::l10n.modalWindow.exportFilesInfo"></small></p> </div></div></div><div class="footer"><a ng-if="exportedFile" href="{{exportedFile}}" class="button" ><span ng-bind="::l10n.save"></span></a> <a class="button red close" ng-click="closeModalWindow()"><span ng-bind="::l10n.close"></span></a></div></div></div>')($scope));


                $scope.collapsedIEPanel = false;
            }

            $scope.import = function () {
                $scope.data.currentSection.import = '';
                $scope.modalWindow = angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window large"><div class="header"><span class="icon export"></span> <span ng-bind="::l10n.modalWindow.import"></span> <div class="close icon" ng-click="closeModalWindow()"></div></div><div class="body"><div class="row"><div class="col-xs-2"><span class="label" ng-bind="::l10n.quickimport"></span></div> <div class="col-xs-10"><textarea ng-model="data.currentSection.import"></textarea><p><small ng-bind="::l10n.modalWindow.importInfo"></small></p> <div class="text-right"><a class="button import-layers" ng-click="importLayers(\'code\')"><span ng-if="!isImporting" ng-bind="::l10n.import"></span><span class="loading" ng-if="isImporting"></span></a></div> </div> </div><div class="row"> <div class="pc-alert error"  ng-show="!isFileZip"><span ng-bind="::l10n.alertErrorFileValidation"></span></div> <div class="col-xs-2"><span class="label" ng-bind="::l10n.mainimport"></span></div> <div class="col-xs-10"><p>  <a class="button" ng-click="uploadFile()"><span ng-bind="::l10n.uploadFile"></span></a> {{importFileZip}} </p> <div class="legend"><span class="icon info"></span> <span ng-bind="::l10n.modalWindow.infoImport"></span></div> <div class="text-right"><br><a class="button import-layers" ng-click="importLayers(\'file\')" ng-show="isFileZip"><span ng-if="!isImporting" ng-bind="::l10n.import"></span><span class="loading" ng-if="isImporting"></span></a></div> </div></div></div><div class="footer"> <a class="button red close" ng-click="closeModalWindow()"><span ng-bind="::l10n.close"></span></a></div></div></div>')($scope));

                $scope.collapsedIEPanel = false;
            }

            $(document).mouseup(function (e) {
                var container = $(".pc-import-export");

                if (!container.is(e.target) // if the target of the click isn't the container...
                    &&
                    container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                    $scope.collapsedIEPanel = false;
                }
            });
            $(document).mouseup(function (e) {
                var container = $(".pc-panel-layers");

                if (!container.is(e.target) // if the target of the click isn't the container...
                    &&
                    container.has(e.target).length === 0) // ... nor a descendant of the container
                {
                    $scope.collapsedBtnPanel = false;
                }
            });

        }
    ]);

    pcapp.controller('treeCtrl', ['$scope', '$location', '$filter', 'Data', '$compile', '$timeout',
        function ($scope, $location, $filter, Data, $compile, $timeout) {
            $scope.msg = 'layers';
            $scope.data = Data;


            $scope.toggle = function (scope) {
                scope.toggle();
            };

            $scope.remove = function (scope) {
                scope.remove();
            };

            $scope.editSection = function () {

            }

            $scope.editLayer = function (layer) {
                $scope.PCData.changeView = true;
                $location.path("page/" + Data.currentPage.id + "/section/" + Data.currentSection.id + "/layer-" + layer.type + "/" + layer.id);
                $scope.data.currentLayer = layer;
            }
            var uniqId = function () {
                return Math.round(new Date().getTime() + (Math.random() * 1000));
            }
            var regenerateID = function (nodes) {
                _.each(nodes, function (node) {
                    node.id = uniqId();
                    if (node.nodes.length > 0) {
                        regenerateID(node.nodes);
                    }
                });
            }
            $scope.cloneLayer = function (layer) {
                var cloneLayer = angular.copy(layer);
                cloneLayer.id = uniqId();
                regenerateID(cloneLayer.nodes);
                $scope.data.currentSection.nodes.push(cloneLayer);

            }

            $scope.layerMouseenter = function (layer) {
                if ($scope.data.settings.displayLayerNamesType == 'hover')
                    $('#customize-preview iframe')[0].contentWindow._pc.layerMouseenter(layer.id);
            }
            $scope.layerMouseleave = function (layer) {
                if ($scope.data.settings.displayLayerNamesType == 'hover')
                    $('#customize-preview iframe')[0].contentWindow._pc.layerMouseleave(layer.id);
            }

            $scope.togglePreview = function (layer, event) {
                if(layer.preview === false){
                    layer.preview = true;
                }else{
                   layer.preview = false;
                }
            }
            $scope.togglePreviewAll = function (action) {
                // switch(action){

                // }
                _.each($scope.data.currentSection.nodes, function(node){
                    node.preview =  action == 'show' ? true : action == 'hide' ? false : !node.preview;
                });
                
            }

            $scope.deleteLayerConfirm = function (layer, event) {

                var confirmWindow = $(event.currentTarget).parent().next(),
                    panel = $(event.currentTarget).closest('.pc-panel'),
                    top;

                confirmWindow.show();

                setInterval(function () {
                    top = panel.offset().top + panel.height() - confirmWindow.offset().top - confirmWindow.height();

                    if (top < 0) {
                        confirmWindow.css({
                            top: top
                        });
                    }
                }, 25);

                confirmWindow.find('.cancel').on('click', function () {
                    confirmWindow.hide();
                });

            }

            $scope.findDeleteLayer = function (nodes, layer) {
                var index = nodes.indexOf(layer);
                if (index != -1) {
                    nodes.splice(index, 1);
                    return true;
                }

                _.each(nodes, function (node) {
                    if (node.nodes.length > 0) {
                        $scope.findDeleteLayer(node.nodes, layer);
                    }
                });

                return false;
            }

            $scope.deleteLayer = function (layer) {
                $scope.findDeleteLayer($scope.data.currentSection.nodes, layer);
            }


            $scope.deleteAllLayers = function () {
                $scope.data.currentSection.nodes = [];
            }

            $scope.importLayersCode = function () {
                var importData = JSON.parse($scope.import);
                _.each(importData, function (layer) {
                    layer.id = _.uniqueId(new Date().getTime());
                    $scope.offsetAnimation(layer, $scope.importOffset);
                });

                $scope.data.currentSection.nodes = importData;
                $scope.$apply();
            }

            $scope.hideShowAllLayers = function () {
                _.each($scope.data.currentSection.nodes, function (layer) {
                    layer.display = !layer.display;
                });
                $scope.$apply();
            }

            $scope.offsetAnimation = function (layer, offset) {
                if (layer.start) {
                    layer.start += parseInt(offset);
                }
                if (layer.stop) {
                    layer.stop += parseInt(offset);
                }
                _.each(layer.animation, function (key, index) {
                    key.frame += parseInt(offset);
                });


            }


        }
    ]);


    pcapp.controller('editLayer', ['$scope', 'Data', 'PCData', '$compile', '$location', '$timeout',
        function ($scope, Data, PCData, $compile, $location, $timeout) {
            $scope.msg = 'layers';
            $scope.data = Data;
            $scope.PCData = PCData;
            $scope.layer = Data.currentLayer;
            $scope.frame = {};
            $scope.isopen = 0;
            $scope.selectedParentItem = Data.currentSection;
            $scope.isSizeLock = true;
            $scope.isScaleLock = true;
            $scope.sizeLockRatio = 1;
            $scope.isParent = true;

            $scope.backgroundPosition = [{
                value: 'left top',
                title: 'TOP LEFT'
            }, {
                value: 'center top',
                title: 'TOP CENTER'
            }, {
                value: 'right top',
                title: 'TOP RIGHT'
            }, {
                value: 'left center',
                title: 'CENTER LEFT'
            }, {
                value: 'center center',
                title: 'CENTER CENTER'
            }, {
                value: 'right center',
                title: 'CENTER RIGHT'
            }, {
                value: 'left bottom',
                title: 'BOTTOM LEFT'
            }, {
                value: 'center bottom',
                title: 'BOTTOM CENTER'
            }, {
                value: 'right bottom',
                title: 'BOTTOM RIGHT'
            }];

            $scope.backgroundSize = [{
                value: 'inherit',
                title: 'NO SCALE'
            }, {
                value: '100% 100%',
                title: 'SCALE'
            }, {
                value: 'cover',
                title: 'COVER'
            }, {
                value: 'contain',
                title: 'CONTAIN'
            }];


            $scope.backgroundRepeat = [{
                value: 'repeat',
                title: 'REPEAT'
            }, {
                value: 'no-repeat',
                title: 'NO REPEAT'
            }, {
                value: 'repeat-x',
                title: 'REPEAT X'
            }, {
                value: 'repeat-y',
                title: 'REPEAT Y'
            }];


            //timeline
            $timeout(function () {
                $scope.PCData.timelineScope = $scope.$new(false);
                $scope.PCData.timeline = $compile('<div ng-timeline id="pc-timeline" ng-cloak></div>')($scope.PCData.timelineScope);
                angular.element($('#customize-preview')).after($scope.PCData.timeline);
            }, 1000);


            $scope.$watch("layer", _.debounce(function (newValue, oldValue) {

                if (newValue !== oldValue) {
                    if (newValue.size === true && $scope.frame && $scope.frame.width) {
                        $scope.frame['height'] = {
                            value: $scope.frame.width.value
                        }

                    }

                    $scope.PCData.updatePreview = !$scope.PCData.updatePreview;
                }

            }, 200), true);


            var parent = _.find($scope.selectedParentItem.nodes, function (layer) {
                return layer.id == $scope.layer.id;
            });


            if (parent) {
                $scope.isParent = true;
            } else {
                $scope.isParent = false;
            }


            $scope.$watch("scrollPos", _.debounce(function (value, oldvalue) {

                $scope.frame = _.find($scope.layer.animation, function (el) {
                    return el.frame == $scope.scrollPos;
                });
                if (typeof $scope.frame == 'undefined') {
                    $scope.frame = {};
                }

                if ($scope.frame && $scope.frame.width && $scope.frame.height) {
                    $scope.sizeLockRatio = $scope.frame.width.value / $scope.frame.height.value;
                }

            }, 300));

            $scope.$watch("frame", function (value, oldvalue) {

                var allow = $scope.checkFreez('insertInFreez');

                if (!allow && $scope.frame.top && !$scope.frame.top.label) {
                    delete $scope.frame['top'];
                    $('#customize-preview iframe')[0].contentWindow.jQuery().pcAlert({
                        class: 'warning',
                        text: $scope.l10n.alertWarning,
                        msg: $scope.l10n.alertWarningEditFreez
                    });
                }

                if (typeof $scope.frame.frame == 'undefined' && Object.keys($scope.frame).length > 0) {
                    if (typeof $scope.frame[Object.keys($scope.frame)[0]].value !== 'undefined') {
                        $scope.frame.frame = $scope.scrollPos;
                        $scope.layer.animation.push($scope.frame);
                    }
                }


            }, true);

            $scope.changeScale = function (scale) {
                if ($scope.isScaleLock) {
                    $scope.frame.scaleX = angular.copy(scale);
                    $scope.frame.scaleY = angular.copy(scale);
                    $scope.frame.scaleZ = angular.copy(scale);
                }
            }

            $scope.changeSize = function (prop) {
                if (prop == 'width') {
                    if ($scope.isSizeLock && $scope.sizeLockRatio && $scope.frame.width && $scope.frame.width.value) {
                        if ($scope.frame.height) {
                            $scope.frame.height.value = parseInt($scope.frame.width.value / $scope.sizeLockRatio);
                            $scope.frame.height.precent = $scope.frame.width.precent;
                        } else {
                            $scope.frame.height = {
                                value: parseInt($scope.frame.width.value / $scope.sizeLockRatio),
                                precent: $scope.frame.width.precent
                            };
                        }
                    }
                }

                if (prop == 'height') {
                    if ($scope.isSizeLock && $scope.sizeLockRatio && $scope.frame.height && $scope.frame.height.value) {
                        if ($scope.frame.width) {
                            $scope.frame.width.value = parseInt($scope.frame.height.value * $scope.sizeLockRatio);
                            $scope.frame.width.precent = $scope.frame.height.precent;
                        } else {
                            $scope.frame.width = {
                                value: parseInt($scope.frame.height.value * $scope.sizeLockRatio),
                                precent: $scope.frame.height.precent
                            };
                        }
                    }
                }
            }


            $scope.updateKey = function (prop, value) {
                var key = _.find($scope.layer.animation, function (el) {
                    return el.frame == $scope.scrollPos;
                });
                if (key) {
                    key[prop] = value;
                } else {
                    key = {
                        frame: $scope.scrollPos
                    };
                    key[prop] = value;
                    $scope.layer.animation.push(key);

                    $scope.frame = _.find($scope.layer.animation, function (el) {
                        return el.frame == $scope.scrollPos;
                    });
                }


            }

            $scope.offsetAnimation = function (offset) {
                if (parseInt(offset)) {

                    $scope.updateOffsetAnimation($scope.layer, offset);

                    $('#customize-preview iframe')[0].contentWindow.jQuery().pcAlert({
                        class: 'success',
                        text: $scope.l10n.alertSuccess,
                        msg: $scope.l10n.alertOffsetSuccess
                    });
                }

            }

            $scope.updateOffsetAnimation = function (layer, offset) {
                if (parseInt(offset)) {
                    if (layer.start) {
                        layer.start += parseInt(offset);
                    }
                    if (layer.stop) {
                        layer.stop += parseInt(offset);
                    }
                    _.each(layer.animation, function (key, index) {
                        key.frame += parseInt(offset);
                    });

                    if (layer.nodes.length > 0) {
                        _.each(layer.nodes, function (child) {
                            $scope.updateOffsetAnimation(child, offset);
                        });
                    }
                }
            }

            $scope.updateParentSection = function ($this) {
                $scope.selectedParentItem = $this.selectedParentItem;

                var index = Data.currentSection.nodes.indexOf($scope.layer);

                if (index != -1) {
                    if ($scope.layer.animation.length > 0) {
                        $scope.updateOffsetAnimation($scope.layer, $scope.selectedParentItem.offsetTop - Data.currentSection.offsetTop);

                        var findOffset = _.pluck($scope.layer.animation, 'frame').sort();
                        if (findOffset[0] < 0) {
                            $scope.updateOffsetAnimation($scope.layer, -findOffset[0]);
                        }
                    }
                    Data.currentSection.nodes.splice(index, 1);
                    $scope.selectedParentItem.nodes.push($scope.layer);
                    Data.currentSection = $scope.selectedParentItem;

                }

            }

            //edycja Layera
            $scope.isFreez = false;
            $scope.freezId = null;

            $scope.changeImage = function () {
                $scope.addLayerType = $scope.layer.type;
                angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + $scope.layer.type + '"></span> <span ng-bind="::l10n.modalWindow.edit.image"></span> <div class="close icon"></div></div><div class="body"><div class="row"><div class="pc-alert error"  ng-show="!isFileValidate"><span ng-bind="::l10n.alertErrorFileValidation"></span></div><span class="label" ng-bind="::l10n.file"></span> <div class="media-files"><a class="button file"> <span ng-bind="::l10n.chooseFile"></span></a></div><p class="attachment-file"> <span ng-bind="::l10n.file"></span>: ' + $scope.layer.image.filename + '(' + $scope.layer.image.width + 'x' + $scope.layer.image.height + ')</p><div class="clearfix"></div></div></div><div class="footer"><a class="button " ng-click="updateFile(layer)"  ng-show="isFileValidate"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));

            }

            $scope.changeImageList = function () {
                $scope.addLayerType = $scope.layer.type;
                angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + $scope.layer.type + '"></span> <span ng-bind="::l10n.modalWindow.edit.multi"></span> <div class="close icon"></div></div><div class="body"><div class="row"><div class="pc-alert error"  ng-show="!isFileValidate"><span ng-bind="::l10n.alertErrorFileValidation"></span></div><span class="label" ng-bind="::l10n.files"></span> <div class="media-files"><a class="button file"> <span ng-bind="::l10n.chooseFiles"></span></a></div><div class="clearfix"></div><div class="legend"><span class="icon info"></span> <span ng-bind="::l10n.modalWindow.infoMulti"></span></div><div class="file-info"></div> <a class="file-list-collapse"> <span ng-bind="::l10n.editLayer.sections.showFiles"></span></a><ol class="file-list"><li ng-repeat="image in layer.multiimages" ng-bind="image.filename"></li></ol></div></div><div class="footer"><a class="button"  ng-show="isFileValidate" ng-click="updateFile(layer)"> <span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));

            }

            $scope.changeAudio = function () {
                $scope.addLayerType = $scope.layer.type;
                angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window"><div class="header"><span class="icon ' + $scope.layer.type + '"></span> <span ng-bind="::l10n.modalWindow.edit.audio"></span> <div class="close icon"></div></div><div class="body"><div class="row"><div class="pc-alert error"  ng-show="!isFileValidate"><span ng-bind="::l10n.alertErrorFileValidation"></span></div><span class="label" ng-bind="::l10n.files"></span> <div class="media-files"><a class="button file"> <span ng-bind="::l10n.chooseFile"></span></a></div><p class="attachment-file"> <span ng-bind="::l10n.files"></span>: ' + $scope.layer.audio.filename + '</p><div class="clearfix"></div></div></div><div class="footer"><a class="button" ng-click="updateFile(layer)" ng-show="isFileValidate"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
            }

            $scope.changeText = function () {
                angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window ><div class="pc-modal-window large"><div class="header"><span class="icon text"></span> <span ng-bind="::l10n.modalWindow.edit.text"></span> <div class="close icon"></div></div><div class="body"><div class="row"><div class="col-xs-2"><span class="label" ng-bind="::l10n.content"></span></div> <div class="col-xs-10"><div ng-tinymce attr="layer.text"></div></div></div></div><div class="footer"><a class="button update-layer"><span ng-bind="::l10n.save"></span></a></div></div></div>')($scope));
            }

            $scope.startFreez = function () {

                if ($scope.checkFreez('startFreez') && !$scope.isFreez) {

                    var layer = $('#customize-preview iframe').contents().find('[data-id="' + $scope.layer.id + '"]'),

                        posOffset = {
                            position: layer.position(),
                            offset: layer.offset(),
                        },
                        key = _.find($scope.layer.animation, function (el) {
                            return el.frame == $scope.scrollPos;
                        }),
                        label = 'startFreez',
                        scrollPos = $scope.scrollPos,
                        vPos = posOffset.position.top,
                        hPos = posOffset.position.left,
                        align = $scope.layer.align || "0% 0%";

                    align = align.split(' ');

                    if (align[1] == '50%') {
                        vPos = vPos + layer.height() / 2 - layer.parent().outerHeight() / 2;
                    }
                    if (align[1] == '100%') {
                        if (layer.relative2screen == true) {
                            vPos = vPos + layer.height() - layer.parent().outerHeight();
                        } else {
                            vPos = Math.abs(vPos + layer.height() - layer.parent().outerHeight());
                        }
                    }
                    if (align[0] == '50%') {
                        hPos = hPos + layer.outerWidth() / 2 - layer.parent().outerWidth() / 2;
                    }
                    if (align[0] == '100%') {
                        hPos = layer.parent().outerWidth() - hPos - layer.outerWidth();
                    }

                    vPos = parseInt(vPos);
                    hPos = parseInt(hPos);

                    $scope.isFreez = true;
                    $scope.freezId = _.uniqueId(new Date().getTime());

                    $scope.freez = {
                        scrollPos: scrollPos,
                        posOffset: posOffset,
                        vPos: vPos,
                        freezId: $scope.freezId
                    };
                    $scope.updateKey('top', {
                        value: vPos,
                        precent: false,
                        label: label,
                        freezId: angular.copy($scope.freezId)
                    });

                    $scope.updateKey('left', {
                        value: hPos,
                        precent: false
                    });

                } else {
                    $('#customize-preview iframe')[0].contentWindow.jQuery().pcAlert({
                        class: 'warning',
                        text: $scope.l10n.alertWarning,
                        msg: $scope.l10n.alertWarningAddFreez
                    });
                }

            }
            $scope.stopFreez = function () {

                if ($scope.checkFreez('stopFreez')) {
                    var yPos = $scope.freez.vPos + ($scope.scrollPos - $scope.freez.scrollPos);
                    $scope.freez.stop = yPos;
                    $scope.isFreez = false;
                    $scope.updateKey('top', {
                        value: yPos,
                        precent: false,
                        label: 'stopFreez',
                        freezId: angular.copy($scope.freezId)
                    });
                } else {
                    $('#customize-preview iframe')[0].contentWindow.jQuery().pcAlert({
                        class: 'warning',
                        text: $scope.l10n.alertWarning,
                        msg: $scope.l10n.alertWarningAddFreez
                    });
                }


            }

            $scope.checkFreez = function (type) {

                if (type == 'insertInFreez' && $scope.layer.freezArray && $scope.layer.animation.length > 0) {
                    var posStart = _.sortedIndex($scope.layer.freezArray, $scope.scrollPos);
                    return posStart % 2 == 0;
                }
                if (type == 'startFreez' && $scope.layer.animation.length > 0) {
                    var key = _.find($scope.layer.animation, function (key) {
                        return key.frame == $scope.scrollPos;
                    });
                    if (key && key.top && key.top.label) {
                        return false;
                    }
                    var posStart = _.sortedIndex($scope.layer.freezArray, $scope.scrollPos);
                    return posStart % 2 == 0;
                }
                if (type == 'stopFreez' && $scope.layer.animation.length > 0) {

                    if ($scope.freez.scrollPos > $scope.scrollPos) {
                        return false;
                    }

                    var postStart = 0;
                    _.each($scope.layer.animation, function (key) {
                        if (key.frame > $scope.freez.scrollPos && key.frame <= $scope.scrollPos) {
                            if (key && key.top && key.top.label) {
                                postStart++;
                            }
                        }
                    });
                    return postStart == 0;
                }

                return true;

            }

            $scope.$watch('layer.animation', function () {

                $scope.layer.animation.sort(function (a, b) {
                    return a.frame - b.frame;
                });
                if ($scope.isFreez === false) {
                    $scope.getFreezArray();
                }


            }, true);

            $scope.getFreezArray = function () {
                $scope.layer.freezArray = [];
                var arr = {
                    startFreez: [],
                    stopFreez: []
                };

                _.each($scope.layer.animation, function (key) {
                    if (typeof key.top !== 'undefined') {
                        if (typeof key.top.label !== 'undefined') {
                            arr[key.top.label].push(key.frame);
                        }
                    }
                });

                $scope.layer.freezArray = _.union(arr.startFreez, arr.stopFreez).sort(function (a, b) {
                    return a - b
                });

            }

            $scope.isAudioStart = false;
            $scope.startAudio = function () {
                $scope.isAudioStart = true;
                $scope.data.currentLayer.start = $scope.scrollPos;
            }
            $scope.stopAudio = function () {
                $scope.isAudioStart = false;
                $scope.data.currentLayer.stop = $scope.scrollPos;
            }

            $scope.isMultiStart = false;
            $scope.startMulti = function () {
                $scope.isMultiStart = true;
                $scope.data.currentLayer.start = $scope.scrollPos;
            }
            $scope.stopMulti = function () {
                $scope.isMultiStart = false;
                $scope.data.currentLayer.stop = $scope.scrollPos;
            }


            $scope.setPos = function (frame) {
                $('#customize-preview iframe').contents().scrollTop(frame);
            };

            $scope.seekPos = function (pos) {
                var currentPos = parseInt($('#customize-preview iframe').contents().scrollTop()),
                    height = $('#customize-preview iframe').contents().height();

                switch (pos) {
                    case 'first':
                        $('#customize-preview iframe').contents().scrollTop(0);
                        break;
                    case 'prev':
                        $('#customize-preview iframe').contents().scrollTop(currentPos - 1);
                        break;
                    case 'next':
                        $('#customize-preview iframe').contents().scrollTop(currentPos + 1);
                        break;
                    case 'last':
                        $('#customize-preview iframe').contents().scrollTop(height);
                        break;
                }

            };

            $scope.editKey = function (el) {}
            $scope.getCopyAnimation = function () {
                $scope.data.copyAnimation = angular.copy($scope.data.currentLayer.animation);
                $scope.data.isCopyAnimation = true;
                $scope.data.copyAnimationType = $scope.data.currentLayer.type;
            }
            $scope.setCopyAnimation = function () {
                if ($scope.data.copyAnimationType == $scope.data.currentLayer.type) {
                    $scope.data.currentLayer.animation = $scope.data.copyAnimation;
                    $scope.data.isCopyAnimation = false;
                } else {
                    alert($scope.l10n.editLayer.sections.pasteAnimConflict);
                }
            }
            $scope.clearCopyAnimation = function () {
                $scope.data.isCopyAnimation = false;
            }

            $scope.deleteAnimation = function () {
                $scope.data.currentLayer.animation = [];
                $scope.data.currentLayer.start = null;
                $scope.data.currentLayer.stop = null;
            }

            $('.file-list-collapse').on('click', function () {
                $('.file-list').toggle(0, function () {
                    if ($(this).is(':visible')) {
                        $('.file-list-collapse').text('[-]');
                    } else {
                        $('.file-list-collapse').text('[+]');
                    }
                });
            });
            $('.edit-layer-accordion-section h3').on('click', function () {
                $(this).parent().toggleClass('open');
                $(window).trigger('pc.panelopen');
            });


            $scope.lockSize = function () {
                $scope.isSizeLock = !$scope.isSizeLock;
                if ($scope.isSizeLock && $scope.frame && $scope.frame.width && $scope.frame.height) {
                    $scope.sizeLockRatio = $scope.frame.width.value / $scope.frame.height.value;
                }

            }
            $scope.lockScale = function () {
                $scope.isScaleLock = !$scope.isScaleLock;
            }

        }
    ]);


    /* DIRECTIVE */

    pcapp.directive('ngScrollPanel', ['$timeout', '$interval', function ($timeout, $interval) {
        return {
            link: function (scope, elem, attrs) {
                var scroll = elem.find('.scroll-rp'),
                    bar = elem.find('.bar-rp'),
                    panel = elem,
                    subpanel = elem.find('.pc-subpanel');


                var reInit = function () {

                    if (elem.find('.pc-subpanel').height() <= panel.height()) {
                        var scollHeight = 100;
                    } else {
                        var scollHeight = parseInt(panel.height() / elem.find('.pc-subpanel').height() * 100);
                    }

                    // scroll.css({
                    //     height: scollHeight + '%'
                    // }).draggable('option', 'drag').call(scroll);

                    elem.find('.pc-subpanel').css({

                    });
                }
                var subpanelHeight = elem.find('.pc-subpanel').height();
                $interval(function () {
                    if(subpanelHeight != elem.find('.pc-subpanel').height()){
                        reInit();
                    }
                }, 1000);

                $(window).on('resize', function () {
                    reInit();
                });


                scope.$on('onViewLoad', function () {
                    scroll.css({
                        top: 0
                    });

                    $timeout(reInit, 600);
                });

                scroll.draggable({
                    axis: "y",
                    containment: "parent",
                    drag: function () {
                        var top = parseInt(scroll.css('top')),
                            scrolOffset = bar.height() - scroll.height(),
                            panelOffset = $('.pc-subpanel').height() - panel.height();
                        $('.pc-subpanel').stop().animate({
                            top: -parseInt((panelOffset / scrolOffset) * top)
                        }, 200);
                    }
                });

                panel.on('DOMMouseScroll mousewheel', function (event) {
                    var top = parseInt(scroll.css('top')) - extractDelta(event) * (extractDelta(event), panel.height() / elem.find('.pc-subpanel').height());

                    if (top < 0) {
                        top = 0;
                    }
                    if (top > bar.height() - scroll.height()) {
                        top = bar.height() - scroll.height();
                    }
                    if (bar.height() < scroll.height()) {
                        top = 0;
                    }
                    scroll.css({
                        top: top
                    }).draggable('option', 'drag').call(scroll);

                    return false;
                });
            }
        }
    }]);

    pcapp.directive('ngDeleteAllAnimation', function () {
        return {
            transclude: true,
            template: '<div class="del-anim-content"><a class="button red del-anim" ng-transclude></a><div class="pc-confirm">\
                            <div  class="header" ng-bind="::l10n.deleteAskAnimation"></div>\
                                <a class="button confirm"><span ng-bind="::l10n.yes"></span></a>\
                                <a class="button red cancel"><span ng-bind="::l10n.no"></span></a>\
                            </div>\
                    </div></div>',
            link: function (scope, elem, attrs) {
                elem.find('.del-anim').on('click', function () {
                    elem.find('.pc-confirm').show();
                });
                elem.find('.confirm').on('click', function () {
                    scope.data.currentLayer.animation = [];
                    scope.data.currentLayer.start = null;
                    scope.data.currentLayer.stop = null;
                    elem.find('.pc-confirm').hide();
                });
                elem.find('.cancel').on('click', function () {
                    elem.find('.pc-confirm').hide();
                });
            }
        }
    });

    pcapp.directive('ngSwitcher', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                init: '@'
            },
            template: '<div class="switcher" ng-class="{on: data}"><div class="switcher-label"><span ng-show="data">ON</span><span ng-show="!data">OFF</span></div> <span class="switcher-thumb"></span></div>',
            link: function (scope, elem, attrs) {
                elem.bind('click', function () {
                    scope.$apply(function () {
                        scope.data = !scope.data;
                    });
                });
            }

        }
    });

    pcapp.directive('ngTransformOrigin', function () {
        return {
            replace: true,
            scope: {
                data: '='
            },
            template: '<div class="transform-origin">' + '<span class="rec rec-lt" data-origin="0% 0%" ng-class="{active: data==\'0% 0%\' ||  data == null}"></span>' + '<span class="rec rec-ct" data-origin="50% 0%" ng-class="{active: data==\'50% 0%\'}"></span>' + '<span class="rec rec-rt" data-origin="100% 0%" ng-class="{active: data==\'100% 0%\'}"></span>' + '<span class="rec rec-lc" data-origin="0% 50%" ng-class="{active: data==\'0% 50%\'}"></span>' + '<span class="rec rec-cc" data-origin="50% 50%" ng-class="{active: data==\'50% 50%\'}"></span>' + '<span class="rec rec-rc" data-origin="100% 50%" ng-class="{active: data==\'100% 50%\'}"></span>' + '<span class="rec rec-lb" data-origin="0% 100%" ng-class="{active: data==\'0% 100%\'}"></span>' + '<span class="rec rec-cb" data-origin="50% 100%" ng-class="{active: data==\'50% 100%\'}"></span>' + '<span class="rec rec-rb" data-origin="100% 100%" ng-class="{active: data==\'100% 100%\'}"></span>' + '</div>',
            link: function (scope, elem, attrs) {
                elem.children().bind('click', function () {
                    var origin = angular.element(this).data('origin');
                    scope.$apply(function () {
                        scope.data = origin;
                    });
                });
            }

        }
    });

    pcapp.directive('ngSwitcherSmall', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                color: '@'
            },
            template: '<span class="pc-switcher-small"><div class="switcher-label-small"><span ng-show="data">%</span><span ng-show="!data">px</span></div><div class="switcher-small {{color}}" ng-class="{on: data}"><span class="switcher-thumb"></span></div> </span>',
            link: function (scope, elem, attrs) {
                elem.bind('click', function () {
                    scope.$apply(function () {
                        scope.data = !scope.data;
                    });
                });
            }

        }
    });

    pcapp.directive('ngSpinner', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                frame: '=',
                prop: '@',
                change: '&'
            },
            template: '<span class="pc-spinner"><input type="number" ng-model="data.value" ng-disabled="disabled" ng-change="change({prop:prop})" /></span>',
            link: function (scope, elem, attrs) {
                scope.disabled = false;
            }

        }
    });

    pcapp.directive('ngSlider', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                label: '@'
            },
            template: '<div class="pc-slider">' +
                '<span  class="label" ng-bind="::label"></span> ' +
                '<input type="number" min="0" max="1" step="0.1" ng-model="data" /> ' +
                '<span class="slider-value"> 100%</span> ' +
                '<div class="slider"></div>' +
                '</div>',
            link: function (scope, elem, attrs) {
                setTimeout(function () {
                    var slider = null,
                        value = (scope.data || 1) * 100,
                        sliderValue = elem.find('.slider-value');

                    sliderValue.html(value + '%');

                    scope.$watch('data', function () {
                        if (scope.data) {
                            slider.slider("option", "value", scope.data * 100);
                            sliderValue.html(scope.data * 100 + '%');
                        }
                    });

                    slider = elem.find('.slider').slider({
                        range: "min",
                        value: (scope.data || 1) * 100,
                        min: 0,
                        max: 100,
                        slide: function (event, ui) {
                            sliderValue.html(ui.value + '%');
                        },
                        stop: function (event, ui) {
                            scope.$apply(function () {
                                scope.data = ui.value / 100;
                            });
                        }
                    });


                }, 25);

            }

        }
    });

    pcapp.directive('ngRotation', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                label: '@'
            },
            template: '<div class="rotation"> <input type="text" ng-model="data.full" class="rfull input-size-2"> +  <input type="text"  ng-model="data.rad" class="rrad input-size-3"><sup>o</sup> </div>',
            link: function (scope, elem, attrs) {

                elem.find('.rfull').on('keyup', function () {
                    var full = parseInt(elem.find('.rfull').val()) || 0;
                    var rad = parseInt(elem.find('.rrad').val()) || 0;

                    scope.$apply(function () {
                        scope.data.value = full * 360 + rad;
                    });
                });
                elem.find('.rrad').on('keyup', function () {
                    var full = parseInt(elem.find('.rfull').val()) || 0;
                    var rad = parseInt(elem.find('.rrad').val()) || 0;

                    scope.$apply(function () {
                        scope.data.value = full * 360 + rad;
                    });
                });
            }

        }
    });

    pcapp.directive('ngScale', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                label: '@'
            },
            template: '<div class="scale"> <input type="text"  ng-model="data.value" class=""></div>',
            link: function (scope, elem, attrs) {


            }

        }
    });

    pcapp.directive('ngBorderRadius', function () {
        return {
            replace: true,
            scope: {
                data: '=',
                color: '@'
            },
            template: '<div class="pc-border-radius">' +
                '<div><span class="top-left prev"></span> ' +
                '<input type="number" ng-model="data.borderTopLeftRadius.value" > <div class="switcher-label-small"><span>px</span></div></div>' +
                '<div class="right"><input type="number" ng-disabled="isLock" ng-model="data.borderTopRightRadius.value" > <div class="switcher-label-small"><span>px</span></div>' +
                '<span class="top-right prev"></span></div> ' +
                '<div class="pc-border-lock"><a href="" class="lock" ng-class="{active:isLock == true}"></a></div>' +
                '<div><span class="bottom-left prev"></span> ' +
                '<input type="number" ng-disabled="isLock" ng-model="data.borderBottomLeftRadius.value" > <div class="switcher-label-small"><span>px</span></div></div>' +
                '<div  class="right"><input type="number" ng-disabled="isLock" ng-model="data.borderBottomRightRadius.value" > <div class="switcher-label-small"><span>px</span></div>' +
                '<span class="bottom-right prev"></span></div> ' +
                '</div>',
            link: function (scope, elem, attrs) {
                scope.isLock = false;
                elem.find('.lock').on('click', function () {
                    scope.isLock = !scope.isLock;

                    if (scope.isLock && scope.data.borderTopLeftRadius) {
                        var value = {
                            value: scope.data.borderTopLeftRadius.value
                        };
                        scope.$apply(function () {
                            scope.data.borderTopRightRadius = value;
                            scope.data.borderBottomLeftRadius = value;
                            scope.data.borderBottomRightRadius = value;
                        });
                    } else {
                        if (scope.data.borderTopLeftRadius) {
                            var value = {
                                value: scope.data.borderTopLeftRadius.value
                            };
                            scope.data.borderTopRightRadius = angular.copy(value);
                            scope.data.borderBottomLeftRadius = angular.copy(value);
                            scope.data.borderBottomRightRadius = angular.copy(value);
                        }
                    }

                });

                scope.$watch('data', function () {
                    if (scope.isLock && scope.data.borderTopLeftRadius) {
                        var value = {
                            value: scope.data.borderTopLeftRadius.value
                        };
                        scope.data.borderTopRightRadius = value;
                        scope.data.borderBottomLeftRadius = value;
                        scope.data.borderBottomRightRadius = value;
                    }
                }, true);
            }

        }
    });

    pcapp.directive('ngMediaFile', function () {
        return {
            replace: true,
            templateUrl: path + 'media-file.html',
            link: function (scope, elem, attrs) {
                elem.find('.file').on('click', function () {
                    wp.media.editor.send.attachment = function (props, attachment) {
                        scope.$apply(function () {
                            layer.image = attachment;
                        });
                    }
                    wp.media.editor.open();
                });
            }
        }
    });

    pcapp.directive('ngModalWindow', ['$rootScope', function ($rootScope) {
        return {
            transclude: true,
            template: '<div id="pc-modal-window-wrapper" ng-transclude></div>',
            link: function (scope, elem, attrs) {
                var layer = {
                    id: new Date().getTime(),
                    title: elem.find('.name').val() || scope.l10n.layer + ' ' + scope.addLayerType,
                    type: scope.addLayerType,
                    animation: [],
                    display: true,
                    displayLG: true,
                    displayMD: true,
                    displaySM: true,
                    displayXS: true,
                    relative2screen: false,
                    relative2screenDisableOptimization: false,
                    activity: true,
                    align: '0% 0%',
                    transformOrigin: '50% 50%',
                    backgroundSize: '100% 100%',
                    backgroundPosition: 'center center',
                    image: {
                        scale: true,
                    },
                    audio: {},
                    multiimages: [],
                    nodes: [],
                    ppf: 50,
                    loopnum: 1
                };
                var key = {};

                scope.isFileValidate = true;
                scope.fileChanged = false;

                scope.fileValidate = function (mime, type) {
                    var e;
                    switch (type) {
                        case 'image':
                            e = /image/g;
                            break;
                        case 'audio':
                            e = /audio\/(mpeg|ogg)/g;
                            break;
                        case 'zip':
                            e = /zip/g;
                            break;
                    }

                    return e.test(mime);
                }

                elem.find('.close').on('click', function () {
                    elem.remove();
                });
                elem.find('.file').on('click', function () {
                    elem.find('.file-list').html('');
                    layer.multiimages = [];


                    wp.media.editor.send.attachment = function (props, attachment) {

                        scope.$apply(function () {
                            if (scope.addLayerType == 'image') {
                                elem.find('.attachment-file').text(scope.l10n.editLayer.sections.file + ' ' + attachment.filename + '(' + attachment.width + 'x' + attachment.height + ')');
                                if (scope.fileValidate(attachment.mime, 'image')) {
                                    scope.isFileValidate = true;

                                    layer.image = {
                                        id: attachment.id,
                                        url: attachment.url,
                                        width: attachment.width,
                                        height: attachment.height,
                                        mime: attachment.mime,
                                        filesizeHumanReadable: attachment.filesizeHumanReadable,
                                        filename: attachment.filename,
                                    };

                                    scope.fileChanged = true;


                                    key = {
                                        frame: parseInt(scope.data.currentSection.offsetTop) || 0,
                                        left: {
                                            value: 0
                                        },
                                        top: {
                                            value: 0
                                        },
                                        width: {
                                            value: attachment.width
                                        },
                                        height: {
                                            value: attachment.height
                                        }
                                    }


                                    if (layer.animation[0] && layer.animation[0].frame == 0) {
                                        _.extend(layer.animation[0], key);
                                    } else {
                                        layer.animation.push(key);
                                    }
                                } else {
                                    scope.isFileValidate = false;
                                }

                            } else if (scope.addLayerType == 'multi') {

                                if (scope.fileValidate(attachment.mime, 'image')) {
                                    scope.isFileValidate = true;
                                    layer.multiimages.push({
                                        id: attachment.id,
                                        url: attachment.url,
                                        width: attachment.width,
                                        height: attachment.height,
                                        mime: attachment.mime,
                                        filesizeHumanReadable: attachment.filesizeHumanReadable,
                                        filename: attachment.filename,
                                    });
                                    scope.fileChanged = true;

                                    $('<li/>', {
                                        html: attachment.filename
                                    }).appendTo(elem.find('.file-list'));
                                    elem.find('.file-info').text(scope.l10n.editLayer.sections.fileUploadSuccess + ' ' + elem.find('.file-list li').length);
                                    elem.find('.file-list-collapse').text(scope.l10n.editLayer.sections.showFiles);

                                    key = {
                                        frame: parseInt(scope.data.currentSection.offsetTop) || 0,
                                        left: {
                                            value: 0
                                        },
                                        top: {
                                            value: 0
                                        },
                                        width: {
                                            value: attachment.width
                                        },
                                        height: {
                                            value: attachment.height
                                        }
                                    }

                                    if (layer.animation.length == 0) {
                                        layer.animation.push(key);
                                    }
                                } else {
                                    scope.isFileValidate = false;
                                }

                            } else if (scope.addLayerType == 'audio') {

                                elem.find('.attachment-file').text(scope.l10n.editLayer.sections.file + ' ' + attachment.filename);
                                if (scope.fileValidate(attachment.mime, 'audio')) {
                                    scope.isFileValidate = true;
                                    layer.audio = {
                                        id: attachment.id,
                                        url: attachment.url,
                                        mime: attachment.mime,
                                        filesizeHumanReadable: attachment.filesizeHumanReadable,
                                        filename: attachment.filename,
                                    };
                                    scope.fileChanged = true;
                                } else {
                                    scope.isFileValidate = false;
                                }
                            }
                        });

                    }
                    wp.media.editor.open();
                });

                elem.find('.file-list-collapse').on('click', function () {
                    elem.find('.file-list').toggle(0, function () {
                        if ($(this).is(':visible')) {
                            elem.find('.file-list-collapse').text(scope.l10n.editLayer.sections.hideFiles);
                        } else {
                            elem.find('.file-list-collapse').text(scope.l10n.editLayer.sections.showFiles);
                        }
                    });
                });


                elem.find('.add-layer').on('click', function () {
                    $rootScope.$broadcast('add-layer');

                    layer.title = elem.find('.name').val() || scope.l10n.layer + ' ' + scope.addLayerType;
                    layer.code = elem.find('#code-layer').val();

                    if (scope.addLayerType == 'text' || scope.addLayerType == 'text-block') {
                        layer.text = tinyMCE.activeEditor.getContent() || '';
                        var key = {
                            frame: parseInt(scope.data.currentSection.offsetTop) || 0,
                            left: {
                                value: 0
                            },
                            top: {
                                value: 0
                            }
                        }

                        if (layer.animation[0] && layer.animation[0].frame == 0) {
                            _.extend(layer.animation[0], key);
                        } else {
                            layer.animation.push(key);
                        }
                    } else if (scope.addLayerType == 'nullobject') {

                        layer.overflow = false;
                        layer.color = '#dd3333';

                        var key = {
                            frame: parseInt(scope.data.currentSection.offsetTop) || 0,
                            left: {
                                value: 0
                            },
                            top: {
                                value: 0
                            }
                        }

                        layer.animation.push(key);
                    }

                    scope.showEmptySectionInfo = false;
                    elem.remove();
                    scope.$apply(function () {
                        scope.data.currentSection.nodes.push(layer);
                    });

                });

                elem.find('.update-layer').on('click', function () {
                    $rootScope.$broadcast('update-layer');
                    elem.remove();
                    scope.$apply();
                });

                scope.updateFile = function (currnetLayer) {
                    if (currnetLayer.type == 'multi' && layer.multiimages.length > 0) {
                        if (scope.fileChanged) {
                            currnetLayer.multiimages = layer.multiimages;
                        }

                        if (currnetLayer.animation[0] /*&& currnetLayer.animation[0].frame == 0*/ ) {
                            //_.extend(currnetLayer.animation[0], layer.animation[0]); 
                        } else {
                            if (key) {
                                currnetLayer.animation.push(key);
                            }
                        }

                    } else if (currnetLayer.type == 'image' && layer.image) {

                        if (scope.fileChanged) {
                            currnetLayer.image = layer.image;
                        }

                        if (currnetLayer.animation[0] /*&& currnetLayer.animation[0].frame == 0*/ ) {} else {
                            if (key) {
                                currnetLayer.animation.push(key);
                            }
                        }

                    } else if (currnetLayer.type == 'audio' && layer.audio) {
                        if (scope.fileChanged) {
                            currnetLayer.audio = layer.audio;
                        }

                    }
                    elem.remove();
                }
                elem.find('.update-file-list').on('click', function () {
                    elem.remove();
                    scope.$apply(function () {

                    });
                });


                $(document).keyup(function (e) {
                    if (e.keyCode == 27) {
                        elem.remove();
                    } // esc
                });


            }
        }
    }]);

    pcapp.directive('ngModalWindowTooltip', function () {
        return {
            transclude: true,
            template: '<div id="pc-modal-window-wrapper" ng-transclude></div>',
            link: function (scope, elem, attrs) {
                elem.find('.close').on('click', function () {
                    elem.remove();
                });

                $(document).mouseup(function (e) {
                    var container = $('.pc-modal-window');

                    if (!container.is(e.target) && container.has(e.target).length === 0) {
                        elem.remove();
                    }
                });

                $(document).keyup(function (e) {
                    if (e.keyCode == 27) {
                        elem.remove();
                    } // esc
                });

            }
        }
    });

    pcapp.directive('ngColorPicker', ['$timeout', function ($timeout) {
        return {
            scope: {
                color: '=',
                label: '@'
            },
            link: function (scope, elem, attrs) {
                var settings = {},
                    value = false,
                    alpha_container = null,
                    alpha_slider = null,
                    alpha_value = 100,
                    _alpha = '<div class="pc-slider alpha-container">' +
                    '<span class="label" >' + _pcl10n.editLayer.sections.opacity + '</span> ' +
                    '<span class="slider-value"> 100%</span> ' +
                    '<div class="slider-alpha"></div>' +
                    '</div>';


                scope.$watch('color', function () {
                    if (value === false && scope.color) {
                        value = scope.color.replace(/\s+/g, '');

                        if (value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)) {
                            alpha_value = parseFloat(value.match(/rgba\(\d+\,\d+\,\d+\,([^\)]+)\)/)[1]) * 100;
                            alpha_slider.slider("value", alpha_value);
                            alpha_container.find('.slider-value').text(alpha_value + ' %');
                        }
                        $timeout(function () {
                            elem.wpColorPicker('color', scope.color);
                        }, 100);
                    }
                });

                $timeout(function () {
                    elem.wpColorPicker('color', scope.color);
                }, 100);


                settings.change = function (event, ui) {
                    scope.$apply(function () {
                        scope.color = ui.color.toString();
                    });
                }

                var setTransparency = function (ui) {
                    var $transparency = elem.parents('.wp-picker-container:first').find('.transparency');
                    $transparency.css('backgroundColor', ui.color.toString('no-alpha'));
                }

                settings.clear = function (event, ui) {
                    scope.color = '';
                    alpha_slider.slider("value", 100);
                }


                elem.wpColorPicker(settings);

                alpha_container = $(_alpha).appendTo(elem.parents('.wp-picker-container'));
                alpha_slider = alpha_container.find('.slider-alpha');

                alpha_slider.slider({
                    range: "min",
                    min: 0,
                    max: 100,
                    value: alpha_value,
                    slide: function (event, ui) {

                        var alpha_value = parseFloat(ui.value),
                            iris = elem.data('a8cIris'),
                            color_picker = elem.data('wpWpColorPicker');
                        iris._color._alpha = alpha_value / 100.0;
                        elem.val(iris._color.toString());
                        color_picker.toggler.css({
                            backgroundColor: elem.val()
                        });
                        // fix relationship between alpha slider and the 'side slider not updating.
                        var get_value = elem.val();
                        $(elem).wpColorPicker('color', get_value);

                        alpha_container.find('.slider-value').text(ui.value + ' %');
                        setTransparency(color_picker);

                    },
                    stop: function (event, ui) {


                    },
                    create: function (event, ui) {
                        var v = $(this).slider('value');
                        alpha_container.find('.slider-value').text(v + ' %');
                    }
                }); // slider                


                Color.prototype.toString = function (remove_alpha) {
                    if (remove_alpha == 'no-alpha') {
                        return this.toCSS('rgba', '1').replace(/\s+/g, '');
                    }
                    if (this._alpha < 1) {
                        return this.toCSS('rgba', this._alpha).replace(/\s+/g, '');
                    }
                    var hex = parseInt(this._color, 10).toString(16);
                    if (this.error) return '';
                    if (hex.length < 6) {
                        for (var i = 6 - hex.length - 1; i >= 0; i--) {
                            hex = '0' + hex;
                        }
                    }
                    return '#' + hex;
                };

            }
        }
    }]);

    pcapp.directive('ngFlashMsg', ['$interval', function ($interval) {
        return {
            transclude: true,
            template: '<p><span ng-transclude></span> <span class="timer">({{time}})</span></p>',
            link: function (scope, elem, attrs) {
                var timer;
                scope.time = 3;
                elem.hide();

                scope.$watch('data.isCopyAnimation', function () {
                    if (scope.data.isCopyAnimation) {
                        scope.time = 3;
                        elem.show();

                        timer = $interval(function () {
                            scope.time--;
                            if (scope.time < 1) {
                                elem.hide();
                                $interval.cancel(timer);
                            }
                        }, 1000);

                    }
                });


            }
        }
    }]);

    pcapp.directive('ngPreLoader', function () {
        return {
            replace: true,
            template: '<div  id="pc-preloader" ng-class="{active:showPreloader}"><div class="body-preloader"><div class="text-preloader"><h4 ng-bind="::textPreloader.title"></h4><div class="loader"></div><p ng-bind="::textPreloader.info"></p></div></div></div>',
        }
    });
    pcapp.directive('ngStartPage', function () {
        return {
            replace: true,
            templateUrl: pathTemplates + "startpage.html"
        }
    });


    pcapp.directive('ngTimeline', ['$compile', '$window', '$timeout', function ($compile, $window, $timeout) {
        return {
            replace: 'true',
            templateUrl: pathTemplates + "timeline.html",
            controller: function ($scope, $attrs) {
                $scope.allKeysName = [];
                $scope.allKeys = {};

                $scope.showAddKey = function (keyName) {
                    var keyNames = ['color', 'backgroundColor', 'borderStyle', 'borderColor', 'letterSpacing', 'fontSize', 'lineHeight'];
                    return (keyNames.indexOf(keyName) == -1);
                }


                $scope.getAllKeysName = function () {

                    var arr = [];
                    var allowKey = ['top', 'left', 'opacity', 'width', 'height', 'rotationX', 'rotationY', 'rotationZ', 'x', 'y', 'z', 'scaleX', 'scaleY', 'scaleZ', 'skewX', 'skewY', 'backgroundColor', 'borderStyle', 'borderWidth', 'borderColor', 'borderTopLeftRadius', 'borderTopRightRadius', 'borderBottomLeftRadius', 'borderBottomRightRadius', 'outlineStyle', 'outlineWidth', 'outlineColor', 'outlineTopLeftRadius', 'outlineTopRightRadius', 'outlineBottomLeftRadius', 'outlineBottomRightRadius', 'audio', 'volume', 'letterSpacing', 'fontSize', 'lineHeight', 'padding', 'paddingTop', 'paddingRight', 'paddingBottom', 'paddingLeft', 'color'];
                    var animation = $scope.data.currentLayer.animation;

                    function sortFunc(a, b) {
                        var porityArray = ['left', 'top', 'width', 'height', 'fontSize', 'letterSpacing', 'lineHeight', 'rotationX', 'rotationY', 'rotationZ', 'x', 'y', 'z', 'scaleX', 'scaleY', 'scaleZ', 'skewX', 'skewY', 'opacity', 'backgroundColor', 'borderStyle', 'borderWidth', 'borderColor', 'borderTopLeftRadius', 'borderTopRightRadius', 'borderBottomLeftRadius', 'borderBottomRightRadius'];
                        return porityArray.indexOf(b) - porityArray.indexOf(a);
                    }

                    if (angular.isArray(animation)) {
                        for (var i = 0; i < animation.length; i++) {
                            var keys = _.keys(animation[i]);
                            arr = arr.concat(_.filter(keys, function (key) {
                                return _.indexOf(allowKey, key) > -1;
                            })).unique();
                        }

                    }

                    return arr.sort(sortFunc).reverse();
                }

                $scope.getKeysByName = function (animation, keyName) {

                    if (angular.isArray(animation)) {
                        return _.filter(animation, function (el) {
                            return typeof el[keyName] != 'undefined';
                        });
                    }
                    return [];
                }


            },
            link: function (scope, elem, attrs) {


                scope.scaleRatio = 1;
                scope.previewResolution = '100%';
                scope.isEditKeyOpen = 0;
                scope.heightManual = false;


                var count = 0;

                console.time('ngTimeline');


                scope.$watch('data.currentLayer.animation', function () {
                    scope.allKeysName = scope.getAllKeysName();
                    _.each(scope.allKeysName, function (keyName) {
                        scope.allKeys[keyName] = scope.getKeysByName(scope.data.currentLayer.animation, keyName);
                    });
                    if (!scope.heightManual) {
                        elem.css(scope.height());
                        setHeight();
                    }
                }, true);


                scope.removeTimeline = function () {
                    $(window).off('resize', setHeight);
                }

                scope.timlinesContent = function () {
                    if (scope.view == 'layer') {
                        var width = elem.find('.timelines-rightcol').width(),
                            widthCalc = ((scope.windowParms.documentHeight - scope.windowParms.windowHeight) * scope.scaleRatio + scope.windowParms.windowHeight * scope.scaleRatio + 100);
                        if (width < widthCalc) {
                            width = widthCalc;
                        }
                        return {
                            width: width + 'px'
                        }
                    }
                }

                elem.find('.timlines-content').css(scope.timlinesContent());

                scope.measureBar = function () {
                    return {
                        width: ((scope.windowParms.documentHeight + 130) * scope.scaleRatio) + 'px'
                    }
                }
                scope.measure = function () {
                    return {
                        width: (100 * scope.scaleRatio) + 'px'
                    }
                }
                elem.find('.measure > .section').css(scope.measure());

                scope.currentPosLine = function () {
                    return {
                        left: (scope.scrollPos * scope.scaleRatio + 10) + 'px'
                    }
                }
                elem.find('.pc-right-panel').css(scope.currentPosLine());

                scope.$watch('scrollPos', function () {
                    elem.find('.current-pos-line').css(scope.currentPosLine());
                    elem.find('.input-pos').val(scope.scrollPos);
                });


                scope.currentPosLineWindow = function () {
                    return {
                        width: (scope.windowParms.windowHeight * scope.scaleRatio) + 'px'
                    }
                }


                $(window).on('resize', _.debounce(function () {
                    elem.find('.current-pos-line .window').css(scope.currentPosLineWindow());
                }, 200));


                scope.height = function () {

                    scope.allKeysName = scope.getAllKeysName();


                    var height = scope.allKeysName.length * 30 + 71;

                    if (scope.data.currentLayer.type == 'multi' || scope.data.currentLayer.type == 'audio') {
                        height += 30;
                    }

                    return {
                        height: height
                    }
                }


                elem.css(scope.height());
                $timeout(function () {
                    elem.find('.current-pos-line .window').css(scope.currentPosLineWindow());
                }, 500);


                scope.$watch('scaleRatio', function () {
                    elem.find('.timlines-content').css(scope.timlinesContent());
                    elem.find('.measure > .section').css(scope.measure());
                    elem.find('.current-pos-line').css(scope.currentPosLine());
                    elem.find('.current-pos-line .window').css(scope.currentPosLineWindow());
                });


                if (elem.attr('id') == 'pc-timeline') {
                    elem.on('mousedown', function (e) {
                        var target = $(e.target);

                        if (!target.is('input') && !target.is('select') && !target.is('textarea'))
                            e.preventDefault();
                    });
                } else
                    elem.disableSelection();

                var setHeight = function () {
                    var size = $(window).height() - elem.height();
                    if (elem.height() > 0) {
                        $('#customize-preview').height(size - 34);
                    }
                }

                setHeight();


                $(window).on('resize', setHeight);

                elem.resizable({
                    handles: "n",
                    minHeight: 65,
                    maxHeight: 250,
                    resize: function (event, ui) {
                        var size = $(window).height() - ui.size.height;
                        $('#customize-preview').height(size - 25);
                        elem.css({
                            top: ''
                        });
                    },
                    start: function (event, ui) {
                        elem.resizable("option", "maxHeight", elem.find('.timelines-leftcol .animation').height() + 72);
                        $('#customize-preview').append('<div id="maskiframe"></div>');

                    },
                    stop: function (event, ui) {
                        $('#customize-preview #maskiframe').remove();
                        elem.find('.current-pos-line .window').css(scope.currentPosLineWindow());
                        scope.heightManual = true;
                    }
                });
                elem.on('DOMMouseScroll mousewheel', function (event) {
                    var scroll = elem.find('.timlines-scrollbar .scroll'),
                        bar = elem.find('.timlines-scrollbar .bar'),
                        left = parseInt(scroll.css('left')) - event.originalEvent.wheelDelta;

                    if (left < 0) {
                        left = 0;
                    }
                    if (left > bar.width() - scroll.width()) {
                        left = bar.width() - scroll.width();
                    }

                    scroll.css({
                        left: left
                    }).draggable('option', 'drag').call(scroll);

                    return false;
                });

                elem.find('.current-pos-line').draggable({
                    axis: "x",
                    containment: "parent",
                    drag: function () {
                        var frame = parseInt((parseInt(elem.find('.current-pos-line').css('left')) - 10) / scope.scaleRatio),
                            maxFrame = (scope.windowParms.documentHeight - scope.windowParms.windowHeight) * scope.scaleRatio;
                        frame = frame > 0 ? frame : 0;
                        if (frame > maxFrame) {
                            frame = maxFrame;
                        }

                        elem.find('.input-pos').val(frame);

                        elem.find('.content .current-pos-line').css({
                            left: parseInt(elem.find('.header .current-pos-line').css('left'))
                        });
                    },
                    stop: function () {
                        var frame = parseInt((parseInt(elem.find('.current-pos-line').css('left')) - 10) / scope.scaleRatio),
                            maxFrame = (scope.windowParms.documentHeight - scope.windowParms.windowHeight) * scope.scaleRatio;
                        frame = frame > 0 ? frame : 0;
                        if (frame == 0) {
                            elem.find('.current-pos-line').css({
                                left: 10
                            });
                        }
                        if (frame > maxFrame) {
                            frame = maxFrame;
                            elem.find('.current-pos-line').css({
                                left: maxFrame
                            });
                        }
                        $('#customize-preview iframe').contents().scrollTop(frame);


                    }
                });
                elem.find('.timlines-scrollbar .navi.left').on('click', function () {
                    var scroll = elem.find('.timlines-scrollbar .scroll'),
                        bar = elem.find('.timlines-scrollbar .bar'),
                        left = parseInt(scroll.css('left')) - 40;

                    if (left < 0) {
                        left = 0;
                    }
                    if (left > bar.width() - scroll.width()) {
                        left = bar.width() - scroll.width();
                    }

                    scroll.css({
                        left: left
                    }).draggable('option', 'drag').call(scroll);
                });
                elem.find('.timlines-scrollbar .navi.right').on('click', function () {
                    var scroll = elem.find('.timlines-scrollbar .scroll'),
                        bar = elem.find('.timlines-scrollbar .bar'),
                        left = parseInt(scroll.css('left')) + 40;

                    if (left < 0) {
                        left = 0;
                    }
                    if (left > bar.width() - scroll.width()) {
                        left = bar.width() - scroll.width();
                    }

                    scroll.css({
                        left: left
                    }).draggable('option', 'drag').call(scroll);
                });

                var setScrollToFirstKey = function () {
                    if (scope.data.currentLayer.animation.length > 0) {
                        var scroll = elem.find('.timlines-scrollbar .scroll'),
                            bar = elem.find('.timlines-scrollbar .bar'),
                            firstFrame = scope.data.currentLayer.animation[0].frame,
                            left = (firstFrame - 100) * 100 / scope.windowParms.documentHeight;

                        scroll.css({
                            left: left + '%'
                        }).draggable('option', 'drag').call(scroll);
                    }
                }

                $timeout(function () {

                    elem.find('.timlines-scrollbar .scroll').width(elem.find('.timlines-scrollbar .bar').width() * (elem.find('.timelines-rightcol').width() / elem.find('.timlines-content').width()));

                    setScrollToFirstKey();

                }, 100);


                elem.find('.timlines-scrollbar .scroll').draggable({
                    axis: "x",
                    containment: "parent",
                    drag: function () {
                        var left = elem.find('.timlines-scrollbar .scroll').position().left,
                            width = elem.find('.timlines-scrollbar .bar').width() - elem.find('.timlines-scrollbar .scroll').width(),
                            contentWidth = elem.find('.timlines-content').width(),
                            windowWidth = elem.find('.timelines-rightcol').width(),
                            offset = (contentWidth - windowWidth) * (left / width);

                        if (-offset > 0) {
                            offset = 0;
                        }

                        elem.find('.timlines-content').css({
                            left: -offset
                        });


                    },
                    stop: function () {

                    }
                });


                //scrollbar dla ratio
                elem.find('.timlines-scale-scrollbar .scroll').draggable({
                    axis: "x",
                    containment: "parent",
                    drag: function () {
                        var left = elem.find('.timlines-scale-scrollbar .scroll').position().left,
                            width = elem.find('.timlines-scale-scrollbar .bar').width() - elem.find('.timlines-scale-scrollbar .scroll').width(),
                            ratio = Math.round(left * 4 / width * 10) / 10,
                            contentWidth = elem.find('.timlines-content').width(),
                            windowWidth = elem.find('.timelines-rightcol').width();


                        if (((scope.windowParms.documentHeight - scope.windowParms.windowHeight) * ratio) > windowWidth) {} else {
                            ratio = windowWidth / (scope.windowParms.documentHeight - scope.windowParms.windowHeight);
                        }
                        scope.$apply(function () {
                            scope.scaleRatio = ratio;
                        });

                        elem.find('.timlines-scrollbar .scroll')
                            .width(elem.find('.timlines-scrollbar .bar').width() * (windowWidth / contentWidth))
                            .css({
                                left: 0
                            });


                    },
                    stop: function () {


                    }
                });


                elem.find('.input-pos').bind('change', function () {
                    var frame = $(this).val(),
                        maxFrame = scope.windowParms.documentHeight - scope.windowParms.windowHeight;

                    frame = frame < maxFrame ? frame : maxFrame;

                    $('#customize-preview iframe').contents().scrollTop(frame);
                });

                scope.delAllKeysByNameConfirm = function (name, event) {
                    var confirmWindow = $(event.currentTarget).next();
                    confirmWindow.show();

                    confirmWindow.find('.cancel').on('click', function () {
                        confirmWindow.hide();
                    });
                }
                scope.delAllKeysByName = function (name) {
                    _.each(scope.data.currentLayer.animation, function (key, index) {
                        delete key[name];
                    });
                }

                scope.addKey = function (name) {
                    var framelist = [];

                    _.each(scope.data.currentLayer.animation, function (key, index) {
                        if (key[name]) {
                            framelist.push(key.frame);
                        }
                    });

                    framelist.sort(function (a, b) {
                        return a - b;
                    });

                    var newValue = null;

                    if (scope.scrollPos < framelist[0]) {

                        var keyStart = _.find(scope.data.currentLayer.animation, function (el) {
                            return el.frame == framelist[0];
                        });

                        newValue = keyStart[name].value;

                    } else if (scope.scrollPos > framelist[framelist.length - 1]) {

                        var keyEnd = _.find(scope.data.currentLayer.animation, function (el) {
                            return el.frame == framelist[framelist.length - 1];
                        });

                        newValue = keyEnd[name].value;

                    } else {
                        var startFrame = 0,
                            endFrame = 0;
                        _.each(framelist, function (frame) {
                            if (scope.scrollPos > frame) {
                                startFrame = frame;
                            }
                            if (scope.scrollPos < frame && endFrame == 0) {
                                endFrame = frame;
                            }
                        });

                        var keyStart = _.find(scope.data.currentLayer.animation, function (el) {
                            return el.frame == startFrame;
                        });

                        var keyEnd = _.find(scope.data.currentLayer.animation, function (el) {
                            return el.frame == endFrame;
                        });


                        newValue = parseInt(keyStart[name].value + ((keyEnd[name].value - keyStart[name].value) / (endFrame - startFrame)) * (scope.scrollPos - startFrame));

                    }

                    var key = _.find(scope.data.currentLayer.animation, function (el) {
                        return el.frame == scope.scrollPos;
                    });


                    if (key) {

                        keyStart = keyStart || keyEnd;

                        key[name] = {
                            value: newValue,
                            precent: keyStart[name].precent
                        };

                    } else {

                        keyStart = keyStart || keyEnd;

                        var newKey = {
                            frame: scope.scrollPos,
                        };
                        newKey[name] = {
                            value: newValue,
                            precent: keyStart[name].precent
                        };

                        if (Object.keys(newKey).length > 1) {
                            scope.data.currentLayer.animation.push(newKey);
                        }



                        $timeout(function () {
                            $('#customize-preview iframe').contents().scrollTop(newKey.frame - 1);
                            $timeout(function () {
                                $('#customize-preview iframe').contents().scrollTop(newKey.frame);
                            }, 300);
                        }, 300);
                    }

                }


                scope.setScaleRatio = function (ratio) {
                    scope.scaleRatio = ratio;
                }

                scope.keyPress = function (event) {

                }
                scope.changePreviewResolution = function () {
                    $('#customize-preview iframe').width(scope.previewResolution);
                }

                console.timeEnd('ngTimeline');
            }

        };
    }]);

    pcapp.directive('ngMeasureBar', function () {
        return {
            replace: true,
            template: '<div class="measure-bar">' +
                '<div class="measure">' +
                '<div   ng-repeat="i in measureSection" class="section">' +
                '<div class="label" ng-class="{\'hide\':scaleRatio<1 && $index%2 != 0}">{{100*$index}}px</div>' +
                '<span  class="m10" ng-repeat="j in measureRange">' +
                '<!-- <span class="m1" ng-class="{hide:scaleRatio<1}" ng-repeat="k in measureRange"></span> -->' +
                '</span>' +
                '</div>' +
                '</div>' +
                '</div>',
            controller: function ($scope) {
                $scope.measureRange = $scope.range(0, 10);
                $scope.measureSection = $scope.range(0, $scope.windowParms.documentHeight / 100);
            }
        }
    });

    pcapp.directive('ngStaticKey', ['$document', function ($document) {
        return {
            replace: true,
            scope: {
                layer: '=',
                name: '@',
                ratio: '@',
                animation: '=',
                isopen: '='
            },
            template: '<div class="key-static" title="{{key[name].value}}"><div class="edit-key" ng-show="isEdit"  ><input ng-model="newValue" type="number" value="{{layer.start}}" /><a class="ok">OK</a><a class="del"></a></div> </div>',
            link: function (scope, elem, attrs, editLayer) {
                scope.isEdit = false;
                scope.newValue = null;

                scope.keyPos = function () {

                    return {
                        left: parseInt(scope.layer.start * scope.ratio) + 'px',
                        width: (scope.layer.stop) ? (scope.layer.stop * scope.ratio - scope.layer.start * scope.ratio + 11) + 'px' : '100%'
                    }
                }

                scope.$watch('layer.start', function (value, oldvalue) {
                    if (value != oldvalue) {
                        elem.css(scope.keyPos());
                    }
                });
                scope.$watch('layer.stop', function (value, oldvalue) {
                    if (value != oldvalue) {
                        elem.css(scope.keyPos());
                    }
                });
                scope.$watch('key.frame', function (value, oldvalue) {
                    //if(value != oldvalue){
                    elem.css(scope.keyPos());
                    //}
                });
                scope.$watch('ratio', function (value, oldvalue) {
                    if (value != oldvalue) {
                        elem.css(scope.keyPos());
                    }
                });


                elem.find('.del').bind('click', function (e) {
                    e.stopPropagation();
                    scope.layer.start = null;
                    scope.layer.stop = null;

                    scope.$apply(function () {
                        scope.isEdit = false;
                    });
                });

                elem.find('.ok').bind('click', function (e) {
                    e.stopPropagation();

                    scope.layer.start = scope.newValue;

                    scope.$apply(function () {
                        scope.isEdit = false;
                    });
                });
                elem.find('input').bind('click', function (e) {
                    e.stopPropagation();
                });

                elem.find('input').keyup(function (e) {
                    if (e.keyCode == 13) {
                        scope.layer.start = scope.newValue;

                        scope.$apply(function () {
                            scope.isEdit = false;
                        });
                    }
                });

                $(document).keyup(function (e) {
                    if (e.keyCode == 27) {
                        scope.$apply(function () {
                            scope.isEdit = false;
                        });
                    }
                });

                $document.bind('click', function () {
                    scope.$apply(function () {
                        scope.isEdit = false;
                    });
                });


            }
        }
    }]);

    pcapp.directive('ngSectionPage', ['$document', function () {
        return {
            scope: {
                section: '=',
                ratio: '@'
            },
            controller: function ($scope) {
                $scope.pageBarSection = function () {

                    return {
                        width: ($scope.section.height * $scope.ratio) + 'px',
                        left: ($scope.section.offsetTop * $scope.ratio) + 'px'
                    }
                }
            },
            link: function (scope, elem, attrs, editLayer) {

                scope.$watch('ratio', function () {
                    elem.css(scope.pageBarSection());
                });
            }
        }
    }])

    pcapp.directive('ngKey', ['$document', function ($document) {
        return {
            replace: true,
            scope: {
                key: '=',
                name: '@',
                ratio: '@',
                animation: '=',
                freez: '=',
                isopen: '='
            },
            template: '<div class="key {{key[name].label}}" title="{{key[name].value}}"><div class="edit-key" ng-show="isEdit"  ><input ng-model="newFrame" type="number" min="0" value="{{::key.frame}}" /><a class="ok">OK</a><a class="del"></a></div> <div class="freez-line"></div> </div>',
            link: function (scope, elem, attrs, editLayer) {
                scope.isEdit = false;

                scope.keyPos = function () {
                    return {
                        left: (scope.key.frame * scope.ratio) + 'px'
                    }
                }
                scope.freezLineWidth = function () {
                    var idx = scope.freez.indexOf(scope.key.frame),
                        stopFreezPos = scope.freez[idx + 1];

                    return {
                        width: ((stopFreezPos - scope.key.frame) * scope.ratio - 11) + 'px'
                    }
                }

                if (scope.name == 'top' && scope.key.top.label == 'startFreez') {
                    scope.$watch('freez', function (value, oldvalue) {
                        elem.find('.freez-line').css(scope.freezLineWidth());
                    });
                }

                scope.$watch('key.frame', function (value, oldvalue) {
                    //if(value != oldvalue){
                    elem.css(scope.keyPos());
                    //}
                });
                scope.$watch('ratio', function (value, oldvalue) {
                    if (value != oldvalue) {
                        elem.css(scope.keyPos());
                        if (scope.name == 'top' && scope.key.top.label == 'startFreez') {
                            elem.find('.freez-line').css(scope.freezLineWidth());
                        }
                    }
                });

                elem.bind('dblclick', function (e) {
                    e.stopPropagation();
                    //if(!scope.isEdit){                        
                    if (!scope.disabled) $('#customize-preview iframe').contents().scrollTop(scope.key.frame);
                    //}
                    scope.isEdit = false;
                });

                elem.find('input').bind('dblclick', function (e) {
                    e.stopPropagation();
                });

                elem.find('.del').bind('click', function (e) {
                    e.stopPropagation();

                    //NOTE Freeze key removing
                    if (scope.name == 'top') {

                        if (scope.key[scope.name].label == 'startFreez') {

                            var stopFreezKey = _.find(scope.animation, function (key) {
                                if (
                                    key.frame > scope.key.frame &&
                                    key.top && key.top.freezId &&
                                    scope.key.top.freezId &&
                                    scope.key.top.freezId == key.top.freezId
                                ) {
                                    return true;
                                }
                                return false;
                            });
                            if (stopFreezKey)
                                delete stopFreezKey[scope.name];


                        }
                        if (scope.key[scope.name].label == 'stopFreez') {

                            var startFreezKey = _.last(_.filter(scope.animation, function (key) {
                                if (
                                    key.frame < scope.key.frame &&
                                    key.top && key.top.freezId &&
                                    scope.key.top.freezId &&
                                    scope.key.top.freezId == key.top.freezId
                                ) {
                                    return true;
                                }
                                return false;
                            }));

                            scope.animation.reverse();

                            if (startFreezKey)
                                delete startFreezKey[scope.name];
                        }

                    }


                    delete scope.key[scope.name];

                    if (Object.keys(scope.key).length < 3) {
                        var idx = scope.animation.indexOf(scope.key);
                        scope.animation.splice(idx, 1);
                    }


                    scope.$apply(function () {
                        scope.isEdit = false;
                    });
                });
                $(document).keyup(function (e) {
                    if (e.keyCode == 27) {
                        scope.$apply(function () {
                            scope.isEdit = false;
                        });
                    }
                });

                scope.checkFreez = function (type) {

                    var leftFreezPos = _.last(_.filter(scope.freez, function (n) {
                        return n < scope.key.frame;
                    }));
                    var rightFreezPos = _.first(_.filter(scope.freez, function (n) {
                        return n > scope.key.frame;
                    }));

                    if (
                        leftFreezPos < scope.newFrame && rightFreezPos > scope.newFrame ||
                        !leftFreezPos && rightFreezPos > scope.newFrame ||
                        leftFreezPos < scope.newFrame && !rightFreezPos
                    ) {
                        return true;
                    } else {
                        return false;
                    }


                }

                scope.updatePosition = function () {


                    scope.newFrame = parseInt(scope.newFrame);

                    if (isNaN(scope.newFrame)) {
                        scope.newFrame = scope.key.frame
                    }

                    var key = _.find(scope.animation, function (el) {
                        return el.frame == scope.newFrame;
                    });


                    if (scope.name == 'top' && (scope.key[scope.name].label == 'startFreez' || scope.key[scope.name].label == 'stopFreez')) {

                        if (scope.checkFreez(scope.key[scope.name].label)) {
                            scope.key[scope.name].value = scope.key[scope.name].value + (scope.newFrame - scope.key.frame);
                            if (key) {
                                //dolacz
                                key[scope.name] = angular.copy(scope.key[scope.name]);

                            } else {
                                //nowy
                                var newKey = {
                                    frame: scope.newFrame
                                };
                                newKey[scope.name] = angular.copy(scope.key[scope.name]);
                                scope.animation.push(newKey);
                            }
                            //usun stary
                            if (scope.key.frame != scope.newFrame) {
                                delete scope.key[scope.name];
                            }


                        } else {
                            $('#customize-preview iframe')[0].contentWindow.jQuery().pcAlert({
                                class: 'warning',
                                text: $scope.l10n.alertWarning,
                                msg: $scope.l10n.alertWarningMove
                            });
                        }
                    } else {

                        if (key) {

                            key[scope.name] = angular.copy(scope.key[scope.name]);

                        } else {

                            var newKey = {
                                frame: scope.newFrame
                            };
                            newKey[scope.name] = angular.copy(scope.key[scope.name]);
                            scope.animation.push(newKey);
                        }

                        if (scope.key.frame != scope.newFrame) {
                            delete scope.key[scope.name];
                        }
                    }


                    scope.$apply(function () {
                        scope.isEdit = false;
                    });

                }

                elem.find('input').keyup(function (e) {
                    if (e.keyCode == 13) {
                        scope.updatePosition();
                    }
                });
                elem.find('input').bind('click', function (e) {
                    e.stopPropagation();
                });

                elem.find('.ok').bind('click', function (e) {
                    e.stopPropagation();
                    scope.updatePosition();
                });
                $document.bind('click', function () {
                    scope.$apply(function () {
                        scope.isEdit = false;
                    });
                })
                elem.bind('click', function (e) {
                    e.stopPropagation();
                    if (!scope.disabled) {
                        scope.$apply(function () {
                            scope.isEdit = true;
                        });

                        elem.find('input').val(scope.key.frame).focus();
                    }

                });
            }

        }
    }]);


    pcapp.directive('ngTooltip', ['Data', '$compile', function (Data, $compile) {
        return {
            scope: {
                tooltip: '='
            },

            link: function (scope, elem, attrs, editLayer) {
                if (scope.tooltip) {
                    scope.title = scope.tooltip.title || 'no title';
                    scope.content = scope.tooltip.content || 'no content';
                    if (Data.settings.displayTootltips == true) {
                        var icon = $('<a/>', {
                            class: 'icon-tooltip',
                            html: ''
                        }).on('click', function (e) {
                            e.preventDefault();
                            e.stopPropagation();

                            angular.element($('body.wp-customizer')).append($compile('<div ng-modal-window-tooltip ><div class="pc-modal-window"><div class="header"><span class="icon tooltip"></span> <span ng-bind="::title"></span> <div class="close icon"></div></div><div class="body"><div class="row"> <div ng-bind-html="::content"></div> </div></div><div class="footer"></div></div></div>')(scope));

                        });
                        elem.after(icon);
                    }
                }

            }
        }
    }]);

    pcapp.directive('ngTinymce', ['$rootScope', '$timeout', function ($rootScope, $timeout) {
        return {
            replace: true,
            scope: {
                attr: '=',
                sort: '=',
            },
            template: '<div class="customEditor"><textarea ng-model="attr" id="{{id}}"></textarea></div>',
            link: function (scope, elem, attrs) {
                scope.id = 'customEditor-' + new Date().getTime().toString();

                scope.setDesc = function (desc) {
                    scope.attr = desc;
                    scope.$apply();
                }

                $rootScope.$on('update-layer', function (event, args) {
                    if (tinyMCE.get(scope.id)) {
                        scope.setDesc(tinyMCE.get(scope.id).getContent());
                    }
                });

                scope.tinyMCE = function () {
                    tinyMCE.init({
                        menubar: false,
                        plugins: "paste",
                        toolbar_items_size: 'small',
                        toolbar: 'undo redo | italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent',
                        paste_as_text: true
                    });
                    tinyMCE.EditorManager.execCommand('mceAddEditor', false, scope.id);


                };

                $timeout(function () {
                    if (tinyMCE.get(scope.id) === null) {
                        scope.tinyMCE();
                    }
                }, 100);
            }

        }
    }]);

    pcapp.directive('optionFamily', ['$compile', '$parse', function ($compile, $parse) {
        return {
            restrict: 'A',
            priority: 10000,
            link: function optionStylePostLink(scope, elem, attrs) {
                var options = elem.find("option");
                for (var i = 0; i < options.length; i++) {
                    if (angular.element(options[i]).text() == attrs.optionFamily) {
                        angular.element(options[i]).attr('selected', true);
                    } else {
                        angular.element(options[i]).attr('selected', false);
                    }
                }
            }
        };
    }]);


    /* FILTER */

    pcapp.filter('keyName', function () {
        return function (name, scope) {
            return scope.l10n.timeline[name];
        }
    });
    pcapp.filter('getAllKeysName', function () {
        return function (animation) {

            var arr = [];
            var allowKey = ['x', 'y', 'top', 'left', 'opacity', 'width', 'height', 'rotationX', 'rotationY', 'rotationZ', 'scale', 'backgroundColor', 'borderStyle', 'borderWidth', 'borderColor', 'borderTopLeftRadius', 'borderTopRightRadius', 'borderBottomLeftRadius', 'borderBottomRightRadius', 'outlineStyle', 'outlineWidth', 'outlineColor', 'outlineTopLeftRadius', 'outlineTopRightRadius', 'outlineBottomLeftRadius', 'outlineBottomRightRadius', 'audio', 'volume', 'letterSpacing', 'fontSize', 'lineHeight', 'padding', 'paddingTop', 'paddingRight', 'paddingBottom', 'paddingLeft', 'color'];

            if (angular.isArray(animation)) {
                for (var i = 0; i < animation.length; i++) {
                    var keys = _.keys(animation[i]);
                    arr = arr.concat(_.filter(keys, function (key) {
                        return _.indexOf(allowKey, key) > -1;
                    })).unique();
                }

            }
            return arr;
        }
    });

    pcapp.filter('countChild', function () {

        var traverse = function (child, count) {

            count = child.nodes.length;
            _.each(child.nodes, function (node) {
                count += node.nodes.length;

                _.each(node.nodes, function (node2) {
                    count += node2.nodes.length;
                });

            });
            return count;
        }

        return function (nodes) {
            return traverse(nodes, 0);
        }
    });

    pcapp.filter('getKeysByName', function () {
        return function (animation, keyName) {

            if (angular.isArray(animation)) {
                return _.filter(animation, function (el) {
                    return typeof el[keyName] != 'undefined';
                });
            }
            return [];
        }
    });

    pcapp.filter('getKeysByFrame', function () {
        return function (animation, frame) {

            if (angular.isArray(animation)) {
                return _.filter(animation, function (el) {
                    return el.frame == frame;
                });
            }
            return [];
        }
    });

    pcapp.filter('trustAsHtml', function ($sce) {
        return $sce.trustAsHtml;
    });

    var pageTitle = 'PARALLAX COMPOSER ' + IDEO_PC_VERSION;
    document.title = pageTitle;

    wp.customize.bind('title', function () {
        document.title = pageTitle;
    })


})(jQuery);