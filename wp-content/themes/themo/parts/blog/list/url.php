<a class="nounderline" href="<?php the_permalink(); ?>">
    <blockquote class="url">
        <?php $url = ideothemo_get_post_meta('url'); ?>

        <?php echo esc_html(ideothemo_get_post_meta('title_url')); ?>
        <footer>
            <?php echo esc_html($url); ?>
        </footer>
    </blockquote>
</a>