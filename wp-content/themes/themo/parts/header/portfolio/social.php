<div class="socials"<?php ideothemo_customize_attrs(false, ideothemo_blog_social_enabled('', false)); ?>>
    <div class="symbol"><i class="fa fa-share-alt-square"></i></div>
    <ul>
        <?php

        foreach (get_list_enabled_social_media() as $social) : ?>

            <li<?php ideothemo_customize_attrs(false, ideothemo_get_enabled_social_media($social, false, false)); ?>>
                <?php
                echo ideothemo_get_social_share(array($social), get_permalink(), get_the_title(), get_the_excerpt(), '', false, 'portfolio');
                ?>
            </li>

        <?php endforeach; ?>
    </ul>
</div>