<?php the_comments_navigation(); ?>

<ol class="comment-list">
    <?php
        wp_list_comments( array(
            'style'       => 'ol',
            'short_ping'  => true,
            'avatar_size' => 83,
        ) );
    ?>
</ol><!-- .comment-list -->

<?php the_comments_navigation(); ?>