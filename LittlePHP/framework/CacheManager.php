<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-20
 * Time: PM2:04
 */
class CacheManager
{
    const CACHE_HOST = 'host';
    const CACHE_PORT = 'port';

    private static $cache = null;

    private static function getCache()
    {
        if (CacheManager::$cache == null)
        {
            require_once 'CacheConfig.php';
            $cacheConfigArray = CacheConfig::getConfigArray();

            CacheManager::$cache = new Memcache();
            CacheManager::$cache->connect($cacheConfigArray[ENVIROMENT][CacheManager::CACHE_HOST],
                                          $cacheConfigArray[ENVIROMENT][CacheManager::CACHE_PORT]);
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
