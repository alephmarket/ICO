<?php
if ( ! defined( 'ABSPATH' ) ) exit;
add_action('wp_head','ssm_form_options_set_to_head');
function ssm_form_options_set_to_head(){
 // $option = get_option('some option');

  //SLider 
  $ssm_mailchimp_api_key = get_option('ssm_mailchimp_api_key');
  $ssm_mailchimp_list_id = get_option('ssm_mailchimp_list_id');
  $ssm_getresponse_api_key = get_option('ssm_getresponse_api_key');
  $ssm_getresponse_campaign_id = get_option('ssm_getresponse_campaign_id');
  $ssm_redirection_url = get_option('ssm_redirection_url');
  $ssm_enable_email_newsletter = get_option('ssm_enable_email_newsletter');
  $ssm_email_newsletter = get_option('ssm_email_newsletter');
  $ssm_email_newsletter_from_name = get_option('ssm_email_newsletter_from_name');
  $ssm_email_newsletter_from_email = get_option('ssm_email_newsletter_from_email');
  $ssm_email_newsletter_subject = get_option('ssm_email_newsletter_subject');
  $ssm_post_sub_message = get_option('ssm_post_sub_message');
  $sm_mailchimp_doubleoptin = get_option('sm_mailchimp_doubleoptin' );



}


register_activation_hook(__FILE__,'ssm_subscribe_me_add_options');
function ssm_subscribe_me_add_options() {

	add_option('ssm_mailchimp_api_key','');
	add_option('ssm_mailchimp_list_id','');
	add_option('ssm_redirection_url','');
	add_option('ssm_enable_email_newsletter','');
	add_option('ssm_email_newsletter','');
	add_option('ssm_email_newsletter_from_name','');
	add_option('ssm_email_newsletter_from_email','');
	add_option('ssm_email_newsletter_subject','');
	add_option('ssm_getresponse_campaign_id');
	add_option('ssm_getresponse_api_key');
	add_option('ssm_post_sub_message');
	add_option('sm_mailchimp_doubleoptin');

}





add_action('admin_init','ssm_forms_register_options');
function ssm_forms_register_options(){
  // register_setting('mpsp_options_group','option');
	register_setting('ssm_form_options_group','ssm_mailchimp_api_key');
	register_setting('ssm_form_options_group','ssm_mailchimp_list_id');
	register_setting('ssm_form_options_group','ssm_redirection_url');
	register_setting('ssm_form_options_group','ssm_post_sub_message');
	register_setting('ssm_form_options_group','ssm_getresponse_api_key');
	register_setting('ssm_form_options_group','ssm_getresponse_campaign_id');
	register_setting('ssm_form_options_group', 'sm_mailchimp_doubleoptin' );
	register_setting('ssm_form_newsletter_options_group','ssm_enable_email_newsletter');
	register_setting('ssm_form_newsletter_options_group','ssm_email_newsletter');
	register_setting('ssm_form_newsletter_options_group','ssm_email_newsletter_from_name');
	register_setting('ssm_form_newsletter_options_group','ssm_email_newsletter_from_email');
	register_setting('ssm_form_newsletter_options_group','ssm_email_newsletter_subject');


}







add_action('admin_menu','ssm_sub_menus_to_subscribe_me');

function ssm_sub_menus_to_subscribe_me(){

	add_submenu_page( 'edit.php?post_type=subscribe_me_forms', 'Subscriber', 'Subscription Settings', 'manage_options', 'ssm_mailchimp_menu', 'add_ssm_sub_menu_mailchimp' );
	//add_submenu_page( 'edit.php?post_type=subscribe_me_forms', 'Newsletter', 'Newsletter', 'manage_options', 'ssm_newsletter', 'add_ssm_sub_menu_newsletter' );
	add_submenu_page( 'edit.php?post_type=subscribe_me_forms', 'Subscribers List', 'DB Subscribers List', 'manage_options', 'ssm_subscribers_list_menu', 'add_ssm_subscribers_list_menu' );

	add_submenu_page( 'edit.php?post_type=subscribe_me_forms', 'Dashboard', 'Dashboard', 'manage_options', 'ssm_dashboard', 'add_ssm_dashboard_menu' );
}


