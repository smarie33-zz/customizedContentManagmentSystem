(function(document, $){
  "use strict";

  jQuery(document).ready(function($) {
    var getX = '<div id="cwf-close"><span class="cwf-close-clear-line" id="cwf-close-clear-line-1"></span> <span class="cwf-close-clear-line" id="cwf-close-clear-line-2"></span></div>';
    $('body').prepend('<div class="masonry-video-overlay">'+getX+'<div class="video-holder"></div></div>');
    
    $('body').on('click', '.video, .video-click', function(e){
      var embed_url = '';
      var video_url = $(this).attr("href");
      if(video_url.indexOf('youtu.be') !== -1){
        var video_parts = video_url.split("/");
        embed_url = 'https://www.youtube.com/embed/'+video_parts[video_parts.length-1];
      }else{
        embed_url = video_url.replace("watch?v=", "embed/");
      }
      
      console.log(embed_url);
      var video_embed = '<iframe class="video-embed" type="text/html" src="'+embed_url+'?autoplay=1&modestbranding=1&rel=0" frameborder="0"></iframe>';

      e.preventDefault();
      e.stopPropagation();
      $('html, body').css({ overflow: 'hidden' });
      $('.masonry-video-overlay').show();
      $('.masonry-video-overlay .video-holder').html(video_embed);
      
      try {
        if(typeof ytTracker !== "undefined" && ytTracker && ytTracker.digestPotentialVideos) {
            var iframes = $('.masonry-video-overlay .video-holder iframe');
              ytTracker.digestPotentialVideos(iframes);
          }
          else
            console.warn("No ytTracker.digestPotentialVideos found.");
      }
      catch(err)
      {
        console.error("Trouble tracking dynamic video. Squashing Err.", err);
      }

    })

    $('body').on('click', '.masonry-video-overlay #cwf-close', function(e){
      $('.masonry-video-overlay .video-holder').html('');
      $('.masonry-video-overlay').hide();
      $('html, body').css({ overflow: 'auto' });
    })

  })

})(document, window.jQuery);
