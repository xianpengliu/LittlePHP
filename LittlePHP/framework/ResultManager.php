<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-25
 * Time: PM3:01
 */
class ResultManager
{
    const CODE_ERROR   = 0;
    const CODE_SUCCESS = 1;


    private static $codeMsgArray = array(
        ResultManager::CODE_ERROR   => 'Error',
        ResultManager::CODE_SUCCESS => 'Success',
    );

    private static function getMsg($code)
    {
        return ResultManager::$codeMsgArray[$code];
    }

    public static function getResultJson($code, $resultArray, $msg = NULL)
    {
        $jsonArray = array();
        $jsonArray['code'] = $code;
        $jsonArray['msg']  = isset($msg) ? $msg : ResultManager::getMsg($code);
        $jsonArray['data'] = $resultArray;

        return json_encode($jsonArray);
    }
}