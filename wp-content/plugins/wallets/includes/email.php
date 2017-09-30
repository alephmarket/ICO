<?php

// don't load directly
defined( 'ABSPATH' ) || die( '-1' );

if ( ! class_exists( 'Dashed_Slug_Wallets_Email' ) ) {
	class Dashed_Slug_Wallets_Email {

		public function __construct() {
			register_activation_hook( DSWALLETS_FILE, array( __CLASS__, 'action_activate' ) );

			add_action( 'wallets_admin_menu', array( &$this, 'action_admin_menu' ) );
			add_action( 'admin_init', array( &$this, 'action_admin_init' ) );

			if ( is_plugin_active_for_network( 'wallets/wallets.php' ) ) {
				add_action( 'network_admin_edit_wallets-menu-email', array( &$this, 'update_network_options' ) );
			}

			add_action( 'wallets_withdraw', array( &$this, 'action_withdraw' ) );
			add_action( 'wallets_move_send', array( &$this, 'action_move_send' ) );
			add_action( 'wallets_move_receive', array( &$this, 'action_move_receive' ) );
			add_action( 'wallets_deposit', array( &$this, 'action_deposit' ) );

			add_action( 'wallets_withdraw_failed', array( &$this, 'action_withdraw_failed' ) );
			add_action( 'wallets_move_send_failed', array( &$this, 'action_move_send_failed' ) );
		}

		public static function action_activate( $network_active ) {
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_withdraw_enabled', 'on' );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_withdraw_subject', __( 'You have performed a withdrawal. - ###COMMENT###', 'wallets' ) );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_withdraw_message', __( <<<EMAIL

###ACCOUNT###,

You have withdrawn ###AMOUNT### ###SYMBOL### to address ###ADDRESS###.

Fees paid: ###FEE###
Transaction ID: ###TXID###
Transacton created at: ###CREATED_TIME###
Comment: ###COMMENT###

EMAIL
				, 'wallets' ) );

			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_withdraw_failed_enabled', 'on' );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_withdraw_failed_subject', __( 'Your withdrawal request has FAILED permanently. - ###COMMENT###', 'wallets' ) );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_withdraw_failed_message', __( <<<EMAIL

###ACCOUNT###,

You have attempted to withdraw ###AMOUNT### ###SYMBOL### to address ###ADDRESS###.

Your transaction failed after being attempted a predetermined number of times and will not be retried any further. If you are unsure why your transaction failed, please contact the administrator.

Last error message: ###LAST_ERROR###
Transacton created at: ###CREATED_TIME###
Comment: ###COMMENT###

EMAIL
				, 'wallets' ) );


			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_send_enabled', 'on' );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_send_subject', __( 'You have sent funds to another user. - ###COMMENT###', 'wallets' ) );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_send_message', __( <<<EMAIL

###ACCOUNT###,

You have sent ###AMOUNT### ###SYMBOL### from your account to the ###OTHER_ACCOUNT### account.

Fees paid: ###FEE###
Transaction ID: ###TXID###
Transacton created at: ###CREATED_TIME###
Comment: ###COMMENT###
Tags: ###TAGS###

EMAIL
				, 'wallets' ) );

			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_send_failed_enabled', 'on' );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_send_failed_subject', __( 'You request to send funds to another user has FAILED permanently. - ###COMMENT###', 'wallets' ) );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_send_failed_message', __( <<<EMAIL

###ACCOUNT###,

You have attempted to send ###AMOUNT### ###SYMBOL### from your account to the ###OTHER_ACCOUNT### account.

Your transaction failed after being attempted a predetermined number of times and will not be retried any further. If you are unsure why your transaction failed, please contact the administrator.

Transaction ID: ###TXID###
Transacton created at: ###CREATED_TIME###
Comment: ###COMMENT###
Tags: ###TAGS###

EMAIL
				, 'wallets' ) );


			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_receive_enabled', 'on' );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_receive_subject', __( 'You have received funds from another user. - ###COMMENT###', 'wallets' ) );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_move_receive_message', __( <<<EMAIL

###ACCOUNT###,

You have received ###AMOUNT### ###SYMBOL### from ###OTHER_ACCOUNT###.

