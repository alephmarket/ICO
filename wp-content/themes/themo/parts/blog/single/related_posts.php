<?php

global $wp_query;
$wp_query = ideothemo_get_similar_posts();
?>

<?php if (have_posts()) : ?>

    <div class="related-posts"<?php ideothemo_customize_attrs(ideothemo_get_post_meta('blog.blog_single.blog_single_related_posts'), ideothemo_blog_related_posts_enabled('', false));?>>
        <h2 class="text-center sub-head"><?php esc_html_e('Related posts', 'themo'); ?></h2>

        <div class="row recommended">
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-xs-12 col-sm-4 col-md-4 recommended-post">
                    <?php get_template_part('parts/blog/single/related_posts_feature_image'); ?>

                    <a href="<?php the_permalink(); ?>"><h4><?php the_title(); ?></h4>

                        <div><?php echo ideothemo_related_post_excerpt(); ?></div>
                    </a>

                    <?php echo ideothemo_related_post_comments_number() ?>
                    <?php echo ideothemo_post_format_read_more() ?>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
<?php endif; ?>

<?php 
wp_reset_postdata();
wp_reset_query(); 
?>