<?php

/**
 * SalesDeposit filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseSalesDepositFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'amount'     => new sfWidgetFormFilterInput(),
      'sales_id'   => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => true)),
      'deposit_id' => new sfWidgetFormPropelChoice(array('model' => 'Deposit', 'add_empty' => true)),
      'deleted_by' => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'id_state'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'amount'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'sales_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sales', 'column' => 'id')),
      'deposit_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Deposit', 'column' => 'id')),
      'deleted_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('sales_deposit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'SalesDeposit';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'id_state'   => 'Number',
      'amount'     => 'Number',
      'sales_id'   => 'ForeignKey',
      'deposit_id' => 'ForeignKey',
      'deleted_by' => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
    );
  }
}
