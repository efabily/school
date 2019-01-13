<?php

/**
 * CurrencyPrice form base class.
 *
 * @method CurrencyPrice getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCurrencyPriceForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'id_state'    => new sfWidgetFormInputText(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'reference'   => new sfWidgetFormInputText(),
      'sale'        => new sfWidgetFormInputText(),
      'purchase'    => new sfWidgetFormInputText(),
      'since_date'  => new sfWidgetFormDateTime(),
      'until_date'  => new sfWidgetFormDateTime(),
      'currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => false)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
      'reference'   => new sfValidatorString(array('max_length' => 100)),
      'sale'        => new sfValidatorNumber(),
      'purchase'    => new sfValidatorNumber(),
      'since_date'  => new sfValidatorDateTime(),
      'until_date'  => new sfValidatorDateTime(),
      'currency_id' => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('currency_price[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CurrencyPrice';
  }


}
