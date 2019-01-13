<?php

require_once dirname(__FILE__).'/../lib/cashboxGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/cashboxGeneratorHelper.class.php';

/**
 * cashbox actions.
 *
 * @package    school
 * @subpackage cashbox
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class cashboxActions extends autoCashboxActions
{
   
   public function preExecute()
  {
    $this->configuration = new cashboxGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new cashboxGeneratorHelper();

    parent::preExecute();
  }

  public function executeIndex(sfWebRequest $request)
  {
    // sorting
    if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
    {
      $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
    }

    // pager
    if ($request->getParameter('page'))
    {
      $this->setPage($request->getParameter('page'));
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();
  }

  public function executeFilter(sfWebRequest $request)
  {
    $this->setPage(1);

    if ($request->hasParameter('_reset'))
    {
      $this->setFilters($this->configuration->getFilterDefaults());

      $this->redirect('@cashbox');
    }

     $this->filters = $this->configuration->getFilterForm($this->getFilters());
    
    $array_filter = $request->getParameter($this->filters->getName());

    $this->filters->bind($array_filter);
    if ($this->filters->isValid())
    {
      $this->setFilters($array_filter);

      $this->redirect('@cashbox');
    } 
//    else 
//    {
//       echo $this->filters->getErrorSchema()->getMessage();
//    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->Cashbox = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->Cashbox = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->Cashbox = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->Cashbox);
  }
  
  public function executeTransferencia(sfWebRequest $request)
  {
   
   
  }
  
  
  public function executeClose(sfWebRequest $request)
  { 
    $con = Propel::getConnection();
    try
    {
      $con->beginTransaction(); // start the transaction

      $this->cashbox = CashBoxPeer::retrieveByPK($request->getParameter('id'));

      // $this->setValues();
      
      if (is_object($this->cashbox) && ($this->cashbox->getIdState() == 1))
      {
	 $ban = true;
//        if ($this->cashbox->getCashierId() == $this->getUser()->getAttribute('active_user_dependence'))
//        {
//          $ban = true;
//        } else {
//          $dependence_id = UsersDependencePeer::getDependenceFromId($this->getUser()->getAttribute('active_user_dependence'));
//          $cashier_dependence_id = UsersDependencePeer::getDependenceFromId($this->cashbox->getCashierId());
//          // si es supervisor de esta dependencia
//          if ($dependence_id == $cashier_dependence_id)
//          {
//            $ban = true;
//          } else {
//            $ban = false;
//          }
//        }

        if ($ban)
        {
          $this->cashbox->setIdState(2);
          $this->cashbox->setClosingDate(time());
          $this->cashbox->save($con);

          // commit changes if no error
          $con->commit();
	  $this->getUser()->setFlash('notice', 'La caja fue cerrada', false);	  

        } else {
	  $this->getUser()->setFlash('error', 'La caja no fue cerrada', false);
          return $this->redirect('cashBox/index');
        }
      } else {        
	$this->getUser()->setFlash('error', 'La caja no esta abierta, por lo tanto no puede cerrarla', false);
        return $this->redirect('cashBox/index');
      }
    }    
     catch (exception $e) {
      $con->rollback();
      throw $e;
    }

     $this->setTemplate('show');
  }
  
  
  public function executeUpdateSupervising(sfWebRequest $request)
  {
    
    $con = Propel::getConnection();
    try {
      $con->beginTransaction(); // start the transaction

      $this->cashbox = CashBoxPeer::retrieveByPK($request->getParameter('id'));
      $this->forward404Unless($this->cashbox);
      
      // $this->setValues();

      if (is_object($this->cashbox) && ($this->cashbox->getIdState() == 2))
      {
	  $ban = true;
//        $dependence_id = UsersDependencePeer::getDependenceFromId($this->getUser()->getAttribute('active_user_dependence'));
//        $cashier_dependence_id = UsersDependencePeer::getDependenceFromId($this->cashbox->getCashierId());
//        // si es supervisor de esta dependencia
//        if ($dependence_id == $cashier_dependence_id)
//        {
//          $ban = true;
//        } else {
//          $ban = false;
//        }

        if ($ban)
        {
          $this->cashbox->setIdState(3);
          $this->cashbox->setComment($request->getParameter('comment'));
          // $this->cashbox->setSupervisorId($this->getUser()->getProfile()->getId());
          $this->cashbox->save($con);

          
          // commit changes if no error
          $con->commit();
	  $this->getUser()->setFlash('notice', 'La caja fue cerrada', false);
	  
        } else {
//          $this->setFlash('notice', $this->getContext()->getI18N()->__('You cannot supervise the cashbox'));
//          return $this->redirect('cashbox/list');
	  
	  $this->getUser()->setFlash('error', 'Usted no es puede supervisar esta caja', false);
          return $this->redirect('cashBox/index');
	  
        }
      } else {
//        $this->setFlash('notice', $this->getContext()->getI18N()->__('This cashbox can not be supervised'));
//        return $this->redirect('cashbox/list');
	
	$this->getUser()->setFlash('error', 'Esta caja no puede ser supervisada', false);
        return $this->redirect('cashBox/index');
      }
    }catch (exception $e) {
      $con->rollback();
      throw $e;
    }

    $this->setTemplate('show');
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->Cashbox = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->Cashbox);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@cashbox');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@cashbox');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@cashbox');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Cashbox'));
    try
    {
      // validate ids
      $ids = $validator->clean($ids);

      // execute batch
      $this->$method($request);
    }
    catch (sfValidatorError $e)
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
    }

    $this->redirect('@cashbox');
  }
  
  
  public function executeShow(sfWebRequest $request)
  {    
    $this->cashbox = CashBoxPeer::retrieveByPk($request->getParameter('id'));
    
    $this->getUser()->setAttribute('current_payment_type', null);
  }
    
  public function executeBillets(sfWebRequest $request)
  {
    $this->billets = TransferBilletPeer::getFromTransfer($request->getParameter('id'));
  }
  
  public function executeEditPaymentType()
  {    
       $this->getUser()->setAttribute('current_payment_type', $this->getRequestParameter('id'));

       if ($this->getRequestParameter('cashbox_id'))
       {
	 $this->cashbox_id = $this->getRequestParameter('cashbox_id');
       } else {
	 $this->cashbox_id = null;
       }       
  }
 
  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (CashBoxPeer::retrieveByPks($ids) as $object)
    {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));

      $object->delete();
      if ($object->isDeleted())
      {
        $count++;
      }
    }

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    }
    else
    {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@cashbox');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Cashbox = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Cashbox)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@cashbox_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'cashbox_edit', 'sf_subject' => $Cashbox));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('cashbox.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('cashbox.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('Cashbox');
    
//    echo $this->buildCriteria()->toString();
    
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod($this->configuration->getPeerMethod());
    $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
    $pager->init();

//    exit;
    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('cashbox.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('cashbox.page', 1, 'admin_module');
  }

  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
      $array_filter = $this->getFilters();
      
      $criteria = new Criteria();
      if(isset($array_filter['id_state']) && !empty($array_filter['id_state']) && $array_filter['id_state'] > 0)
      {	 
	 $criteria->add(CashboxPeer::ID_STATE, $array_filter['id_state']);
      }
      
      if ((isset($array_filter['from_date']) && $array_filter['from_date'] !== '') || (isset($array_filter['to_date']) && $array_filter['to_date'] !== '')) 
      {
	    if (isset($array_filter['from_date']) && $array_filter['from_date'] !== '')
	    {
	       $array_from_date = explode('/', $array_filter['from_date']);
	       
	       $sf_from_date = new sfDate($array_from_date[2].'-'.$array_from_date[1].'-'.$array_from_date[0].' 00:00:00');
	       $criterion = $criteria->getNewCriterion(NightAuditPeer::DATE, $sf_from_date->dump(), Criteria::GREATER_EQUAL);
	    }

	    if (isset($array_filter['to_date']) && $array_filter['to_date'] !== '')
	    {
  	        $array_to_date = explode('/', $array_filter['to_date']);
	                                   // Año                  Mes                  Dia
		$sf_to_date = new sfDate($array_to_date[2].'-'.$array_to_date[1].'-'.$array_to_date[0].' 23:59:59');

		if (isset($criterion)) {
		    $criterion->addAnd($criteria->getNewCriterion(NightAuditPeer::DATE, $sf_to_date->dump(), Criteria::LESS_EQUAL));
		} else {
		    $criterion = $criteria->getNewCriterion(NightAuditPeer::DATE, $sf_to_date->dump(), Criteria::LESS_EQUAL);
		}
	    }

	    if (isset($criterion)) {
		$criteria->add($criterion);
		$criteria->addJoin(CashBoxPeer::NIGHT_AUDIT_ID, NightAuditPeer::ID);
	    }
        } else {
	   // Obtenemos la ultima auditoria
	   $night_audit_id = NightAuditPeer::getNightAuditIdByLastNightAudit();
	   $criteria->add(CashBoxPeer::NIGHT_AUDIT_ID, $night_audit_id);
	}
      
      
      if(isset($array_filter['cashier_id']) && !empty($array_filter['cashier_id']) && $array_filter['cashier_id'] > 0)
      {
	 $criteria->add(CashboxPeer::CASHIER_ID, $array_filter['cashier_id']);
      }
      
      $criteria->addDescendingOrderByColumn('id');
      
      // $criteria = $this->filters->buildCriteria($this->getFilters());
      
    } else {

       $array_filter = $this->getFilters();


       // $criteria = $this->filters->buildCriteria($this->getFilters());
    }

    $this->addSortCriteria($criteria);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();
    
    return $criteria;
  }

  protected function addSortCriteria($criteria)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    $column = CashBoxPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
    if ('asc' == $sort[1])
    {
      $criteria->addAscendingOrderByColumn($column);
    }
    else
    {
      $criteria->addDescendingOrderByColumn($column);
    }
  }

  protected function getSort()
  {
    if (null !== $sort = $this->getUser()->getAttribute('cashbox.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('cashbox.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('cashbox.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames('Cashbox', BasePeer::TYPE_FIELDNAME));
  }    
   
}