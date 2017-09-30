=== UTM Switcher ===
Donate link: https://jeffshamley.com/
Tags: utm, utm-switcher
Requires at least: 4.3
Tested up to: 4.5.2
Stable tag: 1.0.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The UTM Switcher is a powerful tool to help you track where your site visitors are coming from.

== Description ==

= UTM Switcher =

The UTM Switcher is a powerful tool to help you track _where_ your site visitors are coming from and modify page elements based upon a utm_source GET variable in a url. It notes where a site visitor first lands, and then proactively changes targeted elements across your entire website to match that source.

= Keep track of your leads =

In digital marketing, it can be difficult to figure out which of your channels is getting the best results: whether it’s Adwords, facebook paid advertising, blogging, or something else. For this reason, some companies use landing pages with different phone numbers to track the source of a lead. However, typical customers have multiple interactions with a site before following any call to action. They may click through several pages before making a decision. That’s where UTM Switcher comes in.

= How it works =

UTM Switchers uses cookies to keep your lead-specific content consistent across all pages. The cookies are only destroyed once the website is closed. It works with all Wordpress sites and features integrations with Contact Form 7 and Contact Form DB. The information stored is taken from the URL's GET variables utm_source, utm_medium, and utm_campaign

When a UTM Switcher finds a matching DOM element using jQuery, it replaces the content of that element with the value supplied in the switch. Each Switcher can be set to match a specific utm_source in the URL or stored as a cookie value to the specific DOM element. An example of this is if the utm_source value is Facebook change the value to 1234 and if the utm_source value is Twitter change the targeted element to 4321. Each Switcher can also be set to replace the value with a tel: anchor tag for use with a call tracking plugin.

You can read more about the [call tracking plugin here](https://www.betoplocal.com/call-tracking-plugin/).

= Recommended PHP Version =
PHP 5.4 or greater

= Required plugins =

None

= Recommended plugins =

Contact Form 7 - If you choose, the UTM information can be sent in your form email. This information will include the information gathered from the initial URL GET variables utm_source, utm_medium, and utm_campaign. These values are then passed along to the email via a shortcode, e.g. [utm-100] 

Contact Form DB - This extension is not required, but we do recommend it.

= Usage =

1. Under UTM Switchers, click Add New

2. Enter an Identifier -- this is for internal use only. You could use it to keep track of what the switch does

3. Enter an selector (an #ID or .classname or other selector) to target. This field uses [jQuery syntax](http://api.jquery.com/category/selectors/)

4. Choose the Type. Phone Number Element will replace the whole element with an anchor link with a tel: attribute. Text replacement replaces all text in the above element

5. Click "Add Switcher" under UTM Source Switchers. A matching value in the Campaign Source field to the utm_source GET variable will replace the above selector's content with the value in the Replacement Value field. HTML can be used. You may add multple switches for different UTM Sources

6. Click Publish.

= Contribute =

To report any bugs, or to offer features, please use our [GitHub repository](https://github.com/Shamley/UTM-Switcher)

== Installation ==

= Minimum Requirements =

* WordPress 3.8 or greater
* PHP version 5.4 or greater
* MySQL version 5.0 or greater

= Using The WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Search for 'utm-switcher'
3. Click 'Install Now'
4. Activate the plugin on the Plugin dashboard

= Uploading in WordPress Dashboard =

1. Navigate to the 'Add New' in the plugins dashboard
2. Navigate to the 'Upload' area
3. Select `utm-switcher.zip` from your computer
4. Click 'Install Now'
5. Activate the plugin in the Plugin dashboard

= Using FTP =

1. Download `utm-switcher.zip`
2. Extract the `utm-switcher` directory to your computer
3. Upload the `utm-switcher` directory to the `/wp-content/plugins/` directory
4. Activate the plugin in the Plugin dashboard

== Screenshots ==

1. UTM Switcher Add New page.
2. When used with Contact Form 7, a UTM button appears that allows you to add the UTM fields in the form.
3. When used with Contact Form 7, add the UTM shortcode into the Message body field.
4. When emailed, the contact will receive the information obtained through the UTM shortcode

== Changelog ==

= 1.0.0 =
* Initial commit.

= 1.0.1 =
* Update README.txt to include screenshots and link to Github repo.

= 1.0.2 =
* Update README.txt with more information.

== Updates ==

The basic structure of this plugin was cloned from the [WordPress-Plugin-Boilerplate](https://github.com/tommcfarlin/WordPress-Plugin-Boilerplate) project.