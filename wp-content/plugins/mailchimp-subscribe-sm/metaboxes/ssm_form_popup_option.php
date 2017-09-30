<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ssm_form_popup_option($post){
    // $post is already set, and contains an object: the WordPress post
    global $post;

     $sm_popup_active = get_post_meta($post->ID,'sm_popup_active',true);
     $smf_popup_overlay_color = get_post_meta($post->ID,'smf_popup_overlay_color',true);
     $smf_popup_close_color = get_post_meta($post->ID,'smf_popup_close_color',true);
     $smf_popup_close_text = get_post_meta($post->ID,'smf_popup_close_text',true);
     $smf_popup_delay = get_post_meta( $post->ID,'smf_popup_delay',true);
?>
	<div class='formLayout_1'> 	
	<br>
	<h2>PopUp Options For Subscribe Form</h2>
	<br>
	<br>
	<label for='sm_popup_active'>Enable PopUp :</label>
	<select name='sm_popup_active' id='sm_popup_active'>
	<option>Select</option>
	<option value='true' <?php selected('true' , $sm_popup_active); ?> > Enable</option>
	<option value='false' <?php selected('false' , $sm_popup_active); ?> >Disable</option>
	</select>

	<br>
	<br>

    <label for='smf_popup_overlay_color'>PopUp Delay <span style='font-size:11px;'>(In seconds)</span> : </label>
    <input type='number' name='smf_popup_delay' value='<?php echo $smf_popup_delay; ?>'/>
     <br>
     <br>

	<label for='smf_popup_overlay_color'>OverLay Color : </label>
     <input type='text' class='color_picker' name='smf_popup_overlay_color' data-alpha="true" value='<?php echo $smf_popup_overlay_color; ?>'/>
     <br>
     <br>

	<label for='smf_popup_close_color'>Close Link Color : </label>
     <input type='text' class='color_picker' name='smf_popup_close_color' data-alpha="true" value='<?php echo $smf_popup_close_color; ?>'/>
     <br>
     <br>
     <label for='smf_popup_close_text'>Close Link Text :</label>
     <input type='text' name='smf_popup_close_text' value="<?php echo $smf_popup_close_text; ?>" style="width:300px;">
     <br>
     <br>

	</div>

<div style='width:100%;text-align:center; background:#e3e3e3;height:60px;border-left:5px solid #a7d142;'>
<a href="http://web-settler.com/mailchimp-subscribe-form/?ref=templates" style='float: left;font-size: 19px; margin: 20px 0 0 10px;'id='pr_msg_link'><i>Unlock All Templates and get more amazing features Click Here</i></a>
  <?php submit_button('Update');?>
</div>

<?php

}
?>