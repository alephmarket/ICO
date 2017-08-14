<div class="author" @special@>
    <?php esc_html_e('Author', 'themo'); ?>:
    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"> <?php the_author(); ?></a>
</div>