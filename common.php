<?php
error_reporting(E_ALL);
ini_set("display_errors", 1); 
 
define('ROOT_PATH', dirname(__FILE__));
define('RUNTIME_PATH', dirname(__FILE__).'/runtime');
include(ROOT_PATH.'/config.php');
include(ROOT_PATH.'/lib/Loader.php');
?>