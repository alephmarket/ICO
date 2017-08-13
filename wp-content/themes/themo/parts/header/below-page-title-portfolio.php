<?php if (false && is_singular(ideothemo_get_portfolio_slug())) : ?>

<?php
    if (ideothemo_portfolio_socials_enabled() || ideothemo_nextprev_navi_enabled()) : ?>
        <div class="navigator-bar">
            <div class="container<?php if(ideothemo_is_boxed_version()){ ?>-navigator-bar<?php } ?>">
                <?php if (ideothemo_portfolio_socials_enabled()) : ?>
                    <?php get_template_part('parts/header/portfolio/social'); ?>
                <?php endif; ?>
                
                <?php if (ideothemo_nextprev_navi_enabled()) : ?>
                    <?php get_template_part('parts/header/nav-posts'); ?>
                <?php endif; ?>
                <div class="clearfix"></div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

