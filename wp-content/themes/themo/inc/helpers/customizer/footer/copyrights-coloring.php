<?php

if (!function_exists('ideothemo_get_copyright_colorings')) {
    function ideothemo_get_copyright_colorings($skin, $option, $useLocal = false)
    {
        return ideothemo_is_color(ideothemo_get_footer_setting('footer.copyrights_coloring.copyrights_' . $skin . '_' . $option, $useLocal), 'undefined');
    }
}