<?php
include_once 'BaseService.php';

class ReadCaptcha extends BaseService
{
    public function clear() {
        ImageFromBase64::deleteImage();
        parent::clear();
    }
    
    public function requestParams() {
        return array_merge($this->baseParams(), 
                [
                    'login' => urlencode($this->params['login']), 
                    'password' => urlencode($this->params['path']), 
                    'deviceGuid' => $this->params['device'],
                    'captcha' => [
                                    'value' => $this->params['captcha'], 
                                    'jsessionId' => Session::get(Config::PARAM_JSESSIONID)
                                 ]
                ]);
    }
}

$readCaptcha = new ReadCaptcha(Config::METHOD_LOGIN, ['captcha', 'login', 'path', 'device']);
$result = $readCaptcha->response();
$readCaptcha->clear();
if(!$result->errorCode){
    $readCaptcha->returnAnswer($result->result->sessionId);
} else {
    $readCaptcha->returnAnswer($result->errorMessage);
}
