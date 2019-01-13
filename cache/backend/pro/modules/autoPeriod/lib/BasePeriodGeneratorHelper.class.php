<?php

/**
 * Period module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage Period
 * @author     ##AUTHOR_NAME##
 */
abstract class BasePeriodGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'period' : 'period_'.$action;
  }
}
