<?php
namespace app\lib\exception;
/**
 *404时抛出此异常
 */
class MissException extends BaseException{

    protected $code = 404;
    protected $msg = 'global:your required resource are not found';
    protected $errorCode = 10001;
}