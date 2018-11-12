<?php
include_once '../data/Config.php';

class Kontur
{
    const LOCAL = 'local';
    const TEST = 'test';
    const UAT = 'uat';
    const UAT2 = 'uat2';
    const EKMP = 'ekmp';
    const PREPROD = 'preprod';

    public static function getUrl($kontur)
    {
        switch ($kontur) {
            case self::LOCAL:
                return Config::URL_LOCAL;
            case self::TEST: 
                return Config::URL_TEST;
            case self::UAT:
                return Config::URL_UAT;
            case self::UAT2:
                return Config::URL_UAT2;
            case self::EKMP:
                return Config::URL_EKMP;
            case self::PREPROD:
                return Config::URL_PREPROD;
        }
    }
    
    public static function getParams($kontur)
    {
        if($kontur == self::UAT || $kontur == self::EKMP || $kontur == self::UAT2 || $kontur == self::PREPROD) {
            return ['protocolVersion' => 2];
        }
        return [];
    }
}

