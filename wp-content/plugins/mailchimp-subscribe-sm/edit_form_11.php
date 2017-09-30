<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<link href='http://fonts.googleapis.com/css?family=Sofia' rel='stylesheet' type='text/css'>
<style type="text/css">


	#sm_wrapper{
		background: <?php echo get_post_meta($post->ID,'smf_body_bg',true); ?>;
		width:90%;
		min-width: 230px;
		margin: 0 auto;
		text-align: center;
		box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
		border-bottom: 1px solid #c4c4c4;
		padding-top:5%; 
		
	}

	#smtext {
		width: 100%;
		font-family: helvetica,sans-serif;
		background: #F7F7F7;
		line-height: 1.3;
		text-align: center;
		color:<?php echo get_post_meta($post->ID,'smf_content_c',true); ?> ;

	}
	#sm_form{
		padding: 0 0 1% 0;
	}
	
	.sm_field{
		width: 90% !important;
		height: 50px !important;
		margin-top: 5% !important;
		font-size: 16px !important;
		color:<?php echo get_post_meta($post->ID,'smf_content_c',true); ?> ;
		border: none;
		border-bottom: 1px solid <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;
		background-color:transparent !important;

	}
	.sm_field:focus{
		color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?> ;
		box-shadow: 0 1px 2px rgba(0, 0, 0, 0.25); 
		border: none;
		border-bottom: 1px solid #e3e3e3;
	}
	
	.sm_submit{
		height: 35px !important;
		padding:2.5% 0% 2% 0% !important;
		border: none !important;
		color: <?php echo get_post_meta($post->ID,'smf_cta_c',true); ?>   !important;
		font-size: 17px !important;
		margin-top: 6% !important;
		border-radius: 5px;
		background: <?php echo get_post_meta($post->ID,'smf_cta_bg',true); ?>  !important; /* Old browsers */
		
		

	}
	#sm_footer{
		background: #fff;
		padding: 1px 0 1px 15px;
		font-family: helvetica,sans-serif;

	}
	#response{
		font-family: helvetica,sans-serif;
		font-style: italic;
		color: #E86850;
	}
	#ssm_p{
		font-family:'sofia';
		color:<?php echo get_post_meta($post->ID,'smf_content_c',true); ?> ;
		font-size:32px;
		margin: 0;

	}

	.sm_field::-webkit-input-placeholder {
   color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;
	}

	.sm_field:-moz-placeholder { /* Firefox 18- */
	   color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;  
	}

	.sm_field::-moz-placeholder {  /* Firefox 19+ */
	   color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;  
	}

	.sm_field:-ms-input-placeholder {  
	   color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;  
	}








	
</style>

<div id='sm_wrapper'>
		<p style=''id='ssm_p'>
			<input type='text' name='sm_form_header' value='<?php echo $sm_form_header; ?>' placeholder='Form Headline Goes Here!' class='sm_input_field' style='width:70%; height:45px;text-align:center;font-size:18px;' >
		</p>
	<div id='sm_form'>
			<p>
				<input type='text' id='sm_input' placeholder='Enter Placeholder' class='sm_field' name='sm_form_name_placeholder' value="<?php echo get_post_meta($post->ID,'sm_form_name_placeholder',true); ?>" >
				<input type='text' id='sm_input' placeholder='Enter Placeholder' class='sm_field' name='sm_form_email_placeholder' value="<?php echo get_post_meta($post->ID,'sm_form_email_placeholder',true); ?>"  >
				<br>
				<div  type='submit' id='sm_submit' class='sm_submit'>
					<input type="text"  name="sm_form_cta_text" value='<?php echo $sm_form_cta_text; ?>' placeholder='Button Text' style='width:75%;font-size:22px; text-align: center;'/>
				</div> 
			</p>
		</form>
		<span id="response">
    	</span>
	</div>
</div>