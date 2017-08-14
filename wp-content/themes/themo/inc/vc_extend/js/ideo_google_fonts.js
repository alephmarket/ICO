(function ($) {
    "use strict";

    //NOTE: use ideo_get_google_fonts in wp_localize_script, something like this
    // var webfonts = ideo.webfonts;
    var webfonts = _ideo.webfonts;

    if ($('#google-fonts').length) {
        var inputGoogleFonts = $('#google-fonts');
        var inputGoogleFontsValue = inputGoogleFonts.val().split('|');
        var selectFontFamily = $('#font-family');
        var selectFontWeight = $('#font-weight');
        var selectSubsets = $('#font-subsets');
        var selectPreview = $('#font-preview');

        var getFont = function (family) {

            var font = _.find(webfonts.items, function (font) {
                return font.family == family;
            });

            return font;
        }

        var setFont = function () {
            inputGoogleFonts.val(selectFontFamily.val() + '|' + selectFontWeight.val() + '|' + selectSubsets.val());
            selectPreview.css({
                fontFamily: selectFontFamily.val(),
                fontWeight: selectFontWeight.val().replace('italic', ''),
                fontStyle: (selectFontWeight.val().indexOf('italic') > -1 ? 'italic' : ''),
            });

            $("head").append("<link />");
            var gf = $("head").children(":last");
            gf.attr({
                "rel": "stylesheet",
                "type": "text/css",
                "href": "//fonts.googleapis.com/css?family=" + selectFontFamily.val() + ":" + selectFontWeight.val() + '&subset=' + (selectSubsets.val() || '')
            });

        }


        for (var i in webfonts.items) {
            $('<option/>', {html: webfonts.items[i].family}).appendTo(selectFontFamily);
        }
        // init
        if (inputGoogleFontsValue.length == 3) {

            selectFontFamily.val(inputGoogleFontsValue[0]);
            var font = getFont(inputGoogleFontsValue[0]);

            selectFontWeight.html('');
            for (var i in font.variants) {
                $('<option/>', {html: font.variants[i]}).appendTo(selectFontWeight);
            }
            selectFontWeight.val(inputGoogleFontsValue[1]);

            selectSubsets.html('');
            for (var i in font.subsets) {
                $('<option/>', {html: font.subsets[i]}).appendTo(selectSubsets);
            }
            selectSubsets.val(inputGoogleFontsValue[2].split(','));

            setFont();
        }

        selectFontFamily.on('change', function () {
            var font = getFont($(this).val());

            selectFontWeight.html('');
            for (var i in font.variants) {
                $('<option/>', {html: font.variants[i]}).appendTo(selectFontWeight);
            }

            selectSubsets.html('');
            for (var i in font.subsets) {
                $('<option/>', {html: font.subsets[i]}).appendTo(selectSubsets);
            }


            setFont();
        });

        selectFontWeight.on('change', function () {
            setFont();
        });
        selectSubsets.on('change', function () {
            setFont();
        });


    }

})(window.jQuery);