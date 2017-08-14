<?php 
if(is_singular('team')):
        get_template_part('parts/header/team/below-page-title-content');
    endif;
?>
<div class="page-title-content-<?php echo ideothemo_breadcrumbs_position(); ?>">   
    
    <h1 class="title"><?php echo ideothemo_get_the_title(); ?></h1>
    <?php if (ideothemo_get_the_subtitle()) : ?>
        <p class="lead"><?php echo ideothemo_get_the_subtitle(); ?></p>
    <?php endif; ?>   
        
    <?php if(is_singular(ideothemo_get_portfolio_slug())):
            get_template_part('parts/header/portfolio/below-page-title-content');
        endif;
    ?>
</div>
<?php 
  
if(ideothemo_breadcrumbs_position() === 'inside'):
    get_template_part( 'parts/header/breadcrumbs' );
endif;