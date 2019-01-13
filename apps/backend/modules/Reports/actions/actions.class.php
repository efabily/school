<?php

/**
 * Student actions.
 *
 * @package    school
 * @subpackage Student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12474 2008-10-31 10:41:27Z fabien $
 */
class ReportsActions extends sfActions
{

   /// Reporte lista de alumnos
     public function executeListStudents(sfWebRequest $request)
     {
	 $this->filters = new ListStudentFormFilter();

	 $array_filter = $this->getUser()->getAttribute('list_student_filters');

	 $this->Students = array();
	 if($this->getUser()->getAttribute('list_student_filters'))
	 {
	    $this->Students = $this->getDataListStudent($array_filter);
	 }

	 $this->cadena = '';

	if(isset($array_filter['timetable_id']) && $array_filter['timetable_id'] > 0)
	{
	  $this->cadena .=  'TURNO: '.TimetablePeer::retrieveByPK($array_filter['timetable_id']).'  ';
	}

	if(isset($array_filter['degree_id']) && $array_filter['degree_id'] > 0)
	{
	  $this->cadena .=  'CICLO: '.DegreePeer::retrieveByPK($array_filter['degree_id']).'  ';
	}

	if(isset($array_filter['curso_id']) && $array_filter['curso_id'] > 0)
	{
	  $this->cadena .=  'CURSO: '.CursoPeer::retrieveByPK($array_filter['curso_id']).'  ';
	}

     }


     public function executeFilterListStudents(sfWebRequest $request)
     {
	if ($request->hasParameter('_reset'))
	{
	  $this->getUser()->setAttribute('list_student_filters', null);
	  $this->redirect('/Reports/listStudents');
	}

	 $this->filters = new ListStudentFormFilter();

	 $array_filter = $request->getParameter($this->filters->getName());

	$this->filters->bind($array_filter);
	if ($this->filters->isValid())
	{
	  $this->getUser()->setAttribute('list_student_filters', $array_filter);
//	  $this->redirect('/Reports/listStudents');
	} else {
	   $this->getUser()->setAttribute('list_student_filters', null);
	}

	$this->cadena = '';

	if(isset($array_filter['timetable_id']) && $array_filter['timetable_id'] > 0)
	{
	  $this->cadena .=  'TURNO: '.TimetablePeer::retrieveByPK($array_filter['timetable_id']).'  ';
	}

	if(isset($array_filter['degree_id']) && $array_filter['degree_id'] > 0)
	{
	  $this->cadena .=  'CICLO: '.DegreePeer::retrieveByPK($array_filter['degree_id']).'  ';
	}

	if(isset($array_filter['curso_id']) && $array_filter['curso_id'] > 0)
	{
	  $this->cadena .=  'CURSO: '.CursoPeer::retrieveByPK($array_filter['curso_id']).'  ';
	}

	$this->Students = $this->getDataListStudent($this->getUser()->getAttribute('list_student_filters'));

	$this->setTemplate('listStudents');
      }

  protected function getDataListStudent($filter)
  {
     return StudentPeer::getListStudents(
		 $this->getUser()->getAttribute('period'),
	         (isset($filter['timetable_id']) &&  $filter['timetable_id'] > 0)? $filter['timetable_id'] : null,
	         (isset($filter['degree_id']) && $filter['degree_id'] > 0 )? $filter['degree_id'] : null,
	         (isset($filter['curso_id']) && $filter['curso_id'] > 0) ? $filter['curso_id'] : null,
	         ($filter['codigo']['text'] !== '') ? $filter['codigo']['text'] : null,
	         ($filter['father_name']['text'] !== '') ? $filter['father_name']['text'] : null,
	         ($filter['mother_name']['text'] !== '')? $filter['mother_name']['text'] : null,
	         ($filter['first_name']['text'] !== '')? $filter['first_name']['text'] : null
		 );
  }

  /// Reporte ingresos
  public function executeListIngresos(sfWebRequest $request)
  {
     $this->period_id = $this->getUser()->getAttribute('period');

     $this->filters = new IngresosFormFilter();

     $this->convertToFechaNightAudit(array());

     // Sacamos las cuentas que han recibidos pagos en dicha fecha
      $this->accounts = AccountPeer::getAccountReporteIngresoDia($this->period_id, $this->from_date, $this->to_date);

     // Sacamos los items que han recibido pagos en este rango de fecha
     $this->items = ItemPeer::getItemReporteIngresoDia($this->period_id, $this->from_date, $this->to_date);

     $this->rowset = SalesPeer::getAmountIngreso($this->period_id, $this->from_date, $this->to_date);

  }

