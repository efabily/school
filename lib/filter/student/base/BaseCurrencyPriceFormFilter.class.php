<?php

/**
 * CurrencyPrice filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseCurrencyPriceFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'deleted_by'  => new sfWidgetFormFilterInput(),
      'created_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'reference'   => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'sale'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'purchase'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'since_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'until_date'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id_state'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'deleted_by'  => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'reference'   => new sfValidatorPass(array('required' => false)),
      'sale'        => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'purchase'    => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'since_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'until_date'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'currency_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Currency', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('currency_price_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrencyPrice';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'id_state'    => 'Number',
      'deleted_by'  => 'Number',
      'created_at'  => 'Date',
      'updated_at'  => 'Date',
      'reference'   => 'Text',
      'sale'        => 'Number',
      'purchase'    => 'Number',
      'since_date'  => 'Date',
      'until_date'  => 'Date',
      'currency_id' => 'ForeignKey',
      'user_id'     => 'ForeignKey',
    );
  }
}
