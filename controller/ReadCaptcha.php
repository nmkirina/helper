<?php
include_once 'Curl.php';
include_once 'Kontur.php';
include_once 'ImageFromBase64.php';
include_once 'Session.php';

$captcha = $_POST['captcha'];
$login = $_POST['login'];
$path = $_POST['path'];
$device = $_POST['device'];

$login = trim(mb_strtolower($login));

$kontur = Session::get('kontur');
$url = Kontur::getUrl($kontur) . 'enterlogin';

$params = Kontur::getParams($kontur);
$params = array_merge($params, ['login' => urlencode($login), 'password' => urlencode($path), 
    'deviceGuid' => $device,
    'captcha' => ['value' => $captcha, 'jsessionId' => Session::get('jsessionId')]]);
$result = (new Curl($url, $params))->exec();
$result = json_decode($result);
if (!$result->errorCode){
    ImageFromBase64::deleteImage();
    Session::clear(['jsessionId', 'kontur']);
    echo $result->result->sessionId;
    die;
}

echo 'Error';
die;