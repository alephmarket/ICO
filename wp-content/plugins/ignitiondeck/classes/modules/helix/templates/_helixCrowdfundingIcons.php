<?php do_action('helix_above_crowdfunding_icons'); ?>
<li><a href="<?php echo $params['backer_profile_url'].$current_user->ID; ?>"><i class="fa fa-user"></i></a></li>
<?php if (is_id_pro() && current_user_can('create_edit_projects')) { ?>
	<li><a href="<?php echo $params['creator_profile_url'].$current_user->ID; ?>"><i class="fa fa-users"></i></a></li>
		<?php if (idc_creator_settings_enabled()) { ?>
		<li><a href="<?php echo $params['creator_settings_url']; ?>"><i class="fa fa-university"></i></a></li>
		<?php } ?>
	<li><a href="<?php echo $params['my_projects_url']; ?>"><i class="fa fa-rocket"></i></a></li>
<?php } ?>
<?php do_action('helix_below_crowdfunding_icons'); ?>