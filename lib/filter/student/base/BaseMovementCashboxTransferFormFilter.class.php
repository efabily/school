<?php

/**
 * MovementCashboxTransfer filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseMovementCashboxTransferFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => true)),
      'transfer_id'         => new sfWidgetFormPropelChoice(array('model' => 'Transfer', 'add_empty' => true)),
      'deleted_by'          => new sfWidgetFormFilterInput(),
      'created_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'          => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'MovementCashbox', 'column' => 'id')),
      'transfer_id'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Transfer', 'column' => 'id')),
      'deleted_by'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'          => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_transfer_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxTransfer';
  }

  public function getFields()
  {
    return array(
      'id'                  => 'Number',
      'movement_cashbox_id' => 'ForeignKey',
      'transfer_id'         => 'ForeignKey',
      'deleted_by'          => 'Number',
      'created_at'          => 'Date',
      'updated_at'          => 'Date',
    );
  }
}
