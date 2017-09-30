=== Plugin Name ===
Contributors: alekv
Donate link: http://www.wolfundbaer.ch/donations/
Tags: woocommerce, woocommerce conversion tracking, google adwords, adwords, conversion, conversion value, conversion tag, conversion pixel, conversion value tracking, conversion tracking, conversion tracking adwords, conversion tracking pixel, conversion tracking script, track conversions, tracking code manager
Requires at least: 3.1
Tested up to: 4.8.1
Stable tag: 1.4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Track the dynamic order value in AdWords from WooCommerce

== Description ==

This plugin <strong>tracks the value of WooCommerce orders in Google AdWords</strong>. With this you can optimize all your AdWords campaings to achieve maximum efficiency.

<strong>Highlights</strong>

* Very accurate by preventing duplicate reporting effectively, excluding admins and shop managers from tracking, and not counting failed payments.
* Very easy to install and maintain.

<strong>Requirements</strong>

* The payment gateway **must** support on-site payments. If you want to use an off-site payment solution like the free PayPal extension you need to make sure that the visitor is being redirected back to the WooCommerce thankyou page after the successful transaction. Only if the redirection is set up properly and the visitor doesn't stop the redirection, only then the conversion will be counted.
* As this is a free plugin we only support recent versions of WooCommerce, WordPress and PHP. We don't maintain backward compatibility.

<strong>Other plugins</strong>

If you like this plugin you might like that one too: https://wordpress.org/plugins/woocommerce-google-dynamic-retargeting-tag/

<strong>Supported languages</strong>

* English
* German
* Serbian ( by Adrijana Nikolic http://webhostinggeeks.com )
 
== Installation ==

1. Upload the plugin directory into your plugins directory `/wp-content/plugins/`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Get the AdWords conversion ID and the conversion label. You will find both values in the AdWords conversion tracking code.
4. In the WordPress admin panel go to WooCommerce and then into the 'AdWords Conversion Tracking' menu. Please enter the conversion ID and the conversion label into their respective fields.

== Frequently Asked Questions ==

= How do I check if the plugin is working properly? =

1. Log out of the shop.
2. Search for one of your keywords and click on one of your ads.
3. Purchase an item from your shop.
4. Wait until the conversion shows up in AdWords.

With the Google Tag Assistant you will also be able to see the tag fired on the thankyou page.

= Google Tag Assistant reports that the plugin uses a non-optimized or not standard way of implementation (and suggests to use script based tracking). Why is that so? =

The plugin currently uses only the image pixel based conversion tracking. The reason is a WordPress filter that changes and disables the script based tracking. Unfortunately that filter cannot be turned off. The problem has been reported as a bug long time ago: https://core.trac.wordpress.org/ticket/3670

There is an experimental way to circumvent above mentioned filter, but it possibly will not work for all installations, probably even breaking some themes. So we stuck with the image based pixel for maximum compatibility.

The image pixel conversion tracking works absolutely fine so far. So you can keep using it.

Once we find a way to implement the script based tracking while keeping the same maximum compatibility level, we will release that to the public.

= I get a fatal error and I am running old versions of WordPress and/or WooCommerce. What can I do? =

As this is a free plugin we don't support old version of WordPress and WooCommerce. You will have to update your installation.

= I am using an offsite payment gateway and the conversions are not being tracked. What can I do? =

We don't support if an offsite payment gateway is in use. The reason is that those cases can be complex and time consuming. We don't want to cover this for a free plugin. We do not recommend offsite payment gateways anyway. A visitor can stop the redirection manually which prevents at least some conversions to be tracked. Also offsite payment gateways are generally bad for the conversion rate.

= Where can I report a bug or suggest improvements? =

Please post your problem in the WGACT Support forum: http://wordpress.org/support/plugin/woocommerce-google-adwords-conversion-tracking-tag
You can send the link to the front page of your shop too if you think it would be of help.

== Screenshots ==
1. Settings page

== Changelog ==

= 1.4.3 =
* Tweak: Remove campaign URL parameter
= 1.4.2 =
* Fix: Backward compatibility for $order->get_currency()
= 1.4.1 =
* Tweak: Making the plugin PHP 5.4 backwards compatible
* Fix: Fixing double counting check logic
= 1.4 =
* New: Ask kindly for a rating of the plugin
* New: Add a radio button to use different styles of order total
* Tweak: Consolidate options into one array
* Tweak: Code cleanup
= 1.3.6 =
* New: WordPress 4.8 compatibility update
* Tweak: Minor text tweak.
= 1.3.5 =
* Fix: Fixed a syntax error that caused issues on some installations.
= 1.3.4 =
* Tweak: Added some text output to make debugging for users easier.
= 1.3.3 =
* Tweak: Refurbishment of the settings page
= 1.3.2 =
* New: Uninstall routine
= 1.3.1 =
* New: Keep old deduplication logic in the code as per recommendation by AdWords
= 1.3.0 =
* New: AdWords native order ID deduplication variable
= 1.2.2 =
* New: Filter for the conversion value
= 1.2.1 =
* Fix: wrong conversion value fix
= 1.2 =
* New: Filter for the conversion value
= 1.1 =
* Tweak: Code cleanup
* Tweak: To avoid over reporting only insert the retargeting code for visitors, not shop managers and admins
= 1.0.6 =
* Tweak: Switching single pixel function from transient to post meta
= 1.0.5 =
* Fix: Adding session handling to avoid duplications
= 1.0.4 =
* Fix: Skipping a tag version
= 1.0.3 =
* Fix: Implement different logic to exclude failed orders as the old one is too restrictive
= 1.0.2 =
* Fix: Exclude orders where the payment has failed
= 1.0.1 =
* New: Banner and icon
* Update: Name change
= 1.0 =
* New: Translation into Serbian by Adrijana Nikolic from http://webhostinggeeks.com
* Update: Release of version 1.0!
= 0.2.4 =
* Update: Minor update to the internationalization
= 0.2.3 =
* Update: Minor update to the internationalization
= 0.2.2 =
* New: The plugin is now translation ready
= 0.2.1 =
* Update: Improving plugin security
* Update: Moved the settings to the submenu of WooCommerce
= 0.2.0 =
* Update: Further improving cross browser compatibility
= 0.1.9 =
* Update: Implemented a much better workaround tor the CDATA issue
* Update: Implemented the new currency field
* Fix: Corrected the missing slash dot after the order value
= 0.1.8 =
* Fix: Corrected the plugin source to prevent an error during activation 
= 0.1.7 =
* Significantly improved the database access to evaluate the order value.
= 0.1.6 =
* Added some PHP code to the tracking tag as recommended by Google. 
= 0.1.5 =
* Added settings field to the plugin page.
* Visual improvements to the options page.
= 0.1.4 =
* Changed the woo_foot hook to wp_footer to avoid problems with some themes. This should be more compatible with most themes as long as they use the wp_footer hook. 
= 0.1.3 =
* Changed conversion language to 'en'. 
= 0.1.2 =
* Disabled the check if WooCommerce is running. The check doesn't work properly with multisite WP installations, though the plugin does work with the multisite feature turned on. 
* Added more description in the code to explain why I've build a workaround to not place the tracking code into the thankyou template of WC.
= 0.1.1 =
* Some minor changes to the code
= 0.1 =
* This is the initial release of the plugin. There are no known bugs so far.
