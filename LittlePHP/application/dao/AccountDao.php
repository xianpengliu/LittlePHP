<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:45
 */
require_once 'Account.php';

class AccountDao
{
    public static function queryAccount($wxId)
    {
        $sql = sprintf("SELECT * FROM %s WHERE %s = %d", Account::TABLE_NAME, Account::ID, $wxId);
        $result = DbManager::query($sql);
        $row = DbManager::fetchRow($result);

        $account = new Account();
        $account->updateFromRow($row);
        return $account;
    }
}
