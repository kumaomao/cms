<?php
namespace app\admin\model;
use think\Cache;
use think\Model;
use traits\model\SoftDelete;

class BaseModel extends Model{

     use SoftDelete;

    protected function prefixImgUrl($value,$data){
        $imageUrl = $value;
        if($data['from']==1){
            $setting = Cache::get('settingConfig');//获取配置缓存
            $url = $setting?$setting:Setting::getSetting('img_url',false);
            $imageUrl = $url['img_url'].$imageUrl;
        }
        return $imageUrl;
    }

    //转换时间戳为时间
    protected function changeDate($value){
        $date = date("Y-m-d H:i:s",$value);
        return $date;
    }
}