<?php

define('ROOT_DIR',        dirname(dirname(__FILE__)) . '/');
define('FRAMEWORK_DIR',   ROOT_DIR . 'framework/');
define('APPLICATION_DIR', ROOT_DIR . 'application/');
define('LIBS_DIR',        ROOT_DIR . 'libs');
define('MODULE_DIR',      APPLICATION_DIR . 'module/');
define('MODEL_DIR',       APPLICATION_DIR . 'model/');
define('DAO_DIR',         APPLICATION_DIR . 'dao/');

set_include_path(
    FRAMEWORK_DIR   . PATH_SEPARATOR .
    APPLICATION_DIR . PATH_SEPARATOR .
    MODEL_DIR       . PATH_SEPARATOR .
    DAO_DIR         . PATH_SEPARATOR .
    LIBS_DIR        . PATH_SEPARATOR .
    get_include_path()
);

ini_set('display_errors', 1);
ini_set('date.timezone', 'Asia/Shanghai');

try
{
    /*************************************************************
     * 将一些常用的php文件提前require
     * 免得在代码中导出require
     *************************************************************/
    require_once 'LogManager.php';
    require_once 'DbManager.php';
    require_once 'CacheManager.php';

    /*************************************************************
     * 解析url路径
     *************************************************************/
    require_once 'Router.php';
    $route = Router::getRoute($_SERVER['REQUEST_URI']);

    /*************************************************************
     * 根据路径执行相应的逻辑
     *************************************************************/
    require_once 'Application.php';
    Application::start($route);
}
catch(Exception $e)
{
    echo 'Server Exception';
}

// Close DB connect
DbManager::closeDbConnect();