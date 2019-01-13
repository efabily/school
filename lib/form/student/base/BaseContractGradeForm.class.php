<?php

/**
 * ContractGrade form base class.
 *
 * @method ContractGrade getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseContractGradeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'contract_id' => new sfWidgetFormPropelChoice(array('model' => 'Contract', 'add_empty' => false)),
      'grade_id'    => new sfWidgetFormPropelChoice(array('model' => 'Grade', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'contract_id' => new sfValidatorPropelChoice(array('model' => 'Contract', 'column' => 'id')),
      'grade_id'    => new sfValidatorPropelChoice(array('model' => 'Grade', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('contract_grade[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ContractGrade';
  }


}
