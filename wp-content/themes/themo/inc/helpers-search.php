<?php

if (!function_exists('ideothemo_get_blog_search_posts_per_page')) {
    function ideothemo_get_blog_search_posts_per_page()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_posts_per_page');
    }
}

if (!function_exists('ideothemo_get_blog_search_excerpt_words')) {
    function ideothemo_get_blog_search_excerpt_words()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_excerpt_words');
    }
}

if (!function_exists('ideothemo_get_blog_search_pagination')) {
    function ideothemo_get_blog_search_pagination()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_search.blog_search_pagination');
    }
}