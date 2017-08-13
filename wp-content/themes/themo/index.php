<?php get_header(); ?>

    <div id="content" class="it-blog <?php echo ideothemo_get_content_classes(); ?>" <?php do_action('ideothemo_content_tag');?>>
        <?php if (!ideothemo_is_boxed_version()): ?>
        <div class="container">
        <?php endif; ?>        
            <div class="row">
                 <div class="entry-content <?php echo ideothemo_get_blog_sidebar_page_classes(ideothemo_get_sidebar_position()); ?>">
                    <?php 
                     if ( !shortcode_exists( 'ideo_blog' ) ) {    
                         echo ideothemo_get_blog_html();
                     }else{
                        echo do_shortcode('[ideo_blog el_mob_cols="1" el_desc_cols="' . ideothemo_get_blog_archives_masonry_blocks() . '" el_excerpt="automatic" el_excerpt_words="' . ideothemo_get_blog_archives_excerpt_words() . '" el_date_position="left" el_pagination="' . ideothemo_get_blog_archives_pagination() . '" el_type="' . ideothemo_get_archive_layout() . '" el_post_page="' . ideothemo_get_blog_archives_posts_per_page() . '"  el_date_position="left" el_pagination="' . ideothemo_get_blog_archives_pagination() . '" el_type="' . ideothemo_get_archive_layout() . '" el_post_page="' . ideothemo_get_blog_archives_posts_per_page() . '" el_authors="" el_date="" el_categories="" el_tags="" el_comments="" el_share="" el_facebook="" el_twitter="" el_google="" el_pinterest="" el_reddit="" el_linkedin="" el_tumblr="" el_vk="" el_email=""]'); 
                         
                     } ?>
                </div>

                <?php get_sidebar(); ?>

                <?php do_action('ideothemo_content_entry_after'); ?>
            </div>
        <?php if (!ideothemo_is_boxed_version()): ?>
        </div>
        <?php endif; ?>      
    </div> <!-- /#content -->

<?php get_footer(); ?>