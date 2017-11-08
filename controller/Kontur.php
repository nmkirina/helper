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
                return 'localenter';
            case self::TEST: 
                return 'enter';
            case self::UAT:
                return 'enter';
            case self::EKMP:
                return 'enter';        
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

