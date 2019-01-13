<?php

/**
 * Student actions.
 *
 * @package    school
 * @subpackage Student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class SalesActions extends sfActions
{  
     
     public function executeAddItem(sfWebRequest $request)
     {
	 $con = Propel::getConnection();
	 try {
	    
	    $con->beginTransaction(); // start the transaction	   
	        	       
	    $item = ItemPeer::retrieveByPK($request->getParameter('id'));
	       
	    if(is_object($item))
	    {
	       // Buscamos un sales en estado 1 para el cajero actual
	       $sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());
	       
	       if(!is_object($sales))
	       {
		  $sales = new Sales();
		  $sales->setIdState(1);
		  $sales->setNumber(2);
		  $sales->setCashierId($this->getUser()->getId());
		  $sales->save($con);
	       }
	       
	       // Verifico si para esta venta ya existe el item
	       $item_for_sale = ItemForSalePeer::getItemExistsInTheSale($sales->getId(), $item->getId());
	       
	       if(!is_object($item_for_sale))
	       {
		  $item_for_sale = new ItemForSale();
		  $item_for_sale->setSalesId($sales->getId());            
	          $item_for_sale->setItemId($item->getId());
		  $item_for_sale->setName($item->getName());
		  $item_for_sale->save($con);
	       }

	       $price = $item->getPrice();

	       $quantity = 1;

	       $item_for_sale->setPrice($item_for_sale->getAveragePrice($price, $quantity));				

	       $item_for_sale->setQuantity($item_for_sale->getQuantity() + $quantity);

		if ($item_for_sale->getDeleted() > $quantity)
		{
		   $item_for_sale->setDeleted($item_for_sale->getDeleted() - $quantity);
		} else {
		   $item_for_sale->setDeleted(0);
		}

		$item_for_sale->save($con);	
			
		$con->commit();
		$this->getUser()->setFlash('notice', "Agrego un item para venta directa", false);
	    }
	  
	  } catch (exception $e) {
	    $con->rollback();
	    throw $e;	    
	    $this->getUser()->setFlash('error', "Se genero un problema comuniquese con el adm. $e", false);
	  }
     }
     
     public function executeListItemsCharged(sfWebRequest $request)
     {	
	$this->account = AccountPeer::retrieveByPK($request->getParameter('ida'));
     }
     
     public function executeDelItem(sfWebRequest $request)
     {
	  $item_for_sale = ItemForSalePeer::retrieveByPk($request->getParameter('id'));
       
	  if(is_object($item_for_sale))
	  {
	     $con = Propel::getConnection();
	       try {	    
		  $con->beginTransaction(); // start the transaction		  
		    
		  $item_for_sale->setDeleted($item_for_sale->getDeleted() + $item_for_sale->getQuantity());
		  $item_for_sale->setQuantity(0);
		  $item_for_sale->save($con);

                  $item_for_sale->delete($con);

		  $con->commit();
		  $this->getUser()->setFlash('notice', 'El item ha sido eliminado', false);

		} catch (exception $e) {
		  $con->rollback();
		  throw $e;	    
		  $this->getUser()->setFlash('error', "Se genero un problema comuniquese con el adm. $e", false);
		}
	  }
     }
     
     public function executePago(sfWebRequest $request)
     {
	  $this->total_pay = 0;
	  $this->total_price = 0;
    
	  $this->sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());
    
	  if(is_object($this->sales))
	  {
	     $this->setTotalPricePay($this->sales);
	  }
     }
     
     
     public function executeEditPaymentType(sfWebRequest $request)
     {	
	// Buscamos un sales en estado 1 para el cajero actual
	$sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());
	
	$this->setTotalPricePay($sales);
	
	if($this->total_price > $this->total_pay)
	{
	   $this->getUser()->setAttribute('current_payment_type', $request->getParameter('id'));
	}
     }
     
     public function executeUploadPay(sfWebRequest $request)
     {	
	 $this->account = AccountPeer::retrieveByPK($request->getParameter('account_id'));
     }
     
     
     public function executeAddPay(sfWebRequest $request)
     {
	 // Obtenemos los valores pasados por el formulario          
	 $numbers_value = abs($this->getRequestParameter('numbers_value'));
	 $numbers_value = str_replace(',','.',$numbers_value);
	 $numbers_value = (Float)$numbers_value;	 	 		 	 
	 
	 $payment_type_id = $this->getUser()->getAttribute('current_payment_type');
        
	 //obtenemos el usuario actualmente logueado
	 $sf_guard_user_id = $this->getUser()->getId();
        
	 $type = 1;        
           
	 
	 $con = Propel::getConnection();
	 try {
	    $con->beginTransaction(); // start the transaction	    	   	 
          
	    //Verificamos si hay caja abierta, sino se abre una caja para el usuario actual
	    $cashbox = CashBoxPeer::getCashbox($sf_guard_user_id, null, $con);	    	     	
        
	    if(is_object($cashbox))
	    {
	       // Buscamos un sales en estado 1 para el cajero actual
	       $sales = SalesPeer::getSalesByCashierOpen($sf_guard_user_id);
	       
	       if(is_object($sales))
	       {
		  $payment_type = PaymentTypePeer::retrieveByPK($payment_type_id);
		  
		  $currency_price = $payment_type->getCurrency()->getActiveCurrencyPrice();
		  
		  $movement_cashbox = MovementCashboxPeer::createMovementCashbox(
		       $numbers_value, 
		       $cashbox->getId(), 
		       $currency_price->getId(),
		       $payment_type_id, 
		       null, $con);
		  
		  
		     if(is_object($movement_cashbox) && $movement_cashbox->getId() > 0)
		     {
			$movement_cashbox_sales =  MovementCashboxSalesPeer::createMovementCashboxSales(
				$movement_cashbox->getId(),
				$sales->getId(), null, $con);

			if(is_object($movement_cashbox_sales) && $movement_cashbox_sales->getId() > 0)
			{
			   $type = 0;
			}
		     }
		     
		     if($type == 0)
		     {
			$con->commit(); // Terminar la transaccion

			$this->getUser()->setFlash('notice', 'El movimiento se realizo con exito.', false);

		     } else {
			$this->getUser()->setFlash('error', 'Se genero un error, comuniquese con el administrador del sistema.', false);
		     }
	       }
          
         } else {
           $this->getUser()->setFlash('error', 'No existe la caja, comuniquese con el administrador del sistema.', false);
         }
      } 
      catch (exception $e) 
      {
        $con->rollback();
        throw $e;
        $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
      }               
      
      $this->getUser()->setAttribute('current_payment_type', null);
     
      // Variables para retornar a la interfaz
      $json = json_encode(
            array(
                'type'=> $type
                )
            );
      
      
      $render = $this->renderText($json);      

      return $render;
  }
  
  function executeClose(sfWebRequest $request)
  {
     sfConfig::set('sf_web_debug', false);
     
     $con = Propel::getConnection();
     try
      {
         $con->beginTransaction(); // start the transaction
	 
	 //obtenemos el usuario actualmente logueado
	 $sf_guard_user_id = $this->getUser()->getId();
         
         //Verificamos si hay caja abierta, sino se abre una caja para el usuario actual
         $cashbox = CashBoxPeer::getCashbox($sf_guard_user_id, null, $con);
         if(is_object($cashbox))
         {
	    // Buscamos un sales en estado 1 para el cajero actual
	    $sales = SalesPeer::retrieveByPK($request->getParameter('sales_id'));
	    
	    if(is_object($sales))
	    {
	       // Ajustamos los movimientos de este Deposito
               $sales->adjustPay($cashbox->getId(), $con);
	       
	        // Obtenemos la ultima nightaudit
		$night_audit = NightAuditPeer::getLastNightAudit();

		$discount = 0;
		$comment = 'Venta directa';
		
		$array_receipt = array(
		 'total' => $sales->getTotalPrice()
		,'total_net' => $sales->getTotalPrice()
		,'night_audit_id' => $night_audit->getId()
		,'discount' => $discount
	        ,'service' => 0
		,'canceled' => 0
		,'printed' => 0
		,'comment' => $comment
		,'name' => $request->getParameter('name')
		,'nit' => $request->getParameter('nit')
		,'telefon' => $request->getParameter('telefon')
	     );
	     
	     // Creamos el recibo
	     $this->receipt = ReceiptPeer::saveReceipt($array_receipt, null, $con);

		if(is_object($this->receipt) && $this->receipt->getId() > 0)
		{
		   // Asociamos el recibo a la ventas
		   $sales->addReceipt($this->receipt->getId(), $con);

		   $sales->setIdState(2); // Cerramos la venta

		   $sales->save($con);

		   $con->commit(); // commit changes to db
		   
		   $this->getUser()->setFlash('notice', 'La venta fue exitosa');
		   $this->redirect('/receipt/show/id/'.$this->receipt->getId());
		}
	    }	                  
         }
         
       } catch (exception $e) {
         $con->rollback();        
	 $this->getUser()->setFlash('error', 'Se genero un problema inesperado, comuniquese con el administrador de sistema. ('.$e->getMessage().') ', false);
       }
       
       exit;
   }
   
  public function executePay(sfWebRequest $request)
  {
    $this->total_pay = 0;
    $this->total_price = 0;
    
    $this->sales = SalesPeer::getSalesByCashierOpen($this->getUser()->getId());
    
    if(is_object($this->sales))
    {
       $this->setTotalPricePay($this->sales);
    }
  }
   
   
  public function executeDelPayAmount(sfWebRequest $request)
  {
    // Obtengo la conexion
    $con = Propel::getConnection();
    
    try
    {
      $con->beginTransaction(); // Inicio la transaccion
      
      // Obtenemos el movimiento que se quiere eliminar
      $movement_cashbox = MovementCashboxPeer::retrieveByPK($request->getParameter('movement_id'));

      if(is_object($movement_cashbox))
      { // Si existe este movimiento, buscamos su MovementCashboxContractCurrency
	    $movement_cashbox_sales = MovementCashboxSalesPeer::getMovementCashboxSalesByMovementCashboxId($movement_cashbox->getId());

	    if(is_object($movement_cashbox_sales))
	    {// Si existe este movimientos, lo eliminamos
	      $movement_cashbox_sales->delete($con);
	      // Eliminamos el MovementCashbox
	      $movement_cashbox->delete($con);
	      
	      $con->commit(); // Terminar la transaccion
	      $this->getUser()->setFlash('notice', 'Elimino con exito un pago.', false);
	    }
       }
       
    } catch (PropelException$e) {             
      $this->getUser()->setFlash('error', 'Se genero un problema inesperado, comuniquese con el administrador de sistema.', false);
      $con->rollback();
    }
    
    exit;
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
    
  
}


