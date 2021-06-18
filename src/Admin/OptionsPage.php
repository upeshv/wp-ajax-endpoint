<?php

namespace WPAJAXEPT\Admin;

use WPAJAXEPT\Admin\GetData;

/**
 * Class OptionsPage is responsible for the display of the plugins options page.
 *
 * @since 1.0.0
 */
if ( ! class_exists( 'OptionsPage' ) ) :

	class OptionsPage {

		/**
		 * Displays the plugins options page content.
		 *
		 * @since 1.0.0
		 */
		public function display_plugin_content() {
			
			// Get title field from the data endpoint
			$title = (new GetData())->get_title();

			// Listing content on menu page
			?>

		<div class="wrap">

			<h1><?php echo __('WP Ajax Endpoint', 'wp_ajax_ept'); ?></h1>
			<?php settings_fields('wp_ajax_ept_options_group'); ?>
			<?php do_settings_sections('wp_ajax_ept-settings'); ?>
			<div id="wp_ajax_ept-content-wrapper">
				<h2 class="wp_ajax_ept-heading"><?php echo esc_html__( $title, 'wp_ajax_ept' ); ?></h2>

				<div class="show-content">
					<?php
						$getData = new GetData();
						$getData->prepare_items();
						$getData->display();
					?>
				</div>
			</div>
			<?php
			$other_attributes = array('id' => 'get-ajax-data');

			submit_button(__('Refresh Data', 'wp_ajax_ept'), 'primary get-ajax-data', 'get-ajax-data', true, $other_attributes);

			$warning = '<div class="notice notice-warning is-dismissible">';

			$warning .= '<p>' . sprintf(
				wp_kses( /* translators: %s - Refresh Data  anchor link. */
					__('<strong>Note:</strong> If incase you want to override the default one hour limit, then click on bottom <strong>"Refresh Data"</strong> button to fetch latest data.', 'wp_ajax_ept'),
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

			$warning .= '</div>';

			echo $warning;

			?>
		</div>

	<?php
}
}

endif;
