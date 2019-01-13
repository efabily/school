<?php

/**
 * NightAudit module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage NightAudit
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseNightAuditGeneratorConfiguration extends sfModelGeneratorConfiguration
{
  public function getActionsDefault()
  {
    return array();
  }

  public function getFormActions()
  {
    return array(  '_delete' => NULL,  '_list' => NULL,  '_save' => NULL,  '_save_and_add' => NULL,);
  }

  public function getNewActions()
  {
    return array();
  }

  public function getEditActions()
  {
    return array();
  }

  public function getListObjectActions()
  {
    return array(  '_edit' => NULL,  '_delete' => NULL,);
  }

  public function getListActions()
  {
    return array(  '_new' => NULL,);
  }

  public function getListBatchActions()
  {
    return array(  '_delete' => NULL,);
  }

  public function getListParams()
  {
    return '%%id%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%date%% - %%user_id%% - %%business_entity_id%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'NightAudit List';
  }

  public function getEditTitle()
  {
    return 'Edit NightAudit';
  }

  public function getNewTitle()
  {
    return 'New NightAudit';
  }

  public function getFilterDisplay()
  {
    return array();
  }

  public function getFormDisplay()
  {
    return array();
  }

  public function getEditDisplay()
  {
    return array();
  }

  public function getNewDisplay()
  {
    return array();
  }

  public function getListDisplay()
  {
    return array(  0 => 'id',  1 => 'deleted_by',  2 => 'created_at',  3 => 'updated_at',  4 => 'date',  5 => 'user_id',  6 => 'business_entity_id',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'deleted_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'date' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'user_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'business_entity_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'date' => array(),
      'user_id' => array(),
      'business_entity_id' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'date' => array(),
      'user_id' => array(),
      'business_entity_id' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'date' => array(),
      'user_id' => array(),
      'business_entity_id' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'date' => array(),
      'user_id' => array(),
      'business_entity_id' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'date' => array(),
      'user_id' => array(),
      'business_entity_id' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'NightAuditForm';
  }

  public function hasFilterForm()
  {
    return true;
  }

  /**
   * Gets the filter form class name
   *
   * @return string The filter form class name associated with this generator
   */
  public function getFilterFormClass()
  {
    return 'NightAuditFormFilter';
  }

  public function getPagerClass()
  {
    return 'sfPropelPager';
  }

  public function getPagerMaxPerPage()
  {
    return 20;
  }

  public function getDefaultSort()
  {
    return array(null, null);
  }

  public function getPeerMethod()
  {
    return 'doSelect';
  }

  public function getPeerCountMethod()
  {
    return 'doCount';
  }
}
