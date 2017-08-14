(function () {
    tinymce.PluginManager.add('ideo_shortcodes', function (editor, url) {

        var menu_items = [];

        if (typeof(_ideo_shortcodes) != 'undefined') {            
            
            if(typeof _ideo_shortcodes == 'string'){
                _ideo_shortcodes = JSON.parse(_ideo_shortcodes);                
            }
            
            for (var tag in _ideo_shortcodes) {

                var item = [];
                item['text'] = _ideo_shortcodes[tag].name;
                item['tag'] = tag;
                item['value'] = _ideo_shortcodes[tag];
                item['default'] = _ideo_shortcodes[tag].default;
                item['onclick'] = function () {
                    editor.insertContent(jQuery.fn.createShortcode(this.settings.tag, editor.selection.getContent(), this.settings.default));
                };

                menu_items.push(item)
            }

            editor.addButton('ideo_shortcodes', {
                title: 'Shortcodes',
                type: 'menubutton',
                image: url + '/../../images/btn-shortcodes.png',
                menu: menu_items
            });
        }
    });
})();


(function ($) {
    /**
     * Return shortcode to insert editor
     *
     * TODO: Przeniesc gdzies do globalnych helperow
     *
     * @param tag
     * @param text
     * @param params
     * @returns {string}
     */
    jQuery.fn.createShortcode = function (tag, text, params) {

        var shortcode = '[' + tag;

        if (params) {
            if (typeof params.el_uid == 'undefined')
                params.el_uid = '';

            for (var i in params) {
                
                shortcode = shortcode + ' ' + i + '="' + params[i] + '"';
                
            }
        }

        shortcode = shortcode + ']';

        if (typeof(text) !== 'undefined' && text !== null && text.length !== 0) {
            shortcode = shortcode + text;
        }


        shortcode = shortcode.replace(/el_uid *= *(['"])[^'"]*['"]/g, function(match, p1){
            return 'el_uid=' + p1 + window.vc_guid().replace('-', '') + p1;
        });

        if (tag.indexOf('[/') <= -1)
            shortcode = shortcode + '[/' + (tag.split(' ')[0]) + ']';

        return shortcode.replace(/\[(\/?trow|tcol|thcol|\/ideo_table)\]/gi, '<br/>\[$1\]');
    }
})(jQuery);