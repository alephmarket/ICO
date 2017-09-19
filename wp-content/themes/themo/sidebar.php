<?php if (ideothemo_get_sidebar_position() != 'none' || ideothemo_is_customize_preview()) : ?>
    <div class="<?php echo ideothemo_get_sidebar_classes(); ?>" <?php if(ideothemo_get_sidebar_position() == 'none') echo ' style="display: none;" ';?> <?php ideothemo_local_modifications(array('sidebar.sidebar_settings.sidebar_skin'))?>>

        <?php if ( !is_active_sidebar( ideothemo_get_theme_sidebar() ) || !dynamic_sidebar(ideothemo_get_theme_sidebar())): ?>
            <?php esc_html_e('Add widgets', 'themo'); ?>

        <?php endif; ?>
    </div>

<?php endif; ?>