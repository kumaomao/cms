<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/14
 * Time: 14:13
 */

namespace app\admin\model;

/**
 * 系统配置表
 * Class Option
 * @package app\admin\model
 */
class Option extends BaseModel
{

    /**
     * @param $key 键值
     * @param $data 配置数据
     * @param $replace 是否全部替换
     **/
    public static function setOption($key,$data,$replace=false){
        //判断key是否存在
        $option = self::where('option_name','=',$key)->find();
        if($option){//存在则更新
            if(!$replace){//合并
                $option_arr = json_decode($option['option_value'],true);
                if(!empty($option_arr)){
                    $data = array_merge($option_arr, $data);
                }
            }
            $_option['option_value'] = json_encode($data);
            $result =  self::where('option_name','=',$key)->update($_option);
            return $result;
        }
        //不存在则写入
        $_option=[
            'option_name'=>$key,
            'option_value'=>json_encode($data)
        ];
        $result = self::create($_option);
        return $result;
    }

    //读取数据
    public static function getOption($key){
        $option = self::where('option_name','=',$key)->find();
        return $option;
    }

}