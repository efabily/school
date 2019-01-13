<?php

/**
 * Period form base class.
 *
 * @method Period getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePeriodForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_state'   => new sfWidgetFormInputText(),
      'name'       => new sfWidgetFormInputText(),
      'from_date'  => new sfWidgetFormDateTime(),
      'to_date'    => new sfWidgetFormDateTime(),
      'deleted_by' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'name'       => new sfValidatorString(array('max_length' => 100)),
      'from_date'  => new sfValidatorDateTime(array('required' => false)),
      'to_date'    => new sfValidatorDateTime(array('required' => false)),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('period[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Period';
  }


}
