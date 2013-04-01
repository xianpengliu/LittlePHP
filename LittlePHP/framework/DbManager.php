<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:20
 */
class DbManager
{
    const DB_DSN        = 'db.dsn';
    const DB_USER       = 'db.user';
    const DB_PASS       = 'db.pass';
    const DB_PERSISTENT = 'db.persistent';

    private static $connect = null;

    public static function initialize()
    {
        if (DbManager::$connect == null)
        {
            try
            {
                $dbSettings = parse_ini_file('../config/db_config.ini');

                DbManager::$connect = new PDO($dbSettings[DbManager::DB_DSN],
                                              $dbSettings[DbManager::DB_USER],
                                              $dbSettings[DbManager::DB_PASS],
                                              array(PDO::ATTR_PERSISTENT => $dbSettings[DbManager::DB_PERSISTENT]));

                DbManager::$connect->query("SET NAMES 'UTF8'");
                DbManager::$connect->query("SET CHARACTER SET UTF8");
                DbManager::$connect->query("SET CHARACTER_SET_RESULTS=UTF8'");
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
