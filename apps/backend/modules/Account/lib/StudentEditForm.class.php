<?php

/**
 * Student form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class StudentEditForm extends BaseStudentForm
{
  public function configure()
  {
     
     $this->setWidgets(array(            
      'estudiante_nombre'  => new sfWidgetFormInputText(),
      'estudiante_apellido_paterno' => new sfWidgetFormInputText(),
      'estudiante_apellido_materno' => new sfWidgetFormInputText(),
      'rude'        => new sfWidgetFormInputText(),
//      'nro_registro'      => new sfWidgetFormInputText(),     
      'estudiante_nro_documento'  => new sfWidgetFormInputText(),
      'estudiante_pais' => new sfWidgetFormInputText(),
      'fecha_nacimiento_dia' => new sfWidgetFormInputText(),
      'fecha_nacimiento_mes' => new sfWidgetFormInputText(), 
      'fecha_nacimiento_anio' => new sfWidgetFormInputText(),       
      'estudiante_departamento' => new sfWidgetFormInputText(),
      'estudiante_email' => new sfWidgetFormInputText(),
      'estudiante_provincia' => new sfWidgetFormInputText(),
      'estudiante_localidad' => new sfWidgetFormInputText(),
      'certificado_nacimiento_oficialia' => new sfWidgetFormInputText(),
      'certificado_nacimiento_libro' => new sfWidgetFormInputText(),
      'certificado_nacimiento_partida' => new sfWidgetFormInputText(),
      'certificado_nacimiento_folio' => new sfWidgetFormInputText(),
      'estudiante_direccion_provincia' => new sfWidgetFormInputText(),
      'estudiante_direccion_zona_villa' => new sfWidgetFormInputText(),
      'estudiante_direccion_session_municipio' => new sfWidgetFormInputText(),
      'estudiante_direccion_avenida_calle' => new sfWidgetFormInputText(),
      'estudiante_direccion_localidad_comunidad' => new sfWidgetFormInputText(),
      'estudiante_direccion_celular' => new sfWidgetFormInputText(),
      'estudiante_direccion_numero_vivienda' => new sfWidgetFormInputText(),
      'idioma_nines' => new sfWidgetFormInputText(),
      'idioma_habla_frecuentemente_1' => new sfWidgetFormInputText(),
      'idioma_habla_frecuentemente_2' => new sfWidgetFormInputText(),
      'idioma_habla_frecuentemente_3' => new sfWidgetFormInputText(),
      'otro_pertenece' => new sfWidgetFormInputText(),
      'cuantos_dias_trabajo' => new sfWidgetFormInputText(),
      'padre_tutor_cedula_identidad' => new sfWidgetFormInputText(),
      'madre_cedula_identidad' => new sfWidgetFormInputText(),
      'padre_tutor_apellidos' => new sfWidgetFormInputText(),
      'madre_apellidos' => new sfWidgetFormInputText(),
      'padre_tutor_nombre' => new sfWidgetFormInputText(),
      'madre_nombre' => new sfWidgetFormInputText(),
      'padre_tutor_idioma_frecuente' => new sfWidgetFormInputText(),
      'madre_idioma_frecuente' => new sfWidgetFormInputText(),
      'padre_tutor_ocupacion' => new sfWidgetFormInputText(),
      'madre_ocupacion' => new sfWidgetFormInputText(),
      'padre_tutor_grado_instruccion' => new sfWidgetFormInputText(),
      'madre_grado_instruccion' => new sfWidgetFormInputText(),
      'padre_tutor_parentesco' => new sfWidgetFormInputText(),
      'madre_email' => new sfWidgetFormInputText(),
      'padre_email' => new sfWidgetFormInputText(),
    ));
     
    $this->setValidators(array(      
      'estudiante_nombre'  => new sfValidatorString(array('max_length' => 100)),
      'estudiante_apellido_paterno' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_apellido_materno' => new sfValidatorString(array('max_length' => 100)),
      'rude'        => new sfValidatorString(array('max_length' => 100)),
      // 'nro_registro'      => new sfValidatorString(array('max_length' => 100)),      
      'estudiante_nro_documento'      => new sfValidatorString(array('max_length' => 100)),
      'estudiante_pais'      => new sfValidatorString(array('max_length' => 100)),
      'fecha_nacimiento_dia' => new sfValidatorString(array('max_length' => 100)),
      'fecha_nacimiento_mes' => new sfValidatorString(array('max_length' => 100)),
      'fecha_nacimiento_anio' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_departamento' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_email' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_provincia' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_localidad' => new sfValidatorString(array('max_length' => 100)),
      'certificado_nacimiento_oficialia' => new sfValidatorString(array('max_length' => 100)),
      'certificado_nacimiento_libro' => new sfValidatorString(array('max_length' => 100)),
      'certificado_nacimiento_partida' => new sfValidatorString(array('max_length' => 100)),
      'certificado_nacimiento_folio' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_provincia' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_zona_villa' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_session_municipio' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_avenida_calle' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_localidad_comunidad' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_celular' => new sfValidatorString(array('max_length' => 100)),
      'estudiante_direccion_numero_vivienda' => new sfValidatorString(array('max_length' => 100)),
      'idioma_nines' => new sfValidatorString(array('max_length' => 100)),
      'idioma_habla_frecuentemente_1' => new sfValidatorString(array('max_length' => 100)),
      'idioma_habla_frecuentemente_2' => new sfValidatorString(array('max_length' => 100)),
      'idioma_habla_frecuentemente_3' => new sfValidatorString(array('max_length' => 100)),
      'otro_pertenece' => new sfValidatorString(array('max_length' => 100)),
      'cuantos_dias_trabajo' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_cedula_identidad' => new sfValidatorString(array('max_length' => 100)),
      'madre_cedula_identidad' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_apellidos' => new sfValidatorString(array('max_length' => 100)),      
      'madre_apellidos' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_nombre' => new sfValidatorString(array('max_length' => 100)),
      'madre_nombre' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_idioma_frecuente' => new sfValidatorString(array('max_length' => 100)),
      'madre_idioma_frecuente' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_ocupacion' => new sfValidatorString(array('max_length' => 100)),
      'madre_ocupacion' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_grado_instruccion' => new sfValidatorString(array('max_length' => 100)),
      'madre_grado_instruccion' => new sfValidatorString(array('max_length' => 100)),
      'padre_tutor_parentesco' => new sfValidatorString(array('max_length' => 100)),
      'madre_email' => new sfValidatorString(array('max_length' => 100)),
      'padre_email' => new sfValidatorString(array('max_length' => 100)),
    ));
     
    
     // Tipo de documento
    $this->widgetSchema['tipo_documento'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => array('estudiante_ci' => 'C.I.', 'estudiante_pasaporte' => 'Pasaporte'),));
    $this->validatorSchema['tipo_documento'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
     // genero
    $this->widgetSchema['estudiante_genero'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => array(1 => 'Femenino', 2 => 'Masculino'),));
    $this->validatorSchema['estudiante_genero'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    $array_nivel = array(
	'Inicial' => array('1' => '1º', '2' => '2º'),
	'Primaria' => array('1' => '1º', '2' => '2º', '3' => '3º', '4' => '4º', '5' => '5º', '6' => '6º'),
	'Secundaria' => array('1' => '1º', '2' => '2º', '3' => '3º', '4' => '4º', '5' => '5º', '6' => '6º')
    );
    
    // nivel
    $this->widgetSchema['nivel'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_nivel));
    $this->validatorSchema['nivel'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));        
    
    
    $array_paralelo = array('a' => 'A', 'b' => 'B',
			    'c' => 'C', 'd' => 'D',
			    'e' => 'E', 'f' => 'F',
	                    'g' => 'G', 'h' => 'H',
			    'i' => 'I', 'j' => 'J',
			    'k' => 'K', 'l' => 'L'			    
    );    
    
    // paralelo
    $this->widgetSchema['paralelo'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_paralelo));
    $this->validatorSchema['paralelo'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    $array_turno = array('1' => 'M', '2' => 'T', '3' => 'N');
    
    // turno
    $this->widgetSchema['turno'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_turno));
    $this->validatorSchema['turno'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    
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
    
    // pertenece
    $this->widgetSchema['pertenece'] = new sfWidgetFormChoice(array('expanded' => true, 'multiple' => true,'choices'  => $array_pertenece));
    $this->validatorSchema['pertenece'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_hospital = array(
	'1' => 'SI', '2' => 'NO'
    );
    
    // pertenece
    $this->widgetSchema['hospital'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_hospital));
    $this->validatorSchema['hospital'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));    
    
    $array_veces = array(	
	'veces_1_a_2' => '1 a 2 veces', 'veces_3_a_5' => '3 a 5 veces', 'veces_6_mas' => '6 o más veces', 'ninguna' => 'ninguna'
    );
        
    // pertenece
    $this->widgetSchema['veces'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_veces));
    $this->validatorSchema['veces'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    $array_discapacidad = array(
	'Sensorial y de la comunicación' => array('si' => 'Si', 'no' => 'No'),
	'Motriz' => array('si' => 'Si', 'no' => 'No'),
	'Mental' => array('si' => 'Si', 'no' => 'No')	
    );    
    
    // pertenece
    $this->widgetSchema['discapacidad'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_discapacidad));
    $this->validatorSchema['discapacidad'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_origen_discapacidad = array(
	'nacimiento' => 'De nacimiento',
	'adquirida' => 'Adquirida',
	'hereditaria' => 'Hereditaria',
	'origen_discapacidad_otro' => 'Otro',
    );
    
    $this->widgetSchema['origen_discapacidad'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_origen_discapacidad));
    $this->validatorSchema['origen_discapacidad'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_acceso_servicio_basico = array(
	'caneria_red' => 'Cañería de red',
	'pileta_publica' => 'Pileta pública',
	'carro_repartidor' => 'Carro repartidor (aguatero)',
	'pozo' => 'Pozo (con o sin bomba)',
	'rio_vertiente' => 'Río, vertiente, acequia, lago, laguna, curiche',
	'otra' => 'Otra',
     );
    
    $this->widgetSchema['acceso_servicio_basico'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_acceso_servicio_basico));
    $this->validatorSchema['acceso_servicio_basico'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_energia_electrica = array(
	'si' => 'Si', 'no' => 'No'
     );
    
    $this->widgetSchema['energia_electrica'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_energia_electrica));
    $this->validatorSchema['energia_electrica'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_bano = array(
	'alcantarillado' => 'Alcantarillado', 
	'camara_septica' => 'Cámara séptica',
	'pozo_ciego' => 'Pozo ciego',
	'calle' => 'A la calle',
	'quebrada_rio' => 'A quebrada, río lago, laguna, curiche',
     );
    
    
    $this->widgetSchema['bano'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_bano));
    $this->validatorSchema['bano'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
            
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
    
    $this->widgetSchema['trabajo'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_trabajo));
    $this->validatorSchema['trabajo'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    $array_recibio_pago = array(
	'si' => 'Si', 'no' => 'No'
     );
    
    $this->widgetSchema['recibio_pago'] = new sfWidgetFormChoice(array('expanded' => true,'choices'  => $array_recibio_pago));
    $this->validatorSchema['recibio_pago'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_accede_internet = array(
	'domicilio' => 'Su domicilio', 
	'unidad_educativa' => 'En la Unidad Educativa',
	'lugares_publicos' => 'Lugares públicos',
	'no_accede' => 'Lugares públicos',
     );
    
    $this->widgetSchema['accede_internet'] = new sfWidgetFormChoice(array('expanded' => true, 'multiple' => true, 'choices'  => $array_accede_internet));
    $this->validatorSchema['accede_internet'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
                
    $array_frecuencia_internet = array(
	'diariamente' => 'Diariamente', 
	'mas_1_semana' => 'Más de una vez a la semana',
	'una_mes' => 'Una vez al mes o menos'
     );
    
    $this->widgetSchema['frecuencia_internet'] = new sfWidgetFormChoice(array('expanded' => true,'choices' => $array_frecuencia_internet));
    $this->validatorSchema['frecuencia_internet'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    $array_transporte = array(
	'a_pie' => 'A pie', 
	'transporte_terrestre' => 'En vehículo de transporte terrestre',
	'otro_medio' => 'Otro medio'
     );
    
    $this->widgetSchema['transporte'] = new sfWidgetFormChoice(array('expanded' => true,'choices' => $array_transporte));
    $this->validatorSchema['transporte'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    $array_tiempo_transporte = array(
	'menos_media_hora' => 'Menos de media hora', 
	'entre_media_hora_y_una' => 'Entre media hora y una hora',
	'entre_una_a_dos_hora' => 'Entre una a dos horas',
	'dos_hora_o_mas' => 'Dos horas o más'
     );
    
    $this->widgetSchema['tiempo_transporte'] = new sfWidgetFormChoice(array('expanded' => true,'choices' => $array_tiempo_transporte));
    $this->validatorSchema['tiempo_transporte'] = new sfValidatorInteger(array('min' => 0, 'max' => 2147483647), 
                                                        array('required' => 'Obligatorio.', 'invalid' => '"%value%" no es un numero entero.'));
    
    
    // estudiante_genero
    $this->widgetSchema->setNameFormat('student[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

//    parent::setup();
     
  }
  
  
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    
    // Obtengo el objeto
    $student = $this->getObject(); 
    
    if (is_object($student))
    {
      $values = array();
      
      // Obtengo el identificador de la entidad actual
      $business_entity_id = sfContext::getInstance()->getUser()->getAttribute('business_entity');
    
      // Verificamos si el usuario tiene asignado el grupo  de permiso administrador activo
      $sf_guard_user_group_adm = sfGuardUserGroupPeer::getSfGuardUserGroupByUserIdAndGroupId($sf_guard_user->getId(), 2, 1, $business_entity_id);
    
      $aAdm = array();
      if(is_object($sf_guard_user_group_adm))
      {
        $aAdm = array(1 => 'Administrador');   
      }
    
      $values_adm['adm'] = $aAdm;
      $values = array_merge($values, $values_adm);
                  
      $type_id = null;
      
      // Para verificar si tiene el rol especialista
      $user_profile_user_attribute = UserProfileUserAttributePeer::getRole($sf_guard_user->getId(), 4, 1, $business_entity_id);   

      if(is_object($user_profile_user_attribute))
      {
         $type_id = 1;        
      } else {
        // Para verificar si tiene el rol especialista
        $user_profile_user_attribute = UserProfileUserAttributePeer::getRole($sf_guard_user->getId(), 5, 1, $business_entity_id);

        if(is_object($user_profile_user_attribute))
        {
            $type_id = 2;            
        }
      }
      
      $values_type['type'] = $type_id;
      $values = array_merge($values, $values_type);
      
      // Aqui obtenemos los cubiculos que tiene asignado este usuario
      $cubicle_users = CubicleUserPeer::getCubicleUserByUserId($sf_guard_user->getId(), $business_entity_id);
      $aC = array();
      foreach ($cubicle_users as $cubicle_user) {
        $c = $cubicle_user->getCubicle();
        $aC[$cubicle_user->getCubicleId()] = $c->getName();
      }
      
      $values_cubicle['cubicle'] = array_keys($aC);
      $values = array_merge($values, $values_cubicle);                                                
                              
      // Obtengo el profile del usuario actual
      $sf_guard_user_profile = sfGuardUserProfilePeer::getSfGuardUserProfileByUserId($sf_guard_user->getId());
      
      $values_first_name['first_name'] = $sf_guard_user_profile->getFirstName();
      $values = array_merge($values, $values_first_name);
      
      $values_last_name['last_name'] = $sf_guard_user_profile->getLastName();
      $values = array_merge($values, $values_last_name);
    
      $client = $sf_guard_user_profile->getClient();
    
      $identity_document = IdentityDocumentPeer::getIdentityDocumentByClientId($client->getId());
    
      // Si tiene el tipo de atributo sexo asignado
      $client_attribute = ClientAttributePeer::getSexByClient($client->getId());      
      
      $values_document_identity['document_identity'] = is_object($identity_document) ? $identity_document->getNumber() : '';
      $values = array_merge($values, $values_document_identity);
      
      $values_sex['sex'] = is_object($client_attribute) ? $client_attribute->getId() : null;
      $values = array_merge($values, $values_sex);

      $values_sex['sex'] = is_object($client_attribute) ? $client_attribute->getId() : null;
      $values = array_merge($values, $values_sex);

      $values_username['username'] = $sf_guard_user->getUserName();
      $values = array_merge($values, $values_username);

      $this->setDefaults(array_merge($this->getDefaults(), $values));      
    }
  }
  
  
  
  
}


