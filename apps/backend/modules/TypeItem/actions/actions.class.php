<?php

require_once dirname(__FILE__).'/../lib/TypeItemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/TypeItemGeneratorHelper.class.php';

/**
 * TypeItem actions.
 *
 * @package    school
 * @subpackage TypeItem
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class TypeItemActions extends autoTypeItemActions
{
  
  
  public function preExecute()
  {
    $this->configuration = new TypeItemGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new TypeItemGeneratorHelper();

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

      $this->redirect('@type_item');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@type_item');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }
  
  public function executeChange(sfWebRequest $request)
  {
    $type_item = TypeItemPeer::retrieveByPK($request->getParameter('id'));
    
    $con = Propel::getConnection();
    try
    {
	  $con->beginTransaction(); // Iniciamos transaccion	     
     
	  if(is_object($type_item))
	  {
	     $s = $request->getParameter('s');
	     $type_item->changeStateId($s, $con);
	     $con->commit(); // Terminar la transaccion
	  }
    
    } catch (exception $e) {
      $con->rollback();
      throw $e;
      $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
    }
    
    $this->redirect('@type_item');    
  }
  

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->TypeItem = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
     $this->form = new TypeItemForm();
     
     $data_type_item = $request->getParameter('type_item');
     
     $this->form->bind($data_type_item);
     if ($this->form->isValid())
     {
	
	$con = Propel::getConnection();
	  try
	  {
	     $con->beginTransaction(); // Iniciamos transaccion
	     
	    $array_type_item = array(
	     'id_state' => 2
	     ,'name' => $this->form->getValue('name')
	     ,'description' => $this->form->getValue('description')	    
	     );
	    
	     $type_item = TypeItemPeer::saveTypeItem($array_type_item, null, $con);
	     
	     if(is_object($type_item) && $type_item->getId() > 0)
	     {
		$con->commit(); // Terminar la transaccion
		
		if ($request->hasParameter('_save_and_add'))
	        {
		  $this->getUser()->setFlash('notice', ' Agrego con exito un nuevo item.');

		  $this->redirect('@itype_item_new');
	        }
	        else
	        {
		 $this->getUser()->setFlash('notice', $notice);

		 $this->redirect('@type_item');
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
	 $this->getUser()->setFlash('error', 'El item no fue creado porque se genero un error. '.$this->form->getErrorSchema()->getMessage(), false);
     }
    
    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->TypeItem = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->TypeItem);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $data_type_item = $request->getParameter('type_item');
          
    $this->TypeItem = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->TypeItem);
     
     $this->form->bind($data_type_item);
     if ($this->form->isValid())
     {
	$type_item = $this->form->getObject();
	$con = Propel::getConnection();
	  try
	  {
	     $con->beginTransaction(); // Iniciamos transaccion
	     
	    $array_type_item = array(
	     'id_state' => 2
	     ,'name' => $this->form->getValue('name')
	     ,'description' => $this->form->getValue('description')	    
	     );
	    
	     $type_item = TypeItemPeer::saveTypeItem($array_type_item, $type_item, $con);
	     
	     if(is_object($type_item) && $type_item->getId() > 0)
	     {
		$con->commit(); // Terminar la transaccion
				
		$this->getUser()->setFlash('notice', $notice);

		$this->redirect('@type_item');	        
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
	 $this->getUser()->setFlash('error', 'El item no fue creado porque se genero un error. '.$this->form->getErrorSchema()->getMessage(), false);
     }
    

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@type_item');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@type_item');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@type_item');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'TypeItem'));
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

    $this->redirect('@type_item');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (TypeItemPeer::retrieveByPks($ids) as $object)
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

    $this->redirect('@type_item');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $TypeItem = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $TypeItem)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@type_item_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'type_item_edit', 'sf_subject' => $TypeItem));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('TypeItem.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('TypeItem.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('TypeItem');
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod($this->configuration->getPeerMethod());
    $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('TypeItem.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('TypeItem.page', 1, 'admin_module');
  }

  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());

    $this->addSortCriteria($criteria);

    $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
    $criteria = $event->getReturnValue();
    
    $criteria->add(TypeItemPeer::ID, 1, Criteria::GREATER_THAN);

    return $criteria;
  }

  protected function addSortCriteria($criteria)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    $column = TypeItemPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
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
    if (null !== $sort = $this->getUser()->getAttribute('TypeItem.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('TypeItem.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('TypeItem.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames('TypeItem', BasePeer::TYPE_FIELDNAME));
  }
  
}
