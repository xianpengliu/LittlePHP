<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM5:35
 */
require_once 'ActionGroup.php';

class ActionGroupDao
{
    public static function queryAll()
    {
        $actionGroupArray = array();

        $sql = sprintf("SELECT * FROM %s", ActionGroup::TABLE_NAME);
        $result = DbManager::query($sql);
        while ($row = DbManager::fetchArray($result))
        {
            $actionGroup = new ActionGroup();
            $actionGroup->updateFromRow($row);
            $actionGroupArray []= $actionGroup;
        }

        return $actionGroupArray;
    }
}
