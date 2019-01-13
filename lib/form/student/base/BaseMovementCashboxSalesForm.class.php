<?php

/**
 * MovementCashboxSales form base class.
 *
 * @method MovementCashboxSales getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseMovementCashboxSalesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'movement_cashbox_id' => new sfWidgetFormPropelChoice(array('model' => 'MovementCashbox', 'add_empty' => false)),
      'sales_id'            => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => false)),
      'deleted_by'          => new sfWidgetFormInputText(),
      'created_at'          => new sfWidgetFormDateTime(),
      'updated_at'          => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'movement_cashbox_id' => new sfValidatorPropelChoice(array('model' => 'MovementCashbox', 'column' => 'id')),
      'sales_id'            => new sfValidatorPropelChoice(array('model' => 'Sales', 'column' => 'id')),
      'deleted_by'          => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'          => new sfValidatorDateTime(array('required' => false)),
      'updated_at'          => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('movement_cashbox_sales[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'MovementCashboxSales';
  }


}
