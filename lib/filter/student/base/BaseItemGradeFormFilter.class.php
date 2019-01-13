<?php

/**
 * ItemGrade filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseItemGradeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'item_id'    => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'grade_id'   => new sfWidgetFormPropelChoice(array('model' => 'Grade', 'add_empty' => true)),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'deleted_by' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'id_state'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Item', 'column' => 'id')),
      'grade_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Grade', 'column' => 'id')),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('item_grade_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemGrade';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_state'   => 'Number',
      'item_id'    => 'ForeignKey',
      'grade_id'   => 'ForeignKey',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'deleted_by' => 'Number',
    );
  }
}
