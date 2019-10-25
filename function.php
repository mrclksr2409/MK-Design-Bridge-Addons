<?php
/*
Plugin Name: MK Design Bridge Addons
Description: Fügt einig erweiterungen zur Bridge hinzu.
Version: 0.1
Author: Marcel Kaiser
Author URI: https://www.your-own-design.de/
*/

include_once('inc/icon_text.php');
include_once('inc/page_box.php'); 

include_once('inc/blog_box.php');
include_once('inc/blog_overlay_box.php');

include_once('inc/portfolio_widget.php');
include_once('inc/portfolio_box.php');
include_once('inc/portfolio_list.php');

include_once('inc/locations.php');
include_once('inc/locations-rest-api.php');

// update plugin:
require 'plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'http://wp-plugins.your-own-design.de/mk-design-bridge-addons/plugin.json',
	__FILE__, //Full path to the main plugin file or functions.php.
	'PTCAddons'
);

// Register the style like this for a plugin:
function wptuts_styles_with_the_lot()
{
    wp_register_style( 'custom-style', plugins_url( '/css/mkd-addons.css', __FILE__ ), array(), '1', 'all' );
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'wptuts_styles_with_the_lot' );
