<?php

class ImageFromBase64
{
    public $filename;
    
    public function __construct($base64) 
    {
        $this->imageName();
        $fp = fopen('/home/irina/projects/log-reader/tmp/' . $this->filename, "wb");
        $this->saveImageName();
        fwrite($fp, base64_decode($base64));
        fclose($fp);        
    }
    
    public static function deleteImage()
    {
        session_start();        
        $imageName = $_SESSION['imageName'];
        unlink('/home/irina/projects/log-reader/tmp/' . $imageName);
        session_write_close();
    }
    
    protected function imageName()
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < 10; $i++) {
            $randstring .= $characters[rand(0, strlen($characters))];
        }
        $this->filename = $randstring . '.png';
    }
    
    protected function saveImageName()
    {
        session_start();
        $_SESSION['imageName'] = $this->filename;
        session_write_close();
    }
    
}

