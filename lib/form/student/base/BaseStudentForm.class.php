<?php

/**
 * Student form base class.
 *
 * @method Student getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStudentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'first_name'  => new sfWidgetFormInputText(),
      'father_name' => new sfWidgetFormInputText(),
      'mother_name' => new sfWidgetFormInputText(),
      'rude'        => new sfWidgetFormInputText(),
      'codigo'      => new sfWidgetFormInputText(),
      'birth_date'  => new sfWidgetFormDateTime(),
      'email'       => new sfWidgetFormInputText(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'person_id'   => new sfWidgetFormPropelChoice(array('model' => 'Person', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'first_name'  => new sfValidatorString(array('max_length' => 100)),
      'father_name' => new sfValidatorString(array('max_length' => 100)),
      'mother_name' => new sfValidatorString(array('max_length' => 100)),
      'rude'        => new sfValidatorString(array('max_length' => 100)),
      'codigo'      => new sfValidatorString(array('max_length' => 30)),
      'birth_date'  => new sfValidatorDateTime(array('required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 100)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'person_id'   => new sfValidatorPropelChoice(array('model' => 'Person', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Student';
  }


}
