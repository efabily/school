<?php

/**
 * MovementCashboxPayInf form base class.
 *
 * @method MovementCashboxPayInf getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMovementCashboxPayInfForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'deleted_by'             => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'movement_cashbox_id'    => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => false)),
      'payment_information_id' => new sfWidgetFormPropelChoice(array('model' => 'PaymentInformation', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'deleted_by'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'movement_cashbox_id'    => new sfValidatorPropelChoice(array('model' => 'MovementCashbox', 'column' => 'id')),
      'payment_information_id' => new sfValidatorPropelChoice(array('model' => 'PaymentInformation', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_pay_inf[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxPayInf';
  }


}
