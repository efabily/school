<?php

class accountComponents extends sfComponents
{

  public function executeListItems()
  {
    $item_list = ItemForSalePeer::getItemsFromPosItemsGroup($this->getUser()->getAttribute('current_pos'),
                                                          $this->getUser()->getAttribute('current_items_group'));
    $this->item_list = array();

    foreach($item_list as $item)
    {
      $this->item_list[$item->getId()]['id'] = $item->getId();
      $this->item_list[$item->getId()]['name'] = $item->getName();
      $this->item_list[$item->getId()]['price'] = $item->getPrice();
      $this->item_list[$item->getId()]['color'] = $item->getItemForSaleGroup()->getColor()->getCode();
    }
  }
  
}