<?php

/**
 * language actions.
 *
 * @package    basic
 * @subpackage language
 * @author     Yassel Diaz Gomez
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class periodComponents extends sfComponents
{
  public function executeCurrentPeriod(sfWebRequest $request)
  {
    $sf_guard_user = sfGuardUserPeer::retrieveByPK($this->getUser()->getId());

    $all_period = PeriodPeer::getPeriods();
    
    $default = 0;

    if ($this->getUser()->getAttribute('period'))
    {       
      $default = $this->getUser()->getAttribute('period');
      $this->getUser()->setAttribute('period', $default);
    } else {           
	 $period = PeriodPeer::lastPeriod();
	 
	 if(is_object($period))
	 {	    
	    $default = $period->getId();
	 }
                	 
        $this->getUser()->setAttribute('period', $default);
	$this->getUser()->setCulture('es_ES');
    }
    

    $this->form = new CurrentPeriodForm(
      $this->getUser(),
      array('period' => $all_period, 'default' => $default)
    );
  }
  
}