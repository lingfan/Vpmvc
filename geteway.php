<?php
$path = dirname(__FILE__).'/lib/';
set_include_path(get_include_path() . PATH_SEPARATOR . $path);
require 'Zend/Amf/Server.php';
$server = new Zend_Amf_Server();
$server->addDirectory(dirname(__FILE__) .'/services/');
$response = $server->handle(); 
echo $response;

?>