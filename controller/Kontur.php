<?php

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
                return 'http://rzd.local';
            case self::TEST: 
                return 'http://test.rzd.altarix.org:8889';
            case self::UAT:
                return 'http://uat.rzd.altarix.org:8889';
            case self::EKMP:
                return 'https://ekmp.rzd.ru';        
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

