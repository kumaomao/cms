<?php
/**
 * Created by PhpStorm.
 * User: 10832
 * Date: 2018/10/18
 * Time: 22:19
 */

namespace app\admin\validate;


class Banner extends BaseValidate
{
    protected $rule=[
        'id'=>'require',
        'name'=>'require',
        'description'=>'require',
        'img_id'=>'require|number',
        'key_word'=>'require',
        'url'=>'require',
        'banner_id'=>'require|number'
    ];

    protected $message=[
        'img_id.require'=>'请上传图片'
    ];

    protected $scene = [
        'banner'=>['id','name','description'],
        'bannerItem'=>['id','img_id','key_word','url','banner_id']
    ];
}