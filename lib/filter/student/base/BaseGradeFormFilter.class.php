<?php

/**
 * Grade filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseGradeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'     => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'description'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'   => new sfWidgetFormFilterInput(),
      'created_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'degree_id'    => new sfWidgetFormPropelChoice(array('model' => 'Degree', 'add_empty' => true)),
      'timetable_id' => new sfWidgetFormPropelChoice(array('model' => 'Timetable', 'add_empty' => true)),
      'curso_id'     => new sfWidgetFormPropelChoice(array('model' => 'Curso', 'add_empty' => true)),
      'paralelo_id'  => new sfWidgetFormPropelChoice(array('model' => 'Paralelo', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'         => new sfValidatorPass(array('required' => false)),
      'description'  => new sfValidatorPass(array('required' => false)),
      'deleted_by'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'degree_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Degree', 'column' => 'id')),
      'timetable_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Timetable', 'column' => 'id')),
      'curso_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Curso', 'column' => 'id')),
      'paralelo_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Paralelo', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grade';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'id_state'     => 'Number',
      'name'         => 'Text',
      'description'  => 'Text',
      'deleted_by'   => 'Number',
      'created_at'   => 'Date',
      'updated_at'   => 'Date',
      'degree_id'    => 'ForeignKey',
      'timetable_id' => 'ForeignKey',
      'curso_id'     => 'ForeignKey',
      'paralelo_id'  => 'ForeignKey',
    );
  }
}
