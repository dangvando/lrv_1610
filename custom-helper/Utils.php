<?php 
if(!function_exists('prettyUrl')){
	function prettyUrl($str){
		return $str;
	}
}

if(!function_exists('get_options')){

  function get_options($array, $parent=0, $indent="", $forget = null) {
      
      // Return variable
      $return = array();
      for ($i=0; $i < count($array); $i++) {
          $val = $array[$i];

        	if($val->parent_id == $parent && $val->id != $forget) {
          	$return["x".$val->id] = $indent.$val->name;
          	$return = array_merge($return, get_options($array, $val->id, $indent."--", $forget));
          }
      }

      return $return;
  }
}



 ?>