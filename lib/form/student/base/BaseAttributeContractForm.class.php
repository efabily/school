<?php

/**
 * AttributeContract form base class.
 *
 * @method AttributeContract getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseAttributeContractForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'key'         => new sfWidgetFormInputText(),
      'value'       => new sfWidgetFormInputText(),
      'label'       => new sfWidgetFormTextarea(),
      'description' => new sfWidgetFormTextarea(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'contract_id' => new sfWidgetFormPropelChoice(array('model' => 'Contract', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'key'         => new sfValidatorString(array('max_length' => 250)),
      'value'       => new sfValidatorString(array('max_length' => 250)),
      'label'       => new sfValidatorString(),
      'description' => new sfValidatorString(),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'contract_id' => new sfValidatorPropelChoice(array('model' => 'Contract', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('attribute_contract[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AttributeContract';
  }


}
