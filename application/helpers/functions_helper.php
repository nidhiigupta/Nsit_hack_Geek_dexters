<?php
function php_redirect($REDIRECT_URL, $POST_DATA, $METHOD = 'post') {
  print("<form id='redirect_data_form' action='{$REDIRECT_URL}' method='{$METHOD}'>");
  foreach ($POST_DATA as $a => $b) {
    print('<input type="hidden" name="'.htmlentities($a).'" value="'.htmlentities($b).'">');
  }
  print("</form>");
  print("<script type='text/javascript'>
  document.getElementById('redirect_data_form').submit();
  </script>");
}

function array_sort($array, $on, $order=SORT_ASC) {
  $new_array = array();
  $sortable_array = array();

  if (count($array) > 0) {
    foreach ($array as $k => $v) {
      if (is_array($v)) {
        foreach ($v as $k2 => $v2) {
          if ($k2 == $on) {
            $sortable_array[$k] = $v2;
          }
        }
      } else {
        $sortable_array[$k] = $v;
      }
    }

    switch ($order) {
      case SORT_ASC:
      asort($sortable_array);
      break;
      case SORT_DESC:
      arsort($sortable_array);
      break;
    }

    foreach ($sortable_array as $k => $v) {
      $new_array[$k] = $array[$k];
    }
  }
  $i = 0;
  $new_array_f = [];
  foreach ($new_array as $key => $value) {
    $new_array_f[$i] = $new_array[$key];
    $i = $i + 1;
  }
  return $new_array_f;
}

?>
