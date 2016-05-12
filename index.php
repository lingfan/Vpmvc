<?php
include('common.php');
$r = isset($_GET['r'])?$_GET['r']:'';
$app = new Controller($r);
$app->run();
?>