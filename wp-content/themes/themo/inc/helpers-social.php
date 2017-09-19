<?php

if (!function_exists('ideothemo_get_other_social_profile_url')) {
    /**
     * Return social media profile url for undefined social media
     *
     * @param string $social Type of social Media
     * @param string $url Url to social media profile
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_other_social_profile_url($social, $url, $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => ideothemo_get_social_icon($social)));

        $atts['href'] = esc_url($url);

        return ideothemo_get_social_button($atts);
    }
}

if (!function_exists('ideothemo_get_social_profile_url')) {
    /**
     * Return social media profile url
     *
     * @param string $social Type of social Media
     * @param string $url Url to social media profile
     * @param array $atts
     *
     * @return bool|mixed
     */

    function ideothemo_get_social_profile_url($social, $url, $atts = array())
    {
        $funcName = 'ideothemo_get_' . $social . '_profile_url';

        if (function_exists($funcName)) {
            return $funcName($url, $atts);
        }

        return false;
    }
}


/** Mail */

if (!function_exists('ideothemo_get_mail_profile_url')) {
    /**
     * Return Mail Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_mail_profile_url($url, $atts = array())
    {
        return ideothemo_get_mail_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_mail_share_button')) {

    /**
     * Return Mail Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_mail_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-envelope-o'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'body' => $url,
                'subject' => $text
            ), 'mailto:');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Reddit */

if (!function_exists('ideothemo_get_reddit_profile_url')) {
    /**
     * Return Reddit Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_reddit_profile_url($url, $atts = array())
    {
        return ideothemo_get_reddit_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_reddit_share_button')) {

    /**
     * Return Reddit Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_reddit_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-reddit-square'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'url' => $url,
            ), 'http://reddit.com/submit');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Vk */

if (!function_exists('ideothemo_get_vk_profile_url')) {
    /**
     * Return Vk Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_vk_profile_url($url, $atts = array())
    {
        return ideothemo_get_vk_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_vk_share_button')) {

    /**
     * Return Vk Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_vk_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-vk'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'url' => $url,
            ), 'http://vk.com/share.php');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Tumblr */

if (!function_exists('ideothemo_get_tumblr_profile_url')) {
    /**
     * Return Tumblr Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_tumblr_profile_url($url, $atts = array())
    {
        return ideothemo_get_tumblr_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_tumblr_share_button')) {

    /**
     * Return Tumblr Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_tumblr_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-tumblr-square', 'excerpt' => ''));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'url' => $url,
                'name' => $text,
                'excerpt' => $atts['excerpt'],
            ), 'http://www.tumblr.com/share/link');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Linkedin */

if (!function_exists('ideothemo_get_linkedin_profile_url')) {
    /**
     * Return Linkedin Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_linkedin_profile_url($url, $atts = array())
    {
        return ideothemo_get_linkedin_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_linkedin_share_button')) {

    /**
     * Return Linkedin Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_linkedin_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-linkedin-square'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'mini' => 'true',
                'url' => esc_url($url),
                'title' => $text
            ), 'http://linkedin.com/shareArticle');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Pinterest */

if (!function_exists('ideothemo_get_pinterest_profile_url')) {
    /**
     * Return Pinterest Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_pinterest_profile_url($url, $atts = array())
    {
        return ideothemo_get_pinterest_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_pinterest_share_button')) {

    /**
     * Return Pinterest Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_pinterest_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-pinterest-square', 'media' => ''));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'url' => $url,
                'description' => $text,
                'media' => $atts['media'],
            ), 'http://pinterest.com/pin/create/button/');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Google+ */

if (!function_exists('ideothemo_get_google_plus_profile_url')) {
    /**
     * Return Google+ Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_google_plus_profile_url($url, $atts = array())
    {
        return ideothemo_get_facebook_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_google_plus_share_button')) {

    /**
     * Return Google+ Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_google_plus_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-google-plus-square'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'u' => $url,
                't' => $text
            ), 'http://www.facebook.com/sharer.php');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Facebook */

if (!function_exists('ideothemo_get_facebook_profile_url')) {
    /**
     * Return Facebook Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_facebook_profile_url($url, $atts = array())
    {
        return ideothemo_get_facebook_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_facebook_share_button')) {

    /**
     * Return Facebook Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_facebook_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-facebook-square'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'u' => $url,
                't' => $text
            ), 'http://www.facebook.com/sharer.php');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** Twitter */

if (!function_exists('ideothemo_get_twitter_profile_url')) {
    /**
     * Return Twitter Profile URL Button
     *
     * @param $url
     * @param array $atts
     *
     * @return string
     */
    function ideothemo_get_twitter_profile_url($url, $atts = array())
    {
        return ideothemo_get_twitter_share_button(false, false, wp_parse_args($atts, array('href' => $url)));
    }
}

if (!function_exists('ideothemo_get_twitter_button')) {

    /**
     * Return Twitter Profile Share Button
     *
     * @param $url
     * @param string $text
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_twitter_share_button($url, $text = '', $atts = array())
    {
        $atts = wp_parse_args($atts, array('icon' => 'fa-twitter-square'));

        if (empty($atts['href'])) {
            $atts['href'] = add_query_arg(array(
                'url' => $url,
                'text' => $text
            ), 'https://twitter.com/share');
        }

        return ideothemo_get_social_button($atts);
    }
}

/** GENERAL */

if (!function_exists('ideothemo_get_social_button')) {

    /**
     * Generate Social Button
     *
     * @param array $atts
     *
     * @return string
     */

    function ideothemo_get_social_button($atts = array())
    {
        $default = array(
            'icon' => '',
            'href' => '',
            'class' => 'js--social-share'
        );

        $ignored = array('icon');

        $atts = wp_parse_args($atts, $default);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if (!empty($value) && !in_array($attr, $ignored)) {
                $value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        return '<a' . $attributes . '><i class="fa ' . $atts['icon'] . '"></i></a>';
    }
}

if (!function_exists('ideothemo_get_social_icon')) {

    /**
     * Get Social Icon
     *
     * @param string $social
     *
     * @return string
     */
    function ideothemo_get_social_icon($social, $use_square = false)
    {

        $icons = array('behance' => 'behance-square', 'vimeo' => 'vimeo-square', 'xing' => 'xing-square', 'youtube' => 'youtube-square', 'google' => 'google-plus-square');

        if ($use_square && isset($icons[$social]))
            return sprintf('fa fa-%s', $icons[$social]);

        return sprintf('fa fa-%s', $social);
    }
}

if (!function_exists('ideothemo_get_header_socials')) {

    /**
     * Get Header Socials
     *
     * @param string $header
     *
     * @return string
     */
    function ideothemo_get_header_socials($header)
    {

        if (($header == 'standard_header' || $header == 'sticky_header') && !wp_is_mobile()) {
            $icons = array('youtube' => 'youtube-square', 'vimeo' => 'vimeo-square', 'twitter' => 'twitter-square', 'tumblr' => 'tumblr-square', 'reddit' => 'reddit-square', 'pinterest' => 'pinterest-square', 'linkedin' => 'linkedin-square', 'facebook' => 'facebook-square', 'behance' => 'behance-square', 'vimeo' => 'vimeo-square', 'xing' => 'xing-square', 'youtube' => 'youtube-square', 'google' => 'google-plus-square');
        } else {
            $icons = array('youtube' => 'youtube-play', 'reddit' => 'reddit-alien', 'google' => 'google-plus');
        }

        $output = '';

        foreach (ideothemo_get_social_media_list() as $social) {
            $url = ideothemo_get_header_social($social);

            if (!empty($url)) {
                if ($header == 'side_header' || $header == 'side_left_header' || $header == 'side_right_header') {
                    $output .= sprintf('<li><a href="%s" target="_blank"><i class="fa fa-%s"></i></a></li>', esc_url($url), isset($icons[$social]) ? esc_attr($icons[$social]) : esc_attr($social));
                } else {
                    $output .= sprintf('<a href="%s" target="_blank" class="element-visible-standard"><i class="fa fa-%s visible"></i></a>', esc_url($url), isset($icons[$social]) ? esc_attr($icons[$social]) : esc_attr($social));
                    $output .= sprintf('<a href="%s" target="_blank" class="element-visible-mobile"><i class="fa fa-%s"></i></a>', esc_url($url), esc_attr($social));
                }
            }
        }

        echo $output;
    }
}

if (!function_exists('ideothemo_get_header_social')) {
    /**
     * Get header social
     *
     * @param string $social
     *
     * @return string
     */
    function ideothemo_get_header_social($social)
    {

        return ideothemo_get_theme_mod_parse(sprintf('social_media.social_media_profiles.%s', $social));
    }
}
