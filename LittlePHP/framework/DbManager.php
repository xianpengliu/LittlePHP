<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:20
 */
class DbManager
{
    const DB_DSN        = 'dsn';
    const DB_USER       = 'user';
    const DB_PASS       = 'pass';
    const DB_OPTIONS    = 'options';

    private static $connect = null;

    public static function initialize()
    {
        if (DbManager::$connect == null)
        {
            try
            {
                require_once 'MysqlConfig.php';
                $mysqlConfigArray = MysqlConf::getConfigArray();

                DbManager::$connect = new PDO($mysqlConfigArray[ENVIRONMENT][DbManager::DB_DSN],
                                              $mysqlConfigArray[ENVIRONMENT][DbManager::DB_USER],
                                              $mysqlConfigArray[ENVIRONMENT][DbManager::DB_PASS],
                                              $mysqlConfigArray[ENVIRONMENT][DbManager::DB_OPTIONS]);
            }
            catch (PDOException $e)
            {
                LogManager::warn('Can NOT connect to database!!!');
            }
        }
    }

    public static function getDbConnect()
    {
        if (DbManager::$connect == null)
        {
            DbManager::initialize();
        }

        return DbManager::$connect;
    }

    public static function closeDbConnect()
    {
        DbManager::$connect = null;
    }
}
