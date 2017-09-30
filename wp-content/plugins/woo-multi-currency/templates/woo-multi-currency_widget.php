<?php
/**
 * Show widget
 *
 * This template can be overridden by copying it to yourtheme/woo-currency/woo-currency_widget.php.
 *
 * @author        Cuong Nguyen
 * @package       Woo-currency/Templates
 * @version       1.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$main_currency = get_option( 'woocommerce_currency' );
?>
<script>
	jQuery(document).ready(function () {
		jQuery('#wmc_widget').select2();
		jQuery('#wmc_widget').on("change", function () {
			window.location.href = jQuery(this).val();
		});
	});
</script>
<div class="woo-multi-currency-wrapper">
	<input name="widget_hidden_is_main_currency" id="widget_hidden_is_main_currency" type="hidden" value="0">
	<select name="wmc_widget" id="wmc_widget" class="wc-enhanced-select" style="width:180px;" data-placeholder="Select currency">
		<?php foreach ( $selected_currencies as $code => $values ) {
			$arg = array( 'wmc_current_currency' => $code );
			if ( $current_currency == $main_currency ) {
				if ( isset( $_GET['min_price'] ) ) {
					$arg['min_price'] = $_GET['min_price'] * $values['rate'];
				}
				if ( isset( $_GET['max_price'] ) ) {
					$arg['max_price'] = $_GET['max_price'] * $values['rate'];
				}
			} else {
				if ( isset( $_GET['min_price'] ) ) {
					$arg['min_price'] = ( $_GET['min_price'] / $selected_currencies[$current_currency]['rate'] ) * $values['rate'];
				}
				if ( isset( $_GET['max_price'] ) ) {
					$arg['max_price'] = ( $_GET['max_price'] / $selected_currencies[$current_currency]['rate'] ) * $values['rate'];
				}
			}

			?>
			<option value="<?php echo esc_url( add_query_arg( $arg ) ) ?>" <?php selected( $code, $current_currency ) ?>
					style="width:100px;"><?php echo "(" . $values['symbol'] . ") " . $currencies_list[$code]; ?></option>
		<?php } ?>
	</select>
</div>