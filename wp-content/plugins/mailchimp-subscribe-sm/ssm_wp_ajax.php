<?php
if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'wp_ajax_nopriv_ssm_subscribe_form_db', 'ssm_subscribe_form_db_wp_ajax'  );
add_action( 'wp_ajax_ssm_subscribe_form_db', 'ssm_subscribe_form_db_wp_ajax' );

add_action( 'wp_ajax_nopriv_ssm_subscribe_form_mailchimp', 'ssm_subscribe_form_mailchimp_wp_ajax'  );
add_action( 'wp_ajax_ssm_subscribe_form_mailchimp', 'ssm_subscribe_form_mailchimp_wp_ajax' );

add_action( 'wp_ajax_nopriv_ssm_subscribe_form_getresponse', 'ssm_subscribe_form_getresponse_wp_ajax'  );
add_action( 'wp_ajax_ssm_subscribe_form_getresponse', 'ssm_subscribe_form_getresponse_wp_ajax' );

add_action( 'wp_ajax_nopriv_ssm_subscribe_list_empty', 'ssm_subscribe_list_empty_wp_ajax'  );
add_action( 'wp_ajax_ssm_subscribe_list_empty', 'ssm_subscribe_list_empty_wp_ajax' );

add_action( 'wp_ajax_nopriv_ssm_subscribe_list_download', 'ssm_subscribe_list_download_wp_ajax'  );
add_action( 'wp_ajax_ssm_subscribe_list_download', 'ssm_subscribe_list_download_wp_ajax' );


function ssm_subscribe_form_db_wp_ajax(){

	function check_input($data){

	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}

	function ssm_send_email(){

	    add_filter( 'wp_mail_content_type', 'ssm_set_html_content_type' );
	    function ssm_set_html_content_type() {
	        return 'text/html';
	    }
	    	$ssm_post_id = check_input($_REQUEST['sm_id']);

			$headers = 'From: '.get_post_meta($ssm_post_id,'ssm_email_newsletter_from_name',true).' <'.get_post_meta($ssm_post_id,'ssm_email_newsletter_from_email',true).'>' . "\r\n";
		    $to = filter_var($_REQUEST['sm_email'],FILTER_SANITIZE_EMAIL);
		    $subject = get_post_meta($ssm_post_id,'ssm_email_newsletter_subject',true);
		    $message = get_post_meta($ssm_post_id,'ssm_email_newsletter',true);
		    wp_mail( $to, $subject, $message, $headers );

	        remove_filter( 'wp_mail_content_type', 'ssm_set_html_content_type' );

	}

	function ssm_send_to_db() {

		$ssm_post_id = check_input($_REQUEST['sm_id']);
		$s_name = filter_var($_REQUEST['sm_name'],FILTER_SANITIZE_STRING);
		$s_email = filter_var($_REQUEST['sm_email'],FILTER_SANITIZE_EMAIL);
		

		if (!filter_var($s_email, FILTER_VALIDATE_EMAIL)) {
	      echo  "Invalid email format"; 
	      exit;
	    }
		
		$ssm_Name = wp_strip_all_tags($s_name);
		$ssm_Email = wp_strip_all_tags($s_email);

		$ssm_subscribers_list = get_post_meta($ssm_post_id,'ssm_subscribers_list',true);
		$array_size_prev = count($ssm_subscribers_list); 

		if ( ! is_array( $ssm_subscribers_list ) )
			$ssm_subscribers_list = array();

		$array_size_prev = count($ssm_subscribers_list);

		$newSubscriber = array(
				'name' => $ssm_Name,
				'email' => $ssm_Email
			);

		//var_dump(get_post_meta($ssm_post_id,'ssm_subscribers_list',true));

		$ssm_subscribers_list_pid = $ssm_subscribers_list;

		array_push($ssm_subscribers_list_pid, $newSubscriber);
		update_post_meta( $ssm_post_id, 'ssm_subscribers_list', $ssm_subscribers_list_pid, $unique = false);

		$ssm_subscribers_list2 = get_post_meta($ssm_post_id,'ssm_subscribers_list',true);
		$array_size_aft = count($ssm_subscribers_list2);
		
		return true;
	}



	$data = check_input($_REQUEST['sm_name']);
	$data .= check_input($_REQUEST['sm_email']);
	$data_lower = strtolower($data);
	$data_spaces = str_replace(' ','',$data_lower);

	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
	if (!preg_match($pattern,$data_spaces))
	{
	    echo ("Invalid Input");
	    exit;
	}
	else{

		$checkss = ssm_send_to_db();
		$ssm_post_id = check_input($_REQUEST['sm_id']);
		$sub_url = check_input($_REQUEST['ssm_sub_url']);
		if($checkss && !empty($sub_url)){
			$ssm_enable_newsletter = get_post_meta($ssm_post_id,'ssm_enable_email_newsletter',true);
			if ($ssm_enable_newsletter === 'true') {
				ssm_send_email();   		
			}
			echo "run_url";
			exit;
		}
		elseif ($checkss > 0){
			$ssm_enable_newsletter = get_post_meta($ssm_post_id,'ssm_enable_email_newsletter',true);
			if ($ssm_enable_newsletter === 'true') {
				ssm_send_email();   		
			}
			echo "success";
			exit;
		}
		else{
			echo $checkss;
		}

	}

}

