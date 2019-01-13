<?php

/**
 * MovementCashbox filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMovementCashboxFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'deleted_by'        => new sfWidgetFormFilterInput(),
      'created_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'        => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'sum'               => new sfWidgetFormFilterInput(),
      'cashbox_id'        => new sfWidgetFormPropelChoice(array('model' => 'CashBox', 'add_empty' => true)),
      'currency_price_id' => new sfWidgetFormPropelChoice(array('model' => 'CurrencyPrice', 'add_empty' => true)),
      'payment_type_id'   => new sfWidgetFormPropelChoice(array('model' => 'PaymentType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'deleted_by'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'        => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'sum'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'cashbox_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'CashBox', 'column' => 'id')),
      'currency_price_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'CurrencyPrice', 'column' => 'id')),
      'payment_type_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PaymentType', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashbox';
  }

  public function getFields()
  {
    return array(
      'id'                => 'Number',
      'deleted_by'        => 'Number',
      'created_at'        => 'Date',
      'updated_at'        => 'Date',
      'sum'               => 'Number',
      'cashbox_id'        => 'ForeignKey',
      'currency_price_id' => 'ForeignKey',
      'payment_type_id'   => 'ForeignKey',
    );
  }
}
