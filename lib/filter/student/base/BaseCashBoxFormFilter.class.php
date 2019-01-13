<?php

/**
 * CashBox filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCashBoxFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'       => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'     => new sfWidgetFormFilterInput(),
      'created_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'     => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'closing_date'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'comment'        => new sfWidgetFormFilterInput(),
      'superviser_id'  => new sfWidgetFormFilterInput(),
      'cashier_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'night_audit_id' => new sfWidgetFormPropelChoice(array('model' => 'NightAudit', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'     => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'     => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'closing_date'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'comment'        => new sfValidatorPass(array('required' => false)),
      'superviser_id'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'cashier_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'night_audit_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'NightAudit', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('cash_box_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CashBox';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'id_state'       => 'Number',
      'deleted_by'     => 'Number',
      'created_at'     => 'Date',
      'updated_at'     => 'Date',
      'closing_date'   => 'Date',
      'comment'        => 'Text',
      'superviser_id'  => 'Number',
      'cashier_id'     => 'ForeignKey',
      'night_audit_id' => 'ForeignKey',
    );
  }
}
