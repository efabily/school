<?php

/**
 * Student filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class ResumenMensualidadFormFilter extends BaseStudentFormFilter
{
  public function configure()
  {     
     parent::setup();
     
     $period_id = sfContext::getInstance()->getUser()->getAttribute('period');
     
     $choices_timetable = TimetablePeer::getTimeTableArray($period_id);
     
     $choices_degree = DegreePeer::getDegreeArray($period_id);
     
     $choices_curso = CursoPeer::getCursoArray($period_id);
     
     $choices_mes = array(
	  1 => 'ENERO',
	  2 => 'FEBRERO',
	  3 => 'MARZO',
	  4 => 'ABRIL',
	  5 => 'MAYO',
	  6 => 'JUNIO',
	  7 => 'JULIO',
	  8 => 'AGOSTO',
	  9 => 'SEPTIEMBRE',
	  10 => 'OCTUBRE'
	 );
     
     $this->setWidgets(array(
      'timetable_id' => new sfWidgetFormSelect(array('choices' => $choices_timetable), array()),
      'degree_id' => new sfWidgetFormSelect(array('choices' => $choices_degree), array()),
      'curso_id' => new sfWidgetFormSelect(array('choices' => $choices_curso), array()),
      'nro_mes' => new sfWidgetFormSelect(array('choices' => $choices_mes), array()),
      'from_date' => new sfWidgetFormDateJQueryUI(
                 array( "change_year" => true, "culture" => "es"
	         ),array('size'=>'12','maxlength'=>'10'))
	     ,'to_date' => new sfWidgetFormDateJQueryUI(array( "change_year" => true,
	         "culture" => "es"),array('size'=>'12','maxlength'=>'10'))
    ));

    $this->setValidators(array(
      'timetable_id'  => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'degree_id'   => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'curso_id'    => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'nro_mes'    => new sfValidatorInteger(array('trim' => true, 'required' => false)),
      'from_date' => new sfValidatorDateTime(array('required' => false,
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             ))
            ,'to_date' => new sfValidatorDateTime(array('required' => false,             
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             )),
    ));

    $this->widgetSchema->setNameFormat('list_student_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
    $this->disableLocalCSRFProtection();
  }
}