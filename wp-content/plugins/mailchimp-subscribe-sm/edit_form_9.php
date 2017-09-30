<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<style type="text/css">


	#sm_wrapper{
		background: <?php echo get_post_meta($post->ID,'smf_body_bg',true); ?>;
		width:75%;
		min-width: 230px;
		padding: 5px;
		margin: 0 auto;
		border-radius: 10px;
	}

	#sm_content{
		
		margin:6px 0 0 0;
		padding-bottom: 10px;
		border-bottom: 1px solid #d0d0d0;
		display: inline-block;
		 color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?>;
	
	}

	#smtext {
		width: 100%;
		font-family: helvetica,sans-serif;
		padding: 10px 0 25px 5%;
		line-height: 1.3;

	}
	#sm_form{
		background: <?php echo get_post_meta($post->ID,'smf_form_bg',true); ?>;
		padding: 3% 0 1% 0;
	}
	
	.sm_field{
		width: 90% !important;
		height: 35px !important;
		margin-left: 5% !important;
		margin-bottom: 2% !important;
		font-size: 16px !important;
	}
	.sm_submit{
		padding: 0 !important;
		margin-left: 5% !important;
		width: 90% !important;
		border: none !important;
		color: <?php echo get_post_meta($post->ID,'smf_cta_c',true); ?> !important;
		font-size: 18px !important;


		background-color:#e74c3c !important;
		text-align: center;
		
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






	
</style>

<div id='sm_wrapper'>
	<div id='sm_form'>
			<p>
				<input type='text' id='sm_input' class='sm_field' name='sm_form_email_placeholder' value='<?php echo get_post_meta($post->ID,'sm_form_email_placeholder',true); ?>' placeholder='Email Placeholder Text'  >
				<br>
				<div  type='submit' id='sm_submit' class='sm_submit'>
					<input type="text"  name="sm_form_cta_text" value='<?php echo $sm_form_cta_text; ?>' placeholder='Button Text'style='margin-top:10px;margin-bottom:10px;width:30%;'/>
				</div> 

			</p>
		</form>
		
	</div>
	
</div>