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


}