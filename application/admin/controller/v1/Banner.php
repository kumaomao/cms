<?php
/**
 * 轮播图片管理
 */
namespace app\admin\controller;
use app\admin\model\Banner as BannerModel;

class Banner extends Base{
    /**
     * 获取banner图片
     * @param $id
     * @return BannerModel|array|false|\PDOStatement|string|\think\Model
     * @throws MissException
     */
    public function getBanner(){
        $banner = BannerModel::getBanner();
        if(!$banner){
            throw new MissException([
                'msg'=>'请求Banner不存在',
                'errorCode'=>40000
            ]);
        }
        return json(['data'=>$banner]);
    }
}