<?php

/**
 * Discount filter form.
 *
 * @package    school
 * @subpackage filter
 * @author     Your name here
 */
class DiscountFormFilter extends BaseDiscountFormFilter
{
  public function configure()
  {
      parent::setup();
     
     $this->setWidgets(array(
       'id_state'      => new sfWidgetFormChoice(array('choices' => ItemPeer::getArrState())),
       'name'          => new sfWidgetFormInputText(array()),            
       'discount'  => new sfWidgetFormInputText(array())
     ));

    $this->setValidators(array(
      'id_state'      => new sfValidatorInteger(array('required' => false)),
      'name'          => new sfValidatorString(array('required' => false)),
      'discount'  => new sfValidatorInteger(array('required' => false))
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);
  }
}
