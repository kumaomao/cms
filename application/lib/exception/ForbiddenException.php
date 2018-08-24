<?php
namespace app\lib\exception;

/**
 * token验证失败时抛出此异常 
 */
class ForbiddenException extends BaseException
{
    public $code = 403;
    public $msg = '该资源禁止访问';
    public $errorCode = 10003;
}