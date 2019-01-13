<?php

/**
 * PaymentTypeBillet filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePaymentTypeBilletFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'billet_id'       => new sfWidgetFormPropelChoice(array('model' => 'Billet', 'add_empty' => true)),
      'payment_type_id' => new sfWidgetFormPropelChoice(array('model' => 'PaymentType', 'add_empty' => true)),
      'deleted_by'      => new sfWidgetFormFilterInput(),
      'created_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'      => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'id_state'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'billet_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Billet', 'column' => 'id')),
      'payment_type_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'PaymentType', 'column' => 'id')),
      'deleted_by'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'      => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('payment_type_billet_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentTypeBillet';
  }

  public function getFields()
  {
    return array(
      'id'              => 'Number',
      'id_state'        => 'Number',
      'billet_id'       => 'ForeignKey',
      'payment_type_id' => 'ForeignKey',
      'deleted_by'      => 'Number',
      'created_at'      => 'Date',
      'updated_at'      => 'Date',
    );
  }
}
