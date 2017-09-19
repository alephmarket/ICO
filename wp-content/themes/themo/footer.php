<?php ideothemo_set_ID(); ?>
            <?php get_template_part('parts/footer/footer'); ?>

            <?php if ( ideothemo_is_boxed_version() ) : ?>
            </div>
            <?php endif; ?>  
            
        <style type="text/css" data-type="vc_shortcodes-custom-css" scoped="scoped"><?php echo ideothemo_add_custom_style(); ?></style>        
        </div> <!-- #page container -->
    <?php if (ideothemo_is_advanced_sticky_loading()): ?></div><?php endif; ?> <!-- #ideo-transition-page-container -->

    
    
    <div id="ajax-container"></div><!-- #ajax-container -->

    <div id="ideo-page-preloader" class="out"></div>

    <?php do_action('ideothemo_body_entry_after'); ?>
    
    <?php wp_footer(); ?>
    </body>

</html>
