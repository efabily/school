<?php

/**
 * PaymentTypeBillet form base class.
 *
 * @method PaymentTypeBillet getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BasePaymentTypeBilletForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'id_state'        => new sfWidgetFormInputText(),
      'billet_id'       => new sfWidgetFormPropelChoice(array('model' => 'Billet', 'add_empty' => false)),
      'payment_type_id' => new sfWidgetFormPropelChoice(array('model' => 'PaymentType', 'add_empty' => false)),
      'deleted_by'      => new sfWidgetFormInputText(),
      'created_at'      => new sfWidgetFormDateTime(),
      'updated_at'      => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'billet_id'       => new sfValidatorPropelChoice(array('model' => 'Billet', 'column' => 'id')),
      'payment_type_id' => new sfValidatorPropelChoice(array('model' => 'PaymentType', 'column' => 'id')),
      'deleted_by'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'      => new sfValidatorDateTime(array('required' => false)),
      'updated_at'      => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('payment_type_billet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentTypeBillet';
  }


}
