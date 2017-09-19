<header id="header" class="<?php echo esc_attr(ideothemo_get_header_classes(1)); ?>"
        data-header-type="<?php echo esc_attr(ideothemo_get_header_setting('type')); ?>" <?php
ideothemo_local_modifications(
    array(
        'header.type',

        'header.top.style',
        'header.top.logo.type',
        'header.top.top_distance',

        'header.sticky.style',
        'header.sticky.logo.type',
        'header.sticky.top_distance',
        'header.sticky.loading_effect',

        'header.side.style',
        'header.side.align.menu',
        'header.side.align.bottom_area',
        'header.side.logo.type',
        
        'header.side.offcanvas.topbar.style',
        'header.side.offcanvas.topbar.transparent',
        'header.side.offcanvas.stickybar.style',
        'header.side.offcanvas.topbar.logo.type',
        'header.side.offcanvas.stickybar.logo.type',

    ));
?> <?php if (ideothemo_pt_background_effect_enabled('parallax', 1)) : ?> data-motion="parallax" data-motion-speed="<?php echo esc_attr(ideothemo_get_pt_background_moving_speed(1)); ?>"<?php endif; ?>>

    <div class="pt-overlay"></div>

    <div class="background-video" <?php do_action('ideothemo_header_background_tag'); ?>></div>

    <?php if ( ideothemo_page_title_area_enabled() && ideothemo_get_pt_area_background(1) == 'video') : ?>
    <?php do_action('ideothemo_pagetitle_background_' . ideothemo_get_pt_background_video_platform(1)); ?>
    <?php endif; ?>
    <div class="page-title-container skin-<?php echo esc_attr(ideothemo_get_page_title_skin_area(1)); ?>" <?php
    ideothemo_local_modifications(
        array(
            'pagetitle.page_title_settings.page_title_area_skin',
            'pagetitle.page_title_settings.page_title_area_height',
            'pagetitle.page_title_settings.page_title_area_content_align',
            'pagetitle.page_title_background.pt_background_parallax',
            'pagetitle.page_title_background.pt_background_motion',
            'pagetitle.page_title_fonts.pt_title_font_size',
            'pagetitle.page_title_fonts.pt_subtitle_font_size',
            'pagetitle.page_title_coloring.pt_title_color',
            'pagetitle.page_title_coloring.pt_subtitle_color',
            'pagetitle.page_title_coloring.pt_b_text_color',
            'pagetitle.page_title_coloring.pt_b_text_accent_color',
            'pagetitle.page_title_coloring.pt_b_background_color',
            'pagetitle.page_title_coloring.pt_b_border_color'
        )
    ); ?>>
        <?php get_template_part('parts/header/nav'); ?>
        <?php if (ideothemo_page_title_area_enabled()) : ?>
        <?php if ( !defined('IDEOTHEMO_CORE_VERSION') && is_singular('post') && ideothemo_get_page_title_local_setting('pagetitle.page_title_settings.page_title_area') == null )  : ?>            
        <?php else: ?>
            <?php get_template_part('parts/header/page-title', ideothemo_get_layout_type()); ?>
        <?php endif; ?>
        <?php endif; ?>
    </div>

    <?php do_action('ideothemo_header_bottom'); ?>

</header>