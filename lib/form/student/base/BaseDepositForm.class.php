<?php

/**
 * Deposit form base class.
 *
 * @method Deposit getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseDepositForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'amount'      => new sfWidgetFormInputText(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'comment'     => new sfWidgetFormTextarea(),
      'discount'    => new sfWidgetFormInputText(),
      'cashier_id'  => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'amount'      => new sfValidatorNumber(array('required' => false)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'comment'     => new sfValidatorString(array('required' => false)),
      'discount'    => new sfValidatorNumber(array('required' => false)),
      'cashier_id'  => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'currency_id' => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('deposit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Deposit';
  }


}
