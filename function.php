<?php
/*
Plugin Name: MK Design Bridge Addons
Description: Fügt einig erweiterungen zur Bridge hinzu.
Version: 0.6.4
Author: Marcel Kaiser
Author URI: https://www.your-own-design.de/
*/


// Blog Addons
	include_once('inc/blog_overlay_box.php');

// Portfolio Addons
	include_once('inc/portfolio_box.php');
	//include_once('inc/portfolio_widget.php');
	include_once('inc/portfolio_list.php');

// Archiv Widget
	include_once('inc/archiv_widget.php');



// fertig überarbeitet
include_once('inc/box.php');
include_once('inc/box_list.php');

include_once('inc/overlay_box.php');



include_once('inc/icon_text.php');




include_once('inc/locations.php');
//include_once('inc/locations-rest-api.php');

// update plugin:
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/mrclksr2409/MK-Design-Bridge-Addons',
	__FILE__,
	'MKDesignBridgeAddons'
);

// Register the style like this for a plugin:
function mkd_addons_styles()
{
    wp_register_style( 'custom-style', plugins_url( '/css/mkd-addons.css', __FILE__ ), array(), '1', 'all' );
    wp_enqueue_style( 'custom-style' );
}
add_action( 'wp_enqueue_scripts', 'mkd_addons_styles' );
