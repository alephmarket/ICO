<?php
/**
 * This interfaces to a standalone Bitcoin node. It is the only built-in coin adapter. You can provide more coin adapters
 * with plugin extensions.
 *
 * @package wallets
 * @since 1.0.0
 */

// don't load directly
defined( 'ABSPATH' ) || die( '-1' );

if ( ! class_exists( 'Bitcoin' ) ) {
	include_once ( DSWALLETS_PATH . '/EasyBitcoin-PHP/easybitcoin.php' );
}

if ( ! class_exists( 'Dashed_Slug_Wallets_Coin_Adapter_Bitcoin' ) ) {

	final class Dashed_Slug_Wallets_Coin_Adapter_Bitcoin extends Dashed_Slug_Wallets_Coin_Adapter_RPC {

		// helpers

		/** Overrides the base function because alertnotify is deprecated in Bitcoin
		 *
		 * {@inheritDoc}
		 * @see Dashed_Slug_Wallets_Coin_Adapter_RPC::get_recommended_config()
		 */
		protected function get_recommended_config() {
			$wallet_url = site_url( 'wallets/notify/' . $this->get_symbol() . '/wallet/%s' );
			$block_url = site_url( 'wallets/notify/' . $this->get_symbol(). '/block/%s' );
			$wp_ip = self::server_ip();
			$user = Dashed_Slug_Wallets::get_option( "{$this->option_slug}-rpc-user" );
			$port = intval( Dashed_Slug_Wallets::get_option( "{$this->option_slug}-rpc-port" ) );

			return <<<CFG
server=1
rpcallowip=127.0.0.1
rpcallowip=$wp_ip
rpcport=$port
walletnotify=curl -s $wallet_url >/dev/null
blocknotify=curl -s $block_url >/dev/null
rpcuser=$user
rpcpassword=ENTER_SECRET_RPC_PASSWORD_HERE
CFG;
		}

		// settings api

		// section callbacks

		/** @internal */
		public function section_fees_cb() {
			if ( ! current_user_can( 'manage_wallets' ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
			}

			?><p><?php esc_html_e( 'You can set two types of fees:', 'wallets'); ?></p>
				<ul>
					<li>
						<strong><?php esc_html_e( 'Transaction fees', 'wallets' )?></strong> &mdash;
						<?php esc_html_e( 'These are the fees a user pays when they send funds to other users.', 'wallets' )?>
					</li><li>
						<p><strong><?php esc_html_e( 'Withdrawal fees', 'wallets' )?></strong> &mdash;
						<?php esc_html_e( 'This the amount that is subtracted from a user\'s account in addition to the amount that they send to another address on the blockchain.', 'wallets' )?></p>
						<p><?php echo __( 'Fees are calculated as: <i>total_fees = fixed_fees + amount * proportional_fees</i>.', 'wallets' ); ?></p>
						<p class="card"><?php esc_html_e( 'This withdrawal fee is NOT the network fee, and you are advised to set the withdrawal fee to an amount that will cover the network fee of a typical transaction, possibly with some slack that will generate profit. To control network fees use the wallet settings in bitcoin.conf: paytxfee, mintxfee, maxtxfee, etc.', 'wallets' ) ?>
						<a href="https://en.bitcoin.it/wiki/Running_Bitcoin" target="_blank"><?php esc_html_e( 'Refer to the documentation for details.', 'wallets' )?></a></p>
					</li>
				</ul><?php
		}

		// input field callbacks

		// API

		public function get_adapter_name() {
			return 'Bitcoin core node';
		}

		public function get_name() {
			return 'Bitcoin';
		}

		public function get_sprintf() {
			return mb_convert_encoding('&#x0E3F;', 'UTF-8', 'HTML-ENTITIES') . '%01.8f';
		}

		public function get_symbol() {
			return 'BTC';
		}

		public function get_icon_url() {
			return plugins_url( '../assets/sprites/bitcoin-logo.png', __FILE__ );
		}

		// notification API implementation

		/**
		 * Overrides the base function because alertnotify is deprecated in Bitcoin
		 *
		 * {@inheritDoc}
		 * @see Dashed_Slug_Wallets_Coin_Adapter_RPC::action_wallets_notify_alert()
		 */
		public function action_wallets_notify_alert( $message ) {
			// Alerts have been deprecated in Bitcoin
		}

		// cron implementation

		public function cron() {
			try {
				$this->cron_scrape_listtransactions();
				$this->cron_scrape_listreceivedbyaddress();
			} catch ( Exception $e ) {
				// bittiraha lightweight wallet only implements listunspent, not listtransactions or listreceivedbyaddress
				$this->cron_scrape_listunspent();
			}
		}

	} // end class Dashed_Slug_Wallets_Coin_Adapter_Bitcoin

} // end if class not exists
