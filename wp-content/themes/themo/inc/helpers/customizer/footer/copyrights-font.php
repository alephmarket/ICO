<?php

if (!function_exists('ideothemo_get_copyright_fonts')) {
    function ideothemo_get_copyright_fonts($option, $useLocal = false)
    {
        return ideothemo_get_footer_setting('footer.copyrights_font.copyrights_' . $option, $useLocal);
    }
}