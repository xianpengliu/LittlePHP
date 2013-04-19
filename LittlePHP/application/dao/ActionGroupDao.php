<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM5:35
 */

require_once 'BaseDao.php';
require_once 'ActionGroup.php';

class ActionGroupDao extends BaseDao
{
    public static function insert($name)
    {
        $sql = sprintf('INSERT INTO %s (%s) VALUES (?)', ActionGroup::TABLE_NAME, ActionGroup::NAME);

        $stmt = DbManager::getDbConnect()->prepare($sql);
        $stmt->bindParam(1, $name);
        $stmt->execute();
    }

    public static function queryAll()
    {
        $actionGroupArray = array();

        $sql = sprintf('SELECT * FROM %s', ActionGroup::TABLE_NAME);

        $stmt = DbManager::getDbConnect()->prepare($sql);
        if ($stmt->execute())
        {
            $rowArray = $stmt->fetchAll();
            foreach ($rowArray as $row)
            {
                $actionGroup = new ActionGroup();
                $actionGroup->updateFromRow($row);
                $actionGroupArray []= $actionGroup;
            }
        }

        return $actionGroupArray;
    }

    public static function test()
    {
        ActionGroupDao::insert("哈哈" . time());

        $actionGroupArray = ActionGroupDao::queryAll();
        var_dump($actionGroupArray);
    }
}
