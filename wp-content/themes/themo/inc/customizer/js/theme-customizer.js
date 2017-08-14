(function ($) {
    "use strict";

    if (typeof window.parent.wp.customize.get()['data_refresh'] === 'undefined') { return; }


    var namespace = $.fn.ideo,
        customize = wp.customize,
        lastValue = '';

    namespace.previewUrl = window.parent.wp.customize.previewer.previewUrl();

    namespace.customizerPreview = function (newval, oldval) { 
        if (newval === "") return false;

        if(lastValue === newval) return false;
        
        lastValue = newval; 
        

        if (window.parent.wp.customize.get()['data_postMessage'] == '' && newval != '') {
            var json = JSON.stringify(newval);
            window.parent.wp.customize.instance('data_postMessage').set(json);
        };

        var settings = namespace.settings = {},
            custom_css = '';

        if (newval != '') {
            settings = namespace.settings = JSON.parse(newval);
        }

        if ($('#leftside-navbar').length) {
            custom_css += '@media(min-width:' + (parseInt(settings['ideo_theme_options[generals][layout][site_width]']) + 330 + 16) + 'px){#page-container .container{width:' + settings['ideo_theme_options[generals][layout][site_width]'] + 'px;}}';
        } else {
            custom_css += '@media(min-width:' + (parseInt(settings['ideo_theme_options[generals][layout][site_width]']) + 60) + 'px){#page-container .container, #header.customize-preview #header-navbar nav.navbar-standard.navbar-standard-width-container, #header.customize-preview #header-navbar nav.navbar-sticky.navbar-sticky-width-container{width:' + (parseInt(settings['ideo_theme_options[generals][layout][site_width]']) + 30) + 'px;} }';
        }

        namespace.setThemeSkin('body', settings['ideo_theme_options[generals][styling][theme_skin]']);

        var accentColor;

        if ('custom' === settings['ideo_theme_options[generals][styling][accent_color]']) {
            accentColor = namespace.isColor(settings['ideo_theme_options[generals][styling][custom_accent_color]'], settings['ideo_theme_options[generals][styling][accent_color]']);
        } else {
            accentColor = settings['ideo_theme_options[generals][styling][accent_color]'];
        }

        if (!namespace.hasLocalModyfication($('body'), 'generals.background.content_background_type')) {
            namespace.setContentBackground(settings);
        }

        if (namespace.getBool(settings['ideo_theme_options[generals][layout][boxed_version]']) || ($('body').hasClass('wrap-boxed') && !namespace.hasLocalModyfication($('body'), 'generals.background.boxed_background_type'))) {
            namespace.setBodyBackground(settings);
        }

        /*
         * ================================== SECTION FONTS ================================== 
         */

        namespace.setGlobalFontFamily(settings['ideo_theme_options[fonts][body_font_settings][body_font_family]']);

        namespace.setFontSize('body', settings['ideo_theme_options[fonts][body_font_settings][body_font_size]']);

        namespace.setFontWeight('body', settings['ideo_theme_options[fonts][body_font_settings][body_font_weight]']);

        namespace.setLineHeight('body', settings['ideo_theme_options[fonts][body_font_settings][body_line_height]']);
        
        namespace.setLetterSpacing('body', settings['ideo_theme_options[fonts][body_font_settings][body_letter_spacing]']);

        namespace.setFontSize('p', settings['ideo_theme_options[fonts][text_tag_settings][p_font_size]'], 'inherit');

        namespace.setFontFamily('p', settings['ideo_theme_options[fonts][text_tag_settings][p_font_family]']);

        namespace.setFontWeight('p', settings['ideo_theme_options[fonts][text_tag_settings][p_font_weight]']);

        namespace.setLineHeight('p', settings['ideo_theme_options[fonts][text_tag_settings][p_line_height]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][p_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][p_font_weight]']
        );

        namespace.setLetterSpacing('p', settings['ideo_theme_options[fonts][text_tag_settings][p_letter_spacing]']);

        namespace.setTextTransform('p', settings['ideo_theme_options[fonts][text_tag_settings][p_text_transform]']);

        $('a:not(.button)').css('fontStyle', settings['ideo_theme_options[fonts][text_tag_settings][link_font_style]']);

        namespace.setFontWeight('a', settings['ideo_theme_options[fonts][text_tag_settings][link_font_weight]']);

        namespace.setTextDecoration('a', settings['ideo_theme_options[fonts][text_tag_settings][link_text_decoration]']);

        namespace.setFontSize('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_font_size]']);

        namespace.setLineHeight('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_line_height]']);

        namespace.setFontFamily('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_font_family]']);

        namespace.setFontWeight('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_font_weight]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][h1_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][h1_font_weight]']
        );

        namespace.setLetterSpacing('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_letter_spacing]']);

        namespace.setTextTransform('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_text_transform]']);

        namespace.toggleFontStyle('h1', settings['ideo_theme_options[fonts][text_tag_settings][h1_italic]']);

        namespace.setFontSize('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_font_size]']);


        $('h2').css('lineHeight', settings['ideo_theme_options[fonts][text_tag_settings][h2_line_height]']);

        namespace.setLineHeight('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_line_height]']);

        namespace.setFontFamily('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_font_family]']);

        namespace.setFontWeight('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_font_weight]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][h2_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][h2_font_weight]']
        );

        namespace.setLetterSpacing('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_letter_spacing]']);

        namespace.setTextTransform('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_text_transform]']);

        namespace.toggleFontStyle('h2', settings['ideo_theme_options[fonts][text_tag_settings][h2_italic]']);

        namespace.setFontSize('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_font_size]']);

        namespace.setLineHeight('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_line_height]']);

        namespace.setFontFamily('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_font_family]']);

        namespace.setFontWeight('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_font_weight]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][h3_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][h3_font_weight]']
        );

        namespace.setLetterSpacing('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_letter_spacing]']);

        namespace.setTextTransform('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_text_transform]']);

        namespace.toggleFontStyle('h3', settings['ideo_theme_options[fonts][text_tag_settings][h3_italic]']);

        namespace.setFontSize('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_font_size]']);

        namespace.setLineHeight('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_line_height]']);

        namespace.setFontFamily('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_font_family]']);

        namespace.setFontWeight('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_font_weight]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][h4_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][h4_font_weight]']
        );

        namespace.setLetterSpacing('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_letter_spacing]']);

        namespace.setTextTransform('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_text_transform]']);

        namespace.toggleFontStyle('h4', settings['ideo_theme_options[fonts][text_tag_settings][h4_italic]']);

        namespace.setFontSize('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_font_size]']);

        namespace.setLineHeight('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_line_height]']);

        namespace.setFontFamily('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_font_family]']);        

        namespace.setFontWeight('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_font_weight]']);

        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][h5_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][h5_font_weight]']
        );
        
        namespace.setLetterSpacing('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_letter_spacing]']);

        namespace.setTextTransform('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_text_transform]']);

        namespace.toggleFontStyle('h5', settings['ideo_theme_options[fonts][text_tag_settings][h5_italic]']);

        namespace.setFontSize('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_font_size]']);

        namespace.setLineHeight('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_line_height]']);

        namespace.setFontFamily('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_font_family]']);

        namespace.setFontWeight('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_font_weight]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[fonts][text_tag_settings][h6_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[fonts][text_tag_settings][h6_font_weight]']
        );

        namespace.setLetterSpacing('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_letter_spacing]']);

        namespace.setTextTransform('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_text_transform]']);

        namespace.toggleFontStyle('h6', settings['ideo_theme_options[fonts][text_tag_settings][h6_italic]']);


        namespace.setFontFamily('body .button', settings['ideo_theme_options[shortcodes][button_font][button_font_family]']);

        namespace.setFontWeight('body .button', settings['ideo_theme_options[shortcodes][button_font][button_font_weight]']);
        
        namespace.appendFonts(
            settings['ideo_theme_options[shortcodes][button_font][button_font_family]'], 
            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
            settings['ideo_theme_options[shortcodes][button_font][button_font_weight]']
        );

        namespace.setLetterSpacing('body .button', settings['ideo_theme_options[shortcodes][button_font][button_letter_spacing]'] ? settings['ideo_theme_options[shortcodes][button_font][button_letter_spacing]'] : 'inherit');

        namespace.setTextTransform('body .button', settings['ideo_theme_options[shortcodes][button_font][button_text_transform]']);

        /*
         * ================================== FONT COLORING ================================== 
         */

        var skin = namespace.getBodyFontSkin();

        if (namespace.hasLocalModyfication($('body'), 'fonts.font_coloring.body_text_skin')) {
            skin = $('body').hasClass('font-dark') ? 'dark' : 'light';
        }

        namespace.toggleClass('body', false, 'font-light font-dark');
        namespace.toggleClass('body', true, 'font-' + skin);

        var selector = 'body.font-' + skin;

        namespace.setColor(selector + ' h1', settings['ideo_theme_options[fonts][font_coloring][' + skin + '][h1]']);
        namespace.setColor(selector + ' h2', settings['ideo_theme_options[fonts][font_coloring][' + skin + '][h2]']);
        namespace.setColor(selector + ' h3', settings['ideo_theme_options[fonts][font_coloring][' + skin + '][h3]']);
        namespace.setColor(selector + ' h4', settings['ideo_theme_options[fonts][font_coloring][' + skin + '][h4]']);
        namespace.setColor(selector + ' h5', settings['ideo_theme_options[fonts][font_coloring][' + skin + '][h5]']);
        namespace.setColor(selector + ' h6', settings['ideo_theme_options[fonts][font_coloring][' + skin + '][h6]']);
        namespace.setColor(selector, settings['ideo_theme_options[fonts][font_coloring][' + skin + '][paragraph]']);
        namespace.setColor(selector + ' a', namespace.getColorOrAccent(settings['ideo_theme_options[fonts][font_coloring][' + skin + '][link]']));

        var color = settings['ideo_theme_options[fonts][font_coloring][' + skin + '][link_hover]'];

        if (color) {
            namespace.setColor(selector + ' a:hover', color);
        } else {
            namespace.setColor(selector + ' a:hover', namespace.setColorDarken(namespace.getColorOrAccent(color)), 15);
        }

        /*
         * ================================== SECTION HEADER ================================== 
         */



        if ($('#header nav.navbar').hasClass('navbar-standard') && !namespace.hasLocalModyfication('#header', 'header.top.style')) {
            namespace.toggleClass('#header', false, 'colored-light colored-dark transparent-light transparent-dark');
            namespace.toggleClass('#header', true, namespace.getHeaderSkin('top', settings['ideo_theme_options[header][top][style]']));


        } else if ($('#header nav.navbar').hasClass('navbar-sticky') && !namespace.hasLocalModyfication('#header', 'header.sticky.style')) {
            namespace.toggleClass('#header', false, 'colored-light colored-dark transparent-light transparent-dark');
            namespace.toggleClass('#header', true, namespace.getHeaderSkin('sticky', settings['ideo_theme_options[header][sticky][style]']));

        }

        //NOTE HEADER TOP
        if (!namespace.hasLocalModyfication('#header', 'header.top.style'))
            _ideo.settings.header.top_class = namespace.getHeaderSkin('top', settings['ideo_theme_options[header][top][style]']);
        if (!namespace.hasLocalModyfication('#header', 'header.top.top_distance'))
            _ideo.settings.header.top_top_distance = settings['ideo_theme_options[header][top][top_distance]'];
        //NOTE HEADER STICKY
        if (!namespace.hasLocalModyfication('#header', 'header.sticky.style'))
            _ideo.settings.header.sticky_class = namespace.getHeaderSkin('sticky', settings['ideo_theme_options[header][sticky][style]']);

        if (!namespace.hasLocalModyfication('#header', 'header.sticky.top_distance'))
            _ideo.settings.header.sticky_top_distance = settings['ideo_theme_options[header][sticky][top_distance]'];
        _ideo.settings.header.amount_to_change = settings['ideo_theme_options[header][sticky][scroll_amount_input]'];

        if (!namespace.hasLocalModyfication('#header', 'header.top.logo.type'))
            _ideo.settings.header.top_logo = settings['ideo_theme_options[header][logo][' + settings['ideo_theme_options[header][top][logo][type]'] + ']'];

        if (!namespace.hasLocalModyfication('#header', 'header.sticky.logo.type') && settings['ideo_theme_options[header][sticky][logo][type]'])
            _ideo.settings.header.sticky_logo = settings['ideo_theme_options[header][logo][' + settings['ideo_theme_options[header][sticky][logo][type]'].replace('.', '][') + ']'];

        //NOTE TOP DISTANCE
        if ($(window).width() > 991) {


            if ($('#header-navbar.sticky_header, #header-navbar.sticky_slide_header').length) {
                custom_css += '@media(min-width: 992px){#header nav.navbar-standard{top:' + parseInt(settings['ideo_theme_options[header][top][top_distance]']) + 'px !important;}}';
            }


            if ($('#topbar').length && $('#header-navbar.sticky_header, #header-navbar.sticky_slide_header, #header-navbar.sticky_slide_hide_header').length) {

                custom_css += '@media(min-width: 992px){#header nav.navbar-standard{top:' + (parseInt(_ideo.settings.header.top_top_distance) + parseInt(settings['ideo_theme_options[header][top][topbar][height]'])) + 'px !important;}}';

            }

            if ($('#topbar').length == 0 && $('#header-navbar.sticky_header, #header-navbar.sticky_slide_header, #header-navbar.sticky_slide_hide_header').length) {

                custom_css += '@media(min-width: 992px){#header nav.navbar-standard{top:' + (parseInt(_ideo.settings.header.top_top_distance)) + 'px !important;}}';

            }


            if (!namespace.hasLocalModyfication('#header', 'header.sticky.top_distance'))
                namespace.setTop('#header nav.navbar-sticky', settings['ideo_theme_options[header][sticky][top_distance]'] + 'px !important');
        }


        // ALL HEADER HEIGHT RELATED

        var header_top_height = parseInt(settings['ideo_theme_options[header][top][height]']);
        var header_sticky_height = parseInt(settings['ideo_theme_options[header][sticky][height]']);
        var header_mobile_height = parseInt(settings['ideo_theme_options[header][mobile][height]']);
        var menu_font_size = parseInt(settings['ideo_theme_options[header][typography][main_menu][font_size]']);

        namespace.setFontSize('#header.customize-preview #header-navbar > .navbar .navbar-content .nav.navbar-nav.navbar-social > li', menu_font_size + 'px');

        namespace.setTop('#header-navbar.sticky_slide_header > nav.navbar-sticky.out', (_ideo.settings.header.sticky_top_distance + header_sticky_height) + 'px'); // menu.less:285
        namespace.setHeight('#header-navbar nav.navbar-standard', header_top_height + 'px'); // menu.less:394
        namespace.setHeight('#header-navbar nav.navbar-standard > div', header_top_height + 'px'); // menu.less:413
        namespace.setMargin('#header-navbar nav.navbar-standard .navbar-nav.navbar-social a i', ((header_top_height - 25) / 2) + 'px',
            false, ((header_top_height - 25) / 2) + 'px',
            false
        ); // menu.less:438
        namespace.setPadding('#header-navbar nav.navbar-standard .navbar-nav > li > a', ((header_top_height - menu_font_size) / 2) + 'px',
            false, ((header_top_height - menu_font_size) / 2) + 'px',
            false
        ); // menu.less:445
        namespace.setFontSize('#header-navbar nav.navbar-standard .navbar-social-modern a', Math.max(Math.min(header_top_height * 0.3, 45), 25) + 'px'); // menu.less:451
        namespace.setFontSize('#header-navbar nav.navbar-standard .navbar-form-modern input', Math.max(Math.min(header_top_height * 0.25, 30), 18) + 'px'); // menu.less:453
        namespace.setHeight('#header-navbar nav.navbar-sticky', header_sticky_height + 'px'); // menu.less:463
        namespace.setHeight('#header-navbar nav.navbar-sticky > div', header_sticky_height + 'px'); // menu.less:465
        namespace.setMargin('#header-navbar nav.navbar-sticky .navbar-nav.navbar-social a i', ((header_sticky_height - 25) / 2) + 'px',
            false, ((header_sticky_height - 25) / 2) + 'px',
            false
        ); // menu.less:522
        namespace.setPadding('#header-navbar nav.navbar-sticky .navbar-nav > li > a', ((header_sticky_height - menu_font_size) / 2) + 'px',
            false, ((header_sticky_height - menu_font_size) / 2) + 'px',
            false
        ); // menu.less:528
        namespace.setFontSize('#header-navbar nav.navbar-sticky .navbar-social-modern a', Math.max(Math.min(header_sticky_height * 0.3, 45), 25) + 'px'); // menu.less:534
        namespace.setFontSize('#header-navbar nav.navbar-sticky .navbar-form-modern input', Math.max(Math.min(header_sticky_height * 0.25, 30), 18) + 'px'); // menu.less:538
        namespace.setTop('#header-navbar nav .navbar-form', (10 + header_top_height) + 'px'); // menu.less:646
        namespace.setTop('#header-navbar nav.navbar-sticky .navbar-form', (10 + header_sticky_height) + 'px'); // menu.less:788

        // CUSTOM CSS

        // MIN-WIDTH 992px
        custom_css += '@media(min-width: 992px){';
        custom_css += '#header-navbar.navbar-hide-menu nav.navbar-standard .navbar-header .navbar-brand, #header-navbar.navbar-hide-menu nav.navbar-standard .navbar-collapse {' + namespace.translate(0, header_top_height + 'px') + '}'; // menu.less:334
        custom_css += '#header-navbar.navbar-hide-menu nav.navbar-sticky .navbar-header .navbar-brand, #header-navbar.navbar-hide-menu nav.navbar-sticky .navbar-collapse {' + namespace.translate(0, header_sticky_height + 'px') + '}'; // menu.less:342
        custom_css += '#header #header-navbar.header-sticky { height: ' + header_sticky_height + 'px }'; // menu.less:1648

        custom_css += '#header #header-navbar.hover-style2 .navbar-standard .navbar-nav > li:hover > a:after,'
        custom_css += '#header #header-navbar.hover-style2 .navbar-standard .navbar-nav > li.active > a:after,'
        custom_css += '#header #header-navbar.hover-style2 .navbar-standard .navbar-nav > li > a:hover:after{ bottom: ' + ((header_top_height - menu_font_size) / 2 - menu_font_size) + 'px }'; // menu.less:1705
        custom_css += '#header #header-navbar.hover-style2 .navbar-sticky .navbar-nav > li:hover > a:after,'
        custom_css += '#header #header-navbar.hover-style2 .navbar-sticky .navbar-nav > li.active > a:after,'
        custom_css += '#header #header-navbar.hover-style2 .navbar-sticky .navbar-nav > li > a:hover:after{ bottom: ' + ((header_sticky_height - menu_font_size) / 2 - menu_font_size) + 'px }'; // menu.less:1710

        var styles = ['colored-dark', 'colored-light', 'transparent-dark', 'transparent-light'];
        for (var i in styles) {
            if(styles.hasOwnProperty(i)){
                custom_css += '#header.' + styles[i] + ' #header-navbar > .navbar-standard .navbar-form { top: ' + (10 + header_top_height + parseInt(settings['ideo_theme_options[header][top_sticky][' + styles[i].replace('-', '][') + '][topbar][border_bottom_thickness]'])) + 'px }'; // menu.less:2159, 2560, 2961, 3362
                custom_css += '#header.' + styles[i] + ' #header-navbar > .navbar-sticky .navbar-form { top: ' + (10 + header_sticky_height + parseInt(settings['ideo_theme_options[header][top_sticky][' + styles[i].replace('-', '][') + '][border_bottom][thickness]'])) + 'px }'; // menu.less:2164, 2565, 2966, 3367
                custom_css += '#header.' + styles[i] + ' #header-navbar.header-sticky { height: ' + header_sticky_height + 'px }'; // menu.less:3625
                custom_css += '#header.' + styles[i] + ' #header-navbar.header-sticky > .navbar { height: ' + header_sticky_height + 'px; min-height: ' + header_sticky_height + 'px }'; // menu.less:3628, 3629
                custom_css += '#header.' + styles[i] + ' #header-navbar.header-sticky .navbar-form { top: ' + (10 + header_sticky_height) + 'px }'; // menu.less:3648
                custom_css += '#header.' + styles[i] + ' #header-navbar.header-sticky.hover-style4 .navbar-nav.navbar-menu > li > a:after { top: ' + ((header_sticky_height - menu_font_size) / 2 - menu_font_size) + 'px }'; // menu.less:3671
            }
        }
        custom_css += '}';

        // MAX-WIDTH 991px
        custom_css += '@media(max-width: 991px){';
        custom_css += '#header-navbar nav.navbar-standard { height: ' + header_mobile_height + 'px }'; // menu.less:396
        custom_css += 'body #header-navbar.mobile.skin-' + namespace.getHeaderSkin('mobile', settings['ideo_theme_options[header][mobile][header_skin]']) + ' .navbar-toggle { margin-top: ' + ((header_mobile_height - 34 - settings['ideo_theme_options[header][mobile][' + namespace.getHeaderSkin('mobile', settings['ideo_theme_options[header][mobile][header_skin]']) + '][styling][border_top_thickness]']) / 2) + 'px; margin-bottom: ' + ((header_mobile_height - 34 - settings['ideo_theme_options[header][mobile][' + namespace.getHeaderSkin('mobile', settings['ideo_theme_options[header][mobile][header_skin]']) + '][styling][border_top_thickness]']) / 2) + 'px }'; // menu.less:3970
        custom_css += '}';

        custom_css += '@media(max-width: 991px){';
        custom_css += ' #header-navbar nav.navbar-standard .navbar-header .navbar-brand{height:' + settings['ideo_theme_options[header][mobile][logo][height_in_mobile_menu]'] + 'px}';

        custom_css += '}';

        namespace.setPadding('#header.customize-preview #header-navbar nav.navbar-sticky .navbar-nav.navbar-social a', 0, 0, 0, 0);

        var top_style = (_ideo.settings.header.top_class + '').replace('-', '][');
        var sticky_style = (_ideo.settings.header.sticky_class + '').replace('-', '][');

        // Mobile header
        namespace.setHeaderLogo('mobile', settings);
        namespace.setMobileHeaderSkin(namespace.getHeaderSkin('mobile', settings['ideo_theme_options[header][mobile][header_skin]']))
        namespace.toggleClass('#header.customize-preview #header-navbar nav', false, 'mobile-search-bar-on mobile-search-bar-off mobile-social-media-on mobile-social-media-off');
        namespace.toggleClass('#header.customize-preview #header-navbar nav', true, ('mobile-search-bar-' + (settings['ideo_theme_options[header][mobile][search_bar]'] == 'true' ? 'on' : 'off')) + (' mobile-social-media-' + (settings['ideo_theme_options[header][mobile][social_media_icon]'] == 'true' ? 'on' : 'off')));
        namespace.toggleClass('#header.customize-preview #header-navbar nav', settings['ideo_theme_options[header][mobile][sticky]'], 'mobile-sticky');


        namespace.setMobileHeaderStyling(namespace.getHeaderSkin('mobile', settings['ideo_theme_options[header][mobile][header_skin]']),
            namespace.getMobileHeaderStylingSettings(settings, namespace.getHeaderSkin('mobile', settings['ideo_theme_options[header][mobile][header_skin]'])));

        namespace.setHeaderLogo('sticky', settings);

        namespace.setMargin('#header-navbar nav.navbar-standard .navbar-header', settings['ideo_theme_options[header][top][logo][margin][top]'], false, false, false);
        namespace.setMargin('#header-navbar nav.navbar-sticky .navbar-header', settings['ideo_theme_options[header][sticky][logo][margin][top]'], false, false, false);
        if ($(window).width() > 991 && !namespace.hasLocalModyfication('#header', 'header.top.top_distance')) {
            namespace.setPadding('#header.customize-preview #header-navbar', settings['ideo_theme_options[header][top][top_distance]'], false, false, false);
        }

        namespace.setHeight('#header-navbar nav.navbar-standard .navbar-header .navbar-brand', settings['ideo_theme_options[header][top][logo][height]']);
        namespace.setHeight('#header-navbar nav.navbar-sticky .navbar-header .navbar-brand', settings['ideo_theme_options[header][sticky][logo][height]']);

        /* HEADER WIDTH */
        var navStandardWidth = settings['ideo_theme_options[header][top][width]'] ? settings['ideo_theme_options[header][top][width]'] : 'full';
        namespace.toggleClass('#header nav', false, 'navbar-standard-width-container navbar-standard-width-custom navbar-standard-width-full');
        namespace.toggleClass('#header nav', true, 'navbar-standard-width-' + navStandardWidth);

        namespace.toggleClass('#header #topbar', false, 'container custom full');
        namespace.toggleClass('#header #topbar', true, navStandardWidth);

        namespace.setMaxWidth('.wrap-wide #header #topbar.custom', settings['ideo_theme_options[header][top][custom_width]']);
        namespace.setWidth('.wrap-wide #header #topbar.custom', 'auto','');
        if ($(window).width() > parseInt(settings['ideo_theme_options[generals][layout][site_width]'])) {
            namespace.setWidth('.wrap-boxed #header #topbar, .wrap-boxed #header-navbar.standard_header > nav, .wrap-boxed #header-navbar.sticky_header > nav, .wrap-boxed #header-navbar.sticky_slide_header > nav', settings['ideo_theme_options[generals][layout][site_width]']);
        }


        var navStickyWidth = settings['ideo_theme_options[header][sticky][width]'] ? settings['ideo_theme_options[header][sticky][width]'] : 'full_width';
        namespace.toggleClass('#header nav', false, 'navbar-sticky-width-container navbar-sticky-width-custom navbar-sticky-width-full_width');
        namespace.toggleClass('#header nav', true, 'navbar-sticky-width-' + navStickyWidth);

        _ideo.settings.generals.layout_site_width = settings['ideo_theme_options[generals][layout][site_width]'];
        _ideo.settings.header.top_width = settings['ideo_theme_options[header][top][width]'];
        _ideo.settings.header.top_custom_width = settings['ideo_theme_options[header][top][custom_width]'];
        _ideo.settings.header.sticky_width = settings['ideo_theme_options[header][sticky][width]'];
        _ideo.settings.header.sticky_custom_width = settings['ideo_theme_options[header][sticky][custom_width]'];


        var topbarHeight = settings['ideo_theme_options[header][top][topbar][enabled]'] == 'true' ? parseInt(settings['ideo_theme_options[header][top][topbar][height]']) : 0;
        var standardNavbarHeight = parseInt(settings['ideo_theme_options[header][top][height]']);
        var borderBottomHeight = parseInt(settings['ideo_theme_options[header][top_sticky][' + top_style + '][border_bottom][thickness]']) || 0;
        var standardNavbarTopDistance = parseInt(_ideo.settings.header.top_top_distance);

        var paddingTopPT = topbarHeight + standardNavbarHeight + borderBottomHeight + standardNavbarTopDistance;

        namespace.setPadding(
            '#header.customize-preview .page-title-container #header-navbar +  .container > .row, #header.customize-preview .page-title-container #header-navbar + .container-content > .row',
            paddingTopPT, false, false, false
        );

        if (settings['ideo_theme_options[header][top][width]'] == 'custom') {
            var top_custom_width = settings['ideo_theme_options[header][top][custom_width]'];            
            custom_css += '.wrap-wide #header.customize-preview #header-navbar nav.navbar-standard.navbar-static-top.navbar-standard-width-custom{width: 100%; }';
            custom_css += '@media (min-width: '+ top_custom_width +'px) {.wrap-wide #header.customize-preview #header-navbar nav.navbar-standard.navbar-static-top.navbar-standard-width-custom{width: '+ top_custom_width +'px;}}';
        }

        if (settings['ideo_theme_options[header][sticky][width]'] == 'custom') {            
            var sticky_custom_width = settings['ideo_theme_options[header][sticky][custom_width]'];            
            custom_css += '.wrap-wide #header.customize-preview #header-navbar.sticky_header nav.navbar-sticky.navbar-sticky-width-custom, .wrap-wide #header.customize-preview #header-navbar.sticky_slide_header nav.navbar-sticky.navbar-sticky-width-custom{width: 100%; }';
            custom_css += '@media (min-width: '+ sticky_custom_width +'px) {.wrap-wide #header.customize-preview #header-navbar.sticky_header nav.navbar-sticky.navbar-sticky-width-custom, .wrap-wide #header.customize-preview #header-navbar.sticky_slide_header nav.navbar-sticky.navbar-sticky-width-custom{width: '+ sticky_custom_width +'px;}}';

        }
        $.fn.centerNavMenu();

        /* PORTFOLIO */
        namespace.toggleVisibility('.single-portfolio #header .navigator-bar', settings['ideo_theme_options[portfolio][portfolio_standard_card][navigation]']);


        /* HEADER STANDARD HEIGHT */

        namespace.setMaxWidth('#header.customize-preview #header-navbar nav.navbar-standard .navbar-content, #header.customize-preview #topbar #topbar-content', parseInt(settings['ideo_theme_options[header][top][content_width]']) + 30);
        namespace.setMaxWidth('#header.customize-preview #header-navbar nav.navbar-sticky .navbar-content, #header.customize-preview #header-navbar nav.navbar-sticky-slide .navbar-content', settings['ideo_theme_options[header][sticky][content_width]']);


        namespace.setPadding('#header.customize-preview #header-navbar nav.navbar-standard .navbar-nav.navbar-social a', 0, 0, 0, 0);


        namespace.toggleClass('#header #header-navbar', false, 'hover-style1 hover-style2 hover-style3 hover-style4 hover-style5');
        namespace.toggleClass('#header #header-navbar', true, settings['ideo_theme_options[header][top][first_level_menu_hover_style]']);

        namespace.toggleClass('#header #header-navbar', false, 'dropdown-slide dropdown-fade dropdown-slide-up dropdown-rotate');
        namespace.toggleClass('#header #header-navbar', true, settings['ideo_theme_options[header][top][dropdown_animation]']);

        namespace.setHeaderLogo('top', settings);

        if ($('#topbar').length && $(window).width() > 991) {
            namespace.setHeight('#header #topbar', settings['ideo_theme_options[header][top][topbar][height]']);
        }

        namespace.toggleClass('#header #topbar', true, 'hidden-xs hidden-sm');

        if (settings['ideo_theme_options[header][top][topbar_mobile]'] == "true") {
            namespace.toggleClass('#header #topbar', false, 'hidden-xs hidden-sm');
        }

        namespace.setBackgroundColor('#header.customize-preview #header-navbar .navbar-form button', accentColor);

        /* HEADER SIDE */

        namespace.setHeaderLogo('side', settings);
        namespace.setHeight('#header.customize-preview #leftside-navbar .navbar-header .navbar-brand', settings['ideo_theme_options[header][side][logo][height]']);
        namespace.setHeight('#header.customize-preview #leftside-navbar .navbar-header .navbar-brand img', settings['ideo_theme_options[header][side][logo][height]']);
        namespace.setMargin('#header.customize-preview #leftside-navbar .navbar-header .brand', settings['ideo_theme_options[header][side][logo][margin_top]'], false, settings['ideo_theme_options[header][side][logo][margin_bottom]'], settings['ideo_theme_options[header][side][logo][margin_left]']);

        var headerType = settings['ideo_theme_options[header][type]'];

        if (namespace.hasLocalModyfication('#header', 'header.type')) {
            headerType = namespace.getAttribute('#header', 'data-header-type');
        }

        if (headerType == 'side_header' || headerType == 'side_left_header' || headerType == 'side_right_header' ||
            headerType == 'side_offcanvas_header' || headerType == 'side_offcanvas_left_header' || headerType == 'side_offcanvas_right_header') {
            var skin = namespace.getHeaderSkin('side', settings['ideo_theme_options[header][side][style]']);

            if(headerType == 'side_left_header' || headerType == 'side_offcanvas_left_header'){
                namespace.toggleClass('body', false, 'side-right');
                namespace.toggleClass('body', true, 'side-left');
            }
            if(headerType == 'side_right_header' || headerType == 'side_offcanvas_right_header'){
                namespace.toggleClass('body', false, 'side-left');
                namespace.toggleClass('body', true, 'side-right');
            }

            if (namespace.hasLocalModyfication('#header', 'header.side.style'))
                skin = namespace.hasSkin('#leftside-navbar', 'dark') ? 'dark' : 'light';

            namespace.toggleClass('#header.customize-preview #leftside-navbar', false, 'skin-light skin-dark');
            namespace.toggleClass('#header.customize-preview #leftside-navbar', true, 'skin-' + skin);

            if (!namespace.hasLocalModyfication('#header', 'header.side.align.menu')) {
                namespace.toggleClass('#header.customize-preview #leftside-navbar', false, 'menu-left menu-right menu-center');
                namespace.toggleClass('#header.customize-preview #leftside-navbar', true, 'menu-' + settings['ideo_theme_options[header][side][align][menu]']);
            }

            if (!namespace.hasLocalModyfication('#header', 'header.side.align.bottom_area')) {
                namespace.toggleClass('#header.customize-preview #leftside-navbar', false, 'bottom-left bottom-right bottom-center');
                namespace.toggleClass('#header.customize-preview #leftside-navbar', true, 'bottom-' + settings['ideo_theme_options[header][side][align][bottom_area]']);
            }

            if (!namespace.hasLocalModyfication($('#header'), 'header.side.offcanvas.topbar.transparent')) {
                namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', settings['ideo_theme_options[header][side][offcanvas][topbar][transparent]'], 'transparent');
            }

           
            var offcanvas_site_style = settings['ideo_theme_options[header][side][style]'] || settings['ideo_theme_options[generals][styling][theme_skin]'];

            if (!namespace.hasLocalModyfication($('#header'), 'header.side.offcanvas.topbar.style')) {
                namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', false, 'light dark');
                var offcanvas_topbar_style = _ideo.settings.header.offcanvas_topbar_style = (settings['ideo_theme_options[header][side][offcanvas][topbar][style]'] || settings['ideo_theme_options[generals][styling][theme_skin]']);
                
                namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_topbar_style + '][styling][bar][background_color]']);
                namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar .hamburger .hamburger-inner, #header.customize-preview  .side-header-offcanvas-topbar .hamburger .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar .hamburger .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_topbar_style + '][styling][menu_icon]']);
                namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar .hamburger:hover .hamburger-inner, #header.customize-preview .side-header-offcanvas-topbar .hamburger:hover .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar .hamburger:hover .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_topbar_style + '][styling][menu_icon_hover]']);
                namespace.setColor('#header.customize-preview .side-header-offcanvas-topbar .side-header-offcanvas-page-title', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_topbar_style + '][styling][pagetitle]']);
            
            }
            if (!namespace.hasLocalModyfication($('#header'), 'header.side.offcanvas.stickybar.style')) {
                namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', false, 'light dark');
                var offcanvas_stickybar_style = _ideo.settings.header.offcanvas_stickybar_style = (settings['ideo_theme_options[header][side][offcanvas][stickybar][style]'] || settings['ideo_theme_options[generals][styling][theme_skin]']);
               
                namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar.sticky .hamburger .hamburger-inner, #header.customize-preview .side-header-offcanvas-topbar.sticky .hamburger .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar.sticky .hamburger .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_stickybar_style + '][styling][menu_icon]']);
                namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar.sticky .hamburger:hover .hamburger-inner, #header.customize-preview .side-header-offcanvas-topbar.sticky .hamburger:hover .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar.sticky .hamburger:hover .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_stickybar_style + '][styling][menu_icon_hover]']);
                namespace.setColor('#header.customize-preview .side-header-offcanvas-topbar.sticky .side-header-offcanvas-page-title', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_stickybar_style + '][styling][pagetitle]']);
                namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar.sticky', settings['ideo_theme_options[header][side][offcanvas][' + offcanvas_stickybar_style + '][styling][bar][background_color]']);
            }

            _ideo.settings.header.offcanvas_topbar_height = settings['ideo_theme_options[header][side][offcanvas][topbar][height]'];
            _ideo.settings.header.offcanvas_stickybar_height = settings['ideo_theme_options[header][side][offcanvas][stickybar][height]'];
            _ideo.settings.header.offcanvas_topbar_logo_height = settings['ideo_theme_options[header][side][offcanvas][topbar][logo][height]'];
            _ideo.settings.header.offcanvas_stickybar_logo_height = settings['ideo_theme_options[header][side][offcanvas][stickybar][logo][height]'];
           
            namespace.setHtml('body.home #header.customize-preview .side-header-offcanvas-page-title', namespace.normalizeText(settings['ideo_theme_options[header][side][offcanvas][pagetitle][text]'], true));
            namespace.toggleClass('#header.customize-preview .side-header-offcanvas-page-title', (settings['ideo_theme_options[header][side][offcanvas][pagetitle][enabled]'] == 'false'), 'hidden');

            namespace.setHeight('#header.customize-preview .side-header-offcanvas-logo img', settings['ideo_theme_options[header][side][offcanvas][topbar][logo][height]'], 'px');
            namespace.setHeight('#header.customize-preview .side-header-offcanvas-topbar.sticky .side-header-offcanvas-logo img, #header.customize-preview .side-header-offcanvas-topbar.stickybar .side-header-offcanvas-logo img', settings['ideo_theme_options[header][side][offcanvas][stickybar][logo][height]'], 'px');
           
           
            if($('#header.customize-preview .side-header-offcanvas-topbar').hasClass('sticky') || $('#header.customize-preview .side-header-offcanvas-topbar').hasClass('stickybar')){      
                if (!namespace.hasLocalModyfication($('#header'), 'header.side.offcanvas.stickybar.style')) {         
                    namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', true, offcanvas_stickybar_style);                
                }else{
                    namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', true, _ideo.settings.header.offcanvas_stickybar_style);                
                }
                namespace.setOffcanvasBarLogo('stickybar', settings);
                
            }else{      
                if (!namespace.hasLocalModyfication($('#header'), 'header.side.offcanvas.topbar.style')) {         
                    namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', true, offcanvas_topbar_style);                
                }else{
                    namespace.toggleClass('#header.customize-preview .side-header-offcanvas-topbar', true, _ideo.settings.header.offcanvas_topbar_style);                
                }              
                namespace.setOffcanvasBarLogo('topbar', settings);
            }

            namespace.setOffcanvasBarLogoData('stickybar', settings);
            namespace.setOffcanvasBarLogoData('topbar', settings);

            namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.light:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][light][styling][bar][background_color]']);
            namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.dark:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][dark][styling][bar][background_color]']);
            
           

            namespace.setBorderColor('#header.customize-preview .side-header-offcanvas-topbar.light:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][light][styling][bar][border_bottom_color]']);
            namespace.setBorderWidth('#header.customize-preview .side-header-offcanvas-topbar.light:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][light][styling][bar][border_bottom_thickness]'], {
                        bottom: true
                    });
            namespace.setBorderColor('#header.customize-preview .side-header-offcanvas-topbar.dark:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][dark][styling][bar][border_bottom_color]']);
            namespace.setBorderWidth('#header.customize-preview .side-header-offcanvas-topbar.dark:not(.transparent)', settings['ideo_theme_options[header][side][offcanvas][dark][styling][bar][border_bottom_thickness]'], {
                        bottom: true
                    });


            namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.light .hamburger .hamburger-inner, #header.customize-preview  .side-header-offcanvas-topbar-sticky.light .hamburger .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar-sticky.light .hamburger .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][light][styling][menu_icon]']);
            namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.dark .hamburger .hamburger-inner, #header.customize-preview  .side-header-offcanvas-topbar-sticky.dark .hamburger .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar-sticky.dark .hamburger .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][dark][styling][menu_icon]']);
            
            

            namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.light .hamburger:hover .hamburger-inner, #header.customize-preview .side-header-offcanvas-topbar-sticky.light .hamburger:hover .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar-sticky.light .hamburger:hover .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][light][styling][menu_icon_hover]']);
            namespace.setBackgroundColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.dark .hamburger:hover .hamburger-inner, #header.customize-preview .side-header-offcanvas-topbar-sticky.dark .hamburger:hover .hamburger-inner:after, #header.customize-preview .side-header-offcanvas-topbar-sticky.dark .hamburger:hover .hamburger-inner:before', settings['ideo_theme_options[header][side][offcanvas][dark][styling][menu_icon_hover]']);
            
           

            namespace.setBackgroundColor('body.side-header #header.customize-preview .side-header-offcanvas-overlay.light', settings['ideo_theme_options[header][side][offcanvas][light][styling][overlay]']);
            namespace.setBackgroundColor('body.side-header #header.customize-preview .side-header-offcanvas-overlay.dark', settings['ideo_theme_options[header][side][offcanvas][dark][styling][overlay]']);

            namespace.setColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.light .side-header-offcanvas-page-title', settings['ideo_theme_options[header][side][offcanvas][light][styling][pagetitle]']);
            namespace.setColor('#header.customize-preview .side-header-offcanvas-topbar-sticky.dark .side-header-offcanvas-page-title', settings['ideo_theme_options[header][side][offcanvas][dark][styling][pagetitle]']);
            

            custom_css += 'body.side-offcanvas-header #header .page-title-container > .container > .row, body.side-offcanvas-header #header .page-title-container > .container-content > .row{padding-top: '+settings['ideo_theme_options[header][side][offcanvas][topbar][height]']+'px !important;}';  
            

            namespace.toggleClass('#header.customize-preview .hamburger', false, 'hamburger--elastic hamburger--slider hamburger--spin hamburger--squeeze hamburger--vortex hamburger--spring');
            
            namespace.toggleClass('#header.customize-preview .hamburger', true, 'hamburger--' + settings['ideo_theme_options[header][side][offcanvas][icon_style]']);
            
            namespace.toggleClass('#header.customize-preview .hamburger', false, 'hamburger--small hamburger--medium hamburger--large');
            namespace.toggleClass('#header.customize-preview .hamburger', true, 'hamburger--' + settings['ideo_theme_options[header][side][offcanvas][icon_size]']);

            namespace.toggleClass('#header.customize-preview .side-header-offcanvas-overlay', false, 'icon-small icon-medium icon-large');
            namespace.toggleClass('#header.customize-preview .side-header-offcanvas-overlay', true, 'icon-' + settings['ideo_theme_options[header][side][offcanvas][icon_size]']);
            
            // var offcanvas_logo_type = settings['ideo_theme_options[header][side][offcanvas][topbar][logo][type]'];
            // namespace.toggleVisibility('#header.customize-preview .side-header-offcanvas-logo', offcanvas_logo_type != 'none' );
            
            //namespace.setHeight('#header.customize-preview .side-header-offcanvas-logo img', settings['ideo_theme_options[header][side][offcanvas][logo][height]'], 'px');
            
            //$('#header.customize-preview .side-header-offcanvas-logo img').attr('src',settings['ideo_theme_options[header][logo]['+offcanvas_logo_type+']']);

            namespace.setHeight('#header.customize-preview .side-header-offcanvas-topbar-hide, #header.customize-preview .side-header-offcanvas-topbar-sticky, #header.customize-preview .side-header-offcanvas-topbar-hide-slide', settings['ideo_theme_options[header][side][offcanvas][topbar][height]']);  
            namespace.setHeight('#header.customize-preview .side-header-offcanvas-topbar-sticky.stickybar, #header.customize-preview .side-header-offcanvas-topbar-hide-slide.sticky', settings['ideo_theme_options[header][side][offcanvas][stickybar][height]']);  
           

            namespace.toggleClass('body', settings['ideo_theme_options[header][side][offcanvas][slide]'] == 'true', 'slide-content');            
            namespace.toggleClass('body', settings['ideo_theme_options[header][side][offcanvas][blur_content]'] == 'true', 'blur-content');  
            var blur_strength = parseInt(settings['ideo_theme_options[header][side][offcanvas][blur_strength]']);
            custom_css += "body.side-header.side-offcanvas-header-open.blur-content .page-title-container > .container, body.side-header.side-offcanvas-header-open.blur-content .page-title-container > .container-content,body.side-header.side-offcanvas-header-open.blur-content #content{-ms-filter: blur(" + blur_strength + "px); -webkit-filter: blur(" + blur_strength + "px); filter: blur(" + blur_strength + "px);}";
            
            namespace.toggleClass('#header.customize-preview #leftside-navbar', settings['ideo_theme_options[header][side][search_form]'] == 'false', 'side-search-off');
            namespace.setBackgroundColor('#header.customize-preview #leftside-navbar .navbar-menu > li > .dropmenu ul', settings['ideo_theme_options[header][side][' + skin + '][styling][dropdown_menu_background_color]']);

            namespace.toggleClass('#header.customize-preview #header-navbar', true, 'skin-' + skin);
            namespace.setHtml('#header.customize-preview #leftside-navbar .copyright', namespace.normalizeText(settings['ideo_theme_options[header][side][copyright]'], true));
        } else {
            namespace.toggleClass('body', false, 'side-left side-right');
        }

        /*
         * ================================== SECTION HEADER STYLING ================================== 
         */

        if (headerType == 'standard_header' || headerType == 'sticky_slide_hide_header' || headerType == 'sticky_header' || headerType == 'sticky_slide_header') {
            var skins = [_ideo.settings.header.top_class, _ideo.settings.header.sticky_class];
            var selectors = ['#header.customize-preview.' + skins[0] + ' #header-navbar > .navbar-standard', '#header.customize-preview.' + skins[1] + ' #header-navbar > .navbar-sticky'];

            namespace.toggleClass('#header.customize-preview', false, 'menu-left menu-center menu-right');
            namespace.toggleClass('#header.customize-preview', true, 'menu-' + settings['ideo_theme_options[header][top][align][menu]']);

            for (x in selectors) {
                var selector = selectors[x];
                var skin = skins[x];

                if (skin == 'colored-light') {
                    skin = '[colored][light]';
                } else if (skin == 'colored-dark') {
                    skin = '[colored][dark]';
                } else if (skin == 'transparent-light') {
                    skin = '[transparent][light]';
                } else if (skin == 'transparent-dark') {
                    skin = '[transparent][dark]';
                }

                // loading effect-1 scroll line height
                if (x == 1) {
                    var scrollHeight = parseInt(settings['ideo_theme_options[header][top_sticky]' + skin + '[border_bottom][thickness]'] || 0);
                    namespace.setHeight('#header.' + skins[x] + ' #header-navbar.loading-effect-1 #scroll-line', scrollHeight, 'px');
                    namespace.setBottom('#header.' + skins[x] + ' #header-navbar.loading-effect-1 #scroll-line', -scrollHeight, 'px');
                }

                //header_background_color
                namespace.setBackgroundColor(selector, settings['ideo_theme_options[header][top_sticky]' + skin + '[background_color]']);

                //header_border_bottom_thickness
                namespace.setHeight(selector + ':after', parseInt(settings['ideo_theme_options[header][top_sticky]' + skin + '[border_bottom][thickness]'] || 0), 'px');
                namespace.setPositionValue(selector + ':after', false, false, (0 - parseInt(settings['ideo_theme_options[header][top_sticky]' + skin + '[border_bottom][thickness]']) || 0), false);

                //header_bottom_border_color
                namespace.setBackgroundColor(selector + ':after', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[border_bottom][color]']));

                //first_level_menu_text_color
                namespace.setColor(selector + ',' + selector + ' .navbar-nav > li > a', settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][color]']);

                //first_level_menu_text_hover_color
                var hoverStyle = settings['ideo_theme_options[header][top][first_level_menu_hover_style]'];
                namespace.setColor(selector + ' .navbar-nav > li.navbar-normal > a:hover,' + selector + '.' + hoverStyle + ' .navbar-nav > li.navbar-normal:hover > a,' + selector + '.' + hoverStyle + ' .navbar-nav > li.navbar-normal.active > a,' + selector + '.' + hoverStyle + ' .modern-bars-content a:hover', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][hover_color]']));
                namespace.setColor('#header.customize-preview.' + skins[x] + ' #header-navbar.' + hoverStyle + ' .navbar-nav li:hover a, #header.customize-preview.' + skins[x] + ' #header-navbar.' + hoverStyle + ' .navbar-nav li.active a', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][hover_color]']));

                namespace.setPadding(
                    '#header.' + skins[x] + ' #header-navbar > .navbar-standard .navbar-nav > li.navbar-megamenu > .dropmenu,' +
                    '#header.' + skins[x] + ' #header-navbar > .navbar-sticky .navbar-nav > li.navbar-megamenu > .dropmenu,' +
                    '#header.' + skins[x] + ' #header-navbar > .navbar-standard .navbar-nav > li.navbar-normal > .dropmenu,' +
                    '#header.' + skins[x] + ' #header-navbar > .navbar-sticky .navbar-nav > li.navbar-normal > .dropmenu',
                    settings['ideo_theme_options[header][top_sticky]' + skin + '[border_bottom][thickness]'], false, false, false
                );


                //hover_style_2_and_3_border_color
                for (var i = 2; i <= 3; i++) {
                    namespace.setBackgroundColor('#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' > #active-line,#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' .navbar-menu > li:not(.active) > a:after,#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' .navbar-menu > li:not(.active):hover > a:after,#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' .navbar-menu > li.active > a:after,#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' .navbar-menu > li.active:hover > a:after', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[hover_border_color]'], skin == '[transparent][light]' ? 0.6 : 1));

                }
                //hover_style_4_background_color
                for (var i = 4; i <= 5; i++) {
                    namespace.setBackgroundColor('#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' .navbar-nav.navbar-menu > li.active > a::after,#header.customize-preview.' + skins[x] + ' #header-navbar.hover-style' + i + ' .navbar-nav.navbar-menu > li:hover:not(.active) > a::after', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[hover_background_color]'], skin == '[transparent][light]' ? 0.6 : 0.1));
                }

                if ((headerType == 'sticky_header' || headerType == 'sticky_slide_header') && !namespace.hasLocalModyfication('#header', 'header.sticky.loading_effect')) {
                    namespace.toggleClass('#header.customize-preview #header-navbar', false, 'loading-effect-1 loading-effect-2');
                    namespace.toggleClass('#header.customize-preview #header-navbar', true, settings['ideo_theme_options[header][sticky][loading_effect]']);
                }

                //search_and_language_icon_color
                namespace.setColor(selector + ' .navbar-nav.navbar-social a', settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_color]']);
                namespace.setColor(selector + ' .navbar-nav.navbar-social a i', namespace.changeAlphaInRGBA(settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_color]'], 0.2));

                namespace.setBorderColor(selector + ' .navbar-nav.navbar-social a i', namespace.hexToRGBA(settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_color]'], 0.2));


                //search_and_language_icon_hover_color
                namespace.setColor(selector + ' .navbar-nav.navbar-social a:hover i', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_hover_color]']));

                //loading_effect_1_color
                namespace.setBackgroundColor('#header.customize-preview.' + skins[x] + ' #header-navbar.loading-effect-1 .navbar-sticky #scroll-line', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[loading_effect1_color]'], null, 20));

                //loading_effect_2_color
                namespace.setBackgroundColor('#header.customize-preview.' + skins[x] + ' #header-navbar.loading-effect-2 .navbar-sticky #scroll-line',
                    skin == '[colored][light]' ? namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[loading_effect2_color]'], 0.2) : settings['ideo_theme_options[header][top_sticky]' + skin + '[loading_effect2_color]']);

                //SUB & MEGA MENU STYLING
                //background_color
                namespace.setBackgroundColor(selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul,' + selector + ' .navbar-megamenu > .dropmenu > ul', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][background][color]']);
                namespace.setBackgroundColor(selector + ' .navbar-form', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][background][color]']);
                namespace.setBorderColor(selector + ' .navbar-form:after', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][background][color]'], {
                    bottom: true
                });

                //background_image_overlay_color_mega
                namespace.setBackgroundColor(selector + ' .navbar-megamenu > .dropmenu.overlay:before,' + selector + ' .navbar-megamenu > .dropmenu > ul > li.overlay:before', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][background_image][overlay_color]']);

                //hover_background_color
                if ($(window).width() > 991) {

                    namespace.setBackgroundColor(selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li:hover > a,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li a:hover,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li > ul:hover a,' + selector + ' .navbar-nav .navbar-megamenu > .dropmenu > ul > li ul > li a:hover', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][hover_color]']) + '!important');
                }

                //column_title_color_mega
                namespace.setColor(selector + ' .navbar-megamenu > .dropmenu > ul > li > a', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][column_title_color]']));

                //column_title_border_color_mega
                namespace.setBorderColor(selector + ' .navbar-megamenu > .dropmenu > ul > li > a', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][column_title][border_color]']), {
                    bottom: true
                });

                //text_and_icon_color
                namespace.setColor(selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li a,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li > ul li a,' + selector + ' .navbar-megamenu > .dropmenu > ul > li ul > li a', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][text_icon][color]']);

                //text_icon_hover_color
                namespace.setColor(selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li:hover > a,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li a:hover,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li > ul li a:hover,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li > ul li:hover a,' + selector + ' .navbar-megamenu > .dropmenu > ul > li ul > li a:hover', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][text_icon][hover_color]']);

                //horizontal_separators_color

                namespace.setBorderColor(selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li + li a,' + selector + ' .navbar-nav > li.navbar-normal .dropmenu > ul > li > ul li + li a', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][separators_color][horizontal]'], {
                    top: true
                });
                namespace.setBorderColor(selector + ' .navbar-megamenu > .dropmenu > ul > li,' + selector + ' .navbar-megamenu > .dropmenu > ul > li ul > li a', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][separators_color][horizontal]'], {
                    bottom: true,
                });

                //vertical_separators_color_mega
                namespace.setBorderColor(selector + ' .navbar-megamenu > .dropmenu > ul > li', settings['ideo_theme_options[header][top_sticky]' + skin + '[mega_menu_sub_level][separators_color][vertical]'], {
                    left: true
                });

                //first_level_menu_text_color
                namespace.setColor(selector + ' .navbar-form-modern input', settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][color]']);
                namespace.setColor(selector + ' .navbar-form-modern input.form-control::-webkit-input-placeholder', settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][color]']);
                namespace.setColor(selector + ' .navbar-form-modern input.form-control:-moz-placeholder', settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][color]']);
                namespace.setColor(selector + ' .navbar-form-modern input.form-control::-moz-placeholder', settings['ideo_theme_options[header][top_sticky]' + skin + '[first_level_menu_text][color]']);

                //search_and_language_icon_color
                namespace.setColor(selector + ' .modern-bars-content .modern-bar a.close', settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_color]']);
                namespace.setColor(selector + ' .modern-bars-content .modern-bar a.close:hover', settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_hover_color]']);
                namespace.setColor(selector + ' .social a', settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_color]']);
                namespace.setColor(selector + ' .social a:hover', settings['ideo_theme_options[header][top_sticky]' + skin + '[search_language_icon_hover_color]']);

                if (x == 0) {
                    //background
                    namespace.setBackgroundColor('#header.customize-preview.' + skins[0] + ' #header-navbar #topbar', settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][background]']);

                    //text color
                    namespace.setColor('#header.customize-preview.' + skins[0] + ' #header-navbar #topbar', settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][text]']);

                    //border_top_thickness
                    namespace.setBorderWidth('#header.customize-preview.' + skins[0] + ' #header-navbar #topbar', settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_top_thickness]'], {
                        top: true
                    });

                    //border_top_color
                    namespace.setBorderColor('#header.customize-preview.' + skins[0] + ' #header-navbar #topbar', namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_top_color]']), {
                        top: true
                    });

                    //border_bottom_thickness
                    namespace.setBorderWidth('#header.customize-preview.' + skins[0] + ' #header-navbar #topbar', settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_bottom_thickness]'], {
                        bottom: true
                    });

                    //border_bottom_color
                    namespace.setBorderColor('#header.customize-preview.' + skins[0] + ' #header-navbar #topbar',
                        skin == '[colored][light]' ? namespace.getColorOrAccent(settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_bottom_color]']) : settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_bottom_color]'], {
                            bottom: true
                        });


                    if ($('#topbar').length && $(window).width() > 991) {
                        namespace.setHeight('#header #topbar .topbar-widget', parseInt(settings['ideo_theme_options[header][top][topbar][height]']) - parseInt(settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_top_thickness]']) - parseInt(settings['ideo_theme_options[header][top_sticky]' + skin + '[topbar][border_bottom_thickness]']));
                    }


                }
            }
        }

        /*
         * ================================== SECTION HEADER TYPOGRAPHY ================================== 
         */

        var skins = ['colored-dark', 'colored-light', 'transparent-dark', 'transparent-light', 'skin-dark', 'skin-light']

        var sections = [
            {
                name: 'main_menu',
                selector: ' #header-navbar .navbar-nav > li > a'
            },
            {
                name: 'main_menu',
                selector: ' #header-navbar nav .navbar-nav.navbar-social'
            },
            {
                name: 'submenu',
                selector: ' #header-navbar .navbar-nav > li.navbar-normal .dropmenu > ul > li a'
            },
            {
                name: 'mega_menu',
                selector: ' #header-navbar .navbar-megamenu > .dropmenu > ul > li ul > li a'
            },
            {
                name: 'mega_menu_column_title',
                selector: ' #header-navbar .navbar-megamenu > .dropmenu > ul > li > a'
            },
            {
                name: 'side_menu',
                selector: ' ul.navbar-menu > li > a'
            },
            {
                name: 'side_menu_submenu',
                selector: ' ul.navbar-menu > li > .dropmenu ul li a'
            },
            {
                name: 'mobile_menu',
                selector: ' #header-navbar.mobile .navbar-standard .navbar-nav li a'
            },
            {
                name: 'mobile_menu',
                selector: ' #header-navbar.mobile .navbar-standard .navbar-nav > li.navbar-normal .dropmenu > ul > li a'
            }
        ]

        for (var y in skins) {
            if(skins.hasOwnProperty(y)){
                var skin = skins[y];

                for (var x in sections) {
                    if(sections.hasOwnProperty(x)){
                        var section = sections[x];

                        if (section.name == 'side_menu' || section.name == 'side_menu_submenu')
                            var selector = 'body.side-header #header.customize-preview nav#leftside-navbar.' + skin + section.selector;
                        else
                            var selector = '#header.customize-preview.' + skin + section.selector;

                        if ((skin != 'skin-dark' && skin != 'skin-light') && (section.name == 'side_menu' || section.name == 'side_menu_submenu'))
                            continue;

                        if ((skin == 'skin-dark' || skin == 'skin-light') && (section.name != 'side_menu' && section.name != 'side_menu_submenu'))
                            continue;

                        namespace.setFontSize(selector, settings['ideo_theme_options[header][typography][' + section.name + '][font_size]']);

                        if (section.name != 'main_menu') {
                            namespace.setLineHeight(selector, settings['ideo_theme_options[header][typography][' + section.name + '][line_height]']);
                        }

                        namespace.setFontFamily(selector, settings['ideo_theme_options[header][typography][' + section.name + '][font_family]']);
                        namespace.setFontWeight(selector, settings['ideo_theme_options[header][typography][' + section.name + '][font_weight]']);
                        namespace.setLetterSpacing(selector, settings['ideo_theme_options[header][typography][' + section.name + '][letter_spacing]']);
                        namespace.setTextTransform(selector, settings['ideo_theme_options[header][typography][' + section.name + '][text_transform]']);
                        
                        namespace.appendFonts(
                            settings['ideo_theme_options[header][typography][' + section.name + '][font_family]'], 
                            settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
                            settings['ideo_theme_options[header][typography][' + section.name + '][font_weight]']
                        );

                        custom_css += selector + ' { font-style: ' + namespace.stripGoogleFontsVariant(settings['ideo_theme_options[header][typography][' + section.name + '][font_weight]'])['font-style'] + '!important; }';
                    }
                }
            }
        }

        /*
         * ================================== SECTION SIDE HEADER STYLING ================================== 
         */

        var skin = namespace.getHeaderSkin('side', settings['ideo_theme_options[header][side][style]']);
        

        if (namespace.hasLocalModyfication('#header', 'header.side.style'))
            skin = namespace.hasSkin('#header', 'dark') ? 'dark' : 'light';

        var selector = '#header.customize-preview #leftside-navbar.skin-' + skin;


        namespace.setSideHeaderBackground(settings);

        namespace.setColor(selector + ' ul:not(.social) li a', settings['ideo_theme_options[header][side][' + skin + '][styling][menu_text_color]']);
        namespace.setColor(selector + ' ul:not(.social) li a:hover,' + selector + ' ul li.active > a,' + selector + ' .current-menu-parent > a,' + selector + ' .current-menu-ancestor > a', namespace.getColorOrAccent(settings['ideo_theme_options[header][side][' + skin + '][styling][menu_text_hover_color]']));
        namespace.setBorderLeftColor(selector + ' footer .lang-switch li + li', settings['ideo_theme_options[header][side][' + skin + '][styling][menu_text_color]']);

        namespace.setBorderTopColor(selector + ' .navbar-menu li a,' + selector + ' .navbar-menu a', settings['ideo_theme_options[header][side][' + skin + '][styling][separators_color]']);
        namespace.setBorderBottomColor(selector + ' .navbar-menu li:last-child a,' + selector + ' .navbar-menu a', settings['ideo_theme_options[header][side][' + skin + '][styling][separators_color]']);

        namespace.setBackgroundColor(selector + ' .navbar-header .search-form', settings['ideo_theme_options[header][side][' + skin + '][styling][search_input_color]']);
        namespace.setColor(selector + ' .navbar-header .search-form input,' + selector + ' .navbar-header .search-form button', settings['ideo_theme_options[header][side][' + skin + '][styling][search_text_color]']);
        namespace.setColor(selector + ' .navbar-header .search-form input::-webkit-input-placeholder,' + selector + ' .navbar-header .search-form button', settings['ideo_theme_options[header][side][' + skin + '][styling][search_text_color]']);
        namespace.setColor(selector + ' .navbar-header .search-form input:-moz-placeholder,' + selector + ' .navbar-header .search-form button', settings['ideo_theme_options[header][side][' + skin + '][styling][search_text_color]']);
        namespace.setColor(selector + ' .navbar-header .search-form input::-moz-placeholder,' + selector + ' .navbar-header .search-form button', settings['ideo_theme_options[header][side][' + skin + '][styling][search_text_color]']);
        namespace.setColor(selector + ' .navbar-header .search-form input:-ms-input-placeholder,' + selector + ' .navbar-header .search-form button', settings['ideo_theme_options[header][side][' + skin + '][styling][search_text_color]']);

        var color = namespace.getColorOrAccent(settings['ideo_theme_options[header][side][' + skin + '][styling][social_icon_background_color]']);
        namespace.setBackgroundColor(selector + ' footer .social a', color);
        namespace.setBackgroundColor(selector + ' footer .social a:hover', namespace.setColorDarken(color, 15));
        namespace.setColor(selector + ' footer .social a', settings['ideo_theme_options[header][side][' + skin + '][styling][social_icons_color]']);

        namespace.setColor(selector + ' footer .copyright', settings['ideo_theme_options[header][side][' + skin + '][styling][copyrights]']);

        /*
         * ================================== SECTION PAGETITLE ================================== 
         */

        namespace.setLineHeight('#header.customize-preview h1', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_line_height]']);
        namespace.setLineHeight('#header.customize-preview .page-title .lead', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_line_height]']);

        namespace.toggleClass('.page-title .nav-bar', settings['ideo_theme_options[pagetitle][page_title_settings][breadcrumbs_mobile]'] !== 'true', 'hidden-xs hidden-sm');

        //BREADCRUMBS POSITION
        $('.page-title').removeClass('breadcrumbs-position-bottom breadcrumbs-position-inside').addClass('breadcrumbs-position-' + settings['ideo_theme_options[pagetitle][page_title_settings][breadcrumbs_position]']);

        var breadcrumbs = $('.page-title-container .nav-bar');
        breadcrumbs.find('.breadcrumb').removeClass('inside bottom').addClass(settings['ideo_theme_options[pagetitle][page_title_settings][breadcrumbs_position]']);
        if (settings['ideo_theme_options[pagetitle][page_title_settings][breadcrumbs_position]'] === 'inside') {
            if (!$('.page-title-content > *').hasClass('page-title-content-inside')) {
                $('.page-title-content > *').wrapAll('<div class="page-title-content-inside"></div>');
            }
            $('.page-title-content').append(breadcrumbs);
        } else {
            $('.page-title').after(breadcrumbs);
            if ($('.page-title-content .title').is('.page-title-content-inside')) {
                $('.page-title-content .title').unwrap();
            }
        }

        if ($('#header .page-title-container').length) {
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_settings.page_title_area_skin')) {
                namespace.setThemeSkin('#header .page-title-container', settings['ideo_theme_options[pagetitle][page_title_settings][page_title_area_skin]'], true, 'light');
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_settings.page_title_area_height')) {
                if (settings['ideo_theme_options[pagetitle][page_title_settings][page_title_area]'] == 'true') {
                    $('#header .page-title-container > .container > .row, #header .page-title-container > .container-content > .row').css('height', settings['ideo_theme_options[pagetitle][page_title_settings][page_title_area_height]'] + 'px');
                }
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_settings.page_title_area_content_align')) {
                $('.page-title').removeClass('page-title-position-left page-title-position-center page-title-position-right').addClass('page-title-position-' + settings['ideo_theme_options[pagetitle][page_title_settings][page_title_area_content_align]']);
            }

            if (namespace.checkConditions(['is-locally-modified'], $('#header'))) {
                namespace.setPTBackground(settings);
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_background.pt_background_parallax')) {
                namespace.setPTParallaxEffect(namespace.getBool(settings['ideo_theme_options[pagetitle][page_title_background][pt_background_parallax]']));
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_fonts.pt_title_font_size')) {
                var pt_title_font_size = settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_font_size]'];
                namespace.setFontSize('#header .page-title h1', pt_title_font_size);
                custom_css +=
                    "@media (max-width: 1199px) {" +
                    " #header .page-title h1{font-size: " + Math.max(0.8 * parseInt(pt_title_font_size), 25) + "px;}" +
                    "}" +
                    "@media (max-width: 991px) {" +
                    "  #header .page-title h1{font-size: " + Math.max(0.6 * parseInt(pt_title_font_size), 22) + "px;}" +
                    "}" +
                    "@media (max-width: 767px) {" +
                    "  #header .page-title h1{font-size: " + Math.max(0.5 * parseInt(pt_title_font_size), 22) + "px;}" +
                    "}" +
                    "@media (max-width: 479px) {" +
                    "  #header .page-title h1{font-size: " + Math.max(0.4 * parseInt(pt_title_font_size), 22) + "px;}" +
                    "} ";
            }

            namespace.setFontFamily('#header .page-title h1', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_font_family]']);

            namespace.setFontWeight('#header .page-title h1', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_font_weight]']);
            
            namespace.appendFonts(
                settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_font_family]'], 
                settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
                settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_font_weight]']
            );

            namespace.setLetterSpacing('#header .page-title h1', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_letter_spacing]']);

            namespace.setTextTransform('#header .page-title h1', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_title_text_transform]']);

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_fonts.pt_subtitle_font_size')) {
                namespace.setFontSize('#header .lead', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_font_size]']);
            }

            namespace.setFontFamily('#header .lead', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_font_family]']);

            namespace.setFontWeight('#header .lead', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_font_weight]']);
            
            namespace.appendFonts(
                settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_font_family]'], 
                settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
                settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_font_weight]']
            );


            namespace.setLetterSpacing('#header .lead', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_letter_spacing]']);

            namespace.setTextTransform('#header .lead', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_text_transform]']);

            namespace.setFontSize('#header .breadcrumb, #header .breadcrumb a', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_font_size]']);

            namespace.setLineHeight('#header .breadcrumb, #header .breadcrumb a', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_line_height]']);

            namespace.setFontFamily('#header .breadcrumb, #header .breadcrumb a', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_font_family]']);

            namespace.setFontWeight('#header .breadcrumb, #header .breadcrumb a', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_font_weight]']);
            
            namespace.appendFonts(
                settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_font_family]'], 
                settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
                settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_font_weight]']
            );

            namespace.setLetterSpacing('#header .breadcrumb, #header .breadcrumb a', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_letter_spacing]']);

            namespace.setTextTransform('#header .breadcrumb, #header .breadcrumb a', settings['ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_text_transform]']);

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_title_color')) {
                namespace.setPTTitleColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_light_title_color]'], 'skin-light');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_subtitle_color')) {
                namespace.setPTSubitleColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_light_subtitle_color]'], 'skin-light');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_text_color')) {
                namespace.setPTBreadcrumbsTextColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_light_b_text_color]'], 'skin-light');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_text_accent_color')) {
                namespace.setPTBreadcrumbsTextAccentColor(namespace.getColorOrAccent(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_light_b_text_accent_color]']), 'skin-light');
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_background_color')) {
                namespace.setPTBreadcrumbsBgColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_light_b_background_color]'], 'skin-light');
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_border_color')) {
                namespace.setPTBreadcrumbsTopBorderColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_light_b_border_color]'], 'skin-light');
            }

            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_title_color')) {
                namespace.setPTTitleColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_dark_title_color]'], 'skin-dark');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_subtitle_color')) {
                namespace.setPTSubitleColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_dark_subtitle_color]'], 'skin-dark');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_text_color')) {
                namespace.setPTBreadcrumbsTextColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_dark_b_text_color]'], 'skin-dark');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_text_accent_color')) {
                namespace.setPTBreadcrumbsTextAccentColor(namespace.getColorOrAccent(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_dark_b_text_accent_color]']), 'skin-dark');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_background_color')) {
                namespace.setPTBreadcrumbsBgColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_dark_b_background_color]'], 'skin-dark');
            }
            if (!namespace.hasLocalModyfication($('#header .page-title-container'), 'pagetitle.page_title_coloring.pt_b_border_color')) {
                namespace.setPTBreadcrumbsTopBorderColor(settings['ideo_theme_options[pagetitle][page_title_coloring][pt_dark_b_border_color]'], 'skin-dark');
            }

        } else {
            $('#header .page-title-container').css('height', 'auto');
        }


        /*
         * ================================== SECTION SHORTCODES ================================== 
         */

        namespace.setBorderRadius('.btn.radius-small, .button.radius-small', settings['ideo_theme_options[shortcodes][button_radius][button_radius_small]'] + 'px');
        namespace.setBorderRadius('.btn.radius-big, .button.radius-big', settings['ideo_theme_options[shortcodes][button_radius][button_radius_big]'] + 'px');

        //namespace.toggleClass('.btn', settings['ideo_theme_options[footer][footer_settings][sticky_footer]'], 'sticky');

        //namespace.toggleShortcodeBorderRadius('big', settings['ideo_theme_options[shortcodes][button_radius][button_radius_big]']);


        customize('ideo_theme_options[shortcodes][button_radius][button_default_radius]', function (value) {
            value.bind(function (theme) {

                var newVal = namespace.getCustomizerSetting('ideo_theme_options[shortcodes][button_radius][button_radius_' + theme + ']');

                namespace.toggleShortcodeBorderRadius(theme, newVal);
            });
        });

        namespace.setAllShortcodeStyling(settings);

        /*
         * ================================== SECTION FOOTER ================================== 
         */


        if (settings['ideo_theme_options[footer][footer_settings][footer_on]']) {
            if ('advanced' === settings['ideo_theme_options[footer][footer_settings][footer_type]']) {
                namespace.toggleClass('#footer-container', settings['ideo_theme_options[footer][footer_settings][sticky_footer]'], 'sticky');
            }
            if ('standard' === settings['ideo_theme_options[footer][footer_settings][footer_type]']) {

                if (!namespace.hasLocalModyfication($('#footer-content'), 'footer.footer_settings.standard_footer_skin')) {
                    namespace.setStaticSkin('#footer-content', settings['ideo_theme_options[footer][footer_settings][standard_footer_skin]'], 'light');
                }

                if (!namespace.hasLocalModyfication($('#footer-container'), 'footer.footer_settings.copywrite_area_on'))
                    namespace.toggleVisibility('#copyright', settings['ideo_theme_options[footer][footer_settings][copywrite_area_on]']);

                if (!namespace.hasLocalModyfication($('#copyright'), 'footer.footer_settings.copyright_skin')) {
                    namespace.setStaticSkin('#copyright', settings['ideo_theme_options[footer][footer_settings][copyright_skin]'], 'dark');
                }

                namespace.setPadding('#copyright', settings['ideo_theme_options[footer][footer_settings][copyright_paddings]'], false, settings['ideo_theme_options[footer][footer_settings][copyright_paddings]'], false);

                if (!namespace.hasLocalModyfication($('#copyright .copyright-text'), 'footer.footer_settings.copyright_text')) {
                    $('#copyright .copyright-text').html(settings['ideo_theme_options[footer][footer_settings][copyright_text]'].replace(/[^\\]\\{1}/g, '').replace(/\r?\n/g, '<br />'));
                }

                namespace.setTextAlign('#copyright .copyright-text', settings['ideo_theme_options[footer][footer_settings][copyright_text_align]']);

                if (!namespace.hasLocalModyfication($('#copyright'), 'footer.copyrights_coloring.copyrights_background_color')) {
                    namespace.setBackgroundColor('#copyright.skin-light', settings['ideo_theme_options[footer][copyrights_coloring][copyrights_light_background_color]']);
                    namespace.setBackgroundColor('#copyright.skin-dark', settings['ideo_theme_options[footer][copyrights_coloring][copyrights_dark_background_color]']);
                }

                if (!namespace.hasLocalModyfication($('#copyright .copyright-text'), 'footer.copyrights_coloring.copyrights_text_color')) {
                    namespace.setColor('#copyright.skin-light', settings['ideo_theme_options[footer][copyrights_coloring][copyrights_light_text_color]']);
                    namespace.setColor('#copyright.skin-dark', settings['ideo_theme_options[footer][copyrights_coloring][copyrights_dark_text_color]']);
                }

                namespace.setFontSize('#copyright', settings['ideo_theme_options[footer][copyrights_font][copyrights_font_size]']);
                namespace.setLineHeight('#copyright', settings['ideo_theme_options[footer][copyrights_font][copyrights_line_height]']);
                namespace.setFontFamily('#copyright', settings['ideo_theme_options[footer][copyrights_font][copyrights_font_family]']);
                namespace.setFontWeight('#copyright', settings['ideo_theme_options[footer][copyrights_font][copyrights_font_weight]']);
                namespace.setLetterSpacing('#copyright', settings['ideo_theme_options[footer][copyrights_font][copyrights_letter_spacing]']);
                
                namespace.appendFonts(
                    settings['ideo_theme_options[footer][copyrights_font][copyrights_font_family]'], 
                    settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
                    settings['ideo_theme_options[footer][copyrights_font][copyrights_font_weight]']
                );

                namespace.toggleClass('#footer-container', settings['ideo_theme_options[footer][footer_settings][sticky_footer]'], 'sticky');
                //ideo_theme_options[footer][standard_footer_layout][footer_layout]
                if ('in_grid' === settings['ideo_theme_options[footer][standard_footer_layout][footer_layout]']) {

                }
                if ('full_width' === settings['ideo_theme_options[footer][standard_footer_layout][footer_layout]']) {

                }
                if ('custom' === settings['ideo_theme_options[footer][standard_footer_layout][footer_layout]']) {
                    namespace.setMaxWidth('#footer-container .container', settings['ideo_theme_options[footer][standard_footer_layout][footer_custom_layout]'], 'px !important');
                }
                namespace.setPadding('#footer-container.type-standard #footer', settings['ideo_theme_options[footer][standard_footer_layout][footer_padding_top]'], false, false, false);
                namespace.setPadding('#footer-container.type-standard #footer', false, false, settings['ideo_theme_options[footer][standard_footer_layout][footer_padding_bottom]'], false);

                if (namespace.checkConditions(['is-locally-modified'], $('#footer-container'))) {
                    namespace.setFooterBackground(settings);
                }

                namespace.setFooterLightAccentColor(namespace.getColorOrAccent(settings['ideo_theme_options[footer][standard_footer_coloring][footer_light_accent_color]']), 'skin-light');

                namespace.setFooterTitleColor(settings['ideo_theme_options[footer][standard_footer_coloring][footer_light_widgets_title_color]'], 'skin-light');

                namespace.setFooterTextColor(settings['ideo_theme_options[footer][standard_footer_coloring][footer_light_widgets_text_color]'], 'skin-light');

                namespace.setFooterLightAccentColor(namespace.getColorOrAccent(settings['ideo_theme_options[footer][standard_footer_coloring][footer_dark_accent_color]']), 'skin-dark');

                namespace.setFooterTitleColor(settings['ideo_theme_options[footer][standard_footer_coloring][footer_dark_widgets_title_color]'], 'skin-dark');

                namespace.setFooterTextColor(settings['ideo_theme_options[footer][standard_footer_coloring][footer_dark_widgets_text_color]'], 'skin-dark');

                namespace.setFontSize('footer#footer-container .widget-title', settings['ideo_theme_options[footer][widgets_title_font][widget_title_font_size]']);

                namespace.setLineHeight('footer#footer-container .widget-title', settings['ideo_theme_options[footer][widgets_title_font][widget_title_line_height]']);

                namespace.setFontFamily('footer#footer-container .widget-title', settings['ideo_theme_options[footer][widgets_title_font][widget_title_font_family]']);

                namespace.setFontWeight('footer#footer-container .widget-title', settings['ideo_theme_options[footer][widgets_title_font][widget_title_font_weight]']);
                
                namespace.appendFonts(
                    settings['ideo_theme_options[footer][widgets_title_font][widget_title_font_family]'], 
                    settings['ideo_theme_options[fonts][font_family][global_font_extension]'], 
                    settings['ideo_theme_options[footer][widgets_title_font][widget_title_font_weight]']
                );

                namespace.setLetterSpacing('footer#footer-container .widget-title', settings['ideo_theme_options[footer][widgets_title_font][widget_title_letter_spacing]']);
            }
        }

        /*
         * ================================== SECTION PORTFOLIO NAVIGATION ==================================
         */

        namespace.toggleVisibility('body.single-portfolio .footer-navigator-bar', settings['ideo_theme_options[portfolio][portfolio_navigation][enabled]'] == 'true');
        namespace.setBackgroundColor('body.single-portfolio .footer-navigator-bar', settings['ideo_theme_options[portfolio][portfolio_navigation][background_color]']);
        namespace.setBorderTopColor('body.single-portfolio .footer-navigator-bar', settings['ideo_theme_options[portfolio][portfolio_navigation][border_top_color]']);
        namespace.setBorderBottomColor('body.single-portfolio .footer-navigator-bar', settings['ideo_theme_options[portfolio][portfolio_navigation][border_bottom_color]']);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .previous a h4', settings['ideo_theme_options[portfolio][portfolio_navigation][text_color]']);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .previous a:hover h4', settings['ideo_theme_options[portfolio][portfolio_navigation][text_color]']);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .next a h4', settings['ideo_theme_options[portfolio][portfolio_navigation][text_color]']);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .next a:hover h4', settings['ideo_theme_options[portfolio][portfolio_navigation][text_color]']);
        namespace.setBorderColor('body.single-portfolio .footer-navigator-bar .list .mini-square', settings['ideo_theme_options[portfolio][portfolio_navigation][text_color]']);

        var portfolioAccentColor = settings['ideo_theme_options[portfolio][portfolio_navigation][accent_color]'];

        if (namespace.getCustomizerSetting('ideo_theme_options[generals][styling][theme_skin]') == 'light')
            portfolioAccentColor = namespace.getColorOrAccent(portfolioAccentColor);

        namespace.setColor('body.single-portfolio .footer-navigator-bar .previous a label', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .previous a:hover label', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .previous a i', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .previous a:hover i', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .next a label', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .next a:hover label', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .next a i', portfolioAccentColor);
        namespace.setColor('body.single-portfolio .footer-navigator-bar .next a:hover i', portfolioAccentColor);

        /*
         * ================================== SECTION SIDEBAR ================================== 
         */

        if (namespace.elementExists('.sidebar')) {
            if (!namespace.hasLocalModyfication($('.sidebar'), 'sidebar.sidebar_settings.sidebar_skin'))
                namespace.setThemeSkin('.sidebar', settings['ideo_theme_options[sidebar][sidebar_settings][sidebar_skin]'], true);

            $('.sidebar .widget .widget-title').css('fontSize', settings['ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_size]'] + 'px');
            $('.sidebar .widget .widget-title').css('lineHeight', settings['ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_line_height]']);
            $('.sidebar .widget .widget-title').css('fontFamily', settings['ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_family]']);
            namespace.setFontWeight('.sidebar .widget .widget-title', settings['ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_font_weight]']);
            namespace.setLetterSpacing('.sidebar .widget .widget-title', settings['ideo_theme_options[sidebar][sidebar_widgets_title_font][sidebar_title_letter_spacing]']);
            namespace.setSidebarAccentColor(namespace.getColorOrAccent(settings['ideo_theme_options[sidebar][sidebar_coloring][sidebar_light_accent_color]']), 'skin-light');
            namespace.setSidebarTitleColor(settings['ideo_theme_options[sidebar][sidebar_coloring][sidebar_light_titles_color]'], 'skin-light');
            namespace.setSidebarTextColor(settings['ideo_theme_options[sidebar][sidebar_coloring][sidebar_light_text_color]'], 'skin-light');
            namespace.setSidebarAccentColor(namespace.getColorOrAccent(settings['ideo_theme_options[sidebar][sidebar_coloring][sidebar_dark_accent_color]']), 'skin-dark');
            namespace.setSidebarTitleColor(settings['ideo_theme_options[sidebar][sidebar_coloring][sidebar_dark_titles_color]'], 'skin-dark');
            namespace.setSidebarTextColor(settings['ideo_theme_options[sidebar][sidebar_coloring][sidebar_dark_text_color]'], 'skin-dark');
        }


        /*
         * ================================== SECTION BLOG ================================== 
         */

        if (namespace.isBlogPage() || (namespace.isArchivePage() && !namespace.hasArchiveCustomMeta(settings)) || namespace.isSinglePostPage()) {
            namespace.toggleVisibility('.ideo-entry-meta .post-meta .author, .ideo-blog-single .post-meta .author, .ideo-blog-single footer .author', settings['ideo_theme_options[blog][blog_settings][blog_hide_authors]']);

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .comments,  .ideo-blog-single .post-meta .comments, .ideo-blog-single .comments-container', settings['ideo_theme_options[blog][blog_settings][blog_hide_comments]']);

            namespace.toggleVisibility('.ideo-blog-masonry .post-meta .date, .ideo-blog-single .post-meta .date', settings['ideo_theme_options[blog][blog_settings][blog_hide_date]']);
            if (namespace.blogIsClassic()) {
                if (settings['ideo_theme_options[blog][blog_settings][blog_hide_date]']) {
                    $('.blog-lists-posts').removeClass('hide-date');
                } else {
                    $('.blog-lists-posts').addClass('hide-date');
                }
            }

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .tags, .ideo-blog-single .post-meta .tags', settings['ideo_theme_options[blog][blog_settings][blog_hide_tags]']);

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .categories, .ideo-blog-single footer .tags', settings['ideo_theme_options[blog][blog_settings][blog_hide_categories]']);
        }

        namespace.setThemeSkin('.ideo-blog-single', settings['ideo_theme_options[generals][styling][theme_skin]']);

        if (namespace.isBlogPage() || namespace.isArchivePage() || namespace.isSearchPage()) {
            namespace.toggleClass('.blog-lists-posts', false, 'skin-colored-light skin-colored-dark');
            namespace.toggleClass('.blog-lists-posts', true, 'skin-colored-' + settings['ideo_theme_options[generals][styling][theme_skin]']);
        }

        if ('none' === settings['ideo_theme_options[blog][blog_single][blog_sidebar]']) {

        }


        namespace.toggleVisibility('.posts-navi', settings['ideo_theme_options[blog][blog_single][blog_single_navigation]']);

        namespace.toggleVisibility('.ideo-blog-single .ideo-featured-image', settings['ideo_theme_options[blog][blog_single][blog_single_featured_image]']);

        namespace.toggleVisibility('.ideo-blog-single .post-title', settings['ideo_theme_options[blog][blog_single][blog_single_post_title]']);

        namespace.toggleVisibility('.ideo-blog-single .post-meta', settings['ideo_theme_options[blog][blog_single][blog_single_meta]']);

        if (namespace.getBool(settings['ideo_theme_options[blog][blog_settings][blog_hide_categories]'])) {
            namespace.toggleVisibility('.ideo-blog-single footer .tags', settings['ideo_theme_options[blog][blog_single][blog_single_meta]']);
        }

        namespace.toggleVisibility('.ideo-blog-single .related-posts', settings['ideo_theme_options[blog][blog_single][blog_single_related_posts]']);

        namespace.toggleVisibility('.ideo-blog-single .socials', settings['ideo_theme_options[blog][blog_single][blog_single_socials]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-facebook').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_facebook]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-twitter').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_twitter]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-google-plus').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_google]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-pinterest').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_pinterest]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-reddit').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_reddit]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-linkedin').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_linkedin]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-tumblr').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_tumblr]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-vk').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_vk]']);

        namespace.toggleVisibility($('.ideo-blog-single .socials .fa-envelope-o').parents('li'), settings['ideo_theme_options[blog][blog_single][blog_single_email]']);


        /*
         * ============================ SECTION BLOG ARCHIVE/CATEGORIES PAGES ===========================
         */

        if (namespace.isArchivePage()) {
            namespace.toggleVisibility($('.blog-list-archive .social, .blog-lists-posts .social'), settings['ideo_theme_options[blog][blog_archives][blog_archives_socials]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-facebook, .blog-lists-posts .social .fa-facebook').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_facebook]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-twitter, .blog-lists-posts .social .fa-twitter').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_twitter]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-google-plus, .blog-lists-posts .social .fa-google-plus').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_google]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-pinterest, .blog-lists-posts .social .fa-pinterest').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_pinterest]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-reddit, .blog-lists-posts .social .fa-reddit').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_reddit]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-linkedin, .blog-lists-posts .social .fa-linkedin').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_linkedin]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-tumblr, .blog-lists-posts .social .fa-tumblr').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_tumblr]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-vk, .blog-lists-posts .social .fa-vk').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_vk]']);
            namespace.toggleVisibility($('.blog-list-archive .social .fa-email, .blog-lists-posts .social .fa-email').parents('li'), settings['ideo_theme_options[blog][blog_archives][blog_archives_email]']);
        }

        namespace.setMargin('.wrap-boxed .blog-lists-posts.ideo-blog-masonry',
            false, (25 - settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2) + 'px',
            false, (25 - settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2) + 'px'
        );

        namespace.setMargin('.wrap-wide .blog-lists-posts.ideo-blog-masonry',
            false, (-settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2) + 'px',
            false, (-settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2) + 'px'
        );

        namespace.setPadding('.blog-lists-posts.ideo-blog-masonry .ideo-blog-entry, .blog-lists-posts.blog-list-archive.ideo-blog-masonry .ideo-blog-entry',
            false, (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2 + 10) + 'px', (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]']) + 'px', (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2 + 10) + 'px'
        );

        namespace.setPositionValue('.blog-lists-posts.ideo-blog-masonry .ideo-blog-entry:before, .blog-lists-posts.blog-list-archive.ideo-blog-masonry .ideo-blog-entry:before',
            false, (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2) + 'px', (parseInt(settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'])) + 'px', (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2) + 'px'
        );

        namespace.setPositionValue('.blog-lists-posts.ideo-blog-masonry .ideo-blog-entry:after, .blog-lists-posts.blog-list-archive.ideo-blog-masonry .ideo-blog-entry:after',
            false, (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2 + 1) + 'px', (parseInt(settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]']) + 2) + 'px', (settings['ideo_theme_options[blog][blog_archives][blog_archives_block_distance]'] / 2 + 1) + 'px'
        );

        if (namespace.isArchivePage() && namespace.hasArchiveCustomMeta(settings)) {

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .author, .ideo-blog-single .post-meta .author, .ideo-blog-single footer .author', settings['ideo_theme_options[blog][blog_archives][blog_archives_authors]']);

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .comments,  .ideo-blog-single .post-meta .comments, .ideo-blog-single .comments-container', settings['ideo_theme_options[blog][blog_archives][blog_archives_comments]']);

            namespace.toggleVisibility('.ideo-blog-masonry .post-meta .date, .ideo-blog-single .post-meta .date', settings['ideo_theme_options[blog][blog_archives][blog_archives_date]']);
            if (namespace.blogIsClassic()) {
                if (settings['ideo_theme_options[blog][blog_archives][blog_archives_date]']) {
                    $('.blog-lists-posts').removeClass('hide-date');
                } else {
                    $('.blog-lists-posts').addClass('hide-date');
                }
            }

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .tags, .ideo-blog-single .post-meta .tags', settings['ideo_theme_options[blog][blog_archives][blog_archives_tags]']);

            namespace.toggleVisibility('.ideo-entry-meta .post-meta .categories, .ideo-blog-single footer .tags', settings['ideo_theme_options[blog][blog_archives][blog_archives_categories]']);

        }

        /*
         * ============================ SECTION BLOG SEARCH PAGE ===========================
         */


        namespace.blodToggleFeatureImage(settings['ideo_theme_options[blog][blog_search][blog_search_featured_image]']);

        namespace.toggleVisibility('.blog-list-search .post-meta .date', settings['ideo_theme_options[blog][blog_search][blog_search_meta_date]']);

        namespace.toggleVisibility('.blog-list-search .post-meta .author', settings['ideo_theme_options[blog][blog_search][blog_search_meta_author]']);

        //when hiding meta info have to hide seprator, css :last-child not working

        $('.ideo-entry-meta .post-meta').each(function () {
            $(this).show().children('div').removeClass('hide-sep').filter(':visible').last().addClass('hide-sep');
        });

        $('.blog-list-search .ideo-entry-meta .post-meta').each(function () {
            if ($(this).children(':visible').length == 0)
                $(this).hide();
        });

        /*
         * ============================ SECTION CUSTOM CSS ===========================
         */

        namespace.setCustomCss(settings['ideo_theme_options[custom][custom_css][custom_css]']);


        /*
         * ============================ SECTION LIGHTBOX ===========================
         */

        namespace.setColor('.mfp-title, .mfp-counter, .mfp-title span, .mfp-arrow-left::before, .mfp-arrow-right::before, .mfp-content .mfp-close', settings['ideo_theme_options[lightbox][lightbox_coloring][lightbox_text_and_nav_color]']);
        namespace.setTextAlign('.mfp-title', settings['ideo_theme_options[lightbox][lightbox_settings][lightbox_text_align]']);
        namespace.setBackgroundColor('.mfp-bg', settings['ideo_theme_options[lightbox][lightbox_coloring][lightbox_overlay_color]']);

        /*
         * ============================ SECTION ADVANCED ===========================
         */


        namespace.toggleVisibility('.js--back-top-button', settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_button]']);
        if (settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_button]']) {
            namespace.setBorderRadius('body a.back-top-button', settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_radius]'] + 'px');
            namespace.setBackgroundColor('body a.back-top-button', settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_background_color]']);
            namespace.setBackgroundColor('body a.back-top-button:hover', namespace.getColorOrAccent(settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_background_hover_color]']));
            namespace.setColor('body a.back-top-button > i', settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_icon_color]']);
            namespace.setColor('body a.back-top-button:hover > i', settings['ideo_theme_options[advanced][advanced_backtotop][advanced_backtotop_icon_hover_color]']);
        }


        namespace.setCssRules(null, null, custom_css);

        $.fn.initParallax();
        $.fn.centerNavMenu();
        $.fn.runStickyFooter();

    }

    customize('data_postMessage', function (value) {
        var cutomizerPrev = _.debounce(namespace.customizerPreview, 100);
        value.bind(cutomizerPrev);
    });
    $(window).load(function () {
        customize.preview.bind('active', function () {
            customize.preview.send('active', {
                action: 'active'
            });
        });
        namespace.customizerPreview(customize.get().data_postMessage);
    });

    $(window).on('resize', _.debounce(function () {
        namespace.customizerPreview(customize.get().data_postMessage);
    }, 1000));

})(jQuery);