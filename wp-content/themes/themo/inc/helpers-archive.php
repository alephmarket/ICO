<?php

if (!function_exists('ideothemo_get_archive_layout')) {
    function ideothemo_get_archive_layout()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_layout');
    }
}

if (!function_exists('ideothemo_get_blog_archives_pagination')) {
    function ideothemo_get_blog_archives_pagination()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_pagination');
    }
}

if (!function_exists('ideothemo_get_blog_archives_posts_per_page')) {
    function ideothemo_get_blog_archives_posts_per_page()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_posts_per_page');
    }
}

if (!function_exists('ideothemo_get_blog_archives_excerpt_words')) {
    function ideothemo_get_blog_archives_excerpt_words()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_excerpt_words');
    }
}

if (!function_exists('ideothemo_get_blog_archives_masonry_blocks')) {
    function ideothemo_get_blog_archives_masonry_blocks()
    {
        return ideothemo_get_theme_mod_parse('blog.blog_archives.blog_archives_masonry_blocks');
    }
}