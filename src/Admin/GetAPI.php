<?php

namespace WPAJAXEPT\Admin;

/**
 * Class GetAPI is responsible for helping GetData class by fetching data from the endpoint 
 * and displaying it in a table format.
 *
 * @since 1.0.0
 */
if (!class_exists('GetAPI')) :

  class GetAPI
  {
    /**
     * Data endpoint.
     *
     * @var Endpoint $endpoint
     * @since   1.0.0
     */
    protected $endpoint = 'https://miusage.com/v1/challenge/1/';

    public function getAPIResponse()
    {
      // Get any existing copy of our transient data.
      if (false === ($response = get_transient('wp_ajax_ept_miusage_data'))) {
        // Transient expired, refresh the data.
        $response        = wp_remote_get($this->endpoint);
        $http_code = wp_remote_retrieve_response_code($response);
        // If response code is 200 then set the transient data.
        if ($http_code == 200) :
          set_transient('wp_ajax_ept_miusage_data', $response,  60 * 60);
        endif;
      }
      if ($response['response']['code'] == 200) : // if response is OK.
        $data = (json_decode(wp_remote_retrieve_body($response), true));

        return $data;
      endif;
    }

    /**
     * Getter Function to get the endpoint value outside the class.
     */
    public function getEndpoint()
    {
      return $this->endpoint;
    }
  }
endif;
