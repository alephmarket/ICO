<?php

if (!function_exists('ideothemo_get_member_social')) {
    function ideothemo_get_member_social()
    {
        $socials = array();

        $member_social = ideothemo_get_team_meta('member_social');

        if (!empty($member_social)) {
            foreach ($member_social AS $key => $value) {
                if (!empty($value)) {
                    $socials[$key] = $value;
                }
            }
        }

        return $socials;
    }
}

if (!function_exists('ideothemo_is_member_pt_image_enabled')) {
    function ideothemo_is_member_pt_image_enabled()
    {
        return ideothemo_get_team_meta('member_pt_image');
    }
}

if (!function_exists('ideothemo_get_team_image_align')) {
    function ideothemo_get_team_image_align()
    {
        return ideothemo_get_team_meta('team_image_align');
    }
}

if (!function_exists('ideothemo_get_member_image_border_color')) {
    function ideothemo_get_member_image_border_color()
    {
        return ideothemo_is_color(ideothemo_get_team_meta('member_image_border_color'), 'undefined');
    }
}

if (!function_exists('ideothemo_get_social_profile')) {
    /**
     * Return URL to social profile
     *
     * @param string $social
     * @param string $profile
     * @return string|boolean
     */
    function ideothemo_get_social_profile($social, $profile)
    {
        if (empty($profile)) {
            return false;
        }

        if (($profileURL = ideothemo_get_social_profile_url($social, $profile)) !== false) {
            return $profileURL;
        }

        return ideothemo_get_other_social_profile_url($social, $profile);
    }
}