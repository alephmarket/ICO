<?php get_header(); ?>
<?php the_post(); ?>

<div id="content" class="it-blog <?php echo ideothemo_get_content_classes(); ?>" <?php do_action('ideothemo_content_tag'); ?>>
        <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled() || !has_shortcode(get_the_content(), 'vc_row'))): ?>
        <div class="container">
        <?php endif; ?>
           <div class="row">
                <div class="entry-content <?php echo ideothemo_get_theme_skin_class(); ?> <?php echo ideothemo_get_blog_sidebar_page_classes(ideothemo_get_sidebar_position()); ?>">
                    <?php the_content(); ?>
                </div>
                <?php
                get_sidebar();
                ?>
            </div>

        <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled() || !has_shortcode(get_the_content(), 'vc_row'))): ?>
        </div>
        <?php endif; ?>

</div>

<?php get_footer(); ?>
