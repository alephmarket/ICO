<?php woocommerce_admin_fields( $setting_fields );
if ( $wmc_auto_update_rates_time <= 0 || $wmc_auto_update_rates_time == "" ) {
	$wmc_auto_update_rates_time = 6;
	$wmc_auto_update_time_type  = 'hour';
}
$get_exchange_server = apply_filters( "get_exchange_server", esc_html__( 'Yahoo Finance', 'woo-multi-currency' ) );
?>
	<input type="button" value="<?php esc_attr_e( 'Add currency', 'woo-multi-currency' ); ?>" id="btn_add_curr" class="button" />
<?php do_action( 'wmc_after_button_add_currency' ) ?>
	<img src="<?php echo plugins_url() . "/woo-multi-currency/images/select2-spinner.gif"; ?>" alt="Loading"
		 class="wmc_img" id="getting_rates" style="display:none;">
	<div id="wmc_setting_description" class="wmc_wrap_description">
		<div class="wmc_description_ismain"><b><?php esc_html_e( 'Default', 'woo-multi-currency' ); ?></b></div>
		<div class="wmc_description"><b><?php esc_html_e( 'Currency', 'woo-multi-currency' ); ?></b></div>
		<div class="wmc_description"><b><?php esc_html_e( 'Position', 'woo-multi-currency' ); ?></b></div>
		<div class="wmc_description wmc_rate_description"><b><?php esc_html_e( 'Rate', 'woo-multi-currency' ); ?></b>
		</div>
		<div class="wmc_description num_of_dec_description">
			<b><?php esc_html_e( 'Number of Decimals', 'woo-multi-currency' ); ?></b>
		</div>
		<?php
		do_action( 'wmc_currency_options_fields_header' );
		?>
	</div>
	<div id="wmc_sort" class="wmc_sort">
		<?php foreach ( $selected_currencies as $code => $values ) { ?>
			<div class="wmc_wrap">
				<img src="<?php echo plugins_url() . "/woo-multi-currency/images/dragndrop.png"; ?>" alt="Move to Sort"
					 class="wmc_img">
				<input name="wmc_is_main[]" id="wmc_is_main" class="wmc_is_main wmc_is_main_css" autocomplete="off"
					   type="radio" <?php if ( $values['is_main'] ) {
					echo "Checked";
				} ?>
					   title="<?php esc_attr_e( 'Check to set this Currency as main currency', 'woo-multi-currency' ); ?>">
				<input name="wmc_hidden_is_main[]" id="wmc_hidden_is_main" class="wmc_hidden_is_main" type="hidden"
					   value="<?php echo $values['is_main']; ?>">
				<select name="wmc_currency[]" id="wmc_currency" class="wc-enhanced-select wmc_currency_css  wmc_select2"
						title="Select Currency" autocomplete="off">
					<?php foreach ( $currencies_symbol as $id => $symbol ) { ?>
						<option
							value="<?php echo $id; ?>" <?php selected( $code, $id ) ?> > <?php echo "(" . $symbol . ") " . $currencies_list[$id]; ?> </option>
					<?php } ?>
				</select>
				<select name="wmc_pos[]" id="wmc_pos" class="wc-enhanced-select wmc_pos_css  wmc_select2" autocomplete="off">
					<option
						value="left" <?php selected( $values['pos'], 'left' ) ?> > <?php esc_html_e( "Left $99", "woo-multi-currency" ); ?> </option>
					<option
						value="right" <?php selected( $values['pos'], 'right' ) ?> > <?php esc_html_e( "Right 99$", "woo-multi-currency" ); ?> </option>
					<option
						value="left_space" <?php selected( $values['pos'], 'left_space' ) ?> > <?php esc_html_e( "Left with space $ 99", "woo-multi-currency" ); ?> </option>
					<option
						value="right_space" <?php selected( $values['pos'], 'right_space' ) ?> > <?php esc_html_e( "Right with space 99 $", "woo-multi-currency" ); ?> </option>
				</select>
				<input id="wmc_rate" name="wmc_rate[]" type="text"
					   value="<?php echo isset( $values['rate'] ) ? $values['rate'] : 1; ?>"
					   placeholder="<?php esc_attr_e( 'Exchange rate', 'woo-multi-currency' ); ?>"
					   class="wmc_rate wmc_rate_css" data-tip="Manual enter your exchange rate here" autocomplete="off">
				<input name="num_of_dec[]" type="text"
					   value="<?php echo isset( $values['num_of_dec'] ) ? $values['num_of_dec'] : 2; ?>"
					   class="num_of_dec num_of_dec_css"
					   placeholder="<?php esc_attr_e( 'Number of Decimals', 'woo-multi-currency' ); ?>" autocomplete="off">
				<?php
				do_action( 'wmc_currency_options_fields_input', $values );
				?>
				<input type="button" value="<?php esc_attr_e( 'Delete', 'woo-multi-currency' ); ?>" id="btn_delete"
					   class="btn_delete button" title='Press to delete this currency'
					   data-confirm="<?php esc_attr_e( 'Do you want to delete', 'woo-multi-currency' ); ?>" />
				<?php do_action( 'wmc_after_button_delete_currency' ); ?>
			</div>
		<?php } ?>
	</div>
	<div id="temcurrency" style="display:none">
		<div class="wmc_wrap">
			<img src="<?php echo plugins_url() . "/woo-multi-currency/images/dragndrop.png"; ?>" alt="Move to Sort"
				 class="wmc_img">
			<input name="temp_wmc_is_main" id="temp_wmc_is_main" type="radio" class="temp_wmc_is_main wmc_is_main_css"
				   title="Check to set this Currency as main currency">
			<input name="temp_wmc_hidden_is_main" id="temp_wmc_hidden_is_main" type="hidden" value="0">
			<select name="temp_wmc_currency[]" id="temp_wmc_currency" class="wmc_currency_css  wmc_select2">
				<?php foreach ( $currencies_symbol as $id => $symbol ) { ?>
					<option
						value="<?php echo $id; ?>"><?php echo "(" . $symbol . ") " . $currencies_list[$id]; ?></option>
				<?php } ?>
			</select>

			<select name="temp_wmc_pos[]" id="temp_wmc_pos" class="wmc_pos_css wmc_select2">
				<option value="left"> <?php esc_html_e( "Left $99", "woo-multi-currency" ); ?> </option>
				<option value="right"> <?php esc_html_e( "Right 99$", "woocommerce" ); ?> </option>
				<option
					value="left_space"> <?php esc_html_e( "Left with space $ 99", "woo-multi-currency" ); ?> </option>
				<option
					value="right_space"> <?php esc_html_e( "Right with space 99 $", "woo-multi-currency" ); ?> </option>
			</select>
			<input id="temp_wmc_rate" name="temp_wmc_rate[]" type="text"
				   placeholder="<?php esc_attr_e( 'Exchange rate', 'woo-multi-currency' ); ?>" value="1"
				   class="wmc_rate_css">
			<input id="num_of_dec" name="num_of_dec[]" type="text" class="num_of_dec num_of_dec_css"
				   placeholder="<?php esc_attr_e( 'Number of Decimals', 'woo-multi-currency' ); ?>" value="2">
			<?php
			do_action( 'wmc_currency_options_fields_input_temp' );
			?>
			<input type="button" value="<?php esc_attr_e( 'Delete', 'woo-multi-currency' ); ?>" id="btn_delete"
				   class="btn_delete button" title="Press to delete this currency" />
			<?php do_action( 'wmc_after_button_delete_currency' ); ?>
		</div>
	</div>
	<table id="div_temp_setting_update_rate_time" style="display:none;">
		<tr class="" valign="top">
			<th class="titledesc"
				scope="row"><?php esc_html_e( 'Setting time to update', 'woo-multi-currency' ); ?></th>
			<td class="forminp forminp-checkbox">
				<fieldset>
					<legend class="screen-reader-text">
						<span><?php esc_html_e( 'Auto update exchange rate', 'woo-multi-currency' ); ?></span>
					</legend>
					<?php esc_html_e( 'Update Every', 'woo-multi-currency' ); ?>:
					<label for="wmc_auto_update_rates_time">
						<input id="wmc_auto_update_rates_time" class="wmc_auto_update_rates_time" type="text"
							   value="<?php echo esc_attr( $wmc_auto_update_rates_time ); ?>"
							   name="wmc_auto_update_rates_time">
						<select name="wmc_auto_update_time_type" id="wmc_auto_update_time_type"
								class="wmc_auto_update_time_type">
							<option
								value="min" <?php selected( $wmc_auto_update_time_type, 'min' ) ?>> <?php esc_html_e( "Min", "woo-multi-currency" ); ?> </option>
							<option
								value="hour" <?php selected( $wmc_auto_update_time_type, 'hour' ) ?>> <?php esc_html_e( "Hour", "woocommerce" ); ?> </option>
							<option
								value="day" <?php selected( $wmc_auto_update_time_type, 'day' ) ?>> <?php esc_html_e( "Day", "woo-multi-currency" ); ?> </option>
						</select>
					</label>
					<p class="description"><?php esc_html_e( 'Enter your time value.', 'woo-multi-currency' ); ?></p>
				</fieldset>
			</td>
		</tr>
	</table>
<?php
do_action( 'wmc_after_option' );
do_action( 'villatheme_ads' ) ?>