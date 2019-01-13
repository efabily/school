<?php

/**
 * cashbox module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage cashbox
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCashboxGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return '%%id%% - %%id_state%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%closing_date%% - %%comment%% - %%superviser_id%% - %%cashier_id%% - %%night_audit_id%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'Cashbox List';
  }

  public function getEditTitle()
  {
    return 'Edit Cashbox';
  }

  public function getNewTitle()
  {
    return 'New Cashbox';
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
    return array(  0 => 'id',  1 => 'id_state',  2 => 'deleted_by',  3 => 'created_at',  4 => 'updated_at',  5 => 'closing_date',  6 => 'comment',  7 => 'superviser_id',  8 => 'cashier_id',  9 => 'night_audit_id',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'deleted_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'closing_date' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'comment' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'superviser_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'cashier_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'night_audit_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
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
      'closing_date' => array(),
      'comment' => array(),
      'superviser_id' => array(),
      'cashier_id' => array(),
      'night_audit_id' => array(),
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
      'closing_date' => array(),
      'comment' => array(),
      'superviser_id' => array(),
      'cashier_id' => array(),
      'night_audit_id' => array(),
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
      'closing_date' => array(),
      'comment' => array(),
      'superviser_id' => array(),
      'cashier_id' => array(),
      'night_audit_id' => array(),
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
      'closing_date' => array(),
      'comment' => array(),
      'superviser_id' => array(),
      'cashier_id' => array(),
      'night_audit_id' => array(),
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
      'closing_date' => array(),
      'comment' => array(),
      'superviser_id' => array(),
      'cashier_id' => array(),
      'night_audit_id' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'CashboxForm';
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
    return 'CashboxFormFilter';
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
