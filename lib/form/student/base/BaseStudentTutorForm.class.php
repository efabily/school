<?php

/**
 * StudentTutor form base class.
 *
 * @method StudentTutor getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseStudentTutorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'         => new sfWidgetFormInputHidden(),
      'id_state'   => new sfWidgetFormInputText(),
      'deleted_by' => new sfWidgetFormInputText(),
      'created_at' => new sfWidgetFormDateTime(),
      'updated_at' => new sfWidgetFormDateTime(),
      'student_id' => new sfWidgetFormPropelChoice(array('model' => 'Student', 'add_empty' => false)),
      'tutor_id'   => new sfWidgetFormPropelChoice(array('model' => 'Tutor', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'         => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by' => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at' => new sfValidatorDateTime(array('required' => false)),
      'updated_at' => new sfValidatorDateTime(array('required' => false)),
      'student_id' => new sfValidatorPropelChoice(array('model' => 'Student', 'column' => 'id')),
      'tutor_id'   => new sfValidatorPropelChoice(array('model' => 'Tutor', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student_tutor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentTutor';
  }


}
