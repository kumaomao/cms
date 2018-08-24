<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/22 0022
 * Time: 下午 4:58
 */

namespace app\admin\model;
use app\admin\model\Image;

class Setting extends BaseModel
{


    public function bgImg(){
        return $this->belongsTo('Image','login_imgs','id');
    }

    public function adminLogoImg(){
        return $this->belongsTo('Image','admin_logo_img','id');
    }

    public function adminLogoImgMin(){
        return $this->belongsTo('Image','admin_logo_img_min','id');
    }


    /**
     * 读取系统配置
     * @param string $field
     * @return false|\PDOStatement|string|\think\Collection
     */
    public static function getSetting($field='*',$isWith=true){
        $self = $isWith?self::with(['bgImg','adminLogoImg','adminLogoImgMin']):self::where('1=1');
        $setting = $self->field($field)->find();
        return $setting;
    }

    /**
     * 获取登录背景图
     * @return array|false|\PDOStatement|string|\think\Model
     */
    public static function getLoginImg(){
        $setting = self::with('bgImg')->field('login_imgs')->find();
        $setting->hidden(['login_imgs','bg_img.id','bg_img.from','bg_img.delete_time','bg_img.update_time']);
        return $setting;
    }
}