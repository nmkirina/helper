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
    
    public function setKontur() {
        $this->kontur = Session::get(Config::PARAM_KONTUR);
    }
    
    public function returnAnswer($answer, $error = null) {
        $this->clear();
        parent::returnAnswer($answer, $error);
    }
}

$readCaptcha = new ReadCaptcha(Config::METHOD_CAPTCHA, ['captcha', 'login', 'path', 'device']);
$result = $readCaptcha->response();
$readCaptcha->returnAnswer($result->result->sessionId, $result->errorMessage);
