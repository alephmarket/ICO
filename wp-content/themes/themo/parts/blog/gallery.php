<?php if (ideothemo_get_post_gallery_photos()) : ?>
    <div id="post-<?php the_ID(); ?>-gallery-carousel" class="carousel slide" data-ride="carousel">

        <ol class="carousel-indicators">
            <?php $i = 0; foreach (ideothemo_get_post_gallery_photos() as $key => $image) : ?>
                <li data-target="#post-<?php the_ID(); ?>-gallery-carousel" data-slide-to="<?php echo esc_attr($i); ?>"
                    class="<?php echo($i == 0 ? 'active' : ''); ?>"></li>
            <?php $i++; endforeach; ?>
        </ol>


        <div class="carousel-inner" role="listbox">

            <?php $i = 0; foreach (ideothemo_get_post_gallery_photos() as $key => $image) : ?>
                <div data-slide-no="<?php echo  esc_attr($i); ?>" class="item <?php echo($i == 0 ? 'active' : ''); ?>">
                    <img src="<?php echo esc_url($image); ?>">
                </div>

            <?php $i++; endforeach; ?>
        </div>

        <a class="left carousel-control" href="#post-<?php the_ID(); ?>-gallery-carousel" role="button"
           data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only"><?php esc_html_e('Previous', 'themo'); ?></span>
        </a>

        <a class="right carousel-control" href="#post-<?php the_ID(); ?>-gallery-carousel" role="button"
           data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only"><?php esc_html_e('Next', 'themo'); ?></span> </a>
    </div>

<?php
endif;