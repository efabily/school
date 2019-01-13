<?php

/**
 * GradeSubjectPeriod filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseGradeSubjectPeriodFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'       => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'grade_subject_id' => new sfWidgetFormPropelChoice(array('model' => 'GradeSubject', 'add_empty' => true)),
      'period_id'        => new sfWidgetFormPropelChoice(array('model' => 'Period', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'grade_subject_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'GradeSubject', 'column' => 'id')),
      'period_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Period', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade_subject_period_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'GradeSubjectPeriod';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'id_state'         => 'Number',
      'deleted_by'       => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'grade_subject_id' => 'ForeignKey',
      'period_id'        => 'ForeignKey',
    );
  }
}
