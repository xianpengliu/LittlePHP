<?php
/**
 * Created by JetBrains PhpStorm.
 * User: xianpengliu
 * Date: 13-4-25
 * Time: PM3:01
 */
class ResultManager
{
    const CODE_ERROR       = 0;
    const CODE_SUCCESS     = 1;
    const CODE_ERROR_ROUTE    = 2;

    const CODE_ERROR_REGISTER = 10;

    private static $codeMsgArray = array(
        ResultManager::CODE_ERROR       => 'Error',
        ResultManager::CODE_SUCCESS     => 'Success',
        ResultManager::CODE_ERROR_ROUTE    => 'Error Route',

        ResultManager::CODE_ERROR_REGISTER => 'Error Register',
    );

    private static function getMsg($code)
    {
        return ResultManager::$codeMsgArray[$code];
    }

    /*
     * 为了处理中文
     * 对$msg调用 urlencode
     * 并对json_encode的结果调用 urldecode
     *
     * 对于$resultArray中的中文字符串
     * 由调用者保证已经调用过urlencode
     */
    public static function getResultJson($code, $resultArray = NULL, $msg = NULL)
    {
        // 处理中文，先urlencode, 再urldecode
        $resultArray = ResultManager::makeFormat($resultArray);

        $jsonArray = array();
        $jsonArray['code'] = $code;
        $jsonArray['msg']  = isset($msg) ? urlencode($msg) : ResultManager::getMsg($code);
        $jsonArray['data'] = isset($resultArray) ? $resultArray : array();

        return urldecode(json_encode($jsonArray));
    }

    private static function makeFormat($data)
    {
        if (is_string($data))
        {
            return urlencode($data);
        }
        elseif (is_array($data))
        {
            foreach ($data as $key => $value)
            {
                $data[$key] = ResultManager::makeFormat($value);
            }

            return $data;
        }
        else
        {
            return $data;
        }
    }
}