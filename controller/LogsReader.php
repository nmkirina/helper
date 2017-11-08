<?php
  
    $log = $_POST['log'];
    $filename = '/home/irina/projects/rzd_runtime/backend/logs/' . $log;
    $logStrings = file($filename);
    $result = [];
    foreach ($logStrings as $log)
    {
        array_unshift($result, json_decode($log));
    }
    echo '<pre>';
    var_dump($result);
    echo '</pre>';
