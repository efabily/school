<?php

/**
 * Student module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage Student
 * @author     ##AUTHOR_NAME##
 * @version    SVN: $Id: configuration.php 24171 2009-11-19 16:37:50Z Kris.Wallsmith $
 */
abstract class BaseStudentGeneratorConfiguration extends sfModelGeneratorConfiguration
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
    return '%%id%% - %%id_state%% - %%first_name%% - %%father_name%% - %%mother_name%% - %%rude%% - %%codigo%% - %%birth_date%% - %%email%% - %%deleted_by%% - %%created_at%% - %%updated_at%% - %%person_id%%';
  }

  public function getListLayout()
  {
    return 'stacked';
  }

  public function getListTitle()
  {
    return 'Lista de estudiantes';
  }

  public function getEditTitle()
  {
    return 'Edit Student';
  }

  public function getNewTitle()
  {
    return 'New Student';
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
    return array(  0 => 'id',  1 => 'id_state',  2 => 'first_name',  3 => 'father_name',  4 => 'mother_name',  5 => 'rude',  6 => 'codigo',  7 => 'birth_date',  8 => 'email',  9 => 'deleted_by',  10 => 'created_at',  11 => 'updated_at',  12 => 'person_id',);
  }

  public function getFieldsDefault()
  {
    return array(
      'id' => array(  'is_link' => true,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'id_state' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'first_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'father_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'mother_name' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'rude' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'codigo' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'birth_date' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'email' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'deleted_by' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Text',),
      'created_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'updated_at' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'Date',),
      'person_id' => array(  'is_link' => false,  'is_real' => true,  'is_partial' => false,  'is_component' => false,  'type' => 'ForeignKey',),
    );
  }

  public function getFieldsList()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'first_name' => array(),
      'father_name' => array(),
      'mother_name' => array(),
      'rude' => array(),
      'codigo' => array(),
      'birth_date' => array(),
      'email' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'person_id' => array(),
    );
  }

  public function getFieldsFilter()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'first_name' => array(),
      'father_name' => array(),
      'mother_name' => array(),
      'rude' => array(),
      'codigo' => array(),
      'birth_date' => array(),
      'email' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'person_id' => array(),
    );
  }

  public function getFieldsForm()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'first_name' => array(),
      'father_name' => array(),
      'mother_name' => array(),
      'rude' => array(),
      'codigo' => array(),
      'birth_date' => array(),
      'email' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'person_id' => array(),
    );
  }

  public function getFieldsEdit()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'first_name' => array(),
      'father_name' => array(),
      'mother_name' => array(),
      'rude' => array(),
      'codigo' => array(),
      'birth_date' => array(),
      'email' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'person_id' => array(),
    );
  }

  public function getFieldsNew()
  {
    return array(
      'id' => array(),
      'id_state' => array(),
      'first_name' => array(),
      'father_name' => array(),
      'mother_name' => array(),
      'rude' => array(),
      'codigo' => array(),
      'birth_date' => array(),
      'email' => array(),
      'deleted_by' => array(),
      'created_at' => array(),
      'updated_at' => array(),
      'person_id' => array(),
    );
  }


  /**
   * Gets the form class name.
   *
   * @return string The form class name
   */
  public function getFormClass()
  {
    return 'StudentForm';
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
    return 'StudentFormFilter';
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
