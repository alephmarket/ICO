<?php
 
 if (!class_exists('IdeoThemoCustomizerPageOptionsAjax')) {
     class IdeoThemoCustomizerPageOptionsAjax
     {
         public function __construct()
         {
             add_action('wp_ajax_customizerPageOptions', array($this, 'page_options'));
         }
 
         public function page_options()
         {
             global $post;
 
             wp_cache_delete('ideo-options');
             flush_rewrite_rules();
 
             $storedControls = unserialize(get_option('ideo_customizer_local_modification_trigger_controls')); 
             $currentControls = ideothemo_get_customizer_local_modification_trigger_controls(); 
 
             update_option('ideo_customizer_local_modification_trigger_controls', serialize($currentControls), false);
 
             if ($storedControls === $currentControls || ideothemo_get_header_setting('type') == 'side')
                 return false;
 
             $ideoGeneratePageCss = new IdeoThemoGeneratePageCss();
 
             $posts = get_posts(array('posts_per_page' => -1, 'orderby' =>'ID',  'post_type' => array('page', 'post', ideothemo_get_portfolio_slug(), 'team')));
 
             $ideoGeneratePageCss->action(0, (object)array('post_status' => 'publish'), false);
 
             foreach ($posts as $post) {
                 setup_postdata($post);
                 $ideoGeneratePageCss->action($post->ID, $post, false);
             }
 
             wp_reset_postdata();
 
             return true;
         }
     }
 
     new IdeoThemoCustomizerPageOptionsAjax;
 }
