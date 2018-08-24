<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/4 0004
 * Time: 下午 6:54
 */

namespace app\lib\exception;


class UnauthException extends BaseException
{
    public $code = 401;
    public $errorCode = 10002;
    public $msg = "未授权";
}