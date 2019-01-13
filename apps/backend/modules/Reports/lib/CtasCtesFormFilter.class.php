<?php

/**
 * Student filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class CtasCtesFormFilter extends BaseStudentFormFilter
{
  public function configure()
  {     
     parent::setup();
     
     $period_id = sfContext::getInstance()->getUser()->getAttribute('period');
     
     $choices_timetable = TimetablePeer::getTimeTableArray($period_id, true);
     
     $choices_degree = DegreePeer::getDegreeArray($period_id, true);
     
     $choices_curso = CursoPeer::getCursoArray($period_id, true);
     
     $this->setWidgets(array(
      'timetable_id' => new sfWidgetFormSelect(array('choices' => $choices_timetable), array()),
      'degree_id' => new sfWidgetFormSelect(array('choices' => $choices_degree), array()),
      'curso_id' => new sfWidgetFormSelect(array('choices' => $choices_curso), array()),
      'codigo'      => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'father_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'mother_name' => new sfWidgetFormFilterInput(array('with_empty' => false)),
      'first_name'  => new sfWidgetFormFilterInput(array('with_empty' => false))
    ));

    $this->setValidators(array(
      'timetable_id'  => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'degree_id'   => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'curso_id'    => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'codigo'      => new sfValidatorPass(array('required' => false)),      
      'father_name' => new sfValidatorPass(array('required' => false)),
      'mother_name' => new sfValidatorPass(array('required' => false)),
      'first_name'  => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('list_student_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    $this->disableLocalCSRFProtection();
  }
}