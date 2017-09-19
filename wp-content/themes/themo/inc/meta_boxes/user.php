<?php

//account owner
add_action('show_user_profile', 'ideothemo_add_custom_user_profile_fields');
add_action('personal_options_update', 'ideothemo_save_custom_user_profile_fields');

//admin
add_action('edit_user_profile', 'ideothemo_add_custom_user_profile_fields');
add_action('edit_user_profile_update', 'ideothemo_save_custom_user_profile_fields');

function ideothemo_add_custom_user_profile_fields($user)
{
    ?>
    <table class="form-table">
        <tr>
            <th><label for="position"><?php esc_html_e('Position', 'themo'); ?></label></th>
            <td>
                <input type="text" name="position" id="position"
                       value="<?php echo esc_attr(get_user_meta($user->ID, 'position', true)); ?>"
                       class="regular-text"/>
            </td>
        </tr>
    </table>
    <?php
}

function ideothemo_save_custom_user_profile_fields($user_id)
{
    if (!current_user_can('edit_user', $user_id))
        return false;

    $position_name = isset($_POST['position']) ? esc_sql($_POST['position']) : '';

    update_user_meta($user_id, 'position', $position_name);
}