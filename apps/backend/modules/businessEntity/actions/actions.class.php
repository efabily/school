<?php

/**
 * businessEntity actions.
 *
 * @package    basic
 * @subpackage businessEntity
 * @author     Yassel Diaz Gomez
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class businessEntityActions extends sfActions
{
  public function preExecute()
  {
    $this->configuration = new ModuleConfigurationClass($this->getModuleName(), $this->getActionName(),
                                                        $this->getUser()->getAttribute('admin_show'),
                                                        $this->getUser()->getAttribute('admin_show_deleted'));

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

    $this->helper = new ToolbarLinkClass(array( 'moduleRoute' => $this->configuration->getModuleRoute(),
                                                'moduleName'  => $this->configuration->getModuleName()));
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

      $this->redirect('@'.$this->configuration->getModuleRoute());
    }

    $this->filters = $this->configuration->getFilterForm($this->getFilters());

    $this->filters->bind($request->getParameter($this->filters->getName()));
    if ($this->filters->isValid())
    {
      $this->setFilters($this->filters->getValues());

      $this->redirect('@'.$this->configuration->getModuleRoute());
    }

    $this->pager = $this->getPager();
    $this->sort = $this->getSort();

    $this->setTemplate('index');
  }

  public function executeNew(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->_object = $this->form->getObject();
  }

  public function executeCreate(sfWebRequest $request)
  {
    $this->form = $this->configuration->getForm();
    $this->_object = $this->form->getObject();
    $this->_object->setIdState(1);

    unset ($this->form['id_state']);

    $this->processForm($request, $this->form);

    $this->setTemplate('new');
  }

  public function executeShow(sfWebRequest $request)
  {
    if($this->getUser()->getAttribute('admin_show_deleted'))
    {
      $peer_class = $this->configuration->getModelPeerName();
      $peer_class::disableSoftDelete();
    }

    $this->_object = $this->getRoute()->getObject();
  }

  public function executeEdit(sfWebRequest $request)
  {
    $this->_object = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->_object);
  }

  public function executeUpdate(sfWebRequest $request)
  {
    $this->_object = $this->getRoute()->getObject();
    $this->form = $this->configuration->getForm($this->_object);

    foreach ($this->configuration->getUnsetFields() as $unset)
    {
      unset($this->form[$unset]);
    }

    $this->processForm($request, $this->form);

    $this->setTemplate('edit');
  }

  public function executeStateup(sfWebRequest $request)
  {
    $this->_object = $this->getRoute()->getObject();

    switch ($this->_object->getIdState())
    {
      case 2:
        $id_state = 3;
        break;

      default:
        $id_state = 2;
        break;
    }

    $this->_object->setIdState($id_state);
    $this->_object->save();

    $this->getUser()->setFlash('notice', 'The item was updated successfully.');

    $this->redirect(array('sf_route' => $this->configuration->getModuleRoute('show'), 'sf_subject' => $this->_object));
  }

  public function executeDelete(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

    $this->getRoute()->getObject()->setDeletedBy($this->getUser()->getId());

    $this->getRoute()->getObject()->delete();

    $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

    $this->redirect('@'.$this->configuration->getModuleRoute());
  }

  public function executeUndelete(sfWebRequest $request)
  {
    if ($this->getUser()->getAttribute('admin_show_deleted'))
    {
      $peer_class = $this->configuration->getModelPeerName();
      $peer_class::disableSoftDelete();
    }

    $object = $this->getRoute()->getObject();
    $object->setDeletedBy(null);
    $object->unDelete();

    $this->getUser()->setFlash('notice', 'The item was undeleted successfully.');

    $this->redirect('@'.$this->configuration->getModuleRoute());
  }

  public function executeBatch(sfWebRequest $request)
  {
    $request->checkCSRFProtection();

    if (!$ids = $request->getParameter('ids'))
    {
      $this->getUser()->setFlash('error', 'You must at least select one item.');

      $this->redirect('@'.$this->configuration->getModuleRoute());
    }

    if (!$action = $request->getParameter('batch_action'))
    {
      $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

      $this->redirect('@'.$this->configuration->getModuleRoute());
    }

    if (!method_exists($this, $method = 'execute'.ucfirst($action)))
    {
      throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
    }

    if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
    {
      $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
    }

    if ($this->getUser()->getAttribute('admin_show_deleted'))
    {
      $peer_class = $this->configuration->getModelPeerName();
      $peer_class::disableSoftDelete();
    }

    $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => $this->configuration->getModelName()));

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

    $this->redirect('@'.$this->configuration->getModuleRoute());
  }

  public function executeChangeBusinessEntity(sfWebRequest $request)
  {
    $sf_guard_user = sfGuardUserPeer::retrieveByPK($this->getUser()->getId());

    $default = $request->getParameter('business_entity');
    
    $this->form = new BusinessEntityForm(
            $this->getUser(),
            array('business_entity' => $sf_guard_user->getBusinessEntitys(), 'default' => $default)
    );

    $this->form->process($request);

    return $this->redirect('@homepage');
  }

  protected function executeBatchUndelete(sfWebRequest $request)
  {
    $peer_class = $this->configuration->getModelPeerName();

    if ($this->getUser()->getAttribute('admin_show_deleted'))
    {
      $peer_class::disableSoftDelete();
    }

    foreach ($peer_class::retrieveByPks($request->getParameter('ids')) as $object)
    {
      $object->setDeletedBy(null);
      $object->unDelete();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been Undeleted successfully.');
  }

  protected function executeBatchActivate(sfWebRequest $request)
  {
    $peer_class = $this->configuration->getModelPeerName();

    foreach ($peer_class::retrieveByPks($request->getParameter('ids')) as $object)
    {
      $object->activate();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been Activated successfully.');
  }

  protected function executeBatchInactivate(sfWebRequest $request)
  {
    $peer_class = $this->configuration->getModelPeerName();

    foreach ($peer_class::retrieveByPks($request->getParameter('ids')) as $object)
    {
      $object->inactivate();
    }

    $this->getUser()->setFlash('notice', 'The selected items have been Inactivated successfully.');
  }

  protected function executeBatchDelete(sfWebRequest $request)
  {
    $ids = $request->getParameter('ids');
    $count = 0;

    $peer_class = $this->configuration->getModelPeerName();

    foreach ($peer_class::retrieveByPks($ids) as $object)
    {
      $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));

      $object->setDeletedBy($this->getUser()->getId());

      $object->delete();

      if ($object->getDeletedAt())
      {
        $count++;
      }
    }

    if ($count >= count($ids))
    {
      $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
    } else {
      $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
    }

    $this->redirect('@'.$this->configuration->getModuleRoute());
  }

  protected function processForm(sfWebRequest $request, sfForm $form)
  {
    $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));

    if ($form->isValid())
    {
      $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

      $object = $form->save();

      $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $object)));

      switch ($request->getParameter('do_after'))
      {
        case '_save_and_add':
          $notice = $notice.' You can add another one below.';
          $redirect = '@'.$this->configuration->getModuleRoute('new');
          break;

        case '_save_and_list':
          $redirect = '@'.$this->configuration->getModuleRoute();
          break;

        default:
          $redirect = array('sf_route' => $this->configuration->getModuleRoute('show'), 'sf_subject' => $object);
      }

      $this->getUser()->setFlash('notice', $notice);

      $this->redirect($redirect);
    } else {
      $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
    }
  }

  protected function getFilters()
  {
    return $this->getUser()->getAttribute($this->configuration->getModuleName().'.filters', $this->configuration->getFilterDefaults(), 'admin_module');
  }

  protected function setFilters(array $filters)
  {
    return $this->getUser()->setAttribute($this->configuration->getModuleName().'.filters', $filters, 'admin_module');
  }

  protected function getPager()
  {
    $pager = $this->configuration->getPager();
    $pager->setCriteria($this->buildCriteria());
    $pager->setPage($this->getPage());

    if ($this->getUser()->getAttribute('admin_show_deleted'))
    {
      $peer_class = $this->configuration->getModelPeerName();
      $peer_class::disableSoftDelete();
    }

    $pager->init();

    return $pager;
  }

  protected function setPage($page)
  {
    $this->getUser()->setAttribute($this->configuration->getModuleName().'.page', $page, 'admin_module');
  }

  protected function getPage()
  {
    return $this->getUser()->getAttribute($this->configuration->getModuleName().'.page', 1, 'admin_module');
  }

  protected function buildCriteria()
  {
    if (null === $this->filters)
    {
      $this->filters = $this->configuration->getFilterForm($this->getFilters());
    }

    $criteria = $this->filters->buildCriteria($this->getFilters());

    if ($this->getUser()->getAttribute('admin_show_deleted'))
    {
      $criteria->filterByDeletedAt(array('min'=>0));
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

    $peer_class = $this->configuration->getModelPeerName();
    $column = $peer_class::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);

    if ('asc' == $sort[1])
    {
      $criteria->addAscendingOrderByColumn($column);
    } else {
      $criteria->addDescendingOrderByColumn($column);
    }
  }

  protected function getSort()
  {
    if (null !== $sort = $this->getUser()->getAttribute($this->configuration->getModuleName().'.sort', null, 'admin_module'))
    {
      return $sort;
    }

    $this->setSort($this->configuration->getDefaultSort());

    return $this->getUser()->getAttribute($this->configuration->getModuleName().'.sort', null, 'admin_module');
  }

  protected function setSort(array $sort)
  {
    if (null !== $sort[0] && null === $sort[1])
    {
      $sort[1] = 'asc';
    }

    $this->getUser()->setAttribute($this->configuration->getModuleName().'.sort', $sort, 'admin_module');
  }

  protected function isValidSortColumn($column)
  {
    return in_array($column, BasePeer::getFieldnames($this->configuration->getModelName(), BasePeer::TYPE_FIELDNAME));
  }
}
