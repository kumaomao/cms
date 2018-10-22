<?php
/**
 * 轮播图片管理
 */
namespace app\admin\controller\v1;
use app\admin\controller\BaseController;
use app\admin\model\Banner as BannerModel;
use app\admin\validate\IDcheck;
use app\admin\model\BannerItem as BannerItemModel;
use app\admin\validate\Limit;
use app\admin\validate\Banner as BannerValidate;

class Banner extends BaseController {
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
        return $this->returnJson(['code'=>0,'data'=>$banner]);
    }

    /**
     * 获取banner位置
     * @param $page 页数
     * @param $limit 每页数量
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function getBanners($page,$limit){
        $validate = new Limit();
        $validate->goCheck();
        $banner = BannerModel::getBanners($page,$limit);
        return $this->returnJson(['code'=>0,'count'=>count($banner),'data'=>$banner]);
    }

    /**
     * 获取banner下图片
     * @param $id banner_id
     * @param $page 页数
     * @param $limit 每页数量
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function getBannerItem($id,$page,$limit){
        $validate = new IDcheck();
        $validate->goCheck();
        $validate = new Limit();
        $validate->goCheck();
        $bannerItem = BannerItemModel::getBannerItem($id,$page,$limit);
        $bannerItem = changeDataToJion($bannerItem,'img','url');
        return $this->returnJson(['code'=>0,'count'=>count($bannerItem),'data'=>$bannerItem]);
    }

    /**
     * 添加banner位置
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function addBanner(){
        $validate = new BannerValidate();
        $validate->scene('banner')->goCheck();
        $data = $validate->getDataByRule(input('post.'),'banner');
        $result = BannerModel::addBanner($data);
        return $this->returnJson(['msg'=>'添加成功']);
    }


    /**
     * 删除banner
     * @param $id
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function delBanner($id){
        (new IDcheck())->goCheck();
        $result = BannerModel::delBanner($id);
        return $result?$this->returnJson(['code'=>200,'msg'=>'删除成功']):$this->returnJson(['code'=>0,'msg'=>'该位置下存在图片，无法删除']);
    }
}