<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
set_include_path(dirname(__FILE__) . PATH_SEPARATOR . get_include_path());

class Mora
{
   static function calcMora($month, $year, $amount)
   {
      $calc = 0;
      $diasMora = 0;
      $expiration_date = '';
      // $currDate = new Zend_Date(); // obtenemos la fecha actual

      $currDate = new Zend_Date("31-12-2013", 'dd-MM-y'); // hasta el 31-12-2013

      $dateToCheck = new Zend_Date();
      $dateToCheck->setDay(1)->setMonth($month);
      $dateToCheck->setYear($year);

      $dueDate = clone $dateToCheck;
      $dueDate->addMonth(1)->setDay(10);

      if($currDate->isLater($dueDate))
      {

	 $diff = $currDate->sub($dueDate)->toValue();

	 $diasMora = ceil($diff/60/60/24);
	 $cuota = $amount;
	 $factor_tasa = (0.015/30);

	 $deudaMora = ($diasMora * $cuota * $factor_tasa);
	 $calc = $deudaMora;

	 $expiration_date = $dueDate->get('dd-MM-y');
      }

      return array($calc, $diasMora, $expiration_date);
   }

}

?>
