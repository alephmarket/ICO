<?php

if ( ! class_exists( 'Dashed_Slug_Wallets_Widget' ) ) {
	class Dashed_Slug_Wallets_Widget extends WP_Widget {

		private $widget;
		private $description;
		private $capabilities;

		public static function widgets_init() {
			register_widget( 'Dashed_Slug_Wallets_Widget_Deposit' );
			register_widget( 'Dashed_Slug_Wallets_Widget_Withdraw' );
			register_widget( 'Dashed_Slug_Wallets_Widget_Move' );
			register_widget( 'Dashed_Slug_Wallets_Widget_Balance' );
			register_widget( 'Dashed_Slug_Wallets_Widget_Transactions' );
		}

		/**
		 * Sets up the widgets name etc
		 */
		public function __construct( $widget, $desc, $caps, $classname ) {
			$this->widget = $widget;
			$this->description = $desc;
			$this->capabilities = $caps;

			$widget_ops = array(
				'classname' => $classname,
				'description' => $desc,
			);

			parent::__construct(
				strtolower( $classname ),
				__( 'Wallets ' . preg_replace( '/.*_(\w+)$/', '${1}', $classname ), 'wallets'),
				$widget_ops );

		}

		/**
		 * Outputs the content of the widget
		 *
		 * @param array $args
		 * @param array $instance
		 */
		public function widget( $args, $instance ) {
			if ( is_user_logged_in() ) {
				$allowed = true;
				foreach ( $this->capabilities as $capability ) {
					$allowed = $allowed && current_user_can( $capability );
				}

				if ( $allowed ): ?>
				<div class="widget widget-wallets widget-<?php echo str_replace( '_', '-', $this->widget ); ?>">
					<h3 class="widget-heading"><?php esc_html_e( $this->name, 'wallets' ); ?></h3>
					<?php echo do_shortcode( '[' . $this->widget . ']' ); ?>
				</div>
				<?php endif;
			}
		}

		/**
		 * Outputs the options form on admin
		 *
		 * @param array $instance The widget options
		 */
		public function form( $instance ) {
			// outputs the options form on admin
		}

		/**
		 * Processing widget options on save
		 *
		 * @param array $new_instance The new options
		 * @param array $old_instance The previous options
		 */
		public function update( $new_instance, $old_instance ) {
			// processes widget options to be saved
		}
	}

	class Dashed_Slug_Wallets_Widget_Deposit extends Dashed_Slug_Wallets_Widget {
		public function __construct( ) {
			parent::__construct(
				'wallets_deposit',
				__( 'A form that will let the user know which address they can send coins to if they wish to make a deposit.'),
				array( 'has_wallets' ),
				__CLASS__
			);
		}
	}

	class Dashed_Slug_Wallets_Widget_Withdraw extends Dashed_Slug_Wallets_Widget {
		public function __construct( ) {
			parent::__construct(
				'wallets_withdraw',
				__( 'A form that will let the user withdraw funds.', 'wallets' ),
				array( 'has_wallets', 'withdraw_funds_from_wallet' ),
				__CLASS__
			);
		}
	}

	class Dashed_Slug_Wallets_Widget_Move extends Dashed_Slug_Wallets_Widget {
		public function __construct( ) {
			parent::__construct(
				'wallets_move',
				__( 'A form that lets the user transfer coins to other users on your site.', 'wallets' ),
				array( 'has_wallets', 'send_funds_to_user' ),
				__CLASS__
			);
		}
	}

	class Dashed_Slug_Wallets_Widget_Balance extends Dashed_Slug_Wallets_Widget {
		public function __construct( ) {
			parent::__construct(
					'wallets_balance',
				__( "The current user's balances in all enabled coins.", 'wallets' ),
				array( 'has_wallets' ),
				__CLASS__
			);
		}
	}

	class Dashed_Slug_Wallets_Widget_Transactions extends Dashed_Slug_Wallets_Widget {
		public function __construct( ) {
			parent::__construct(
				'wallets_transactions',
				__( 'An interactive table that shows past deposits, withdrawals and transfers for the user.', 'wallets' ),
				array( 'has_wallets', 'list_wallet_transactions' ),
				__CLASS__
			);
		}
	}

	// bind all widgets
	add_action( 'widgets_init', 'Dashed_Slug_Wallets_Widget::widgets_init' );

} // end if class exists

