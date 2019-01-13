<?php

require_once dirname(__FILE__).'/../lib/PeriodGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/PeriodGeneratorHelper.class.php';

/**
 * Period actions.
 *
 * @package    school
 * @subpackage Period
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class PeriodActions extends autoPeriodActions
{

  public function executeChange(sfWebRequest $request)
  {
    $period = PeriodPeer::retrieveByPK($request->getParameter('id'));
    
    if(is_object($period))
    {
       $con = Propel::getConnection();
       try
       {
	     $con->beginTransaction(); // Iniciamos transaccion	     
	     
	     $s = $request->getParameter('s');
	     $period->changeStateId($s, $con);
	     
	     if($s == 2)
	     {
		$old_period = PeriodPeer::getAnotherAssetExchange($s, $period->getId());
		if(is_object($old_period))
		{
		   $old_period->setIdState(3);
		   $old_period->save($con);
		}
	     }
	     
	     $con->commit(); // Terminar la transaccion	    

       } catch (exception $e) {
	 $con->rollback();
	 throw $e;
	 $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
       }       
    }
    
    $this->redirect('@period');    
  }
   
  public function executeChangePeriod(sfWebRequest $request)
  {
    $default = $request->getParameter('period');
    
    $this->form = new CurrentPeriodForm(
            $this->getUser(),
            array('period' => PeriodPeer::getPeriods(), 'default' => $default)
    );

    $this->form->process($request);

    return $this->redirect('@homepage');
  }
  
  
  public function preExecute()
  {
    $this->configuration = new PeriodGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new PeriodGeneratorHelper();

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

      $this->redirect('@period');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@period');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->Period = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
     $this->form = new PeriodForm();
     
     $period = $request->getParameter('period');
     
     $this->form->bind($period);
     if ($this->form->isValid())
     {
	
	$con = Propel::getConnection();
	  try
	  {
	     $con->beginTransaction(); // Iniciamos transaccion
	     
	    $array_period = array(
	     'id_state' => 1
	     ,'name' => strtoupper($this->form->getValue('name'))
	     ,'from_date' => $this->form->getValue('from_date')
	     ,'to_date' => $this->form->getValue('to_date')
	     );
	    
	     $period = PeriodPeer::savePeriod($array_period, null, $con);
	     
	     if(is_object($period) && $period->getId() > 0)
	     {
		$con->commit(); // Terminar la transaccion
		
		if ($request->hasParameter('_save_and_add'))
	        {
		  $this->getUser()->setFlash('notice', ' Agrego con exito un nuevo periodo.');

		  $this->redirect('@period_new');
	        }
	        else
	        {
		 $this->getUser()->setFlash('notice', $notice);

		 $this->redirect('@period');
	        }
	     }
	  } 
	  catch (exception $e) 
	  {
	      $con->rollback();
	      throw $e;
	      $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
	  }       	 	 
     }
     else
     {
	 $this->getUser()->setFlash('error', 'El periodo no fue creado porque se genero un error. '.$this->form->getErrorSchema()->getMessage(), false);
     }

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->Period = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->Period);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $data_period = $request->getParameter('period');
          
    $this->Period = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->Period);
     
    $this->form->bind($data_period);
    if ($this->form->isValid())
    {
	  $con = Propel::getConnection();
	  try
	  {
	       $con->beginTransaction(); // Iniciamos transaccion
	     
	       $array_period = array(
		  'id_state' => $this->Period->getStateId()
		  ,'name' =>  strtoupper($this->form->getValue('name'))
		  ,'from_date' => $this->form->getValue('from_date')
		  ,'to_date' => $this->form->getValue('to_date')
	       );
	    
	       $period = PeriodPeer::savePeriod($array_period, $this->Period, $con);
	     
	       if(is_object($period) && $period->getId() > 0)
	       {
		  $con->commit(); // Terminar la transaccion
				
		  $this->getUser()->setFlash('notice', $notice);

		  $this->redirect('@period');	        
	     }
	  } 
	  catch (exception $e) 
	  {
	      $con->rollback();
	      throw $e;
	      $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
	  }       	 	 
     }
     else
     {
	 $this->getUser()->setFlash('error', 'El periodo no fue editado porque se genero un error. '.$this->form->getErrorSchema()->getMessage(), false);
     }

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@period');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@period');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@period');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Period'));
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

    $this->redirect('@period');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (PeriodPeer::retrieveByPks($ids) as $object)
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

    $this->redirect('@period');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Period = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Period)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@period_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'period_edit', 'sf_subject' => $Period));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('Period.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('Period.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('Period');
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod($this->configuration->getPeerMethod());
    $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('Period.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('Period.page', 1, 'admin_module');
  }

  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());
    $criteria->addDescendingOrderByColumn('id');
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

    $column = PeriodPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
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
    if (null !== $sort = $this->getUser()->getAttribute('Period.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('Period.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('Period.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames('Period', BasePeer::TYPE_FIELDNAME));
  }
  
}
