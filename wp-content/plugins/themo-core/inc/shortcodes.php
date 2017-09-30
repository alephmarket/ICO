<?php
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoDropCapsShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoHighlightShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTooltipShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoEmptySpaceShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoQuoteShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTableShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoSocialIconShortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTinyMCEShortcodesGenerator.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoRow.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoColumn.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTable4x4Shortcode.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTableRow.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTableHeaderCell.php');
include(plugin_dir_path(__FILE__) . 'shortcodes/IdeoTableCell.php');

add_shortcode('ideo_blog', 'ideothemo_blog_sc');
add_shortcode('social_icons', 'ideothemo_sc_social_icon');