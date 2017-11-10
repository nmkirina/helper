<?php

class Session
{
    public static function set($key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
        self::end();
    }

    public static function get($key)
    {
        self::start();
        $value = $_SESSION[$key];        
        self::end();
        return $value;
    }
    
    public static function clear($params)
    {
        self::start();
        foreach ($params as $key)
        {
            unset($_SESSION[$key]);
        }
        self::end();
    }

    protected static function start()
    {
        session_start();
    }
    
    protected static function end()
    {
        session_write_close();
    }
    
}

