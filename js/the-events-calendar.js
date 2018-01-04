var base_url = window.cdu_vars.site_url;

if (typeof TribeCalendar != 'undefined') {
  if (typeof TribeCalendar.ajaxurl != 'undefined') {
    TribeCalendar.ajaxurl = swapDomain(TribeCalendar.ajaxurl);
  }
}

if (typeof TribeList != 'undefined') {
  if (typeof TribeList.ajaxurl != 'undefined') {
    TribeList.ajaxurl = swapDomain(TribeList.ajaxurl);
  }
}

function swapDomain(url) {
  var string_find = "://"
  var domain_pos = url.indexOf(string_find) + string_find.length;
  var domain_path = url.slice(domain_pos);
  var path_pos = domain_path.indexOf("/");
  var path = domain_path.slice(path_pos);

  return base_url + path;
}
