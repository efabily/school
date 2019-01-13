<?php

/**
 * Receipt form base class.
 *
 * @method Receipt getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseReceiptForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'total'                  => new sfWidgetFormInputText(),
      'total_net'              => new sfWidgetFormInputText(),
      'night_audit_id'         => new sfWidgetFormPropelChoice(array('model' => 'NightAudit', 'add_empty' => false)),
      'discount'               => new sfWidgetFormInputText(),
      'service'                => new sfWidgetFormInputText(),
      'canceled'               => new sfWidgetFormInputCheckbox(),
      'printed'                => new sfWidgetFormInputCheckbox(),
      'comment'                => new sfWidgetFormTextarea(),
      'name'                   => new sfWidgetFormInputText(),
      'nit'                    => new sfWidgetFormInputText(),
      'telefon'                => new sfWidgetFormInputText(),
      'additional_information' => new sfWidgetFormTextarea(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
      'deleted_by'             => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'total'                  => new sfValidatorNumber(array('required' => false)),
      'total_net'              => new sfValidatorNumber(array('required' => false)),
      'night_audit_id'         => new sfValidatorPropelChoice(array('model' => 'NightAudit', 'column' => 'id')),
      'discount'               => new sfValidatorNumber(array('required' => false)),
      'service'                => new sfValidatorNumber(array('required' => false)),
      'canceled'               => new sfValidatorBoolean(array('required' => false)),
      'printed'                => new sfValidatorBoolean(array('required' => false)),
      'comment'                => new sfValidatorString(array('required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'nit'                    => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'telefon'                => new sfValidatorString(array('max_length' => 12, 'required' => false)),
      'additional_information' => new sfValidatorString(array('required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
      'deleted_by'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('receipt[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Receipt';
  }


}
