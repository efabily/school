<?php

/**
 * PaymentType filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePaymentTypeFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'           => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'         => new sfWidgetFormFilterInput(),
      'created_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'         => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_name'          => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'number'             => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'document'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'comment'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'address'            => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'validity'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'cvv_code'           => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'sales_check'        => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'accounting_record'  => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'currency_id'        => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => true)),
      'form_of_payment_id' => new sfWidgetFormPropelChoice(array('model' => 'FormOfPayment', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'         => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_name'          => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'number'             => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'document'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'comment'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'address'            => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'validity'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'cvv_code'           => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'sales_check'        => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'accounting_record'  => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'currency_id'        => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Currency', 'column' => 'id')),
      'form_of_payment_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'FormOfPayment', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('payment_type_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentType';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'id_state'           => 'Number',
      'deleted_by'         => 'Number',
      'created_at'         => 'Date',
      'updated_at'         => 'Date',
      'user_name'          => 'Boolean',
      'number'             => 'Boolean',
      'document'           => 'Boolean',
      'comment'            => 'Boolean',
      'address'            => 'Boolean',
      'validity'           => 'Boolean',
      'cvv_code'           => 'Boolean',
      'sales_check'        => 'Boolean',
      'accounting_record'  => 'Boolean',
      'currency_id'        => 'ForeignKey',
      'form_of_payment_id' => 'ForeignKey',
    );
  }
}