function add_ssm_sub_menu_mailchimp(){
	?>
	<style type="text/css">	
	.ub_p{
		font-size: 20px;
		font-family: arial;
		color: #525252;
		font-weight: bold;
	}
	.ub-heading-bar{
		background-color: #FFBA00;
		padding:25px 30% 25px 30%;
		text-align: center;
		color: #fff;
		font-size: 38px;
		line-height: 25px;
	}
	form{
		margin-left: 30px;
		background-color: #fff;
	}
	body, #wpcontent{
		background-color: #fff;
	}



	</style>
	
	<form method="post" action="options.php">
		  <?php $sm_mailchimp_doubleoptin = get_option('sm_mailchimp_doubleoptin'); ?>
	      <?php settings_fields( 'ssm_form_options_group' );?>
	      <?php do_settings_sections( 'ssm_form_options_group' );?>
	      <h3 class="ub-heading-bar">General</h3>
			<br>
			<br>
			Post Subscription Thank you message :
			<br>
			<br>
			<input type='text' name='ssm_post_sub_message' placeholder='Enter Thankyou Message' value='<?php echo get_option('ssm_post_sub_message'); ?>' style='width:400px; height:50px;font-size:19px;'>
		</p>
		<?php submit_button('Save Settings','primary'); ?>
	      <h3 class="ub-heading-bar">MailChimp</h3>
	      <br>
		    <p> MailChimp Double Opt-In : 
			  <select name="sm_mailchimp_doubleoptin">
			    <option value="true" <?php selected('true' , $sm_mailchimp_doubleoptin); ?> >Enable</option>
			    <option value="false" <?php selected('false' , $sm_mailchimp_doubleoptin); ?>>Disable</option>
			  </select></p>
			
		</p>
		<?php submit_button();?>
		<a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">How to find MailChimp List ID</a>
		<br>
		<a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">How to find MailChimp API Key</a>
		
	</form>
	<?php
}


function add_ssm_subscribers_list_menu(){
	?>
	<script type="text/javascript">

		(function($){
    $(document).ready(function() {
    $('.empty_button_form').on('submit',function(){
         
        // Add text 'loading...' right after clicking on the submit button. 
        $('#response').text('Processing'); 
         
        var form = $(this);
        $.ajax({
            url: form.attr('action'),
            method: form.attr('method'),
            data: form.serialize(),
            success: function(result){
                if (result == 'success'){
                    $('#response').text(result);  
                }else {
                    $('#response').text(result);
                }
            }
        });
         
        // Prevents default submission of the form after clicking on the submit button. 
        return false;   
    });
	});
	})(jQuery);

	</script>
	<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
	<style type="text/css">
	#wpcontent{
		background-color: #fff;
	}

	</style>
	<div style='padding:50px; margin:0 auto; margin-top:50px; font-family:sans-serif,arial;font-size:17px; width:60%;'>
	<?php

		global $wpdb;
		$ssm_db = $wpdb->prefix.'ssm_data';
		$ssm_results = $wpdb->get_results( 
	"
	SELECT *
	FROM $ssm_db
	"
	);
		?>
		<p><i>Note :</i> New subscribers will be added in subscribe form subcribers list. Please edit your form to view the subscribers, Also backup this list it will be removed in future update. Thanks</p>
		<table class='w3-table w3-striped w3-bordered w3-card-4'>

			<tr class="w3-red">
				<th>ID</th>
				<th>Name</th>
				<th>Email</th>
				<th>Browser</th>
				<th>OS</th>
			</tr>
			<?php foreach ( $ssm_results as $ssm_result ) {
	?>
			<tr>
				<td><?php echo $ssm_result->id; ?></td>
				<td><?php echo $ssm_result->name; ?></td>
				<td><?php echo $ssm_result->email; ?></td>
				<td><?php echo $ssm_result->userBrowser; ?></td>
				<td><?php echo $ssm_result->userOS; ?></td>
			</tr>
	<?php } ?>
		</table>


	</div>
  	<br>

	<?php
}



function add_ssm_sub_menu_newsletter(){
	$ssm_enable_email_newsletter = get_option('ssm_enable_email_newsletter');
  	$ssm_email_newsletter = get_option('ssm_email_newsletter');
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
	<h3>Newsletter</h3>
	<form method="post" action="options.php" class="lpp_form">
	      <?php settings_fields( 'ssm_form_newsletter_options_group' );?>
	      <?php do_settings_sections( 'ssm_form_newsletter_options_group' );?>
	      <p style="margin-bottom:30px;"><label style="font-size: 18px; margin-right: 20px;"> Enable Autmomatic Newsletter : </label> <input type="checkbox" name="ssm_enable_email_newsletter" value="true" <?php checked( 'true', $ssm_enable_email_newsletter); ?>></p>
	      <hr>
	      <p style="margin-top:30px;"><label class="lpp_label">From Name : </label><input type='text' placeholder='From Name ' name='ssm_email_newsletter_from_name' value='<?php echo get_option('ssm_email_newsletter_from_name'); ?>' class='lpp_input'>
	      <p><label class="lpp_label">From Email : </label><input type='email' placeholder='From Email ' name='ssm_email_newsletter_from_email' value='<?php echo get_option('ssm_email_newsletter_from_email'); ?>' class='lpp_input'>
	      <p><label class="lpp_label">Email Subject : </label><input type='text' placeholder='Email Subject' name='ssm_email_newsletter_subject' value='<?php echo get_option('ssm_email_newsletter_subject'); ?>' class='lpp_input'>
		<?php
		$settings = array('media_buttons'=> true,'ssm_email_newsletter','textarea_rows' => 23);
		wp_editor( $ssm_email_newsletter, 'ssm_email_newsletter', $settings ); 
		submit_button();?>
	</form>
	<?php
}

function add_ssm_dashboard_menu(){
	include_once SSM_PLUGIN_PATH.'/admin/admin-dashboard.php';
}











 ?>