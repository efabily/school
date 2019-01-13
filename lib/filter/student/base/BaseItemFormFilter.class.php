<?php

/**
 * Item filter form base class.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id_state'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'name'          => new sfWidgetFormFilterInput(),
      'description'   => new sfWidgetFormFilterInput(),
      'price'         => new sfWidgetFormFilterInput(),
      'alter_price'   => new sfWidgetFormFilterInput(),
      'quantity_load' => new sfWidgetFormFilterInput(),
      'name_load'     => new sfWidgetFormFilterInput(),
      'type_item_id'  => new sfWidgetFormPropelChoice(array('model' => 'TypeItem', 'add_empty' => true)),
      'deleted_by'    => new sfWidgetFormFilterInput(),
      'created_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
      'updated_at'    => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate())),
    ));

    $this->setValidators(array(
      'id_state'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name'          => new sfValidatorPass(array('required' => false)),
      'description'   => new sfValidatorPass(array('required' => false)),
      'price'         => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'alter_price'   => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'quantity_load' => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'name_load'     => new sfValidatorPass(array('required' => false)),
      'type_item_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'TypeItem', 'column' => 'id')),
      'deleted_by'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'    => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function getFields()
  {
    return array(
      'id'            => 'Number',
      'id_state'      => 'Number',
      'name'          => 'Text',
      'description'   => 'Text',
      'price'         => 'Number',
      'alter_price'   => 'Number',
      'quantity_load' => 'Number',
      'name_load'     => 'Text',
      'type_item_id'  => 'ForeignKey',
      'deleted_by'    => 'Number',
      'created_at'    => 'Date',
      'updated_at'    => 'Date',
    );
  }
}
