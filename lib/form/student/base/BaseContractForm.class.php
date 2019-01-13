<?php

/**
 * Contract form base class.
 *
 * @method Contract getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseContractForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'nro'         => new sfWidgetFormInputText(),
      'amount'      => new sfWidgetFormInputText(),
      'container'   => new sfWidgetFormTextarea(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'description' => new sfWidgetFormTextarea(),
      'record_date' => new sfWidgetFormDateTime(),
      'city'        => new sfWidgetFormInputText(),
      'period_id'   => new sfWidgetFormPropelChoice(array('model' => 'Period', 'add_empty' => false)),
      'student_id'  => new sfWidgetFormPropelChoice(array('model' => 'Student', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'nro'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'amount'      => new sfValidatorNumber(array('required' => false)),
      'container'   => new sfValidatorString(array('required' => false)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'record_date' => new sfValidatorDateTime(array('required' => false)),
      'city'        => new sfValidatorString(array('max_length' => 100)),
      'period_id'   => new sfValidatorPropelChoice(array('model' => 'Period', 'column' => 'id')),
      'student_id'  => new sfValidatorPropelChoice(array('model' => 'Student', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('contract[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contract';
  }


}