Transaction ID: ###TXID###
Transacton created at: ###CREATED_TIME###
Comment: ###COMMENT###
Tags: ###TAGS###

EMAIL
				, 'wallets' ) );

			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_deposit_enabled', 'on' );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_deposit_subject', __( 'You have performed a ###SYMBOL### deposit.', 'wallets' ) );
			call_user_func( $network_active ? 'add_site_option' : 'add_option',  'wallets_email_deposit_message', __( <<<EMAIL

###ACCOUNT###,

You have deposited ###AMOUNT### ###SYMBOL### from address ###ADDRESS###.

Please note that the funds may not be yet available to you before the required amount of network confirmations is reached.

Transaction ID: ###TXID###
Transacton seen at: ###CREATED_TIME###

EMAIL
				, 'wallets' ) );

		}

		public function action_admin_init() {
			// withdrawal
			add_settings_section(
				'wallets_email_withdraw_section',
				__( 'E-mail notification settings for SUCCESSFUL withdrawals', '/* @echo slug' ),
				array( &$this, 'wallets_email_section_cb' ),
				'wallets-menu-email'
			);

			add_settings_field(
				'wallets_email_withdraw_enabled',
				__( 'Notify users about SUCCESSFUL withdrawals', 'wallets' ),
				array( &$this, 'checkbox_cb' ),
				'wallets-menu-email',
				'wallets_email_withdraw_section',
				array(
					'label_for' => 'wallets_email_withdraw_enabled',
					'description' => __( 'Check to enable this type of e-mails.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_withdraw_enabled'
			);

			add_settings_field(
				'wallets_email_withdraw_subject',
				__( 'Template for e-mail subject line:', 'wallets' ),
				array( &$this, 'text_cb' ),
				'wallets-menu-email',
				'wallets_email_withdraw_section',
				array(
					'label_for' => 'wallets_email_withdraw_subject',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_withdraw_subject'
			);

			add_settings_field(
				'wallets_email_withdraw_message',
				__( 'Template for e-mail message body:', 'wallets' ),
				array( &$this, 'textarea_cb' ),
				'wallets-menu-email',
				'wallets_email_withdraw_section',
				array(
					'label_for' => 'wallets_email_withdraw_message',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_withdraw_message'
			);

			// withdrawal failed
			add_settings_section(
				'wallets_email_withdraw_failed_section',
				__( 'E-mail notification settings for FAILED withdrawals', '/* @echo slug' ),
				array( &$this, 'wallets_email_section_cb' ),
				'wallets-menu-email'
				);

			add_settings_field(
				'wallets_email_withdraw_failed_enabled',
				__( 'Notify users about FAILED withdrawals', 'wallets' ),
				array( &$this, 'checkbox_cb' ),
				'wallets-menu-email',
				'wallets_email_withdraw_failed_section',
				array(
					'label_for' => 'wallets_email_withdraw_failed_enabled',
					'description' => __( 'Check to enable this type of e-mails.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_withdraw_failed_enabled'
			);

			add_settings_field(
				'wallets_email_withdraw_failed_subject',
				__( 'Template for e-mail subject line:', 'wallets' ),
				array( &$this, 'text_cb' ),
				'wallets-menu-email',
				'wallets_email_withdraw_failed_section',
				array(
					'label_for' => 'wallets_email_withdraw_failed_subject',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_withdraw_failed_subject'
			);

			add_settings_field(
				'wallets_email_withdraw_failed_message',
				__( 'Template for e-mail message body:', 'wallets' ),
				array( &$this, 'textarea_cb' ),
				'wallets-menu-email',
				'wallets_email_withdraw_failed_section',
				array(
					'label_for' => 'wallets_email_withdraw_failed_message',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_withdraw_failed_message'
			);

			// deposit
			add_settings_section(
				'wallets_email_deposit_section',
				__( 'E-mail notification settings for deposits', '/* @echo slug' ),
				array( &$this, 'wallets_email_section_cb' ),
				'wallets-menu-email'
			);

			add_settings_field(
				'wallets_email_deposit_enabled',
				__( 'Notify users about depositals', 'wallets' ),
				array( &$this, 'checkbox_cb' ),
				'wallets-menu-email',
				'wallets_email_deposit_section',
				array(
					'label_for' => 'wallets_email_deposit_enabled',
					'description' => __( 'Check to enable this type of e-mails.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_deposit_enabled'
			);

			add_settings_field(
				'wallets_email_deposit_subject',
				__( 'Template for e-mail subject line:', 'wallets' ),
				array( &$this, 'text_cb' ),
				'wallets-menu-email',
				'wallets_email_deposit_section',
				array(
					'label_for' => 'wallets_email_deposit_subject',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_deposit_subject'
			);

			add_settings_field(
				'wallets_email_deposit_message',
				__( 'Template for e-mail message body:', 'wallets' ),
				array( &$this, 'textarea_cb' ),
				'wallets-menu-email',
				'wallets_email_deposit_section',
				array(
					'label_for' => 'wallets_email_deposit_message',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_deposit_message'
			);

			// move_send
			add_settings_section(
				'wallets_email_move_send_section',
				__( 'E-mail notification settings for SUCCESSFUL outgoing fund transfers', '/* @echo slug' ),
				array( &$this, 'wallets_email_section_cb' ),
				'wallets-menu-email'
			);

			add_settings_field(
				'wallets_email_move_send_enabled',
				__( 'Notify users about SUCCESSFUL outgoing fund transfers', 'wallets' ),
				array( &$this, 'checkbox_cb' ),
				'wallets-menu-email',
				'wallets_email_move_send_section',
				array(
					'label_for' => 'wallets_email_move_send_enabled',
					'description' => __( 'Check to enable this type of e-mails.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_send_enabled'
			);

			add_settings_field(
				'wallets_email_move_send_subject',
				__( 'Template for e-mail subject line:', 'wallets' ),
				array( &$this, 'text_cb' ),
				'wallets-menu-email',
				'wallets_email_move_send_section',
				array(
					'label_for' => 'wallets_email_move_send_subject',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_send_subject'
			);

			add_settings_field(
				'wallets_email_move_send_message',
				__( 'Template for e-mail message body:', 'wallets' ),
				array( &$this, 'textarea_cb' ),
				'wallets-menu-email',
				'wallets_email_move_send_section',
				array(
					'label_for' => 'wallets_email_move_send_message',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_send_message'
			);

			// move_send failed
			add_settings_section(
				'wallets_email_move_send_failed_section',
				__( 'E-mail notification settings for FAILED outgoing fund transfers', '/* @echo slug' ),
				array( &$this, 'wallets_email_section_cb' ),
				'wallets-menu-email'
			);

			add_settings_field(
				'wallets_email_move_send_failed_enabled',
				__( 'Notify users about outgoing FAILED fund transfers', 'wallets' ),
				array( &$this, 'checkbox_cb' ),
				'wallets-menu-email',
				'wallets_email_move_send_failed_section',
				array(
					'label_for' => 'wallets_email_move_send_failed_enabled',
					'description' => __( 'Check to enable this type of e-mails.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_send_failed_enabled'
			);

			add_settings_field(
				'wallets_email_move_send_failed_subject',
				__( 'Template for e-mail subject line:', 'wallets' ),
				array( &$this, 'text_cb' ),
				'wallets-menu-email',
				'wallets_email_move_send_failed_section',
				array(
					'label_for' => 'wallets_email_move_send_failed_subject',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_send_failed_subject'
			);

			add_settings_field(
				'wallets_email_move_send_failed_message',
				__( 'Template for e-mail message body:', 'wallets' ),
				array( &$this, 'textarea_cb' ),
				'wallets-menu-email',
				'wallets_email_move_send_failed_section',
				array(
					'label_for' => 'wallets_email_move_send_failed_message',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_send_failed_message'
			);

			// move_receive
			add_settings_section(
				'wallets_email_move_receive_section',
				__( 'E-mail notification settings for incoming fund transfers', '/* @echo slug' ),
				array( &$this, 'wallets_email_section_cb' ),
				'wallets-menu-email'
			);

			add_settings_field(
				'wallets_email_move_receive_enabled',
				__( 'Notify users about incoming fund transfers', 'wallets' ),
				array( &$this, 'checkbox_cb' ),
				'wallets-menu-email',
				'wallets_email_move_receive_section',
				array(
					'label_for' => 'wallets_email_move_receive_enabled',
					'description' => __( 'Check to enable this type of e-mails.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_receive_enabled'
			);

			add_settings_field(
				'wallets_email_move_receive_subject',
				__( 'Template for e-mail subject line:', 'wallets' ),
				array( &$this, 'text_cb' ),
				'wallets-menu-email',
				'wallets_email_move_receive_section',
				array(
					'label_for' => 'wallets_email_move_receive_subject',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_receive_subject'
			);

			add_settings_field(
				'wallets_email_move_receive_message',
				__( 'Template for e-mail message body:', 'wallets' ),
				array( &$this, 'textarea_cb' ),
				'wallets-menu-email',
				'wallets_email_move_receive_section',
				array(
					'label_for' => 'wallets_email_move_receive_message',
					'description' => __( 'See the bottom of this page for variable substitutions.', 'wallets' ),
				)
			);

			register_setting(
				'wallets-menu-email',
				'wallets_email_move_receive_message'
			);
		}

		public function action_admin_menu() {
			if ( current_user_can( 'manage_wallets' ) ) {
				add_submenu_page(
					'wallets-menu-wallets',
					'Bitcoin and Altcoin Wallets E-mail notifications',
					'E-mails',
					'manage_wallets',
					'wallets-menu-email',
					array( &$this, "wallets_email_page_cb" )
				);
			}
		}


		public function wallets_email_page_cb() {
			if ( ! current_user_can( Dashed_Slug_Wallets_Capabilities::MANAGE_WALLETS ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
			}

			?><h1><?php esc_html_e( 'Bitcoin and Altcoin Wallets E-mail notification settings', 'wallets' ); ?></h1>

				<p><?php esc_html_e( 'Users are notified by e-mail when they perform deposits or withdrawals and when they send or receive funds. ' .
					'Here you can set template messages for these emails.', 'wallets' ); ?></p>

				<form method="post" action="<?php

						if ( is_plugin_active_for_network( 'wallets/wallets.php' ) ) {
							echo esc_url(
								add_query_arg(
									'action',
									'wallets-menu-email',
									network_admin_url( 'edit.php' )
								)
							);
						} else {
							echo 'options.php';
						}

					?>"><?php
					settings_fields( 'wallets-menu-email' );
					do_settings_sections( 'wallets-menu-email' );
					submit_button();
				?></form>

				<div class="card">
					<h2><?php esc_html_e( 'The following variables are substituted in e-mail templates:', 'wallets' ); ?></h2>
					<dl>
						<dt><code>###ACCOUNT###</code></dt>
						<dd><?php esc_html_e( 'Account username', 'wallets' ); ?></dd>
						<dt><code>###OTHER_ACCOUNT###</code></dt>
						<dd><?php esc_html_e( 'Username of other account (for internal transactions between users)', 'wallets' ); ?></dd>
						<dt><code>###TXID###</code></dt>
						<dd><?php esc_html_e( 'Transaction ID. ( This is normally the same as the txid on the blockchain. Internal transactions are also assigned a unique ID. )', 'wallets' ); ?></dd>
						<dt><code>###AMOUNT###</code></dt>
						<dd><?php esc_html_e( 'The amount transacted.', 'wallets' ); ?></dd>
						<dt><code>###FEE###</code></dt>
						<dd><?php esc_html_e( 'For withdrawals and transfers, the fees paid to the site.', 'wallets' ); ?></dd>
						<dt><code>###SYMBOL###</code></dt>
						<dd><?php esc_html_e( 'The coin symbol for this transaction (e.g. "BTC" for Bitcoin)', 'wallets' ); ?></dd>
						<dt><code>###CREATED_TIME###</code></dt>
						<dd><?php esc_html_e( 'The date and time of the transaction in ISO-8601 notation. YYYY-MM-DDThh:mm:ssZZZZ', 'wallets' ); ?></dd>
						<dt><code>###COMMENT###</code></dt>
						<dd><?php esc_html_e( 'The comment attached to the transaction.', 'wallets' ); ?></dd>
						<dt><code>###ADDRESS###</code></dt>
						<dd><?php esc_html_e( 'For deposits and withdrawals, the external address.', 'wallets' ); ?></dd>
						<dt><code>###TAGS###</code></dt>
						<dd><?php esc_html_e( 'A space separated list of tags, slugs, etc that further describe the type of transaction.', 'wallets' ); ?></dd>
						<dt><code>###LAST_ERROR###</code></dt>
						<dd><?php esc_html_e( 'Only for failed withdrawals, shows the last error occurred in a failed transaction.', 'wallets' ); ?></dd>
					</dl>
				</div><?php
		}

		public function update_network_options() {
			check_admin_referer( 'wallets-menu-email-options' );

			foreach ( array(
				'wallets_email_withdraw_enabled',
				'wallets_email_withdraw_failed_enabled',
				'wallets_email_move_send_enabled',
				'wallets_email_move_send_failed_enabled',
				'wallets_email_move_receive_enabled',
				'wallets_email_deposit_enabled'
			) as $checkbox_option_slug ) {
				Dashed_Slug_Wallets::update_option( $checkbox_option_slug, filter_input( INPUT_POST, $checkbox_option_slug, FILTER_SANITIZE_STRING ) ? 'on' : '' );
			}

			foreach ( array(
				'wallets_email_withdraw_subject',
				'wallets_email_withdraw_message',
				'wallets_email_withdraw_failed_subject',
				'wallets_email_withdraw_failed_message',
				'wallets_email_move_send_subject',
				'wallets_email_move_send_message',
				'wallets_email_move_send_failed_subject',
				'wallets_email_move_send_failed_message',
				'wallets_email_move_receive_subject',
				'wallets_email_move_receive_message',
				'wallets_email_deposit_subject',
				'wallets_email_deposit_message',

			) as $text_option_slug ) {
				Dashed_Slug_Wallets::update_option( $text_option_slug, filter_input( INPUT_POST, $text_option_slug, FILTER_SANITIZE_STRING ) );
			}

			wp_redirect( add_query_arg( 'page', 'wallets-menu-email', network_admin_url( 'admin.php' ) ) );
			exit;
		}

		public function checkbox_cb( $arg ) {
			?><input name="<?php echo esc_attr( $arg['label_for'] ); ?>" id="<?php echo esc_attr( $arg['label_for'] ); ?>" type="checkbox"
			<?php checked( Dashed_Slug_Wallets::get_option( $arg['label_for'] ), 'on' ); ?> />
			<p id="<?php echo esc_attr( $arg['label_for'] ); ?>-description" class="description"><?php
			echo esc_html( $arg['description'] ); ?></p><?php
		}

		public function text_cb( $arg ) {
			?><input style="width:100%;" type="text"
			name="<?php echo esc_attr( $arg['label_for'] ); ?>" id="<?php echo esc_attr( $arg['label_for'] ); ?>" value="<?php
			echo esc_attr( Dashed_Slug_Wallets::get_option( $arg['label_for'] ) ); ?>" />
			<p id="<?php echo esc_attr( $arg['label_for'] ); ?>-description" class="description"><?php
			echo esc_html( $arg['description'] ); ?></p><?php
		}

		public function textarea_cb( $arg ) {
			?><textarea style="width:100%;" rows="8"
				name="<?php echo esc_attr( $arg['label_for'] ); ?>"
				id="<?php echo esc_attr( $arg['label_for'] ); ?>"><?php
					echo esc_html( Dashed_Slug_Wallets::get_option( $arg['label_for'] ) ); ?></textarea>
			<p id="<?php echo esc_attr( $arg['label_for'] ); ?>-description" class="description"><?php
			echo esc_html( $arg['description'] ); ?></p><?php
		}

		public function wallets_email_section_cb() {
			?><p><?php esc_html_e( 'Here you can choose whether users receive e-mail notifications on this event. ' .
				'You can also edit the template used to produce the email subject line and text body. ' .
				'You can use the available variable substitutions in both the subject line and the message body.', 'wallets'); ?></p><?php
		}

		public function action_withdraw( $row ) {
			if ( Dashed_Slug_Wallets::get_option( 'wallets_email_withdraw_enabled' ) ) {
				$user = get_userdata( $row->account );
				$row->account = $user->user_login;

				$this->notify_user_by_email(
					$user->user_email,
					Dashed_Slug_Wallets::get_option( 'wallets_email_withdraw_subject' ),
					Dashed_Slug_Wallets::get_option( 'wallets_email_withdraw_message' ),
					$row
				);
			}
		}

		public function action_withdraw_failed( $row ) {
			if ( Dashed_Slug_Wallets::get_option( 'wallets_email_withdraw_failed_enabled' ) ) {
				$user = get_userdata( $row->account );
				$row->account = $user->user_login;

				$this->notify_user_by_email(
					$user->user_email,
					Dashed_Slug_Wallets::get_option( 'wallets_email_withdraw_failed_subject' ),
					Dashed_Slug_Wallets::get_option( 'wallets_email_withdraw_failed_message' ),
					$row
				);
			}
		}

		public function action_move_send( $row ) {
			if ( Dashed_Slug_Wallets::get_option( 'wallets_email_move_send_enabled' ) ) {
				$sender = get_userdata( $row->account );
				$recipient = get_userdata( $row->other_account );

				$row->account = $sender->user_login;
				$row->other_account = $recipient->user_login;

				$this->notify_user_by_email(
					$sender->user_email,
					Dashed_Slug_Wallets::get_option( 'wallets_email_move_send_subject' ),
					Dashed_Slug_Wallets::get_option( 'wallets_email_move_send_message' ),
					$row
				);
			}
		}

		public function action_move_send_failed( $row ) {
			if ( Dashed_Slug_Wallets::get_option( 'wallets_email_move_send_failed_enabled' ) ) {
				$sender = get_userdata( $row->account );
				$recipient = get_userdata( $row->other_account );

				$row->account = $sender->user_login;
				$row->other_account = $recipient->user_login;

				$this->notify_user_by_email(
					$sender->user_email,
					Dashed_Slug_Wallets::get_option( 'wallets_email_move_send_failed_subject' ),
					Dashed_Slug_Wallets::get_option( 'wallets_email_move_send_failed_message' ),
					$row
				);
			}
		}

		public function action_move_receive( $row ) {
			if ( Dashed_Slug_Wallets::get_option( 'wallets_email_move_receive_enabled' ) ) {
				$recipient = get_userdata( $row->account );
				$sender = get_userdata( $row->other_account );

				$row->account = $recipient->user_login;
				$row->other_account = $sender->user_login;
				unset( $row->fee );

				$this->notify_user_by_email(
					$recipient->user_email,
					Dashed_Slug_Wallets::get_option( 'wallets_email_move_receive_subject' ),
					Dashed_Slug_Wallets::get_option( 'wallets_email_move_receive_message' ),
					$row
				);
			}
		}

		public function action_deposit( $row ) {
			if ( Dashed_Slug_Wallets::get_option( 'wallets_email_deposit_enabled' ) ) {
				$user = get_userdata( $row->account );
				$row->account = $user->user_login;

				$this->notify_user_by_email(
					$user->user_email,
					Dashed_Slug_Wallets::get_option( 'wallets_email_deposit_subject' ),
					Dashed_Slug_Wallets::get_option( 'wallets_email_deposit_message' ),
					$row
				);
			}
		}

		private function notify_user_by_email( $email, $subject, $message, &$row ) {
			unset( $row->category );
			unset( $row->updated_time );

			// use pattern for displaying amounts
			if ( isset( $row->symbol ) ) {
				try {
					$adapter = Dashed_Slug_Wallets::get_instance()->get_coin_adapters( $row->symbol, false );
					$sprintf = $adapter->get_sprintf();
				} catch ( Exception $e ) {
					$sprintf = '%01.8F';
				}

				if ( isset( $row->amount ) ) {
					$row->amount = sprintf( $sprintf, $row->amount );
				}
				if ( isset( $row->fee ) ) {
					$row->fee = sprintf( $sprintf, $row->fee );
				}
			}


			// variable substitution
			foreach ( $row as $field => $val ) {
				$subject = str_replace( '###' . strtoupper( $field ) . '###', $val, $subject );
				$message = str_replace( '###' . strtoupper( $field ) . '###', $val, $message );
			}

			try {
				wp_mail(
					$email,
					$subject,
					$message
				);
			} catch ( Exception $e ) {
				$this->_notices->error(
					__( "The following errors occured while sending notification email to $email: ", 'wallets' ) .
					$e->getMessage()
				);
			}
		}

	}

	new Dashed_Slug_Wallets_Email();
}