<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM5:16
 */

require_once 'BaseModel.php';

class ActionInfo extends BaseModel
{
    const TABLE_NAME = 'action_info';
    const ID         = 'id';
    const GROUP_ID   = 'group_id';
    const NEXT_ID    = 'next_id';
    const CONTENT    = 'content';

    private $id      = 0;
    private $groupId = 0;
    private $nextId  = 0;
    private $content = '';

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    public function getGroupId()
    {
        return $this->groupId;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setNextId($nextId)
    {
        $this->nextId = $nextId;
    }

    public function getNextId()
    {
        return $this->nextId;
    }

    public function updateFromRow($row)
    {
        $this->id      = isset($row[ActionInfo::ID])       ? $row[ActionInfo::ID]       : $this->id;
        $this->groupId = isset($row[ActionInfo::GROUP_ID]) ? $row[ActionInfo::GROUP_ID] : $this->groupId;
        $this->nextId  = isset($row[ActionInfo::NEXT_ID])  ? $row[ActionInfo::NEXT_ID]  : $this->nextId;
        $this->content = isset($row[ActionInfo::CONTENT])  ? $row[ActionInfo::CONTENT]  : $this->content;
    }
}
