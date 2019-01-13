<?php

/**
 * ItemForSale form base class.
 *
 * @method ItemForSale getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseItemForSaleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                     => new sfWidgetFormInputHidden(),
      'name'                   => new sfWidgetFormInputText(),
      'quantity'               => new sfWidgetFormInputText(),
      'price'                  => new sfWidgetFormInputText(),
      'discount'               => new sfWidgetFormInputText(),
      'discount_name'          => new sfWidgetFormInputText(),
      'deleted'                => new sfWidgetFormInputText(),
      'sales_id'               => new sfWidgetFormPropelChoice(array('model' => 'Sales', 'add_empty' => false)),
      'item_id'                => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => false)),
      'additional_information' => new sfWidgetFormTextarea(),
      'deleted_by'             => new sfWidgetFormInputText(),
      'created_at'             => new sfWidgetFormDateTime(),
      'updated_at'             => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'                     => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'                   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'quantity'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'price'                  => new sfValidatorNumber(array('required' => false)),
      'discount'               => new sfValidatorNumber(array('required' => false)),
      'discount_name'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'deleted'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'sales_id'               => new sfValidatorPropelChoice(array('model' => 'Sales', 'column' => 'id')),
      'item_id'                => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id')),
      'additional_information' => new sfValidatorString(array('required' => false)),
      'deleted_by'             => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'             => new sfValidatorDateTime(array('required' => false)),
      'updated_at'             => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_for_sale[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemForSale';
  }


}
