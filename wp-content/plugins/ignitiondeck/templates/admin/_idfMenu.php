<div class="wrap idf ignitiondeck">
    <h2 class="title"><?php _e('IgnitionDeck', 'idf'); ?></h2>
    <p class="about-description"><?php _e('Welcome to the IgnitionDeck platform! Follow the instructions below to get started selling, fundraising, and crowdfunding.', 'idf'); ?></p>
    <div class="id-badge"></div>
<div id="ignitiondeck-panel" class="welcome-panel">
    <div class="welcome-panel-content">
        <?php if ($idf_registered) { ?>
            <a id="idf_reset_account" class="disconnect" href="#"><?php _e('Disconnect Account', 'idf'); ?></a>
            <div class="getting_started">
                <?php _e('You have registered successfully, and IgnitionDeck Crowdfunding and IgnitionDeck Commerce have been installed and activated', 'idf'); ?>.<br/>
                <?php _e('Here\'s how to get started', 'idf'); ?>:
                <ol>
                    <li><a href="<?php echo site_url('wp-admin/themes.php'); ?>"><?php _e('Activate Theme 500', 'idf'); ?></a> <?php _e(', if you wish to use it', 'idf'); ?></li>
                    <li><a href="<?php echo site_url('wp-admin/admin.php?page=ignitiondeck'); ?>"><?php _e('Configure IgnitionDeck Crowdfunding and IgnitionDeck Commerce', 'idf'); ?></a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="https://ignitiondeck.com/id/documentation/quickstart/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium"><i class="fa fa-file-text-o"></i></a></li>
                    <li><a href="<?php echo site_url('wp-admin/post-new.php?post_type=ignition_product'); ?>"><?php _e('Create your first project', 'idf'); ?></a>&nbsp;&nbsp;&nbsp;<a target="_blank" href="https://ignitiondeck.com/id/documentation/ignitiondeck-crowdfunding/create-a-project/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium"><i class="fa fa-file-text-o"></i></a></li>
                    <li><?php _e('Need to unlock more features', 'idf'); ?>? <a target="_blank" href="https://ignitiondeck.com/id/ignitiondeck-pricing/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium"><?php _e('Upgrade to IgnitionDeck Echelon or IgnitionDeck Enterprise', 'idf'); ?></a></li>
                    <li><?php _e('Use the commerce selector below to choose an eCommerce platform for use with IgnitionDeck Crowdfunding', 'idf'); ?></li>
                </ol>
            </div>
        <?php } else { ?>
		    <h2><?php _e('Benefits of Activation', 'idf'); ?></h2>
		    <div class="welcome-panel-column-container">
		        <div class="welcome-panel-column">
		            <ul>
		                <li><?php _e('Automatic installation of our free plugins', 'idf'); ?>.</li>
		                <li><?php _e('Access to support forums', 'idf'); ?></li>
		                <li><?php _e('News and updates', 'idf'); ?></li>
		                <li><?php _e('Access to more free themes and modules', 'idf'); ?></li>
		            </ul>
		            
		        </div>
		        <div class="welcome-panel-column">
                    <?php if ($install_data->status) { ?>
		            <a class="button button-primary button-hero" href="https://ignitiondeck.com/id/id-launchpad-checkout/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" id="id_account" name="id_account"><?php _e('Activate Now', 'idf'); ?></a>
		            <p class="hide-if-no-customize"><?php _e('Account creation is fast and', 'idf'); ?><br/><?php _e('you won&rsquo;t leave your website', 'idf'); ?>.</p>
                    <?php } else { 
                        echo '<p class="idf_install_data"><span class="idf_install_data_title">'.__('Cannot Activate', 'idf').'</span>: ';
                        foreach ($install_data as $data) {
                            echo $data->message;
                        }
                        echo '</p>';
                    } ?>
                </div>
		    </div>
		<?php } ?>
    </div>
</div>

