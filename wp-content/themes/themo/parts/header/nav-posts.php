<div class="pagetitle-nav-container portfolio-nav-container">
    <ul class="portfolio-nav">
        <?php if (get_next_post()) : ?>
            <li class="previous">
                <a href="<?php echo get_permalink(get_next_post()); ?>">
                    <i class="id id-left"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (is_singular(ideothemo_get_portfolio_slug()) && ($main_page = ideothemo_get_portfolio_main_page())) : ?>
            <li class="list">
                <a href="<?php echo esc_url( (preg_match('/^(https?:\/\/|\/)/i', $main_page) ? '' : '/') .  $main_page); ?>">
                    <i class="id id-Home-category"></i>
                </a>
            </li>
        <?php endif; ?>

        <?php if (get_previous_post()) : ?>
            <li class="next">
                <a href="<?php echo get_permalink(get_previous_post()); ?>">
                    <i class="id id-right"></i>
                </a>
            </li>
        <?php endif; ?>
    </ul>
</div>