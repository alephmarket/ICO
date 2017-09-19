<?php

/**
 * Customizer
 */
if (!function_exists('ideothemo_get_portfolio_slug')) {
    function ideothemo_get_portfolio_slug()
    {
        return sanitize_title(ideothemo_get_theme_mod_parse('portfolio.portfolio_settings.slug')) ?: 'portfolio';
    }
}

if (!function_exists('ideothemo_get_portfolio_main_page')) {
    function ideothemo_get_portfolio_main_page()
    {
        return ideothemo_get_theme_mod_parse('portfolio.portfolio_settings.main_page') ?: false;
    }
}

if (!function_exists('ideothemo_get_portfolio_label')) {
    function ideothemo_get_portfolio_label()
    {
        return esc_html(ideothemo_get_theme_mod_parse('portfolio.portfolio_settings.label')) ?: esc_html__('Portfolio', 'themo');
    }
}

if (!function_exists('ideothemo_portfolio_socials_enabled')) {
    function ideothemo_portfolio_socials_enabled()
    {
        return ideothemo_portfolio_social_enabled('social_media_share');
    }
}

if (!function_exists('ideothemo_portfolio_social_enabled')) {
    function ideothemo_portfolio_social_enabled($social)
    {
        return ideothemo_get_theme_mod_parse('portfolio.portfolio_standard_card.' . $social) == 'true' ? true : false;
    }
}

if (!function_exists('ideothemo_portfolio_navigation_enabled')) {
    function ideothemo_portfolio_navigation_enabled()
    {
        return ideothemo_get_theme_mod_parse('portfolio.portfolio_navigation.enabled') == 'true' ? true : false;
    }
}

/**
 * Portfolio Options
 */

if (!function_exists('ideothemo_is_portfolio_parametrs_enabled')) {
    function ideothemo_is_portfolio_parametrs_enabled()
    {
        return ideothemo_get_portfolio_meta('portfolio_parametrs');
    }
}

if (!function_exists('ideothemo_get_portfolio_parameters')) {
    function ideothemo_get_portfolio_parameters()
    {
        $_parametrs = ideothemo_get_portfolio_meta('portfolio_parameters_arr');

        if (empty($_parametrs)) {
            return false;
        }

        $parametrs = array();

        for ($i = 0; $i < count($_parametrs['labels']); $i++) {
            $parametrs[] = array(
                'label' => $_parametrs['labels'][$i],
                'value' => $_parametrs['values'][$i],
                'url' => esc_url($_parametrs['urls'][$i]),
            );
        }

        return $parametrs;
    }
}

if (!function_exists('ideothemo_has_not_empty_portfolio_parameters')) {
    function ideothemo_has_not_empty_portfolio_parameters()
    {
        $_parametrs = ideothemo_get_portfolio_meta('portfolio_parameters_arr');

        if (empty($_parametrs)) {
            return false;
        }

        for ($i = 0; $i < count($_parametrs['values']); $i++) {
            if (!empty($_parametrs['values'][$i]))
                return true;
        }

        return false;
    }
}

