<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-20
 * Time: PM2:04
 */
class CacheManager
{
    const CACHE_HOST = 'cache.host';
    const CACHE_PORT = 'cache.port';

    private static $cache = null;

    private static function getCache()
    {
        if (CacheManager::$cache == null)
        {
            $cacheSettings = parse_ini_file('../config/cache_config.ini');

            CacheManager::$cache = new Memcache();
            CacheManager::$cache->connect($cacheSettings[CacheManager::CACHE_HOST],
                                          $cacheSettings[CacheManager::CACHE_PORT]);
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
