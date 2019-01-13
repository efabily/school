<?php

/**
 * Student form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class EnrollForm extends BaseStudentForm
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

      $rude['rude'] = $student->getRude();
      $values = array_merge($values, $rude);

      $nro_registro['nro_registro'] = $student->getCodigo();
      $values = array_merge($values, $nro_registro);

      // Obtenemos el person del estudiante
      $person = $student->getPerson();

      // Tipo de documento
      $attribute_tipo_documento = AttributePeer::getAttributeByKeyAndPerson('tipo_documento', $person->getId());
      $estudiante_tipo_documento['estudiante_nro_documento'] = is_object($attribute_tipo_documento) ? $attribute_tipo_documento->getValue() : null;
      $values = array_merge($values, $estudiante_tipo_documento);

      // Nro de documento de identidad
      $attribute_nro_documento = AttributePeer::getAttributeByKeyAndPerson('estudiante_nro_documento', $person->getId());
      $estudiante_nro_documento['estudiante_nro_documento'] = is_object($attribute_nro_documento) ? $attribute_nro_documento->getValue() : null;
      $values = array_merge($values, $estudiante_nro_documento);

      // Pais de nacimiento
      $attribute_nacimiento_pais = AttributePeer::getAttributeByKeyAndPerson('estudiante_nacimiento_pais', $person->getId());
      $estudiante_nacimiento_pais['estudiante_nacimiento_pais'] = is_object($attribute_nacimiento_pais) ? $attribute_nacimiento_pais->getValue() : null;
      $values = array_merge($values, $estudiante_nacimiento_pais);

      // Dia
      $estudiante_fecha_nacimiento_dia['fecha_nacimiento_dia'] = $student->getBirthDate('d');
      $values = array_merge($values, $estudiante_fecha_nacimiento_dia);

      // Mes
      $estudiante_fecha_nacimiento_mes['fecha_nacimiento_mes'] = $student->getBirthDate('m');
      $values = array_merge($values, $estudiante_fecha_nacimiento_mes);

      // Anio
      $estudiante_fecha_nacimiento_anio['fecha_nacimiento_anio'] = $student->getBirthDate('Y');
      $values = array_merge($values, $estudiante_fecha_nacimiento_anio);

      // departamento de nacimiento
      $attribute_nacimiento_departamento = AttributePeer::getAttributeByKeyAndPerson('estudiante_departamento', $person->getId());
      $estudiante_nacimiento_departamento['estudiante_nacimiento_departamento'] = is_object($attribute_nacimiento_departamento) ? $attribute_nacimiento_departamento->getValue() : null;
      $values = array_merge($values, $estudiante_nacimiento_departamento);

      // email del estudiante
      $estudiante_email['estudiante_email'] = $student->getEmail();
      $values = array_merge($values, $estudiante_email);

      // provincia de nacimiento del estudiante
      $attribute_nacimiento_provincia = AttributePeer::getAttributeByKeyAndPerson('estudiante_provincia', $person->getId());
      $estudiante_nacimiento_provincia['estudiante_nacimiento_provincia'] = is_object($attribute_nacimiento_provincia) ? $attribute_nacimiento_provincia->getValue() : null;
      $values = array_merge($values, $estudiante_nacimiento_provincia);

      // localidad de nacimiento del estudiante
      $attribute_nacimiento_localidad = AttributePeer::getAttributeByKeyAndPerson('estudiante_localidad', $person->getId());
      $estudiante_nacimiento_localidad['estudiante_nacimiento_localidad'] = is_object($attribute_nacimiento_localidad) ? $attribute_nacimiento_localidad->getValue() : null;
      $values = array_merge($values, $estudiante_nacimiento_localidad);

      // localidad de nacimiento del estudiante
      $attribute_certificado_nacimiento_oficialia = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_oficialia', $person->getId());
      $certificado_nacimiento_oficialia['certificado_nacimiento_oficialia'] = is_object($attribute_certificado_nacimiento_oficialia) ? $attribute_certificado_nacimiento_oficialia->getValue() : null;
      $values = array_merge($values, $certificado_nacimiento_oficialia);

      // certificado_nacimiento_libro
      $attribute_certificado_nacimiento_libro = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_libro', $person->getId());
      $certificado_nacimiento_libro['certificado_nacimiento_libro'] = is_object($attribute_certificado_nacimiento_libro) ? $attribute_certificado_nacimiento_libro->getValue() : null;
      $values = array_merge($values, $certificado_nacimiento_libro);

      // certificado_nacimiento_partida
      $attribute_certificado_nacimiento_partida = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_partida', $person->getId());
      $certificado_nacimiento_partida['certificado_nacimiento_partida'] = is_object($attribute_certificado_nacimiento_partida) ? $attribute_certificado_nacimiento_partida->getValue() : null;
      $values = array_merge($values, $certificado_nacimiento_partida);

      // certificado_nacimiento_folio
      $attribute_certificado_nacimiento_folio = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_folio', $person->getId());
      $certificado_nacimiento_folio['certificado_nacimiento_folio'] = is_object($attribute_certificado_nacimiento_folio) ? $attribute_certificado_nacimiento_folio->getValue() : null;
      $values = array_merge($values, $certificado_nacimiento_folio);


      /**** para esto necesitamos contrato. */
      /*Obtenemos el antepenultimo contrato*/

      // $antepenultimo_periodo = PeriodPeer::ultimoPeriodoCerrado();
      // $antepenultimo_contrato = ContractPeer::getContract($student->getId(), $antepenultimo_periodo->getId());

      $antepenultimo_contrato = ContractPeer::getLastContract($student->getId());


      // estudiante_direccion_provincia
      $attribute_contract_direccion_provincia = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_provincia', $antepenultimo_contrato->getId());
      $estudiante_direccion_provincia['estudiante_direccion_provincia'] = is_object($attribute_contract_direccion_provincia) ? $attribute_contract_direccion_provincia->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_provincia);

      // estudiante_direccion_zona_villa
      $attribute_contract_direccion_zona_villa = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_zona_villa', $antepenultimo_contrato->getId());
      $estudiante_direccion_zona_villa['estudiante_direccion_zona_villa'] = is_object($attribute_contract_direccion_zona_villa) ? $attribute_contract_direccion_zona_villa->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_zona_villa);

      // estudiante_direccion_session_municipio
      $attribute_contract_direccion_session_municipio = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_session_municipio', $antepenultimo_contrato->getId());
      $estudiante_direccion_session_municipio['estudiante_direccion_session_municipio'] = is_object($attribute_contract_direccion_session_municipio) ? $attribute_contract_direccion_session_municipio->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_session_municipio);

      // estudiante_direccion_avenida_calle
      $attribute_contract_direccion_avenida_calle = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_avenida_calle', $antepenultimo_contrato->getId());
      $estudiante_direccion_avenida_calle['estudiante_direccion_avenida_calle'] = is_object($attribute_contract_direccion_avenida_calle) ? $attribute_contract_direccion_avenida_calle->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_avenida_calle);

      // estudiante_direccion_localidad_comunidad
      $attribute_contract_direccion_localidad_comunidad = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_localidad_comunidad', $antepenultimo_contrato->getId());
      $estudiante_direccion_localidad_comunidad['estudiante_direccion_localidad_comunidad'] = is_object($attribute_contract_direccion_localidad_comunidad) ? $attribute_contract_direccion_localidad_comunidad->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_localidad_comunidad);

      // estudiante_direccion_celular
      $attribute_contract_direccion_celular = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_celular', $antepenultimo_contrato->getId());
      $estudiante_direccion_celular['estudiante_direccion_celular'] = is_object($attribute_contract_direccion_celular) ? $attribute_contract_direccion_celular->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_celular);

      // estudiante_direccion_numero_vivienda
      $attribute_contract_direccion_numero_vivienda = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_numero_vivienda', $antepenultimo_contrato->getId());
      $estudiante_direccion_numero_vivienda['estudiante_direccion_numero_vivienda'] = is_object($attribute_contract_direccion_numero_vivienda) ? $attribute_contract_direccion_numero_vivienda->getValue() : null;
      $values = array_merge($values, $estudiante_direccion_numero_vivienda);

      // idioma_nines
      $question_idioma_nines = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'idioma_nines');
      $idioma_nines['idioma_nines'] = is_object($question_idioma_nines) ? $question_idioma_nines->getReply() : null;
      $values = array_merge($values, $idioma_nines);

      // idioma_habla_frecuentemente_1
      $question_idioma_habla_frecuentemente_1 = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'idioma_habla_frecuentemente_1');
      $idioma_habla_frecuentemente_1['idioma_habla_frecuentemente_1'] = is_object($question_idioma_habla_frecuentemente_1) ? $question_idioma_habla_frecuentemente_1->getReply() : null;
      $values = array_merge($values, $idioma_habla_frecuentemente_1);

      // idioma_habla_frecuentemente_2
      $question_idioma_habla_frecuentemente_2 = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'idioma_habla_frecuentemente_2');
      $idioma_habla_frecuentemente_2['idioma_habla_frecuentemente_2'] = is_object($question_idioma_habla_frecuentemente_2) ? $question_idioma_habla_frecuentemente_2->getReply() : null;
      $values = array_merge($values, $idioma_habla_frecuentemente_2);

      // idioma_habla_frecuentemente_3
      $question_idioma_habla_frecuentemente_3 = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'idioma_habla_frecuentemente_3');
      $idioma_habla_frecuentemente_3['idioma_habla_frecuentemente_3'] = is_object($question_idioma_habla_frecuentemente_3) ? $question_idioma_habla_frecuentemente_3->getReply() : null;
      $values = array_merge($values, $idioma_habla_frecuentemente_3);

      // otro_pertenece
      $question_otro_pertenece = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'otro_pertenece');
      $otro_pertenece['otro_pertenece'] = is_object($question_otro_pertenece) ? $question_otro_pertenece->getReply() : null;
      $values = array_merge($values, $otro_pertenece);

      // cuantos_dias_trabajo
      $question_cuantos_dias_trabajo = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'cuantos_dias_trabajo');
      $cuantos_dias_trabajo['cuantos_dias_trabajo'] = is_object($question_cuantos_dias_trabajo) ? $question_cuantos_dias_trabajo->getReply() : null;
      $values = array_merge($values, $cuantos_dias_trabajo);

      // padre_tutor_cedula_identidad
      $tutor_padre = TutorPeer::getTutor($student->getId(), null, 1);
      $padre_tutor_cedula_identidad['padre_tutor_cedula_identidad'] = is_object($tutor_padre) ? $tutor_padre->getCi() : null;
      $values = array_merge($values, $padre_tutor_cedula_identidad);

      //padre_tutor_apellido_paterno
      $padre_tutor_apellido_paterno['padre_tutor_apellido_paterno'] = is_object($tutor_padre) ? $tutor_padre->getFatherName() : null;
      $values = array_merge($values, $padre_tutor_apellido_paterno);

      // padre_tutor_apellido_materno
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

      // madre_apellido_paterno
      $madre_apellido_paterno['madre_apellido_paterno'] = is_object($tutor_madre) ? $tutor_madre->getFatherName() : null;
      $values = array_merge($values, $madre_apellido_paterno);

      // madre_apellido_materno
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


      // estudiante_genero
      $attribute_estudiante_genero = AttributePeer::getAttributeByKeyAndPerson('estudiante_genero', $person->getId());
      $estudiante_genero['estudiante_genero'] = is_object($attribute_estudiante_genero) ? $attribute_estudiante_genero->getValue() : null;
      $values = array_merge($values, $estudiante_genero);


      // pertenece
      $question_pertenece = QuestionPeer::getAttributeByKeyAndStudent($antepenultimo_contrato->getId(), 'pertenece');
      $pertenece['pertenece'] = is_object($question_pertenece) ? $question_pertenece->getReply() : null;
      $values = array_merge($values, $pertenece);

      // hospital
      $question_hospital = QuestionPeer::getAttributeByKeyAndStudent($antepenultimo_contrato->getId(), 'hospital');
      $hospital['hospital'] = is_object($question_hospital) ? $question_hospital->getReply() : null;
      $values = array_merge($values, $hospital);


      // hospital_veces
      $question_hospital_veces = QuestionPeer::getAttributeByKeyAndStudent($antepenultimo_contrato->getId(), 'hospital_veces');
      $hospital_veces['hospital_veces'] = is_object($question_hospital_veces) ? $question_hospital_veces->getReply() : null;
      $values = array_merge($values, $hospital_veces);


      // discapacidad_sensorial
      $question_discapacidad_sensorial = QuestionPeer::getAttributeByKeyAndStudent($antepenultimo_contrato->getId(), 'discapacidad_sensorial');
      $discapacidad_sensorial['discapacidad_sensorial'] = is_object($question_discapacidad_sensorial) ? $question_discapacidad_sensorial->getReply() : null;
      $values = array_merge($values, $discapacidad_sensorial);

      // discapacidad_motriz
      $question_discapacidad_motriz = QuestionPeer::getAttributeByKeyAndStudent($antepenultimo_contrato->getId(), 'discapacidad_motriz');
      $discapacidad_motriz['discapacidad_motriz'] = is_object($question_discapacidad_motriz) ? $question_discapacidad_motriz->getReply() : null;
      $values = array_merge($values, $discapacidad_motriz);

      // discapacidad_mental
      $question_discapacidad_mental = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'discapacidad_mental');
      $discapacidad_mental['discapacidad_mental'] = is_object($question_discapacidad_mental) ? $question_discapacidad_mental->getReply() : null;
      $values = array_merge($values, $discapacidad_mental);


      // origen_discapacidad
      $question_origen_discapacidad = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'origen_discapacidad');
      $origen_discapacidad['origen_discapacidad'] = is_object($question_origen_discapacidad) ? $question_origen_discapacidad->getReply() : null;
      $values = array_merge($values, $origen_discapacidad);

      // acceso_servicio_basico
      $question_acceso_servicio_basico = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'acceso_servicio_basico');
      $acceso_servicio_basico['acceso_servicio_basico'] = is_object($question_acceso_servicio_basico) ? $question_acceso_servicio_basico->getReply() : null;
      $values = array_merge($values, $acceso_servicio_basico);

      // energia_electrica
      $question_energia_electrica = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'energia_electrica');
      $energia_electrica['energia_electrica'] = is_object($question_energia_electrica) ? $question_energia_electrica->getReply() : null;
      $values = array_merge($values, $energia_electrica);

      // bano
      $question_bano = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'bano');
      $bano['bano'] = is_object($question_bano) ? $question_bano->getReply() : null;
      $values = array_merge($values, $bano);

      // trabajo
      $question_trabajo = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'trabajo');
      $trabajo['trabajo'] = is_object($question_trabajo) ? $question_trabajo->getReply() : null;
      $values = array_merge($values, $trabajo);

      // recibio_pago
      $question_recibio_pago = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'recibio_pago');
      $recibio_pago['recibio_pago'] = is_object($question_recibio_pago) ? $question_recibio_pago->getReply() : null;
      $values = array_merge($values, $recibio_pago);

      // accede_internet
      $question_accede_internet = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'accede_internet');
      $accede_internet['accede_internet'] = is_object($question_accede_internet) ? $question_accede_internet->getReply() : null;
      $values = array_merge($values, $accede_internet);

      // frecuencia_internet
      $question_frecuencia_internet = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'frecuencia_internet');
      $frecuencia_internet['frecuencia_internet'] = is_object($question_frecuencia_internet) ? $question_frecuencia_internet->getReply() : null;
      $values = array_merge($values, $frecuencia_internet);


      // transporte
      $question_transporte = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'transporte');
      $transporte['transporte'] = is_object($question_transporte) ? $question_transporte->getReply() : null;
      $values = array_merge($values, $transporte);


      // tiempo_transporte
      $question_tiempo_transporte = QuestionPeer::getAttributeByKeyAndStudent($student->getId(), 'tiempo_transporte');
      $tiempo_transporte['tiempo_transporte'] = is_object($question_tiempo_transporte) ? $question_tiempo_transporte->getReply() : null;
      $values = array_merge($values, $tiempo_transporte);



      $this->setDefaults(array_merge($this->getDefaults(), $values));
    }
  }




}


