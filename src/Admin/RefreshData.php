<?php

namespace WPAJAXEPT\Admin;

/**
 * Class RefreshData gets the data from the endpoint on action of the button click.
 *
 * @since 1.0.0
 */
if (!class_exists('RefreshData')) :

	class RefreshData
	{

		/**
		 * Function called on "Refresh" button clicked via Ajax
		 *
		 * @since   1.0.0
		 */
		public function get_miusage_data()
		{
			// Nonce Check.
			if ('GET' === $_SERVER['REQUEST_METHOD']) { // Check if post method.
				if (!check_ajax_referer('wp-ajax-ept-security-nonce', 'security', false)) {
					wp_send_json_error('Unauthorized Request');
					wp_die();
				}
			}

			/**
			 * Delete the transient cache if refresh data button is pressed.
			 */
			delete_transient('wp_ajax_ept_miusage_data');

			// get the data in table format.      
			ob_start();

			$getData = new GetData();
			$getData->prepare_items();
			$getData->display();

			$table_response = ob_get_contents();
			ob_end_clean();

			$data_response = array(
				'type' => 'success',
				'data' => $table_response,
			);

			// send data back to the calling script in decoded format.
			echo json_encode($data_response);
			wp_die();
		}
	}

endif;
