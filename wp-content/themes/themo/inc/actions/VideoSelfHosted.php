<?php

if (!class_exists('IdeoThemoVideoSelfHosted')) {
    /**
     * Render HTML for self hosted video option
     * Works for PT, body, content
     */
    class IdeoThemoVideoSelfHosted
    {
        function __construct()
        {
            add_action('ideothemo_pagetitle_background_self_hosted', array($this, 'pagetitle_background_self_hosted'), 99);
            add_action('ideothemo_page_background_self_hosted', array($this, 'page_background_self_hosted'), 99);
            add_action('ideothemo_content_background_self_hosted', array($this, 'content_background_self_hosted'), 99);
            add_action('ideothemo_boxed_background_self_hosted', array($this, 'boxed_background_self_hosted'), 99);
        }

        private function videoHtml($fallback_image, $webm, $mp4, $args = array())
        {
            $default = array('class' => '');
            $args = shortcode_atts($default, $args);
            ?>
        <div class="background-video" <?php echo ($fallback_image ? 'style="background-image: url(' . esc_attr($fallback_image) .')"' : '');?>>
                <video autoplay loop poster="<?php echo esc_attr($fallback_image);?>" class="<?php echo esc_attr($args['class']);?>" muted>
                    <?php if ($webm) : ?>
                        <source src="<?php echo esc_attr($webm); ?>" type="video/webm">
                    <?php endif; ?>
                
                    <?php if ($mp4) : ?>
                        <source src="<?php echo esc_attr($mp4); ?>" type="video/mp4">
                    <?php endif; ?>
                </video>
            </div>
        <?php
        }

        public function pagetitle_background_self_hosted()
        {
            if(ideothemo_page_title_area_enabled()) {
                $this->videoHtml(
                    ideothemo_get_pt_background_fallback_image(1),
                    ideothemo_get_pt_background_webm(1),
                    ideothemo_get_pt_background_mp4(1)
                );
            }
        }

        public function page_background_self_hosted()
        {
            $this->videoHtml(
                ideothemo_get_boxed_background_fallback_image(1),
                ideothemo_get_boxed_background_webm(1),
                ideothemo_get_boxed_background_mp4(1),
                array('class' => 'background-video')
            );
        }

        public function content_background_self_hosted()
        {
            $this->videoHtml(
                ideothemo_get_content_background_fallback_image(1),
                ideothemo_get_content_background_webm(1),
                ideothemo_get_content_background_mp4(1),
                array('class' => 'background-video')
            );
        }
        
        public function boxed_background_self_hosted() {
            $this->videoHtml(
                ideothemo_get_boxed_background_fallback_image(1),
                ideothemo_get_boxed_background_webm(1),
                ideothemo_get_boxed_background_mp4(1),
                array('class' => 'background-video')
            );
        }
    }

    new IdeoThemoVideoSelfHosted;
}