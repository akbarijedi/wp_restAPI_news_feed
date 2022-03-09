=== Your Plugin Name ===
Contributors: Hadi Akbarijedi
Tags: news feed, rest
Requires at least: 5.5
Tested up to: 5.8
Stable tag: 1.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
 
A WordPress plugin to get news feed in JSON
 
== Description ==
 
This plugin send news in json format with restful api

1- to get latest N content visit: (site_URL)/api/latestnews/(Number of contents like 30)
2- to get one post content visit: (site_URL)/api/getpost/(post ID)
3- to get 'mobile_app_more' visit: (site_URL)/api/moretab/1

== Installation ==
 
1. Upload the plugin folder to your /wp-content/plugins/ folder.
2. Go to the **Plugins** page and activate the plugin.
 
== Frequently Asked Questions ==
 
= How do I use this plugin? =
 
to get latest news in json format with restful api
 
= How to uninstall the plugin? =
 
Simply deactivate and delete the plugin. 
 
== Screenshots ==
1. Description of the first screenshot. 
2. Description of the second screenshot.
 
== Changelog ==
= 1.0.0 =
* Plugin released.

= 1.0.1 =
* Fix some bug
* Add latest post list and post picture image
* Add one post display

= 1.0.2 =
* add CROS ability

= 1.0.3 =
* add rewrite url output data in one json array

= 1.0.4 =
* add Category name to output

= 1.0.5
* add read from category name = 'mobile_app_more'