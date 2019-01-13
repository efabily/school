<?php
class ConfigForm extends BaseBusinessEntityForm
{
  public function configure()
  {
    parent::configure();  
    
    unset(
      // $this['id'],
      $this['id_central'],
      $this['id_state'],
      $this['deleted_by'],
      $this['created_at'],
      $this['updated_at'],
      $this['name'],
      $this['description'],
      $this['server_name'],
      $this['connection'],
      $this['night_audit_overtime'],
      $this['deleted_at']
    );        
    
    // Hora de cierre
    $choices_night_audit_hour = array(0 =>'00:00'
	                             ,1 =>'01:00'
				     ,2 =>'02:00'
				     ,3 =>'03:00'
				     ,4 =>'04:00'
				     ,5 =>'05:00'
				     ,6 =>'06:00'
				     ,7 =>'07:00'
				     ,8 =>'08:00'
				     ,9 =>'09:00'
				     ,10 =>'10:00'
				     ,11 =>'11:00'
				     ,12 =>'12:00'
				     ,13 =>'13:00'
				     ,14 =>'14:00'
				     ,15 =>'15:00'
				     ,16 =>'16:00'
				     ,17 =>'17:00'
				     ,18 =>'18:00'
				     ,19 =>'19:00'
				     ,20 =>'20:00'
				     ,21 =>'21:00'
				     ,22 =>'22:00'
				     ,23 =>'23:00'
				     );
    $this->widgetSchema['night_audit_hour'] = new sfWidgetFormSelect(array('choices' => $choices_night_audit_hour, 'default'=>'0'));
    
    $this->validatorSchema['night_audit_hour'] = new sfValidatorInteger(array('required' => false)); 
    
    $this->disableLocalCSRFProtection();
    
  }
  
  
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    
    $config = $this->getObject();
    
    if (is_object($config))
    {
       
      $values = array();            
                  
      $values_nah['night_audit_hour'] = $config->getNightAuditHour();
      $values = array_merge($values, $values_nah);
      
      $this->setDefaults(array_merge($this->getDefaults(), $values));      
    }
  }
  
  
  
}