<?php

/**
 * MovementCashbox form base class.
 *
 * @method MovementCashbox getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMovementCashboxForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                => new sfWidgetFormInputHidden(),
      'deleted_by'        => new sfWidgetFormInputText(),
      'created_at'        => new sfWidgetFormDateTime(),
      'updated_at'        => new sfWidgetFormDateTime(),
      'sum'               => new sfWidgetFormInputText(),
      'cashbox_id'        => new sfWidgetFormPropelChoice(array('model' => 'CashBox', 'add_empty' => false)),
      'currency_price_id' => new sfWidgetFormPropelChoice(array('model' => 'CurrencyPrice', 'add_empty' => false)),
      'payment_type_id'   => new sfWidgetFormPropelChoice(array('model' => 'PaymentType', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'deleted_by'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'        => new sfValidatorDateTime(array('required' => false)),
      'updated_at'        => new sfValidatorDateTime(array('required' => false)),
      'sum'               => new sfValidatorNumber(array('required' => false)),
      'cashbox_id'        => new sfValidatorPropelChoice(array('model' => 'CashBox', 'column' => 'id')),
      'currency_price_id' => new sfValidatorPropelChoice(array('model' => 'CurrencyPrice', 'column' => 'id')),
      'payment_type_id'   => new sfValidatorPropelChoice(array('model' => 'PaymentType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashbox';
  }


}
