<?php
/**
 * WooCommerce All Currencies - Currencies
 *
 * @version 2.1.1
 * @since   2.0.0
 * @author  Algoritmika Ltd.
 */

if ( ! function_exists( 'alg_wcac_get_all_currencies_names' ) ) {
	/**
	 * alg_wcac_get_all_currencies_names.
	 *
	 * @version 2.1.1
	 * @since   2.1.0
	 */
	function alg_wcac_get_all_currencies_names() {
		$result = array();
		if ( 'yes' === get_option( 'alg_wc_all_currencies_list_country_enabled', 'yes' ) ) {
			$result = array_merge( $result, alg_wcac_get_country_currencies_names() );
		}
		if ( 'yes' === get_option( 'alg_wc_all_currencies_list_crypto_enabled', 'yes' ) ) {
			$result = array_merge( $result, alg_wcac_get_crypto_currencies_names() );
		}
		return $result;
	}
}

if ( ! function_exists( 'alg_wcac_get_all_currencies_symbols' ) ) {
	/**
	 * alg_wcac_get_all_currencies_symbols.
	 *
	 * @version 2.1.1
	 * @since   2.1.0
	 */
	function alg_wcac_get_all_currencies_symbols() {
		$result = array();
		if ( 'yes' === get_option( 'alg_wc_all_currencies_list_country_enabled', 'yes' ) ) {
			$result = array_merge( $result, alg_wcac_get_country_currencies_symbols() );
		}
		if ( 'yes' === get_option( 'alg_wc_all_currencies_list_crypto_enabled', 'yes' ) ) {
			$result = array_merge( $result, alg_wcac_get_crypto_currencies_symbols() );
		}
		return $result;
	}
}

