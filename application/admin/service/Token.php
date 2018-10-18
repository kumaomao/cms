<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/9 0009
 * Time: 下午 3:05
 */

namespace app\admin\service;
use app\lib\exception\UnauthException;
use think\Cache;
use think\Request;

/**
 * 令牌管理
 * Class Token
 * @package app\api\service
 */
class Token
{

    private static function getToken(){
        $token = Request::instance()->header('token');
        if(!$token){
           $token =  Request::instance()->param('token');
        }
        return $token;
    }

    /**
     * 生成token
     * @return string
     */
    private static function generateToken()
    {
        //获取关键字
        $tokenSalt =get_option('token.tokenSalt');
        $randChar = self::getRandChar(32);
        //获取请求提交时间
        $timestamp = $_SERVER['REQUEST_TIME_FLOAT'];
        //生成token
        return sha1(md5($randChar . $timestamp . $tokenSalt));
    }

    /**
     * 读取token数据
     * @param $key
     * @return mixed
     * @throws UnauthException
     */
    public static function getDataByToken($key){
        $token = self::getToken();
        $vars = Cache::get($token);

        if($vars){
            return changeArr($vars,$key);
        }
        throw new UnauthException([
            'msg'=>'身份不合法',
            'errorCode'=>20002
        ]);

    }


    /**
     * 验证token
     * @return array|mixed
     * @throws UnauthException
     */
    public static function checkToken(){
        $status =get_option('token.status');
        //判断验证模式
        if($status){
            $uid = self::getDataByToken('id');
            return $uid;
        }
        //token自动刷新
        //保存的到期时间
        $time_expire = self::getDataByToken('time_expire');
        $time_last =get_option('token.time_last');
        if(time()>$time_expire){
            throw new UnauthException([
                'msg'=>'身份不合法',
                'errorCode'=>20002
            ]);
        }
        //产生新的token并储存
        if($time_expire - time() < $time_last ){
            $old_token = self::getToken();
            $value = Cache::get($old_token);
            //删除过期缓存
            Cache::rm($old_token);
            $token = self::setCacheByToken($value);
            //返回新token
            return ['id'=>changeArr($value,'id'),'token'=>$token];
         }
         return self::getDataByToken('id');
    }

    /**
     * 将token写入缓存
     * @param $value
     * @return string
     */
    public static  function setCacheByToken($value){
        $token = self::generateToken();
        $time_expire =get_option('token.time_expire');
        $status = get_option('token.status');
        //判断写入模式 0自动更新，1不自动更新
        if($status){
            $result = Cache::set($token,$value,$time_expire);
        }else{
            //计算缓存到期时间
            $value['time_expire']=time()+$time_expire;
            $result = Cache::set($token,$value);
        }
        if (!$result){
            throw new UnauthException([
                'msg' => '服务器缓存异常',
                'errorCode' => 10005
            ]);
        }
        return $token;
    }

    /**
     * 生成随机字符串
     * @access public
     * @param  int $length 长度
     * @return String
     */
    private static function getRandChar($length){
        $str = null;
        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPol) - 1;

        for ($i = 0;
             $i < $length;
             $i++) {
            $str .= $strPol[rand(0, $max)];
        }
        return $str;
    }
}