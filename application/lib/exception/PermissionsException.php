<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23 0023
 * Time: 上午 10:31
 */

namespace app\lib\exception;

/**
 * 权限不足
 * Class PermissionsException
 * @package app\lib\exception
 */
class PermissionsException extends BaseException
{
    protected $code = 401;
    protected $msg ='invalid parameters';
    protected $errorCode = 10002;
}