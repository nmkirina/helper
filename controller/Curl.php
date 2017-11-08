<?php
class Curl
{
    protected $ch;
    
    public function __construct($url, $params = null) 
    {
        $this->ch = curl_init($url);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
        if($params) {
            curl_setopt($this->ch, CURLOPT_POST, true);
            curl_setopt($this->ch, CURLOPT_POSTFIELDS, http_build_query($params));
        }
    }
    
    public function exec()
    {
        return curl_exec($this->ch);
    }
}
