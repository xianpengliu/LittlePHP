<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:45
 */

require_once 'BaseDao.php';
require_once 'Account.php';

class AccountDao extends BaseDao
{
    public static function queryAccount($wxId)
    {
        $sql = sprintf('SELECT * FROM %s WHERE %s = ?', Account::TABLE_NAME, Account::ID);

        $stmt = DbManager::getDbConnect()->prepare($sql);
        $stmt->bindParam(1, $wxId);
        if ($stmt->execute())
        {
            $row = $stmt->fetch();

            $account = new Account();
            $account->updateFromRow($row);
            return $account;
        }
    }

    public static function test()
    {
        $account = AccountDao::queryAccount(1);
        var_dump($account);
    }
}
