<?php 
if ( ! defined( 'ABSPATH' ) ) exit;
//////////// META BOXES TYPE STARTS HERE!!!!! //////////////////
                                                        ///////
                                                        //////
                                                        /////
//////////// META BOXES TYPE STARTS HERE!!!!! //////////////


add_action('add_meta_boxes','ssm_add_meta_boxes');

  function ssm_add_meta_boxes(){
   
    add_meta_box('ssm_shortcode_meta' ,'Form Shortcode','ssm_shortcode_meta', 'subscribe_me_forms','side','high');

    add_meta_box('ssm_premium_ver' ,'Get More Awesome Features','ssm_premium_ver', 'subscribe_me_forms','side','high');

    add_meta_box('ssm_select_form_meta' ,'Select Form Template','ssm_select_form_meta', 'subscribe_me_forms','normal','high');

    add_meta_box('ssm_form_edit_meta' ,'Edit Form','ssm_form_edit_meta', 'subscribe_me_forms','normal','low');

    add_meta_box('ssm_form_popup_option' ,'PopUp Options','ssm_form_popup_option', 'subscribe_me_forms','normal','low');

    add_meta_box('ssm_form_integrations' ,'Integrations','ssm_form_integrations', 'subscribe_me_forms','normal','low');

    add_meta_box('ssm_form_subscribers' ,'Subscribers List','ssm_form_subscribers', 'subscribe_me_forms','normal','low');

    add_meta_box('ssm_form_autoresponder' ,'Autoresponder','ssm_form_autoresponder', 'subscribe_me_forms','normal','low');

    add_meta_box('ssm_color_settings_meta' ,'Form Color Settings','ssm_color_settings_meta', 'subscribe_me_forms','normal','low');

  }
 


