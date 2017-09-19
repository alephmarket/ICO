<?php if (get_the_category()) : ?>
    <div class="categories" @special@>
        <?php echo get_the_category_list(); ?>
    </div>
<?php endif; ?>