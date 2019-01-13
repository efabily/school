<?php
/**
 * cashbox actions.
 *
 * @package    school
 * @subpackage cashbox
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class transferActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
    // obtenemos la transferencia a partir de un ide
     $this->transfer_id = $request->getParameter('id');
     
     
  } 
  
  public function executeListTransfer(sfWebRequest $request)
  {
    // obtenemos el id de la caja para el cual se mostrara las transferencia
     $this->cashbox_id = $request->getParameter('cashbox_id');
  }
  
  public function executeUploadAmount()
  {
    if ($this->getRequestParameter('cashbox_id'))
    {
      $this->cashbox_id = $this->getRequestParameter('cashbox_id');
    } else {
      $this->cashbox_id = null;
    }
  }
  
  public function executePaymentTypeList()
  {
    if ($this->getRequestParameter('cashbox_id'))
    {
      $this->cashbox_id = $this->getRequestParameter('cashbox_id');
    } else {
      $this->cashbox_id = null;
    }
  }
  
  public function executeCreateTransfer(sfWebRequest $request)
  {
     sfConfig::set('sf_web_debug', false);

    if ($request->getParameter('cashbox_id'))
    {        
	$this->cashbox_id = $request->getParameter('cashbox_id');
    } else {
       $cashbox = CashBoxPeer::getCashbox($this->getUser()->getId());	 
       $this->cashbox_id = $cashbox->getId();
    }
    
    $this->getUser()->setAttribute('current_payment_type', null);
  }
  
  public function executeOpen(sfWebRequest $request)
  {
     sfConfig::set('sf_web_debug', false);
     $this->setLayout(false);
    $this->cashbox_id = $request->getParameter('cashbox_id');
    
  }
  
  public function executeAddAmount(sfWebRequest $request)
  {
     $this->transfer_id = 0;
     if(!$request->getParameter('cashbox_id'))
     {
	$this->getUser()->setFlash('error', 'No existe caja abierta para el usuario actualmente logueado');
	return;
     }
     
     if(!$this->getUser()->getAttribute('current_payment_type'))
     {
	$this->getUser()->setFlash('error', 'Debe Seleccionar el tipo de pago');
	return;
     }
     
     if(!$request->getParameter('username') && !$request->getParameter('password'))
     {
	 $this->getUser()->setFlash('error', 'Debe ingresar el nombre de usuario y contraseña que aprueba este moviento');
	 return;
     }
     
     if(!$request->getParameter('type_movement'))
     {
	$this->getUser()->setFlash('error', 'Debe Seleccionar el tipo de moviento que esta realizando');
	return;
     }
     
     if(!$request->getParameter('comment'))
     {
	$this->getUser()->setFlash('error', 'Debe ingresar el comentario de la transferencia');
	return;
     }
     
     if(!$request->getParameter('billets') && !$request->getParameter('monto'))
     {
	$this->getUser()->setFlash('error', 'Debe ingresar la cantidad de cada corte de dinero');
	return;
     }
     
     if($request->getParameter('monto') <= 0)
     {
	$this->getUser()->setFlash('error', 'La cantidad de cada corte debe ser positiva');
	return;
     }
     
     $cashbox_id = $request->getParameter('cashbox_id');
     $billets = $request->getParameter('billets');
     $monto = $request->getParameter('monto');
     
     $comment = $request->getParameter('comment');
     $type_movement = $request->getParameter('type_movement');
     
     $current_payment_type = $this->getUser()->getAttribute('current_payment_type');
     
     $username = $request->getParameter('username');
     $password = $request->getParameter('password');
     
      $sf_guard_user_aprobado = sfGuardUserPeer::retrieveByUsername($request->getParameter('username'));
      if(!is_object($sf_guard_user_aprobado))
      {
	 $this->getUser()->setFlash('error', 'Ingrese un usuario valido');
	 return;
      }
      
      if (!$sf_guard_user_aprobado->checkPassword($request->getParameter('password')))
      {
	$this->getUser()->setFlash('error', 'Contraseña incorrecta');
	return;
      }
      
      
      $con = Propel::getConnection();
	       
      try {

	    $con->beginTransaction(); // start the transaction	
	    $r = true;
		  
		  //Verificamos si hay caja abierta, sino se abre una caja para el usuario actual
		  $this->cashbox = CashBoxPeer::retrieveByPK($cashbox_id);
        
		  if(is_object($this->cashbox))
		  {  
		     $payment_type = PaymentTypePeer::retrieveByPK($current_payment_type);	       	       
    
		     $currency_price = $payment_type->getCurrency()->getActiveCurrencyPrice();
		     
		     // Creamos la transferencia
		     $transfer = TransferPeer::saveTransfer(2, $monto, $comment, $type_movement, $sf_guard_user_aprobado->getId(), null, $con);
		     if(is_object($transfer) && $transfer->getId() > 0)
		      {
			     $total = 0;

			     foreach ($billets as $b)
			     {
				$billet = BilletPeer::retrieveByPK($b['id']);		    		    

				if(is_object($billet))
				{
				   $total += ($b['value'] * $billet->getValue());

				   $transfer_billet = TransferBilletPeer::saveTransferBillet($transfer->getId(), $billet->getId(), $b['value'], null, $con);

				   if(!is_object($transfer_billet) || $transfer_billet->getId() < 0)
				   {
				      break;
				      $r = false;
				   }
				}
			     }

			     if($type_movement == 2)
			     {
				$total = $total * -1;
			     }

			     $transfer->setAmount($total);
			     $transfer->save($con);
			     
			     $this->cashbox->getId();
			     $currency_price->getId();
			     
			     $movement_cashbox = MovementCashboxPeer::createMovementCashbox($total, $this->cashbox->getId(), $currency_price->getId(), $payment_type->getId(), null, $con);
			     if(is_object($movement_cashbox) && $movement_cashbox->getId() > 0)
			     {
				$movement_cashbox_transfer = MovementCashboxTransferPeer::saveMovementCashboxTransfer($transfer->getId(), $movement_cashbox->getId(), null, $con);
				if(!is_object($movement_cashbox_transfer) || $movement_cashbox_transfer->getId() <= 0)
				{
				   $r = false;
				}
			     } else {
				$r = false;
			     }
			  }


			if($r)
			{
			   
			   $this->transfer_id = $transfer->getId();
			   
			   $con->commit(); // Terminar la transaccion
			   $this->getUser()->setAttribute('current_payment_type', null);
			   $this->getUser()->setFlash('notice', 'El movimiento se realizo con exito.', false);
			} else {
			   $this->getUser()->setFlash('error', 'Se genero un error, comuniquese con el administrador del sistema.', false);
			}
		     
		  } else {
		     $this->getUser()->setFlash('error', 'El usuario actualmente logueado no tiene caja abierta.', false);
		  }
	    }
	    catch (exception $e) 
	    {
	       $con->rollback();
	       throw $e;
	       $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
	    }
	      
	   
	   
		
    
      
     
  }
   
}

