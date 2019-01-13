<?php

/**
 * language actions.
 *
 * @package    basic
 * @subpackage language
 * @author     Yassel Diaz Gomez
 * @version    SVN: $Id: components.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class businessEntityComponents extends sfComponents
{
  public function executeBusinessEntity(sfWebRequest $request)
  {
    $sf_guard_user = sfGuardUserPeer::retrieveByPK($this->getUser()->getId());

    $all_business_entity = $sf_guard_user->getBusinessEntitys();

    $default = 0;

    if ($this->getUser()->getAttribute('business_entity'))
    {
      $default = $this->getUser()->getAttribute('business_entity');
    } else {

      if (count($all_business_entity) == 1)
      {
        $default = $sf_guard_user->getBusinessEntity();
        
        $this->getUser()->setAttribute('business_entity', $default);
        
        BusinessEntityUserPeer::updatePermission($this->getUser(), $this->getUser()->getAttribute('business_entity'));
      }
    }

    $this->form = new BusinessEntityForm(
      $this->getUser(),
      array('business_entity' => $all_business_entity, 'default' => $default)
    );
  }
  
  public function executeSystemDate(sfWebRequest $request)
  {
     $this->msg = '';
     if ($this->getUser()->getAttribute('business_entity'))
     {
	$this->msg = 'Fecha del Sistema: ';
	$night_audit = NightAuditPeer::getLast($this->getUser()->getAttribute('business_entity'));
	
	if(is_object($night_audit))
	{	   
	   $this->night_audit = $night_audit;
	}	
     } else {
	$this->msg = 'Debe seleccionar una entidad para trabajar';
     }
    
  }
}