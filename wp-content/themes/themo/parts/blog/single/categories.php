<?php if (get_the_category()) : ?>
    <div class="tags"<?php ideothemo_customize_attrs(false, ideothemo_blog_categories_enabled('', false));?>>
        <div class="symbol"><i class="fa fa-tags"></i></div>
        <?php echo get_the_category_list(); ?>
    </div>
<?php endif; ?>