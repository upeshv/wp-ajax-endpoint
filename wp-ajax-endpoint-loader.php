<?php
/**
 * Plugin Name:       WP Ajax Endpoint
 * Description:       Ability to retrieves data from remote endpoint using WP AJAX
 * Version:           1.0.0
 * Requires at least: 4.9
 * Requires PHP:      5.6.0
 * Author:            Upesh Vishwakarma
 * Author URI:        https://github.com/upeshv/wp-ajax-endpoint
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       wp-ajax-endpoint
 * Domain Path:       /assets/languages
 *
 * @package           WP Ajax Endpoint
 */


// Exit if accessed directly.
if (!defined('ABSPATH')) {
	exit;
}

/**
 * Useful global constants.
 *
 * @since 1.0.0
 */
// Plugin version.
if (!defined('WPAJAXEPT_PLUGIN_VERSION')) {
	define('WPAJAXEPT_PLUGIN_VERSION', '1.0.0');
}

// Plugin Folder Path.
if (!defined('WPAJAXEPT_PLUGIN_PATH')) {
	define('WPAJAXEPT_PLUGIN_PATH', plugin_dir_path(__FILE__));
}

// Plugin Folder URL.
if (!defined('WPAJAXEPT_PLUGIN_URL')) {
	define('WPAJAXEPT_PLUGIN_URL', plugin_dir_url(__FILE__));
}

// Plugin Root File.
if (!defined('WPAJAXEPT_PLUGIN_FILE')) {
	define('WPAJAXEPT_PLUGIN_FILE', __FILE__);
}

// Plugin Language Folder Path.
if (!defined('WPAJAXEPT_PLUGIN_LANG')) {
	define('WPAJAXEPT_PLUGIN_LANG', WPAJAXEPT_PLUGIN_PATH . 'assets/languages/');
}

// Minimum PHP Version
if (!defined('MIN_PHP_VER')) {
	define('MIN_PHP_VER', '5.6.0');
}

// Prefix for plugin
if (!defined('WPAJAXEPT')) {
	define('WPAJAXEPT', 'of');
}


require_once __DIR__ . '/wp-ajax-endpoint.php';
