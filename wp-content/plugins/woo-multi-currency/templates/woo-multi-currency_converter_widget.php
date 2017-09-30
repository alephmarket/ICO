<?php
/**
 * Created by PhpStorm.
 * User: FalconNguyen
 * Date: 5/31/2016
 * Time: 10:40 AM
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<script>
	jQuery(document).ready(function () {
		//jQuery('#wmc_widget_converter_from').select2();
		//jQuery('#wmc_widget_converter_to').select2();
		jQuery("#btn_convert").live('click', function () {
			var from_rate = jQuery('#wmc_widget_converter_from').val();
			var to_rate = jQuery('#wmc_widget_converter_to').val();
			var convert_value = jQuery('#txt_amount').val();
			var convert_result = (to_rate / from_rate) * convert_value;
			jQuery('#txt_result').val(convert_result.toFixed(4));
		});
		jQuery("#txt_amount").on("keypress keyup blur", function (event) {
			jQuery(this).val(jQuery(this).val().replace(/[^0-9\.]/g, ''));
			if (event.keyCode == 8 || event.keyCode == 46 || event.keyCode == 37 || event.keyCode == 39) {
				return true;
			}
			else if ((event.which != 46 || jQuery(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
				event.preventDefault();
			}
		});
	});
</script>
<table class="table" border="0" cellpadding="2" cellspacing="2">
	<tr>
		<td>
			<input type="text" id="txt_amount" style="width: 180px;" placeholder="<?php esc_attr_e( 'Enter your value', 'woo-multi-currency' ); ?>">
		</td>
		<td>
			<div class="woo-multi-currency-wrapper">
				<select name="wmc_widget_converter_from" id="wmc_widget_converter_from" class="wc-enhanced-select" style="width:180px;" data-placeholder="Select currency">
					<?php foreach ( $selected_currencies as $code => $values ) : ?>
						<option value="<?php echo $values['rate']; ?>"
								style="width:100px;"><?php echo "(" . $values['symbol'] . ") " . $currencies_list[$code]; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="2"><?php esc_html_e( 'To', 'woo-multi-currency' ) ?></td>
	</tr>
	<tr>
		<td><input type="text" id="txt_result" style="width: 180px;" readonly></td>
		<td>
			<div class="woo-multi-currency-wrapper">
				<select name="wmc_widget_converter_to" id="wmc_widget_converter_to" class="wc-enhanced-select" style="width:180px;" data-placeholder="Select currency">
					<?php foreach ( $selected_currencies as $code => $values ) : ?>
						<option value="<?php echo $values['rate']; ?>"
								style="width:100px;"><?php echo "(" . $values['symbol'] . ") " . $currencies_list[$code]; ?></option>
					<?php endforeach; ?>
				</select>
			</div>
		</td>
	</tr>
</table>
<input type="button" id="btn_convert" value="<?php esc_attr_e( 'Convert', 'woo-multi-currency' ) ?>"