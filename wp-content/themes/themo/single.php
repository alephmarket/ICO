<?php get_header(); ?>

<div id="content" class="it-blog <?php echo ideothemo_get_content_classes(); ?>" <?php do_action('ideothemo_content_tag');?>>
    <?php if (!ideothemo_is_boxed_version()): ?>
    <div class="container">
    <?php endif; ?>
        <div class="row">
        <div class="entry-content <?php echo ideothemo_get_blog_sidebar_page_classes(ideothemo_get_sidebar_position()); ?>">
            <!-- single posts list element -->
            <?php while (have_posts()) : the_post(); ?>
            <article
                class="it-list-view ideo-blog-single ideo-blog-entry <?php echo ideothemo_get_theme_skin_class();?>">

                <?php /** NAV */ ?>
                <?php if (ideothemo_nextprev_navi_enabled()) : ?>

                    <?php get_template_part('parts/blog/single/nav'); ?>

                <?php endif; ?>


                <header>

                    <?php /** TOP */ ?>
                    <?php if (ideothemo_blog_feature_image_enabled()) : ?>

                        <?php get_template_part('parts/blog/single/feature_image'); ?>

                    <?php endif;?>

                    <?php /** POST TITLE */ ?>
                    <?php if (ideothemo_blog_post_title_enabled()) : ?>
                        <h1 class="post-title"<?php ideothemo_customize_attrs(ideothemo_get_post_meta('blog.blog_single.blog_single_post_title'), ideothemo_blog_post_title_enabled(false, false)); ?>><?php the_title(); ?></h1>
                    <?php endif;?>

                    <?php if (ideothemo_blog_meta_enabled()): ?>
                        <div
                            class="post-meta"<?php ideothemo_customize_attrs(ideothemo_get_post_meta('blog.blog_single.blog_single_post_meta'), ideothemo_blog_meta_enabled(false, false)); ?>>
                            <?php /** AUTHOR */ ?>
                            <?php if (ideothemo_blog_author_enabled()) : ?>
                                <?php get_template_part('parts/blog/single/meta/authors'); ?>
                            <?php endif; ?>

                            <?php /** DATE */ ?>
                            <?php if (ideothemo_blog_date_enabled()) : ?>
                                <?php get_template_part('parts/blog/single/meta/date'); ?>
                            <?php endif; ?>

                            <?php /** TAGS */ ?>
                            <?php if (ideothemo_blog_tags_enabled()) : ?>

                                <?php get_template_part('parts/blog/single/meta/tags'); ?>

                            <?php endif; ?>

                            <?php /** COMMENTS */ ?>
                            <?php if (ideothemo_blog_comments_enabled()) : ?>

                                <?php get_template_part('parts/blog/single/meta/comments'); ?>

                            <?php endif; ?>
                        </div>

                    <?php endif; ?>

                </header>

                <div class="blog-content">
                    <?php the_content(); ?>
                    <?php wp_link_pages(array(
                        'before'      => '<div class="pagination standard skin-colored-' . ideothemo_get_general_theme_skin() . '">',
                        'after'       => '</div>',
                        'link_before' => '<span>',
                        'link_after'  => '</span>',
                    )); ?>
                </div>

                <footer>

                    <?php /** CATEGORIES */ ?>
                    <?php if (ideothemo_blog_categories_enabled()) : ?>

                        <?php get_template_part('parts/blog/single/categories'); ?>

                    <?php endif;?>

                    <?php /** SOCIAL MEDIA */ ?>
                    <?php if (ideothemo_blog_social_enabled()) : ?>

                        <?php get_template_part('parts/blog/single/social'); ?>

                    <?php endif; ?>

                    <?php /** AUTHOR DETAILS */ ?>
                    <?php if (ideothemo_blog_author_enabled()) : ?>

                        <?php get_template_part('parts/blog/single/author_details'); ?>

                    <?php endif;?>

                    <?php /** RELATED POSTS */ ?>
                    <?php if (ideothemo_blog_related_posts_enabled()) : ?>

                        <?php get_template_part('parts/blog/single/related_posts'); ?>

                    <?php endif;?>

                    <?php /** COMMENTS */ ?>
                    <?php if (ideothemo_blog_comments_enabled()) : ?>

                        <?php get_template_part('parts/blog/single/comments'); ?>

                    <?php endif;?>

                </footer>
            </article>
        </div>

        <?php endwhile; ?>

        <?php
        get_sidebar();
        ?>
    </div>
    <?php if (!ideothemo_is_boxed_version()): ?>
    </div>
    <?php endif;?>

    <?php do_action('ideothemo_content_entry_after'); ?>
</div>

<?php get_footer(); ?>
