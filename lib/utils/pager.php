<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Clase para la paginacion
 *
 * @author Carolina
 */
class pager {

    /**
   *
   * @param Criteria $criteria
   * @param Int $page
   * @param Int $list_max
   * @return sfPropelPager 
   */
  public static function getPager($class, $criteria, $page = 1, $list_max = 20)
  {        
    $pager = new sfPropelPager($class, $list_max);
    $pager->setCriteria($criteria);
    $pager->setPage($page);
    $pager->init();
        
    return $pager;    
  }
  
}

?>
