<?php

/**
 * TypeItem module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage TypeItem
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseTypeItemGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'type_item' : 'type_item_'.$action;
  }
}
