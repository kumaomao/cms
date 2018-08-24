<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23 0023
 * Time: 上午 10:45
 */

namespace app\lib\exception;


class InternalnException extends BaseException
{
    protected $code = 500;
    protected $msg = '内部错误';
    protected $errorCode = 10006;
}