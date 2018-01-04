(function(window, document, $) {
	"use strict";

  var self = {};

  self.init = function() {
    var boxes = document.querySelectorAll('.cwf-warning-box-container');
    for (var i = 0; i < boxes.length; i++) {
      self.initWarningBox(boxes[i]);
    }
  }

  self.initWarningBox = function(box) {
    var boxID = box.innerText.replace(/\W+/g, "").substr(0,20);
    var dismissBtn = box.querySelector('.cwf-warning-box-remove');
    var closeBtn = box.querySelector('.cwf-warning-box-close');

    if (typeof(Storage) !== "undefined") {
      if (localStorage.getItem(boxID) != "hide") {
        $(box).addClass("show-box");
        $(box).parents('.cwf-warning-box-holder').addClass("show-box");
      }
    }
    else {
      $(box).addClass("show-box");
    }
    dismissBtn.addEventListener('click', function(e) {
      if (typeof(Storage) !== "undefined") {
        localStorage.setItem(boxID, "hide");
        $(box).parents('.cwf-warning-box-holder').slideUp( "fast", function() {
          $(box).removeClass("show-box");
          $(box).addClass("remove-box");
          $(box).parents('.cwf-warning-box-holder').removeClass("show-box");
          $(box).parents('.cwf-warning-box-holder').addClass("remove-box");
        })
      }
      else {
        $(box).removeClass("show-box");
        $(box).addClass("remove-box");
        $(box).parents('.cwf-warning-box-holder').removeClass("show-box");
        $(box).parents('.cwf-warning-box-holder').addClass("remove-box");
      }
    })

		closeBtn.addEventListener('click', function(e) {
      $(box).parents('.cwf-warning-box-holder').slideUp( "fast", function() {
        $(box).removeClass("show-box");
        $(box).addClass("remove-box");
        $(box).parents('.cwf-warning-box-holder').removeClass("show-box");
              $(box).parents('.cwf-warning-box-holder').addClass("remove-box");
        });
      });
			
  };

  self.init();

})(window, document, jQuery);
