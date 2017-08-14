<?php

if (!class_exists('IdeoThemoHeadTags')) {
    class IdeoThemoHeadTags
    {
        function __construct()
        {
            add_action('wp_head', array($this, 'tags'), 99);
            add_action('wp_head', array($this, 'og_tags'), 100);
            add_action('wp_head', array($this, 'favicon'), 101);
        }

        public function tags()
        {
            echo apply_filters('ideothemo_head_tags', ideothemo_get_advanced_head_tags());
        }
        
        public function og_tags()
        {
        	if (ideothemo_get_theme_mod_parse('advanced.advanced_open_graph.open_graph') !== 'true' || !get_the_ID())
        		return false;

			$post_id = ideothemo_get_link_ajax_card_id();
        	
        	$meta = array();
        	
			$meta[] = sprintf('<meta property="og:title" content="%s" />', get_the_title($post_id));
			
			$thumbnail = get_the_post_thumbnail_url($post_id);
			
			if ($thumbnail)
			{
				$meta[] = sprintf('<meta property="og:image" content="%s" />', get_the_post_thumbnail_url($post_id));
			}
			
			$description = get_the_excerpt($post_id);

			if (!$description)
			{
				$description = get_post_field('post_content', $post_id);

				$arr = explode('<div class="blog-content">', $description);
				
				if (isset($arr[1]))
				{
					$description = $arr[1];
				}
				
				$description = preg_replace(array('/\[[^\]]+\]/', '/\s+/'), array(null, ' '), strip_tags($description));
				
				if (strlen($description) > 250)
				{
					$description = substr(trim($description), 0, 250) . '...';
				}
			}

			$meta[] = sprintf('<meta property="og:description" content="%s" />', $description);

			echo implode($meta, PHP_EOL);
        }
        
        public function favicon() 
        {
        	$value = ideothemo_get_theme_mod_parse('header.logo.favicon');
        	
        	if (!$value)
        		$value = IDEOTHEMO_INIT_DIR_URI . '/assets/images/themofavicon.gif';
        	
        		echo sprintf('<link rel="icon" type="image/x-icon" href="%s">', $value);
        }
    }

    new IdeoThemoHeadTags;
}