function ssm_subscribe_form_mailchimp_wp_ajax(){

function check_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

$ssm_post_id = check_input($_REQUEST['sm_id']);
	include SSM_PLUGIN_PATH.'/inc/MCAPI.class.php';
	// grab an API Key from http://admin.mailchimp.com/account/api/
	$sm_api_key = get_post_meta($ssm_post_id,'ssm_mailchimp_apikey',true);
	$api = new MCAPI($sm_api_key);

function ssm_send_email(){

    add_filter( 'wp_mail_content_type', 'ssm_set_html_content_type' );
    function ssm_set_html_content_type() {
        return 'text/html';
    }
    	$ssm_post_id = check_input($_REQUEST['sm_id']);

		$headers = 'From: '.get_post_meta($ssm_post_id,'ssm_email_newsletter_from_name',true).' <'.get_post_meta($ssm_post_id,'ssm_email_newsletter_from_email',true).'>' . "\r\n";
	    $to = filter_var($_REQUEST['sm_email'],FILTER_SANITIZE_EMAIL);
	    $subject = get_post_meta($ssm_post_id,'ssm_email_newsletter_subject',true);
	    $message = get_post_meta($ssm_post_id,'ssm_email_newsletter',true);
	    wp_mail( $to, $subject, $message, $headers );

        remove_filter( 'wp_mail_content_type', 'ssm_set_html_content_type' );

}

$ssm_post_id = check_input($_REQUEST['sm_id']);
$smf_fName = check_input($_REQUEST['sm_name']);
$smf_email = check_input($_REQUEST['sm_email']);

	$merge_vars = Array( 
        'EMAIL' => $smf_email,
        'FNAME' => $smf_fName
    );
	
$data = check_input($_REQUEST['sm_name']);
$data .= check_input($_REQUEST['sm_email']);
$data_lower = strtolower($data);
$data_spaces = str_replace(' ','',$data_lower);

$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
if (!preg_match($pattern,$data_spaces))
{
    echo ("Invalid Input");
    exit; 
}
else{
	$ssm_enable_newsletter = get_post_meta($ssm_post_id,'ssm_enable_email_newsletter',true);
	$sm_mailchimp_doubleoptin = get_option('sm_mailchimp_doubleoptin');
	$list_id = get_post_meta($ssm_post_id,'ssm_mailchimp_listid',true);
	$ssm_post_id = check_input($_REQUEST['sm_id']);
	$sub_url = check_input($_REQUEST['ssm_sub_url']);
	$retval = $api->listSubscribe($list_id, $smf_email,$merge_vars, '',$sm_mailchimp_doubleoptin);
	if ($retval === true && !empty($sub_url)) {
		if ($ssm_enable_newsletter === 'true') {
			ssm_send_email();   		
		}
		echo 'run_url';
		exit;

	} else if ($retval === true) {
			if ($ssm_enable_newsletter === 'true') {
			ssm_send_email();   		
		}
		$s_message = get_option('ssm_post_sub_message');
	
		if (!empty($s_message)) {
			echo "success";
			exit;
		} else{
			echo "success";
			exit;
		}
	}

	if($api->errorCode) {
		if ($api->errorCode === 214) {
		   echo "Subscriber Already Exists";
		   exit;
		} elseif ($api->errorCode === 104) {
			echo "Invalid API Key Or List Name";
			exit;
		} elseif ($api->errorCode === 200) {
			echo "Invalid API Key Or List Name";
			exit;
		}  else {
			echo "Unknown Error Occurred";
			var_dump($api->errorCode);
			exit;
		}
	}
}
}



