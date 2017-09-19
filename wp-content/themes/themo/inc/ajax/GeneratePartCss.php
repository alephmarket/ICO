<?php

if (!class_exists('IdeoThemoGeneratePartCssAjax')) {
    class IdeoThemoGeneratePartCssAjax
    {
        public function __construct()
        {          
            add_action('wp_ajax_generate_part_css', array($this, 'ajax'));
            add_action('wp_ajax_nopriv_generate_part_css', array($this, 'ajax'));
        }

        public function ajax()
        {
            global $post;
            
            $paged = (int)$_GET['paged'] ?: 0;
            
            if( current_user_can( 'edit_theme_options' ) || get_transient( 'generate_part_css_progress' ) ){
                set_transient( 'generate_part_css_progress', true, 60 );
            }else{
                return false;
            }  

            $posts_per_page = 10;
            $offset = $posts_per_page * $paged;
            $posts = get_posts(array('posts_per_page' => $posts_per_page, 'offset' => $offset, 'orderby' =>'ID',  'post_type' => array('page', 'post', ideothemo_get_portfolio_slug(), 'team')));

            $ideoGeneratePageCss = new IdeoThemoGeneratePageCss(true);

            if($paged == 0){
                $ideoGeneratePageCss->action(0, (object)array('post_status' => 'publish'), false);                
            }

            foreach ($posts as $post) {
                setup_postdata($post);
                $ideoGeneratePageCss->action($post->ID, $post, false);
            }

            wp_reset_postdata();           
          

            if( count($posts) >= $posts_per_page){
                $response = wp_remote_get(
                    admin_url( 'admin-ajax.php?action=generate_part_css&paged=' . ($paged+1))
                );                
            }else{
                delete_transient( 'generate_part_css_progress' );
            }
            
            
            wp_die();
        }
    }

    new IdeoThemoGeneratePartCssAjax;
}
