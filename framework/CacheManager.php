<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-20
 * Time: PM2:04
 */
class CacheManager
{
    const CACHE_HOST = 'localhost';
    const CACHE_PORT = 11211;

    private static $cache = null;

    private static function getCache()
    {
        if (CacheManager::$cache == null)
        {
            CacheManager::$cache = new Memcache();
            CacheManager::$cache->connect('localhost', 11211);
        }

        return CacheManager::$cache;
    }

    public static function set($key, $value)
    {
        $memcache = CacheManager::getCache();
        if ($memcache)
        {
            return $memcache->set($key, $value);
        }
        else
        {
            return false;
        }
    }

    public static function get($key)
    {
        $memcache = CacheManager::getCache();
        if ($memcache)
        {
            return $memcache->get($key);
        }
        else
        {
            return false;
        }
    }
}