function ssm_subscribe_form_getresponse_wp_ajax(){

	function check_input($data)
	{
	    $data = trim($data);
	    $data = stripslashes($data);
	    $data = htmlspecialchars($data);
	    return $data;
	}

	function send_data_to_gr_api(){
		
	require SSM_PLUGIN_PATH.'/inc/jsonRPCClient.php';

	$p_id = check_input($_REQUEST['sm_id']);
	$api_key = get_post_meta($p_id,'ssm_getresponse_api_key',true);

	$api_url = 'http://api2.getresponse.com';

	$client = new jsonRPCClient($api_url);

	$campaign_name_wp = get_post_meta($p_id,'ssm_getresponse_campaign_id',true);
	$user_given_campaign_name = array ( 'EQUALS' => $campaign_name_wp);


	try {
		$campaigns = $client->get_campaigns(
	    $api_key,
	    array (
	        'name' => $user_given_campaign_name
	    )
	);

	$campaign_keys = array_keys($campaigns);
	$CAMPAIGN_ID = array_pop($campaign_keys);

		$result = $client->add_contact(
	    $api_key,
	    array (
	        'campaign'  => $CAMPAIGN_ID,
	        'name'      => $_REQUEST['sm_name']." ",
	        'email'     => $_REQUEST['sm_email'],

	    )

	);

		echo "success";
		exit();
		
	} catch (Exception $e) {
		$gr_contact_exists = "Contact already added to target campaign";
		$gr_contact_queue = "Contact already queued for target campaign";
		$gr_invalid_params = "Request have return error: Invalid params";
		$gr_invalid_api = "Request have return error: API key verification failed";
		$gr__invalid_param_result = strstr($e, $gr_invalid_params, $before_needle = true);
		$gr__invalid_api_result = strstr($e, $gr_invalid_api, $before_needle = true);
		$gr__c_exists_result = strstr($e, $gr_contact_exists, $before_needle = true);
		$gr_contact_queue_results = strstr($e, $gr_contact_queue, $before_needle = true);
		if($gr__invalid_param_result !== false){
			echo "Invalid API Key Or List Name";
			exit;
		} else if($gr_invalid_api !== false){
			echo "Invalid API Key Or List Name";
			exit;
		} else if ($gr__c_exists_result !== false) {
			echo get_option('lpp_subscriber_exists_msg','Subscriber Already Exists');
			exit;
		} else if ($gr_contact_queue_results !== false) {
			echo get_option('lpp_subscriber_exists_msg','Subscriber Already Exists');
			exit;
		} else{
			echo "Unknown error occurred!".$e;
			exit;
		}

		
	}



	}

function ssm_send_email(){

    add_filter( 'wp_mail_content_type', 'ssm_set_html_content_type' );
    function ssm_set_html_content_type() {
        return 'text/html';
    }
    	$p_id = check_input($_REQUEST['sm_id']);

		$headers = 'From: '.get_post_meta($p_id,'ssm_email_newsletter_from_name',true).' <'.get_post_meta($p_id,'ssm_email_newsletter_from_email',true).'>' . "\r\n";
	    $to = filter_var($_REQUEST['sm_email'],FILTER_SANITIZE_EMAIL);
	    $subject = get_post_meta($p_id,'ssm_email_newsletter_subject',true);
	    $message = get_post_meta($p_id,'ssm_email_newsletter',true);
	    wp_mail( $to, $subject, $message, $headers );

        remove_filter( 'wp_mail_content_type', 'ssm_set_html_content_type' );

}

		
	$data = check_input($_REQUEST['sm_name']);
	$data .= check_input($_REQUEST['sm_email']);
	$data_lower = strtolower($data);
	$data_spaces = str_replace(' ','',$data_lower);

	$pattern = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/";
	if (!preg_match($pattern,$data_spaces))
	{
	    echo ("Invalid Input");
	    exit();
	}
	else{
		$sub_url = check_input($_REQUEST['ssm_sub_url']);
		$result_send_data = send_data_to_gr_api();
		if($result_send_data === true && !empty($sub_url)) {
			$lpp_enable_newsletter = get_post_meta($p_id,'ssm_enable_email_newsletter',true);
			if ($lpp_enable_newsletter === 'true') {
				lpp_send_email();   		
			}
			echo 'run_url';
			exit();

		} else if ($result_send_data === true) {
			$lpp_enable_newsletter = get_post_meta($p_id,'ssm_enable_email_newsletter',true);
			if ($lpp_enable_newsletter === 'true') {
				lpp_send_email();   		
			}
			echo "success";
			exit();
		} else{
			// An error ocurred, return error message	
			return 'Error: ';
			exit();
		}

	}

}

