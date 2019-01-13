<?php

/**
 * MovementCashboxTransfer form base class.
 *
 * @method MovementCashboxTransfer getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMovementCashboxTransferForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => false)),
      'transfer_id'         => new sfWidgetFormPropelChoice(array('model' => 'Transfer', 'add_empty' => false)),
      'deleted_by'          => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('model' => 'MovementCashbox', 'column' => 'id')),
      'transfer_id'         => new sfValidatorPropelChoice(array('model' => 'Transfer', 'column' => 'id')),
      'deleted_by'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_transfer[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxTransfer';
  }


}
