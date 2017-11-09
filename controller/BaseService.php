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
    
    public function __construct($method, $params) {
        foreach ($params as $param)
        {
            if(isset($_POST[$param])){
                $this->params[$param] = $_POST[$param];
            }
        }
        $this->kontur = Session::get(Config::PARAM_KONTUR);
        $this->url = Kontur::getUrl($this->kontur) . $method;
    }
    
    public function returnAnswer($answer)
    {
        echo $answer;
        die;
    }
    
    public function response()
    {
        $result = (new Curl($this->url, $this->requestParams()))->exec();
        return json_decode($result);
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
}
