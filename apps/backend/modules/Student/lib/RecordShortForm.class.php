<?php

/**
 * Student form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class RecordShortForm extends BaseStudentForm
{
  public function configure()
  {
     parent::setup(); 
     
     $day = date('d');
     $month = date('m');
     $year = date('Y');
     
     $this->setWidgets(array(            
      'estudiante_nombre'  => new sfWidgetFormInputText(array(), array()),
      'estudiante_apellido_paterno' => new sfWidgetFormInputText(array(), array()),
      'estudiante_apellido_materno' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_cedula_identidad' => new sfWidgetFormInputText(array(), array()),
      'madre_cedula_identidad' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_apellido_paterno' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_apellido_materno' => new sfWidgetFormInputText(array(), array()),
      'madre_apellido_materno' => new sfWidgetFormInputText(array(), array()),
      'madre_apellido_paterno' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_nombre' => new sfWidgetFormInputText(array(), array()),
      'madre_nombre' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_idioma_frecuente' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array()),
      'madre_idioma_frecuente' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array()),
      'padre_tutor_ocupacion' => new sfWidgetFormInputText(array(), array()),
      'madre_ocupacion' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_grado_instruccion' => new sfWidgetFormChoice(array('choices'  => DataSource::$GRADO_INSTRUCCION), array()),
      'madre_grado_instruccion' => new sfWidgetFormChoice(array('choices'  => DataSource::$GRADO_INSTRUCCION), array()),
      'padre_tutor_parentesco' => new sfWidgetFormChoice(array('choices'  => DataSource::$PARENTESTO), array()),
      'madre_email' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_email' => new sfWidgetFormInputText(array(), array()),
      'fecha_registro_dia' => new sfWidgetFormInputText(array('default' => $day), array()),
      'fecha_registro_mes' => new sfWidgetFormInputText(array('default' => $month), array()),
      'fecha_registro_anio' => new sfWidgetFormInputText(array('default' => $year), array()),
      'lugar_registro' => new sfWidgetFormInputText(array('default' => 'MONTERO'), array())
    ));
     
    $this->setValidators(array(      
      'estudiante_nombre'  => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => 'Obligatorio')),
      'estudiante_apellido_paterno' => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => 'Obligatorio')),
      'estudiante_apellido_materno' => new sfValidatorString(array('max_length' => 100, 'required' => true), array('required' => 'Obligatorio')),     
      'padre_tutor_cedula_identidad' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_cedula_identidad' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'padre_tutor_apellido_paterno' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'padre_tutor_apellido_materno' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_apellido_paterno' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'madre_apellido_materno' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'padre_tutor_nombre' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_nombre' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'padre_tutor_idioma_frecuente' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_idioma_frecuente' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'padre_tutor_ocupacion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_ocupacion' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'padre_tutor_grado_instruccion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_grado_instruccion' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'padre_tutor_parentesco' => new sfValidatorString(array('required' => false)),
      'madre_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'padre_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fecha_registro_dia' => new sfValidatorNumber(array('min' => 1, 'max' => 31, 'required' => true)),
      'fecha_registro_mes' => new sfValidatorNumber(array('min' => 1, 'max' => 12, 'required' => true)),
      'fecha_registro_anio' => new sfValidatorNumber(array('min' => 1, 'max' => $year, 'required' => true)),
      'lugar_registro' => new sfValidatorString(array('max_length' => 100)),
    ));              
     // genero
    $choices_genero = array('FEMENINO' => 'FEMENINO', 'MASCULINO' => 'MASCULINO');
    $this->widgetSchema['estudiante_genero'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $choices_genero), array());
    $this->validatorSchema['estudiante_genero'] = new sfValidatorString(array('required' => true), array('required' => 'Debe seleccionar el genero al que pertenece el o la estudiante', 'invalid' => 'Valor invalido'));
    
    
    $array_nivel_1 = GradePeer::getArrCurso(1); // turno mañana    
    if(count($array_nivel_1) > 0 )
    {
       $this->widgetSchema['nivel_m'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_nivel_1), array('required' => false));
       $this->validatorSchema['nivel_m'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Valor invalido'));
    }
    
    $array_nivel_2 = GradePeer::getArrCurso(2); // turno tarde
    if(count($array_nivel_2) > 0 )
    {
       $this->widgetSchema['nivel_t'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_nivel_2), array());
       $this->validatorSchema['nivel_t'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Valor invalido'));
    }
    
    
    $array_nivel_3 = GradePeer::getArrCurso(3); // turno noche
    if(count($array_nivel_3) > 0 )
    {
       $this->widgetSchema['nivel_n'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_nivel_3), array());
       $this->validatorSchema['nivel_n'] = new sfValidatorInteger(array('required' => false), array('invalid' => 'Valor invalido'));
    }       
    
    // estudiante_genero
    $this->widgetSchema->setNameFormat('record_short[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);


     
  }
}


