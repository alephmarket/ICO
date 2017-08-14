(function ($) {
    "use strict";

    var colorsArray = {};
    var colorsMultiArray = {};

    var changeSkin = function (select) {
        var $select = $(select),
            colorsData = $select.data('colors'),
            name = $select.attr('name'),
            colorStyle = {},
            $colorPickerList = $('.' + name + '_colors_list'),
            $input = $('.' + name + '_colors'),
            value = $input.val(),
            jsonValue = {},
            customColorsData = $input.data('el-colors'),
            customColorsListData = $input.data('el-colors-list'),
            elColors = {},
            elColorsStyle;


        if (typeof customColorsListData === "object") {
            var selectName = Object.keys(customColorsListData)[0],
                selectValue = $('[name="' + selectName + '"]').val();

            if (colorsMultiArray[selectName + '_' + selectValue + '_' + $select.val()]) {
                colorStyle = colorsMultiArray[selectName + '_' + selectValue + '_' + $select.val()];
            } else {
                elColorsStyle = customColorsListData[selectName][selectValue][$select.val().split('-')[0]];
                $.each(elColorsStyle, function (index, value) {
                    colorStyle[index] = '';
                });

                colorsMultiArray[selectName + '_' + selectValue + '_' + $select.val()] = colorStyle;
            }
        } else {            
            if (value && value.trim() != '') {
                colorStyle = colorsArray[name + '_colors_' + $select.val()];
            }
            if (typeof colorStyle !== 'object') {
                colorStyle = {};
                var colors = customColorsData[$select.val().split('-')[0]];
                $.each(colors, function (index, value) {
                    colorStyle[index] = '';

                });
                colorsArray[name + '_colors_' + $select.val()] = colorStyle;
            }
        }

        setInputColors($select.val(), colorStyle, $input);
        createColorPickers($select.val(), colorStyle, $colorPickerList, $input);

    }


    var setInputColors = function (style, colors, $input) {
        var value = $input.val(),
            jsonValue = {};

        if (value && value.trim() != '') {
            jsonValue = JSON.parse(value.replace(/\'/g, '"'));
        }

        value = JSON.stringify(colors);

        $input.val(value.replace(/\"/g, "'"));
    }

    var createColorPickers = function (style, colors, $list, $input) {
        var customColorsData = $input.data('el-colors'),
            customColorsListData = $input.data('el-colors-list'),
            elColorsStyle = {},
            labels = {};

        if (typeof customColorsListData === "object") {
            var selectName = Object.keys(customColorsListData)[0],
                $selectDep = $('[name="' + selectName + '"]'),
                selectValue = $selectDep.val();

            elColorsStyle = customColorsListData[selectName][selectValue][style.split('-')[0]];

        } else {
            elColorsStyle = customColorsData[style.split('-')[0]];

        }


        $.each(elColorsStyle, function (index, value) {
            labels[index] = elColorsStyle[index];
        });

        $list.html('');

        $.each(colors, function (index, value) {

            var div = $('<div/>').appendTo($list);

            var label = $('<label/>', {
                class: 'label-' + index,
                html: labels[index]
            }).appendTo(div);

            var colorpicker = $('<input/>', {
                class: 'color-' + index,
                'data-alpha': true,
                value: value || ''
            }).appendTo(div);

            colorpicker.wpColorPicker({
                change: function (event, ui) {
                    var color = $(this).wpColorPicker('color');
                    colors[index] = color;
                    setInputColors(style, colors, $input);
                },
                clear: function () {
                    colors[index] = '';
                    setInputColors(style, colors, $input);
                }
            });
        });
    }

    $('.ideo_custom_colors_field').each(function (index, element) {
        var $input = $(element),
            value = $input.val(),
            customColorsData = $input.data('el-colors'),
            customColorsListData = $input.data('el-colors-list'),
            inputName = $input.attr('name'),
            $colorPickerList = $('.' + inputName + '_list'),
            $select = $('.' + inputName.replace('_colors', '') + ''),
            colorsArr = [],
            elColorsStyle = [],
            elColors = {};

        if (typeof customColorsListData === "object") {
            var selectName = Object.keys(customColorsListData)[0],
                $selectDep = $('[name="' + selectName + '"]'),
                selectValue = $selectDep.val();

            $selectDep.on('change', function () {
                $('select[data-colors]').trigger('change');
            });

            if (value && value.trim() != '') {
                elCustomColors = JSON.parse(value.replace(/\'/g, '"'));
                elColors = elCustomColors;

                colorsArray[selectName + '_' + $select.val()] = elColors;
                colorsMultiArray[selectName + '_' + selectValue + '_' + $select.val()] = elColors;
            } else {
                elColorsStyle = customColorsListData[selectName][selectValue][$select.val().split('-')[0]];

                $.each(elColorsStyle, function (index, value) {
                    elColors[index] = '';
                });

                colorsArray[selectName + '_' + $select.val()] = elColors;
                colorsMultiArray[selectName + '_' + selectValue + '_' + $select.val()] = elColors;

                $input.val(JSON.stringify(elColors).replace(/\"/g, "'"));

            }
            createColorPickers($select.val(), elColors, $colorPickerList, $input);
        } else {
            var elCustomColors = '';

            if (value && value.trim() != '') {
                elCustomColors = JSON.parse(value.replace(/\'/g, '"'));
                elColors = elCustomColors;
                colorsArray[inputName + '_' + $select.val()] = elColors;
            } else {
                elColorsStyle = customColorsData[$select.val().split('-')[0]];
                $.each(elColorsStyle, function (index, value) {
                    elColors[index] = '';
                });

                colorsArray[inputName + '_' + $select.val()] = elColors;
                $input.val(JSON.stringify(elColors).replace(/\"/g, "'"));
            }

            createColorPickers($select.val(), elColors, $colorPickerList, $input);
        }

    });

    $('select[data-colors]').on('change', function () {
        changeSkin(this);
    });


})(window.jQuery);