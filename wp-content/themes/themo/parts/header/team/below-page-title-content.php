
    <?php if (ideothemo_is_member_pt_image_enabled() && has_post_thumbnail()) : ?>
        <div class="member-image-container">
            <?php the_post_thumbnail('thumbnail', array('class' => 'member-image')); ?>
        </div>
    <?php endif; ?>