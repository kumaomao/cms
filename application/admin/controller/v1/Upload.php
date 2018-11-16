<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/23
 * Time: 17:48
 */

namespace app\admin\controller\v1;


use app\admin\controller\BaseController;
use app\admin\validate\Upload as UploadValidate;
use app\admin\model\Option as OptionModel;
use app\admin\service\Upload as UploadService;
use think\Cache;

//上传接口
class Upload extends BaseController
{


    /**
     * 上传接口
     * @return \think\response\Json
     * @throws \app\lib\exception\ParameterException
     */
    public function upload(){
        $result = UploadService::upload();
        return $this->returnJson($result);
    }

    public function setUpload(){
        $validate = new UploadValidate();
        $validate->goCheck();
        $data = $validate->getDataByRule(input('post.'));
        $result = OptionModel::setOption('upload',$data);

        //更新缓存
        Cache::set('Option_upload',$result);
        return $this->returnJson(['msg'=>'修改成功']);
    }

    public function getUpload(){
        $info = get_option('upload');
        return $this->returnJson(['msg'=>'成功','data'=>$info]);
    }

}