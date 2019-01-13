<?php

/**
 * TypeItem module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage TypeItem
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseTypeItemGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return '%%id%% - %%id_state%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%name%% - %%description%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'TypeItem List';
  }

  public function getEditTitle()
  {
    return 'Edit TypeItem';
  }

  public function getNewTitle()
  {
    return 'New TypeItem';
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
    return array(  0 => 'id',  1 => 'id_state',  2 => 'deleted_by',  3 => 'created_at',  4 => 'updated_at',  5 => 'name',  6 => 'description',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'deleted_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'description' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'name' => array(),
      'description' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'name' => array(),
      'description' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'name' => array(),
      'description' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'name' => array(),
      'description' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'name' => array(),
      'description' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'TypeItemForm';
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
    return 'TypeItemFormFilter';
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
