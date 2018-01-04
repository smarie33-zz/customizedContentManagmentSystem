(function(document, $){
  "use strict";

  jQuery(document).ready(function($) {

  	$('#cwf-hdr-search-form-embed #cwf-hdr-search-input').focus();
    
    $('body').on('click', '#cwf-hdr-search-form-embed #cwf-hdr-search-clear', function(){
      $('#cwf-hdr-search-form-embed #cwf-hdr-search-input').val('').focus();
    });

  });

})(document, window.jQuery);
