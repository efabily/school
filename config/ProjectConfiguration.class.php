<?php

require_once dirname(__FILE__).'/../lib/vendor/symfony/lib/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();
define('BACKEND_ROOT_DIR', realpath(dirname(__FILE__).'/..'));

class ProjectConfiguration extends sfProjectConfiguration
{
  public function setup()
  {
    $this->enablePlugins('sfPropelPlugin');
    $this->enablePlugins('sfGuardPlugin');
    $this->enablePlugins('sfJqueryReloadedPlugin');
    $this->enablePlugins('sfDateTime2Plugin');
    $this->enablePlugins('sfJQueryUIPlugin');
    $this->enablePlugins('sfJQueryUIPlugin');
  }
}
