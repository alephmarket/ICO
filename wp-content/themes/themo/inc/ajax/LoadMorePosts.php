<?php

if (!class_exists('IdeoThemoLoadMorePostsAjax')) {
    class IdeoThemoLoadMorePostsAjax
    {
        public function __construct()
        {
            add_action('wp_ajax_loadMorePosts', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_loadMorePosts', array($this, 'ajax'));
        }

        private function parseArgs()
        {
            $args = array();

            if (isset($_POST['paged']) && !empty($_POST['paged'])) {
                $args['paged'] = absint($_POST['paged']);
            }

            if (isset($_POST['category_name']) && !empty($_POST['category_name'])) {
                $args['category_name'] = sanitize_title($_POST['category_name']);
            }

            if (isset($_POST['author_name']) && !empty($_POST['author_name'])) {
                $args['author_name'] = sanitize_title($_POST['author_name']);
            }

            if (isset($_POST['tag']) && !empty($_POST['tag'])) {
                $args['tag'] = sanitize_title($_POST['tag']);
            }

            if (isset($_POST['s']) && !empty($_POST['s'])) {
                $args['s'] = esc_html(esc_sql($_POST['s']));
            }

            if (isset($_POST['year']) && !empty($_POST['year'])) {
                $args['year'] = absint($_POST['year']);
            }

            if (isset($_POST['monthnum']) && !empty($_POST['monthnum'])) {
                $args['monthnum'] = absint($_POST['monthnum']);
            }

            if (isset($_POST['day']) && !empty($_POST['day'])) {
                $args['day'] = absint($_POST['day']);
            }

            $args = array_merge($args, ideothemo_parse_shortcode_atts($_POST));

            if (!empty($_POST['is_search'])) {
                $args['orderby'] = 'relevance';
                $args['post_status'] = array('publish');

                if (is_user_logged_in())
                    $args['post_status'][] = 'private';
            }

            return $args;
        }

        public function ajax()
        {
            global $wp_query;

            if (isset($_POST)) {
                $args = array('post_type' => empty($_POST['post_type']) ? 'post' : $_POST['post_type']);

                $args = array_merge($args, $this->parseArgs());

                $wp_query = new WP_Query($args);

                $data = '';

                foreach ($_POST AS $key => $value)
                    $data .= ' ' . $key . '="' . esc_sql($value) . '" ';

                echo do_shortcode('[ideo_blog ' . $data . ']');
                
                wp_reset_postdata();
                wp_reset_query();
            }

            die();
        }
    }

    new IdeoThemoLoadMorePostsAjax;
}