<?php

namespace WPAJAXEPT\Admin;

/**
 * Class AdminNotice is responsible for displaying the notices on the plugins options page.
 *
 * @since 1.0.0
 */
if (!class_exists('AdminNotices')) :

	class AdminNotices
	{

		/**
		 * Construct the AdminNotices class.
		 *
		 * @since   1.0.0
		 */
		public function __construct()
		{

			// Show admin notices.
			if (isset($_GET['page'])) {
				// If plugin settings page.
				if ($_GET['page'] == 'wp-ajax-endpoint') {
					if (get_transient('wp_ajax_ept_miusage_data')) {
						add_action('admin_notices', [$this, 'show_notice_success']);
					} else {
						add_action('admin_notices', [$this, 'show_notice_info']);
					}
				}
			}
		}

		/**
		 * Show success admin notice
		 *
		 * @since   1.0.0
		 */
		public function show_notice_success()
		{
			$notice = '<div class="notice notice-success is-dismissible">';

			$notice .= '<p>' . sprintf(
				wp_kses( /* translators: %s - Refresh Data  anchor link. */
					__('The below data is fetched from cache and will get refreshed every one hour!', 'wp_ajax_ept'),
					array(
						'a'      => array(
							'href'  => array(),
							'class' => array(),
						),
						'strong' => array(),
					)
				),
				'javascript:void(0)'
			) . '</p>';

			$notice .= '</div>';

			echo $notice;
		}

		/**
		 * Show error admin notice
		 *
		 * @since   1.0.0
		 */
		public function show_notice_info()
		{

			$notice = '<div class="notice notice-info is-dismissible">';

			$notice .= '<p>' . sprintf(
				wp_kses( /* translators: %s - Refresh Data  anchor link. */
					__('The cache got expired and new data was fetched after an interval of one hour!', 'wp_ajax_ept'),
					array(
						'a'      => array(
							'href'  => array(),
							'class' => array(),
						),
						'strong' => array(),
					)
				),
				'javascript:void(0)'
			) . '</p>';
			$notice .= '</div>';

			echo $notice;
		}
	}

endif;
