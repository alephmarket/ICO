<?php if (have_posts()): ?>

    <ul class="newest-list">
        <?php while (have_posts()) : the_post(); ideothemo_get_the_post_thumbnail_size()?>

            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
            </li>
        <?php endwhile; ?>
    </ul>

<?php endif;