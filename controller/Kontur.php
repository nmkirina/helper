<?php
include_once '../data/Config.php';

class Kontur
{
    const LOCAL = 'local';
    const TEST = 'test';
    const UAT = 'uat';
    const EKMP = 'ekmp';

    public static function getUrl($kontur)
    {
        switch ($kontur) {
            case self::LOCAL:
                return Config::URL_LOCAL;
            case self::TEST: 
                return Config::URL_TEST;
            case self::UAT:
                return Config::URL_UAT;
            case self::EKMP:
                return Config::URL_EKMP;
        }
    }
    
    public static function getParams($kontur)
    {
        if($kontur == self::UAT || $kontur == self::EKMP) {
            return ['protocolVersion' => 2];
        }
        return [];
    }
}
