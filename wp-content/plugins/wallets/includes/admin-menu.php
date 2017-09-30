<?php

/**
 * This is the main "Wallets" admin screen that features the coin adapters list. The list itself is implemented in admin-menu-adapter-list.php .
 */

// don't load directly
defined( 'ABSPATH' ) || die( '-1' );

if ( ! class_exists( 'Dashed_Slug_Wallets_Admin_Menu' ) ) {
	class Dashed_Slug_Wallets_Admin_Menu {

		public function __construct() {
			add_action( is_plugin_active_for_network( 'wallets/wallets.php' ) ? 'network_admin_menu' : 'admin_menu', array( &$this, 'action_admin_menu' ) );

			add_filter( 'upload_mimes', array( &$this, 'custom_upload_mimes' ) );
		}

		function custom_upload_mimes( $existing_mimes=array() ) {
			$existing_mimes['csv'] = 'text/csv';
			return $existing_mimes;
		}

		public function action_admin_menu() {

			if ( current_user_can( 'manage_wallets' ) ) {
				add_menu_page(
					'Bitcoin and Altcoin Wallets',
					__( 'Wallets' ),
					'manage_wallets',
					'wallets-menu-wallets',
					array( &$this, 'wallets_page_cb' ),
					plugins_url( 'assets/sprites/wallet-icon.png', DSWALLETS_PATH . '/wallets.php' )
				);

				add_submenu_page(
					'wallets-menu-wallets',
					'Bitcoin and Altcoin Wallets',
					__( 'About' ),
					'manage_wallets',
					'wallets-menu-wallets',
					array( &$this, 'wallets_page_cb' )
				);

				do_action( 'wallets_admin_menu' );
			}
		}

		public function wallets_page_cb() {
			if ( ! current_user_can( 'manage_wallets' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
			} ?>


			<h1><?php echo 'Bitcoin and Altcoin Wallets' ?></h1>

			<div class="notice notice-warning"><h2><?php
			esc_html_e( 'IMPORTANT SECURITY DISCLAIMER:', 'wallets' ); ?></h2>

			<p><?php esc_html_e( 'By using this free plugin you accept all responsibility for handling ' .
			'the account balances for all your users. Under no circumstances is dashed-slug.net ' .
			'or any of its affiliates responsible for any damages incurred by the use of this plugin. ' .
			'Every effort has been made to harden the security of this plugin, ' .
			'but its safe operation is your responsibility and depends on your site being secure overall. ' .
			'You, the administrator, must take all necessary precautions to secure your WordPress installation ' .
			'before you connect it to any live wallets. ' .
			'You are strongly advised to take the following actions (at a minimum):', 'wallets'); ?></p>
			<ol><li><a href="https://codex.wordpress.org/Hardening_WordPress" target="_blank"><?php
			esc_html_e( 'educate yourself about hardening WordPress security', 'wallets' ); ?></a></li>
			<li><a href="https://infinitewp.com/addons/wordfence/?ref=260" target="_blank" title="<?php esc_attr_e(
				'This affiliate link supports the development of dashed-slug.net plugins. Thanks for clicking.', 'wallets' );
			?>"><?php esc_html_e( 'install a security plugin such as Wordfence', 'wallets' ); ?></a></li>
			<li><?php esc_html_e( 'Enable SSL on your site, if you have not already done.', 'wallets' );
			?></li><li><?php esc_html_e( 'If you are connecting to an RPC API on a different machine than that ' .
			'of your WordPress server over an untrusted network, make sure to tunnel your connection via ssh or stunnel.',
			'wallets' ); ?> <a href="https://en.bitcoin.it/wiki/Enabling_SSL_on_original_client_daemon"><?php
			esc_html_e( 'See more here', 'wallets' ); ?></a>.</li></ol><p><?php
			esc_html_e( 'By continuing to use the Bitcoin and Altcoin Wallets plugin, ' .
			'you indicate that you have understood and agreed to this disclaimer.', 'wallets' );
			?></p></div>

			<div class="card">
				<h2><?php esc_html_e( 'Follow the slime:', 'wallets' ); ?></h2>

				<h4><?php esc_html_e( 'Subscribe to the YouTube channel:', 'wallets' ); ?></h4>

				<div class="g-ytsubscribe" data-channelid="UCZ1XhSSWnzvB2B_-Cy1tTjA" data-layout="full" data-count="default"></div>

				<h4><?php esc_html_e( '+1 the Google+ page to learn the latest news:', 'wallets' ); ?></h4>

				<div class="g-follow" data-annotation="bubble" data-height="24" data-href="//plus.google.com/u/0/103549774963556626441" data-rel="publisher"></div>

				<h4><?php esc_html_e( 'Like the Facebook page to learn the latest news:', 'wallets' ); ?></h4>

				<iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdashedslug%2F&tabs=timeline&width=500&height=500&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=false&appId=1048870338583588" width="500" height="500" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true"></iframe>
			</div>

			<div class="card">
				<h2><?php esc_html_e( 'Download cool plugin extensions:', 'wallets' ); ?></h2>

				<p><?php esc_html_e( 'Bitcoin and Altcoin Wallets is a plugin that offers basic deposit-transfer-withdraw functionality. ', 'wallets' ); ?></p>

				<p><?php esc_html_e( 'You can install', 'wallets' ); ?></p>
				<ol>
					<li><?php esc_html_e( '"coin adapters" to make the plugin talk with other cryptocurrencies. ', 'wallets' ); ?></li>
					<li><?php esc_html_e( '"app extensions". App extensions are plugins that utilize the core API ' .
									'to supply some user functionality. ', '/& @echo slug */' ); ?></li>
				</ol>

				<p><a href="<?php echo 'https://www.dashed-slug.net/bitcoin-altcoin-wallets-wordpress-plugin'; ?>" target="_blank">
						<?php esc_html_e( 'Visit the dashed-slug to see what\'s available', 'wallets' ); ?>
				</a></p>
			</div>

			<div class="card">
				<h2><?php esc_html_e( 'Have your say!', 'wallets' ); ?></h2>

				<ol>
					<li><?php echo __( 'Did you find this plugin useful? Leave a review on <a href="https://wordpress.org/support/plugin/wallets/reviews/">wordpress.org</a>.', 'wallets' ); ?></li>
					<li><?php echo __( 'Do you need help? Did you find a bug? Visit the <a href="https://wordpress.org/support/plugin/wallets">wordpress.org support forum</a> for the main plugin or the <a href="https://www.dashed-slug.net/support/">dashed-slug.net</a> support forums for the extensions.', 'wallets' ); ?></li>
					<li><?php echo __( 'Something else on your mind? <a href="https://dashed-slug.net/contact">Contact me</a>.', 'wallets' ); ?></li>
				</ol>
			</div>

			<div class="card">
				<h2><?php esc_html_e( 'Show your appreciation with a donation!', 'wallets' ); ?></h2>

				<p><?php esc_html_e( 'Want to help with development? Help me buy the coffee that makes this all possible!', 'wallets' ); ?></p>

				<ol>
					<li><?php echo __( 'Donate via <a href="https://flattr.com/profile/dashed-slug">flattr</a>', '/* @echo slug *' ); ?>.</li>
					<li><?php echo __( 'Donate a few shatoshi to the dashed-slug Bitcoin address: ' .
						'<a href="bitcoin:1DaShEDyeAwEc4snWq14hz5EBQXeHrVBxy?label=dashed-slug&message=donation">1DaShEDyeAwEc4snWq14hz5EBQXeHrVBxy</a>.', '/* @echo slug *' ); ?></li>
				</ol>

				<p><?php esc_html_e( 'Your support is greatly appreciated.', 'wallets' ); ?></p>
			</div>

			<div style="clear: left;"></div>
			<?php
		}


	}
	new Dashed_Slug_Wallets_Admin_Menu();
}

