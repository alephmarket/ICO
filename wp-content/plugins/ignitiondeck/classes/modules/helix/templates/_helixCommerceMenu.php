<?php do_action('helix_above_commerce_menu'); ?>
<li><a href="<?php echo $params['durl']; ?>"><?php _e('Dashboard', 'idf'); ?></a></li>
<li><a href="<?php echo $params['edit_profile_url']; ?>"><?php _e('Account', 'idf'); ?></a></li>
<li><a href="<?php echo $params['orders_url']; ?>"><?php _e('Order History', 'idf'); ?></a></li>
<?php do_action('helix_below_commerce_menu'); ?>