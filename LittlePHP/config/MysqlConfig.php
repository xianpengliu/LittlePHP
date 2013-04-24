<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-24
 * Time: PM5:17
 */
class MysqlConf
{
    public static function getConfigArray()
    {
        return array(
                     'dev' => array('dsn'=>'mysql:host=localhost;dbname=wxgame', 'user'=>'lxp', 'pass'=>'', 'options'=>array(PDO::ATTR_PERSISTENT=>true, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'UTF8'")),
                     'pro' => array('dsn'=>'mysql:host=localhost;dbname=wxgame', 'user'=>'lxp', 'pass'=>'', 'options'=>array(PDO::ATTR_PERSISTENT=>true, PDO::MYSQL_ATTR_INIT_COMMAND=>"SET NAMES 'UTF8'")),
                    );
    }
}