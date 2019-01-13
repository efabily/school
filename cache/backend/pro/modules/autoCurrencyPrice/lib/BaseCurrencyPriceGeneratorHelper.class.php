<?php

/**
 * currencyPrice module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage currencyPrice
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseCurrencyPriceGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'currency_price' : 'currency_price_'.$action;
  }
}
