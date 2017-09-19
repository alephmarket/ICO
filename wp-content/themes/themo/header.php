<?php ideothemo_set_ID(); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
    <head>    
        <meta charset="<?php bloginfo( 'charset' ); ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

        <?php wp_head(); ?>
    </head>

    <body <?php body_class(); ?> <?php do_action('ideothemo_body_tag');?> data-id="<?php echo get_the_ID(); ?>" <?php
        ideothemo_local_modifications(
            array(
                'fonts.font_coloring.body_text_skin',
                'generals.layout.boxed_version',
                'generals.background.boxed_background_type',
                'generals.background.content_background_type'
            ))?>>
        
    <?php do_action('ideothemo_body_entry_before');?>


    <?php get_template_part('parts/transition/header'); ?>
    
    <?php if (ideothemo_is_advanced_sticky_loading()): ?><div id="ideo-transition-page-container"><?php endif; ?>
    
        <a id="top"></a>
        <div id="page-container">        
           
            <?php if ( ideothemo_is_boxed_version() ) : ?>
            <div class="container">
            <?php endif; ?>
            
            <?php get_template_part('parts/header/header'); ?>            
            <?php get_template_part('parts/slider/slider'); ?>

            <?php if( !is_page() ): ?>
                <div id="ideo-page" class="<?php echo ideothemo_get_layout_type_class(); ?>">
            <?php endif; ?>
