<?php

/**
 * TransferBillet form base class.
 *
 * @method TransferBillet getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTransferBilletForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'transfer_id' => new sfWidgetFormPropelChoice(array('model' => 'Transfer', 'add_empty' => false)),
      'billet_id'   => new sfWidgetFormPropelChoice(array('model' => 'Billet', 'add_empty' => false)),
      'quantity'    => new sfWidgetFormInputText(),
      'deleted_by'  => new sfWidgetFormInputText(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'transfer_id' => new sfValidatorPropelChoice(array('model' => 'Transfer', 'column' => 'id')),
      'billet_id'   => new sfValidatorPropelChoice(array('model' => 'Billet', 'column' => 'id')),
      'quantity'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'deleted_by'  => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'  => new sfValidatorDateTime(array('required' => false)),
      'updated_at'  => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('transfer_billet[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'TransferBillet';
  }


}
