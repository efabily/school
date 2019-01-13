<?php

/**
 * Item filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class ItemFormFilter extends BaseItemFormFilter
{
  public function configure()
  {
     parent::setup();
     
     $this->setWidgets(array(
       'id_state'      => new sfWidgetFormChoice(array('choices' => ItemPeer::getArrState())),
       'name'          => new sfWidgetFormInputText(array()),            
       'type_item_id'  => new sfWidgetFormChoice(array('choices' => TypeItemPeer::getArrayTypeItem(2)))
     ));

    $this->setValidators(array(
      'id_state'      => new sfValidatorInteger(array('required' => false)),
      'name'          => new sfValidatorString(array('required' => false)),
      'type_item_id'  => new sfValidatorInteger(array('required' => false))
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
         
  }
}
