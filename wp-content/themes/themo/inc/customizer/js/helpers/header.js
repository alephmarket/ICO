(function ($) {
    var namespace = $.fn.ideo;

    if(typeof window.parent.wp.customize.get()['data_refresh'] === 'undefined') return;

    namespace.setAllHeaderStyling = function (settings) {
        namespace.setHeaderStyling('#header.colored-light', namespace.getHeaderStylingSettings(settings, 'colored', 'light'));
        namespace.setHeaderStyling('#header.colored-dark', namespace.getHeaderStylingSettings(settings, 'colored', 'dark'));
        namespace.setHeaderStyling('#header.transparent-light', namespace.getHeaderStylingSettings(settings, 'transparent', 'light'));
        namespace.setHeaderStyling('#header.transparent-dark', namespace.getHeaderStylingSettings(settings, 'transparent', 'dark'));
    };

    namespace.setHeaderStyling = function (base, settings) {

        namespace.setBackgroundColor(base + " .inna-klasa", settings.backgroundColor);
        namespace.setBorderColor(base + " .klasa", settings.borderBottomColor);
        namespace.setColor(base + " #header-navbar > .navbar-standard", settings.firstLevelMenuTextColor);
        namespace.setColor(base + " #header-navbar > .navbar-sticky", settings.firstLevelMenuTextColor);
        namespace.setColor(base + " #header-navbar > .navbar-standard .navbar-nav > li > a", settings.firstLevelMenuTextColor);
        namespace.setColor(base + " #header-navbar > .navbar-sticky .navbar-nav > li > a", settings.firstLevelMenuTextColor);
        namespace.setColor(base + " #header-navbar .navbar-form-modern input", settings.firstLevelMenuTextColor);
        namespace.setColor(base + " .klasa", settings.firstLevelMenyTextHoverColor);
        namespace.setBackgroundColor(base + " .klasa", settings.hoverBorderColor);
        namespace.setBackgroundColor(base + " .klasa", settings.hoverBackgroundColor);
        namespace.setColor(base + " .klasa", settings.searchLanguageIconColor);
        namespace.setColor(base + " .klasa", settings.searchLanguageIconHoverColor);
        namespace.setBackgroundColor(base + " .klasa", settings.loadingEffect1Color);
        namespace.setBackgroundColor(base + " .klasa", settings.loadingEffect2Color);
        //namespace.setColor( base + " .klasa",  settings.firstReset );

        namespace.setBackgroundColor(base + " .klasa", settings.megaMenuSubLevelBackgroundColor);
        namespace.setBackgroundColor(base + " .klasa", settings.megaMenuSubLevelBackgroundImageOverlayColor);
        namespace.setColor(base + " .klasa", settings.megaMenuSubLevelHoverColor);
        namespace.setColor(base + " .klasa", settings.megaMenuSubLevelColumnTitleColor);
        namespace.setColor(base + " .klasa", settings.megaMenuSubLevelTextIconColor);
        namespace.setColor(base + " .klasa", settings.megaMenuSubLevelTextIconHoverColor);
        namespace.setBorderColor(base + " .klasa", settings.megaMenuSubLevelSeparatorsColorHorizontal);
        namespace.setBorderColor(base + " .klasa", settings.megaMenuSubLevelSeparatorsColorVertical);

        namespace.setBackgroundColor(base + " .klasa", settings.topbarBackground);
        namespace.setBorderColor(base + " .klasa", settings.topbarBorderTopColor);
        namespace.setBorderColor(base + " .klasa", settings.topbarBorderBottomColor);


    };

    namespace.getHeaderStylingSettings = function (settings, type, theme) {
        return {
            backgroundColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][background_color]'],
            borderBottomColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][border_bottom][color]'],
            //borderBottomThickness: settings['ideo_theme_options[header][top_sticky]['+ type +'][' + theme + '][border_bottom][thickness]'],		
            firstLevelMenuTextColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][first_level_menu_text][color]'],
            firstLevelMenyTextHoverColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][first_level_menu_text][hover_color]'],
            hoverBorderColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][hover_border_color]'],
            hoverBackgroundColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][hover_background_color]'],
            searchLanguageIconColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][search_language_icon_color]'],
            searchLanguageIconHoverColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][search_language_icon_hover_color]'],
            loadingEffect1Color: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][loading_effect1_color]'],
            loadingEffect2Color: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][loading_effect2_color]'],
            //firstReset: settings['ideo_theme_options[header][top_sticky]['+ type +'][' + theme + '][first_reset]'],
            megaMenuSubLevelBackgroundColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][background][color]'],
            megaMenuSubLevelBackgroundImageOverlayColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][background][image_overlay_color]'],
            megaMenuSubLevelHoverColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][hover_color]'],
            megaMenuSubLevelColumnTitleColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][column_title_color]'],
            megaMenuSubLevelTextIconColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][text_icon][color]'],
            megaMenuSubLevelTextIconHoverColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][text_icon][hover_color]'],
            megaMenuSubLevelSeparatorsColorHorizontal: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][separators_color][horizontal]'],
            megaMenuSubLevelSeparatorsColorVertical: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][mega_menu_sub_level][separators_color][vertical]'],
            topbarBackground: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][topbar][background]'],
            topbarBorderTopColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][topbar][border_top_color]'],
            topbarBorderBottomColor: settings['ideo_theme_options[header][top_sticky][' + type + '][' + theme + '][topbar][border_bottom_color]'],


        };
    };

    namespace.setAllSideHeaderStyling = function (settings) {

        namespace.setSideHeaderStyling('#header.side.colored-light', namespace.getSideHeaderStylingSettings(settings, 'colored', 'light'));
        namespace.setHeaderStyling('#header.side.colored-light', namespace.getSideHeaderStylingSettings(settings, 'colored', 'dark'));
    };

    namespace.setSideHeaderStyling = function (base, settings) {

        namespace.setBackgroundColor(base + " .klasa", settings.sideColorBackgroundBackgroundColor);
        namespace.setBackgroundColor(base + " .klasa", settings.sideColorBackgroundPatternColor);
        namespace.setBackgroundColor(base + " .klasa", settings.sideImageBackgroundImageOverlayColorPatternColor);
        namespace.setBackgroundColor(base + " .klasa", settings.sideImageBackgroundImageOverlayPatternColor);
        namespace.setColor(base + " .klasa", settings.sideMenuTextColor);
        namespace.setColor(base + " .klasa", settings.sideMenuTextHoverColor);
        namespace.setBorderColor(base + " .klasa", settings.sideSeparatorsColor);
        namespace.setBackgroundColor(base + " .klasa", settings.sideDropdownMenuBackgroundColor);
        namespace.setColor(base + " .klasa", settings.sideSearchInputColor);
        namespace.setColor(base + " .klasa", settings.sideSearchTextColor);
        namespace.setBackgroundColor(base + " .klasa", settings.sideSocialIconBackgroundColor);
        namespace.setColor(base + " .klasa", settings.sideSocialIconsColor);
        namespace.setColor(base + " .klasa", settings.sideCopyrights);




    };

    namespace.getSideHeaderStylingSettings = function (settings, type, theme) {
        return {
            sideColorBackgroundBackgroundColor: settings['ideo_theme_options[header][side][' + theme + '][styling][color_background][background_color]'],
            sideColorBackgroundPatternColor: settings['ideo_theme_options[header][side][' + theme + '][styling][color_background][pattern_color]'],
            sideImageBackgroundImageOverlayColorPatternColor: settings['ideo_theme_options[header][side][' + theme + '][styling][image_background][image_overlay][color][pattern_color]'],
            sideImageBackgroundImageOverlayPatternColor: settings['ideo_theme_options[header][side][' + theme + '][styling][image_background][image_overlay][pattern][color]'],
            sideMenuTextColor: settings['ideo_theme_options[header][side][' + theme + '][styling][menu_text_color]'],
            sideMenuTextHoverColor: settings['ideo_theme_options[header][side][' + theme + '][styling][menu_text_hover_color]'],
            sideSeparatorsColor: settings['ideo_theme_options[header][side][' + theme + '][styling][separators_color]'],
            sideDropdownMenuBackgroundColor: settings['ideo_theme_options[header][side][' + theme + '][styling][dropdown_menu_background_color]'],
            sideSearchInputColor: settings['ideo_theme_options[header][side][' + theme + '][styling][search_input_color]'],
            sideSearchTextColor: settings['ideo_theme_options[header][side][' + theme + '][styling][search_text_color]'],
            sideSocialIconBackgroundColor: settings['ideo_theme_options[header][side][' + theme + '][styling][social_icon_background_color]'],
            sideSocialIconsColor: settings['ideo_theme_options[header][side][' + theme + '][styling][social_icons_color]'],
            sideCopyrights: settings['ideo_theme_options[header][side][' + theme + '][styling][copyrights]'],

        };
    };

    namespace.setAllMobileHeaderStyling = function (settings) {

    };

    namespace.setMobileHeaderStyling = function (base, settings) {

        namespace.setBackgroundColor(base + " .klasa", settings.mobileBackgroundColor);
        namespace.setBorderColor(base + " .klasa", settings.mobileBorderTopColor);
        namespace.setColor(base + " .klasa", settings.mobileIconColor);
        namespace.setBackgroundColor(base + " .klasa", settings.mobileFirstDropdownBackground);
        namespace.setBackgroundColor(base + " .klasa", settings.mobileSecondDropdownBackground);
        namespace.setColor(base + " .klasa", settings.mobileTextColor);
        namespace.setColor(base + " .klasa", settings.mobileTextHoverColor);
        namespace.setBorderColor(base + " .klasa", settings.mobileSeparatorsColor);
        namespace.setBackgroundColor(base + " .klasa", settings.mobileSearchInputColor);
        namespace.setColor(base + " .klasa", settings.mobileSearchTextColor);


    };

    namespace.getMobileHeaderStylingSettings = function (settings, type, theme) {
        return {
            mobileBackgroundColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][background_color]'],
            mobileBorderTopColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][border_top_color]'],
            mobileIconColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][icon_color]'],
            mobileFirstDropdownBackground: settings['ideo_theme_options[header][mobile][' + theme + '][styling][first_dropdown_background]'],
            mobileSecondDropdownBackground: settings['ideo_theme_options[header][mobile][' + theme + '][styling][second_dropdown_background]'],
            mobileTextColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][text_color]'],
            mobileTextHoverColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][text_hover_color]'],
            mobileSeparatorsColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][separators_color]'],
            mobileSearchInputColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][search_input_color]'],
            mobileSearchTextColor: settings['ideo_theme_options[header][mobile][' + theme + '][styling][search_text_color]']

        };
    };

})(jQuery);