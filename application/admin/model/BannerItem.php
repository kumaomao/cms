<?php
/**
 * Created by PhpStorm.
 * User: 10832
 * Date: 2018/7/20
 * Time: 23:14
 */

namespace app\admin\model;


class BannerItem extends BaseModel
{
    public function img(){
        return $this->belongsTo('Image','img_id','id');
    }


    public static function getBannerItem($id,$page=1,$limit=10){
        $info = self::with(['img'])
            ->where('banner_id','=',$id)
            ->page($page,$limit)
            ->select();
        return $info;
    }

    public static function addBannerItem($data){
        $result = self::create($data);
        return $result;
    }

    public static function editBannerItem($data,$id){
        $result = self::where('id','=',$id)->update($data);
        return $result;
    }

    public static function delBannerItem($id){
        $result = self::destroy($id,true);
        return $result;
    }
}