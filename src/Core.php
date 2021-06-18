<?php
/**
 * Core plugin functionality.
 *
 * @package WP Ajax Endpoint
 */

namespace WPAJAXEPT;

use WPAJAXEPT\Admin\AdminMenu;
use WPAJAXEPT\Admin\SettingsLink;
use WPAJAXEPT\Frontend\Shortcode;

/**
 * main class Core
 *
 * @since 1.0.0
 */
if (!class_exists('Core')) :

  class Core
  {

    /**
     * Core constructor where all hooks are assigned.
     *
     * @since 1.0.0
     */
    public function __construct()
    {

      // Createing instance here for both AdminMenu and SettingsLink
      $adminMenu =  new AdminMenu();
      new SettingsLink();

      add_action('admin_menu', [$adminMenu, "wp_ajax_ept_register_options_page"]);

      // Admin scripts and styles
      add_action('admin_enqueue_scripts', [$this, 'admin_scripts']);
      add_action('admin_enqueue_scripts', [$this, 'admin_styles']);

      // Frontend scripts and styles
      add_action('wp_enqueue_scripts', [$this, 'frontend_scripts']);
      add_action('wp_enqueue_scripts', [$this, 'frontend_styles']);

      // Register Shortcode.
      (new Shortcode())->load_shortcode();

      // Allow async or defer on asset loading.
      add_filter('script_loader_tag', [$this, 'script_loader_tag'], 10, 2);
    }

    /**
     * Functions for registering backend scripts
     * Load JavaScript helper functions
     * Return false if admin screen is not a option wp ajax endpoint editor screen
     *
     * @since 1.0.0
     */
    public function admin_scripts()
    {
      if (!($_GET['page'] == 'wp-ajax-endpoint')) {
        return;
      }

      wp_register_script("wp-ajax-ept-backend-js", WPAJAXEPT_PLUGIN_URL . '/assets/js/main-backend.js', array('jquery'), WPAJAXEPT_PLUGIN_VERSION);

      //localizing ajax scripts url
      wp_localize_script('wp-ajax-ept-backend-js', 'ajax_initialize_script_ept', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'security' => wp_create_nonce('wp-ajax-ept-security-nonce'),
      ));

      // jQuery is needed.
      wp_enqueue_script('jquery');

      // Enqueue Script
      wp_enqueue_script('wp-ajax-ept-backend-js');
    }

    /**
     * Functions for registering backend stylesheets
     *
     * @since 1.0.0
     */
    public function admin_styles()
    {
      if (!($_GET['page'] == 'wp-ajax-endpoint')) {
        return;
      }

      wp_enqueue_style('wp-ajax-ept-backend-css', WPAJAXEPT_PLUGIN_URL . '/assets/css/main-backend.css', array(), WPAJAXEPT_PLUGIN_VERSION, 'all');
    }

    /**
     * Functions for registering frontend scripts
     *
     * @since 1.0.0
     */
    public function frontend_scripts()
    {
      wp_enqueue_script('wp-ajax-ept-frontend-js', WPAJAXEPT_PLUGIN_URL . '/assets/js/main-frontend.js', array(), WPAJAXEPT_PLUGIN_VERSION);
    }

    /**
     * Functions for registering frontend stylesheets
     *
     * @since 1.0.0
     */
    public function frontend_styles()
    {
      wp_enqueue_style('wp-ajax-ept-frontend-css', WPAJAXEPT_PLUGIN_URL . '/assets/css/main-frontend.css', array(), WPAJAXEPT_PLUGIN_VERSION, 'all');
    }

    /**
     * Activate plugin actions.
     *
     * @since 1.0.0
     */
    public function activate()
    {
      // Get the intial timestamp upon activation
      add_option("ajaxDataRefreshTime", time());
    }

    /**
     * Deactivate plugin actions.
     *
     * @since 1.0.0
     */
    public function deactivate()
    {
      // TODO: To disable any page menu options upon deactivate
    }

    /**
     * Uninstall plugin actions.
     *
     * @since 1.0.0
     */
    public function uninstall()
    {
      // TODO: To disable any page menu options upon uninstall

    }

    /**
     * Add async/defer attributes to enqueued scripts that have the specified 
     * script_execution flag.
     *
     * @param string $tag    The script tag.
     * @param string $handle The script handle.
     * @return string
     */
    function script_loader_tag($tag, $handle)
    {
      $script_execution = wp_scripts()->get_data($handle, 'script_execution');

      if (!$script_execution) {
        return $tag;
      }

      if ('async' !== $script_execution && 'defer' !== $script_execution) {
        return $tag; // doing_it_wrong
      }

      // Abort adding async/defer for scripts that have this script as a dependency. 
      foreach (wp_scripts()->registered as $script) {
        if (in_array($handle, $script->deps, true)) {
          return $tag;
        }
      }

      // Add the attribute if it hasn't already been added.
      if (!preg_match(":\s$script_execution(=|>|\s):", $tag)) {
        $tag = preg_replace(':(?=></script>):', " $script_execution", $tag, 1);
      }

      return $tag;
    }
  }
endif;
