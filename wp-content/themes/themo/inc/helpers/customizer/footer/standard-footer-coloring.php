<?php

if (!function_exists('ideothemo_get_standard_footer_coloring_footer')) {
    function ideothemo_get_standard_footer_coloring_footer($skin, $type)
    {
        return ideothemo_is_color(ideothemo_get_theme_mod_parse('footer.standard_footer_coloring.footer_' . $skin . '_' . $type));
    }

    function ideothemo_get_standard_footer_accent_color($skin)
    {
        $accent_color = ideothemo_get_theme_mod_parse('footer.standard_footer_coloring.footer_' . $skin . '_accent_color');

        return ideothemo_blog_get_option(ideothemo_get_general_accent_color(), $accent_color);
    }}