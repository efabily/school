<?php
// auto-generated by sfPropelAdmin
// date: 2008/03/28 22:29:39
?>
<?php

/**
 * autoSfGuardUser actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage autoSfGuardUser
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 3501 2007-02-18 10:28:17Z fabien $
 */
class sfGuardUserActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('sfGuardUser', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();

    $this->filters = $this->getUser()->getAttributeHolder()->getAll('sf_admin/sf_guard_user/filters');

    // pager
    $this->pager = new sfPropelPager('sfGuardUserProfile', sfConfig::get('app_pager_list_max'));
    $c = new Criteria();
    $c->addJoin(sfGuardUserProfilePeer::USER_ID, sfGuardUserPeer::ID);
    // fixme: don't show admin in list
    $c->add(sfGuardUserPeer::ID, 1, Criteria::NOT_EQUAL);
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);

    $this->pager->setCriteria($c);
    $this->pager->setPage($this->processPager());
    $this->pager->init();
  }


  protected function processPager()
  {
    if($this->getRequestParameter('page'))
    {
      $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'midea_front/sf_guard_user/pager');
    }

    return $this->getUser()->getAttribute('page', null, 'midea_front/sf_guard_user/pager');
  }

  public function executeCreate()
  {
    return $this->forward('sfGuardUser', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('sfGuardUser', 'edit');
  }

  public function executeChangePassword()
  {
    $this->sf_guard_user = $this->getUser()->getGuardUser();

    if(!$this->sf_guard_user)
    {
      return $this->redirect('homepage/index');
    } else {
      
      if ($this->getRequest()->getMethod() == sfRequest::POST)
      {
        $sf_guard_user = $this->getRequestParameter('sf_guard_user');

        if($this->sf_guard_user->checkPassword($sf_guard_user['password_old']))
        {
          $this->updatesfGuardUserFromRequest(true);

          $this->setFlash('notice', 'All changed successfully');
          
          $this->sf_guard_user->save();
        } else {
          $this->setFlash('notice', 'Password is not valid');
        }
      }
    }

    $this->labels = $this->getLabels();  

    $this->pass = true;

    $this->setTemplate('edit');
  }

  public function executeEdit()
  {
    $this->sf_guard_user = $this->getsfGuardUserOrCreate();
    $this->sf_guard_user_profile = $this->getsfGuardUserProfileOrCreate();

    if ($this->sf_guard_user->getId() == 1)
    {
      return $this->redirect('sfGuardUser/list');
    }
    else
    {
      if ($this->getRequest()->getMethod() == sfRequest::POST)
      {
        $this->updatesfGuardUserFromRequest();
        $this->savesfGuardUser($this->sf_guard_user);

        $this->setFlash('notice', 'Your modifications have been saved');

        if ($this->getRequestParameter('do_after') == 'save_and_create')
        {
          return $this->redirect('sfGuardUser/create');
        }
        else if ($this->getRequestParameter('do_after') == 'save_and_list')
        {
          return $this->redirect('sfGuardUser/list');
        }
        else
        {
          return $this->redirect('sfGuardUser/edit?id='.$this->sf_guard_user->getId());
        }
      }
      else
      {
        $this->labels = $this->getLabels();
      }
    }
    $this->pass = false;
  }

    public function executeDelete()
  {
    $this->sf_guard_user = sfGuardUserPeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->sf_guard_user);

    try
    {
      $this->deletesfGuardUser($this->sf_guard_user);
    }
    catch (PropelException$e) {
            $this->getRequest()->setError('delete', $this->getContext()->getI18N()->__('Could not delete the selected %1%. Make sure it does not have any associated items', array('%1%' => $this->getContext()->getI18N()->__('Sf guard user'))));
            return $this->forward('sfGuardUser', 'list');
        }

        return $this->redirect('sfGuardUser/list');
    }

  public function handleErrorEdit()
  {
 //   $this->preExecute();
    $this->sf_guard_user_profile = $this->getsfGuardUserProfileOrCreate();
    $this->sf_guard_user = $this->sf_guard_user_profile->getsfGuardUser();
  //  $this->sf_guard_user = $this->getsfGuardUserOrCreate();
    $this->updatesfGuardUserFromRequest();
    $this->updatesfGuardUserProfileFromRequest();

    $this->labels = $this->getLabels();
    $this->pass = false;

    return sfView::SUCCESS;
  }

  public function handleErrorChangePassword()
  {
    $this->sf_guard_user = $this->getsfGuardUserOrCreate();
    $this->updatesfGuardUserFromRequest();

    $this->labels = $this->getLabels();
    $this->pass = true;

    $this->setTemplate('edit');

    return sfView::SUCCESS;
  }
  
  protected function savesfGuardUser($sf_guard_user)
  {
    $sf_guard_user->save();
    $this->updatesfGuardUserProfileFromRequest();
    $this->sf_guard_user_profile->save();

      // Update many-to-many for "groups"
      $c = new Criteria();
      $c->add(sfGuardUserGroupPeer::USER_ID, $sf_guard_user->getPrimaryKey());
      sfGuardUserGroupPeer::doDelete($c);

      $ids = $this->getRequestParameter('associated_groups');
      if (is_array($ids))
      {
        foreach ($ids as $id)
        {
          $SfGuardUserGroup = new sfGuardUserGroup();
          $SfGuardUserGroup->setUserId($sf_guard_user->getPrimaryKey());
          $SfGuardUserGroup->setGroupId($id);
          $SfGuardUserGroup->save();
        }
      }

      // Update many-to-many for "dependences"
      $c = new Criteria();
      $c->add(UsersDependencePeer::USERS_ID, $this->sf_guard_user_profile->getId());
  
      $user_dependences = UsersDependencePeer::doSelect($c);
      
      $dep_ids = array();
      $dep_ids = array_map(create_function('$o', 'return $o->getDependenceId();'), $user_dependences);
      
      $ids = array();
      $ids = $this->getRequestParameter('associated_dependences');
      
      if ($user_dependences)
      {
        foreach ($user_dependences as $user_dependence)
        {
          if (in_array($user_dependence->getDependenceId(), $ids))
          {
            if(!$user_dependence->getActive())
            {
              $user_dependence->setActive(1);
              $user_dependence->save();
            }
          } else {
            if($user_dependence->getActive())
            {
              $user_dependence->setActive(0);
              $user_dependence->save();
            }
          }
        }
      }
      
      foreach ($ids as $id)
      {
        if (!in_array($id, $dep_ids))
        {
          $UsersDependence = new UsersDependence();
          $UsersDependence->setUsersId($this->sf_guard_user_profile->getId());
          $UsersDependence->setDependenceId($id);
          $UsersDependence->setActive(1);
          $UsersDependence->save();
        }
      }     

      // Update many-to-many for "permissions"
  /*    $c = new Criteria();
      $c->add(sfGuardUserPermissionPeer::USER_ID, $sf_guard_user->getPrimaryKey());
      sfGuardUserPermissionPeer::doDelete($c);

      $ids = $this->getRequestParameter('associated_permissions');
      if (is_array($ids))
      {
        foreach ($ids as $id)
        {
          $SfGuardUserPermission = new sfGuardUserPermission();
          $SfGuardUserPermission->setUserId($sf_guard_user->getPrimaryKey());
          $SfGuardUserPermission->setPermissionId($id);
          $SfGuardUserPermission->save();
        }
      }
  */
  }

  protected function deletesfGuardUser($sf_guard_user)
  {
    $sf_guard_user->delete();
  }

  protected function updatesfGuardUserFromRequest($pass = false)
  {
    $sf_guard_user = $this->getRequestParameter('sf_guard_user');

    if (isset($sf_guard_user['username']))
    {
      $this->sf_guard_user->setUsername($sf_guard_user['username']);
    }
    if (isset($sf_guard_user['password']))
    {
      $this->sf_guard_user->setPassword($sf_guard_user['password']);
    }
    if (isset($sf_guard_user['password_bis']))
    {
      $this->sf_guard_user->setPasswordBis($sf_guard_user['password_bis']);
    }

    if (!$pass)
    {
      if (isset($sf_guard_user['last_login']))
      {
        if ($sf_guard_user['last_login'])
        {
          try
          {
            $dateFormat = new sfDateFormat($this->getUser()->getCulture());
                                if (!is_array($sf_guard_user['last_login']))
            {
              $value = $dateFormat->format($sf_guard_user['last_login'], 'I', $dateFormat->getInputPattern('g'));
            }
            else
            {
              $value_array = $sf_guard_user['last_login'];
              $value = $value_array['year'].'-'.$value_array['month'].'-'.$value_array['day'].(isset($value_array['hour']) ? ' '.$value_array['hour'].':'.$value_array['minute'].(isset($value_array['second']) ? ':'.$value_array['second'] : '') : '');
            }
            $this->sf_guard_user->setLastLogin($value);
          }
          catch (sfException $e)
          {
            // not a date
          }
        }
        else
        {
          $this->sf_guard_user->setLastLogin(null);
        }
      }
      $this->sf_guard_user->setIsActive(isset($sf_guard_user['is_active']) ? $sf_guard_user['is_active'] : 0);
      if (isset($sf_guard_user['groups']))
      {
        $this->sf_guard_user->setGroups($sf_guard_user['groups']);
      }
      if (isset($sf_guard_user['permissions']))
      {
        $this->sf_guard_user->setPermissions($sf_guard_user['permissions']);
      }
    }
  }

  protected function updatesfGuardUserProfileFromRequest()
  {
    $sf_guard_user_profile = $this->getRequestParameter('sf_guard_user_profile');

    if (isset($sf_guard_user_profile['first_name']))
    {
      $this->sf_guard_user_profile->setFirstName($sf_guard_user_profile['first_name']);
    }

    $this->sf_guard_user_profile->setUserId($this->sf_guard_user->getId());

    if (isset($sf_guard_user_profile['last_name']))
    {
      $this->sf_guard_user_profile->setLastName($sf_guard_user_profile['last_name']);
    }
    if (isset($sf_guard_user_profile['block']))
    {
      $this->sf_guard_user_profile->setBlock($sf_guard_user_profile['block'], 0);
    }
    if (isset($sf_guard_user_profile['possition']))
    {
      $this->sf_guard_user_profile->setPossition($sf_guard_user_profile['possition']);
    }
  }

  protected function getsfGuardUserOrCreate($id = 'id')
  {
    if (!$this->getRequestParameter($id))
    {
      $sf_guard_user = new sfGuardUser();
    } else {
      $sf_guard_user = sfGuardUserPeer::retrieveByPk($this->getRequestParameter($id));

      $this->forward404Unless($sf_guard_user);
    }

    return $sf_guard_user;
  }

  protected function getsfGuardUserProfileOrCreate($id = 'profile_id')
  {
    if (!$this->getRequestParameter($id))
    {
      $sf_guard_user_profile = sfGuardUserProfilePeer::getFromsfGuardUserId($this->sf_guard_user->getId());

      if (!$sf_guard_user_profile)
      {
        $sf_guard_user_profile = new sfGuardUserProfile();
      }
    }
    else
    {
      $sf_guard_user_profile = sfGuardUserProfilePeer::retrieveByPk($this->getRequestParameter($id));
      
      $this->forward404Unless($sf_guard_user_profile);
    }

    return $sf_guard_user_profile;
  }

  protected function processFilters()
  {
    if ($this->getRequest()->hasParameter('filter'))
    {
      $filters = $this->getRequestParameter('filters');

      if (isset($filters['created_at']['from']) && $filters['created_at']['from'] !==
          '') {
          $filters['created_at']['from'] = sfI18N::getTimestampForCulture($filters['created_at']['from'],
              $this->getUser()->getCulture());
      }
      if (isset($filters['created_at']['to']) && $filters['created_at']['to'] !== '') {
          $filters['created_at']['to'] = sfI18N::getTimestampForCulture($filters['created_at']['to'],
              $this->getUser()->getCulture());
      }
      if (isset($filters['updated_at']['from']) && $filters['updated_at']['from'] !==
          '') {
          $filters['updated_at']['from'] = sfI18N::getTimestampForCulture($filters['updated_at']['from'],
              $this->getUser()->getCulture());
      }
      if (isset($filters['updated_at']['to']) && $filters['updated_at']['to'] !== '') {
          $filters['updated_at']['to'] = sfI18N::getTimestampForCulture($filters['updated_at']['to'],
              $this->getUser()->getCulture());
      }

      $this->getUser()->getAttributeHolder()->removeNamespace('sf_admin/sf_guard_user/filters');
      $this->getUser()->getAttributeHolder()->add($filters, 'sf_admin/sf_guard_user/filters');
    }
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/sf_guard_user/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/sf_guard_user/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
    if (isset($this->filters['username_is_empty']))
    {
      $criterion = $c->getNewCriterion(sfGuardUserPeer::USERNAME, '');
      $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::USERNAME, null, Criteria::ISNULL));
      $c->add($criterion);
    }
    else if (isset($this->filters['username']) && $this->filters['username'] !== '')
    {
      $c->add(sfGuardUserPeer::USERNAME, strtr($this->filters['username'], '*', '%'), Criteria::LIKE);
    }

    if (isset($this->filters['id_is_empty'])) {
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['id']) && $this->filters['id'] !== '') {
            $c->add(sfGuardUserPeer::ID, $this->filters['id']);
        }

   if (isset($this->filters['user_id_is_empty'])) {     // Para el nombre completo
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['user_id']) && $this->filters['user_id'] !== '') {
          $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
          $c->add(sfGuardUserProfilePeer::ID, $this->filters['user_id']);
        }

   if (isset($this->filters['user_name_is_empty'])) {     // Para el nombre de usuario
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['user_name']) && $this->filters['user_name'] !== '') {
          $c->add(sfGuardUserPeer::ID, $this->filters['user_name']);
        }

   if (isset($this->filters['dependence_id_is_empty'])) {
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['dependence_id']) && $this->filters['dependence_id'] !== '') {         
          $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
          $c->addJoin(sfGuardUserProfilePeer::ID, UsersDependencePeer::USERS_ID);
          $c->add(UsersDependencePeer::DEPENDENCE_ID, $this->filters['dependence_id']);
        }

   if (isset($this->filters['guard_group_id_is_empty'])) {
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['guard_group_id']) && $this->filters['guard_group_id'] !== '') {
          $c->addJoin(sfGuardUserGroupPeer::USER_ID, sfGuardUserPeer::ID);
          $c->add(sfGuardUserGroupPeer::GROUP_ID, $this->filters['guard_group_id']);
        }

   if (isset($this->filters['possition_is_empty'])) {
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['possition']) && $this->filters['possition'] !== '') {
          $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
          $c->add(sfGuardUserProfilePeer::POSSITION, strtr($this->filters['possition'], '*', '%'), Criteria::LIKE);
        }

   if (isset($this->filters['block_is_empty'])) {
        $criterion = $c->getNewCriterion(sfGuardUserPeer::ID, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::ID, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['block']) && $this->filters['block'] !== '') {
          $c->addJoin(sfGuardUserPeer::ID, sfGuardUserProfilePeer::USER_ID);
          $c->add(sfGuardUserProfilePeer::BLOCK, $this->filters['block']);
        }

   if (isset($this->filters['is_active_is_empty'])) {     // Para el nombre de usuario
        $criterion = $c->getNewCriterion(sfGuardUserPeer::IS_ACTIVE, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserPeer::IS_ACTIVE, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['is_active']) && $this->filters['is_active'] !== '') {
          $c->add(sfGuardUserPeer::IS_ACTIVE, $this->filters['is_active']);
        }

    if (isset($this->filters['created_at_is_empty'])) {
        $criterion = $c->getNewCriterion(sfGuardUserProfilePeer::CREATED_AT, '');
        $criterion->addOr($c->getNewCriterion(sfGuardUserProfilePeer::CREATED_AT, null, Criteria::
            ISNULL));
        $c->add($criterion);
    } else
        if (isset($this->filters['created_at'])) {
            if (isset($this->filters['created_at']['from']) && $this->filters['created_at']['from']
                !== '') {
                $criterion = $c->getNewCriterion(sfGuardUserProfilePeer::CREATED_AT, $this->filters['created_at']['from'],
                    Criteria::GREATER_EQUAL);
            }
            if (isset($this->filters['created_at']['to']) && $this->filters['created_at']['to']
                !== '') {
                if (isset($criterion)) {
                    $criterion->addAnd($c->getNewCriterion(sfGuardUserProfilePeer::CREATED_AT, $this->filters['created_at']['to'],
                        Criteria::LESS_EQUAL));
                } else {
                    $criterion = $c->getNewCriterion(sfGuardUserProfilePeer::CREATED_AT, $this->filters['created_at']['to'], Criteria::LESS_EQUAL);
                }
            }

            if (isset($criterion)) {
                $c->add($criterion);
            }
        }

        if (isset($this->filters['updated_at_is_empty'])) {
            $criterion = $c->getNewCriterion(sfGuardUserProfilePeer::UPDATED_AT, '');
            $criterion->addOr($c->getNewCriterion(sfGuardUserProfilePeer::UPDATED_AT, null, Criteria::
                ISNULL));
            $c->add($criterion);
        } else
            if (isset($this->filters['updated_at'])) {
                if (isset($this->filters['updated_at']['from']) && $this->filters['updated_at']['from']
                    !== '') {
                    $criterion = $c->getNewCriterion(sfGuardUserProfilePeer::UPDATED_AT, $this->filters['updated_at']['from'], Criteria::GREATER_EQUAL);
                }
                if (isset($this->filters['updated_at']['to']) && $this->filters['updated_at']['to']
                    !== '') {
                    if (isset($criterion)) {
                        $criterion->addAnd($c->getNewCriterion(sfGuardUserProfilePeer::UPDATED_AT, $this->filters['updated_at']['to'], Criteria::LESS_EQUAL));
                    } else {
                        $criterion = $c->getNewCriterion(sfGuardUserProfilePeer::UPDATED_AT, $this->filters['updated_at']['to'], Criteria::LESS_EQUAL);
                    }
                }

                if (isset($criterion)) {
                    $c->add($criterion);
                }
        }


  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/sf_guard_user/sort'))
    {
      if (($sort_column == 'username') || ($sort_column == 'last_login') || ($sort_column == 'is_active')) {
                switch ($sort_column) {
                    case "username":
                        $sort_column = sfGuardUserPeer::USERNAME;
                        break;
                    case "last_login":
                        $sort_column = sfGuardUserPeer::LAST_LOGIN;
                        break;
                    case "is_active":
                        $sort_column = sfGuardUserPeer::IS_ACTIVE;
				}                
            } else {
              $sort_column = sfGuardUserProfilePeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
              
            }


      if ($this->getUser()->getAttribute('type', null, 'sf_admin/sf_guard_user/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'sf_guard_user{username}' => 'Username:',
      'sf_guard_user{password}' => 'Password:',
      'sf_guard_user{password_bis}' => 'Password bis:',
      'sf_guard_user{last_login}' => 'Last login:',
      'sf_guard_user{is_active}' => 'Is active:',
      'sf_guard_user{groups}' => 'Groups/Roles:',
      'sf_guard_user{permissions}' => 'permissions:',
      'sf_guard_user_profile{first_name}' => 'First Name',
      'sf_guard_user_profile{last_name}'  => 'Last Name',
      'sf_guard_user_profile{block}'      => 'Block',
      'sf_guard_user_profile{possition}'  => 'Position',
    );
  }
  
      // ajax dependence add

  public function executeUpdateDependence()
  {
    $con = Propel::getConnection();
    try {
      $con->begin(); // start the transaction
    
      if (!$this->getRequestParameter('id')) 
      { // creating a new item
        $user_dependence = new UsersDependence();      
      } else { // editing a new item
        $user_dependence = UsersDependencePeer::retrieveByPk($this->getRequestParameter('id'));
        $this->forward404Unless($user_dependence);
      }
      
      //comprobar que no exista ese user_dependence	            
      
      $user_dependence_test = UsersDependencePeer::existsUsersDependence(
          $this->getRequestParameter('user_id'), $this->getRequestParameter('dependence_id'));
      
      if (!$user_dependence_test || ($user_dependence_test->getId() == $this->getRequestParameter('id')))
      {        
        $user_dependence->setUsersId($this->getRequestParameter('user_id')); 
        $user_dependence->setDependenceId($this->getRequestParameter('dependence_id'));      
        $user_dependence->setActive($this->getRequestParameter('active', 0));
        $user_dependence->save();    
        
        $this->setFlash('notice', 'Your modifications have been saved', false);				
      } else {      
        $this->setFlash('notice', 'Ya ese Usuario - Dependencia existe', false);
      }
      
      $con->commit(); // commit changes to db
    }    
    catch (exception $e) {
      $con->rollback();
      throw $e;
    }    
    // If all goes well then load current unit_sizes_product so
    $this->user_id = $this->getRequestParameter('user_id');    
  }

  public function executeEditDependence()
  {
    $this->user_dependence = UsersDependencePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->user_dependence);
  }

  public function executeCreateDependence()
  {
    $this->user_id = $this->getRequestParameter('user_id');
  }

  public function executeDelDependence()
  {
    $user_dependence = UsersDependencePeer::retrieveByPk($this->getRequestParameter('id'));    
    $this->forward404Unless($user_dependence);
    
    $this->user_id = $user_dependence->getUsersId();
    try {
      $user_dependence->delete();
    }
    catch (PropelException$e) {
      $this->getRequest()->setError('delete',
      'Could not delete the selected User - Dependence. Make sure it does not have any associated items.');
    }
        
    $this->setFlash('notice', 'The User - Dependence has been deleted');
  }  
}
