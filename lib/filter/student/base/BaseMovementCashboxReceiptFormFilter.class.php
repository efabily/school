<?php

/**
 * MovementCashboxReceipt filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMovementCashboxReceiptFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => true)),
      'receipt_id'          => new sfWidgetFormPropelChoice(array('model' => 'Receipt', 'add_empty' => true)),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'deleted_by'          => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MovementCashbox', 'column' => 'id')),
      'receipt_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Receipt', 'column' => 'id')),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_by'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_receipt_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxReceipt';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'movement_cashbox_id' => 'ForeignKey',
      'receipt_id'          => 'ForeignKey',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
      'deleted_by'          => 'Number',
    );
  }
}
