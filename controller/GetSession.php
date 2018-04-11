<?php
include_once 'BaseService.php';

class GetSession extends BaseService
{    
    public function requestParams() {
        return $this->baseParams();
    }
    
    public function setKontur() {
        $this->kontur = $this->params['kontur'];
        Session::set('kontur', $this->kontur);
    }
    
    public function answer($result) {
        if(!$result->errorCode) {
            $image = new ImageFromBase64($result->result->image);
            Session::set(Config::PARAM_JSESSIONID, $result->result->jsessionId);
            $this->returnAnswer($image->filename);
        } else {
            $this->returnAnswer($result->errorMessage);
        }        
    }
}
$getSession = new GetSession(Config::METHOD_CAPTCHA, ['kontur']);
$getSession->response();
