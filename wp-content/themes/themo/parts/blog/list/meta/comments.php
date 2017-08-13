<?php if (comments_open()) : ?>
    <div class="comments" @special@>
        <a href="<?php echo get_comments_link(); ?>"><?php echo get_comments_number(); ?></a>
    </div>
<?php endif; ?>