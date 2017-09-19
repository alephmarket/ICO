<div class="socials">
    <div class="symbol"><label><?php echo esc_html__('Socials', 'themo') ?></label> <i class="fa fa-share-alt"></i></div>
    <ul>
        <?php foreach (ideothemo_get_team_meta('member_social') as $socialmedia => $profile): ?>

			<?php if ($profile): ?>
            <li>
                <a href="<?php echo esc_url($profile); ?>" target="_blank" class="js--no-load">
					<i class="<?php echo esc_attr(ideothemo_get_social_icon($socialmedia, false)); ?>"></i>
				</a>
            </li>
            <?php endif; ?>

        <?php endforeach; ?>
    </ul>
</div>