<?php
include_once 'Kontur.php';
include_once 'Curl.php';
include_once 'ImageFromBase64.php';
include_once 'Session.php';
include_once '../data/Config.php';

$kontur = $_POST['kontur'];

Session::set('kontur', $kontur);
$url = Kontur::getUrl($kontur) . Config::METHOD_CAPTCHA;

$params = Kontur::getParams($kontur);
$result = (new Curl($url, $params))->exec();
$result = json_decode($result);

if (!$result->errorCode){
    $image = new ImageFromBase64($result->result->image);
    Session::set(Config::PARAM_JSESSIONID, $result->result->jsessionId);
    echo $image->filename;
    die;
}
//include_once 'BaseService.php';
//
//class GetSession extends BaseService
//{
//    public function __construct($method, $params) {
//        Session::set('kontur', $kontur);
//        parent::__construct($method, $params);
//    }
//
//    public function requestParams() {
//        return $this->baseParams();
//    }
//}
//
//$getSession = new GetSession(Config::METHOD_CAPTCHA, ['kontur']);