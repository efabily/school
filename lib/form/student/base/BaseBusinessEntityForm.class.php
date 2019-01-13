<?php

/**
 * BusinessEntity form base class.
 *
 * @method BusinessEntity getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseBusinessEntityForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                   => new sfWidgetFormInputHidden(),
      'id_state'             => new sfWidgetFormInputText(),
      'deleted_by'           => new sfWidgetFormInputText(),
      'created_at'           => new sfWidgetFormDateTime(),
      'updated_at'           => new sfWidgetFormDateTime(),
      'name'                 => new sfWidgetFormInputText(),
      'description'          => new sfWidgetFormTextarea(),
      'server_name'          => new sfWidgetFormInputText(),
      'connection'           => new sfWidgetFormInputText(),
      'night_audit_hour'     => new sfWidgetFormInputText(),
      'night_audit_overtime' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                   => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'           => new sfValidatorDateTime(array('required' => false)),
      'updated_at'           => new sfValidatorDateTime(array('required' => false)),
      'name'                 => new sfValidatorString(array('max_length' => 100)),
      'description'          => new sfValidatorString(),
      'server_name'          => new sfValidatorString(array('max_length' => 100)),
      'connection'           => new sfValidatorString(array('max_length' => 100)),
      'night_audit_hour'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'night_audit_overtime' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
    ));

    $this->widgetSchema->setNameFormat('business_entity[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BusinessEntity';
  }


}