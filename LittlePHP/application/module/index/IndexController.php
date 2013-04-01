<?php
/**
 *
 */
class IndexController
{
    public static function indexAction()
    {
        require_once 'ActionGroupDao.php';
        ActionGroupDao::test();

        require_once 'AccountDao.php';
        AccountDao::test();

        LogManager::error("zzzzzzz121212阿达2", __FILE__, __LINE__);
    }
}