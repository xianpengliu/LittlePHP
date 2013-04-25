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
            require_once 'LogConfig.php';
            $logConfigArray = LogConfig::getConfigArray();

            Logger::configure($logConfigArray);
            LogManager::$logger = Logger::getLogger("LOG");
        }
    }

    public static function debug($msg, $file = __FILE__, $line = __LINE__)
    {
        LogManager::initialize();
        LogManager::$logger->debug(LogManager::formatMsg($msg, $file, $line));
    }

    public static function info($msg, $file = __FILE__, $line = __LINE__)
    {
        LogManager::initialize();
        LogManager::$logger->info(LogManager::formatMsg($msg, $file, $line));
    }

    public static function warn($msg, $file = __FILE__, $line = __LINE__)
    {
        LogManager::initialize();
        LogManager::$logger->warn(LogManager::formatMsg($msg, $file, $line));
    }

    public static function error($msg, $file = __FILE__, $line = __LINE__)
    {
        LogManager::initialize();
        LogManager::$logger->error(LogManager::formatMsg($msg, $file, $line));
    }

    public static function fatal($msg, $file = __FILE__, $line = __LINE__)
    {
        LogManager::initialize();
        LogManager::$logger->fatal(LogManager::formatMsg($msg, $file, $line));
    }


    private static function formatMsg($msg, $file, $line)
    {
        return $msg . ' (' . $file . ':' . $line . ')';
    }
}
