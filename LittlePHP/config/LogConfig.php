<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-25
 * Time: PM2:49
 */
class LogConfig
{
    public static function getConfigArray()
    {
        return array(
                    'rootLogger' => array(
                        'appenders' => array('default'),
                        'level' => 'DEBUG'
                    ),
                    'appenders' => array(
                        'default' => array(
                            'class' => 'LoggerAppenderDailyFile',
                            'layout' => array(
                                'class' => 'LoggerLayoutPattern',
                                'params' => array(
                                    'ConversionPattern' => '%d{Y-m-d H:i:s} [%p] %c: %m %n'
                                )
                            ),
                            'params' => array(
                                'file' => '../logs/%s.1log',
                                'append' => true
                            )
                        )
                    )
                );
    }
}
