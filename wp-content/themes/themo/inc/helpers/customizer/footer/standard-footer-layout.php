<?php

if (!function_exists('ideothemo_get_standard_footer_layout_footer_layout')) {
    /**
     * FOOTER CONTENT WIDTH
     *
     * @return mixed
     */
    function ideothemo_get_standard_footer_layout_footer_layout()
    {
        return ideothemo_get_theme_mod_parse('footer.standard_footer_layout.footer_layout');
    }
}

if (!function_exists('ideothemo_get_standard_footer_layout_footer_custom_layout')) {
    /**
     * CUSTOM LAYOUT (WIDTH)
     *
     * @return mixed
     */
    function ideothemo_get_standard_footer_layout_footer_custom_layout()
    {
        return ideothemo_get_theme_mod_parse('footer.standard_footer_layout.footer_custom_layout');
    }
}

if (!function_exists('ideothemo_get_standard_footer_layout_footer_columns')) {
    /**
     * FOOTER COLUMNS
     *
     * @return null
     */
    function ideothemo_get_standard_footer_layout_footer_columns()
    {
        return ideothemo_get_theme_mod_parse('footer.standard_footer_layout.footer_columns');
    }
}

if (!function_exists('ideothemo_get_standard_footer_layout_footer_column_paddings')) {
    /**
     * FOOTER COLUMN PADDINGS
     *
     * @return null
     */
    function ideothemo_get_standard_footer_layout_footer_column_paddings()
    {
        return (int)ideothemo_get_theme_mod_parse('footer.standard_footer_layout.footer_column_paddings');
    }
}

if (!function_exists('ideothemo_get_standard_footer_layout_footer_padding_top')) {
    /**
     * PADDING TOP
     *
     * @return int
     */

    function ideothemo_get_standard_footer_layout_footer_padding_top()
    {
        return (int)ideothemo_get_theme_mod_parse('footer.standard_footer_layout.footer_padding_top');
    }
}

if (!function_exists('ideothemo_get_standard_footer_layout_footer_padding_bottom')) {
    /**
     * PADDING BOTTOM
     *
     * @return int
     */
    function ideothemo_get_standard_footer_layout_footer_padding_bottom()
    {
        return (int)ideothemo_get_theme_mod_parse('footer.standard_footer_layout.footer_padding_bottom');
    }
}