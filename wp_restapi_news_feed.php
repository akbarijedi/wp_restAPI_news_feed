<?php

/**
 * Plugin Name: News JSON Restful API
 * Plugin URI: 
 * Description: Generate N latest News in RestFul API, in JSON format with news image URL | url to get latest news = (siteURL)/api/latestnews/(News Number)/ | to get 1 post = (siteURL)/api/getpost/(PostID)/ | to show 'mobile_app_more' category use (siteURL)/api/moretab/1/
 * Version: 1.0.5
 * Requires at least: 5.2
 * Requires PHP: 7.2
 * Author: Hadi Akbarijedi
 * Author URI: https://webstart.ir
 * License: GPL v2 or later 
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Text Domain: news-json-restful-feed
 *
 */


function add_custom_headers() {
    add_filter( 'rest_pre_serve_request', function( $value ) {
        header( 'Access-Control-Allow-Headers: Authorization, X-WP-Nonce,Content-Type, X-Requested-With');
        header( 'Access-Control-Allow-Origin: *' );
        header( 'Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE' );
        //header( 'Access-Control-Allow-Credentials: true' );
        return $value;
    } );
}
add_action( 'rest_api_init', 'add_custom_headers', 15 );

require 'inc/rewrite-api.php';
//require 'inc/rest-api.php';