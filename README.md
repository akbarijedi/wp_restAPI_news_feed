# === Latest Posts with Restful API ===
Contributors: Hadi Akbarijedi
Tags: news feed, rest
Requires at least: 5.5
Tested up to: 5.5
Stable tag: 1.0.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A WordPress plugin to get news feed in JSON format

### WordPress plugin to show:

- the latest news in JSON form
- One post show
- export one category in JSON format

This plugin sends posts in json format with restful api with rewrite ajax with catch ability

1. to get latest N content visit: (site_URL)/api/latestnews/(Number of POSTs - like 30)
2. to get one post content visit: (site_URL)/api/getpost/(post ID)
3. to get 'mobile_app_more' category posts just visit: (site_URL)/api/moretab/1

## Installation

1. Download the latest release from [HERE](https://github.com/akbarijedi/wp_restAPI_news_feed/releases/)
2. Go to your website admin page
3. Go to ADD NEW PLUGIN and upload zip file
4. (or) Upload the plugin folder to your /wp-content/plugins/ folder.
5. Go to the **Plugins** page and activate the plugin.
6. got to setting -> permalink and just hit save button to update routes!

## Frequently Asked Questions

### How do I use this plugin?

to get latest your post in json format with restful rewrite api

### How to uninstall the plugin?

Simply deactivate and delete the plugin.

## Changelog

### 1.0.0

- Plugin first released.

### 1.0.1

- Fix some bugs!
- Add latest post list and post picture image
- Add one post display

### 1.0.2

- add CROS ability

### 1.0.3

- add rewrite url output data in one json array

### 1.0.4

- add Category name to output

### 1.0.5

- add read from category name = 'mobile_app_more'
