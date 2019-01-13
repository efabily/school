<?php

/**
 * MovementCashboxDeposit form base class.
 *
 * @method MovementCashboxDeposit getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMovementCashboxDepositForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => false)),
      'deposit_id'          => new sfWidgetFormPropelChoice(array('model' => 'Deposit', 'add_empty' => false)),
      'deleted_by'          => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('model' => 'MovementCashbox', 'column' => 'id')),
      'deposit_id'          => new sfValidatorPropelChoice(array('model' => 'Deposit', 'column' => 'id')),
      'deleted_by'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_deposit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxDeposit';
  }


}
