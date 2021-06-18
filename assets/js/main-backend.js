/**
 * Plugin script file.
 * Below ajax call is made once we click on the refresh data button.
 */
jQuery(document).ready(function ($) {

  jQuery('.get-ajax-data').on('click', function () {
    jQuery("#get-ajax-data").attr("disabled", true);
  
    jQuery.ajax({
      type: "get",
      contentType: "application/json",
      dataType: 'json',
      url: ajax_initialize_script_ept.ajax_url,
      data: { action: "get_miusage_data", security: ajax_initialize_script_ept.security },
      success: function (response) {
        if (response.type == "success") {
          jQuery(".show-content").html(response.data);
          jQuery("#get-ajax-data").attr("disabled", false);
        }
        else {
          // console.log(response);
        }
      },
      error: function (error) {
        // console.log(error);
      }
    });
  });

});