<div class="posts-navi"<?php ideothemo_customize_attrs(false, ideothemo_nextprev_navi_enabled('', false));?>>
    <?php if (get_previous_post_link()) : ?>
        <a href="<?php echo get_permalink(get_adjacent_post(false, '', true)); ?>"
           class="prev"><i class="id id-left"></i> <span><?php esc_html_e('previous', 'themo'); ?></span></a>
    <?php endif; ?>
    <?php if (get_next_post_link()) : ?>
        <a href="<?php echo get_permalink(get_adjacent_post(false, '', false)); ?>"
           class="next"><?php esc_html_e('next', 'themo'); ?> <i class="id id-right"></i></a>
    <?php endif; ?>
</div>
