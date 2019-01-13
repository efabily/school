<?php

/**
 * Item form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class EditItemForm extends BaseItemForm
{
  public function configure()
  {
     parent::setup();          
     
     $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'name'          => new sfWidgetFormInputText(),
      'description'   => new sfWidgetFormTextarea(),
      'price'         => new sfWidgetFormInputText(),      
      'type_item_id'  => new sfWidgetFormChoice(array('choices' => TypeItemPeer::getArrayTypeItem(2)))
    ));

    $this->setValidators(array(      
      'id'            => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'name'          => new sfValidatorString(array('required' => true, 'max_length' => 100, 'required' => false)),
      'description'   => new sfValidatorString(array('required' => false)),
      'price'         => new sfValidatorNumber(array('required' => true)),      
      'type_item_id'  => new sfValidatorInteger(array('required' => true))      
    ));
    
    
    $array_nivel_1 = GradePeer::getArrCurso(1); // turno mañana    
    if(count($array_nivel_1) > 0 )
    {
       $this->widgetSchema['nivel_m'] = new sfWidgetFormChoice(array('multiple' => true, 'expanded' => true,'choices'  => $array_nivel_1), array('required' => false));
       $this->validatorSchema['nivel_m'] = new sfValidatorChoice(array('choices' => array($array_nivel_1), 'required' => false), array( 'invalid' => 'Valor invalido'));
    }
    
    $array_nivel_2 = GradePeer::getArrCurso(2); // turno tarde
    if(count($array_nivel_2) > 0 )
    {
       $this->widgetSchema['nivel_t'] = new sfWidgetFormChoice(array('multiple' => true, 'expanded' => true,'choices'  => $array_nivel_2), array('required' => false));
       $this->validatorSchema['nivel_t'] = new sfValidatorChoice(array('choices' => array($array_nivel_2), 'required' => false), array('invalid' => 'Valor invalido'));
    }
    
    
    $array_nivel_3 = GradePeer::getArrCurso(3); // turno noche
    if(count($array_nivel_3) > 0 )
    {
       $this->widgetSchema['nivel_n'] = new sfWidgetFormChoice(array('multiple' => true,'expanded' => true,'choices'  => $array_nivel_3), array('required' => false));
       $this->validatorSchema['nivel_n'] = new sfValidatorChoice(array('choices' => array($array_nivel_3), 'required' => false), array('invalid' => 'Valor invalido'));
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
  
  
  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();
    
    // Obtengo el objeto
    $item = $this->getObject(); 
    
    if (is_object($item))
    {
      $values = array();
      
      $name['name'] = $item->getName();
      $values = array_merge($values, $name);
      
      $id['id'] = $item->getId();
      $values = array_merge($values, $id);
      
      $description['description'] = $item->getDescription();
      $values = array_merge($values, $description);
            
      $price['price'] = $item->getPrice();
      $values = array_merge($values, $price);
      
      $type_item_id['type_item_id'] = $item->getTypeItemId();
      $values = array_merge($values, $type_item_id);
      
      
      $array_item_grade = ItemGradePeer::getArrayItemGrade($item->getId(), null, 2);
      
      $array_nivel_1 = GradePeer::getArrCurso(1); // turno mañana    
      if(count($array_nivel_1) > 0 )
      {
	 $nivel_m['nivel_m'] = $array_item_grade;
	 $values = array_merge($values, $nivel_m);
      }      
      
      $array_nivel_2 = GradePeer::getArrCurso(2); // turno tarde
      if(count($array_nivel_2) > 0 )
      {
	 $nivel_t['nivel_t'] = $array_item_grade;
	 $values = array_merge($values, $nivel_t);
      }
      
      $array_nivel_3 = GradePeer::getArrCurso(3); // turno noche
      if(count($array_nivel_3) > 0 )
      {
	 $nivel_n['nivel_n'] = $array_item_grade;
         $values = array_merge($values, $nivel_n);
      }
      
      $array_mounth = json_decode($item->getNameLoad(), true);
      
      $arr_month = array();
      if(count($array_mounth))
      {
	 foreach ($array_mounth as $key => $a_mounth)
	 {
	    $arr_month[$key] = $key;
	 }
      }
          
      $month['month'] = $arr_month;
      $values = array_merge($values, $month);
      
      $array_discount_item = DiscountItemPeer::getArrayDiscountItem($item->getId(), null, 2);
 
      $discount['discount'] = $array_discount_item;
      $values = array_merge($values, $discount);
      
      $this->setDefaults(array_merge($this->getDefaults(), $values));      
    }
  }
  
  
}
