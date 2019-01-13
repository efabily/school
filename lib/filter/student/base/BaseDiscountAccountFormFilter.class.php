<?php

/**
 * DiscountAccount filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseDiscountAccountFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'account_id'  => new sfWidgetFormPropelChoice(array('model' => 'Account', 'add_empty' => true)),
      'discount_id' => new sfWidgetFormPropelChoice(array('model' => 'Discount', 'add_empty' => true)),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'deleted_by'  => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'account_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Account', 'column' => 'id')),
      'discount_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Discount', 'column' => 'id')),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'deleted_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('discount_account_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'DiscountAccount';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'account_id'  => 'ForeignKey',
      'discount_id' => 'ForeignKey',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'deleted_by'  => 'Number',
    );
  }
}
