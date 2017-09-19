<?php if (ideothemo_is_advanced_sticky_loading()): ?>

<div class="ideo-transition ideo-transition-overlay" style="background-color: <?php echo ideothemo_get_advanced_loader_background_color(); ?>;"></div>

<div class="ideo-transition ideo-transition-box">
    
    <?php $logo = ideothemo_get_theme_mod_parse('advanced.advanced_loading.logo'); if (wp_get_referer() === false && !empty($logo)): ?>
        <div class="ideo-transition-logo">
            <img id="transition_logo" src="<?php echo esc_url($logo); ?>" <?php echo ideothemo_get_theme_mod_parse('advanced.advanced_loading.logo_retina') ? 'data-at2x="' . ideothemo_get_theme_mod_parse('advanced.advanced_loading.logo_retina') . '"' : '' ?> alt="transition-logo" />
        </div>
    <?php endif; ?>

    <div class="ideo-transition-loader" style="color: <?php echo ideothemo_get_advanced_loader_color(); ?>;">
    <?php get_template_part(sprintf('parts/transition/loaders/%s', ideothemo_get_theme_mod_parse('advanced.advanced_loading.advanced_loader'))); ?>
    </div>   
</div>

<?php endif; ?>
       
