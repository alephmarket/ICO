<div class="container<?php if(ideothemo_is_boxed_version()){ ?>-content<?php } ?>">
    <div class="page-title-row row"<?php if (ideothemo_pt_parallax_effect_enabled()) : ?> data-motion="pt-motion" data-motion-speed="<?php echo ideothemo_get_pt_parallax_moving_speed(); ?>"<?php endif; ?>>

        <div class="<?php ideothemo_page_title_classes(); ?>">
            <div class="page-title-content<?php echo ideothemo_get_team_image_align() !== '' && ideothemo_get_team_image_align() !== null ?  ' team-image-' . ideothemo_get_team_image_align() : '';?><?php echo ideothemo_is_member_pt_image_enabled() && has_post_thumbnail()?' has-thumbnail':''; ?>">
                <?php get_template_part( 'parts/header/page-title-content' ); ?>
            </div>
            
        </div>

        <?php if (ideothemo_breadcrumbs_position() == 'bottom') : ?>
            <?php get_template_part( 'parts/header/breadcrumbs' ); ?>
        <?php endif; ?>

    </div>
</div>

<?php get_template_part( 'parts/header/below-page-title', get_post_type() ); ?>