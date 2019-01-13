<?php

/**
 * cashbox module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage cashbox
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseCashboxGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'cashbox' : 'cashbox_'.$action;
  }
}
