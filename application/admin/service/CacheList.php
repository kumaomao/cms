<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/7/14 0014
 * Time: 上午 11:31
 */

namespace app\admin\service;

use app\admin\model\Menu;
use app\admin\model\Option;
use app\admin\model\Setting;
use app\lib\exception\MissException;
use think\Cache;
use app\admin\model\Token as TokenModel;

/**
 * 缓存管理
 * Class Cache
 * @package app\api\service
 */
class CacheList
{
//    /**
//     * 获取token配置
//     * @param $key
//     * @return mixed
//     */
//    public static function getTokenConfig($key){
//        $tokenConfig = Cache::remember('tokenConfig',function(){
//
//            $tokenConfig =  TokenModel::getTokenSetting();
//            if(!$tokenConfig){
//                throw new MissException([
//                    'msg'=>'token配置不存在',
//                    'errorCode'=>40002
//                ]);
//            }
//            return $tokenConfig->toArray();
//        });
//        return changeArr($tokenConfig,$key);
//    }
//
//    /**
//     *路由配置
//     * @return mixed
//     */
//    public static function getRouteConfig(){
//        $routeConfig = Cache::remember('routeConfig',function(){
//            $auth = new Auth();
//            $routeConfig = $auth->getRoute();
//            if($routeConfig->isEmpty()){
//                throw new MissException([
//                    'msg'=>'路由配置不存在',
//                    'errorCode'=>40004
//                ]);
//            }
//            return $routeConfig->toArray();
//        });
//        return changeArr($routeConfig);
//    }
//
//    /**
//     * 菜单缓存
//     * @return mixed
//     */
//    public static function getMenuConfig(){
//        $menuConfig = Cache::remember('menuConfig',function(){
//            $menuConfig = Menu::getMenuByStatus();//获取菜单
//            if($menuConfig->isEmpty()){
//                throw new MissException([
//                    'msg'=>'菜单配置不存在',
//                    'errorCode'=>40005
//                ]);
//            }
//            return $menuConfig->toArray();
//        });
//        return changeArr($menuConfig);
//    }
//
//    /**
//     * 获取系统配置信息
//     * @param $key
//     * @return mixed
//     */
//    public static function getSettingConfig($key="_all"){
//        $SettingConfig = Cache::remember('settingConfig',function(){
//            $settingConfig = Setting::getSetting();
//            if(!$settingConfig){
//                throw new MissException([
//                    'msg'=>'系统配置不存在',
//                    'errorCode'=>40006
//                ]);
//            }
//            return $settingConfig->toArray();
//        });
//        return changeArr($SettingConfig,$key);
//    }


    /**
     * 获取系统配置
     * @param $key
     * @return array|mixed|object
     */
    public static function getOptionConfig($key){
        //以.作为分割
        $key_arr = explode('.',$key);

        $optionConfig = Cache::get('Option_'.$key_arr[0]);

        if(!$optionConfig){//不存在则读取数据库
            $_optionCofig = Option::getOption($key_arr[0]);

            $optionConfig = $_optionCofig['option_value'];
            //存入缓存
            Cache::set('Option_'.$key_arr[0],$optionConfig);
        }

        if(!is_array($optionConfig))
        {
            $optionConfig = json_decode($optionConfig, true);
        }

        $num = count($key_arr);

        for($i=1;$i<$num;$i++){
            $optionConfig = $optionConfig[$key_arr[$i]];
        }

        return $optionConfig;
    }


}