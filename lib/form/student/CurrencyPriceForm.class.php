<?php

/**
 * CurrencyPrice form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class CurrencyPriceForm extends BaseCurrencyPriceForm
{
   
   // $this->widgetSchema['my_date']= new sfWidgetFormDateJQueryUI(array("change_month" => true, "change_year" => true)),
   
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(            
      'reference'   => new sfWidgetFormInputText(),
      'sale'        => new sfWidgetFormInputText(),
      'purchase'    => new sfWidgetFormInputText(),
      'since_date'  => new sfWidgetFormDate(array('format' => '%day% - %month% - %year%')),
      'until_date'  => new sfWidgetFormDate(array('format' => '%day% - %month% - %year%')),
      'currency_id' => new sfWidgetFormPropelChoice(array('model' => 'Currency', 'add_empty' => false))      
    ));

    $this->setValidators(array(      
      'reference'   => new sfValidatorString(array('max_length' => 100)),
      'sale'        => new sfValidatorNumber(),
      'purchase'    => new sfValidatorNumber(),
      'since_date'  => new sfValidatorDate(),
      'until_date'  => new sfValidatorDate(),
      'currency_id' => new sfValidatorPropelChoice(array('model' => 'Currency', 'column' => 'id'))      
    ));
    
    $this->widgetSchema->setLabels(array(
	'reference'   => 'Referencia',
	 'sale'        => 'Venta',
	 'purchase'    => 'Compra',
	 'since_date'  => 'Desde',
	 'until_date'  => 'Hasta',
	 'currency_id' => 'Moneda'
    ));

    $this->widgetSchema->setNameFormat('currency_price[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    
     
  }
}
