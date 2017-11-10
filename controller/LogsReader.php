<?php
include_once '../data/Config.php';

$log = $_POST['log'];
$filename = Config::PATH_LOGS . $log;
$logStrings = file($filename);
$result = [];
foreach ($logStrings as $log)
{
    array_unshift($result, json_decode($log));
}
echo '<pre>';
var_dump($result);
echo '</pre>';
