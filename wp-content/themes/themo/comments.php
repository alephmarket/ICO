<?php

if (post_password_required()) { ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'themo'); ?></p>
    <?php
    return;
}
?>

<!-- You can start editing here. -->

<?php if (have_comments()) : ?>
    <ol class="comment-list js--coments-list">
        <?php get_template_part('parts/blog/single/comment-list'); ?>
    </ol>

    <?php if (get_comments_number() > ideothemo_get_comments_per_page()) : ?>

        <?php
        global $wp_query;

        $cpage = get_query_var('cpage');
        $max_page = $wp_query->max_num_comment_pages;

        if (empty($max_page))
            $max_page = get_comment_pages_count();
        ?>

        <div class="row text-center pagination load-more">
            <a href="" class="button btn-center load-more-button js--load-more-comments"
               data-post_id="<?php the_ID(); ?>"
               data-page="<?php echo esc_attr($cpage); ?>"
               data-max_page="<?php echo esc_attr($max_page); ?>"
               data-action="loadCommentsAjax"
               data-default_comments_page="<?php echo esc_attr(get_option('default_comments_page')); ?>">
                <?php esc_html_e('Load more', 'themo'); ?>
            </a>
            <div class="loader"><?php echo esc_html__('Loading...', 'themo'); ?></div>
        </div>
    <?php endif; ?>
<?php else : // this is displayed if there are no comments so far ?>

    <?php if (comments_open()) : ?>
        <!-- If comments are open, but there are no comments. -->

    <?php else : // comments are closed ?>
        <!-- If comments are closed. -->
        <p class="nocomments"><?php esc_html_e('Comments are closed.', 'themo'); ?></p>

    <?php endif; ?>
<?php endif; ?>

<?php if (comments_open()) : ?>
    <h2 class="text-center sub-head"><?php esc_html_e('Leave a Reply', 'themo'); ?></h2>
    <div id="comments" class="comments-area">
        <?php

        comment_form
        (
            array(
                'comment_notes_before' => '',
                'comment_notes_after' => '',
                'class_submit' => 'submit button',
                'comment_field' => '<p class="comment-form-comment"><textarea id="comment" name="comment"
                                                                              placeholder="' . esc_html__('Comment', 'themo') . '" cols="45" rows="8"
                                                                              aria-describedby="form-allowed-tags"
                                                                              aria-required="true"></textarea></p>'
            )
        );
        ?>
    </div>

<?php endif; ?>
