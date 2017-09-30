<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<style type="text/css">

	body{
		background: #e3e3e3;
	}
	#sm_wrapper{
		width:100%;
		min-width: 230px;
		border-radius: 5px;
		padding: 5px;
		margin: 0 auto;
	}
	#sm_top{
		background: #ECEEAD;
	}
	#sm_top li{
		list-style:none;
		margin-left: 5%;
		font-family: helvetica,sans-serif;
		font-size: 25px;
		font-weight: bold;
		padding:10px 0 10px 0;
	}
	#sm_content{
		background: #fff;
		margin:-16px 0 0 0;
		border-bottom: 1px solid #d0d0d0;
	
	}
	#sm_content > p{
		font-size: 16px;
		font-family: helvetica,sans-serif;
		padding: 15px 5px 10px 5%;
		line-height: 1.8;

	}
	
	.sm_field{
		margin: 0;
		padding: 0;
		width: 50%;
		height: 35px;
		margin-left: 5%;
		margin-bottom: 5%;
		font-size: 16px;
	}
	.sm_submit:hover{
		background: #4b8bcc;
	}
	.sm_submit{
		margin: 0;
		padding: 0;
		height: 35px;
		width: 130px;
		border: none;
		color: #fff;
		font-size: 18px;
		margin-left: 1%;



		background: rgb(122,188,255); /* Old browsers */
		background: -moz-linear-gradient(top,  rgba(122,188,255,1) 0%, rgba(96,171,248,1) 44%, rgba(64,150,238,1) 100%); /* FF3.6+ */
		background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgba(122,188,255,1)), color-stop(44%,rgba(96,171,248,1)), color-stop(100%,rgba(64,150,238,1))); /* Chrome,Safari4+ */
		background: -webkit-linear-gradient(top,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* Chrome10+,Safari5.1+ */
		background: -o-linear-gradient(top,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* Opera 11.10+ */
		background: -ms-linear-gradient(top,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* IE10+ */
		background: linear-gradient(to bottom,  rgba(122,188,255,1) 0%,rgba(96,171,248,1) 44%,rgba(64,150,238,1) 100%); /* W3C */
		filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#7abcff', endColorstr='#4096ee',GradientType=0 ); /* IE6-9 */

	}
	#sm_footer{
		background: #e3e3e3;
		padding: 10px 0 1px 15px;
		font-family: helvetica,sans-serif;

	}

	.sm_input_field:hover,.sm_input_field:focus{
		border: 2px dashed #727272;
	}






	
</style>

<div id='sm_wrapper'>
	<div id='sm_top'>
	 <li><input type='text' name='sm_form_header' value='<?php echo $sm_form_header; ?>' placeholder='Form Headline Goes Here!' class='sm_input_field' style='width:60%; height:35px;' >  </li>		
	</div>
	<div id='sm_content'>
		<p>
			<textarea name='sm_form_content' placeholder='Form Content  Goes Here!' class='sm_input_field' style='width:90%; height:45px;' ><?php echo $sm_form_content; ?> </textarea>
		</p>
		<form id='sm_form'>
			<p>
				<input type='text' id='sm_input' placeholder='Enter Placeholder' class='sm_field' name='sm_form_name_placeholder' value="<?php echo get_post_meta($post->ID,'sm_form_name_placeholder',true); ?>" >
				<input type='text' id='sm_input' placeholder='Enter Placeholder' class='sm_field' name='sm_form_email_placeholder' value="<?php echo get_post_meta($post->ID,'sm_form_email_placeholder',true); ?>"  >
				<input type='text' name='sm_form_cta_text' value='<?php echo $sm_form_cta_text; ?>' placeholder='CTA Text' class='sm_input_field' style='width:20%; height:35px;' >

			</p>
		</form>
	</div>
	<div id='sm_footer'>
		<p><input type='text' name='sm_form_footer_msg' value='<?php echo $sm_form_footer_msg; ?>' placeholder='Enter Text Here!' class='sm_input_field' style='width:90%; height:25px;' ></p>
	</div>
</div>