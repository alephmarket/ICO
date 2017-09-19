<?php if (!is_search()) : ?>
        <div class="navigator-bar">
            <div class="container<?php if(ideothemo_is_boxed_version()){ ?>-navigator-bar<?php } ?>">
                <?php if (ideothemo_get_member_social()) : ?>
                    <?php get_template_part('parts/header/team/social'); ?>
                <?php endif; ?>
                
                <?php get_template_part('parts/header/nav-posts'); ?>
                <div class="clearfix"></div>
            </div>
        </div>
<?php endif; ?>