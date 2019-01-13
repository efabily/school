<?php
class PropertySetter{
   
   
   static function set(&$obj, array $attr) {
      
      foreach ($attr as $key => $val)
      {
	 $key_replaced = str_replace('_', '', $key);
	 $method_name = "set{$key_replaced}";
	 if(method_exists($obj, $method_name))
	 {
	    $obj->$method_name($val);
	 }
      }
   }
}
?>
