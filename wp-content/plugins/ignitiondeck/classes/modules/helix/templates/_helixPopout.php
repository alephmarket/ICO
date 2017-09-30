<div class="pop-out-content">
	<p><span class="waitlist-length"><?php echo (idhelix_waitlist_length()  > 0 ? idhelix_waitlist_length() : '0'); ?></span><?php echo __('People are on the Helix waiting list. '.(is_user_logged_in() ? 'Sign up' : 'Login').' to reserve your spot!', 'idf') ?></p>
    <div class="<?php echo (is_user_logged_in() ? 'helix-popup-logo' : ''); ?>">
		<?php echo '<img src="' . plugins_url( 'images/helix-logo-hover-proper.png', dirname(__FILE__) ) . '" >'; ?>
    </div>
    <?php if (is_user_logged_in()) { ?>
    <div class="helix-popup-logo-link" data-id="<?php echo get_current_user_id(); ?>">
			<?php echo '<a href="#" class="'.(!idhelix_user_waitlisted() ? 'unlisted' : '').'"><img src="' . plugins_url( (idhelix_user_waitlisted() ? 'images/helix-join-saved.png' : 'images/helix-join.png'), dirname(__FILE__) ) . '" ></a>'; ?>
    </div>
    <?php } ?>
</div>