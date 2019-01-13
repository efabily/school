<?php

/**
 * Contract filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseContractFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'nro'         => new sfWidgetFormFilterInput(),
      'amount'      => new sfWidgetFormFilterInput(),
      'container'   => new sfWidgetFormFilterInput(),
      'deleted_by'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'description' => new sfWidgetFormFilterInput(),
      'record_date' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'city'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'period_id'   => new sfWidgetFormPropelChoice(array('model' => 'Period', 'add_empty' => true)),
      'student_id'  => new sfWidgetFormPropelChoice(array('model' => 'Student', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'nro'         => new sfValidatorPass(array('required' => false)),
      'amount'      => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'container'   => new sfValidatorPass(array('required' => false)),
      'deleted_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'description' => new sfValidatorPass(array('required' => false)),
      'record_date' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'city'        => new sfValidatorPass(array('required' => false)),
      'period_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Period', 'column' => 'id')),
      'student_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Student', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('contract_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Contract';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_state'    => 'Number',
      'nro'         => 'Text',
      'amount'      => 'Number',
      'container'   => 'Text',
      'deleted_by'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'description' => 'Text',
      'record_date' => 'Date',
      'city'        => 'Text',
      'period_id'   => 'ForeignKey',
      'student_id'  => 'ForeignKey',
    );
  }
}