if ( ! function_exists( 'alg_wcac_get_country_currencies_names' ) ) {
	/**
	 * alg_wcac_get_country_currencies_names.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function alg_wcac_get_country_currencies_names() {
		return array(
			'AED' => __( 'UAE dirham', 'woocommerce-all-currencies' ),
			'AFN' => __( 'Afghan afghani', 'woocommerce-all-currencies' ),
			'ALL' => __( 'Albanian lek', 'woocommerce-all-currencies' ),
			'AMD' => __( 'Armenian dram', 'woocommerce-all-currencies' ),
			'ANG' => __( 'Netherlands Antillean gulden', 'woocommerce-all-currencies' ),
			'AOA' => __( 'Angolan kwanza', 'woocommerce-all-currencies' ),
			'ARS' => __( 'Argentine peso', 'woocommerce-all-currencies' ),
			'AUD' => __( 'Australian dollar', 'woocommerce-all-currencies' ),
			'AWG' => __( 'Aruban florin', 'woocommerce-all-currencies' ),
			'AZN' => __( 'Azerbaijani manat', 'woocommerce-all-currencies' ),
			'BAM' => __( 'Bosnia and Herzegovina konvertibilna marka', 'woocommerce-all-currencies' ),
			'BBD' => __( 'Barbadian dollar', 'woocommerce-all-currencies' ),
			'BDT' => __( 'Bangladeshi taka', 'woocommerce-all-currencies' ),
			'BGN' => __( 'Bulgarian lev', 'woocommerce-all-currencies' ),
			'BHD' => __( 'Bahraini dinar', 'woocommerce-all-currencies' ),
			'BIF' => __( 'Burundi franc', 'woocommerce-all-currencies' ),
			'BND' => __( 'Brunei dollar', 'woocommerce-all-currencies' ),
			'BOB' => __( 'Bolivian boliviano', 'woocommerce-all-currencies' ),
			'BRL' => __( 'Brazilian real', 'woocommerce-all-currencies' ),
			'BSD' => __( 'Bahamian dollar', 'woocommerce-all-currencies' ),
			'BTN' => __( 'Bhutanese ngultrum', 'woocommerce-all-currencies' ),
			'BWP' => __( 'Botswana pula', 'woocommerce-all-currencies' ),
			'BYR' => __( 'Belarusian ruble', 'woocommerce-all-currencies' ),
			'BZD' => __( 'Belize dollar', 'woocommerce-all-currencies' ),
			'CAD' => __( 'Canadian dollar', 'woocommerce-all-currencies' ),
			'CDF' => __( 'Congolese franc', 'woocommerce-all-currencies' ),
			'CHF' => __( 'Swiss franc', 'woocommerce-all-currencies' ),
			'CLP' => __( 'Chilean peso', 'woocommerce-all-currencies' ),
			'CNY' => __( 'Chinese renminbi', 'woocommerce-all-currencies' ),
			'COP' => __( 'Colombian peso', 'woocommerce-all-currencies' ),
			'CRC' => __( 'Costa Rican colon', 'woocommerce-all-currencies' ),
			'CUC' => __( 'Cuban peso', 'woocommerce-all-currencies' ),
			'CVE' => __( 'Cape Verdean escudo', 'woocommerce-all-currencies' ),
			'CZK' => __( 'Czech koruna', 'woocommerce-all-currencies' ),
			'DJF' => __( 'Djiboutian franc', 'woocommerce-all-currencies' ),
			'DKK' => __( 'Danish krone', 'woocommerce-all-currencies' ),
			'DOP' => __( 'Dominican peso', 'woocommerce-all-currencies' ),
			'DZD' => __( 'Algerian dinar', 'woocommerce-all-currencies' ),
			'EEK' => __( 'Estonian kroon', 'woocommerce-all-currencies' ),
			'EGP' => __( 'Egyptian pound', 'woocommerce-all-currencies' ),
			'ERN' => __( 'Eritrean nakfa', 'woocommerce-all-currencies' ),
			'ETB' => __( 'Ethiopian birr', 'woocommerce-all-currencies' ),
			'EUR' => __( 'European euro', 'woocommerce-all-currencies' ),
			'FJD' => __( 'Fijian dollar', 'woocommerce-all-currencies' ),
			'FKP' => __( 'Falkland Islands pound', 'woocommerce-all-currencies' ),
			'GBP' => __( 'British pound', 'woocommerce-all-currencies' ),
			'GEL' => __( 'Georgian lari', 'woocommerce-all-currencies' ),
			'GHS' => __( 'Ghanaian cedi', 'woocommerce-all-currencies' ),
			'GIP' => __( 'Gibraltar pound', 'woocommerce-all-currencies' ),
			'GMD' => __( 'Gambian dalasi', 'woocommerce-all-currencies' ),
			'GNF' => __( 'Guinean franc', 'woocommerce-all-currencies' ),
			'GQE' => __( 'Central African CFA franc', 'woocommerce-all-currencies' ),
			'GTQ' => __( 'Guatemalan quetzal', 'woocommerce-all-currencies' ),
			'GYD' => __( 'Guyanese dollar', 'woocommerce-all-currencies' ),
			'HKD' => __( 'Hong Kong dollar', 'woocommerce-all-currencies' ),
			'HNL' => __( 'Honduran lempira', 'woocommerce-all-currencies' ),
			'HRK' => __( 'Croatian kuna', 'woocommerce-all-currencies' ),
			'HTG' => __( 'Haitian gourde', 'woocommerce-all-currencies' ),
			'HUF' => __( 'Hungarian forint', 'woocommerce-all-currencies' ),
			'IDR' => __( 'Indonesian rupiah', 'woocommerce-all-currencies' ),
			'ILS' => __( 'Israeli new sheqel', 'woocommerce-all-currencies' ),
			'INR' => __( 'Indian rupee', 'woocommerce-all-currencies' ),
			'IQD' => __( 'Iraqi dinar', 'woocommerce-all-currencies' ),
			'IRR' => __( 'Iranian rial', 'woocommerce-all-currencies' ),
			'ISK' => __( 'Icelandic krona', 'woocommerce-all-currencies' ),
			'JMD' => __( 'Jamaican dollar', 'woocommerce-all-currencies' ),
			'JOD' => __( 'Jordanian dinar', 'woocommerce-all-currencies' ),
			'JPY' => __( 'Japanese yen', 'woocommerce-all-currencies' ),
			'KES' => __( 'Kenyan shilling', 'woocommerce-all-currencies' ),
			'KGS' => __( 'Kyrgyzstani som', 'woocommerce-all-currencies' ),
			'KHR' => __( 'Cambodian riel', 'woocommerce-all-currencies' ),
			'KIP' => __( 'Lao kip', 'woocommerce-all-currencies' ),
			'KMF' => __( 'Comorian franc', 'woocommerce-all-currencies' ),
			'KPW' => __( 'North Korean won', 'woocommerce-all-currencies' ),
			'KRW' => __( 'South Korean won', 'woocommerce-all-currencies' ),
			'KWD' => __( 'Kuwaiti dinar', 'woocommerce-all-currencies' ),
			'KYD' => __( 'Cayman Islands dollar', 'woocommerce-all-currencies' ),
			'KZT' => __( 'Kazakhstani tenge', 'woocommerce-all-currencies' ),
			'LBP' => __( 'Lebanese lira', 'woocommerce-all-currencies' ),
			'LKR' => __( 'Sri Lankan rupee', 'woocommerce-all-currencies' ),
			'LRD' => __( 'Liberian dollar', 'woocommerce-all-currencies' ),
			'LSL' => __( 'Lesotho loti', 'woocommerce-all-currencies' ),
			'LTL' => __( 'Lithuanian litas', 'woocommerce-all-currencies' ),
			'LVL' => __( 'Latvian lats', 'woocommerce-all-currencies' ),
			'LYD' => __( 'Libyan dinar', 'woocommerce-all-currencies' ),
			'MAD' => __( 'Moroccan dirham', 'woocommerce-all-currencies' ),
			'MDL' => __( 'Moldovan leu', 'woocommerce-all-currencies' ),
			'MGA' => __( 'Malagasy ariary', 'woocommerce-all-currencies' ),
			'MKD' => __( 'Macedonian denar', 'woocommerce-all-currencies' ),
			'MMK' => __( 'Myanma kyat', 'woocommerce-all-currencies' ),
			'MNT' => __( 'Mongolian tugrik', 'woocommerce-all-currencies' ),
			'MOP' => __( 'Macanese pataca', 'woocommerce-all-currencies' ),
			'MRO' => __( 'Mauritanian ouguiya', 'woocommerce-all-currencies' ),
			'MUR' => __( 'Mauritian rupee', 'woocommerce-all-currencies' ),
			'MVR' => __( 'Maldivian rufiyaa', 'woocommerce-all-currencies' ),
			'MWK' => __( 'Malawian kwacha', 'woocommerce-all-currencies' ),
			'MXN' => __( 'Mexican peso', 'woocommerce-all-currencies' ),
			'MYR' => __( 'Malaysian ringgit', 'woocommerce-all-currencies' ),
			'MZM' => __( 'Mozambican metical', 'woocommerce-all-currencies' ),
			'NAD' => __( 'Namibian dollar', 'woocommerce-all-currencies' ),
			'NGN' => __( 'Nigerian naira', 'woocommerce-all-currencies' ),
			'NIO' => __( 'Nicaraguan cordoba', 'woocommerce-all-currencies' ),
			'NOK' => __( 'Norwegian krone', 'woocommerce-all-currencies' ),
			'NPR' => __( 'Nepalese rupee', 'woocommerce-all-currencies' ),
			'NZD' => __( 'New Zealand dollar', 'woocommerce-all-currencies' ),
			'OMR' => __( 'Omani rial', 'woocommerce-all-currencies' ),
			'PAB' => __( 'Panamanian balboa', 'woocommerce-all-currencies' ),
			'PEN' => __( 'Peruvian nuevo sol', 'woocommerce-all-currencies' ),
			'PGK' => __( 'Papua New Guinean kina', 'woocommerce-all-currencies' ),
			'PHP' => __( 'Philippine peso', 'woocommerce-all-currencies' ),
			'PKR' => __( 'Pakistani rupee', 'woocommerce-all-currencies' ),
			'PLN' => __( 'Polish zloty', 'woocommerce-all-currencies' ),
			'PYG' => __( 'Paraguayan guarani', 'woocommerce-all-currencies' ),
			'QAR' => __( 'Qatari riyal', 'woocommerce-all-currencies' ),
			'RMB' => __( 'Chinese Yuan', 'woocommerce-all-currencies' ),
			'RON' => __( 'Romanian leu', 'woocommerce-all-currencies' ),
			'RSD' => __( 'Serbian dinar', 'woocommerce-all-currencies' ),
			'RUB' => __( 'Russian ruble', 'woocommerce-all-currencies' ),
			'RWF' => __( 'Rwandan franc', 'woocommerce-all-currencies' ),
			'SAR' => __( 'Saudi riyal', 'woocommerce-all-currencies' ),
			'SBD' => __( 'Solomon Islands dollar', 'woocommerce-all-currencies' ),
			'SCR' => __( 'Seychellois rupee', 'woocommerce-all-currencies' ),
			'SDG' => __( 'Sudanese pound', 'woocommerce-all-currencies' ),
			'SEK' => __( 'Swedish krona', 'woocommerce-all-currencies' ),
			'SGD' => __( 'Singapore dollar', 'woocommerce-all-currencies' ),
			'SHP' => __( 'Saint Helena pound', 'woocommerce-all-currencies' ),
			'SKK' => __( 'Slovak koruna', 'woocommerce-all-currencies' ),
			'SLL' => __( 'Sierra Leonean leone', 'woocommerce-all-currencies' ),
			'SOS' => __( 'Somali shilling', 'woocommerce-all-currencies' ),
			'SRD' => __( 'Surinamese dollar', 'woocommerce-all-currencies' ),
			'STD' => __( 'Sao Tome and Principe dobra', 'woocommerce-all-currencies' ),
			'SYP' => __( 'Syrian pound', 'woocommerce-all-currencies' ),
			'SZL' => __( 'Swazi lilangeni', 'woocommerce-all-currencies' ),
			'THB' => __( 'Thai baht', 'woocommerce-all-currencies' ),
			'TJS' => __( 'Tajikistani somoni', 'woocommerce-all-currencies' ),
			'TMM' => __( 'Turkmen manat', 'woocommerce-all-currencies' ),
			'TND' => __( 'Tunisian dinar', 'woocommerce-all-currencies' ),
			'TOP' => __( 'Paanga', 'woocommerce-all-currencies' ),
			'TRY' => __( 'Turkish new lira', 'woocommerce-all-currencies' ),
			'TTD' => __( 'Trinidad and Tobago dollar', 'woocommerce-all-currencies' ),
			'TWD' => __( 'New Taiwan dollar', 'woocommerce-all-currencies' ),
			'TZS' => __( 'Tanzanian shilling', 'woocommerce-all-currencies' ),
			'UAH' => __( 'Ukrainian hryvnia', 'woocommerce-all-currencies' ),
			'UGX' => __( 'Ugandan shilling', 'woocommerce-all-currencies' ),
			'USD' => __( 'United States dollar', 'woocommerce-all-currencies' ),
			'UYU' => __( 'Uruguayan peso', 'woocommerce-all-currencies' ),
			'UZS' => __( 'Uzbekistani som', 'woocommerce-all-currencies' ),
			'VEF' => __( 'Venezuelan bolivar', 'woocommerce-all-currencies' ),
			'VND' => __( 'Vietnamese dong', 'woocommerce-all-currencies' ),
			'VUV' => __( 'Vanuatu vatu', 'woocommerce-all-currencies' ),
			'WST' => __( 'Samoan tala', 'woocommerce-all-currencies' ),
			'XAF' => __( 'Central African CFA franc', 'woocommerce-all-currencies' ),
			'XCD' => __( 'East Caribbean dollar', 'woocommerce-all-currencies' ),
			'XDR' => __( 'Special Drawing Rights', 'woocommerce-all-currencies' ),
			'XOF' => __( 'West African CFA franc', 'woocommerce-all-currencies' ),
			'XPF' => __( 'CFP franc', 'woocommerce-all-currencies' ),
			'YER' => __( 'Yemeni rial', 'woocommerce-all-currencies' ),
			'ZAR' => __( 'South African rand', 'woocommerce-all-currencies' ),
			'ZMK' => __( 'Zambian kwacha', 'woocommerce-all-currencies' ),
			'ZWD' => __( 'Zimbabwean dollar', 'woocommerce-all-currencies' ),
		);
	}
}

if ( ! function_exists( 'alg_wcac_get_crypto_currencies_names' ) ) {
	/**
	 * alg_wcac_get_crypto_currencies_names.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function alg_wcac_get_crypto_currencies_names() {
		return array(
			'AUR' => __( 'Auroracoin', 'woocommerce-all-currencies' ),
			'BTC' => __( 'Bitcoin', 'woocommerce-all-currencies' ),
			'BCC' => __( 'BitConnect', 'woocommerce-all-currencies' ),
			'KOI' => __( 'Coinye', 'woocommerce-all-currencies' ),
			'XDN' => __( 'DigitalNote', 'woocommerce-all-currencies' ),
			'EMC' => __( 'Emercoin', 'woocommerce-all-currencies' ),
			'ETH' => __( 'Ethereum', 'woocommerce-all-currencies' ),
			'ETC' => __( 'Ethereum Classic', 'woocommerce-all-currencies' ),
			'FMC' => __( 'Freemasoncoin', 'woocommerce-all-currencies' ),
			'GRC' => __( 'Gridcoin', 'woocommerce-all-currencies' ),
			'IOT' => __( 'IOTA', 'woocommerce-all-currencies' ),
			'LTC' => __( 'Litecoin', 'woocommerce-all-currencies' ),
			'MZC' => __( 'MazaCoin', 'woocommerce-all-currencies' ),
			'XMR' => __( 'Monero', 'woocommerce-all-currencies' ),
			'NMC' => __( 'Namecoin', 'woocommerce-all-currencies' ),
			'XEM' => __( 'NEM', 'woocommerce-all-currencies' ),
			'NXT' => __( 'Nxt', 'woocommerce-all-currencies' ),
			'MSC' => __( 'Omni', 'woocommerce-all-currencies' ),
			'PPC' => __( 'Peercoin', 'woocommerce-all-currencies' ),
			'POT' => __( 'PotCoin', 'woocommerce-all-currencies' ),
			'XPM' => __( 'Primecoin', 'woocommerce-all-currencies' ),
			'XRP' => __( 'Ripple', 'woocommerce-all-currencies' ),
			'SIL' => __( 'SixEleven', 'woocommerce-all-currencies' ),
			'AMP' => __( 'Synereo AMP', 'woocommerce-all-currencies' ),
			'TIT' => __( 'Titcoin', 'woocommerce-all-currencies' ),
			'UBQ' => __( 'Ubiq', 'woocommerce-all-currencies' ),
			'VTC' => __( 'Vertcoin', 'woocommerce-all-currencies' ),
			'ZEC' => __( 'Zcash', 'woocommerce-all-currencies' ),
//			'MYC' => __( 'myCRED', 'woocommerce-all-currencies' ),
		);
	}
}

if ( ! function_exists( 'alg_wcac_get_country_currencies_symbols' ) ) {
	/**
	 * alg_wcac_get_country_currencies_symbols.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function alg_wcac_get_country_currencies_symbols() {
		return array(
			'AED' => 'AED',
			'AFN' => 'AFN',
			'ALL' => 'ALL',
			'AMD' => 'AMD',
			'ANG' => 'ANG',
			'AOA' => 'AOA',
			'ARS' => 'ARS',
			'AUD' => '&#36;',
			'AWG' => 'AWG',
			'AZN' => 'AZN',
			'BAM' => 'BAM',
			'BBD' => 'BBD',
			'BDT' => 'BDT',
			'BGN' => 'BGN',
			'BHD' => 'BHD',
			'BIF' => 'BIF',
			'BND' => 'BND',
			'BOB' => 'BOB',
			'BRL' => '&#82;&#36;',
			'BSD' => 'BSD',
			'BTN' => 'BTN',
			'BWP' => 'BWP',
			'BYR' => 'BYR',
			'BZD' => 'BZD',
			'CAD' => 'CAD',
			'CDF' => 'CDF',
			'CHF' => '&#67;&#72;&#70;',
			'CLP' => 'CLP',
			'CNY' => '&yen;',
			'COP' => 'COP',
			'CRC' => 'CRC',
			'CUC' => 'CUC',
			'CVE' => 'CVE',
			'CZK' => '&#75;&#269;',
			'DJF' => 'DJF',
			'DKK' => '&#107;&#114;',
			'DOP' => 'DOP',
			'DZD' => 'DZD',
			'EEK' => 'EEK',
			'EGP' => 'EGP',
			'ERN' => 'ERN',
			'ETB' => 'ETB',
			'EUR' => '&euro;',
			'FJD' => 'FJD',
			'FKP' => 'FKP',
			'GBP' => '&pound;',
			'GEL' => 'GEL',
			'GHS' => 'GHS',
			'GIP' => 'GIP',
			'GMD' => 'GMD',
			'GNF' => 'GNF',
			'GQE' => 'GQE',
			'GTQ' => 'GTQ',
			'GYD' => 'GYD',
			'HKD' => '&#36;',
			'HNL' => 'HNL',
			'HRK' => 'HRK',
			'HTG' => 'HTG',
			'HUF' => '&#70;&#116;',
			'IDR' => 'Rp',
			'ILS' => '&#8362;',
			'INR' => '&#8377;',
			'IQD' => 'IQD',
			'IRR' => 'IRR',
			'ISK' => 'ISK',
			'JMD' => 'JMD',
			'JOD' => 'JOD',
			'JPY' => '&yen;',
			'KES' => 'KES',
			'KGS' => 'KGS',
			'KHR' => 'KHR',
			'KIP' => 'KIP',
			'KMF' => 'KMF',
			'KPW' => 'KPW',
			'KRW' => '&#8361;',
			'KWD' => 'KWD',
			'KYD' => 'KYD',
			'KZT' => 'KZT',
			'LBP' => 'LBP',
			'LKR' => 'LKR',
			'LRD' => 'LRD',
			'LSL' => 'LSL',
			'LTL' => 'LTL',
			'LVL' => 'LVL',
			'LYD' => 'LYD',
			'MAD' => 'MAD',
			'MDL' => 'MDL',
			'MGA' => 'MGA',
			'MKD' => 'MKD',
			'MMK' => 'MMK',
			'MNT' => 'MNT',
			'MOP' => 'MOP',
			'MRO' => 'MRO',
			'MUR' => 'MUR',
			'MVR' => 'MVR',
			'MWK' => 'MWK',
			'MXN' => '&#36;',
			'MYR' => '&#82;&#77;',
			'MZM' => 'MZM',
			'NAD' => 'NAD',
			'NGN' => 'NGN',
			'NIO' => 'NIO',
			'NOK' => '&#107;&#114;',
			'NPR' => 'NPR',
			'NZD' => '&#36;',
			'OMR' => 'OMR',
			'PAB' => 'PAB',
			'PEN' => 'PEN',
			'PGK' => 'PGK',
			'PHP' => '&#8369;',
			'PKR' => 'PKR',
			'PLN' => '&#122;&#322;',
			'PYG' => 'PYG',
			'QAR' => 'QAR',
			'RMB' => '&yen;',
			'RON' => 'lei',
			'RSD' => 'RSD',
			'RUB' => 'RUB',
			'RWF' => 'RWF',
			'SAR' => 'SAR',
			'SBD' => 'SBD',
			'SCR' => 'SCR',
			'SDG' => 'SDG',
			'SEK' => '&#107;&#114;',
			'SGD' => '&#36;',
			'SHP' => 'SHP',
			'SKK' => 'SKK',
			'SLL' => 'SLL',
			'SOS' => 'SOS',
			'SRD' => 'SRD',
			'STD' => 'STD',
			'SYP' => 'SYP',
			'SZL' => 'SZL',
			'THB' => '&#3647;',
			'TJS' => 'TJS',
			'TMM' => 'TMM',
			'TND' => 'TND',
			'TOP' => 'TOP',
			'TRY' => '&#84;&#76;',
			'TTD' => 'TTD',
			'TWD' => '&#78;&#84;&#36;',
			'TZS' => 'TZS',
			'UAH' => 'UAH',
			'UGX' => 'UGX',
			'USD' => '&#36;',
			'UYU' => 'UYU',
			'UZS' => 'UZS',
			'VEF' => 'VEF',
			'VND' => 'VND',
			'VUV' => 'VUV',
			'WST' => 'WST',
			'XAF' => 'XAF',
			'XCD' => 'XCD',
			'XDR' => 'XDR',
			'XOF' => 'XOF',
			'XPF' => 'XPF',
			'YER' => 'YER',
			'ZAR' => '&#82;',
			'ZMK' => 'ZMK',
			'ZWD' => 'ZWD',
		);
	}
}

if ( ! function_exists( 'alg_wcac_get_crypto_currencies_symbols' ) ) {
	/**
	 * alg_wcac_get_crypto_currencies_symbols.
	 *
	 * @version 2.1.1
	 * @since   2.1.1
	 */
	function alg_wcac_get_crypto_currencies_symbols() {
		return array(
			'AUR' => 'AUR',
			'BTC' => '&#3647;',
			'BCC' => 'BCC',
			'KOI' => 'KOI',
			'XDN' => 'XDN',
			'EMC' => 'EMC',
			'ETH' => 'ETH',
			'ETC' => 'ETC',
			'FMC' => 'FMC',
			'GRC' => 'GRC',
			'IOT' => 'IOT',
			'LTC' => 'LTC',
			'MZC' => 'MZC',
			'XMR' => 'XMR',
			'NMC' => 'NMC',
			'XEM' => 'XEM',
			'NXT' => 'NXT',
			'MSC' => 'MSC',
			'PPC' => 'PPC',
			'POT' => 'POT',
			'XPM' => 'XPM',
			'XRP' => 'XRP',
			'SIL' => 'SIL',
			'AMP' => 'AMP',
			'TIT' => 'TIT',
			'UBQ' => 'UBQ',
			'VTC' => 'VTC',
			'ZEC' => 'ZEC',
//			'MYC' => 'MYC',
		);
	}
}
