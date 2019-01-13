<?php

/**
 * Period form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class PeriodForm extends BasePeriodForm
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(      
      'name'       => new sfWidgetFormInputText(),
      'from_date'  => new sfWidgetFormDate(array('format' => '%day% - %month% - %year%')),
      'to_date'    => new sfWidgetFormDate(array('format' => '%day% - %month% - %year%'))
     ));

     $this->setValidators(array(            
      'name'       => new sfValidatorString(array('max_length' => 100)),
      'from_date'  => new sfValidatorDate(array('required' => false)),
      'to_date'    => new sfValidatorDate(array('required' => false))
     ));
     
     $this->widgetSchema->setLabels(
	     array(
		 'name' => 'Nombre'
		 ,'from_date' => 'Desde'
		 ,'to_date' => 'Hasta'
		 )
	     );

     $this->widgetSchema->setNameFormat('period[%s]');

     $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }
}
