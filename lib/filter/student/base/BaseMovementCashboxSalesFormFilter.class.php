<?php

/**
 * MovementCashboxSales filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMovementCashboxSalesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => true)),
      'sales_id'            => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => true)),
      'deleted_by'          => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MovementCashbox', 'column' => 'id')),
      'sales_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sales', 'column' => 'id')),
      'deleted_by'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_sales_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxSales';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'movement_cashbox_id' => 'ForeignKey',
      'sales_id'            => 'ForeignKey',
      'deleted_by'          => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
