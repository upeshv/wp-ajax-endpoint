<?php

namespace WPAJAXEPT\Frontend;

use WPAJAXEPT\Admin\GetAPI;

/**
 * Class Shortcode adds the shortcode support to the plugin.
 *
 * @since 1.0.0
 */
if (!class_exists('Shortcode')) :

	class Shortcode
	{

		public function load_shortcode()
		{

			// Create shortcode to display data in frontend. [wpajaxept]
			add_shortcode('wpajaxept', array($this, 'display_table'));
		}

		/**
		 * Sperately formating table for frontend since wp list table have some limations for 
		 * frontend.
		 * 
		 * @var Endpoint
		 * @since   1.0.0
		 */
		public function display_table()
		{
			$data = (new GetAPI())->getAPIResponse();
			$headers = $data['data']['headers'];
			$users   = $data['data']['rows'];

			// Setup display data.
			$result  = '<table class="form-table wp_ajax_ept-table">';
			$result .= '<thead>';
			$result .= '<tr valign="top">';
			foreach ($headers as $header) {
				$result .= '<th>' . esc_attr($header) . '</th>';
			}
			$result .= '</tr>';
			$result .= '</thead>';
			$result .= '<tbody>';

			/**
			 * Sort result based on ID
			 *
			 * @param int $a
			 * @param int $b
			 * @return int greater number
			 */
			function cmp($a, $b)
			{
				if ($a == $b) {
					return 0;
				}
				return ($a < $b) ? -1 : 1;
			}

			// Namespace added for cmp function.
			usort($users, 'WPAJAXEPT\Admin\cmp');
			foreach ($users as $user) {
				$result .= '<tr valign="top">';
				$result .= '<td>' . esc_attr($user['id']) . '</td>';
				$result .= '<td>' . esc_attr($user['fname']) . '</td>';
				$result .= '<td>' . esc_attr($user['lname']) . '</td>';
				$result .= '<td>' . esc_attr($user['email']) . '</td>';
				$result .= '<td>' . date_i18n('F d, Y', $user['date']) . '</td>';
				$result .= '</tr>';
			}
			$result .= '</tbody>';
			$result .= '</table>';

			return $result;
		}
	}

endif;
