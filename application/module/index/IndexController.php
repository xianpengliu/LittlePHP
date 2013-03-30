<?php
/**
 *
 */
class IndexController
{
    public static function indexAction()
    {
        LogManager::warn(time());

        require_once 'ActionGroupDao.php';
        $actionGroupArray = ActionGroupDao::queryAll();
        var_dump($actionGroupArray);

        require_once 'AccountDao.php';
        $account = AccountDao::queryAccount(1);
        var_dump($account);
    }
}