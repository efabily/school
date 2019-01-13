<?php

/**
 * StudentTutor filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseStudentTutorFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by' => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'student_id' => new sfWidgetFormPropelChoice(array('model' => 'Student', 'add_empty' => true)),
      'tutor_id'   => new sfWidgetFormPropelChoice(array('model' => 'Tutor', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'student_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Student', 'column' => 'id')),
      'tutor_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Tutor', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student_tutor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'StudentTutor';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_state'   => 'Number',
      'deleted_by' => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'student_id' => 'ForeignKey',
      'tutor_id'   => 'ForeignKey',
    );
  }
}
