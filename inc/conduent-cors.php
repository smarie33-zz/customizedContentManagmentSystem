<?php
add_action('init', 'conduent_allowed_origins_init');

function conduent_allowed_origins_init() {
  add_filter( 'allowed_http_origin', 'conduent_allowed_origins');
}

function conduent_allowed_origins($origin, $origin_arg = null) 
{
  if ($origin_arg == null) {
    $origin_arg = get_http_origin();
  }

  if ($origin_arg != null)
  {
    $origin_arg = strtolower($origin_arg);

    if (preg_match("/colorsticks\.([\w\.]{2,5})$/", $origin_arg)) {
      return $origin_arg;
    }
    if (preg_match("/conduent\.([\w\.]{2,5})$/", $origin_arg)) {
      return $origin_arg;
    }
  }
}
?>