<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/24
 * Time: 17:19
 */

namespace app\admin\model;


class Category extends BaseModel
{

    /**
     * 获取所有栏目
     * @return false|\PDOStatement|string|\think\Collection
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getCategory($page,$limit){
        $info = self::page($page,$limit)->select();
        return $info;
    }


    public static function addCategory($data){
        $result = self::create($data);
        return $result;
    }


    public static function delCategory($id){
        $result = self::destroy($id);
        return $result;
    }

}