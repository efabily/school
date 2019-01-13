<?php

/**
 * AccountDeposit form base class.
 *
 * @method AccountDeposit getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAccountDepositForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_state'   => new sfWidgetFormInputText(),
      'amount'     => new sfWidgetFormInputText(),
      'account_id' => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'deposit_id' => new sfWidgetFormPropelChoice(array('model' => 'Deposit', 'add_empty' => false)),
      'deleted_by' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'amount'     => new sfValidatorNumber(array('required' => false)),
      'account_id' => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'deposit_id' => new sfValidatorPropelChoice(array('model' => 'Deposit', 'column' => 'id')),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('account_deposit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AccountDeposit';
  }


}
