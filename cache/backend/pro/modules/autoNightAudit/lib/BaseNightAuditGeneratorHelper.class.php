<?php

/**
 * NightAudit module configuration.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage NightAudit
 * @author     ##AUTHOR_NAME##
 */
abstract class BaseNightAuditGeneratorHelper extends sfModelGeneratorHelper
{
  public function getUrlForAction($action)
  {
    return 'list' == $action ? 'night_audit_NightAudit' : 'night_audit_NightAudit_'.$action;
  }
}
