<?php
require_once(dirname(__FILE__).'/config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'pro', true);
sfContext::createInstance($configuration)->dispatch();

