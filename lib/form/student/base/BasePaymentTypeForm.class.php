<?php

/**
 * PaymentType form base class.
 *
 * @method PaymentType getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePaymentTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'id_state'           => new sfWidgetFormInputText(),
      'deleted_by'         => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'user_name'          => new sfWidgetFormInputCheckbox(),
      'number'             => new sfWidgetFormInputCheckbox(),
      'document'           => new sfWidgetFormInputCheckbox(),
      'comment'            => new sfWidgetFormInputCheckbox(),
      'address'            => new sfWidgetFormInputCheckbox(),
      'validity'           => new sfWidgetFormInputCheckbox(),
      'cvv_code'           => new sfWidgetFormInputCheckbox(),
      'sales_check'        => new sfWidgetFormInputCheckbox(),
      'accounting_record'  => new sfWidgetFormInputCheckbox(),
      'currency_id'        => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => false)),
      'form_of_payment_id' => new sfWidgetFormPropelChoice(array('model' => 'FormOfPayment', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
      'user_name'          => new sfValidatorBoolean(array('required' => false)),
      'number'             => new sfValidatorBoolean(array('required' => false)),
      'document'           => new sfValidatorBoolean(array('required' => false)),
      'comment'            => new sfValidatorBoolean(array('required' => false)),
      'address'            => new sfValidatorBoolean(array('required' => false)),
      'validity'           => new sfValidatorBoolean(array('required' => false)),
      'cvv_code'           => new sfValidatorBoolean(array('required' => false)),
      'sales_check'        => new sfValidatorBoolean(array('required' => false)),
      'accounting_record'  => new sfValidatorBoolean(array('required' => false)),
      'currency_id'        => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id')),
      'form_of_payment_id' => new sfValidatorPropelChoice(array('model' => 'FormOfPayment', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('payment_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentType';
  }


}
