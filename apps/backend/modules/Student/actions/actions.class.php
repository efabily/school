<?php

require_once dirname(__FILE__).'/../lib/StudentGeneratorConfiguration.class.php';
require_once dirname(__FILE__).'/../lib/StudentGeneratorHelper.class.php';

/**
 * Student actions.
 *
 * @package    school
 * @subpackage Student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class StudentActions extends autoStudentActions
{
    public function preExecute()
    {
       $this->configuration = new StudentGeneratorConfiguration();

       if (!$this->getUser()->hasCredential($this->configuration->getCredentials($this->getActionName())))
       {
	 $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
       }

       $this->dispatcher->notify(new sfEvent($this, 'admin.pre_execute', array('configuration' => $this->configuration)));

       $this->helper = new StudentGeneratorHelper();

       parent::preExecute();
     }

     function executeChooseTutor(sfWebRequest $request)
     {
        // the contract id
        $id = $request->getParameter('contract');
        $do = $request->getParameter('do');

        $this->do = $do;
        $this->contract = $id;

        $arr = TutorPeer::getTutors($id);

        if(!$arr)
        {
            $this->redirect('/Student');
            exit;
        }

        if(1 == count($arr))
        {
           $tutor = $arr['0']->getId();

           $this->redirect("/Student/contract/id/$id/do/$do/tutor/$tutor");
           exit;
        }

        $n0 = $arr['0']->getFatherName() . $arr['0']->getMotherName() . $arr['0']->getFirstName();
        $n1 = $arr['1']->getFatherName() . $arr['1']->getMotherName() . $arr['1']->getFirstName();

        if(empty($n0))
        {
           $tutor = $arr['1']->getId();
           $this->redirect("/Student/contract/id/$id/do/$do/tutor/$tutor");
           exit;
        }

        if(empty($n1))
        {
           $tutor = $arr['0']->getId();
           $this->redirect("/Student/contract/id/$id/do/$do/tutor/$tutor");
           exit;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST')
        {
            $tutor = @$_POST['tutor'];
            $this->redirect("/Student/contract/id/$id/do/$do/tutor/$tutor");
            exit;
        }

        $this->rowset = $arr;
     }

     public function executeContract(sfWebRequest $request)
     {
         $id = $request->getParameter('id');
         $do = $request->getParameter('do');
         $tutor = $request->getParameter('tutor');

         if($do != 'display' && $do != 'new' && $do != 'create')
            exit;

         $this->to_print = false;

         switch($do)
         {
            case 'new':
            case 'create':
               if(!$tutor)
               {
                  $this->redirect("/Student/ChooseTutor/do/$do/contract/$id");
                  exit;
               }
               else
               {
                  $contract = ContractPeer::retrieveByPK($id);
                  $nro = $contract->getNro();
                  $exploded = explode('-', $contract->getCreatedAt());
                  $mid = 1;



                  if(!empty($nro) && $nro != 1)
                  {
                     $explode2 = explode('-', $nro);
                     $mid = $explode2[1] + 1;
                  }

                  $contract_nro = "{$exploded['0']}-$mid-{$contract->getId()}";

                  $contract->setNro($contract_nro);
                  $contract->save();


		  $contract = ContractPeer::retrieveByPK($id);

		  $c = contrato::get($id, $tutor);
		  $contract->setContainer($c);
		  $contract->save();


               }

               $this->to_print = true;
            break;
         }

         $contract = ContractPeer::retrieveByPK($id);
         $this->contenido = $contract->getContainer();
     }

     public function executeIndex(sfWebRequest $request)
     {
	if(!$this->getUser()->getAttribute('period'))
	{
	   $period = PeriodPeer::lastPeriod();
	   if(is_object($period))
	   {
	       $default = $period->getId();
	       $this->getUser()->setAttribute('period', $default);
	       $this->getUser()->setCulture('es_ES');
	   } else {
	       $this->getUser()->setFlash('error', "No tiene periodo escolar activo", false);
	   }
	}

	// Pasamos el periodo con el que estamos trabajando a la plantilla
	$this->period_id = $this->getUser()->getAttribute('period');

	// Tras que el usuario ingresa al sistema se le abre una caja
	//Verificamos si hay caja abierta, sino se abre una caja para el usuario actual
        $cashbox = CashBoxPeer::getCashbox($this->getUser()->getId());



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

	 $this->redirect('@student');
       }

       $this->filters = $this->configuration->getFilterForm($this->getFilters()); // new StudentFormFilter();

       $data = $request->getParameter($this->filters->getName());

       $this->filters->bind($data);

       if ($this->filters->isValid())
       {
	 $this->setFilters($this->filters->getValues());

	 $this->redirect('@student');
       }

       $this->pager = $this->getPager();
       $this->sort = $this->getSort();

       $this->setTemplate('index');
     }

     public function executeNew(sfWebRequest $request)
     {
       $this->form = new StudentForm();

     }

     public function executeRecordShort(sfWebRequest $request)
     {
       $this->form = new RecordShortForm();
     }

     public function executeEnroll(sfWebRequest $request)
     {

		$student = StudentPeer::retrieveByPK($request->getParameter('id'));

		if(is_object($student))
		{
		   $this->id = $student->getId();

		   $this->form = new EnrollForm($student);
		}
     }

     public function executeRecordShortEnroll(sfWebRequest $request)
     {
		$this->Student = StudentPeer::retrieveByPK($request->getParameter('id'));

		if(is_object($this->Student))
		{
		   $this->id = $this->Student->getId();

		   $this->form = new RecordShortEnrollForm($this->Student);
		}
     }

     public function executeAccount(sfWebRequest $request)
     {
       if($request->getParameter('period_id'))
       {
	   		$this->contract = ContractPeer::getContract($request->getParameter('id'), $request->getParameter('period_id'));
       } else {
      	   $this->contract = ContractPeer::getContract($request->getParameter('id'), $this->getUser()->getAttribute('period'));
       }

       if(is_object($this->contract))
       {
          $this->has_contract = false;
          if($this->contract->getContainer() != '')
            $this->has_contract = true;

	        $this->student = $this->contract->getStudent();

	        $a_contract_grade = $this->contract->getContractGrade();

	        $this->turno = $a_contract_grade['turno'];
	        $this->ciclo = $a_contract_grade['ciclo'];
	        $this->nivel = $a_contract_grade['curso'];

			// HASTA EL 31-12-2013
	        // $this->contracts = ContractPeer::getAllContracts($this->student->getId(), $this->getUser()->getAttribute('period'));

	        $this->contracts = ContractPeer::getAllContractsDistintCurrent($this->student->getId());


	        // Descuento disponible
	        $this->discount_contract = DiscountContractPeer::getDiscountByContract($this->contract->getId(), 2);// Contracto activo

	        $period = PeriodPeer::getPeriod(2);

	        $this->deposit = DepositPeer::getDeposit(1, $this->contract->getId(), $this->getUser()->getId());
       }

     }

     public function executeAddDiscount(sfWebRequest $request)
     {
	$this->contract_id = $request->getParameter('contract_id');

	$this->discount_contract = DiscountContractPeer::getDiscountByContract($this->contract_id, 2);

	$this->discounts = DiscountPeer::getDiscounts(2);
     }

     public function executeAddUpdate(sfWebRequest $request)
     {
       $con = Propel::getConnection();
	 try {

                $con->beginTransaction(); // start the transaction

                $this->contract_id = $request->getParameter('contract_id');

                $discount_id = $request->getParameter('discount_id');

                $this->discount_contract = DiscountContractPeer::getDiscountByContract($this->contract_id, 2);

                if(is_object($this->discount_contract))
                {// si ya tenia un descuento asignado

		   if($discount_id > 0)
		   {// Si esta cambiando de descuento
			$this->discount_contract->setDiscountId($discount_id);
			$this->discount_contract->setIdState(2);
			$this->discount_contract->save($con);
			$this->discount_contract->updateSales(1, $con);
		   } else {
		      // Si esta quitando el descuento
		      $this->discount_contract->setIdState(3);
		      $this->discount_contract->save($con);
		      $this->discount_contract->updateSales(null, $con);
		   }
                } else {
		   if($discount_id > 0)
		   {
		       $this->discount_contract = new DiscountContract();
		       $this->discount_contract->setContractId($this->contract_id);
		       $this->discount_contract->setDiscountId($discount_id);
		       $this->discount_contract->setIdState(2);
		       $this->discount_contract->save($con);
		       $this->discount_contract->updateSales(1, $con);
		   }
                }

                $con->commit();
        } catch (exception $e) {
	    $con->rollback();
	    throw $e;
	    $this->getUser()->setFlash('error', "Se genero un problema comuniquese con el adm. $e", false);
	}

     }


     public function executeListDiscount(sfWebRequest $request)
     {
	$this->contract_id = $request->getParameter('contract_id');
	$this->discount_contract = DiscountContractPeer::getDiscountByContract($request->getParameter('contract_id'), 2);
     }

     public function executeAddItem(sfWebRequest $request)
     {
	 $con = Propel::getConnection();
	 try {

	    $con->beginTransaction(); // start the transaction

	    $this->contract = ContractPeer::retrieveByPK($request->getParameter('idc'));

	    if(is_object($this->contract))
	    {

	       $item = ItemPeer::retrieveByPK($request->getParameter('id'));

	       if(is_object($item))
	       {
		  $r = true;
		  if($item->getQuantityLoad() > 0)
		  {
		     // Verifico si el item que se intenta agregar es de tipo mensualidad de colegio (type item = 2)
		     if($item->getTypeItemId() == 2) // Es de tipo mensualidad
		     {
			// Verifico si este contrato ya tiene un item de tipo mensualidad agregado
			$item_for_sale = ItemForSalePeer::getMensualidad($this->contract->getId());

			if(is_object($item_for_sale))
			{
			   $this->getUser()->setFlash('error', 'Este alumno ya tiene la mensualidad asignada para esta gestión');
			   $r = false;
			}
		     }

		     if($r)
		     {
			$quantity_load = $item->getQuantityLoad();
			$a_name_load = json_decode($item->getNameLoad(), 1);
			if($quantity_load == count($a_name_load))
			{
			   foreach ($a_name_load as $key => $value) {

			      $account = AccountPeer::getAccount(1, $value, $key, $this->contract->getId());

			      if(is_object($account) && $account->getIdState() == 1)
			      {
				 if($item->getTypeItemId() == 2)
				 {// Si es mensualidad
				    // verifico si la cuenta ya tiene un item de tipo mensualidad asigando
				    $item_for_sale = ItemForSalePeer::getMensualidadByAccountId($account->getId());

				    if(!is_object($item_for_sale))
				    {
				       $sales = new Sales();
				       $sales->setIdState(2);
				       $sales->setNumber(1);
				       $sales->setCashierId($this->getUser()->getId());
				       $sales->save($con);

				       $item_for_sale = new ItemForSale();
				       $item_for_sale->setSalesId($sales->getId());
				       $item_for_sale->setItemId($item->getId());
				       $item_for_sale->setName($item->getName());

				       $price = $item->getPrice();

				       $quantity = 1;

				       $item_for_sale->setPrice($item_for_sale->getAveragePrice($price, $quantity));

				       $item_for_sale->setQuantity($item_for_sale->getQuantity() + $quantity);

				       if ($item_for_sale->getDeleted() > $quantity)
				       {
					  $item_for_sale->setDeleted($item_for_sale->getDeleted() - $quantity);
				       } else {
					  $item_for_sale->setDeleted(0);
				       }

				       $item_for_sale->save($con);

				       $sales_account = new SaleAccount();
				       $sales_account->setAmount($sales->getTotalPrice());
				       $sales_account->setAccountId($account->getId());
				       $sales_account->setSalesId($sales->getId());
				       $sales_account->setIdState(1); // 1 = Cargado a cuenta, 2 = Cargado a cuenta y pagado 3 = cargado venta directa, 4 = cargado venta directa y pagado, 5 = anulado, 6 = eliminado
				       $sales_account->save($con);

				    }

				 } else {
				       // Si no es mensualidad
				       $sales = new Sales();
				       $sales->setIdState(2);
				       $sales->setNumber(1);
				       $sales->setCashierId($this->getUser()->getId());
				       $sales->save($con);

				       $item_for_sale = new ItemForSale();
				       $item_for_sale->setSalesId($sales->getId());
				       $item_for_sale->setItemId($item->getId());
				       $item_for_sale->setName($item->getName());

				       $price = $item->getPrice();

				       $quantity = 1;

				       $item_for_sale->setPrice($item_for_sale->getAveragePrice($price, $quantity));

				       $item_for_sale->setQuantity($item_for_sale->getQuantity() + $quantity);

				       if ($item_for_sale->getDeleted() > $quantity)
				       {
					  $item_for_sale->setDeleted($item_for_sale->getDeleted() - $quantity);
				       } else {
					  $item_for_sale->setDeleted(0);
				       }

				       $item_for_sale->save($con);

				       $sales_account = new SaleAccount();
				       $sales_account->setAmount($sales->getTotalPrice());
				       $sales_account->setAccountId($account->getId());
				       $sales_account->setSalesId($sales->getId());
				       $sales_account->setIdState(1); // 1 = Cargado a cuenta, 2 = Cargado a cuenta y pagado 3 = cargado venta directa, 4 = cargado venta directa y pagado, 5 = anulado, 6 = eliminado
				       $sales_account->save($con);
				 }

			      } else {
				 // Lanzamos excepcion
			      }
			   }

			   $con->commit();
			}
		     }
		   } else {// Si es un  item que no se paga de manera mensualizada
		      // Identificamos el mes en curso.

		      $arr_month = ZendDate::getZendCurrentMonth();
		      $mth = $arr_month[0];
		      $month = $arr_month[1];

		      $account = AccountPeer::getAccount(1, $month, $mth, $this->contract->getId());

		      if(is_object($account) && $account->getIdState() == 1)
		      {
			 if($r)
		         {
			      $sales = new Sales();
			      $sales->setIdState(2);
			      $sales->setNumber(1);
			      $sales->setCashierId($this->getUser()->getId());
			      $sales->save($con);

			      $item_for_sale = new ItemForSale();
			      $item_for_sale->setSalesId($sales->getId());
			      $item_for_sale->setItemId($item->getId());
			      $item_for_sale->setName($item->getName());

			      $price = $item->getPrice();

			      $quantity = 1;

			      $item_for_sale->setPrice($item_for_sale->getAveragePrice($price, $quantity));

			      $item_for_sale->setQuantity($item_for_sale->getQuantity() + $quantity);

			      if ($item_for_sale->getDeleted() > $quantity)
			      {
				 $item_for_sale->setDeleted($item_for_sale->getDeleted() - $quantity);
			      } else {
				 $item_for_sale->setDeleted(0);
			      }

			      $item_for_sale->save($con);

			      $sales_account = new SaleAccount();
			      $sales_account->setAmount($sales->getTotalPrice());
			      $sales_account->setAccountId($account->getId());
			      $sales_account->setSalesId($sales->getId());
			      $sales_account->setIdState(1); // 1 = Cargado a cuenta, 2 = Cargado a cuenta y pagado 3 = cargado venta directa, 4 = cargado venta directa y pagado, 5 = anulado, 6 = eliminado
			      $sales_account->save($con);

			      $con->commit();
			 }
		      }
		   }

	       } else {
		  $this->getUser()->setFlash('error', 'No existe este item', false);
	       }

	    } else {
	       $this->getUser()->setFlash('error', 'No existe esta cuenta.', false);
	    }

	  } catch (exception $e) {
	    $con->rollback();
	    throw $e;
	    $this->getUser()->setFlash('error', "Se genero un problema comuniquese con el adm. $e", false);
	  }
     }

     public function executeListItemsCharged(sfWebRequest $request)
     {
	$this->account = AccountPeer::retrieveByPK($request->getParameter('ida'));
     }

     public function executeListAccount(sfWebRequest $request)
     {
	if($request->getParameter('contract_id'))
	{
	   $this->contract = ContractPeer::retrieveByPK($request->getParameter('contract_id'));
	} else {
	   $account = AccountPeer::retrieveByPK($request->getParameter('id'));
	   $this->contract = $account->getContract();
	}

	$this->deposit = DepositPeer::getDeposit(1, $this->contract->getId(), $this->getUser()->getId());
     }

     public function executeDelItem(sfWebRequest $request)
     {
       $this->account = AccountPeer::retrieveByPK($request->getParameter('ida'));

       $this->contract = $this->account->getContract();

       if(is_object($this->account))
       {
	  $item_for_sale = ItemForSalePeer::retrieveByPk($request->getParameter('id'));

	  if(is_object($item_for_sale))
	  {
	     $con = Propel::getConnection();
	       try {
		  $con->beginTransaction(); // start the transaction
		  $sales = $item_for_sale->getSales();

		  //Verificamos la cantidad de la venta
		  $item_for_sales = ItemForSalePeer::getItemForSaleBySales($sales->getId());


		  $item_for_sale->setDeleted($item_for_sale->getDeleted() + $item_for_sale->getQuantity());
		  $item_for_sale->setQuantity(0);
		  $item_for_sale->save($con);

		  if(count($item_for_sales) == 1)
		  {
		       if(is_object($sales))
		       {
			  $sale_account = SaleAccountPeer::getSaleAccountBySaleAndAccount($sales->getId(), $this->account->getId(), 1);

			  if(is_object($sale_account))
			  {
			     $sale_account->delete($con);
			  }

			  $item_for_sale->delete($con);

			  $sales->delete($con);

			  $con->commit();
			  $this->getUser()->setFlash('notice', 'El item ha sido eliminado', false);
		       }
		  }

		} catch (exception $e) {
		  $con->rollback();
		  throw $e;
		  $this->getUser()->setFlash('error', "Se genero un problema comuniquese con el adm. $e", false);
		}
	  }
       }

     }

     public function getGenerateCodigo($period_year, $degree_id, $curso, $student_id)
     {
	// Ciclo Nivel
	$lengt_degree = strlen($degree_id);
	$string_degree = $degree_id;
	if($lengt_degree < 2)
	{
	   $string_degree = '0'.$degree_id;
	}

	// Curso
	$array_curso = json_decode($curso->getDescription(), 1);

	$number_curso = $array_curso['NUMBER'];

	$lengt_curso = strlen($number_curso);
	$string_curso = $number_curso;
	if($lengt_curso < 2)
	{
	   $string_curso = '0'.$number_curso;
	}


	// Id del estudiante
	$lengt_id = strlen($student_id);
	$string_id = $student_id;

	if($lengt_id < 3)
	{
	   if($lengt_id == 2)
	   {
	      $string_id = '0'.$student_id;
	   } else if($lengt_id == 1){
	      $string_id = '00'.$student_id;
	   }
	}

	$codigo = $period_year.$string_degree.$string_curso.$string_id;

	return $codigo;
     }

     public function executeCreate(sfWebRequest $request)
     {
	$this->form = new StudentForm();

	 if ($request->isMethod('POST'))
	 {
	    // Obtenemos el periodo actualmente seleccionado
	    $period = PeriodPeer::retrieveByPK($this->getUser()->getAttribute('period'));

	    if(is_object($period))
	    {
		  // Obtenemos los datos del formulario
		  $data = $request->getParameter('student');

		  $this->form->bind($data);// Seteamos los datos al formulario

		  if ($this->form->isValid()) // Verificamos si es valido
		  {
		     // Llamo a la funcion que verifica si se han ingresado los datos de uno de los tutores
		     if($this->validarTutor($this->form->getValue('padre_tutor_cedula_identidad'), $this->form->getValue('padre_tutor_nombre'), $this->form->getValue('padre_tutor_apellido_paterno'), $this->form->getValue('padre_tutor_apellido_materno')) || $this->validarTutor($this->form->getValue('madre_cedula_identidad'), $this->form->getValue('madre_nombre'), $this->form->getValue('madre_apellido_paterno'), $this->form->getValue('madre_apellido_materno')))
		     {
			  $day = new sfDate(date('Y-M-d'));

                          // Creamos contract
			  $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

                          $sf_fecha_registro = new sfDate($fecha_registro);

                          if ($day->dump() >= $sf_fecha_registro->dump())
                          {


		       // Obtenemos el grado a partir de lo que haya seleccionado
		       if(isset($data['nivel_m']) && !empty($data['nivel_m']))
		       {
			  $grade = GradePeer::retrieveByPK($data['nivel_m']);
		       } else if(isset($data['nivel_t']) && !empty($data['nivel_t'])) {
			  $grade = GradePeer::retrieveByPK($data['nivel_t']);
		       } else if(isset($data['nivel_n']) && !empty($data['nivel_n'])) {
			  $grade = GradePeer::retrieveByPK($data['nivel_t']);
		       }

		       if(isset($grade) && is_object($grade))
		       {
			  $r = true;

			    $birth_date = null;
			    if($this->form->getValue('fecha_nacimiento_anio') > 0 && $this->form->getValue('fecha_nacimiento_mes') > 0 && $this->form->getValue('fecha_nacimiento_dia') > 0)
			    {
			       $birth_date = $this->form->getValue('fecha_nacimiento_anio').'-'.$this->form->getValue('fecha_nacimiento_mes').'-'.$this->form->getValue('fecha_nacimiento_dia').date('H:m:s');

			       $sf_birth_date = new sfDate($birth_date);

			       if ($sf_birth_date->dump() >= $day->dump())
			       {
				  $r = false;
			       }
			    }

			    if($r)
			    {
			          $con = Propel::getConnection();
				  try
				  {
				     $con->beginTransaction(); // Iniciamos transaccion

				     // Creamos al estudiante como persona
				     $person = PersonPeer::savePerson(2, null, $con);

				      if(is_object($person) && $person->getId() > 0)
				      {
					 $student = StudentPeer::saveStudent(2,
						 strtoupper(trim(strip_tags($this->form->getValue('estudiante_nombre')))),
						 strtoupper(trim(strip_tags($this->form->getValue('estudiante_apellido_paterno')))),
						 strtoupper(trim(strip_tags($this->form->getValue('estudiante_apellido_materno')))),
						 strtoupper(trim(strip_tags($this->form->getValue('rude')))),
						 '',
						 $birth_date,
						 trim(strip_tags($this->form->getValue('estudiante_email'))), $person->getId(), null, $con);

					 if(is_object($student) && $student->getId() > 0)
					 {
					    $student_id = $student->getId();
					    // Generamos el codigo del estudiante
					    $codigo = $this->getGenerateCodigo(
						    $period->getFromDate('y'),
						    $grade->getDegreeId(),
						    $grade->getCurso(), $student_id);

					    $student->setCodigo($codigo);
					    $student->save($con);


					    // Atributos del estudiante attribute
					    if(isset($data['tipo_documento']) && !empty ($data['tipo_documento']))
					    {
					      $attribute_tipo_documento = AttributePeer::saveAttribute(2, 'tipo_documento', trim(strip_tags($this->form->getValue('tipo_documento'))), 'DOCUMENTO DE IDENTIFICACIÓN', 'DOCUMENTO DE IDENTIFICACIÓN', $person->getId(), null, $con);
					      if(!is_object($attribute_tipo_documento) || $attribute_tipo_documento->getId() <= 0)
					      {
						 $r = false;
					      }
					    }

					    if(isset($data['estudiante_nro_documento']) && !empty($data['estudiante_nro_documento']))
					    {
					       $attribute_nro_documento = AttributePeer::saveAttribute(2, 'estudiante_nro_documento', strtoupper(trim(strip_tags($this->form->getValue('estudiante_nro_documento')))), 'No del documento de identificación', 'No del documento de identificación', $person->getId(), null, $con);
					       if(!is_object($attribute_nro_documento) || $attribute_nro_documento->getId() <= 0)
					       {
						 $r = false;
					       }
					    }

					    if(isset($data['estudiante_nacimiento_pais']) && !empty ($data['estudiante_nacimiento_pais']))
					    {
					       $attribute_estudiante_pais = AttributePeer::saveAttribute(2, 'estudiante_nacimiento_pais', strtoupper(trim(strip_tags($this->form->getValue('estudiante_nacimiento_pais')))), 'País', 'País', $person->getId(), null, $con);

					       if(!is_object($attribute_estudiante_pais) || $attribute_estudiante_pais->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['estudiante_genero']) && !empty ($data['estudiante_genero']))
					    {
					       $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', strtoupper(trim(strip_tags($this->form->getValue('estudiante_genero')))), 'SEXO', 'SEXO', $person->getId(), null, $con);
					       if(!is_object($attribute_estudiante_genero) || $attribute_estudiante_genero->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['estudiante_nacimiento_departamento']) && !empty ($data['estudiante_nacimiento_departamento']))
					    {
					       $attribute_estudiante_departamento = AttributePeer::saveAttribute(2, 'estudiante_departamento', strtoupper(trim(strip_tags($this->form->getValue('estudiante_nacimiento_departamento')))), 'Departamento', 'Departamento', $person->getId(), null, $con);
					       if(!is_object($attribute_estudiante_departamento) || $attribute_estudiante_departamento->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['estudiante_nacimiento_provincia']) && !empty($data['estudiante_nacimiento_provincia']))
					    {
					       $attribute_estudiante_provincia = AttributePeer::saveAttribute(2, 'estudiante_provincia', strtoupper(trim(strip_tags($this->form->getValue('estudiante_nacimiento_provincia')))), 'Provincia', 'Provincia', $person->getId(), null, $con);
					       if(!is_object($attribute_estudiante_provincia) || $attribute_estudiante_provincia->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['estudiante_nacimiento_localidad']) && !empty($data['estudiante_nacimiento_localidad']))
					    {
					       $attribute_estudiante_localidad = AttributePeer::saveAttribute(2, 'estudiante_localidad', strtoupper(trim(strip_tags($this->form->getValue('estudiante_nacimiento_localidad')))), 'Localidad', 'Localidad', $person->getId(), null, $con);
					       if(!is_object($attribute_estudiante_localidad) || $attribute_estudiante_localidad->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['certificado_nacimiento_oficialia']) && !empty($data['certificado_nacimiento_oficialia']))
					    {
					       $attribute_certificado_nacimiento_oficialia = AttributePeer::saveAttribute(2, 'certificado_nacimiento_oficialia', strtoupper(trim(strip_tags($this->form->getValue('certificado_nacimiento_oficialia')))), 'Oficialía No', 'Oficialía No', $person->getId(), null, $con);
					       if(!is_object($attribute_certificado_nacimiento_oficialia) || $attribute_certificado_nacimiento_oficialia->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['certificado_nacimiento_libro']) && !empty($data['certificado_nacimiento_libro']))
					    {
					       $attribute_certificado_nacimiento_libro = AttributePeer::saveAttribute(2, 'certificado_nacimiento_libro', strtoupper(trim(strip_tags($this->form->getValue('certificado_nacimiento_libro')))), 'Libro No', 'Libro No', $person->getId(), null, $con);
					       if(!is_object($attribute_certificado_nacimiento_libro) || $attribute_certificado_nacimiento_libro->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['certificado_nacimiento_partida']) && !empty($data['certificado_nacimiento_partida']))
					    {
					       $attribute_certificado_nacimiento_partida = AttributePeer::saveAttribute(2, 'certificado_nacimiento_partida', strtoupper(trim(strip_tags($this->form->getValue('certificado_nacimiento_partida')))), 'Partida No', 'Partida No', $person->getId(), null, $con);
					       if(!is_object($attribute_certificado_nacimiento_partida) || $attribute_certificado_nacimiento_partida->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    if(isset($data['certificado_nacimiento_folio']) && !empty($data['certificado_nacimiento_folio']))
					    {
					       $attribute_certificado_nacimiento_folio = AttributePeer::saveAttribute(2, 'certificado_nacimiento_folio', strtoupper(trim(strip_tags($this->form->getValue('certificado_nacimiento_folio')))), 'Folio N', 'Folio N', $person->getId(), null, $con);
					       if(!is_object($attribute_certificado_nacimiento_folio) || $attribute_certificado_nacimiento_folio->getId() <= 0)
					       {
						  $r = false;
					       }
					    }

					    // Creamos al tutor
					    //TODO verificar si ya existen a partir del ci

					    // Tutores Madre
					    $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro

					    $persona_madre = PersonPeer::savePerson(2, null, $con);
					    if(is_object($persona_madre) && $persona_madre->getId() > 0)
					    {
						 $tutor_madre = TutorPeer::saveTutor(2,
						 strtoupper(trim(strip_tags($this->form->getValue('madre_nombre')))),
						 strtoupper(trim(strip_tags($this->form->getValue('madre_apellido_paterno')))),
						 strtoupper(trim(strip_tags($this->form->getValue('madre_apellido_materno')))),
						 strtoupper(trim(strip_tags($this->form->getValue('madre_cedula_identidad')))),
						 strtoupper(trim(strip_tags($this->form->getValue('madre_idioma_frecuente')))),
						 strtoupper(trim(strip_tags($this->form->getValue('madre_ocupacion')))),
						 strtoupper(trim(strip_tags($this->form->getValue('madre_grado_instruccion')))),
						 trim(strip_tags($this->form->getValue('madre_email'))),
						 $type_tutor_id,
						 $persona_madre->getId(), null, $con);

						 if(is_object($tutor_madre) && $tutor_madre->getId() > 0)
						 {
						    $student_tutor_madre = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_madre->getId(), null, $con);

						    if(!is_object($student_tutor_madre) || $student_tutor_madre->getId() <= 0)
						    {
						       $r = false;
						    }
						 }
					    }

					    // Tutores
					 $type_tutor_id = 2;

					 if(isset($data['padre_tutor_parentesco']) && !empty($data['padre_tutor_parentesco']))
					 {
					    $parentesco = strtoupper(trim(strip_tags($data['padre_tutor_parentesco'])));

					    $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
					    if(!is_object($type_tutor))
					    {
						$type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
					    }
					    $type_tutor_id = $type_tutor->getId();


					    $persona_tutor = PersonPeer::savePerson(2, null, $con);
					    if(is_object($persona_tutor) && $persona_tutor->getId() > 0)
					    {
						 $tutor_tutor = TutorPeer::saveTutor(2,
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_nombre')))),
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_apellido_paterno')))),
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_apellido_materno')))),
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_cedula_identidad')))),
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_idioma_frecuente')))),
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_ocupacion')))),
						 strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_grado_instruccion')))),
						 trim(strip_tags($this->form->getValue('padre_email'))),
						 $type_tutor_id,
						 $persona_tutor->getId(), null, $con);

						 if(is_object($tutor_tutor) && $tutor_tutor->getId() > 0)
						 {
						    $student_tutor = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_tutor->getId(), null, $con);

						    if(!is_object($student_tutor) || $student_tutor->getId() <= 0)
						    {
						       $r = false;
						    }
						 }
					    }
					 }



					 // $id_state, $nro, $amount, $container, $description, $record_date, $city, $student_id, $period_id, $contract = null, $con = null
					 $contract = ContractPeer::saveContract(1,'', 0, '', '', $fecha_registro, $data['lugar_registro'], $student_id, $period->getId(), null, $con);

					 if(is_object($contract) && $contract->getId() > 0)
					 {
					    $account1 = AccountPeer::saveAccount(1, 'Enero', 1, $contract->getId(), null, $con);
					    $account2 = AccountPeer::saveAccount(1, 'Febrero', 2, $contract->getId(), null, $con);
					    $account3 = AccountPeer::saveAccount(1, 'Marzo', 3, $contract->getId(), null, $con);
					    $account4 = AccountPeer::saveAccount(1, 'Abril', 4, $contract->getId(), null, $con);
					    $account5 = AccountPeer::saveAccount(1, 'Mayo', 5, $contract->getId(), null, $con);
					    $account6 = AccountPeer::saveAccount(1, 'Junio', 6, $contract->getId(), null, $con);
					    $account7 = AccountPeer::saveAccount(1, 'Julio', 7, $contract->getId(), null, $con);
					    $account8 = AccountPeer::saveAccount(1, 'Agosto', 8, $contract->getId(), null, $con);
					    $account9 = AccountPeer::saveAccount(1, 'Septiembre', 9, $contract->getId(), null, $con);
					    $account10 = AccountPeer::saveAccount(1, 'Octubre', 10, $contract->getId(), null, $con);
      //				      $account11 = AccountPeer::saveAccount(1, 'Noviembre', 11, $contract->getId(), null, $con);
      //				      $account12 = AccountPeer::saveAccount(1, 'Diciembre', 12, $contract->getId(), null, $con);
					 }

					 // Le asignamos al contrato del estudiante el nivel que le corresponde
					 $array_contract_grade = array('id_state' => 2, 'contract_id' => $contract->getId(), 'grade_id' => $grade->getId());

					 $contract_grade = ContractGradePeer::saveContractGrade($array_contract_grade, null, $con);

					 if(!is_object($contract_grade) || $contract_grade->getId() <= 0)
					 {
					    $r = false;
					 }


      //				   $attribute_nivel = AttributeContractPeer::saveAttributeContract(2, 'nivel', $grade->getId(), '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
      //				   if(!is_object($attribute_nivel) || $attribute_nivel->getId() <= 0)
      //				   {
      //				       $r = false;
      //				   }
      //
      //
      //				   $attribute_paralelo = AttributeContractPeer::saveAttributeContract(2, 'paralelo', $grade->getParaleloId(), '3.2. PARALELO', '3.2. PARALELO', $contract->getId(), null, $con);
      //				   if(!is_object($attribute_paralelo) || $attribute_paralelo->getId() <= 0)
      //				   {
      //				       $r = false;
      //				   }
      //
      //
      //				   $attribute_turno = AttributeContractPeer::saveAttributeContract(2, 'turno', $grade->getTimetableId(), '3.3. TURNO', '3.3. TURNO', $contract->getId(), null, $con);
      //				   if(!is_object($attribute_turno) || $attribute_turno->getId() <= 0)
      //				   {
      //				       $r = false;
      //				   }

					 if(isset($data['estudiante_direccion_provincia']) && !empty($data['estudiante_direccion_provincia']))
					 {
					    $attribute_estudiante_direccion_provincia = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_provincia', strtoupper(trim(strip_tags($data['estudiante_direccion_provincia']))), 'Provincia', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_provincia) || $attribute_estudiante_direccion_provincia->getId() <= 0)
					    {
						$r = false;
					    }
					 }

					 if(isset($data['estudiante_direccion_zona_villa']) && !empty($data['estudiante_direccion_zona_villa']))
					 {
					    $attribute_estudiante_direccion_zona_villa = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_zona_villa', strtoupper(trim(strip_tags($data['estudiante_direccion_zona_villa']))), 'Zona / Villa', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_zona_villa) || $attribute_estudiante_direccion_zona_villa->getId() <= 0)
					    {
						$r = false;
					    }
					 }

					 if(isset($data['estudiante_direccion_session_municipio']) && !empty($data['estudiante_direccion_session_municipio']))
					 {
					    $attribute_estudiante_direccion_session_municipio = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_session_municipio', strtoupper(trim(strip_tags($data['estudiante_direccion_session_municipio']))), 'Sección / Municipio', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_session_municipio) || $attribute_estudiante_direccion_session_municipio->getId() <= 0)
					    {
						$r = false;
					    }
					 }

					 if(isset($data['estudiante_direccion_avenida_calle']) && !empty($data['estudiante_direccion_avenida_calle']))
					 {
					    $attribute_estudiante_direccion_avenida_calle = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_avenida_calle', strtoupper(trim(strip_tags($data['estudiante_direccion_avenida_calle']))), 'Avenida / Calle', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_avenida_calle) || $attribute_estudiante_direccion_avenida_calle->getId() <= 0)
					    {
						$r = false;
					    }
					 }

					 if(isset($data['estudiante_direccion_localidad_comunidad']) && !empty($data['estudiante_direccion_localidad_comunidad']))
					 {
					    $attribute_estudiante_direccion_localidad_comunidad = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_localidad_comunidad', strtoupper(trim(strip_tags($data['estudiante_direccion_localidad_comunidad']))), 'Localidad / Comunidad', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_localidad_comunidad) || $attribute_estudiante_direccion_localidad_comunidad->getId() <= 0)
					    {
						$r = false;
					    }
					 }

					 if(isset($data['estudiante_direccion_celular']) && !empty($data['estudiante_direccion_celular']))
					 {
					    $attribute_estudiante_direccion_celular = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_celular', strtoupper(trim(strip_tags($data['estudiante_direccion_celular']))), 'Teléfono/Celular', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_celular) || $attribute_estudiante_direccion_celular->getId() <= 0)
					    {
						$r = false;
					    }
					 }

					 if(isset($data['estudiante_direccion_numero_vivienda']) && !empty($data['estudiante_direccion_numero_vivienda']))
					 {
					    $attribute_estudiante_direccion_numero_vivienda = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_numero_vivienda', strtoupper(trim(strip_tags($data['estudiante_direccion_numero_vivienda']))), 'Número de vivienda', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($attribute_estudiante_direccion_numero_vivienda) || $attribute_estudiante_direccion_numero_vivienda->getId() <= 0)
					    {
						$r = false;
					    }
					 }


					 // Aspectos Sociales (Preguntas)
					 if(isset($data['idioma_nines']) && !empty($data['idioma_nines']))
					 {
					    $question_idioma_nines = QuestionPeer::saveQuestion(2, 'idioma_nines', strtoupper(trim(strip_tags($data['idioma_nines']))),
					       '5.1.1.¿Cuál es el idioma que aprendió a hablar en su niñez la o el estudiante?',
					       'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

						if(!is_object($question_idioma_nines) || $question_idioma_nines->getId() <= 0)
						{
						   $r = false;
						}
					 }

					 if(isset($data['idioma_habla_frecuentemente_1']) && !empty($data['idioma_habla_frecuentemente_1']))
					 {
					    $question_idioma_habla_frecuentemente_1 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_1', strtoupper(trim(strip_tags($data['idioma_habla_frecuentemente_1']))),
					       '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					       'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					    if(!is_object($question_idioma_habla_frecuentemente_1) || $question_idioma_habla_frecuentemente_1->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['idioma_habla_frecuentemente_2']) && !empty($data['idioma_habla_frecuentemente_2']))
					 {
					    $question_idioma_habla_frecuentemente_2 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_2', strtoupper(trim(strip_tags($data['idioma_habla_frecuentemente_2']))),
					       '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					       'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
					    if(!is_object($question_idioma_habla_frecuentemente_2) || $question_idioma_habla_frecuentemente_2->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['idioma_habla_frecuentemente_3']) && !empty($data['idioma_habla_frecuentemente_3']))
					 {
					    $question_idioma_habla_frecuentemente_3 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_3', strtoupper(trim(strip_tags($data['idioma_habla_frecuentemente_3']))),
					       '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					       'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					    if(!is_object($question_idioma_habla_frecuentemente_3) || $question_idioma_habla_frecuentemente_3->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['pertenece']) && !empty($data['pertenece']))
					 {
					    foreach ($data['pertenece'] as $pertenece)
					    {
					       $question_pertenece = QuestionPeer::saveQuestion(2, 'pertenece', $pertenece,
					       '5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
					       'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					       if(!is_object($question_pertenece) || $question_pertenece->getId() <= 0)
					       {
						  $r = false;
						  break;
					       }
					    }
					 }

					 if(isset($data['otro_pertenece']) &&  !empty($data['otro_pertenece']))
					 {
					    $question_otro_pertenece = QuestionPeer::saveQuestion(2, 'otro_pertenece', strtoupper(trim(strip_tags($data['otro_pertenece']))),
					       '5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
					       'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					       if(!is_object($question_otro_pertenece) || $question_otro_pertenece->getId() <= 0)
					       {
						  $r = false;
					       }
					 }

					 if(isset($data['hospital']) && !empty($data['hospital']))
					 {
					    $question_hospital = QuestionPeer::saveQuestion(2, 'hospital', trim(strip_tags($data['hospital'])),
					    '5.2.1.¿Existe Centro de Salud / Posta / Hospital en su comunidad?',
					    '5.2. SALUD', $contract->getId(), null, $con);

					    if(!is_object($question_hospital) || $question_hospital->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['hospital_veces']) || !empty ($data['hospital_veces']))
					 {
					    $question_veces = QuestionPeer::saveQuestion(2, 'hospital_veces', strtoupper(trim(strip_tags($data['hospital_veces']))),
					    '5.2.2. ¿Cuántas veces fue la o el estudiante al centro de salud el año pasado?',
					    '5.2. SALUD', $contract->getId(), null, $con);

					    if(!is_object($question_veces) || $question_veces->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['discapacidad_sensorial']) && !empty($data['discapacidad_sensorial']))
					 {
					    $question_discapacidad_sensorial = QuestionPeer::saveQuestion(2, 'discapacidad_sensorial', $data['discapacidad_sensorial'],
					    '5.2.3. Presenta la o el estudiante alguna discapacidad - Sensorial y de la comunicación',
					    '5.2. SALUD', $contract->getId(), null, $con);

					    if(!is_object($question_discapacidad_sensorial) || $question_discapacidad_sensorial->getId() <= 0)
					    {
					       $r = false;
					    }
					 }


					 if(isset($data['discapacidad_motriz']) && !empty($data['discapacidad_motriz']))
					 {
					    $question_discapacidad_motriz = QuestionPeer::saveQuestion(2, 'discapacidad_motriz', $data['discapacidad_motriz'],
					    '5.2.3. Presenta la o el estudiante alguna discapacidad - Motriz',
					    '5.2. SALUD', $contract->getId(), null, $con);

					    if(!is_object($question_discapacidad_motriz) || $question_discapacidad_motriz->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['discapacidad_mental']) && !empty($data['discapacidad_mental']))
					 {
					    $question_discapacidad_mental = QuestionPeer::saveQuestion(2, 'discapacidad_mental', $data['discapacidad_mental'],
					    '5.2.3. Presenta la o el estudiante alguna discapacidad -  Mental',
					    '5.2. SALUD', $contract->getId(), null, $con);

					    if(!is_object($question_discapacidad_mental) || $question_discapacidad_mental->getId() <= 0)
					    {
					       $r = false;
					    }
					 }


					 if(isset($data['origen_discapacidad']) && !empty($data['origen_discapacidad']))
					 {
					    $question_origen_discapacidad = QuestionPeer::saveQuestion(2, 'origen_discapacidad', $data['origen_discapacidad'],
					    '5.2.4. Su discapacidad es:',
					    '5.2. SALUD', $contract->getId(), null, $con);
					    if(!is_object($question_origen_discapacidad) || $question_origen_discapacidad->getId() <= 0)
					    {
					       $r = false;
					    }
					 }


					 if(isset($data['acceso_servicio_basico']) && !empty($data['acceso_servicio_basico']))
					 {
					    $question_acceso_servicio_basico = QuestionPeer::saveQuestion(2, 'acceso_servicio_basico', $data['acceso_servicio_basico'],
					    '5.3.1. El agua de su casa proviene de:',
					    '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);
					    if(!is_object($question_acceso_servicio_basico) || $question_acceso_servicio_basico->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['energia_electrica']) && !empty($data['energia_electrica']))
					 {
					    $question_energia_electrica = QuestionPeer::saveQuestion(2, 'energia_electrica', $data['energia_electrica'],
					    '5.3.2. ¿La o el estudiante tiene energía eléctrica en su vivienda? ',
					    '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);

					    if(!is_object($question_energia_electrica) || $question_energia_electrica->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 // Aqui falta poner los datos del baño
					 if(isset($data['bano']) && !empty($data['bano']))
					 {
					    $bano = QuestionPeer::saveQuestion(2, 'bano', $data['bano'],
					    '5.3.3. El baño, water o letrina de su casa tiene desagüe a:  ',
					    '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);

					    if(!is_object($bano) || $bano->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['trabajo']) && !empty($data['trabajo']))
					 {
					    $question_trabajo = QuestionPeer::saveQuestion(2, 'trabajo', strtoupper($data['trabajo']),
					    '5.4.1. ¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?',
					    '5.4. EMPLEO', $contract->getId(), null, $con);
					    if(!is_object($question_trabajo) || $question_trabajo->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['cuantos_dias_trabajo']) && !empty($data['cuantos_dias_trabajo']))
					 {
					    $question_cuantos_dias_trabajo = QuestionPeer::saveQuestion(2, 'cuantos_dias_trabajo', strtoupper(trim(strip_tags($data['cuantos_dias_trabajo']))),
					    '5.4.2. La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante? ',
					    '5.4. EMPLEO', $student_id, null, $con);
					    if(!is_object($question_cuantos_dias_trabajo) || $question_cuantos_dias_trabajo->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['recibio_pago']) && !empty($data['recibio_pago']))
					 {
					    $question_recibio_pago = QuestionPeer::saveQuestion(2, 'recibio_pago', strtoupper($data['recibio_pago']),
					    '5.4.3. ¿Recibió algún pago por el trabajo realizado? ',
					    '5.4. EMPLEO', $contract->getId(), null, $con);
					    if(!is_object($question_recibio_pago) || $question_recibio_pago->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['accede_internet']) && !empty($data['accede_internet']))
					 {
					    foreach ($data['accede_internet'] as $accede_internet)
					    {
					       $question_accede_internet = QuestionPeer::saveQuestion(2, 'accede_internet', $accede_internet,
					       '5.5.1. La o el estudiante accede a internet en:',
					       '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE ', $contract->getId(), null, $con);
					       if(!is_object($question_accede_internet) || $question_accede_internet->getId() <= 0)
					       {
						   $r = false;
					       }
					    }
					 }

					 if(isset($data['frecuencia_internet']) && !empty($data['frecuencia_internet']))
					 {
					    $question_frecuencia_internet = QuestionPeer::saveQuestion(2, 'frecuencia_internet', $data['frecuencia_internet'],
					    '5.5.2. ¿Con qué frecuencia la o el estudiante accede a internet?',
					    '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), null, $con);
					    if(!is_object($question_frecuencia_internet) || $question_frecuencia_internet->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['transporte']) && !empty($data['transporte']))
					 {
					    $question_transporte = QuestionPeer::saveQuestion(2, 'transporte', $data['transporte'],
					    '5.5.3. ¿Cómo llega la o el estudiante a la Unidad Educativa? ',
					    '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), null, $con);
					    if(!is_object($question_transporte) || $question_transporte->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 if(isset($data['tiempo_transporte']) && !empty($data['tiempo_transporte']))
					 {
					    $question_tiempo_transporte = QuestionPeer::saveQuestion(2, 'tiempo_transporte', $data['tiempo_transporte'],
					    '5.5.4. En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?',
					    '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), null, $con);

					    if(!is_object($question_tiempo_transporte) || $question_tiempo_transporte->getId() <= 0)
					    {
					       $r = false;
					    }
					 }


					 if($r)
					 {
					    // funcion que agrega el item(mensualidad) que corresponde segun al curso que se lo esta inscribiendo
					    $this->addDefaultItem($grade, $contract);

					     $con->commit();
					     $this->getUser()->setFlash('notice', 'Creo con exito un nuevo estudiante');
					     $this->redirect('/Student/account/id/'.$student_id);
					 } else {
					    $this->getUser()->setFlash('error', "Ocurrio un error inesperado, comuniquese con el Administrador del sistema", false);
					 }

				       }// end student
				    }// end person
				  } catch (exception $e) {
				      $con->rollback();
				      throw $e;
				      $this->getUser()->setFlash('error', $e, false);
				  }

			    } else {
			       $this->getUser()->setFlash('error', "La fecha de nacimiento no puede ser mayor o igual a la fecha actual", false);
			    }





                            } else {
                                $this->getUser()->setFlash('error', "Debe seleccionar el nivel escolar del estudiante", false);
                            }

                            } else {
                                $this->getUser()->setFlash('error', "La fecha de registro no puede ser mayor a la fecha actual", false);
                            }


		     } else {
			$this->getUser()->setFlash('error', "Debe ingresar los datos de uno de los tutores del alumno", false);
		     }
		  } else {
		      $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
		  }

	    } else {
	       $this->getUser()->setFlash('error', "Debe seleccionar el periodo escolar para el que lo esta inscribiendo", false);
            }
	 }

       $this->setTemplate('new');
     }

     protected function validarTutor($cedula_identidad, $nombres, $apellido_paterno = null, $apellido_materno = null)
     {
	$r = false;
	$cedula_identidad = trim(strip_tags($cedula_identidad));
	$nombres = trim(strip_tags($nombres));
	$apellido_paterno = trim(strip_tags($apellido_paterno));
	$apellido_materno = trim(strip_tags($apellido_materno));

	if(!empty($cedula_identidad) && !empty($nombres) && (!empty($apellido_paterno) || !empty($apellido_materno)))
	{
	   $r = true;
	}

	return $r;
     }


     public function executeSaveRecordSort(sfWebRequest $request)
     {
	 $this->form = new RecordShortForm();

	 if ($request->isMethod('POST'))
	 {
	    // Obtenemos el periodo actualmente seleccionado
	    $period = PeriodPeer::retrieveByPK($this->getUser()->getAttribute('period'));

	    if(is_object($period))
	    {
		  // Obtenemos los datos del formulario
		  $data = $request->getParameter('record_short');

		  $this->form->bind($data);// Seteamos los datos al formulario

		  if ($this->form->isValid()) // Verificamos si es valido
		  {
		     // Llamo a la funcion que verifica si se han ingresado los datos de uno de los tutores
		     if($this->validarTutor($this->form->getValue('padre_tutor_cedula_identidad'), $this->form->getValue('padre_tutor_nombre'), $this->form->getValue('padre_tutor_apellido_paterno'), $this->form->getValue('padre_tutor_apellido_materno')) || $this->validarTutor($this->form->getValue('madre_cedula_identidad'), $this->form->getValue('madre_nombre'), $this->form->getValue('madre_apellido_paterno'), $this->form->getValue('madre_apellido_materno')))
		     {
			$day = new sfDate(time());

			// Creamos contract
			$fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

			$sf_fecha_registro = new sfDate($fecha_registro);

			if ($day->dump() >= $sf_fecha_registro->dump())
                        {
			   // Obtenemos el grado a partir de lo que haya seleccionado
			   if(isset($data['nivel_m']) && !empty($data['nivel_m']))
			   {
			     $grade = GradePeer::retrieveByPK($data['nivel_m']);
			   } else if(isset($data['nivel_t']) && !empty($data['nivel_t'])) {
			     $grade = GradePeer::retrieveByPK($data['nivel_t']);
			   } else if(isset($data['nivel_n']) && !empty($data['nivel_n'])) {
			     $grade = GradePeer::retrieveByPK($data['nivel_t']);
			   }

			  if(isset($grade) && is_object($grade))
			  {
			       $con = Propel::getConnection();
			       try
			       {
				  $con->beginTransaction(); // Iniciamos transaccion

				  // Creamos al estudiante como persona
				  $person = PersonPeer::savePerson(2, null, $con);

				   if(is_object($person) && $person->getId() > 0)
				   {
					$student = StudentPeer::saveStudent(2,
					      strtoupper(trim(strip_tags($this->form->getValue('estudiante_nombre')))),
					      strtoupper(trim(strip_tags($this->form->getValue('estudiante_apellido_paterno')))),
					      strtoupper(trim(strip_tags($this->form->getValue('estudiante_apellido_materno')))),
					      '',
					      '',
					      $birth_date,'', $person->getId(), null, $con);

				      if(is_object($student) && $student->getId() > 0)
				      {
					 $r = true;

					 $student_id = $student->getId();
					 $codigo = $this->getGenerateCodigo($period->getFromDate('y'),
									    $grade->getDegreeId(),
									    $grade->getCurso(),
									    $student_id);

					 $student->setCodigo($codigo);
					 $student->save($con);

					 if(isset($data['estudiante_genero']) && !empty ($data['estudiante_genero']))
					 {
					    $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', strtoupper($this->form->getValue('estudiante_genero')), 'SEXO', 'SEXO', $person->getId(), null, $con);
					    if(!is_object($attribute_estudiante_genero) || $attribute_estudiante_genero->getId() <= 0)
					    {
					       $r = false;
					    }
					 }

					 // Creamos al tutor
					 //TODO verificar si ya existen a partir del ci

					 // Tutores Madre
					 $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro

					 $persona_madre = PersonPeer::savePerson(2, null, $con);
					 if(is_object($persona_madre) && $persona_madre->getId() > 0)
					 {
					      $tutor_madre = TutorPeer::saveTutor(2,
					      strtoupper(trim(strip_tags($this->form->getValue('madre_nombre')))),
					      strtoupper(trim(strip_tags($this->form->getValue('madre_apellido_paterno')))),
					      strtoupper(trim(strip_tags($this->form->getValue('madre_apellido_materno')))),
					      strtoupper(trim(strip_tags($this->form->getValue('madre_cedula_identidad')))),
					      strtoupper(trim(strip_tags($this->form->getValue('madre_idioma_frecuente')))),
					      strtoupper(trim(strip_tags($this->form->getValue('madre_ocupacion')))),
					      strtoupper(trim(strip_tags($this->form->getValue('madre_grado_instruccion')))),
					      trim(strip_tags($this->form->getValue('madre_email'))),
					      $type_tutor_id,
					      $persona_madre->getId(), null, $con);

					      if(is_object($tutor_madre) && $tutor_madre->getId() > 0)
					      {
						 $student_tutor_madre = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_madre->getId(), null, $con);

						 if(!is_object($student_tutor_madre) || $student_tutor_madre->getId() <= 0)
						 {
						    $r = false;
						 }
					      }
					 }

					 // Tutores
				      $type_tutor_id = 2;

				      if(isset($data['padre_tutor_parentesco']) && !empty($data['padre_tutor_parentesco']))
				      {
					 $parentesco = strtoupper($data['padre_tutor_parentesco']);

					 $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
					 if(!is_object($type_tutor))
					 {
					     $type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
					 }
					 $type_tutor_id = $type_tutor->getId();


					 $persona_tutor = PersonPeer::savePerson(2, null, $con);
					 if(is_object($persona_tutor) && $persona_tutor->getId() > 0)
					 {
					      $tutor_tutor = TutorPeer::saveTutor(2,
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_nombre')))),
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_apellido_paterno')))),
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_apellido_materno')))),
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_cedula_identidad')))),
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_idioma_frecuente')))),
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_ocupacion')))),
					      strtoupper(trim(strip_tags($this->form->getValue('padre_tutor_grado_instruccion')))),
					      trim(strip_tags($this->form->getValue('padre_email'))),
					      $type_tutor_id,
					      $persona_tutor->getId(), null, $con);

					      if(is_object($tutor_tutor) && $tutor_tutor->getId() > 0)
					      {
						 $student_tutor = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_tutor->getId(), null, $con);

						 if(!is_object($student_tutor) || $student_tutor->getId() <= 0)
						 {
						    $r = false;
						 }
					      }
					 }
				      }



				      // $id_state, $nro, $amount, $container, $description, $record_date, $city, $student_id, $period_id, $contract = null, $con = null
				      $contract = ContractPeer::saveContract(1,'', 0, '', '', $fecha_registro, $data['lugar_registro'], $student_id, $period->getId(), null, $con);

				      if(is_object($contract) && $contract->getId() > 0)
				      {
					 $account1 = AccountPeer::saveAccount(1, 'Enero', 1, $contract->getId(), null, $con);
					 $account2 = AccountPeer::saveAccount(1, 'Febrero', 2, $contract->getId(), null, $con);
					 $account3 = AccountPeer::saveAccount(1, 'Marzo', 3, $contract->getId(), null, $con);
					 $account4 = AccountPeer::saveAccount(1, 'Abril', 4, $contract->getId(), null, $con);
					 $account5 = AccountPeer::saveAccount(1, 'Mayo', 5, $contract->getId(), null, $con);
					 $account6 = AccountPeer::saveAccount(1, 'Junio', 6, $contract->getId(), null, $con);
					 $account7 = AccountPeer::saveAccount(1, 'Julio', 7, $contract->getId(), null, $con);
					 $account8 = AccountPeer::saveAccount(1, 'Agosto', 8, $contract->getId(), null, $con);
					 $account9 = AccountPeer::saveAccount(1, 'Septiembre', 9, $contract->getId(), null, $con);
					 $account10 = AccountPeer::saveAccount(1, 'Octubre', 10, $contract->getId(), null, $con);
   //				      $account11 = AccountPeer::saveAccount(1, 'Noviembre', 11, $contract->getId(), null, $con);
   //				      $account12 = AccountPeer::saveAccount(1, 'Diciembre', 12, $contract->getId(), null, $con);
				      }

				      // Le asignamos al contrato del estudiante el nivel que le corresponde
				      $array_contract_grade = array('id_state' => 2, 'contract_id' => $contract->getId(), 'grade_id' => $grade->getId());

				      $contract_grade = ContractGradePeer::saveContractGrade($array_contract_grade, null, $con);

				      if(!is_object($contract_grade) || $contract_grade->getId() <= 0)
				      {
					 $r = false;
				      }


//				      $attribute_nivel = AttributeContractPeer::saveAttributeContract(2, 'nivel', $grade->getId(), '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
//				      if(!is_object($attribute_nivel) || $attribute_nivel->getId() <= 0)
//				      {
//					  $r = false;
//				      }
//
//
//				      $attribute_paralelo = AttributeContractPeer::saveAttributeContract(2, 'paralelo', $grade->getParaleloId(), '3.2. PARALELO', '3.2. PARALELO', $contract->getId(), null, $con);
//				      if(!is_object($attribute_paralelo) || $attribute_paralelo->getId() <= 0)
//				      {
//					  $r = false;
//				      }
//
//
//				      $attribute_turno = AttributeContractPeer::saveAttributeContract(2, 'turno', $grade->getTimetableId(), '3.3. TURNO', '3.3. TURNO', $contract->getId(), null, $con);
//				      if(!is_object($attribute_turno) || $attribute_turno->getId() <= 0)
//				      {
//					  $r = false;
//				      }

				      if($r)
				      {
					 // Con este metodo agregamos el item(Mensualidad) que corresponde al estudiante segun el curso para el que se lo esta inscribiendo
					  $this->addDefaultItem($grade, $contract);

					  $con->commit();
					  $this->getUser()->setFlash('notice', 'Creo con exito un nuevo alumno');
					  // Con esto redireccionamos a la cuenta del estudiante
					  $this->redirect('/Student/account/id/'.$student_id);
				      } else {
					 $this->getUser()->setFlash('error', "Ocurrio un error inesperado, comuniquese con el Administrador del sistema", false);
				      }

				    }// end student
				 }// end person
			       } catch (exception $e) {
				   $con->rollback();
				   throw $e;
				   $this->getUser()->setFlash('error', $e, false);
			       }

			    } else {
				$this->getUser()->setFlash('error', "Debe seleccionar el nivel escolar del estudiante", false);
			    }

			 } else {
			     $this->getUser()->setFlash('error', "La fecha de registro no puede ser mayor a la fecha actual", false);
			 }

		     } else {
			$this->getUser()->setFlash('error', "Debe ingresar los datos de uno de los tutores del alumno", false);
		     }

		  } else {
		      $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
		  }

	    } else {
	       $this->getUser()->setFlash('error', "Debe seleccionar el periodo escolar para el que lo esta inscribiendo", false);
            }
	 }

       $this->setTemplate('recordShort');
     }


     public function executeSaveRecordSortEnroll(sfWebRequest $request)
     {
	 if ($request->isMethod('POST'))
	 {
	    // Obtenemos el periodo actualmente seleccionado
	    $period = PeriodPeer::retrieveByPK($this->getUser()->getAttribute('period'));

	    if(is_object($period))
	    {
		  // Obtenemos los datos del formulario
		  $data = $request->getParameter('record_short');

		  // A partir del identificador obtenemos al estudiante
		  $this->Student = StudentPeer::retrieveByPK($data['id']);

		  $student = $this->Student;

		  $this->form = new RecordShortEnrollForm($this->Student);

		  $this->form->bind($data);// Seteamos los datos al formulario

		  if ($this->form->isValid()) // Verificamos si es valido
		  {
                      $day = new sfDate(time());

                      // Creamos contract
		      $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

                      $sf_fecha_registro = new sfDate($fecha_registro);

                      if ($day->dump() >= $sf_fecha_registro->dump())
                      {
			  // Obtenemos el grado a partir de lo que haya seleccionado
			  if(isset($data['nivel_m']) && !empty($data['nivel_m']))
			  {
			     $grade = GradePeer::retrieveByPK($data['nivel_m']);
			  } else if(isset($data['nivel_t']) && !empty($data['nivel_t'])) {
			     $grade = GradePeer::retrieveByPK($data['nivel_t']);
			  } else if(isset($data['nivel_n']) && !empty($data['nivel_n'])) {
			     $grade = GradePeer::retrieveByPK($data['nivel_t']);
			  }

		       if(isset($grade) && is_object($grade))
		       {
			    $con = Propel::getConnection();
			    try
			    {
			       $con->beginTransaction(); // Iniciamos transaccion

			       // Obtenemos el person del estudiante
			       $person = $this->Student->getPerson();

				if(is_object($person) && $person->getId() > 0)
				{


				   $student = StudentPeer::saveStudent(2,
					   strtoupper($this->form->getValue('estudiante_nombre')),
					   strtoupper($this->form->getValue('estudiante_apellido_paterno')),
					   strtoupper($this->form->getValue('estudiante_apellido_materno')),
					   '',
					   $student->getCodigo(),
					   null,
					   '', $person->getId(), $this->Student, $con);


				   if(is_object($student) && $student->getId() > 0)
				   {
				      $r = true;



				      if(isset($data['estudiante_genero']) && !empty ($data['estudiante_genero']))
				      {
					 $attribute_estudiante_genero = AttributePeer::getAttributeByKeyAndPerson('estudiante_genero', $person->getId());
					 $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', strtoupper($this->form->getValue('estudiante_genero')), 'SEXO', 'SEXO', $person->getId(), $attribute_estudiante_genero, $con);
					 if(!is_object($attribute_estudiante_genero) || $attribute_estudiante_genero->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      // Creamos al tutor
				      //TODO verificar si ya existen a partir del ci

				      // Tutores Madre
				      $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro

				      $student_tutor_madre = StudentTutorPeer::getStudentTutor($student->getId(), $type_tutor_id);

				      $tutor_madre = $student_tutor_madre->getTutor();

				      $persona_madre = $tutor_madre->getPerson();
				      if(is_object($persona_madre) && $persona_madre->getId() > 0)
				      {
					   $tutor_madre = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('madre_nombre')),
					   strtoupper($this->form->getValue('madre_apellido_paterno')),
					   strtoupper($this->form->getValue('madre_apellido_materno')),
					   strtoupper($this->form->getValue('madre_cedula_identidad')),
					   strtoupper($this->form->getValue('madre_idioma_frecuente')),
					   strtoupper($this->form->getValue('madre_ocupacion')),
					   strtoupper($this->form->getValue('madre_grado_instruccion')),
					   $this->form->getValue('madre_email'),
					   $type_tutor_id,
					   $persona_madre->getId(), $tutor_madre, $con);

					   if(is_object($tutor_madre) && $tutor_madre->getId() > 0)
					   {
					      $student_tutor_madre = StudentTutorPeer::saveStudentTutor(2, $student->getId(), $tutor_madre->getId(), $student_tutor_madre, $con);

					      if(!is_object($student_tutor_madre) || $student_tutor_madre->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }

				      // Tutores
				   $type_tutor_id = 2;

				   if(isset($data['padre_tutor_parentesco']) && !empty($data['padre_tutor_parentesco']))
				   {
				      $parentesco = strtoupper($data['padre_tutor_parentesco']);

				      $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
				      if(!is_object($type_tutor))
				      {
					  $type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
				      }
				      $type_tutor_id = $type_tutor->getId();

				      $student_tutor = StudentTutorPeer::getStudentTutor($student->getId(), $type_tutor_id);

				      if(is_object($student_tutor))
				      {
					 $tutor_tutor = $student_tutor->getTutor();
					 $persona_tutor = $tutor_tutor->getPerson();
				      } else {
					$tutor_tutor = null;
					$persona_tutor = PersonPeer::savePerson(2, null, $con);
				      }

				      if(is_object($persona_tutor) && $persona_tutor->getId() > 0)
				      {
					   $tutor_tutor = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('padre_tutor_nombre')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_paterno')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_materno')),
					   strtoupper($this->form->getValue('padre_tutor_cedula_identidad')),
					   strtoupper($this->form->getValue('padre_tutor_idioma_frecuente')),
					   strtoupper($this->form->getValue('padre_tutor_ocupacion')),
					   strtoupper($this->form->getValue('padre_tutor_grado_instruccion')),
					   $this->form->getValue('padre_email'),
					   $type_tutor_id,
					   $persona_tutor->getId(), $tutor_tutor, $con);

					   if(is_object($tutor_tutor) && $tutor_tutor->getId() > 0)
					   {
					      $student_tutor = StudentTutorPeer::saveStudentTutor(2, $student->getId(), $tutor_tutor->getId(), $student_tutor, $con);

					      if(!is_object($student_tutor) || $student_tutor->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }
				   }



				   // $id_state, $nro, $amount, $container, $description, $record_date, $city, $student_id, $period_id, $contract = null, $con = null
				   $contract = ContractPeer::saveContract(1,'', 0, '', '', $fecha_registro, $data['lugar_registro'], $student->getId(), $period->getId(), null, $con);

				   if(is_object($contract) && $contract->getId() > 0)
				   {
				      $account1 = AccountPeer::saveAccount(1, 'Enero', 1, $contract->getId(), null, $con);
				      $account2 = AccountPeer::saveAccount(1, 'Febrero', 2, $contract->getId(), null, $con);
				      $account3 = AccountPeer::saveAccount(1, 'Marzo', 3, $contract->getId(), null, $con);
				      $account4 = AccountPeer::saveAccount(1, 'Abril', 4, $contract->getId(), null, $con);
				      $account5 = AccountPeer::saveAccount(1, 'Mayo', 5, $contract->getId(), null, $con);
				      $account6 = AccountPeer::saveAccount(1, 'Junio', 6, $contract->getId(), null, $con);
				      $account7 = AccountPeer::saveAccount(1, 'Julio', 7, $contract->getId(), null, $con);
				      $account8 = AccountPeer::saveAccount(1, 'Agosto', 8, $contract->getId(), null, $con);
				      $account9 = AccountPeer::saveAccount(1, 'Septiembre', 9, $contract->getId(), null, $con);
				      $account10 = AccountPeer::saveAccount(1, 'Octubre', 10, $contract->getId(), null, $con);
//				      $account11 = AccountPeer::saveAccount(1, 'Noviembre', 11, $contract->getId(), null, $con);
//				      $account12 = AccountPeer::saveAccount(1, 'Diciembre', 12, $contract->getId(), null, $con);
				   }

				   // Le asignamos al contrato del estudiante el nivel que le corresponde
				   $array_contract_grade = array('id_state' => 2, 'contract_id' => $contract->getId(), 'grade_id' => $grade->getId());

				   $contract_grade = ContractGradePeer::saveContractGrade($array_contract_grade, null, $con);

				   if(!is_object($contract_grade) || $contract_grade->getId() <= 0)
				   {
				      $r = false;
				   }

				   if($r)
				   {
				       $this->addDefaultItem($grade, $contract);

				       $con->commit();
				       $this->getUser()->setFlash('notice', 'Creo con exito un nuevo estudiante');
				       $this->redirect('/Student/account/id/'.$student->getId());
				   } else {
				      $this->getUser()->setFlash('error', "Ocurrio un error inesperado, comuniquese con el Administrador del sistema", false);
				   }

				 }// end student
			      }// end person
			    } catch (exception $e) {
				$con->rollback();
				throw $e;
				$this->getUser()->setFlash('error', $e, false);
			    }


                            } else {
                                $this->getUser()->setFlash('error', "Debe seleccionar el nivel escolar del estudiante", false);
                            }

                            } else {
                                $this->getUser()->setFlash('error', "La fecha de registro no puede ser mayor a la fecha actual", false);
                            }

		  } else {
		      $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
		  }

	    } else {
	       $this->getUser()->setFlash('error', "Debe seleccionar el periodo escolar para el que lo esta inscribiendo", false);
            }
	 }

       $this->setTemplate('recordShortEnroll');
     }


     protected function addDefaultItem($grade, $contract)
     {
	// Le agregamos el item mensualidad por defecto
	   $item = ItemPeer::getItemsByGrade(2, $grade->getId(), 2, 1);// tipo mensualidad

	    if(is_object($item))
	    {

	       if($item->getQuantityLoad() > 0)
	       {
		  // Verifico si el item que se intenta agregar es de tipo mensualidad de colegio (type item = 2)
		  if($item->getTypeItemId() == 2) // Es de tipo mensualidad
		  {
		     // Verifico si este contrato ya tiene un item de tipo mensualidad agregado
//		     $item_for_sale = ItemForSalePeer::getMensualidad($contract->getId());
//
//		     if(!is_object($item_for_sale))
//		     {
			$quantity_load = $item->getQuantityLoad();
			$a_name_load = json_decode($item->getNameLoad(), 1);
			if($quantity_load == count($a_name_load))
			{
			   foreach ($a_name_load as $key => $value) {

			      $account = AccountPeer::getAccount(1, $value, $key, $contract->getId());

			      if(is_object($account) && $account->getIdState() == 1)
			      {
				   // verifico si la cuenta ya tiene un item de tipo mensualidad asigando
				   $item_for_sale = ItemForSalePeer::getMensualidadByAccountId($account->getId());

				   if(!is_object($item_for_sale))
				   {
				       $sales = new Sales();
				       $sales->setIdState(2);
				       $sales->setNumber(1);
				       $sales->setCashierId($this->getUser()->getId());
				       $sales->save($con);

				       $item_for_sale = new ItemForSale();
				       $item_for_sale->setSalesId($sales->getId());
				       $item_for_sale->setItemId($item->getId());
				       $item_for_sale->setName($item->getName());

				       $price = $item->getPrice();

				       $quantity = 1;

				       $item_for_sale->setPrice($item_for_sale->getAveragePrice($price, $quantity));

				       $item_for_sale->setQuantity($item_for_sale->getQuantity() + $quantity);

				       if ($item_for_sale->getDeleted() > $quantity)
				       {
					  $item_for_sale->setDeleted($item_for_sale->getDeleted() - $quantity);
				       } else {
					  $item_for_sale->setDeleted(0);
				       }

				       $item_for_sale->save($con);

				       $sales_account = new SaleAccount();
				       $sales_account->setAmount($sales->getTotalPrice());
				       $sales_account->setAccountId($account->getId());
				       $sales_account->setSalesId($sales->getId());
				       $sales_account->setIdState(1); // 1 = Cargado a cuenta, 2 = Cargado a cuenta y pagado 3 = cargado venta directa, 4 = cargado venta directa y pagado, 5 = anulado, 6 = eliminado
				       $sales_account->save($con);
				   }// termina la comprobacion de si la cuenta ya tiene item de tipo mensualidad

			      } else {
				 // Lanzamos excepcion
			      }
			   }
			}

//		     }
		  }

		}
	    } else {
	       $this->getUser()->setFlash('error', 'No existe este item', false);
	    }
     }


     public function executeSaveEnroll(sfWebRequest $request)
     {
	 if ($request->isMethod('POST'))
	 {
	    // Obtiene el ultimo periodo activo
            // $period = PeriodPeer::getPeriod(2);

	    // Obtenemos el periodo actualmente seleccionado
	    $period = PeriodPeer::retrieveByPK($this->getUser()->getAttribute('period'));

	    if(is_object($period))
	    {

		  // Obtenemos los datos del formulario
		  $data = $request->getParameter('student');

		  // A partir del identificador obtenemos al estudiante
		  $student = StudentPeer::retrieveByPK($data['id']);

		  $this->id = $student->getId();

		  $this->form = new EnrollForm($student);

		  $this->form->bind($data);// Seteamos los datos al formulario

		  if ($this->form->isValid()) // Verificamos si es valido
		  {

		     // Llamo a la funcion que verifica si se han ingresado los datos de uno de los tutores
		     if($this->validarTutor($this->form->getValue('padre_tutor_cedula_identidad'), $this->form->getValue('padre_tutor_nombre'), $this->form->getValue('padre_tutor_apellido_paterno'), $this->form->getValue('padre_tutor_apellido_materno')) || $this->validarTutor($this->form->getValue('madre_cedula_identidad'), $this->form->getValue('madre_nombre'), $this->form->getValue('madre_apellido_paterno'), $this->form->getValue('madre_apellido_materno')))
		     {

		       // Obtenemos el grado a partir de lo que haya seleccionado
		       if(isset($data['nivel_m']) && !empty($data['nivel_m']))
		       {
			  $grade = GradePeer::retrieveByPK($data['nivel_m']);
		       } else if(isset($data['nivel_t']) && !empty($data['nivel_t'])) {
			  $grade = GradePeer::retrieveByPK($data['nivel_t']);
		       } else if(isset($data['nivel_n']) && !empty($data['nivel_n'])) {
			  $grade = GradePeer::retrieveByPK($data['nivel_t']);
		       }

		       if(isset($grade) && is_object($grade))
		       {
			    $con = Propel::getConnection();
			    try
			    {
			       $con->beginTransaction(); // Iniciamos transaccion

			       // Obtenemos el person del estudiante
			       $person = $student->getPerson();

				if(is_object($person) && $person->getId() > 0)
				{
				   $birth_date = $this->form->getValue('fecha_nacimiento_anio').'-'.$this->form->getValue('fecha_nacimiento_mes').'-'.$this->form->getValue('fecha_nacimiento_dia').'00:00:00';

				   $student = StudentPeer::saveStudent(2,
					   strtoupper($this->form->getValue('estudiante_nombre')),
					   strtoupper($this->form->getValue('estudiante_apellido_paterno')),
					   strtoupper($this->form->getValue('estudiante_apellido_materno')),
					   strtoupper($this->form->getValue('rude')),
					   $student->getCodigo(),
					   $birth_date,
					   $this->form->getValue('estudiante_email'), $person->getId(), $student, $con);

				   if(is_object($student) && $student->getId() > 0)
				   {
				      $r = true;

				      $student_id = $student->getId();
				      $person_id = $person->getId();

				      // Atributos del estudiante attribute
				      if(isset($data['tipo_documento']) && !empty ($data['tipo_documento']))
				      {
					$attribute_tipo_documento = AttributePeer::getAttributeByKeyAndPerson('tipo_documento', $person_id);
					$attribute_tipo_documento = AttributePeer::saveAttribute(2, 'tipo_documento', $this->form->getValue('tipo_documento'), 'DOCUMENTO DE IDENTIFICACIÓN', 'DOCUMENTO DE IDENTIFICACIÓN', $person->getId(), $attribute_tipo_documento, $con);
					if(!is_object($attribute_tipo_documento) || $attribute_tipo_documento->getId() <= 0)
					{
					   $r = false;
					}
				      }

				      if(isset($data['estudiante_nro_documento']) && !empty($data['estudiante_nro_documento']))
				      {
					 $attribute_nro_documento = AttributePeer::getAttributeByKeyAndPerson('estudiante_nro_documento', $person_id);
					 $attribute_nro_documento = AttributePeer::saveAttribute(2, 'estudiante_nro_documento', strtoupper($this->form->getValue('estudiante_nro_documento')), 'No del documento de identificación', 'No del documento de identificación', $person->getId(), $attribute_nro_documento, $con);
					 if(!is_object($attribute_nro_documento) || $attribute_nro_documento->getId() <= 0)
					 {
					   $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_pais']) && !empty ($data['estudiante_nacimiento_pais']))
				      {
					 $attribute_estudiante_pais = AttributePeer::getAttributeByKeyAndPerson('estudiante_nacimiento_pais', $person_id);
					 $attribute_estudiante_pais = AttributePeer::saveAttribute(2, 'estudiante_nacimiento_pais', strtoupper($this->form->getValue('estudiante_nacimiento_pais')), 'País', 'País', $person->getId(), $attribute_estudiante_pais, $con);
					 if(!is_object($attribute_estudiante_pais) || $attribute_estudiante_pais->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_genero']) && !empty ($data['estudiante_genero']))
				      {
					 $attribute_estudiante_genero = AttributePeer::getAttributeByKeyAndPerson('estudiante_genero', $person_id);
					 $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', strtoupper($this->form->getValue('estudiante_genero')), 'SEXO', 'SEXO', $person->getId(), $attribute_estudiante_genero, $con);
					 if(!is_object($attribute_estudiante_genero) || $attribute_estudiante_genero->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_departamento']) && !empty ($data['estudiante_nacimiento_departamento']))
				      {
					 $attribute_estudiante_departamento = AttributePeer::getAttributeByKeyAndPerson('estudiante_departamento', $person_id);
					 $attribute_estudiante_departamento = AttributePeer::saveAttribute(2, 'estudiante_departamento', strtoupper($this->form->getValue('estudiante_nacimiento_departamento')), 'Departamento', 'Departamento', $person->getId(), $attribute_estudiante_departamento, $con);
					 if(!is_object($attribute_estudiante_departamento) || $attribute_estudiante_departamento->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_provincia']) && !empty($data['estudiante_nacimiento_provincia']))
				      {
					 $attribute_estudiante_provincia = AttributePeer::getAttributeByKeyAndPerson('estudiante_provincia', $person_id);
					 $attribute_estudiante_provincia = AttributePeer::saveAttribute(2, 'estudiante_provincia', strtoupper($this->form->getValue('estudiante_nacimiento_provincia')), 'Provincia', 'Provincia', $person->getId(), $attribute_estudiante_provincia, $con);
					 if(!is_object($attribute_estudiante_provincia) || $attribute_estudiante_provincia->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_localidad']) && !empty($data['estudiante_nacimiento_localidad']))
				      {
					 $attribute_estudiante_localidad = AttributePeer::getAttributeByKeyAndPerson('estudiante_localidad', $person_id);
					 $attribute_estudiante_localidad = AttributePeer::saveAttribute(2, 'estudiante_localidad', strtoupper($this->form->getValue('estudiante_nacimiento_localidad')), 'Localidad', 'Localidad', $person->getId(), $attribute_estudiante_localidad, $con);
					 if(!is_object($attribute_estudiante_localidad) || $attribute_estudiante_localidad->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_oficialia']) && !empty($data['certificado_nacimiento_oficialia']))
				      {
					 $attribute_certificado_nacimiento_oficialia = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_oficialia', $person_id);
					 $attribute_certificado_nacimiento_oficialia = AttributePeer::saveAttribute(2, 'certificado_nacimiento_oficialia', strtoupper($this->form->getValue('certificado_nacimiento_oficialia')), 'Oficialía No', 'Oficialía No', $person->getId(), $attribute_certificado_nacimiento_oficialia, $con);
					 if(!is_object($attribute_certificado_nacimiento_oficialia) || $attribute_certificado_nacimiento_oficialia->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_libro']) && !empty($data['certificado_nacimiento_libro']))
				      {
					 $attribute_certificado_nacimiento_libro = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_libro', $person_id);
					 $attribute_certificado_nacimiento_libro = AttributePeer::saveAttribute(2, 'certificado_nacimiento_libro', strtoupper($this->form->getValue('certificado_nacimiento_libro')), 'Libro No', 'Libro No', $person->getId(), $attribute_certificado_nacimiento_libro, $con);
					 if(!is_object($attribute_certificado_nacimiento_libro) || $attribute_certificado_nacimiento_libro->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_partida']) && !empty($data['certificado_nacimiento_partida']))
				      {
					 $attribute_certificado_nacimiento_partida = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_partida', $person_id);
					 $attribute_certificado_nacimiento_partida = AttributePeer::saveAttribute(2, 'certificado_nacimiento_partida', strtoupper($this->form->getValue('certificado_nacimiento_partida')), 'Partida No', 'Partida No', $person->getId(), $attribute_certificado_nacimiento_partida, $con);
					 if(!is_object($attribute_certificado_nacimiento_partida) || $attribute_certificado_nacimiento_partida->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_folio']) && !empty($data['certificado_nacimiento_folio']))
				      {
					 $attribute_certificado_nacimiento_folio = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_folio', $person_id);
					 $attribute_certificado_nacimiento_folio = AttributePeer::saveAttribute(2, 'certificado_nacimiento_folio', strtoupper($this->form->getValue('certificado_nacimiento_folio')), 'Folio N', 'Folio N', $person->getId(), $attribute_certificado_nacimiento_folio, $con);
					 if(!is_object($attribute_certificado_nacimiento_folio) || $attribute_certificado_nacimiento_folio->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      // Creamos al tutor
				      //TODO verificar si ya existen a partir del ci

				      // Tutores Madre
				      $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro

				      $student_tutor_madre = StudentTutorPeer::getStudentTutor($student_id, $type_tutor_id);

				      $tutor_madre = $student_tutor_madre->getTutor();

				      $persona_madre = $tutor_madre->getPerson();
				      if(is_object($persona_madre) && $persona_madre->getId() > 0)
				      {
					   $tutor_madre = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('madre_nombre')),
					   strtoupper($this->form->getValue('madre_apellido_paterno')),
					   strtoupper($this->form->getValue('madre_apellido_materno')),
					   strtoupper($this->form->getValue('madre_cedula_identidad')),
					   strtoupper($this->form->getValue('madre_idioma_frecuente')),
					   strtoupper($this->form->getValue('madre_ocupacion')),
					   strtoupper($this->form->getValue('madre_grado_instruccion')),
					   $this->form->getValue('madre_email'),
					   $type_tutor_id,
					   $persona_madre->getId(), $tutor_madre, $con);

					   if(is_object($tutor_madre) && $tutor_madre->getId() > 0)
					   {
					      $student_tutor_madre = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_madre->getId(), $student_tutor_madre, $con);

					      if(!is_object($student_tutor_madre) || $student_tutor_madre->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }

				      // Tutores
				   $type_tutor_id = 2;

				   if(isset($data['padre_tutor_parentesco']) && !empty($data['padre_tutor_parentesco']))
				   {
				      $parentesco = strtoupper($data['padre_tutor_parentesco']);

				      $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
				      if(!is_object($type_tutor))
				      {
					  $type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
				      }
				      $type_tutor_id = $type_tutor->getId();

				      $student_tutor = StudentTutorPeer::getStudentTutor($student_id, $type_tutor_id);

				      if(is_object($student_tutor))
				      {
					 $tutor_tutor = $student_tutor->getTutor();
					 $persona_tutor = $tutor_tutor->getPerson();
				      } else {
					$tutor_tutor = null;
					$persona_tutor = PersonPeer::savePerson(2, null, $con);
				      }

				      if(is_object($persona_tutor) && $persona_tutor->getId() > 0)
				      {
					   $tutor_tutor = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('padre_tutor_nombre')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_paterno')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_materno')),
					   strtoupper($this->form->getValue('padre_tutor_cedula_identidad')),
					   strtoupper($this->form->getValue('padre_tutor_idioma_frecuente')),
					   strtoupper($this->form->getValue('padre_tutor_ocupacion')),
					   strtoupper($this->form->getValue('padre_tutor_grado_instruccion')),
					   $this->form->getValue('padre_email'),
					   $type_tutor_id,
					   $persona_tutor->getId(), $tutor_tutor, $con);

					   if(is_object($tutor_tutor) && $tutor_tutor->getId() > 0)
					   {
					      $student_tutor = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_tutor->getId(), $student_tutor, $con);

					      if(!is_object($student_tutor) || $student_tutor->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }
				   }


				   // Creamos contract
				   $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

				   // $id_state, $nro, $amount, $container, $description, $record_date, $city, $student_id, $period_id, $contract = null, $con = null
				   $contract = ContractPeer::saveContract(1,'', 0, '', '', $fecha_registro, $data['lugar_registro'], $student_id, $period->getId(), null, $con);

				   if(is_object($contract) && $contract->getId() > 0)
				   {
				      $account1 = AccountPeer::saveAccount(1, 'Enero', 1, $contract->getId(), null, $con);
				      $account2 = AccountPeer::saveAccount(1, 'Febrero', 2, $contract->getId(), null, $con);
				      $account3 = AccountPeer::saveAccount(1, 'Marzo', 3, $contract->getId(), null, $con);
				      $account4 = AccountPeer::saveAccount(1, 'Abril', 4, $contract->getId(), null, $con);
				      $account5 = AccountPeer::saveAccount(1, 'Mayo', 5, $contract->getId(), null, $con);
				      $account6 = AccountPeer::saveAccount(1, 'Junio', 6, $contract->getId(), null, $con);
				      $account7 = AccountPeer::saveAccount(1, 'Julio', 7, $contract->getId(), null, $con);
				      $account8 = AccountPeer::saveAccount(1, 'Agosto', 8, $contract->getId(), null, $con);
				      $account9 = AccountPeer::saveAccount(1, 'Septiembre', 9, $contract->getId(), null, $con);
				      $account10 = AccountPeer::saveAccount(1, 'Octubre', 10, $contract->getId(), null, $con);
//				      $account11 = AccountPeer::saveAccount(1, 'Noviembre', 11, $contract->getId(), null, $con);
//				      $account12 = AccountPeer::saveAccount(1, 'Diciembre', 12, $contract->getId(), null, $con);
				   }

				   // Le asignamos al contrato del estudiante el nivel que le corresponde
				   $array_contract_grade = array('id_state' => 2, 'contract_id' => $contract->getId(), 'grade_id' => $grade->getId());

				   $contract_grade = ContractGradePeer::saveContractGrade($array_contract_grade, null, $con);

				   if(!is_object($contract_grade) || $contract_grade->getId() <= 0)
				   {
				      $r = false;
				   }


//				   $attribute_nivel = AttributeContractPeer::saveAttributeContract(2, 'nivel', $grade->getId(), '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', '3.1. NIVEL Y AÑO/GRADO ESCOLAR DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
//				   if(!is_object($attribute_nivel) || $attribute_nivel->getId() <= 0)
//				   {
//				       $r = false;
//				   }
//
//
//				   $attribute_paralelo = AttributeContractPeer::saveAttributeContract(2, 'paralelo', $grade->getParaleloId(), '3.2. PARALELO', '3.2. PARALELO', $contract->getId(), null, $con);
//				   if(!is_object($attribute_paralelo) || $attribute_paralelo->getId() <= 0)
//				   {
//				       $r = false;
//				   }
//
//
//				   $attribute_turno = AttributeContractPeer::saveAttributeContract(2, 'turno', $grade->getTimetableId(), '3.3. TURNO', '3.3. TURNO', $contract->getId(), null, $con);
//				   if(!is_object($attribute_turno) || $attribute_turno->getId() <= 0)
//				   {
//				       $r = false;
//				   }

				   if(isset($data['estudiante_direccion_provincia']) && !empty($data['estudiante_direccion_provincia']))
				   {
				      $attribute_estudiante_direccion_provincia = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_provincia', strtoupper($data['estudiante_direccion_provincia']), 'Provincia', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_provincia) || $attribute_estudiante_direccion_provincia->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_zona_villa']) && !empty($data['estudiante_direccion_zona_villa']))
				   {
				      $attribute_estudiante_direccion_zona_villa = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_zona_villa', strtoupper($data['estudiante_direccion_zona_villa']), 'Zona / Villa', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_zona_villa) || $attribute_estudiante_direccion_zona_villa->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_session_municipio']) && !empty($data['estudiante_direccion_session_municipio']))
				   {
				      $attribute_estudiante_direccion_session_municipio = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_session_municipio', strtoupper($data['estudiante_direccion_session_municipio']), 'Sección / Municipio', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_session_municipio) || $attribute_estudiante_direccion_session_municipio->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_avenida_calle']) && !empty($data['estudiante_direccion_avenida_calle']))
				   {
				      $attribute_estudiante_direccion_avenida_calle = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_avenida_calle', strtoupper($data['estudiante_direccion_avenida_calle']), 'Avenida / Calle', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_avenida_calle) || $attribute_estudiante_direccion_avenida_calle->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_localidad_comunidad']) && !empty($data['estudiante_direccion_localidad_comunidad']))
				   {
				      $attribute_estudiante_direccion_localidad_comunidad = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_localidad_comunidad', strtoupper($data['estudiante_direccion_localidad_comunidad']), 'Localidad / Comunidad', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_localidad_comunidad) || $attribute_estudiante_direccion_localidad_comunidad->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_celular']) && !empty($data['estudiante_direccion_celular']))
				   {
				      $attribute_estudiante_direccion_celular = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_celular', strtoupper($data['estudiante_direccion_celular']), 'Teléfono/Celular', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_celular) || $attribute_estudiante_direccion_celular->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_numero_vivienda']) && !empty($data['estudiante_direccion_numero_vivienda']))
				   {
				      $attribute_estudiante_direccion_numero_vivienda = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_numero_vivienda', strtoupper($data['estudiante_direccion_numero_vivienda']), 'Número de vivienda', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($attribute_estudiante_direccion_numero_vivienda) || $attribute_estudiante_direccion_numero_vivienda->getId() <= 0)
				      {
					  $r = false;
				      }
				   }


				   // Aspectos Sociales (Preguntas)
				   if(isset($data['idioma_nines']) && !empty($data['idioma_nines']))
				   {
				      $question_idioma_nines = QuestionPeer::saveQuestion(2, 'idioma_nines', strtoupper($data['idioma_nines']),
					 '5.1.1.¿Cuál es el idioma que aprendió a hablar en su niñez la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					  if(!is_object($question_idioma_nines) || $question_idioma_nines->getId() <= 0)
					  {
					     $r = false;
					  }
				   }

				   if(isset($data['idioma_habla_frecuentemente_1']) && !empty($data['idioma_habla_frecuentemente_1']))
				   {
				      $question_idioma_habla_frecuentemente_1 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_1', strtoupper($data['idioma_habla_frecuentemente_1']),
					 '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

				      if(!is_object($question_idioma_habla_frecuentemente_1) || $question_idioma_habla_frecuentemente_1->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['idioma_habla_frecuentemente_2']) && !empty($data['idioma_habla_frecuentemente_2']))
				   {
				      $question_idioma_habla_frecuentemente_2 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_2', strtoupper($data['idioma_habla_frecuentemente_2']),
					 '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($question_idioma_habla_frecuentemente_2) || $question_idioma_habla_frecuentemente_2->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['idioma_habla_frecuentemente_3']) && !empty($data['idioma_habla_frecuentemente_3']))
				   {
				      $question_idioma_habla_frecuentemente_3 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_3', strtoupper($data['idioma_habla_frecuentemente_3']),
					 '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

				      if(!is_object($question_idioma_habla_frecuentemente_3) || $question_idioma_habla_frecuentemente_3->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['pertenece']) && !empty($data['pertenece']))
				   {
				      foreach ($data['pertenece'] as $pertenece)
				      {
					 $question_pertenece = QuestionPeer::saveQuestion(2, 'pertenece', $pertenece,
					 '5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					 if(!is_object($question_pertenece) || $question_pertenece->getId() <= 0)
					 {
					    $r = false;
					    break;
					 }
				      }
				   }

				   if(isset($data['otro_pertenece']) &&  !empty($data['otro_pertenece']))
				   {
				      $question_otro_pertenece = QuestionPeer::saveQuestion(2, 'otro_pertenece', strtoupper($data['otro_pertenece']),
					 '5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					 if(!is_object($question_otro_pertenece) || $question_otro_pertenece->getId() <= 0)
					 {
					    $r = false;
					 }
				   }

				   if(isset($data['hospital']) && !empty($data['hospital']))
				   {
				      $question_hospital = QuestionPeer::saveQuestion(2, 'hospital', $data['hospital'],
				      '5.2.1.¿Existe Centro de Salud / Posta / Hospital en su comunidad?',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_hospital) || $question_hospital->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['hospital_veces']) || !empty ($data['hospital_veces']))
				   {
				      $question_veces = QuestionPeer::saveQuestion(2, 'hospital_veces', $data['hospital_veces'],
				      '5.2.2. ¿Cuántas veces fue la o el estudiante al centro de salud el año pasado?',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_veces) || $question_veces->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['discapacidad_sensorial']) && !empty($data['discapacidad_sensorial']))
				   {
				      $question_discapacidad_sensorial = QuestionPeer::saveQuestion(2, 'discapacidad', $data['discapacidad_sensorial'],
				      '5.2.3. Presenta la o el estudiante alguna discapacidad ',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_discapacidad_sensorial) || $question_discapacidad_sensorial->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if(isset($data['discapacidad_motriz']) && !empty($data['discapacidad_motriz']))
				   {
				      $question_discapacidad_motriz = QuestionPeer::saveQuestion(2, 'discapacidad', $data['discapacidad_motriz'],
				      '5.2.3. Presenta la o el estudiante alguna discapacidad ',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_discapacidad_motriz) || $question_discapacidad_motriz->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['discapacidad_mental']) && !empty($data['discapacidad_mental']))
				   {
				      $question_discapacidad_mental = QuestionPeer::saveQuestion(2, 'discapacidad', $data['discapacidad_mental'],
				      '5.2.3. Presenta la o el estudiante alguna discapacidad ',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_discapacidad_mental) || $question_discapacidad_mental->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if(isset($data['origen_discapacidad']) && !empty($data['origen_discapacidad']))
				   {
				      $question_origen_discapacidad = QuestionPeer::saveQuestion(2, 'origen_discapacidad', $data['origen_discapacidad'],
				      '5.2.4. Su discapacidad es:',
				      '5.2. SALUD', $contract->getId(), null, $con);
				      if(!is_object($question_origen_discapacidad) || $question_origen_discapacidad->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if(isset($data['acceso_servicio_basico']) && !empty($data['acceso_servicio_basico']))
				   {
				      $question_acceso_servicio_basico = QuestionPeer::saveQuestion(2, 'acceso_servicio_basico', $data['acceso_servicio_basico'],
				      '5.3.1. El agua de su casa proviene de:',
				      '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);
				      if(!is_object($question_acceso_servicio_basico) || $question_acceso_servicio_basico->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['energia_electrica']) && !empty($data['energia_electrica']))
				   {
				      $question_energia_electrica = QuestionPeer::saveQuestion(2, 'energia_electrica', $data['energia_electrica'],
				      '5.3.2. ¿La o el estudiante tiene energía eléctrica en su vivienda? ',
				      '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);

				      if(!is_object($question_energia_electrica) || $question_energia_electrica->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   // Aqui falta poner los datos del baño
				   if(isset($data['bano']) && !empty($data['bano']))
				   {
				      $bano = QuestionPeer::saveQuestion(2, 'bano', $data['bano'],
				      '5.3.3. El baño, water o letrina de su casa tiene desagüe a:  ',
				      '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);

				      if(!is_object($bano) || $bano->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['trabajo']) && !empty($data['trabajo']))
				   {
				      $question_trabajo = QuestionPeer::saveQuestion(2, 'trabajo', $data['trabajo'],
				      '5.4.1. ¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?',
				      '5.4. EMPLEO', $contract->getId(), null, $con);
				      if(!is_object($question_trabajo) || $question_trabajo->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['cuantos_dias_trabajo']) && !empty($data['cuantos_dias_trabajo']))
				   {
				      $question_cuantos_dias_trabajo = QuestionPeer::saveQuestion(2, 'cuantos_dias_trabajo', strtoupper($data['cuantos_dias_trabajo']),
				      '5.4.2. La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante? ',
				      '5.4. EMPLEO', $student_id, null, $con);
				      if(!is_object($question_cuantos_dias_trabajo) || $question_cuantos_dias_trabajo->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['recibio_pago']) && !empty($data['recibio_pago']))
				   {
				      $question_recibio_pago = QuestionPeer::saveQuestion(2, 'recibio_pago', $data['recibio_pago'],
				      '5.4.3. ¿Recibió algún pago por el trabajo realizado? ',
				      '5.4. EMPLEO', $contract->getId(), null, $con);
				      if(!is_object($question_recibio_pago) || $question_recibio_pago->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['accede_internet']) && !empty($data['accede_internet']))
				   {
				      foreach ($data['accede_internet'] as $accede_internet)
				      {
					 $question_accede_internet = QuestionPeer::saveQuestion(2, 'accede_internet', $accede_internet,
					 '5.5.1. La o el estudiante accede a internet en:',
					 '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE ', $contract->getId(), null, $con);
					 if(!is_object($question_accede_internet) || $question_accede_internet->getId() <= 0)
					 {
					     $r = false;
					 }
				      }
				   }

				   if(isset($data['frecuencia_internet']) && !empty($data['frecuencia_internet']))
				   {
				      $question_frecuencia_internet = QuestionPeer::saveQuestion(2, 'frecuencia_internet', $data['frecuencia_internet'],
				      '5.5.2. ¿Con qué frecuencia la o el estudiante accede a internet?',
				      '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), null, $con);
				      if(!is_object($question_frecuencia_internet) || $question_frecuencia_internet->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['transporte']) && !empty($data['transporte']))
				   {
				      $question_transporte = QuestionPeer::saveQuestion(2, 'transporte', $data['transporte'],
				      '5.5.3. ¿Cómo llega la o el estudiante a la Unidad Educativa? ',
				      '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), null, $con);
				      if(!is_object($question_transporte) || $question_transporte->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['tiempo_transporte']) && !empty($data['tiempo_transporte']))
				   {
				      $question_tiempo_transporte = QuestionPeer::saveQuestion(2, 'tiempo_transporte', $data['tiempo_transporte'],
				      '5.5.4. En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?',
				      '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), null, $con);

				      if(!is_object($question_tiempo_transporte) || $question_tiempo_transporte->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if($r)
				   {
				      $this->addDefaultItem($grade, $contract);
                       	              $con->commit();
				       $this->getUser()->setFlash('notice', 'Creo con exito un nuevo estudiante', false);
				       $this->redirect('/Student/account/id/'.$student_id);
				   } else {
				      $this->getUser()->setFlash('error', "Ocurrio un error inesperado, comuniquese con el Administrador del sistema", false);
				   }

				 }// end student
			      }// end person
			    } catch (exception $e) {
				$con->rollback();
				throw $e;
				$this->getUser()->setFlash('error', $e, false);
			    }
		       } else {
			   $this->getUser()->setFlash('error', "Debe seleccionar el nivel escolar del estudiante", false);
		       }

		       } else {
			   $this->getUser()->setFlash('error', "Debe ingresar los datos de uno de los tutores del alumno", false);
		       }

		  } else {
		      $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
		  }

	    } else {
	       $this->getUser()->setFlash('error', "Debe seleccionar el periodo escolar para el que lo esta inscribiendo", false);
            }
	 }

       $this->setTemplate('enroll');
     }

     public function executeRecordShortEdit(sfWebRequest $request)
     {
       $this->Student = StudentPeer::retrieveByPK($request->getParameter('id'));

       $this->form = new StudentEditForm($this->Student);

       $this->setTemplate('recordShortEdit');
     }

     public function executeUpdate(sfWebRequest $request)
     {
	 if ($request->isMethod('POST'))
	 {

	    // Obtenemos los datos del formulario
	    $data = $request->getParameter('student');

	    // A partir del identificador obtenemos al estudiante
	    $student = StudentPeer::retrieveByPK($data['id']);

	    $this->Student = $student;

	    $this->form = new StudentEditForm($this->Student);

	    // Obtenemos el periodo actualmente seleccionado
	    $period = PeriodPeer::retrieveByPK($this->getUser()->getAttribute('period'));

	    if(is_object($period))
	    {
		  $this->form->bind($data);// Seteamos los datos al formulario

		  if ($this->form->isValid()) // Verificamos si es valido
		  {

		     // Llamo a la funcion que verifica si se han ingresado los datos de uno de los tutores
		     if($this->validarTutor($this->form->getValue('padre_tutor_cedula_identidad'), $this->form->getValue('padre_tutor_nombre'), $this->form->getValue('padre_tutor_apellido_paterno'), $this->form->getValue('padre_tutor_apellido_materno')) || $this->validarTutor($this->form->getValue('madre_cedula_identidad'), $this->form->getValue('madre_nombre'), $this->form->getValue('madre_apellido_paterno'), $this->form->getValue('madre_apellido_materno')))
		     {
		       // Obtenemos el grado a partir de lo que haya seleccionado
		       if(isset($data['nivel_m']) && !empty($data['nivel_m']))
		       {
			  $grade = GradePeer::retrieveByPK($data['nivel_m']);
		       } else if(isset($data['nivel_t']) && !empty($data['nivel_t'])) {
			  $grade = GradePeer::retrieveByPK($data['nivel_t']);
		       } else if(isset($data['nivel_n']) && !empty($data['nivel_n'])) {
			  $grade = GradePeer::retrieveByPK($data['nivel_t']);
		       }

		       if(isset($grade) && is_object($grade))
		       {
			    $con = Propel::getConnection();
			    try
			    {
			       $con->beginTransaction(); // Iniciamos transaccion

			       // Obtenemos el person del estudiante
			       $person = $this->Student->getPerson();

			       $student_id = $this->Student->getId();


				if(is_object($person) && $person->getId() > 0)
				{
				   $birth_date = $this->form->getValue('fecha_nacimiento_anio').''.$this->form->getValue('fecha_nacimiento_mes').''.$this->form->getValue('fecha_nacimiento_dia').'00:00:00';

				   $student = StudentPeer::saveStudent(2,
					   strtoupper($this->form->getValue('estudiante_nombre')),
					   strtoupper($this->form->getValue('estudiante_apellido_paterno')),
					   strtoupper($this->form->getValue('estudiante_apellido_materno')),
					   strtoupper($this->form->getValue('rude')),
					   $student->getCodigo(),
					   $birth_date,
					   $this->form->getValue('estudiante_email'), $person->getId(), $student, $con);

				   if(is_object($student) && $student->getId() > 0)
				   {
				      $r = true;

				      $person_id = $person->getId();

				      // Atributos del estudiante attribute
				      if(isset($data['tipo_documento']) && !empty ($data['tipo_documento']))
				      {
					$attribute_tipo_documento = AttributePeer::getAttributeByKeyAndPerson('tipo_documento', $person_id);
					$attribute_tipo_documento = AttributePeer::saveAttribute(2, 'tipo_documento', $this->form->getValue('tipo_documento'), 'DOCUMENTO DE IDENTIFICACIÓN', 'DOCUMENTO DE IDENTIFICACIÓN', $person->getId(), $attribute_tipo_documento, $con);
					if(!is_object($attribute_tipo_documento) || $attribute_tipo_documento->getId() <= 0)
					{
					   $r = false;
					}
				      }

				      if(isset($data['estudiante_nro_documento']) && !empty($data['estudiante_nro_documento']))
				      {
					 $attribute_nro_documento = AttributePeer::getAttributeByKeyAndPerson('estudiante_nro_documento', $person_id);
					 $attribute_nro_documento = AttributePeer::saveAttribute(2, 'estudiante_nro_documento', strtoupper($this->form->getValue('estudiante_nro_documento')), 'No del documento de identificación', 'No del documento de identificación', $person->getId(), $attribute_nro_documento, $con);
					 if(!is_object($attribute_nro_documento) || $attribute_nro_documento->getId() <= 0)
					 {
					   $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_pais']) && !empty ($data['estudiante_nacimiento_pais']))
				      {
					 $attribute_estudiante_pais = AttributePeer::getAttributeByKeyAndPerson('estudiante_nacimiento_pais', $person_id);
					 $attribute_estudiante_pais = AttributePeer::saveAttribute(2, 'estudiante_nacimiento_pais', strtoupper($this->form->getValue('estudiante_nacimiento_pais')), 'País', 'País', $person->getId(), $attribute_estudiante_pais, $con);
					 if(!is_object($attribute_estudiante_pais) || $attribute_estudiante_pais->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_genero']) && !empty ($data['estudiante_genero']))
				      {
					 $attribute_estudiante_genero = AttributePeer::getAttributeByKeyAndPerson('estudiante_genero', $person_id);
					 $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', $this->form->getValue('estudiante_genero'), 'SEXO', 'SEXO', $person->getId(), $attribute_estudiante_genero, $con);
					 if(!is_object($attribute_estudiante_genero) || $attribute_estudiante_genero->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_departamento']) && !empty ($data['estudiante_nacimiento_departamento']))
				      {
					 $attribute_estudiante_departamento = AttributePeer::getAttributeByKeyAndPerson('estudiante_departamento', $person_id);
					 $attribute_estudiante_departamento = AttributePeer::saveAttribute(2, 'estudiante_departamento', strtoupper($this->form->getValue('estudiante_nacimiento_departamento')), 'Departamento', 'Departamento', $person->getId(), $attribute_estudiante_departamento, $con);
					 if(!is_object($attribute_estudiante_departamento) || $attribute_estudiante_departamento->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_provincia']) && !empty($data['estudiante_nacimiento_provincia']))
				      {
					 $attribute_estudiante_provincia = AttributePeer::getAttributeByKeyAndPerson('estudiante_provincia', $person_id);
					 $attribute_estudiante_provincia = AttributePeer::saveAttribute(2, 'estudiante_provincia', strtoupper($this->form->getValue('estudiante_nacimiento_provincia')), 'Provincia', 'Provincia', $person->getId(), $attribute_estudiante_provincia, $con);
					 if(!is_object($attribute_estudiante_provincia) || $attribute_estudiante_provincia->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['estudiante_nacimiento_localidad']) && !empty($data['estudiante_nacimiento_localidad']))
				      {
					 $attribute_estudiante_localidad = AttributePeer::getAttributeByKeyAndPerson('estudiante_localidad', $person_id);
					 $attribute_estudiante_localidad = AttributePeer::saveAttribute(2, 'estudiante_localidad', strtoupper($this->form->getValue('estudiante_nacimiento_localidad')), 'Localidad', 'Localidad', $person->getId(), $attribute_estudiante_localidad, $con);
					 if(!is_object($attribute_estudiante_localidad) || $attribute_estudiante_localidad->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_oficialia']) && !empty($data['certificado_nacimiento_oficialia']))
				      {
					 $attribute_certificado_nacimiento_oficialia = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_oficialia', $person_id);
					 $attribute_certificado_nacimiento_oficialia = AttributePeer::saveAttribute(2, 'certificado_nacimiento_oficialia', strtoupper($this->form->getValue('certificado_nacimiento_oficialia')), 'Oficialía No', 'Oficialía No', $person->getId(), $attribute_certificado_nacimiento_oficialia, $con);
					 if(!is_object($attribute_certificado_nacimiento_oficialia) || $attribute_certificado_nacimiento_oficialia->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_libro']) && !empty($data['certificado_nacimiento_libro']))
				      {
					 $attribute_certificado_nacimiento_libro = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_libro', $person_id);
					 $attribute_certificado_nacimiento_libro = AttributePeer::saveAttribute(2, 'certificado_nacimiento_libro', strtoupper($this->form->getValue('certificado_nacimiento_libro')), 'Libro No', 'Libro No', $person->getId(), $attribute_certificado_nacimiento_libro, $con);
					 if(!is_object($attribute_certificado_nacimiento_libro) || $attribute_certificado_nacimiento_libro->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_partida']) && !empty($data['certificado_nacimiento_partida']))
				      {
					 $attribute_certificado_nacimiento_partida = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_partida', $person_id);
					 $attribute_certificado_nacimiento_partida = AttributePeer::saveAttribute(2, 'certificado_nacimiento_partida', strtoupper($this->form->getValue('certificado_nacimiento_partida')), 'Partida No', 'Partida No', $person->getId(), $attribute_certificado_nacimiento_partida, $con);
					 if(!is_object($attribute_certificado_nacimiento_partida) || $attribute_certificado_nacimiento_partida->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      if(isset($data['certificado_nacimiento_folio']) && !empty($data['certificado_nacimiento_folio']))
				      {
					 $attribute_certificado_nacimiento_folio = AttributePeer::getAttributeByKeyAndPerson('certificado_nacimiento_folio', $person_id);
					 $attribute_certificado_nacimiento_folio = AttributePeer::saveAttribute(2, 'certificado_nacimiento_folio', strtoupper($this->form->getValue('certificado_nacimiento_folio')), 'Folio N', 'Folio N', $person->getId(), $attribute_certificado_nacimiento_folio, $con);
					 if(!is_object($attribute_certificado_nacimiento_folio) || $attribute_certificado_nacimiento_folio->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      // Creamos al tutor
				      //TODO verificar si ya existen a partir del ci

				      // Tutores Madre
				      $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro

				      $student_tutor_madre = StudentTutorPeer::getStudentTutor($student_id, $type_tutor_id);

				      $tutor_madre = $student_tutor_madre->getTutor();

				      $persona_madre = $tutor_madre->getPerson();
				      if(is_object($persona_madre) && $persona_madre->getId() > 0)
				      {
					   $tutor_madre = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('madre_nombre')),
					   strtoupper($this->form->getValue('madre_apellido_paterno')),
					   strtoupper($this->form->getValue('madre_apellido_materno')),
					   strtoupper($this->form->getValue('madre_cedula_identidad')),
					   strtoupper($this->form->getValue('madre_idioma_frecuente')),
					   strtoupper($this->form->getValue('madre_ocupacion')),
					   strtoupper($this->form->getValue('madre_grado_instruccion')),
					   $this->form->getValue('madre_email'),
					   $type_tutor_id,
					   $persona_madre->getId(), $tutor_madre, $con);

					   if(is_object($tutor_madre) && $tutor_madre->getId() > 0)
					   {
					      $student_tutor_madre = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_madre->getId(), $student_tutor_madre, $con);

					      if(!is_object($student_tutor_madre) || $student_tutor_madre->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }

				      // Tutores
				   $type_tutor_id = 2;

				   if(isset($data['padre_tutor_parentesco']) && !empty($data['padre_tutor_parentesco']))
				   {
				      $parentesco = strtoupper($data['padre_tutor_parentesco']);

				      $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
				      if(!is_object($type_tutor))
				      {
					  $type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
				      }
				      $type_tutor_id = $type_tutor->getId();

				      $student_tutor = StudentTutorPeer::getStudentTutor($student_id, $type_tutor_id);

				      if(is_object($student_tutor))
				      {
					 $tutor_tutor = $student_tutor->getTutor();
					 $persona_tutor = $tutor_tutor->getPerson();
				      } else {
					$tutor_tutor = null;
					$persona_tutor = PersonPeer::savePerson(2, null, $con);
				      }

				      if(is_object($persona_tutor) && $persona_tutor->getId() > 0)
				      {
					   $tutor_tutor = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('padre_tutor_nombre')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_paterno')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_materno')),
					   strtoupper($this->form->getValue('padre_tutor_cedula_identidad')),
					   strtoupper($this->form->getValue('padre_tutor_idioma_frecuente')),
					   strtoupper($this->form->getValue('padre_tutor_ocupacion')),
					   strtoupper($this->form->getValue('padre_tutor_grado_instruccion')),
					   $this->form->getValue('padre_email'),
					   $type_tutor_id,
					   $persona_tutor->getId(), $tutor_tutor, $con);

					   if(is_object($tutor_tutor) && $tutor_tutor->getId() > 0)
					   {
					      $student_tutor = StudentTutorPeer::saveStudentTutor(2, $student_id, $tutor_tutor->getId(), $student_tutor, $con);

					      if(!is_object($student_tutor) || $student_tutor->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }
				   }


				   // Creamos contract
				   $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

				   $contract = ContractPeer::retrieveByPK($this->form->getValue('contract_id'));

				   // Verifico que el contrato pertenece a la gestion actualmente activa
				   if($contract->getPeriod()->getIdState() == 2)
				   {
				      // Cambiamos los datos del contrato
				      $contract = ContractPeer::saveContract(1,$contract->getNro(), 0, $contract->getContainer(), '', $fecha_registro, strtoupper($data['lugar_registro']), $student->getId(), $contract->getPeriodId(), $contract, $con);

				      // Verificamos a que curso estaba inscrito el estudiante
				      $contract_grade = ContractGradePeer::getContractGrade($contract->getId(), null, 2);
				      // Solo debe dejarlo cambiar de curso si es para
				      // la gestion actualmente vigente, si es una gestion pasada no debe permitirle cambiar de curso
				      if($contract_grade && $contract_grade->getGradeId() != $grade->getId()) // Verifico si lo esta cambiando de curso
				      {
					 // Inactivamos para el curso anterior
					 $contract_grade->setIdState(3);
					 $contract_grade->save($con);

					 // Eliminamos todos los items de tipo mensualidad asignados a este estudiante que no esten pagados.
					 $contract->EliminarMensualidadesSinPago($con);

					 // Realizamos el cambio de curso
					 // Le asignamos al contrato del estudiante el nivel que le corresponde
					 $array_contract_grade = array('id_state' => 2, 'contract_id' => $contract->getId(), 'grade_id' => $grade->getId());

					 $new_contract_grade = ContractGradePeer::saveContractGrade($array_contract_grade, null, $con);

					 if(is_object($new_contract_grade) && $new_contract_grade->getId() > 0)
					 {
					    // Le agregamos la nueva mensualidad segun el nuevo curso al que lo estan cambiando
					    $this->addDefaultItem($grade, $contract);
					 } else {
					    $r = false;
					 }
				      }
				   }

				   if(isset($data['estudiante_direccion_provincia']) && !empty($data['estudiante_direccion_provincia']))
				   {
                                      $attribute_estudiante_direccion_provincia = null;
                                      $attribute_estudiante_direccion_provincia = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_provincia', $contract->getId());

				      $attribute_estudiante_direccion_provincia = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_provincia', strtoupper($data['estudiante_direccion_provincia']), 'Provincia', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_provincia, $con);
				      if(!is_object($attribute_estudiante_direccion_provincia) || $attribute_estudiante_direccion_provincia->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_zona_villa']) && !empty($data['estudiante_direccion_zona_villa']))
				   {
                                      $attribute_estudiante_direccion_zona_villa = null;
                                      $attribute_estudiante_direccion_zona_villa = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_zona_villa', $contract->getId());

				      $attribute_estudiante_direccion_zona_villa = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_zona_villa', strtoupper($data['estudiante_direccion_zona_villa']), 'Zona / Villa', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_zona_villa, $con);
				      if(!is_object($attribute_estudiante_direccion_zona_villa) || $attribute_estudiante_direccion_zona_villa->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_session_municipio']) && !empty($data['estudiante_direccion_session_municipio']))
				   {
                                      $attribute_estudiante_direccion_session_municipio = null;
                                      $attribute_estudiante_direccion_session_municipio = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_session_municipio', $contract->getId());

				      $attribute_estudiante_direccion_session_municipio = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_session_municipio', strtoupper($data['estudiante_direccion_session_municipio']), 'Sección / Municipio', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_session_municipio, $con);
				      if(!is_object($attribute_estudiante_direccion_session_municipio) || $attribute_estudiante_direccion_session_municipio->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_avenida_calle']) && !empty($data['estudiante_direccion_avenida_calle']))
				   {
                                      $attribute_estudiante_direccion_avenida_calle = null;
                                      $attribute_estudiante_direccion_avenida_calle = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_avenida_calle', $contract->getId());

				      $attribute_estudiante_direccion_avenida_calle = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_avenida_calle', strtoupper($data['estudiante_direccion_avenida_calle']), 'Avenida / Calle', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_avenida_calle, $con);
				      if(!is_object($attribute_estudiante_direccion_avenida_calle) || $attribute_estudiante_direccion_avenida_calle->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_localidad_comunidad']) && !empty($data['estudiante_direccion_localidad_comunidad']))
				   {
                                      $attribute_estudiante_direccion_localidad_comunidad = null;
                                      $attribute_estudiante_direccion_localidad_comunidad = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_localidad_comunidad', $contract->getId());

				      $attribute_estudiante_direccion_localidad_comunidad = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_localidad_comunidad', strtoupper($data['estudiante_direccion_localidad_comunidad']), 'Localidad / Comunidad', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_localidad_comunidad, $con);
				      if(!is_object($attribute_estudiante_direccion_localidad_comunidad) || $attribute_estudiante_direccion_localidad_comunidad->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_celular']) && !empty($data['estudiante_direccion_celular']))
				   {
                                      $attribute_estudiante_direccion_celular = null;
                                      $attribute_estudiante_direccion_celular = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_celular', $contract->getId());

				      $attribute_estudiante_direccion_celular = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_celular', strtoupper($data['estudiante_direccion_celular']), 'Teléfono/Celular', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_celular, $con);
				      if(!is_object($attribute_estudiante_direccion_celular) || $attribute_estudiante_direccion_celular->getId() <= 0)
				      {
					  $r = false;
				      }
				   }

				   if(isset($data['estudiante_direccion_numero_vivienda']) && !empty($data['estudiante_direccion_numero_vivienda']))
				   {
                                      $attribute_estudiante_direccion_numero_vivienda = null;
                                      $attribute_estudiante_direccion_numero_vivienda = AttributeContractPeer::getAttributeByKeyAndContract('estudiante_direccion_numero_vivienda', $contract->getId());

				      $attribute_estudiante_direccion_numero_vivienda = AttributeContractPeer::saveAttributeContract(2, 'estudiante_direccion_numero_vivienda', strtoupper($data['estudiante_direccion_numero_vivienda']), 'Número de vivienda', 'IV. DIRECCIÓN ACTUAL DE LA O EL ESTUDIANTE', $contract->getId(), $attribute_estudiante_direccion_numero_vivienda, $con);
				      if(!is_object($attribute_estudiante_direccion_numero_vivienda) || $attribute_estudiante_direccion_numero_vivienda->getId() <= 0)
				      {
					  $r = false;
				      }
				   }


				   // Aspectos Sociales (Preguntas)
				   if(isset($data['idioma_nines']) && !empty($data['idioma_nines']))
				   {
                                      $question_idioma_nines = null;
                                      $question_idioma_nines = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'idioma_nines');

				      $question_idioma_nines = QuestionPeer::saveQuestion(2, 'idioma_nines', strtoupper($data['idioma_nines']),
					 '5.1.1.¿Cuál es el idioma que aprendió a hablar en su niñez la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), $question_idioma_nines, $con);

					  if(!is_object($question_idioma_nines) || $question_idioma_nines->getId() <= 0)
					  {
					     $r = false;
					  }
				   }

				   if(isset($data['idioma_habla_frecuentemente_1']) && !empty($data['idioma_habla_frecuentemente_1']))
				   {
                                      $question_idioma_habla_frecuentemente_1 = null;
                                      $question_idioma_habla_frecuentemente_1 = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'idioma_habla_frecuentemente_1');

				      $question_idioma_habla_frecuentemente_1 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_1', strtoupper($data['idioma_habla_frecuentemente_1']),
					 '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), $question_idioma_habla_frecuentemente_1, $con);

				      if(!is_object($question_idioma_habla_frecuentemente_1) || $question_idioma_habla_frecuentemente_1->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['idioma_habla_frecuentemente_2']) && !empty($data['idioma_habla_frecuentemente_2']))
				   {
                                      $question_idioma_habla_frecuentemente_2 = null;
                                      $question_idioma_habla_frecuentemente_2 = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'idioma_habla_frecuentemente_2');

				      $question_idioma_habla_frecuentemente_2 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_2', strtoupper($data['idioma_habla_frecuentemente_2']),
					 '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);
				      if(!is_object($question_idioma_habla_frecuentemente_2) || $question_idioma_habla_frecuentemente_2->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['idioma_habla_frecuentemente_3']) && !empty($data['idioma_habla_frecuentemente_3']))
				   {
                                      $question_idioma_habla_frecuentemente_3 = null;
                                      $question_idioma_habla_frecuentemente_3 = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'idioma_habla_frecuentemente_3');

				      $question_idioma_habla_frecuentemente_3 = QuestionPeer::saveQuestion(2, 'idioma_habla_frecuentemente_3', strtoupper($data['idioma_habla_frecuentemente_3']),
					 '5.1.2. ¿Qué idiomas habla frecuentemente la o el estudiante?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), $question_idioma_habla_frecuentemente_3, $con);

				      if(!is_object($question_idioma_habla_frecuentemente_3) || $question_idioma_habla_frecuentemente_3->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['pertenece']) && !empty($data['pertenece']))
				   {
				      foreach ($data['pertenece'] as $pertenece)
				      {

					 $question_pertenece = QuestionPeer::saveQuestion(2, 'pertenece', $pertenece,
					 '5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), null, $con);

					 if(!is_object($question_pertenece) || $question_pertenece->getId() <= 0)
					 {
					    $r = false;
					    break;
					 }
				      }
				   }

				   if(isset($data['otro_pertenece']) &&  !empty($data['otro_pertenece']))
				   {
                                      $question_otro_pertenece = null;
                                      $question_otro_pertenece = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'otro_pertenece');

				      $question_otro_pertenece = QuestionPeer::saveQuestion(2, 'otro_pertenece', strtoupper($data['otro_pertenece']),
					 '5.1.3. ¿Pertenece a alguna nación, pueblo indígena originario campesino o afroboliviano?',
					 'V. ASPECTOS SOCIALES, 5.1. IDIOMAS Y PERTENENCIA DE LA O EL ESTUDIANTE', $contract->getId(), $question_otro_pertenece, $con);

					 if(!is_object($question_otro_pertenece) || $question_otro_pertenece->getId() <= 0)
					 {
					    $r = false;
					 }
				   }

				   if(isset($data['hospital']) && !empty($data['hospital']))
				   {
                                      $question_hospital = null;
                                      $question_hospital = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'hospital');

				      $question_hospital = QuestionPeer::saveQuestion(2, 'hospital', $data['hospital'],
				      '5.2.1.¿Existe Centro de Salud / Posta / Hospital en su comunidad?',
				      '5.2. SALUD', $contract->getId(), $question_hospital, $con);

				      if(!is_object($question_hospital) || $question_hospital->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['hospital_veces']) || !empty ($data['hospital_veces']))
				   {
                                      $question_veces = null;
                                      $question_veces = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'hospital_veces');

				      $question_veces = QuestionPeer::saveQuestion(2, 'hospital_veces', $data['hospital_veces'],
				      '5.2.2. ¿Cuántas veces fue la o el estudiante al centro de salud el año pasado?',
				      '5.2. SALUD', $contract->getId(), $question_veces, $con);

				      if(!is_object($question_veces) || $question_veces->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['discapacidad_sensorial']) && !empty($data['discapacidad_sensorial']))
				   {
                                      $question_discapacidad_sensorial = null;
                                      $question_discapacidad_sensorial = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'discapacidad_sensorial');

				      $question_discapacidad_sensorial = QuestionPeer::saveQuestion(2, 'discapacidad_sensorial', $data['discapacidad_sensorial'],
				      '5.2.3. Presenta la o el estudiante alguna discapacidad ',
				      '5.2. SALUD', $contract->getId(), $question_discapacidad_sensorial, $con);

				      if(!is_object($question_discapacidad_sensorial) || $question_discapacidad_sensorial->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if(isset($data['discapacidad_motriz']) && !empty($data['discapacidad_motriz']))
				   {
                                      $question_discapacidad_motriz = null;
                                      $question_discapacidad_motriz = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'discapacidad_motriz');

				      $question_discapacidad_motriz = QuestionPeer::saveQuestion(2, 'discapacidad_motriz', $data['discapacidad_motriz'],
				      '5.2.3. Presenta la o el estudiante alguna discapacidad ',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_discapacidad_motriz) || $question_discapacidad_motriz->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['discapacidad_mental']) && !empty($data['discapacidad_mental']))
				   {
                                      $question_discapacidad_mental = null;
                                      $question_discapacidad_mental = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'discapacidad_mental');

				      $question_discapacidad_mental = QuestionPeer::saveQuestion(2, 'discapacidad_mental', $data['discapacidad_mental'],
				      '5.2.3. Presenta la o el estudiante alguna discapacidad ',
				      '5.2. SALUD', $contract->getId(), null, $con);

				      if(!is_object($question_discapacidad_mental) || $question_discapacidad_mental->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if(isset($data['origen_discapacidad']) && !empty($data['origen_discapacidad']))
				   {
                                      $question_origen_discapacidad = null;
                                      $question_origen_discapacidad = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'origen_discapacidad');

				      $question_origen_discapacidad = QuestionPeer::saveQuestion(2, 'origen_discapacidad', $data['origen_discapacidad'],
				      '5.2.4. Su discapacidad es:',
				      '5.2. SALUD', $contract->getId(), $question_origen_discapacidad, $con);
				      if(!is_object($question_origen_discapacidad) || $question_origen_discapacidad->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if(isset($data['acceso_servicio_basico']) && !empty($data['acceso_servicio_basico']))
				   {
                                      $question_acceso_servicio_basico = null;
                                      $question_acceso_servicio_basico = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'acceso_servicio_basico');

				      $question_acceso_servicio_basico = QuestionPeer::saveQuestion(2, 'acceso_servicio_basico', $data['acceso_servicio_basico'],
				      '5.3.1. El agua de su casa proviene de:',
				      '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), null, $con);
				      if(!is_object($question_acceso_servicio_basico) || $question_acceso_servicio_basico->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['energia_electrica']) && !empty($data['energia_electrica']))
				   {
                                      $question_energia_electrica = null;
                                      $question_energia_electrica = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'energia_electrica');

				      $question_energia_electrica = QuestionPeer::saveQuestion(2, 'energia_electrica', $data['energia_electrica'],
				      '5.3.2. ¿La o el estudiante tiene energía eléctrica en su vivienda? ',
				      '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), $question_energia_electrica, $con);

				      if(!is_object($question_energia_electrica) || $question_energia_electrica->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   // Aqui falta poner los datos del baño
				   if(isset($data['bano']) && !empty($data['bano']))
				   {
                                      $bano = null;
                                      $bano = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'bano');

				      $bano = QuestionPeer::saveQuestion(2, 'bano', $data['bano'],
				      '5.3.3. El baño, water o letrina de su casa tiene desagüe a:  ',
				      '5.3. ACCESO A SERVICIOS BÁSICOS', $contract->getId(), $bano, $con);

				      if(!is_object($bano) || $bano->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['trabajo']) && !empty($data['trabajo']))
				   {
                                      $bano = null;
                                      $bano = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'bano');

				      $question_trabajo = QuestionPeer::saveQuestion(2, 'trabajo', $data['trabajo'],
				      '5.4.1. ¿Realizó la o el estudiante en los últimos 3 meses alguna de las siguientes actividades?',
				      '5.4. EMPLEO', $contract->getId(), null, $con);
				      if(!is_object($question_trabajo) || $question_trabajo->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['cuantos_dias_trabajo']) && !empty($data['cuantos_dias_trabajo']))
				   {
                                      $question_cuantos_dias_trabajo = null;
                                      $question_cuantos_dias_trabajo = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'cuantos_dias_trabajo');

				      $question_cuantos_dias_trabajo = QuestionPeer::saveQuestion(2, 'cuantos_dias_trabajo', strtoupper($data['cuantos_dias_trabajo']),
				      '5.4.2. La semana pasada ¿Cuántos días trabajó o ayudó a la familia la o el estudiante? ',
				      '5.4. EMPLEO', $student_id, $question_cuantos_dias_trabajo, $con);
				      if(!is_object($question_cuantos_dias_trabajo) || $question_cuantos_dias_trabajo->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['recibio_pago']) && !empty($data['recibio_pago']))
				   {
                                      $question_recibio_pago = null;
                                      $question_recibio_pago = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'recibio_pago');

				      $question_recibio_pago = QuestionPeer::saveQuestion(2, 'recibio_pago', $data['recibio_pago'],
				      '5.4.3. ¿Recibió algún pago por el trabajo realizado? ',
				      '5.4. EMPLEO', $contract->getId(), $question_recibio_pago, $con);
				      if(!is_object($question_recibio_pago) || $question_recibio_pago->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['accede_internet']) && !empty($data['accede_internet']))
				   {
				      foreach ($data['accede_internet'] as $accede_internet)
				      {
                                         $question_accede_internet = null;
                                         $question_accede_internet = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'accede_internet');

					 $question_accede_internet = QuestionPeer::saveQuestion(2, 'accede_internet', $accede_internet,
					 '5.5.1. La o el estudiante accede a internet en:',
					 '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE ', $contract->getId(), $question_accede_internet, $con);
					 if(!is_object($question_accede_internet) || $question_accede_internet->getId() <= 0)
					 {
					     $r = false;
					 }
				      }
				   }

				   if(isset($data['frecuencia_internet']) && !empty($data['frecuencia_internet']))
				   {
                                      $question_frecuencia_internet = null;
                                      $question_frecuencia_internet = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'frecuencia_internet');

				      $question_frecuencia_internet = QuestionPeer::saveQuestion(2, 'frecuencia_internet', $data['frecuencia_internet'],
				      '5.5.2. ¿Con qué frecuencia la o el estudiante accede a internet?',
				      '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), $question_frecuencia_internet, $con);
				      if(!is_object($question_frecuencia_internet) || $question_frecuencia_internet->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['transporte']) && !empty($data['transporte']))
				   {
                                      $question_transporte = null;
                                      $question_transporte = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'transporte');

				      $question_transporte = QuestionPeer::saveQuestion(2, 'transporte', $data['transporte'],
				      '5.5.3. ¿Cómo llega la o el estudiante a la Unidad Educativa? ',
				      '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), $question_transporte, $con);
				      if(!is_object($question_transporte) || $question_transporte->getId() <= 0)
				      {
					 $r = false;
				      }
				   }

				   if(isset($data['tiempo_transporte']) && !empty($data['tiempo_transporte']))
				   {
                                      $question_tiempo_transporte = null;
                                      $question_tiempo_transporte = QuestionPeer::getAttributeByKeyAndStudent($contract->getId(), 'tiempo_transporte');

				      $question_tiempo_transporte = QuestionPeer::saveQuestion(2, 'tiempo_transporte', $data['tiempo_transporte'],
				      '5.5.4. En el medio de transporte señalado ¿Cuál es el tiempo máximo que demora en llegar de su casa a la Unidad Educativa o viceversa?',
				      '5.5. ACCESO A MEDIOS DE COMUNICACIÓN Y TRANSPORTE', $contract->getId(), $question_tiempo_transporte, $con);

				      if(!is_object($question_tiempo_transporte) || $question_tiempo_transporte->getId() <= 0)
				      {
					 $r = false;
				      }
				   }


				   if($r)
				   {
				       $con->commit();
				       $this->getUser()->setFlash('notice', 'Edito con exito los datos de un alumno');
				       $this->redirect('/Student/index');
				   } else {
				      $this->getUser()->setFlash('error', "Ocurrio un error inesperado, comuniquese con el Administrador del sistema", false);
				   }

				 }// end student
			      }// end person
			    } catch (exception $e) {
				$con->rollback();
				throw $e;
				$this->getUser()->setFlash('error', $e, false);
			    }
		       } else {
			   $this->getUser()->setFlash('error', "Debe seleccionar el nivel escolar del estudiante", false);
		       }

		     } else {
			$this->getUser()->setFlash('error', "Debe ingresar los datos de uno de los tutores del alumno", false);
		     }

		  } else {
		      $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
		  }

	    } else {
	       $this->getUser()->setFlash('error', "Debe seleccionar el periodo escolar para el que lo esta inscribiendo", false);
            }
	 }

       $this->setTemplate('recordShortEdit');
     }




     public function executeEdit(sfWebRequest $request)
     {
        $this->Student = StudentPeer::retrieveByPK($request->getParameter('id'));

        $this->form = new RecordShortEditForm($this->Student);

     }

     public function executeSaveRecordSortEdit(sfWebRequest $request)
     {
	 if ($request->isMethod('POST'))
	 {
	    // Obtenemos los datos del formulario
	    $data = $request->getParameter('record_short');

	    // A partir del identificador obtenemos al estudiante
            $this->Student = StudentPeer::retrieveByPK($data['id']);

	    $this->form = new RecordShortEditForm($this->Student);

	    // Obtenemos el periodo actualmente seleccionado
	    $period = PeriodPeer::retrieveByPK($this->getUser()->getAttribute('period'));

	    if(is_object($period))
	    {
		  $student = $this->Student;

		  $this->form->bind($data);// Seteamos los datos al formulario

		  if ($this->form->isValid()) // Verificamos si es valido
		  {

		      // Llamo a la funcion que verifica si se han ingresado los datos de uno de los tutores
		     if($this->validarTutor($this->form->getValue('padre_tutor_cedula_identidad'), $this->form->getValue('padre_tutor_nombre'), $this->form->getValue('padre_tutor_apellido_paterno'), $this->form->getValue('padre_tutor_apellido_materno')) || $this->validarTutor($this->form->getValue('madre_cedula_identidad'), $this->form->getValue('madre_nombre'), $this->form->getValue('madre_apellido_paterno'), $this->form->getValue('madre_apellido_materno')))
		     {

                      $day = new sfDate(time());

                      // Creamos contract
		      $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

                      $sf_fecha_registro = new sfDate($fecha_registro);

                      if ($day->dump() >= $sf_fecha_registro->dump())
                      {
			  // Obtenemos el grado a partir de lo que haya seleccionado
			  if(isset($data['nivel_m']) && !empty($data['nivel_m']))
			  {
			     $grade = GradePeer::retrieveByPK($data['nivel_m']);
			  } else if(isset($data['nivel_t']) && !empty($data['nivel_t'])) {
			     $grade = GradePeer::retrieveByPK($data['nivel_t']);
			  } else if(isset($data['nivel_n']) && !empty($data['nivel_n'])) {
			     $grade = GradePeer::retrieveByPK($data['nivel_t']);
			  }

		       if(isset($grade) && is_object($grade))
		       {
			    $con = Propel::getConnection();
			    try
			    {
			       $con->beginTransaction(); // Iniciamos transaccion


			       // Obtenemos el person del estudiante
			       $person = $this->Student->getPerson();

				if(is_object($person) && $person->getId() > 0)
				{


				   $student = StudentPeer::saveStudent(2,
					   strtoupper($this->form->getValue('estudiante_nombre')),
					   strtoupper($this->form->getValue('estudiante_apellido_paterno')),
					   strtoupper($this->form->getValue('estudiante_apellido_materno')),
					   $student->getRude(),
					   $student->getCodigo(),
					   $student->getBirthDate(),
					   $student->getEmail(), $person->getId(), $this->Student, $con);


				   if(is_object($student) && $student->getId() > 0)
				   {
				      $r = true;

				      if(isset($data['estudiante_genero']) && !empty ($data['estudiante_genero']))
				      {
					 $attribute_estudiante_genero = AttributePeer::getAttributeByKeyAndPerson('estudiante_genero', $person->getId());
					 $attribute_estudiante_genero = AttributePeer::saveAttribute(2, 'estudiante_genero', strtoupper($this->form->getValue('estudiante_genero')), 'SEXO', 'SEXO', $person->getId(), $attribute_estudiante_genero, $con);
					 if(!is_object($attribute_estudiante_genero) || $attribute_estudiante_genero->getId() <= 0)
					 {
					    $r = false;
					 }
				      }

				      // Creamos al tutor
				      //TODO verificar si ya existen a partir del ci

				      // Tutores Madre
				      $type_tutor_id = 1; // tipo de tutor madre, este debe ser el primer registro

				      $student_tutor_madre = StudentTutorPeer::getStudentTutor($student->getId(), $type_tutor_id);

				      $tutor_madre = $student_tutor_madre->getTutor();

				      $persona_madre = $tutor_madre->getPerson();
				      if(is_object($persona_madre) && $persona_madre->getId() > 0)
				      {
					   $tutor_madre = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('madre_nombre')),
					   strtoupper($this->form->getValue('madre_apellido_paterno')),
					   strtoupper($this->form->getValue('madre_apellido_materno')),
					   strtoupper($this->form->getValue('madre_cedula_identidad')),
					   strtoupper($this->form->getValue('madre_idioma_frecuente')),
					   strtoupper($this->form->getValue('madre_ocupacion')),
					   strtoupper($this->form->getValue('madre_grado_instruccion')),
					   $this->form->getValue('madre_email'),
					   $type_tutor_id,
					   $persona_madre->getId(), $tutor_madre, $con);

					   if(is_object($tutor_madre) && $tutor_madre->getId() > 0)
					   {
					      $student_tutor_madre = StudentTutorPeer::saveStudentTutor(2, $student->getId(), $tutor_madre->getId(), $student_tutor_madre, $con);

					      if(!is_object($student_tutor_madre) || $student_tutor_madre->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }

				      // Tutores
				   $type_tutor_id = 2;

				   if(isset($data['padre_tutor_parentesco']) && !empty($data['padre_tutor_parentesco']))
				   {
				      $parentesco = strtoupper($data['padre_tutor_parentesco']);

				      $type_tutor = TypeTutorPeer::getTypeTutorByName($parentesco, 2);
				      if(!is_object($type_tutor))
				      {
					  $type_tutor = TypeTutorPeer::saveTypeTutor(2, $parentesco, $parentesco, null, $con);
				      }
				      $type_tutor_id = $type_tutor->getId();

				      $student_tutor = StudentTutorPeer::getStudentTutor($student->getId(), $type_tutor_id);

				      if(is_object($student_tutor))
				      {
					 $tutor_tutor = $student_tutor->getTutor();
					 $persona_tutor = $tutor_tutor->getPerson();
				      } else {
					$tutor_tutor = null;
					$persona_tutor = PersonPeer::savePerson(2, null, $con);
				      }

				      if(is_object($persona_tutor) && $persona_tutor->getId() > 0)
				      {
					   $tutor_tutor = TutorPeer::saveTutor(2,
					   strtoupper($this->form->getValue('padre_tutor_nombre')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_paterno')),
					   strtoupper($this->form->getValue('padre_tutor_apellido_materno')),
					   strtoupper($this->form->getValue('padre_tutor_cedula_identidad')),
					   strtoupper($this->form->getValue('padre_tutor_idioma_frecuente')),
					   strtoupper($this->form->getValue('padre_tutor_ocupacion')),
					   strtoupper($this->form->getValue('padre_tutor_grado_instruccion')),
					   $this->form->getValue('padre_email'),
					   $type_tutor_id,
					   $persona_tutor->getId(), $tutor_tutor, $con);

					   if(is_object($tutor_tutor) && $tutor_tutor->getId() > 0)
					   {
					      $student_tutor = StudentTutorPeer::saveStudentTutor(2, $student->getId(), $tutor_tutor->getId(), $student_tutor, $con);

					      if(!is_object($student_tutor) || $student_tutor->getId() <= 0)
					      {
						 $r = false;
					      }
					   }
				      }
				   }


				   // Creamos contract
				   $fecha_registro = $data['fecha_registro_anio'].'-'.$data['fecha_registro_mes'].'-'.$data['fecha_registro_dia'];

				   // Obtenemos el contrato de la gestion actualmente seleccionada
				   $contract = ContractPeer::retrieveByPK($this->form->getValue('contract_id'));

				   // Verifico que el contrato pertenece a la gestion actualmente activa
				   if($contract->getPeriod()->getIdState() == 2)
				   {
				      // Cambiamos los datos del contrato
				      $contract = ContractPeer::saveContract(1,$contract->getNro(), 0, $contract->getContainer(), '', $fecha_registro, strtoupper($data['lugar_registro']), $student->getId(), $contract->getPeriodId(), $contract, $con);

				      // Verificamos a que curso estaba inscrito el estudiante
				      $contract_grade = ContractGradePeer::getContractGrade($contract->getId(), null, 2);
				      // Solo debe dejarlo cambiar de curso si es para
				      // la gestion actualmente vigente, si es una gestion pasada no debe permitirle cambiar de curso

				      if($contract_grade && ($contract_grade->getGradeId() != $grade->getId())) // Verifico si lo esta cambiando de curso
				      {
					 // Inactivamos para el curso anterior
					 $contract_grade->setIdState(3);
					 $contract_grade->save($con);

					 // Eliminamos todos los items de tipo mensualidad asignados a este estudiante que no esten pagados.
					 $contract->EliminarMensualidadesSinPago($con);

					 // Realizamos el cambio de curso
					 // Le asignamos al contrato del estudiante el nivel que le corresponde
					 $array_contract_grade = array('id_state' => 2, 'contract_id' => $contract->getId(), 'grade_id' => $grade->getId());

					 $new_contract_grade = ContractGradePeer::saveContractGrade($array_contract_grade, null, $con);

					 if(is_object($new_contract_grade) && $new_contract_grade->getId() > 0)
					 {
					    // Le agregamos la nueva mensualidad segun el nuevo curso al que lo estan cambiando
					    $this->addDefaultItem($grade, $contract);
					 } else {
					    $r = false;
					 }
				      }
				   }

				   if($r)
				   {
				       $con->commit();
				       $this->getUser()->setFlash('notice', 'Edito con exito los datos de un alumno');
				       $this->redirect('/Student/index');
				   } else {
				      $this->getUser()->setFlash('error', "Ocurrio un error inesperado, comuniquese con el Administrador del sistema", false);
				   }

				 }// end student
			      }// end person
			    } catch (exception $e) {
				$con->rollback();
				throw $e;
				$this->getUser()->setFlash('error', $e, false);
			    }


                            } else {
                                $this->getUser()->setFlash('error', "Debe seleccionar el nivel escolar del estudiante", false);
                            }

                            } else {
                                $this->getUser()->setFlash('error', "La fecha de registro no puede ser mayor a la fecha actual", false);
                            }

		     } else {
			$this->getUser()->setFlash('error', "Debe ingresar los datos de uno de los tutores del alumno", false);
		     }

		  } else {
		      $this->getUser()->setFlash('error', $this->form->getErrorSchema()->getMessage(), false);
		  }

	    } else {
	       $this->getUser()->setFlash('error', "Debe seleccionar el periodo escolar para el que lo esta inscribiendo", false);
            }
	 }

       $this->setTemplate('edit');
     }



     public function executeDelete(sfWebRequest $request)
     {
       $id = (int)$request->getParameter('id');
       $Student = StudentPeer::retrieveByPK($id);

       if($Student)
       {
         $flag = $Student->getIsPayByContract();
         if(!$flag)
         {
            $Student->delete();
            $this->redirect('/Student');
         }
         else
         {
          $this->redirect('/Student');
         }
       }
       else
       {
          $this->redirect('/Student');
       }

       #$this->dispatcher->notify(new sfEvent($this, 'admin.delete_object', array('object' => $this->getRoute()->getObject())));
       #$this->getRoute()->getObject()->delete();
       #$this->getUser()->setFlash('notice', 'The item was deleted successfully.');
     }

     public function executeBatch(sfWebRequest $request)
     {
       $request->checkCSRFProtection();

       if (!$ids = $request->getParameter('ids'))
       {
	 $this->getUser()->setFlash('error', 'You must at least select one item.');

	 $this->redirect('@student');
       }

       if (!$action = $request->getParameter('batch_action'))
       {
	 $this->getUser()->setFlash('error', 'You must select an action to execute on the selected items.');

	 $this->redirect('@student');
       }

       if (!method_exists($this, $method = 'execute'.ucfirst($action)))
       {
	 throw new InvalidArgumentException(sprintf('You must create a "%s" method for action "%s"', $method, $action));
       }

       if (!$this->getUser()->hasCredential($this->configuration->getCredentials($action)))
       {
	 $this->forward(sfConfig::get('sf_secure_module'), sfConfig::get('sf_secure_action'));
       }

       $validator = new sfValidatorPropelChoice(array('multiple' => true, 'model' => 'Student'));
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

       $this->redirect('@student');
     }



     public function executeAddSalesPay(sfWebRequest $request)
     {
	// Identificador del contrato
	$contract_id = $request->getParameter('contract_id');
	$array_sales = $request->getParameter('items');
	$r = true;

	$amount = 0;
	$comment = '';
	$discount = 0;
	$discount100 = false;
	$sf_guard_user_id = $this->getUser()->getId(); // Id del usuario actualmente logueado

	$con = Propel::getConnection();
	try
	 {
	      $con->beginTransaction(); // start the transaction

	      // Obtenemos un deposito abierto para este contrato
	      $deposit = DepositPeer::getDeposit(1, $contract_id, $sf_guard_user_id);

	      $array_deposit = array(
		     'id_state' => 1
		     ,'amount' => $amount
		     ,'comment' => $comment
		     ,'discount' => $discount
		     ,'cashier_id' => $sf_guard_user_id
		     ,'currency_id' => 1 //Boliviano
              );

	      if(!is_object($deposit))
	      {
		   $deposit = DepositPeer::saveDeposit($array_deposit, null, $con);

		   if(!is_object($deposit) || $deposit->getId() <= 0)
		   {
			 $r = false;
		   }
	      }

	      $arr_to_save = array();
	      if(is_array($array_sales) && count($array_sales) > 0)
	      {
		     foreach ($array_sales  as $sales_id)
		     {
			$sales = SalesPeer::retrieveByPK($sales_id);

			if(is_object($sales))
			{
			   // $amount += $sales->getSaldo();
			   $amount += $sales->getSaldoByDeposit();
			   $discount += $sales->getTotalDiscount();

			   $arr_to_save[$sales->getId()] = $sales->getSaldoByDeposit();

			   if($sales->getDiscount100())
			   {
			      $arr_to_save = array();
			      $discount100 = true;

			      $arr_to_save[$sales->getId()] = $sales->getSaldoByDeposit();
			   }

			   $account_deposit = AccountDepositPeer::getAccountDeposit($sales->getIdAccount(), $deposit->getId());
			   $amount_sd = $sales->getSaldoByDeposit();

			   if(is_object($account_deposit))
			   {
			      $amount_sd = $account_deposit->getAmount() + $sales->getSaldoByDeposit();
			   } else {
			      $account_deposit = null;
			   }

			   $array_account_deposit =  array(
			       'id_state' => 1,
			       'amount' => $amount_sd,
			       'account_id' => $sales->getIdAccount(),
			       'deposit_id' => $deposit->getId(),
			   );

			   $account_deposit = AccountDepositPeer::saveAccountDeposit($array_account_deposit, $account_deposit, $con);
			}
		     }

		     $comment = json_encode($arr_to_save);
		  }

		  $array_deposit = array(
			   'id_state' => 1
			   ,'amount' => $amount
			   ,'comment' => $comment
			   ,'discount' => $discount
			   ,'cashier_id' => $sf_guard_user_id
			   ,'currency_id' => 1 //Boliviano
                 );

		 // Actualizamos los datos del deposito
		 $deposit = DepositPeer::saveDeposit($array_deposit, $deposit, $con);

		 $this->getUser()->setFlash('notice', 'Agrego un deposito');
		 $con->commit(); // commit changes to db

	 } catch (exception $e) {
	    $con->rollback();
	    throw $e;
	    $this->getUser()->setFlash('error', $e, false);
	 }

	$json = json_encode(array('amount' => $amount, 'discount100' => $discount100));

	return $this->renderText($json);
     }

     public function executeDiscount100(sfWebRequest $request)
     {
         $r = false;

         // id del usuario actual
         $sf_guard_user_id = $this->getUser()->getId();

         // Id de la cuenta a la que se le realizara el deposito
	 $contract_id = $request->getParameter('contract_id');

         // Obtenemos un deposito abierto para este contrato
         $deposit = DepositPeer::getDeposit(1, $contract_id, $sf_guard_user_id);

         if($deposit->getAmount() == 0)
         {
		$con = Propel::getConnection();
		try
		{
		    $con->beginTransaction(); // start the transaction
			// Si llega aqui es porque este deposito es de un item que tiene el descuento del 100 %

		    // eliminados todos los AccountDeposit de este deposito
		    $deposit->delAccountDeposit($con);

		    // Obtengo lo que tiene este deposito
		    $array_sales = json_decode($deposit->getComment(), 1);

		    foreach ($array_sales as $key => $value)
		    {
			$sales = SalesPeer::retrieveByPK($key);

			if(is_object($sales))
			{
			   if($sales->getDiscount100())
			   {
			      SalesDepositPeer::saveSalesDepositAndAccont(3, $value, $deposit->getId(), $sales->getId(), $con);

			      // Creamos los AccountDeposit correspondiente
			      $account_deposit = AccountDepositPeer::getAccountDeposit($sales->getIdAccount(), $deposit->getId());
			      $amount_sd = $value;

			      if(is_object($account_deposit))
			      {
				 $amount_sd = $account_deposit->getAmount() + $value;
			      } else {
				 $account_deposit = null;
			      }

			      $array_account_deposit =  array(
				  'id_state' => 2,
				 'amount' => $amount_sd,
				 'account_id' => $sales->getIdAccount(),
				 'deposit_id' => $deposit->getId(),
			      );

			      $account_deposit = AccountDepositPeer::saveAccountDeposit($array_account_deposit, $account_deposit, $con);

			      $con->commit(); // commit changes to db
			      $r = true;
			   }
			}
		      }// EndForeach sales

		 } catch (exception $e) {
		     $con->rollback();
		    throw $e;
		    $this->getUser()->setFlash('error', $e, false);
		 }
         }

	return $this->renderText(json_encode(array('r'=> $r)));
     }



     public function executeAddDeposit(sfWebRequest $request)
     {
	// Id del contrato actual
	$contract_id = $request->getParameter('contract_id');

	// Id de la venta que se esta modificando
	$sales_id = $request->getParameter('sales_id');

	// el monto que se le esta poniendo al item
	$amount = abs($request->getParameter('amount'));
	$amount = str_replace(',','.',$amount);
	$amount = (Float)$amount;

	$con = Propel::getConnection();
	try
	 {
	    $con->beginTransaction(); // start the transaction

	    $sales = SalesPeer::retrieveByPK($sales_id);

	    $sf_guard_user_id = $this->getUser()->getId();

	    // Obtenemos un deposito abierto para este contrato
            $deposit = DepositPeer::getDeposit(1, $contract_id, $sf_guard_user_id);

	    if(is_object($sales))
	    {
		  // Obengo el array de items del campo comment del deposito
		  $array_comment_deposit = json_decode($deposit->getComment(), 1);

		  if(!isset ($array_comment_deposit[$sales_id]))
		  {
		     // retornamos type en cero, avisando que no se realizo ningun cambio
		     $json = json_encode(array('amount' => $deposit->getAmount()));
		     return $this->renderText($json);
		  }

		  // Verificar que el monto que esta ingresando para este item no sea mayor a su saldo
		  if($amount <= $sales->getSaldoByDeposit())
		  {
		     // Le quitamos el monto anterior al deposito
		     $amount_deposit = $deposit->getAmount() - $array_comment_deposit[$sales_id];

		     // Le asignamos el nuevo monto al array de comment
		     $array_comment_deposit[$sales_id] = $amount;

		     // Sumamos el nuevo monto al amount del deposit
		     $amount_deposit += $amount;

		     $discount = 0;

		     $comment = json_encode($array_comment_deposit);
		     $array_deposit = array(
				  'id_state' => 1
				 ,'amount' => $amount_deposit
				 ,'comment' => $comment
				 ,'discount' => $discount
				 ,'cashier_id' => $sf_guard_user_id
				 ,'currency_id' => 1 // Boliviano
		     );

		     if(is_object($deposit))
		     {
			$deposit = DepositPeer::saveDeposit($array_deposit, $deposit, $con);
		     }
		     $con->commit(); // commit changes to db
		     $this->getUser()->setFlash('notice', 'Cambio el monto del deposito');
		  } else {
		     $this->getUser()->setFlash('error', 'El monto de un item no puede ser mayor a su precio');
		  }
	    }

	 } catch (exception $e) {
	    $con->rollback();
	    throw $e;
	    $this->getUser()->setFlash('error', $e, false);
	 }

	$json = json_encode(array('amount' => $deposit->getAmount()));

	return $this->renderText($json);
     }



     public function executePago(sfWebRequest $request)
     {
       // Obtenemos la cuenta a la que se esta realizando el deposito
       $this->contract_id = $request->getParameter('contract_id');

       // Obtenemos el deposito de esta cuenta
       $this->deposit = DepositPeer::getDeposit(1, $this->contract_id, $this->getUser()->getId());

       if(is_object($this->deposit))
       {
	    $this->setTotalPricePay($this->deposit);

	    $array_sales = json_decode($this->deposit->getComment(), 1);

	    $this->array_sales_item = array();

	    foreach ($array_sales as $sale_id => $amount)
	    {

	       $item_for_sales = ItemForSalePeer::getItemForSaleBySales($sale_id);

	       foreach ($item_for_sales as $item_for_sale)
	       {
		  $this->array_sales_item[] = array(
		            'sales_id' => $item_for_sale->getSalesId()
			  , 'name' => $item_for_sale->getItem()->getName().' ('.$item_for_sale->getSales()->getNameSalesAccount().' )'
//			  , 'saldo' => $item_for_sale->getSales()->getSaldoByDeposit()
			  , 'saldo' => $amount
		      );
	       }

	    }// EndForeach sales

       } else {
	    $this->getUser()->setFlash('error', 'No hay deposito para este contrato', false);
       }

	// para activar las formas de pago
	$this->getUser()->setAttribute('current_payment_type', null);
     }


     public function executeEditPaymentType(sfWebRequest $request)
     {
	$this->contract_id = $request->getParameter('contract_id');

	$this->getUser()->setAttribute('current_payment_type', $request->getParameter('id'));
     }

     public function executeUploadPay(sfWebRequest $request)
     {
	 $this->contract_id = $request->getParameter('contract_id');
     }


     public function executeAddPay(sfWebRequest $request)
     {
	 // Obtenemos los valores pasados por el formulario
	 $numbers_value = abs($this->getRequestParameter('numbers_value'));
	 $numbers_value = str_replace(',','.',$numbers_value);
	 $numbers_value = (Float)$numbers_value;

	 $deposit_id = $this->getRequestParameter('deposit_id');

	 $payment_type_id = $this->getUser()->getAttribute('current_payment_type');

	 //obtenemos el usuario actualmente logueado
	 $sf_guard_user_id = $this->getUser()->getId();

	 $type = 1;


	 $con = Propel::getConnection();
	 try {
	    $con->beginTransaction(); // start the transaction

	    //Verificamos si hay caja abierta, sino se abre una caja para el usuario actual
	    $cashbox = CashBoxPeer::getCashbox($sf_guard_user_id, null, $con);

	    if(is_object($cashbox))
	    {
	       $payment_type = PaymentTypePeer::retrieveByPK($payment_type_id);

	       $currency_price = $payment_type->getCurrency()->getActiveCurrencyPrice();

	       $movement_cashbox = MovementCashboxPeer::createMovementCashbox(
		       $numbers_value,
		       $cashbox->getId(),
		       $currency_price->getId(),
		       $payment_type_id,
		       null, $con);



	       if(is_object($movement_cashbox) && $movement_cashbox->getId() > 0)
	       {

		  $movement_cashbox_deposit =  MovementCashboxDepositPeer::createMovementCashboxDeposit(
			  $movement_cashbox->getId(),
			  $deposit_id, null, $con);

		  if(is_object($movement_cashbox_deposit) && $movement_cashbox_deposit->getId() > 0)
		  {
		     $type = 0;
		  }
	       }

	       if($type == 0)
	       {

		  $con->commit(); // Terminar la transaccion


		  $this->getUser()->setFlash('notice', 'El movimiento se realizo con exito.', false);

	       } else {
		  $this->getUser()->setFlash('error', 'Se genero un error, comuniquese con el administrador del sistema.', false);
	       }

         } else {
           $this->getUser()->setFlash('error', 'No existe la caja, comuniquese con el administrador del sistema.', false);
         }
      }
      catch (exception $e)
      {
        $con->rollback();
        throw $e;
        $this->getUser()->setFlash('error', 'Se genero una error, comuniquese con el administrador del sistema', false);
      }

      $this->getUser()->setAttribute('current_payment_type', null);

      // Variables para retornar a la interfaz
      $json = json_encode(
            array(
                'type'=> $type
                )
            );


      $render = $this->renderText($json);

      return $render;
  }

  function executeClose(sfWebRequest $request)
  {
     sfConfig::set('sf_web_debug', false);

     // el deposito que se esta pagando
     $deposit_id = $request->getParameter('deposit_id');

     // Obtenemos el id del contrato para el que se esta realizando el deposito
     $contract_id = $request->getParameter('contract_id');

     // Ponemos el comentario para el recibo
     $comment = $request->getParameter('comment');
     $name = $request->getParameter('name');
     $nit = $request->getParameter('nit');
     $telefon = $request->getParameter('telefon');

     //obtenemos el usuario actualmente logueado
     $sf_guard_user_id = $this->getUser()->getId();

     $con = Propel::getConnection();
     try
      {
         $con->beginTransaction(); // start the transaction

         //Verificamos si hay caja abierta, sino se abre una caja para el usuario actual
         $cashbox = CashBoxPeer::getCashbox($sf_guard_user_id, null, $con);
         if(is_object($cashbox))
         {

           // Obtenemos el Deposit (desposito actual de este contrato)
           $deposit = DepositPeer::retrieveByPK($deposit_id);

           if(is_object($deposit))
           {
             // Ajustamos los movimientos de este Deposito
             $deposit->adjustPay($cashbox->getId(), $con);

	     // Obtenemos el ultima nightaudit
	     $night_audit = NightAuditPeer::getLastNightAudit();


	     $discount = $deposit->getDiscount();

	     $array_receipt = array(
		 'total' => $deposit->getAmount()
		,'total_net' => $deposit->getAmount()
		,'night_audit_id' => $night_audit->getId()
		,'discount' => $discount
	        ,'service' => 0
		,'canceled' => 0
		,'printed' => 0
		,'comment' => $comment
		,'name' => $name
		,'nit' => $nit
		,'telefon' => $telefon
		,'additional_information' => ''
	     );

	     // Creamos el recibo
	     $this->receipt = ReceiptPeer::saveReceipt($array_receipt, null, $con);

	     if(is_object($this->receipt) && $this->receipt->getId() > 0)
	     {
		// Asociamos el recibo con su deposito
		$deposit->addReceipt($this->receipt->getId(), $con);

		$r = true;

		// eliminados todos los AccountDeposit de este deposito
		$deposit->delAccountDeposit($con);


		$array_sales = json_decode($deposit->getComment(), 1);

		foreach ($array_sales as $key => $value)
		{
		       $sales = SalesPeer::retrieveByPK($key);

		       if(is_object($sales))
		       {
			  if($value == $sales->getSaldoByDeposit())
			  {
			     SalesDepositPeer::saveSalesDepositAndAccont(3, $value, $deposit->getId(), $sales->getId(), $con);

			  } else {
			     SalesDepositPeer::saveSalesDepositAndAccont(2, $value, $deposit->getId(), $sales->getId(), $con);
			  }

			  // Creamos los AccountDeposit correspondiente
			  $account_deposit = AccountDepositPeer::getAccountDeposit($sales->getIdAccount(), $deposit->getId());
			  $amount_sd = $value;

			  if(is_object($account_deposit))
			  {
			      $amount_sd = $account_deposit->getAmount() + $value;
			  } else {
			      $account_deposit = null;
			  }

			  $array_account_deposit =  array(
			       'id_state' => 2,
			       'amount' => $amount_sd,
			       'account_id' => $sales->getIdAccount(),
			       'deposit_id' => $deposit->getId(),
			  );

			  $account_deposit = AccountDepositPeer::saveAccountDeposit($array_account_deposit, $account_deposit, $con);

		       }
		}// EndForeach sales

	     }

             if(isset($r) && $r == true)
             {
		   // Obtenemos el identificador del estudiante
		   $contract = ContractPeer::retrieveByPK($contract_id);
		   $student_id = $contract->getStudentId();

		   // Obtenemos todos los contratos de un estudiante
		   $contracts = ContractPeer::getContracts($student_id);

		   $arr = array('saldo_mensualidad_adeudada' => 0, 'cantidad_cuotas_vencidas' => 0, 'proximo_venciento' => '');
		   foreach ($contracts as $contract)
		   {
			$array_datos_mensualidad = $contract->getDatosMensualidad();
			$arr['saldo_mensualidad_adeudada'] += $array_datos_mensualidad[2];
			$arr['cantidad_cuotas_vencidas'] += $array_datos_mensualidad[3];
		   }

		   // Obtenemos el contrato actual o el contrato para la gestion activa actual
		   $current_contract = ContractPeer::contractForTheActivePeriod($student_id);

		   if(is_object($current_contract))
		   {
		      $arr['proximo_venciento'] = $current_contract->shareOfMaturing();
		   }

		   $additional_information = json_encode($arr);

		   $this->receipt->setAdditionalInformation($additional_information);
		   $this->receipt->save($con);

                // Cambiamos el estado del deposito
                $deposit->setIdState(3); // Con saldo o Completado
                $deposit->save($con);
                $con->commit(); // commit changes to db

		// redireccionamos al recibo
		$this->redirect('/receipt/show/id/'.$this->receipt->getId().'/idc/'.$contract_id);

             } else {
               // Genero un error
	       $con->rollback();
               $this->getUser()->setFlash('error', 'Se genero un problema inesperado, comuniquese con el administrador de sistema.', false);
             }
           }
         }

       } catch (exception $e) {
         $con->rollback();
	 $this->getUser()->setFlash('error', 'Se genero un problema inesperado, comuniquese con el administrador de sistema. ('.$e->getMessage().') ', false);
       }

       exit;
   }


//   protected function closeDeposit($deposit, $sales, $contract_id, $con = null)
//   {
//      $r = true;
//
//      if($deposit->saldo() > 0)
//      {
//	  if($deposit->saldo() >= $sales->getSaldoByDeposit())
//	  {
//	     if(!SalesDepositPeer::saveSalesDepositAndAccont(3, $sales->getSaldoByDeposit(), $deposit->getId(), $sales->getId(), $con))
//	     {
//		// Salimos del foreach y hacemos rollback
//		$r = false;
//	     }
//	  } else {
//	     // Aqui obtenemos el saldo que falta pagar
//	     $saldo_d_venta_guardar = $sales->getSaldoByDeposit() - $deposit->saldo();
//	     $saldo_d_venta = $sales->getSaldoByDeposit() - $deposit->saldo();
//	     $array_deposito = array();
//
//	     // Creamos el sales deposit en estado 2 (pagado parcialmente)
//	     if(!SalesDepositPeer::saveSalesDepositAndAccont(2, $deposit->saldo(), $deposit->getId(), $sales->getId(), $con))
//	     {
//		$r = false;
//	     }
//
//	     // Buscamos otros depositos que tenga saldo
//	     $depositos_saldos = DepositPeer::getDepositByState(2, $contract_id);
//	     foreach ($depositos_saldos as $deposito_saldo)
//	     {
//		$array_deposito[] = $deposito_saldo->getId();
//
//		$saldo_d_venta = $saldo_d_venta - $deposito_saldo->saldo();
//
//		if($saldo_d_venta <= 0)
//		{
//		   break;
//		}
//	     }
//
//	     if(count($array_deposito) > 0)
//	     {
//		   // Empezamos a recorrer los deposito
//		   foreach ($array_deposito as $array)
//		   {
//		      if($saldo_d_venta_guardar > 0)
//		      {
//			 // Obtenemos el deposito
//			  $deposito_saldo = DepositPeer::retrieveByPK($array);
//			  if($deposito_saldo->saldo() >= $saldo_d_venta_guardar)
//			  {
//			    $saldo_depositar = $saldo_d_venta_guardar;
//
//			    $saldo_d_venta_guardar = $saldo_d_venta_guardar - $deposito_saldo->saldo();
//
//			    if(!SalesDepositPeer::saveSalesDepositAndAccont(3, $saldo_depositar, $deposito_saldo->getId(), $sales->getId(), $con))
//			    {
//			       $r = false;
//			       break;
//			    }
//			  } else {
//			       $saldo_d_venta_guardar = $saldo_d_venta_guardar - $deposito_saldo->saldo();
//
//			       if(!SalesDepositPeer::saveSalesDepositAndAccont(2, $deposito_saldo->saldo(), $deposito_saldo->getId(), $sales->getId(), $con))
//			       {
//				  $r = false;
//				  break;
//			       }
//			  }
//
//			  if($deposito_saldo->saldo() == 0)
//			  {
//			      $deposito_saldo->setIdState(3);
//			      $deposito_saldo->save($con);
//			  }
//		      }
//
//		   }// EndForeach deposito
//	     }
//	  }
//       }
//
//       return $r;
//   }


  public function executePay(sfWebRequest $request)
  {
     $this->contract_id = $request->getParameter('contract_id');
  }

  public function executeFlashes(sfWebRequest $request)
  {

  }


  public function executeDelPayAmount(sfWebRequest $request)
  {
    // Obtengo la conexion
    $con = Propel::getConnection();

    $type = 1;

    try
    {
      $con->beginTransaction(); // Inicio la transaccion


          if(DepositPeer::delMovements($request->getParameter('movement_id'), $con))
          {
            $type = 0;
          }


	 if($type == 0)
	 {
	   $con->commit(); // Terminar la transaccion
	 }

    } catch (PropelException$e) {
      $this->getUser()->setFlash('error', 'Se genero un problema inesperado, comuniquese con el administrador de sistema.', false);
      $con->rollback();
    }

    $arr = array("type" => $type);
    $json = json_encode($arr);

    return $this->renderText($json);
  }


  public function executeDelDeposit(sfWebRequest $request)
  {
     // id del contrato con el que se esta trabajando
     $contract_id = $request->getParameter('contract_id');

     // id de la venta que se quiere borrar
     $sales_id = $request->getParameter('sales_id');

     //obtenemos el usuario actualmente logueado
     $sf_guard_user_id = $this->getUser()->getId();

     // Obtengo la conexion
     $con = Propel::getConnection();

     try
     {
	 $con->beginTransaction(); // Inicio la transaccion

	 // Obtenemos un deposito abierto para este contrato
	 $this->deposit = DepositPeer::getDeposit(1, $contract_id, $sf_guard_user_id);

	 // Obengo el array de items del campo comment del deposito
	 $array_comment_deposit = json_decode($this->deposit->getComment(), 1);

	 if(!isset ($array_comment_deposit[$sales_id]))
	 {
	    // retornamos avisando que no se realizo ningun cambio
	    $json = json_encode(array('amount' => $this->deposit->getAmount()));
	    return $this->renderText($json);
	 }

	 // Le quitamos el monto anterior al deposito
	 $amount_deposit = $this->deposit->getAmount() - $array_comment_deposit[$sales_id];

	 if($amount_deposit > 0)
	 {
	    // Quitamos la venta que se selecciono
	    unset($array_comment_deposit[$sales_id]);

	    $comment = json_encode($array_comment_deposit);
	    $array_deposit = array(
		   'id_state' => 1
		  ,'amount' => $amount_deposit
		  ,'comment' => $comment
		  ,'discount' => $this->deposit->getDiscount()
		  ,'cashier_id' => $sf_guard_user_id
		  ,'currency_id' => 1
	    );


	    $this->deposit = DepositPeer::saveDeposit($array_deposit, $this->deposit, $con);

      } else {
	$this->deposit->setAmount(0);
	$this->deposit->setComment('');
	$this->deposit->save($con);
      }

      $con->commit(); // Terminar la transaccion

    } catch (PropelException$e) {
      $this->getUser()->setFlash('error', 'Se genero un problema inesperado, comuniquese con el administrador de sistema.', false);
      $con->rollback();
    }

    $json = json_encode(array('amount' => $this->deposit->getAmount()));

    return $this->renderText($json);
  }


     /**
      * Dado un objeto, pasa el total a pagar
      * y el total pagado que tiene ese objecto, al template
      *
      * @param Object $object
      */
     protected function setTotalPricePay($object)
     {
	$this->total_pay = 0;
	$this->total_price = 0;
	$this->change_in_dollar = 0;
	$this->change_in_local_currency = 0;

	if(is_object($object))
	{
	   $this->total_pay = $object->getTotalPay();
	   $this->total_price = $object->getTotalPrice();

	   $this->change_in_dollar = $object->changeInDollar();
	   $this->change_in_local_currency = $object->changeInLocalCurrency();
	}
      }

     protected function executeBatchDelete(sfWebRequest $request)
     {
       $ids = $request->getParameter('ids');

       $count = 0;
       foreach (StudentPeer::retrieveByPks($ids) as $object)
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

       $this->redirect('@student');
     }

     protected function processForm(sfWebRequest $request, sfForm $form)
     {
       $form->bind($request->getParameter($form->getName()), $request->getFiles($form->getName()));
       if ($form->isValid())
       {
	 $notice = $form->getObject()->isNew() ? 'The item was created successfully.' : 'The item was updated successfully.';

	 $Student = $form->save();

	 $this->dispatcher->notify(new sfEvent($this, 'admin.save_object', array('object' => $Student)));

	 if ($request->hasParameter('_save_and_add'))
	 {
	   $this->getUser()->setFlash('notice', $notice.' You can add another one below.');

	   $this->redirect('@student_new');
	 }
	 else
	 {
	   $this->getUser()->setFlash('notice', $notice);

	   $this->redirect(array('sf_route' => 'student_edit', 'sf_subject' => $Student));
	 }
       }
       else
       {
	 $this->getUser()->setFlash('error', 'The item has not been saved due to some errors.', false);
       }
     }

     protected function getFilters()
     {
       return $this->getUser()->getAttribute('Student.filters', $this->configuration->getFilterDefaults(), 'admin_module');
     }

     protected function setFilters(array $filters)
     {
       return $this->getUser()->setAttribute('Student.filters', $filters, 'admin_module');
     }

     protected function getPager()
     {
       $pager = $this->configuration->getPager('Student');
       $pager->setCriteria($this->buildCriteria());
       $pager->setPage($this->getPage());
       $pager->setPeerMethod($this->configuration->getPeerMethod());
       $pager->setPeerCountMethod($this->configuration->getPeerCountMethod());
       $pager->init();

       return $pager;
     }

     protected function setPage($page)
     {
       $this->getUser()->setAttribute('Student.page', $page, 'admin_module');
     }

     protected function getPage()
     {
       return $this->getUser()->getAttribute('Student.page', 1, 'admin_module');
     }

     protected function buildCriteria()
     {
       if (null === $this->filters)
       {
	 $this->filters = $this->configuration->getFilterForm($this->getFilters());
       }

       $criteria = $this->filters->buildCriteria($this->getFilters());

       $criteria->addDescendingOrderByColumn(StudentPeer::ID);

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

       $column = StudentPeer::translateFieldName($sort[0], BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
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
       if (null !== $sort = $this->getUser()->getAttribute('Student.sort', null, 'admin_module'))
       {
	 return $sort;
       }

       $this->setSort($this->configuration->getDefaultSort());

       return $this->getUser()->getAttribute('Student.sort', null, 'admin_module');
     }

     protected function setSort(array $sort)
     {
       if (null !== $sort[0] && null === $sort[1])
       {
	 $sort[1] = 'asc';
       }

       $this->getUser()->setAttribute('Student.sort', $sort, 'admin_module');
     }

     protected function isValidSortColumn($column)
     {
       return in_array($column, BasePeer::getFieldnames('Student', BasePeer::TYPE_FIELDNAME));
     }

}


