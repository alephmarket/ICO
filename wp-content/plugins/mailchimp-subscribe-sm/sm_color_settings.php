<?php
if ( ! defined( 'ABSPATH' ) ) exit;
function ssm_color_settings_meta($post){
	//
	//  Background Colors 
	//
    $smf_body_bg = get_post_meta($post->ID,'smf_body_bg',true);
	$smf_form_bg = get_post_meta($post->ID,'smf_form_bg',true); //Section -1
	$smf_cta_bg = get_post_meta($post->ID,'smf_cta_bg',true); //Section --2
	$smf_content_c = get_post_meta($post->ID,'smf_content_c',true); //Section -3
	$smf_cta_c = get_post_meta($post->ID,'smf_cta_c',true);


	////  NONCE FIELD ///////

	wp_nonce_field( 'my_meta_box_nonce', 'meta_box_nonce' );

?>
		
		
	<style type="text/css">
	.formLayout_1
    {

        
        padding: 10px;
        width: 550px;
        margin: 10px;

        

    }
    
    .formLayout_1 label 
    {
        display: block;
        width: 195px;
        float: left;
        margin-bottom: 20px;
        margin-left: 20px;
    }
    .formLayout_1 input{
         display: block;
        float: left;
        margin-bottom: 20px;

    }
 
    .formLayout_1 label
    {
        text-align: right;
        padding-right: 20px;
        font-size: 16px;
        font-weight: bold;
    }
 
    br
    {
        clear: left;
    }

	</style>

<div class='formLayout_1'> 	
<h2>Background Colors</h2>

    <label for='smf_body_bg'>Body Background Color : </label>
     <input type='text' class='color_picker' name='smf_body_bg' value='<?php echo $smf_body_bg; ?>'/>
     <br>
     <br>

	<label for='smf_form_bg'>Form Background Color : </label>
	 <input type='text' class='color_picker' name='smf_form_bg' value='<?php echo $smf_form_bg; ?>'/>
	 <br>
 	 <br>
 	 <label for='smf_cta_bg'>Button Background Color : </label>
	 <input type='text' class='color_picker' name='smf_cta_bg' value='<?php echo $smf_cta_bg; ?>'/>
	 <br>
 	 <br>
	 

	 <h2>Text Color</h2>

	 <label for='smf_content_c'>Text Color : </label>
	 <input type='text' class='color_picker' name='smf_content_c' value='<?php echo $smf_content_c; ?>'/>
	 <br>
 	 <br>
	
	 <label for='smf_cta_c'>Button Text Color : </label>
	 <input type='text' class='color_picker' name='smf_cta_c' value='<?php echo $smf_cta_c; ?>'/>
	 <br>
 	 <br>

</div>

<div style='width:95%;margin-left:2.5%; text-align:center; background:#e3e3e3;height:60px;border-left:5px solid #a7d142;'>
 <?php submit_button('Update');?>
</div>





<?php


}
?>