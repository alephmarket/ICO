<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<style type="text/css">
<?php echo get_post_meta($post->ID,'sm_form_custom_css',true); ?>

	#sm_wrapper{
		
		width:80%;
		min-width: 550px;
		padding: 5px;
		margin: 0 auto;
	}

	#sm_content{
		width: 100%;
		border-radius: 2px;
		margin: 6px 0 0 0;
		padding-bottom: 10px;
		border-bottom: 1px solid #d0d0d0;
		display: inline-block;
		 color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;
	
	}

	#smtext {
		background: <?php echo get_post_meta($post->ID,'smf_body_bg',true); ?>;
		width: 100%;
		font-family: helvetica,sans-serif;
		padding: 5% 2% 5% 2%;
		line-height: 1.3;

	}
	#sm_form{
		float: left;
		display: inline-block;
		width: 62%;
		padding: 2% 0% 2% 0%;
		
	}
	#form_content{
		float: left;
		display: inline-block;
		width: 35%;
		margin-left: 3%;
		padding: 2% 0% 2% 0%;
		
	}
	
	.sm_field{
		width: 80% !important;
		height: 35px !important;
		margin-left: 20% !important;
		margin-bottom: 5% !important;
		font-size: 16px !important;
	}
	.sm_submit{
		padding: 0 !important;
		margin-left: 20% !important;
		height: 35px !important;
		width: 80% !important;
		border: none !important;
		color: <?php echo get_post_meta($post->ID,'smf_cta_c',true); ?> !important;
		font-size: 16px !important;


		background-color: <?php echo get_post_meta($post->ID,'smf_cta_bg',true); ?> !important;
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
	#form_content_wrapper{
		display: inline-block;
		width: 100%;
		background: <?php echo get_post_meta($post->ID,'smf_form_bg',true); ?>;
		padding: 3% 2% 0% 2%;
	}






	
</style>

<div id='sm_wrapper'>
	<div id='sm_content'>
	<div id='smtext'> 
		<p style='text-align:center;margin-bottom:-10px;'>
			<input type='text' name='sm_form_header' value='<?php echo $sm_form_header; ?>' placeholder='Form Headline Goes Here!' class='sm_input_field' style='width:80%; height:40px;' >  
		</p>
	</div>
	<div id='form_content_wrapper'>
	<div id='form_content'>

	
		<p style='text-align:center;font-size:1.3em;'>
			<textarea name='sm_form_content' placeholder='Form Content  Goes Here!' class='sm_input_field' style='width:100%; height:85px;' ><?php echo $sm_form_content; ?> </textarea>
		</p>
	</div>
	<div id='sm_form'>
	<form>
			<p>
				<input type='hidden' name='sm_name' value=' ' >
				<input type='hidden' name='ssm_sub_url' class="ssm_sub_url" value='<?php echo get_option('ssm_redirection_url'); ?>' >
				<input type='text' id='sm_input' placeholder='Enter Placeholder' class='sm_field' name='sm_form_email_placeholder' value="<?php echo get_post_meta($post->ID,'sm_form_email_placeholder',true); ?>"  >
				<br>
				<input type='text' class='sm_field' name='sm_form_cta_text' value='<?php echo $sm_form_cta_text; ?>' placeholder='Button Text' class='sm_input_field' style='width:100%;' >

			</p>
		</form>
		</div>
		<span id="response"></span>
	</div>
	</div>

	
</div>