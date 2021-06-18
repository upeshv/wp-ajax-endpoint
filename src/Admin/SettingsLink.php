<?php

namespace WPAJAXEPT\Admin;

/**
 * Class SettingsLink is responsible for displaying plugins settings link.
 *
 * @since 1.0.0
 */
if (!class_exists('SettingsLink')) :

	class SettingsLink
	{

		// Plugin name.
		protected $plugin_name;

		/**
		 * Construct the SettingsLink class.
		 *
		 * @since   1.0.0
		 */
		public function __construct()
		{
			
			$this->plugin_name = plugin_basename(WPAJAXEPT_PLUGIN_FILE);

			add_filter("plugin_action_links_$this->plugin_name", array($this, 'wp_ajax_ept_settings_link'));
		}

		/**
		 * Add plugins settings link.
		 *
		 * @since   1.0.0
		 */
		public function wp_ajax_ept_settings_link($links)
		{

			$settings_link = '<a href="' . admin_url('admin.php?page=wp-ajax-endpoint') . '">' . __('Settings') . '</a>';

			array_unshift($links, $settings_link);

			return $links;
		}
	}

endif;
