<?php
/*
Plugin Name: WP Google Custom Search Engine
Plugin URI: https://github.com/eartahhj/wp-google-cse
Description: The Google CSE integrated with the API from Google Cloud: add a custom search engine to your website, showing search results without ads!
Text-Domain: wp-google-cse
Version: 1.0.0
Author: eartahhj
Author URI: https://www.codinghouse.it/
License: GPLv2 or later
Requires at least: 5.0.0
Tested up to: 6.0.1
*/

use \CodingHouse\WPPlugins\GoogleCSE\Plugin;

require_once __DIR__ . '/CodingHouse/WPPlugins/GoogleCSE/Plugin.php';

$wpGoogleCsePlugin = new \CodingHouse\WPPlugins\GoogleCSE\Plugin();

register_activation_hook(__FILE__, ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'activate']);
register_deactivation_hook(__FILE__, ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'deactivate']);
register_uninstall_hook(__FILE__, ['\CodingHouse\WPPlugins\GoogleCSE\Plugin', 'uninstall']);

$wpGoogleCsePlugin->register();
