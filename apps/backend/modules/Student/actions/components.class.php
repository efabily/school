<?php

class StudentComponents extends sfComponents
{

  public function executeListItems()
  {
    $array_grade = $this->contract->getContractGrade();
        
    // Obtenemos el curso del estudiante
    $item_list1 = ItemPeer::getItemsByGrade(2, $array_grade['grade_id']);
    
    $item_list2 = ItemPeer::getItemNoGrade(2);
    $item_list = array_merge($item_list1, $item_list2);
    
    $this->item_list = array();

    foreach($item_list as $item)
    {   
      $this->item_list[$item->getId()]['id'] = $item->getId();
      $this->item_list[$item->getId()]['name'] = $item->getName();
      $this->item_list[$item->getId()]['price'] = $item->getPrice();
      $this->item_list[$item->getId()]['color'] = '498BF4';
    }
  
  }
  
  public function executeListAccount()
  {
     // Listamos las cuentas de este contrato
     $this->accounts = AccountPeer::getAccount(null, null, null, $this->contract->getId(), 1);
  }
  
  public function executeListItemsCharged()
  {     
     // Lista de items por cuenta
     $this->items_charged = ItemForSalePeer::getItemForSaleByAccount($this->account->getId());
  }
  
  public function executeListPaidItems()
  {
     $this->items_charged = ItemForSalePeer::getItemForSaleByAccount($this->account->getId(), 2);
  }
  
  public function executeListPaymentType()
  {
    $this->contract_id;
    $this->payment_list = PaymentTypePeer::getPaymentActive();       
  }
  
  public function executeUploadPay()
  {
    $this->total_pay = 0;
    $this->total_price = 0;
    
    if ($this->getUser()->getAttribute('current_payment_type'))
    {   
      $payment_type = PaymentTypePeer::retrieveByPK($this->getUser()->getAttribute('current_payment_type'));

      if (is_object($payment_type))
      {     
        $this->payment_type = $payment_type;        
      } else {
        $this->payment_type = new PaymentType();
      }
    } else {
      $this->payment_type = new PaymentType();
    }
    
    $deposit = DepositPeer::getDeposit(1, $this->contract_id, $this->getUser()->getId());

    if(is_object($deposit))
    {     
	$this->delete = false;		

	$this->setTotalPricePay($deposit) ;		
    }                            
       
    $this->setPaymentTypeData();
  }
  
  public function executeListPayAmount()
  {
    $this->total_pay = 0;
    $this->total_price = 0;
    $this->change_in_dollar = 0;
    $this->change_in_local_currency = 0;
     
    $this->pays = array();
    
    $movements = array();
                     
    $deposit = DepositPeer::getDeposit(1, $this->contract_id, $this->getUser()->getId());        

    if(is_object($deposit))
    {
       if($deposit->getIdState() == 1)
       {
	  $this->delete = true;
       } else {
	  $this->delete = false;
       }

       $movements = MovementCashboxDepositPeer::getMovementCashboxByDepositId($deposit->getId());

       $this->setTotalPricePay($deposit) ;
     }
    
    if(count($movements) > 0)
    {
       foreach($movements as $pay)
       {
          $this->pays[$pay->getId()]['id'] = $pay->getId();
          $this->pays[$pay->getId()]['name'] = $pay->getPaymentType()->getFullName();
          $this->pays[$pay->getId()]['sum'] = $pay->getSum();
          $this->pays[$pay->getId()]['cup'] = $pay->getPaymentType()->getCupOfChange();
          $this->pays[$pay->getId()]['calc_sum'] = $pay->getCalculateSum();
       }      
    }
   
  }
  
  public function executePaymentsMade()
  {
     $this->receipts = ReceiptPeer::getReceiptByContract($this->contract->getId());
  }
  
   /**
   * Dado un objeto, pasa el total a pagar
   * y el total pagado que tiene ese objecto, al template
   * 
   * @param Object $object 
   */    
   protected function setTotalPricePay($object)
   {     
     $this->total_pay = 0;
     $this->total_price = 0;
     $this->change_in_dollar = 0;
     $this->change_in_local_currency = 0;

     if(is_object($object))
     {       
	$this->total_pay = $object->getTotalPay();
	$this->total_price = $object->getTotalPrice();
	
	$this->change_in_dollar = $object->changeInDollar();
        $this->change_in_local_currency = $object->changeInLocalCurrency();
     }     
   }
  
  protected function setPaymentTypeData($payment_type_id = null)
  {
    if ($payment_type_id)
    {
      $payment = PaymentTypePeer::retrieveByPK($payment_type_id);
    } else {
      $payment = PaymentTypePeer::retrieveByPK($this->getUser()->getAttribute('current_payment_type'));
    }

    if (is_object($payment))
    {

      if ($payment->getNumber())
      {
        $this->number = true;
      }

      if ($payment->getDocument())
      {
        $this->document = true;
      }

      if ($payment->getComment())
      {
        $this->comment = true;
      }      
  
    }
  }
  
}