<?php

class cashboxComponents extends sfComponents
{
  public function executeListAmountForFunction()
  {
    $array = CashBoxPeer::getArrayMovements($this->cashbox_id);
    
    $this->amounts_payment = $array;
  }
  
  public function executeListPaymentType()
  {
      $this->payment_list = PaymentTypePeer::getMakeSelectPaymentTypeActivesFor();
  }
  
  public function executeUploadAmountContract()
  {
    if ($this->getUser()->getAttribute('current_payment_type'))
    {
      $this->payment_type = PaymentTypePeer::retrieveByPk($this->getUser()->getAttribute('current_payment_type'));     
    } else {
      $this->payment_type = new PaymentType();
    }   
    
    $this->value = '';
  }
  
  public function executeListDeposit()
  {
    $this->deposits =  DepositPeer::getDepositByCashboxId($this->cashbox_id);
  }
  
  public function executeListItems()
  {
    $this->items_for_sales = ItemForSalePeer::getItemForSaleByCashbox($this->cashbox_id);
  }
  
}

?>