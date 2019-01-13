<?php

/**
 * Item form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class NewItemForm extends BaseItemForm
{
  public function configure()
  {
     parent::setup();          
     
     $this->setWidgets(array(
      'name'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'price'         => new sfWidgetFormInputText(),      
      'type_item_id'  => new sfWidgetFormChoice(array('choices' => TypeItemPeer::getArrayTypeItem(2)))      
    ));

    $this->setValidators(array(      
      'name'          => new sfValidatorString(array('required' => true, 'max_length' => 100, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => true)),
      'price'         => new sfValidatorNumber(array('required' => true)),      
      'type_item_id'  => new sfValidatorInteger(array('required' => true))      
    ));
    
    
    $array_nivel_1 = GradePeer::getArrCurso(1); // turno mañana    
    if(count($array_nivel_1) > 0 )
    {
       $this->widgetSchema['nivel_m'] = new sfWidgetFormChoice(array('multiple' => true, 'expanded' => true,'choices'  => $array_nivel_1), array('required' => false));
       $this->validatorSchema['nivel_m'] = new sfValidatorChoice(array('required' => false, 'choices' => array($array_nivel_1)), array('invalid' => 'Valor invalido'));
    }
    
    $array_nivel_2 = GradePeer::getArrCurso(2); // turno tarde
    if(count($array_nivel_2) > 0 )
    {
       $this->widgetSchema['nivel_t'] = new sfWidgetFormChoice(array('multiple' => true, 'expanded' => true,'choices'  => $array_nivel_2), array('required' => false));
       $this->validatorSchema['nivel_t'] = new sfValidatorChoice(array('required' => false, 'choices' => array($array_nivel_2)), array('invalid' => 'Valor invalido'));
    }
    
    
    $array_nivel_3 = GradePeer::getArrCurso(3); // turno noche
    if(count($array_nivel_3) > 0 )
    {
       $this->widgetSchema['nivel_n'] = new sfWidgetFormChoice(array('multiple' => true,'expanded' => true,'choices'  => $array_nivel_3), array('required' => false));
       $this->validatorSchema['nivel_n'] = new sfValidatorChoice(array('required' => false, 'choices' => array($array_nivel_3)), array('invalid' => 'Valor invalido'));
    }
    
    $array_month = array(
	 1 => 'Enero'
	,2 => 'Febrero'
	,3 => 'Marzo'
	,4 => 'Abril'
	,5 => 'Mayo'
	,6 => 'Junio'
	,7 => 'Julio'
	,8 => 'Agosto'
	,9 => 'Septiembre'
	,10 => 'Octubre'
	,11 => 'Noviembre'
	,12 => 'Diciembre'	
    );
    
    $this->widgetSchema['month'] = new sfWidgetFormChoice(array('multiple' => true,'expanded' => true,'choices'  => $array_month, 'label' => 'label_month'), array('required' => false));
    $this->validatorSchema['month'] = new sfValidatorChoice(array('required' => false, 'choices' => array($array_month)), array('invalid' => 'Valor invalido'));
    
    $array_discount = DiscountPeer::getArrayDiscount(2);
    $this->widgetSchema['discount'] = new sfWidgetFormChoice(array('multiple' => true,'expanded' => true,'choices'  => $array_discount), array('required' => false));
    $this->validatorSchema['discount'] = new sfValidatorChoice(array('required' => false, 'choices' => array($array_discount)), array('invalid' => 'Valor invalido'));
    

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

  }
}
