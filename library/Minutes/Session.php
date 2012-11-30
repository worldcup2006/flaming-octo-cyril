<?php
namespace Minutes;
class Session
{
    const PREFIX = 'Minutes';

    public static function start() {
        if (!self::exists()) {
            if(!@session_start()) {
                session_regenerate_id(true);
                session_start();
            }
        }        
    }
    public static function exists() {
        if ('PHP_SESSION_ACTIVE' == session_status()) {
            return true;
        }
        return false;
    }
    public static function setValue($valName, $val) {
        self::start();
        $_SESSION[self::PREFIX][$valName] = $val;        
    }
    public static function getValue($valName) {
        self::start();
        if(isset($_SESSION[self::PREFIX][$valName])){
            return $_SESSION[self::PREFIX][$valName];
        }
        return null;
    }
    public static function unsetValue($valName) {
        self::start();
        if(isset($_SESSION[self::PREFIX][$valName])){
            unset($_SESSION[self::PREFIX][$valName]);
        }
    }
    public static function getId() {
        return session_id();
    }
    public static function destroy() {
        session_destroy();
    }
}