add_action('save_post','ssm_save_metabox_data');

  function ssm_save_metabox_data($post_id){


  	if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
     
    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'my_meta_box_nonce' ) ) return;
     
    // if our current user can't edit this post, bail
    if( !current_user_can( 'edit_post' ) ) return;
     
    // now we can actually save the data
    $allowed = array( 
        'a' => array( // on allow a tags
            'href' => array() // and those anchors can only have href attribute
        )
    );
     
    // Make sure your data is set before trying to save it


    if( isset( $_POST['smf_example'] ) )
        update_post_meta( $post_id, 'smf_example', wp_kses( $_POST['smf_example'], $allowed ) );

      if( isset( $_POST['ssm_select_data_save_method'] ) )
        update_post_meta( $post_id, 'ssm_select_data_save_method',$_POST['ssm_select_data_save_method'] );

      if( isset( $_POST['ssm_subscribers_list'] ) )
        update_post_meta( $post_id, 'ssm_subscribers_list', wp_kses( $_POST['ssm_subscribers_list'], $allowed ) );



     if( isset( $_POST['ssm_select_form_template'] ) )
        update_post_meta( $post_id, 'ssm_select_form_template',$_POST['ssm_select_form_template'] );

      if( isset( $_POST['sm_form_header'] ) )
        update_post_meta( $post_id, 'sm_form_header', wp_kses( $_POST['sm_form_header'], $allowed ) );

      if( isset( $_POST['sm_form_content'] ) )
        update_post_meta( $post_id, 'sm_form_content', wp_kses( $_POST['sm_form_content'], $allowed ) );

      if( isset( $_POST['sm_form_cta_text'] ) )
        update_post_meta( $post_id, 'sm_form_cta_text', wp_kses( $_POST['sm_form_cta_text'], $allowed ) );

      if( isset( $_POST['sm_form_footer_msg'] ) )
        update_post_meta( $post_id, 'sm_form_footer_msg', wp_kses( $_POST['sm_form_footer_msg'], $allowed ) );

      if( isset( $_POST['smf_body_bg'] ) )
        update_post_meta( $post_id, 'smf_body_bg',$_POST['smf_body_bg'] );

      if( isset( $_POST['smf_form_bg'] ) )
        update_post_meta( $post_id, 'smf_form_bg',$_POST['smf_form_bg'] );

      if( isset( $_POST['smf_cta_bg'] ) )
        update_post_meta( $post_id, 'smf_cta_bg',$_POST['smf_cta_bg'] );

      if( isset( $_POST['smf_content_c'] ) )
        update_post_meta( $post_id, 'smf_content_c',$_POST['smf_content_c'] );

      if( isset( $_POST['smf_cta_c'] ) )
        update_post_meta( $post_id, 'smf_cta_c',$_POST['smf_cta_c'] );

       if( isset( $_POST['sm_form_name_placeholder'] ) )
        update_post_meta( $post_id, 'sm_form_name_placeholder',$_POST['sm_form_name_placeholder'] );

       if( isset( $_POST['sm_form_email_placeholder'] ) )
        update_post_meta( $post_id, 'sm_form_email_placeholder',$_POST['sm_form_email_placeholder'] );

      if( isset( $_POST['sm_form_custom_css'] ) )
        update_post_meta( $post_id, 'sm_form_custom_css',$_POST['sm_form_custom_css'] );

      if( isset( $_POST['sm_popup_active'] ) )
        update_post_meta( $post_id, 'sm_popup_active',$_POST['sm_popup_active'] );

      if( isset( $_POST['smf_popup_overlay_color'] ) )
        update_post_meta( $post_id, 'smf_popup_overlay_color',$_POST['smf_popup_overlay_color'] );

      if( isset( $_POST['smf_popup_close_color'] ) )
        update_post_meta( $post_id, 'smf_popup_close_color',$_POST['smf_popup_close_color'] );

      if( isset( $_POST['smf_popup_close_text'] ) )
        update_post_meta( $post_id, 'smf_popup_close_text',$_POST['smf_popup_close_text'] );

      if( isset( $_POST['smf_popup_delay'] ) )
        update_post_meta( $post_id, 'smf_popup_delay',$_POST['smf_popup_delay'] );

      if( isset( $_POST['ssm_mailchimp_listid'] ) )
        update_post_meta( $post_id, 'ssm_mailchimp_listid', wp_kses( $_POST['ssm_mailchimp_listid'], $allowed ) );

      if( isset( $_POST['ssm_mailchimp_apikey'] ) )
        update_post_meta( $post_id, 'ssm_mailchimp_apikey', wp_kses( $_POST['ssm_mailchimp_apikey'], $allowed ) );

      if( isset( $_POST['ssm_getresponse_campaign_id'] ) )
        update_post_meta( $post_id, 'ssm_getresponse_campaign_id', wp_kses( $_POST['ssm_getresponse_campaign_id'], $allowed ) );

      if( isset( $_POST['ssm_getresponse_api_key'] ) )
        update_post_meta( $post_id, 'ssm_getresponse_api_key', wp_kses( $_POST['ssm_getresponse_api_key'], $allowed ) );

      if( isset( $_POST['ssm_enable_email_newsletter'] ) )
        update_post_meta( $post_id, 'ssm_enable_email_newsletter', wp_kses( $_POST['ssm_enable_email_newsletter'], $allowed ) );

      if( isset( $_POST['ssm_email_newsletter'] ) )
        update_post_meta( $post_id, 'ssm_email_newsletter', $_POST['ssm_email_newsletter'] );

      if( isset( $_POST['ssm_email_newsletter_from_name'] ) )
        update_post_meta( $post_id, 'ssm_email_newsletter_from_name', wp_kses( $_POST['ssm_email_newsletter_from_name'], $allowed ) );

      if( isset( $_POST['ssm_email_newsletter_from_email'] ) )
        update_post_meta( $post_id, 'ssm_email_newsletter_from_email', wp_kses( $_POST['ssm_email_newsletter_from_email'], $allowed ) );

      if( isset( $_POST['ssm_email_newsletter_subject'] ) )
        update_post_meta( $post_id, 'ssm_email_newsletter_subject', wp_kses( $_POST['ssm_email_newsletter_subject'], $allowed ) );

      if( isset( $_POST['ssm_redirection_url'] ) )
        update_post_meta( $post_id, 'ssm_redirection_url', wp_kses( $_POST['ssm_redirection_url'], $allowed ) );

  }

  


include 'ssm_shortcode_gen.php';

include 'subscribers_list.php';

include 'metaboxes/ssm_edit_form.php';

include 'metaboxes/ssm_select_form_temp.php';

include 'metaboxes/mail_chimp_meta.php';

include 'metaboxes/sm_color_settings.php';

include 'metaboxes/ssm_form_popup_option.php';

include 'metaboxes/ssm_form_integrations.php';

include 'metaboxes/ssm_form_autoresponder.php';

include 'metaboxes/ssm_form_subscribers_list.php';

include 'metaboxes/ssm_premium_ver.php';



  ?>