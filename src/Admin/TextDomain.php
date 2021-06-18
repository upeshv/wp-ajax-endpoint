<?php

namespace WPAJAXEPT\Admin;

/**
 * Class TextDomain loads the plugin text domain.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'TextDomain' ) ) :

	class TextDomain {

		/**
		 * Constructs the TextDomain class.
		 *
		 * @since 1.0.0
		 */
		public function __construct() {
			// Load plugin textdomain.
			add_action( 'admin_init', array( $this, 'wp_ajax_ept_load_textdomain' ) );
		}

		/**
		 * Load plugin textdomain.
		 *
		 * @since   1.0.0
		 */
		public function wp_ajax_ept_load_textdomain() {
			load_plugin_textdomain( 'wp_ajax_ept', false, WPAJAXEPT_PLUGIN_LANG );
		}
	}

endif;
