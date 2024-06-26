<?php


/**
 * Skeleton subclass for performing query and update operations on the 'sch_movement_cashbox' table.
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
class MovementCashboxPeer extends BaseMovementCashboxPeer {
   
   /**
   *
   * Crea un MovementCashbox, si se le pasa un objeto de tipo 
   * MovementCashbox, actualiza este mismo
   * 
   * @param float $sum
   * @param int $cashboxId
   * @param int $currencyPriceId
   * @param int $paymentTypeId
   * @param MovementCashbox $movementCashbox || null
   * @param PropelPDO $con
   * @return MovementCashbox 
   */
  public static function createMovementCashbox($sum, $cashboxId, $currencyPriceId, $paymentTypeId, $movementCashbox = null, $con = null)
  {
    if(!is_object($movementCashbox))
    {
      $movementCashbox = new MovementCashbox();
    }
    
    $movementCashbox->setSum($sum);
    $movementCashbox->setCashboxId($cashboxId);
    $movementCashbox->setCurrencyPriceId($currencyPriceId);
    $movementCashbox->setPaymentTypeId($paymentTypeId);
    $movementCashbox->save($con);
    
    return $movementCashbox;
  }

} // MovementCashboxPeer
