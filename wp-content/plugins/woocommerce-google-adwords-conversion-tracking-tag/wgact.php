<?php
/**
 * Plugin Name:  WooCommerce AdWords Conversion Tracking
 * Plugin URI:   https://wordpress.org/plugins/woocommerce-google-adwords-conversion-tracking-tag/
 * Description:  Google AdWords dynamic conversion value tracking for WooCommerce.
 * Author:       Wolf+Bär Agency
 * Author URI:   https://wolfundbaer.ch
 * Version:      1.4.6
 * License:      GPLv2 or later
 * Text Domain:  woocommerce-google-adwords-conversion-tracking-tag
 * WC requires at least: 2.6.0
 * WC tested up to: 3.1.2
 **/

// TODO add validation for the input fields. Try to use jQuery validation in the form.
// TODO add sanitization to the output
// TODO in case Google starts to use alphabetic characters in the conversion ID, output the conversion ID with ''
// TODO switch deduplication to order ID based
// TODO give users choice to use content or footer based code insertion
// TODO only run if WooCommerce is active
// TODO fix json_encode for order total with only two decimals https://stackoverflow.com/questions/42981409/php7-1-json-encode-float-issue
// TODO also json_encode might not return the correct format under certain locales http://php.net/manual/en/function.json-encode.php#91434



if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}


class WGACT {

	public $conversion_id;
	public $conversion_label;

	public function __construct() {


		// preparing the DB check and upgrade routine
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-db-upgrade.php';

		// running the DB updater
		$db_upgrade = new WGACT_DB_Upgrade();
		$db_upgrade->run_options_db_upgrade();

		// startup all functions
		$this->init();

	}

	// startup all functions
	public function init() {

		// load the options
		$this->wgact_options_init();

		// add the admin options page
		add_action( 'admin_menu', array( $this, 'wgact_plugin_admin_add_page' ), 99 );

		// install a settings page in the admin console
		add_action( 'admin_init', array( $this, 'wgact_plugin_admin_init' ) );

		// add a settings link on the plugins page
		add_filter( 'plugin_action_links', array( $this, 'wgact_settings_link' ), 10, 2 );

		// Load textdomain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// ask for a rating in a plugin notice
		add_action( 'admin_head', array( $this, 'ask_for_rating_js' ) );
		add_action( 'wp_ajax_wgact_dismissed_notice_handler', array( $this, 'ajax_rating_notice_handler' ) );
		add_action( 'admin_notices', array( $this, 'ask_for_rating_notices_if_not_asked_before' ) );

		// add the Google AdWords tag to the thankyou part of the page within the body tags
		add_action( 'woocommerce_thankyou', array( $this, 'GoogleAdWordsTag' ) );

		// fix WordPress CDATA filter as per ticket https://core.trac.wordpress.org/ticket/3670
		add_action( 'template_redirect', array( $this, 'cdata_template_redirect' ), -1 );

	}

    // start cdata template markupfix
	function cdata_template_redirect( $content ) {
		ob_start( array( $this, 'cdata_markupfix' ) );
	}

	// execute str_replace on content to fix the CDATA comments
	function cdata_markupfix( $content ) {
		$content = str_replace("]]&gt;", "]]>", $content);

		return $content;
	}

	// client side ajax js handler for the admin rating notice
	public function ask_for_rating_js() {

		?>
        <script type="text/javascript">
            jQuery(document).on('click', '.notice-success.wgact-rating-success-notice, wgact-rating-link, .wgact-rating-support', function ($) {

                var data = {
                    'action': 'wgact_dismissed_notice_handler',
                };

                jQuery.post(ajaxurl, data);
                jQuery('.wgact-rating-success-notice').remove();

            });
        </script> <?php

	}

	// server side php ajax handler for the admin rating notice
	public function ajax_rating_notice_handler() {

		// prepare the data that needs to be written into the user meta
		$wgdr_admin_notice_user_meta = array(
			'date-dismissed' => date( 'Y-m-d' ),
		);

		// update the user meta
		update_user_meta( get_current_user_id(), 'wgact_admin_notice_user_meta', $wgdr_admin_notice_user_meta );

		wp_die(); // this is required to terminate immediately and return a proper response
	}


	// only ask for rating if not asked before or longer than a year
	public function ask_for_rating_notices_if_not_asked_before() {

		// get user meta data for this plugin
		$user_meta = get_user_meta( get_current_user_id(), 'wgact_admin_notice_user_meta' );

		// check if there is already a saved value in the user meta
		if ( isset( $user_meta[0]['date-dismissed'] ) ) {

			$date_1 = date_create( $user_meta[0]['date-dismissed'] );
			$date_2 = date_create( date( 'Y-m-d' ) );

			// calculate day difference between the dates
			$interval = date_diff( $date_1, $date_2 );

			// check if the date difference is more than 360 days
			if ( 360 < $interval->format( '%a' ) ) {
				$this->ask_for_rating_notices();
			}

		} else {

			$this->ask_for_rating_notices();
		}
	}

