<?php

/**
 * GradeSubject filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseGradeSubjectFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by' => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'grade_id'   => new sfWidgetFormPropelChoice(array('model' => 'Grade', 'add_empty' => true)),
      'subject_id' => new sfWidgetFormPropelChoice(array('model' => 'Subject', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'grade_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Grade', 'column' => 'id')),
      'subject_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Subject', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade_subject_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GradeSubject';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_state'   => 'Number',
      'deleted_by' => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'grade_id'   => 'ForeignKey',
      'subject_id' => 'ForeignKey',
    );
  }
}
