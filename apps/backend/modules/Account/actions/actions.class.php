<?php

require_once dirname(__FILE__).'/../lib/AccountGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/AccountGeneratorHelper.class.php';

/**
 * Account actions.
 *
 * @package    school
 * @subpackage Account
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class AccountActions extends autoAccountActions
{
    public function preExecute()
    {
       $this->configuration = new AccountGeneratorConfiguration();

       if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
       {
	 $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
       }

       $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

       $this->helper = new AccountGeneratorHelper();

       parent::preExecute();
     }

     public function executeIndex(sfWebRequest $request)
     {
       // sorting
       if ($request->getParameter('sort') && $this->isValidSortColumn($request->getParameter('sort')))
       {
	 $this->setSort(array($request->getParameter('sort'), $request->getParameter('sort_type')));
       }

       // pager
       if ($request->getParameter('page'))
       {
	 $this->setPage($request->getParameter('page'));
       }

       $this->pager = $this->getPager();
       $this->sort = $this->getSort();
     }

     public function executeFilter(sfWebRequest $request)
     {
       $this->setPage(1);

       if ($request->hasParameter('_reset'))
       {
	 $this->setFilters($this->configuration->getFilterDefaults());

	 $this->redirect('@Account');
       }

       $this->filters = $this->configuration->getFilterForm($this->getFilters()); // new AccountFormFilter();       

       $data = $request->getParameter($this->filters->getName());            

       $this->filters->bind($data);
       	
       if ($this->filters->isValid())
       {
	 $this->setFilters($this->filters->getValues());

	 $this->redirect('@Account');
       }

       $this->pager = $this->getPager();
       $this->sort = $this->getSort();

       $this->setTemplate('index');
     }

     public function executeNew(sfWebRequest $request)
     {
	
     }

     public function executeCreate(sfWebRequest $request)
     {
	$this->form = new AccountForm();
      
	 if ($request->isMethod('POST'))
	 {
	    $data = $request->getParameter('Account');
	    $this->form->bind($data);

	       if ($this->form->isValid())
	       {
		   $con = Propel::getConnection();
		   try
		   {				     		      
		      
		      $person = PersonPeer::savePerson(2, null, $con);

		       if(is_object($person) && $person->getId() > 0)
		       {
			  
			 $birth_date = $data['fecha_nacimiento_anio'].''.$data['fecha_nacimiento_mes'].''.$data['fecha_nacimiento_dia'].'00:00:00';		      
			  
			  $Account = AccountPeer::saveAccount(2, $data['estudiante_nombre'], 
				  $data['estudiante_apellido_paterno'], 
				  $data['estudiante_apellido_materno'], $data['rude'], $data['nro_registro'], $birth_date, $data['estudiante_email'], $person->getId(), null, $con);
			  
			  $Account_id = $Account->getId();
			  
			  
			  // Atributos del estudiante
			  if(isset($data['tipo_documento']))
			  {
			    $attribute_tipo_documento = AttributePeer::saveAttribute(2, 'tipo_documento', $data['tipo_documento'], 'DOCUMENTO DE IDENTIFICACIÓN', 'DOCUMENTO DE IDENTIFICACIÓN', $person->getId(), null, $con);
			  }			  			  
			  
			  if(isset($data['estudiante_nro_documento']))
			  {
			     $attribute_nro_documento = AttributePeer::saveAttribute(2, 'estudiante_nro_documento', $data['estudiante_nro_documento'], 'No del documento de identificación', 'No del documento de identificación', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_pais']))
			  {
			     $attribute_estudiante_pais = AttributePeer::saveAttribute(2, 'estudiante_pais', $data['estudiante_pais'], 'País', 'País', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_genero']))
			  {
			     $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', $data['estudiante_genero'], 'SEXO', 'SEXO', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_departamento']))
			  {
			     $attribute_estudiante_departamento = AttributePeer::saveAttribute(2, 'estudiante_departamento', $data['estudiante_departamento'], 'Departamento', 'Departamento', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_provincia']))
			  {
			     $attribute_estudiante_provincia = AttributePeer::saveAttribute(2, 'estudiante_provincia', $data['estudiante_provincia'], 'Provincia', 'Provincia', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_localidad']))
			  {
			     $attribute_estudiante_localidad = AttributePeer::saveAttribute(2, 'estudiante_localidad', $data['estudiante_localidad'], 'Localidad', 'Localidad', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['certificado_nacimiento_oficialia']))
			  {
			     $attribute_certificado_nacimiento_oficialia = AttributePeer::saveAttribute(2, 'certificado_nacimiento_oficialia', $data['certificado_nacimiento_oficialia'], 'Oficialía No', 'Oficialía No', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['certificado_nacimiento_libro']))
			  {
			     $attribute_certificado_nacimiento_libro = AttributePeer::saveAttribute(2, 'certificado_nacimiento_libro', $data['certificado_nacimiento_libro'], 'Libro No', 'Libro No', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['certificado_nacimiento_partida']))
			  {
			     $attribute_certificado_nacimiento_partida = AttributePeer::saveAttribute(2, 'certificado_nacimiento_partida', $data['certificado_nacimiento_partida'], 'Partida No', 'Partida No', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['certificado_nacimiento_folio']))
			  {
			     $attribute_certificado_nacimiento_folio = AttributePeer::saveAttribute(2, 'certificado_nacimiento_folio', $data['certificado_nacimiento_folio'], 'Folio N', 'Folio N', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['nivel']))
			  {
			     $attribute_nivel = AttributePeer::saveAttribute(2, 'nivel', $data['nivel'], '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['paralelo']))
			  {
			     $attribute_paralelo = AttributePeer::saveAttribute(2, 'paralelo', $data['paralelo'], '3.2. PARALELO', '3.2. PARALELO', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['turno']))
			  {
			     $attribute_turno = AttributePeer::saveAttribute(2, 'turno', $data['turno'], '3.3. TURNO', '3.3. TURNO', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_direccion_provincia']))
			  {
			     $attribute_estudiante_direccion_provincia = AttributePeer::saveAttribute(2, 'estudiante_direccion_provincia', $data['estudiante_direccion_provincia'], 'Provincia', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_direccion_zona_villa']))
			  {
			     $attribute_estudiante_direccion_zona_villa = AttributePeer::saveAttribute(2, 'estudiante_direccion_zona_villa', $data['estudiante_direccion_zona_villa'], 'Zona / Villa', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_direccion_session_municipio']))
			  {
			     $attribute_estudiante_direccion_session_municipio = AttributePeer::saveAttribute(2, 'estudiante_direccion_session_municipio', $data['estudiante_direccion_session_municipio'], 'Sección / Municipio', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }			  			  
			  
			  if(isset($data['estudiante_direccion_avenida_calle']))
			  {
			     $attribute_estudiante_direccion_avenida_calle = AttributePeer::saveAttribute(2, 'estudiante_direccion_avenida_calle', $data['estudiante_direccion_avenida_calle'], 'Avenida / Calle', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  			  
			  if(isset($data['estudiante_direccion_localidad_comunidad']))
			  {
			     $attribute_estudiante_direccion_localidad_comunidad = AttributePeer::saveAttribute(2, 'estudiante_direccion_localidad_comunidad', $data['estudiante_direccion_localidad_comunidad'], 'Localidad / Comunidad', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_direccion_celular']))
			  {
			     $attribute_estudiante_direccion_celular = AttributePeer::saveAttribute(2, 'estudiante_direccion_celular', $data['estudiante_direccion_celular'], 'Teléfono/Celular', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  
			  if(isset($data['estudiante_direccion_numero_vivienda']))
			  {
			     $attribute_estudiante_direccion_numero_vivienda = AttributePeer::saveAttribute(2, 'estudiante_direccion_numero_vivienda', $data['estudiante_direccion_numero_vivienda'], 'Número de vivienda', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $person->getId(), null, $con);
			  }
			  
			  // Aspectos Sociales (Preguntas)
			  if(isset($data['idioma_nines']))
			  {
			     $question_idioma_nines = QuestionPeer::saveQuestion(2, 'idioma_nines', $data['idioma_nines'], 
				'5.1.1.¿Cuál es el idioma que aprendió a hablar en su niñez la o el estudiante?',
			        'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $Account_id, null, $con);
			  }
			  
			  if(isset($data['idioma_habla_frecuentemente_1']))
			  {
			     $question_idioma_habla_frecuentemente_1 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_1', $data['idioma_habla_frecuentemente_1'], 
				'5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
			        'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $Account_id, null, $con);
			  }
			  
			  if(isset($data['idioma_habla_frecuentemente_2']))
			  {
			     $question_idioma_habla_frecuentemente_2 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_2', $data['idioma_habla_frecuentemente_2'], 
				'5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
			        'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $Account_id, null, $con);
			  }
			  
			  if(isset($data['idioma_habla_frecuentemente_3']))
			  {
			     $question_idioma_habla_frecuentemente_3 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_3', $data['idioma_habla_frecuentemente_3'], 
				'5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
			        'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $Account_id, null, $con);
			  }
			  
			  if(isset($data['pertenece']))
			  {
			     foreach ($data['pertenece'] as $pertenece)
			     {
				$question_pertenece = QuestionPeer::saveQuestion(2, 'pertenece', $pertenece, 
				'5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
			        'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $Account_id, null, $con);
			     }
			  }
			  
			  if(isset($data['hospital']))
                          {
			     $question_hospital = QuestionPeer::saveQuestion(2, 'hospital', $data['hospital'], 
			     '5.2.1.¿Existe Centro de Salud / Posta / Hospital en su comunidad?',
			     '5.2. SALUD', $Account_id, null, $con);			     
			  }
			  
			  if(isset($data['veces']))
                          {
			     $question_veces = QuestionPeer::saveQuestion(2, 'veces', $data['veces'], 
			     '5.2.2. ¿Cuántas veces fue la o el estudiante al centro de salud el año pasado?',
			     '5.2. SALUD', $Account_id, null, $con);
			  }
			  
			  if(isset($data['discapacidad']))
                          {
			     $question_discapacidad = QuestionPeer::saveQuestion(2, 'discapacidad', $data['discapacidad'], 
			     '5.2.3. Presenta la o el estudiante alguna discapacidad ',
			     '5.2. SALUD', $Account_id, null, $con);
			  }
			  
			  if(isset($data['origen_discapacidad']))
                          {
			     $question_origen_discapacidad = QuestionPeer::saveQuestion(2, 'origen_discapacidad', $data['origen_discapacidad'], 
			     '5.2.4. Su discapacidad es:',
			     '5.2. SALUD', $Account_id, null, $con);
			  }
			  
			  if(isset($data['acceso_servicio_basico']))
                          {
			     $question_acceso_servicio_basico = QuestionPeer::saveQuestion(2, 'acceso_servicio_basico', $data['acceso_servicio_basico'], 
			     '5.3.1. El agua de su casa proviene de:',
			     '5.3. ACCESO A SERVICIOS BÁSICOS', $Account_id, null, $con);
			  }
			  
			  if(isset($data['energia_electrica']))
                          {
			     $question_energia_electrica = QuestionPeer::saveQuestion(2, 'energia_electrica', $data['energia_electrica'], 
			     '5.3.2. ¿La o el estudiante tiene energía eléctrica en su vivienda? ',
			     '5.3. ACCESO A SERVICIOS BÁSICOS', $Account_id, null, $con);
			  }
			  
			  if(isset($data['trabajo']))
                          {
			     $question_trabajo = QuestionPeer::saveQuestion(2, 'trabajo', $data['trabajo'], 
			     '5.4.1. ¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?',
			     '5.4. EMPLEO', $Account_id, null, $con);
			  }
			  
			  if(isset($data['cuantos_dias_trabajo']))
                          {
			     $question_cuantos_dias_trabajo = QuestionPeer::saveQuestion(2, 'cuantos_dias_trabajo', $data['cuantos_dias_trabajo'],
			     '5.4.2. La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante? ',
			     '5.4. EMPLEO', $Account_id, null, $con);
			  }
			  
			  if(isset($data['recibio_pago']))
                          {
			     $question_recibio_pago = QuestionPeer::saveQuestion(2, 'recibio_pago', $data['recibio_pago'],
			     '5.4.3. ¿Recibió algún pago por el trabajo realizado? ',
			     '5.4. EMPLEO', $Account_id, null, $con);
			  }
			  
			  if(isset($data['accede_internet']))
                          {
			     foreach ($data['accede_internet'] as $accede_internet)
			     {
				$question_accede_internet = QuestionPeer::saveQuestion(2, 'accede_internet', $accede_internet,
				'5.5.1. La o el estudiante accede a internet en:',
				'5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE ', $Account_id, null, $con);				
			     }			     			     
			  }
			  
			  if(isset($data['frecuencia_internet']))
                          {
			     $question_frecuencia_internet = QuestionPeer::saveQuestion(2, 'frecuencia_internet', $data['frecuencia_internet'],
			     '5.5.2. ¿Con qué frecuencia la o el estudiante accede a internet?',
			     '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $Account_id, null, $con);
			  }
			  
			  if(isset($data['transporte']))
                          {
			     $question_transporte = QuestionPeer::saveQuestion(2, 'transporte', $data['transporte'],
			     '5.5.3. ¿Cómo llega la o el estudiante a la Unidad Educativa? ',
			     '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $Account_id, null, $con);
			  }
			  
			  if(isset($data['tiempo_transporte']))
                          {
			     $question_tiempo_transporte = QuestionPeer::saveQuestion(2, 'tiempo_transporte', $data['tiempo_transporte'],
			     '5.5.4. En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?',
			     '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $Account_id, null, $con);
			  }
			  
			  // Tutores Madre
			  $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro
			  
			  $persona_madre = PersonPeer::savePerson(2, null, $con);
			  $tutor_madre = TutorPeer::saveTutor(2, 
				  $data['madre_nombre'],
				  strtoupper($this->form->getValue('madre_apellido_paterno')), 
				  strtoupper($this->form->getValue('madre_apellido_materno')),
				  $data['madre_cedula_identidad'], 
				  $data['madre_idioma_frecuente'], 
				  $data['madre_ocupacion'], 
				  $data['madre_grado_instruccion'], 
				  $data['madre_email'], 
				  $type_tutor_id,
				  $persona_madre->getId(), null, $con);
			  
			  $Account_tutor_madre = AccountTutorPeer::saveAccountTutor(2, $Account_id, $tutor_madre->getId(), null, $con);
			  
			  // Tutores
			  $type_tutor_id = 2;
			  
			  if(isset($data['padre_tutor_parentesco']))
			  {
			     $parentesco = strtoupper($data['padre_tutor_parentesco']);
			     
			     $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
			     if(!is_object($type_tutor))
			     {                              
				 $type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
			     }
			     $type_tutor_id = $type_tutor->getId();
			  }
			  
			  $persona_tutor = PersonPeer::savePerson(2, null, $con);
			  $tutor_tutor = TutorPeer::saveTutor(2, 
				  $data['padre_tutor_nombre'],
				  strtoupper($this->form->getValue('padre_tutor_apellido_paterno')), 
				  strtoupper($this->form->getValue('padre_tutor_apellido_materno')),
				  $data['padre_tutor_cedula_identidad'], 
				  $data['padre_tutor_idioma_frecuente'], 
				  $data['padre_tutor_ocupacion'], 
				  $data['padre_tutor_grado_instruccion'], 
				  $data['padre_email'], 
				  $type_tutor_id,
				  $persona_tutor->getId(), null, $con);
			  
			  $Account_tutor = AccountTutorPeer::saveAccountTutor(2, $Account_id, $tutor_tutor->getId(), null, $con);
			  
			  // Cuenta			  
			  $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];
			  
			  $period = PeriodPeer::getPeriod(2);
			  
			  $account = AccountPeer::saveAccount(2, $fecha_registro, $data['lugar_registro'], $Account_id, $period->getId(), null, $con);
			  
			  			  
			  $con->commit();
			  $this->getUser()->setFlash('notice', 'Creo con exito un nuevo estudiante', false);
		       }
		   } catch (exception $e) {
		       $con->rollback();
		       throw $e;
		       $this->getUser()->setFlash('error', $e, false);
		   }
	       } else {
		   $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
	       }
	 }
	
       $this->setTemplate('new');
     }

     public function executeEdit(sfWebRequest $request)
     {         
       $this->Account = AccountPeer::retrieveByPK($request->getParameter('id'));
       $this->form = new AccountEditForm($this->Account);
     }

     public function executeUpdate(sfWebRequest $request)
     {
       $this->Account = $this->getRoute()->getObject();
       $this->form = $this->configuration->getForm($this->Account);

       $this->processForm($request, $this->form);

       $this->setTemplate('edit');
     }

     public function executeDelete(sfWebRequest $request)
     {
       $request->checkCSRFProtection();

       $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));

       $this->getRoute()->getObject()->delete();

       $this->getUser()->setFlash('notice', 'The item was deleted successfully.');

       $this->redirect('@Account');
     }

     public function executeBatch(sfWebRequest $request)
     {
       $request->checkCSRFProtection();

       if (!$ids = $request->getParameter('ids'))
       {
	 $this->getUser()->setFlash('error', 'You must at least select one item.');

	 $this->redirect('@Account');
       }

       if (!$action = $request->getParameter('batch_action'))
       {
	 $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

	 $this->redirect('@Account');
       }

       if (!method_exists($this, $method = 'execute'.ucfirst($action)))
       {
	 throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
       }

       if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
       {
	 $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
       }

       $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Account'));
       try
       {
	 // validate ids
	 $ids = $validator->clean($ids);

	 // execute batch
	 $this->$method($request);
       }
       catch (sfValidatorError $e)
       {
	 $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items as some items do not exist anymore.');
       }

       $this->redirect('@Account');
     }

     protected function executeBatchDelete(sfWebRequest $request)
     {
       $ids = $request->getParameter('ids');

       $count = 0;
       foreach (AccountPeer::retrieveByPks($ids) as $object)
       {
	 $this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $object)));

	 $object->delete();
	 if ($object->isDeleted())
	 {
	   $count++;
	 }
       }

       if ($count >= count($ids))
       {
	 $this->getUser()->setFlash('notice', 'The selected items have been deleted successfully.');
       }
       else
       {
	 $this->getUser()->setFlash('error', 'A problem occurs when deleting the selected items.');
       }

       $this->redirect('@Account');
     }

     protected function processForm(sfWebRequest $request, sfForm $form)
     {
       $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
       if ($form->isValid())
       {
	 $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

	 $Account = $form->save();

	 $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Account)));

	 if ($request->hasParameter('_save_and_add'))
	 {
	   $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

	   $this->redirect('@Account_new');
	 }
	 else
	 {
	   $this->getUser()->setFlash('notice', $notice);

	   $this->redirect(array('sf_route' => 'Account_edit', 'sf_subject' => $Account));
	 }
       }
       else
       {
	 $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
       }
     }

     protected function getFilters()
     {
       return $this->getUser()->getAttribute('Account.filters', $this->configuration->getFilterDefaults(), 'admin_module');
     }

     protected function setFilters(array $filters)
     {
       return $this->getUser()->setAttribute('Account.filters', $filters, 'admin_module');
     }

     protected function getPager()
     {
       $pager = $this->configuration->getPager('Account');
       $pager->setCriteria($this->buildCriteria());
       $pager->setPage($this->getPage());
       $pager->setPeerMethod($this->configuration->getPeerMethod());
       $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
       $pager->init();

       return $pager;
     }

     protected function setPage($page)
     {
       $this->getUser()->setAttribute('Account.page', $page, 'admin_module');
     }

     protected function getPage()
     {
       return $this->getUser()->getAttribute('Account.page', 1, 'admin_module');
     }

     protected function buildCriteria()
     {
       if (null === $this->filters)
       {
	 $this->filters = $this->configuration->getFilterForm($this->getFilters());
       }

       $criteria = $this->filters->buildCriteria($this->getFilters());

       $this->addSortCriteria($criteria);

       $event = $this->dispatcher->filter(new sfEvent($this, 'admin.build_criteria'), $criteria);
       $criteria = $event->getReturnValue();

       return $criteria;
     }

     protected function addSortCriteria($criteria)
     {
       if (array(null, null) == ($sort = $this->getSort()))
       {
	 return;
       }

       $column = AccountPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
       if ('asc' == $sort[1])
       {
	 $criteria->addAscendingOrderByColumn($column);
       }
       else
       {
	 $criteria->addDescendingOrderByColumn($column);
       }
     }

     protected function getSort()
     {
       if (null !== $sort = $this->getUser()->getAttribute('Account.sort', null, 'admin_module'))
       {
	 return $sort;
       }

       $this->setSort($this->configuration->getDefaultSort());

       return $this->getUser()->getAttribute('Account.sort', null, 'admin_module');
     }

     protected function setSort(array $sort)
     {
       if (null !== $sort[0] && null === $sort[1])
       {
	 $sort[1] = 'asc';
       }

       $this->getUser()->setAttribute('Account.sort', $sort, 'admin_module');
     }

     protected function isValidSortColumn($column)
     {
       return in_array($column, BasePeer::getFieldnames('Account', BasePeer::TYPE_FIELDNAME));
     }
  
}


