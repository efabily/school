<?php

/**
 * CashBox form base class.
 *
 * @method CashBox getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseCashBoxForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'id_state'       => new sfWidgetFormInputText(),
      'deleted_by'     => new sfWidgetFormInputText(),
      'created_at'     => new sfWidgetFormDateTime(),
      'updated_at'     => new sfWidgetFormDateTime(),
      'closing_date'   => new sfWidgetFormDateTime(),
      'comment'        => new sfWidgetFormTextarea(),
      'superviser_id'  => new sfWidgetFormInputText(),
      'cashier_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => false)),
      'night_audit_id' => new sfWidgetFormPropelChoice(array('model' => 'NightAudit', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'       => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'     => new sfValidatorDateTime(array('required' => false)),
      'updated_at'     => new sfValidatorDateTime(array('required' => false)),
      'closing_date'   => new sfValidatorDateTime(array('required' => false)),
      'comment'        => new sfValidatorString(array('required' => false)),
      'superviser_id'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'cashier_id'     => new sfValidatorPropelChoice(array('model' => 'sfGuardUser', 'column' => 'id')),
      'night_audit_id' => new sfValidatorPropelChoice(array('model' => 'NightAudit', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('cash_box[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'CashBox';
  }


}