  public function executeFilterListIngresos(sfWebRequest $request)
  {
      if ($request->hasParameter('_reset'))
      {
	$this->getUser()->setAttribute('ingresos_filters', null);
	$this->redirect('/Reports/listIngresos');
      }

      $this->period_id = $this->getUser()->getAttribute('period');

      $this->filters = new IngresosFormFilter();

      $array_filter = $request->getParameter($this->filters->getName());

      $this->filters->bind($array_filter);
      if ($this->filters->isValid())
      {
		$this->getUser()->setAttribute('ingresos_filters', $array_filter);
      } else {
	 	$this->getUser()->setAttribute('ingresos_filters', null);
      }

      $this->convertToFechaNightAudit($array_filter);

      if(isset($array_filter['period']) && $array_filter['period'] != '' && $array_filter['period'] > 0)
      {
      	$this->period_id = $array_filter['period'];
      }

      // Sacamos las cuentas que han recibidos pagos en dicha fecha
     $this->accounts = AccountPeer::getAccountReporteIngresoDia($this->period_id, $this->from_date, $this->to_date);

     // Sacamos los items que han recibido pagos en este rango de fecha
     $this->items = ItemPeer::getItemReporteIngresoDia($this->period_id, $this->from_date, $this->to_date);

     $this->rowset = SalesPeer::getAmountIngreso($this->period_id, $this->from_date, $this->to_date);

     $this->setTemplate('listIngresos');
   }

   protected function convertToFechaNightAudit($array_filter)
   {

      if ((isset($array_filter['from_date']) && $array_filter['from_date'] !== '') && (isset($array_filter['to_date']) && $array_filter['to_date'] !== ''))
      {
	 $array_from_date = explode('/', $array_filter['from_date']);
	 $this->from_date = $array_from_date[2].'-'.$array_from_date[1].'-'.$array_from_date[0].' 00:00:00';

	 $array_to_date = explode('/', $array_filter['to_date']);
	 $this->to_date = $array_to_date[2].'-'.$array_to_date[1].'-'.$array_to_date[0].' 23:59:59';
      }
      else if(isset($array_filter['from_date']) && $array_filter['from_date'] !== '')
      {
	    $array_from_date = explode('/', $array_filter['from_date']);

	    $this->from_date = $array_from_date[2].'-'.$array_from_date[1].'-'.$array_from_date[0].' 00:00:00';
	    $this->to_date = $array_from_date[2].'-'.$array_from_date[1].'-'.$array_from_date[0].' 23:59:59';

      }
      else if (isset($array_filter['to_date']) && $array_filter['to_date'] !== '')
      {
	     $array_to_date = explode('/', $array_filter['to_date']);

	     $this->from_date = $array_to_date[2].'-'.$array_to_date[1].'-'.$array_to_date[0].' 00:00:00';
	     $this->to_date = $array_to_date[2].'-'.$array_to_date[1].'-'.$array_to_date[0].' 23:59:59';

      } else {
	 // Sacamos la fecha de la ultima auditoria nocturna
	 $night_audit = NightAuditPeer::getLastNightAudit();

	 $this->from_date = $night_audit->getDate('Y').'-'.$night_audit->getDate('m').'-'.$night_audit->getDate('d').' 00:00:00';
	 $this->to_date = $night_audit->getDate('Y').'-'.$night_audit->getDate('m').'-'.$night_audit->getDate('d').' 23:59:59';
      }
   }


  // Reporte de resumen de mensualidad
  public function executeResumenMensualidad(sfWebRequest $request)
  {
     $this->period_id = $this->getUser()->getAttribute('period');

     $this->filters = new ResumenMensualidadFormFilter();

     $array_filter = $this->getUser()->getAttribute('resumen_mensualidad_filters');

     $this->grades = $this->getDataResumenMensualidad($array_filter);

     $this->nro_mes = 1;

     $this->cadena .=  'MES: '.AccountPeer::getMes($this->nro_mes).'  ';

     $this->convertToFecha($array_filter);

     $this->rowset = SalesPeer::getAmountIngreso($this->period_id, $this->from_date, $this->to_date);
  }

