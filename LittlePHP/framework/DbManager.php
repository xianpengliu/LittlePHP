<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:20
 */
class DbManager
{
    const DB_DSN = 'mysql:host=localhost;dbname=wxgame';
    const DB_USER = 'lxp';
    const DB_PASS = '';

    private static $connect = null;

    public static function initialize()
    {
        if (DbManager::$connect == null)
        {
            try
            {
                DbManager::$connect = new PDO(DbManager::DB_DSN, DbManager::DB_USER, DbManager::DB_PASS, array(PDO::ATTR_PERSISTENT => true));
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
