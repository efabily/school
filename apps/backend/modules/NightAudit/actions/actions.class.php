<?php

require_once dirname(__FILE__).'/../lib/NightAuditGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/NightAuditGeneratorHelper.class.php';

/**
 * NightAudit actions.
 *
 * @package    school
 * @subpackage NightAudit
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class NightAuditActions extends autoNightAuditActions
{
   
  public function preExecute()
  {
    $this->configuration = new NightAuditGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new NightAuditGeneratorHelper();

    parent::preExecute();
  }
  
  
  public function executeShow(sfWebRequest $request)
  {      
    // Obtengo el objeto entidad a partir de la actualmente seleccionada
    $this->business_entity = BusinessEntityPeer::retrieveByPK(1);
  }
  
  
  public function executeConfig(sfWebRequest $request)
  {        
    // Obtengo el objeto entidad a partir de la actualmente seleccionada
    $business_entity = BusinessEntityPeer::retrieveByPK(1);
    
    if(is_object($business_entity))
    {
        
        $this->form = new ConfigForm($business_entity);
        
        if ($request->isMethod('post'))
        {
	   
	   // $data['_csrf_token'] = $request->getParameter('_csrf_token');
	   $array_business_entity = $request->getParameter('business_entity');	
		    
           $this->form->bind($array_business_entity);
            
            if ($this->form->isValid())//	 
            {
                // iniciamos las transacciones
                $con = Propel::getConnection();
                try {
                    $con->beginTransaction(); // start the transaction
                                        
                     // Actualizamos los datos de la entidad                     
                     $business_entity->setNightAuditHour($this->form->getValue('night_audit_hour'));
                     $business_entity->save($con);

                    // commit changes if no error
                    $con->commit();
                    $this->getUser()->setFlash('notice', 'Datos de configuracion guardado con exito ');
		    return $this->redirect('NightAudit/show');

                } catch (exception $e) {
                    $con->rollback();
                    throw $e;
                }
                                                
            }else {         
             $this->getUser()->setFlash('error', 'Los compos en rojo son obligatorios. '.$this->form->getErrorSchema()->getMessage(), false);
            }
        }
        
        
    } else {
       $this->getUser()->setFlash('error', 'No existe esta entidad, comuniquese con el adm del portal.');
       return $this->redirect('NightAudit/index');
    }        
           
  }
  
  
  public function executeExecute()
  {        
    // Obtengo el objeto entidad a partir de la actualmente seleccionada
    $business_entity = BusinessEntityPeer::retrieveByPK(1);
    
    if(is_object($business_entity))
    {
        // iniciamos las transacciones
        $con = Propel::getConnection();
        try {
          $con->beginTransaction(); // start the transaction          
          
          if(NightAuditPeer::execute($business_entity, $this->getUser()->getId(), $con))
          {
              // commit changes if no error
              $con->commit();
              $this->getUser()->setFlash('notice', 'Realizo un cierre con exito.');
              $this->redirect('NightAudit/index');
          } else {
              $this->getUser()->setFlash('error', 'No es hora para ejecutar el cierre, la hora del cierre es a las '.$business_entity->getNightAuditHour().':00:00');
              return $this->redirect('NightAudit/index');
          }

        } catch (exception $e) {
         $con->rollback();
         throw $e;
        }	  
	  
            
    } else {
       $this->getUser()->setFlash('error', 'No existe esta entidad, comuniquese con el adm del portal.');
       return $this->redirect('NightAudit/index');
    }        
           
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

      $this->redirect('@night_audit_NightAudit');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    
    $array_filter = $request->getParameter($this->filters->getName());
    
    $this->filters->bind($array_filter);
    if ($this->filters->isValid())
    {
      // $this->setFilters($this->filters->getValues());
      $this->setFilters($array_filter);

      $this->redirect('@night_audit_NightAudit');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->NightAudit = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->NightAudit = $this->form->getObject();

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->NightAudit = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->NightAudit);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->NightAudit = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->NightAudit);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@night_audit_NightAudit');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@night_audit_NightAudit');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@night_audit_NightAudit');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'NightAudit'));
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

    $this->redirect('@night_audit_NightAudit');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (NightAuditPeer::retrieveByPks($ids) as $object)
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

    $this->redirect('@night_audit_NightAudit');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $NightAudit = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $NightAudit)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@night_audit_NightAudit_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'night_audit_NightAudit_edit', 'sf_subject' => $NightAudit));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('NightAudit.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('NightAudit.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('NightAudit');
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod($this->configuration->getPeerMethod());
    $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('NightAudit.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('NightAudit.page', 1, 'admin_module');
  }

  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
      
      $array_filter = $this->getFilters();    
      
    $criteria = new Criteria();
      if(isset($array_filter['user_id']) && !empty($array_filter['user_id']) && $array_filter['user_id'] > 0)
      {	 
	 $criteria->add(NightAuditPeer::USER_ID, $array_filter['user_id']);
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
	    }
        }
    }
    
    

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

    $column = NightAuditPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
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
    if (null !== $sort = $this->getUser()->getAttribute('NightAudit.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('NightAudit.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('NightAudit.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames('NightAudit', BasePeer::TYPE_FIELDNAME));
  }
  
}
