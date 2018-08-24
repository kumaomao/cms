<?php
/**
 * Created by PhpStorm.
 * User: kumaomao
 * Date: 2018/6/15 0015
 * Time: 下午 3:30
 */

namespace app\lib\exception;


class ParameterException extends BaseException
{
    protected $code = 400;
    protected $msg ='invalid parameters';
    protected $errorCode = 10000;
}