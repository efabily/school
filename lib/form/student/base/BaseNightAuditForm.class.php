<?php

/**
 * NightAudit form base class.
 *
 * @method NightAudit getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseNightAuditForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'deleted_by'         => new sfWidgetFormInputText(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'date'               => new sfWidgetFormDateTime(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'business_entity_id' => new sfWidgetFormPropelChoice(array('model' => 'BusinessEntity', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'deleted_by'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(array('required' => false)),
      'updated_at'         => new sfValidatorDateTime(array('required' => false)),
      'date'               => new sfValidatorDateTime(),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'business_entity_id' => new sfValidatorPropelChoice(array('model' => 'BusinessEntity', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('night_audit[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'NightAudit';
  }


}
