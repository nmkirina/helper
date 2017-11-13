<?php
include_once 'BaseService.php';

class ErrorTest extends BaseService
{
    protected function requestParams() {
        return [];
    }
    
    protected function setKontur() {
        $this->kontur = $this->params['kontur'];
    }
    
    public function answer($result) {
        if($result->errorCode) {
            $this->returnAnswer($result->errorMessage);
        } else {
            $this->returnAnswer('Something wrong');
        }
    }
}

$error = new ErrorTest(Config::METHOD_ERROR10000, ['kontur']);
$error->response();