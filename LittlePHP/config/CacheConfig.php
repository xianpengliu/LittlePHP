<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-24
 * Time: PM5:58
 */
class CacheConfig
{
    public static function getConfigArray()
    {
        return array(
            'dev' => array('host'=>'localhost', 'port'=>11211),
            'pro' => array('host'=>'localhost', 'port'=>11211),
        );
    }
}