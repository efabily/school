<?php

/**
 * DiscountAccount form base class.
 *
 * @method DiscountAccount getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseDiscountAccountForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'account_id'  => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => false)),
      'discount_id' => new sfWidgetFormPropelChoice(array('model' => 'Discount', 'add_empty' => false)),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'deleted_by'  => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'account_id'  => new sfValidatorPropelChoice(array('model' => 'Account', 'column' => 'id')),
      'discount_id' => new sfValidatorPropelChoice(array('model' => 'Discount', 'column' => 'id')),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('discount_account[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DiscountAccount';
  }


}
