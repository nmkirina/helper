<?php
include_once '../data/Config.php';

class ImageFromBase64
{
    public $filename;
    
    public function __construct($base64) 
    {
        $this->imageName();
        $fp = fopen(Config::PATH_TMP . $this->filename, "wb");
        $this->saveImageName();
        fwrite($fp, base64_decode($base64));
        fclose($fp);        
    }
    
    public static function deleteImage()
    {
        session_start();        
        $imageName = $_SESSION['imageName'];
        unlink(Config::PATH_TMP . $imageName);
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

