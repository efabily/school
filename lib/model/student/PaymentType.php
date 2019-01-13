<?php


/**
 * Skeleton subclass for representing a row from the 'sch_payment_type' table.
 *
 * 
 *
 * This class was autogenerated by Propel 1.4.2 on:
 *
 * Fri Sep 28 00:21:33 2012
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    lib.model.student
 */
class PaymentType extends BasePaymentType {

  /**
   *
   * @return type 
   */
  function getFullName()
  {
    return $this->getFormOfPayment()->getName().' '. $this->getCurrency()->getName();
  }  
  
  /**
   *
   * @param type $sale
   * @return type 
   */
  function getCupOfChange($sale = null)
  {
      $t_c = 0;
      
      $currency_price = CurrencyPricePeer::getActiveCurrencyPrice($this->getCurrencyId());
      
      if(is_object($currency_price))
      {
	 if($sale)
	 {
	    $t_c = $currency_price->getSale();
	 } else {
	    $t_c = $currency_price->getPurchase();
	 }
      }
      
      return $t_c;
  }
  
} // PaymentType