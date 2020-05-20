<?php
/*
* Plugin Name: TBO NewsPortal
* Plugin URI: https://anssoftinc.com.np
* Author: Sabin khanal, Sizan Dyola and Arjun Kandel
* Author URI: https://anssoftinc.com.np
* Description: Newsportal plugin 
* Version: 1.0.0
* License: GPL2
* License URI:  https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: tbo newsportal
*/
//If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
//Define Constants
if (!defined('WPAC_PLUGIN_VERSION')) {
    define('WPAC_PLUGIN_VERSION', '1.0.0');
}
if (!defined('WPAC_PLUGIN_DIR')) {
    define('WPAC_PLUGIN_DIR', plugin_dir_url(__FILE__));
}
include_once ABSPATH . 'wp-includes/pluggable.php';
require_once plugin_dir_path(__FILE__) . 'styles.php';
require_once plugin_dir_path(__FILE__) . 'inc/helpers.php';
require_once plugin_dir_path(__FILE__) . 'inc/news/news_menu.php';
require_once plugin_dir_path(__FILE__) . 'inc/news/news_columns.php';
require_once plugin_dir_path(__FILE__) . 'inc/news/news_meta.php';
