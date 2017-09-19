<?php if (ideothemo_is_portfolio_parametrs_enabled() && ideothemo_get_portfolio_parameters()) : ?>
    <ul class="portfolio-parameters">
        <?php foreach (ideothemo_get_portfolio_parameters() AS $parametr) : ?>
            <?php if (!empty($parametr['value'])): ?>
                <li>
                    <?php if (isset($parametr['url']) && !empty($parametr['url'])) : ?>
                        <a href="<?php echo esc_url($parametr['url']); ?>">
                        <?php endif; ?>
                        <strong class="param-label"><?php echo esc_html($parametr['label']); ?>: </strong>
                        <span class="param-value"><?php echo esc_html($parametr['value']); ?></span>
                        <?php if (isset($parametr['url']) && !empty($parametr['url'])) : ?>
                        </a>
                    <?php endif; ?>
                </li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>
    <?php
 endif;