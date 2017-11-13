<?php
include_once 'Curl.php';
include_once 'Kontur.php';
include_once 'ImageFromBase64.php';
include_once 'Session.php';
include_once '../data/Config.php';

abstract class BaseService
{
    public $params;
    public $url;
    public $kontur;
    public $result;


    public function __construct($method, $params) {
        foreach ($params as $param)
        {
            if(isset($_POST[$param])){
                $this->params[$param] = $_POST[$param];
            }
        }
        $this->setKontur();
        $this->url = Kontur::getUrl($this->kontur) . $method;
    }
    
    public function returnAnswer($answer)
    {
        echo $answer;
        die;
    }
    
    public function response()
    {
        $response = (new Curl($this->url, $this->requestParams()))->exec();
        $result = json_decode($response);
        $this->answer($result);
    }
    
    public function clear()
    {
        Session::clear([Config::PARAM_JSESSIONID, Config::PARAM_KONTUR]);
    }
    
    public function baseParams()
    {
        return Kontur::getParams($this->kontur);
    }    
            
    abstract protected function requestParams();
    abstract protected function setKontur();
    abstract public function answer($result);
}
