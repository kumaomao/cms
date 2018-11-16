<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/10/24
 * Time: 17:19
 */

namespace app\admin\validate;


class Category extends BaseValidate
{

    protected $rule = [
        'id'=>'require|checkIDs',
        'pid'=>'require|checkIDs',
        'order'=>'require|number',
        'name'=>'require',
        'description'=>'require',
        'seo_title'=>'require',
        'seo_keywords'=>'require',
        'seo_description'=>'require',
    ];
}