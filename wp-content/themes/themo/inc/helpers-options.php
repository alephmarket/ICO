<?php

if (!function_exists('ideothemo_get_grid_columns')) {
    function ideothemo_get_grid_columns()
    {
        return 12;
    }
}

if (!function_exists('ideothemo_get_sidebars')) {
    /**
     * Returns list of all sidebars
     *
     * @param bool $only_custom True - only custom sidebars, False - all
     * @return array
     */
    function ideothemo_get_sidebars($only_custom = false)
    {
        if (!$only_custom) {
            global $wp_registered_sidebars;
            $list = array();

            foreach ($wp_registered_sidebars as $sidebar_name => $sidebar)
                $list[$sidebar_name] = $sidebar['name'];

            return $list;
        }

        return apply_filters('ideothemo_get_sidebars', get_option('ideo_sidebars'));
    }
}

if (!function_exists('ideothemo_get_social_media_list')) {

    function ideothemo_get_social_media_list()
    {
        $social_media = array
        (
            'behance',
            'dribbble',
            'flickr',
            'instagram',
            'soundcloud',
            'skype',
            'vimeo',
            'xing',
            'youtube',
            'facebook',
            'twitter',
            'google',
            'pinterest',
            'linkedin',
            'tumblr',
            'vk',
            'reddit',
            'email'
        );

        return apply_filters('ideothemo_get_social_media_list', $social_media);
    }
}

if (!function_exists('ideothemo_get_comments_per_page')) {
    /**
     * Return count of comments per page
     *
     * @return mixed|void
     */
    function ideothemo_get_comments_per_page()
    {
        return get_option('comments_per_page');
    }
}

