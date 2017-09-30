<?php if ($logged_in) { ?>
	<li><a href="<?php echo wp_logout_url(home_url()); ?>"><i class="fa fa-power-off"></i></a></li>
<?php } else { ?>
	<li><a href="#"><i class="fa fa-user"></i></a></li>
    <li><a href="#"><i class="fa fa-lock"></i></a></li>
<?php } ?>