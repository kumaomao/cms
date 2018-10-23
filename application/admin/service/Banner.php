<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/22
 * Time: 17:50
 */

namespace app\admin\service;


use app\admin\model\BannerItem;
use app\admin\model\Banner as BannerModel;

class Banner
{

    public static function delBanner($id){
        //判断id是单id还是多id
        $values = explode(',', $id);
        $arr_id = [];
        if(empty($values)){
            //单id
            $arr_id=[$id];
        }else{
            $arr_id = $values;
        }
        $result = self::checkBannerIsHaveItem($arr_id);
        if($result){
            return ['code'=>0,'msg'=>'id:'.$result.'下存在图片，无法删除'];
        }
        BannerModel::delBanner($arr_id);
        return ['code'=>200,'msg'=>'删除成功'];

    }


    private static function checkBannerIsHaveItem($id){
        $_id = false;
        foreach ($id as $k=>$v){
            $info = BannerItem::getBannerItem($v);
            if(!$info->isEmpty()){
                $_id = $v;
                break;
            }
        }

        return $_id;
    }

}