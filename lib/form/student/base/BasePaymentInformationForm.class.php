<?php

/**
 * PaymentInformation form base class.
 *
 * @method PaymentInformation getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePaymentInformationForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'deleted_by' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'user_name'  => new sfWidgetFormInputText(),
      'number'     => new sfWidgetFormInputText(),
      'comment'    => new sfWidgetFormTextarea(),
      'address'    => new sfWidgetFormTextarea(),
      'validity'   => new sfWidgetFormDateTime(),
      'cvv_code'   => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'user_name'  => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'number'     => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'comment'    => new sfValidatorString(array('required' => false)),
      'address'    => new sfValidatorString(array('required' => false)),
      'validity'   => new sfValidatorDateTime(array('required' => false)),
      'cvv_code'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('payment_information[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentInformation';
  }


}
