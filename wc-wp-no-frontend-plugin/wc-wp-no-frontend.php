<?php
/*
Plugin Name:  WC WP No Frontend
Plugin URI:
Description:  Disables the frontend without blocking the REST API. (Suggested theme: WC WP No Frontend)
Version:      1.0
Author:       WiredCreation
Author URI:
License:
License URI:
*/

defined('ABSPATH') or die('No script kiddies please!');

/**
 * Avoid a front end and ensure only the admin login can be seen
 */
function wc_redirect_frontend_to_login(){
    if (!defined("REST_REQUEST") && !is_admin() && $GLOBALS['pagenow'] !== 'wp-login.php'){
        wp_redirect(site_url('wp-admin'));
        exit;
    }
}

add_action("parse_request", "wc_redirect_frontend_to_login");

function add_allowed_origins( $origins ) {
    $origins[] = 'http://body-link.ca';
    return $origins;
}
add_filter( 'allowed_http_origins', 'add_allowed_origins' );
