<?php

/**
 * Tutor filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTutorFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'    => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'first_name'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'father_name'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mother_name'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'ci'            => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'languaje'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'occupation'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'degree'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'email'         => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'type_tutor_id' => new sfWidgetFormPropelChoice(array('model' => 'TypeTutor', 'add_empty' => true)),
      'person_id'     => new sfWidgetFormPropelChoice(array('model' => 'Person', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'first_name'    => new sfValidatorPass(array('required' => false)),
      'father_name'   => new sfValidatorPass(array('required' => false)),
      'mother_name'   => new sfValidatorPass(array('required' => false)),
      'ci'            => new sfValidatorPass(array('required' => false)),
      'languaje'      => new sfValidatorPass(array('required' => false)),
      'occupation'    => new sfValidatorPass(array('required' => false)),
      'degree'        => new sfValidatorPass(array('required' => false)),
      'email'         => new sfValidatorPass(array('required' => false)),
      'type_tutor_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TypeTutor', 'column' => 'id')),
      'person_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Person', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tutor_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tutor';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_state'      => 'Number',
      'deleted_by'    => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
      'first_name'    => 'Text',
      'father_name'   => 'Text',
      'mother_name'   => 'Text',
      'ci'            => 'Text',
      'languaje'      => 'Text',
      'occupation'    => 'Text',
      'degree'        => 'Text',
      'email'         => 'Text',
      'type_tutor_id' => 'ForeignKey',
      'person_id'     => 'ForeignKey',
    );
  }
}
