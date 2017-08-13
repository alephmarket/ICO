<?php get_header(); ?>

<div id="content" class="it-blog <?php echo ideothemo_get_content_classes(); ?>"<?php do_action('ideothemo_content_tag'); ?>>
    <?php if (!ideothemo_is_boxed_version() ): ?>
        <div class="container">
        <?php endif; ?>
            <div class="row">

                <div class="entry-content <?php echo ideothemo_get_blog_sidebar_page_classes(ideothemo_get_sidebar_position()); ?>">
            	<?php if(have_posts()): ?>

                    <?php echo do_shortcode('[ideo_blog el_desc_cols="3" el_excerpt="automatic" el_excerpt_words="' . ideothemo_get_blog_search_excerpt_words() . '" el_date_position="meta" el_pagination="' . ideothemo_get_blog_search_pagination() . '" el_type="masonry" el_post_page="' . ideothemo_get_blog_search_posts_per_page() . '" el_authors=""  el_date="" el_share=""]'); ?>

                <?php else: ?>
                <div class="no-results">
                    <h1 class="no-results__header">Nothing Found</h1>
                    <div class="no-results__text"><?php echo esc_html__('No result were found. If you want to rephrase your query, use search field below.', 'themo') ?></div>
                    <form class="no-results__search-bar" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="no-results__search">
                            <input type="text" class="form-control" name="s" placeholder="<?php esc_html_e('Search on website', 'themo'); ?>">
                            <button type="submit" class=""><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <?php endif; ?>
                </div>

                <?php get_sidebar(); ?>

				<?php if(have_posts()): ?>
                <?php do_action('ideothemo_content_entry_after'); ?>
                <?php endif; ?>
            </div>
        <?php if (!ideothemo_is_boxed_version() ): ?>
        </div>
        <?php endif; ?>    


</div>

<?php get_footer(); ?>