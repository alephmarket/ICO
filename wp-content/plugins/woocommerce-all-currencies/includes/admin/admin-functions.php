<?php
/**
 * WooCommerce All Currencies - Admin Functions
 *
 * @version 2.1.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! function_exists( 'alg_wcac_get_list_section_settings' ) ) {
	/**
	 * alg_wcac_get_list_section_settings.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function alg_wcac_get_list_section_settings( $list ) {
		switch ( $list ) {
			case 'country':
				$title      = __( 'Country Currencies', 'woocommerce-all-currencies' );
				$currencies = alg_wcac_get_country_currencies_names();
				$symbols    = alg_wcac_get_country_currencies_symbols();
				break;
			case 'crypto':
				$title      = __( 'Crypto Currencies', 'woocommerce-all-currencies' );
				$currencies = alg_wcac_get_crypto_currencies_names();
				$symbols    = alg_wcac_get_crypto_currencies_symbols();
				break;
		}
		$settings = array(
			array(
				'title'    => $title,
				'type'     => 'title',
				'desc'     => apply_filters( 'alg_wc_all_currencies_filter', '<em>' . sprintf( __( 'You will need <a target="_blank" href="%s">All Currencies for WooCommerce Pro</a> plugin to change currency symbol.', 'woocommerce-all-currencies' ), 'https://wpcodefactory.com/item/woocommerce-all-currencies-plugin/' ) . '</em>', 'settings' ),
				'id'       => 'alg_wc_all_currencies_list_' . $list . '_options',
			),
		);
		foreach( $currencies as $code => $name ) {
			$settings = array_merge( $settings, array(
				array(
					'title'    => '[' . $code . '] ' . $name,
					'id'       => 'woocommerce_currencies_pro_currency_' . $code,
					'default'  => alg_wc_all_currencies()->core->get_default_currency_symbol( $code, $symbols[ $code ] ),
					'type'     => 'text',
					'custom_attributes' => apply_filters( 'alg_wc_all_currencies_filter', array( 'readonly' => 'readonly' ), 'settings' ),
				),
			) );
		}
		$settings = array_merge( $settings, array(
			array(
				'type'     => 'sectionend',
				'id'       => 'alg_wc_all_currencies_list_' . $list . '_options',
			),
		) );
		return $settings;
	}
}
