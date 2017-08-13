<div class="date" @special@>
    <a href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>">
        <?php the_time(get_option('date_format')); ?>
    </a>
</div>