  public function executeFilterResumenMensualidad(sfWebRequest $request)
  {
      $this->period_id = $this->getUser()->getAttribute('period');

      if ($request->hasParameter('_reset'))
      {
	$this->getUser()->setAttribute('resumen_mensualidad_filters', null);
	$this->redirect('/Reports/resumenMensualidad');
      }

       $this->filters = new ResumenMensualidadFormFilter();

       $array_filter = $request->getParameter($this->filters->getName());

      $this->filters->bind($array_filter);
      if ($this->filters->isValid())
      {
	$this->getUser()->setAttribute('resumen_mensualidad_filters', $array_filter);
      } else {
	 $this->getUser()->setAttribute('resumen_mensualidad_filters', null);
      }

      $this->cadena = '';

      if(isset($array_filter['timetable_id']) && $array_filter['timetable_id'] > 0)
      {
	$this->cadena .=  'TURNO: '.TimetablePeer::retrieveByPK($array_filter['timetable_id']).'  ';
      }

      if(isset($array_filter['degree_id']) && $array_filter['degree_id'] > 0)
      {
	$this->cadena .=  'CICLO: '.DegreePeer::retrieveByPK($array_filter['degree_id']).'  ';
      }

      if(isset($array_filter['curso_id']) && $array_filter['curso_id'] > 0)
      {
	$this->cadena .=  'CURSO: '.CursoPeer::retrieveByPK($array_filter['curso_id']).'  ';
      }

      if(isset($array_filter['nro_mes']) && $array_filter['nro_mes'] > 0)
      {
	 $this->nro_mes = $array_filter['nro_mes'];
	 $this->cadena .=  'MES: '.AccountPeer::getMes($array_filter['nro_mes']).'  ';
      } else {
	 $this->nro_mes = 1;
	 $this->cadena .=  'MES: '.AccountPeer::getMes(1).'  ';
      }

      $this->convertToFecha($array_filter);

      $this->grades = $this->getDataResumenMensualidad($array_filter);

      $this->rowset = SalesPeer::getAmountIngreso($this->period_id, $this->from_date,  $this->to_date);

      $this->setTemplate('resumenMensualidad');
   }

   protected function getDataResumenMensualidad($filter)
   {
      return GradePeer::getActiveGradeReport(2,
	      (isset($filter['timetable_id']) &&  $filter['timetable_id'] > 0)? $filter['timetable_id'] : null,
	      (isset($filter['degree_id']) && $filter['degree_id'] > 0 )? $filter['degree_id'] : null,
	      (isset($filter['curso_id']) && $filter['curso_id'] > 0) ? $filter['curso_id'] : null
	     );
   }


  // Reporte de resumen de servicio
  public function executeResumenServicios(sfWebRequest $request)
  {
     $this->period_id = $this->getUser()->getAttribute('period');

     $this->filters = new ResumenServicioFormFilter();

     if($this->getUser()->getAttribute('resumen_servicios_filters'))
     {
	$array_filter = $this->getUser()->getAttribute('resumen_servicios_filters');
     } else {
	$array_filter = $request->getParameter('resumen_services_filters');
     }

     $this->grades = $this->getDataResumenServicios($array_filter);

     // items de tipo servicios
     $this->items = ItemPeer::getArraysItems(isset($array_filter['item_id']) ? $array_filter['item_id'] : null);

     $this->nro_mes = 1;

     $this->cadena .=  'MES: '.AccountPeer::getMes($this->nro_mes).'  ';

     $this->convertToFecha($array_filter);

     $this->rowset = SalesPeer::getAmountIngreso($this->period_id, $this->from_date,  $this->to_date);

  }

  public function executeFilterResumenServicios(sfWebRequest $request)
  {
      if ($request->hasParameter('_reset'))
      {
	$this->getUser()->setAttribute('resumen_servicios_filters', null);
	$this->redirect('/Reports/resumenServicios');
      }

      $this->period_id = $this->getUser()->getAttribute('period');

      $this->filters = new ResumenServicioFormFilter();

      $array_filter = $request->getParameter($this->filters->getName());

      $this->filters->bind($array_filter);
      if ($this->filters->isValid())
      {
	$this->getUser()->setAttribute('resumen_servicios_filters', $array_filter);
      } else {
	 $this->getUser()->setAttribute('resumen_servicios_filters', null);
      }



      $this->grades = $this->getDataResumenServicios($array_filter);

      $this->cadena = '';

      $this->items = ItemPeer::getArraysItems(isset($array_filter['item_id']) ? $array_filter['item_id'] : null);

      if(isset($array_filter['timetable_id']) && $array_filter['timetable_id'] > 0)
      {
	$this->cadena .=  'TURNO: '.TimetablePeer::retrieveByPK($array_filter['timetable_id']).'  ';
      }

      if(isset($array_filter['degree_id']) && $array_filter['degree_id'] > 0)
      {
	$this->cadena .=  'CICLO: '.DegreePeer::retrieveByPK($array_filter['degree_id']).'  ';
      }

      if(isset($array_filter['curso_id']) && $array_filter['curso_id'] > 0)
      {
	$this->cadena .=  'CURSO: '.CursoPeer::retrieveByPK($array_filter['curso_id']).'  ';
      }

      if(isset($array_filter['nro_mes']) && $array_filter['nro_mes'] > 0)
      {
	 $this->nro_mes = $array_filter['nro_mes'];
	 $this->cadena .=  'MES: '.AccountPeer::getMes($array_filter['nro_mes']).'  ';
      } else {
	 $this->nro_mes = 1;
	 $this->cadena .=  'MES: '.AccountPeer::getMes(1).'  ';
      }

      $this->convertToFecha($array_filter);

      $this->setTemplate('resumenServicios');
   }

