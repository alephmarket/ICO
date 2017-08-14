<?php
/**
 * Template Name: 404
 * */


    
?>

<?php get_header(); ?>

<div id="content" class="it-blog <?php echo ideothemo_get_content_classes(); ?>"<?php do_action('ideothemo_content_tag'); ?>>
    
        <?php if (!ideothemo_is_boxed_version() && (ideothemo_is_sidebar_enabled())): ?>
        <div class="e404-container container">
        <?php else: ?>
        <div class="col-md-12 e404-container">
        <?php endif; ?>
        <div class="e404-row row">
            <div class="e404-entry-content entry-content <?php echo ideothemo_get_blog_sidebar_page_classes(ideothemo_get_sidebar_position()); ?>">                
                <section class="e404-centered">
					<div class="text-1">404</div>
					<div class="text-2">Page not found</div>
					<div>
						<a class="button flat" href="<?php echo esc_url( home_url( '/' ) ); ?>"><span>Homepage</span></a>
					</div>
				</section>
            </div>
            <?php get_sidebar(); ?>
            <?php do_action('ideothemo_content_entry_after'); ?>
        </div>       
        </div>
    
</div> <!-- /#content -->

<?php get_footer(); ?>