	// show an admin notice to ask for a plugin rating
	public function ask_for_rating_notices() {

		$current_user = wp_get_current_user();

		?>
        <div class="notice notice-success is-dismissible wgact-rating-success-notice">
            <p>
                <span><?php _e( 'Hi ', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></span>
                <span><?php echo( $current_user->user_firstname ? $current_user->user_firstname : $current_user->nickname ); ?></span>
                <span><?php _e( '! ', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></span>
                <span><?php _e( 'You\'ve been using the ', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></span>
                <span><b><?php _e( 'WGACT Google AdWords Conversion Tracking Plugin', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></b></span>
                <span><?php _e( ' for a while now. If you like the plugin please support our development by leaving a ★★★★★ rating: ', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></span>
                <span class="wgact-rating-link">
                    <a href="https://wordpress.org/support/view/plugin-reviews/woocommerce-google-adwords-conversion-tracking-tag?rate=5#postform"
                       target="_blank"><?php _e( 'Rate it!', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></a>
                </span>
            </p>
            <p>
                <span><?php _e( 'Or else, please leave us a support question in the forum. We\'ll be happy to assist you: ', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></span>
                <span class="wgact-rating-support">
                    <a href="https://wordpress.org/support/plugin/woocommerce-google-adwords-conversion-tracking-tag"
                       target="_blank"><?php _e( 'Get support', 'woocommerce-google-adwords-conversion-tracking-tag' ); ?></a>
                </span>
            </p>
        </div>
		<?php

	}


	// initialise the options
	public function wgact_options_init() {

		// set options equal to defaults
		global $wgact_plugin_options;
		$wgact_plugin_options = get_option( 'wgact_plugin_options' );

		if ( false === $wgact_plugin_options ) {

			$wgact_plugin_options = $this->wgact_get_default_options();
			update_option( 'wgact_plugin_options', $wgact_plugin_options );

		} else {  // Check if each single option has been set. If not, set them. That is necessary when new options are introduced.

			// get default plugins options
			$wgact_default_plugin_options = $this->wgact_get_default_options();

			// go through all default options an find out if the key has been set in the current options already
			foreach ( $wgact_default_plugin_options as $key => $value ) {

				// Test if the key has been set in the options already
				if ( ! array_key_exists( $key, $wgact_plugin_options ) ) {

					// set the default key and value in the options table
					$wgact_plugin_options[ $key ] = $value;

					// update the options table with the new key
					update_option( 'wgact_plugin_options', $wgact_plugin_options );

				}
			}
		}
	}

	// get the default options
	public function wgact_get_default_options() {
		// default options settings
		$options = array(
			'conversion_id'     => '',
			'conversion_label'  => '',
			'order_total_logic' => 0,
		);

		return $options;
	}


	// Load text domain function
	public function load_plugin_textdomain() {
		load_plugin_textdomain( 'woocommerce-google-adwords-conversion-tracking-tag', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	// adds a link on the plugins page for the wgact settings
	function wgact_settings_link( $links, $file ) {
		if ( $file == plugin_basename( __FILE__ ) ) {
			$links[] = '<a href="' . admin_url( "admin.php?page=wgact" ) . '">' . __( 'Settings' ) . '</a>';
		}

		return $links;
	}

	// add the admin options page
	function wgact_plugin_admin_add_page() {
		//add_options_page('WGACT Plugin Page', 'WGACT Plugin Menu', 'manage_options', 'wgact', array($this, 'wgact_plugin_options_page'));
		add_submenu_page( 'woocommerce', esc_html__( 'AdWords Conversion Tracking', 'woocommerce-google-adwords-conversion-tracking-tag' ), esc_html__( 'AdWords Conversion Tracking', 'woocommerce-google-adwords-conversion-tracking-tag' ), 'manage_options', 'wgact', array(
			$this,
			'wgact_plugin_options_page',
		) );
	}

	// display the admin options page
	function wgact_plugin_options_page() {

		?>

        <br>
        <div style="width:980px; float: left; margin: 5px">
            <div style="float:left; margin: 5px; margin-right:20px; width:750px">
                <div style="background: #0073aa; padding: 10px; font-weight: bold; color: white; border-radius: 2px">
					<?php esc_html_e( 'Google AdWords Conversion Tracking Settings', 'woocommerce-google-adwords-conversion-tracking-tag' ) ?>
                </div>
                <form action="options.php" method="post">
					<?php settings_fields( 'wgact_plugin_options_settings_fields' ); ?>
					<?php do_settings_sections( 'wgact' ); ?>
                    <br>
                    <table class="form-table" style="margin: 10px">
                        <tr>
                            <th scope="row" style="white-space: nowrap">
                                <input name="Submit" type="submit" value="<?php esc_attr_e( 'Save Changes' ); ?>"
                                       class="button button-primary"/>
                            </th>
                        </tr>
                    </table>
                </form>

                <br>
                <div
                        style="background: #0073aa; padding: 10px; font-weight: bold; color: white; margin-bottom: 20px; border-radius: 2px">
					<span>
						<?php esc_html_e( 'Profit Driven Marketing by Wolf+Bär', 'woocommerce-google-adwords-conversion-tracking-tag' ) ?>
					</span>
                    <span style="float: right;">
						<a href="https://wolfundbaer.ch/"
                           target="_blank" style="color: white">
							<?php esc_html_e( 'Visit us here: https://wolfundbaer.ch', 'woocommerce-google-adwords-conversion-tracking-tag' ) ?>
						</a>
					</span>
                </div>
            </div>
            <div style="float: left; margin: 5px">
                <a href="https://wordpress.org/plugins/woocommerce-google-dynamic-retargeting-tag/" target="_blank">
                    <img src="<?php echo( plugins_url( 'images/wgdr-icon-256x256.png', __FILE__ ) ) ?>" width="150px"
                         height="150px">
                </a>
            </div>
            <div style="float: left; margin: 5px">
                <a href="https://wordpress.org/plugins/woocommerce-google-adwords-conversion-tracking-tag/"
                   target="_blank">
                    <img src="<?php echo( plugins_url( 'images/wgact-icon-256x256.png', __FILE__ ) ) ?>" width="150px"
                         height="150px">
                </a>
            </div>
        </div>
		<?php
	}


	// add the admin settings and such
	function wgact_plugin_admin_init() {

		register_setting( 'wgact_plugin_options_settings_fields', 'wgact_plugin_options' );

		add_settings_section( 'wgact_plugin_main', esc_html__( 'Settings', 'woocommerce-google-adwords-conversion-tracking-tag' ), array(
			$this,
			'wgact_plugin_section_text',
		), 'wgact' );

		// add the field for the conversion id
		add_settings_field( 'wgact_plugin_conversion_id', esc_html__( 'Conversion ID', 'woocommerce-google-adwords-conversion-tracking-tag' ), array(
			$this,
			'wgact_plugin_setting_conversion_id',
		), 'wgact', 'wgact_plugin_main' );

		// ad the field for the conversion label
		add_settings_field( 'wgact_plugin_conversion_label', esc_html__( 'Conversion Label', 'woocommerce-google-adwords-conversion-tracking-tag' ), array(
			$this,
			'wgact_plugin_setting_conversion_label',
		), 'wgact', 'wgact_plugin_main' );

		// add fields for the product identifier
		add_settings_field(
			'wgact_plugin_order_total_logic',
			esc_html__(
				'Order Total Logic',
				'woocommerce-google-adwords-conversion-tracking-tag'
			),
			array(
				$this,
				'wgact_plugin_setting_order_total_logic',
			),
			'wgact',
			'wgact_plugin_main'
		);
	}

	function wgact_plugin_section_text() {
		//echo '<p>Woocommerce Google AdWords Conversion Tracking Tag</p>';
	}

	function wgact_plugin_setting_conversion_id() {
		$options = get_option( 'wgact_plugin_options' );
		echo "<input id='wgact_plugin_conversion_id' name='wgact_plugin_options[conversion_id]' size='40' type='text' value='{$options['conversion_id']}' />";
	}

	function wgact_plugin_setting_conversion_label() {
		$options = get_option( 'wgact_plugin_options' );
		echo "<input id='wgact_plugin_conversion_label' name='wgact_plugin_options[conversion_label]' size='40' type='text' value='{$options['conversion_label']}' />";
	}

	function wgact_plugin_setting_order_total_logic() {
		$options = get_option( 'wgact_plugin_options' );
		?>
        <input type='radio' id='wgact_plugin_option_product_identifier_0' name='wgact_plugin_options[order_total_logic]'
               value='0'  <?php echo( checked( 0, $options['order_total_logic'], false ) ) ?> ><?php _e( 'Use order_subtotal: Doesn\'t include tax and shipping (default)', 'woocommerce-google-adwords-conversion-tracking-tag' ) ?>
        <br>
        <input type='radio' id='wgact_plugin_option_product_identifier_1' name='wgact_plugin_options[order_total_logic]'
               value='1'  <?php echo( checked( 1, $options['order_total_logic'], false ) ) ?> ><?php _e( 'Use order_total: Includes tax and shipping', 'woocommerce-google-adwords-conversion-tracking-tag' ) ?>
        <br><br>
		<?php _e( 'This is the order total amount reported back to AdWords', 'woocommerce-google-adwords-conversion-tracking-tag' ) ?>
		<?php
	}

	// validate our options
	function wgact_plugin_options_validate( $input ) {
		$newinput['text_string'] = trim( $input['text_string'] );
		if ( ! preg_match( '/^[a-z0-9]{32}$/i', $newinput['text_string'] ) ) {
			$newinput['text_string'] = '';
		}

		return $newinput;
	}

	function woocommerce_3_and_above(){
        global $woocommerce;
        if( version_compare( $woocommerce->version, 3.0, ">=" ) ) {
            return true;
        } else {
            return false;
        }
    }

	public function GoogleAdWordsTag( $order_id ) {

		$conversion_id    = $this->get_conversion_id();
		$conversion_label = $this->get_conversion_label();

		// get order from URL and evaluate order total
		$order = new WC_Order( $order_id );

		$options             = get_option( 'wgact_plugin_options' );
		$order_total_setting = $options['order_total_logic'];
		$order_total         = 0 == $order_total_setting ? $order->get_subtotal() : $order->get_total();

		// use the right function to get the currency depending on the WooCommerce version
		$order_currency      = $this->woocommerce_3_and_above() ? $order->get_currency() : $order->get_order_currency();

		// the filter is deprecated
		// $order_total_filtered = apply_filters( 'wgact_conversion_value_filter', $order_total, $order );


		?>

        <!--noptimize-->
        <!-- START Google Code for Sales (AdWords) Conversion Page -->
		<?php

		// Only run conversion script if the payment has not failed. (has_status('completed') is too restrictive)
		// And use the order meta to check if the conversion code has already run for this order ID. If yes, don't run it again.
		// Also don't run the pixel if an admin or shop manager is logged in.
		// TODO $order->get_order_currency() is deprecated. Switch to $order->get_currency() at a later point somewhen in 2018
		if ( ! $order->has_status( 'failed' ) && ! current_user_can( 'edit_others_pages' ) ) {
			?>

        <script type="text/javascript">
            /* <![CDATA[ */
            var google_conversion_id = <?php echo json_encode( $conversion_id, JSON_NUMERIC_CHECK ); ?>;
            var google_conversion_language = "en";
            var google_conversion_format = "3";
            var google_conversion_color = "ffffff";
            var google_conversion_label = <?php echo json_encode( $conversion_label ); ?>;
            var google_conversion_order_id = "<?php echo $order_id; ?>";
            var google_conversion_value = <?php echo $order_total; ?>;
            var google_conversion_currency = <?php echo json_encode( $order_currency ); ?>;
            var google_remarketing_only = false;
            /* ]]> */
        </script>
        <script type="text/javascript" src="//www.googleadservices.com/pagead/conversion.js">
        </script>
        <noscript>
            <div style="display:inline;">
                <img height="1" width="1" style="border-style:none;" alt=""
                     src="//www.googleadservices.com/pagead/conversion/<?php echo $conversion_id; ?>/?value=<?php echo $order_total; ?>&amp;currency_code=<?php echo $order_currency; ?>&amp;label=<?php echo $conversion_label; ?>&amp;guid=ON&amp;oid=<?php echo $order_id; ?>&amp;script=0"/>
            </div>
        </noscript>
			<?php

		} else {

			?>

            <!-- The AdWords pixel has not been inserted. Possible reasons: -->
            <!--    You are logged into WooCommerce as admin or shop manager. -->
            <!--    The order payment has failed. -->
            <!--    The pixel has already been fired. To prevent double counting the pixel is not being fired again. -->

			<?php
		} // end if order status

		?>

        <!-- END Google Code for Sales (AdWords) Conversion Page -->
        <!--/noptimize-->
		<?php
	}

	private function get_conversion_id() {
		$opt           = get_option( 'wgact_plugin_options' );
		$conversion_id = $opt['conversion_id'];

		return $conversion_id;
	}

	// insert the Google AdWords tag into the page

	private function get_conversion_label() {
		$opt              = get_option( 'wgact_plugin_options' );
		$conversion_label = $opt['conversion_label'];

		return $conversion_label;
	}
}

$wgact = new WGACT();