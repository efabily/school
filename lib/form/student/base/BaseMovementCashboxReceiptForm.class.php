<?php

/**
 * MovementCashboxReceipt form base class.
 *
 * @method MovementCashboxReceipt getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMovementCashboxReceiptForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => false)),
      'receipt_id'          => new sfWidgetFormPropelChoice(array('model' => 'Receipt', 'add_empty' => false)),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
      'deleted_by'          => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('model' => 'MovementCashbox', 'column' => 'id')),
      'receipt_id'          => new sfValidatorPropelChoice(array('model' => 'Receipt', 'column' => 'id')),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
      'deleted_by'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_receipt[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxReceipt';
  }


}
