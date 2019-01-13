<?php

/**
 * ItemGrade form base class.
 *
 * @method ItemGrade getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseItemGradeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_state'   => new sfWidgetFormInputText(),
      'item_id'    => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => false)),
      'grade_id'   => new sfWidgetFormPropelChoice(array('model' => 'Grade', 'add_empty' => false)),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'deleted_by' => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'item_id'    => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id')),
      'grade_id'   => new sfValidatorPropelChoice(array('model' => 'Grade', 'column' => 'id')),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_grade[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemGrade';
  }


}
