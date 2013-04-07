<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-3-19
 * Time: PM5:08
 */
class User
{
    const TABLE_NAME = 'account';
    const ID         = 'id';
    const NAME       = 'name';
    const GENDER     = 'gender';
    const HEIGHT     = 'height';
    const WEIGHT     = 'weight';

    private $id     = 0;
    private $name   = '';
    private $gender = 0;
    private $height = 0;
    private $weight = 0;

    public function setGender($gender)
    {
        $this->gender = $gender;
    }

    public function getGender()
    {
        return $this->gender;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getHeight()
    {
        return $this->height;
    }

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

    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function updateFromRow($row)
    {
        $this->id     = isset($row[User::ID])     ? $row[User::ID]     : $this->id;
        $this->name   = isset($row[User::NAME])   ? $row[User::NAME]   : $this->name;
        $this->gender = isset($row[User::GENDER]) ? $row[User::GENDER] : $this->gender;
        $this->height = isset($row[User::HEIGHT]) ? $row[User::HEIGHT] : $this->height;
        $this->weight = isset($row[User::WEIGHT]) ? $row[User::WEIGHT] : $this->weight;
    }
}
