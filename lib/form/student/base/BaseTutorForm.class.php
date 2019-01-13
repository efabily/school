<?php

/**
 * Tutor form base class.
 *
 * @method Tutor getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTutorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'id_state'      => new sfWidgetFormInputText(),
      'deleted_by'    => new sfWidgetFormInputText(),
      'created_at'    => new sfWidgetFormDateTime(),
      'updated_at'    => new sfWidgetFormDateTime(),
      'first_name'    => new sfWidgetFormInputText(),
      'father_name'   => new sfWidgetFormInputText(),
      'mother_name'   => new sfWidgetFormInputText(),
      'ci'            => new sfWidgetFormInputText(),
      'languaje'      => new sfWidgetFormInputText(),
      'occupation'    => new sfWidgetFormInputText(),
      'degree'        => new sfWidgetFormInputText(),
      'email'         => new sfWidgetFormInputText(),
      'type_tutor_id' => new sfWidgetFormPropelChoice(array('model' => 'TypeTutor', 'add_empty' => false)),
      'person_id'     => new sfWidgetFormPropelChoice(array('model' => 'Person', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'      => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'deleted_by'    => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'    => new sfValidatorDateTime(array('required' => false)),
      'updated_at'    => new sfValidatorDateTime(array('required' => false)),
      'first_name'    => new sfValidatorString(array('max_length' => 100)),
      'father_name'   => new sfValidatorString(array('max_length' => 100)),
      'mother_name'   => new sfValidatorString(array('max_length' => 100)),
      'ci'            => new sfValidatorString(array('max_length' => 20)),
      'languaje'      => new sfValidatorString(array('max_length' => 100)),
      'occupation'    => new sfValidatorString(array('max_length' => 100)),
      'degree'        => new sfValidatorString(array('max_length' => 100)),
      'email'         => new sfValidatorString(array('max_length' => 100)),
      'type_tutor_id' => new sfValidatorPropelChoice(array('model' => 'TypeTutor', 'column' => 'id')),
      'person_id'     => new sfValidatorPropelChoice(array('model' => 'Person', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('tutor[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tutor';
  }


}
