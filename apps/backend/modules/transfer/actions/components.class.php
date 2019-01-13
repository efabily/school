<?php

class transferComponents extends sfComponents
{
   public function executeShowTransfer(sfWebRequest $request)
   {
    // obtenemos la transferencia a partir de un ide
     $this->transfer = TransferPeer::retrieveByPK($this->transfer_id);
   }
   
  public function executeListOpeningAmount()
  {
    $this->opening_amount = MovementCashboxTransferPeer::getFromCashbox($this->cashbox_id);
  }
  
  public function executeOpen(sfWebRequest $request)
  {
     sfConfig::set('sf_web_debug', false);
     
     $this->cashbox = CashBoxPeer::retrieveByPK($this->cashbox_id);
  }
  
  public function executeUploadAmount()
  {
    $this->billets = array();    

    if ($this->getUser()->getAttribute('current_payment_type'))
    {
      $this->payment_type = PaymentTypePeer::retrieveByPk($this->getUser()->getAttribute('current_payment_type'));

      $this->billets = PaymentTypePeer::getActiveBillets($this->payment_type->getId());

    } else {
      $this->payment_type = new PaymentType();
    }   
    
    $this->value = '';
  }
  
  
  
}

?>