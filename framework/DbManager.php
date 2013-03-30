<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:20
 */
class DbManager
{
    const DB_HOST = 'localhost';
    const DB_USER = 'root';
    const DB_PASS = '';
    const DB_NAME = 'wxgame';

    private static $connect = null;

    public static function initialize()
    {
        if (DbManager::$connect == null)
        {
            DbManager::$connect = mysql_connect(DbManager::DB_HOST, DbManager::DB_USER, DbManager::DB_PASS);
            mysql_select_db(DbManager::DB_NAME);

            mysql_query("SET NAMES 'UTF8'");
            mysql_query("SET CHARACTER SET UTF8");
            mysql_query("SET CHARACTER_SET_RESULTS=UTF8'");
        }
    }

    public static function getDbConnect()
    {
        DbManager::initialize();

        return DbManager::$connect;
    }

    public static function closeDbConnect()
    {
        if (DbManager::$connect != null)
        {
            DbManager::close(DbManager::$connect);
        }
    }

    /*************************************************************
     * 封装 mysql_* 函数
     *************************************************************/
    public static function connect($dbHost, $dbUser, $dbPass)
    {
        DbManager::initialize();
        return mysql_connect($dbHost, $dbUser, $dbPass);
    }

    public static function close($connect)
    {
        DbManager::initialize();
        return mysql_close($connect);
    }

    public static function selectDb($dbName)
    {
        DbManager::initialize();
        return mysql_select_db($dbName);
    }

    public static function query($sql)
    {
        DbManager::initialize();
        return mysql_query($sql);
    }

    public static function fetchArray($result, $resultType = MYSQL_ASSOC)
    {
        DbManager::initialize();
        return mysql_fetch_array($result, $resultType);
    }

    public static function fetchRow($result)
    {
        DbManager::initialize();
        return mysql_fetch_row($result);
    }

    public static function numRows($result)
    {
        DbManager::initialize();
        return mysql_num_rows($result);
    }

    public static function numFields($result)
    {
        DbManager::initialize();
        return mysql_num_fields($result);
    }

    public static function affectedRows($result)
    {
        DbManager::initialize();
        return mysql_affected_rows($result);
    }
}
