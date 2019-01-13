<?php

class SalesComponents extends sfComponents
{

  public function executeListItems()
  {
    // Obtenemos el curso del estudiante
    $item_list = ItemPeer::getItemsByDirectSales(2);         
    
    $this->item_list = array();

    foreach($item_list as $item)
    {   
      $this->item_list[$item->getId()]['id'] = $item->getId();
      $this->item_list[$item->getId()]['name'] = $item->getName();
      $this->item_list[$item->getId()]['price'] = $item->getPrice();
      $this->item_list[$item->getId()]['color'] = '498BF4';
    }
  
  }
  
  public function executeListItemsCharged()
  {     
     $this->items_charged = array();
     
     $this->sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());
     
     if(is_object($this->sales))
     {
	 // Lista de items por cuenta
	 $this->items_charged = ItemForSalePeer::getItemForSaleBySales($this->sales->getId());
     }

  }
    
  public function executeListPaymentType()
  {
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
    
    $sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());

    if(is_object($sales))
    {     
	$this->delete = false;		

	$this->setTotalPricePay($sales) ;		
    }

//    $this->setPaymentTypeData();  

  }
  
  public function executeListPayAmount()
  {
    $this->total_pay = 0;
    $this->total_price = 0;
    $this->change_in_local_currency = 0;
    $this->change_in_dollar = 0;
    $this->pays = array();
    
    $movements = array();
    
    $this->sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());
  
    if(is_object($this->sales))
    {
       $movements = MovementCashboxSalesPeer::getMovementCashboxBySales($this->sales->getId());

       $this->setTotalPricePay($this->sales) ;
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
     $this->change_in_local_currency = 0;
     $this->change_in_dollar = 0;

     if(is_object($object))
     {       
	$this->total_pay = $object->getTotalPay();
	$this->total_price = $object->getTotalPrice();
	$this->change_in_local_currency = $object->changeInLocalCurrency();
	$this->change_in_dollar = $object->changeInDollar();
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