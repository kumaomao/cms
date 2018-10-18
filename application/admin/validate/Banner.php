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
        'name'=>'require',
        'description'=>'require',
    ];

    protected $scene = [
        'banner'=>['name','description']
    ];
}