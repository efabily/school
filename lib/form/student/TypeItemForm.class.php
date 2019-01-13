<?php

/**
 * TypeItem form.
 *
 * @package    school
 * @subpackage form
 * @author     Your name here
 */
class TypeItemForm extends BaseTypeItemForm
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(
      'name'        => new sfWidgetFormInputText(),
      'description' => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'name'        => new sfValidatorString(array('max_length' => 100)),
      'description' => new sfValidatorString(),
    ));
    
    
    $this->widgetSchema->setLabels(
        array(
          'name' => 'Nombre:',
          'description' => 'Descripción:'          
        )
     );
    
    
    $this->widgetSchema->setNameFormat('type_item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    
  }
}
