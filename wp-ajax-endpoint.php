<?php

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

/**
 * Do not want to load a complete set of files hence seprating it from default Composer autoloader.
 *
 * @since 1.0.0
 *
 * @param string $class
 */
spl_autoload_register(function ($class) {

	list($plugin_space) = explode('\\', $class);
	if ($plugin_space !== 'WPAJAXEPT') {
		return;
	}

	/*
	 * Base folder directory
	 */
	$plugin_dir = basename(__DIR__);

	// Default directory plugin's /src/.
	$base_dir = plugin_dir_path(__DIR__) . '/' . $plugin_dir . '/src/';

	// Get the relative class name.
	$relative_class = substr($class, strlen($plugin_space) + 1);

	// Prepare a path to a file.
	$file = wp_normalize_path($base_dir . $relative_class . '.php');

	// If the file exists, require it.
	if (is_readable($file)) {
		require_once $file;
	}
});

// NameSpace decleration.
use WPAJAXEPT as Admin;

// Create object for main class.
$wp_ajax_ept_obj = new Admin\Core();

/**
 * Deactivate/Uninstall plugin hooks.
 *
 * @since 1.0.0
 */
register_activation_hook(WPAJAXEPT_PLUGIN_FILE, $wp_ajax_ept_obj->activate());
register_deactivation_hook(WPAJAXEPT_PLUGIN_FILE, $wp_ajax_ept_obj->deactivate());
register_uninstall_hook(WPAJAXEPT_PLUGIN_FILE, $wp_ajax_ept_obj->uninstall());



// Namesspace to fetch specific Data for perparing WPCLI command.
use WPAJAXEPT\Admin\GetData;

/**
 * Function WPCliCMD is responsible for refershing data from terminal.
 *
 * @since 1.0.0
 */
$WPCliCMD = function () {
	// This function can only be accessed via CLI.
	if (!defined('WP_CLI')) {
		return;
	}

	// Delete the saved transient data.
	delete_transient('wp_ajax_ept_miusage_data');

	// Fetch new data from the endpoint.
	$getData = new GetData();
	$getData->getAPIResponse();


	WP_CLI::success('Congratulations new data have been fetched please refresh your page to see the new data!' . esc_url($getData->getEndpoint()) . '');
};

/**
 * Function WPCliCMD is responsible for refershing data from terminal.
 *
 * @since 1.0.0
 */
if (class_exists('WP_CLI')) {
	if (is_admin() || (defined('WP_CLI') && WP_CLI)) {
		WP_CLI::add_command('wp-ajax-ept-reset', $WPCliCMD);
	}
}
