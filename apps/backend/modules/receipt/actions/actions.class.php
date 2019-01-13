<?php

//require_once dirname(__FILE__).'/../lib/cashboxGeneratorConfiguration.class.php';
//require_once dirname(__FILE__).'/../lib/cashboxGeneratorHelper.class.php';

/**
 * cashbox actions.
 *
 * @package    school
 * @subpackage cashbox
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class receiptActions extends sfActions
{

  public function executeShow(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('id'))
    {
       $this->receipt = ReceiptPeer::retrieveByPK($request->getParameter('id'));
       
       if($request->getParameter('idc'))
       {
	  $this->contract = ContractPeer::retrieveByPK($request->getParameter('idc'));
       }
    }   
  }   
   
}
