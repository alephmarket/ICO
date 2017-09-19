<footer id="footer-container"
        class="<?php echo esc_attr(ideothemo_get_footer_classes(1)); ?>" <?php ideothemo_local_modifications(array('footer.footer_settings.copywrite_area_on')) ?>>
    <?php if (ideothemo_is_boxed_version()) : ?>
    <div class="container">
        <?php endif; ?>

        <?php if (ideothemo_footer_enabled(1)) : ?>

            <?php if (!ideothemo_is_boxed_version()): ?>
                <div class="<?php echo !ideothemo_is_boxed_version() && (ideothemo_get_footer_type(1) == 'standard' && (ideothemo_get_standard_footer_layout_footer_layout(1) == 'in_grid' || ideothemo_get_standard_footer_layout_footer_layout(1) == 'custom')) ? 'container' : 'container-fluid'; ?>">
            <?php endif; ?>
            <div class="row">


            <section id="footer" class="col-sm-12">
                <div id="footer-content"
                     class="<?php echo esc_attr(ideothemo_get_footer_container_classes()); ?>" <?php ideothemo_local_modifications(array('footer.footer_settings.standard_footer_skin')) ?>>
                    <?php if (ideothemo_get_footer_type(1) == 'standard') : ?>
                        <?php for ($column = 0; ++$column <= ideothemo_get_footer_columns_count(1);): ?>

                            <div class="column <?php echo esc_attr(ideothemo_get_footer_column_class($column, 1)); ?>">
                                <?php  if( is_active_sidebar('footer-column-' . $column) ){ dynamic_sidebar('footer-column-' . $column); } ?>
                            </div>

                        <?php endfor; ?>
                    <?php else : ?>

                        <?php echo ideothemo_get_footer_content(1); ?>
                    <?php endif; ?>

                </div>
            </section>

            <?php if (!ideothemo_is_boxed_version()): ?>
            </div>

        <?php endif; ?>
            </div>
        <?php endif; //ideo_footer_enabled?>

        <?php if (ideothemo_get_footer_type(1) == 'standard' && ((ideothemo_copyright_enabled(1) || (ideothemo_is_customize_preview() && (ideothemo_is_nopo_template() || ideothemo_get_custom_post_meta('footer.footer_settings.copywrite_area_on', get_the_ID()) != 'no'))))) : ?>
            <div id="copyright" class="<?php echo ideothemo_get_copyright_classes(1); ?>" <?php ideothemo_local_modifications(array('footer.footer_settings.copywrite_area_on', 'footer.footer_settings.copyright_skin', 'footer.copyrights_coloring.copyrights_background_color', 'footer.copyrights_coloring.copyrights_text_color')) ?>>
                <?php if (!ideothemo_is_boxed_version()): ?>
                <div
                    class="<?php echo !ideothemo_is_boxed_version() && (ideothemo_get_footer_type(1) == 'standard' && (ideothemo_get_standard_footer_layout_footer_layout(1) == 'in_grid' || ideothemo_get_standard_footer_layout_footer_layout(1) == 'custom')) ? 'container' : 'container-fluid'; ?>">
                    <div class="row">
                        <div id="copyright-content" class="col-md-12">
                            <?php endif; ?>
                            <div
                                class="copyright-text" <?php ideothemo_local_modifications(array('footer.footer_settings.copyright_text')) ?>><?php echo ideothemo_get_footer_copyright_text(1); ?></div>
                            <?php if (!ideothemo_is_boxed_version()): ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php do_action('ideothemo_footer_bottom'); ?>

        <?php if (ideothemo_is_boxed_version()) : ?>
    </div>
<?php endif; ?>

</footer>