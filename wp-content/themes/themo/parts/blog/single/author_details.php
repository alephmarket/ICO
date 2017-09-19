<?php if($desc = get_the_author_meta('description')): ?>
<div class="author"<?php ideothemo_customize_attrs(false, ideothemo_blog_author_enabled('', false));?>>
    <?php echo get_avatar(get_the_author_meta('ID'), 110); ?>

    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="name">
        <?php the_author_meta('display_name'); ?>
    </a>

    <p class="status"><?php the_author_meta('position'); ?></p>

    <p><?php echo $desc; ?></p>
</div>
<?php endif; ?>