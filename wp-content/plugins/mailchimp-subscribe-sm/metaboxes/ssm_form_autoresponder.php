<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ssm_form_autoresponder($post){
	$ssm_enable_email_newsletter = get_post_meta($post->ID,'ssm_enable_email_newsletter',true);
  	$ssm_email_newsletter = get_post_meta($post->ID,'ssm_email_newsletter',true);
  	$ssm_email_newsletter_from_name = get_post_meta($post->ID,'ssm_email_newsletter_from_name',true);
  	$ssm_email_newsletter_from_email = get_post_meta($post->ID,'ssm_email_newsletter_from_email',true);
  	$ssm_email_newsletter_subject = get_post_meta($post->ID,'ssm_email_newsletter_subject',true);

	?>
	<style type="text/css">
	.lpp_form{
		width:800px;
	}
	.lpp_input{
		display: block;
		width:250px; 
		height:40px;
		font-size:16px;
		text-align: left;
	}
	.lpp_label{
		display: block;
		float: left;
		font-size: 18px;
		width: 150px;
		margin-right: 20px;
	}
	</style>
	<h3>Autoresponder</h3>
	      
	      <p style="margin-bottom:30px;"><label style="font-size: 18px; margin-right: 20px;"> Enable Autoresponder : </label> <input type="checkbox" name="ssm_enable_email_newsletter" value="true" <?php checked( 'true', $ssm_enable_email_newsletter); ?>></p>
	      <hr>
	      <p style="margin-top:30px;"><label class="lpp_label">From Name : </label><input type='text' placeholder='From Name ' name='ssm_email_newsletter_from_name' value='<?php echo $ssm_email_newsletter_from_name; ?>' class='lpp_input'>
	      <p><label class="lpp_label">From Email : </label><input type='email' placeholder='From Email ' name='ssm_email_newsletter_from_email' value='<?php echo $ssm_email_newsletter_from_email; ?>' class='lpp_input'>
	      <p><label class="lpp_label">Email Subject : </label><input type='text' placeholder='Email Subject' name='ssm_email_newsletter_subject' value='<?php echo $ssm_email_newsletter_subject; ?>' class='lpp_input'>
		<?php
		$settings = array('media_buttons'=> true,'ssm_email_newsletter','textarea_rows' => 23);
		wp_editor( $ssm_email_newsletter, 'ssm_email_newsletter', $settings ); 
		?> 
		 <div style='width:100%;text-align:center; background:#e3e3e3;height:60px;border-left:5px solid #a7d142;'>
			 <?php submit_button('Update');?>
		</div> 
<?php
}
?>