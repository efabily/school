<?php

/**
 * GradeSubject form base class.
 *
 * @method GradeSubject getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseGradeSubjectForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_state'   => new sfWidgetFormInputText(),
      'deleted_by' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'grade_id'   => new sfWidgetFormPropelChoice(array('model' => 'Grade', 'add_empty' => false)),
      'subject_id' => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'grade_id'   => new sfValidatorPropelChoice(array('model' => 'Grade', 'column' => 'id')),
      'subject_id' => new sfValidatorPropelChoice(array('model' => 'Subject', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade_subject[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GradeSubject';
  }


}
