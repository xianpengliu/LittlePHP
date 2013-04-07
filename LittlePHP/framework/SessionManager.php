<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-7
 * Time: PM4:33
 */
class SessionManager
{
    public static function start()
    {
        session_start();
    }

    public static function destory()
    {
        session_destroy();
    }

    public static function reset()
    {
        /*************************************************************
         * As php document
         * session_regenerate_id(true) will reset the session array
         * But it doesn't work well. (I don't know why)
         * So call session_unset() to reset the session array
         *************************************************************/
        session_regenerate_id(true);
        session_unset();
    }

    public static function getSessionId()
    {
        return session_id();
    }

    public static function set($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    /*************************************************************
     * For Debug
     * echo the session info in memcache
     *************************************************************/
    public static function getSessionInfo()
    {
        return CacheManager::get(SessionManager::getSessionId());
    }
}
