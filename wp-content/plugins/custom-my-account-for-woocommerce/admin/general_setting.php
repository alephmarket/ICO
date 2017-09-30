<?php 
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	if ( !current_user_can( 'manage_options' ) ){ die(); }
	
	if ( ! empty( $_POST ) && check_admin_referer( 'phoen_custom_my_account_action', 'phoen_custom_my_account_nonce_field' ) ) {
	
		if(isset($_POST['update_settings']))
		{
			
			$check = update_option('myaccount_general_setting', $_POST);
		 
			if($check ==1)
			{
			?>

				<div class="updated" id="message">

					<p><strong><?php _e('Setting updated.','custom-my-account');?></strong></p>

				</div>

			<?php
			}
			else
			{
				?>
					<div class="error below-h2" id="message"><p><?php _e(' Something Went Wrong Please Try Again With Valid Data.','custom-my-account');?></p></div>
				<?php
			}
		}
	
		if(isset($_POST['phoen_reset']))
		{
			$reset = array(
							'phoen_enable_plugin'=>'enable',
							
							
						);
			$check = update_option('myaccount_general_setting', $reset); 
			
			if($check ==1)
			{
			?>

				<div class="updated" id="message">

					<p><strong><?php _e('Setting has been Reset.','custom-my-account');?></strong></p>

				</div>

			<?php
			}  
			else
			{    
				?>
					<div class="error below-h2" id="message"><p><?php _e(' Something Went Wrong Please Try Again With Valid Data.','custom-my-account');?></p></div>
				<?php
			}
		}
		
	}
	$row = get_option('myaccount_general_setting');

?>

<form method="post" action="" class="form-table">
	<?php wp_nonce_field( 'phoen_custom_my_account_action', 'phoen_custom_my_account_nonce_field' ); ?>
	<table class="form-table" style="background:#fff;">
		<tbody>
		<h3><?php _e('General Options','custom-my-account');?></h3>
			<tr>
				<th><?php _e('Enable plugin','custom-my-account');?></th>
				<td><input type="checkbox" value="enable" name="phoen_enable_plugin" <?php if($row['phoen_enable_plugin']=='enable'){echo"checked";}?>></td>
			</tr>
			
		</tbody>
	</table>
	<p class="submit"><input type="submit" value="Save changes" class="button button-primary" id="submit" name="update_settings">&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" onclick="return confirm('If you continue with this action, you will reset all options in this page.\nAre you sure?');" value="Reset Defaults" class="button-secondary" name="phoen_reset">
</p>
</form>