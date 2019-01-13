<?php

/**
 * Period filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class PeriodFormFilter extends BasePeriodFormFilter
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(
       'id_state'      => new sfWidgetFormChoice(array('choices' => ItemPeer::getArrState())),
       'name'          => new sfWidgetFormInputText(array())
       ,'from_date'  =>  new sfWidgetFormDateJQueryUI(
                      array("change_month" => true, 
                            "change_year" => true, 
                            "culture" => sfContext::getInstance()->getUser()->getCulture(),
                      ), array('size'=>'12','maxlength'=>'10')
       )
       ,'to_date' => new sfWidgetFormDateJQueryUI(
                      array("change_month" => true, 
                            "change_year" => true, 
                            "culture" => sfContext::getInstance()->getUser()->getCulture(),
                      ),array('size'=>'12','maxlength'=>'10')
       )
     ));

    $this->setValidators(array(
      'id_state'      => new sfValidatorInteger(array('required' => false)),
      'name'          => new sfValidatorString(array('required' => false))
      ,'from_date' => new sfValidatorDate(array('required' => false,
                   'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'),
                   array('bad_format' => '"%value%" no coincide con el formato de fecha dia/mes/año.', 
                  'max' => 'La fecha debe ser antes de %max%.','required' => 'Obligatorio.'))
            ,'to_date' => new sfValidatorDate(array('required' => false,
                   'date_format' => '~(?P<day>\d{2})/(?P<month>\d{2})/(?P<year>\d{4})~'), 
                   array('bad_format' => '"%value%" no coincide con el formato de fecha dia/mes/año.'))
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
    
  }
}
