<?php
include_once 'Kontur.php';
include_once 'Curl.php';
include_once 'ImageFromBase64.php';
include_once 'Session.php';

$kontur = $_POST['kontur'];

Session::set('kontur', $kontur);
$url = Kontur::getUrl($kontur) . 'enteraptcha';

$params = Kontur::getParams($kontur);
$result = (new Curl($url, $params))->exec();
$result = json_decode($result);

if (!$result->errorCode){
    $image = new ImageFromBase64($result->result->image);
    Session::set('jsessionId', $result->result->jsessionId);
    echo $image->filename;
    die;
}