<?php

if (!function_exists('ideothemo_get_page_setting')) {
    function ideothemo_get_page_setting($setting, $useLocal = false)
    {
        global $post;
        
        $highPriority = '';

        if ($useLocal /*&& !ideothemo_is_nopo_template()*/) {
            
            if(is_archive() || is_search() || (is_front_page() && !get_option( 'page_on_front' ))){
                if (is_archive()) {
                    $post_id = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pt');
                } elseif (is_search()) {
                    $post_id = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pt');
                } 
            }else if($post){
                $post_id = $post->ID;
            }
            
            if (empty($post_id)) {
                $highPriority = '';
            }else{
                $highPriority = ideothemo_get_custom_post_meta($setting, $post_id);                                
            }   
            
        }

        return ideothemo_blog_get_option(ideothemo_get_theme_mod_parse($setting), $highPriority);
    }
}

if (!function_exists('ideothemo_get_page_option_setting')) {
    function ideothemo_get_page_option_setting($setting = '', $ignoreGlobal = false, $post_id = null, $defaultInit = true)
    {       
        $local = '';
        
        if (is_archive()) {
            $post_id = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pt');
        } elseif (is_search()) {
            $post_id = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pt');
        }

        if (empty($post_id) && !is_archive() && !is_search() && !is_front_page() || is_singular() || is_admin() /* if compile less PO*/) {
            $post_id = get_the_ID();
        }
        
        if (is_singular() || is_page() || $post_id) {
            $local = ideothemo_get_custom_post_meta($setting, $post_id); 
        }

        if ($ignoreGlobal)
            return $local;

        return ideothemo_blog_get_option(ideothemo_get_theme_mod_parse($setting, null, $defaultInit), $local);
    }
}

if (!function_exists('ideothemo_get_custom_post_meta')) {
    function ideothemo_get_custom_post_meta($key, $post_id = null, $default = null)
    {
        if(is_archive() || is_search() || (is_front_page() && !get_option( 'page_on_front' ))){
            if (is_archive()) {
                $post_id = ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pt');
            } elseif (is_search()) {
                $post_id = ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pt');
            }

            if (empty($post_id)) {
                return '';
            }            
        }
        $funcName = 'ideothemo_get_' . get_post_type($post_id) . '_meta';

        if (function_exists($funcName)) {
            $value = $funcName($key, $post_id);

            if ($value === null)
                return $default;

            return $value;
        }

        return false;
    }
}

if (!function_exists('ideothemo_get_custom_post_meta_to_css')) {
    /*
     * Return image position converted to CSS spec
     */
    function ideothemo_get_custom_post_meta_to_css($key, $toSep = ' ')
    {
        $value = ideothemo_get_custom_post_meta($key);

        if ($value) {
            return str_replace('_', $toSep, $value);
        }

        return false;
    }
}

if (!function_exists('ideothemo_get_post_meta')) {
    function ideothemo_get_post_meta($key, $post_id = null)
    {
        return ideothemo_get_custom_meta('_ideo_post', $post_id, $key);
    }
}

if (!function_exists('ideothemo_get_page_meta')) {
    function ideothemo_get_page_meta($key, $post_id = null)
    {
        return ideothemo_get_custom_meta('_ideo_page', $post_id, $key);
    }
}

if (!function_exists('ideothemo_get_portfolio_meta')) {
    function ideothemo_get_portfolio_meta($key, $post_id = null)
    {
        return ideothemo_get_custom_meta('_ideo_portfolio', $post_id, $key);
    }
}

if (!function_exists('ideothemo_get_team_meta')) {
    function ideothemo_get_team_meta($key, $post_id = null)
    {
        return ideothemo_get_custom_meta('_ideo_team', $post_id, $key);
    }
}

if (!function_exists('ideothemo_get_custom_meta')) {
    function ideothemo_get_custom_meta($key, $post_id = null, $key2 = '')
    {
        if (empty($post_id))
            $post_id = get_the_ID();

        $post_meta = get_post_meta($post_id, $key, true);

        if (!is_array($post_meta))
            return null;

        return ideothemo_parse_dot_string($post_meta, $key2);
    }
}

