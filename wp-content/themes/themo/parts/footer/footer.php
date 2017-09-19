<?php if (is_singular(ideothemo_get_portfolio_slug())) : ?>
    <?php get_template_part('parts/footer/portfolio/over-footer-portfolio'); ?>
<?php endif; ?>

<?php if (ideothemo_footer_enabled(1) || ideothemo_copyright_enabled(1)) : ?>
    <?php get_template_part('parts/footer/footer-container'); ?>
<?php endif; ?>
    
