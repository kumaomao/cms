<?php
namespace app\lib\exception;
use Exception;
use think\exception\Handle;
use think\Log;
use think\Request;

class ExceptionHandler extends Handle{

    private $code;
    private $msg;
    private $errorCode;
    //返回客服端当前请求的URL路径

    public function render(Exception $e)
    {
        //判断异常是否继承BaseException，如果是就为自定义异常
        if($e instanceof BaseException){
            //如果是自定义异常，则控制http状态码，不需要记录日志
            //因为这些通常是因为客户端传递参数错误或者是用户请求造成的异常
            //不应当记录日志
            $this->code = $e->getCode();
            $this->msg = $e->getMsg();
            $this->errorCode = $e->getErrorCode();
        }else{
            // 如果是服务器未处理的异常，将http状态码设置为500，并记录日志
            if(config('app_debug')){
                // 调试状态下需要显示TP默认的异常页面，因为TP的默认页面
                // 很容易看出问题
                return parent::render($e);
            }

            $this->code = 500;
            $this->msg = 'sorry，we make a mistake. (^o^)Y';
            $this->errorCode = 999;

            //错误日志记录
            $this->recordErrorLog($e);
        }


        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' =>$request->url(),
        ];
       return json($result,$this->code);
    }

    /**
     * 异常写入日志
     */
    private function recordErrorLog(Exception $e){
        Log::init([
            'type'  =>  'File',
            'path'  =>  LOG_PATH,
            'level' => ['error']
        ]);
        Log::record($e->getMessage(),'error');
    }
}