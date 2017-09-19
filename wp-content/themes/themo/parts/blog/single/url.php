<?php $url = ideothemo_get_post_meta('url'); ?>

<a target="_blank" href="<?php echo esc_url($url); ?>" class="nounderline">
    <blockquote class="url">

        <?php echo esc_html(ideothemo_get_post_meta('title_url')); ?>
        <footer>
            <?php echo esc_html($url); ?>
        </footer>
    </blockquote>
</a>