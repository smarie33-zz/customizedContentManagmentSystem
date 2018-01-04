(function(document, $){
  "use strict";

  $(document).ready(function() {
    $("a[href^='tel']").each(function() {
      var href = $(this).attr("href");
      if (href.indexOf("+") === -1) {
        href = href.replace("tel:", "tel:+");
      }
      $(this).attr("href", href);
    });
  });
})(document, window.jQuery);
