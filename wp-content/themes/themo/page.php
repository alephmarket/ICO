<?php the_post(); ?>
<?php get_header(); ?>

<div id="content" class="it-blog <?php echo ideothemo_get_content_classes(); ?>"<?php do_action('ideothemo_content_tag'); ?>>

    <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled() || !has_shortcode(get_the_content(), 'vc_row'))): ?>
    <div class="container">
    <?php endif; ?>
        <div class="row">
            <div class="entry-content <?php echo ideothemo_get_blog_sidebar_page_classes(ideothemo_get_sidebar_position()); ?>">
                <?php the_content(); ?>
               
                <?php wp_link_pages(array(
                    'before'      => '<div class="pagination standard skin-colored-' . ideothemo_get_general_theme_skin() . '">',
                    'after'       => '</div>',
                    'link_before' => '<span>',
                    'link_after'  => '</span>',
                )); ?>
                
                <?php /** COMMENTS */ ?>
                <?php if ( comments_open() && ideothemo_blog_comments_enabled()) : ?>
                
                <?php if (!ideothemo_is_boxed_version() && !ideothemo_is_sidebar_enabled() && has_shortcode(get_the_content(), 'vc_row')): ?>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                <?php endif; ?>
                
                <?php get_template_part('parts/blog/single/comments'); ?>                
                
                <?php if (!ideothemo_is_boxed_version() && !ideothemo_is_sidebar_enabled() && has_shortcode(get_the_content(), 'vc_row')): ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php endif;?>
            </div>
            <?php get_sidebar(); ?>
            <?php do_action('ideothemo_content_entry_after'); ?>
        </div>
        

        
        <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled() || !has_shortcode(get_the_content(), 'vc_row'))): ?>
    </div>
<?php endif; ?>

</div> <!-- /#content -->

<?php get_footer(); ?>


