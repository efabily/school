<?php

/**
 * Item form base class.
 *
 * @method Item getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_state'      => new sfWidgetFormInputText(),
      'name'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'price'         => new sfWidgetFormInputText(),
      'alter_price'   => new sfWidgetFormInputText(),
      'quantity_load' => new sfWidgetFormInputText(),
      'name_load'     => new sfWidgetFormTextarea(),
      'type_item_id'  => new sfWidgetFormPropelChoice(array('model' => 'TypeItem', 'add_empty' => false)),
      'deleted_by'    => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'name'          => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'price'         => new sfValidatorNumber(array('required' => false)),
      'alter_price'   => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'quantity_load' => new sfValidatorInteger(array('min' => -128, 'max' => 127, 'required' => false)),
      'name_load'     => new sfValidatorString(array('required' => false)),
      'type_item_id'  => new sfValidatorPropelChoice(array('model' => 'TypeItem', 'column' => 'id')),
      'deleted_by'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }


}
