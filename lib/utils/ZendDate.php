<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
set_include_path(dirname(__FILE__) . PATH_SEPARATOR . get_include_path());

class ZendDate
{
   static function getZendCurrentMonth()
   {
      $currDate = new Zend_Date();
	     
      $mth = $currDate->get('MM');
      $month = ucfirst($currDate->get('MMMM', 'es'));

      return array($mth, $month);
   }
   
   static function toContract($date)
   {
      $zend_date = new Zend_Date();
      $zend_date->setDate($date, 'y-MM-dd');
      
      return $zend_date->get(Zend_Date::DATE_LONG, 'es');
   }
   
}

?>
