<?php
/**
 * Created by PhpStorm.
 * User: 10832
 * Date: 2018/7/20
 * Time: 23:11
 */

namespace app\admin\model;


class Banner extends BaseModel
{

    public function item(){
        return $this->hasMany('BannerItem','banner_id','id');
    }

    public function getCreateTimeAttr($value){
        return $this->changeDate($value);
    }

    public function getUpdateTimeAttr($value){
        return $this->changeDate($value);
    }

    /**
     * 获取banner
     * @param $id
     * @return array|false|\PDOStatement|string|\think\Model
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\ModelNotFoundException
     * @throws \think\exception\DbException
     */
    public static function getBanner(){
        $banner = self::with(['item','item.img'])->find();
        return $banner;
    }

    public static function getBanners($page,$limit){
        $banner = self::page($page,$limit)->select();
        return $banner;
    }

    public static function addBanner($data){
        $result = self::create($data);
        return $result;
    }

//    public static function editBanner($data,$id){
//        $result = self::where('id','=',$id)->update($data);
//        return $result;
//    }

    public static function delBanner($id){
        $result = self::destroy($id);
        return $result;
    }


}