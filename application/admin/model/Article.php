<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/11/16
 * Time: 11:19
 */

namespace app\admin\model;


class Article extends BaseModel
{

    public static function addArticle($data){
        $result = self::create($data);
        return $result;
    }

    public static function delArticle($id){
        $result = self::destroy($id);
        return $result;
    }

    public static function getArticle($page,$limit){
        $info = self::page($page,$limit)->select();
        return $info;
    }

}