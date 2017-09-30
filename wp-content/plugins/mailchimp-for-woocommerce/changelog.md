** 2.0.2 **

* Added new logs feature to help troubleshoot isolated sync and data feed issues.
* Fixed bug with setting customers as Transactional during checkout if they had already opted in previously.
* Fixed bug where abandoned cart automation still fired after a customer completed an order.

** 2.0.1 **

##### New Features: #####
* MC.js support added.
* Added pop-up forms to the site details page with a warning to upgrade to 2.0.1 before using them.

##### Fixes: #####
* Adding physical address as a required field for store setup, since this is also a field required by MailChimp.
* Order/carts timestamps now pass over as UTC.
* Improved handling of Order Notification and sending Order Invoice and Order Confirmation simultaneously when order is moved to “Processing” in Woocommerce.
* Tabs paginating on store set up, moving the user through each step automatically.

** 2.0 ** 
* Support WooComerce 3.0 
* Support for manually uploaded WooCommerce plugin
* Fix for sync issues 
* Fix for guest orders sync issue 
* Remove MailChimp debug logger

** 1.1.1 ** 
* Support for site url changes
* Fix for WP Version 4.4 Compatibility issues

** 1.1.0 ** 
* Fix for persisting opt-in status
* Pass order URLs to MailChimp
* Pass partial refund status to MailChimp 

** 1.0.9 **
* billing and shipping address support for orders

** 1.0.8 **
* add landing_site, financial status and discount information for orders
* fix to support php 5.3

** 1.0.7 **
* add options to move, hide and change defaults for opt-in checkbox
* add ability to re-sync and display connection details
* support for subscriptions without orders
* additional small fixes and some internal logging removal

** 1.0.6 **
* fixed conflict with the plugin updater where the class could not be loaded correctly.
* fixed error validation for store name.
* fixed cross device abandoned cart url's

** 1.0.4 **
* fix for Abandoned Carts without cookies

** 1.0.3 **
* fixed cart posts on dollar amounts greater than 1000

** 1.0.2**
* title correction for Product Variants
* added installation checks for WooCommerce and phone contact info
support for free orders

** 1.0 **
* added is_synicng flag to prevent sends during backfill
* fix for conflicts with Gravity Forms Pro and installation issues
* skip all Amazon orders
* allow users to set opt-in for pre-existing customers during first sync
* add Plugin Updater

** 0.1.22 **
* flag quantity as 1 if the product does not manage inventory

** 0.1.21 **
* php version check to display warnings < 5.5

** 0.1.19 **
* fix campaign tracking on new orders

** 0.1.18 **
* check woocommerce dependency before activating the plugin

** 0.1.17 **
* fix php version syntax errors for array's

** 0.1.16 **
* fix namespace conflicts
* fix free order 0.00 issue
* fix product variant naming issue

** 0.1.15 **
* adding special MailChimp header to requests

** 0.1.14 **
* removing jquery dependencies

** 0.1.13 **
* fixing a number format issue on total_spent

** 0.1.12 **
* skipping orders placed through amazon due to seller agreements

** 0.1.11 **
* removed an extra debug log that was not needed

** 0.1.10 **
* altered debug logging and fixed store settings validation requirements

** 0.1.9 **
* using fallback to stream context during failed patch requests

** 0.1.8 **
* fixing http request header for larger patch requests

** 0.1.7 **
* fixing various bugs with the sync and product issues.

** 0.1.2 **
* fixed admin order update hook.
