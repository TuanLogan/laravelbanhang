<?php 
define('ROLE_MODERATOR', 500);
define('ROLE_ADMIN', 900);
define('ROLE_STAFF', 100);
/*
Slug constant
 */
define('ENTITY_TYPE_TYPE', 100);
define('ENTITY_TYPE_PRODUCT', 500);
if(!function_exists('get_options')){

  function get_options($array, $parent=0, $indent="", $forget = null) {
      
      // Return variable
      $return = [];
      for ($i=0; $i < count($array); $i++) {
          $val = $array[$i];

          if($val->parent_id == $parent && $val->id != $forget) {
            $return["x".$val->id] = $indent.$val->name;
            $return = array_merge($return, get_options($array, $val->id, "--".$indent, $forget));
          }
      }

      return $return;
  }
}
if(!function_exists('slug_generate')){

  function slug_generate($name) {
      $slug = null;
      $slug = str_slug(trim($name), '-');
      $slug .= "-" . date('YmdHis', time());
      return $slug;
  }
}


 ?>