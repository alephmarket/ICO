<?php do_action('helix_above_crowdfunding_menu'); ?>
<li><a href="<?php echo $params['backer_profile_url'].$current_user->ID; ?>"><?php _e('Backer Profile', 'idf'); ?></a></li>
<?php if (is_id_pro() && current_user_can('create_edit_projects')) { ?>
	<li><a href="<?php echo $params['creator_profile_url'].$current_user->ID; ?>"><?php _e('Creator Profile', 'idf'); ?></a></li>
		<?php if (idc_creator_settings_enabled()) { ?>
		<li><a href="<?php echo $params['creator_settings_url']; ?>"><?php _e('Creator Settings', 'idf'); ?></a></li>
		<?php } ?>
	<li><a href="<?php echo $params['my_projects_url']; ?>"><?php _e(($project_count > 0 ? 'My Projects' : 'Create Project'), 'idf'); ?></a></li>
<?php } ?>
<?php do_action('helix_below_crowdfunding_menu'); ?>