<?php

/**
 * MovementCashboxPayInf filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMovementCashboxPayInfFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'deleted_by'             => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'movement_cashbox_id'    => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => true)),
      'payment_information_id' => new sfWidgetFormPropelChoice(array('model' => 'PaymentInformation', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'deleted_by'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'movement_cashbox_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MovementCashbox', 'column' => 'id')),
      'payment_information_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PaymentInformation', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_pay_inf_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxPayInf';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'deleted_by'             => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
      'movement_cashbox_id'    => 'ForeignKey',
      'payment_information_id' => 'ForeignKey',
    );
  }
}
