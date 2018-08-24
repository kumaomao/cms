<?Php
namespace app\lib\exception;
use think\Exception;
class BaseException extends Exception{
    //HTTP状态码
    protected $code = '400';
    //错误具体信息
    protected $msg = 'error_args';
    //自定义的错误码
    protected $errorCode  = '10000';

    /**
     * 构造函数，接收一个关联数组
     * @param array $params 关联数组只应包含code、msg和errorCode，且不应该是空值
     */
    public function __construct($params=[])
    {
        if(!is_array($params)){
            return;
        }
        if(array_key_exists('code',$params)){
            $this->code = $params['code'];
        }
        if(array_key_exists('msg',$params)){
            $this->msg = $params['msg'];
        }
        if(array_key_exists('errorCode',$params)){
            $this->errorCode = $params['errorCode'];
        }
    }
    

    public function getMsg(){
        return $this->msg;
    }

    public function getErrorCode(){
        return $this->errorCode;
    }
}