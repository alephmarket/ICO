(function ($) {
    "use strict";
//aaa
    if(typeof window.parent.wp.customize.get()['data_refresh'] === 'undefined') return;

    var xhr;
    $.fn.ideo = {};

    var namespace = $.fn.ideo;
        
    /* chaned values will be store here */
    namespace.changedValues = {};
    namespace.rules = {};
    namespace.shortcodePatterns = [];

    namespace.toggleVisibility = function (selector, show, conditions) {
        var elems = $(selector);
        var localConditions = ['is-locally-modified'];

        if ($.isArray(conditions) && !namespace.checkConditions(conditions)) {
            return false;
        }

        show = namespace.getBool(show);

        elems.each(function () {
            if (namespace.checkConditions(localConditions, $(this))) {

                if (show) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            }
        });
    };

    namespace.toggleClass = function (selector, show, classes) {
        if (namespace.getBool(show)) {
            $(selector).addClass(classes);
        }
        else {
            $(selector).removeClass(classes);
        }
    };

    namespace.toggleBlogLayout = function (selector, layout, conditions) {
        var elems = $(selector);
        var localConditions = ['is-locally-modified'];

        if ($.isArray(conditions) && !namespace.checkConditions(conditions)) {
            return false;
        }

        elems.each(function () {
            if (namespace.checkConditions(localConditions, $(this))) {
                //NOTE: column classes must to be dynamic
                switch (layout) {
                    case 'masonry':
                        $(this).removeClass('ideo-blog-classic left').addClass('ideo-blog-masonry');
                        $(this).find('article').addClass('col-xs-6 col-sm-6 col-md-4');
                        $.fn.runIsotope();
                        break;
                    default:
                        $(this).addClass('ideo-blog-classic').removeClass('ideo-blog-masonry left');
                        $(this).isotope('destroy');
                        $(this).find('article').removeClass('col-xs-6 col-sm-6 col-md-4');
                }
            }
        });
    };

    namespace.blodToggleFeatureImage = function (value) {
        namespace.toggleVisibility('.blog-list-search .ideo-blog-entry .ideo-featured-image', value);

        if (namespace.blogIsMasonry()) {
            $.fn.runIsotope();
        }
    };

    namespace.changeSidebarPosition = function (elem, conditions) {

        if ($.isArray(conditions) && !namespace.checkConditions(conditions, elem)) {
            return false;
        }

        var data = namespace.getDirtySettings();

        data.ideo_action = 'customize';

        namespace.ajaxRequest('', data, function (html) {
            jQuery('#ideo-page').replaceWith($(html).find('#ideo-page'));
            jQuery('body').removeClass('loader');
        }, namespace.previewUrl);
    };

    namespace.toggleFontStyle = function (selector, style) {
        if (style) {
            $(selector).css('fontStyle', 'italic');
        } else {
            $(selector).css('fontStyle', '');
        }
    };

    namespace.getBodyFontSkin = function () {
        var skin = namespace.getCustomizerSetting('ideo_theme_options[fonts][font_coloring][body_text_skin]');

        if (skin == 'default') {
            var skin = namespace.getCustomizerSetting('ideo_theme_options[generals][styling][theme_skin]');

            if (skin == 'dark')
                return 'light';

            return 'dark';
        }

        return skin;
    }

    namespace.setCustomCss = function (value) {
        if($('#custom-css').length == 0){
            $('<style/>',{id:'custom-css', type: 'text/css'}).appendTo('body');
        }
        $('#custom-css').html(namespace.normalizeText(value));
    };

    namespace.toggleShortcodeBorderRadius = function (newStyle, newVal) {

        var theme = namespace.getCustomizerSetting('ideo_theme_options[shortcodes][button_radius][button_default_radius]');

        if (theme == 'none') {
            newVal = 0;
        }

        if (newStyle == theme) {
            $('.btn, .button:not(.radius-big,.radius-small,.radius-none)').css('borderRadius', newVal + 'px');
        }
    };

    namespace.setAllShortcodeStyling = function (settings) {
        namespace.setShortcodeStylingColored('.colored-light', namespace.getShortcodeStylingByType(settings, 'colored_light'));
        namespace.setShortcodeStylingColored('.colored-dark', namespace.getShortcodeStylingByType(settings, 'colored_dark'));
        namespace.setShortcodeStylingTransparent('.transparent-light', namespace.getShortcodeStylingByType(settings, 'transparent_light'));
        namespace.setShortcodeStylingTransparent('.transparent-dark', namespace.getShortcodeStylingByType(settings, 'transparent_dark'));

        namespace.setShortcodeStylingColoredToTransparent('.colored-dark-to-transparent', namespace.getShortcodeStylingByType(settings, 'colored_dark'));
        namespace.setShortcodeStylingColoredToTransparent('.colored-light-to-transparent', namespace.getShortcodeStylingByType(settings, 'colored_light'));
        namespace.setShortcodeStylingTransparentToColored('.colored-dark-to-transparent-invert', namespace.getShortcodeStylingByType(settings, 'colored_dark'));
        namespace.setShortcodeStylingTransparentToColored('.colored-light-to-transparent-invert', namespace.getShortcodeStylingByType(settings, 'colored_light'));

        namespace.setBlogListShortcodeStyling('.skin-colored-light', namespace.getShortcodeStylingByType(settings, 'colored_light'));
        namespace.setBlogListShortcodeStyling('.skin-colored-dark', namespace.getShortcodeStylingByType(settings, 'colored_dark'));

        namespace.setBlogSingleShortcodeStyling('.skin-light', namespace.getShortcodeStylingByType(settings, 'colored_light'));
        namespace.setBlogSingleShortcodeStyling('.skin-dark', namespace.getShortcodeStylingByType(settings, 'colored_dark'));

        namespace.setBackgroundColor('.ideo-wp-newest-posts .title:before', namespace.getAccentColor());
        namespace.setBackgroundColor('.ideo-wp-newest-posts .newest-list .image a:before', namespace.getAccentColor());
        namespace.setColor('.ideo-wp-newest-posts .newest-list p.date', namespace.getAccentColor());
        namespace.setColor('.ideo-wp-newest-posts .newest-list .comments', namespace.getAccentColor());
    };

    /* 
    *  Shortcodes coloring COLORED STYLES 
    */
    namespace.setShortcodeStylingColored = function (className, colors) {
        //selectors for background colors
        var accentBC = [];
        var titleBC = [];
        var iconBC = [];
        var textBC = [];
        var BC = [];
        var altTitleBC = [];

        //selectors for colors 
        var accentFC = [];
        var titleFC = [];
        var iconFC = [];
        var textFC = [];
        var FC = [];
        var altTitleFC = [];

        //selectors for border colors
        var accentBorderC = [];
        var titleBorderC = [];
        var textBorderC = [];
        var altTitleBorderC = [];
        var BorderC = [];

        //selectors for border-top colors
        var accentBorderTopC = [];
        var titleBorderTopC = [];

        //selectors for border-bottom colors
        var accentBorderBottomC = [];
        var titleBorderBottomC = [];

        //selectors for border-left colors
        var accentBorderLeftC = [];
        var titleBorderLeftC = [];

        //selectors for border-right colors
        var accentBorderRightC = [];
        var titleBorderRightC = [];


        /*
         * Accent color control
         */
        if (Boolean(colors.accent)) {


            accentBC.push(className + '.accordion .panel-default > .panel-heading .panel-title a');
            accentBC.push(className + '.container-tabs .nav-tabs > li');
            accentBC.push(className + '.button');
            accentBC.push(className + '.ideo-progress-bar .bar .cover');
            accentBC.push(className + '.ideo-progress-bar .bar .cover .number');
            accentBC.push(className + '.ideo-iconbox.type-small-icon .icon');
            accentBC.push(className + '.ideo-iconbox.type-big-icon .icon i');
            accentBC.push(className + '.ideo-single-image-wrap .ideo-single-image:hover .link:hover');
            accentBC.push(className + '.ideo-icons.style-advanced i.icon');
            accentBC.push(className + '.ideo-pricing-table .price');
            accentBC.push(className + '.ideo-pricing-table.highlight-table');
            accentBC.push(className + '.ideo-team-box .social .icon');
            accentBC.push(className + '.ideo-team-box-caption .social');
            namespace.setBackgroundColor(accentBC.join(', '), colors.accent);

            var accentBC75 = [];
            accentBC75.push(className + '.ideo-message-box.type-custom .ideo-message-box-content::before'); 
            namespace.setBackgroundColor(accentBC75.join(', '), namespace.setColorAlpha(colors.accent, 0.75));

            var accentBC80 = [];
            accentBC80.push(className + '.ideo-testimonials-slider .carousel-control'); 
            accentBC80.push(className + '.ideo-single-image-wrap .ideo-single-image .hover'); 
            namespace.setBackgroundColor(accentBC80.join(', '), namespace.setColorAlpha(colors.accent, 0.80));

            var accentBCDarken = [];
            accentBCDarken.push(className + '.container-tabs .nav-tabs > li:hover'); 
            accentBCDarken.push(className + '.button:hover'); 
            accentBCDarken.push(className + '.button:focus'); 
            accentBCDarken.push(className + '.ideo-icons.style-advanced.icon-hover i.icon:hover'); 
            namespace.setBackgroundColor(accentBCDarken.join(', '), namespace.setColorDarken(colors.accent, 10));

            var accentBCDarken = [];
            accentBCDarken.push(className + '.ideo-testimonials-slider .carousel-control::before'); 
            namespace.setBackgroundColor(accentBCDarken.join(', '), namespace.setColorDarken(colors.accent, 1));

            accentFC.push(className + '.ideo-testimonials-slider .item blockquote .author');
            accentFC.push(className + '.ideo-single-image-wrap .ideo-single-image .link::before');
            accentFC.push(className + '.ideo-pricing-table .icon');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .price .amount');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .price .unit');
            accentFC.push(className + '.ideo-team-box .social a:hover .icon');
            accentFC.push(className + '.ideo-team-box-caption .name-position .position');
            accentFC.push(className + '.ideo-icons i.icon');
            namespace.setColor(accentFC.join(', '), colors.accent);

            var accentFCDarken = [];
            accentFCDarken.push(className + '.ideo-icons.icon-hover i.icon:hover'); 
            namespace.setColor(accentFCDarken.join(', '), namespace.setColorDarken(colors.accent, 10));

            accentBorderC.push(className + '.button');
            accentBorderC.push(className + '.ideo-iconbox.type-small-icon .icon');
            accentBorderC.push(className + '.ideo-icons.style-advanced.icon-hover i.icon:hover');
            accentBorderC.push(className + '.ideo-wow-title .title');
            accentBorderC.push(className + '.ideo-wow-title.style-underlined .title::after');
            namespace.setBorderColor(accentBorderC.join(', '), colors.accent);

            var accentBorderCDarken = [];
            accentBorderCDarken.push(className + '.button:hover'); 
            accentBorderCDarken.push(className + '.button:focus'); 
            accentBorderCDarken.push(className + '.ideo-icons.style-advanced i.icon'); 
            namespace.setBorderColor(accentBorderCDarken.join(', '), namespace.setColorDarken(colors.accent, 10));


            accentBorderTopC.push(className + '.container-tabs.horizontal .nav-tabs > li.active a');
            accentBorderTopC.push(className + '.ideo-pricing-table');
            accentBorderTopC.push(className + '.klasa');
            accentBorderTopC.push(className + '.ideo-pricing-table .price::after');
            accentBorderTopC.push(className + '.ideo-progress-bar .bar .cover .number::after');
            namespace.setBorderTopColor(accentBorderTopC.join(', '), colors.accent);


            accentBorderBottomC.push(className + '.accordion.panel-group .panel');
            accentBorderBottomC.push(className + '.container-tabs.horizontal .tab-content');
            accentBorderBottomC.push(className + '.container-tabs.vertical .tab-content');
            accentBorderBottomC.push(className + '.column-text-styled');
            accentBorderBottomC.push(className + '.ideo-iconbox');
            accentBorderBottomC.push(className + '.ideo-imagebox');
            accentBorderBottomC.push(className + '.ideo-counter .circle .number-icon .number-unit');
            accentBorderBottomC.push(className + '.ideo-pricing-table');
            namespace.setBorderBottomColor(accentBorderBottomC.join(', '), colors.accent);


            accentBorderLeftC.push(className + '.container-tabs.vertical .nav-tabs > li.active a::before');
            accentBorderLeftC.push(className + '.ideo-cta-button::before');
            namespace.setBorderLeftColor(accentBorderLeftC.join(', '), colors.accent);


            accentBorderRightC.push(className + '.klasa');
            namespace.setBorderRightColor(accentBorderRightC.join(', '), colors.accent);

            var accentStrokeC = [];
            accentStrokeC.push(className + '.ideo-pie-chart .circle svg .bar');
            namespace.setStroke(accentStrokeC.join(', '), colors.accent)

            var accentBoxShadowC = [];
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="email"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="text"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="number"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="tel"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="url"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="date"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="phone"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 select:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 textarea:focus');
            namespace.setBoxShadow(accentBoxShadowC.join(', '), '0 0 0 2px ' + colors.accent);

            namespace.setShortcodeIconPattern(className + '.ideo-wow-title[data-icon-svg-type]', colors.accent, '.title-icon');
            namespace.shortCodeColor('.diver-icon .icon', colors.accent);
            namespace.setShortcodeIconColor(className + '.diver-icon[data-icon-colored]', colors.accent);

            namespace.setBoxShadow(className + '.button.button3d', '0 3px 0px ' + namespace.setColorDarken(colors.accent, 20));
            namespace.setBoxShadow(className + '.button.button3d:hover', '0 0 0px ' + namespace.setColorDarken(colors.accent, 20));

        }

        /*
         * Title color control
         */
        if (Boolean(colors.title)) {
            titleBC.push(className + '.klasa');
            namespace.setBackgroundColor(titleBC.join(', '), colors.title);            
            titleFC.push(className + '.accordion .panel-default > .panel-heading .panel-title a.collapsed');
            titleFC.push(className + '.container-tabs.horizontal .nav-tabs > li.active a');
            titleFC.push(className + '.container-tabs .nav-tabs > li.active a');
            titleFC.push(className + '.ideo-iconbox h4');
            titleFC.push(className + '.ideo-imagebox h4');
            titleFC.push(className + '.ideo-pie-chart .circle .number-icon .number-unit');
            titleFC.push(className + '.ideo-counter .circle .number-icon .number-unit');
            titleFC.push(className + '.ideo-message-box .ideo-message-box-content p.title');
            titleFC.push(className + '.ideo-wow-title .title');
            titleFC.push(className + '.ideo-pricing-table .title');
            titleFC.push(className + '.ideo-pricing-table .subtitle');
            titleFC.push(className + '.ideo-pricing-table.highlight-table .price .peroid');
            titleFC.push(className + '.ideo-team-box .name-position .name');
            titleFC.push(className + '.ideo-team-box-caption .name-position .name');
            titleFC.push(className + '.ideo-message-box .ideo-message-box-content span.title');
            namespace.setColor(titleFC.join(', '), colors.title);


            titleBorderC.push(className + '.klasa');
            namespace.setBorderColor(titleBorderC.join(', '), colors.title);


            titleBorderTopC.push(className + '.klasa');
            namespace.setBorderTopColor(titleBorderTopC.join(', '), colors.title);


            titleBorderBottomC.push(className + '.ideo-wow-title.style-underlined .title');
            titleBorderBottomC.push(className + '.klasa');
            namespace.setBorderBottomColor(titleBorderBottomC.join(', '), colors.title);

            var titleBorderBottomC18 = [];
            titleBorderBottomC18.push(className + '.ideo-iconbox h4'); 
            titleBorderBottomC18.push(className + '.ideo-imagebox h4'); 
            namespace.setBorderBottomColor(titleBorderBottomC18.join(', '), namespace.setColorAlpha(colors.title, 0.18));


            titleBorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(titleBorderLeftC.join(', '), colors.title);


            titleBorderRightC.push(className + '.klasa');
            namespace.setBorderRightColor(titleBorderRightC.join(', '), colors.title);


        }

        /*
         * Icon color control
         */
        if (Boolean(colors.icon)) {
            iconBC.push(className + '.klasa');
            iconBC.push(className + '.klasa');
            iconBC.push(className + '.klasa');
            iconBC.push(className + '.klasa');
            namespace.setBackgroundColor(iconBC.join(', '), colors.icon);

            iconFC.push(className + '.ideo-pie-chart .circle .number-icon .icon');
            iconFC.push(className + '.ideo-team-box-caption .image .overlay');
            namespace.setColor(iconFC.join(', '), colors.icon);
        }


        /*
         * Text color controls
         */
        if (Boolean(colors.text)) {
            var textBorderTopC = [], textBorderBottomC = [], textBorderLeftC = [], textBorderRightC = [];

            textBC.push(className + '.klasa');
            namespace.setBackgroundColor(textBC.join(', '), colors.text);

            textFC.push(className + '.ideo-iconbox');
            textFC.push(className + '.column-text-styled');
            textFC.push(className + '.ideo-cta-button .ideo-cta-column-content *:not(a)');
            textFC.push(className + '.ideo-iconbox p');
            textFC.push(className + '.ideo-imagebox p');
            textFC.push(className + '.ideo-counter .circle .number-icon p');
            textFC.push(className + '.ideo-message-box .ideo-message-box-content p');
            textFC.push(className + '.ideo-message-box .ideo-message-box-content .message-close');
            textFC.push(className + '.ideo-testimonials-slider .item');
            textFC.push(className + '.ideo-testimonials-slider .item blockquote .company');
            textFC.push(className + '.ideo-contact-form7 input[type="email"]');
            textFC.push(className + '.ideo-contact-form7 input[type="text"]');
            textFC.push(className + '.ideo-contact-form7 textarea');
            textFC.push(className + '.ideo-contact-form7 input[type="number"]');
            textFC.push(className + '.ideo-contact-form7 input[type="tel"]');
            textFC.push(className + '.ideo-contact-form7 input[type="url"]');
            textFC.push(className + '.ideo-contact-form7 input[type="date"]');
            textFC.push(className + '.ideo-contact-form7 input[type="phone"]');
            textFC.push(className + '.ideo-contact-form7 select');
            textFC.push(className + '.ideo-pricing-table');
            textFC.push(className + '.ideo-team-box .name-position .position');
            textFC.push(className + '.ideo-team-box-caption .caption');
            textFC.push(className + '.column-text-styled *');
            textFC.push(className + '.ideo-testimonials-slider .item blockquote .content');
            textFC.push(className + '.ideo-testimonials-slider .item blockquote .content *');
            textFC.push(className + '.ideo-team-box-caption .caption *');
            namespace.setColor(textFC.join(', '), colors.text);


            textBorderC.push(className + '.klasa');
            namespace.setBorderColor(textBorderC.join(', '), colors.text);


            var textBorderC18 = [];
            textBorderC18.push(className + '.ideo-testimonials-slider .item .image img'); 
            namespace.setBorderColor(textBorderC18.join(', '), namespace.setColorAlpha(colors.text, 0.18));


            var textBorderTopC25 = [];
            textBorderTopC25.push(className + '.ideo-pricing-table ul li + li'); 
            namespace.setBorderTopColor(textBorderTopC25.join(', '), namespace.setColorAlpha(colors.text, 0.25));

            var textBorderBottomC25 = [];
            textBorderBottomC25.push(className + '.ideo-pricing-table ul li:last-child'); 
            namespace.setBorderTopColor(textBorderBottomC25.join(', '), namespace.setColorAlpha(colors.text, 0.25));


            textBorderBottomC.push(className + '.klasa');
            namespace.setBorderBottomColor(textBorderBottomC.join(', '), colors.text);


            textBorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(textBorderLeftC.join(', '), colors.text);


            textBorderRightC.push(className + '.klasa');
            namespace.setBorderRightColor(textBorderRightC.join(', '), colors.text);
        }

        /*
         * Background color controls
         */
        if (colors.background) {
            var BorderTopC = [], BorderBottomC = [], BorderLeftC = [], BorderRightC = [], FillC = [];

            BC.push(className + '.accordion .panel-default > .panel-heading .panel-title a.collapsed');
            BC.push(className + '.accordion .panel-collapse');
            BC.push(className + '.container-tabs .tab-content');
            BC.push(className + '.container-tabs .nav-tabs > li.active');
            BC.push(className + '.column-text-styled');
            BC.push(className + '.ideo-cta-button');
            BC.push(className + '.ideo-iconbox');
            BC.push(className + '.ideo-imagebox');
            BC.push(className + '.ideo-counter .circle');
            BC.push(className + '.ideo-message-box .ideo-message-box-content');
            BC.push(className + '.ideo-testimonials-slider .carousel-inner');
            BC.push(className + '.ideo-contact-form7 input[type="email"]');
            BC.push(className + '.ideo-contact-form7 input[type="text"]');
            BC.push(className + '.ideo-contact-form7 input[type="number"]');
            BC.push(className + '.ideo-contact-form7 input[type="tel"]');
            BC.push(className + '.ideo-contact-form7 input[type="url"]');
            BC.push(className + '.ideo-contact-form7 input[type="date"]');
            BC.push(className + '.ideo-contact-form7 input[type="phone"]');
            BC.push(className + '.ideo-contact-form7 select');
            BC.push(className + '.ideo-contact-form7 textarea');
            BC.push(className + '.ideo-wow-title .title-bg');
            BC.push(className + '.ideo-pricing-table');
            BC.push(className + '.ideo-pricing-table.highlight-table .price');
            BC.push(className + '.ideo-team-box-caption .caption');
            namespace.setBackgroundColor(BC.join(', '), colors.background);


            var BC18 = [];
            BC18.push(className + '.ideo-progress-bar .bar'); 
            namespace.setBackgroundColor(BC18.join(', '), namespace.setColorAlpha(colors.background, 0.18));

            var BC60 = [];
            BC60.push(className + '.ideo-team-box .image .overlay'); 
            namespace.setBackgroundColor(BC60.join(', '), namespace.setColorAlpha(colors.background, 0.60));


            FC.push(className + '.klasa');
            namespace.setColor(FC.join(', '), colors.background);


            BorderC.push(className + '.klasa');
            namespace.setBorderColor(BorderC.join(', '), colors.background);


            BorderTopC.push(className + '.ideo-pricing-table.highlight-table');
            namespace.setBorderTopColor(BorderTopC.join(', '), colors.background);


            BorderBottomC.push(className + '.ideo-pricing-table.highlight-table');
            namespace.setBorderBottomColor(BorderBottomC.join(', '), colors.background);


            BorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(BorderLeftC.join(', '), colors.background);


            BorderRightC.push(className + '.klasa');
            namespace.setBorderRightColor(BorderRightC.join(', '), colors.background);

            FillC.push(className + '.ideo-pie-chart .circle svg .bg-circle');
            namespace.setFill(FillC.join(', '), colors.background);

            var backgroundStroke25 = [];
            backgroundStroke25.push(className + '.ideo-pie-chart .circle svg .bg-bar');
            namespace.setStroke(backgroundStroke25.join(', '), namespace.setColorAlpha(colors.background, 0.25));

            namespace.setTitleWingsPattern(className + '.ideo-wow-title[data-wings-svg-type]', colors.background);
            namespace.setShortcodeIconPattern(className + '.diver-icon[data-icon-svg-type]', namespace.setColorAlpha(colors.background, 0.18));

            namespace.setDividerWithIconPattern(className + '.diver-icon[data-svg-type]', colors.background);
        }

        /*
         * Alt title color controls
         */
        if (colors.altTitle) {
            var altTitleBorderTopC = [], altTitleBorderBottomC = [], altTitleBorderLeftC = [], altTitleBorderRightC = [];

            altTitleBC.push(className + '.ideo-single-image-wrap .ideo-single-image .link');
            altTitleBC.push(className + '.ideo-team-box .social a:hover .icon');
            namespace.setBackgroundColor(altTitleBC.join(', '), colors.altTitle);

            altTitleFC.push(className + '.ideo-team-box .social .icon');
            altTitleFC.push(className + '.container-tabs .nav-tabs > li a');
            altTitleFC.push(className + '.button');
            altTitleFC.push(className + '.button span');
            altTitleFC.push(className + '.button i');
            altTitleFC.push(className + '.button:hover');
            altTitleFC.push(className + '.button:hover span');
            altTitleFC.push(className + '.button:focus');
            altTitleFC.push(className + '.button:focus span');
            altTitleFC.push(className + '.button:hover i');
            altTitleFC.push(className + '.button:focus i');
            altTitleFC.push(className + '.ideo-progress-bar .bar .cover .title');
            altTitleFC.push(className + '.ideo-progress-bar .bar .cover .number');
            altTitleFC.push(className + '.ideo-iconbox .icon');
            altTitleFC.push(className + '.ideo-message-box.type-custom .ideo-message-box-content .icon');
            altTitleFC.push(className + '.ideo-testimonials-slider .carousel-control');
            altTitleFC.push(className + '.ideo-single-image-wrap .ideo-single-image:hover .link:hover::before');
            altTitleFC.push(className + '.ideo-icons.style-advanced i.icon');
            altTitleFC.push(className + '.ideo-wow-title.style-icon .title-icon');
            altTitleFC.push(className + '.ideo-pricing-table .price .amount');
            altTitleFC.push(className + '.ideo-pricing-table .price .unit');
            altTitleFC.push(className + '.ideo-pricing-table .price .peroid');
            altTitleFC.push(className + '.ideo-pricing-table.highlight-table');
            altTitleFC.push(className + '.ideo-pricing-table.highlight-table .icon');
            altTitleFC.push(className + '.ideo-pricing-table.highlight-table .title');
            altTitleFC.push(className + '.ideo-pricing-table.highlight-table .subtitle');
            altTitleFC.push(className + '.ideo-team-box .social .icon');
            altTitleFC.push(className + '.ideo-team-box-caption .social a');
            namespace.setColor(altTitleFC.join(', '), colors.altTitle);

            var altTitleFCDarken = [];
            altTitleFCDarken.push(className + '.ideo-icons.style-advanced.icon-hover i.icon:hover'); 
            altTitleFCDarken.push(className + '.ideo-team-box-caption .social a:hover .icon'); 
            namespace.setColor(altTitleFCDarken.join(', '), namespace.setColorDarken(colors.altTitle, 10));


            altTitleBorderC.push(className + '.klasa');
            namespace.setBorderColor(altTitleBorderC.join(', '), colors.altTitle);


            altTitleBorderTopC.push(className + '.klasa');
            namespace.setBorderTopColor(altTitleBorderTopC.join(', '), colors.altTitle);

            var altTitleBorderTopC25 = [];
            altTitleBorderTopC25.push(className + '.ideo-pricing-table.highlight-table ul li + li'); 
            namespace.setBorderTopColor(altTitleBorderTopC25.join(', '), namespace.setColorAlpha(colors.altTitle, 0.25));


            var altTitleBorderBottomC25 = [];
            altTitleBorderBottomC25.push(className + '.container-tabs.vertical .nav-tabs > li a'); 
            altTitleBorderBottomC25.push(className + '.ideo-pricing-table.highlight-table ul li:last-child'); 
            namespace.setBorderBottomColor(altTitleBorderBottomC25.join(', '), namespace.setColorAlpha(colors.altTitle, 0.25));


            altTitleBorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(altTitleBorderLeftC.join(', '), colors.altTitle);


            var altTitleBorderRightC25 = [];
            altTitleBorderRightC25.push(className + '.container-tabs.horizontal .nav-tabs > li a'); 
            namespace.setBorderRightColor(altTitleBorderRightC25.join(', '), namespace.setColorAlpha(colors.altTitle, 0.25));


        }

        if (colors.background || colors.accent) {
            namespace.setIconBoxIconPattern(className + '.ideo-iconbox[data-icon-svg-type]', colors.background, colors.accent ? colors.accent : namespace.getAccentColor());
        }
    };

    /* 
    *  Shortcodes coloring TRANSPARENT STYLES 
    */

    namespace.setShortcodeStylingTransparent = function (className, colors) {

        //selectors for background colors
        var accentBC = [];
        var titleBC = [];
        var iconBC = [];
        var textBC = [];
        var BC = [];
        var altTitleBC = [];

        //selectors for colors 
        var accentFC = [];
        var titleFC = [];
        var iconFC = [];
        var textFC = [];
        var FC = [];
        var altTitleFC = [];

        //selectors for border colors
        var accentBorderC = [];
        var titleBorderC = [];
        var textBorderC = [];
        var altTitleBorderC = [];
        var BorderC = [];

        //selectors for border-top colors
        var accentBorderTopC = [];
        var titleBorderTopC = [];

        //selectors for border-bottom colors
        var accentBorderBottomC = [];
        var titleBorderBottomC = [];

        //selectors for border-left colors
        var accentBorderLeftC = [];
        var titleBorderLeftC = [];

        //selectors for border-right colors
        var accentBorderRightC = [];
        var titleBorderRightC = [];


        /*
         * Accent color control
         */
        if (Boolean(colors.accent)) {
            accentBC.push(className + '.ideo-progress-bar .bar .cover');
            accentBC.push(className + '.type-big-icon .icon i');
            namespace.setBackgroundColor(accentBC.join(', '), colors.accent);

            var accentBC75 = [];
            accentBC75.push(className + '.ideo-message-box.type-custom .ideo-message-box-content::before'); 
            namespace.setBackgroundColor(accentBC75.join(', '), namespace.setColorAlpha(colors.accent, 0.75));

            var accentBC18 = [];
            accentBC18.push(className + '.class'); 
            namespace.setBackgroundColor(accentBC18.join(', '), namespace.setColorAlpha(colors.accent, 0.18));


            accentFC.push(className + '.container-tabs .nav-tabs > li.active a');
            accentFC.push(className + '.container-tabs .nav-tabs > li a:hover');
            accentFC.push(className + '.ideo-testimonials-slider .item blockquote .author');
            accentFC.push(className + '.ideo-pricing-table .price .peroid');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .title');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .price .amount');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .price .unit');
            accentFC.push(className + '.ideo-pricing-table .title');
            accentFC.push(className + '.ideo-pricing-table .price .amount');
            accentFC.push(className + '.ideo-pricing-table .price .unit');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .price .peroid');
            accentFC.push(className + '.ideo-pricing-table .icon');
            accentFC.push(className + '.ideo-pricing-table.highlight-table .icon');
            accentFC.push(className + '.ideo-team-box-caption .social a');
            accentFC.push(className + '.ideo-team-box-caption .name-position .position');
            accentFC.push(className + '.klasa');
            namespace.setColor(accentFC.join(', '), colors.accent);


            accentBorderC.push(className + '.ideo-iconbox.type-small-icon .icon');
            accentBorderC.push(className + '.ideo-icons.style-advanced i.icon');
            accentBorderC.push(className + '.ideo-wow-title .title');
            accentBorderC.push(className + '.ideo-wow-title.style-underlined .title::after');
            accentBorderC.push(className + '.klasa');
            namespace.setBorderColor(accentBorderC.join(', '), colors.accent);

            var accentBorderCDarken = [];
            accentBorderCDarken.push(className + '.ideo-icons.style-advanced.icon-hover i.icon:hover'); 
            namespace.setBorderColor(accentBorderCDarken.join(', '), namespace.setColorDarken(colors.accent, 10));

            accentBorderTopC.push(className + '.accordion .panel-default > .panel-heading .panel-title a');
            accentBorderTopC.push(className + '.container-tabs.horizontal .nav-tabs > li.active a::before');
            accentBorderTopC.push(className + '.ideo-pricing-table.highlight-table');
            accentBorderTopC.push(className + '.klasa');
            namespace.setBorderTopColor(accentBorderTopC.join(', '), colors.accent);


            accentBorderBottomC.push(className + '.ideo-counter .circle .number-icon .number-unit');
            accentBorderBottomC.push(className + '.ideo-pricing-table.highlight-table');
            accentBorderBottomC.push(className + '.klasa');
            namespace.setBorderBottomColor(accentBorderBottomC.join(', '), colors.accent);


            accentBorderLeftC.push(className + '.container-tabs.vertical .nav-tabs > li.active a::before');
            accentBorderLeftC.push(className + '.ideo-cta-button::before');
            accentBorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(accentBorderLeftC.join(', '), colors.accent);


            accentBorderRightC.push(className + '.klasa');
            namespace.setBorderColor(accentBorderRightC.join(', '), colors.accent);

            var accentStrokeC = [];
            accentStrokeC.push(className + '.ideo-pie-chart .circle svg .bar');
            namespace.setStroke(accentStrokeC.join(', '), colors.accent);

            var accentBoxShadowC = [];
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="email"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="text"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="number"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="tel"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="url"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="date"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 input[type="phone"]:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 select:focus');
            accentBoxShadowC.push(className + '.ideo-contact-form7 textarea:focus');
            namespace.setBoxShadow(accentBoxShadowC.join(', '), '0 0 0 2px ' + colors.accent);

            namespace.setShortcodeIconPattern(className + '.ideo-wow-title[data-icon-svg-type]', colors.accent, '.title-icon');
            namespace.setIconBoxIconPattern(className + '.ideo-iconbox[data-icon-svg-type]', colors.accent, namespace.setColorAlpha(colors.accent, 0));

            var accentBorderBottomC25 = [];
            accentBorderBottomC25.push(className + '.ideo-team-box-caption .social'); 
            namespace.setBorderBottomColor(accentBorderBottomC25.join(', '), namespace.setColorAlpha(colors.accent, 0.25));
        }

        /*
         * Title color control
         */
        if (Boolean(colors.title)) {

            titleBC.push(className + '.class');
            namespace.setBackgroundColor(titleBC.join(', '), colors.title);

            var titleBC10 = [];
            titleBC10.push(className + '.ideo-pricing-table .price'); 
            titleBC10.push(className + '.ideo-pricing-table.highlight-table .header'); 
            titleBC10.push(className + '.ideo-pricing-table.highlight-table ul'); 
            titleBC10.push(className + '.ideo-pricing-table.highlight-table .button-wrap'); 
            namespace.setBackgroundColor(titleBC10.join(', '), namespace.setColorAlpha(colors.title, 0.1));

            var titleBC18 = [];
            titleBC18.push(className + '.button:hover'); 
            titleBC18.push(className + '.ideo-progress-bar .bar'); 
            namespace.setBackgroundColor(titleBC18.join(', '), namespace.setColorAlpha(colors.title, 0.18));

            titleFC.push(className + '.button');           
            titleFC.push(className + '.button span');           
            titleFC.push(className + '.button:hover');
            titleFC.push(className + '.button:hover span');
            titleFC.push(className + '.accordion .panel-default > .panel-heading .panel-title a.collapsed');
            titleFC.push(className + '.container-tabs .nav-tabs > li a');
            titleFC.push(className + '.ideo-progress-bar .bar .cover .title');
            titleFC.push(className + '.ideo-progress-bar .bar .cover .number');
            titleFC.push(className + '.ideo-iconbox h4');
            titleFC.push(className + '.ideo-imagebox h4');
            titleFC.push(className + '.ideo-pie-chart .circle .number-icon .number-unit');
            titleFC.push(className + '.ideo-counter .circle .number-icon .number-unit');
            titleFC.push(className + '.ideo-message-box .ideo-message-box-content p.title');
            titleFC.push(className + '.ideo-wow-title .title');
            titleFC.push(className + '.ideo-pricing-table .subtitle');
            titleFC.push(className + '.ideo-pricing-table.highlight-table .subtitle');
            titleFC.push(className + '.ideo-team-box-caption .name-position .name');
            titleFC.push(className + '.ideo-message-box .ideo-message-box-content span.title');
            namespace.setColor(titleFC.join(', '), colors.title);


            titleBorderC.push(className + '.ideo-wow-title.style-underlined .title');
            namespace.setBorderColor(titleBorderC.join(', '), colors.title);

            var titleBorderC18 = [];
            titleBorderC18.push(className + '.button');
            titleBorderC18.push(className + '.button:hover');
            namespace.setBorderColor(titleBorderC18.join(', '), namespace.setColorAlpha(colors.title, 0.18));


            var titleBorderTopC10 = [];
            titleBorderTopC10.push(className + '.ideo-pricing-table:not(.highlight-table) .price::after');
            namespace.setBorderTopColor(titleBorderTopC10.join(', '), namespace.setColorAlpha(colors.title, 0.1));

            var titleBorderTopC18 = [];
            titleBorderTopC18.push(className + '.accordion .panel-default > .panel-heading .panel-title a.collapsed'); 
            titleBorderTopC18.push(className + '.accordion .panel-default:first-child > .panel-heading .panel-title a.collapsed'); 
            titleBorderTopC18.push(className + '.ideo-message-box .ideo-message-box-content');  
            namespace.setBorderTopColor(titleBorderTopC18.join(', '), namespace.setColorAlpha(colors.title, 0.18));

            var titleBorderTopC25 = []; 
            titleBorderTopC25.push(className + '.container-tabs.vertical .nav-tabs > li.active a'); 
            titleBorderTopC25.push(className + '.ideo-pricing-table'); 
            namespace.setBorderTopColor(titleBorderTopC25.join(', '), namespace.setColorAlpha(colors.title, 0.25));


            var titleBorderBottomC10 = [];
            titleBorderBottomC10.push(className + '.ideo-pricing-table.highlight-table .price::after');  
            titleBorderBottomC10.push(className + '.ideo-pricing-table.highlight-table .price::before');  
            namespace.setBorderBottomColor(titleBorderBottomC10.join(', '), namespace.setColorAlpha(colors.title, 0.10));

            var titleBorderBottomC18 = [];
            titleBorderBottomC18.push(className + '.accordion'); 
            titleBorderBottomC18.push(className + '.ideo-iconbox h4 '); 
            titleBorderBottomC18.push(className + '.ideo-imagebox h4'); 
            titleBorderBottomC18.push(className + '.ideo-message-box .ideo-message-box-content');  
            namespace.setBorderBottomColor(titleBorderBottomC18.join(', '), namespace.setColorAlpha(colors.title, 0.18));

            var titleBorderBottomC25 = [];
            titleBorderBottomC25.push(className + '.container-tabs.horizontal .nav-tabs > li a'); 
            titleBorderBottomC25.push(className + '.container-tabs.vertical .nav-tabs > li.active a'); 
            titleBorderBottomC25.push(className + '.ideo-pricing-table'); 
            namespace.setBorderBottomColor(titleBorderBottomC25.join(', '), namespace.setColorAlpha(colors.title, 0.25));


            titleBorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(titleBorderLeftC.join(', '), colors.title);


            titleBorderRightC.push(className + '.klasa');
            namespace.setBorderRightColor(titleBorderRightC.join(', '), colors.title);

            var titleBorderRightC25 = [];
            titleBorderRightC25.push(className + '.container-tabs.vertical .nav-tabs > li a'); 
            titleBorderRightC25.push(className + '.ideo-pricing-table'); 
            titleBorderRightC25.push(className + '.container-tabs.horizontal .nav-tabs > li.active a'); 
            namespace.setBorderRightColor(titleBorderRightC25.join(', '), namespace.setColorAlpha(colors.title, 0.25));

            var titleBorderLeftC25 = [];
            titleBorderLeftC25.push(className + '.container-tabs.horizontal .nav-tabs > li.active a'); 
            titleBorderLeftC25.push(className + '.ideo-pricing-table'); 
            namespace.setBorderLeftColor(titleBorderLeftC25.join(', '), namespace.setColorAlpha(colors.title, 0.25));

            var titleStroke25 = [];
            titleStroke25.push(className + '.ideo-pie-chart .circle svg .bg-bar');
            namespace.setStroke(titleStroke25.join(', '), namespace.setColorAlpha(colors.title, 0.25));

            namespace.setTitleWingsPattern(className + '.ideo-wow-title[data-wings-svg-type]', colors.title);

            namespace.setBoxShadow(className + '.button.button3d', '0 3px 0px ' + namespace.setColorAlpha(colors.title, 0.18));
            namespace.setBoxShadow(className + '.button.button3d:hover', '0 0 0px ' + namespace.setColorAlpha(colors.title, 0.18));
        }

        /*
         * Icon color control
         */
        if (Boolean(colors.icon)) {
            iconBC.push(className + '.klasa');
            namespace.setBackgroundColor(iconBC.join(', '), colors.icon);

           
            iconFC.push(className + '.button i');
            iconFC.push(className + '.button:hover i');
            iconFC.push(className + '.ideo-iconbox .icon');
            iconFC.push(className + '.ideo-pie-chart .circle .number-icon .icon');
            iconFC.push(className + '.ideo-message-box.type-custom .ideo-message-box-content .icon');
            iconFC.push(className + '.ideo-icons i.icon');
            iconFC.push(className + '.ideo-icons.style-advanced i.icon');
            iconFC.push(className + '.ideo-wow-title.style-icon .title-icon');
            iconFC.push(className + '.ideo-team-box-caption .image .overlay');
            iconFC.push(className + '.ideo-custom-list li.with-icon > i.icon');
            namespace.setColor(iconFC.join(', '), colors.icon);

            var iconFCDarken = [];
            iconFCDarken.push(className + '.ideo-icons.icon-hover i.icon:hover'); 
            iconFCDarken.push(className + '.ideo-icons.style-advanced.icon-hover i.icon:hover'); 
            namespace.setColor(iconFCDarken.join(', '), namespace.setColorDarken(colors.icon, 10));
        }

        /*
         * Text color controls
         */
        if (Boolean(colors.text)) {
            var textBorderTopC = [], textBorderBottomC = [], textBorderLeftC = [], textBorderRightC = [];

            textBC.push(className + '.class');
            namespace.setBackgroundColor(textBC.join(', '), colors.text);

            textFC.push(className + '.column-text-styled');
            textFC.push(className + '.ideo-iconbox p');
            textFC.push(className + '.ideo-imagebox p');
            textFC.push(className + '.ideo-counter .circle .number-icon p');
            textFC.push(className + '.ideo-message-box .ideo-message-box-content p');
            textFC.push(className + '.ideo-message-box .ideo-message-box-content .message-close');
            textFC.push(className + '.ideo-testimonials-slider .item');
            textFC.push(className + '.ideo-testimonials-slider .item blockquote .company');
            textFC.push(className + '.ideo-testimonials-slider .carousel-control');
            textFC.push(className + '.ideo-contact-form7 input[type="text"]');
            textFC.push(className + '.ideo-contact-form7 input[type="email"]');
            textFC.push(className + '.ideo-contact-form7 input[type="number"]');
            textFC.push(className + '.ideo-contact-form7 input[type="tel"]');
            textFC.push(className + '.ideo-contact-form7 input[type="url"]');
            textFC.push(className + '.ideo-contact-form7 input[type="date"]');
            textFC.push(className + '.ideo-contact-form7 input[type="phone"]');
            textFC.push(className + '.ideo-contact-form7 select');
            textFC.push(className + '.ideo-contact-form7 textarea');
            textFC.push(className + '.ideo-pricing-table.highlight-table');
            textFC.push(className + '.ideo-pricing-table');
            textFC.push(className + '.ideo-team-box-caption .caption');
            textFC.push(className + '.column-text *');
            textFC.push(className + '.column-text-styled *');
            textFC.push(className + '.ideo-cta-button .ideo-cta-column-content *:not(a)');
            textFC.push(className + '.ideo-custom-list');
            textFC.push(className + '.ideo-testimonials-slider .item blockquote .content');
            textFC.push(className + '.ideo-testimonials-slider .item blockquote .content *');
            textFC.push(className + '.ideo-team-box-caption .caption *');
            namespace.setColor(textFC.join(', '), colors.text);


            textBorderC.push(className + '.klasa');
            namespace.setBorderColor(textBorderC.join(', '), colors.text);

            var textBorderC18 = [];
            textBorderC18.push(className + '.ideo-cta-button');
            textBorderC18.push(className + '.ideo-testimonials-slider .item .image img'); 
            namespace.setBorderColor(textBorderC18.join(', '), namespace.setColorAlpha(colors.text, 0.18));

            var textBorderC50 = [];
            textBorderC50.push(className + '.ideo-contact-form7 input[type="text"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 input[type="email"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 input[type="number"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 input[type="tel"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 input[type="url"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 input[type="date"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 input[type="phone"]'); 
            textBorderC50.push(className + '.ideo-contact-form7 select'); 
            textBorderC50.push(className + '.ideo-contact-form7 textarea'); 
            namespace.setBorderColor(textBorderC50.join(', '), namespace.setColorAlpha(colors.text, 0.50));


            textBorderTopC.push(className + '.klasa');
            namespace.setBorderTopColor(textBorderTopC.join(', '), colors.text);

            var textBorderTopC25 = [];
            textBorderTopC25.push(className + '.ideo-pricing-table ul li + li'); 
            textBorderTopC25.push(className + '.ideo-pricing-table.highlight-table ul li + li'); 
            namespace.setBorderTopColor(textBorderTopC25.join(', '), namespace.setColorAlpha(colors.text, 0.25));


            var textBorderBottomC25 = [];
            textBorderBottomC25.push(className + '.ideo-pricing-table ul li:last-child');
            textBorderBottomC25.push(className + '.ideo-pricing-table.highlight-table ul li:last-child');
            namespace.setBorderBottomColor(textBorderBottomC25.join(', '), namespace.setColorAlpha(colors.text, 0.25));

            var textBorderBottomC20 = [];
            textBorderBottomC20.push(className + '.column-text-styled'); 
            namespace.setBorderBottomColor(textBorderBottomC20.join(', '), namespace.setColorAlpha(colors.text, 0.20));


            textBorderLeftC.push(className + '.klasa');
            namespace.setBorderLeftColor(textBorderLeftC.join(', '), colors.text);

            textBorderRightC.push(className + '.klasa');
            namespace.setBorderRightColor(textBorderRightC.join(', '), colors.text);

            namespace.setShortcodePattern(className + '.diver[data-svg-type]', colors.text);
        }

        /*
         * Background color controls
         */
        if (colors.background) {
            BC.push(className + '.klasa');
            namespace.setBackgroundColor(BC.join(', '), colors.background);

            FC.push(className + '.klasa');
            namespace.setColor(FC.join(', '), colors.background);
        }

        /*
         * Alt title color controls
         */
        if (colors.altTitle) {
            altTitleBC.push(className + '.klasa');
            namespace.setBackgroundColor(altTitleBC.join(', '), colors.altTitle);

            altTitleFC.push(className + '.ideo-team-box .social .icon');
            namespace.setColor(altTitleFC.join(', '), colors.altTitle);
        }
    };

    /* 
    *  Shortcodes (buttons) Colored to transparent styles coloring 
    */

    namespace.setShortcodeStylingColoredToTransparent = function (className, colors) {

        /*
         * Accent color control
         */
        if (Boolean(colors.accent)) {
            var accentBackgroundColor = [];

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            accentBackgroundColor.push(className + className + '.button');

            namespace.setBackgroundColor(accentBackgroundColor.join(', '), colors.accent);


            var accentBorderColor = [];

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            accentBorderColor.push(className + className + '.button');
            accentBorderColor.push(className + className + '.button:hover');

            namespace.setBorderColor(accentBorderColor.join(', '), colors.accent);

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            namespace.setBoxShadow(className + className + '.button.button3d', '0 3px 0 ' + namespace.setColorDarken(colors.accent, 20));
            namespace.setBoxShadow(className + className + '.button.button3d:hover', '0 0 0 ' + namespace.setColorDarken(colors.accent, 20));
        }

        /*
         * Alt title color controls
         */
        if (Boolean(colors.altTitle)) {
            var altTitleFontColor = [];

            // Selector is doubled because of doubled selector in button-colored-to-transparent.less (imported by button.less)
            altTitleFontColor.push(className + className + '.button');
            altTitleFontColor.push(className + className + '.button>span');
            altTitleFontColor.push(className + className + '.button i');

            namespace.setColor(altTitleFontColor.join(', '), colors.altTitle);
        }

        if (Boolean(colors.accent) || Boolean(colors.altTitle)) {
            // If accent color is set we need to use it, if accent is not set but altTitle is we have to set default
            // accent color because otherwise altTitle color will override default hover color
            var color = Boolean(colors.accent) ? colors.accent : namespace.getColorOrAccent();

            var accentFontColor = [];

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            accentFontColor.push(className + className + '.button:hover');
            accentFontColor.push(className + className + '.button:hover>span');
            accentFontColor.push(className + className + '.button:hover i');

            namespace.setColor(accentFontColor.join(', '), color);
        }
    };

    /* 
    *  Shortcodes (buttons) Transparent to Coloredstyles coloring 
    */

    namespace.setShortcodeStylingTransparentToColored = function (className, colors) {

        /*
         * Accent color control
         */
        if (Boolean(colors.accent)) {
            var accentBackgroundColor = [];

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            accentBackgroundColor.push(className + className + '.button:hover');

            namespace.setBackgroundColor(accentBackgroundColor.join(', '), colors.accent);


            var accentBorderColor = [];

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            accentBorderColor.push(className + className + '.button');
            accentBorderColor.push(className + className + '.button:hover');

            namespace.setBorderColor(accentBorderColor.join(', '), colors.accent);


            var accentFontColor = [];

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            accentFontColor.push(className + className + '.button');
            accentFontColor.push(className + className + '.button>span');
            accentFontColor.push(className + className + '.button i');

            namespace.setColor(accentFontColor.join(', '), colors.accent);

            // Selector is doubled because of doubled selectors in button-colored-to-transparent.less (imported by button.less)
            namespace.setBoxShadow(className + className + '.button.button3d', '0 3px 0 ' + namespace.setColorDarken(colors.accent, 20));
            namespace.setBoxShadow(className + className + '.button.button3d:hover', '0 0 0 ' + namespace.setColorDarken(colors.accent, 20));
        }

        /*
         * Alt title color controls
         */
        if (colors.altTitle) {
            var altTitleFontColor = [];

            // Selector is doubled because of doubled selector in button-colored-to-transparent.less (imported by button.less)
            altTitleFontColor.push(className + className + '.button:hover');
            altTitleFontColor.push(className + className + '.button:hover>span');
            altTitleFontColor.push(className + className + '.button:hover i');

            namespace.setColor(altTitleFontColor.join(', '), colors.altTitle);
        }
    };

    namespace.setBlogCommonShortcodeStyling = function (className, blogSelector, colors) {
        /*
         * Accent color control
         */
        if (Boolean(colors.accent)) {
            var accentFontColor = [];
            accentFontColor.push(className + blogSelector + ' blockquote:not(.itQuote).quote:before');
            accentFontColor.push(className + blogSelector + ' blockquote:not(.itQuote).url:before');
            namespace.setColor(accentFontColor.join(', '), colors.accent);

            var accentBackgroundColor = [];
            accentBackgroundColor.push(className + blogSelector + ' .mejs-container .mejs-inner .mejs-controls .mejs-playpause-button');
            accentBackgroundColor.push(className + blogSelector + ' .mejs-controls .mejs-time-rail .mejs-time-current');
            accentBackgroundColor.push(className + blogSelector + ' .mejs-horizontal-volume-current');
            accentBackgroundColor.push(className + blogSelector + ' .mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current');
            accentBackgroundColor.push(className + blogSelector + ' .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current');
            accentBackgroundColor.push(className + blogSelector + ' blockquote:not(.itQuote).quote');
            accentBackgroundColor.push(className + blogSelector + ' blockquote:not(.itQuote).url');
            namespace.setBackgroundColor(accentBackgroundColor.join(', '), colors.accent);

            var accentBackgroundColorDarken = [];
            accentBackgroundColorDarken.push(className + blogSelector + ' blockquote:not(.itQuote).quote:hover');
            accentBackgroundColorDarken.push(className + blogSelector + ' blockquote:not(.itQuote).url:hover');
            namespace.setBackgroundColor(accentBackgroundColorDarken.join(', '), namespace.subtractColors(colors.accent, '#222'));

            var accentBorderTopBottomColor = [];
            accentBorderTopBottomColor.push(className + blogSelector + ' .post-sticky-marker');
            namespace.setBorderTopColor(accentBorderTopBottomColor.join(', '), colors.accent);
            namespace.setBorderBottomColor(accentBorderTopBottomColor.join(', '), colors.accent);
        }

        /*
         * Text color control
         */
        if (Boolean(colors.text)) {
            var textBorderColorFade20 = [];
            textBorderColorFade20.push(className + blogSelector + ' .post-meta');
            namespace.setBorderColor(textBorderColorFade20.join(', '), namespace.setColorAlpha(colors.text, 0.2));
        }

        /*
         * Alternative title color control
         */
        if (Boolean(colors.altTitle)) {
            var altTitleFontColor = [];
            altTitleFontColor.push(className + blogSelector + ' .mejs-controls .mejs-playpause-button button:before');
            altTitleFontColor.push(className + blogSelector + ' blockquote:not(.itQuote).quote');
            altTitleFontColor.push(className + blogSelector + ' blockquote:not(.itQuote).url');
            namespace.setColor(altTitleFontColor.join(', '), colors.altTitle);

            var altTitleBackgroundColor = [];
            altTitleBackgroundColor.push(className + blogSelector + ' blockquote:not(.itQuote).quote:before');
            altTitleBackgroundColor.push(className + blogSelector + ' blockquote:not(.itQuote).url:before');
            namespace.setBackgroundColor(altTitleBackgroundColor.join(', '), colors.altTitle);
        }
    }

    namespace.setBlogListShortcodeStandardPagingStyling = function(className, colors){
        var skin = className == '.skin-colored-ligh' ? 'light' : 'dark';

        var accentColor = namespace.getColorOrAccent(colors.accent);
        var textColor = colors.text;

        if (!textColor)
            textColor = colors.bodyFont;

        $(className + '.pagination.standard').each(function() {
            var selector = '#' + $(this).attr('id') + className + '.pagination.standard';

            if (!namespace.hasLocalModyfication($(this), 'accent_color')) {
                var accentFontColor = [];
                accentFontColor.push(selector + ' a:hover');
                namespace.setColor(accentFontColor.join(', '), accentColor + '!important');

                var accentBackgroundColor = [];
                accentBackgroundColor.push(selector + ' .current');
                namespace.setBackgroundColor(accentBackgroundColor.join(', '), accentColor + '!important');

                var accentBorderColor = [];
                accentBorderColor.push(selector + ' .current');
                accentBorderColor.push(selector + ' a:hover');
                namespace.setBorderColor(accentBorderColor.join(', '), accentColor + '!important');
            }

            if (!namespace.hasLocalModyfication($(this), 'text_color')) {
                var textFontColor = [];
                textFontColor.push(selector + ' a');
                textFontColor.push(selector + ' .dots');
                textFontColor.push(selector + ' .prev:hover');
                textFontColor.push(selector + ' .next:hover');
                namespace.setColor(textFontColor.join(', '), textColor + '!important');

                var textBorderColorFade40 = [];
                textBorderColorFade40.push(selector + ' a');
                textBorderColorFade40.push(selector + ' .dots');
                textBorderColorFade40.push(selector + ' .prev');
                textBorderColorFade40.push(selector + ' .next');
                textBorderColorFade40.push(selector + ' .prev:hover');
                textBorderColorFade40.push(selector + ' .next:hover');
                namespace.setBorderColor(textBorderColorFade40.join(', '), namespace.setColorAlpha(textColor, 0.4) + '!important');

                var textBackgroundColorFade20 = [];
                textBackgroundColorFade20.push(selector + ' .prev:before');
                textBackgroundColorFade20.push(selector + ' .next:before');
                namespace.setBackgroundColor(textBackgroundColorFade20.join(', '), namespace.setColorAlpha(textColor, 0.2) + '!important');
            }
        });

        /*
         * Alternative title color control
         */
        if (Boolean(colors.altTitle)) {
            var altTitleFontColor = [];
            altTitleFontColor.push(className + '.pagination.standard .current');
            namespace.setColor(altTitleFontColor.join(', '), colors.altTitle);
        }
    }

    namespace.setBlogListShortcodeStyling = function (className, colors) {

        namespace.setBlogCommonShortcodeStyling(className, '.blog-lists-posts', colors);
        namespace.setBlogListShortcodeStandardPagingStyling(className, colors);

        /*
         * Accent color control
         */
        if (Boolean(colors.accent)) {
            var accentFontColor = [];
            accentFontColor.push(className + '.blog-lists-posts .post-title a:hover');
            accentFontColor.push(className + '.blog-lists-posts .text-hover:before');
            accentFontColor.push(className + '.blog-lists-posts .text-hover span:before');
            accentFontColor.push(className + '.blog-lists-posts .text-hover:hover > i');
            accentFontColor.push(className + '.blog-lists-posts .read-more > i');
            accentFontColor.push(className + '.blog-lists-posts .read-more:hover > i');
            accentFontColor.push(className + '.blog-lists-posts .social a');
            accentFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .ideo-entry-content .post-title a:hover');
            accentFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .ideo-entry-footer .social li a');
            accentFontColor.push(className + '.blog-lists-posts.blog-list-search .ideo-blog-entry .post-type');
            namespace.setColor(accentFontColor.join(', '), colors.accent);

            var accentFontColorDarken = [];
            accentFontColorDarken.push(className + '.blog-lists-posts .social a:hover');
            accentFontColorDarken.push(className + '.blog-lists-posts .ideo-blog-entry .ideo-entry-footer .social li a:hover');
            namespace.setColor(accentFontColorDarken.join(', '), namespace.subtractColors(colors.accent, '#222'));

            var accentBackgroundColor = [];
            accentBackgroundColor.push(className + '.blog-lists-posts .ideo-blog-entry .date-box .day');
            accentBackgroundColor.push(className + '.blog-lists-posts .ideo-blog-entry .carousel .carousel-control .glyphicon:after');
            accentBackgroundColor.push(className + '.pagination .button');
            namespace.setBackgroundColor(accentBackgroundColor.join(', '), colors.accent);

            var accentBackgroundColorDarken = [];
            accentBackgroundColorDarken.push(className + '.pagination .button:hover');
            namespace.setBackgroundColor(accentBackgroundColorDarken.join(', '), namespace.subtractColors(colors.accent, '#222'));

            var accentBorderColor = [];
            accentBorderColor.push(className + '.pagination .button');
            namespace.setBorderColor(accentBorderColor.join(', '), colors.accent);

            var accentBorderBottomColor = [];
            accentBorderBottomColor.push(className + '.blog-lists-posts.ideo-blog-masonry .ideo-blog-entry::after');
            namespace.setBorderBottomColor(accentBorderBottomColor.join(', '), colors.accent);

            var accentBorderColorDarken = [];
            accentBorderColorDarken.push(className + '.pagination .button:hover');
            namespace.setBorderColor(accentBorderColorDarken.join(', '), namespace.setColorDarken(colors.accent, 10));
        }

        /*
         * Text color control
         */
        if (Boolean(colors.text)) {
            var textFontColor = [];
            textFontColor.push(className + '.blog-lists-posts .ideo-entry-excerpt');
            textFontColor.push(className + '.blog-lists-posts .ideo-entry-excerpt p');
            textFontColor.push(className + '.blog-lists-posts .ideo-entry-excerpt p a');
            textFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .date-box .month');
            textFontColor.push(className + '.blog-lists-posts .post-meta');
            textFontColor.push(className + '.blog-lists-posts .post-meta li:before');
            textFontColor.push(className + '.blog-lists-posts .post-meta li:after');
            textFontColor.push(className + '.blog-lists-posts .post-meta > div');
            textFontColor.push(className + '.blog-lists-posts .post-meta > div:after');
            textFontColor.push(className + '.blog-lists-posts .post-meta a');
            textFontColor.push(className + '.blog-lists-posts .post-meta .author');
            textFontColor.push(className + '.blog-lists-posts .post-meta .categories ul:before');
            textFontColor.push(className + '.blog-lists-posts .post-meta > div:before');
            textFontColor.push(className + '.blog-lists-posts .post-meta > div:after');
            namespace.setColor(textFontColor.join(', '), colors.text);

            var textBorderColorFade20 = [];
            textBorderColorFade20.push(className + '.blog-lists-posts .ideo-blog-entry .ideo-entry-content .ideo-entry-footer');
            textBorderColorFade20.push(className + '.blog-lists-posts.ideo-blog-masonry .ideo-blog-entry:before');
            namespace.setBorderColor(textBorderColorFade20.join(', '), namespace.setColorAlpha(colors.text, 0.2));

            var textBorderBottomColorFade20 = [];
            textBorderBottomColorFade20.push(className + '.blog-lists-posts .post-meta');
            textBorderBottomColorFade20.push(className + '.blog-lists-posts .ideo-blog-entry .ideo-entry-content .ideo-entry-footer');
            namespace.setBorderBottomColor(textBorderBottomColorFade20.join(', '), namespace.setColorAlpha(colors.text, 0.2));
        }

        /*
         * Title color control
         */
        if (Boolean(colors.title)) {
            var titleFontColor = [];
            titleFontColor.push(className + '.blog-lists-posts .read-more');
            titleFontColor.push(className + '.blog-lists-posts .read-more:hover');
            titleFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .ideo-entry-content .post-title a');
            titleFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .date-box .year');
            namespace.setColor(titleFontColor.join(', '), colors.title);
        }

        /*
         * Alternative title color control
         */
        if (Boolean(colors.altTitle)) {
            var altTitleFontColor = [];
            altTitleFontColor.push(className + '.pagination .button');
            altTitleFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .date-box .day');
            altTitleFontColor.push(className + '.blog-lists-posts .ideo-blog-entry .carousel .carousel-control span');
            namespace.setColor(altTitleFontColor.join(', '), colors.altTitle);

            var altTitleBackgroundColorFade20 = [];
            altTitleBackgroundColorFade20.push(className + '.blog-lists-posts .ideo-blog-entry .carousel .carousel-control span');
            namespace.setBackgroundColor(altTitleBackgroundColorFade20.join(', '), namespace.setColorAlpha(colors.altTitle, 0.2));

            var altTitleBackgroundColorFade50 = [];
            altTitleBackgroundColorFade50.push(className + '.blog-lists-posts .ideo-blog-entry .carousel .carousel-indicators li');
            altTitleBackgroundColorFade50.push(className + '.blog-lists-posts .ideo-blog-entry .carousel .carousel-indicators li.active');
            namespace.setBackgroundColor(altTitleBackgroundColorFade50.join(', '), namespace.setColorAlpha(colors.altTitle, 0.5));

            var altTitleBorderColor = [];
            altTitleBorderColor.push(className + '.blog-lists-posts .ideo-blog-entry .carousel .carousel-indicators li.active');
            namespace.setBorderColor(altTitleBorderColor.join(', '), colors.altTitle);
        }

        /*
         * Background color control
         */
        if (Boolean(colors.background)) {
            var backgroundColor = [];
            backgroundColor.push(className + '.blog-lists-posts.ideo-blog-masonry .ideo-blog-entry:before');
            namespace.setBackgroundColor(backgroundColor.join(', '), colors.background);
        }
    }

    namespace.setBlogSingleShortcodeStyling = function (className, colors) {

        namespace.setBlogCommonShortcodeStyling(className, '.ideo-blog-single', colors);

        // /*
        //  * Accent color control
        //  */
        if (Boolean(colors.accent)) {
            var accentFontColor = [];
            accentFontColor.push(className + '.ideo-blog-single .recommended .text-hover:before');
            accentFontColor.push(className + '.ideo-blog-single .recommended .text-hover span:before');
            accentFontColor.push(className + '.ideo-blog-single .recommended .text-hover:hover > i');
            accentFontColor.push(className + '.ideo-blog-single .recommended .recommended-post .read-more > i');
            accentFontColor.push(className + '.ideo-blog-single .recommended .read-more:hover > i');
            accentFontColor.push(className + '.ideo-blog-single .posts-navi > a > i');
            accentFontColor.push(className + '.ideo-blog-single .posts-navi > a:hover > i');
            accentFontColor.push(className + '.ideo-blog-single .post-meta > *:before');
            accentFontColor.push(className + '.ideo-blog-single footer .tags ul a:hover');
            accentFontColor.push(className + '.ideo-blog-single footer .socials ul a:hover');
            accentFontColor.push(className + '.ideo-blog-single footer .author .name');
            accentFontColor.push(className + '.ideo-blog-single .recommended h4:hover');
            accentFontColor.push(className + '.ideo-blog-single .comment-list .comment-author');
            accentFontColor.push(className + '.ideo-blog-single .comment-list .comment-author a');
            accentFontColor.push(className + '.ideo-blog-single .comment-list .reply > a:hover');
            accentFontColor.push(className + '.ideo-blog-single .comment-list .comment-reply-link');
            accentFontColor.push(className + '.ideo-blog-single .comment-form #cancel-comment-reply-link');
            namespace.setColor(accentFontColor.join(', '), colors.accent);

            var accentFontColorDarken = [];
            accentFontColorDarken.push(className + '.ideo-blog-single .comment-form #cancel-comment-reply-link:hover');
            namespace.setColor(accentFontColorDarken.join(', '), namespace.setColorDarken(colors.accent, 10));

            var accentBackgroundColor = [];
            accentBackgroundColor.push(className + '.ideo-blog-single footer .symbol');
            accentBackgroundColor.push(className + '.ideo-blog-single .recommended .recommended-post .comments-count');
            accentBackgroundColor.push(className + '.ideo-blog-single .sub-head:after');
            accentBackgroundColor.push(className + '.ideo-blog-single .button');
            accentBackgroundColor.push(className + '.ideo-blog-single .carousel .carousel-control .glyphicon:after');
            namespace.setBackgroundColor(accentBackgroundColor.join(', '), colors.accent);

            var accentBackgroundColorDarken = [];
            accentBackgroundColorDarken.push(className + '.ideo-blog-single .button:hover');
            namespace.setBackgroundColor(accentBackgroundColorDarken.join(', '), namespace.setColorDarken(colors.accent, 10));

            var accentBorderColor = [];
            accentBorderColor.push(className + '.ideo-blog-single .recommended .recommended-post:after');
            accentBorderColor.push(className + '.ideo-blog-single .comments-container .load-more-button');
            namespace.setBorderColor(accentBorderColor.join(', '), colors.accent);

            var accentBorderColorDarken10 = [];
            accentBorderColorDarken10.push(className + '.ideo-blog-single .comments-container .load-more-button:hover');
            namespace.setBorderColor(accentBorderColorDarken10.join(', '), namespace.setColorDarken(colors.accent, 10));
        }

        /*
         * Text color control
         */
        if (Boolean(colors.text)) {
            var textFontColor = [];
            textFontColor.push(className + '.ideo-blog-single .post-meta');
            textFontColor.push(className + '.ideo-blog-single .post-meta > div');
            textFontColor.push(className + '.ideo-blog-single .post-meta a');
            textFontColor.push(className + '.ideo-blog-single .post-meta .tags');
            textFontColor.push(className + '.ideo-blog-single footer .tags ul a');
            textFontColor.push(className + '.ideo-blog-single footer .socials ul a');
            textFontColor.push(className + '.ideo-blog-single footer .author .status');
            textFontColor.push(className + '.ideo-blog-single footer .post-categories li:before');
            textFontColor.push(className + '.ideo-blog-single .recommended p');
            textFontColor.push(className + '.ideo-blog-single .recommended .recommended-post > a');
            textFontColor.push(className + '.ideo-blog-single .comment-list .comment-body p');
            textFontColor.push(className + '.ideo-blog-single .comment-list .commentmetadata a');
            textFontColor.push(className + '.ideo-blog-single .comment-form .logged-in-as');
            textFontColor.push(className + '.ideo-blog-single .comment-form .logged-in-as a');
            textFontColor.push(className + '.ideo-blog-single footer .post-categories li:before');
            namespace.setColor(textFontColor.join(', '), colors.text);

            var textBorderColorFade20 = [];
            textBorderColorFade20.push(className + '.ideo-blog-single .posts-meta');
            textBorderColorFade20.push(className + '.ideo-blog-single .recommended h4');
            namespace.setBorderColor(textBorderColorFade20.join(', '), namespace.setColorAlpha(colors.text, 0.2));

            var textBorderColorFade25 = [];
            textBorderColorFade25.push(className + '.ideo-blog-single .posts-navi');
            textBorderColorFade25.push(className + '.ideo-blog-single footer .tags');
            textBorderColorFade25.push(className + '.ideo-blog-single footer .socials');
            textBorderColorFade25.push(className + '.ideo-blog-single .comment-list .comment-body');
            namespace.setBorderColor(textBorderColorFade25.join(', '), namespace.setColorAlpha(colors.text, 0.25));

            var textBorderBottomColorFade25 = [];
            textBorderBottomColorFade25.push(className + '.ideo-blog-single .comment-list .comment-body');
            namespace.setBorderBottomColor(textBorderBottomColorFade25.join(', '), namespace.setColorAlpha(colors.text, 0.25));

            var textBackgroundColorFade25 = [];
            textBackgroundColorFade25.push(className + '.ideo-blog-single .comments-container .sub-head:first-child:before');
            namespace.setBackgroundColor(textBackgroundColorFade25.join(', '), namespace.setColorAlpha(colors.text, 0.25));
        }

        // /*
        //  * Title color control
        //  */
        if (Boolean(colors.title)) {
            var titleFontColor = [];
            titleFontColor.push(className + '.ideo-blog-single .recommended .recommended-post .read-more');
            titleFontColor.push(className + '.ideo-blog-single .recommended .recommended-post .read-more:hover');
            titleFontColor.push(className + '.ideo-blog-single .posts-navi > a');
            titleFontColor.push(className + '.ideo-blog-single .posts-navi > a:hover');
            titleFontColor.push(className + '.ideo-blog-single .post-title');
            titleFontColor.push(className + '.ideo-blog-single .recommended h4');
            titleFontColor.push(className + '.ideo-blog-single .sub-head');
            titleFontColor.push(className + '.ideo-blog-single .comment-list .reply > a');
            titleFontColor.push(className + '.ideo-blog-single .comment-list .comment-meta');
            titleFontColor.push(className + '.ideo-blog-single .comment-list .comment-meta > a');
            namespace.setColor(titleFontColor.join(', '), colors.title);
        }

        /*
         * Alternative title color control
         */
        if (Boolean(colors.altTitle)) {
            var altTitleFontColor = [];
            altTitleFontColor.push(className + '.ideo-blog-single footer .symbol');
            altTitleFontColor.push(className + '.ideo-blog-single .recommended .recommended-post .comments-count');
            altTitleFontColor.push(className + '.ideo-blog-single .button');
            altTitleFontColor.push(className + '.ideo-blog-single .carousel .carousel-control .glyphicon:before');
            namespace.setColor(altTitleFontColor.join(', '), colors.altTitle);

            var altTitleBackgroundColorFade20 = [];
            altTitleBackgroundColorFade20.push(className + '.ideo-blog-single .carousel .carousel-control .glyphicon');
            namespace.setBackgroundColor(altTitleBackgroundColorFade20.join(', '), namespace.setColorAlpha(colors.altTitle, 0.2));
        }
    }

    namespace.getShortcodeStylingByType = function (settings, type) {
        var colors = {
            accent: namespace.getColorOrAccent(settings['ideo_theme_options[shortcodes][shortcodes_coloring][sc_' + type + '_accent_color]']),
            title: settings['ideo_theme_options[shortcodes][shortcodes_coloring][sc_' + type + '_title_color]'],
            text: settings['ideo_theme_options[shortcodes][shortcodes_coloring][sc_' + type + '_text_color]'],
            icon: settings['ideo_theme_options[shortcodes][shortcodes_coloring][sc_' + type + '_icon_color]'],
            bodyFont: namespace.getColorOrAccent(settings['ideo_theme_options[fonts][font_coloring][' + namespace.getBodyFontSkin() +'][link]'])
        };

        if (type === 'colored_light' || type === 'colored_dark') {
            colors.background = settings['ideo_theme_options[shortcodes][shortcodes_coloring][sc_' + type + '_background_color]'];
            colors.altTitle = settings['ideo_theme_options[shortcodes][shortcodes_coloring][sc_' + type + '_alternative_title_color]'];
        }

        return colors;
    };

    /*
     * =================== conditions =======================
     */
    namespace.blogIsClassic = function () {
        return $('.blog-lists-posts.ideo-blog-classic').length === 1;
    };

    namespace.blogIsMasonry = function () {
        return $('.blog-lists-posts.ideo-blog-masonry').length === 1;
    };

    namespace.isLocallyModified = function (elem) {
        return elem.hasClass('js--local-modifications') || parseInt(elem.data('local-modifications')) === 1;
    };

    namespace.isBlogPage = function () {
        return $('body').hasClass('blog');
    };

    namespace.isArchivePage = function () {
        return $('body').hasClass('archive');
    };

    namespace.isCategoryPage = function () {
        return $('body').hasClass('category');
    };

    namespace.isSearchPage = function () {
        return $('body').hasClass('search');
    };

    namespace.isSinglePostPage = function () {
        return $('body').hasClass('single-post');
    };

    namespace.is404 = function() {
        return $('body').hasClass('error404');
    };

    namespace.hasArchiveCustomMeta = function (settings) {
        var inherited = namespace.getBool(settings['ideo_theme_options[blog][blog_archives][blog_archives_meta]']);

        return inherited;
    };

    namespace.isSkinLightFooter = function () {
        return namespace.hasSkin($('#footer-content'), 'light');
    };

    namespace.isSkinDarkFooter = function () {
        return namespace.hasSkin($('#footer-content'), 'dark');
    };

    namespace.hasSkin = function (elem, type) {
        if (typeof elem == 'string')
            elem = $(elem);

        var skin = 'skin-' + type;

        return elem.hasClass(skin);
    };

    /*
     * =================== /conditions =======================
     */

    namespace.hasLocalModyfication = function (elem, setting) {
        if (typeof elem == 'string')
            elem = $(elem);

        if (typeof elem.data('local-modifications') == 'undefined') {
            return false;
        }

        var data = elem.data('local-modifications').split(',');
        return data.indexOf(setting) > -1;

    };


    namespace.checkConditions = function (conditions, elem, operator) {
        var checked = true;

        if (typeof operator === 'udenfiend') {
            operator = 'AND';
        }

        for (var i = 0; i < conditions.length; i++) {
            var condition = conditions[i];

            switch (condition) {
                case 'is-archive-page':
                    checked = namespace.isArchivePage();
                    break;
                case 'is-not-archive-page':
                    checked = !namespace.isArchivePage();
                    break;
                case 'is-category-page':
                    checked = namespace.isCategoryPage();
                    break;
                case 'is-not-category-page':
                    checked = !namespace.isCategoryPage();
                    break;
                case 'is-search-page':
                    checked = namespace.isSearchPage();
                    break;
                case 'is-not-search-page':
                    checked = !namespace.isSearchPage();
                    break;
                case 'blog-is-masonry':
                    checked = namespace.blogIsMasonry();
                    break;
                case 'is-locally-modified':
                    checked = !namespace.isLocallyModified(elem);
                    break;
                case 'is-skin-light-footer':
                    checked = namespace.isSkinLightFooter();
                    break;
                case 'is-skin-dark-footer':
                    checked = namespace.isSkinDarkFooter();
                    break;
            }

            if ((!checked && operator === 'AND') || operator === 'OR') {
                break;
            }
        }

        return checked;
    };

    namespace.renderSiedbar = function (selector, name) {
        var data = {
            sidebar: name,
            action: 'render_sidebar'
        };

        var settings = {
            url: _ideo.ajaxurl,
            data: data,
            success: function (data) {
                $(selector).html(data);
                $.fn.initJsScriptsForAjax();
            }
        };


        jQuery.ajax(settings);
    };

    namespace.renderFooter = function () {
        var data = namespace.getDirtySettings();
        data.action = 'render_footer';
        data.ideo_action = 'customize';

        namespace.ajaxRequest('', data, function (html) {
            jQuery('#footer-container').replaceWith(html);
            jQuery('body').removeClass('loader');
            $.fn.runStickyFooter();
        }, namespace.previewUrl);
    };

    namespace.renderPageTitle = function () {
        var data = namespace.getDirtySettings();
        data.action = 'render_page_title';
        data.ideo_action = 'customize';

        namespace.ajaxRequest('', data, function (html) {
            if (jQuery('#header').length > 0) {
                jQuery('#header').replaceWith(html);
            } else {
                jQuery('#page-container').prepend(html);
            }
            jQuery('body').removeClass('loader');
        }, namespace.previewUrl);
    };

    namespace.renderArchivePage = function (url, container) {
        var conditions = ['is-archive-page', 'is-category-page'];

        if (namespace.checkConditions(conditions, $('body'), 'OR')) {
            namespace.renderPage(url, container);
        }
    };

    namespace.renderSearchPage = function (url, container) {
        var conditions = ['is-search-page'];

        if (namespace.checkConditions(conditions, $('body'))) {
            namespace.renderPage(url, container);
        }
    };

    namespace.renderPage = function (url, container, conditions) {
        var data = namespace.getDirtySettings();
        data.ideo_action = 'customize';
        var cb = function (data) {
            jQuery(container).replaceWith(jQuery(container, data));
            jQuery('body').removeClass('loader');
            namespace.renderMasonry();
            $.fn.initJsScriptsForAjax();
        };

        namespace.ajaxRequest(container, data, cb, url);
    };

    namespace.ajaxRequest = function (selector, data, successCallback, url) {
        if (xhr && xhr.readystate != 4) {
            xhr.abort();
        }

        if (typeof successCallback === 'undefined') {
            successCallback = function (data) {
                $(selector).html(data);
            }
        }

        if (typeof url === 'undefined') {
            url = _ideo.ajaxurl;
        }

        jQuery('body').addClass('loader');

        var settings = {
            url: url,
            data: data,
            method: 'post',
            complete: function () {
                jQuery('body').removeClass('loader');
                $.fn.initJsScriptsForAjax();
            },
            success: successCallback
        };


        xhr = jQuery.ajax(settings);
    };

    namespace.findFont = function (name) {
        for (var font in ideo.fonts.items) {
            if (ideo.fonts.items[font].family === name) {
                return ideo.fonts.items[font];
            }
        }

        return false;
    };

    namespace.getFontSubsets = function (name) {
        var font = namespace.findFont(name);

        return font.subsets;
    };

    namespace.getFontVariants = function (name) {
        var font = namespace.findFont(name);

        return font.variants;
    };

    namespace.getFontsBySubsets = function (subset) {
        var fonts = [], fontSubset;

        for (var font in ideo.fonts.items) {
            for (var i = 0; i < ideo.fonts.items[font].subsets.length; i++) {

                fontSubset = ideo.fonts.items[font].subsets[i];
                if (fontSubset === subset) {
                    fonts.push(ideo.fonts.items[font].family);
                }
            }
        }

        return fonts;
    };

    namespace.setupFontSubsets = function (selector, font) {
        var select = $('[data-customize-setting-link="' + selector + '"]');

        var subsets = namespace.getFontSubsets(font);
        namespace.setupSelect(select, subsets, 'first');
    };

    namespace.setupFonts = function (selector, fonts) {
        var select = $('[data-customize-setting-link="' + selector + '"]');
        namespace.setupSelect(select, fonts, 'first');
    };

    namespace.setupFontVariants = function (selector, font) {
        if (font === "") {
            return false;
        }

        var select = $('[data-customize-setting-link="' + selector + '"]');

        var variants = namespace.getFontVariants(font);

        namespace.setupSelect(select, variants, 'first');
    };

    namespace.getDirtySettings = function () {
        var dirty = {};
        window.parent.wp.customize.each(function (value, key) {
            if (value._dirty) {
                dirty[key] = value();
            }
        });

        return dirty;
    };

    namespace.escapeSquareBrackets = function (str) {
        var temp = str.replace(/[[]/g, '\\[');
        return temp.replace(/]/g, '\\]');

    };

    namespace.changeAllFontsFamily = function (fields) {
        _.each(fields, function (obj, field) {
            if (field !== 'ideo_theme_options[fonts][body_font_settings][body_font_family]') {
                var selector = '[data-customize-setting-link="' + namespace.escapeSquareBrackets(field) + '"]';
                if ($(selector).val() === '') {
                    $(selector).change();
                }
            }
        });
    };

    namespace.setupSelect = function (select, options, selected) {

        var curSelected = false;

        $('option', select).each(function () {
            var elem = $(this);
            var value = elem.attr('value');

            elem.attr('disabled', 'disabled');

            if (typeof(value) != 'undefined' && typeof(options) != 'undefined' && (options.indexOf(value) > -1 || value === '')) {
                elem.attr('disabled', false);
            }

            //checking if any previeous selected font is avaible
            if (!elem.attr('disabled') && elem.attr('selected')) {
                curSelected = true;
            }
        });


        if (typeof selected !== 'undefined' && !curSelected) {
            var selectValue = selected;
            if (selected === 'first') {

                selectValue = $("option:enabled", select).first().val();
            }

            select.val(selectValue);
        }

        select.change();
    };

    namespace.removeFromArray = function (arr, value) {
        var index = arr.indexOf(value);

        if (index > -1) {
            arr.splice(index, 1);
        }

        return arr;
    };

    namespace.generateGoogleFontURL = function (fontName, subset, variant) {
        var url = '//fonts.googleapis.com/css?family=' + fontName.replace(/\s/g,'+');

        if (typeof variant !== 'undefined' && variant !== 'default' && variant !== null) {
            if (typeof variant === 'string') {
                url += ':' + variant;
            } else {
                url += ':' + variant.join()
            }
        }

        if (typeof subset !== 'undefined' && subset !== 'default') {
            url += '&subset=' + subset;
        }

        return url;
    };

    namespace.stripGoogleFontsVariant = function (value) {
        var settings = {};

        if (typeof(value) === 'undefined' || value == null) return false;

        if (value.indexOf('italic') > -1) {
            settings['font-style'] = 'italic';
        } else {
            settings['font-style'] = 'normal';
        }

        value = value.replace('regular', '').replace('italic', '');

        settings['font-weight'] = parseInt(value);

        if (isNaN(settings['font-weight'])) {
            settings['font-weight'] = 400;
        }

        return settings;
    };

    namespace.renderMasonry = function () {
        if (namespace.blogIsMasonry()) {
            $.fn.runIsotope();
        }
    };

    namespace.getCustomizerSetting = function (name) {
        var settings = JSON.parse(window.parent.wp.customize.get()['data_postMessage']);
        return settings[name];
    };

    namespace.getAccentColor = function () {
        var accentColor = namespace.getCustomizerSetting('ideo_theme_options[generals][styling][accent_color]');

        if (accentColor == 'custom')
            return namespace.getCustomizerSetting('ideo_theme_options[generals][styling][custom_accent_color]');

        return accentColor;
    }

    namespace.setSidebarAccentColor = function (color, className) {
        var base = '.sidebar.' + className;
        namespace.setWidgetAccentColor(color, base);
    };

    namespace.setSidebarTitleColor = function (color, className) {
        var base = '.sidebar.' + className;
        namespace.setWidgetTitleColor(color, base);
    };

    namespace.setSidebarTextColor = function (color, className) {
        var base = '.sidebar.' + className;
        namespace.setWidgetTextColor(color, base);
    };

    namespace.setPTParallaxEffect = function (enable) {
        var container = $('.page-title').parent('.row');
        if (enable) {
            container.attr('data-motion-speed', 0.5);
            container.attr('data-motion', 'pt-motion');
            $.fn.initParallax();
        } else {
            container.attr('data-motion-speed', '');
            container.attr('data-motion', '');

            jQuery(window).unbind('scroll.ptParallax');
            jQuery(window).unbind('scroll.ptParallax');
        }
    };

    namespace.setPTTitleColor = function (color, className) {
        var fc = [];
        var base = '#header .page-title-container.' + className;

        fc.push(base + ' .page-title h1');
        namespace.setColor(fc.join(', '), color);
    };

    namespace.setPTSubitleColor = function (color, className) {
        var fc = [];
        var base = '#header .page-title-container.' + className;

        fc.push(base + ' .page-title .lead');
        namespace.setColor(fc.join(', '), color);
    };

    namespace.setPTBreadcrumbsTextColor = function (color, className) {
        var fc = [];
        var base = '#header .page-title-container.' + className;

        fc.push(base + ' .breadcrumb li:not(.active)');
        fc.push(base + ' .breadcrumb li:not(.active) a');
        fc.push(base + ' .breadcrumb .home:not(.active)');
        fc.push(base + ' .breadcrumb li:not(.active):before');

        namespace.setColor(fc.join(', '), color);
    };

    namespace.setPTBreadcrumbsTextAccentColor = function (color, className) {
        var fc = [];
        var base = '#header .page-title-container.' + className;

        fc.push(base + ' .breadcrumb li.active');
        namespace.setColor(fc.join(', '), color);
    };

    namespace.setPTBreadcrumbsBgColor = function (color, className) {
        var bc = [];
        var base = '#header .page-title-container.' + className;

        bc.push(base + ' .breadcrumb.bottom');
        namespace.setBackgroundColor(bc.join(', '), color);
    };

    namespace.setPTBreadcrumbsTopBorderColor = function (color, className) {
        var fc = [];
        var base = '#header .page-title-container.' + className;

        fc.push(base + ' .nav-bar .breadcrumb.bottom');
        namespace.setBorderColor(fc.join(', '), color);
    };

    namespace.setWidgetAccentColor = function (color, base) {
        var bc = [], fc = [];

        bc.push(base + ' .widget .widget-title:before');
        bc.push(base + ' .widget .selectric-wrapper .selectric:after');
        bc.push(base + ' .widget .selectric-wrapper .selectric-items li:hover');
        bc.push(base + ' .widget.widget_archive span');
        bc.push(base + ' .widget.widget_calendar table tfoot .im');
        bc.push(base + ' .widget.widget_categories .cat-item span');
        bc.push(base + ' .widget.widget_tag_cloud .tagcloud a:hover');
        bc.push(base + ' .widget.widget_recentpostwidget .newest-list .image a:before');
        namespace.setBackgroundColor(bc.join(', '), color);

        fc.push(base + ' .widget.widget_recentpostwidget .newest-list p.date');
        fc.push(base + ' .widget a:hover');
        fc.push(base + ' .widget.widget_recentpostwidget .newest-list .comments');
        fc.push(base + ' .widget.widget_nav_menu ul.menu > li.menu-item-has-children > a:after');
        fc.push(base + ' .widget.widget_nav_menu ul.menu li a:before');
        fc.push(base + ' .widget.widget_recent_comments .recentcomments:before');
        fc.push(base + ' .widget.widget_recent_comments .recentcomments .comment-author-link');
        fc.push(base + ' .widget.widget_archive li');
        fc.push(base + ' .widget.widget_categories .cat-item');
        fc.push(base + ' .widget.widget_categories .cat-item a:before');
        fc.push(base + ' .widget.widget_recent_entries .post-date');
        namespace.setColor(fc.join(', '), color);
    };

    namespace.setWidgetTitleColor = function (color, base) {
        var fc = [];
        fc.push(base + ' .widget.widget_calendar table caption');
        fc.push(base + ' .widget.widget_calendar table tfoot a:hover');
        fc.push(base + ' .widget .widget-title');

        namespace.setColor(fc.join(', '), color);
    };

    namespace.setWidgetTextColor = function (color, base) {
        var fc = [];
        fc.push(base + ' .widget.widget_text .textwidget');
        fc.push(base + ' .widget.widget_calendar table tfoot a:hover');
        fc.push(base + ' .widget a');
        fc.push(base + ' .widget.widget_recent_comments .recentcomments > div');
        fc.push(base + ' .widget.widget_recent_comments .recentcomments');

        namespace.setColor(fc.join(', '), color);

        namespace.setBorderTopColor(base + ' .widget > ul li', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderTopColor(base + ' .widget > ul li a', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderTopColor(base + ' .widget.widget_archive > ul li', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderTopColor(base + ' .widget.widget_categories > ul li', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderTopColor(base + ' .widget.widget_nav_menu ul.menu li a', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderBottomColor(base + ' .widget.widget_nav_menu ul.menu li:last-child a', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderBottomColor(base + ' .widget.widget_categories ul.menu li:last-child a', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderBottomColor(base + ' .widget.widget_archive  ul.menu li:last-child a', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderBottomColor(base + ' .widget > ul li', namespace.setColorAlpha(color, 0.1));
        namespace.setBorderColor(base + ' .widget.widget_tag_cloud .tagcloud a', namespace.setColorAlpha(color, 0.1));
    };

    /*
     * ======================= CSS settings ==================
     */

    namespace.setFontWeight = function (selector, value) {
        namespace.addRule(selector, 'font-weight', namespace.stripGoogleFontsVariant(value));
    };

    namespace.setFontSize = function (selector, value, defaultValue) {
        if (defaultValue && !value){
            namespace.addRule(selector, 'font-size', defaultValue);
        } else {
            namespace.setDimension(selector, 'font-size', value);
        }
    };

    namespace.setTextTransform = function (selector, value) {
        namespace.addRule(selector, 'text-transform', value);
    };

    namespace.setFontFamily = function (selector, value) {
        if (value === '' || value === 'default') {
            value = namespace.getCustomizerSetting('ideo_theme_options[fonts][body_font_settings][body_font_family]');
        }

        namespace.addRule(selector, 'font-family', "'" + value + "'");
        
    };

    namespace.setLineHeight = function (selector, value) {
        namespace.addRule(selector, 'line-height', value);
    };

    namespace.setLetterSpacing = function (selector, value) {
        if (!value)
            return;

        if (!isNaN(value))
            namespace.setDimension(selector, 'letter-spacing', value);
        else
            namespace.addRule(selector, 'letter-spacing', value);
    };

    namespace.setTextDecoration = function (selector, value) {
        namespace.addRule(selector, 'text-decoration', value);
    };

    namespace.setGlobalFontFamily = function (value) {

        var tags = 'body';

        if (namespace.getCustomizerSetting('ideo_theme_options[fonts][text_tag_settings][h1_font_family]') === '') {
            tags += ',h1';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[fonts][text_tag_settings][h2_font_family]') === '') {
            tags += ',h2';
        }

        tags += ',.widget .widget-title, .widget .widgettitle';

        if (namespace.getCustomizerSetting('ideo_theme_options[fonts][text_tag_settings][h3_font_family]') === '') {
            tags += ',h3';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[fonts][text_tag_settings][h4_font_family]') === '') {
            tags += ',h4';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[fonts][text_tag_settings][h5_font_family]') === '') {
            tags += ',h5';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[fonts][text_tag_settings][h6_font_family]') === '') {
            tags += ',h6';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[shortcodes][button_font][button_font_family]') === '') {
            tags += ',.button';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[pagetitle][page_title_fonts][pt_title_font_family]') === '') {
            tags += ',#header .page-title h1';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[pagetitle][page_title_fonts][pt_subtitle_font_family]') === '') {
            tags += ',#header .lead';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[pagetitle][page_title_fonts][pt_breadcrumbs_font_family]') === '') {
            tags += ',#header .breadcrumb';
        }

        if (namespace.getCustomizerSetting('ideo_theme_options[footer][widgets_title_font][widget_title_font_family]') === '') {
            tags += ',footer#footer-container .widget-title';
        }
        
        if(namespace.getCustomizerSetting('ideo_theme_options[fonts][body_font_settings][body_font_family]') !== 'Open Sans'){
            
            namespace.appendFonts(
                namespace.getCustomizerSetting('ideo_theme_options[fonts][body_font_settings][body_font_family]'), 
                namespace.getCustomizerSetting('ideo_theme_options[fonts][font_family][global_font_extension]'), 
                namespace.getCustomizerSetting('ideo_theme_options[fonts][body_font_settings][body_font_weight]')
            );
        }

        namespace.setFontFamily(tags, value);
    };
    
    namespace.appendFonts = function (name, subset, weight) {
        if(name && name.toLowerCase() != 'default'){
            $('head').append('<link href="' + namespace.generateGoogleFontURL(name, subset, weight) + '" rel="stylesheet" type="text/css">');            
        }
    };
    
    namespace.setPadding = function (selector, top, right, bottom, left) {
        if (top !== false) {
            namespace.setDimension(selector, 'padding-top', top);
        }

        if (right !== false) {
            namespace.setDimension(selector, 'padding-right', right);
        }

        if (bottom !== false) {
            namespace.setDimension(selector, 'padding-bottom', bottom);
        }

        if (left !== false) {
            namespace.setDimension(selector, 'padding-left', left);
        }
    };

    namespace.setMargin = function (selector, top, right, bottom, left) {
        if (top !== false) {
            namespace.setDimension(selector, 'margin-top', top);
        }

        if (right !== false) {
            namespace.setDimension(selector, 'margin-right', right);
        }

        if (bottom !== false) {
            namespace.setDimension(selector, 'margin-bottom', bottom);
        }

        if (left !== false) {
            namespace.setDimension(selector, 'margin-left', left);
        }
    };

    namespace.setPositionValue = function (selector, top, right, bottom, left) {
        if (top !== false) {
            namespace.setDimension(selector, 'top', top);
        }

        if (right !== false) {
            namespace.setDimension(selector, 'right', right);
        }

        if (bottom !== false) {
            namespace.setDimension(selector, 'bottom', bottom);
        }

        if (left !== false) {
            namespace.setDimension(selector, 'left', left);
        }
    };

    namespace.setWidth = function (selector, value, unit) {
        namespace.setDimension(selector, 'width', value, unit);
    };

    namespace.setMaxWidth = function (selector, value, unit) {
        namespace.setDimension(selector, 'max-width', value, unit);
    };

    namespace.setMinHeight = function (selector, value, unit) {
        namespace.setDimension(selector, 'min-height', value, unit);
    };

    namespace.setHeight = function (selector, value, unit) {
        namespace.setDimension(selector, 'height', value, unit);
    };

    namespace.setTop = function (selector, value, unit) {
        namespace.setDimension(selector, 'top', value, unit);
    };

    namespace.setBottom = function (selector, value, unit) {
        namespace.setDimension(selector, 'bottom', value, unit);
    };

    namespace.setColor = function (selector, value, conditions) {
        namespace.addRule(selector, 'color', value, conditions);
    };

    namespace.setBackgroundColor = function (selector, value, conditions) {
        namespace.addRule(selector, 'background-color', value, conditions);
    };

    namespace.setBackgroundImage = function (selector, value, conditions) {
        namespace.addRule(selector, 'background-image', 'url(' + value + ')', conditions);
    };

    namespace.setBackgroundImagePosition = function (selector, value, conditions) {
        namespace.addRule(selector, 'background-position', value.replace('_', ' '), conditions);
    };

    namespace.setBackgroundAttachment = function (selector, value, conditions) {
        namespace.addRule(selector, 'background-attachment', value, conditions);
    };

    namespace.setBackgroundRepeat = function (selector, value, conditions) {

        var obj = {};
        obj['no_repeat'] = 'no-repeat';
        obj['repeat_x'] = 'repeat-x';
        obj['repeat_y'] = 'repeat-y';
        obj['repeat'] = 'repeat';

        namespace.addRule(selector, 'background-repeat', obj[value], conditions);
    };

    namespace.setBackgroundSize = function (selector, value, conditions) {

        var values = ['auto', 'cover', 'contain'];

        if (values.indexOf(value) === -1) {
            if (namespace.getBool(value)) {
                value = 'cover';
            } else {
                value = 'auto';
            }
        }

        namespace.addRule(selector, 'background-size', value, conditions);
    };


    namespace.setBackgroundOverlay = function (selector, value, backgroundType) {

        $(selector).removeClass('background-overlay background-overlay-color-color background-overlay-color-pattern background-overlay-image-color background-overlay-image-pattern background-overlay-video-color background-overlay-video-pattern');

        if (value != 'none') {
            $(selector).addClass('background-overlay background-overlay-' + backgroundType + '-' + value);
        }
    };

    namespace.setFill = function (selector, value, conditions) {
        namespace.addRule(selector, 'fill', value, conditions);
    };

    namespace.setStroke = function (selector, value, conditions) {
        namespace.addRule(selector, 'stroke', value, conditions);
    };

    namespace.setBorderRadius = function (selector, value, conditions) {
        namespace.addRule(selector, 'border-radius', value, conditions);
    };

    namespace.setBorderWidth = function (selector, value, borders) {
        if (typeof borders === 'undefined') {
            namespace.setDimension(selector, 'border-width', value);
            return;
        }

        if (borders.left) {
            namespace.setDimension(selector, 'border-left-width', value);
        }

        if (borders.right) {
            namespace.setDimension(selector, 'border-right-width', value);
        }

        if (borders.top) {
            namespace.setDimension(selector, 'border-top-width', value);
        }

        if (borders.bottom) {
            namespace.setDimension(selector, 'border-bottom-width', value);
        }
    };

    namespace.setBorderColor = function (selector, value, borders) {

        if (typeof borders === 'undefined') {
            namespace.addRule(selector, 'border-color', value);
            return;
        }

        if (borders.left) {
            namespace.addRule(selector, 'border-left-color', value);
        }

        if (borders.right) {
            namespace.addRule(selector, 'border-right-color', value);
        }

        if (borders.top) {
            namespace.addRule(selector, 'border-top-color', value);
        }

        if (borders.bottom) {
            namespace.addRule(selector, 'border-bottom-color', value);
        }
    };

    namespace.setBorderTopColor = function (selector, value) {
        namespace.setBorderColor(selector, value, {top: true});
    };

    namespace.setBorderBottomColor = function (selector, value) {
        namespace.setBorderColor(selector, value, {bottom: true});
    };

    namespace.setBorderLeftColor = function (selector, value) {
        namespace.setBorderColor(selector, value, {left: true});
    };

    namespace.setBorderRightColor = function (selector, value) {
        namespace.setBorderColor(selector, value, {right: true});
    };

    namespace.setBorderTopColor = function (selector, value) {
        namespace.addRule(selector, 'border-top-color', value);
    };

    namespace.setBoxShadow = function (selector, value) {
        namespace.addRule(selector, 'box-shadow', value);
        namespace.addRule(selector, '-moz-box-shadow', value);
        namespace.addRule(selector, '-webkit-box-shadow', value);
    };

    namespace.hexToRGBA = function (hex, alpha) {
        var hex = hex.replace('#', ''),
        r = parseInt(hex.substring(0, 2), 16),
        g = parseInt(hex.substring(2, 4), 16),
        b = parseInt(hex.substring(4, 6), 16),
        result = 'rgba(' + r + ',' + g + ',' + b + ',' + alpha + ')';

        return result;
    }

    namespace.changeAlphaInRGBA = function (value, alpha) {
        alpha = value.match(/[\d]\.[\d]+/) * alpha;
        value = value.replace(/[\d\.]+\)$/g, alpha + ')');

        return value;
    }

    namespace.setDimension = function (selector, property, number, unit) {

        if (typeof unit === 'undefined') {
            unit = 'px';
        }

        var fontSize = number;

        if (namespace.valueHasNoUnit(number)) {
            fontSize = number + unit;
        }
        namespace.addRule(selector, property, fontSize);
    };
    /**
     *
     * @param string selector
     * @param string property
     * @param mixed value
     * @param array conditions
     * @returns undefined
     */
    namespace.addRule = function (selector, property, value, conditions) {
        if (typeof namespace.rules[selector] === 'undefined') {
            namespace.rules[selector] = {};
        }

        if (!conditions)
            conditions = {};

        if (typeof value === 'object') {
            for (var attrname in value) {
                namespace.rules[selector][attrname] = value[attrname] + (conditions.important ? ' !important' : '');
            }
        } else {
            namespace.rules[selector][property] = value + (conditions.important ? ' !important' : '');
        }
    };

    namespace.setTextAlign = function (selector, value) {
        namespace.addRule(selector, 'text-align', value);
    };

    /**
     * Set alpha of color
     *
     * @param {type} color css color value
     * @param {type} alpha number from 0 to 1
     * @returns string css rgba color
     */
    namespace.setColorAlpha = function (color, alpha) {
        var newColor = tinycolor(color);

        newColor.setAlpha(alpha);

        return newColor.toRgbString();
    };

    /**
     * Set color more darken
     *
     * @param {type} color css color value
     * @param {type} darkenBy number from 0 to 100
     * @returns string css rgba color
     */
    namespace.setColorDarken = function (color, darkenBy) {
        var newColor = tinycolor(color);

        newColor.darken(darkenBy);

        return newColor.toRgbString();
    };

    /**
     * Set color more lighten
     *
     * @param {string} color css color value
     * @param {number} lightenBy number from 0 to 100
     * @returns string css rgba color
     */
    namespace.setColorLighten = function (color, lightenBy) {
        var newColor = tinycolor(color);

        newColor.lighten(lightenBy);

        return newColor.toRgbString();
    };

    /**
     * Subtracts to colors and returns rgb string
     *
     * @param {type} color css color value
     * @param {type} subtract css subtract value
     * @returns string css rgba color
     */
    namespace.subtractColors = function (color, subtract) {
        var color = tinycolor(color).toRgb();
        var subtract = tinycolor(subtract).toRgb();

        return tinycolor('rgb ' + (color.r - subtract.r) + ' ' + (color.g - subtract.g) + ' ' + ' ' + (color.b - subtract.b)).toRgbString();
    };

    namespace.setThemeSkin = function (selector, value, invert, defaultValue) {

        var defaultSkin = namespace.getCustomizerSetting('ideo_theme_options[generals][styling][theme_skin]');

        if (!value || value.length == 0) {
            if (!invert) {
                value = defaultSkin;
            } else {
                value = defaultSkin == 'light' ? 'dark' : 'light';
            }
            if(defaultValue){
                value = defaultValue;
            }
        }

        $(selector).removeClass('skin-light skin-dark').addClass('skin-' + value);
    };

    namespace.setStaticSkin = function (selector, value, defaultValue) {

        if (!value || value.length == 0) {
            value = defaultValue;
        }

        $(selector).removeClass('skin-light skin-dark').addClass('skin-' + value);
    };


    namespace.setBackgroundByType = function (coreSelector, settings) {
        $(coreSelector).removeClass('background-overlay-pattern background-overlay-color background-overlay background-overlay-image-pattern background-overlay-video-pattern background-overlay-color-pattern background-type-default background-type-color background-type-image background-type-video background-motion-fixed background-motion-scroll background-motion-parallax');
        $(coreSelector).find('> .ytplayer-container, > video, > .ytplayer-shield, > .background-video .ytplayer-container, > .background-video video, > .background-video .ytplayer-shield').remove();


        if ('' === settings.type) {
            $(coreSelector).addClass('background-type-default');
        }

        if ('color' === settings.type) {
            $(coreSelector).addClass('background-type-color');
            namespace.setBackgroundColor(coreSelector + '.background-type-color', settings.color);
            namespace.setBackgroundColor(coreSelector + '.background-type-color:before', 'transparent');
            namespace.setBackgroundOverlayNew(coreSelector, settings.overlay);
        }

        if ('image' === settings.type) {
            $(coreSelector).addClass('background-type-image');

            if (settings.color === 'transparent') {
                namespace.setBackgroundColor(coreSelector + '.background-type-image', settings.color);
            }

            namespace.setBackgroundImage(coreSelector + '.background-type-image', settings.image);
            namespace.setBackgroundSize(coreSelector + '.background-type-image', settings.size);
            namespace.setBackgroundImagePosition(coreSelector + '.background-type-image', settings.position);
            namespace.setBackgroundRepeat(coreSelector + '.background-type-image', settings.repeat);

            if (settings.motion) {
                namespace.destroyParallaxBgEffect(coreSelector);

                $(coreSelector).addClass('background-motion-' + settings.motion);

                if (settings.motion !== 'parallax') {
                    namespace.setBackgroundAttachment(coreSelector + '.background-type-image', settings.motion);
                    namespace.setBackgroundAttachment(coreSelector + '.background-overlay-pattern .pt-overlay', settings.motion);
                } else {
                    namespace.setParallaxBgEffect(coreSelector, settings.motionSpeed);
                }
            }
            namespace.setBackgroundOverlayNew(coreSelector, settings.overlay);
        }

        if ('video' === settings.type) {
            $(coreSelector).addClass('background-type-video');
            namespace.videoBackground(coreSelector, settings.video);
            namespace.setBackgroundOverlayNew(coreSelector, settings.overlay);
        }
    };

    namespace.setSideHeaderBackground = function (settings) {
        var skin = settings['ideo_theme_options[header][side][style]'] || settings['ideo_theme_options[generals][styling][theme_skin]'];
        
        var selector = '#header.customize-preview #leftside-navbar.skin-' + skin;
        var type = settings['ideo_theme_options[header][side][' + skin + '][styling][background]'];

        var bgSettings = {
            type: type,
            color: settings['ideo_theme_options[header][side][' + skin + '][styling][color_background][background_color]'],
            image: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][background_image]'],
            size: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_size]'],
            position: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_position]'],
            repeat: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_repeat]'],
        };

        if ('color' === type) {
            bgSettings.overlay = {
                type: 'pattern',
                color: settings['ideo_theme_options[header][side][' + skin + '][styling][color_background][background_color]'],
                pattern: settings['ideo_theme_options[header][side][' + skin + '][styling][color_background][pattern_overlay]'],
                patternColor: settings['ideo_theme_options[header][side][' + skin + '][styling][color_background][pattern_color]']
            }
        }

        if ('image' === type) {
            bgSettings.color = 'transparent';

            bgSettings.overlay = {
                type: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_overlay][type]'],
                color: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_overlay][color][pattern_color]'],
                pattern: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_overlay][pattern][type]'],
                patternColor: settings['ideo_theme_options[header][side][' + skin + '][styling][image_background][image_overlay][pattern][color]']
            }
        }

        namespace.setBackgroundByType(selector, bgSettings);
    }

    namespace.setParallaxBgEffect = function (coreSelector, speed, motion) {
        var elem = $(coreSelector);

        if (typeof motion === 'undefined') {
            motion = 'parallax';
        }

        elem.attr('data-motion', motion);
        elem.attr('data-motion-speed', speed);
    };

    namespace.destroyParallaxBgEffect = function (coreSelector) {
        var elem = $(coreSelector);

        if(typeof $.fn.parallax.destroy == 'function'){
            $.fn.parallax.destroy();            
        }

        elem.attr('data-motion', 'none');
        elem.attr('data-motion-speed', '');
        elem.css('background-position', '');

        var childElem = elem.find('pt-overlay');
        childElem.attr('data-motion', 'none');
        childElem.attr('data-motion-speed', '');
        childElem.css('background-position', '');
    };

    namespace.setBackgroundOverlayNew = function (selector, overlay) {
        var bgContainer = (/body\.skin-[^ ]+ #header/.test(selector)) ? ' .pt-overlay' : ':before';

        if ('color' === overlay.type) {
            $(selector).addClass('background-overlay-color');
            namespace.setBackgroundColor(selector + '.background-overlay-color' + bgContainer, overlay.color);
        }
        if ('pattern' === overlay.type) {
            $(selector).addClass('background-overlay-pattern');
            namespace.setBackgroundPattern(selector + '.background-overlay-pattern' + bgContainer, overlay.pattern, overlay.patternColor);
        }
    };

    namespace.removeBackgroundPattern = function (selector) {
        $(selector).css('background-image', 'none');
    };

    namespace.setShortcodePattern = function (selector, color) {
        $(selector).each(function () {
            var pattern = $(this).attr('data-svg-type');
            namespace.setBackgroundPattern('#' + $(this).attr('id'), pattern, color, {important: true})
        });
    };

    namespace.setDividerWithIconPattern = function (selector, color) {
        $(selector).each(function () {
            var pattern = $(this).attr('data-svg-type');
            namespace.setBackgroundPattern('#' + $(this).attr('id') + ' .line-left, #' + $(this).attr('id') + ' .line-right', pattern, color, {important: true})
        });
    };

    namespace.setShortcodeIconPattern = function (selector, color, iconSelector) {
        $(selector).each(function () {
            var pattern = $(this).attr('data-icon-svg-type');
            namespace.setBackgroundPattern('#' + $(this).attr('id') + ' ' + (iconSelector ? iconSelector : '.icon'), pattern, color, {important: true})
        });
    };

    namespace.setShortcodeIconColor = function (selector, color) {
        $(selector).each(function () {
            namespace.setColor('#' + $(this).attr('id') + ' i', color)
        });
    };

    namespace.shortCodeColor = function (selector, color) {
        $(selector).each(function () {
            namespace.setColor('#' + $(this).attr('id'), color)
        });
    };

    namespace.setIconBoxIconPattern = function (selector, color1, color2) {
        $(selector).each(function () {
            var pattern = $(this).attr('data-icon-svg-type');
            var params = $(this).attr('data-icon-svg-params').split('/');
            namespace.setBackgroundPattern('#' + $(this).attr('id') + ' .icon', pattern, {
                color: params[0] ? params[0] : color1,
                color2: params[1] ? params[1] : color2,
                radius: params[2],
                stroke: params[3]
            }, {important: true});
        });
    };

    namespace.setTitleWingsPattern = function (selector, color) {
        $(selector).each(function () {
            var pattern = $(this).attr('data-wings-svg-type');
            namespace.setBackgroundPattern('#' + $(this).attr('id') + ' .title-bg::before, #' + $(this).attr('id') + ' .title-bg::after', pattern, color, {important: true});
        });
    };

    namespace.getPatternPreviewUrl = function (pattern, color) {
        var url = _ideo.ajaxurl + '?action=svgmask_preview&mask=' + pattern;
        
        if (typeof(color) == 'object') {
            for (var key in color){
                url += '&' + key + '=' + namespace.urlEncode(color[key].replace('#', ''));                 
            }
        } else{
            url += '&color=' + (color.replace('#', '').replace('(', '_').replace(')', '_'));            
        }
        
        return url;
    };

    namespace.setBackgroundPattern = function (selector, pattern, color, conditions) {
        namespace.setBackgroundImage(selector, namespace.getPatternPreviewUrl(pattern, color), conditions);
    };

    namespace.videoYTPlayer = null;

    namespace.runYoutubeVideo = function (selector, videoId) {

        var player = $(selector).data('ytPlayer');
        if (player) player.destroy();

        namespace.videoYTPlayer = $(selector).YTPlayer(
            {
                'videoId': videoId,
                'playerVars': {
                    origin: window.location.origin
                }
            }
        );

    };

    namespace.getYouTubeVideoId = function (url) {

        if (!url) return false;

        var video_id = url.split('v=')[1];
        var ampersandPosition = video_id.indexOf('&');
        if (ampersandPosition != -1) {
            return video_id.substring(0, ampersandPosition);
        }

        return video_id;
    };

    namespace.destroyVideoBackground = function (selector) {
        //destroy ytPlayer
        var player = $(selector).data('ytPlayer');
        if (player) player.destroy();

        //destroy selfhost
        $(selector).find('video').each(function () {
            this.pause();
            delete this;
            $(this).remove();
        });
    };

    namespace.videoBackground = function (selector, settings) {
        if (typeof settings !== 'object') {
            return false;
        }

        var videoId = namespace.getYouTubeVideoId(settings.youtube);


        namespace.destroyVideoBackground($(selector).find('.background-video'));

        if (settings.platform == 'youtube') {
            namespace.runYoutubeVideo($(selector).find('.background-video'), videoId);
        } else if (settings.platform == 'self_hosted') {
            if ($(selector).find('.background-video').length) {
                $(selector).find('.background-video').remove();
            }
            $(selector).append(namespace.generateVideoHtml(settings.mp4, settings.webm, '', settings.fallbackImage));
        }
    };

    namespace.generateVideoHtml = function (mp4, webm, classes, fallback_image) {

        var html = '';

        if ((webm.length + mp4.length) > 0) {
            html = html + '<div class="background-video ' + classes + '"> <video autoplay loop poster="' + fallback_image + '" muted>';

            if (webm.length > 0) {
                html = html + '<source src="' + webm + '" type="video/webm">';
            }

            if (mp4.length > 0) {
                html = html + '<source src="' + mp4 + '" type="video/mp4">';
            }

            html = html + '</video></div>';
        }

        return html;
    };

    namespace.setContentBackground = function (settings) {
        var bgSettings = {};
        bgSettings.overlay = {};

        bgSettings.type = settings['ideo_theme_options[generals][background][content_background_type]'];


        if ('color' === bgSettings.type) {
            bgSettings.overlay.type = settings['ideo_theme_options[generals][background][content_background_color_overlay]'];
            bgSettings.color = settings['ideo_theme_options[generals][background][content_background_color]'];
            bgSettings.overlay.color = settings['ideo_theme_options[generals][background][content_background_color_overlay_color]'];
            bgSettings.overlay.patternColor = settings['ideo_theme_options[generals][background][content_background_color_pattern_color]'];
            bgSettings.overlay.pattern = settings['ideo_theme_options[generals][background][content_background_color_pattern]'];
        }

        if ('image' === bgSettings.type) {
            bgSettings.image = settings['ideo_theme_options[generals][background][content_background_upload_image]'];
            bgSettings.size = settings['ideo_theme_options[generals][background][content_background_cover]'];
            bgSettings.position = settings['ideo_theme_options[generals][background][content_background_image_position]'];
            bgSettings.repeat = settings['ideo_theme_options[generals][background][content_background_image_repeat]'];
            bgSettings.motion = settings['ideo_theme_options[generals][background][content_background_image_motion]'];
            bgSettings.overlay.type = settings['ideo_theme_options[generals][background][content_background_image_overlay]'];
            bgSettings.overlay.color = settings['ideo_theme_options[generals][background][content_background_image_overlay_color]'];
            bgSettings.overlay.patternColor = namespace.getCustomizerSetting('ideo_theme_options[generals][background][content_background_image_overlay_pattern_color]');
            bgSettings.overlay.pattern = namespace.getCustomizerSetting('ideo_theme_options[generals][background][content_background_image_overlay_pattern]');
        }

        namespace.setBackgroundByType('body.skin-light #content', bgSettings);
        namespace.setBackgroundByType('body.skin-dark #content', bgSettings);
    };

    namespace.setBodyBackground = function (settings) {
        var bgSettings = {};
        bgSettings.overlay = {};

        bgSettings.type = settings['ideo_theme_options[generals][background][boxed_background_type]'];


        if ('color' === bgSettings.type) {
            bgSettings.overlay.type = settings['ideo_theme_options[generals][background][boxed_background_color_overlay]'];
            bgSettings.color = settings['ideo_theme_options[generals][background][boxed_background_color]'];
            bgSettings.overlay.color = settings['ideo_theme_options[generals][background][boxed_background_color_overlay_color]'];
            bgSettings.overlay.patternColor = settings['ideo_theme_options[generals][background][boxed_background_color_pattern_color]'];
            bgSettings.overlay.pattern = settings['ideo_theme_options[generals][background][boxed_background_color_pattern]'];
        }

        if ('image' === bgSettings.type) {
            bgSettings.image = settings['ideo_theme_options[generals][background][boxed_background_upload_image]'];
            bgSettings.size = settings['ideo_theme_options[generals][background][boxed_background_cover]'];
            bgSettings.position = settings['ideo_theme_options[generals][background][boxed_background_image_position]'];
            bgSettings.repeat = settings['ideo_theme_options[generals][background][boxed_background_image_repeat]'];
            bgSettings.motion = settings['ideo_theme_options[generals][background][boxed_background_image_motion]'];
            bgSettings.overlay.type = settings['ideo_theme_options[generals][background][boxed_background_image_overlay]'];
            bgSettings.overlay.color = settings['ideo_theme_options[generals][background][boxed_background_image_overlay_color]'];
            bgSettings.overlay.patternColor = namespace.getCustomizerSetting('ideo_theme_options[generals][background][boxed_background_image_overlay_pattern_color]');
            bgSettings.overlay.pattern = namespace.getCustomizerSetting('ideo_theme_options[generals][background][boxed_background_image_overlay_pattern]');
        }
        if (!namespace.hasLocalModyfication($('body'), 'generals.background.boxed_background_type')) {
            namespace.setBackgroundByType('.background-page', bgSettings);
        }
    };

    namespace.setPTBackground = function (settings) {
        var bgSettings = {};
        bgSettings.overlay = {};

        bgSettings.type = settings['ideo_theme_options[pagetitle][page_title_background][page_title_area_background]'];

        if ('color' === bgSettings.type) {
            bgSettings.overlay.type = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_color_overlay]'];
            bgSettings.color = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_color]'];
            bgSettings.overlay.color = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_color_overlay_color]'];
            bgSettings.overlay.patternColor = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_color_pattern_color]'];
            bgSettings.overlay.pattern = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_color_pattern]'];
        }

        if ('image' === bgSettings.type) {
            bgSettings.image = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_upload_image]'];
            bgSettings.size = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_cover]'];
            bgSettings.position = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_image_position]'];
            bgSettings.repeat = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_image_repeat]'];
            bgSettings.motion = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_motion]'];
            bgSettings.motionSpeed = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_moving_speed]'];
            bgSettings.overlay.type = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_image_overlay]'];
            bgSettings.overlay.color = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_image_overlay_color]'];
            bgSettings.overlay.patternColor = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_image_overlay_pattern_color]'];
            bgSettings.overlay.pattern = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_image_overlay_pattern]'];
        }

        if ('video' === bgSettings.type) {
            bgSettings.video = {};
            bgSettings.video.platform = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_video_platform]'];
            bgSettings.video.youtube = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_youtube]'];
            bgSettings.video.mp4 = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_mp4]'];
            bgSettings.video.webm = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_webm]'];
            bgSettings.video.fallbackImg = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_fallback_image]'];
            bgSettings.overlay.type = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_video_overlay]'];
            bgSettings.overlay.color = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_video_overlay_color]'];
            bgSettings.overlay.patternColor = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_video_overlay_pattern_color]'];
            bgSettings.overlay.pattern = settings['ideo_theme_options[pagetitle][page_title_background][pt_background_video_overlay_pattern]'];
        }

        namespace.setBackgroundByType('body.skin-light #header', bgSettings);
        namespace.setBackgroundByType('body.skin-dark #header', bgSettings);
    };

    namespace.setHeaderLogo = function (type, settings) {
        if (namespace.hasLocalModyfication('#header', 'header.' + type + '.logo.type'))
            return;

        var logo = settings['ideo_theme_options[header][' + type + '][logo][type]'];
        
        var selector, src;

        if (type == 'side')
            selector = '#leftside-navbar';
        else
            selector = 'nav.navbar-' + (type == 'sticky' ? 'sticky' : 'standard');

        if (type == 'sticky' && (logo == 'sticky.light' || logo == 'sticky.dark')) {
            src = settings['ideo_theme_options[header][logo][sticky][' + logo.split('.')[1] + ']'];
        } else {
            src = settings['ideo_theme_options[header][logo][' + settings['ideo_theme_options[header][' + type + '][logo][type]'] + ']'];
        }
        
        if( logo == "none" ){
            $('#header ' + selector + ' .navbar-header .brand .navbar-brand').hide();
            $('#header ' + selector + ' .navbar-header .navbar-brand img').addClass('no-src');
            return;
        }else{
            $('#header ' + selector + ' .navbar-header .brand .navbar-brand').show();
            $('#header ' + selector + ' .navbar-header .navbar-brand img').removeClass('no-src');
        }

        $('#header ' + selector + ' .navbar-header .navbar-brand img' + (type == 'mobile' ? '.logo-mobile' : (type != 'side' ? '.logo-standard' : ''))).attr('src', src);
    }

    namespace.setOffcanvasBarLogo = function (type, settings) { 
        if (namespace.hasLocalModyfication('#header', 'header.side.offcanvas.' + type + '.logo.type'))
            return;

        var logo = {
            'topbar': settings['ideo_theme_options[header][side][offcanvas][topbar][logo][type]'],        
            'stickybar': settings['ideo_theme_options[header][side][offcanvas][stickybar][logo][type]']
        },
        src = {
            'topbar': settings['ideo_theme_options[header][logo][' + logo.topbar + ']'],        
            'stickybar': settings['ideo_theme_options[header][logo][' + logo.stickybar + ']'],     
        };        

        $('#header.customize-preview .side-header-offcanvas-logo img').data('topbar-src', src.topbar || '').data('stickybar-src', src.stickybar || '');       
        
        if( logo[type] == "none" ){            
            $('#header.customize-preview .side-header-offcanvas-logo img').addClass('no-src');
            return;
        }else{            
            $('#header.customize-preview .side-header-offcanvas-logo img').removeClass('no-src');
        }

        $('#header.customize-preview .side-header-offcanvas-logo img').attr('src', src[type]);
    }

    namespace.setOffcanvasBarLogoData = function (type, settings) { 
        if (namespace.hasLocalModyfication('#header', 'header.side.offcanvas.' + type + '.logo.type'))
            return;

        var logo = settings['ideo_theme_options[header][side][offcanvas][' + type + '][logo][type]'],        
            src = settings['ideo_theme_options[header][logo][' + logo + ']'];

        $('#header.customize-preview .side-header-offcanvas-logo img').data( type + '-src', src);               
       
    }

    namespace.getHeaderSkin = function(headerType, settingsValue){ 

        if (settingsValue)
            return settingsValue;

        var value = namespace.getCustomizerSetting('ideo_theme_options[generals][styling][theme_skin]');

        if (headerType == 'mobile' || headerType == 'side')
            return value;

        return 'colored-' + value;
    }

    namespace.setMobileHeaderSkin = function (skin) {
        var header = $('#header-navbar');
        header.attr('data-mobile-skin', skin);

        header.find('nav').removeClass('mobile-skin-light mobile-skin-dark').addClass('mobile-skin-' + skin);

        if (header.is('.mobile'))
            header.removeClass('skin-light skin-dark').addClass('skin-' + skin);
    }

    namespace.setMobileHeaderStyling = function (skin, settings) {
        var base = '#header.customize-preview #header-navbar.mobile.skin-' + skin;


        // Background color

        var importantBackgroundColor = [
            base,
            base + ' #header-navbar-collapse',
            base + ' .navbar-form button'
        ];
        namespace.setBackgroundColor(importantBackgroundColor.join(', '), settings.mobileBackgroundColor + ' !important');


        // Border top color and thickness

        namespace.setBorderTopColor(base + ' nav', settings.mobileBorderTopColor + ' !important');
        namespace.setBorderWidth(base + ' nav', settings.mobileBorderTopThickness, {top: true});
        namespace.setTop(base + ' nav .navbar-social-modern', -settings.mobileBorderTopThickness + 'px');


        // Icon color

        if (settings.mobileIconColor) {
            namespace.setBackgroundColor(base + ' .navbar-toggle .animated-icon', settings.mobileIconColor);
            namespace.setBackgroundColor(base + ' .navbar-toggle .animated-icon:before', settings.mobileIconColor);
            namespace.setBackgroundColor(base + ' .navbar-toggle .animated-icon:after', settings.mobileIconColor);
        }

        // Search input color

        namespace.setBackgroundColor(base + ' .navbar-form input', settings.mobileSearchInputColor + ' !important');


        // Search text color

        var importantSearchTextColor = [
            base + ' .mobile-navbar-form input',
            base + ' .mobile-navbar-form input::-webkit-input-placeholder',
            base + ' .mobile-navbar-form input:-moz-placeholder',
            base + ' .mobile-navbar-form input::-moz-placeholder',
            base + ' .mobile-navbar-form input:-ms-input-placeholder',
            base + ' .mobile-navbar-form input:placeholder-shown'
        ];

        for (var i in importantSearchTextColor) {
            namespace.setColor(importantSearchTextColor[i], settings.mobileSearchTextColor + ' !important');
        }

        namespace.setColor(base + ' .navbar-form button', settings.mobileSearchTextColor);


        // Text color

        var importantTextColor = [
            base + ' .navbar-menu > li a',
            base + ' .navbar-menu > li:before',
            base + '.socials nav .modern-bars-content .navbar-social-modern a'
        ];

        namespace.setColor(importantTextColor.join(', '), settings.mobileTextColor + ' !important');
        namespace.setColor(base + ' .navbar-menu > li > .dropmenu li', settings.mobileTextColor);


        // Text hover color

        var importantTextHoverColor = [
            base + ' .navbar-menu li:hover > a',
            base + ' .navbar-menu li:focus > a',
            base + ' .navbar-menu li.open > a',
            base + ' .navbar-menu li.active > a',
            base + ' .navbar-menu li:hover:before',
            base + ' .navbar-menu li:focus:before',
            base + ' .navbar-menu li.open:before',
            base + ' .navbar-menu li.active:before',
            base + '.socials nav .modern-bars-content .navbar-social-modern a:hover'
        ];

        namespace.setColor(importantTextHoverColor.join(', '), settings.mobileTextHoverColor + ' !important');


        // Separators color

        namespace.setBorderBottomColor(base + ' .navbar-menu > li', settings.mobileSeparatorsColor);
        namespace.setBorderTopColor(base + ' .navbar-menu > li > .dropmenu li', settings.mobileSeparatorsColor);


        // First dropdown background color

        namespace.setBackgroundColor(base + ' .navbar-form', settings.mobileFirstDropdownBackground + ' !important');
        namespace.setBackgroundColor(base + ' .navbar-menu > li', settings.mobileFirstDropdownBackground + ' !important');
        namespace.setBackgroundColor(base + ' .mobile-navbar-form', settings.mobileFirstDropdownBackground + ' !important');


        // Second dropdown background color

        namespace.setBackgroundColor(base + ' .navbar-menu > li > .dropmenu li', settings.mobileSecondDropdownBackground);


        // Topbar background color

        namespace.setBackgroundColor(base + ' #topbar', settings.mobileTopbarBackgroundColor);


        // Coloring outside mixin

        var outsideBase = 'body #header-navbar nav.mobile-skin-' + skin;

        namespace.setBackgroundColor(outsideBase + ' .mobile-navbar-form input', settings.mobileSearchInputColor);
        namespace.setColor(outsideBase + ' .mobile-navbar-form input', settings.mobileSearchTextColor);
        namespace.setColor(outsideBase + ' .mobile-navbar-form button.submit', settings.mobileSearchTextColor);
        if ($(window).width() < 992) {
            namespace.setBackgroundColor(outsideBase + ' .navbar-social-modern', settings.mobileFirstDropdownBackground);
        }
    };

    namespace.getMobileHeaderStylingSettings = function (settings, theme) {
        return {
            mobileBackgroundColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][background_color]'],
            mobileBorderTopColor: namespace.getColorOrAccent(settings['ideo_theme_options[header][mobile][' + theme + '][styling][border_top_color]']),
            mobileBorderTopThickness: settings['ideo_theme_options[header][mobile][' + theme + '][styling][border_top_thickness]'] ? settings['ideo_theme_options[header][mobile][' + theme + '][styling][border_top_thickness]'] : 0,
            mobileIconColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][icon_color]'],
            mobileFirstDropdownBackground: settings['ideo_theme_options[header][mobile][' + theme + '][styling][first_dropdown_background]'],
            mobileSecondDropdownBackground: settings['ideo_theme_options[header][mobile][' + theme + '][styling][second_dropdown_background]'],
            mobileTextColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][text_color]'],
            mobileTextHoverColor: namespace.getColorOrAccent(settings['ideo_theme_options[header][mobile][' + theme + '][styling][text_hover_color]']),
            mobileSeparatorsColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][separators_color]'],
            mobileSearchInputColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][search_input_color]'],
            mobileSearchTextColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][search_text_color]'],
            mobileTopbarBackgroundColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][topbar_background_color]'],
        };
    };

    namespace.setCssRules = function (rules, conditions, custom_css) {
        var css = '';
        var custom_css = custom_css || '';
        var currentSelector = '';
        var head = document.body || document.getElementsByTagName('body')[0];
        var rules = namespace.rules;
        var conditions = conditions || [];

        if ($.isArray(conditions) && !namespace.checkConditions(conditions)) {
            return false;
        }

        for (var key in rules) {
            if (currentSelector === '' || currentSelector !== key) {
                css += currentSelector !== key && currentSelector !== '' ? '}' : '';
                css += key + '{';
                currentSelector = key;
            }

            var obj = rules[key];
            for (var prop in obj) {

                if (obj.hasOwnProperty(prop)) {
                    css += prop + ':' + obj[prop] + ';';
                }
            }
        }

        css += '}';
        css += custom_css;

        namespace.rules = {};

        if ($('#style-preview')) {
            $('#style-preview').remove();
        }

        var style = document.createElement('style');
        style.setAttribute('id', 'style-preview');

        style.type = 'text/css';

        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }

        head.appendChild(style);
        namespace.renderMasonry();
    };

    namespace.base64_encode = function (data) {
        //  discuss at: http://phpjs.org/functions/base64_encode/
        // original by: Tyler Akins (http://rumkin.com)
        // improved by: Bayron Guevara
        // improved by: Thunder.m
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
        // improved by: Rafał Kukawski (http://kukawski.pl)
        // bugfixed by: Pellentesque Malesuada
        //   example 1: base64_encode('Kevin van Zonneveld');
        //   returns 1: 'S2V2aW4gdmFuIFpvbm5ldmVsZA=='
        //   example 2: base64_encode('a');
        //   returns 2: 'YQ=='

        var b64 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
        var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
            ac = 0,
            enc = '',
            tmp_arr = [];

        if (!data) {
            return data;
        }

        do { // pack three octets into four hexets
            o1 = data.charCodeAt(i++);
            o2 = data.charCodeAt(i++);
            o3 = data.charCodeAt(i++);

            bits = o1 << 16 | o2 << 8 | o3;

            h1 = bits >> 18 & 0x3f;
            h2 = bits >> 12 & 0x3f;
            h3 = bits >> 6 & 0x3f;
            h4 = bits & 0x3f;

            // use hexets to index into b64, and append result to encoded string
            tmp_arr[ac++] = b64.charAt(h1) + b64.charAt(h2) + b64.charAt(h3) + b64.charAt(h4);
        } while (i < data.length);

        enc = tmp_arr.join('');

        var r = data.length % 3;

        return (r ? enc.slice(0, r - 3) : enc) + '==='.slice(r || 3);
    };

    namespace.urlEncode = function (parameter) {
        if (!parameter)
            return parameter;

        return (parameter.replace('#', '').replace('(', '_').replace(')', '_')).replace(/=/g, '-');
    };

    namespace.getBool = function (bool) {
        if (typeof bool === "boolean") {
            return bool;
        }

        if (typeof bool === 'undefined') {
            return false;
        }

        if ("true" == bool.toLowerCase() || "1" === bool || 1 === bool) {
            return true;
        }

        return false;

    };

    namespace.valueHasNoUnit = function (number) {
        var units = ['px', 'em', 'pt', 'rem'];
        return !new RegExp(units.join("|")).test(number);
    };

    namespace.getColorOrAccent = function (value, opacity, darken) {
        if (value)
            return value;

        var accentColor = namespace.getAccentColor();

        if (opacity)
            accentColor = namespace.hexToRgb(accentColor, opacity);

        if (darken)
            accentColor = namespace.setColorDarken(accentColor, darken);

        return accentColor;
    }

    namespace.isColor = function (color, defaultColor) {
        if(/(^#[0-9A-F]{6}$)|(^#[0-9A-F]{3}$)|(^(rgb|hsl)(a?)[(]\s*([\d.]+\s*%?)\s*,\s*([\d.]+\s*%?)\s*,\s*([\d.]+\s*%?)\s*(?:,\s*([\d.]+)\s*)?[)]$)/i.test(color) ){
            return color;
        }else{
            return defaultColor || '';
        }
    }

    namespace.hexToRgb = function (hex, opacity) {
        if (!hex)
            return hex;

        var shorthandRegex = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
        hex = hex.replace(shorthandRegex, function (m, r, g, b) {
            return r + r + g + g + b + b;
        });

        var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);

        result = {r: parseInt(result[1], 16), g: parseInt(result[2], 16), b: parseInt(result[3], 16)};

        if (opacity)
            return 'rgba(' + result.r + ',' + result.g + ',' + result.b + ',' + opacity + ')';

        return 'rgb(' + result.r + ',' + result.g + ',' + result.b + ')';
    }

    namespace.normalizeText = function (text, useBr) {
        return (text + '').replace(String.fromCharCode(7), useBr ? '<br/>' : "\r\n");
    };

    namespace.setHtml = function (selector, html) {
        $(selector).html(html);
    }

    namespace.elementExists = function (selector) {
        return $(selector).length > 0;
    }

    namespace.getAttribute = function (selector, name) {
        return $(selector).attr(name);
    }

    namespace.translate = function (x, y) {
        return ' -webkit-transform: translate(' + x + ', ' + y + ')' +
            ' -ms-transform: translate(' + x + ', ' + y + ')' +
            ' -o-transform: translate(' + x + ', ' + y + ')' +
            ' transform: translate(' + x + ', ' + y + ')';
    }

})(jQuery);
