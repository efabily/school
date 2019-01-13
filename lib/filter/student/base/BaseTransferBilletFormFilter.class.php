<?php

/**
 * TransferBillet filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseTransferBilletFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'transfer_id' => new sfWidgetFormPropelChoice(array('model' => 'Transfer', 'add_empty' => true)),
      'billet_id'   => new sfWidgetFormPropelChoice(array('model' => 'Billet', 'add_empty' => true)),
      'quantity'    => new sfWidgetFormFilterInput(),
      'deleted_by'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'transfer_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Transfer', 'column' => 'id')),
      'billet_id'   => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Billet', 'column' => 'id')),
      'quantity'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('transfer_billet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransferBillet';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'transfer_id' => 'ForeignKey',
      'billet_id'   => 'ForeignKey',
      'quantity'    => 'Number',
      'deleted_by'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
    );
  }
}
