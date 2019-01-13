<?php

/**
 * SaleAccount form base class.
 *
 * @method SaleAccount getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseSaleAccountForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_state'   => new sfWidgetFormInputText(),
      'amount'     => new sfWidgetFormInputText(),
      'sales_id'   => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => false)),
      'account_id' => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'deleted_by' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'amount'     => new sfValidatorNumber(array('required' => false)),
      'sales_id'   => new sfValidatorPropelChoice(array('model' => 'Sales', 'column' => 'id')),
      'account_id' => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sale_account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SaleAccount';
  }


}
