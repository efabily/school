<?php


/**
 * Skeleton subclass for performing query and update operations on the 'sch_payment_type' table.
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
class PaymentTypePeer extends BasePaymentTypePeer {
  
  /**
   * Devulve los tipos de pagos activos
   * @return PaymentTypes
   */
  public static function getPaymentActive()
  {
    $criteria = new Criteria();
    $criteria->add(self::ID_STATE, 2);// que sean activos
    $criteria->add(self::ID, 3, Criteria::LESS_THAN);

    return self::doSelect($criteria);
  }
  
  
  public static function getMakeSelectPaymentTypeActivesFor()
  {
    $criteria = new Criteria();
    // filter by actives provider
    $criteria->add(PaymentTypePeer::ID_STATE, 2);
    $criteria->add(self::ID, 3, Criteria::LESS_THAN);

    // sort the list by name
    $criteria->addAscendingOrderByColumn(PaymentTypePeer::ID);
    return PaymentTypePeer::doSelect($criteria);
  }
  
  public static function getActiveBillets($payment_type_id = null)
  {
    $c = new Criteria();
    $c->add(PaymentTypeBilletPeer::PAYMENT_TYPE_ID, $payment_type_id);
    $c->add(PaymentTypeBilletPeer::ID_STATE, 2);
    $c->addJoin(PaymentTypeBilletPeer::BILLET_ID, BilletPeer::ID);
    $c->addAscendingOrderByColumn(BilletPeer::ID);
    
    return BilletPeer::doSelect($c);
  }
  
  
} // PaymentTypePeer
