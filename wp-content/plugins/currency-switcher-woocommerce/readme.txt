=== Currency Switcher for WooCommerce ===
Contributors: algoritmika,anbinder
Tags: woocommerce, currency switcher, multicurrency, woo commerce, algoritmika
Requires at least: 4.1
Tested up to: 4.8
Stable tag: 2.5.2
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Currency Switcher for WooCommerce.

== Description ==

Currency Switcher for WooCommerce.

= Features =
* Automatic currency exchange rates updates.
* Prices on per product basis.
* Currency by country (i.e. by IP).
* Currency by language (i.e. locale).
* Option to revert to original currency on checkout.
* Various currency switcher placement and format options.
* Option to add currency switcher as widget or as shortcodes.

= Currency Switcher Shortcodes =
* `[woocommerce_currency_switcher_drop_down_box]` - currency switcher in drop down box format.
* `[woocommerce_currency_switcher_radio_list]` - currency switcher in radio list format.
* `[woocommerce_currency_switcher_link_list]` - currency switcher in links list format.

= More Shortcodes =
* `[woocommerce_currency_switcher_product_price_table]` - product prices preview in all currencies.
* `[woocommerce_currency_switcher_convert_price]` - convert any price to another currency.

= Feedback =
* We are open to your suggestions and feedback. Thank you for using or trying out one of our plugins!
* Drop us a line at [www.algoritmika.com](http://www.algoritmika.com).

= More =
* Visit the [Currency Switcher for WooCommerce plugin page](https://wpcodefactory.com/item/currency-switcher-woocommerce-wordpress-plugin/).

== Installation ==

1. Upload the entire 'currency-switcher-woocommerce' folder to the '/wp-content/plugins/' directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Start by visiting plugin settings at WooCommerce > Settings > Currency Switcher.

== Screenshots ==

1. Currency Switcher for WooCommerce - Currencies.
2. Currency Switcher for WooCommerce - Exchange Rates.
3. Currency Switcher for WooCommerce - Currency Countries (by IP).
4. Currency Switcher for WooCommerce - General.
5. Currency Switcher for WooCommerce - General - Switcher Placement and Format.
6. Currency Switcher for WooCommerce - General - Exchange Rates Final Price Correction.
7. Currency Switcher for WooCommerce - General - Advanced Options.
8. Currency Switcher for WooCommerce - Price Formats.
9. Currency Switcher for WooCommerce - Languages.
10. Currency Switcher for WooCommerce - Shortcodes - Product Price Table.

== Changelog ==

= 2.5.2 - 05/09/2017 =
* Dev - General - Switcher Placement and Format Options - "Link List Switcher - Separator" option added.

= 2.5.1 - 03/09/2017 =
* Fix - Price Formats - "Currency Code" option renamed to "Currency Symbol".
* Dev - Flags - Settings description updated.

= 2.5.0 - 02/09/2017 =
* Dev - `format_price` attribute (defaults to `yes`) added to `alg_convert_price()` function (and `[woocommerce_currency_switcher_convert_price]` shortcode).
* Dev - "Currency Languages (Locales)" section added.
* Dev - General - "Show Flags in Admin Settings Section" option added.
* Dev - General - Settings section restyled.
* Dev - Countries - "Enter Countries as Comma Separated Text" option added.
* Dev - Countries - Section renamed from "Currency Countries (by IP)".
* Dev - Price Formats - "Currency Code" options added.
* Dev - Minor code refactoring.

= 2.4.4 - 02/08/2017 =
* Dev - Flags added.

= 2.4.3 - 30/07/2017 =
* Fix - General - Pretty Price - If "Price Formats" section is enabled - now uses corresponding currency "Number of decimals" instead of shop's default.
* Dev - General - Advanced Options - "Apply Rounding and Pretty Price to Shop's Default Currency" option added.
* Dev - Price Format - Default shop currency added ("Additional currency code position (optional)" as new option; other options are copied from "WooCommerce > Settings > General").
* Dev - Functions - `alg_get_product_price_by_currency()` - Code refactoring.

= 2.4.2 - 29/07/2017 =
* Fix - Skipping price by currency calculation for shop default currency (this fixes the issue with original prices rounded, when rounding is enabled).
* Fix - Skipping price formatting for shop default currency.

= 2.4.1 - 28/07/2017 =
* Dev - `[woocommerce_currency_switcher_convert_price]` shortcode added.

= 2.4.0 - 03/07/2017 =
* Dev - "Price Formats" section added.
* Dev - "Reset settings" option added.
* Dev - Autoloading plugin options.
* Dev - Code cleanup.
* Dev - Plugin link updated from <a href="http://coder.fm">http://coder.fm</a> to <a href="https://wpcodefactory.com">https://wpcodefactory.com</a>.

= 2.3.1 - 21/05/2017 =
* Dev - "Apply Currency Conversion for Fixed Amount Coupons" option added.

= 2.3.0 - 14/04/2017 =
* Dev - WooCommerce v3.x.x compatibility - Price filters.
* Dev - WooCommerce v3.x.x compatibility - Product ID.
* Dev - WooCommerce v3.x.x compatibility - `alg_get_product_display_price()`.
* Dev - WooCommerce v3.x.x compatibility - `wc_get_formatted_variation()`.
* Fix - `alg_get_product_price_html_by_currency()` - variable and grouped products fixed.
* Dev - Functions - `alg_get_exchange_rate_yahoo()` - cURL prioritized over `allow_url_fopen` (`file_get_contents()`).
* Tweak - Per product settings metabox restyled.

= 2.2.4 - 11/03/2017 =
* Dev - General - "Switcher Wrapper" option added.
* Dev - General - Switcher Item Format - `%currency_symbol%` value added.
* Dev - General - Switcher Item Format - `%product_price%` value added.
* Dev - `[woocommerce_currency_switcher_product_price_table]` shortcode added.
* Dev - Code refactoring.

= 2.2.3 - 06/03/2017 =
* Dev - General - "Reposition Page after Currency Switch" option added.

= 2.2.2 - 01/03/2017 =
* Dev - Functions - `alg_get_exchange_rate_yahoo()` - cURL fallback added for Yahoo server rates (in case `allow_url_fopen` is disabled).
* Dev - Functions - `alg_get_exchange_rate_yahoo()` - Time limit (`set_time_limit()`) increased to 10 seconds.
* Dev - Language (POT) file updated.

= 2.2.1 - 20/02/2017 =
* Dev - Free shipping minimum order amount conversion by currency added.
* Dev - Language (POT) file updated.
* Tweak - General - Settings divided in sections.

= 2.2.0 - 19/02/2017 =
* Fix - Rounding and Precision added to variable hash.
* Dev - General - "Make Pretty Price" option added.
* Dev - Exchange Rates - "Exchange Rates Server" option added (and "European Central Bank" server added).
* Dev - JS "grab exchange rate" button changed to AJAX.
* Dev - Autoload set to `no` in `add_option`.
* Dev - Language (POT) file updated.
* Tweak - Link to "All Currencies for WooCommerce" plugin added.

= 2.1.1 - 31/12/2016 =
* Dev - Admin - General - "Advanced: Fix Mini Cart" option added.
* Dev - Admin - General - "Switcher Format" option added.
* Dev - Admin - General - "Advanced: Additional Price Filters" option added.
* Dev - Language (POT) file updated.
* Tweak - Tag added.

= 2.1.0 - 14/12/2016 =
* Dev - Admin - General - "Advanced: Disable on URI" option added.

= 2.0.0 - 08/12/2016 =
* Dev - Admin - Exchange Rates - "Reset All Rates" button added.
* Dev - Admin - Currencies - "Update All Exchange Rates Now" button added.
* Dev - Admin - Currencies - "Auto Generate PayPal Supported Currencies" button added.
* Dev - "Currency Countries (by IP)" section added.
* Fix - `load_plugin_textdomain` moved to constructor.
* Tweak - `get_woocommerce_currency()` replaced with `get_option( 'woocommerce_currency' )`.
* Tweak - Admin - Exchange Rates - Full currency name and number added.
* Tweak - Admin - Exchange Rates - "Grab rate" button restyled.
* Tweak - Admin - Currencies - "Currency (Shop's Default)" added.
* Tweak - Admin - Currencies - Code added to currency name in list.
* Tweak - Tooltip added to custom number admin settings.
* Tweak - Check for Pro rewritten.
* Tweak - Author added.
* Tweak - Major code refactoring.

= 1.0.1 - 04/08/2016 =
* Fix - `custom_number` replaced with `alg_custom_number` - this fixes the issue with "Total Currencies" field duplicating.
* Dev - Language (POT) file added.

= 1.0.0 - 24/07/2016 =
* Initial Release.

== Upgrade Notice ==

= 1.0.0 =
This is the first release of the plugin.
