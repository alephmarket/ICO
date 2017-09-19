<?php

if (!class_exists('IdeoThemoLoadCommentsAjax')) {
    class IdeoThemoLoadCommentsAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_loadCommentsAjax', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_loadCommentsAjax', array($this, 'ajax'));
        }

        public function comments_template($template)
        {
            return get_template_directory() . '/parts/blog/single/comment-list.php';
        }

        public function ajax()
        {
            add_filter('comments_template', array($this, 'comments_template'));

            $post_id = isset($_POST['post_id']) ? absint($_POST['post_id']) : 0;
            $page = isset($_POST['page']) ? max(1, absint($_POST['page'])) : 1;

            if (!$post_id) {
                die(esc_html__('Cheatin&#8217; uh?', 'themo'));
            }

            query_posts(array('p' => $post_id));
            set_query_var('cpage', $page);

            if (have_posts()) {
                the_post();

                comments_template();
            }
            wp_reset_postdata();
            die();
        }
    }

    new IdeoThemoLoadCommentsAjax;
}
