<?php

/**
 * GradeSubjectPeriod form base class.
 *
 * @method GradeSubjectPeriod getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseGradeSubjectPeriodForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'id_state'         => new sfWidgetFormInputText(),
      'deleted_by'       => new sfWidgetFormInputText(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'grade_subject_id' => new sfWidgetFormPropelChoice(array('model' => 'GradeSubject', 'add_empty' => false)),
      'period_id'        => new sfWidgetFormPropelChoice(array('model' => 'Period', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'         => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'       => new sfValidatorDateTime(array('required' => false)),
      'updated_at'       => new sfValidatorDateTime(array('required' => false)),
      'grade_subject_id' => new sfValidatorPropelChoice(array('model' => 'GradeSubject', 'column' => 'id')),
      'period_id'        => new sfValidatorPropelChoice(array('model' => 'Period', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade_subject_period[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GradeSubjectPeriod';
  }


}
