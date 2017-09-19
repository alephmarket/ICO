<div class="author"<?php ideothemo_customize_attrs(false, ideothemo_blog_author_enabled('', false));?>>
    <?php esc_html_e('Author', 'themo'); ?>:
    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php the_author(); ?></a>
</div>