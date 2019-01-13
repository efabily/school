<?php

/**
 * Grade form base class.
 *
 * @method Grade getObject() Returns the current form's model object
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseGradeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'           => new sfWidgetFormInputHidden(),
      'id_state'     => new sfWidgetFormInputText(),
      'name'         => new sfWidgetFormInputText(),
      'description'  => new sfWidgetFormTextarea(),
      'deleted_by'   => new sfWidgetFormInputText(),
      'created_at'   => new sfWidgetFormDateTime(),
      'updated_at'   => new sfWidgetFormDateTime(),
      'degree_id'    => new sfWidgetFormPropelChoice(array('model' => 'Degree', 'add_empty' => false)),
      'timetable_id' => new sfWidgetFormPropelChoice(array('model' => 'Timetable', 'add_empty' => false)),
      'curso_id'     => new sfWidgetFormPropelChoice(array('model' => 'Curso', 'add_empty' => false)),
      'paralelo_id'  => new sfWidgetFormPropelChoice(array('model' => 'Paralelo', 'add_empty' => false)),
    ));

    $this->setValidators(array(
      'id'           => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'id_state'     => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'name'         => new sfValidatorString(array('max_length' => 100)),
      'description'  => new sfValidatorString(),
      'deleted_by'   => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'created_at'   => new sfValidatorDateTime(array('required' => false)),
      'updated_at'   => new sfValidatorDateTime(array('required' => false)),
      'degree_id'    => new sfValidatorPropelChoice(array('model' => 'Degree', 'column' => 'id')),
      'timetable_id' => new sfValidatorPropelChoice(array('model' => 'Timetable', 'column' => 'id')),
      'curso_id'     => new sfValidatorPropelChoice(array('model' => 'Curso', 'column' => 'id')),
      'paralelo_id'  => new sfValidatorPropelChoice(array('model' => 'Paralelo', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('grade[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Grade';
  }


}
