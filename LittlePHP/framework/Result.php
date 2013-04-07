<?php
/**
 *
 */
class Result
{
    const CODE_SUCCESS = 0;

    private static $codeMsgArray = array(
        '0'     => 'Success',
        '1'     => 'False',
        '2'     => 'Server In Maintenance',
        '3'     => 'Client Version Too Low',

        // 注册登录相关
        '100'   => 'User Name Already Exists',
        '101'   => 'User Name Error',
        '102'   => 'Password Error',
        '103'   => 'Account Locked',

        // RPC调用相关错误
        '200'   => 'Route Error',
        '201'   => 'Params Error'
    );

    private $code;
    private $msg;
    private $dataArray = array();

    public function Result($code, $msg)
    {
        $this->code = $code;
        $this->msg = is_null($msg) ? self::$codeMsgArray[$code] : $msg;
    }

    public function addData($key, array $data)
    {
        $this->dataArray[$key] = $data;
    }

    public function encodeJson()
    {
        $resultArray = array('code' => $this->code, 'msg' => $this->msg, 'data' => $this->dataArray);
        return json_encode($resultArray);
    }

    /**
        测试用代码
        require_once 'Result.php';
        $result = new Result(Result::CODE_SUCCESS, 'haha');

        $data1 = array('key1' => 'data1');
        var_dump($data1);
        echo 'xxx';
        $result->addData('data1', $data1);

        $data2 = array('key2' => 'data2');
        $result->addData('data2', $data2);

        echo $result->encodeJson();
    */
}