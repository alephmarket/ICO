<div class="portfolio-footer-nav-container">
    <?php $next = get_next_post(); ?>
    <?php if ($next) : ?>
        <div class="previous">
            <a href="<?php echo get_permalink($next); ?>">
                <i class="id id-left"></i>
                <label><?php echo esc_html__("Previous item", "themo") ?></label>
                <h4><?php echo esc_html($next->post_title); ?></h4>
            </a>
        </div>
    <?php endif; ?>

    <?php if (is_singular(ideothemo_get_portfolio_slug()) && ($main_page = ideothemo_get_portfolio_main_page())) : ?>
        <div class="list">
            <a href="<?php echo esc_url((preg_match('/^(https?:\/\/|\/)/i', $main_page) ? '' : '/') .  $main_page); ?>">
                <div class="mini-square mini-square-1"></div>
                <div class="mini-square mini-square-2"></div>
                <div class="mini-square mini-square-3"></div>
                <div class="mini-square mini-square-4"></div>
            </a>
        </div>
    <?php endif; ?>

    <?php $previous = get_previous_post(); ?>
    <?php if ($previous) : ?>
        <div class="next">
            <a href="<?php echo get_permalink($previous); ?>">
                <i class="id id-right"></i>
                <label><?php echo esc_html__("Next item", "themo"); ?></label>
                <h4><?php echo esc_html($previous->post_title); ?></h4>
            </a>
        </div>
    <?php endif; ?>
    <div class="clearfix"></div>
</div>