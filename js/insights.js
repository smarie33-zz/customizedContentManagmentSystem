(function(document, $){
  "use strict";

  jQuery(document).ready(function($) {

    function reset_grid(data) {
      var page_num = (data.offset / data.posts_per_page) + 1;
      var max_pages = data.max_pages;
      var content = data.content;
      if(!content) {
        content = '<div class="container cwf-post-list cwf-section-padding"></div>';
      }
      var pages_per_load = data.posts_per_page;
      $('#insights-grid').html(content);
      $('#cwf-pagenum').val(page_num);
      $('#cwf-max-pages').html('of ' + max_pages);
      $('#cwf-max-pages').data('maxpage', max_pages);
      $('#cwf-max-pages').data('pagesPerLoad', pages_per_load);
      if(max_pages < 1) {
        $('.cwf-pagination').addClass('no-results');
      } else if (max_pages == 1) {
        $('.cwf-pagination').removeClass('no-results');
      }
      else {
        $('.cwf-pagination').removeClass('no-results');
      }
      
      if (page_num <= 1) {
        $('.previous-arrow').parent().addClass('disabled');
      }
      else {
        $('.previous-arrow').parent().removeClass('disabled');
      }
      if (max_pages <= 1 || page_num == max_pages) {
        $('.next-arrow').parent().addClass('disabled');
      }
      else {
        $('.next-arrow').parent().removeClass('disabled');
      }
    }

    function insights_url_generate(pagenum) {
      if (!window.conduent) {
        window.conduent = {};
      }
      var new_url = location.origin + '/insights/';
      if (pagenum > 1) {
        new_url = new_url + "page/" + pagenum;
      }
      var new_search = '';
      $('.dropdown li.active[data-filter]').each(function() {
        if (new_search.indexOf('?') == -1) {
          new_search = new_search + '?' + $(this).data('filter') + '=' + $(this).data('slug');
        }
        else {
          new_search = new_search + '&' + $(this).data('filter') + '=' + $(this).data('slug');
        }
      });
      if (new_search === '' && (window.conduent.category || window.conduent['post-type'])) {
        new_url = new_url + location.search;
      } else {
        new_url = new_url + new_search;
      }
        
      return new_url;
    }

    $('.dropdown li[data-filter]').click(function(event) {
      event.preventDefault();
      var clicked_filter = $(this).data('filter');
      $('[data-filter="' + clicked_filter + '"]').removeClass('active');
      $(this).addClass('active');
      var $filter_dropdown = $(this).closest('.dropdown').find('button.dropdown-toggle');
      $filter_dropdown.addClass('selected-filter');
      $filter_dropdown.find('span.filter-selection').html( $(this).find('a').text() );
      var post_category = $('.active[data-filter="category"]').data('slug');
      var post_type = $('.active[data-filter="post-type"]').data('slug');
      window.conduent.category = post_category;
      window.conduent['post-type'] = post_type;

      var new_url = insights_url_generate();

      history.replaceState({'Insights': 'Insights'}, 'Insights', new_url);
      $.ajax({
          url: window.cdu_vars.site_url + '/wp-admin/admin-ajax.php',
          crossDomain: true,
          data: {
              'action':'cwf_insights_filtered_posts_ajax',
              'category': post_category,
              'post-type': post_type
          },
          xhrFields: {
              withCredentials: true
          },
          success: reset_grid,
          error: function(errorThrown){
              console.log(errorThrown);
          }
      });
    });
    $('.cwf-reset a').click(function(event) {
      event.preventDefault();
      if ($('.dropdown li.active[data-filter]').length > 0 ||
          location.pathname.indexOf('/page/') > 0) {
        $('.dropdown li.active[data-filter]').removeClass('active');
        window.conduent.category = null;
        window.conduent['post-type'] = null;
        var new_url = insights_url_generate();
        history.replaceState({'Insights': 'Insights'}, 'Insights', new_url);
        $('.cwf-filter .dropdown button').removeClass('selected-filter');
        $('#dropdownMenu1').find('span.filter-selection').html( 'All Categories');
        $('#dropdownMenu2').find('span.filter-selection').html( 'All Types');
        $.ajax({
          url: window.cdu_vars.site_url + '/wp-admin/admin-ajax.php',
          crossDomain: true,
          data: {
            'action':'cwf_insights_filtered_posts_ajax',
            'paged': 1
          },
          xhrFields: {
              withCredentials: true
          },
          success: reset_grid,
          error: function(errorThrown){
              console.log(errorThrown);
          }
        });
      }
    });

    function insightsScrollTop() {
      $("html, body").delay(1000).animate({scrollTop: $('section.cwf-filter').offset().top }, 750);
    }

    jQuery('.next-arrow').click(function() {
      var pageNum = $('#cwf-pagenum').val();
      var maxPage = $('#cwf-max-pages').data('maxpage');
      var numPosts = $('#cwf-max-pages').data('pagesPerLoad');
      if (pageNum < maxPage) {
        pageNum++;
        var post_category = window.conduent.category;
        var post_type = window.conduent['post-type'];
        insightsScrollTop()

        var new_url = insights_url_generate(pageNum);
        history.replaceState({'Insights': 'Insights'}, 'Insights', new_url);

        $.ajax({
          url: window.cdu_vars.site_url + '/wp-admin/admin-ajax.php',
          crossDomain: true,
          data: {
            'action':'cwf_insights_filtered_posts_ajax',
            'category': post_category,
            'post-type': post_type,
            'offset': (pageNum - 1) * numPosts
          },
          xhrFields: {
              withCredentials: true
          },
          success: reset_grid,
          error: function(errorThrown){
              console.log(errorThrown);
          }
        });
      }
    });

    jQuery('.previous-arrow').click(function() {
      var pageNum = $('#cwf-pagenum').val();
      var maxPage = $('#cwf-max-pages').data('maxpage');
      var numPosts = $('#cwf-max-pages').data('pagesPerLoad');
      if (pageNum > 1) {
        pageNum--;
        var post_category = window.conduent.category;
        var post_type = window.conduent['post-type'];
        insightsScrollTop();

        var new_url = insights_url_generate(pageNum);
        history.replaceState({'Insights': 'Insights'}, 'Insights', new_url);

        $.ajax({
          url: window.cdu_vars.site_url + '/wp-admin/admin-ajax.php',
          crossDomain: true,
          data: {
            'action':'cwf_insights_filtered_posts_ajax',
            'category': post_category,
            'post-type': post_type,
            'offset': (pageNum - 1) * numPosts
          },
          xhrFields: {
            withCredentials: true
          },
          success: reset_grid,
          error: function(errorThrown){
              console.log(errorThrown);
          }
        });
      }
    });

    var filter_args = location.search.split(/[?&]/);
    if (!window.conduent) {
      window.conduent = {};
    }
    for(var i = 1; i < filter_args.length; i++) {
      var temp_array = filter_args[i].split('=');
      if(temp_array.length == 2) {
        var filter = temp_array[0];
        var slug   = temp_array[1];
        window.conduent[filter] = slug;
        var $activeLi = $('[data-filter="' + filter + '"][data-slug="' + slug + '"]').first();
        $activeLi.addClass('active');
        $activeLi.closest('.dropdown').find('button.dropdown-toggle')
          .addClass('selected-filter')
          .find('span.filter-selection').html($activeLi.find('a').text());
      }
    }

  });

})(document, window.jQuery);
