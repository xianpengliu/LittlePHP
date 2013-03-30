<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM6:04
 *
 * <--配置文件、log文件的路径均是相对于public_html目录-->
 *
 */

require_once 'log4php/Logger.php';

class LogManager
{
    private static $logger = null;

    public static function initialize()
    {
        if (LogManager::$logger == null)
        {
            Logger::configure('../config/log_config.properties');
            LogManager::$logger = Logger::getLogger("LOG");
        }
    }

    public static function debug($msg)
    {
        LogManager::initialize();
        LogManager::$logger->debug($msg);
    }

    public static function warn($msg)
    {
        LogManager::initialize();
        LogManager::$logger->warn($msg);
    }
}
