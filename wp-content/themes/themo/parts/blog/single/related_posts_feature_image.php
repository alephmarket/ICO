<div
    class="ideo-featured-image"<?php ideothemo_customize_attrs(ideothemo_get_post_meta('blog.blog_single.blog_single_featured_image'), ideothemo_blog_feature_image_enabled('', false)); ?>>

    <?php if (get_post_format() == 'video') : ?>

        <?php echo ideothemo_get_media(get_the_ID(), get_post_format()); ?>

    <?php elseif (get_post_format() == 'audio') : ?>

        <?php echo ideothemo_get_media(get_the_ID(), get_post_format()); ?>


    <?php elseif (get_post_format() == 'quote') : ?>

        <?php get_template_part('parts/blog/single/quote'); ?>

    <?php elseif (get_post_format() == 'link') : ?>

        <?php get_template_part('parts/blog/single/url'); ?>

    <?php elseif (get_post_format() == 'gallery') : ?>

        <?php get_template_part('parts/blog/gallery'); ?>

    <?php else : ?>

        <?php if (has_post_thumbnail()) : ?>
            <?php   $image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'ideothemo-blog-featured-image');?>
            <a href="<?php the_permalink(); ?>" class="thumbnail-recommended"
               style="background-image: url(' <?php echo esc_url($image[0]); ?> ');">
            </a>
        <?php endif; ?>
    <?php endif; ?>

</div>