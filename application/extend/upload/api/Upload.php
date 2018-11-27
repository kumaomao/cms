<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 10:03
 */
namespace upload\api;

interface Upload
{
    public static function init($Oss);
    public static function uploadFile($object,$Path,$bucket);
}