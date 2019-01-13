<?php

/**
 * Question form base class.
 *
 * @method Question getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseQuestionForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'question'    => new sfWidgetFormInputText(),
      'reply'       => new sfWidgetFormInputText(),
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
      'question'    => new sfValidatorString(array('max_length' => 255)),
      'reply'       => new sfValidatorString(array('max_length' => 255)),
      'label'       => new sfValidatorString(),
      'description' => new sfValidatorString(),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'contract_id' => new sfValidatorPropelChoice(array('model' => 'Contract', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('question[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Question';
  }


}