function ssm_subscribe_list_empty_wp_ajax(){
	if (current_user_can('activate_plugins' )) {

	$post_ID = $_REQUEST['ps_ID'];

	 update_post_meta( $post_ID, 'ssm_subscribers_list', '', $unique = false);

	if ($result === 0) {
		echo "No records found!";
	}else if($result === false){
		echo "Some error occurred";
	}
	else{
		echo 'Success';
		exit();
	}
	}else{
		echo "...";
	}

}

function ssm_subscribe_list_download_wp_ajax(){
	
	if (current_user_can('activate_plugins')) {
	
    $post_ID = $_REQUEST['ps_ID'];
    $ssm_results_to_write = get_post_meta( $post_ID, 'ssm_subscribers_list', true );

$all_data = '';
foreach ($ssm_results_to_write["$post_ID"] as $res) {
    $res_name  = $res['name'];
    $res_email  = $res['email'];


    $current_row = $res_ID.' , '.$res_name.' , '.$res_email. PHP_EOL;
    $all_data = $all_data." ".$current_row;
}


    $file = "sm_subcribers-list.csv";
    $fp = fopen($file, "a")or die("Error Couldn't open $file for writing!");
    fwrite($fp, $all_data)or die("Error Couldn't write values to file!"); 
    fclose($fp); 


ignore_user_abort(true);
set_time_limit(0); // disable the time limit for this script

 // change the path to fit your websites document structure
$path = plugins_url('/',__FILE__); // change the path to fit your websites document structure
$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})", '', $_GET['download_file']); // simple file name validation
$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
$fullPath = $path.$dl_file;

if ($fd = fopen ($fullPath, "r")) {
    $path_parts = pathinfo($fullPath);
    $ext = strtolower($path_parts["extension"]);
    switch ($ext) {
        case "csv":
        header("Content-type: application/csv");
        header("Content-Disposition: attachment; filename=\"".$path_parts["basename"]."\""); // use 'attachment' to force a file download
        break;
        // add more headers for other content types here
        default;
        header("Content-type: application/octet-stream");
        header("Content-Disposition: filename=\"".$path_parts["basename"]."\"");
        break;
    }
    header("Cache-control: private"); //use this to open files directly
    while(!feof($fd)) {
        $buffer = fread($fd, 2048);
        echo $buffer;
    }
}
fclose ($fd);

$file = "sm_subcribers-list.csv";
unlink($file);

exit;
}
}
?>