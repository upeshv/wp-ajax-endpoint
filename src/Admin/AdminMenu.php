<?php

namespace WPAJAXEPT\Admin;

use WPAJAXEPT\Admin\OptionsPage;
use WPAJAXEPT\Admin\RefreshData;
use WPAJAXEPT\Admin\AdminNotices;
use WPAJAXEPT\Admin\TextDomain;

/**
 * Class AdminMenu registers the required settings for the plugin
 * and creates the options page to display the data.
 *
 * @since 1.0.0
 */
if (!class_exists('AdminMenu')) :

	class AdminMenu
	{
		/**
		 * Construct the AdminMenu class.
		 *
		 * @since   1.0.0
		 */
		public function __construct()
		{
			// Object of class Refresh data.
			$refresh_data = new RefreshData();

			// Define Ajax.
			add_action('wp_ajax_get_miusage_data', [$refresh_data, 'get_miusage_data']);
			add_action('wp_ajax_nopriv_get_miusage_data', [$refresh_data, 'get_miusage_data']);

			// Hook settings add additonal info
			add_action('admin_init', [$this, 'wp_ajax_ept_register_settings']);

			$this->load_helpers();
		}

		/**
		 * Helper functions required on plugin load.
		 *
		 * @since   1.0.0
		 */
		public function load_helpers()
		{
			// Register Admin Notices.
			(new AdminNotices());

			// Load Text_Domain.
			(new TextDomain());
		}

		/**
		 * Regsiter plugin settings page.
		 *
		 * @since   1.0.0
		 */
		public function wp_ajax_ept_register_settings()
		{
			register_setting('wp_ajax_ept_options_group', 'wp_ajax_ept_option_name');

			add_settings_section('wp_ajax_ept-section-1', __('API Data', 'wp_ajax_ept'), array($this, 'wp_ajax_ept_settings_cb'), 'wp_ajax_ept-settings');
		}

		/**
		 * Add plugin options page.
		 *
		 * @since   1.0.0
		 */
		public function wp_ajax_ept_register_options_page()
		{

			// Options pages access capability.
			$access_capability = 'manage_options';

			add_menu_page(
				esc_html__('WP Ajax Endpoint', 'wp_ajax_ept'),
				esc_html__('WP Ajax Endpoint', 'wp_ajax_ept'),
				$access_capability,
				'wp-ajax-endpoint',
				[$this, 'wp_ajax_ept_options_page'],
				'',
				98
			);
		}


		/**
		 * Settings section.
		 *
		 * @since   1.0.0
		 */
		public function wp_ajax_ept_settings_cb()
		{
			echo __('Below data is been fetched from <a href="https://miusage.com/v1/challenge/1/" target="_blank">this endpoint</a>.', 'wp_ajax_ept');
		}

		/**
		 * Display options page data.
		 *
		 * @since   1.0.0
		 */
		public function wp_ajax_ept_options_page()
		{
			// get the data from the 'Options_Page' class.
			(new OptionsPage())->display_plugin_content();
		}
	}

endif;
