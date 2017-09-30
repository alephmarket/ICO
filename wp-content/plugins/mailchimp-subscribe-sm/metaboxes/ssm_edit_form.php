<?php

if ( ! defined( 'ABSPATH' ) ) exit;

function ssm_form_edit_meta($post){
    // $post is already set, and contains an object: the WordPress post
    global $post;


 //////////////////////////////////////////////////////////////////////////
                                                                        //  
                               //START                                 //
                                                                      //  
                                                                     //
    ///////  MAIN SETTINGS var assign BOX Starts HERE!!! /////////////

    $example = get_post_meta($post->ID,'example',true);
    $ssm_select_data_save_method = get_post_meta($post->ID,'ssm_select_data_save_method',true);
    ///// Form - 1 Settings  //////////////
    $sm_form_header = get_post_meta($post->ID,'sm_form_header',true);
    $sm_form_content = get_post_meta($post->ID,'sm_form_content',true);
    $sm_form_cta_text = get_post_meta($post->ID,'sm_form_cta_text',true);
    $sm_form_footer_msg = get_post_meta($post->ID,'sm_form_footer_msg',true);
    $sm_form_custom_css = get_post_meta($post->ID,'sm_form_custom_css',true);
    ///// Form - 1 Ends  ////////////////






    wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

    //////////////  Place Holders /////////

    $smfprimary = 'Form Headline Goes Here!';

    $smfcontent = 'Form Content Line Goes Here!';

    $smffooter = 'Put your Security Line Here!';

    $smfcta = 'CTA Text';

    $ssm_editable = 'edit_';

    $sm_action_url = admin_url('admin-ajax.php?action=ssm_subscribe_form_db');
    $msm_action_url = admin_url('admin-ajax.php?action=ssm_subscribe_form_mailchimp');
    $gsm_action_url = admin_url('admin-ajax.php?action=ssm_subscribe_form_getresponse');

    $smf_mailchimp_method = '<form id="sm_form" action='.$msm_action_url.' method="post" class="smform" >';
    $smf_getresponse_method = '<form id="sm_form" action='.$gsm_action_url.' method="post" class="smform" >';
    $smf_database_method  = '<form id="sm_form" action='.$sm_action_url.' method="post" class="smform" >';


    $ssm_select_form_template_check_empty = get_post_meta( $post->ID,'ssm_select_form_template',true);
      if (!empty($ssm_select_form_template_check_empty)) {
          include (SSM_PLUGIN_PATH.$ssm_editable.get_post_meta( $post->ID,'ssm_select_form_template',true)); 
      }

    ?>
    <br>
    <br>
<p> Where to save Subscribers :
    <select name='ssm_select_data_save_method' required>
      <option value='<?php echo $smf_database_method ?>' <?php selected($smf_database_method , $ssm_select_data_save_method); ?> >Database</option>
      <option value='<?php echo $smf_mailchimp_method ?>' <?php selected($smf_mailchimp_method, $ssm_select_data_save_method); ?> >Mail Chimp</option>
      <option value='<?php echo $smf_getresponse_method ?>' <?php selected($smf_getresponse_method , $ssm_select_data_save_method); ?> >GetResponse</option>
    </select>
  </p>
  <br>
  <br>
  <br>
  <br>

  <textarea id='sm_custom_css' style='margin-left:100px; display: none;' placeholder="Custom CSS" cols="40" rows="10" name="sm_form_custom_css"><?php echo $sm_form_custom_css;  ?></textarea>

  <div style='width:100%;text-align:center; background:#e3e3e3;height:60px;border-left:5px solid #a7d142;'>
<a href="http://web-settler.com/mailchimp-subscribe-form/?ref=templates" style='float: left;font-size: 19px; margin: 20px 0 0 10px;'id='pr_msg_link'><i>Unlock All Templates and get more amazing features Click Here</i></a>
  <?php submit_button('Update');?>
</div>


    
    <?php







}









?>