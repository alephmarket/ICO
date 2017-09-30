<?php 
if ( ! defined( 'ABSPATH' ) ) exit;


//////////// CUSTOM POST TYPE STARTS HERE!!!!! //////////////

function ss_m_custom_post_type(){
  $labels = array(
    'name' => _x('Subscribe Forms','post type general name'),
    'singular_name' => _x('Subscribe Form','post type singular name'),
    'add_new' => _x('Add New','Forms'),
    'add_new_item' => __('Add new Forms'),
    'edit_item' => __('Edit Forms'),
    'new_item' => __('New Forms'),
    'all_items' => __('All Forms'),
    'view_itme' => __('View Forms'),
    'search_items' => __('Search Forms'),
    'not_found' => __('No Forms found'),
    'not_found_in_trash' => __('No Forms found in trash'),
    'parent_item_colon' => "",
    'menu_name' => 'Subscribe Forms'
    );
  $args = array(
    'labels' => $labels,
    'description' => 'Create SM Forms',
    'menu_position' => 10,	
    'public' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'supports' => array('title','custom_fields'),
    'has_archive' => true,
    'query_var' => 'ssm_forms',
    'menu_icon' => 'dashicons-email',
    'show_in_menu' => true,
    'show_in_nav_menus' => false
    );


  register_post_type('subscribe_me_forms',$args);
}

add_action('init','ss_m_custom_post_type');

//////////// CUSTOM POST TYPE ENDS HERE!!!!! ////////////// /
                                                        // //   / 
                                                            //  //  /
                                                            //  //  //
                // WONDERFULL ART HERE                      //  //  //////////////////////////////
                                                            //  //  ///        //////////////////
                                                            //  //  ////////////////////////////
                                                            //  //  ///
                                                            //  //
                                                            //  //
                                                            //  /
                                                            //

/////////////////////////// Removing post name from perma link ///////////////////////////


function msf_custom_posts_column($defaults) {
    unset($defaults['date']);
    $defaults['msf_shortocode']  = 'Shortocode';
    return $defaults;
}
function msf_display_custom_column_data($column_name, $post_ID) {
    if ($column_name == 'msf_shortocode') {
        echo "<div style='padding: 7px 10px 8px 31px;background: #fff;border: 1px solid #D2D2D2;border-radius: 3px;width: 20%; min-width:200px;font-weight: bold;' >[ssm_form id='$post_ID']</div>";
    }
}

add_filter('manage_subscribe_me_forms_posts_columns', 'msf_custom_posts_column');
add_action('manage_subscribe_me_forms_posts_custom_column','msf_display_custom_column_data',10, 2);

function ssm_post_form_filter($content){
    $current_post_type =  get_post_type(get_the_id());
    $postID = get_the_id();

    if ($current_post_type === "subscribe_me_forms") {
        return do_shortcode("[ssm_form id='$postID']");
    }else{
       return do_shortcode($content);
    }
}

add_filter('the_content','ssm_post_form_filter');


?>