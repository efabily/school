<?php

/**
 * Student form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class StudentForm extends BaseStudentForm
{
  public function configure()
  {
     parent::setup(); 
     
     $day = date('d');
     $month = date('m');
     $year = date('Y');
     
     $this->setWidgets(array(            
      'estudiante_nombre'  => new sfWidgetFormInputText(array(), array('required' => true)),
      'estudiante_apellido_paterno' => new sfWidgetFormInputText(array(), array('required' => true)),
      'estudiante_apellido_materno' => new sfWidgetFormInputText(array(), array('required' => true)),
      'rude'        => new sfWidgetFormInputText(array(), array()),
      'estudiante_nro_documento'  => new sfWidgetFormInputText(array(), array()),
      'estudiante_nacimiento_pais' => new sfWidgetFormInputText(array(), array('required' => false)),
      'fecha_nacimiento_dia' => new sfWidgetFormInputText(array(), array('required' => false)),
      'fecha_nacimiento_mes' => new sfWidgetFormInputText(array(), array('required' => false)),
      'fecha_nacimiento_anio' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_nacimiento_departamento' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_email' => new sfWidgetFormInputText(array(), array()),
      'estudiante_nacimiento_provincia' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_nacimiento_localidad' => new sfWidgetFormInputText(array(), array('required' => false)),
      'certificado_nacimiento_oficialia' => new sfWidgetFormInputText(array(), array('required' => false)),
      'certificado_nacimiento_libro' => new sfWidgetFormInputText(array(), array('required' => false)),
      'certificado_nacimiento_partida' => new sfWidgetFormInputText(array(), array('required' => false)),
      'certificado_nacimiento_folio' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_direccion_provincia' => new sfWidgetFormChoice(array('choices'  => DataSource::$PROVINCIAS), array('required' => false)),
      'estudiante_direccion_zona_villa' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_direccion_session_municipio' => new sfWidgetFormChoice(array('choices'  => array()), array('required' => false)),
      'estudiante_direccion_avenida_calle' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_direccion_localidad_comunidad' => new sfWidgetFormInputText(array(), array('required' => false)),
      'estudiante_direccion_celular' => new sfWidgetFormInputText(array(), array()),
      'estudiante_direccion_numero_vivienda' => new sfWidgetFormInputText(array(), array('required' => false)),
      'idioma_nines' => new sfWidgetFormInputText(array(), array()),
      'idioma_habla_frecuentemente_1' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'idioma_habla_frecuentemente_2' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'idioma_habla_frecuentemente_3' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'otro_pertenece' => new sfWidgetFormInputText(array(), array()),
      'cuantos_dias_trabajo' => new sfWidgetFormInputText(array(), array()),
      'padre_tutor_cedula_identidad' => new sfWidgetFormInputText(array(), array('required' => false)),
      'madre_cedula_identidad' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_apellido_paterno' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_apellido_materno' => new sfWidgetFormInputText(array(), array('required' => false)),
      'madre_apellido_paterno' => new sfWidgetFormInputText(array(), array('required' => false)),
      'madre_apellido_materno' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_nombre' => new sfWidgetFormInputText(array(), array('required' => false)),
      'madre_nombre' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_idioma_frecuente' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'madre_idioma_frecuente' => new sfWidgetFormChoice(array('choices'  => DataSource::$IDIOMAS), array('required' => false)),
      'padre_tutor_ocupacion' => new sfWidgetFormInputText(array(), array('required' => false)),
      'madre_ocupacion' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_tutor_grado_instruccion' => new sfWidgetFormChoice(array('choices'  => DataSource::$GRADO_INSTRUCCION), array('required' => false)),
      'madre_grado_instruccion' => new sfWidgetFormChoice(array('choices'  => DataSource::$GRADO_INSTRUCCION), array('required' => false)),
      'padre_tutor_parentesco' => new sfWidgetFormChoice(array('choices'  => DataSource::$PARENTESTO), array('required' => false)),
      'madre_email' => new sfWidgetFormInputText(array(), array('required' => false)),
      'padre_email' => new sfWidgetFormInputText(array(), array('required' => false)),
      'fecha_registro_dia' => new sfWidgetFormInputText(array('default' => $day), array('required' => true)),
      'fecha_registro_mes' => new sfWidgetFormInputText(array('default' => $month), array('required' => true)),
      'fecha_registro_anio' => new sfWidgetFormInputText(array('default' => $year), array('required' => true)),
      'lugar_registro' => new sfWidgetFormInputText(array('default' => 'MONTERO'), array('required' => true))
    ));
     
    $this->setValidators(array(      
      'estudiante_nombre'  => new sfValidatorString(array('max_length' => 100), array('required' => 'Obligatorio')),
      'estudiante_apellido_paterno' => new sfValidatorString(array('max_length' => 100), array('required' => 'Obligatorio')),
      'estudiante_apellido_materno' => new sfValidatorString(array('max_length' => 100), array('required' => 'Obligatorio')),
      'rude'        => new sfValidatorString(array('required' => false),array()),
      'estudiante_nro_documento'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_nacimiento_pais'      => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'fecha_nacimiento_dia' => new sfValidatorNumber(array('min' => 1, 'max' => 31, 'required' => false), array()),
      'fecha_nacimiento_mes' => new sfValidatorNumber(array('min' => 1, 'max' => 12, 'required' => false), array()),
      'fecha_nacimiento_anio' => new sfValidatorNumber(array('min' => 1950, 'max' => $year, 'required' => false)),
      'estudiante_nacimiento_departamento' => new sfValidatorString(array('max_length' => 100, 'required' => false), array()),
      'estudiante_email' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_nacimiento_provincia' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_nacimiento_localidad' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'certificado_nacimiento_oficialia' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'certificado_nacimiento_libro' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'certificado_nacimiento_partida' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'certificado_nacimiento_folio' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_provincia' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_zona_villa' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_session_municipio' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_avenida_calle' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_localidad_comunidad' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_celular' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'estudiante_direccion_numero_vivienda' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'idioma_nines' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'idioma_habla_frecuentemente_1' => new sfValidatorString(array('max_length' => 100,  'required' => false)),
      'idioma_habla_frecuentemente_2' => new sfValidatorString(array('max_length' => 100,  'required' => false)),
      'idioma_habla_frecuentemente_3' => new sfValidatorString(array('max_length' => 100,  'required' => false)),
      'otro_pertenece' => new sfValidatorString(array('required' => false)),
      'cuantos_dias_trabajo' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
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
      'fecha_registro_dia' => new sfValidatorNumber(array('min' => 1, 'max' => 31)),
      'fecha_registro_mes' => new sfValidatorNumber(array('min' => 1, 'max' => 12)),
      'fecha_registro_anio' => new sfValidatorNumber(array('min' => 1, 'max' => $year)),
      'lugar_registro' => new sfValidatorString(array('max_length' => 100)),
    ));
     
    
     // Tipo de documento
    $choices_tipo_documento = array('estudiante_ci' => 'C.I.', 'estudiante_pasaporte' => 'PASAPORTE');
    $this->widgetSchema['tipo_documento'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $choices_tipo_documento), array('required' => false));
    $this->validatorSchema['tipo_documento'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar un tipo de documento', */'invalid' => 'Valor invalido'));
            
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
    
    // pertenece
    $array_pertenece = array(
	'no_pertenece' => 'No pertenece',
	'afroboliviano' => 'Afroboliviano',
	'araona' => 'Araona',
	'aymara' => 'Aymara',
	'baure' => 'Baure',
	'besiro' => 'Bésiro',
	'canichana' => 'Canichana',
	'cavineno' => 'Cavineño',
	'cayubaba' => 'Cayubaba',
	'chacobo' => 'Chacobo',
	'chiman' => 'Chiman',
	'eseejja' => 'EseEjja',
	'guarani' => 'Guaraní',
	'guarasuawe' => 'Guarasuawe',
	'guarayo' => 'Guarayo',
	'itonoma' => 'Itonoma',
	'leco' => 'Leco',
	'machajuyai_kallawaya' => 'Machajuyai-Kallawaya',
	'machineri' => 'Machineri',
	'maropa' => 'Maropa ',
	'mojeno_ignaciano' => 'Mojeño-Ignaciano',
	'mojeno_trinitario' => 'Mojeño-Trinitario',
	'more' => 'Moré',
	'moseten' => 'Mosetén',
	'movima' => 'Movima',
	'tacawara' => 'Tacawara',
	'puquina' => 'Puquina',
	'quechua' => 'Quechua',
	'siriono' => 'Sirionó Tacana',
	'tacana' => 'Tacana',
	'tapiete' => 'Tapiete',
	'toromona' => 'Toromona',
	'uru_chipaya' => 'Uru-Chipaya',
	'weenhayek' => 'Weenhayek',
	'yaminawa' => 'Yaminawa',
	'yuki' => 'Yuki',
	'yuracare' => 'Yuracaré',
	'zamuco' => 'Zamuco',	
    );
        
    $this->widgetSchema['pertenece'] = new sfWidgetFormChoice(array('expanded' => true, 'multiple' => true,'choices'  => $array_pertenece), array('required' => false));
    $this->validatorSchema['pertenece'] = new sfValidatorChoice(array('required' => false, 'choices' => array($array_pertenece)), array(/*'required' => 'Debe seleccionar por 
                                                                lo menos un usuario para este cubiculo.', */'invalid' => 'Valor invalido'));
    
    // hospital
    $array_hospital = array(
	'1' => 'SI', '2' => 'NO'
    );
        
    $this->widgetSchema['hospital'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_hospital), array('required' => false));
    $this->validatorSchema['hospital'] = new sfValidatorInteger(array('required' => false), array(/*'required' => 'Debe seleccionar el genero al que pertenece el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // hospital_veces
    $array_veces = array(	
	'veces_1_a_2' => '1 a 2 veces', 'veces_3_a_5' => '3 a 5 veces', 'veces_6_mas' => '6 o más veces', 'ninguna' => 'ninguna'
    );
            
    $this->widgetSchema['hospital_veces'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_veces), array('required' => false));
    $this->validatorSchema['hospital_veces'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar el paralelo al que esta asignado el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // Origen Discapacidad sensorial
    $array_discapacidad_sensorial = array(
	'si' => 'Si', 'no' => 'No'
    );    
        
    $this->widgetSchema['discapacidad_sensorial'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_discapacidad_sensorial), array('required' => false));
    $this->validatorSchema['discapacidad_sensorial'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar si tiene discapacidad sensorial',*/ 'invalid' => 'Valor invalido'));
    
    // Origen Discapacidad motriz
    $array_discapacidad_motriz = array(
	'si' => 'Si', 'no' => 'No'
    );
    $this->widgetSchema['discapacidad_motriz'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_discapacidad_motriz), array('required' => false));
    $this->validatorSchema['discapacidad_motriz'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar si tiene discapacidad motriz',*/ 'invalid' => 'Valor invalido'));
    
    // Origen Discapacidad Mental
    $array_discapacidad_mental = array(	
	'si' => 'Si', 'no' => 'No'
    );
    $this->widgetSchema['discapacidad_mental'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_discapacidad_mental), array('required' => false));
    $this->validatorSchema['discapacidad_mental'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar si tiene discapacidad mental',*/ 'invalid' => 'Valor invalido'));
    
    
    // Origen Discapacidad
    $array_origen_discapacidad = array(
	'nacimiento' => 'De nacimiento',
	'adquirida' => 'Adquirida',
	'hereditaria' => 'Hereditaria',
	'origen_discapacidad_otro' => 'Otro',
    );
    
    $this->widgetSchema['origen_discapacidad'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_origen_discapacidad), array('required' => false));
    $this->validatorSchema['origen_discapacidad'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar el paralelo al que esta asignado el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // Acceso a servicios
    $array_acceso_servicio_basico = array(
	'caneria_red' => 'Cañería de red',
	'pileta_publica' => 'Pileta pública',
	'carro_repartidor' => 'Carro repartidor (aguatero)',
	'pozo' => 'Pozo (con o sin bomba)',
	'rio_vertiente' => 'Río, vertiente, acequia, lago, laguna, curiche',
	'otra' => 'Otra',
     );
    
    $this->widgetSchema['acceso_servicio_basico'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_acceso_servicio_basico), array('required' => false));
    $this->validatorSchema['acceso_servicio_basico'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar el paralelo al que esta asignado el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // Energia electrica
    $array_energia_electrica = array(
	'si' => 'Si', 'no' => 'No'
     );
    
    $this->widgetSchema['energia_electrica'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_energia_electrica), array('required' => false));
    $this->validatorSchema['energia_electrica'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar el paralelo al que esta asignado el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // Baño
    $array_bano = array(
	'alcantarillado' => 'Alcantarillado', 
	'camara_septica' => 'Cámara séptica',
	'pozo_ciego' => 'Pozo ciego',
	'calle' => 'A la calle',
	'quebrada_rio' => 'A quebrada, río lago, laguna, curiche',
     );
        
    $this->widgetSchema['bano'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_bano), array('required' => false));
    $this->validatorSchema['bano'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar el paralelo al que esta asignado el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // Trabajo       
    $array_trabajo = array(
	'agricultura_agroindustria' => 'Trabajó en agricultura o agroindustria', 
	'familiares_agricultura_ganaderia' => 'Ayudó a familiares en agricultura o ganadería',
	'labores_domesticas_ventas' => 'Ayudó en el hogar en labores domésticas, comercio o ventas',
	'trabajadora_del_hogar' => 'Trabajó como trabajadora del hogar o niñera',
	'mineria' => 'Trabajó en minería',
	'construccion' => 'Trabajó en construcción',
	'transporte_publico' => 'Trabajó en transporte público',
	'otro_trabajo' => 'Otro trabajo',
	'no_trabajo' => 'No trabajó'
     );
    
    $this->widgetSchema['trabajo'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_trabajo), array('required' => false));
    $this->validatorSchema['trabajo'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe seleccionar el paralelo al que esta asignado el o la estudiante',*/ 'invalid' => 'Valor invalido'));
    
    // Pago
    $array_recibio_pago = array(
	'si' => 'Si', 'no' => 'No'
     );
    
    $this->widgetSchema['recibio_pago'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_recibio_pago), array('required' => false));
    $this->validatorSchema['recibio_pago'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe responder a la pregunta de si recibio pago',*/ 'invalid' => 'Valor invalido'));
    
    // Internet
    $array_accede_internet = array(
	'domicilio' => 'Su domicilio', 
	'unidad_educativa' => 'En la Unidad Educativa',
	'lugares_publicos' => 'Lugares públicos',
	'no_accede' => 'Lugares públicos',
     );
    
    $this->widgetSchema['accede_internet'] = new sfWidgetFormChoice(array('expanded' => true, 'multiple' => true, 'choices'  => $array_accede_internet), array('required' => false));
    $this->validatorSchema['accede_internet'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe responder a la pregunta de si recibio pago',*/ 'invalid' => 'Valor invalido'));
    
    // Frecuencia de internet            
    $array_frecuencia_internet = array(
	'diariamente' => 'Diariamente', 
	'mas_1_semana' => 'Más de una vez a la semana',
	'una_mes' => 'Una vez al mes o menos'
     );
    
    $this->widgetSchema['frecuencia_internet'] = new sfWidgetFormChoice(array('expanded' => true,'choices' => $array_frecuencia_internet), array('required' => false));
    $this->validatorSchema['frecuencia_internet'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe responder a la pregunta de si recibio pago',*/ 'invalid' => 'Valor invalido'));
    
    // Transporte
    $array_transporte = array(
	'a_pie' => 'A pie', 
	'transporte_terrestre' => 'En vehículo de transporte terrestre',
	'otro_medio' => 'Otro medio'
     );
    
    $this->widgetSchema['transporte'] = new sfWidgetFormChoice(array('expanded' => true,'choices' => $array_transporte), array('required' => false));
    $this->validatorSchema['transporte'] = new sfValidatorString(array('required' => false), array(/* 'required' => 'Debe responder a la pregunta de si recibio pago',*/ 'invalid' => 'Valor invalido'));
    
    // Tiempo Transporte
    $array_tiempo_transporte = array(
	'menos_media_hora' => 'Menos de media hora', 
	'entre_media_hora_y_una' => 'Entre media hora y una hora',
	'entre_una_a_dos_hora' => 'Entre una a dos horas',
	'dos_hora_o_mas' => 'Dos horas o más'
     );
    
    $this->widgetSchema['tiempo_transporte'] = new sfWidgetFormChoice(array('expanded' => true,'choices' => $array_tiempo_transporte), array('required' => false));
    $this->validatorSchema['tiempo_transporte'] = new sfValidatorString(array('required' => false), array(/*'required' => 'Debe responder a la pregunta de si recibio pago',*/ 'invalid' => 'Valor invalido'));
    
    
    // estudiante_genero
    $this->widgetSchema->setNameFormat('student[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);


     
  }
}