<div id="dashboard-widgets-wrap">
    <div id="dashboard-widgets" class="metabox-holder">
        <div id="postbox-container-1" class="postbox-container">
            <div id="normal-sortables" class="meta-box-sortables ui-sortable">
                <?php if ($super) { ?>
                <div id="idf_license_settings" class="postbox <?php echo (empty($idf_registered) || !$idf_registered ? 'disabled' : ''); ?>">
                    <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text"><?php _e('Toggle panel', 'idf'); ?>: <?php _e('License Settings', 'idf'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span><?php _e('License Settings', 'idf'); ?></span></h2>
                    <div class="inside">
                        <p><?php _e('Entering your <a href="https://ignitiondeck.com/id/documentation/ignitiondeck-crowdfunding/setup-ignitiondeck/ignitiondeck-license-keys/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" target="_blank">license key</a> will enable automatic updates via the WordPress admin for the duration of your license period.', 'idf'); ?></p>
                        <form name="licenseSettings" action="" method="post">
                            <ul>
                                <?php if (idf_has_idcf()) { ?>
                                <li>
                                    <label for="idcf_license_key" class=""><i class="fa fa-key"></i> <?php _e('IDCF License Key', 'idf'); ?></label><br/>
                                    <input type="text" name="idcf_license_key" id="idcf_license_key" value="<?php echo (isset($idcf_license_key) ? $idcf_license_key : ''); ?>"/>
                                </li>
                                <?php } ?>
                                <?php if (idf_has_idc()) { ?>
                                <li>
                                    <label for="idc_license_key" class=""><i class="fa fa-key"></i> <?php _e('IDC License Key', 'memberdeck'); ?></label><br/>
                                    <input type="text" name="idc_license_key" id="idc_license_key" value="<?php echo (isset($idc_license_key) ? $idc_license_key : ''); ?>"/>
                                </li>
                                <?php } ?>
                                <li>
                                    <button class="button button-primary"><?php _e('Validate', 'ignitiondeck'); ?></button>
                                </li>
                            </ul>
                        </form>
                        <div class="license_validation">
                            <p>
                                <?php echo ($is_id_licensed || $is_idc_licensed ? '<i class="fa fa-check"></i>'.__(' License Valid for', 'ignitiondeck').$type_msg : 'You are using the free version of IgnitionDeck.<br/><a href="https://ignitiondeck.com/id/ignitiondeck-pricing/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" target="_blank">Upgrade now</a> to unlock advanced functionality.'); ?>
                            </p>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div id="idf_commerce_platform" class="postbox <?php echo (!class_exists('ID_Project') ? 'disabled' : ''); ?>">
                    <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text"><?php _e('Toggle panel', 'idf'); ?>: <?php _e('Crowdfunding Integration', 'idf'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span><?php _e('Crowdfunding Integration', 'idf'); ?></span></h2>
                    <div class="inside">
                        <form id="idf_commerce" name="idf_commerce" method="POST" action="">
                            <p><?php _e('Select a commerce platform for use with IgnitionDeck Crowdfunding', 'idf'); ?></br></p>
                            <p><em><?php _e('Note: Enabling WooCommerce requires the purchase of an IgnitionDeck License.', 'idf'); ?></em></br></p>
                            <div class="form-select form-row">
                                <label for="commerce_selection" style="font-weight: bold;"><?php _e('Commerce Platform', 'idf'); ?></label>
                                <p>
                                    <select name="commerce_selection" id="commerce_selection">
                                        <?php if (in_array('idc', $platforms)) { ?>
                                            <option value="idc" <?php echo (isset($platform) && $platform == 'idc' ? 'selected="selected"' : ''); ?>><?php _e('IgnitionDeck Commerce', 'idf'); ?></option>
                                        <?php } if (in_array('wc', $platforms)) { ?>
                                            <option value="wc" <?php echo (isset($platform) && $platform == 'wc' ? 'selected="selected"' : ''); ?>><?php _e('WooCommerce', 'idf'); ?></option>
                                        <?php } if (in_array('edd', $platforms) && idf_has_edd()) { ?>
                                            <option value="edd" <?php echo (isset($platform) && $platform == 'edd' ? 'selected="selected"' : ''); ?>><?php _e('Easy Digital Downloads', 'idf'); ?></option>
                                        <?php } if (isset($platform) && $platform == 'legacy') { ?>
                                            <option value="legacy" selected="selected"><?php _e('Legacy IgnitionDeck', 'idf'); ?></option>
                                        <?php } ?>
                                    </select>
                                </p>
                            </div>
                            <div class="form-input">
                                <input type="submit" name="commerce_submit" class="button button-primary" value="<?php _e('Save', 'idf'); ?>"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="postbox-container-2" class="postbox-container">
            <div id="side-sortables" class="meta-box-sortables ui-sortable">
                <div id="idf_modules_widget" class="postbox <?php echo (!$idf_registered ? 'disabled' : ''); ?>">
                    <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text"><?php _e('Toggle panel', 'idf'); ?>: <?php _e('Modules', 'idf'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span><?php _e('Modules', 'idf'); ?></span></h2>
                    <div class="inside">
                        <ul>
                            <?php foreach ($extension_data as $extension) { ?>
                            <li>
                                <div class="modules-image" style="background-image: url(<?php echo $extension->thumbnail; ?>);"></div>
                                <div class="modules-info">
                                    <strong><?php echo $extension->title; ?></strong><br/>
                                    <?php echo $extension->short_desc; ?>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                        <p><a href="<?php menu_page_url('idf-extensions');?>" class="modules-link"><?php printf(__('View All %d Modules', 'idf'), count($data)); ?></a>
                     </div>
                </div>
                <div id="idf_support_widget" class="postbox">
                    <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text"><?php _e('Toggle panel', 'idf'); ?>: <?php _e('Support', 'idf'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span><?php _e('Support', 'idf'); ?></span></h2>
                    <div class="inside">
                        <p><?php _e('Our support team is available 9am-5pm EST Monday-Friday. Click the links below to view our step-by-step documentation or visit the support forums.', 'idf'); ?></p>
                        <a href="https://ignitiondeck.com/id/forums/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" alt="IgnitionDeck Support" title="IgnitionDeck Support" target="_blank"><button class="button button-large button-secondary"><?php _e('Support', 'idf'); ?></button></a>
                        <a href="https://ignitiondeck.com/id/documentation/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" alt="IgnitionDeck Documentation" title="IgnitionDeck Documentation" target="_blank"><button class="button button-large button-secondary"><?php _e('Documentation', 'idf'); ?></button></a>
                        <p><?php _e('Like this product? Help us out with a', 'idf'); ?> <a href="https://wordpress.org/support/plugin/ignitiondeck/reviews/"><?php _e('review', 'idf'); ?></a>!<br/>
                        <?php _e('Not a fan?', 'idf'); ?> <a href="mailto:hello@virtuousgiant.com?Subject=IgnitionDeck%20Feedback" target="_blank"><?php _e('Tell us why', 'idf'); ?></a>.</p>
                     </div>
                </div>
            </div>
        </div>  
        <?php if ($license_type !== 'ide') { ?>
        <div id="postbox-container-3" class="postbox-container">
            <div id="column3-sortables" class="meta-box-sortables ui-sortable">
                <div id="idf_upgrades_widget" class="postbox">
                    <button type="button" class="handlediv button-link" aria-expanded="true"><span class="screen-reader-text"><?php _e('Toggle panel', 'idf'); ?>: <?php _e('Available Upgrades', 'idf'); ?></span><span class="toggle-indicator" aria-hidden="true"></span></button><h2 class="hndle ui-sortable-handle"><span><?php _e('Available Upgrades', 'idf'); ?></span></h2>
                    <div class="inside">
                        <?php if ($license_type !== 'idc') { ?>
                        <p><strong><?php _e('IgnitionDeck Echelon', 'idf'); ?></strong><br>
                        Our complete e-commerce toolkit. Enables additional gateways (incl. Stripe), modules, commerce options, email templates, member settings, and tons more!</p>
                        <a href="https://ignitiondeck.com/commerce/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" alt="Upgrade Now" title="IgnitionDeck Support" target="_blank"><button class="button button-large button-primary"><?php _e('Get Echelon', 'idf'); ?></button></a>
                        <?php } ?>
                        <p><strong><?php _e('IgnitionDeck Enterprise', 'idf'); ?></strong><br>
                        Allows you to build your own white label crowdfunding platform. Includes front-end submission, flat and % based commissions, and much more!</p>
                        <a href="https://ignitiondeck.com/enterprise/?utm_source=licensepage&utm_medium=link&utm_campaign=freemium" alt="Upgrade Now" title="IgnitionDeck Support" target="_blank"><button class="button button-large button-primary"><?php _e('Get Enterprise', 'idf'); ?></button></a>
                     </div>
                </div>
            </div>
        </div>
        <?php } ?>
        <div id="postbox-container-4" class="postbox-container">
            <div id="column4-sortables" class="meta-box-sortables ui-sortable empty-container"></div>
        </div>
</div>

<input type="hidden" id="closedpostboxesnonce" name="closedpostboxesnonce" value="4a00a60188"><input type="hidden" id="meta-box-order-nonce" name="meta-box-order-nonce" value="563de8399f">    </div>