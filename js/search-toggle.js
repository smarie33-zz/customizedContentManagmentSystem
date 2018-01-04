(function(document, $){
  "use strict";

  jQuery(document).ready(function($) {

    $('body').on('click', '.trigger-search', function(event){
      event.stopPropagation();
      event.preventDefault();
      $('#cwf-hdr-checkbox-search').prop("checked", true);
    })
  }) //END OF DOC READY

})(document, window.jQuery);
