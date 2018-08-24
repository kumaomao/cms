<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/23 0023
 * Time: 下午 4:26
 */

namespace app\admin\model;

/**
 * toekn配置信息
 * Class Token
 * @package app\admin\model
 */
class Token extends BaseModel
{
    //设置id为只读字段
    protected $readonly = ['id'];

    /**
     * 获取token配置信息
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getTokenSetting(){
        $tokenSetting = self::find(1);
        return $tokenSetting;
    }

    /**
     * 修改token配置
     * @param $data
     * @return $this
     */
    public static function updateToken($data){
        $result = self::where('id',1)->update($data);
        return $result;
    }

}