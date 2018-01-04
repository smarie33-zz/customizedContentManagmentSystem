(function(document, $){
  "use strict";

  jQuery(document).ready(function($) {

    //stop typing in the excerpt at 150 characters
    $('body').on('keyup', '#postexcerpt textarea', function(){
      var curTextarea = this;
      var len = curTextarea.value.length;
      if (len >= 150) {
        curTextarea.value = curTextarea.value.substring(0, 150);
      }
    })

    //stop publish/save if Excerpt has nothing in it
    $('body').on('click', '#publishing-action input', function(event){
      if($('#postexcerpt textarea').length >= 1){
        if($.trim($('#postexcerpt textarea').val()) == ''){
          event.stopPropagation();
          event.preventDefault();
          alert('Please fill in the Excerpt at the bottom of the page!')
        }
      }
    })

    // $('body').on('click', '.submitdelete', function(event){
    //   var curDelete = $(this);

    //             // a > span.trash > div.row-actions > td.title > tr.id (holder)
    //   var curBar = curDelete.parent().parent().parent().parent();

    //   if(curBar.find('.categories.column-categories a').length >= 1){
    //     if(curBar.find('.categories.column-categories a').html() != 'Uncategorized'){
    //       event.stopPropagation();
    //       event.preventDefault();

    //       //get current post type
    //       var currPostType = $('h1.wp-heading-inline').html();
    //       confirm('Deleting this '+currPostType+' ');
    //     }
    //   }

    //})

  }) //END OF DOC READY

})(document, window.jQuery);
