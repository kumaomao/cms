<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/22 0022
 * Time: 下午 4:40
 */

namespace app\admin\model;


class Image extends BaseModel
{
    public function getUrlAttr($value,$data){
        return $this->prefixImgUrl($value,$data);
    }

    public static function getImageById($id){

    }
}