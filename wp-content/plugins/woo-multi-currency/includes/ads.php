<?php

/**
 * Add Ads in product
 * Class VI_WOO_CB_Admin_Ads
 */
if ( ! class_exists( 'Villatheme_Ads' ) ) {
	class Villatheme_Ads {
		public function __construct() {
			add_action( 'villatheme_ads', array( $this, 'add_ads' ) );

			//Init Script
			add_action( 'admin_enqueue_scripts', array( $this, 'wp_enqueue_scripts' ) );
		}

		/**
		 * Add Script
		 */
		function wp_enqueue_scripts() {
			wp_enqueue_style( 'villatheme-ads', plugins_url() . '/woo-multi-currency/css/villatheme-items.css' );
		}

		/**
		 * Add ADS
		 */
		public function add_ads() {

			$ads = $this->get_xml();


			if ( ! $ads || ! is_array( $ads ) ) {
				return false;
			}
			$ads = array_filter( $ads );
			if ( ! count( $ads ) ) {
				return false;
			}


			?>
			<div class="villatheme-ads-wrapper">
				<h3><?php echo esc_html( 'MAY BE YOU LIKE' ) ?></h3>
				<ul class="villatheme-list-ads">
					<?php

					if ( count( $ads ) > 8 ) {
						$ads = $this->array_random_assoc( $ads, 8 );
					}
					foreach ( $ads as $ad ) { ?>
						<li>
							<a href="<?php echo esc_url( $ad->link ) ?>">
								<?php if ( $ad->thumb ) { ?>
									<img src="<?php echo esc_url( $ad->thumb ) ?>" />
								<?php } ?>
								<?php if ( $ad->image ) { ?>
									<span>
								<img src="<?php echo esc_url( $ad->image ) ?>" />
							</span>
								<?php } ?>
								<?php echo esc_html( $ad->title ) ?>
							</a>
						</li>
					<?php } ?>
				</ul>
			</div>
		<?php }

		/**
		 * Get data from server
		 * @return array
		 */
		protected function get_xml() {
			if ( ! isset( $_SESSION['ads'] ) ) {
				@$ads = file_get_contents( 'http://villatheme.com/feed.php' );
				$_SESSION['ads'] = $ads;
			} else {
				$ads = $_SESSION['ads'];
			}
			if ( $ads ) {
				$ads = json_decode( $ads );
				$ads = array_filter( $ads );
			} else {
				return false;
			}
			if ( count( $ads ) ) {
				$theme_select = null;
				foreach ( $ads as $ad ) {
					$item        = new stdClass();
					$item->title = $ad->title;
					$item->link  = $ad->link;
					$item->thumb = $ad->thumb;
					$item->image = $ad->image;
					$item->desc  = $ad->description;
					$results[]   = $item;
				}
			} else {
				return false;
			}
			if ( count( $results ) ) {
				return $results;
			} else {
				return false;
			}
		}

		/**
		 * Random multi array
		 *
		 * @param     $arr
		 * @param int $num
		 *
		 * @return array
		 */
		protected function array_random_assoc( $arr, $num = 1 ) {
			$keys = array_keys( $arr );
			shuffle( $keys );

			$r = array();
			for ( $i = 0; $i < $num; $i ++ ) {
				$r[ $keys[ $i ] ] = $arr[ $keys[ $i ] ];
			}

			return $r;
		}
	}

	new Villatheme_Ads();
}