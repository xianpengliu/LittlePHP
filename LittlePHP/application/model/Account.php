<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM4:13
 */
class Account
{
    const TABLE_NAME = 'account';
    const ID         = 'id';
    const WX_ID      = 'wx_id';
    const WX_NAME    = 'wx_name';

    private $id     = 0;
    private $wxId   = 0;
    private $wxName = '';

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setWxId($wxId)
    {
        $this->wxId = $wxId;
    }

    public function getWxId()
    {
        return $this->wxId;
    }

    public function setWxName($wxName)
    {
        $this->wxName = $wxName;
    }

    public function getWxName()
    {
        return $this->wxName;
    }

    public function updateFromRow($row)
    {
        $this->id     = isset($row[Account::ID])      ? $row[Account::ID]      : $this->id;
        $this->wxId   = isset($row[Account::WX_ID])   ? $row[Account::WX_ID]   : $this->id;
        $this->wxName = isset($row[Account::WX_NAME]) ? $row[Account::WX_NAME] : $this->wxName;
    }
}
