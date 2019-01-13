<?php

/**
 * PaymentInformation filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BasePaymentInformationFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'deleted_by' => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'user_name'  => new sfWidgetFormFilterInput(),
      'number'     => new sfWidgetFormFilterInput(),
      'comment'    => new sfWidgetFormFilterInput(),
      'address'    => new sfWidgetFormFilterInput(),
      'validity'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'cvv_code'   => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'deleted_by' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'user_name'  => new sfValidatorPass(array('required' => false)),
      'number'     => new sfValidatorPass(array('required' => false)),
      'comment'    => new sfValidatorPass(array('required' => false)),
      'address'    => new sfValidatorPass(array('required' => false)),
      'validity'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'cvv_code'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('payment_information_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'PaymentInformation';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'deleted_by' => 'Number',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'user_name'  => 'Text',
      'number'     => 'Text',
      'comment'    => 'Text',
      'address'    => 'Text',
      'validity'   => 'Date',
      'cvv_code'   => 'Number',
    );
  }
}
