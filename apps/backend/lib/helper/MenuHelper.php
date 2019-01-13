<?php

/**
 * @author Yassel Diaz Gomez
 * @copyright 2011
 */
//define('ENV', '/backend_dev.php/');

function menu_build()
{    
  // include joomla menu object tree libraries BASIC_ROOT_DIR .
  require_once(BACKEND_ROOT_DIR.DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR .
  'utils' . DIRECTORY_SEPARATOR .'Menu' . DIRECTORY_SEPARATOR . 'menu.php');

  // Get the menu object
  $menu = new JAdminCSSMenu();

  $menu->addChild(new JMenuNode(__('ALUMNOS'), '/Student/index', 'ALUMNOS'), true);
  $menu->getParent();
  
  $menu->addChild(new JMenuNode(__('VENTA'), '/Sales/pago', 'VENTA DIRECTA'), true);
  $menu->getParent();
  
  $menu->addChild(new JMenuNode(__('TRANSFERENCIA'), '/transfer/createTransfer', 'TRANSFERENCIA'), true);
  $menu->getParent();

  // Especialista dela entidad 
//  if(BeUserGroupPeer::inGroup(sfContext::getInstance()->getUser()->getId(), 3))
//  {
        $menu->addChild(new JMenuNode(__('CAJA'), '/cashbox/index', 'CAJA'), true);
        $menu->getParent();
	
	$menu->addChild(new JMenuNode(__('CIERRES'), '/NightAudit/index', 'CIERRES'), true);
        $menu->getParent();

        $menu->addChild(new JMenuNode(__('REPORTES'), '', 'Reporte'), true);	
        $menu->addChild(new JMenuNode(__('LISTA DE ALUMNOS'), '/Reports/listStudents', 'LISTA DE ALUMNOS'));
	$menu->addChild(new JMenuNode(__('LISTA DE INGRESOS'), '/Reports/listIngresos', 'RESUMEN DE SERVICIOS'));
        $menu->addChild(new JMenuNode(__('RESUMEN DE MENSUALIDAD'), '/Reports/resumenMensualidad', 'RESUMEN DE MENSUALIDAD'));
	$menu->addChild(new JMenuNode(__('RESUMEN DE SERVICIOS'), '/Reports/resumenServicios', 'RESUMEN DE SERVICIOS'));
	$menu->addChild(new JMenuNode(__('SALDO DEUDAS'), '/Reports/ctasCtes', 'SALDO DEUDAS POR MENSUALIDAD'));
	
        $menu->getParent();
//  }

  
  // ADM dela entidad
//  if(BeUserGroupPeer::inGroup(sfContext::getInstance()->getUser()->getId(), 2) || BeUserGroupPeer::inGroup(sfContext::getInstance()->getUser()->getId(), 1))
//  {
        $menu->addChild(new JMenuNode(__('ADM'), '', 'ADM'), true);
        $menu->addChild(new JMenuNode(__('ITEM'), '/Item/index', 'ITEM'));
        $menu->addChild(new JMenuNode(__('TIPO DE ITEM'), '/TypeItem/index', 'TIPO DE ITEM'));
        $menu->addChild(new JMenuNode(__('DESCUENTO'), '/Discount/index', 'DESCUENTO'));
        $menu->addChild(new JMenuNode(__('PERIODOS'), '/Period/index', 'PERIODOS'));
        $menu->addChild(new JMenuNode(__('TIPO DE CAMBIO'), '/currencyPrice/index', 'Cierre'));        

        $menu->getParent();
//  }

  return $menu->renderMenu();
}