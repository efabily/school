<?php

/**
 * currencyPrice module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage currencyPrice
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseCurrencyPriceGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return '%%id%% - %%id_state%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%reference%% - %%sale%% - %%purchase%% - %%since_date%% - %%until_date%% - %%currency_id%% - %%user_id%%';
  }

  public function getListLayout()
  {
    return 'tabular';
  }

  public function getListTitle()
  {
    return 'CurrencyPrice List';
  }

  public function getEditTitle()
  {
    return 'Edit CurrencyPrice';
  }

  public function getNewTitle()
  {
    return 'New CurrencyPrice';
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
    return array(  0 => 'id',  1 => 'id_state',  2 => 'deleted_by',  3 => 'created_at',  4 => 'updated_at',  5 => 'reference',  6 => 'sale',  7 => 'purchase',  8 => 'since_date',  9 => 'until_date',  10 => 'currency_id',  11 => 'user_id',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'deleted_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'reference' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'sale' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'purchase' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'since_date' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'until_date' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'currency_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
      'user_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
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
      'reference' => array(),
      'sale' => array(),
      'purchase' => array(),
      'since_date' => array(),
      'until_date' => array(),
      'currency_id' => array(),
      'user_id' => array(),
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
      'reference' => array(),
      'sale' => array(),
      'purchase' => array(),
      'since_date' => array(),
      'until_date' => array(),
      'currency_id' => array(),
      'user_id' => array(),
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
      'reference' => array(),
      'sale' => array(),
      'purchase' => array(),
      'since_date' => array(),
      'until_date' => array(),
      'currency_id' => array(),
      'user_id' => array(),
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
      'reference' => array(),
      'sale' => array(),
      'purchase' => array(),
      'since_date' => array(),
      'until_date' => array(),
      'currency_id' => array(),
      'user_id' => array(),
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
      'reference' => array(),
      'sale' => array(),
      'purchase' => array(),
      'since_date' => array(),
      'until_date' => array(),
      'currency_id' => array(),
      'user_id' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'CurrencyPriceForm';
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
    return 'CurrencyPriceFormFilter';
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
