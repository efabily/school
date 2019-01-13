<?php

/**
 * ItemForSale filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseItemForSaleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'                   => new sfWidgetFormFilterInput(),
      'quantity'               => new sfWidgetFormFilterInput(),
      'price'                  => new sfWidgetFormFilterInput(),
      'discount'               => new sfWidgetFormFilterInput(),
      'discount_name'          => new sfWidgetFormFilterInput(),
      'deleted'                => new sfWidgetFormFilterInput(),
      'sales_id'               => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => true)),
      'item_id'                => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'additional_information' => new sfWidgetFormFilterInput(),
      'deleted_by'             => new sfWidgetFormFilterInput(),
      'created_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'             => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'name'                   => new sfValidatorPass(array('required' => false)),
      'quantity'               => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'price'                  => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount'               => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'discount_name'          => new sfValidatorPass(array('required' => false)),
      'deleted'                => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'sales_id'               => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Sales', 'column' => 'id')),
      'item_id'                => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Item', 'column' => 'id')),
      'additional_information' => new sfValidatorPass(array('required' => false)),
      'deleted_by'             => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'             => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('item_for_sale_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemForSale';
  }

  public function getFields()
  {
    return array(
      'id'                     => 'Number',
      'name'                   => 'Text',
      'quantity'               => 'Number',
      'price'                  => 'Number',
      'discount'               => 'Number',
      'discount_name'          => 'Text',
      'deleted'                => 'Number',
      'sales_id'               => 'ForeignKey',
      'item_id'                => 'ForeignKey',
      'additional_information' => 'Text',
      'deleted_by'             => 'Number',
      'created_at'             => 'Date',
      'updated_at'             => 'Date',
    );
  }
}
