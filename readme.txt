=== Freshbooks Widget ===
Contributors: richard_steeleagency
Donate link: http://www.steele-agency.com/2010/06/freshbooks-wordpress-widget/
Tags: project management, Freshbooks, Freshbooks.com
Requires at least: 2.8
Tested up to: 3.1
Stable tag: 1.0

This plugin creates a simple sidebar widget that outputs the total hours billed for a FreshBooks account. 

== Description ==

As avid users of Freshbooks web-based accounting software, we are always looking for ways to integrate our project tracking and accounting in fun and useful ways. This plugin creates a simple sidebar widget that outputs the total hours billed for a FreshBooks account. 

Note: You will need the API URL and API token for your FreshBooks account, see [http://developers.freshbooks.com/](http://developers.freshbooks.com/)

Your FreshBooks API URL has a single point of entry, derived from your account URL:

[https://sample.freshbooks.com/api/2.1/xml-in](https://sample.freshbooks.com/api/2.1/xml-in)

After enabling API access for your account, you’ll be given a unique authentication token. The admin user, and each staff member, has an API token. The admin user’s authentication token can be found on the "enable FreshBooks API" page. The staff token can be found on each staff member’s Profile page, or on the Edit Staff page (for admin only). At this time, staff members have limited access to the API (see the individual method pages for details).

Please note your authentication token is based on your account password. If your password changes, so will your authentication token.

To use this widget, install the plugin and then in the widgets setup admin area drag the "Freshbooks Widget" to a sidebar. Input your Title, API URL, and API token. Note, using the Freshbooks Admin API token will return the number hours billed by the Admin user and all the Staff accounts associated with the Admin account (the entire team), whereas inputing a Staff token will output the hours billed by that staff user only.

* [Project Homepage](http://www.steele-agency.com/2010/06/freshbooks-wordpress-widget/)
* [Support](http://www.steele-agency.com/2010/06/freshbooks-wordpress-widget/#comments)


== Installation ==

1. To use this widget, install the plugin and then in the widgets setup admin area drag the "Freshbooks Widget" to a sidebar. Obtain your API URL and API token from GreshBooks.com. Input your Title, API URL, and API token. Note, using the Freshbooks Admin API token will return the number hours billed by the Admin user and all the Staff accounts associated with the Admin account (the entire team), whereas inputing a Staff token will output the hours billed by that staff user only. 

== Frequently Asked Questions ==

= What is required from my FreshBooks account =

You must enable API access for your account and then you’ll be given a unique authentication token. The admin user, and each staff member, has an API token.
Note, using the Freshbooks Admin API token with this plugin will return the number hours billed by the Admin user and all the Staff accounts associated with the Admin account (the entire team), whereas inputing a Staff token will output the hours billed by that staff user only. See [http://developers.freshbooks.com/](http://developers.freshbooks.com/)

= I'm getting a warning? =

Note: PHP will produce a warning if it is operating in "safe_mode" which will look something like this:
Warning: curl_setopt() [function.curl-setopt]: CURLOPT_FOLLOWLOCATION cannot be activated when in safe_mode or an open_basedir is set in /home/public_html/wp-content/plugins/freshbooks-widget/library/FreshBooks/HttpClient.php on line 79

Check with your host provider to turn-off "safe_mode" if this warning appears.

== Screenshots ==

1. Output in a sidebar
2. Administration widget

== Changelog ==

= 1.0 =
* Originating version.

== Upgrade Notice ==

= 1.0 =
Originating version.

