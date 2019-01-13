<?php

/**
 * CashBox filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class CashBoxFormFilter extends BaseCashBoxFormFilter
{
  public function configure()
  {
     parent::configure();

     $choices_state = CashBoxPeer::getStates();
     // $choices_cashier = sfGuardUserProfilePeer::getCashier();         
     
     $choices_cashier = array();

     $this->setWidgets(
            array(
             'id_state' => new sfWidgetFormSelect(array('choices' => $choices_state), array('add_empty' => ''))             
            ,'cashier_id' => new sfWidgetFormSelect(array('choices' => $choices_cashier), array('add_empty' => ''))
             ,'from_date' => new sfWidgetFormDateJQueryUI(
                 array( "change_year" => true, "culture" => "es"
	         ),array('size'=>'12','maxlength'=>'10'))
	     ,'to_date' => new sfWidgetFormDateJQueryUI(array( "change_year" => true,
	         "culture" => "es"),array('size'=>'12','maxlength'=>'10'))
	    )
      );
    
        
      $this->setValidators(
        array(
             'id_state' => new sfValidatorInteger(array('required' => false, 'trim' => true))
            ,'cashier_id' => new sfValidatorInteger(array('required' => false, 'trim' => true))            
            ,'from_date' => new sfValidatorDateTime(array('required' => false,
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             ))
            ,'to_date' => new sfValidatorDateTime(array('required' => false,             
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             )),
          )
     );
      
     $this->widgetSchema->setNameFormat('filters[%s]'); 
     
     
  }
}
