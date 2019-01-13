<?php

require_once dirname(__FILE__).'/../lib/currencyPriceGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/currencyPriceGeneratorHelper.class.php';

/**
 * currencyPrice actions.
 *
 * @package    school
 * @subpackage currencyPrice
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class currencyPriceActions extends autoCurrencyPriceActions
{
   
   public function preExecute()
  {
    $this->configuration = new currencyPriceGeneratorConfiguration();

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new currencyPriceGeneratorHelper();

    parent::preExecute();
  }
  
  public function executeChange(sfWebRequest $request)
  {
    $currency_price = CurrencyPricePeer::retrieveByPK($request->getParameter('id'));
    
    if(is_object($currency_price))
    {
       $con = Propel::getConnection();
       try
       {
	     $con->beginTransaction(); // Iniciamos transaccion	     
	     
	     $s = $request->getParameter('s');
	     $currency_price->changeStateId($s, $con);
	     
	     if($s == 2)
	     {
		$old_currency_price = CurrencyPricePeer::getAnotherAssetExchange($currency_price->getCurrencyId(), $s, $currency_price->getId());
		if(is_object($old_currency_price))
		{
		   $old_currency_price->setIdState(3);
		   $old_currency_price->save($con);
		}
	     }
	     
	     $con->commit(); // Terminar la transaccion	    

       } catch (exception $e) {
	 $con->rollback();
	 throw $e;
	 $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
       }       
    }
    
    $this->redirect('@currency_price');    
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

      $this->redirect('@currency_price');
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());
    
    $array_filter = $request->getParameter($this->filters->getName());

    $this->filters->bind($array_filter);
    if ($this->filters->isValid())
    {
      $this->setFilters($array_filter);

      $this->redirect('@currency_price');
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->CurrencyPrice = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->CurrencyPrice = $this->form->getObject();
    
    $currency_price = $request->getParameter('currency_price');
     
     $this->form->bind($currency_price);
     if ($this->form->isValid())
     {
	
	$con = Propel::getConnection();
	  try
	  {
	     $con->beginTransaction(); // Iniciamos transaccion
	     
	    $array_currency_price = array(
		'id_state' => 1
		,'reference' => strtoupper($this->form->getValue('reference'))
		,'sale' => $this->form->getValue('sale')
		,'purchase' => $this->form->getValue('purchase')
		,'since_date' => $this->form->getValue('since_date')
		,'until_date' => $this->form->getValue('until_date')
		,'currency_id' => $this->form->getValue('currency_id')
		,'user_id' => $this->getUser()->getId()
	     );
	    
	     $currency_price = CurrencyPricePeer::saveCurrencyPrice($array_currency_price, null, $con);
	     
	     if(is_object($currency_price) && $currency_price->getId() > 0)
	     {
		$con->commit(); // Terminar la transaccion
		
		if ($request->hasParameter('_save_and_add'))
	        {
		  $this->getUser()->setFlash('notice', ' Agrego con exito un nuevo periodo.');

		  $this->redirect('@currency_price_new');
	        }
	        else
	        {
		 $this->getUser()->setFlash('notice', $notice);

		 $this->redirect('@currency_price');
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
	 $this->getUser()->setFlash('error', 'El Tipo de Cambio no fue creado porque se genero un error. '.$this->form->getErrorSchema()->getMessage(), false);
     }

    $this->setTemplate('new');
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->CurrencyPrice = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->CurrencyPrice);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->CurrencyPrice = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->CurrencyPrice);

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@currency_price');
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@currency_price');
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@currency_price');
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'CurrencyPrice'));
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

    $this->redirect('@currency_price');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');

    $count = 0;
    foreach (CurrencyPricePeer::retrieveByPks($ids) as $object)
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

    $this->redirect('@currency_price');
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $CurrencyPrice = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $CurrencyPrice)));

      if ($request->hasParameter('_save_and_add'))
      {
        $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

        $this->redirect('@currency_price_new');
      }
      else
      {
        $this->getUser()->setFlash('notice', $notice);

        $this->redirect(array('sf_route' => 'currency_price_edit', 'sf_subject' => $CurrencyPrice));
      }
    }
    else
    {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute('currencyPrice.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute('currencyPrice.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager('CurrencyPrice');
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());
    $pager->setPeerMethod($this->configuration->getPeerMethod());
    $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute('currencyPrice.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute('currencyPrice.page', 1, 'admin_module');
  }

  protected function buildCriteria()
  {
    $criteria = new Criteria();
      
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
      $array_filter = $this->getFilters();
      
//      print_r($array_filter);
//      exit;
//      
      
      if(isset($array_filter['currency_id']) && !empty($array_filter['currency_id']) && $array_filter['currency_id'] > 0)
      {	 
	 $criteria->add(CurrencyPricePeer::CURRENCY_ID, $array_filter['currency_id']);
      }
      
      if(isset($array_filter['user_id']) && !empty($array_filter['user_id']) && $array_filter['user_id'] > 0)
      {
	 $criteria->add(CurrencyPricePeer::USER_ID, $array_filter['user_id']);
      }
      
      if (isset($array_filter['since_date']) && $array_filter['since_date'] !== '') 
      {
	    $array_since_date = explode('/', $array_filter['since_date']);

	    $sf_since_date1 = new sfDate($array_since_date[2].'-'.$array_since_date[1].'-'.$array_since_date[0].' 00:00:00');
	    $sf_since_date2 = new sfDate($array_since_date[2].'-'.$array_since_date[1].'-'.$array_since_date[0].' 23:59:59');

	    $criterion = $criteria->getNewCriterion(CurrencyPricePeer::SINCE_DATE, $sf_since_date1->dump(), Criteria::GREATER_EQUAL);

	    if (isset($criterion)) {
		 $criterion->addAnd($criteria->getNewCriterion(CurrencyPricePeer::SINCE_DATE, $sf_since_date2->dump(), Criteria::LESS_EQUAL));
	     } else {
		 $criterion = $criteria->getNewCriterion(CurrencyPricePeer::SINCE_DATE, $sf_since_date2->dump(), Criteria::LESS_EQUAL);
	     }

	    if (isset($criterion)) {
		$criteria->add($criterion);
	    }
        }
	
	if (isset($array_filter['until_date']) && $array_filter['until_date'] !== '')
	 {
	     $array_until_date = explode('/', $array_filter['until_date']);
					// Año                  Mes                  Dia
	     $sf_until_date1 = new sfDate($array_until_date[2].'-'.$array_until_date[1].'-'.$array_until_date[0].' 00:00:00');
	     $sf_until_date2 = new sfDate($array_until_date[2].'-'.$array_until_date[1].'-'.$array_until_date[0].' 23:59:59');
	     
	    $criterion2 = $criteria->getNewCriterion(CurrencyPricePeer::UNTIL_DATE, $sf_until_date1->dump(), Criteria::GREATER_EQUAL);

	    if (isset($criterion2)) {
		 $criterion2->addAnd($criteria->getNewCriterion(CurrencyPricePeer::UNTIL_DATE, $sf_until_date2->dump(), Criteria::LESS_EQUAL));
	     } else {
		 $criterion2 = $criteria->getNewCriterion(CurrencyPricePeer::UNTIL_DATE, $sf_until_date2->dump(), Criteria::LESS_EQUAL);
	     }

	    if (isset($criterion2)) {
		$criteria->add($criterion2);
	    }
	 }      
    }

    // $criteria = $this->filters->buildCriteria($this->getFilters());
    
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

    $column = CurrencyPricePeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
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
    if (null !== $sort = $this->getUser()->getAttribute('currencyPrice.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute('currencyPrice.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute('currencyPrice.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames('CurrencyPrice', BasePeer::TYPE_FIELDNAME));
  }
  
}
