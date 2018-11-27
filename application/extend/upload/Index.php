<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/27
 * Time: 9:53
 */


class Index
{
    private static $Oss=[
        'aliyun_oss'=>'\upload\api\AliOss',
    ];

    private static function init(){
        $config = require_once 'api\config.php';
        $Oss = $config['Oss'];//使用的对象存储
        //dump(self::$Oss[$Oss]);exit;
        $OssObject = self::$Oss[$Oss];
        $OssObject::init($config[$Oss]);
        return $OssObject;
    }

    public static function uploadFile($object,$Path,$bucket=false){
        $Oss = self::init();
        $result = $Oss::uploadFile($object,$Path,$bucket);
        return $result;
    }

}