<?php

/**
 * Discount form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class DiscountForm extends BaseDiscountForm
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(      
      'name'        => new sfWidgetFormInputText(),
      'discount'    => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea()
    ));

    $this->setValidators(array(      
      'name'        => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'discount'    => new sfValidatorNumber(array('min' => 1, 'max' => 100, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false))      
    ));
    
    
    $this->widgetSchema->setLabels(
        array(
          'name' => 'Nombre:',
	  'discount' => 'Descuento %:',
          'description' => 'Descripción:'          
        )
     );

    $this->widgetSchema->setNameFormat('discount[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
