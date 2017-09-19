(function ($) {
    "use strict";

    var customize = wp.customize;

    var panel = angular.module('panelApp', []);
    panel.factory('Depending', function () {
        var service = {
            depending: {},
            controls: {},
            SetDepending: function (id, depen) {
                service.depending[id] = depen;
                angular.forEach(depen, function (control_ids, control_value) {
                    if (control_ids) {
                        angular.forEach(control_ids, function (control_id) {
                            if (!service.controls[control_id]) {
                                service.controls[control_id] = [];
                            }
                            if (!service.controls[control_id][id]) {
                                service.controls[control_id][id] = [];
                            }
                            service.controls[control_id][id].push(control_value);
                        });
                    }
                });
            },
        };
        return service;
    });
    panel.controller('panelCtrl', ['$scope', 'Depending', function ($scope, Depending) {
        $scope.panel_structure = panel_structure;
        $scope.panel_data = panel_data;
        $scope.open_panel_id = false;
        $scope.show_loader = true;


        customize.control('data_refresh').focus();

        customize.previewer.bind('active', function (data) {
            $scope.$broadcast('previewer::active');
            $scope.show_loader = false;
            $scope.$apply();
        });

        customize.bind('saved', function (resp) {
            jQuery('#customize-header-actions .ideo-spinner').remove();

            var spinnerText = jQuery('<span class="ideo-spinner"><span class="text">' + _ideo_customizer.progress + '</span> <i class="fa fa-check-circle-o fa-fw success"></i> <i class="fa fa- fa-minus-circle fa-fw error"></i> <i class="fa fa-spinner fa-pulse fa-fw generate"></i></span>');
            jQuery('#customize-header-actions .spinner').before(spinnerText);

            setTimeout(function () {
                spinnerText.addClass('active');
            }, 25);

            var done = function () {
                jQuery('#customize-header-actions .ideo-spinner').addClass('done');
            }
            var showError = function (error) {
                jQuery('#customize-header-actions .ideo-spinner').addClass('error');
                var errorDialog = jQuery('<div class="ideo-error-dialog"><a href="#" class="close">&times;</a>' + _ideo_customizer[error] + '</div>').appendTo('#customize-header-actions');
                errorDialog.find('.close').on('click', function (e) {
                    e.preventDefault();
                    errorDialog.remove();
                });
            }
            var updateProgress = function () {
                setTimeout(done, 1000);
            }

            jQuery.post(ajaxurl, {
                action: 'customizerGenerateCss'
            }, function (response) {
                if (response.success) {
                    updateProgress();
                    jQuery.post(ajaxurl, {
                        action: 'generate_part_css'
                    });
                } else {
                    showError(response.error);
                }
            }, 'json');
        });
        $scope.$on('openpanel', function (event, args) {
            $scope.open_panel_id = args;
        });
        $scope.forcePostMessage = false;
        $scope.$on('previewer::active', function () {
            if ($scope.forcePostMessage) {
                $scope.$broadcast('update_control', {
                    transport: 'postMessage'
                });
                $scope.forcePostMessage = false;
            }
        });
        $scope.$on('update_control', function (event, args) {

            var json = JSON.stringify($scope.panel_data);
            if (args.transport == 'refresh' || args.transport == 'both') {
                $scope.show_loader = true;
                customize.instance('data_refresh').set(json);
                customize.instance('data_postMessage').set(json);
                $scope.forcePostMessage = true;
            } else {
                customize.instance('data_refresh')._value = json;
                customize.instance('data_postMessage').set(json);
            }
        });
        $scope.isOpenPanel = function () {
            return $scope.open_panel_id;
        };
        $scope.showSubPanel = function (subpanel) {
            return $scope.open_panel_id == subpanel.id;
        };
        $scope.hideSubPanel = function () {
            $scope.open_panel_id = false;
        };

        $scope.isVisible = function (control) {
            if (Depending.controls[control.id]) {
                var parent_id = Object.keys(Depending.controls[control.id])[0];
                return Depending.controls[control.id][parent_id].indexOf($scope.panel_data[parent_id]) > -1;
            }
            return true;
        };
        $scope.isControlDepending = function (control) {
            if (Depending.controls[control.id]) {
                return true;
            }
            return false;
        };
    }]);
    panel.directive('accordionPanel', ['$rootScope', function ($rootScope) {
        return {
            controller: function ($scope, $element) {
                $scope.togglePanel = function (panel) {
                    $element.toggleClass('open');
                    $rootScope.$broadcast('openpanel', panel.id);
                };
            }
        }
    }]);
    panel.directive('accordionSection', ['$rootScope', function ($rootScope) {
        return {
            controller: function ($scope, $element) {
                $rootScope.$on('toggleSection', function (event, element) {
                    if ($element.hasClass('open') && !angular.equals($element, element)) {
                        $element.removeClass('open');
                    }
                });
                $scope.toggleSection = function () {
                    $element.toggleClass('open');
                    $rootScope.$broadcast('toggleSection', $element);
                };
            }
        }
    }]);
    panel.directive('panelControls', ['$compile', 'Depending', function ($compile, Depending) {
        return {
            template: '',
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope, $sce) {
                if (typeof $scope.paneldata[$scope.control.id] == 'undefined') {
                    $scope.paneldata[$scope.control.id] = angular.copy($scope.control.default);
                }
                $scope.description = $sce.trustAsHtml($scope.control.description);
                $scope.label = $sce.trustAsHtml($scope.control.label);
                if ($scope.control.depending) {
                    Depending.SetDepending($scope.control.id, $scope.control.depending);
                }
            },
            link: function ($scope, element) {
                element.append($compile(
                    '<h4 class="ideo-control-title control-title-{{::control.type}}"><span ng-bind-html="::label"></span> <i class="icon-help id id-Alerts_3" ng-if="control.description.length>0"><span ng-bind-html="::description"></span></i></h4>' +
                    '<div panel-control-' + $scope.control.type + ' control="control"  paneldata="paneldata" >' +
                    '</div>'
                )($scope));
            }
        }
    }]);
    panel.directive('panelControlInfo', function () {
        return {
            scope: {
                control: '=control'
            },
            controller: function ($scope, $element, $sce) {
                $scope.description = $sce.trustAsHtml($scope.control.description);
                $scope.label = $sce.trustAsHtml($scope.control.label);
                $scope.toggleClass = function () {
                    $element.find('.ideo-control-title').toggleClass('open');
                };
            },
            template: '<div><h5 class="ideo-control-title control-title-{{::control.type}}" ng-click="toggleClass()">{{::label}} </h5> <p class="info-description" ng-bind-html="::description"></p></div>'
        }
    });
    panel.directive('sectionTitle', function () {
        return {
            scope: {
                title: '@title'
            },
            controller: function ($scope, $element, $sce) {
                $scope.trustedHtml = $sce.trustAsHtml($scope.title);
            },
            template: '<span ng-bind-html="::trustedHtml"></span>'
        }
    });
    panel.directive('panelControlSeparator', function () {
        return {}
    });
    panel.directive('panelControlText', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div><input type="text" name="{{::control.id}}" ng-model="paneldata[control.id]" ng-model-options="{ debounce: 200 }" ng-change="update()"></div>'
        }
    }]);
    panel.directive('panelControlCheckbox', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div><label for="{{::control.id}}"><input type="checkbox" id="{{::control.id}}" ng-model="paneldata[control.id]" ng-true-value="\'1\'" ng-false-value="\'0\'" ng-change="update()"> {{::control.label}}</label></div>'
        }
    }]);
    panel.directive('panelControlTextarea', ['$rootScope', '$filter', function ($rootScope, $filter) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {

                function escapeHtml(text) {
                    var map = {
                        '&': '&amp;',
                        '<': '&lt;',
                        '>': '&gt;',
                        '"': '&quot;',
                        "'": '&#039;'
                    };
                    return text.replace(/[&<>"']/g, function (m) {
                        return map[m];
                    });
                };

                function unescapeHtml(unsafe) {
                    return unsafe
                        .replace(/&amp;/g, "&")
                        .replace(/&lt;/g, "<")
                        .replace(/&gt;/g, ">")
                        .replace(/&quot;/g, "\"")
                        .replace(/&#039;/g, "'");
                }

                $scope.value = unescapeHtml($scope.paneldata[$scope.control.id]);

                $scope.update = function () {
                    $scope.paneldata[$scope.control.id] = escapeHtml($scope.value);
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div><textarea name="{{::control.id}}" ng-model="value" ng-model-options="{ updateOn: \'blur\' }" ng-change="update()">{{value}}</textarea></div>'
        }
    }]);
    panel.directive('panelControlExport', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope, $element) {
                $scope.select = function () {
                    $element.find('textarea').focus();
                    $element.find('textarea').select();
                };
            },
            template: '<div class="ideo-panel-control-export"><textarea name="{{::control.id}}" ng-readonly="true" ng-click="select()">{{paneldata|json:0}}</textarea></div>'
        }
    }]);
    panel.directive('panelControlImport', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.bkp_data = {};
                $scope.import_data = '';
                $scope.error = '';

                $scope.preview = function () {
                    try {
                        $scope.error = '';
                        var import_data = JSON.parse($scope.import_data);
                        Object.assign($scope.paneldata, import_data);
                        $rootScope.$broadcast('update_control', {
                            transport: $scope.control.transport,
                            control: $scope.control
                        });
                    } catch (err) {
                        $scope.error = err.message;
                    }


                };
            },
            template: '<div class="ideo-panel-control-export">' +
                '<button type="button" class="button button-primary button-preview" ng-click="preview()">Preview</button>' +
                '<div class="valid-error" ng-if="error" ng-bind="error"></div>' +
                '<textarea name="{{::control.id}}" ng-model="import_data"></textarea></div>'
        }
    }]);
    panel.directive('panelControlCode', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.isChanged = false;
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
                $scope.preview = function () {
                    $scope.paneldata[$scope.control.id] = $scope.cm.getValue();
                    $scope.isChanged = false;
                    $scope.update();
                };
            },
            link: function (scope, element) {
                scope.cm = CodeMirror.fromTextArea(element.find('textarea')[0], {
                    mode: scope.control.code_type,
                    theme: 'railscasts',
                    lineNumbers: false,
                    newlineAndIndent: true,
                    autoRefresh: true,
                });
                scope.cm.setSize(285, window.innerHeight - 200);
                scope.cm.setValue(scope.paneldata[scope.control.id]);
                if (!scope.control.add_preview_button) {
                    var update = function () {
                        var replaceCharacter = String.fromCharCode(7);
                        scope.$apply(function () {
                            scope.isChanged = true;
                            scope.paneldata[scope.control.id] = scope.cm.getValue().replace(/\<[\/]*script\>/g, '');
                            scope.update();
                        });
                    };
                    var debounce = _.debounce(update, 300);
                    scope.cm.on('change', debounce);
                } else {
                    scope.cm.on('change', function (cm) {
                        scope.$apply(function () {
                            scope.isChanged = true;
                            scope.paneldata[scope.control.id] = scope.cm.getValue().replace(/\<[\/]*script\>/g, '');
                        });
                    });
                }
            },
            template: '<div class="ideo-panel-control-code">' +
                '<button ng-if="control.add_preview_button" ng-disabled="!isChanged" type="button" class="button button-primary button-preview" ng-click="preview()">Preview</button>' +
                '<textarea name="{{::control.id}}" ng-model="paneldata[control.id]" ng-model-options="{ debounce: 200 }"></textarea>' +
                '</div>'
        }
    }]);
    panel.directive('panelControlAlphacolor', ['$rootScope', '$timeout', function ($rootScope, $timeout) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            link: function (scope, element) {
                jQuery(element).find('input')
                    .data('default-color', scope.control.default)
                    .data('default-palette', scope.control.palette)
                    .wpColorPicker()
                    .wpColorPicker('color', angular.copy(scope.paneldata[scope.control.id] || scope.control.default))
                    .wpColorPicker('option', 'clear', function (event, ui) {
                        scope.$apply(function () {
                            scope.paneldata[scope.control.id] = '';
                            scope.update();
                        });
                    })
                    .wpColorPicker('option', 'change', function (event, ui) {
                        scope.$apply(function () {
                            scope.paneldata[scope.control.id] = ui.color.toString();
                            scope.update();
                        });
                    });
            },
            template: '<div><input class="color-picker" data-alpha="true" type="text" name="{{::control.id}}" valuel="{{::paneldata[control.id]}}" ></div>'
        }
    }]);
    panel.directive('panelControlUpload', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope, $element) {
                $scope.url = $scope.paneldata[$scope.control.id];
                $scope.isEmpty = $scope.url == '' ? true : false;
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
                $scope.upload = function () {
                    wp.media.editor.insert = function (img) {
                        if (img != '') {
                            $scope.paneldata[$scope.control.id] = $scope.url = angular.element(img).attr('src');
                            $scope.isEmpty = $scope.url == '' ? true : false;
                            $scope.$apply();
                            $scope.update();
                        }
                    }
                    wp.media.editor.send.attachment = function (props, attachment) {
                        $scope.paneldata[$scope.control.id] = $scope.url = attachment.url;
                        $scope.isEmpty = $scope.url == '' ? true : false;
                        $scope.$apply();
                        $scope.update();
                    }
                    wp.media.editor.open();
                };
                $scope.remove = function () {
                    $scope.paneldata[$scope.control.id] = $scope.url = '';
                    $scope.isEmpty = true;
                    $scope.update();
                };
            },

            template: '<div class="ideo-panel-control-upload"> ' +
                '  <div class="image-upload-prev">' +
                '   <img ng-if="!isEmpty" ng-src="{{url}}"/>' +
                '   <div ng-if="isEmpty" class="no-image">No file selected</div>' +
                '  </div> ' +
                '  <input type="hidden" name="{{::control.id}}" ng-model="paneldata[control.id]" >' +
                '   <div class="actions">' +
                '       <button ng-if="!isEmpty" type="button" class="button button-primary change-button" ng-click="upload()">Change File</button>' +
                '       <button ng-if="isEmpty" type="button" class="button button-primary upload-button" ng-click="upload()">Select File</button>' +
                '       <button ng-if="!isEmpty" type="button" class="button button-primary remove-button" ng-click="remove()">Remove</button>' +
                '   </div>' +
                '</div>'
        }
    }]);
    panel.directive('panelControlSlider', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope, $element) {
                $scope.updateSlider = function () {
                    jQuery($element).find('.slider').slider({
                        value: parseInt($scope.paneldata[$scope.control.id])
                    });
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            link: function (scope, element) {

                jQuery(element).find('.slider').slider({
                    min: parseInt(scope.control.choices.min),
                    max: parseInt(scope.control.choices.max),
                    step: parseInt(scope.control.choices.step),
                    value: parseInt(scope.paneldata[scope.control.id]),
                    slide: function (event, ui) {
                        scope.$apply(function () {
                            scope.paneldata[scope.control.id] = ui.value;
                        });
                    },
                    stop: function (event, ui) {
                        $rootScope.$broadcast('update_control', {
                            transport: scope.control.transport
                        });
                    }
                });
            },
            template: '<div><div class="slider ideo-slider"></div><input class="ideo-slider-value" type="text" name="{{::control.id}}" ng-model="paneldata[control.id]" ng-model-options="{ updateOn: \'default\', debounce: 200 }" ng-change="updateSlider()"></div>'
        }
    }]);
    panel.directive('panelControlSwitcher', ['$rootScope', '$timeout', function ($rootScope, $timeout) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $scope.onoff = $scope.paneldata[$scope.control.id] == 'true' ? 'on' : 'off';
                };
                $scope.toggle = function () {
                    $scope.paneldata[$scope.control.id] = $scope.paneldata[$scope.control.id] == 'true' ? 'false' : 'true';
                    $scope.update();
                    $timeout(function () {
                        $rootScope.$broadcast('update_control', {
                            transport: $scope.control.transport,
                            control: $scope.control
                        });
                    }, 350);
                };
                $scope.update();
            },
            link: function (scope, element) {

            },
            template: '<div class="ideo-onoffswitch" ng-click="toggle()">' +
                '<label class="onoffswitch-label {{onoff}}" for="onoffswitch-{{::control.id}}">' +
                '   <div class="onoffswitch-inner"></div>' +
                '   <div class="onoffswitch-switch"></div>' +
                '</label>' +
                '<input type="radio" name="{{::control.id}}" ng-model="paneldata[control.id]" value="true" ng-change="update()">' +
                '<input type="radio" name="{{::control.id}}" ng-model="paneldata[control.id]" value="false" ng-change="update()">' +
                '</div>'
        }
    }]);
    panel.directive('panelControlSelect', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div> <select name="{{::control.id}}" ng-model="paneldata[control.id]" ng-options="key as value for (key, value) in control.choices" ng-change="update()"></select></div>'
        }
    }]);
    panel.directive('panelControlVisualSelect', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.base_url = _ideo_customizer.base_url;
                $scope.update = function (value) {
                    $scope.paneldata[$scope.control.id] = value;
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div class="ideo-panel-control-visual-select">' +
                '<input type="hidden" name="{{::control.id}}" ng-model="paneldata[control.id]" value="{{::value}}">' +
                '<div ng-repeat="(key, value) in control.choices">' +
                '<button type="button" ng-click="update(key)" ng-class="{\'selected\':key == paneldata[control.id]}">' +
                '<img title="{{::value.title}}" ng-src="{{::base_url}}/inc/customizer/image/{{::value.image}}" /></button>' +
                '</div></div>'
        }
    }]);
    panel.directive('panelControlSelectFonts', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {

                $scope.fonts = [];

                $scope.$watch("paneldata['ideo_theme_options[fonts][font_family][global_font_extension]']", function (val, oldval) {
                    if (val != oldval) {
                        $scope.updateFontList($scope.paneldata['ideo_theme_options[fonts][font_family][global_font_extension]'], true);
                    }
                });


                $scope.updateFontList = function (subsets, watch) {
                    $scope.fonts = [];
                    if ($scope.control.id !== 'ideo_theme_options[fonts][body_font_settings][body_font_family]') {
                        $scope.fonts.push({
                            label: 'Default',
                            value: ''
                        });
                    }
                    angular.forEach(_ideo.webfonts.items, function (font) {
                        if (font.subsets.indexOf(subsets) > -1) {
                            $scope.fonts.push({
                                label: font.family,
                                value: font.family
                            });
                        }
                    });
                    if (watch && $scope.control.id === 'ideo_theme_options[fonts][body_font_settings][body_font_family]') {
                        $scope.paneldata[$scope.control.id] = $scope.fonts[0].value;
                    }
                };
                $scope.updateFontList($scope.paneldata['ideo_theme_options[fonts][font_family][global_font_extension]'], false);
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
                $scope.subset = function (value) {
                    return false;
                };
            },
            template: '<div> <select name="{{::control.id}}" ng-model="paneldata[control.id]" ng-options="font.value as font.label for font in fonts" ng-change="update()"></select></div>'
        }
    }]);
    panel.directive('panelControlSelectFontsWeight', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {

                $scope.fontsWeight = [];

                $scope.$watch("paneldata['ideo_theme_options[fonts][body_font_settings][body_font_family]']", function (val, oldval) {
                    if (val != oldval) {
                        //$scope.updateFontList($scope.paneldata['ideo_theme_options[fonts][font_family][global_font_extension]'], true);
                        if (!$scope.paneldata[$scope.control.depends]) {
                            $scope.updateFontWeightList($scope.paneldata['ideo_theme_options[fonts][body_font_settings][body_font_family]'], true);
                        }
                        //console.log('watch ideo_theme_options[fonts][body_font_settings][body_font_family]', val, $scope.paneldata[$scope.control.depends]);
                    }
                });

                $scope.$watch("paneldata['" + $scope.control.depends + "']", function (val, oldval) {
                    if (val != oldval) {
                        $scope.updateFontWeightList($scope.paneldata[$scope.control.depends], true);
                    }
                });

                $scope.updateFontWeightList = function (fontName, watch) {

                    if (watch && fontName == '') {
                        $scope.paneldata[$scope.control.id] = angular.copy($scope.control.default);
                    }

                    if (watch && fontName != '') {
                        $scope.fontsWeight = [];
                    } else {
                        $scope.fontsWeight = [{
                            label: 'Default',
                            value: ''
                        }];
                        fontName = $scope.paneldata['ideo_theme_options[fonts][body_font_settings][body_font_family]'];
                    }

                    angular.forEach(_ideo.webfonts.items, function (font) {
                        if (font.family == fontName) {
                            angular.forEach(font.variants, function (variant) {
                                $scope.fontsWeight.push({
                                    label: variant,
                                    value: variant
                                });
                            });
                            return;
                        }
                    });
                    if (watch && $scope.fontsWeight.length == 1) {
                        $scope.paneldata[$scope.control.id] = $scope.fontsWeight[0].value;
                    }

                    if (watch) {
                        $scope.update();
                    }
                };



                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
                $scope.subset = function (value) {
                    return false;
                };

                $scope.updateFontWeightList($scope.paneldata[$scope.control.depends], false);
            },
            template: '<div> <select name="{{::control.id}}" ng-model="paneldata[control.id]" ng-options="weight.value as weight.label for weight in fontsWeight" ng-change="update()"></select></div>'
        }
    }]);
    panel.directive('panelControlRadio', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div class="ideo-panel-control-radio">' +
                '<div ng-repeat="(value, key) in control.choices"><label  >' +
                '<input type="radio" name="{{::control.id}}"  ng-model="paneldata[control.id]" value="{{::value}}"  ng-change="update()">' +
                ' <span ng-bind-html="::key|trustAsHtml"></span></label>' +
                '</div></div>'
        }
    }]);
    panel.directive('panelControlButton', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {
                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: $scope.control.transport,
                        control: $scope.control
                    });
                };
            },
            template: '<div> <button type="button" class="button button-primary" id="{{::control.id}}" ng-bind="::control.label"></button></div>'
        }
    }]);
    panel.directive('panelControlButtonReset', ['$rootScope', function ($rootScope) {
        return {
            scope: {
                paneldata: '=paneldata',
                control: '=control'
            },
            controller: function ($scope) {

                $scope.update = function () {
                    $rootScope.$broadcast('update_control', {
                        transport: 'both'
                    });
                };
                $scope.resetToDefault = function () {
                    angular.forEach(panel_structure, function (panel) {
                        angular.forEach(panel.sections, function (section) {
                            angular.forEach(section.controls, function (control) {
                                $scope.paneldata[control.id] = control.default;
                            });
                        });
                    });
                    $scope.update();
                };
            },
            template: '<div> <button type="button" class="button button-primary" id="{{::control.id}}" ng-bind="::control.label" ng-click="resetToDefault()"></button></div>'
        }
    }]);

    panel.filter('trustAsHtml', function ($sce) {
        return $sce.trustAsHtml;
    });
})(jQuery);