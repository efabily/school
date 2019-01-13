<?php

require_once dirname(__FILE__).'/../lib/ItemGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/ItemGeneratorHelper.class.php';

/**
 * Item actions.
 *
 * @package    school
 * @subpackage Item
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class ItemActions extends autoItemActions
{
  public function preExecute()
  {
    $this->configuration = new ItemGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new ItemGeneratorHelper();

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

      $this->redirect('@item');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@item');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }
  
  
  public function executeChange(sfWebRequest $request)
  {
    $item = ItemPeer::retrieveByPK($request->getParameter('id'));
    
    $con = Propel::getConnection();
    try
    {
	  $con->beginTransaction(); // Iniciamos transaccion	     
     
	  if(is_object($item))
	  {
	     $s = $request->getParameter('s');
	     $item->changeStateId($s, $con);
	     $con->commit(); // Terminar la transaccion
	  }
    
    } catch (exception $e) {
      $con->rollback();
      throw $e;
      $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
    }
    
    $this->redirect('@item');    
  }
  

  public function executeNew(sfWebRequest $request)
  {
     $this->form = new NewItemForm();
  }

  public function executeCreate(sfWebRequest $request)
  {
     $this->form = new NewItemForm();
     
     $data_item = $request->getParameter('item');
     
     $this->form->bind($data_item);
     if ($this->form->isValid())
     {
	
	$con = Propel::getConnection();
	  try
	  {
	     $con->beginTransaction(); // Iniciamos transaccion
	     
	     $r = true;
	
	    $array_month = $this->form->getValue('month');
	    $quantity_load = null;
	    $name_load = null;
	    
	    if(count($array_month) > 0)
	    {
	       $quantity_load = count($array_month);
	       $array_name_load = array();
	       
	       foreach ($array_month as $month)
	       {
		  $array_name_load[$month] = ItemPeer::getMounth($month);
	       }
	       
	       $name_load = json_encode($array_name_load);
	    }
	
	    $array_item = array(
	     'id_state' => 2
	     ,'name' => $this->form->getValue('name')
	     ,'description' => $this->form->getValue('description')
	     ,'price' => $this->form->getValue('price')
	     ,'quantity_load' => $quantity_load
	     ,'name_load' => $name_load
	     ,'type_item_id' => $this->form->getValue('type_item_id')
	     );
	    
	     $item = ItemPeer::saveItem($array_item, null, $con);
	     
	     if(is_object($item) && $item->getId() > 0)
	     {				
		$array_nivel_m = $this->form->getValue('nivel_m');		
		
		if(count($array_nivel_m) > 0)
		{
		   foreach ($array_nivel_m as $nivel_m)
		   {
		      $array_item_grade = array('id_state' => 2, 'item_id' => $item->getId(), 'grade_id' => $nivel_m);
		      $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, null, $con);
		      
		      if(!is_object($item_grade) || $item_grade->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }		   
		}
		
		$array_nivel_t = $this->form->getValue('nivel_t');
		if(count($array_nivel_t) > 0)
		{
		   foreach ($array_nivel_t as $nivel_t)
		   {
		      $array_item_grade = array('id_state' => 2, 'item_id' => $item->getId(), 'grade_id' => $nivel_t);
		      $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, null, $con);
		      
		      if(!is_object($item_grade) || $item_grade->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }		   
		}
		
		$array_nivel_n = $this->form->getValue('nivel_n');
		if(count($array_nivel_n) > 0)
		{
		   foreach ($array_nivel_n as $nivel_n)
		   {
		      $array_item_grade = array('id_state' => 2, 'item_id' => $item->getId(), 'grade_id' => $nivel_n);
		      $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, null, $con);
		      
		      if(!is_object($item_grade) || $item_grade->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }		   
		}
		
		$array_discount = $this->form->getValue('discount');
		
		if(count($array_discount) > 0)
		{
		   foreach ($array_discount as $discount)
		   {
		      $array_discount_item = array('id_state' => 2, 'item_id' => $item->getId(), 'discount_id' => $discount);
		      $discount_item = DiscountItemPeer::saveDiscountItem($array_discount_item, null, $con);
		      if(!is_object($discount_item) || $discount_item->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }		      
		   }
		}
		
		
	     }

	     if($r)
	     {
		$con->commit(); // Terminar la transaccion
		
	       if ($request->hasParameter('_save_and_add'))
	       {
		 $this->getUser()->setFlash('notice', ' Agrego con exito un nuevo item.');

		 $this->redirect('@item_new');
	       }
	       else
	       {
		 $this->getUser()->setFlash('notice', " Agrego con exito un nuevo item.");

		 $this->redirect('@item');
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
    $item = ItemPeer::retrieveByPK($request->getParameter('id'));
     
    $this->form = new EditItemForm($item);          
        
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $data_item = $request->getParameter('item');
     
    $item = ItemPeer::retrieveByPK($data_item['id']);
     
    $this->form = new EditItemForm($item);
     
    $this->form->bind($data_item);
    if ($this->form->isValid())
    {
	$con = Propel::getConnection();
	  try
	  {
	     $con->beginTransaction(); // Iniciamos transaccion
	     
	     $r = true;
	
	    $array_month = $this->form->getValue('month');
	    $quantity_load = null;
	    $name_load = null;
	    
	    if(count($array_month) > 0)
	    {
	       $quantity_load = count($array_month);
	       $array_name_load = array();
	       
	       foreach ($array_month as $month)
	       {
		  $array_name_load[$month] = ItemPeer::getMounth($month);
	       }
	       
	       $name_load = json_encode($array_name_load);
	    }
	
	    $array_item = array(
	     'id_state' => 2
	     ,'name' => $this->form->getValue('name')
	     ,'description' => $this->form->getValue('description')
	     ,'price' => $this->form->getValue('price')
	     ,'quantity_load' => $quantity_load
	     ,'name_load' => $name_load
	     ,'type_item_id' => $this->form->getValue('type_item_id')
	     );
	    
	     $item = ItemPeer::saveItem($array_item, $item, $con);
	     
	     if(is_object($item) && $item->getId() > 0)
	     {
		
		ItemGradePeer::deleteByItem($item->getId(), $con);
		
		$array_nivel_m = $this->form->getValue('nivel_m');
		
		
		
		if(count($array_nivel_m) > 0)
		{
		   foreach ($array_nivel_m as $nivel_m)		      
		   {
		      $array_item_grade = array('id_state' => 2, 'item_id' => $item->getId(), 'grade_id' => $nivel_m);
		      
		      $item_grade = ItemGradePeer::getItemGrade($item->getId(), $nivel_m);
		      
		      if(is_object($item_grade))
		      {
			 $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, $item_grade, $con);
		      } else {			 
			 $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, null, $con);
		      }
		      		      
		      if(!is_object($item_grade) || $item_grade->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }		   
		}
		
		$array_nivel_t = $this->form->getValue('nivel_t');
		if(count($array_nivel_t) > 0)
		{
		   foreach ($array_nivel_t as $nivel_t)
		   {
		      $array_item_grade = array('id_state' => 2, 'item_id' => $item->getId(), 'grade_id' => $nivel_t);
		      
		      $item_grade = ItemGradePeer::getItemGrade($item->getId(), $nivel_t);
		      
		      if(is_object($item_grade))
		      {
			 $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, $item_grade, $con);
		      } else {
			 $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, null, $con);
		      }
		      
		      if(!is_object($item_grade) || $item_grade->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }		   
		}
		
		$array_nivel_n = $this->form->getValue('nivel_n');
		if(count($array_nivel_n) > 0)
		{
		   foreach ($array_nivel_n as $nivel_n)
		   {
		      $array_item_grade = array('id_state' => 2, 'item_id' => $item->getId(), 'grade_id' => $nivel_n);
		      
		      $item_grade = ItemGradePeer::getItemGrade($item->getId(), $nivel_n);
		      
		      if(is_object($item_grade))
		      {
			 $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, $item_grade, $con);
		      } else {
			 $item_grade = ItemGradePeer::saveItemGrade($array_item_grade, null, $con);
		      }
		      
		      if(!is_object($item_grade) || $item_grade->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }		   
		}
		
		$array_discount = $this->form->getValue('discount');
		
		if(count($array_discount) > 0)
		{
		   DiscountItemPeer::deleteByItem($item->getId(), $con);
		   foreach ($array_discount as $discount)
		   {
		      $array_discount_item = array('id_state' => 2, 'item_id' => $item->getId(), 'discount_id' => $discount);
		      
		      $discount_item = DiscountItemPeer::getDiscountByItem($item->getId(), $discount);
		      
		      if(is_object($discount_item))
		      {
			 $discount_item = DiscountItemPeer::saveDiscountItem($array_discount_item, $discount_item, $con);
		      } else {
			 $discount_item = DiscountItemPeer::saveDiscountItem($array_discount_item, null, $con);
		      }
		      
		      if(!is_object($discount_item) || $discount_item->getId() <= 0)
		      {
			 $r = false;
			 break;
		      }
		   }
		}
		
	     }

	     if($r)
	     {
		$con->commit(); // Terminar la transaccion
				
		$this->getUser()->setFlash('notice', $notice);

		$this->redirect('@item');	       
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

    $this->redirect('@item');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@item');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@item');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Item'));
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

    $this->redirect('@item');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (ItemPeer::retrieveByPks($ids) as $object)
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

    $this->redirect('@item');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $Item = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Item)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@item_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'item_edit', 'sf_subject' => $Item));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('Item.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('Item.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('Item');
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod($this->configuration->getPeerMethod());
    $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('Item.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('Item.page', 1, 'admin_module');
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
    
    $criteria->add(ItemPeer::ID, 1, Criteria::GREATER_THAN);

    return $criteria;
  }

  protected function addSortCriteria($criteria)
  {
    if (array(null, null) == ($sort = $this->getSort()))
    {
      return;
    }

    $column = ItemPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
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
    if (null !== $sort = $this->getUser()->getAttribute('Item.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('Item.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('Item.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames('Item', BasePeer::TYPE_FIELDNAME));
  }
}
