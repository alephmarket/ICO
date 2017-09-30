<?php

function ideothemo_remove_default_shortcodes(){
    //vc_remove_element("vc_tta_tabs");
    vc_remove_element("vc_tta_tour");
    vc_remove_element("vc_tta_accordion");
    vc_remove_element("vc_tta_pageable");
    vc_remove_element("vc_cta");
    vc_remove_element("vc_text_separator");
    vc_remove_element("vc_message");
    vc_remove_element("vc_toggle");
    vc_remove_element("vc_posts_slider");
    vc_remove_element("vc_button2");
    vc_remove_element("vc_custom_heading");
    vc_remove_element("vc_basic_grid");
    vc_remove_element("vc_media_grid");
    vc_remove_element("vc_masonry_grid");
    vc_remove_element("vc_masonry_media_grid");
    vc_remove_element("vc_images_carousel");
    vc_remove_element("vc_gallery");
    vc_remove_element("vc_pie");
    vc_remove_element("vc_icon");
    vc_remove_element("vc_tour");
    vc_remove_element("vc_cta_button2");
    vc_remove_element("vc_progress_bar");
    vc_remove_element("vc_empty_space");
    vc_remove_element("vc_gmaps");
    vc_remove_element("vc_progress_bar");
    vc_remove_element("vc_btn");
    vc_remove_element("vc_round_chart");
    vc_remove_element("vc_line_chart");
    vc_remove_element("vc_tabs");
    vc_remove_element("vc_cta_button");
    
    if(defined('WPCF7_VERSION')){
        vc_remove_element("contact-form-7");
    }
}

 add_action( 'admin_init', 'ideothemo_remove_default_shortcodes' );

function &ideothemo_tab_counter($add = 0){
    static $counter = 0;
    static $styles_array = array();
    
    if($add){
        $counter += $add;
    }
    if($add == 'reset'){
        $counter = 0;
    }
    
    return $counter;
}

function ideothemo_add_shortcodes(){
    

    include('ideo_row.php');
    include('ideo_column.php');
    include('ideo_accordion.php');
    include('ideo_tabs.php');
    include('ideo_tab.php');
    include('ideo_button.php');
    include('ideo_block.php');
    include('ideo_block_styled.php');
    include('ideo_divider.php');
    include('ideo_divider_padding.php');
    include('ideo_divider_icon.php');
    include('ideo_progress_bar.php');
    include('ideo_calltoaction.php');
    include('ideo_iconbox.php');
    include('ideo_iconbox2.php');
    include('ideo_imagebox.php');
    include('ideo_pie_chart.php');
    include('ideo_counter.php');
    include('ideo_message_box.php');
    include('ideo_custom_list.php');
    include('ideo_testimonials_slider.php');
    include('ideo_testimonial_item.php');
    include('ideo_single_image.php');
    if(defined('WPCF7_VERSION')){
        include('ideo_contact_form7.php');
    }
    include('ideo_icons.php');
    include('ideo_google_map.php');
    include('ideo_google_map_v2.php');
    include('ideo_wow_title.php');
    include('ideo_box_styled.php');
    include('ideo_pricing_table.php');
    include('ideo_team_box.php');
    include('ideo_team_box_caption.php');
    include('ideo_blog.php');
    include('ideo_wp_newest_posts.php');
    
    
}
add_action( 'vc_before_init', 'ideothemo_add_shortcodes' );