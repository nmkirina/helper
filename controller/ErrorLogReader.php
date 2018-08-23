<?php
include_once '../data/Config.php';

$log = $_POST['log'];
$filename = Config::PATH_LOGS . $log;
$resultJson = file_get_contents($filename);

echo '<pre>';
var_dump($resultJson);
echo '</pre>';
