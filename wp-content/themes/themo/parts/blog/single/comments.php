<div class="comments-container"<?php ideothemo_customize_attrs(false, ideothemo_blog_comments_enabled('', false));?>>
    <h2 class="text-center sub-head"><?php echo get_comments_number_text(); ?></h2>

    <?php comments_template(); ?>
</div>