<?php if (get_the_tags()) : ?>
    <div class="tags"<?php ideothemo_customize_attrs(false, ideothemo_blog_tags_enabled('', false));?>>
        <ul>
            <?php foreach (get_the_tags() as $tag) : ?>
                <li>
                    <a href="<?php echo get_tag_link($tag->term_id); ?>" title="<?php echo  esc_attr($tag->name); ?> <?php esc_html_e('Tag','themo'); ?>"
                       class="<?php echo esc_attr($tag->slug); ?>">
                        <?php echo esc_html($tag->name); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>