   protected function getDataResumenServicios($filter)
   {
     return GradePeer::getActiveGradeReport(2,
	      (isset($filter['timetable_id']) &&  $filter['timetable_id'] > 0)? $filter['timetable_id'] : null,
	      (isset($filter['degree_id']) && $filter['degree_id'] > 0 )? $filter['degree_id'] : null,
	      (isset($filter['curso_id']) && $filter['curso_id'] > 0) ? $filter['curso_id'] : null
	     );
   }

   // Conversion de fecha para consulta
   protected function convertToFecha($array_filter)
   {
      $this->from_date = null;
      $this->to_date = null;

      if (isset($array_filter['from_date']) && $array_filter['from_date'] !== '')
      {
	 $array_from_date = explode('/', $array_filter['from_date']);

	 $sf_from_date = new sfDate($array_from_date[2].'-'.$array_from_date[1].'-'.$array_from_date[0]);
	 $from_date = $sf_from_date->dump();
         $afrom = explode(' ', $from_date);
         $this->from_date = $afrom[0].' 00:00:00';
      }

      if (isset($array_filter['to_date']) && $array_filter['to_date'] !== '')
      {
	  $array_to_date = explode('/', $array_filter['to_date']);
				     // Año                  Mes                  Dia
	  $sf_to_date = new sfDate($array_to_date[2].'-'.$array_to_date[1].'-'.$array_to_date[0]);
          $to_date = $sf_to_date->dump();
          $aTo = explode(' ', $to_date);
	  $this->to_date = $aTo[0].' 23:59:59';
      }
   }


  // ctasctes 2
   public function executeCtasCtes(sfWebRequest $request)
   {
       $this->period_id = $this->getUser()->getAttribute('period');


       $this->filters = new CtasCtesFormFilter();

       $array_filter = $this->getUser()->getAttribute('list_student_filters');

       $this->Students = array();
       if($this->getUser()->getAttribute('list_student_filters'))
       {
	  $this->Students = $this->getDataListStudent($array_filter);
       }

       $this->cadena = '';

      if(isset($array_filter['timetable_id']) && $array_filter['timetable_id'] > 0)
      {
	$this->cadena .=  'TURNO: '.TimetablePeer::retrieveByPK($array_filter['timetable_id']).'  ';
      }

      if(isset($array_filter['degree_id']) && $array_filter['degree_id'] > 0)
      {
	$this->cadena .=  'CICLO: '.DegreePeer::retrieveByPK($array_filter['degree_id']).'  ';
      }

      if(isset($array_filter['curso_id']) && $array_filter['curso_id'] > 0)
      {
	$this->cadena .=  'CURSO: '.CursoPeer::retrieveByPK($array_filter['curso_id']).'  ';
      }

   }

   public function executeFilterCtasCtes(sfWebRequest $request)
   {
       $this->period_id = $this->getUser()->getAttribute('period');

       if ($request->hasParameter('_reset'))
       {
	 $this->getUser()->setAttribute('list_ctas_ctes', null);
	 $this->redirect('/Reports/ctasCtes');
       }

	$this->filters = new CtasCtesFormFilter();

	$array_filter = $request->getParameter($this->filters->getName());



       $this->filters->bind($array_filter);
       if ($this->filters->isValid())
       {
	 $this->getUser()->setAttribute('list_ctas_ctes', $array_filter);
       } else {
	  $this->getUser()->setAttribute('list_ctas_ctes', null);
       }

       $this->cadena = '';

      if(isset($array_filter['timetable_id']) && $array_filter['timetable_id'] > 0)
      {
	$this->cadena .=  'TURNO: '.TimetablePeer::retrieveByPK($array_filter['timetable_id']).'  ';
      }

      if(isset($array_filter['degree_id']) && $array_filter['degree_id'] > 0)
      {
	$this->cadena .=  'CICLO: '.DegreePeer::retrieveByPK($array_filter['degree_id']).'  ';
      }

      if(isset($array_filter['curso_id']) && $array_filter['curso_id'] > 0)
      {
	$this->cadena .=  'CURSO: '.CursoPeer::retrieveByPK($array_filter['curso_id']).'  ';
      }

       $this->Students = $this->getDataListStudent($array_filter);

       $this->setTemplate('ctasCtes');
    }

}