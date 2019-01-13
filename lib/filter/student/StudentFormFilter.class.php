<?php

/**
 * Student filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class StudentFormFilter extends BaseStudentFormFilter
{
  public function configure()
  {     
     parent::setup();
     $choices_state = StatesClass::getArrayStateName('Student');
     $this->setWidgets(array(
     'id_state' => new sfWidgetFormSelect(array('choices' => $choices_state), array('add_empty' => '')),
	 
	 
      // 'id_state'    => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'  => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'father_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mother_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'rude'        => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'codigo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),      
    ));

    $this->setValidators(array(
      'id_state'    => new sfValidatorInteger(array('trim' => true, 'required' => false)),      
      'first_name'  => new sfValidatorPass(array('required' => false)),
      'father_name' => new sfValidatorPass(array('required' => false)),
      'mother_name' => new sfValidatorPass(array('required' => false)),
      'rude'        => new sfValidatorPass(array('required' => false)),
      'codigo'      => new sfValidatorPass(array('required' => false)),      
    ));

    $this->widgetSchema->setNameFormat('student_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    
  }
}
