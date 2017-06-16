<?php
namespace Core;

class Configure
{
    private static $params = null;
    public static function getParam($name)
    {
        if (!isset(self::$params)) {
            self::$params = json_decode(file_get_contents('../app/config.json'), true);
        }

        if(!isset(self::$params[$name])) {
            return null;
        }
        return self::$params[$name];
    }
}