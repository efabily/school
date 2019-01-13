<?php

//set_include_path('/home/efabily/www/school/lib/utils'. PATH_SEPARATOR. get_include_path());
//require '../lib/utils/Zend/Date.php';

//echo calcMora(10, 1000);

//$dueDate = $nextMonth


// ECHO '<PRE>';
// print_r($_SERVER);



//exit;

require_once(dirname(__FILE__).'/../config/ProjectConfiguration.class.php');

$configuration = ProjectConfiguration::getApplicationConfiguration('backend', 'pro', true);
sfContext::createInstance($configuration)->dispatch();

