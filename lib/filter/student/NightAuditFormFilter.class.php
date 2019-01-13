<?php

/**
 * NightAudit filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class NightAuditFormFilter extends BaseNightAuditFormFilter
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(
      
      'from_date' => new sfWidgetFormDateJQueryUI(
                 array( "change_year" => true, "culture" => "es"
	         ),array('size'=>'12','maxlength'=>'10'))
	     ,'to_date' => new sfWidgetFormDateJQueryUI(array( "change_year" => true,
	"culture" => "es"),array('size'=>'12','maxlength'=>'10')),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true))      
    ));

    $this->setValidators(array(      
      'from_date' => new sfValidatorDateTime(array('required' => false,
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             ))
            ,'to_date' => new sfValidatorDateTime(array('required' => false,             
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             )),
      'user_id'            => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),      
    ));

    $this->widgetSchema->setNameFormat('night_audit_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    
  }
}
