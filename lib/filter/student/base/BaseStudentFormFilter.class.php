<?php

/**
 * Student filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseStudentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'father_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mother_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rude'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'birth_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'email'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'person_id'   => new sfWidgetFormPropelChoice(array('model' => 'Person', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'first_name'  => new sfValidatorPass(array('required' => false)),
      'father_name' => new sfValidatorPass(array('required' => false)),
      'mother_name' => new sfValidatorPass(array('required' => false)),
      'rude'        => new sfValidatorPass(array('required' => false)),
      'codigo'      => new sfValidatorPass(array('required' => false)),
      'birth_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'email'       => new sfValidatorPass(array('required' => false)),
      'deleted_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'person_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Person', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('student_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Student';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_state'    => 'Number',
      'first_name'  => 'Text',
      'father_name' => 'Text',
      'mother_name' => 'Text',
      'rude'        => 'Text',
      'codigo'      => 'Text',
      'birth_date'  => 'Date',
      'email'       => 'Text',
      'deleted_by'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'person_id'   => 'ForeignKey',
    );
  }
}
