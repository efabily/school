<?php

/**
 * Student form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class RecordShortEnrollForm extends BaseStudentForm
{
   public function configure()
  {
     parent::setup(); 
     

      $day = date('d');
     $month = date('m');
     $year = date('Y');
     
     $this->setWidgets(array(
      'id' => new sfWidgetFormInputHidden(),      
      'estudiante_nombre'  => new sfWidgetFormInputText(array(), array('required' => true)),
      'estudiante_apellido_paterno' => new sfWidgetFormInputText(array(), array('required' => true)),
      'estudiante_apellido_materno' => new sfWidgetFormInputText(array(), array('required' => true)),            
      'padre_tutor_cedula_identidad' => new sfWidgetFormInputText(array(), array()),
      'madre_cedula_identidad' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_apellido_paterno' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_apellido_materno' => new sfWidgetFormInputText(array(), array()),
      'madre_apellido_paterno' => new sfWidgetFormInputText(array(), array('required' => false)),
      'madre_apellido_materno' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_nombre' => new sfWidgetFormInputText(array(), array()),
      'madre_nombre' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_idioma_frecuente' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'madre_idioma_frecuente' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'padre_tutor_ocupacion' => new sfWidgetFormInputText(array(), array()),
      'madre_ocupacion' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_grado_instruccion' => new sfWidgetFormChoice(array('choices'  => DataSource::$GRADO_INSTRUCCION), array('required' => false)),
      'madre_grado_instruccion' => new sfWidgetFormChoice(array('choices'  => DataSource::$GRADO_INSTRUCCION), array('required' => false)),
      'padre_tutor_parentesco' => new sfWidgetFormChoice(array('choices'  => DataSource::$PARENTESTO), array('required' => false)),
      'madre_email' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_email' => new sfWidgetFormInputText(array(), array()),
      'fecha_registro_dia' => new sfWidgetFormInputText(array('default' => $day), array('required' => true)),
      'fecha_registro_mes' => new sfWidgetFormInputText(array('default' => $month), array('required' => true)),
      'fecha_registro_anio' => new sfWidgetFormInputText(array('default' => $year), array('required' => true)),
      'lugar_registro' => new sfWidgetFormInputText(array('default' => 'MONTERO'), array('required' => true))
    ));
     
    $this->setValidators(array(      
      'id' => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),      
      'estudiante_nombre'  => new sfValidatorString(array('max_length' => 100), array('required' => 'Obligatorio')),
      'estudiante_apellido_paterno' => new sfValidatorString(array('max_length' => 100), array('required' => 'Obligatorio')),
      'estudiante_apellido_materno' => new sfValidatorString(array('max_length' => 100), array('required' => 'Obligatorio')),     
      'padre_tutor_cedula_identidad' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_cedula_identidad' => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => 'Obligatorio')),
      'padre_tutor_apellido_paterno' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'padre_tutor_apellido_materno' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_apellido_paterno' => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => 'Obligatorio')),
      'madre_apellido_materno' => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => 'Obligatorio')),
      'padre_tutor_nombre' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_nombre' => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => 'Obligatorio')),
      'padre_tutor_idioma_frecuente' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_idioma_frecuente' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'padre_tutor_ocupacion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_ocupacion' => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => 'Obligatorio')),
      'padre_tutor_grado_instruccion' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'madre_grado_instruccion' => new sfValidatorString(array('max_length' => 100, 'required' => false), array('required' => 'Obligatorio')),
      'padre_tutor_parentesco' => new sfValidatorString(array('required' => false)),
      'madre_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'padre_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fecha_registro_dia' => new sfValidatorNumber(array('min' => 1, 'max' => 31)),
      'fecha_registro_mes' => new sfValidatorNumber(array('min' => 1, 'max' => 12)),
      'fecha_registro_anio' => new sfValidatorNumber(array('min' => 1, 'max' => $year)),
      'lugar_registro' => new sfValidatorString(array('max_length' => 100)),
    ));
    
     // genero
    $choices_genero = array('FEMENINO' => 'FEMENINO', 'MASCULINO' => 'MASCULINO');
    $this->widgetSchema['estudiante_genero'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $choices_genero), array('required' => true));
    $this->validatorSchema['estudiante_genero'] = new sfValidatorString(array(), array('required' => 'Debe seleccionar el genero al que pertenece el o la estudiante', 'invalid' => 'Valor invalido'));
    
    
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
  
  
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    
    // Obtengo el objeto
    $student = $this->getObject(); 
    
    if (is_object($student))
    {
      $values = array();
      
      $estudiante_nombre['estudiante_nombre'] = $student->getFirstName();
      $values = array_merge($values, $estudiante_nombre);
      
      $estudiante_apellido_paterno['estudiante_apellido_paterno'] = $student->getFatherName();
      $values = array_merge($values, $estudiante_apellido_paterno);
            
      $estudiante_apellido_materno['estudiante_apellido_materno'] = $student->getMotherName();
      $values = array_merge($values, $estudiante_apellido_materno);
      
      
      // Obtenemos el person del estudiante
      $person = $student->getPerson();
      
      // Estudiante Genero
      $attribute_estudiante_genero = AttributePeer::getAttributeByKeyAndPerson('estudiante_genero', $person->getId());
      $estudiante_genero['estudiante_genero'] = is_object($attribute_estudiante_genero) ? $attribute_estudiante_genero->getValue() : null;
      $values = array_merge($values, $estudiante_genero);
     
      // padre_tutor_cedula_identidad
      $tutor_padre = TutorPeer::getTutor($student->getId(), null, 1);
      $padre_tutor_cedula_identidad['padre_tutor_cedula_identidad'] = is_object($tutor_padre) ? $tutor_padre->getCi() : null;
      $values = array_merge($values, $padre_tutor_cedula_identidad);
      
      //padre_tutor_apellidos
      $padre_tutor_apellido_paterno['padre_tutor_apellido_paterno'] = is_object($tutor_padre) ? $tutor_padre->getFatherName() : null;
      $values = array_merge($values, $padre_tutor_apellido_paterno);
      
      //padre_tutor_apellidos
      $padre_tutor_apellido_materno['padre_tutor_apellido_materno'] = is_object($tutor_padre) ? $tutor_padre->getMotherName() : null;
      $values = array_merge($values, $padre_tutor_apellido_materno);
      
      // padre_tutor_nombre
      $padre_tutor_nombre['padre_tutor_nombre'] = is_object($tutor_padre) ? $tutor_padre->getFirstName() : null;
      $values = array_merge($values, $padre_tutor_nombre);
      
      // padre_tutor_idioma_frecuente      
      $padre_tutor_idioma_frecuente['padre_tutor_idioma_frecuente'] = is_object($tutor_padre) ? $tutor_padre->getLanguaje() : null;
      $values = array_merge($values, $padre_tutor_idioma_frecuente);
      
      // padre_tutor_ocupacion
      $padre_tutor_ocupacion['padre_tutor_ocupacion'] = is_object($tutor_padre) ? $tutor_padre->getOccupation() : null;
      $values = array_merge($values, $padre_tutor_ocupacion);
      
      // padre_tutor_grado_instruccion
      $padre_tutor_grado_instruccion['padre_tutor_grado_instruccion'] = is_object($tutor_padre) ? $tutor_padre->getDegree() : null;
      $values = array_merge($values, $padre_tutor_grado_instruccion);
      
      // padre_tutor_parentesco
      $padre_tutor_parentesco['padre_tutor_parentesco'] = is_object($tutor_padre) ? $tutor_padre->getTypeTutor()->getName() : null;
      $values = array_merge($values, $padre_tutor_parentesco);
      
      //padre_email
      $padre_email['padre_email'] = is_object($tutor_padre) ? $tutor_padre->getEmail() : null;
      $values = array_merge($values, $padre_email);
      
      // madre_cedula_identidad
      $tutor_madre = TutorPeer::getTutor($student->getId(), 1);
      $madre_cedula_identidad['madre_cedula_identidad'] = is_object($tutor_madre) ? $tutor_madre->getCi() : null;
      $values = array_merge($values, $madre_cedula_identidad);
            
      // madre_apellidos
      $madre_apellido_madre_apellido_paterno['madre_apellido_paterno'] = is_object($tutor_madre) ? $tutor_madre->getFatherName() : null;
      $values = array_merge($values, $madre_apellido_madre_apellido_paterno);
      
      // madre_apellidos
      $madre_apellido_materno['madre_apellido_materno'] = is_object($tutor_madre) ? $tutor_madre->getMotherName() : null;
      $values = array_merge($values, $madre_apellido_materno);
      
      // madre_nombre
      $madre_nombre['madre_nombre'] = is_object($tutor_madre) ? $tutor_madre->getFirstName() : null;
      $values = array_merge($values, $madre_nombre);      
      
      // madre_idioma_frecuente	 
      $madre_idioma_frecuente['madre_idioma_frecuente'] = is_object($tutor_madre) ? $tutor_madre->getLanguaje() : null;
      $values = array_merge($values, $madre_idioma_frecuente);
      
      // madre_ocupacion      
      $madre_ocupacion['madre_ocupacion'] = is_object($tutor_madre) ? $tutor_madre->getOccupation() : null;
      $values = array_merge($values, $madre_ocupacion);
            
      // madre_grado_instruccion      
      $madre_grado_instruccion['madre_grado_instruccion'] = is_object($tutor_madre) ? $tutor_madre->getDegree() : null;
      $values = array_merge($values, $madre_grado_instruccion);
      
      // madre_email
      $madre_email['madre_email'] = is_object($tutor_madre) ? $tutor_madre->getEmail() : null;
      $values = array_merge($values, $madre_email);
      
      
      
      
      $this->setDefaults(array_merge($this->getDefaults(), $values));      
    }
    
  }
  
}


