<?php

/**
 * Student filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class IngresosFormFilter extends BaseStudentFormFilter
{
  public function configure()
  {
     parent::setup();

     $arrayPerios = PeriodPeer::getPeriods();

     $period_id = sfContext::getInstance()->getUser()->getAttribute('period');

     $this->setWidgets(array(
          'from_date' => new sfWidgetFormDateJQueryUI(
                 array( "change_year" => true, "culture" => "es"
	         ),array('size'=>'12','maxlength'=>'10'))
	     ,'to_date' => new sfWidgetFormDateJQueryUI(array( "change_year" => true,
	         "culture" => "es"),array('size'=>'12','maxlength'=>'10'))
     	 ,'period' => new sfWidgetFormChoice(
    				array('choices' => $arrayPerios, 'default' => array($period_id)),
    				array()
    		)
    ));

    $this->setValidators(array(
      'from_date' => new sfValidatorDateTime(array('required' => false,
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             ))
            ,'to_date' => new sfValidatorDateTime(array('required' => false,
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             ))
    		,'period' => new sfValidatorInteger(array('trim' => true))
    ));

    $this->widgetSchema->setNameFormat('ingresos_filters[%s]');

    $this->widgetSchema->setLabels(
    		array(
    				'period' => 'Periodos: '
    		)
    );


    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    $this->disableLocalCSRFProtection();

  }
}