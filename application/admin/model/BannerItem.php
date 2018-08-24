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
}