<?php

/**
 * Discount module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage Discount
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseDiscountGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'discount' : 'discount_'.$action;
  }
}
