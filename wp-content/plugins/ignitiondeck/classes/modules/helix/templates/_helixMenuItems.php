<?php if (is_user_logged_in()) { ?>
<li><a href="<?php echo wp_logout_url(home_url()); ?>"><?php _e('Logout', 'idf'); ?></a></li>
<?php } ?>