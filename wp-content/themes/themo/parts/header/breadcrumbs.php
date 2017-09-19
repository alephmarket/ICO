<?php if (!is_front_page() && !is_singular('team') && ideothemo_breadcrumbs_area_enabled(1)) : ?>
    <div class="nav-bar<?php if (!ideothemo_breadcrumbs_area_mobile_enabled()) { echo ' hidden-xs hidden-sm'; } ?>">
        <ol class="breadcrumb <?php echo ideothemo_breadcrumbs_position(); ?>">

            <li><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home"><span class="glyphicon glyphicon-home"></span></a></li>

            <?php if (is_singular()) : ?>

                <?php if (is_singular('post')) : ?>
                    <li><a href="<?php echo get_category_link(ideothemo_get_post_category_breadcumbs(get_the_ID())); ?>">
                            <?php
                            echo get_cat_name(ideothemo_get_post_category_breadcumbs(get_the_ID()));
                            ?>
                        </a></li>
                <?php endif; ?>

            <?php if (is_singular(ideothemo_get_portfolio_slug())) :
                    if ($main_page = ideothemo_get_portfolio_main_page()) :
                        ?>
                        <li><a href="<?php echo esc_url((preg_match('/^(https?:\/\/|\/)/i', $main_page) ? '' : '/') .  $main_page); ?>">
                                <?php echo ideothemo_get_portfolio_label(); ?>
                            </a></li>
                    <?php endif; ?>
                <?php endif; ?>
                            
                <?php if(is_singular( 'page' ) && $post->post_parent !== 0):
                    echo ideothemo_breadcrumbspost_parents($post->post_parent, get_option('page_on_front'), '');
                endif; ?>

                <li class="active"><?php the_title(); ?></li>

            <?php elseif (is_category()) : ?>

                <li class="active"><?php echo single_cat_title(); ?></li>

            <?php elseif (is_tag()) : ?>
                <li class="active"><?php echo single_tag_title(); ?></li>

            <?php elseif (is_date()) : ?>

                <li><a href="<?php echo get_year_link(get_the_date('Y')); ?>"><?php echo get_the_date('Y'); ?></a></li>

                <?php if (is_month() || is_day()) : ?>
                    <li class="active"><?php echo get_the_date('F'); ?></li>
                <?php endif; ?>

                <?php if (is_day()) : ?>
                    <li class="active"><?php echo get_the_date('d'); ?></li>
                <?php endif; ?>

            <?php elseif (is_author()) : ?>

                <li class="active"><?php esc_html_e('Author', 'themo'); ?>:
                    <?php $author = get_userdata(get_query_var('author')); ?>

                    <?php echo esc_html($author->display_name); ?></li>

            <?php elseif (is_search()) : ?>
                <li class="active"><?php esc_html_e('Search Results', 'themo'); ?></li>
            <?php endif; ?>
        </ol>
    </div>
<?php endif; ?>
