<?php

/**
 * CurrencyPrice filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class CurrencyPriceFormFilter extends BaseCurrencyPriceFormFilter
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(
      'since_date' => new sfWidgetFormDateJQueryUI(
                 array( "change_year" => true, "culture" => "es"
	         ),array('size'=>'12','maxlength'=>'10'))
	,'until_date' => new sfWidgetFormDateJQueryUI(array( "change_year" => true,
	"culture" => "es"),array('size'=>'12','maxlength'=>'10')),
      'currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => true)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
    ));

    $this->setValidators(array(
	'since_date' => new sfValidatorDateTime(array('required' => false,
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             ))
            ,'until_date' => new sfValidatorDateTime(array('required' => false,             
                            'date_format' => '/^[0-9]{2}\/[0-9]{2}\/[0-9]{4}$/',
             )),
      'currency_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Currency', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('currency_price_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    
    
  }
}
