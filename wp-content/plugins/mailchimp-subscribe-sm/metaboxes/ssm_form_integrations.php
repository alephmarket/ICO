<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ssm_form_integrations($post){


     $ssm_mailchimp_listid = get_post_meta($post->ID,'ssm_mailchimp_listid',true);
     $ssm_mailchimp_apikey = get_post_meta($post->ID,'ssm_mailchimp_apikey',true);
	 $ssm_getresponse_campaign_id = get_post_meta($post->ID,'ssm_getresponse_campaign_id',true);
     $ssm_getresponse_api_key = get_post_meta($post->ID,'ssm_getresponse_api_key',true);
     $ssm_redirection_url = get_post_meta($post->ID,'ssm_redirection_url',true);

	 wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

	?>
	<style type="text/css">
	#integration-input-field{
		width:400px;
		height: 50px;
		margin-left: 20px;
	}
	 </style>
	 <div id='form_sec'>
	 <h1>MailChimp</h1>
	 <p> Enter Mailchimp API key :
	<input type='text' name='ssm_mailchimp_apikey' id='integration-input-field' placeholder='Your Mailchimp API key' value='<?php echo $ssm_mailchimp_apikey; ?>'> </p>
	<p> Enter Mailchimp List ID :
	<input type='text' name='ssm_mailchimp_listid' id='integration-input-field' placeholder='Your Mailchimp List ID' value='<?php echo $ssm_mailchimp_listid; ?>'> </p>
	<a href="http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id" target="_blank">How to find MailChimp List ID</a>
		<br>
		<a href="http://kb.mailchimp.com/accounts/management/about-api-keys" target="_blank">How to find MailChimp API Key</a>
	<h1>GetResponse</h1>
	<p> Enter GetResponse API key :
	<input type='text' name='ssm_getresponse_api_key' id='integration-input-field' placeholder='Your GetResponse API key' value='<?php echo $ssm_getresponse_api_key; ?>'> </p>
	<p> Enter GetResponse Campaign Name :
	<input type='text' name='ssm_getresponse_campaign_id' id='integration-input-field' placeholder='Your GetResponse Campaign ID' value='<?php echo $ssm_getresponse_campaign_id; ?>'> </p>
	<a href="https://support.getresponse.com/faq/where-i-find-api-key" target="_blank">How to find GetResponse Api Key</a>
		<br>
		<a href="https://support.getresponse.com/faq/how-do-i-create-a-new-campaign" target="_blank">How to find MailChimp Campaign Name</a>
	</div>
	<br>
	<br>
	<p>Page redirect URL :
			<br>
			<br>
			<input type='text' name='ssm_redirection_url' placeholder='Enter Thank you Page URL' value='<?php echo $ssm_redirection_url; ?>' style='width:400px; height:50px;font-size:19px;'>
			<br>
			<br>
<div style='width:95%;margin-left:2.5%; text-align:center; background:#e3e3e3;height:60px;border-left:5px solid #a7d142;margin-top:50px;'>
 <?php submit_button('Update');?>
</div>
	<?php

}


 ?>