<?php

// don't load directly
defined( 'ABSPATH' ) || die( '-1' );

if ( 'wallets-menu-transactions' == filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING ) ) {
	include_once( 'transactions-list.php' );
}

if ( ! class_exists( 'Dashed_Slug_Wallets_TXs' ) ) {
	class Dashed_Slug_Wallets_TXs {

		public static $tx_columns = 'category,account,other_account,address,txid,symbol,amount,fee,comment,created_time,updated_time,confirmations,tags,blog_id,status,retries,admin_confirm,user_confirm';

		public function __construct() {
			add_action( 'wallets_admin_menu', array( &$this, 'action_admin_menu' ) );
			add_action( 'init', array( &$this, 'import_handler' ) );
			add_action( 'admin_init', array( &$this, 'actions_handler' ) );
			add_action( 'admin_init', array( &$this, 'redirect_if_no_sort_params' ) );


			// these actions record a transaction or address to the DB
			add_action( 'wallets_transaction',	array( &$this, 'action_wallets_transaction' ) );
			add_action( 'wallets_address',	array( &$this, 'action_wallets_address' ) );

			// these are attached to the cron job and process transactions
			add_action( 'wallets_periodic_checks', array( &$this, 'cron' ) );
		}

		public function cron() {
			if ( is_plugin_active_for_network( 'wallets/wallets.php' ) ) {

				global $wpdb;
				foreach ( $wpdb->get_col( "SELECT blog_id FROM $wpdb->blogs" ) as $blog_id ) {
					switch_to_blog( $blog_id );
					$this->fail_transactions();
					$this->execute_pending_moves();
					$this->execute_pending_withdrawals();
					restore_current_blog();
				}
			} else {
				$this->fail_transactions();
				$this->execute_pending_moves();
				$this->execute_pending_withdrawals();
			}
		}

		public function redirect_if_no_sort_params() {
			// make sure that sorting params are set
			if ( 'wallets-menu-transactions' == filter_input( INPUT_GET, 'page', FILTER_SANITIZE_STRING ) ) {
				if ( ! filter_input( INPUT_GET, 'order', FILTER_SANITIZE_STRING ) || ! filter_input( INPUT_GET, 'orderby', FILTER_SANITIZE_STRING ) ) {
					wp_redirect(
						add_query_arg(
							array(
								'page' => 'wallets-menu-transactions',
								'order' => 'desc',
								'orderby' => 'created_time',
							),
							call_user_func( is_plugin_active_for_network( 'wallets/wallets.php' ) ? 'network_admin_url' : 'admin_url', 'admin.php' )
						)
					);
					exit;
				}
			}
		}

		public function action_admin_menu() {
			if ( current_user_can( 'manage_wallets' ) ) {
				add_submenu_page(
					'wallets-menu-wallets',
					'Bitcoin and Altcoin Wallets Transactions',
					'Transactions',
					'manage_wallets',
					'wallets-menu-transactions',
					array( &$this, "wallets_txs_page_cb" )
				);
			}
		}

		public function wallets_txs_page_cb() {
			if ( ! current_user_can( Dashed_Slug_Wallets_Capabilities::MANAGE_WALLETS ) )  {
				wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
			}

			$txs_list = new DSWallets_Admin_Menu_TX_List();

			?><h1><?php esc_html_e( 'Bitcoin and Altcoin Wallets Transactions', 'wallets' ); ?></h1>

			<?php if ( isset( $_GET['updated'] ) ):
			?><div class="updated notice is-dismissible"><p><?php
				esc_html_e( 'Transaction updated.', 'wallets' );
			?></p></div><?php endif; ?>

			<div class="wrap"><?php
				$txs_list->prepare_items();
				$txs_list->display();
			?></div>

			<h2><?php echo esc_html_e( 'Import transactions from csv', 'wallets' ) ?></h2>
			<form class="card" method="post" enctype="multipart/form-data">
				<p><?php esc_html_e( 'You can use this form to upload transactions that you have exported previously. ' .
					'Pending transactions will be skipped if they have not been assigned a blockchain TXID. ' .
					'Transactions that are completed will be imported, unless if they already exist in your DB.', 'wallets' ); ?></p>
				<input type="hidden" name="action" value="import" />
				<input type="file" name="txfile" />
				<input type="submit" value="<?php esc_attr_e( 'Import', 'wallets' ) ?>" />
				<?php wp_nonce_field( 'wallets-import' ); ?>
			</form>

			<?php
		}

		public function fail_transactions() {
			global $wpdb;

			$table_name_txs = Dashed_Slug_Wallets::$table_name_txs;

			$fail_txs_update_query = $wpdb->prepare(
				"
				UPDATE
					{$table_name_txs}
				SET
					status = 'failed',
					updated_time = %s
				WHERE
					( blog_id = %d || %d ) AND
					status = 'pending' AND
					retries < 1
				",
				current_time( 'mysql', true ),
				get_current_blog_id(),
				is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0
			);

			$wpdb->query( $fail_txs_update_query );
		}


		public function execute_pending_moves() {
			$batch_size = Dashed_Slug_Wallets::get_option( 'wallets_cron_batch_size', 8 );

			global $wpdb;
			$table_name_txs = Dashed_Slug_Wallets::$table_name_txs;
			$table_name_adds = Dashed_Slug_Wallets::$table_name_adds;
			$table_name_options = is_plugin_active_for_network( 'wallets/wallets.php' ) ? $wpdb->sitemeta : $wpdb->options;

			$move_txs_send_query = $wpdb->prepare(
				"
				SELECT
					*
				FROM
					{$table_name_txs}
				WHERE
					( blog_id = %d || %d ) AND
					category = 'move' AND
					status = 'pending' AND
					retries > 0 AND
					amount < 0
				ORDER BY
					created_time ASC
				LIMIT
					%d
				",
				get_current_blog_id(),
				is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
				$batch_size
			);

			$move_txs_send =  $wpdb->get_results( $move_txs_send_query );

			foreach ( $move_txs_send as $move_tx_send ) {

				if ( preg_match( '/^(move-.*)-send$/', $move_tx_send->txid, $matches ) ) {
					$id_prefix = $matches[1];

					$move_tx_receive_query = $wpdb->prepare(
						"
						SELECT
							*
						FROM
							{$table_name_txs}
						WHERE
							( blog_id = %d || %d ) AND
							category = 'move' AND
							symbol = %s AND
							status = 'pending' AND
							amount > 0 AND
							txid = %s
						LIMIT 1
						",
						get_current_blog_id(),
						is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
						$move_tx_send->symbol,
						"$id_prefix-receive"
					);

					$move_tx_receive = $wpdb->get_row( $move_tx_receive_query );

					if ( ! is_null( $move_tx_receive ) ) {
						$current_time_gmt = current_time( 'mysql', true );

						$wpdb->query( "
							LOCK TABLES
								$table_name_txs WRITE,
								$table_name_options WRITE,
								$table_name_adds READ
						" );

						$balance_query = $wpdb->prepare(
							"
							SELECT
								SUM(amount)
							FROM
								{$table_name_txs}
							WHERE
								( blog_id = %d || %d ) AND
								status = 'done' AND
								symbol = %s AND
								account = %d
							",
							get_current_blog_id(),
							is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
							$move_tx_send->symbol,
							$move_tx_send->account
						);

						$balance = $wpdb->get_var( $balance_query );

						if ( ! is_null( $balance ) ) {

							if ( ( floatval( $balance ) + floatval( $move_tx_send->amount ) ) >= 0 ) {

								$success_update_query = $wpdb->prepare(
									"
										UPDATE
											{$table_name_txs}
										SET
											status = 'done',
											retries = retries - 1,
											updated_time = %s
										WHERE
											( blog_id = %d || %d ) AND
											status = 'pending' AND
											txid IN ( %s, %s )
									",
									$current_time_gmt,
									get_current_blog_id(),
									is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
									$move_tx_send->txid,
									$move_tx_receive->txid
								);

								$wpdb->query( $success_update_query );

								$wpdb->query( "UNLOCK TABLES" );

								do_action( 'wallets_move_send', $move_tx_send );
								do_action( 'wallets_move_receive', $move_tx_receive );

							} else {

								$success_update_query = $wpdb->prepare(
									"
									UPDATE
										{$table_name_txs}
									SET
										status = %s,
										retries = retries - 1,
										updated_time = %s
									WHERE
										( blog_id = %d || %d ) AND
										status = 'pending' AND
										txid IN ( %s, %s )
									",
									$move_tx_send->retries > 1 ? 'pending' : 'failed',
									$current_time_gmt,
									get_current_blog_id(),
									is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
									$move_tx_send->txid,
									$move_tx_receive->txid
								);

								$wpdb->query( $success_update_query );

								$wpdb->query( "UNLOCK TABLES" );

								if ( $move_tx_send->retries == 1 ) {
									do_action( 'wallets_move_send_failed', $move_tx_send );
								}
							}
						}
					}
				}
			}
		}

		public function execute_pending_withdrawals() {
			$batch_size = Dashed_Slug_Wallets::get_option( 'wallets_cron_batch_size', 8 );

			global $wpdb;

			$table_name_txs = Dashed_Slug_Wallets::$table_name_txs;
			$table_name_adds = Dashed_Slug_Wallets::$table_name_adds;
			$table_name_options = is_plugin_active_for_network( 'wallets/wallets.php' ) ? $wpdb->sitemeta : $wpdb->options;

			$wd_txs_query = $wpdb->prepare(
				"
				SELECT
					*
				FROM
					{$table_name_txs}
				WHERE
					( blog_id = %d || %d ) AND
					category = 'withdraw' AND
					status = 'pending' AND
					retries > 0
				ORDER BY
					created_time ASC
				LIMIT
					%d
				",
				get_current_blog_id(),
				is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
				$batch_size
			);

			$wd_txs =  $wpdb->get_results( $wd_txs_query );

			foreach ( $wd_txs as $wd_tx ) {

				$wpdb->query( "
					LOCK TABLES
						$table_name_txs WRITE,
						$table_name_options WRITE,
						$table_name_adds READ,
						$wpdb->users u READ
				" );


				$txid = null;
				try {
					$deposit_address = $wpdb->get_row( $wpdb->prepare(
						"
						SELECT
							account
						FROM
							{$table_name_adds}
						WHERE
							( blog_id = %d || %d ) AND
							symbol = %s AND
							address = %s
						ORDER BY
							created_time DESC
						LIMIT 1
						",
						get_current_blog_id(),
						is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
						$wd_tx->symbol,
						$wd_tx->address
					) );

					if ( ! is_null( $deposit_address ) ) {

						throw new Exception(
							sprintf(
								__( 'Cannot withdraw to address %s because it is a deposit address on this system.', 'wallets' ),
								$wd_tx->address ),
							Dashed_Slug_Wallets::ERR_DO_WITHDRAW );
					}

					$balance_query = $wpdb->prepare(
						"
						SELECT
							SUM(amount)
						FROM
							{$table_name_txs}
						WHERE
							( blog_id = %d || %d ) AND
							symbol = %s AND
							status = 'done' AND
							account = %d
						",
						get_current_blog_id(),
						is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
						$wd_tx->symbol,
						$wd_tx->account
					);

					$balance = $wpdb->get_var( $balance_query );

					if ( is_null( $balance ) ) {
						throw new Exception( 'Could not get balance' );
					}

					if ( ( floatval( $balance ) + floatval( $wd_tx->amount ) ) < 0 ) {
						throw new Exception( 'Insufficient balance' );
					}

					$adapter = Dashed_Slug_Wallets::get_instance()->get_coin_adapters( $wd_tx->symbol );

					$txid = $adapter->do_withdraw(
						$wd_tx->address,
						- $wd_tx->amount - $wd_tx->fee,
						$wd_tx->comment
					);

					if ( ! is_string( $txid ) ) {
						throw new Exception( 'Adapter did not return with transaction ID' );
					}

					$success_query = $wpdb->prepare(
						"
						UPDATE
							{$table_name_txs}
						SET
							status = 'done',
							txid = %s
						WHERE
							id = %d
						",
						$txid,
						$wd_tx->id
					);

					$wpdb->query( $success_query );

					$wpdb->query( "UNLOCK TABLES" );

					$wd_tx->txid = $txid;
					do_action( 'wallets_withdraw', $wd_tx );

				} catch ( Exception $e ) {

					$fail_query = $wpdb->prepare(
						"
						UPDATE
							{$table_name_txs}
						SET
							status = %s,
							retries = retries - 1
						WHERE
							id = %d
						",
						$wd_tx->retries > 1 ? 'pending' : 'failed',
						$wd_tx->id
					);

					$wpdb->query( $fail_query );

					$wpdb->query( "UNLOCK TABLES" );

					if ( $wd_tx->retries <= 1 ) {
						$wd_tx->last_error = $e->getMessage();
						do_action( 'wallets_withdraw_failed', $wd_tx );
					}
				}
			}
		}

		/**
		 * Handler attached to the action wallets_transaction. Coin adapters perform this action to notify about
		 * new transactions and transaction updates.
		 *
		 * This function adds new pending deposits to the database, or updates confirmation counts
		 * for existing deposits and withdrawals.
		 *
		 * $tx->category One of 'deposit', 'withdraw'
		 * $tx->address The blockchain address
		 * $tx->txid The blockchain transaction ID
		 * $tx->symbol The coin symbol
		 * $tx->amount The amount
		 * $tx->fee The blockchain fee
		 * $tx->comment A comment
		 * $tx->confirmations Blockchain confirmation count
		 *
		 * @internal
		 * @param stdClass $tx The transaction details.
		 */
		public function action_wallets_transaction( $tx ) {
			try {
				$adapter = Dashed_Slug_Wallets::get_instance()->get_coin_adapters( $tx->symbol, false );
			} catch ( Exception $e ) {
				error_log( __FUNCTION__ . ": Adapter for transaction $tx->txid is not online" );
				return;
			}

			if ( $adapter ) {

				if ( ! isset( $tx->created_time ) ) {
					$tx->created_time = time();
				}

				if ( is_numeric( $tx->created_time ) ) {
					$tx->created_time = date( DATE_ISO8601, $tx->created_time );
				}

				$current_time_gmt = current_time( 'mysql', true );
				$table_name_txs = Dashed_Slug_Wallets::$table_name_txs;

				global $wpdb;

				if ( isset( $tx->category ) ) {

					if ( 'deposit' == $tx->category ) {
						try {
							$tx->account = $this->get_account_id_for_address( $tx->symbol, $tx->address );
						} catch ( Exception $e ) {
							// we don't know about this address - ignore it
							return;
						}

						$where = array(
							'txid' => $tx->txid,
						);

						if ( ! is_plugin_active_for_network( 'wallets/wallets.php' ) ) {
							$where['blog_id'] = get_current_blog_id();
						}

						$affected = $wpdb->update(
							Dashed_Slug_Wallets::$table_name_txs,
							array(
								'updated_time' => $current_time_gmt,
								'confirmations'	=> isset( $tx->confirmations ) ? $tx->confirmations : 0,
								'status' => $adapter->get_minconf() > $tx->confirmations ? 'pending' : 'done',
							),
							$where,
							array(
								'%s', '%d', '%s'
							)
						);

						if ( ! $affected ) {
							$new_tx_data = array(
								'blog_id' => get_current_blog_id(),
								'category' => 'deposit',
								'account' => $tx->account,
								'address' => $tx->address,
								'txid' => $tx->txid,
								'symbol' => $tx->symbol,
								'amount' => $tx->amount,
								'created_time' => $tx->created_time,
								'updated_time' => $current_time_gmt,
								'confirmations'	=> isset( $tx->confirmations ) ? $tx->confirmations : 0,
								'status' => $adapter->get_minconf() > $tx->confirmations ? 'pending' : 'done',
								'retries' => 255
							);

							if ( isset( $tx->fee ) ) {
								$new_tx_data['fee'] = $tx->fee;
							}

							$affected = $wpdb->insert(
								Dashed_Slug_Wallets::$table_name_txs,
								$new_tx_data,
								array(
									'%d', '%s', '%d', '%s', '%s', '%s', '%20.10f', '%s', '%s', '%d', '%s', '%d'
								)
							);

							if ( 1 === $affected ) {
								// row was inserted, not updated
								do_action( 'wallets_deposit', $tx );
							}
						}

					} elseif ( 'withdraw' == $tx->category ) {
						$where = array(
							'address' => $tx->address,
							'txid' => $tx->txid,
						);

						if ( ! is_plugin_active_for_network( 'wallets/wallets.php' ) ) {
							$where['blog_id'] = get_current_blog_id();
						}

						$affected = $wpdb->update(
							Dashed_Slug_Wallets::$table_name_txs,
							array(
								'updated_time'	=> $current_time_gmt,
								'confirmations'	=> $tx->confirmations,
							),
							$where,
							array( '%s', '%d' ),
							array( '%s', '%s', '%d' )
						);


						if ( ! $affected && isset( $tx->account ) )  {
							// Old transactions that are rediscovered via cron do not normally have an account id and cannot be inserted.
							// Will now try to record as new withdrawal since this is not an existing transaction.

							$new_tx_data = array(
								'blog_id' => get_current_blog_id(),
								'category' => 'withdraw',
								'account' => $tx->account,
								'address' => $tx->address,
								'txid' => $tx->txid,
								'symbol' => $tx->symbol,
								'amount' => $tx->amount,
								'fee' => $tx->fee,
								'comment' => $tx->comment,
								'created_time' => $tx->created_time,
								'confirmations'	=> isset( $tx->confirmations ) ? $tx->confirmations : 0,
								'status' => 'unconfirmed',
								'retries' => Dashed_Slug_Wallets::get_option( 'wallets_retries_withdraw', 3 )
							);

							$affected = $wpdb->insert(
								Dashed_Slug_Wallets::$table_name_txs,
								$new_tx_data,
								array( '%d', '%s', '%d', '%s', '%s', '%s', '%20.10f', '%20.10f', '%s', '%s', '%d', '%s', '%d' )
							);

							if ( ! $affected ) {
								error_log( __FUNCTION__ . " Transaction $txid was not inserted! " . print_r( $new_tx_data, true ) );
							}
						}
					} // end if category == withdraw
				} // end if isset category
			} // end if false !== $adapter
		} // end function action_wallets_transaction()

		/**
		 * Handler attached to the action wallets_address.
		 *
		 * Called by core or the coin adapter when a new user-address mapping is seen..
		 * Adds the link between an address and a user.
		 * Core should always record new addresses. Adapters that choose to notify about
		 * user-address mappings do so as a failsafe mechanism only. Addresses that have
		 * already been assigned are not reaassigned because the address column is UNIQUE
		 * on the DB.
		 *
		 * @internal
		 * @param stdClass $tx The address mapping.
		 */
		public function action_wallets_address( $address ) {
			global $wpdb;
			$table_name_adds = Dashed_Slug_Wallets::$table_name_adds;

			if ( ! isset( $address->created_time ) ) {
				$address->created_time = time();
			}

			if ( is_numeric( $address->created_time ) ) {
				$address->created_time = date( DATE_ISO8601, $address->created_time );
			}

			// Disable errors about duplicate inserts, since $wpdb has no INSERT IGNORE
			$suppress_errors = $wpdb->suppress_errors;
			$wpdb->suppress_errors();

			$wpdb->insert(
				$table_name_adds,
				array(
					'blog_id' => get_current_blog_id(),
					'account' => $address->account,
					'symbol' => $address->symbol,
					'address' => $address->address,
					'created_time' => $address->created_time
				),
				array( '%d', '%d', '%s', '%s', '%s' )
			);

			$wpdb->suppress_errors( $suppress_errors );
		}

		/**
		 * Account ID corresponding to an address.
		 *
		 * Returns the WordPress user ID for the account that has the specified address in the specified coin's wallet.
		 *
		 * @since 2.1.0 Added $check_capabilities argument
		 * @since 1.0.0 Introduced
		 * @param string $symbol (Usually) three-letter symbol of the wallet's coin.
		 * @param string $address The address
		 * @param bool $check_capabilities Capabilities are checked if set to true. Default: false.
		 * @throws Exception If the address is not associated with an account.
		 * @throws Exception If the operation fails. Exception code will be one of Dashed_Slug_Wallets::ERR_*.
		 * @return integer The WordPress user ID for the account found.
		 */
		public function get_account_id_for_address( $symbol, $address, $check_capabilities = false ) {
			global $wpdb;

			if (
				$check_capabilities &&
				! current_user_can( Dashed_Slug_Wallets_Capabilities::HAS_WALLETS )
				) {
					throw new Exception( __( 'Not allowed', 'wallets' ), Dashed_Slug_Wallets::ERR_NOT_ALLOWED );
				}

				$table_name_adds = Dashed_Slug_Wallets::$table_name_adds;
				$account = $wpdb->get_var( $wpdb->prepare(
					"
					SELECT
						account
					FROM
						$table_name_adds a
					WHERE
						( blog_id = %d || %d ) AND
						symbol = %s AND
						address = %s
					ORDER BY
						created_time DESC
					LIMIT 1
					",
					get_current_blog_id(),
					is_plugin_active_for_network( 'wallets/wallets.php' ) ? 1 : 0,
					$symbol,
					$address
				) );

				if ( is_null( $account ) ) {
					throw new Exception( sprintf( __( 'Could not get account for %s address %s', 'wallets' ), $symbol, $address ), Dashed_Slug_Wallets::ERR_GET_COINS_INFO );
				}

				return intval( $account );
		}

		public function import_handler() {
			$action = filter_input( INPUT_POST, 'action', FILTER_SANITIZE_STRING );

			if ( 'import' == $action && isset( $_FILES['txfile'] ) ) {
				if ( ! current_user_can( 'manage_wallets' ) )  {
					wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
				}

				$nonce = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );

				if ( ! wp_verify_nonce( $nonce, "wallets-import" ) ) {
					wp_die( __( 'Possible request forgery detected. Please reload and try again.', 'wallets' ) );
				}

				$notices = Dashed_Slug_Wallets_Admin_Notices::get_instance();

				if ( ! function_exists( 'wp_handle_upload' ) ) {
					require_once( ABSPATH . 'wp-admin/includes/file.php' );
				}

				$uploaded_file = $_FILES[ 'txfile' ];
				$upload_overrides = array( 'action' => 'import' );
				$moved_file = wp_handle_upload( $uploaded_file, $upload_overrides );
				if ( $moved_file && ! isset( $moved_file['error'] ) ) {
					$moved_file_name = $moved_file['file'];

					$result = $this->csv_import( $moved_file_name );

					if ( false !== $result ) {
						$notices->success(
							sprintf(
								__( '<code>%1$d</code> transactions out of <code>%2$d</code> found in <code>%3$s</code> were imported successfully.', 'wallets' ),
								$result['total_rows_affected'], $result['total_rows'], basename( $moved_file_name ) ) );
					}

				} else {

					// Error generated by _wp_handle_upload()
					$notices->error( sprintf(
					__( 'Failed to import file : %s', 'wallets' ),
					$moved_file['error'] ) );
				}

				// Finally delete the uploaded .csv file
				unlink( $moved_file_name );
			}
		}


		private function csv_import( $filename ) {
			try {
				$total_rows = 0;
				$total_rows_affected = 0;

				// see http://php.net/manual/en/function.fgetcsv.php
				if ( version_compare( PHP_VERSION, '5.1.0' ) >= 0 ) {
					$len = 0;
				} else {
					$len = 2048;
				}

				// read file
				if ( ( $fh = fopen( $filename, 'r' ) ) !== false ) {
					global $wpdb;
					$table_name_txs = Dashed_Slug_Wallets::$table_name_txs;
					$headers = fgetcsv( $fh, $len );

					while (( $data = fgetcsv( $fh, $len )) !== false ) {

						$total_rows++;

						if ( $data[4] ) { // only insert rows with a TXID
							$rows_affected = $wpdb->query( $wpdb->prepare(
								"
								INSERT INTO
								$table_name_txs(" . Dashed_Slug_Wallets_TXs::$tx_columns . ")
									VALUES
										( %s, %d, NULLIF(%d, ''), %s, %s, %s, %20.10f, %20.10f, NULLIF(%s, ''), %s, %s, %d, %s, %d, %s, %d, %d, %d )
								",
								$data[0],
								$data[1],
								$data[2],
								$data[3],
								$data[4],
								$data[5],
								$data[6],
								$data[7],
								$data[8],
								$data[9],
								$data[10],
								$data[11],
								$data[12],
								$data[13],
								$data[14],
								$data[15],
								$data[16],
								$data[17]
							) );

							if ( false !== $rows_affected ) {
								$total_rows_affected += $rows_affected;
							}
						}
					}
					return array(
						'total_rows' => $total_rows,
						'total_rows_affected' => $total_rows_affected,
					);
				}
			} catch ( Exception $e ) {
				fclose( $fh );
				throw $e;
			}
			fclose( $fh );
			return false;
		} // end function csv_import()


		public function actions_handler() {

			$action = filter_input( INPUT_GET, 'action', FILTER_SANITIZE_STRING ); // slug of action in transactions admin panel
			$id = filter_input( INPUT_GET, 'tx_id', FILTER_SANITIZE_NUMBER_INT ); // primary key to the clicked transaction row
			$nonce = filter_input( INPUT_GET, '_wpnonce', FILTER_SANITIZE_STRING ); // the _wpnonce coming from the action link
			$custom_nonce = md5( uniqid( NONCE_KEY, true ) ); // new nonce, in case of unconfirming

			global $wpdb;
			$table_name_txs = Dashed_Slug_Wallets::$table_name_txs;
			$affected_rows = 0;

			if ( $action && $id && $nonce ) {

				$ids = array( $id => null );

				$tx_data = $wpdb->get_row( $wpdb->prepare(
					"
					SELECT
						*
					FROM
						$table_name_txs
					WHERE
						id = %d
					", $id
				) );

				if ( 'move' == $tx_data->category ) {
					if ( preg_match( '/^(move-.*-)(send|receive)$/', $tx_data->txid, $matches ) ) {
						$txid_prefix = $matches[1];

						$tx_group = $wpdb->get_results( $wpdb->prepare(
							"
							SELECT
								*
							FROM
								$table_name_txs
							WHERE
								txid LIKE %s
							",
							"$txid_prefix%" ) );

						if ( $tx_group ) {
							foreach ( $tx_group as $tx ) {
								$ids[ intval( $tx->id ) ] = null;

								// send new confirmation email
								if ( 'user_unconfirm' == $action && Dashed_Slug_Wallets::get_option( 'wallets_confirm_move_user_enabled' ) && preg_match( '/send$/', $tx->txid ) ) {
										$tx->nonce = $custom_nonce;
										do_action( 'wallets_send_user_confirm_email', $tx );
								}
							}
						}
					}
				} elseif ( 'withdraw' == $tx_data->category ) {
					// send new confirmation email
					if ( 'user_unconfirm' == $action && Dashed_Slug_Wallets::get_option( 'wallets_confirm_withdraw_user_enabled' ) ) {
						$tx_data->nonce = $custom_nonce;
						do_action( 'wallets_send_user_confirm_email', $tx_data );
					}
				}

				// if the original transaction was a move, here the set of ids will contain the IDs for both send and receive rows
				$set_of_ids = implode( ',', array_keys( $ids ) );

				switch ( $action ) {

					case 'user_unconfirm':
						if ( ! current_user_can( 'manage_wallets' ) )  {
							wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
						}

						if ( ! wp_verify_nonce( $nonce, "wallets-user-unconfirm-$id" ) ) {
							wp_die( __( 'Possible request forgery detected. Please reload and try again.', 'wallets' ) );
						}

						$affected_rows = $wpdb->query(
							"
							UPDATE
								$table_name_txs
							SET
								user_confirm = 0,
								nonce = '$custom_nonce'
							WHERE
								id IN ( $set_of_ids )
							");
						break;

					case 'user_confirm':
						if ( ! current_user_can( 'manage_wallets' ) )  {
							wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
						}

						if ( ! wp_verify_nonce( $nonce, "wallets-user-confirm-$id" ) ) {
							wp_die( __( 'Possible request forgery detected. Please reload and try again.', 'wallets' ) );
						}

						$affected_rows = $wpdb->query(
							"
							UPDATE
								$table_name_txs
							SET
								user_confirm = 1,
								nonce = NULL
							WHERE
								id IN ( $set_of_ids )
							");
						break;

					case 'admin_unconfirm':
						if ( ! current_user_can( 'manage_wallets' ) )  {
							wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
						}

						if ( ! wp_verify_nonce( $nonce, "wallets-admin-unconfirm-$id" ) ) {
							wp_die( __( 'Possible request forgery detected. Please reload and try again.', 'wallets' ) );
						}

						$affected_rows = $wpdb->query(
							"
							UPDATE
								$table_name_txs
							SET
								admin_confirm = 0
							WHERE
								id IN ( $set_of_ids )
							");
						break;

					case 'admin_confirm':
						if ( ! current_user_can( 'manage_wallets' ) )  {
							wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
						}

						if ( ! wp_verify_nonce( $nonce, "wallets-admin-confirm-$id" ) ) {
							wp_die( __( 'Possible request forgery detected. Please reload and try again.', 'wallets' ) );
						}

						$affected_rows = $wpdb->query(
							"
							UPDATE
								$table_name_txs
							SET
								admin_confirm = 1
							WHERE
								id IN ( $set_of_ids )
							");
						break;

					case 'reset_retries':
						if ( ! current_user_can( 'manage_wallets' ) )  {
							wp_die( __( 'You do not have sufficient permissions to access this page.', 'wallets' ) );
						}

						if ( ! wp_verify_nonce( $nonce, "wallets-reset-retries-$id" ) ) {
							wp_die( __( 'Possible request forgery detected. Please reload and try again.', 'wallets' ) );
						}

						$affected_rows = $wpdb->query( $wpdb->prepare(
							"
							UPDATE
								$table_name_txs
							SET
								retries = IF( category='withdraw', %d, %d ),
								status = IF ( status='failed', 'pending', status )
							WHERE
								id IN ( $set_of_ids ) AND
								category IN ( 'withdraw', 'move' )
							",
							Dashed_Slug_Wallets::get_option( 'wallets_retries_withdraw', 3 ),
							Dashed_Slug_Wallets::get_option( 'wallets_retries_move', 1 ),
							$id
						) );

						break;

				}

				$redirect_args = array(
					'page' => 'wallets-menu-transactions',
					'paged' => filter_input( INPUT_GET, 'paged', FILTER_SANITIZE_NUMBER_INT ),
					'order' => filter_input( INPUT_GET, 'order', FILTER_SANITIZE_STRING ),
					'orderby' => filter_input( INPUT_GET, 'orderby', FILTER_SANITIZE_STRING ),
				);

				if ( $affected_rows ) {
					$redirect_args['updated'] = 1;
				}

				wp_redirect(

					add_query_arg(
						$redirect_args,
						call_user_func( is_plugin_active_for_network( 'wallets/wallets.php' ) ? 'network_admin_url' : 'admin_url', 'admin.php' )
					)
				);
			}
		}
	}

	new Dashed_Slug_Wallets_TXs();
}