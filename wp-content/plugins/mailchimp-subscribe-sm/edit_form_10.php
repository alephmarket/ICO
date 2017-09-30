<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<style type="text/css">

	#top_border{
		width:100%;
		margin: 0 auto;
		height:10px;
		border-radius:3px;
		background: -webkit-linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		background: -moz-linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
		background:linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
	}
	#sm_wrapper{
		background: <?php echo get_post_meta($post->ID,'smf_body_bg',true); ?>;
		width:90%;
		min-width: 230px;
		margin: 0 auto;
		text-align: center;
		box-shadow: 0 1px 5px rgba(0, 0, 0, 0.25);
		border-bottom: 1px solid #c4c4c4;
		
	}

	#smtext {
		width: 100%;
		font-family: helvetica,sans-serif;
		padding: 20px 0 35px 0;
		background: #F7F7F7;
		line-height: 1.3;
		text-align: center;
		color:<?php echo get_post_meta($post->ID,'smf_content_c',true); ?> ;

	}
	#sm_form{
		padding: 1% 0 1% 0;
	}
	
	.sm_field{
		width: 90% !important;
		height: 50px !important;
		margin-top: 5% !important;
		font-size: 16px !important;
		color: #aaa;
		border-radius: 5px;
	}
	
	.sm_submit{
		height: 35px !important;
		padding:2.5% 20% 2.5% 20% !important;
		border: none !important;
		color: <?php echo get_post_meta($post->ID,'smf_cta_c',true); ?>   !important;
		font-size: 17px !important;
		margin-top: 6% !important;
		border-radius: 5px;
		background:#333333; /* Old browsers */
		
		

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
	<div id='top_border'></div>
	<div id='sm_content'>
	<div id='smtext'> 
		<p>
			<input type='text' name='sm_form_header' value='<?php echo $sm_form_header; ?>' placeholder='Form Headline Goes Here!' class='sm_input_field' style='width:100%; height:45px;text-align:center;font-size:18px;' >
		</p>
	</div>
	</div>
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
	</div>
</div>