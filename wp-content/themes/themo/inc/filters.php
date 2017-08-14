<?php

include 'filters/IdeoBodyClass.php';
include 'filters/IdeoPostTypeNameFilter.php';
include 'filters/IdeoFooterRenderTemplateFilter.php';
include 'filters/IdeoHeaderRenderTemplateFilter.php';
include 'filters/IdeoLetterSpacing.php';
include 'filters/IdeoFontFamily.php';
include 'filters/IdeoCustomizerUnit.php';
include 'filters/IdeoCustomizerNumber.php';
include 'filters/PostMeta.php';

/**
 * Filter the first-row list of TinyMCE buttons (Visual tab).
 *
 * @param array $buttons First-row list of buttons.
 * @param string $editor_id Unique editor identifier, e.g. 'content'.
 *
 * @return array
 */
function ideothemo_mce_buttons_header($buttons, $editor_id = '')
{
    $buttons[] = 'ideo_shortcodes';

    return $buttons;
}

add_filter('mce_buttons', 'ideothemo_mce_buttons_header');

/**
 * Filter the list of TinyMCE external plugins.
 *
 * The filter takes an associative array of external plugins for
 * TinyMCE in the form 'plugin_name' => 'url'.
 *
 * The url should be absolute, and should include the js filename
 * to be loaded. For example:
 * 'myplugin' => 'http://mysite.com/wp-content/plugins/myfolder/mce_plugin.js'.
 *
 * If the external plugin adds a button, it should be added with
 * one of the 'mce_buttons' filters.
 *
 * @param array $external_plugins An array of external TinyMCE plugins.
 *
 * @return array
 */
function ideothemo_mce_external_plugins_header($external_plugins)
{
    $external_plugins['ideo_shortcodes'] = IDEOTHEMO_INIT_DIR_URI . '/assets/admin/js/mce-ideo-shortcodes-plugin.js';

    return $external_plugins;
}

add_filter('mce_external_plugins', 'ideothemo_mce_external_plugins_header');
