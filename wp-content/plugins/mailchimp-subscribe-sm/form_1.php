<style type="text/css">

<?php echo get_post_meta($post->ID,'sm_form_custom_css',true); ?>

	#sm_form > input[type="submit"], 
	#sm_form > input[type="button"]{

		padding: 10px 10px 10px 10px !important;
		border: none !important;
		
		font-size: 16px !important;
		font-family: helvetica,sans-serif;
		background-color: <?php echo get_post_meta($post->ID,'smf_cta_bg',true); ?> !important;
		line-height: normal;
		vertical-align: unset !important
		
	} 
	#sm_form > input[type="text"],input[type="email"]{
		margin: 0;
		padding: 0;
		width: 50%;
		height: 35px;
		margin-left: 5%;
		margin-bottom: 5%;
		font-size: 16px;
		font-family: helvetica,sans-serif;
		vertical-align: unset !important;
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
		background-color: #4b8bcc !important;
		background: #4b8bcc !important;
	}
	.sm_submit,#sm_submit{
		margin: 0 ;
		border: none !important;	
		 	
	}
	#response{
		display: none;
		font-family: helvetica,sans-serif;
		font-style: italic;
		}


<?php
$sm_modal = get_post_meta($post->ID,'sm_popup_active',true);
$smf_popup_close_color = get_post_meta($post->ID,'smf_popup_close_color',true);
$smf_popup_overlay_color = get_post_meta($post->ID,'smf_popup_overlay_color',true);
if ($sm_modal === 'true') {
	echo "

	@import url(https://fonts.googleapis.com/css?family=Great+Vibes);

	.sm_modal{
		width: 100%;
		height: 100%;
		position: fixed;
		top: 0;
		bottom: 0;
		left: 0;
		right: 0;
		background: $smf_popup_overlay_color;
		margin: 0 auto;
		z-index: 99999;
		display: none;
	}
	.sm_close{
		margin-top: 3%;
		color: $smf_popup_close_color;
		font-size: 1.2vw;
		font-family: 'Great Vibes', cursive;
		float: left;
		display: block;
		cursor: pointer;
		border-bottom: 1px solid $smf_popup_close_color;
	}
	#sm_wrapper{
		position: absolute;
  		top: 50%;
 	 	left: 50%;
  		transform: translate(-50%, -50%);
	}
	#sm_top{
		margin-bottom:-21px; 
	}";
}

 ?>
	

</style>

<?php
$smf_popup_delay = get_post_meta( $post->ID,'smf_popup_delay',true);

    if (empty($smf_popup_delay)) {
        $smf_popup_delay = '1';
    }

if ($sm_modal === 'true') {
	echo '
	<link href="https://fonts.googleapis.com/css?family=Muli" rel="stylesheet" type="text/css">
	<div class="sm_modal">';
} ?>


<div id="sm_wrapper" id='sm_wrapper' class='smwrapper' data-delay="<?php echo $smf_popup_delay.'000';?>" style="color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?> !important; max-width: 600px; min-width:360px; background: <?php echo get_post_meta($post->ID,'smf_form_bg',true); ?>;" >
	<h3 style=" padding: 20px 10px 20px; background:#ECEEAD;font-family: helvetica,sans-serif; font-size: 22px; margin: 0;"><?php echo get_post_meta($post->ID,'sm_form_header',true); ?>  </h3>

	<p style="font-size: 16px; font-family: helvetica,sans-serif; margin:15px;"><?php echo get_post_meta($post->ID,'sm_form_content',true); ?>  </p>

	<?php echo get_post_meta($post->ID,'ssm_select_data_save_method',true); ?>
		<input type="hidden" name="sm_id" value="<?php echo $post->ID; ?>" >
		<input type='hidden' name='ssm_sub_url' class="ssm_sub_url" value='<?php echo get_post_meta($post->ID,'ssm_redirection_url',true); ?>' >
		<input type='text' id='sm_input' class='sm_field' name='sm_name' placeholder="<?php echo get_post_meta($post->ID,'sm_form_name_placeholder',true); ?>" >
		<input type='email' id='sm_input' class='sm_field' name='sm_email' placeholder="<?php echo get_post_meta($post->ID,'sm_form_email_placeholder',true); ?>" required >
	 
		<input type="submit"  name="submit" value="<?php echo get_post_meta($post->ID,'sm_form_cta_text',true); ?>" class="sm_submit" id='sm_submit'  style="color: <?php echo get_post_meta($post->ID,'smf_form_bg',true); ?> !important; background-color: <?php echo get_post_meta($post->ID,'smf_cta_bg',true); ?> !important; background: <?php echo get_post_meta($post->ID,'smf_cta_bg',true); ?> !important; ">
	</form>   
	<div style="font-size: 16px; line-height: 1.8; background: #e3e3e3; padding: 9px 0 1px 15px; font-family: helvetica,sans-serif; ">
		<span id="response" style="color: <?php echo get_post_meta($post->ID,'smf_content_c',true); ?> !important; ">
		<?php

			$ssm_post_sub_messages = get_option('ssm_post_sub_message' );
			if (!empty($ssm_post_sub_messages)) {
				echo $ssm_post_sub_messages;
			}else {
				echo "Thank you for subscribing.";
			}
		   ?>
    	</span>
		<p><?php echo get_post_meta($post->ID,'sm_form_footer_msg',true); ?></p>
	</div>
<?php
if ($sm_modal === 'true') {
	$smf_popup_close_text = get_post_meta($post->ID,'smf_popup_close_text',true);
	if (!empty($smf_popup_close_text)) {
		echo "<div class='sm_close'>$smf_popup_close_text</div>";
	}else{
		echo "<div class='sm_close'>No, Thanks Let me see the website.</div>";
	}
	
}	?>
</div>


<?php
if ($sm_modal === 'true') {
	echo '</div>';
}	?>