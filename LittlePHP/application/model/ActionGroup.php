<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM5:15
 */

require_once 'BaseModel.php';

class ActionGroup extends BaseModel
{
    const TABLE_NAME = 'action_group';
    const ID         = 'id';
    const NAME       = 'name';

    private $id   = 0;
    private $name = 0;

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    public function updateFromRow($row)
    {
        $this->id   = isset($row[ActionGroup::ID])   ? $row[ActionGroup::ID]   : $this->id;
        $this->name = isset($row[ActionGroup::NAME]) ? $row[ActionGroup::NAME] : $this->name;
    }
}
