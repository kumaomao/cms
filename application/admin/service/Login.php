<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/22 0022
 * Time: 下午 4:57
 */

namespace app\admin\service;
use app\admin\model\AdminList;
use app\lib\exception\MissException;
use app\lib\exception\PermissionsException;
use app\admin\model\AdminLog;


class Login
{

    public function Login($username,$password){
        $adminInfo = AdminList::getAdminInfoByUsername($username);
        if(!$adminInfo){
            throw new MissException([
                'msg'=>'用户不存在',
                'errorCode'=>60000
            ]);
        }

        //密码不一致
        if($adminInfo['password']!=Md5($password)){
            throw new PermissionsException([
                'msg'=>'密码错误',
                'errorCode'=>60001
            ]);
        }

        //登陆成功
        //移除密码信息
        unset($adminInfo['password']);
        //写入缓存

        //过滤需要的字段
        $adminInfo = $adminInfo->visible(['id','username','nickname','img.details','img.url','create_time'])->toArray();
        $token =Token::setCacheByToken($adminInfo);
        //写入操作log
        $log=AdminLog::setLog($adminInfo['id'],$adminInfo['username'],'管理员:'.$adminInfo['username'].'登陆了后台');
        return ['token'=>$token,'userInfo'=>$adminInfo];
    }

}