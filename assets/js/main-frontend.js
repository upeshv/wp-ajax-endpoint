/**
 * Plugin frontend script file.
 * Below code in Vanilla js because want to get rid of default jquery dependecny file
 */

function wrap(top, selector, bottom){
  var matches = document.querySelectorAll(selector);
  for (var i = 0; i < matches.length; i++){
    var modified = top + matches[i].outerHTML + bottom;
    matches[i].outerHTML = modified;
  }
}

wrap("<div id='wp_ajax_ept-content-wrapper'>", ".wp_ajax_ept-table", "</div>");