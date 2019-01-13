<?php

/**
 * Item module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage Item
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseItemGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'item' : 'item_'.$action;
  }
}
