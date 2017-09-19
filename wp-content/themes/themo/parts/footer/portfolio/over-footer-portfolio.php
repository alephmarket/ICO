<?php if (ideothemo_portfolio_navigation_enabled() || ideothemo_is_customize_preview()) : ?>
    <div class="footer-navigator-bar">
        <div class="container">
                <?php get_template_part('parts/footer/nav-posts'); ?>
            <div class="clearfix"></div>
        </div>
    </div>
<?php endif; ?>