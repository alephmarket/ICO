<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>
<style type="text/css">


	#sm_wrapper{
		width:45%;
		min-width: 230px;
		border-radius: 5px;
		margin: 0 auto;
	}
	@import url(http://fonts.googleapis.com/css?family=Oswald);
	
	.sm_field{
		  height: 2.55em;
		  width:70%;
		  font-size: 1.6em;
		  text-align:center;
		  border: 0;
		  outline: 0;
		  color: #fff;
		  background-color: transparent;
		  background: transparent;
		  border:0.033em #fff solid;
		  font-family: 'Oswald', sans-serif;
		  font-weight: bold;
	}

	.sm_submit{
		text-align: center;
		background-color: #e9c85d;
		width: 100%;
		height:85px;
		border: none;
		color: #fff;
		font-size: 2em; 
		font-family: 'Oswald', sans-serif;
		font-weight: bold;

	}
	#sm_footer{
		background: #fff;
		padding: 1px 0 1px 15px;
		font-family: helvetica,sans-serif;

	}
	.sm_email_div{
		background:#404241;
		padding:30px 0 30px 0;
		text-align: center;
	}
	.sm_name_div{
		background:#4daf7c;
		padding:30px 0 30px 0;
		text-align: center;
	}

	::placeholder {
	  color: #fff;
	}

	::-moz-placeholder {
	  color: #fff;
	}

	:-ms-input-placeholder {
	  color: #fff;
	}

	::-webkit-input-placeholder {
	  color: #fff;
	}






	
</style>

<div id='sm_wrapper'>
	<div id='smf_form'>
		<form>
			<div class="sm_name_div">
				<input disabled type='text' id='sm_input' class='sm_field' name='sm_name' placeholder='NAME' required >
			</div>
			<div class="sm_email_div">
				<input disabled type='email' id='sm_input' class='sm_field' name='sm_email' placeholder='EMAIL' required >
			</div>
				<div  type='submit' id='sm_submit' class='sm_submit'>
					<input type='text' name='sm_form_cta_text' value='<?php echo $sm_form_cta_text; ?>' placeholder='Button Text' class='sm_input_field' style='width:75%; height:50px;font-size:22px; text-align: center;' >
				</div> 

		</form>
	</div>
</div>