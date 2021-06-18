<?php

namespace WPAJAXEPT\Admin;

use WPAJAXEPT\Admin\GetAPI;

// Using WordPress Table Listing Features
if (!class_exists('\WP_List_Table')) {
  require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
 * Extends WordPress WP_List_Table class for listing table data
 * Class GetData helps GetAPI class to list the data in WP table list format.
 *
 * @since 1.0.0
 */
if (!class_exists('GetData')) :

  class GetData extends \WP_List_Table
  {

    /**
     * Data endpoint.
     *
     * @since   1.0.0
     */
    function getAPIResponse()
    {
      return (new GetAPI())->getAPIResponse();
    }

    /**
     * Get Data function.
     *
     * @since   1.0.0
     */
    function getTableData()
    {
      $data = $this->getAPIResponse();

      return $data["data"]["rows"];
    }

    /**
     * Get data by Columns.
     *
     * @since   1.0.0
     */
    function get_columns()
    {
      $data = $this->getAPIResponse();

      $columns = $data["data"]["headers"];

      return $columns;
    }

    /**
     * Prepare items to help listing data in wp table list format.
     *
     * @since   1.0.0
     */
    function prepare_items()
    {
      $columns = $this->get_columns();
      $hidden = array();
      $sortable = array();
      $this->_column_headers = array($columns, $hidden, $sortable);
      $this->items = $this->getTableData();
    }

    /**
     * Default column heading.
     *
     * @since   1.0.0
     */
    function column_default($item, $column_name)
    {
      switch ($column_name) {
        case 0:
          return esc_attr($item["id"]);
          break;
        case 1:
          return esc_attr($item["fname"]);
          break;
        case 2:
          return esc_attr($item["lname"]);
          break;
        case 3:
          return esc_attr($item["email"]);
          break;
        case 4:
          return date_i18n('F d, Y', $item["date"]);
          break;
        default:
          return print_r($item, true); //Show the whole array for troubleshooting purposes
      }
    }

    /**
     * Get title value from the given endpoint
     *
     * @since   1.0.0
     *
     * @return string title
     */
    public function get_title()
    {
      $data = $this->getAPIResponse();
      return $data["title"];
    }
  }

endif;
