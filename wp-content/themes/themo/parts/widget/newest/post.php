<?php if (have_posts()): ?>

    <ul class="newest-list">
        <?php while (have_posts()) : the_post(); ?>

            <li<?php if (has_post_thumbnail()): ?> class="no-image clearfix"<?php endif; ?>>
                <?php if (has_post_thumbnail()): ?>
                    <div class="image">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail('ideothemo-blog-thumbnail-widget'); ?>
                        </a>
                    </div>
                <?php endif; ?>

                <p class="date"><?php the_time('d F Y'); ?></p>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <span class="comments"><?php echo get_comments_number(); ?></span>
            </li>
        <?php endwhile; ?>
    </ul>

<?php endif;